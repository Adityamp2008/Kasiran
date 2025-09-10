<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create(); // kalau mau bikin user random

        $this->call([
            UserSeeder::class,
            KategoriSeeder::class,
            SupplierSeeder::class,
            ProductSeeder::class,
        ]);
    }
}
