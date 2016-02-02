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

//Route::get('/', 'QuizController@home');


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

Route::get('/', [
    'uses' => 'QuizController@home',
    'as' => 'home',
    'middleware' => 'tokenFB'
]);
Route::get('login','Auth\AuthController@login');
Route::get('callback', 'Auth\AuthController@callback');


/*Route::match(array('GET', 'POST'),'/', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb) {
    try {
        $token = $fb->getCanvasHelper()->getAccessToken();
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        // Failed to obtain access token
        dd($e->getMessage());
    }

    // $token will be null if the user hasn't authenticated your app yet
    if (isset($token)) {
        $fb->setDefaultAccessToken($token);
        $response = $fb->get('/me');
        $me = $response->getGraphUser();
        Session::put('name',(string) $me->getName());
        Session::put('facebook_access_token', (string) $token);
        Route::get('/','QuizController@home');    
    }
    else {
        $helper = $fb->getRedirectLoginHelper();
        $permissions = ['email']; // optional
        $callback = 'https://quizfb.herokuapp.com/callback/';
        $loginUrl = $helper->getLoginUrl($callback, $permissions);
        return Redirect::to($loginUrl);
    }
}); */ 



