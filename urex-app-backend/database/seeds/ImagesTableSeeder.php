<?php

use Illuminate\Database\Seeder;
use App\Image;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class ImagesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('images')->truncate();

        for($i = 1; $i <= 5; $i++) {
          Image::create([
            'file_location' => 'https://blognumbers.files.wordpress.com/2010/09/'.$i.'.jpg',
            'caption' => 'Lorem Ipsum',
            'category_id' => $i
          ]);
        }

        $this->command->info('Images table seeded!');
    }

}