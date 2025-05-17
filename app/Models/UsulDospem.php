<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsulDospem extends Model
{
    use HasFactory;

    protected $table = 'usul_dospems';
    protected $fillable = ['judul_ta', 'id_mahasiswa', 'id_dosen_1', 'id_dosen_2', 'status'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }

    public function dosen1()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen_1');
    }

    public function dosen2()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen_2');
    }
}