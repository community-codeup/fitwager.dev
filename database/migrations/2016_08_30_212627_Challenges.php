<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Challenges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Challenges', function (Blueprint $table){
            $table->increments('id');
            $table->longText('description');
            $table->foreign('Created_By')->references('id')->on('Users');
            $table->foreign('Bet_Type')->refrences('id')->on('BetType');
            $table->foreign('Challenge_Type')->refrences('id')->on('ChallengeType');
            $table->string('Start_Date');
            $table->string('End_Date');
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
        Schema::drop('Challenges');
    }
}
