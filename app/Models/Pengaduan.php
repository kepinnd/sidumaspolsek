<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan'; // Eksplisit mendefinisikan nama tabel

    protected $fillable = [
        'masyarakat_id',
        'tgl_pengaduan',
        'judul_laporan',
        'isi_laporan',
        'lokasi_kejadian',
        'foto_bukti',
        'status',
        'tanggapan',
        'petugas_id',
    ];

    protected $casts = [
        'tgl_pengaduan' => 'date',
    ];

    public function masyarakat()
    {
        return $this->belongsTo(User::class, 'masyarakat_id');
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }
}