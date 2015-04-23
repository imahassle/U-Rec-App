<?php

use Illuminate\Database\Seeder;
use App\ItemRental;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class ItemRentalsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('item_rentals')->truncate();

        for($i = 1; $i <= 5; $i++) {
          ItemRental::create([
            'name' => 'Item #'.$i,
            'faculty_pricing_1' => $i * 1.0,
            'faculty_pricing_2' => $i * 2.0,
            'faculty_pricing_3' => $i * 3.0,
            'faculty_pricing_4' => $i * 4.0,
            'student_pricing_1' => $i * 2.0,
            'student_pricing_2' => $i * 3.0,
            'student_pricing_3' => $i * 4.0,
            'student_pricing_4' => $i * 5.0
          ]);
        }
    }

}