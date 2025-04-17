<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    protected $table = 'detail_penjualans';
    protected $primaryKey = 'DetailPenjualanID';
    protected $fillable = [
        'PenjualanID',
        'ProdukID',
        'Jumlah_produk',
        'Subtotal',
    ];

      // Relasi ke Penjualan
      public function penjualan()
      {
          return $this->belongsTo('App\penjualan', 'PenjualanID');
      }

    public function produk()
    {
        return $this->belongsTo('App\produk', 'ProdukID');
    }
}
