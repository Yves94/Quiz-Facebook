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
use App\User;
/*Route::get('/', function () {
    return view('welcome');
});*/
Route::group(['prefix' => 'admin'], function () {
    Route::get('/salut', function () {
    	return ' salut les gens ';
		});
    Route::group(['prefix' => 'quiz'], function () {
        Route::get('list', 'QuizController@listQuizzes');
        Route::match(array('GET', 'POST'),'edit/{slug}', 'QuizController@editQuiz');
        Route::match(array('GET', 'POST'),'add', 'QuizController@addQuiz');
    });

});

Route::get('/', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb) {
    try {
        $token = $fb->getCanvasHelper()->getAccessToken();
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        // Failed to obtain access token
        dd($e->getMessage());
    }

    // $token will be null if the user hasn't authenticated your app yet
    if (! $token) {
        Route::get('login','Auth\AuthController@facebook');
    }
     return view('welcome');
});  


//Route::get('callback', 'Auth\AuthController@callback');

Route::group(['middleware' => ['auth']], function(){
	Route::get('home',array('as'=>'home', 'uses'=>function(){
	return view('home');
	}));
});
