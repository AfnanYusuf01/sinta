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
        Schema::table('nilai_literatur', function (Blueprint $table) {
            // Hapus kolom nilai_kesimpulan
            $table->dropColumn('nilai_kesimpulan');

            // Tambah kolom baru
            $table->float('nilai_metodologi')->after('nilai_sintesis');
            $table->float('nilai_penulisan')->after('nilai_metodologi');
            $table->float('nilai_referensi')->after('nilai_penulisan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nilai_literatur', function (Blueprint $table) {
            // Hapus kolom baru
            $table->dropColumn(['nilai_metodologi', 'nilai_penulisan', 'nilai_referensi']);

            // Kembalikan kolom lama
            $table->float('nilai_kesimpulan')->after('nilai_sintesis');
        });
    }
};
