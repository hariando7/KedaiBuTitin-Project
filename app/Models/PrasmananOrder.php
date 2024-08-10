<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PrasmananOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'items',
        'tanggal_pesanan',
        'total_harga',
    ];

    protected $casts = [
        'items' => 'array', // Mengonversi JSON ke array
    ];

    public function getTotalHargaAttribute()
    {
        $totalHarga = 0;

        foreach (json_decode($this->items) as $item) {
            $totalHarga += $item->quantity * $item->harga_menu;
        }

        return $totalHarga;
    }

    public function getTanggalPesananAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('Y-m-d H:i'); // Format yang sama dengan format input
    }
    
    public function setTanggalPesananAttribute($value)
    {
        $this->attributes['tanggal_pesanan'] = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $value)->format('Y-m-d H:i:s');
    }
}
