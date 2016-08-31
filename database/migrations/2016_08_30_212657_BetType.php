<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BetType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('BetType' function(Blueprint $table){
            $table->increments('id');
            $table->foreign('Challenge_Id')->refrences('id')->on('Challenges');
            $table->string('Bet_Type_Name');
            $table->mediumText('Bet_Description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('BetType');
    }
}
