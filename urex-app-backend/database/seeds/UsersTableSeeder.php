<?php

use Illuminate\Database\Seeder;
use App\User;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class UsersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->truncate();

        User::create([
          'username' => 'jcorry',
          'password' => 'jcorry',
          'first_name' => 'Joey',
          'last_name' => 'Corry',
          'email' => 'jcorry15@my.whitworth.edu',
          'category_id' => 1
        ]);
        User::create([
          'username' => 'hgamiel',
          'password' => 'hgamiel',
          'first_name' => 'Hannah',
          'last_name' => 'Gamiel',
          'email' => 'hgamiel15@my.whitworth.edu',
          'category_id' => 2
        ]);
        User::create([
          'username' => 'lpangborn',
          'password' => 'lpangborn',
          'first_name' => 'Lauren',
          'last_name' => 'Pangborn',
          'email' => 'lpangborn15@my.whitworth.edu',
          'category_id' => 3
        ]);
        User::create([
          'username' => 'bhassell',
          'password' => 'bhassell',
          'first_name' => 'Bryan',
          'last_name' => 'Hassell',
          'email' => 'bhassell15@my.whitworth.edu',
          'category_id' => 4
        ]);
        User::create([
          'username' => 'wcunningham15',
          'password' => 'wcunningham15',
          'first_name' => 'Sean',
          'last_name' => 'Cunningham',
          'email' => 'wcunningham15@my.whitworth.edu',
          'category_id' => 5
        ]);
    }

}