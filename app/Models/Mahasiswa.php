<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = "mahasiswa";

    protected $fillable = [
        'nim', 'nama', 'prodi', 'jk', 'alamat', 'email', 'no_hp', 'tanggal_lahir', 'tempat_lahir', 'status'
    ];
}
