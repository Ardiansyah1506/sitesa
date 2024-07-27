<?php

namespace App\Models\Dosbim;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tesis extends Model
{
    use HasFactory;

    protected $table = 'tesis';
    protected $guarded = ['id'];
}
