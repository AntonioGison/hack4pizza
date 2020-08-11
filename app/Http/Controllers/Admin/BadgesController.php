<?php

namespace App\Http\Controllers\Admin;


use App\Badge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Session;
use File;
use Image;

class BadgesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');

    }

    public function index(Request $request)
    {
//dd("working");
        return view('admin.badges.index', ['title' => 'Badges List']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.badges.create', ['title' => 'Add Badge']);
    }

    public function getBadges(Request $request)
    {
//        dd("working");
        $columns = array(
//            0 => 'select',
            0 => 'name',
            7 => 'action'
        );

        $totalData = Badge::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $badges = Badge::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = Badge::count();
        } else {
            $search = $request->input('search.value');
            $badges= Badge::where('name', 'like', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = Badge::where('name', 'like', "%{$search}%")
                ->count();
        }


        $data = array();
//        dd($badges);
        if ($badges) {
            foreach ($badges as $r) {
                $edit_url = route('badges.edit', $r->id);


                $nestedData['select'] = '
                                <td style="text-align: center">
                                    <input type="checkbox" class="ace" title="badge_id[]" value="'.$r->id.'">
                                </td>
                            ';
                $nestedData['name'] = $r->name;
                $nestedData['action'] = '
                                <div class="text-center">
                                
                                <td>
                                    <a title="Edit Badge" class="btn btn-success btn-outline btn-circle btn-lg m-r-5"
                                       href="'.$edit_url.'">
                                        <i class="ti-pencil-alt"></i>
                                    </a>
                                    <a class="btn btn-info btn-outline btn-circle btn-lg m-r-5" onclick="event.preventDefault();view(' . $r->id . ');" title="View Badge" href="#">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a class="btn btn-danger btn-outline btn-circle btn-lg m-r-5" onclick="event.preventDefault();del('.$r->id.');" title="Delete Badge" href="#">
                                        <i class="icon-trash"></i>
                                    </a>
                                </td>
                                </div> 
                            ';
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );

        echo json_encode($json_data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required',
            'color' => 'required',
        ]);

        $badge = new Badge();
        $file = $request->file('pic');
        if ($request->hasFile('pic')) {
            if ($request->file('pic')->isValid()) {
                $this->validate($request, [
                    'pic' => 'required|image|mimes:jpeg,png,jpg'
                ]);
                $destinationPath = base_path()."/uploads/badges/";
                $extension = $file->getClientOriginalExtension('pic');
                $fileName = $file->getClientOriginalName('pic');
                $fileName = time().$fileName;
                //renameing image
                $request->file('pic')->move($destinationPath, $fileName);
                $badge->pic = $fileName;

            }
        }
        $badge->name = $request->input('name');
        $badge->description = $request->input('description');
        $badge->color = $request->input('color');
        $badge->save();

        $newImage = base_path()."/uploads/badges/".$badge->pic;
        $thumb_image = Image::make($newImage);
        $thumb_image->fit(24);
        $newThumb = base_path()."/uploads/badges/thumbs/".$badge->pic;
        $thumb_image->save($newThumb);
        Session::flash('success_message', 'Success! Badge has been saved successfully!');
        return redirect()->back();

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
        $badge = Badge::findOrFail($id);
        return view('admin.badges.edit', ['title' => 'Update Badges Details'])->withBadge($badge);
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

        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required',
            'color' => 'required',
        ]);

        $badge =  Badge::findOrFail($id);
        if ($request->hasFile('pic')) {
            if ($request->file('pic')->isValid()) {
                $this->validate($request, [
                    'pic' => 'required|image|mimes:jpeg,png,jpg'
                ]);
                $file = $request->file('pic');
                $destinationPath = base_path()."/uploads/badges";
                $extension = $file->getClientOriginalExtension('pic');
                $fileName = $file->getClientOriginalName('pic');
                $fileName = time() . $fileName;
                //renameing image
                $request->file('pic')->move($destinationPath, $fileName);
                $delete_old_file=base_path()."/uploads/badges/".$badge->pic;
                File::delete($delete_old_file);
                $badge->pic = $fileName;
            }
        }
        $badge->name = $request->input('name');
        $badge->description = $request->input('description');
        $badge->color = $request->input('color');
        $badge->save();
        $newImage = base_path()."/uploads/badges/".$badge->pic;
        $thumb_image = Image::make($newImage);
        $thumb_image->fit(24);
        $newThumb = base_path()."/uploads/badges/thumbs/".$badge->pic;
        $thumb_image->save($newThumb);
        Session::flash('success_message', 'Success! Badge has been updated successfully!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $badge = Badge::findOrFail($id);
        $badge->delete();
        Session::flash('success_message', 'Badge successfully deleted!');
        return redirect()->route('badges.index');
    }

    public function getBadgeDetail(Request $request){

        $badge = Badge::findOrFail($request->input('id'));
        return view('admin.badges.single', ['title' => 'Badge Details'])->withBadge($badge);

    }
    public function DeleteSelectedBadges(Request $request)
    {
//        dd("working");
        $input = $request->all();
        $this->validate($request, [
            'badge_id' => 'required',

        ]);
        foreach ($input['badge_id'] as $key => $val) {
//            dd("working");
            Badge::findOrFail($val)->delete();


        }
        Session::flash('success_message', 'Badges successfully deleted!');
        return redirect()->back();

    }
}
