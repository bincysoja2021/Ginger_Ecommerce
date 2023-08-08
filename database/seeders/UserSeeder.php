<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
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
        DB::table('users')->insert([
            'name'         => "Admin",
            'role'         => 1,
            'email'        => 'admin@gmail.com',
            'password'     => Hash::make('123456')
        ]);
        DB::table('users')->insert([
            'name'         => "User",
            'role'         => 2,
            'email'        => 'bincy@gmail.com',
            'password'     => Hash::make('123456')
        ]);

    }
}
