<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class MahasiswaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        DB::beginTransaction();
        try {
            // Create user
            $user = User::create([
                'name' => $row['nama'],
                'email' => $row['email'],
                'password' => Hash::make($row['password']),
                'role' => 'mahasiswa'
            ]);

            // Create mahasiswa
            $mahasiswa = Mahasiswa::create([
                'user_id' => $user->id,
                'nama' => $row['nama'],
                'nim' => $row['nim'],
                'prodi' => $row['prodi'],
                'angkatan' => $row['angkatan']
            ]);

            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}