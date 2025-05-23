<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NilaiLiteratur extends Model
{
    use HasFactory;

    protected $table = 'nilai_literatur';

    protected $fillable = [
        'id_mahasiswa',
        'id_dosen',
        'nilai_pemahaman',
        'nilai_analisis',
        'nilai_sintesis',
        'nilai_kesimpulan',
        'catatan'
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
