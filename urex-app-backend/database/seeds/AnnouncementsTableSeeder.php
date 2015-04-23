<?php

use Illuminate\Database\Seeder;
use App\Announcement;
use App\User;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class AnnouncementsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('announcements')->truncate();

        date_default_timezone_set('UTC');
        for($i = 1; $i <= 5; $i++) {
          Announcement::create([
            'title' => 'Title #'.$i,
            'message' => 'Announcment #'.$i,
            'date' => date("Y-m-d H:i:s"),
            'X-Authorization' => User::find($i)->apiKey->key,
            'category_id' => $i
          ]);
        }
    }

}