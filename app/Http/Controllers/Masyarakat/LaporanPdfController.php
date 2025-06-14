<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf; // Import facade PDF

class LaporanPdfController extends Controller
{
    public function generatePdf(Pengaduan $pengaduan)
    {
        // Pastikan masyarakat hanya bisa mengunduh PDF pengaduannya sendiri
        // dan pengaduan sudah minimal diterima atau status lain yang relevan
        if ($pengaduan->masyarakat_id !== Auth::id() || !in_array($pengaduan->status, ['diterima', 'diproses', 'selesai'])) {
             // abort(403, 'Tidak dapat mencetak laporan untuk status ini atau bukan milik Anda.');
             return redirect()->back()->with('error', 'Tidak dapat mencetak laporan untuk status ini atau laporan ini bukan milik Anda.');
        }

        // Data yang akan dikirim ke view PDF
        $data = [
            'pengaduan' => $pengaduan,
            'masyarakat' => $pengaduan->masyarakat, // Load relasi jika belum
            'tanggal_cetak' => now()->translatedFormat('d F Y'), // Format tanggal Indonesia
        ];

        // Buat nama file unik
        $fileName = 'laporan_pengaduan_' . $pengaduan->id . '_' . time() . '.pdf';

        // Load view dan generate PDF
        $pdf = Pdf::loadView('masyarakat.pengaduan.pdf_template', $data);

        // Opsi: tampilkan di browser
        // return $pdf->stream($fileName);

        // Opsi: langsung download
        return $pdf->download($fileName);
    }
}
