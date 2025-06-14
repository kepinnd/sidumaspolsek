@extends('layouts.app') {{-- Menggunakan layout utama dengan sidebar --}}

@section('title', 'Dashboard Kapolsek')

@section('content')
    {{-- Header Halaman --}}
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Dashboard Kapolsek</h1>
        <p class="mt-1 text-gray-600">Selamat datang, {{ Auth::user()->name }}. Anda dapat memonitor seluruh pengaduan di sini.</p>
    </div>

    {{-- Konten Utama --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- Kartu Navigasi Utama: Monitoring Pengaduan -->
        <div class="md:col-span-2 lg:col-span-1 bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 ease-in-out transform hover:-translate-y-1">
            <a href="{{ route('kapolsek.monitoring.index') }}" class="block text-center">
                <div class="p-4 bg-purple-500 text-white rounded-lg hover:bg-purple-600 transition duration-300">
                    {{-- Icon Monitoring Pengaduan --}}
                    <svg class="w-12 h-12 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <h3 class="text-lg font-semibold">Monitoring Pengaduan</h3>
                    <p class="text-sm opacity-90">Pantau semua pengaduan yang masuk.</p>
                </div>
            </a>
        </div>

        <!-- Kartu Statistik Pengaduan (Contoh Tambahan) -->
        <div class="md:col-span-2 lg:col-span-2 bg-white p-6 rounded-xl shadow-lg">
            <h3 class="text-lg font-semibold text-gray-700 border-b pb-3 mb-3">Ringkasan Pengaduan Sistem</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                {{-- Pengaduan Pending --}}
                <div class="text-center p-4 bg-yellow-50 rounded-lg">
                    <p class="text-sm font-medium text-yellow-600">Pending</p>
                    @if(isset($jumlahPengaduanPending)) {{-- Anda perlu mengirim variabel ini dari controller --}}
                        <p class="text-3xl font-bold text-yellow-500 mt-1">{{ $jumlahPengaduanPending }}</p>
                    @else
                        <p class="text-3xl font-bold text-gray-400 mt-1">N/A</p>
                    @endif
                </div>
                {{-- Pengaduan Diproses --}}
                <div class="text-center p-4 bg-indigo-50 rounded-lg">
                    <p class="text-sm font-medium text-indigo-600">Diproses</p>
                    @if(isset($jumlahPengaduanDiproses)) {{-- Anda perlu mengirim variabel ini dari controller --}}
                        <p class="text-3xl font-bold text-indigo-500 mt-1">{{ $jumlahPengaduanDiproses }}</p>
                    @else
                        <p class="text-3xl font-bold text-gray-400 mt-1">N/A</p>
                    @endif
                </div>
                {{-- Pengaduan Selesai --}}
                <div class="text-center p-4 bg-green-50 rounded-lg">
                    <p class="text-sm font-medium text-green-600">Selesai</p>
                    @if(isset($jumlahPengaduanSelesai)) {{-- Anda perlu mengirim variabel ini dari controller --}}
                        <p class="text-3xl font-bold text-green-500 mt-1">{{ $jumlahPengaduanSelesai }}</p>
                    @else
                        <p class="text-3xl font-bold text-gray-400 mt-1">N/A</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Anda bisa menambahkan kartu atau widget lain di sini sesuai kebutuhan --}}

    </div>
@endsection