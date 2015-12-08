<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id_question');
            $table->string('wording_question')->unique();
        });

        Schema::create('question_quiz',function (Blueprint $table){
            $table->increments('id');
            $table->integer('question_id')->unsigned()->index();
            $table->integer('quiz_id')->unsigned()->index();
            $table->foreign('question_id')->references('id_question')->on('questions')->onDelete('cascade');
            $table->foreign('quiz_id')->references('id_quiz')->on('quiz')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('questions');
    }
}
