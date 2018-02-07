<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'cat_name' => 'Drinks',
        ]);
        DB::table('categories')->insert([
            'cat_name' => 'Food',
        ]);
        DB::table('categories')->insert([
            'cat_name' => 'Desserts',
        ]);
        DB::table('categories')->insert([
            'cat_name' => 'Desi',
        ]);
        DB::table('categories')->insert([
            'cat_name' => 'Chinese',
        ]);
    }
}
