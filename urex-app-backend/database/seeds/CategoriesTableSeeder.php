<?php

use Illuminate\Database\Seeder;
use App\Category;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class CategoriesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('categories')->truncate();

        Category::create(['name' => 'Administration']);
        Category::create(['name' => 'U-Rec']);
        Category::create(['name' => 'Outdoor Rec']);
        Category::create(['name' => 'Intramurals']);
        Category::create(['name' => 'Climbing Wall']);
    }

}