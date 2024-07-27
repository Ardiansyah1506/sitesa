<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TA extends Model
{
    use HasFactory;
    protected $table = "ta";
    protected $fillable = [
        'id', 'kode_ta', 'nim', 'nama_file', 'tanggal', 'status', 'nota_pembimbing'
    ];
}
