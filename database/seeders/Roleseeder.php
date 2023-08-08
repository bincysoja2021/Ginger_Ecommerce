<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class Roleseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role')->insert([
            'name'         => "Admin"
        ]);
         DB::table('role')->insert([
            'name'         => "User"
        ]);
    }
}
