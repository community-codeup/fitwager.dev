<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Challengers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Challengers', function(Blueprint $table){
            $table->increments('id');
            $table->foreign('User_Id')->refrences('id')->on('Users');
            $table->foreign('Challenge_Id')->refrences('id')->on('Challenges');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Challengers');
    }
}
