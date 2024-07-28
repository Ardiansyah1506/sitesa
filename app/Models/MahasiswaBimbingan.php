<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaBimbingan extends Model
{
    use HasFactory;

    protected $table = 'mhs_bimbingan_ta';
    protected $guarded = ['id'];
}
