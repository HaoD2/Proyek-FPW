<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class isSellerSeeder extends Seeder
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
                'email'=>'calvin@gmail.com',
                'status' => 1,
                'created_at' =>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' =>Carbon::now()->format('Y-m-d H:i:s'),

            ]
        ];
        DB::table('isSeller')->insert($data);
    }
}
