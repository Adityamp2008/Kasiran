<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Diskon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class TransaksiController extends Controller
{
    /**
     * Menampilkan semua transaksi
     */
    public function index()
    {
        $transaksi = Transaksi::with('details.product.supplier', 'diskon')->latest()->get();
        return view('pages.admin.transaksi.index', compact('transaksi'));
    }

    /**
     * Halaman form buat transaksi baru (multi produk)
     */
    public function create()
    {
        $product = Product::with('supplier')->get();
        $diskon   = Diskon::where('status', 1)->get();
        return view('pages.admin.transaksi.create', compact('product', 'diskon'));
    }

    /**
     * Simpan transaksi baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id.*' => 'required|exists:product,id',
            'jumlah.*'     => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request) {
            $transaksi = Transaksi::create([
                'kode_transaksi' => 'TRX-' . strtoupper(Str::random(6)),
                'total'          => 0,
                'diskon_id'      => null,
            ]);

            // proses semua detail
            $totalTransaksi = $this->prosesDetail($transaksi->id, $request->product_id, $request->jumlah);

            // hitung diskon jika ada
            $this->applyDiskon($transaksi, $totalTransaksi);
        });

        return redirect()->route('Transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    /**
     * Halaman edit transaksi
     */
    public function edit($id)
    {
        $transaksi = Transaksi::with('details.product')->findOrFail($id);
        $product  = Product::with('supplier')->get();
        return view('pages.admin.transaksi.edit', compact('transaksi', 'product'));
    }

    /**
     * Update transaksi
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id.*' => 'required|exists:product,id',
            'jumlah.*'     => 'required|integer|min:1',
        ]);

        $transaksi = Transaksi::with('details.product')->findOrFail($id);

        DB::transaction(function () use ($transaksi, $request) {
            // kembalikan stok lama & hapus detail lama
            foreach ($transaksi->details as $detail) {
                $detail->product->increment('stok', $detail->jumlah);
                $detail->delete();
            }

            // buat detail baru
            $totalTransaksi = $this->prosesDetail($transaksi->id, $request->product_id, $request->jumlah);

            $this->applyDiskon($transaksi, $totalTransaksi);
        });

        return redirect()->route('Transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    /**
     * Hapus transaksi
     */
    public function destroy($id)
    {
        $transaksi = Transaksi::with('details.product')->findOrFail($id);

        DB::transaction(function () use ($transaksi) {
            foreach ($transaksi->details as $detail) {
                $detail->product->increment('stok', $detail->jumlah);
                $detail->delete();
            }
            $transaksi->delete();
        });

        return redirect()->route('Transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }

    /**
     * Print transaksi
     */
    public function print($id)
    {
        $transaksi = Transaksi::with('details.product.supplier', 'diskon')->findOrFail($id);
        return view('pages.admin.transaksi.print', compact('transaksi'));
    }

    /**
     * Helper: proses detail transaksi & update stok
     */
    private function prosesDetail($transaksiId, $productIds, $jumlahArr)
    {
        $total = 0;

        foreach ($productIds as $i => $productId) {
            $product = Product::findOrFail($productId);
            $jumlah  = $jumlahArr[$i];

            if ($product->stok < $jumlah) {
                throw ValidationException::withMessages([
                    'jumlah.' . $i => "Stok produk {$product->nama_product} tidak mencukupi. Stok saat ini: {$product->stok}"
                ]);
            }

            $subtotal = $product->harga_jual * $jumlah;

            TransaksiDetail::create([
                'transaksi_id' => $transaksiId,
                'product_id'   => $product->id,
                'jumlah'       => $jumlah,
                'harga'        => $product->harga_jual,
                'subtotal'     => $subtotal,
            ]);

            $product->decrement('stok', $jumlah);
            $total += $subtotal;
        }

        return $total;
    }

    /**
     * Helper: hitung diskon & update total
     */
    private function applyDiskon($transaksi, $total)
    {
        $diskon = Diskon::where('status', 1)->first();
        $diskonId = null;

        if ($diskon && $total >= ($diskon->min_belanja ?? 0)) {
            $potongan = $diskon->tipe === 'persen'
                ? $total * ($diskon->nilai / 100)
                : $diskon->nilai;

            $total -= $potongan;
            $diskonId = $diskon->id;
        }

        $transaksi->update([
            'total'     => $total,
            'diskon_id' => $diskonId,
        ]);
    }
}
