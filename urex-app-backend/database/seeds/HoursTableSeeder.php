<?php

use Illuminate\Database\Seeder;
use App\Hour;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class HoursTableSeeder extends Seeder {

    public function run()
    {
        DB::table('hours')->truncate();

        for($i = 1; $i <= 5; $i++) {
          Hour::create([
            'mon_open' => date("H:i:s"),
            'mon_close' => date("H:i:s"),
            'tue_open' => date("H:i:s"),
            'tue_close' => date("H:i:s"),
            'wed_open' => date("H:i:s"),
            'wed_close' => date("H:i:s"),
            'thu_open' => date("H:i:s"),
            'thu_close' => date("H:i:s"),
            'fri_open' => date("H:i:s"),
            'fri_close' => date("H:i:s"),
            'sat_open' => date("H:i:s"),
            'sat_close' => date("H:i:s"),
            'sun_open' => date("H:i:s"),
            'sun_close' => date("H:i:s"),
            'category_id' => $i
          ]);
        }
    }

}