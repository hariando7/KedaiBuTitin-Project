<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = ['nama_menu', 'jenis_menu', 'catatan_menu'];

    public function stock()
    {
        return $this->hasOne(Stock::class, 'menu_id');
    }
}
