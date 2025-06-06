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
        'nilai_metodologi',
        'nilai_penulisan',
        'nilai_referensi',
        'total_nilai',
        'catatan'
    ];

    protected $casts = [
        'total_nilai' => 'float'
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->total_nilai = $model->nilai_pemahaman +
                                $model->nilai_analisis +
                                $model->nilai_sintesis +
                                $model->nilai_metodologi +
                                $model->nilai_penulisan +
                                $model->nilai_referensi;
        });
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen');
    }
}
