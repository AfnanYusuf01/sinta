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
        Schema::create('usul_dospems', function (Blueprint $table) {
            $table->id();
            $table->string('judul_ta')->nullable();
            $table->foreignId('id_mahasiswa')->nullable()->constrained('mahasiswa')->onDelete('cascade');
            $table->foreignId('id_dosen_1')->nullable()->constrained('dosen')->onDelete('cascade');
            $table->foreignId('id_dosen_2')->nullable()->constrained('dosen')->onDelete('cascade');
            $table->enum('status', ['menunggu', 'diterima', 'ditolak'])->default('menunggu')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usul_dospems');
    }
};
