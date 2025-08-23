<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Kategori;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Product = Product::with(['kategori','supplier'])->latest()->get();
        return view('pages.admin.product.index', compact('Product'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::all();
        $supplier = Supplier::all();
        return view('pages.admin.product.create', compact('kategori', 'supplier'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori_id'  => 'required|exists:kategori,id',
            'supplier_id'  => 'required|exists:supplier,id',
            'harga_beli'   => 'required|numeric|min:0',
            'harga_jual'   => 'required|numeric|min:0',
            'stok'         => 'required|integer|min:0',
            'stok_minimal' => 'required|integer|min:0',
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
        $supplier = Supplier::all();
        return view('pages.admin.product.edit', compact('Product', 'kategori', 'supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'kategori_id'  => 'required|exists:kategori,id',
            'supplier_id'  => 'required|exists:supplier,id',
            'harga_beli'   => 'required|numeric|min:0',
            'harga_jual'   => 'required|numeric|min:0',
            'stok'         => 'required|integer|min:0',
            'stok_minimal' => 'required|integer|min:0',
        ]);

        $product->update($request->all());

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
