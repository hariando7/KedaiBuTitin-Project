<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrasmananStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_menu',
        'stok_menu',
        'tanggal_ditambahkan',
    ];
}
