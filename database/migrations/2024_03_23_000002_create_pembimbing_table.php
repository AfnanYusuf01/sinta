<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembimbingTable extends Migration
{
    public function up()
    {
        Schema::create('pembimbing', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_mahasiswa')->constrained('mahasiswa')->onDelete('cascade');
            $table->foreignId('id_dosen')->constrained('dosen')->onDelete('cascade');
            $table->string('status')->default('aktif');
            $table->enum('jenis_pembimbing', ['1', '2'])->comment('1: Pembimbing 1, 2: Pembimbing 2');
            $table->timestamps();

            // Ensure unique combination of mahasiswa, dosen, and jenis_pembimbing
            $table->unique(['id_mahasiswa', 'id_dosen', 'jenis_pembimbing']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('pembimbing');
    }
} 