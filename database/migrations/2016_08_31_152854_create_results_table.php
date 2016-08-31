<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function(Blueprint $table){
            $table->increments('id');
            $table->integer('challenge_id')->unsigned();
            $table->string('winner');
            $table->string('coins_awarded');

            $table->foreign('challenge_id')->references('id')->on('challenges');

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
        Schema::drop('Results');
    }
}
