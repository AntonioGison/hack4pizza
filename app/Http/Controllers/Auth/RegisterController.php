<?php

namespace App\Http\Controllers\Auth;

use App\Setting;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Mail;
use Auth;
use App\EarnedBadge;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'user/dashboard';

    protected function redirectTo()
    {
        if (!empty($this->profile_slug)) {
            if($this->isBadgeAssigned > 0) {
                return redirect()->route('user.profile',$this->profile_slug)->with('badgeId','22')->with('badgeName','Early Adopter');
            } else {
                return redirect()->route('user.profile',$this->profile_slug);
            }
        }
        return '/user/dashboard';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected $profile_slug;
    protected $isBadgeAssigned;

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required',
            'password' => 'required|string|min:6',
            'terms' => 'required',
        ]);
    }

    protected function create(array $data)
    {       
        $this->profile_slug =  $this->createSlug($data['first_name']." ".$data['last_name']);
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'name'=>$data['first_name']." ".$data['last_name'],
            'email' => $data['email'],
            'phone_number'=>$data['phone_number'],
            'password' => bcrypt($data['password']),
            'slug' => $this->profile_slug,
            'address'=> $data['address'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
//    protected function create(array $data)
//    {
//        dd("working");
//        $user = User::create([
//            'name' => $data['name'],
//            'email' => $data['email'],
//            'password' => Hash::make($data['password']),
//        ]);
//        $settings = Setting::pluck('value', 'name')->all();
//        if ($user){
//            $data = array(
//                'name' => $user->name,
//                'user_email' => $user->email,
//                'subject' => "Registration",
//                'msg' => "Your Account is Created Successfully",
//                'email' => 'info@webexert.com',
//                'logo' => $settings['logo'],
//            );
//            Mail::send('themes.emails.registered', $data, function ($message) use ($data) {
//                $message->to($data['email'],'')
//                    ->from('info@webexert.com','webexert.com')
//                    ->subject('registered');
//            });
//            return $user;
//        }
//    }


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
    public function register(Request $request)
    {
        $validation = $this->validator($request->all());
        if ($validation->fails()) {
            return response()->json($validation->errors()->toArray());
        } else {
            $input = $request->all();
            $slug =  $this->createSlug($request->name);
            $this->profile_slug =  $this->createSlug($request->first_name." ".$request->last_name);

            $input['slug'] = $this->profile_slug;
            $user = $this->create($input);
            Auth::login($user);
            if (Auth::user()) {
                $this->isBadgeAssigned = $this->assignBadge();
                return response()->json(['status' => '0','slug' => $this->profile_slug]);
            }
        }
    }

    public function assignBadge()
    {
        if(date('Y') < 2022) {
            $badge = new EarnedBadge;
            $badge->user_id = auth()->user()->id;
            $badge->badge_id = '22';
            $badge->count = '1';
            $badge->save();
            return $badge->badge_id;
        }
        return 0;
    }
}
