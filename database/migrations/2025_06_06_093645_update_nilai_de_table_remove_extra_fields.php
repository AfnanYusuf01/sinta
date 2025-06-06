<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('nilai_de', function (Blueprint $table) {
            // Ubah kolom nilai_5, nilai_6, dan nilai_7 menjadi nullable
            $table->float('nilai_5')->nullable()->change();
            $table->float('nilai_6')->nullable()->change();
            $table->float('nilai_7')->nullable()->change();

            // Set nilai default untuk kolom yang ada
            DB::statement('UPDATE nilai_de SET nilai_5 = NULL, nilai_6 = NULL, nilai_7 = NULL WHERE 1=1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nilai_de', function (Blueprint $table) {
            // Kembalikan kolom ke not null
            $table->float('nilai_5')->nullable(false)->change();
            $table->float('nilai_6')->nullable(false)->change();
            $table->float('nilai_7')->nullable(false)->change();
        });
    }
};
