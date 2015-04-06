<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call('CategoriesTableSeeder');
		$this->call('UsersTableSeeder');
		$this->call('ApiKeysTableSeeder');
		$this->call('ImagesTableSeeder');
		$this->call('AnnouncementsTableSeeder');
		$this->call('EventsTableSeeder');
		$this->call('FeedbackTableSeeder');
		$this->call('HoursTableSeeder');
		$this->call('HoursExceptionsTableSeeder');
		$this->call('IncentiveProgramsTableSeeder');
		$this->call('ItemRentalsTableSeeder');
	}
}