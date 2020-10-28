<?php

namespace App\Http\Controllers;

use App\Experience;
use App\Performance;
use App\User;
use App\Badge;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\RecentSearch;
use App\EarnedBadge;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $badges = Badge::get();
        return view('themes.new-theme.user.dashboard',compact('badges'));
        // return view('user.dashboard.index');
    }
    public function top_hackers(){
        return view('themes.new-theme.user.top_hackers');
    }
    public function search_user(Request $request){
        $name = $request->q;
        $users = User::where('name','LIKE','%'.$name.'%')->orWhere('email','LIKE','%'.$name.'%')->orWhere('address','LIKE','%'.$name.'%')->select('id','name','profile_picture','slug','address')->withCount('experiences')->get();

        return view('themes.new-theme.user.search_user')->with('users',$users);
    }
    public function search_users_ajax(Request $request)
    {
        $name = $request->name;
        $users = User::where('name','LIKE','%'.$name.'%')->orWhere('email','LIKE','%'.$name.'%')->orWhere('address','LIKE','%'.$name.'%')->select('id','name','profile_picture','slug')->get()->take(7);
        $userCount = User::where('name','LIKE','%'.$name.'%')->orWhere('email','LIKE','%'.$name.'%')->orWhere('address','LIKE','%'.$name.'%')->count();

        $returnHTML = view('themes.new-theme.ajax_view.search_user')->with('users', $users)->with('count',$userCount)->with('search_name',$name)->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }
    public function store_recent_search(Request $request)
    {
        $search = new RecentSearch;
        $search->user_id = auth()->user()->id;
        $search->search_query = $request->q;
        $search->save();
        return response()->json(['success'=>true, 'msg'=>'search stored successfully']);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
        ]);
    }
    protected function performanceValidator(array $data)
    {
        return Validator::make($data, [
            'pitch' => 'required|numeric|min:0|max:10',
            'front_end' => 'required|numeric|min:0|max:10',
            'back_end' => 'required|numeric|min:0|max:10',
            'team_player' => 'required|numeric|min:0|max:10',
            'problem_solving' => 'required|numeric|min:0|max:10',
            'ux_design' => 'required|numeric|min:0|max:10',
        ]);
    }
    protected function hackontonValidator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'organized_by' => 'required',
            'from' => 'required',
            'to' => 'required',
            'description' => 'required|string|max:255',
            'result' => 'required',
        ]);
    }
    public function createSlug($title, $id = 0)
    {
        // Normalize the title
        $slug = str_slug($title);

        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = $this->getRelatedSlugs($slug, $id);

        // If we haven't used it before then we are all good.
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }

        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }

        throw new \Exception('Can not create a unique slug');
    }
    protected function getRelatedSlugs($slug, $id = 0)
    {
        return User::select('slug')->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();
    }
    public function profileUpdate(Request $request)
    {
        $id = Auth::user()->id;
        $validation = $this->validator($request->all());
        if ($validation->fails()) {
            return response()->json($validation->errors()->toArray());
        } else {
            $name = $request->name;
            $bio = $request->bio;
            $user = User::where('id',$id)->update([
                'name'=>$name,
                'bio'=>$bio,
            ]);

            if ($image = $request->file('pic')) {
                $filename = time() . '.' . $image->getClientOriginalExtension();
                //$location = storage_path('app/public/new_images/') . $filename;
                //Storage::disk('local')->put($filename, 'test');
                $image->storeAs('uploads/user-pic', $filename, ['disk' => 'local']);
                //Image::make($image)->save($location);
                $new_filename = "uploads/user-pic/".$filename;
                User::where('id',$id)->update([
                    'profile_picture'=>$new_filename,
                ]);
            }else{
            }
            if ($user) {
                return response()->json(['status' => '0']);
            }
        }
    }

    public function addHackonton(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'result' => ['required', 'string'],
            'from' => ['required'],
            'to' => ['required'],
            'organized_by' => ['required'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray());
        }

        $experience = new Experience;
        
        $experience->name = $request->name;
        $experience->description = $request->description;
        $experience->badge_id = $request->result;
        
        $experience->from = date('Y-m-d', strtotime($request->from));
        $experience->to = date('Y-m-d', strtotime($request->to));
        $experience->organized_by = $request->organized_by;
        $experience->user_id = Auth::user()->id;
       
        if ($image = $request->file('file')) {
            $image_uploaded = true;
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('uploads/hackathon', $filename, ['disk' => 'local']);
            $new_filename = "uploads/hackathon/".$filename;
            $experience->pic = $new_filename;
        }else{
            $image_uploaded = false;
        }
        if ($experience->save()) {

            $badge_id = $experience->badge_id;
            $new_badge = $this->update_badge_info($badge_id);
            return response()->json([
                'status' => '0', 
                'badge_id'=>$new_badge,
                'image_uploaded'=>$image_uploaded
            ]);
        }
    }

    public function updateHackonton(Request $request)
    {

        $id = Auth::user()->id;
        $validation = $this->hackontonValidator($request->all());
        $input = $request->all();
        $experience = Experience::findOrFail($input['id']);
        $experience->name = $input['name'];
        $experience->description = $input['description'];
        $experience->badge_id = $input['result'];
        $experience->from = date('Y-m-d', strtotime($input['from']));
        $experience->to = date('Y-m-d', strtotime($input['to']));
        $experience->pic = $input['pic'];
        $experience->organized_by = $input['organized_by'];
        $experience->user_id = $id;

        if ($validation->fails()) {
            return response()->json($validation->errors()->toArray());
        } else {
            if ($experience->save()) {
                return response()->json(['status' => '0']);
            }
        }
    }

    public function updatePerformance(Request $request)
    {
        $id = Auth::user()->id;
        $validation = $this->performanceValidator($request->all());
        $input = $request->all();
        if ($input['id']!=null){
            $performance = Performance::findOrFail($input['id']);

        }else{
            $performance = new Performance();
        }
        $performance->pitch = $input['pitch'];
        $performance->front_end = $input['front_end'];
        $performance->back_end = $input['back_end'];
        $performance->ux_design = $input['ux_design'];
        $performance->problem_solving = $input['problem_solving'];
        $performance->team_player = $input['team_player'];
        $performance->user_id = $id;
        if ($validation->fails()) {
            return response()->json($validation->errors()->toArray());
        } else {
            if ($performance->save()) {
                return response()->json(['status' => '0']);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $experience = Experience::findOrFail($id);
        $experience->delete();
        Session::flash('success_message', 'Hackonthon successfully deleted!');
        return redirect()->route('user.dashboard');
    }

    public function select_theme($theme)
    {
        if(Auth::check()) {
            $user = auth()->user();
            $user->theme = $theme;
            $user->save();
            return redirect()->route('user.profile',$user->slug);
        } else {
            return Redirect::back()->with('message','Please log in to select the default theme!');
        }
    }

    public function edit_hackathon(Request $request){
        $hackathon_id = $request->id;
        $experience = Experience::where('id',$hackathon_id)->first();
        $badges = Badge::whereIn('id',[1,2,3,12])->get();

        return view('themes.new-theme.user.edit_hackathon',compact('experience','badges'));
    }

    public function update_hackathon(Request $request)
    {
        $id = Auth::user()->id;

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'result' => ['required', 'string'],
            'from' => ['required'],
            'to' => ['required'],
            'organized_by' => ['required'],
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors()->toArray());
        }

        $experience = Experience::findOrFail($request->id);
        
        $experience->name = $request->name;
        $experience->description = $request->description;
        $experience->badge_id = $request->result;
        
        $experience->from = date('Y-m-d', strtotime($request->from));
        $experience->to = date('Y-m-d', strtotime($request->to));
        $experience->organized_by = $request->organized_by;
        $experience->user_id = $id;
       
        if ($image = $request->file('file')) {
            $image_uploaded = true;
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('uploads/hackathon', $filename, ['disk' => 'local']);
            $new_filename = "uploads/hackathon/".$filename;
            $experience->pic = $new_filename;
        }else{
            $image_uploaded = false;
        }

        if ($experience->save()) {
            return response()->json(['status' => '0', 'image_uploaded'=>$image_uploaded]);
        }
    }
    public function update_badge_info($badge_id){
        $where = [
            'user_id' => Auth::user()->id,
            'badge_id' => $badge_id,
        ];
        $objexist = EarnedBadge::where($where);
        if($objexist->count()>0){
            $data = $objexist->first();
            $old_count = $data->count;
            $new_count = $old_count+1;

            $updated = EarnedBadge::where($where)->update([
                'count'=>$new_count
            ]);
            $res = 0;      
        }else{
            EarnedBadge::create([
                'user_id' => Auth::user()->id,
                'badge_id' => $badge_id,
                'count'=>1,
            ]);
            $res = $badge_id;
        }
        return $res;
    }

}
