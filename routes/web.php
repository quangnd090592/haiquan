<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// Route::get('/', function () {
    // return view('welcome');
// });

// Route::get('user', 'HomeController@user');

Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('/assets', 'AssetsController@index');

Route::resource('/departments', 'DepartmentsController');
Route::resource('/producers', 'ProducersController');
