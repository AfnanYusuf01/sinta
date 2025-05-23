<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nilai_de', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_mahasiswa')->constrained('mahasiswa')->onDelete('cascade');
            $table->foreignId('id_dosen')->constrained('dosen')->onDelete('cascade');
            $table->integer('nilai_1'); // Orisinalitas (0-100)
            $table->integer('nilai_2'); // Kebaruan/Novelty (0-100)
            $table->integer('nilai_3'); // Urgensi Penelitian (0-100)
            $table->integer('nilai_4'); // Metodologi (0-100)
            $table->integer('nilai_5'); // Tinjauan Pustaka (0-100)
            $table->integer('nilai_6'); // Kontribusi Penelitian (0-100)
            $table->integer('nilai_7'); // Kelayakan Tim Peneliti (0-100)
            $table->float('total_nilai');
            $table->timestamps();

            // Memastikan satu dosen hanya bisa memberi satu nilai untuk satu mahasiswa
            $table->unique(['id_mahasiswa', 'id_dosen']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilai_de');
    }
};