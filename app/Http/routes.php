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
    Route::group(['prefix' => 'quiz'], function () {
        Route::match(array('GET', 'POST'),'list', ['as' => 'admin_quiz_list', 'uses' => 'BackOffice\QuizController@listQuizzes']);
        Route::match(array('GET', 'POST'),'edit/{slug}', ['as' => 'admin_quiz_edit', 'uses' => 'BackOffice\QuizController@editQuiz']);
        Route::match(array('GET', 'POST'),'add', ['as' => 'admin_quiz_add', 'uses' => 'BackOffice\QuizController@addQuiz']);
        Route::delete('delete/{id}',array('as' => 'admin_quiz_delete', 'uses' => 'BackOffice\QuizController@deleteQuiz'));
        Route::match(array('GET', 'POST'),'participants/{slug}', ['as' => 'admin_quiz_entrants', 'uses' => 'BackOffice\QuizController@entrants']);
    });
    Route::group(['prefix' => 'question'], function () {
        Route::match(array('GET', 'POST'),'list', ['as' => 'admin_question_list', 'uses' => 'BackOffice\questionController@listQuestions']);
        Route::match(array('GET', 'POST'),'edit/{id}', ['as' => 'admin_question_edit', 'uses' =>  'BackOffice\questionController@editQuestion']);
        Route::match(array('GET', 'POST'),'add', ['as' => 'admin_question_list_add', 'uses' =>  'BackOffice\questionController@addQuestion']);
        Route::delete('delete/{id}',array('as' => 'admin_question_delete', 'uses' => 'BackOffice\QuestionController@deleteQuestion'));
    });
    Route::group(['prefix' => 'category'], function () {
        Route::match(array('GET', 'POST'),'list', ['as' => 'admin_category_list', 'uses' => 'BackOffice\CategoryController@listCategories']);
        Route::match(array('GET', 'POST'),'edit/{id}', ['as' => 'admin_category_edit', 'uses' => 'BackOffice\CategoryController@editCategory']);
        Route::match(array('GET', 'POST'),'add',['as' => 'admin_category_add', 'uses' => 'BackOffice\CategoryController@addCategory']);
        Route::delete('delete/{id}',array('as' => 'admin_category_delete', 'uses' => 'BackOffice\CategoryController@deleteCategory'));
    });
    Route::group(['prefix' => 'answer'], function () {
        Route::match(array('GET', 'POST'),'list', ['as' => 'admin_answer_list', 'uses' => 'BackOffice\AnswerController@listAnswers']);
        Route::match(array('GET', 'POST'),'edit/{id}',['as' => 'admin_answer_edit', 'uses' => 'BackOffice\AnswerController@editAnswer']);
        Route::match(array('GET', 'POST'),'add', ['as' => 'admin_answer_add', 'uses' => 'BackOffice\AnswerController@addAnswer']);
        Route::delete('delete/{id}',array('as' => 'admin_answer_delete', 'uses' => 'BackOffice\AnswerController@deleteAnswer'));
    });
    Route::group(['prefix' => 'user'], function () {
        Route::match(array('GET', 'POST'),'list',['as' => 'admin_user_list', 'uses' => 'BackOffice\UserController@listUsers']);
        Route::match(array('GET', 'POST'),'edit/{id}',['as' => 'admin_user_edit', 'uses' => 'BackOffice\UserController@editUser']);
        Route::match(array('GET', 'POST'),'add',['as' => 'admin_user_add', 'uses' => 'BackOffice\UserController@addUser']);
    });
    Route::group(['prefix' => 'joker'], function () {
        Route::match(array('GET', 'POST'),'list',['as' => 'admin_joker_list', 'uses' => 'BackOffice\JokerController@listJokers']);
        Route::match(array('GET', 'POST'),'edit/{id}',['as' => 'admin_joker_edit', 'uses' => 'BackOffice\JokerController@editJoker']);
        Route::match(array('GET', 'POST'),'add',['as' => 'admin_joker_add', 'uses' => 'BackOffice\JokerController@addJoker']);
    });
});

Route::match(array('GET', 'POST'),'/', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb) {
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
    $fb->setDefaultAccessToken($token);
        $response = $fb->get('/me');
        $me = $response->getGraphUser();
        Session::put('name',(string) $me->getName());
        Session::put('facebook_access_token', (string) $token);
     return view('welcome');
});  


//Route::get('callback', 'Auth\AuthController@callback');

Route::group(['middleware' => ['auth']], function(){
	Route::get('home',array('as'=>'home', 'uses'=>function(){
	return view('home');
	}));
});
