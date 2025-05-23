<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pembimbing;
use App\Models\Dosen;
use App\Models\Mahasiswa;

class PembimbingSeeder extends Seeder
{
    public function run()
    {
        // Ambil semua dosen dan mahasiswa
        $dosens = Dosen::all();
        $mahasiswas = Mahasiswa::all();

        // Untuk setiap mahasiswa, assign satu dosen pembimbing
        foreach ($mahasiswas as $index => $mahasiswa) {
            // Gunakan modulo untuk memastikan setiap dosen mendapat mahasiswa bimbingan
            $dosen = $dosens[$index % count($dosens)];
            
            Pembimbing::create([
                'id_mahasiswa' => $mahasiswa->id,
                'id_dosen' => $dosen->id,
                'status' => 'aktif',
                'jenis_pembimbing' => '1'
            ]);
        }
    }
} 