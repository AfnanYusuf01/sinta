<?php
namespace Database\Seeders;
use App\Models\User;
use App\Models\Dosen;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DosenSeeder extends Seeder
{
    public function run(): void
    {
        // Create 3 dosen
        for ($i = 1; $i <= 3; $i++) {
            // Create user first
            $user = User::create([
                'name' => "Dosen $i",
                'email' => "dosen$i@example.com",
                'password' => bcrypt('password'),
                'role' => 'dosen'
            ]);

            // Create dosen record
            Dosen::create([
                'user_id' => $user->id,
                'nama' => "Dosen $i",
                'nip' => "987654" . str_pad($i, 3, '0', STR_PAD_LEFT),
                'program_studi' => 'Teknik Informatika'
            ]);
        }

        $this->command->info('3 dosen created successfully.');
    }
}
