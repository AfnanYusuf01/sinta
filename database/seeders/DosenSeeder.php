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
        for ($i = 1; $i <= 10; $i++) {
            $user = User::create([
                'name' => 'Dosen ' . $i,
                'email' => 'dosen' . $i . '@example.com',
                'password' => Hash::make('password123'),
            ]);
            $user->assignRole('dosen');

            Dosen::create([
                'nama' => $user->name,
                'nidn' => 'NIDN' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'email' => $user->email,
                'user_id' => $user->id,
            ]);
        }
    }
}
