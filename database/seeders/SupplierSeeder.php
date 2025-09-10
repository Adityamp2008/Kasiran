<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run()
    {
        $suppliers = [
            [
                'nama_supplier' => 'PT. Maju Jaya',
                'kontak' => '081234567890',
                'alamat' => 'Jl. Merdeka No. 10',
                'nama_product' => 'Keripik Pisang'
            ],
            [
                'nama_supplier' => 'CV. Sumber Rejeki',
                'kontak' => '082345678901',
                'alamat' => 'Jl. Sudirman No. 5',
                'nama_product' => 'Minuman Botol'
            ],
            [
                'nama_supplier' => 'UD. Sejahtera',
                'kontak' => '083456789012',
                'alamat' => 'Jl. Diponegoro No. 8',
                'nama_product' => 'Snack Kacang'
            ],
        ];

        foreach ($suppliers as $data) {
            Supplier::create($data);
        }
    }
}
