<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Kapolsek\MonitoringController as KapolsekMonitoringController;
use App\Http\Controllers\PetugasSpkt\PengaduanController as PetugasPengaduanController;
use App\Http\Controllers\Masyarakat\PengaduanController as MasyarakatPengaduanController;
use App\Http\Controllers\Masyarakat\LaporanPdfController;
use App\Http\Controllers\Masyarakat\ProfileController as MasyarakatProfileController;
// Halaman utama atau landing page (jika ada)
Route::get('/', function () {
    return view('welcome'); // Atau redirect ke login
});

// Redirect ke dashboard masing-masing setelah login
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

// Grup Rute untuk Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        
        $jumlahTotalPengguna = User::whereIn('role', ['kapolsek', 'petugas_spkt', 'masyarakat'])->count();
        $jumlahSemuaAkun = User::count(); // Termasuk admin
        $jumlahPengaduanPending = \App\Models\Pengaduan::where('status', 'pending')->count();
        $jumlahPengaduanSelesai = \App\Models\Pengaduan::where('status', 'selesai')->count();
     // Kirim data ke view
        return view('admin.dashboard', [
            'jumlahTotalPengguna' => $jumlahTotalPengguna,
            'jumlahSemuaAkun' => $jumlahSemuaAkun,
            'jumlahPengaduanPending' => $jumlahPengaduanPending,
            'jumlahPengaduanSelesai' => $jumlahPengaduanPending
        ]);
    })->name('dashboard');

    Route::resource('users', AdminUserController::class);
    // Rute lain untuk admin
});

// Grup Rute untuk Kapolsek
Route::middleware(['auth', 'role:kapolsek'])->prefix('kapolsek')->name('kapolsek.')->group(function () {
    Route::get('/dashboard', [KapolsekMonitoringController::class, 'dashboard'])->name('dashboard'); // Langsung ke monitoring
    Route::get('/monitoring', [KapolsekMonitoringController::class, 'index'])->name('monitoring.index');
    Route::get('/monitoring/{pengaduan}', [KapolsekMonitoringController::class, 'show'])->name('monitoring.show');
    // Rute lain untuk kapolsek
});

// Grup Rute untuk Petugas SPKT
Route::middleware(['auth', 'role:petugas_spkt'])->prefix('petugas-spkt')->name('petugas.')->group(function () {
    Route::get('/dashboard', [PetugasPengaduanController::class, 'dashboard'])->name('dashboard'); // Langsung ke daftar pengaduan
    Route::get('/pengaduan', [PetugasPengaduanController::class, 'index'])->name('pengaduan.index');
    Route::get('/pengaduan/{pengaduan}', [PetugasPengaduanController::class, 'show'])->name('pengaduan.show');
    Route::patch('/pengaduan/{pengaduan}/update-status', [PetugasPengaduanController::class, 'updateStatus'])->name('pengaduan.updateStatus');
    // Rute lain untuk petugas spkt
});

// Grup Rute untuk Masyarakat
Route::middleware(['auth', 'role:masyarakat'])->prefix('masyarakat')->name('masyarakat.')->group(function () {
    Route::get('/dashboard', [MasyarakatPengaduanController::class, 'dashboard'])->name('dashboard'); // Langsung ke daftar pengaduan mereka
    Route::resource('pengaduan', MasyarakatPengaduanController::class)->except(['edit', 'update', 'destroy']); // Masyarakat tidak bisa edit/delete setelah submit
    Route::get('/pengaduan/{pengaduan}/cetak-laporan', [LaporanPdfController::class, 'generatePdf'])->name('pengaduan.cetakLaporan');
    Route::get('/profile', [MasyarakatProfileController::class, 'show'])->name('profile');
     // === RUTE BARU UNTUK UBAH PASSWORD ===
    Route::get('/profile/change-password', [MasyarakatProfileController::class, 'editPassword'])->name('profile.editPassword');
    Route::put('/profile/change-password', [MasyarakatProfileController::class, 'updatePassword'])->name('profile.updatePassword');
    // Rute lain untuk masyarakat
});


// Rute Autentikasi (Jika menggunakan Breeze, ini sudah diatur di auth.php)
// Jika tidak, Anda perlu mendefinisikannya secara manual atau require file auth.php bawaan Breeze.
require __DIR__.'/auth.php'; // Jika pakai Breeze

// Jika membuat registrasi khusus masyarakat di luar Breeze default:
// use App\Http\Controllers\Auth\RegisteredUserController;
// Route::get('register/masyarakat', [RegisteredUserController::class, 'createMasyarakat'])->name('register.masyarakat');
// Route::post('register/masyarakat', [RegisteredUserController::class, 'storeMasyarakat']);
