<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permission')->insert([
            'title'=>"Dashboard",
            'slug'=>"dashboard"
        ]);
        DB::table('permission')->insert([
            'title'=>"List  User",
            'slug'=>"list_user"
        ]);

        DB::table('permission')->insert([
            'title'=>"Add User",
            'slug'=>"add_user"
        ]);

        DB::table('permission')->insert([
            'title'=>"Edit  User",
            'slug'=>"edit_user"
        ]);

        DB::table('permission')->insert([
            'title'=>"List Role",
            'slug'=>"list_role"
        ]);
        DB::table('permission')->insert([
            'title'=>"List Category",
            'slug'=>"list_category"
        ]);

        DB::table('permission')->insert([
            'title'=>"Add Category",
            'slug'=>"add_category"
        ]);
        DB::table('permission')->insert([
            'title'=>"Edit Category",
            'slug'=>"edit_category"
        ]);
        DB::table('permission')->insert([
            'title'=>"Delete Category",
            'slug'=>"delete_category"
        ]);
        DB::table('permission')->insert([
            'title'=>"List Product",
            'slug'=>"list_product"
        ]);
        DB::table('permission')->insert([
            'title'=>"Add Product",
            'slug'=>"add_product"
        ]);

        DB::table('permission')->insert([
            'title'=>"Edit Product",
            'slug'=>"edit_product"
        ]);
        
    }
}
