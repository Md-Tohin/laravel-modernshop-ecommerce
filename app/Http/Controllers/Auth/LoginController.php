<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

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
    protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo(){
        if (Auth::user()->role_id != 2) {
            return route('admin.dashboard');
        }elseif(Auth::user()->role_id == 2){
            return route('user.dashboard');
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //  redirect to google
    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    //  callback google
    public function handleGoogleCallback(){
        $user = Socialite::driver('google')->user();
        $this->loginOrRegisterUser($user);
        return redirect()->route('user.dashboard');
    }

    //  redirect to facebook
    public function redirectToFacebook(){
        return Socialite::driver('facebook')->redirect();
    }

    //  callback facebook
    public function handleFacebookCallback(){
        $user = Socialite::driver('facebook')->user();
        $this->loginOrRegisterUser($user);
        return redirect()->route('user.dashboard');
    }

    protected function loginOrRegisterUser($data){
        $user = User::where('email', '=', $data->email)->first();
        if (!$user) {
            $user = new User();
            $user->name = $data->name;
            $user->email = $data->email;
            $user->image = $data->avatar;
            $user->provider_id = $data->id;
            $user->save();
        }
        Auth::login($user);
    }


}
