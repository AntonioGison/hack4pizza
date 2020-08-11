<?php

namespace App\Http\Controllers\Admin;

use App\Badge;
use App\MasterBadge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Session;
use File;
use Image;

class MasterBadgesController extends Controller
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
        return view('admin.master-badges.index', ['title' => 'Badges List']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bages = Badge::orderBy('name', 'asc')->pluck('name','id')->toArray();
        return view('admin.master-badges.create', ['title' => 'Add master Badge','bages' => $bages]);
    }

    public function getMasterBadges(Request $request)
    {
        $columns = array(
//            0 => 'select',
            0 => 'name',
            7 => 'action'
        );

        $totalData = MasterBadge::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $badges = MasterBadge::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = MasterBadge::count();
        } else {
            $search = $request->input('search.value');
            $badges= MasterBadge::where('name', 'like', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = MasterBadge::where('name', 'like', "%{$search}%")
                ->count();
        }


        $data = array();
//        dd($badges);
        if ($badges) {
            foreach ($badges as $r) {
                $edit_url = route('master-badges.edit', $r->id);


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
            'number' => 'required',
            'badge' => 'required',
        ]);

        $badge = new MasterBadge();
        $file = $request->file('pic');
        if ($request->hasFile('pic')) {
            if ($request->file('pic')->isValid()) {
                $this->validate($request, [
                    'pic' => 'required|image|mimes:jpeg,png,jpg'
                ]);
                $destinationPath = base_path()."/uploads/master-badges/";
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
        $badge->number = $request->input('number');
        $badge->badge_id = $request->input('badge');
        $badge->save();

//        $newImage = base_path()."/uploads/master-badges/".$badge->pic;
//        $thumb_image = Image::make($newImage);
//        $thumb_image->fit(24);
//        $newThumb = base_path()."/uploads/master-badges/thumbs/".$badge->pic;
//        $thumb_image->save($newThumb);
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
        $bages = Badge::orderBy('name', 'asc')->pluck('name','id')->toArray();
        $badge = MasterBadge::findOrFail($id);
        return view('admin.master-badges.edit', ['title' => 'Update Master Badges Details','bages' => $bages])->withBadge($badge);
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
            'number' => 'required',
            'badge' => 'required',
        ]);

        $badge =  MasterBadge::findOrFail($id);
        if ($request->hasFile('pic')) {
            if ($request->file('pic')->isValid()) {
                $this->validate($request, [
                    'pic' => 'required|image|mimes:jpeg,png,jpg'
                ]);
                $file = $request->file('pic');
                $destinationPath = base_path()."/uploads/master-badges";
                $extension = $file->getClientOriginalExtension('pic');
                $fileName = $file->getClientOriginalName('pic');
                $fileName = time() . $fileName;
                //renameing image
                $request->file('pic')->move($destinationPath, $fileName);
                $delete_old_file=base_path()."/uploads/master-badges/".$badge->pic;
                File::delete($delete_old_file);
                $badge->pic = $fileName;
            }
        }
        $badge->name = $request->input('name');
        $badge->description = $request->input('description');
        $badge->number = $request->input('number');
        $badge->badge_id = $request->input('badge');
        $badge->save();
//        $newImage = base_path()."/uploads/master-badges/".$badge->pic;
//        $thumb_image = Image::make($newImage);
//        $thumb_image->fit(24);
//        $newThumb = base_path()."/uploads/master-badges/thumbs/".$badge->pic;
//        $thumb_image->save($newThumb);
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
        $badge = MasterBadge::findOrFail($id);
        $badge->delete();
        Session::flash('success_message', 'Badge successfully deleted!');
        return redirect()->route('master-badges.index');
    }

    public function getMasterBadgeDetail(Request $request){

        $badge = MasterBadge::findOrFail($request->input('id'));
        return view('admin.master-badges.single', ['title' => 'Badge Details'])->withBadge($badge);

    }
    public function DeleteSelectedMasterBadges(Request $request)
    {
//        dd("working");
        $input = $request->all();
        $this->validate($request, [
            'badge_id' => 'required',

        ]);
        foreach ($input['badge_id'] as $key => $val) {
//            dd("working");
            MasterBadge::findOrFail($val)->delete();


        }
        Session::flash('success_message', 'Badges successfully deleted!');
        return redirect()->back();

    }
}
