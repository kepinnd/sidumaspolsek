<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('masyarakat_id'); // FK ke tabel users (masyarakat)
            $table->date('tgl_pengaduan');
            $table->string('judul_laporan');
            $table->text('isi_laporan');
            $table->string('lokasi_kejadian');
            $table->string('foto_bukti')->nullable(); // Path ke file foto
            $table->enum('status', ['pending', 'diterima', 'ditolak', 'diproses', 'selesai'])->default('pending');
            $table->text('tanggapan')->nullable(); // Tanggapan dari petugas
            $table->unsignedBigInteger('petugas_id')->nullable(); // FK ke tabel users (petugas_spkt yang menanggapi)
            $table->timestamps();

            $table->foreign('masyarakat_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('petugas_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaduan');  
    }
};
