<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz', function (Blueprint $table) {
            $table->increments('id_quiz');
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->integer('nb_questions');
            $table->string('summary');
            $table->string('picture');
            $table->date('start_date');
            $table->date('end_start');
            $table->string('color');
            $table->timestamps();
        });

        Schema::create('quiz_user', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('quiz_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('quiz_id')->references('id_quiz')->on('quiz')->onDelete('cascade');
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
        Schema::drop('quiz_user');
        Schema::drop('quiz');
    }
}
