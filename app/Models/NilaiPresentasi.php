<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NilaiPresentasi extends Model
{
    use HasFactory;

    protected $table = 'nilai_presentasi';

    protected $fillable = [
        'id_mahasiswa',
        'id_dosen',
        'nilai_penyajian',
        'nilai_tingkat_penguasaan',
        'nilai_kualitas_jawaban',
        'nilai_sikap',
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
