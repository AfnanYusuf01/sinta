<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        $adminUser = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        // Create dosen users
        $dosenUsers = [
            [
                'name' => 'Dr. Budi Santoso',
                'email' => 'budi@dosen.com',
                'password' => Hash::make('password'),
                'role' => 'dosen'
            ],
            [
                'name' => 'Dr. Siti Rahayu',
                'email' => 'siti@dosen.com',
                'password' => Hash::make('password'),
                'role' => 'dosen'
            ],
            [
                'name' => 'Dr. Ahmad Wijaya',
                'email' => 'ahmad@dosen.com',
                'password' => Hash::make('password'),
                'role' => 'dosen'
            ]
        ];

        foreach ($dosenUsers as $dosenData) {
            $user = User::create($dosenData);
            Dosen::create([
                'user_id' => $user->id,
                'nama' => $user->name,
                'nip' => 'NIP' . rand(100000, 999999),
                'program_studi' => 'Informatika',
                'bidang_keahlian' => 'Rekayasa Perangkat Lunak'
            ]);
        }

        // Create mahasiswa users
        $mahasiswaUsers = [
            [
                'name' => 'Andi Pratama',
                'email' => 'andi@mahasiswa.com',
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
                'nim' => '2019001',
                'prodi' => 'Informatika',
                'fakultas' => 'Ilmu Komputer',
                'angkatan' => 2019
            ],
            [
                'name' => 'Dewi Lestari',
                'email' => 'dewi@mahasiswa.com',
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
                'nim' => '2019002',
                'prodi' => 'Informatika',
                'fakultas' => 'Ilmu Komputer',
                'angkatan' => 2019
            ],
            [
                'name' => 'Rizki Ramadhan',
                'email' => 'rizki@mahasiswa.com',
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
                'nim' => '2019003',
                'prodi' => 'Informatika',
                'fakultas' => 'Ilmu Komputer',
                'angkatan' => 2019
            ]
        ];

        foreach ($mahasiswaUsers as $mahasiswaData) {
            $nim = $mahasiswaData['nim'];
            $prodi = $mahasiswaData['prodi'];
            $fakultas = $mahasiswaData['fakultas'];
            $angkatan = $mahasiswaData['angkatan'];
            unset($mahasiswaData['nim'], $mahasiswaData['prodi'], $mahasiswaData['fakultas'], $mahasiswaData['angkatan']);

            $user = User::create($mahasiswaData);
            Mahasiswa::create([
                'user_id' => $user->id,
                'nim' => $nim,
                'nama' => $user->name,
                'prodi' => $prodi,
                'fakultas' => $fakultas,
                'angkatan' => $angkatan
            ]);
        }

        // Seed pembimbing data
        $this->call(PembimbingSeeder::class);

        // Seed penguji assignments
        $this->call(PengujiAssignmentSeeder::class);
    }
}
