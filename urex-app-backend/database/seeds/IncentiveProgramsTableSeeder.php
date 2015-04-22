<?php

use Illuminate\Database\Seeder;
use App\IncentiveProgram;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class IncentiveProgramsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('incentive_programs')->truncate();

        for($i = 1; $i <= 5; $i++) {
          IncentiveProgram::create([
            'title' => 'Title #'.$i,
            'description' => 'Description #'.$i,
            'user_id' => $i
          ]);
        }

        $this->command->info('Incentive Programs table seeded!');
    }

}