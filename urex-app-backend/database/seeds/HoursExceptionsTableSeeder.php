<?php

use Illuminate\Database\Seeder;
use App\HoursException;

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
            'close' => date("H:i:s")
          ]);
        }

        $this->command->info('Hours Exceptions table seeded!');
    }

}