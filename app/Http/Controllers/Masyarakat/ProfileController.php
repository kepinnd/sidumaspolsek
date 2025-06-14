<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Wajib untuk mengambil data user yang login
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil pengguna masyarakat.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        // Ambil data lengkap dari pengguna yang sedang terautentikasi
        $user = Auth::user();

        // Kirim data pengguna ke view 'masyarakat.profile.show'
        return view('masyarakat.profile.show', compact('user'));
    }
    public function editPassword()
    {
        return view('masyarakat.profile.edit-password');
    }
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $request->validate([
            'current_password' => ['required', 'string', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    $fail('Password Anda saat ini tidak cocok.');
                }
            }],
            'password' => ['required', 'string', Password::defaults(), 'confirmed'],
        ]);

        // Update password di database
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // Arahkan kembali ke halaman profil dengan pesan sukses
        return redirect()->route('masyarakat.profile')->with('success', 'Password Anda telah berhasil diperbarui.');
    }
}
