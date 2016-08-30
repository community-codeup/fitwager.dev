<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Results extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Results', function(Blueprint $table){
            $table->increments('id');
            $table->foreign('Challenge_Id')->refrences('id')->on('Challenges');
            $table->string('Winner');
            $table->string('Coins Awarded');
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
