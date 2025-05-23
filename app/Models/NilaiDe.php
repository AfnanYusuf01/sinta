<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NilaiDe extends Model
{
    use HasFactory;

    protected $table = 'nilai_de';
    
    protected $fillable = [
        'id_mahasiswa',
        'id_dosen',
        'nilai_1',
        'nilai_2',
        'nilai_3',
        'nilai_4',
        'total'
    ];

    protected $casts = [
        'total' => 'float',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen');
    }
}

