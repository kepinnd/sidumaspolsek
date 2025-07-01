<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOtpMail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'max:16', 'unique:'.User::class],
            'alamat' => ['required', 'string'],
            'no_telp' => ['required', 'string', 'max:15'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $otp = rand(100000, 999999);
        $otpExpires = now()->addMinutes(10);

        $user = User::create([
            'name' => $request->name,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'masyarakat',
            'otp_code' => $otp,
            'otp_expires_at' => $otpExpires,
            'is_verified' => false,
        ]);

        Mail::to($user->email)->send(new SendOtpMail($otp));

        return redirect()->route('otp.verification.notice', ['email' => $user->email])
                         ->with('success', 'Registrasi berhasil! Kode OTP telah dikirim ke email Anda.');
    }
}