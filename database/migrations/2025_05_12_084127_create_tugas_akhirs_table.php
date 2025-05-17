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
        Schema::create('tugas_akhir', function (Blueprint $table) {
            $table->id('id_tugas_akhir');
            $table->string('judul_tugas_akhir')->nullable();
            $table->string('doc_usulan')->nullable();
            $table->foreignId('id_dosen')->nullable()->constrained('dosen')->onDelete('cascade');
            $table->foreignId('id_mahasiswa')->nullable()->constrained('mahasiswa')->onDelete('cascade');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas_akhirs');
    }
};
