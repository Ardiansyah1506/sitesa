<?php

namespace App\Models\Dosbim;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bimbingan extends Model
{
    use HasFactory;
    protected $table = 'mhs_bimbingan_ta';
    protected $guarded = ['id'];
}
