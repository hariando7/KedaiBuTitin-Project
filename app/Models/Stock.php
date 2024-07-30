<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $fillable = [
        'menu_id',
        'jumlah_stok',
        'reset_date',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
