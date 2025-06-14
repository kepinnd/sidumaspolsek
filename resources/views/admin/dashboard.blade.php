@extends('layouts.app') {{-- Menggunakan layout baru dengan sidebar --}}

@section('title', 'Dashboard Admin')

@section('content')
    {{-- Header Halaman --}}
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-white">Dashboard Administrator</h1>
        <p class="mt-1 text-white">Selamat datang, {{ Auth::user()->name }}. Berikut adalah ringkasan sistem.</p>
    </div>

    {{-- Konten Utama --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- Kartu Navigasi Utama: Kelola Pengguna -->
        <div class="md:col-span-2 lg:col-span-1 bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 ease-in-out transform hover:-translate-y-1">
            <a href="{{ route('admin.users.index') }}" class="block text-center">
                <div class="p-4 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600 transition duration-300">
                    {{-- Icon Kelola Pengguna --}}
                    <svg class="w-12 h-12 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    <h3 class="text-lg font-semibold">Kelola Pengguna</h3>
                    <p class="text-sm opacity-90">Atur semua akun pengguna sistem.</p>
                </div>
            </a>
        </div>

        <!-- Kartu Statistik Pengguna -->
        <div class="bg-white p-6 rounded-xl shadow-lg">
            <h3 class="text-lg font-semibold text-gray-700 border-b pb-3 mb-3">Statistik Pengguna</h3>
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Pengguna Publik</span>
                    @if(isset($jumlahTotalPengguna))
                        <span class="font-bold text-indigo-600 bg-indigo-100 px-2 py-1 rounded-full text-sm">{{ $jumlahTotalPengguna }}</span>
                    @else
                        <span class="text-gray-400 text-sm">N/A</span>
                    @endif
                </div>
                <p class="text-xs text-gray-400 -mt-2 ml-1">(Kapolsek, Petugas SPKT, Masyarakat)</p>

                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Total Semua Akun</span>
                    @if(isset($jumlahSemuaAkun))
                        <span class="font-bold text-indigo-600 bg-indigo-100 px-2 py-1 rounded-full text-sm">{{ $jumlahSemuaAkun }}</span>
                    @else
                        <span class="text-gray-400 text-sm">N/A</span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Kartu Statistik Pengaduan (Contoh Tambahan) -->
        <div class="bg-white p-6 rounded-xl shadow-lg">
            <h3 class="text-lg font-semibold text-gray-700 border-b pb-3 mb-3">Statistik Pengaduan</h3>
            <div class="space-y-3">
                 <div class="flex justify-between items-center">
                    <span class="text-gray-600">Pengaduan Pending</span>
                    @if(isset($jumlahPengaduanPending)) {{-- Anda perlu mengirim variabel ini dari controller --}}
                        <span class="font-bold text-yellow-600 bg-yellow-100 px-2 py-1 rounded-full text-sm">{{ $jumlahPengaduanPending }}</span>
                    @else
                        <span class="text-gray-400 text-sm">N/A</span>
                    @endif
                </div>
                 <div class="flex justify-between items-center">
                    <span class="text-gray-600">Pengaduan Selesai</span>
                    @if(isset($jumlahPengaduanSelesai)) {{-- Anda perlu mengirim variabel ini dari controller --}}
                        <span class="font-bold text-green-600 bg-green-100 px-2 py-1 rounded-full text-sm">{{ $jumlahPengaduanSelesai }}</span>
                    @else
                        <span class="text-gray-400 text-sm">N/A</span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Anda bisa menambahkan kartu atau widget lain di sini --}}

    </div>
@endsection