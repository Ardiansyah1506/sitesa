<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TanggalTA extends Model
{
    use HasFactory;

    protected $table = 'berita_acara';
    protected $fillable = ['nama','gelombang', 'tanggal_awal','tanggal_akhir'];
}
