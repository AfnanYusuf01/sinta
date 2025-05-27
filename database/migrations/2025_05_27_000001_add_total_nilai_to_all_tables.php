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
        // Tambah kolom total_nilai ke tabel nilai_literatur jika belum ada
        if (!Schema::hasColumn('nilai_literatur', 'total_nilai')) {
            Schema::table('nilai_literatur', function (Blueprint $table) {
                $table->float('total_nilai')->nullable()->after('nilai_kesimpulan');
            });
        }

        // Tambah kolom total_nilai ke tabel nilai_presentasi jika belum ada
        if (!Schema::hasColumn('nilai_presentasi', 'total_nilai')) {
            Schema::table('nilai_presentasi', function (Blueprint $table) {
                $table->float('total_nilai')->nullable()->after('nilai_sikap');
            });
        }

        // Tambah kolom total_nilai ke tabel nilai_bimbingan jika belum ada
        if (!Schema::hasColumn('nilai_bimbingan', 'total_nilai')) {
            Schema::table('nilai_bimbingan', function (Blueprint $table) {
                $table->float('total_nilai')->nullable()->after('nilai_7');
            });
        }

        // Tambah kolom total_nilai ke tabel nilai_de jika belum ada
        if (!Schema::hasColumn('nilai_de', 'total_nilai')) {
            Schema::table('nilai_de', function (Blueprint $table) {
                $table->float('total_nilai')->nullable()->after('nilai_7');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus kolom total_nilai dari semua tabel jika ada
        if (Schema::hasColumn('nilai_literatur', 'total_nilai')) {
            Schema::table('nilai_literatur', function (Blueprint $table) {
                $table->dropColumn('total_nilai');
            });
        }

        if (Schema::hasColumn('nilai_presentasi', 'total_nilai')) {
            Schema::table('nilai_presentasi', function (Blueprint $table) {
                $table->dropColumn('total_nilai');
            });
        }

        if (Schema::hasColumn('nilai_bimbingan', 'total_nilai')) {
            Schema::table('nilai_bimbingan', function (Blueprint $table) {
                $table->dropColumn('total_nilai');
            });
        }

        if (Schema::hasColumn('nilai_de', 'total_nilai')) {
            Schema::table('nilai_de', function (Blueprint $table) {
                $table->dropColumn('total_nilai');
            });
        }
    }
}; 