<?php

use Illuminate\Database\Seeder;
use Chrisbjr\ApiGuard\Models\ApiKey;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class ApiKeysTableSeeder extends Seeder {

    public function run()
    {
        DB::table('api_logs')->truncate();
        DB::table('api_keys')->truncate();

        for($i = 1; $i <= 5; $i++) {
          $apiKey = App::make(Config::get('apiguard.model', 'Chrisbjr\ApiGuard\Models\ApiKey'));
          $apiKey->key = $apiKey->generateKey();
          $apiKey->user_id = $i;
          $apiKey->level = $i;
          $apiKey->ignore_limits = 1;
          $apiKey->save();
        }

        $this->command->info('Api Keys table seeded!');
    }

}