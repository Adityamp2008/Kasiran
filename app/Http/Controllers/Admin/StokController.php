<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Product = Product::with('kategori')->get();
        return view('pages.admin.stok.index', compact('Product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
{
    $Product = Product::with('supplier')->findOrFail($id);
    return view('pages.admin.stok.edit', compact('Product'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'penyesuaian' => 'required|in:tambah,kurang',
        'jumlah' => 'required|integer|min:1',
        'lokasi' => 'nullable|string|max:255',
    ]);

    $product = Product::findOrFail($id);

    // Proses penyesuaian stok
    if ($request->penyesuaian === 'tambah') {
        $product->stok += $request->jumlah;
    } elseif ($request->penyesuaian === 'kurang') {
        $product->stok -= $request->jumlah;
        if ($product->stok < 0) {
            $product->stok = 0; // biar stok nggak minus
        }
    }

    // Update lokasi (kalau ada input)
    if ($request->has('lokasi')) {
        $product->lokasi = $request->lokasi;
    }

    $product->save();

    return redirect()->route('Stok.index')->with('success', 'Stok berhasil disesuaikan!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
