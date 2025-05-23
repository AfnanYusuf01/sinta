<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TotalNilai extends Model
{
    protected $table = 'total_nilai';
    protected $fillable = ['id_mahasiswa', 'total'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }
}
