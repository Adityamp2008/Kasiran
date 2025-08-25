<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Supplier;
use App\Models\product;
use App\Models\Transaksi;

class AdmindashboardController extends Controller
{
    public function index()
    {
        $kategoriCount   = Kategori::count();
        $supplierCount   = Supplier::count();
        $produkCount     = product::count();
        $transaksiCount  = Transaksi::count();

        return view('pages.admin.dashboard', compact(
            'kategoriCount',
            'supplierCount',
            'produkCount',
            'transaksiCount'
        ));
    }
}
