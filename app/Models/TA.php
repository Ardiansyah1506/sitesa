<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ta extends Model
{
    use HasFactory;
    protected $table = 'ta';
    protected $guarded = ['id'];
}
