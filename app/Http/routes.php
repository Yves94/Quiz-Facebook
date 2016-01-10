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
use App\Role;

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => 'admin'], function () {
    Route::get('/salut', function () {
    	return ' salut les gens ';
		});
});

Route::get('doIt', function(){

    $role = new Role();
    $role->setName('administrateur');
    $role->setDisplayName('admin');
    $role->getDescription('can create, update, delete all quiz');
    $role->save();
});
