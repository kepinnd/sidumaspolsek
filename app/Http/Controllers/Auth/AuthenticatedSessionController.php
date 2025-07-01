<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $user = $request->user();

        // Cek jika pengguna belum terverifikasi
        if (!$user->is_verified) {
            Auth::logout(); // Logout pengguna sementara

            // Arahkan ke halaman OTP dengan pesan error
            return redirect()->route('otp.verification.notice', ['email' => $user->email])
                             ->withErrors(['email' => 'Akun Anda belum diverifikasi. Silakan klik "Kirim ulang OTP".']);
        }

        // Jika sudah terverifikasi, lanjutkan proses login normal
        $request->session()->regenerate();
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}