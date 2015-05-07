<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHoursTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hours', function(Blueprint $table) {
            $table->increments('id');
            $table->time('open');
            $table->time('close');
            $table->boolean('closed');
            $table->integer('day_of_week')->unsigned();
            $table->integer('category_id')->unsigned();
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
        Schema::drop('hours');
    }

}
