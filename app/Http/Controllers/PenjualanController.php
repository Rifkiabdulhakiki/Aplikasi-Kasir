<?php

namespace App\Http\Controllers;

use App\penjualan;
use App\pelanggan;
use App\produk;
use App\DetailPenjualan;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index(Request $request)
{
    $query = Penjualan::orderBy('created_at', 'desc');

    if ($request->has('search')) {
        $search = $request->search;
    
        $query->where(function ($query) use ($search) {
            $query->whereHas('pelanggans', function ($q) use ($search) {
                $q->where('Nama_Pelanggan', 'like', "%$search%");
            })
            ->orWhere('Total_Harga', 'like', "%$search%")
            ->orWhere('Kode_Transaksi', 'like', "%$search%");
        });
    }
    

    $penjualans = $query->paginate(7);
    $produks = Produk::all();
    $pelanggans = Pelanggan::all();

    return view('penjualans.index', compact('penjualans', 'pelanggans', 'produks'));
}



    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produks = produk::all();
        $pelanggans = pelanggan::all();
        return view('penjualans.create', compact('pelanggans', 'produks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function print($id)
{
    // Memuat penjualan beserta detail_penjualans dan produks (produk melalui detail_penjualans)
    $penjualan = penjualan::with(['detail_penjualans.produk', 'pelanggans'])->findOrFail($id);

    return view('penjualans.print', compact('penjualan'));
}



public function store(Request $request)
{
    $request->validate([
        'Tanggal_Penjualan' => 'nullable|date',
        'Total_Harga' => 'required|numeric|min:1|max:999999999999.99',
        'PelangganID' => 'nullable|exists:pelanggans,PelangganID',
        'produk' => 'required|array|min:1',
        'produk.*.ProdukID' => 'required|exists:produks,ProdukID',
        'produk.*.Jumlah_produk' => 'required|integer|min:1',
        'produk.*.Subtotal' => 'required|numeric',
    ], [
        'produk.required' => 'Tolong pilih produk.',
        'produk.min' => 'Tolong pilih produk.',
        'produk.*.ProdukID.required' => 'Produk harus dipilih.',
        'produk.*.Jumlah_produk.required' => 'Jumlah produk harus diisi.',
        'produk.*.Subtotal.required' => 'Subtotal harus diisi.',
    ]);

    DB::beginTransaction();

    try {
        $errorMessages = [];
        $stokProduk = [];

        foreach ($request->produk as $produk) {
            $produkData = produk::findOrFail($produk['ProdukID']);
            if (!isset($stokProduk[$produk['ProdukID']])) {
                $stokProduk[$produk['ProdukID']] = $produkData->Stok;
            }

            if ($produk['Jumlah_produk'] > $stokProduk[$produk['ProdukID']]) {
                $errorMessages[] = "Stok tidak cukup untuk {$produkData->Nama_Produk}.";
            } else {
                $stokProduk[$produk['ProdukID']] -= $produk['Jumlah_produk'];
            }
        }

        if (!empty($errorMessages)) {
            return redirect()->back()->with('error', implode('<br>', $errorMessages));
        }

        $penjualan = penjualan::create([
            'Tanggal_Penjualan' => $request->Tanggal_Penjualan ?: now(),
            'Total_Harga' => $request->Total_Harga,
            'PelangganID' => $request->PelangganID,
        ]);

        foreach ($request->produk as $produk) {
            $produkData = produk::findOrFail($produk['ProdukID']);
            $produkData->Stok -= $produk['Jumlah_produk'];
            $produkData->save();

            DetailPenjualan::create([
                'PenjualanID' => $penjualan->PenjualanID,
                'ProdukID' => $produk['ProdukID'],
                'Jumlah_produk' => $produk['Jumlah_produk'],
                'Subtotal' => $produk['Subtotal'],
            ]);
        }

        DB::commit();
        return redirect()->route('penjualans.index')->with('success', 'Penjualan berhasil ditambahkan.');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}



    /**
     * Display the specified resource.
     *
     * @param  \App\penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function show(penjualan $penjualans)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     // $produks = produk::all();
    //     // $pelanggans = pelanggan::all();
    //     // $penjualans = penjualan::findOrFail($id); // Cari berdasarkan ID
    //     // return view('penjualans.edit', compact('pelanggans' ,'penjualans', 'produks'));
    // }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */

// public function update(Request $request, $PenjualanID)
// {
//     $request->validate([
//         'Tanggal_Penjualan' => 'required',
//         'Total_Harga' => 'required',
//         'PelangganID' => 'nullable|exists:pelanggans,PelangganID',
//         'ProdukID'  => 'required|exists:produks,ProdukID',
//         'Jumlah_produk' => 'required|integer|min:1',
//         'Subtotal' => 'required',
//     ]);

//     $penjualan = penjualan::findOrFail($PenjualanID);
//     $produk = produk::findOrFail($request->ProdukID);

//     // Kembalikan stok lama sebelum diubah
//     $produk->Stok += $penjualan->Jumlah_produk;

//     // Cek apakah stok mencukupi untuk perubahan
//     if ($request->Jumlah_produk > $produk->Stok) {
//         return redirect()->back()->with('error', 'Jumlah melebihi batas stok yang tersedia.');
//     }

//     if ($produk->Stok == 0) {
//         return redirect()->back()->with('error', 'Stok habis.');
//     }

//     // Kurangi stok sesuai jumlah baru
//     $produk->Stok -= $request->Jumlah_produk;
//     $produk->save();

//     // Update data penjualan
//     $penjualan->update($request->all());

//     return redirect()->route('penjualans.index')->with('success', 'Detail Penjualan berhasil diperbarui.');
// }







    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function destroy(penjualan $penjualans)
    {
        $penjualans->delete();  
        return redirect()->route('penjualans.index')->with('success', 'Produk berhasil dihapus.');
    }
}
