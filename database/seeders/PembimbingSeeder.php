<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Pembimbing;
use App\Models\UsulDospem;

class PembimbingSeeder extends Seeder
{
    public function run(): void
    {
        // Get all mahasiswa
        $mahasiswas = Mahasiswa::all();

        // Get all dosen
        $dosens = Dosen::all();

        // Assign pembimbing for each mahasiswa
        foreach ($mahasiswas as $index => $mahasiswa) {
            // Assign first dosen as pembimbing 1
            $pembimbing1 = $dosens[$index % count($dosens)];

            // Assign next dosen as pembimbing 2
            $pembimbing2 = $dosens[($index + 1) % count($dosens)];

            // Create usulan pembimbing
            UsulDospem::create([
                'judul_ta' => 'Judul TA Mahasiswa ' . $mahasiswa->nama,
                'id_mahasiswa' => $mahasiswa->id,
                'id_dosen_1' => $pembimbing1->id,
                'id_dosen_2' => $pembimbing2->id,
                'status' => 'diterima'
            ]);

            // Create pembimbing 1
            Pembimbing::create([
                'id_mahasiswa' => $mahasiswa->id,
                'id_dosen' => $pembimbing1->id,
                'status' => 'aktif',
                'jenis_pembimbing' => '1'
            ]);

            // Create pembimbing 2
            Pembimbing::create([
                'id_mahasiswa' => $mahasiswa->id,
                'id_dosen' => $pembimbing2->id,
                'status' => 'aktif',
                'jenis_pembimbing' => '2'
            ]);
        }
    }
}