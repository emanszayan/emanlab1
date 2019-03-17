<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;


use App\User;

use Illuminate\Support\Facades\Auth;
// use Laravel\Socialite\Facades\Socialite;
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
    public function redirectToProvider()
    {
        // dd($user);
        return Socialite::driver('github')->redirect();
    }
    public function handleProviderCallback()
    {
        $githubuser = Socialite::driver('github')->user();
        // dd("dsssssssss");
        $user = User::where('provider_id', $githubUser->getId())->first();
        // dd($user);

        if (!$user) {

            // add user to database
            $user = User::create([
                'email' => $githubUser->getEmail(),
                'name' => $githubUser->getName(),
                'provider_id' => $githubUser->getId(),
            ]);
        }
        // login the user
        Auth::login($user, true);
        return redirect($this->redirectTo);
        // return redirect()->route('posts.index');

    
      
    }
}
