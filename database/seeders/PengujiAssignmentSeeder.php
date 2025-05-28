<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PengujiAssignment;
use App\Models\Mahasiswa;
use App\Models\Dosen;

class PengujiAssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all mahasiswa and dosen
        $mahasiswas = Mahasiswa::all();
        $dosens = Dosen::all();

        // Assign a random dosen as penguji for each mahasiswa
        foreach ($mahasiswas as $mahasiswa) {
            // Randomly select a dosen that isn't already assigned as pembimbing
            $dosen = $dosens->random();

            PengujiAssignment::create([
                'mahasiswa_id' => $mahasiswa->id,
                'dosen_id' => $dosen->id,
                'status' => 'aktif'
            ]);
        }
    }
}
