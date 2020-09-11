<?php

namespace App\Http\Controllers\Theme;

use App\Discount;
use App\Experience;
use App\Setting;

use App\User;
use App\Badge;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Session;
use Mail;
use Validator;
use Image;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $settings;
    public function __construct()
    {
        $this->settings = Setting::pluck('value','name')->toArray();
    }

    public function index()
    {
        $settings = Setting::pluck('value','name')->toArray();
        return view('themes.main-theme.home.index',['title' => 'home','settings'=>$settings]);
    }
    public function getProfile($slug)
    {
        $badges = Badge::all();
        $user = User::where('slug','=',$slug)->first();
        $title = "Profile-".$slug;
        if (Auth::user()){
            if (Auth::user()->slug == $slug){
                return view('themes.new-theme.user.single_user_profile',['title'=>$title,'user'=>$user,'badges'=>$badges,'ownprofile'=>true]);
            }else{
                return view('themes.new-theme.user.single_user_profile',['title'=>$title,'user'=>$user,'badges'=>$badges,'ownprofile'=>false]);
            }
        }else{
            return view('themes.new-theme.user.single_user_profile',['title'=>$title,'user'=>$user,'badges'=>$badges,'ownprofile'=>false]);
        }
    }
    function picUpload(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        if($validation->passes())
        {
            $image = $request->file('file');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(base_path('uploads/user-pic'), $new_name);

            $newImage = base_path()."/uploads/user-pic/".$new_name;
            $thumb_image = Image::make($newImage);
            $thumb_image->fit(200);
            $newThumb = base_path()."/uploads/user-pic/".$new_name;
            $thumb_image->save($newThumb);
            return response()->json([
                'pic'       => $new_name,
                'message'   => 'Image Upload Successfully',
                'uploaded_image' => '<img src="/uploads/user-pic/'.$new_name.'" class="img-thumbnail" width="100%" />',
                'class_name'  => 'alert-success'
            ]);
        }
        else
        {
            return response()->json([
                'pic' => '',
                'message'   => $validation->errors()->all(),
                'uploaded_image' => '',
                'class_name'  => 'alert-danger'
            ]);
        }
    }

    function picUploadHackon(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        if($validation->passes())
        {
            $image = $request->file('file');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(base_path('public/uploads/hackathon/'), $new_name);

            $newImage = base_path()."/public/uploads/hackathon/".$new_name;
            $thumb_image = Image::make($newImage);
            $thumb_image->fit(200);
            $newThumb = base_path()."/public/uploads/hackathon/".$new_name;
            $thumb_image->save($newThumb);
            return response()->json([
                'pic'       => $new_name,
                'message'   => 'Image Upload Successfully',
                'uploaded_image' => '<img src="/uploads/hackathon/'.$new_name.'" class="img-thumbnail" width="100%" />',
                'class_name'  => 'alert-success'
            ]);

        }
        else
        {
            return response()->json([
                'pic' => '',
                'message'   => $validation->errors()->all(),
                'uploaded_image' => '',
                'class_name'  => 'alert-danger'
            ]);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ContactUsForm(){
        $settings = Setting::pluck('value','name')->toArray();

        $main_menu = MenuItem::where('menu_id',1)->get();
        $footer_menu = MenuItem::where('menu_id',2)->get();

        $theme = ActiveTheme::findOrFail(1);
        $name = $theme->name;
        return view('themes.'.$name.'.home.contact-us',['settings'=>$settings,'title'=>'Contact Us','main_menu'=>$main_menu,'footer_menu'=>$footer_menu,]);
    }



    public function create()
    {
        //
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

    public function processContact(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
            'g-recaptcha-response' => 'required',
            'g-recaptcha-response.required' => 'Check the ReCaptcha',
        ]);

//dd("working");

        $settings = Setting::pluck('value','name')->toArray();
        if(isset($settings['enquiry_email'])) {
            $enquiry_email = $settings['enquiry_email'];
        }else {
            $enquiry_email = "support@ideal.org.pk";
        }
        if(isset($settings['secret_key'])) {
            $secret_key = $settings['secret_key'];
        }else {
            $secret_key = "6LdoXpIUAAAAAIxbg_1LcghcCLK4QyQJrg3CtVW0";
        }

        $input = $request->all();
        $input = array_map('strip_tags', $input);
        $captcha = $input['g-recaptcha-response'];
        $response=json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret_key&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);

        $data = array(
            'name' => $input['name'],
            'email' => $input['email'],
            'check_email' => isset($input['emailupdates']) ?"Yes":"No" ,
            'subject' => $input['subject'],
            'msg' => $input['message'],
            'admin_email' => $enquiry_email,
        );
        Mail::send('theme.email.contact', $data, function ($message) use ($data) {
            $message->to($data['admin_email'],'')
                ->subject('Contact');
        });
        Session::flash('success_message', 'Success! We received contact us enquiry successfully!');
        return redirect()->back();

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
        return redirect()->route('Badges.index');
    }



}
