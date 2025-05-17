<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tugasAkhir()
    {
        return $this->hasMany(TugasAkhir::class, 'id_dosen');
    }

    public function logBimbingan()
    {
        return $this->hasMany(LogBimbingan::class, 'id_dosen');
    }

    public function deskEvaluasi()
    {
        return $this->hasMany(DeskEvaluasi::class, 'id_dosen');
    }

    public function mahasiswaPembimbing()
    {
        return $this->hasMany(Mahasiswa::class, 'pembimbing');
    }

    public function mahasiswaPenguji()
    {
        return $this->hasMany(Mahasiswa::class, 'penguji');
    }

    // Tambahkan method ini
public function usulanPembimbing1()
{
    return $this->hasMany(UsulDospem::class, 'id_dosen_1');
}

public function usulanPembimbing2()
{
    return $this->hasMany(UsulDospem::class, 'id_dosen_2');
}
}
