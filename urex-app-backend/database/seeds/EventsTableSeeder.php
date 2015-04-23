<?php

use Illuminate\Database\Seeder;
use App\Event;
use App\User;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class EventsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('events')->truncate();

        for($i = 1; $i <= 5; $i++) {
          Event::create([
            'title' => 'Title #'.$i,
            'description' => 'Description #'.$i,
            'start' => date("Y-m-d H:i:s"),
            'end' => date("Y-m-d H:i:s"),
            'cost' => 12345.67,
            'spots' => $i * 10,
            'gear_needed' => '',
            'X-Authorization' => User::find($i)->apiKey->key,
            'category_id' => $i
          ]);
        }
    }

}