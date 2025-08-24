<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class kelolaTransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with('product.supplier')->latest()->get();
        return view('pages.admin.kelolaTransaksi.index', compact('transaksi'));
    }

        public function print($id)
    {
        $trx = Transaksi::with('product.supplier')->findOrFail($id);
        return view('pages.admin.kelolaTransaksi.print', compact('trx'));
    }
}
