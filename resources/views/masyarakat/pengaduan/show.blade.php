@extends('layouts.app') {{-- Sesuaikan jika nama layout Anda berbeda --}}

@section('title', 'Detail Pengaduan')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-lg rounded-lg p-6 md:p-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl md:text-3xl font-semibold text-gray-800">Detail Pengaduan</h1>
            <a href="{{ route('masyarakat.pengaduan.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800">&larr; Kembali ke Daftar Pengaduan</a>
        </div>

        @if ($pengaduan)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="md:col-span-2">
                    <h2 class="text-xl font-medium text-gray-700 mb-1">{{ $pengaduan->judul_laporan }}</h2>
                    <p class="text-sm text-gray-500 mb-1">
                        Tanggal Pengaduan: {{ $pengaduan->tgl_pengaduan->translatedFormat('l, d F Y H:i') }}
                    </p>
                    <p class="text-sm text-gray-500 mb-3">
                        Lokasi Kejadian: {{ $pengaduan->lokasi_kejadian }}
                    </p>

                    <div class="mb-4">
                        <h3 class="text-md font-semibold text-gray-700 mb-1">Isi Laporan:</h3>
                        <div class="p-3 bg-gray-50 rounded border border-gray-200 text-gray-700 whitespace-pre-wrap">
                            {{ $pengaduan->isi_laporan }}
                        </div>
                    </div>
                </div>

                <div class="md:col-span-1">
                    <div class="mb-4">
                        <h3 class="text-md font-semibold text-gray-700 mb-1">Status:</h3>
                        <span class="px-3 py-1 text-sm font-semibold rounded-full
                            @if($pengaduan->status == 'pending') bg-yellow-200 text-yellow-800
                            @elseif($pengaduan->status == 'diterima') bg-blue-200 text-blue-800
                            @elseif($pengaduan->status == 'diproses') bg-indigo-200 text-indigo-800
                            @elseif($pengaduan->status == 'selesai') bg-green-200 text-green-800
                            @elseif($pengaduan->status == 'ditolak') bg-red-200 text-red-800
                            @endif">
                            {{ ucfirst($pengaduan->status) }}
                        </span>
                    </div>

                    @if ($pengaduan->foto_bukti)
                    <div class="mb-4">
                        <h3 class="text-md font-semibold text-gray-700 mb-1">Foto Bukti:</h3>
                        <a href="{{ Storage::url($pengaduan->foto_bukti) }}" target="_blank" rel="noopener noreferrer">
                            <img src="{{ Storage::url($pengaduan->foto_bukti) }}" alt="Foto Bukti" class="rounded border border-gray-300 max-w-full h-auto max-h-64 object-contain hover:opacity-80 transition-opacity">
                        </a>
                        <p class="text-xs text-gray-500 mt-1">Klik gambar untuk melihat ukuran penuh.</p>
                    </div>
                    @else
                    <div class="mb-4">
                        <h3 class="text-md font-semibold text-gray-700 mb-1">Foto Bukti:</h3>
                        <p class="text-gray-600">Tidak ada foto bukti yang dilampirkan.</p>
                    </div>
                    @endif
                </div>
            </div>

            @if ($pengaduan->tanggapan)
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Tanggapan dari Petugas:</h3>
                <div class="p-4 bg-blue-50 rounded-lg border border-blue-200">
                    <p class="text-sm text-gray-500 mb-1">
                        Ditanggapi oleh: {{ $pengaduan->petugas->name ?? 'Petugas SPKT' }}
                        @if($pengaduan->updated_at != $pengaduan->created_at && $pengaduan->status != 'pending')
                            pada {{ $pengaduan->updated_at->translatedFormat('l, d F Y H:i') }}
                        @endif
                    </p>
                    <div class="text-gray-700 whitespace-pre-wrap">
                        {{ $pengaduan->tanggapan }}
                    </div>
                </div>
            </div>
            @else
                @if($pengaduan->status != 'pending')
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Tanggapan dari Petugas:</h3>
                    <p class="text-gray-600 p-3 bg-gray-50 rounded border border-gray-200">Belum ada tanggapan untuk pengaduan ini.</p>
                </div>
                @endif
            @endif

            @if (in_array($pengaduan->status, ['diterima', 'diproses', 'selesai']))
            <div class="mt-8 text-center md:text-left">
                <a href="{{ route('masyarakat.pengaduan.cetakLaporan', $pengaduan->id) }}" target="_blank"
                   class="inline-flex items-center px-6 py-3 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-800 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    Cetak Surat Laporan (PDF)
                </a>
            </div>
            @endif

        @else
            <p class="text-red-500">Data pengaduan tidak ditemukan.</p>
        @endif
    </div>
</div>
@endsection