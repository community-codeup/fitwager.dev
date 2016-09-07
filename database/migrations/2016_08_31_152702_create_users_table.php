<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('fitbit_id')->unique();
            $table->string('fitbit_token');
            $table->string('fitbit_refresh_token');
            $table->dateTime('fitbit_token_expiration');
            $table->string('picture')->nullable();
            $table->integer('coins')->nullable();
            $table->rememberToken();
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
        //
        Schema::drop('users');
    }
}
