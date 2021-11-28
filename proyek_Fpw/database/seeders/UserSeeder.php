<?php

namespace Database\Seeders;

use App\Models\userModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
               'fname' => 'admin',
               'lname'=>'ini akun Admin',
               'email'=>'admin@example.com',
               'notelp'=>'admin',
               'password'=> Hash::make('admin'),
               'level'=> 'admin',
               'status'=> '1',
            ],
            [
                'fname' => 'John',
                'lname'=>'Calvin',
                'email'=>'calvin@gmail.com',
                'notelp'=>'08213532352',
                'password'=> Hash::make('johnganteng'),
                'level'=> 'user',
                'status'=> '1',
            ],
        ];
        DB::table('users')->insert($user);
    }
}
