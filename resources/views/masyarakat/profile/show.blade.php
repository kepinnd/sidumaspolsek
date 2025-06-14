@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="bg-white shadow-lg rounded-lg p-4 sm:p-6 md:p-8">
    {{-- Header Halaman --}}
    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4 mb-6 pb-4 border-b border-gray-200">
        <div class="flex items-center gap-4">
             {{-- Avatar --}}
            <img class="h-20 w-20 rounded-full border-2 border-indigo-500 p-1" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&size=128&background=eef2ff&color=4f46e5" alt="{{ Auth::user()->name }}">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Profil Saya</h1>
                <p class="mt-1 text-gray-600">Berikut adalah data diri Anda yang terdaftar di sistem.</p>
            </div>
        </div>
        <div>
            {{-- === TOMBOL UBAH PASSWORD DITAMBAHKAN DI SINI === --}}
            <a href="{{ route('masyarakat.profile.editPassword') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 whitespace-nowrap">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a4 4 0 11-8 0 4 4 0 018 0zM12 15s-2 1-4 1-4-1-4-1V6a4 4 0 014-4h4a4 4 0 014 4v9z"></path></svg>
                Ubah Password
            </a>
        </div>
    </div>

    {{-- Pesan Sukses (setelah berhasil update password) --}}
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r-md" role="alert">
            <p class="font-bold">Sukses</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    {{-- Detail Data Diri --}}
    <div class="space-y-6">
        <h2 class="text-xl font-semibold text-gray-700">Data Pribadi</h2>

        {{-- Grid untuk menampilkan data --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6 text-sm">
            {{-- Nama Lengkap --}}
            <div>
                <strong class="text-gray-500 block">Nama Lengkap</strong>
                <p class="text-gray-800 text-base mt-1">{{ $user->name }}</p>
            </div>

            {{-- Email --}}
            <div>
                <strong class="text-gray-500 block">Alamat Email</strong>
                <p class="text-gray-800 text-base mt-1">{{ $user->email }}</p>
            </div>

            {{-- NIK --}}
            <div>
                <strong class="text-gray-500 block">NIK (Nomor Induk Kependudukan)</strong>
                <p class="text-gray-800 text-base mt-1">{{ $user->nik }}</p>
            </div>

            {{-- Nomor Telepon --}}
            <div>
                <strong class="text-gray-500 block">Nomor Telepon</strong>
                <p class="text-gray-800 text-base mt-1">{{ $user->no_telp }}</p>
            </div>

            {{-- Alamat --}}
            <div class="md:col-span-2">
                <strong class="text-gray-500 block">Alamat Lengkap</strong>
                <p class="text-gray-800 text-base mt-1">{{ $user->alamat }}</p>
            </div>

             {{-- Tanggal Bergabung --}}
            <div class="md:col-span-2">
                <strong class="text-gray-500 block">Tanggal Akun Dibuat</strong>
                <p class="text-gray-800 text-base mt-1">{{ $user->created_at->translatedFormat('l, d F Y') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
