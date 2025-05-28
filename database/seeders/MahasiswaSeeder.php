<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Mahasiswa;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        // Create some default mahasiswa accounts
        $mahasiswa_data = [
            [
                'name' => 'Andi Pratama',
                'email' => 'andi.pratama@mahasiswa.com',
                'nim' => '2024010001',
                'program_studi' => 'Teknik Informatika',
                'angkatan' => '2024',
            ],
            [
                'name' => 'Dewi Lestari',
                'email' => 'dewi.lestari@mahasiswa.com',
                'nim' => '2024010002',
                'program_studi' => 'Teknik Informatika',
                'angkatan' => '2024',
            ],
            [
                'name' => 'Fajar Ramadhan',
                'email' => 'fajar.ramadhan@mahasiswa.com',
                'nim' => '2024010003',
                'program_studi' => 'Teknik Informatika',
                'angkatan' => '2024',
            ],
        ];

        foreach ($mahasiswa_data as $data) {
            // Create user account
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make('password'),
                'role' => 'mahasiswa', // Default role
            ]);

            // Create mahasiswa profile
            Mahasiswa::create([
                'user_id' => $user->id,
                'name' => $data['name'],
                'nim' => $data['nim'],
                'program_studi' => $data['program_studi'],
                'angkatan' => $data['angkatan'],
            ]);
        }

        $this->command->info('5 mahasiswa created successfully.');
    }
}
