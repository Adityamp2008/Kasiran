<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Kategori;
use App\Models\Supplier;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $kategori1 = Kategori::first(); // ambil kategori pertama
        $supplier1 = Supplier::first(); // ambil supplier pertama

        Product::create([
            'kategori_id' => $kategori1->id,
            'supplier_id' => $supplier1->id,
            'harga_beli' => 8000,
            'harga_jual' => 12000,
            'lokasi' => 'Rak A1',
            'stok' => 50,
            'stok_minimal' => 10,
        ]);

        $kategori2 = Kategori::find(2);
        $supplier2 = Supplier::find(2);

        Product::create([
            'kategori_id' => $kategori2->id,
            'supplier_id' => $supplier2->id,
            'harga_beli' => 5000,
            'harga_jual' => 9000,
            'lokasi' => 'Rak B1',
            'stok' => 30,
            'stok_minimal' => 5,
        ]);
    }
}
