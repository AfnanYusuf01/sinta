<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranProposal extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran_proposals'; // <--- Ini wajib!

    protected $fillable = [
        'judul_ta',
        'id_mahasiswa',
        'abstrak',
        'status',
        'id_dosen_1', 
        'id_dosen_2',
    ];

    // Contoh relasi (opsional)
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
