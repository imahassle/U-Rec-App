<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemRentalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('item_rentals', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->decimal('faculty_pricing_1', 10, 2);
            $table->decimal('faculty_pricing_2', 10, 2);
            $table->decimal('faculty_pricing_3', 10, 2);
            $table->decimal('faculty_pricing_4', 10, 2);
            $table->decimal('student_pricing_1', 10, 2);
            $table->decimal('student_pricing_2', 10, 2);
            $table->decimal('student_pricing_3', 10, 2);
            $table->decimal('student_pricing_4', 10, 2);
            $table->timestamps();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('item_rentals');
	}

}
