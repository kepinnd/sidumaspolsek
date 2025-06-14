@extends('layouts.app') {{-- Sesuaikan jika layout Anda berbeda --}}

@section('title', 'Dashboard Anda')

@section('content')

    <div class="mb-4 p-6 bg-gradient-to-r from-blue-600 to-indigo-700 text-black rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold text-gray-200">Selamat Datang Kembali, {{ Auth::user()->name }}!</h1>
        <p class="text-2xl font-bold text-gray-200">Ini adalah ringkasan aktivitas pengaduan Anda. Laporkan setiap tindak kriminal yang Anda saksikan atau alami.</p>
    </div>

    @if(isset($totalPengaduan)) {{-- Cek apakah data statistik dikirim --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 ease-in-out transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-black-500 uppercase tracking-wider">Total Pengaduan</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalPengaduan ?? 0 }}</p>
                </div>
                <div class="p-3 bg-blue-100 text-blue-600 rounded-full">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 ease-in-out transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Pending</p>
                    <p class="text-3xl font-bold text-yellow-500">{{ $pengaduanPending ?? 0 }}</p>
                </div>
                <div class="p-3 bg-black-100 text-black-600 rounded-full">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 5.523-4.477 10-10 10S1 17.523 1 12S5.477 2 12 2s10 4.477 10 10z"></path></svg>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 ease-in-out transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Diproses</p>
                    <p class="text-3xl font-bold text-indigo-600">{{ $pengaduanDiproses ?? 0 }}</p>
                </div>
                <div class="p-3 bg-indigo-100 text-indigo-600 rounded-full">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 ease-in-out transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Selesai</p>
                    <p class="text-3xl font-bold text-green-500">{{ $pengaduanSelesai ?? 0 }}</p>
                </div>
                <div class="p-3 bg-green-100 text-green-600 rounded-full">
                     <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <a href="{{ route('masyarakat.pengaduan.create') }}" class="block p-6 bg-green-500 text-black rounded-lg shadow-md hover:bg-green-600 transition-colors duration-300 ease-in-out text-center">
            <div class="flex flex-col items-center justify-center h-full">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h2 class="text-xl font-semibold">Buat Pengaduan Baru</h2>
                <p class="text-sm">Laporkan tindak kriminal yang Anda temui.</p>
            </div>
        </a>
        <a href="{{ route('masyarakat.pengaduan.index') }}" class="block p-6 bg-blue-700 text-black rounded-lg shadow-md hover:bg-gray-800 transition-colors duration-300 ease-in-out text-center">
            <div class="flex flex-col items-center justify-center h-full">
                <svg class="w-6 h-6 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                <h2 class="text-xl font-semibold">Lihat Riwayat Pengaduan</h2>
                <p class="text-sm">Pantau status semua pengaduan yang telah Anda buat.</p>
            </div>
        </a>
    </div>

    <div class="p-6 bg-blue-50 border-l-4 border-blue-500 text-blue-700 rounded-md shadow">
        <div class="flex">
            <div class="py-1">
                <svg class="fill-current h-6 w-6 text-black-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg>
            </div>
            <div>
                <p class="font-bold">Tips Keamanan:</p>
                <ul class="list-disc list-inside text-sm">
                    <li>Selalu waspada terhadap lingkungan sekitar Anda.</li>
                    <li>Jika melihat sesuatu yang mencurigakan, segera laporkan kepada pihak berwajib.</li>
                    <li>Pastikan informasi yang Anda berikan dalam pengaduan akurat dan jelas.</li>
                </ul>
            </div>
        </div>
    </div>

</div>
@endsection