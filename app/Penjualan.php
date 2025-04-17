<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $table = 'penjualans';
    protected $primaryKey = 'PenjualanID';
    protected $fillable = [
       'Tanggal_Penjualan',
       'Total_Harga',
       'PelangganID',
    ];

    public function pelanggans()
    {
        return $this->belongsTo(Pelanggan::class, 'PelangganID', 'PelangganID')
            ->withDefault([
                'Nama_Pelanggan' => 'Pelanggan Tidak Diketahui'
            ]);
    }
    
    
    public function detail_penjualans()
    {
        return $this->hasMany('App\DetailPenjualan', 'PenjualanID');
    }


    protected static function boot()
    {
        parent::boot();
        static::creating(function ($penjualan) {
            do {
                // Format Kode Transaksi: TRX-YYYYMMDD-XXXX (4 digit acak)
                $kode = 'TRX-' . date('Ymd') . '-' . rand(1000, 9999);
            } while (self::where('Kode_Transaksi', $kode)->exists());

            $penjualan->Kode_Transaksi = $kode;
        });
    }

public function produks()
{
    return $this->belongsToMany(produk::class, 'detail_penjualans', 'PenjualanID', 'ProdukID')
        ->withPivot('Jumlah_produk', 'Subtotal');
}

}
