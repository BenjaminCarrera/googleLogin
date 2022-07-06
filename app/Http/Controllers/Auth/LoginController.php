<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;

use Socialite;
use Redirect;
use App\User;
use App\Login;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Logout trait
     *
     * @author Yugo <dedy.yugo.purwanto@gmail.com>
     * @param  Request $request
     * @return void         
     */
    protected function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/login');
    }

    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return Redirect::to('/login')->withErrors(['There was an error connecting to google please contact the administrator', 'msg']);
        }

        // check if they're an existing user
        $existingUser = User::where('google_id', $user->id)->first();
        $admin = false;
        $loginCount = 0;
        if($existingUser){
            
            // log them in
            auth()->login($existingUser, true);
            $admin = $existingUser->hasRole('admin');
            $userId = $existingUser->getId();
            Login::create([
                'user_id'   => $userId,
            ]);
            $loginCount = Login::where('user_id', $userId)->count();
        } else {

            $domain = explode("@", $user->user['email'])[1];

            // create a new user
            $newUser = User::create([
                'family_name'   => $user->user['family_name'],
                'name'          => $user->user['name'],
                'picture'       => $user->user['picture'],
                'locale'        => $user->user['locale'],
                'email'         => $user->user['email'],
                'given_name'    => $user->user['given_name'],
                'google_id'     => $user->user['id'],
                'hd'            => $domain,
                'verified_email'=> $user->user['verified_email'],
            ]);

            // assign the role
            if(strpos($domain, 'cloudasta.com') !== false || $user->user['email'] == 'ben.edu.carrera@gmail.com' || strpos($user->user['name'], 'QA')){
                $newUser->assignRole('admin');
                $admin = true;
            }else{
                $newUser->assignRole('user');
            }

            $userId = $newUser->getId();
            Login::create([
                'user_id'   => $userId,
            ]);
            $loginCount = Login::where('user_id', $userId)->count();

            auth()->login($newUser, true);
        }
        return redirect()->to('/home')->with([ 'loginCount' => $loginCount ]);;
    }

}
