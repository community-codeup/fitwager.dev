<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChallengeChallengers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('challenge_challengers', function(Blueprint $table){
            $table->increments('id');
            $table->integer('challenge_id')->unsigned();
            $table->integer('challenger_id')->unsigned();
            $table->foreign('challenge_id')->references('id')->on('challenges');
            $table->foreign('challenger_id')->references('id')->on('challengers');
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
        Schema::drop('challenge_challengers');     
    }
}
