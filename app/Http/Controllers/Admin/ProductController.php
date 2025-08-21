<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Product = Product::with('kategori')->latest()->get();
        return view('pages.admin.product.index', compact('Product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $kategori = Kategori::all();
    return view('pages.admin.product.create', compact('kategori'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:Kategori,id',
            'nama_produk' => 'required|string|max:255',
            'harga_beli'  => 'required|numeric|min:0',
            'harga_jual'  => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
            'stok_minimal'=> 'required|integer|min:0',
        ]);

        Product::create($request->all());

        return redirect()->route('Product.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $Product)
    {
        $kategori = Kategori::all();
        return view('pages.admin.product.edit', compact('Product', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $Product)
    {
        $request->validate([
            'kategori_id' => 'required|exists:Kategori,id',
            'nama_produk' => 'required|string|max:255',
            'harga_beli'  => 'required|numeric|min:0',
            'harga_jual'  => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
            'stok_minimal'=> 'required|integer|min:0',
        ]);

        $Product->update($request->all());

        return redirect()->route('Product.index')->with('success', 'Produk berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $Product)
    {
        $Product->delete();

        return redirect()->route('Product.index')->with('success', 'Produk berhasil dihapus.');
    }
}
