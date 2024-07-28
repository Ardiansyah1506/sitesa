<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefPembayaran extends Model
{
    use HasFactory;

    protected $table = 'ref_pembayaran';

    protected $guarded = 'id';
}
