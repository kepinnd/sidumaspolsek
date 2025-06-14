@extends('layouts.app') {{-- Menggunakan layout utama dengan sidebar --}}

@section('title', 'Tindak Lanjut Pengaduan')

@section('content')
<div class="bg-white shadow-lg rounded-lg p-4 sm:p-6 md:p-8">
    {{-- Header Halaman --}}
    <div class="flex flex-col sm:flex-row justify-between sm:items-center mb-6 pb-4 border-b border-gray-200">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Detail & Tindak Lanjut</h1>
            <p class="mt-1 text-gray-600">Pengaduan ID: {{ $pengaduan->id }}</p>
        </div>
        <a href="{{ route('petugas.pengaduan.index') }}" class="mt-4 sm:mt-0 text-sm bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-md inline-block text-center whitespace-nowrap">
            &larr; Kembali ke Daftar Pengaduan
        </a>
    </div>

    @if ($pengaduan)
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Kolom Kiri: Detail Pengaduan --}}
        <div class="lg:col-span-2 space-y-8">
            <!-- Informasi Pelapor -->
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
                </div>
            </div>

            <!-- Detail Laporan -->
            <div>
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Detail Laporan</h2>
                <div class="space-y-5 text-sm">
                    <div>
                        <strong class="text-gray-500 block">Judul Laporan</strong>
                        <p class="text-gray-800 text-lg">{{ $pengaduan->judul_laporan }}</p>
                    </div>
                    <div>
                        <strong class="text-gray-500 block">Tanggal Pengaduan</strong>
                        <p class="text-gray-800">{{ $pengaduan->tgl_pengaduan->translatedFormat('l, d F Y, H:i') }}</p>
                    </div>
                    <div>
                        <strong class="text-gray-500 block">Isi Laporan / Uraian Kejadian</strong>
                        <div class="mt-1 p-3 bg-gray-50 rounded-md border border-gray-200 text-gray-700 whitespace-pre-wrap">
                            {{ $pengaduan->isi_laporan }}
                        </div>
                    </div>
                </div>
            </div>

             <!-- Foto Bukti -->
            @if ($pengaduan->foto_bukti)
            <div>
                <strong class="text-gray-500 block text-sm mb-2">Foto Bukti</strong>
                <a href="{{ Storage::url($pengaduan->foto_bukti) }}" target="_blank" rel="noopener noreferrer" class="inline-block">
                    <img src="{{ Storage::url($pengaduan->foto_bukti) }}" alt="Foto Bukti" class="rounded-lg border border-gray-300 w-full max-w-md h-auto hover:opacity-80 transition-opacity">
                </a>
            </div>
            @endif
        </div>

        {{-- Kolom Kanan: Form Tindak Lanjut --}}
        <div class="lg:col-span-1">
            <div class="bg-gray-50 p-4 sm:p-6 rounded-lg border sticky top-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Form Tindak Lanjut</h2>
                <form action="{{ route('petugas.pengaduan.updateStatus', $pengaduan->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    {{-- Status Saat Ini --}}
                    <div>
                        <p class="text-sm font-medium text-gray-700">Status Saat Ini:</p>
                         <span class="mt-1 px-3 py-1 font-semibold text-xs leading-tight rounded-full
                            @if($pengaduan->status == 'pending') bg-yellow-200 text-yellow-900
                            @elseif($pengaduan->status == 'diterima') bg-blue-200 text-blue-900
                            @elseif($pengaduan->status == 'diproses') bg-indigo-200 text-indigo-900
                            @elseif($pengaduan->status == 'selesai') bg-green-200 text-green-900
                            @elseif($pengaduan->status == 'ditolak') bg-red-200 text-red-900
                            @endif">
                            {{ ucfirst(str_replace('_', ' ', $pengaduan->status)) }}
                        </span>
                    </div>

                    {{-- Ubah Status --}}
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">
                            Ubah Status <span class="text-red-500">*</span>
                        </label>
                        <select id="status" name="status"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                            <option value="diterima" {{ old('status', $pengaduan->status) == 'diterima' ? 'selected' : '' }}>Diterima</option>
                            <option value="diproses" {{ old('status', $pengaduan->status) == 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="selesai" {{ old('status', $pengaduan->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="ditolak" {{ old('status', $pengaduan->status) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                         @error('status')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tanggapan --}}
                    <div>
                        <label for="tanggapan" class="block text-sm font-medium text-gray-700">
                            Tanggapan / Catatan
                        </label>
                        <div class="mt-1">
                            <textarea id="tanggapan" name="tanggapan" rows="6"
                                      class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                      placeholder="Berikan tanggapan atau catatan tindak lanjut. Wajib diisi jika status 'Selesai' atau 'Ditolak'."
                                      >{{ old('tanggapan', $pengaduan->tanggapan) }}</textarea>
                        </div>
                        @error('tanggapan')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="pt-4">
                        <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @else
        <p class="text-red-500 text-center py-10">Data pengaduan tidak ditemukan.</p>
    @endif
</div>
@endsection