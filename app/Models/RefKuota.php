<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefKuota extends Model
{
    use HasFactory;

    protected $table = 'ref_kuota';
    protected $guarded = ['id'];
}
