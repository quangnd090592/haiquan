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

Route::group(['middleware' => 'isAdmin'], function() {
    Route::resource('/departments', 'DepartmentsController');
    Route::get('/departments/{id}/add-user','DepartmentsController@addUser');

	Route::resource('/producers', 'ProducersController');
	Route::resource('/asset-types', 'AssetTypesController');
	Route::resource('/roles', 'RolesController');
	Route::resource('/assets', 'AssetsController');
});
