@extends('layouts.app')

@section('title', 'Ubah Password')

@section('content')
<div class="bg-white shadow-lg rounded-lg p-4 sm:p-6 md:p-8">
    {{-- Header Halaman --}}
    <div class="mb-6 pb-4 border-b border-gray-200">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Ubah Password</h1>
        <p class="mt-1 text-gray-600">Untuk keamanan, jangan bagikan password Anda kepada siapa pun.</p>
    </div>

    <div class="max-w-2xl">
        <form method="POST" action="{{ route('masyarakat.profile.updatePassword') }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Password Saat Ini -->
            <div>
                <label for="current_password" class="block text-sm font-medium text-gray-700">
                    Password Saat Ini <span class="text-red-500">*</span>
                </label>
                <div class="mt-1">
                    <input type="password" name="current_password" id="current_password"
                           class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('current_password') border-red-500 @enderror"
                           required>
                </div>
                @error('current_password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Baru -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">
                    Password Baru <span class="text-red-500">*</span>
                </label>
                <div class="mt-1">
                    <input type="password" name="password" id="password"
                           class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('password') border-red-500 @enderror"
                           required>
                </div>
                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Konfirmasi Password Baru -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                    Konfirmasi Password Baru <span class="text-red-500">*</span>
                </label>
                <div class="mt-1">
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                           required>
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="pt-5 flex justify-end gap-3">
                <a href="{{ route('masyarakat.profile') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Batal
                </a>
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Update Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
