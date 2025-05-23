<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penguji', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_mahasiswa')->constrained('mahasiswa')->onDelete('cascade');
            $table->foreignId('id_dosen')->constrained('dosen')->onDelete('cascade');
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->enum('jenis_penguji', ['1', '2'])->comment('1: Ketua Penguji, 2: Anggota Penguji');
            $table->timestamps();

            // Memastikan satu dosen hanya bisa menjadi satu jenis penguji untuk satu mahasiswa
            $table->unique(['id_mahasiswa', 'id_dosen']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penguji');
    }
};