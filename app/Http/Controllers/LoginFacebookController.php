<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Social; //sử dụng model Social
// use Socialite; //sử dụng Socialite
use App\Models\User; //sử dụng model Login
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite as FacadesSocialite;

class LoginFacebookController extends Controller
{
    public function login_facebook()
    {
        return FacadesSocialite::driver('facebook')->redirect();
    }

    public function callback_facebook()
    {
        $provider = FacadesSocialite::driver('facebook')->user();
        $account = Social::where('provider', 'facebook')->where('provider_user_id', $provider->getId())->first();
        if ($account) {
            //login in vao trang quan tri
            $account_name = User::where('id', $account->user)->first();
            Auth::login($account_name);
            if (auth()->user()->hasRole('admin')) {
                return redirect()->intended(RouteServiceProvider::OTP);
            } else {
                return redirect()->intended(RouteServiceProvider::OTP);
            }
        } else {

            $fb = Social::create([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);
            $orang = User::create([

                'name' => $provider->getName(),
                'email' => $provider->getEmail(),
                'password' => '',

            ]);
            $orang->assignRole('User');
            Auth::login($orang);
            if (auth()->user()->hasRole('admin')) {
                return redirect()->intended(RouteServiceProvider::OTP);
            } else {
                return redirect()->intended(RouteServiceProvider::OTP);
            }
        }
    }
}