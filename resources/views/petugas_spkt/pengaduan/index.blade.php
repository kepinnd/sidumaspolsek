@extends('layouts.app') {{-- Sesuaikan jika nama layout Anda berbeda --}}

@section('title', 'Daftar Pengaduan Masuk')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-semibold text-gray-200 mb-6">Daftar Pengaduan Masuk</h1>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <div class="mb-6 bg-white shadow-md rounded-lg p-4">
        <form method="GET" action="{{ route('petugas.pengaduan.index') }}">
            <div class="flex flex-col md:flex-row md:items-end md:space-x-4 space-y-2 md:space-y-0">
                <div class="flex-grow">
                    <label for="status_filter" class="block text-sm font-medium text-gray-700">Filter berdasarkan Status:</label>
                    <select id="status_filter" name="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md shadow-sm">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                        <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <div class="flex-shrink-0">
                    <button type="submit" class="w-full md:w-auto inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-black bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Filter
                    </button>
                </div>
                 @if(request('status'))
                <div class="flex-shrink-0">
                    <a href="{{ route('petugas.pengaduan.index') }}" class="w-full md:w-auto inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-black-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Reset Filter
                    </a>
                </div>
                @endif
            </div>
        </form>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        No
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Tgl Pengaduan
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Judul Laporan
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Pelapor
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Status
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @if($pengaduan->isEmpty())
                    <tr>
                        <td colspan="6" class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center text-gray-500">
                            Tidak ada data pengaduan yang cocok dengan filter Anda, atau belum ada pengaduan.
                        </td>
                    </tr>
                @else
                    @foreach ($pengaduan as $key => $item)
                    <tr>
                        <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">
                            {{ $pengaduan->firstItem() + $key }}
                        </td>
                        <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $item->tgl_pengaduan->translatedFormat('d M Y, H:i') }}</p>
                        </td>
                        <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ Str::limit($item->judul_laporan, 40) }}</p>
                        </td>
                        <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $item->masyarakat->name ?? 'N/A' }}</p>
                        </td>
                        <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm text-center">
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
                        <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">
                            <a href="{{ route('petugas.pengaduan.show', $item->id) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold">
                                Lihat Detail / Tindak Lanjut
                            </a>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        @if(!$pengaduan->isEmpty())
        <div class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
            <span class="text-xs xs:text-sm text-gray-900">
                Menampilkan {{ $pengaduan->firstItem() }} sampai {{ $pengaduan->lastItem() }} dari {{ $pengaduan->total() }} data
            </span>
            <div class="inline-flex mt-2 xs:mt-0">
                {{ $pengaduan->appends(request()->query())->links() }} {{-- appends(request()->query()) untuk menjaga filter saat paginasi --}}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection