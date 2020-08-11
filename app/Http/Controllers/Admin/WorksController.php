<?php

namespace App\Http\Controllers\Admin;

use App\Work;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Session;
use File;
use Image;

class WorksController extends Controller
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
        return view('admin.works.index', ['title' => 'Works List']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.works.create', ['title' => 'Add Work']);
    }

    public function getWorks(Request $request)
    {
//        dd("working");
        $columns = array(
//            0 => 'select',
            0 => 'title',
            7 => 'action'
        );

        $totalData = Work::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $works = Work::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = Work::count();
        } else {
            $search = $request->input('search.value');
            $works= Work::where('title', 'like', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            $totalFiltered = Work::where('title', 'like', "%{$search}%")
                ->count();
        }


        $data = array();
//        dd($works);
        if ($works) {
            foreach ($works as $r) {
                $edit_url = route('works.edit', $r->id);


                $nestedData['select'] = '
                                <td style="text-align: center">
                                    <input type="checkbox" class="ace" title="work_id[]" value="'.$r->id.'">
                                </td>
                            ';
                $nestedData['title'] = $r->title;
                $nestedData['action'] = '
                                <div class="text-center">
                                
                                <td>
                                    <a title="Edit Work" class="btn btn-success btn-outline btn-circle btn-lg m-r-5"
                                       href="'.$edit_url.'">
                                        <i class="ti-pencil-alt"></i>
                                    </a>
                                    <a class="btn btn-info btn-outline btn-circle btn-lg m-r-5" onclick="event.preventDefault();view(' . $r->id . ');" title="View Work" href="#">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a class="btn btn-danger btn-outline btn-circle btn-lg m-r-5" onclick="event.preventDefault();del('.$r->id.');" title="Delete Work" href="#">
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
            'title' => 'required|max:255',
            'description' => 'required',
            'pic' => 'required',
        ]);

        $work = new Work();
        $file = $request->file('pic');
        if ($request->hasFile('pic')) {
            if ($request->file('pic')->isValid()) {
                $this->validate($request, [
                    'pic' => 'required|image|mimes:jpeg,png,jpg,gif'
                ]);
                $destinationPath = "uploads/works/";
                $extension = $file->getClientOriginalExtension('pic');
                $fileName = $file->getClientOriginalName('pic');
                $fileName = time().$fileName;
                //renameing image
                $request->file('pic')->move($destinationPath, $fileName);
                $work->pic = $fileName;

            }
        }
        $work->title = $request->input('title');
        $work->description = $request->input('description');
        $work->save();

        Session::flash('success_message', 'Success! Work has been saved successfully!');
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
        $work = Work::findOrFail($id);
        return view('admin.works.edit', ['title' => 'Update Works Details'])->withWork($work);
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
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        $work =  Work::findOrFail($id);
        if ($request->hasFile('pic')) {
            if ($request->file('pic')->isValid()) {
                $this->validate($request, [
                    'pic' => 'required|image|mimes:jpeg,png,jpg,gif'
                ]);
                $file = $request->file('pic');
                $destinationPath = "uploads/works";
                $extension = $file->getClientOriginalExtension('pic');
                $fileName = $file->getClientOriginalName('pic');
                $fileName = time() . $fileName;
                //renameing image
                $request->file('pic')->move($destinationPath, $fileName);
                $delete_old_file="uploads/works/".$work->pic;
                File::delete($delete_old_file);
                $work->pic = $fileName;
            }
        }
        $work->title = $request->input('title');
        $work->description = $request->input('description');
        $work->save();

        Session::flash('success_message', 'Success! Work has been updated successfully!');
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
        $work = Work::findOrFail($id);
        $work->delete();
        Session::flash('success_message', 'Work successfully deleted!');
        return redirect()->route('works.index');
    }

    public function getWorkDetail(Request $request){

        $work = Work::findOrFail($request->input('id'));
        return view('admin.works.single', ['title' => 'Work Details'])->withWork($work);

    }
    public function DeleteSelectedWorks(Request $request)
    {
//        dd("working");
        $input = $request->all();
        $this->validate($request, [
            'work_id' => 'required',

        ]);
        foreach ($input['work_id'] as $key => $val) {
//            dd("working");
            Work::findOrFail($val)->delete();


        }
        Session::flash('success_message', 'Works successfully deleted!');
        return redirect()->back();

    }
}
