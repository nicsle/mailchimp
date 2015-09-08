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

/*Route::get('/', function () {
    return view('welcome', ['name'=>'Nico']);
});
Route::get('helloworld', 'NameController@helloworld');*/

Route::post('/', 'MainController@start');
Route::get('/', function(){
    return csrf_token();
    //print_r($_ENV);
});
