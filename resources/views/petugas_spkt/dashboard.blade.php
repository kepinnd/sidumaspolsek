@extends('layouts.app') {{-- Menggunakan layout utama dengan sidebar --}}

@section('title', 'Dashboard Petugas SPKT')

@section('content')
    {{-- Header Halaman --}}
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-200">Dashboard Petugas SPKT</h1>
        <p class="mt-1 text-gray-200">Selamat datang, {{ Auth::user()->name }}. Kelola semua pengaduan yang masuk di sini.</p>
    </div>

    {{-- Konten Utama --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Kolom Kiri: Aksi Utama & Statistik --}}
        <div class="lg:col-span-2 space-y-6">
            <!-- Kartu Navigasi Utama: Daftar Pengaduan -->
            <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 ease-in-out transform hover:-translate-y-1">
                <a href="{{ route('petugas.pengaduan.index') }}" class="block">
                    <div class="flex flex-col sm:flex-row items-center gap-6">
                        <div class="flex-shrink-0 p-4 bg-indigo-500 text-white rounded-lg">
                            {{-- Icon Daftar Pengaduan --}}
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <div class="text-center sm:text-left">
                            <h3 class="text-xl font-semibold text-gray-800">Lihat & Tindak Lanjuti Pengaduan</h3>
                            <p class="text-gray-600 mt-1">Akses semua pengaduan yang masuk untuk diverifikasi, diproses, dan diberi tanggapan.</p>
                        </div>
                        <div class="ml-auto text-indigo-500 hidden sm:block">
                             <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Kartu Statistik Pengaduan (Contoh Tambahan) -->
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <h3 class="text-lg font-semibold text-gray-700 border-b pb-3 mb-4">Ringkasan Pekerjaan</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    {{-- Pengaduan Pending --}}
                    <div class="p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                        <p class="text-sm font-medium text-yellow-600">Pengaduan Perlu Diverifikasi</p>
                        @if(isset($jumlahPengaduanPending))
                            <p class="text-3xl font-bold text-yellow-500 mt-1">{{ $jumlahPengaduanPending }}</p>
                        @else
                            <p class="text-3xl font-bold text-gray-400 mt-1">N/A</p>
                        @endif
                    </div>
                    {{-- Pengaduan Diproses --}}
                    <div class="p-4 bg-indigo-50 rounded-lg border border-indigo-200">
                        <p class="text-sm font-medium text-indigo-600">Pengaduan Sedang Diproses</p>
                        @if(isset($jumlahPengaduanDiproses))
                            <p class="text-3xl font-bold text-indigo-500 mt-1">{{ $jumlahPengaduanDiproses }}</p>
                        @else
                            <p class="text-3xl font-bold text-gray-400 mt-1">N/A</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Informasi & Tips --}}
        <div class="lg:col-span-1">
             <div class="bg-white p-6 rounded-xl shadow-lg h-full">
                <h3 class="text-lg font-semibold text-gray-700 border-b pb-3 mb-4">Prosedur Standar (SOP)</h3>
                <ul class="space-y-3 text-sm text-gray-600 list-decimal list-inside">
                    <li>
                        <span class="font-semibold">Verifikasi Laporan Masuk:</span>
                        Periksa kelengkapan dan keabsahan laporan yang berstatus "Pending".
                    </li>
                    <li>
                        <span class="font-semibold">Ubah Status:</span>
                        Ubah status menjadi "Diterima" jika laporan valid, atau "Ditolak" dengan alasan yang jelas.
                    </li>
                    <li>
                        <span class="font-semibold">Beri Tanggapan:</span>
                        Berikan tanggapan awal pada laporan yang diterima.
                    </li>
                     <li>
                        <span class="font-semibold">Proses Laporan:</span>
                        Ubah status menjadi "Diproses" saat tindak lanjut lapangan dimulai.
                    </li>
                    <li>
                        <span class="font-semibold">Selesaikan Laporan:</span>
                        Ubah status menjadi "Selesai" dengan memberikan tanggapan akhir hasil dari tindak lanjut.
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection