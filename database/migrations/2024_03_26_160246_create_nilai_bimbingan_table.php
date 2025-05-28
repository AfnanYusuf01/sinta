<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('nilai_bimbingan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_mahasiswa')->constrained('mahasiswa')->onDelete('cascade');
            $table->foreignId('id_dosen')->constrained('dosen')->onDelete('cascade');
            $table->integer('nilai_1')->comment('Penguasaan Dasar Teori');
            $table->integer('nilai_2')->comment('Tingkat Penguasaan Materi');
            $table->integer('nilai_3')->comment('Tinjauan Pustaka');
            $table->integer('nilai_4')->comment('Kontribusi Praktis');
            $table->integer('nilai_5')->comment('Kontribusi Teoritis');
            $table->integer('nilai_6')->comment('Teknik Penulisan');
            $table->integer('nilai_7')->comment('Format Penulisan');
            $table->float('total_nilai');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('nilai_bimbingan');
    }
}; 