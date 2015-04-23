<?php

use Illuminate\Database\Seeder;
use App\HoursException;
use App\User;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class HoursExceptionsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('hours_exceptions')->truncate();

        for($i = 1; $i <= 5; $i++) {
          HoursException::create([
            'date' => date("Y-m-d"),
            'open' => date("H:i:s"),
            'close' => date("H:i:s"),
            'category_id' => $i,
            'X-Authorization' => User::find($i)->apiKey->key
          ]);
        }
    }

}