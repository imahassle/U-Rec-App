<?php

use Illuminate\Database\Seeder;
use App\Feedback;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class FeedbackTableSeeder extends Seeder {

    public function run()
    {
        DB::table('feedback')->truncate();

        for($i = 1; $i <= 5; $i++) {
          Feedback::create([
            'message' => 'Message #'.$i,
            'email' => 'email'.$i.'@my.whitworth.edu',
            'date' => date("Y-m-d H:i:s")
          ]);
        }
    }

}