<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;
use Illuminate\Support\Str;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        $kategoris = [
            'Makanan Ringan',
            'Minuman',
            'Elektronik',
            'Pakaian',
            'Alat Tulis'
        ];

        foreach ($kategoris as $nama) {
            Kategori::create([
                'nama' => $nama,
                'slug' => Str::slug($nama) // otomatis jadi 'makanan-ringan', 'minuman', dll
            ]);
        }
    }
}
