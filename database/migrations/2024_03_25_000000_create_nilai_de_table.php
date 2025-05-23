<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('nilai_de', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_mahasiswa')->constrained('mahasiswa')->onDelete('cascade');
            $table->foreignId('id_dosen')->constrained('dosen')->onDelete('cascade');
            $table->integer('nilai_1')->comment('Penguasaan Dasar Teori');
            $table->integer('nilai_2')->comment('Tingkat Penguasaan Materi');
            $table->integer('nilai_3')->comment('Tinjauan Pustaka');
            $table->integer('nilai_4')->comment('Kontribusi');
            $table->float('total')->nullable();
            $table->timestamps();

            // Ensure one student can only be graded once by a specific dosen
            $table->unique(['id_mahasiswa', 'id_dosen']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('nilai_de');
    }
}; 