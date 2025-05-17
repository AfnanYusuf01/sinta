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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->string('nim')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('nama')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->unsignedBigInteger('pembimbing')->nullable();
            $table->unsignedBigInteger('penguji')->nullable();
            $table->string('email')->nullable();
            $table->integer('sks')->nullable();
            $table->float('ipk')->nullable();
            $table->string('nomor_telepon')->nullable();
            $table->string('tak')->nullable();
            $table->string('nomor_orang_tua')->nullable();
            $table->string('sertifikat')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
