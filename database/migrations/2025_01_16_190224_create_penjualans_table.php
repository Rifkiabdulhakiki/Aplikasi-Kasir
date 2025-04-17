<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualans', function (Blueprint $table) {
            $table->bigIncrements('PenjualanID');
            $table->date('Tanggal_Penjualan');
            $table->decimal('Total_Harga', 15, 2);
            $table->unsignedBigInteger('PelangganID')->nullable();  // Pastikan menggunakan unsigned
            $table->string('Kode_Transaksi')->unique();
            $table->timestamps();
        
            // Menambahkan foreign key
            $table->foreign('PelangganID')->references('PelangganID')->on('pelanggans')->onDelete('set null');
        });
    }
    
     
    
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penjualans');
    }
}
