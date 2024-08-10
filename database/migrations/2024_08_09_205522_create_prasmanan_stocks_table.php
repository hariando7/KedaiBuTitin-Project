<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('prasmanan_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_menu');
            $table->integer('stok_menu');
            $table->date('tanggal_ditambahkan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prasmanan_stocks');
    }
};
