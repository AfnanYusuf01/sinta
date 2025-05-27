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
        'catatan',
        'total_nilai'
    ];

    protected $casts = [
        'total_nilai' => 'float',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->total_nilai = $model->nilai_penyajian + 
                                $model->nilai_tingkat_penguasaan + 
                                $model->nilai_kualitas_jawaban + 
                                $model->nilai_sikap;
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
