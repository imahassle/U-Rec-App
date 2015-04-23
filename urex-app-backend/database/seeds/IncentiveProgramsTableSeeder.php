<?php

use Illuminate\Database\Seeder;
use App\IncentiveProgram;
use App\User;

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
            'X-Authorization' => User::find($i)->apiKey->key
          ]);
        }
    }

}