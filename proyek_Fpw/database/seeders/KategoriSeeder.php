<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'nama_kategori' => 'Buku'
            ],
            [
                'id' => 2,
                'nama_kategori' => 'Dapur'
            ],
            [
                'id' => 3,
                'nama_kategori' => 'Elektronik'
            ],
            [
                'id' => 4,
                'nama_kategori' => 'Fashion Anak & Bayi'
            ],
            [
                'id' => 5,
                'nama_kategori' => 'Fashion Muslim'
            ],
            [
                'id' => 6,
                'nama_kategori' => 'Fashion Pria'
            ],
            [
                'id' => 7,
                'nama_kategori' => 'Fashion Wanita'
            ],
            [
                'id' => 8,
                'nama_kategori' => 'Film & Musik'
            ],
            [
                'id' => 9,
                'nama_kategori' => 'Gaming'
            ],
            [
                'id' => 10,
                'nama_kategori' => 'Handphone & Tablet'
            ],
            [
                'id' => 11,
                'nama_kategori' => 'Ibu & Bayi'
            ],
            [
                'id' => 12,
                'nama_kategori' => 'Kamera'
            ],
            [
                'id' => 13,
                'nama_kategori' => 'Kecantikan'
            ],
            [
                'id' => 14,
                'nama_kategori' => 'Kesehatan'
            ],
            [
                'id' => 15,
                'nama_kategori' => 'Komputer & Laptop'
            ],
            [
                'id' => 16,
                'nama_kategori' => 'Logam & Mulia'
            ],
            [
                'id' => 17,
                'nama_kategori' => 'Mainan & Hobi'
            ],
            [
                'id' => 18,
                'nama_kategori' => 'Makanan & Minuman'
            ],
            [
                'id' => 19,
                'nama_kategori' => 'Office & Stationery'
            ],
            [
                'id' => 20,
                'nama_kategori' => 'Olahraga'
            ],
            [
                'id' => 21,
                'nama_kategori' => 'Otomotif'
            ],
            [
                'id' => 22,
                'nama_kategori' => 'Perawatan Hewan'
            ],
            [
                'id' => 23,
                'nama_kategori' => 'Perawatan Tubuh'
            ],
            [
                'id' => 24,
                'nama_kategori' => 'Perlengkapan Pesta & Craft'
            ],
            [
                'id' => 25,
                'nama_kategori' => 'Pertukangan'
            ],
            [
                'id' => 26,
                'nama_kategori' => 'Rumah Tangga'
            ],
            [
                'id' => 27,
                'nama_kategori' => 'Tour & Travel'
            ],
            [
                'id' => 28,
                'nama_kategori' => 'Wedding'
            ],
        ];
        DB::table('kategori')->insert($data);
    }
}
