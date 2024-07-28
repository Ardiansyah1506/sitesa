<?php

namespace App\Models\Prodi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuota extends Model
{
    use HasFactory;

    protected $table = 'ref_kuota';
    protected $guarded = ['id'];
}
