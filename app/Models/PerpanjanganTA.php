<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PerpanjanganTA extends Model
{
    use HasFactory;

    protected $table = 'perpanjangan_ta';
    protected $primaryKey = 'id_perpanjangan_ta';
}
