<?php

namespace App; 


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pelanggan extends Model
{
    protected $table = 'pelanggans';
    protected $primaryKey = 'PelangganID';
    public $timestamps = true; 

    protected $fillable = [
       'Nama_pelanggan',
       'Alamat',
       'Nomor_telepon',
    //    'Kode_Unik'
    ];

    // protected static function boot()
    // {
    //     parent::boot();
    //     static::creating(function ($pelanggan) {
    //         do {
    //             $kode = strtoupper(Str::random(8)); //acak 8 karakter
    //         } while (self::where('Kode_Unik', $kode)->exists());

    //         $pelanggan->Kode_Unik = $kode;
    //     });
    // }

  
    public function penjualans()
    {
        return $this->hasMany('App\penjualan', 'PelangganID'); 
    }
}
