<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogBimbingan extends Model
{
    use HasFactory;

    protected $table = 'log_bimbingan';
    protected $fillable = ['id_user', 'id_dosen', 'catatan', 'tanggal', 'nilai'];

    /**
     * Relasi ke tabel dosen
     */
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen');
    }

    /**
     * Relasi ke tabel user
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}