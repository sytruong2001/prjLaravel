<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Broadcasting\HasBroadcastChannel;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Telegram\Bot\Laravel\Facades\Telegram;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');
        $checkInfo = DB::table('users')->where('email', $email)->select('password')->first();
        if ($checkInfo != "") {
            if (Hash::check($password, $checkInfo->password)) {
                $start = Carbon::now('Asia/Ho_Chi_Minh');
                $end = Carbon::now('Asia/Ho_Chi_Minh')->addMinute(3);
                // generate a pin based on 2 * 3 digits + a random character
                $ma_otp = mt_rand(100, 999)
                    . mt_rand(100, 999);

                // shuffle the result
                $string = str_shuffle($ma_otp);
                Telegram::sendMessage([
                    'chat_id' => env('TELEGRAM_CHANNEL_ID', ''),
                    'parse_mode' => 'HTML',
                    'text' => "Mã OTP của bạn: " . $string . ". Mã OTP có thời gian sử dụng là 3 phút."
                ]);
                $create = DB::table('otp')->insert([
                    'email' => $email,
                    'otp' => $string,
                    'chat_id' => env('TELEGRAM_CHANNEL_ID', ''),
                    'created_at' => $start,
                    'updated_at' => $end,
                ]);
                return redirect('/check-otp')->with(['email' => $email]);
            } else {
                throw ValidationException::withMessages([
                    'password' => trans('Sai mật khẩu'),
                ]);
            }
        } else {
            throw ValidationException::withMessages([
                'email' => trans('Sai địa chỉ email'),
            ]);
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}