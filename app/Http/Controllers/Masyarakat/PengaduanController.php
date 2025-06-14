<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;  
use Illuminate\Support\Facades\File; 


class PengaduanController extends Controller
{
    public function dashboard() // Method baru untuk halaman dashboard
    {
        $userId = Auth::id();

        $totalPengaduan = Pengaduan::where('masyarakat_id', $userId)->count();
        $pengaduanPending = Pengaduan::where('masyarakat_id', $userId)->where('status', 'pending')->count();
        $pengaduanDiproses = Pengaduan::where('masyarakat_id', $userId)->whereIn('status', ['diterima', 'diproses'])->count();
        $pengaduanSelesai = Pengaduan::where('masyarakat_id', $userId)->where('status', 'selesai')->count();

        // Pastikan view 'masyarakat.dashboard' ada di resources/views/masyarakat/dashboard.blade.php
        return view('masyarakat.dashboard', compact(
            'totalPengaduan',
            'pengaduanPending',
            'pengaduanDiproses',
            'pengaduanSelesai'
        ));
    }
    public function index()
    {
        $pengaduan = Pengaduan::where('masyarakat_id', Auth::id())->latest()->paginate(10);
        return view('masyarakat.pengaduan.index', compact('pengaduan'));
    }

    public function create()
    {
        return view('masyarakat.pengaduan.create');
    }

    public function store(Request $request)
{
    Log::info('Masyarakat\PengaduanController@store: Proses dimulai.');
    $request->validate([
        'judul_laporan' => ['required', 'string', 'max:255'],
        'isi_laporan' => ['required', 'string'],
        'lokasi_kejadian' => ['required', 'string', 'max:255'],
        'foto_bukti' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
    ]);
    Log::info('Validasi berhasil.');

    $pathFotoBukti = null;
    if ($request->hasFile('foto_bukti')) {
        $file = $request->file('foto_bukti');
        Log::info('File ditemukan: ' . $file->getClientOriginalName() . ', Ukuran: ' . $file->getSize() . ', Tipe: ' . $file->getMimeType());

        if (!$file->isValid()) {
            Log::error('File tidak valid setelah dicek isValid().');
            return redirect()->back()->withErrors(['foto_bukti' => 'File bukti tidak valid.'])->withInput();
        }

        try {
            Log::info('Mencoba menyimpan file ke disk public, path: bukti_pengaduan');
            // Ini adalah baris kunci
            $pathFotoBukti = $file->store('bukti_pengaduan', 'public');

            if ($pathFotoBukti) {
                Log::info('Operasi store() mengembalikan path: ' . $pathFotoBukti);
                // Cek apakah file dan direktori benar-benar ada setelah operasi store()
                $fullPath = storage_path('app/public/' . $pathFotoBukti);
                if (File::exists($fullPath)) {
                    Log::info('SUKSES FISIK: File dikonfirmasi ada di: ' . $fullPath);
                } else {
                    Log::error('GAGAL FISIK: File::exists() mengembalikan false untuk: ' . $fullPath);
                    $parentDir = dirname($fullPath);
                    if (File::isDirectory($parentDir)) {
                        Log::info('Direktori induk (' . $parentDir . ') ADA.');
                        if (!is_writable($parentDir)) {
                            Log::error('Direktori induk (' . $parentDir . ') TIDAK DAPAT DITULIS.');
                        } else {
                            Log::info('Direktori induk (' . $parentDir . ') DAPAT DITULIS.');
                        }
                    } else {
                        Log::error('Direktori induk (' . $parentDir . ') TIDAK ADA.');
                        // Cek apakah storage/app/public ada dan writable
                        $storageAppPublic = storage_path('app/public');
                        if(File::isDirectory($storageAppPublic) && is_writable($storageAppPublic)) {
                            Log::info('storage/app/public ADA dan WRITABLE.');
                        } else {
                            Log::error('storage/app/public TIDAK ADA atau TIDAK WRITABLE. Path: ' . $storageAppPublic);
                        }
                    }
                }
            } else {
                Log::error('Operasi store() mengembalikan false atau null. Tidak ada path yang dihasilkan.');
            }
        } catch (\Exception $e) {
            Log::error('Exception saat operasi store file: ' . $e->getMessage() . ' di baris: ' . $e->getLine() . ' dalam file: ' . $e->getFile());
            // Penting untuk melihat detail exception ini
            return redirect()->back()->withErrors(['foto_bukti' => 'Gagal menyimpan file bukti karena exception. Periksa log.'])->withInput();
        }
    } else {
        Log::info('Tidak ada file foto_bukti yang diunggah.');
    }

    try {
        Log::info('Mencoba membuat record Pengaduan dengan pathFotoBukti: ' . ($pathFotoBukti ?? 'NULL'));
        Pengaduan::create([
            'masyarakat_id' => Auth::id(),
            'tgl_pengaduan' => now(),
            'judul_laporan' => $request->judul_laporan,
            'isi_laporan' => $request->isi_laporan,
            'lokasi_kejadian' => $request->lokasi_kejadian,
            'foto_bukti' => $pathFotoBukti,
            'status' => 'pending',
        ]);
        Log::info('Record Pengaduan berhasil dibuat.');
    } catch (\Exception $e) {
        Log::error('Exception saat membuat record Pengaduan: ' . $e->getMessage());
        return redirect()->back()->withErrors(['error' => 'Gagal membuat pengaduan karena kesalahan database. Periksa log.'])->withInput();
    }

    return redirect()->route('masyarakat.pengaduan.index')->with('success', 'Pengaduan berhasil dikirim.');

    }

    public function show(Pengaduan $pengaduan)
    {
        // Pastikan masyarakat hanya bisa melihat pengaduannya sendiri
        if ($pengaduan->masyarakat_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK');
        }

        if ($pengaduan->tanggapan) {
            $pengaduan->load('petugas');
        }

        return view('masyarakat.pengaduan.show', compact('pengaduan'));
    }
}
