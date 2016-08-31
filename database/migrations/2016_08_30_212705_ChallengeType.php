<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChallengeType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ChallengeType', function(Blueprint $table){
            $table->increments('id');
            //$table->foreign('Challenge_Id')->references('id')->on('Challenges');
            $table->string('Challenge_Name');
            $table->mediumText('description');
        })
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ChallengeType');
    }
}
