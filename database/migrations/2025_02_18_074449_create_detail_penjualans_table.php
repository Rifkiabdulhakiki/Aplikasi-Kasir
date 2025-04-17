<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPenjualansTable extends Migration
{
    public function up()
    {
        Schema::create('detail_penjualans', function (Blueprint $table) {
            $table->id('DetailPenjualanID');
            $table->unsignedBigInteger('PenjualanID');
            $table->unsignedBigInteger('ProdukID');
            $table->integer('Jumlah_produk');
            $table->decimal('Subtotal', 10, 2);
            $table->timestamps();

            // Foreign Keys
            $table->foreign('PenjualanID')->references('PenjualanID')->on('penjualans')->onDelete('cascade');
            $table->foreign('ProdukID')->references('ProdukID')->on('produks')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_penjualans');
    }
}
