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
use App\User;
Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => 'admin'], function () {
    Route::get('/salut', function () {
    	return ' salut les gens ';
		});
});

Route::get('doit', function(){

    try{

        /*$admin = new Role();
        $admin->name = 'Admin';
        $admin->display_name ='Un Administrateur';
        $admin->save();*/

        $admin = new Role();
        $admin= Role::where('name','=','Admin')->first();

        $user = new User();
        $user = User::where('first_name','=','Matthieu')->first();
        
        $user->attachRole($admin);
        return 'sucess';
    } catch(Exception $e){
        print_r($e);
    }

});
