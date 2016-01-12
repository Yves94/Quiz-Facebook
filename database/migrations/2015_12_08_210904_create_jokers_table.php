<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJokersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jokers', function (Blueprint $table) {
            $table->increments('id_joker');
            $table->string('wording_joker')->unique();
            $table->integer('id_action')->unique();
        });

        Schema::create('joker_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('joker_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->boolean('active',true);
            $table->dateTime('date_active');
            $table->foreign('joker_id')->references('id_joker')->on('jokers')->onDelete('cascade');
            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('jokers');
        Schema::drop('joker_user');
    }
}
