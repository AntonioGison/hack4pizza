<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Setting;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;
use File;
class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $obj_setting;
    public function __construct(Setting $settingObject)
    {
        $this->middleware('auth');
        $this->obj_setting=$settingObject;
    }
    public function index()
    {
        $settings = $this->obj_setting->pluck('value','name')->all();
        $all_columns =array(
            array(
                'name'=>'site_title',
                'id'=>'site_title',
                'type'=>'textfield',
                'label'=>'Site Title',
                'place_holder'=>'Enter Site Title',
                'class'=>'form-control',
                'style'=>'width:30px;max-width:100%;margin-top:12px'
            ),

            array(
                'name'=>'meta_keywords',
                'id'=>'meta_keywords',
                'type'=>'textarea',
                'label'=>'Meta Keywords',
                'place_holder'=>'Enter Site Meta Keywords separated by common limit 9 words',
                'class'=>'form-control',
                'style'=>'width:30px;max-width:100%;margin-top:12px',
                'rows'=>'4',
            ),
            array(
                'name'=>'meta_desc',
                'id'=>'meta_desc',
                'type'=>'textarea',
                'label'=>'Meta Description',
                'place_holder'=>'Enter Site Meta Description limit 39 charaters',
                'class'=>'form-control',
                'style'=>'width:30px;max-width:100%;margin-top:12px',
                'rows'=>'4',
            ),

            array(
                'name' => 'favicon',
                'id' => 'favicon',
                'type' => 'file',
                'label' => 'Favicon (Png)',
                'class' => 'form-control',
                'style' => 'width:60px;max-width:100%;margin-top:12px'
            ),
            array(
                'name'=>'logo',
                'id'=>'logo',
                'type'=>'file',
                'label'=>'Logo',
                'class'=>'form-control',
                'style'=>'width:120px;max-width:100%;margin-top:12px'
            ),

            array(
                'name'=>'link1_text',
                'id'=>'link1_text',
                'type'=>'textfield',
                'label'=>'Link1 text',
                'place_holder'=>'Enter your link1 text',
                'class'=>'form-control',
                'style'=>'width:30px;max-width:100%;margin-top:12px'
            ),
            array(
                'name'=>'link1_url',
                'id'=>'link1_url',
                'type'=>'textfield',
                'label'=>'Link2 url',
                'place_holder'=>'Enter your link1 url',
                'class'=>'form-control',
                'style'=>'width:30px;max-width:100%;margin-top:12px'
            ),

            array(
                'name'=>'link2_text',
                'id'=>'link2_text',
                'type'=>'textfield',
                'label'=>'Link2 text',
                'place_holder'=>'Enter your link2 text',
                'class'=>'form-control',
                'style'=>'width:30px;max-width:100%;margin-top:12px'
            ),
            array(
                'name'=>'link2_url',
                'id'=>'link2_url',
                'type'=>'textfield',
                'label'=>'Link2 url',
                'place_holder'=>'Enter your link2 url',
                'class'=>'form-control',
                'style'=>'width:30px;max-width:100%;margin-top:12px'
            ),
            array(
                'name'=>'link3_text',
                'id'=>'link3_text',
                'type'=>'textfield',
                'label'=>'Link3 text',
                'place_holder'=>'Enter your link3 text',
                'class'=>'form-control',
                'style'=>'width:30px;max-width:100%;margin-top:12px'
            ),
            array(
                'name'=>'link3_url',
                'id'=>'link3_url',
                'type'=>'textfield',
                'label'=>'Link3 url',
                'place_holder'=>'Enter your link3 url',
                'class'=>'form-control',
                'style'=>'width:30px;max-width:100%;margin-top:12px'
            ),
            array(
                'name'=>'link4_text',
                'id'=>'link4_text',
                'type'=>'textfield',
                'label'=>'Link4 text',
                'place_holder'=>'Enter your link4 text',
                'class'=>'form-control',
                'style'=>'width:30px;max-width:100%;margin-top:12px'
            ),
            array(
                'name'=>'link4_url',
                'id'=>'link4_url',
                'type'=>'textfield',
                'label'=>'Link4 url',
                'place_holder'=>'Enter your link4 url',
                'class'=>'form-control',
                'style'=>'width:30px;max-width:100%;margin-top:12px'
            ),


            array(
                'name'=>'footer_text',
                'id'=>'footer_text',
                'type'=>'textfield',
                'label'=>'Footer text',
                'place_holder'=>'Enter your Footer text',
                'class'=>'form-control',
                'style'=>'width:30px;max-width:100%;margin-top:12px',
                'rows'=>'4',
            ),
//            array(
//                'name'=>'theme_color',
//                'id'=>'theme_color',
//                'type'=>'textfield',
//                'label'=>'Theme Color',
//                'place_holder'=>'',
//                'class'=>'colorpicker form-control',
//                'style'=>'width:30px;max-width:100%;margin-top:12px'
//            ),



        );

        return view('admin.settings.index', ['title' => 'Site Setting','settings'=>$settings,'all_columns'=>$all_columns]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create', ['title' => 'Registere User']);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $settings = $this->obj_setting->pluck('value', 'name')->all();
        $logo = "";
        $favicon = "";
        $banner = "";
        $logo_es = "";
        if ($request->hasFile('logo')) {
            if ($request->file('logo')->isValid()) {
                $this->validate($request, [
                    'logo' => 'required|image|mimes:jpeg,png,jpg'
                ]);
                $file = $request->file('logo');
                $destinationPath = "uploads/";
                //$extension = $file->getClientOriginalExtension('logo');
                $logo = $file->getClientOriginalName('logo');
                $logo = time() . $logo;
                //renameing image
                $request->file('logo')->move($destinationPath, $logo);
                if (isset($settings['logo'])) {
                    if (file_exists('uploads/' . $settings['logo'])) {
                        $delete_old_file = "uploads/" . $settings['logo'];
                        File::delete($delete_old_file);
                    }
                }

            }
        }
        if ($request->hasFile('favicon')) {
            if ($request->file('favicon')->isValid()) {
                $this->validate($request, [
                    'favicon' => 'required|image|mimes:jpeg,png,jpg'
                ]);
                $file = $request->file('favicon');
                $destinationPath = "uploads/";
                $favicon = $file->getClientOriginalName('favicon');
                $favicon = time() . $favicon;
                //renameing image
                $request->file('favicon')->move($destinationPath, $favicon);
                if (isset($settings['favicon'])) {
                    if (file_exists('uploads/' . $settings['favicon'])) {
                        $delete_old_file = "uploads/" . $settings['favicon'];
                        File::delete($delete_old_file);
                    }
                }
            }
        }


        //DB::table('settings')->truncate();
        unset($input['_token']);
        if (isset($logo) && !empty($logo)) {
            $input['logo'] = $logo;
        } else {
            $input['logo'] = isset($settings['logo']) ? $settings['logo'] : '';
        }
        if (isset($favicon) && !empty($favicon)) {
            $input['favicon'] = $favicon;
        } else {
            $input['favicon'] = isset($settings['favicon']) ? $settings['favicon'] : '';
        }


//       DB::table('settings')->delete();
        DB::table('settings')->truncate();
        $res = array_key_exists('stripe_enable', $input);
        if ($res == false) {
            $input['stripe_enable'] = "0";
        } else {
            $input['stripe_enable'] = "1";

        }
        $res = array_key_exists('paypal_enable', $input);
        if ($res == false) {
            $input['paypal_enable'] = "0";
        } else {
            $input['paypal_enable'] = "1";

        }
        foreach ($input as $key => $value) {
            $setting = new Setting();
            $setting->name = $key;
            $setting->value = $value;
            $setting->save();

        }

        Session::flash('flash_message', 'Settings has been saved successfully!');
        return redirect()->back();
    }
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->obj_user->findOrFail($id);
        return view('admin.users.profile-setting', ['title' => 'Edit Profile'])->withUser($user);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user =  $this->obj_user->findOrFail($id);
        return view('admin.users.edit', ['title' => 'Update User Details'])->withUser($user);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = $this->obj_user->findOrFail($id);
        $this->validate($request, [
            'name'     => 'required|max:255',
            'email'    => 'required',
        ]);
        $input = $request->all();
        if (empty($input['password'])) {
            $input['password'] = $user->password;
        } else {
            $input['password'] = bcrypt($input['password']);
        }
        $input['created_by'] = Auth::user()->id;
        $res = array_key_exists('status', $input);
        if ($res == false) {
            $input['status'] = "0";
        } else {
            $input['status'] = "1";

        }
        $user->fill($input)->save();
        Session::flash('flash_message', 'Great! User successfully updated!');
        return redirect()->back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if ($id == Auth::user()->id) {
            Session::flash('error_message', 'You can not delete logged-in user!');
            return redirect()->route('users.index');
        }
        $user =  $this->obj_user->findOrFail($id);
        $user->delete();
        Session::flash('flash_message', 'User successfully deleted!');
        return redirect()->route('users.index');
    }
    public function DeleteUsers(Request $request){
        $input = $request->all();
        $this->validate($request, [
            'user_id' => 'required',

        ]);
        foreach($input['user_id'] as $key=>$val){
            if($val == Auth::user()->id){
                continue;
            }else {
                $this->obj_user->where('id',$val)->delete();

            }

        }
        Session::flash('flash_message', 'Users successfully deleted!');
        return redirect()->back();

    }

}
