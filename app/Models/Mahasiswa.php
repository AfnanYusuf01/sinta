<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';

    protected $fillable = [
        'user_id',
        'nim',
        'nama',
        'program_studi',
        'angkatan',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tugasAkhir()
    {
        return $this->hasOne(TugasAkhir::class, 'id_mahasiswa');
    }

    public function pembimbing()
    {
        return $this->hasMany(Pembimbing::class, 'id_mahasiswa');
    }

    public function dosenPembimbing()
    {
        return $this->belongsToMany(Dosen::class, 'pembimbing', 'id_mahasiswa', 'id_dosen')
                    ->withPivot('status', 'jenis_pembimbing');
    }

    public function penguji()
    {
        return $this->belongsTo(Dosen::class, 'penguji');
    }

    public function deskEvaluasi()
    {
        return $this->hasMany(DeskEvaluasi::class, 'id_mahasiswa');
    }

public function usulanPembimbing()
{
    return $this->hasMany(UsulDospem::class, 'id_mahasiswa');
}

    public function nilaiBimbingan()
    {
        return $this->hasMany(NilaiBimbingan::class, 'id_mahasiswa');
    }

    public function nilaiDe()
    {
        return $this->hasMany(NilaiDe::class, 'id_mahasiswa');
    }
}
