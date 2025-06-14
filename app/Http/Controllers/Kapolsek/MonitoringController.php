<?php

namespace App\Http\Controllers\Kapolsek;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengaduan::with(['masyarakat', 'petugas'])->latest();

        if ($request->has('status_filter') && $request->status_filter != '') {
            $query->where('status', $request->status_filter);
        }
        if ($request->has('tanggal_awal') && $request->tanggal_awal != '') {
            $query->whereDate('tgl_pengaduan', '>=', $request->tanggal_awal);
        }
        if ($request->has('tanggal_akhir') && $request->tanggal_akhir != '') {
            $query->whereDate('tgl_pengaduan', '<=', $request->tanggal_akhir);
        }

        $pengaduan = $query->paginate(10);
        $statuses = ['pending', 'diterima', 'ditolak', 'diproses', 'selesai']; // Untuk filter
        return view('kapolsek.monitoring.index', compact('pengaduan', 'statuses'));
    }

    public function show(Pengaduan $pengaduan)
    {
        return view('kapolsek.monitoring.show', compact('pengaduan'));
    }
     public function dashboard()
        {
            // Ambil data statistik dari semua pengaduan
            $jumlahPengaduanPending = Pengaduan::where('status', 'pending')->count();
            $jumlahPengaduanDiproses = Pengaduan::whereIn('status', ['diterima', 'diproses'])->count();
            $jumlahPengaduanSelesai = Pengaduan::where('status', 'selesai')->count();

            return view('kapolsek.dashboard', compact(
                'jumlahPengaduanPending',
                'jumlahPengaduanDiproses',
                'jumlahPengaduanSelesai'
            ));
        }
}
