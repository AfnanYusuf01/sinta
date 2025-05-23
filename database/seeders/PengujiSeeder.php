<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penguji;
use App\Models\Dosen;
use App\Models\Mahasiswa;

class PengujiSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua dosen dan mahasiswa yang ada
        $dosen = Dosen::first();
        $mahasiswas = Mahasiswa::all();

        if ($dosen && $mahasiswas->count() > 0) {
            foreach ($mahasiswas as $mahasiswa) {
                // Buat data penguji
                Penguji::create([
                    'id_mahasiswa' => $mahasiswa->id,
                    'id_dosen' => $dosen->id,
                    'status' => 'aktif',
                    'jenis_penguji' => '1' // 1 untuk ketua penguji
                ]);
            }
        }
    }
}