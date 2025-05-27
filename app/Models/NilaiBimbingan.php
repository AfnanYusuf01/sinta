<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NilaiBimbingan extends Model
{
    use HasFactory;

    protected $table = 'nilai_bimbingan';
    
    protected $fillable = [
        'id_mahasiswa',
        'id_dosen',
        'nilai_1',
        'nilai_2',
        'nilai_3',
        'nilai_4',
        'nilai_5',
        'nilai_6',
        'nilai_7',
        'total_nilai'
    ];

    protected $casts = [
        'total_nilai' => 'float',
    ];



    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->total_nilai = $model->nilai_1 + 
                                $model->nilai_2 + 
                                $model->nilai_3 + 
                                $model->nilai_4 + 
                                $model->nilai_5 + 
                                $model->nilai_6 + 
                                $model->nilai_7;
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

