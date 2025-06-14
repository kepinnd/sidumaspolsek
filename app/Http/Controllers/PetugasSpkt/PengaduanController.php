<?php

namespace App\Http\Controllers\PetugasSpkt;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengaduan::with('masyarakat')->latest();

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $pengaduan = $query->paginate(10);
        return view('petugas_spkt.pengaduan.index', compact('pengaduan'));
    }

      public function dashboard()
    {
        // Ambil data statistik yang relevan untuk petugas
        $jumlahPengaduanPending = Pengaduan::where('status', 'pending')->count();
        $jumlahPengaduanDiproses = Pengaduan::whereIn('status', ['diterima', 'diproses'])->count();

        // Kirim data statistik ke view 'petugas_spkt.dashboard'
        return view('petugas_spkt.dashboard', compact(
            'jumlahPengaduanPending',
            'jumlahPengaduanDiproses'
        ));
    }

    public function show(Pengaduan $pengaduan)
    {
        return view('petugas_spkt.pengaduan.show', compact('pengaduan'));
    }

    public function updateStatus(Request $request, Pengaduan $pengaduan)
    {
        $request->validate([
            'status' => ['required', 'in:diterima,ditolak,diproses,selesai'],
            'tanggapan' => $request->status == 'ditolak' || $request->status == 'selesai' ? ['required', 'string'] : ['nullable', 'string'],
        ]);

        $pengaduan->status = $request->status;
        $pengaduan->petugas_id = Auth::id(); // Petugas yang mengubah status

        if ($request->filled('tanggapan')) {
            $pengaduan->tanggapan = $request->tanggapan;
        }

        // Jika status 'diterima', petugas_id diisi, tapi tanggapan mungkin belum.
        // Jika 'diproses', petugas_id diisi.
        // Jika 'ditolak' atau 'selesai', tanggapan wajib diisi.

        $pengaduan->save();

        // TODO: Kirim notifikasi ke masyarakat (Email atau lainnya)

        return redirect()->route('petugas.pengaduan.show', $pengaduan)->with('success', 'Status pengaduan berhasil diperbarui.');
    }
}
