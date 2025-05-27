<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembimbing extends Model
{
    use HasFactory;

    protected $table = 'pembimbing';
<<<<<<< HEAD

=======
    
>>>>>>> b37f191 (Siap upload ke repo AfnanYusuf01/sinta)
    protected $fillable = [
        'id_mahasiswa',
        'id_dosen',
        'status',
        'jenis_pembimbing' // 1 untuk pembimbing 1, 2 untuk pembimbing 2
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
