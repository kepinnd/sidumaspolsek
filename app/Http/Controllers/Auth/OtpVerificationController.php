<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOtpMail;
use Illuminate\Support\Facades\Log;

class OtpVerificationController extends Controller
{
    public function notice(Request $request) {
        return view('auth.verify-otp', ['email' => $request->email]);
    }

    public function verify(Request $request) {
        $request->validate(['email' => 'required|email', 'otp' => 'required|numeric|digits:6']);
        $user = User::where('email', $request->email)->first();

        if (!$user || $user->otp_code !== $request->otp || now()->gt($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'Kode OTP salah atau telah kedaluwarsa.']);
        }

        $user->update(['is_verified' => true, 'email_verified_at' => now(), 'otp_code' => null, 'otp_expires_at' => null]);
        Auth::login($user);
        return redirect()->route('dashboard')->with('success', 'Verifikasi berhasil. Selamat datang!');
    }

    public function resend(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User dengan email tersebut tidak ditemukan.']);
        }
        
        if ($user->is_verified) {
             return redirect()->route('login')->withErrors(['email' => 'Akun ini sudah terverifikasi. Silakan login.']);
        }

        try {
            $otp = rand(100000, 999999);
            $user->update(['otp_code' => $otp, 'otp_expires_at' => now()->addMinutes(10)]);
            Mail::to($user->email)->send(new SendOtpMail($otp));
            return back()->with('success', 'Kode OTP baru telah berhasil dikirim ke email Anda.');
        } catch (\Exception $e) {
            Log::error('Gagal mengirim email OTP: ' . $e->getMessage());
            return back()->withErrors(['email' => 'Gagal mengirim email OTP. Silakan periksa konfigurasi atau log untuk detail.']);
        }
    }
}