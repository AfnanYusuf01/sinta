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
        Schema::create('desk_evaluasi', function (Blueprint $table) {
            $table->id('id_desk_evaluasi');
            $table->string('file')->nullable();
            $table->string('judul_ta')->nullable();
            $table->integer('nilai')->nullable();   
            $table->foreignId('id_mahasiswa')->nullable()->constrained('mahasiswa')->onDelete('cascade');
            $table->foreignId('id_dosen')->nullable()->constrained('dosen')->onDelete('cascade');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desk_evaluasis');
    }
};
