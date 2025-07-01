<?php

use Illuminate\Support\Facades\Route;

// Import Model
use App\Models\User;
use App\Models\Pengaduan;

// Import Controller
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Kapolsek\MonitoringController as KapolsekMonitoringController;
use App\Http\Controllers\PetugasSpkt\PengaduanController as PetugasPengaduanController;
use App\Http\Controllers\Masyarakat\PengaduanController as MasyarakatPengaduanController;
use App\Http\Controllers\Masyarakat\LaporanPdfController;
use App\Http\Controllers\Masyarakat\ProfileController as MasyarakatProfileController;
use App\Http\Controllers\Auth\OtpVerificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// === RUTE UNTUK VERIFIKASI DAN PENGIRIMAN ULANG OTP ===
Route::get('/otp-verification', [OtpVerificationController::class, 'notice'])->name('otp.verification.notice');
Route::post('/otp-verification', [OtpVerificationController::class, 'verify'])->name('otp.verification.verify');
Route::post('/otp-resend', [OtpVerificationController::class, 'resend'])->name('otp.resend');

// Memuat rute-rute autentikasi bawaan (login, register, logout, dll.)
require __DIR__.'/auth.php';


// === SEMUA RUTE SETELAH LOGIN HARUS TERVERIFIKASI ===

// Rute dashboard umum yang akan mengarahkan pengguna berdasarkan peran
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified']) // 'verified' akan memeriksa is_verified=true
    ->name('dashboard');

// Grup Rute untuk Admin
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        $jumlahTotalPengguna = User::whereIn('role', ['kapolsek', 'petugas_spkt', 'masyarakat'])->count();
        $jumlahSemuaAkun = User::count();
        $jumlahPengaduanPending = Pengaduan::where('status', 'pending')->count();
        $jumlahPengaduanSelesai = Pengaduan::where('status', 'selesai')->count();
        
        return view('admin.dashboard', [
            'jumlahTotalPengguna' => $jumlahTotalPengguna,
            'jumlahSemuaAkun' => $jumlahSemuaAkun,
            'jumlahPengaduanPending' => $jumlahPengaduanPending,
            'jumlahPengaduanSelesai' => $jumlahPengaduanSelesai, // PERBAIKAN: Menggunakan variabel yang benar
        ]);
    })->name('dashboard');

    Route::resource('users', AdminUserController::class);
});

// Grup Rute untuk Kapolsek
Route::middleware(['auth', 'verified', 'role:kapolsek'])->prefix('kapolsek')->name('kapolsek.')->group(function () {
    Route::get('/dashboard', [KapolsekMonitoringController::class, 'dashboard'])->name('dashboard');
    Route::get('/monitoring', [KapolsekMonitoringController::class, 'index'])->name('monitoring.index');
    Route::get('/monitoring/{pengaduan}', [KapolsekMonitoringController::class, 'show'])->name('monitoring.show');
});

// Grup Rute untuk Petugas SPKT
Route::middleware(['auth', 'verified', 'role:petugas_spkt'])->prefix('petugas-spkt')->name('petugas.')->group(function () {
    Route::get('/dashboard', [PetugasPengaduanController::class, 'dashboard'])->name('dashboard');
    Route::get('/pengaduan', [PetugasPengaduanController::class, 'index'])->name('pengaduan.index');
    Route::get('/pengaduan/{pengaduan}', [PetugasPengaduanController::class, 'show'])->name('pengaduan.show');
    Route::patch('/pengaduan/{pengaduan}/update-status', [PetugasPengaduanController::class, 'updateStatus'])->name('pengaduan.updateStatus');
});

// Grup Rute untuk Masyarakat
Route::middleware(['auth', 'verified', 'role:masyarakat'])->prefix('masyarakat')->name('masyarakat.')->group(function () {
    Route::get('/dashboard', [MasyarakatPengaduanController::class, 'dashboard'])->name('dashboard');
    Route::resource('pengaduan', MasyarakatPengaduanController::class)->except(['edit', 'update', 'destroy']);
    Route::get('/pengaduan/{pengaduan}/cetak-laporan', [LaporanPdfController::class, 'generatePdf'])->name('pengaduan.cetakLaporan');
    Route::get('/profile', [MasyarakatProfileController::class, 'show'])->name('profile');
    Route::get('/profile/change-password', [MasyarakatProfileController::class, 'editPassword'])->name('profile.editPassword');
    Route::put('/profile/change-password', [MasyarakatProfileController::class, 'updatePassword'])->name('profile.updatePassword');
});
