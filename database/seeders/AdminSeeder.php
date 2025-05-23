<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Dosen;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        // Create dosen record for admin
        Dosen::create([
            'user_id' => $user->id,
            'nama' => 'Admin',
            'nip' => '123456789',
            'program_studi' => 'Teknik Informatika'
        ]);

        $this->command->info('Admin user created successfully.');
    }
} 