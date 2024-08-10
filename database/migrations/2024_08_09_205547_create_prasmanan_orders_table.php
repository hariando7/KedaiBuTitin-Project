<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrasmananOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('prasmanan_orders', function (Blueprint $table) {
            $table->id();
            $table->json('items'); // Menyimpan daftar item sebagai JSON
            $table->datetime('tanggal_pesanan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('prasmanan_orders');
    }
}
