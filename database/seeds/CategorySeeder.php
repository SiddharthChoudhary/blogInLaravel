<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $categories = [
            ['category_name'=>'nature'],
            ['category_name'=>'industry'],
            ['category_name'=>'metallurgical'],
            ['category_name'=>'science'],
            ['category_name'=>'biology'],
            ['category_name'=>'physics']
            ];
        \App\Category::insert($categories);
    }
}
