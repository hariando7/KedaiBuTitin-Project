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

        // Append this attribute to the model's array form
        protected $appends = ['jumlah_pesanan'];

        // Define an accessor for 'jumlah_pesanan'
        public function getJumlahPesananAttribute()
        {
            return Order::where('menu_id', $this->menu_id)->sum('jumlah_pesanan');
        }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
