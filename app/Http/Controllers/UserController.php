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
    public function search_user(){
        return view('themes.new-theme.user.search_user');
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
            'email' => 'required|unique:users,email,'.$data['id'],
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
            'from' => 'required|date|',
            'to' => 'required|date|after_or_equal:from',
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
        $user = User::findOrFail($id);
        $validation = $this->validator($request->all());
        $input = $request->all();
        if (empty($input['password'])) {
            $input['password'] = $user->password;
        } else {
            $input['password'] = bcrypt($input['password']);
        }
        if ($validation->fails()) {
            return response()->json($validation->errors()->toArray());
        } else {
            $slug =  $this->createSlug($request->name);
            $input['slug'] = $slug;
            if ($user->fill($input)->save()) {
                return response()->json(['status' => '0']);
            }
        }
    }

    public function addHackonton(Request $request)
    {
        $id = Auth::user()->id;
        $validation = $this->hackontonValidator($request->all());
        $input = $request->all();
        $experience = new Experience();
        $experience->name = $input['name'];
        $experience->description = $input['description'];
        $experience->badge_id = $input['result'];
        $experience->from = date('Y-m-d', strtotime($input['from']));
        $experience->to = date('Y-m-d', strtotime($input['to']));
        $experience->pic = 'uploads/hackathon/'.$input['pic'];
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
}
