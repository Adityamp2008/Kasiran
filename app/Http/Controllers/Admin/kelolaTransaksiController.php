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

class KelolaTransaksiController extends Controller
{
    // Tampilkan halaman riwayat transaksi
    public function index()
    {
        $transaksi = Transaksi::with('product.supplier', 'details.product.supplier')->latest()->get();
        return view('pages.admin.transaksi.index', compact('transaksi'));
    }

    // Cetak transaksi
    public function print($id)
    {
        $trx = Transaksi::with('product.supplier', 'details.product.supplier')->findOrFail($id);
        return view('pages.admin.transaksi.print', compact('trx'));
    }

    // Tampilkan halaman create multi-transaksi
    public function create()
    {
        $product = Product::with('supplier')->get();
        $diskon   = Diskon::where('status', 1)->get();
        return view('pages.admin.transaksi.create', compact('product', 'diskon'));
    }

    // Simpan transaksi multi-item
    public function store(Request $request)
    {
        $request->validate([
            'product_id.*' => 'required|exists:product,id',
            'jumlah.*'     => 'required|integer|min:1',
        ]);

        $productIds = $request->product_id;
        $jumlahArr  = $request->jumlah;

        DB::transaction(function() use ($productIds, $jumlahArr) {
            // Buat transaksi
            $transaksi = Transaksi::create([
                'kode_transaksi' => 'TRX-' . Str::upper(Str::random(6)),
                'total'          => 0,
                'diskon_id'      => null
            ]);

            $totalTransaksi = 0;

            foreach($productIds as $index => $productId) {
                $product = Product::findOrFail($productId);
                $jumlah  = $jumlahArr[$index];

                if ($product->stok < $jumlah) {
                    throw \Illuminate\Validation\ValidationException::withMessages([
                        'jumlah' => "Stok produk {$product->supplier->nama_product} tidak mencukupi."
                    ]);
                }

                $subtotal = $product->harga_jual * $jumlah;

                // Tambah detail
                TransaksiDetail::create([
                    'transaksi_id' => $transaksi->id,
                    'product_id'   => $product->id,
                    'jumlah'       => $jumlah,
                    'harga'        => $product->harga_jual,
                    'subtotal'     => $subtotal,
                ]);

                // Kurangi stok
                $product->decrement('stok', $jumlah);

                $totalTransaksi += $subtotal;
            }

            // Cek diskon aktif
            $diskon = Diskon::where('status', 1)->first();
            $potongan = 0;
            $diskonId = null;

            if($diskon) {
                $minBelanja = $diskon->min_belanja ?? 0;
                if($totalTransaksi >= $minBelanja) {
                    if($diskon->tipe === 'persen') {
                        $potongan = $totalTransaksi * ($diskon->nilai / 100);
                    } else {
                        $potongan = $diskon->nilai;
                    }
                    $diskonId = $diskon->id;
                    $totalTransaksi -= $potongan;
                }
            }

            // Update total transaksi & diskon
            $transaksi->update([
                'total'     => $totalTransaksi,
                'diskon_id' => $diskonId
            ]);
        });

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }
}
