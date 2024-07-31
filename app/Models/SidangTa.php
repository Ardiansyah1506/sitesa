<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SidangTa extends Model
{
    use HasFactory;
    protected $table = 'penguji';
    protected $guarded = ['id'];
}
