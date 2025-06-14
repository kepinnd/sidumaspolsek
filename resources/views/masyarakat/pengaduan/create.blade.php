@extends('layouts.app') {{-- Menggunakan layout utama dengan sidebar --}}

@section('title', 'Buat Pengaduan Baru')

@section('content')
<div class="bg-white shadow-lg rounded-lg p-4 sm:p-6 md:p-8">
    {{-- Header Halaman --}}
    <div class="flex flex-col sm:flex-row justify-between sm:items-center mb-6 pb-4 border-b border-gray-200">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Formulir Pengaduan</h1>
            <p class="mt-1 text-gray-600">Silakan isi detail pengaduan Anda di bawah ini.</p>
        </div>
        <a href="{{ url()->previous('dashboard') }}" class="mt-4 sm:mt-0 text-sm bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-md inline-block text-center whitespace-nowrap">
            &larr; Kembali
        </a>
    </div>

    <form action="{{ route('masyarakat.pengaduan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Judul Laporan --}}
        <div>
            <label for="judul_laporan" class="block text-sm font-medium text-gray-700">
                Judul Laporan <span class="text-red-500">*</span>
            </label>
            <div class="mt-1">
                <input type="text" name="judul_laporan" id="judul_laporan"
                       class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('judul_laporan') border-red-500 @enderror"
                       value="{{ old('judul_laporan') }}"
                       placeholder="Contoh: Pencurian di Jalan Merdeka"
                       required>
            </div>
            @error('judul_laporan')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Lokasi Kejadian --}}
        <div>
            <label for="lokasi_kejadian" class="block text-sm font-medium text-gray-700">
                Lokasi Kejadian <span class="text-red-500">*</span>
            </label>
            <div class="mt-1">
                <input type="text" name="lokasi_kejadian" id="lokasi_kejadian"
                       class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('lokasi_kejadian') border-red-500 @enderror"
                       value="{{ old('lokasi_kejadian') }}"
                       placeholder="Contoh: Depan Toko ABC, Jalan Merdeka No. 10"
                       required>
            </div>
             @error('lokasi_kejadian')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Isi Laporan --}}
        <div>
            <label for="isi_laporan" class="block text-sm font-medium text-gray-700">
                Isi Laporan / Uraian Kejadian <span class="text-red-500">*</span>
            </label>
            <div class="mt-1">
                <textarea id="isi_laporan" name="isi_laporan" rows="8"
                          class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('isi_laporan') border-red-500 @enderror"
                          placeholder="Jelaskan kronologi kejadian secara detail..."
                          required>{{ old('isi_laporan') }}</textarea>
            </div>
            @error('isi_laporan')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Foto Bukti --}}
        <div x-data="{ photoName: null, photoPreview: null }">
            <label class="block text-sm font-medium text-gray-700">Foto Bukti (Opsional)</label>
            <div class="mt-1 flex items-center space-x-4">
                {{-- Preview Gambar --}}
                <div class="shrink-0">
                    <img x-show="photoPreview" :src="photoPreview" class="h-20 w-20 rounded-md object-cover" alt="Image Preview">
                    <span x-show="!photoPreview" class="flex items-center justify-center h-20 w-20 bg-gray-100 text-gray-300 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    </span>
                </div>
                {{-- Tombol dan Input File --}}
                <div class="block">
                     <input type="file" name="foto_bukti" id="foto_bukti" class="hidden"
                           x-ref="photo"
                           @change="
                                photoName = $refs.photo.files[0].name;
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    photoPreview = e.target.result;
                                };
                                reader.readAsDataURL($refs.photo.files[0]);
                           "
                           accept="image/*">
                    <button type="button" x-on:click.prevent="$refs.photo.click()" class="py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Pilih Foto
                    </button>
                    <div x-show="photoName" class="text-sm text-gray-500 mt-1" x-text="photoName"></div>
                </div>
            </div>
             @error('foto_bukti')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tombol Aksi --}}
        <div class="pt-5 border-t border-gray-200">
            <div class="flex justify-end gap-3">
                <a href="{{ route('masyarakat.dashboard') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Batal
                </a>
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Kirim Pengaduan
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
