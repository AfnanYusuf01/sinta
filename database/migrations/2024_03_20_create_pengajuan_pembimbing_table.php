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
        Schema::create('pengajuan_pembimbing', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_mahasiswa')->constrained('users');
            $table->foreignId('id_dosen')->constrained('users');
            $table->string('judul_ta');
            $table->text('deskripsi');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_pembimbing');
    }
}; 