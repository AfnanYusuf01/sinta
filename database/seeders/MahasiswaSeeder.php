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
        // Create 5 mahasiswa
        for ($i = 1; $i <= 5; $i++) {
            // Create user first
            $user = User::create([
                'name' => "Mahasiswa $i",
                'email' => "mahasiswa$i@example.com",
                'password' => bcrypt('password'),
                'role' => 'mahasiswa'
            ]);

            // Create mahasiswa record
            Mahasiswa::create([
                'user_id' => $user->id,
                'nim' => "12345" . str_pad($i, 3, '0', STR_PAD_LEFT),
                'nama' => "Mahasiswa $i",
                'program_studi' => 'Teknik Informatika',
                'angkatan' => '2020',
                'status' => 'aktif'
            ]);
        }

        $this->command->info('5 mahasiswa created successfully.');
    }
}
