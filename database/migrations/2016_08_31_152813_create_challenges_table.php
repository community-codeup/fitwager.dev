<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChallengesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challenges', function (Blueprint $table){
            $table->increments('id');
            $table->mediumText('description');
            $table->integer('created_by')->unsigned();
            $table->integer('bet_type')->unsigned();
            $table->integer('challenge_type')->unsigned();
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('wager');
            $table->integer('target')->nullable();
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('bet_type')->references('id')->on('bet_types');
            $table->foreign('challenge_type')->references('id')->on('challenge_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('challenges');
    }
}
