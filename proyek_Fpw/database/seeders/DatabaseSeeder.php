<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Kategori;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            BarangSeeder::class,
            isSellerSeeder::class,
            KategoriSeeder::class

        ]);

    }
}
