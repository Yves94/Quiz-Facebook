<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'quiz'], function () {
        Route::match(array('GET', 'POST'),'list', 'BackOffice\QuizController@listQuizzes');
        Route::match(array('GET', 'POST'),'edit/{slug}', 'BackOffice\QuizController@editQuiz');
        Route::match(array('GET', 'POST'),'add', 'BackOffice\QuizController@addQuiz');
    });
    Route::group(['prefix' => 'question'], function () {
        Route::match(array('GET', 'POST'),'list', 'BackOffice\questionController@listQuestions');
        Route::match(array('GET', 'POST'),'edit/{id}', 'BackOffice\questionController@editQuestion');
        Route::match(array('GET', 'POST'),'add', 'BackOffice\questionController@addQuestion');
    });

});
