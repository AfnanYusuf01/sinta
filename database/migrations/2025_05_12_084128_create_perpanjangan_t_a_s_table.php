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
        Schema::create('perpanjangan_ta', function (Blueprint $table) {
            $table->id('id_perpanjangan_ta');
            $table->string('jenis_perpanjangan')->nullable();
            $table->text('alasan_perpanjangan')->nullable();
            $table->text('kendala_pergerjaan_ta')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perpanjangan_t_a_s');
    }
};
