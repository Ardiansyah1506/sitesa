<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefSks extends Model
{
    use HasFactory;

    protected $table = 'ref_sks';
    protected $guarded = ['id'];
}
