<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
 protected $table = 'produks';
 protected $primaryKey ='ProdukID';
 protected $fillable = [
    'Nama_Produk',
    'Harga',
    'Stok',
    'Deskripsi',
    'Gambar',
];

public function penjualans()
{
    return $this->hasMany('App\penjualan','PenjualanID');
}
}
