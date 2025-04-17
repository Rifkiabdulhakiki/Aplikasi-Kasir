<?php

namespace App\Http\Controllers;

use App\pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = pelanggan::orderBy('created_at', 'desc');
    
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('Nama_Pelanggan', 'like', "%$search%");
        }
    
        $pelanggans = $query->paginate(7);
    
        return view('pelanggan.index', compact('pelanggans'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        return view('pelanggan.create');
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'Nama_pelanggan' => 'required',
            'Alamat' => 'required',
            'Nomor_telepon' => 'required',
        ]);
        pelanggan::create($request->all());
        return redirect()->route('pelanggan.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\pelanggan  $pelanggans
     * @return \Illuminate\Http\Response
     */
    public function show(pelanggan $pelanggans)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\pelanggan  $pelanggans
     * @return \Illuminate\Http\Response
     */
    public function edit($pelanggan)
    {
        $pelanggans = pelanggan::findOrFail($pelanggan);
        return view('pelanggan.edit', compact('pelanggans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\pelanggan  $pelanggans
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $PelangganID)
    {
        $request->validate([
         'Nama_pelanggan' => 'required',
            'Alamat' => 'required',
            'Nomor_telepon' => 'required',
    ]);
    $pelanggans = pelanggan::findOrFail($PelangganID);
    $pelanggans->update($request->all());
    return redirect()->route('pelanggan.index')->with('success', 'Kategori berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\pelanggan  $pelanggans
     * @return \Illuminate\Http\Response
     */
    public function destroy($PelangganID)
    {
       $pelanggans = pelanggan::findOrFail($PelangganID);
       $pelanggans->delete();
        return redirect()->route('pelanggan.index')->with('success', 'kategori berhasil dihapus.');
    }
}
