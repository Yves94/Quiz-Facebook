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

        $user = new User();
        $user->first_name='Matthieu';
        $user->last_name='Rochet';
        $user->email='RochetMatthieu@gmail.com';
        $user->age_rangs=25;
        $user->birthday=date('Y-m-d',strtotime('28/02/1991'));
        $user->gender=0;
        $user->save();

        $user->attachRole($admin);
        return 'sucess';
    } catch(Exception $e){
        print_r($e);
    }

});
