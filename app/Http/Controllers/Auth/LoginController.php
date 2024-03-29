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
    private function findOrCreateUser($githubUser)
    {
        if ($authUser = User::where('github_id', $githubUser->id)->first()) {
            return $authUser;
        }

        return User::create([
            'name' => $githubUser->name,
            'email' => $githubUser->email,
            'github_id' => $githubUser->id,
        ]);
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
}
