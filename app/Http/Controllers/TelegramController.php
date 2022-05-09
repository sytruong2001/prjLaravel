<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{
    public function updatedActivity()
    {
        $activity = Telegram::getUpdates();
        dd($activity);
    }
    public function veritifyForm(Request $request)
    {
        $email = $request->session()->get('email');

        return view('contactForm', [
            'email' => $email,
        ]);
    }

    public function check_otp(Request $req)
    {
        $otp = $req->get('otp');
        $time = Carbon::now('Asia/Ho_Chi_Minh');
        $email = $req->get('email');
        $get_check_otp = DB::table('otp')
            ->where('email', $email)
            ->where('otp', $otp)
            ->where('created_at', '<=', $time)
            ->where('updated_at', '>=', $time)
            ->orderByDesc('id')
            ->count();
        dd($get_check_otp);
        // if ($get_check_otp == 1) {
        //     $request->authenticate();
        //     $request->session()->regenerate();
        //     if (auth()->user()->hasRole('Admin')) {
        //         return redirect()->intended(RouteServiceProvider::ADMIN);
        //     } else {
        //         return redirect()->intended(RouteServiceProvider::HOME);
        //     }
        // } else {
        //     return redirect()->back();
        // }
    }
}