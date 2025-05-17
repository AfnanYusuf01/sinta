<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeskEvaluasi extends Model
{
    use HasFactory;

    protected $table = 'desk_evaluasi';
    protected $primaryKey = 'id_desk_evaluasi';
        protected $fillable = [
        'file',
        'judul_ta',
        'nilai',
        'id_mahasiswa',
        'id_dosen',
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
