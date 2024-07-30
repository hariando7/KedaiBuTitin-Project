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
        'catatan_pesanan'
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function getTotalHargaAttribute()
    {
        return $this->menu->harga_menu * $this->jumlah_pesanan;
    }
}
