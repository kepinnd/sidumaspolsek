@extends('layouts.app') {{-- Menggunakan layout utama dengan sidebar --}}

@section('title', 'Detail Monitoring Pengaduan')

@section('content')
<div class="bg-white shadow-lg rounded-lg p-4 sm:p-6 md:p-8">
    {{-- Header Halaman --}}
    <div class="flex flex-col sm:flex-row justify-between sm:items-center mb-6 pb-4 border-b border-gray-200">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Detail Pengaduan</h1>
            <p class="text-sm text-gray-500 mt-1">ID Pengaduan: {{ $pengaduan->id }}</p>
        </div>
        <a href="{{ route('kapolsek.monitoring.index') }}" class="mt-4 sm:mt-0 text-sm bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-md inline-block text-center whitespace-nowrap">
            &larr; Kembali ke Daftar
        </a>
    </div>

    @if ($pengaduan)
        <div class="space-y-8">
            {{-- Informasi Pelapor --}}
            <div>
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Informasi Pelapor</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-5 text-sm">
                    <div>
                        <strong class="text-gray-500 block">Nama Pelapor</strong>
                        <p class="text-gray-800">{{ $pengaduan->masyarakat->name ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <strong class="text-gray-500 block">NIK</strong>
                        <p class="text-gray-800">{{ $pengaduan->masyarakat->nik ?? 'N/A' }}</p>
                    </div>
                    <div class="sm:col-span-2">
                        <strong class="text-gray-500 block">Alamat Pelapor</strong>
                        <p class="text-gray-800">{{ $pengaduan->masyarakat->alamat ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <strong class="text-gray-500 block">No. Telepon</strong>
                        <p class="text-gray-800">{{ $pengaduan->masyarakat->no_telp ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <strong class="text-gray-500 block">Email</strong>
                        <p class="text-gray-800">{{ $pengaduan->masyarakat->email ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <hr>

            {{-- Detail Pengaduan --}}
            <div>
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Detail Laporan Pengaduan</h2>
                <div class="grid grid-cols-1 gap-y-5 text-sm">
                    <div>
                        <strong class="text-gray-500 block">Judul Laporan</strong>
                        <p class="text-gray-800 text-lg">{{ $pengaduan->judul_laporan }}</p>
                    </div>
                    <div>
                        <strong class="text-gray-500 block">Tanggal Pengaduan</strong>
                        <p class="text-gray-800">{{ $pengaduan->tgl_pengaduan->translatedFormat('l, d F Y H:i') }}</p>
                    </div>
                    <div>
                        <strong class="text-gray-500 block">Lokasi Kejadian</strong>
                        <p class="text-gray-800">{{ $pengaduan->lokasi_kejadian }}</p>
                    </div>
                    <div>
                        <strong class="text-gray-500 block">Isi Laporan / Uraian Kejadian</strong>
                        <div class="mt-1 p-3 bg-gray-50 rounded-md border border-gray-200 text-gray-700 whitespace-pre-wrap">
                            {{ $pengaduan->isi_laporan }}
                        </div>
                    </div>
                    <div>
                        <strong class="text-gray-500 block mb-1">Status Pengaduan</strong>
                        <p>
                            <span class="px-3 py-1 text-sm font-semibold rounded-full
                                @if($pengaduan->status == 'pending') bg-yellow-200 text-yellow-800
                                @elseif($pengaduan->status == 'diterima') bg-blue-200 text-blue-800
                                @elseif($pengaduan->status == 'diproses') bg-indigo-200 text-indigo-800
                                @elseif($pengaduan->status == 'selesai') bg-green-200 text-green-800
                                @elseif($pengaduan->status == 'ditolak') bg-red-200 text-red-800
                                @endif">
                                {{ ucfirst(str_replace('_', ' ', $pengaduan->status)) }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            {{-- Foto Bukti --}}
            @if ($pengaduan->foto_bukti)
            <div>
                <strong class="text-gray-500 block text-sm">Foto Bukti</strong>
                <div class="mt-2">
                    <a href="{{ Storage::url($pengaduan->foto_bukti) }}" target="_blank" rel="noopener noreferrer" class="inline-block">
                        <img src="{{ Storage::url($pengaduan->foto_bukti) }}" alt="Foto Bukti" class="rounded-lg border border-gray-300 w-full max-w-md h-auto hover:opacity-80 transition-opacity">
                    </a>
                    <p class="text-xs text-gray-500 mt-1">Klik gambar untuk melihat ukuran penuh.</p>
                </div>
            </div>
            @endif

            <hr>

            {{-- Tanggapan Petugas --}}
            @if ($pengaduan->tanggapan || $pengaduan->petugas_id)
            <div>
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Tindak Lanjut oleh Petugas</h2>
                @if($pengaduan->petugas)
                <div class="text-sm mb-4">
                    <strong class="text-gray-500 block">Ditangani oleh</strong>
                    <p class="text-gray-800">{{ $pengaduan->petugas->name }} (Petugas SPKT)</p>
                </div>
                @endif
                @if($pengaduan->tanggapan)
                <div>
                    <strong class="text-gray-500 text-sm block">Tanggapan / Catatan Petugas</strong>
                    <div class="mt-1 p-3 bg-blue-50 rounded-md border border-blue-200 text-gray-700 whitespace-pre-wrap text-sm">
                        {{ $pengaduan->tanggapan }}
                    </div>
                    <p class="text-xs text-gray-500 mt-1">
                        Tanggal Update Terakhir: {{ $pengaduan->updated_at->translatedFormat('l, d F Y H:i') }}
                    </p>
                </div>
                @else
                <p class="text-gray-600 text-sm italic">Belum ada tanggapan detail dari petugas untuk status saat ini.</p>
                @endif
            </div>
            @elseif($pengaduan->status == 'pending')
                <div>
                    <h2 class="text-xl font-semibold text-gray-700 mb-4">Tindak Lanjut</h2>
                    <p class="text-gray-600 text-sm italic">Pengaduan ini masih menunggu untuk diverifikasi dan ditangani oleh petugas.</p>
                </div>
            @endif

        </div>

    @else
        <p class="text-red-500 text-center py-10">Data pengaduan tidak ditemukan.</p>
    @endif
</div>
@endsection
