@extends('layouts.app') {{-- Menggunakan layout utama dengan sidebar --}}

@section('title', 'Riwayat Pengaduan Saya')

@section('content')
    {{-- Header Halaman --}}
    <div class="flex flex-col sm:flex-row justify-between sm:items-center mb-6 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-300">Riwayat Pengaduan Saya</h1>
            <p class="mt-1 text-gray-300">Pantau semua pengaduan yang telah Anda buat di sini.</p>
        </div>
        <a href="{{ route('masyarakat.pengaduan.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 whitespace-nowrap">
            Buat Pengaduan Baru
        </a>
    </div>

    {{-- Daftar Pengaduan --}}
    <div class="bg-white shadow-lg rounded-lg overflow-hidden"> {{-- Div ini sudah benar dengan rounded-lg dan overflow-hidden --}}
        {{-- Tampilan Tabel untuk Desktop (Terlihat di layar medium ke atas) --}}
        <div class="hidden md:block">
            <table class="min-w-full"> {{-- Dihapus: leading-normal --}}
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tanggal Pengaduan</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Judul Laporan</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($pengaduan as $key => $item)
                    <tr>
                        {{-- Perubahan: Dihapus 'bg-white' dari setiap <td> --}}
                        <td class="px-5 py-4 text-sm text-gray-700">{{ $pengaduan->firstItem() + $key }}</td>
                        <td class="px-5 py-4 text-sm text-gray-700">{{ $item->tgl_pengaduan->translatedFormat('d M Y, H:i') }}</td>
                        <td class="px-5 py-4 text-sm text-gray-900 font-medium">{{ Str::limit($item->judul_laporan, 50) }}</td>
                        <td class="px-5 py-4 text-sm text-center">
                            <span class="px-3 py-1 font-semibold text-xs leading-tight rounded-full
                                @if($item->status == 'pending') bg-yellow-200 text-yellow-900
                                @elseif($item->status == 'diterima') bg-blue-200 text-blue-900
                                @elseif($item->status == 'diproses') bg-indigo-200 text-indigo-900
                                @elseif($item->status == 'selesai') bg-green-200 text-green-900
                                @elseif($item->status == 'ditolak') bg-red-200 text-red-900
                                @endif">
                                {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-sm">
                            <a href="{{ route('masyarakat.pengaduan.show', $item->id) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold">
                                Lihat Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-5 py-10 text-center text-gray-500">
                            Anda belum memiliki riwayat pengaduan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Tampilan Kartu untuk Mobile (Terlihat di layar kecil, tersembunyi di medium ke atas) --}}
        <div class="block md:hidden">
            <div class="divide-y divide-gray-200">
                @forelse ($pengaduan as $item)
                <div class="p-4">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <p class="text-sm text-gray-500">{{ $item->tgl_pengaduan->translatedFormat('d M Y, H:i') }}</p>
                            <p class="font-semibold text-gray-800 mt-1">{{ $item->judul_laporan }}</p>
                        </div>
                        <div class="ml-4">
                             <span class="px-3 py-1 font-semibold text-xs leading-tight rounded-full
                                @if($item->status == 'pending') bg-yellow-200 text-yellow-900
                                @elseif($item->status == 'diterima') bg-blue-200 text-blue-900
                                @elseif($item->status == 'diproses') bg-indigo-200 text-indigo-900
                                @elseif($item->status == 'selesai') bg-green-200 text-green-900
                                @elseif($item->status == 'ditolak') bg-red-200 text-red-900
                                @endif">
                                {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                            </span>
                        </div>
                    </div>
                    <div class="mt-4 text-right">
                        <a href="{{ route('masyarakat.pengaduan.show', $item->id) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold text-sm">
                            Lihat Detail &rarr;
                        </a>
                    </div>
                </div>
                @empty
                <div class="p-10 text-center text-gray-500">
                    Anda belum memiliki riwayat pengaduan.
                </div>
                @endforelse
            </div>
        </div>

        {{-- Paginasi --}}
        @if($pengaduan->hasPages())
        <div class="px-4 py-4 bg-gray-50 border-t border-gray-200">
            {{ $pengaduan->links() }}
        </div>
        @endif
    </div>
@endsection
