<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'menu_id',
        'jumlah_pesanan',
        'harga_pesanan',
        'catatan_pesanan'
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

}
