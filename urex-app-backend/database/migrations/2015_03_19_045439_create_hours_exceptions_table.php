<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHoursExceptionsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hours_exceptions', function(Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->time('open');
            $table->time('close');
            $table->integer('category_id')->unsigned();
            //$table->foreign('category_id')->references('id')->on('categories');
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
        Schema::drop('hours_exceptions');
    }

}
