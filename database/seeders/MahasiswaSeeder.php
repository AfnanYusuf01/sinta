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
        for ($i = 1; $i <= 10; $i++) {
    $email = 'mahasiswa' . $i . '@example.com';

    // Cek apakah user sudah ada
    if (User::where('email', $email)->exists()) {
        continue;
    }

    $user = User::create([
        'name' => 'Mahasiswa ' . $i,
        'email' => $email,
        'password' => Hash::make('password123'),
    ]);
    $user->assignRole('mahasiswa');

    Mahasiswa::create([
        'user_id' => $user->id,
        'nim' => '12345' . str_pad($i, 3, '0', STR_PAD_LEFT),
        'jurusan' => 'Informatika',
        'nama' => $user->name,
        'email' => $user->email,
        'sks' => rand(110, 144),
        'ipk' => round(mt_rand(250, 400) / 100, 2),
        'nomor_telepon' => '08' . rand(1000000000, 9999999999),
        'tak' => 'TAK-' . rand(1000, 9999),
        'nomor_orang_tua' => '08' . rand(1000000000, 9999999999),
        'sertifikat' => 'sertifikat_' . $i . '.pdf',
    ]);
}

    }
}
