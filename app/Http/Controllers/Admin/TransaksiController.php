<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaksi;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    // Tampilkan semua transaksi + form tambah
    public function index()
    {
        $transaksi = Transaksi::with('product.supplier')->latest()->get();
        $product   = Product::with('supplier')->get();
        $supplier  = Supplier::all();
        return view('pages.admin.transaksi.index', compact('transaksi', 'product', 'supplier'));
    }

    // Simpan transaksi baru
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:product,id',
            'jumlah'     => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request) {
            $product = Product::findOrFail($request->product_id);

    if ($product->stok < $request->jumlah) {
        return redirect()->back()
            ->withErrors(['jumlah' => '⚠️ Stok tidak mencukupi. Stok tersedia: ' . $product->stok])
            ->withInput();
    }


            $product->decrement('stok', $request->jumlah);

            Transaksi::create([
                'product_id' => $product->id,
                'jumlah'     => $request->jumlah,
                'total'      => $product->harga_jual * $request->jumlah,
            ]);
        });

        return redirect()->route('Transaksi.index')->with('success', 'Transaksi berhasil disimpan.');
    }

    // Form edit transaksi
    public function edit(string $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        return view('pages.admin.transaksi.edit', compact('transaksi'));
    }

    // Update transaksi
    public function update(Request $request, string $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        // Kembalikan stok lama
        $transaksi->product->increment('stok', $transaksi->jumlah);

        // Update jumlah & total
        $transaksi->update([
            'jumlah' => $request->jumlah,
            'total'  => $transaksi->product->harga_jual * $request->jumlah,
        ]);

        // Kurangi stok baru
        $transaksi->product->decrement('stok', $request->jumlah);

        return redirect()->route('Transaksi.index')->with('success', 'Transaksi berhasil diupdate.');
    }

    // Hapus transaksi
    public function destroy(string $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->product->increment('stok', $transaksi->jumlah);
        $transaksi->delete();

        return redirect()->route('Transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
