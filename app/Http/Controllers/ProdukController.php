<?php

namespace App\Http\Controllers;

use App\produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    $query = produk::orderBy('created_at', 'desc');

    if ($request->has('search')) {
        $search = $request->search;
        $query->where('Nama_Produk', 'like', "%$search%");
    }

    $produks = $query->paginate(7);

    return view('produks.index', compact('produks'));
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $validated = $request->validate([
                'Nama_Produk' => 'required',
                'Harga' => 'required',
                'Stok' => 'required',
                'Deskripsi' => 'nullable',
                'Gambar' => 'required|image|mimes:jpeg,png,jpg,gif', 
            ]);

            if ($request->hasFile('Gambar')) {
                $path = $request->file('Gambar')->store('produk', 'public');
                $validated['Gambar'] = $path;
            }
    
            produk::create($validated);
    
            return redirect()->route('produks.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(produk $produk)
    {
  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit(produk $produk)
    {
        return view('produks.edit', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, produk $produk)
    {
        $validated = $request->validate([
            'Nama_Produk' => 'required',
            'Harga' => 'required',
            'Stok' => 'required',
            'Deskripsi' => 'nullable',
            'Gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);
        
    
            if ($request->hasFile('Gambar')) {
                $path = $request->file('Gambar')->store('produk', 'public');
                $validated['Gambar'] = $path;
            }
    

            $produk->update($validated);
    
            return redirect()->route('produks.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(produk $produk)
    {
            $produk->delete();  
            return redirect()->route('produks.index')->with('success', 'Produk berhasil dihapus.');
    }
}
