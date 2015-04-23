<?php

use Illuminate\Database\Seeder;
use App\Hour;
use App\User;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class HoursTableSeeder extends Seeder {

    public function run()
    {
        DB::table('hours')->truncate();

        for($i = 1; $i <= 5; $i++) {
          Hour::create([
            'open' => date("H:i:s"),
            'close' => date("H:i:s"),
            'day_of_week' => $i,
            'category_id' => $i,
            'X-Authorization' => User::find($i)->apiKey->key
          ]);
        }
    }

}