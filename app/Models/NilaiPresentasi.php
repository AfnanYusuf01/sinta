<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiPresentasi extends Model
{
    protected $table = 'nilai_presentasi';
    protected $fillable = ['id_mahasiswa', 'id_dosen', 'nilai_1', 'nilai_2', 'nilai_3', 'nilai_4', 'nilai_5', 'nilai_6', 'total'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen');
    }
}
