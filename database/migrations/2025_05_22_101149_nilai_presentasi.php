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
        Schema::create('nilai_presentasi', function (Blueprint $table) {
    $table->id();
    $table->foreignId('id_mahasiswa')->constrained('mahasiswa');
    $table->foreignId('id_dosen')->constrained('dosen');
    for ($i = 1; $i <= 6; $i++) {
        $table->float("nilai_$i")->nullable();
    }
    $table->float('total')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
