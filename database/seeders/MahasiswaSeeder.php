<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Support\Str;

class MahasiswaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['21102082', 'ANANDA FIKRI SATRIYO HASTOMO', 'S1IF-09-C'],
            ['21102131', 'FAHREZI AMRI SYAFIQ', 'S1IF-09-D'],
            ['21102138', 'MUHAMMAD SINDHU SATRIA PERDANA', 'S1IF-09-D'],
            ['21102152', 'HAIKAL TRIGUNADI', 'S1IF-09-D'],
            ['21102154', 'CAHYA NOVAL RIADY', 'S1IF-09-E'],
            ['21102175', 'MUHAMAD TAFRIHAN AMANULOH', 'S1IF-09-E'],
            ['21102193', 'HAFIZ ALFITO AZIZ', 'S1IF-09-F'],
            ['21102205', 'ANANDA MUHAMMAD RAIHAN', 'S1IF-09-F'],
            ['21102216', 'ZAYAN ZULFA SANJIVANI', 'S1IF-09-F'],
            ['21102267', 'HAFIDZ ZAKI AMRULLOH', 'S1IF-09-H'],
            ['21102281', 'RAFLI TRI SAPUTRA', 'S1IF-09-H'],
            ['21102290', 'BINTANG KUSUMA ARDANA', 'S1IF-09-H'],
            ['21102294', 'MUHAMAD HAFIDH', 'S1IF-09-H'],
            ['21102295', 'SITI ROQAYAH', 'S1IF-09-H'],
            ['21102028', 'GALUH AMELIA PUTRI', 'S1IF-09-A'],
            ['21102084', 'JESTIN REYNARD POLIN SITORUS', 'S1IF-09-C'],
            ['21102194', 'ALFA YUDHA NUGRAHA', 'S1IF-09-F'],
            ['21102259', 'MAULANA RYAN ZAKLI', 'S1IF-09-G'],
            ['21102017', 'RIZKY SURYA PRATAMA', 'S1IF-09-A'],
            ['21102032', 'SYAHRIAL FEBRIAN RAHARDJO', 'S1IF-09-A'],
            ['21102055', 'IKA THOL\'ATUN KHASANAH', 'S1IF-09-B'],
            ['21102086', 'HENDRAWAN NUR MAJID', 'S1IF-09-C'],
            ['21102204', 'MURSYIDAH AMALIAH RIDWAN', 'S1IF-09-F'],
            ['21102261', 'HADI SUPRIYANTO', 'S1IF-09-G'],
            ['21102300', 'SULTAN ARROSE SURYADITYA', 'S1IF-09-H'],
            ['21102311', 'INDRA SAPUTRA', 'S1IF-09-H'],
        ];

        foreach ($data as [$nim, $nama, $kelas]) {
            $email = $nim . '@ittelkom-pwt.ac.id';

            // Buat user
            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => $nama,
                    'email_verified_at' => now(),
                    'password' => Hash::make($nim),
                    'remember_token' => Str::random(10),
                ]
            );

            // Buat mahasiswa
            Mahasiswa::firstOrCreate(
                ['nim' => $nim],
                [
                    'nama' => $nama,
                    'kelas' => $kelas, // <- Tambahkan ini
                    'prodi' => 'S1 Informatika',
                    'fakultas' => 'Informatika',
                    'angkatan' => 2000 + intval(substr($nim, 0, 2)),
                    'user_id' => $user->id,
                ]
            );
        }
    }
}
