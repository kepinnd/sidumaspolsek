@extends('layouts.app') {{-- Sesuaikan jika nama layout Anda berbeda --}}

@section('title', 'Edit Pengguna')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Edit Pengguna: {{ $user->name }}</h1>

    <div class="bg-white shadow-md rounded-lg px-8 pt-6 pb-8 mb-4">
        <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Nama Lengkap <span class="text-red-500">*</span>
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror"
                       id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required autofocus>
                @error('name')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Alamat Email <span class="text-red-500">*</span>
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror"
                       id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password Baru (Opsional)
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror"
                       id="password" type="password" name="password">
                <p class="text-xs text-gray-600">Kosongkan jika tidak ingin mengubah password.</p>
                @error('password')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password_confirmation">
                    Konfirmasi Password Baru
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                       id="password_confirmation" type="password" name="password_confirmation">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="role">
                    Role <span class="text-red-500">*</span>
                </label>
                <select id="role" name="role" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('role') border-red-500 @enderror">
                    <option value="">Pilih Role</option>
                    <option value="kapolsek" {{ old('role', $user->role) == 'kapolsek' ? 'selected' : '' }}>Kapolsek</option>
                    <option value="petugas_spkt" {{ old('role', $user->role) == 'petugas_spkt' ? 'selected' : '' }}>Petugas SPKT</option>
                    <option value="masyarakat" {{ old('role', $user->role) == 'masyarakat' ? 'selected' : '' }}>Masyarakat</option>
                </select>
                @error('role')
                    <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div id="masyarakat_fields" style="display: none;"> {{-- Default ke none, JS akan handle --}}
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="nik">
                        NIK (Nomor Induk Kependudukan) <span id="nik_required_star" class="text-red-500" style="display: none;">*</span> {{-- Default ke none --}}
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nik') border-red-500 @enderror"
                           id="nik" type="text" name="nik" value="{{ old('nik', $user->nik) }}">
                    @error('nik')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="alamat">
                        Alamat Lengkap <span id="alamat_required_star" class="text-red-500" style="display: none;">*</span> {{-- Default ke none --}}
                    </label>
                    <textarea id="alamat" name="alamat" rows="3"
                              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('alamat') border-red-500 @enderror">{{ old('alamat', $user->alamat) }}</textarea>
                    @error('alamat')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="no_telp">
                        Nomor Telepon <span id="no_telp_required_star" class="text-red-500" style="display: none;">*</span> {{-- Default ke none --}}
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('no_telp') border-red-500 @enderror"
                           id="no_telp" type="text" name="no_telp" value="{{ old('no_telp', $user->no_telp) }}">
                    @error('no_telp')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center justify-between mt-6">
                <button class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Update Pengguna
                </button>
                <a href="{{ route('admin.users.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const roleSelect = document.getElementById('role');
        const masyarakatFields = document.getElementById('masyarakat_fields');
        const nikInput = document.getElementById('nik');
        const alamatInput = document.getElementById('alamat');
        const noTelpInput = document.getElementById('no_telp');
        const nikRequiredStar = document.getElementById('nik_required_star');
        const alamatRequiredStar = document.getElementById('alamat_required_star');
        const noTelpRequiredStar = document.getElementById('no_telp_required_star');

        function toggleMasyarakatFields() {
            const isMasyarakat = roleSelect.value === 'masyarakat';
            masyarakatFields.style.display = isMasyarakat ? 'block' : 'none';
            nikInput.required = isMasyarakat;
            alamatInput.required = isMasyarakat;
            noTelpInput.required = isMasyarakat;
            nikRequiredStar.style.display = isMasyarakat ? 'inline' : 'none';
            alamatRequiredStar.style.display = isMasyarakat ? 'inline' : 'none';
            noTelpRequiredStar.style.display = isMasyarakat ? 'inline' : 'none';
        }

        roleSelect.addEventListener('change', toggleMasyarakatFields);
        // Panggil saat load untuk menangani old('role') atau $user->role
        toggleMasyarakatFields();
    });
</script>
@endsection