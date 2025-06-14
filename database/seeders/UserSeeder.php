<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin Polsek',
            'email' => 'admin@polsek.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Kapolsek
        User::create([
            'name' => 'Kapolsek Contoh',
            'email' => 'kapolsek@polsek.com',
            'password' => Hash::make('password'),
            'role' => 'kapolsek',
        ]);

        // Petugas SPKT
        User::create([
            'name' => 'Petugas SPKT 1',
            'email' => 'spkt1@polsek.com',
            'password' => Hash::make('password'),
            'role' => 'petugas_spkt',
            'nik' => '1234567890123451', // Contoh NIK
            'nrp' => '100200300',
            'alamat' => 'Jl. Polisi No. 1',
            'no_telp' => '081234567891'
        ]);

        // Contoh Masyarakat (opsional, bisa registrasi mandiri)
        User::create([
            'name' => 'Warga Contoh',
            'email' => 'warga@contoh.com',
            'password' => Hash::make('password'),
            'role' => 'masyarakat',
            'nik' => '0987654321098765',
            'alamat' => 'Jl. Warga No. 10',
            'no_telp' => '089876543210'
        ]);
    }

}
