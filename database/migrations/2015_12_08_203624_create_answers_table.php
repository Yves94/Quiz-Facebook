<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->increments('id_answer');
            $table->string('wording_answer')->unique();
        });

        Schema::create('answer_question',function (Blueprint $table) {
            $table->increments('id');
            $table->integer('answer_id')->unsigned()->index();
            $table->integer('question_id')->unsigned()->index();
            $table->foreign('answer_id')->references('id_answer')->on('answers')->onDelete('cascade');
            $table->foreign('question_id')->references('id_question')->on('questions')->onDelete('cascade');
            $table->boolean('is_good');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('answer_question');
        Schema::drop('answers');
    }
}
