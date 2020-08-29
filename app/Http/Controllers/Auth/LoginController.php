<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Socialite;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'user/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


//    public function login(Request $request)
//    {
//        // Validate the form data
//        $this->validate($request, [
//            'email'   => 'required|email',
//            'password' => 'required|min:6'
//        ]);
//
//        // Attempt to log the user in
//        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
//            // if successful, then redirect to their intended location
//
//            return redirect()->route('user-dashboard');
//        }
//
//        // if unsuccessful, then redirect back to the login with the form data
//        return redirect()->back()->withInput($request->only('email', 'remember'));
//    }
    public function login(Request $request)
    {
        $input = $request->all();
        $credentials['email'] = $input['email'];
        $credentials['password'] = $input['password'];

        if (Auth::attempt($credentials)) {
            return response()->json(['status' => '0','slug'=>Auth::user()->slug]);
        }
        else{
            return response()->json(['status'=>'1']);
        }

    }
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }
    public function redirectToLinkedinProvider()
    {
        return Socialite::with('LinkedIn')->redirect();
    }
    public function redirectToFacebookProvider()
    {
        return Socialite::with('Facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('github')->user();
        } catch (Exception $e) {
            return Redirect::to('auth/github');
        }

        $authUser = $this->findOrCreateUser($user);

        Auth::login($authUser, true);

        return redirect('user/dashboard');
        // $user->token;
    }
    public function handleProviderLinkedinCallback()
    {
        try {
            $user = Socialite::driver('LinkedIn')->user();
        } catch (Exception $e) {
            return Redirect::to('auth/linkedin');
        }

        $authUser = $this->findOrCreateUserLinkedin($user);

        Auth::login($authUser, true);

        return redirect('user/dashboard');
        // $user->token;
    }
    public function handleProviderFacebookCallback()
    {
        try {
            $user = Socialite::driver('Facebook')->user();
        } catch (Exception $e) {
            return Redirect::to('auth/facebook');
        }

        $authUser = $this->findOrCreateUserFacebook($user);

        Auth::login($authUser, true);

        return redirect('user/dashboard');
        // $user->token;
    }
    private function findOrCreateUser($githubUser)
    {
        if ($authUser = User::where('github_id', $githubUser->id)->first()) {
            return $authUser;
        }        
        $headshot = $githubUser->avatar;
        
        $slug = str_slug($githubUser->name,"-");
        $password = bcrypt("hack4Pizza$".$slug);
        
        if ($authUser = User::where('email', $githubUser->email)->first()) {
            return $authUser;
        } else{
            return User::create([
                'name' => $githubUser->name,
                'slug'=>$slug,
                'email' => $githubUser->email,
                'password'=>$password,
                'profile_picture'=>$headshot,
                'github_id' => $githubUser->id,
            ]);
        }
    }
    private function findOrCreateUserLinkedin($linkedinUser)
    {
        if ($authUser = User::where('linkedin_id', $linkedinUser->id)->first()) {
            return $authUser;
        }

        return User::create([
            'name' => $linkedinUser->name,
            'email' => $linkedinUser->email,
            'linkedin_id' => $linkedinUser->id,
        ]);
    }
    public function createFileObject($url){
  
        $path_parts = pathinfo($url);
  
        $newPath = $path_parts['dirname'] . '/tmp-files/';
        if(!is_dir ($newPath)){
            mkdir($newPath, 0777);
        }
  
        $newUrl = $newPath . $path_parts['basename'];
        copy($url, $newUrl);
        $imgInfo = getimagesize($newUrl);
  
        $file = new UploadedFile(
            $newUrl,
            $path_parts['basename'],
            $imgInfo['mime'],
            filesize($url),
            true,
            TRUE
        );
  
        return $file;
    }
    private function findOrCreateUserFacebook($facebookUser)
    {
        if ($authUser = User::where('facebook_id', $facebookUser->id)->first()) {
            return $authUser;
        }  
        $headshot = $facebookUser->avatar_original;
        
        $slug = str_slug($facebookUser->name,"-");
        $password = bcrypt("hack4Pizza$".$slug);
        
        return User::create([
            'name' => $facebookUser->name,
            'slug'=>$slug,
            'email' => $facebookUser->email,
            'password'=>$password,
            'profile_picture'=>$headshot,
            'facebook_id' => $facebookUser->id,
        ]);
    }
}
