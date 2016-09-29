<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');

Route::resource('/departments', 'Api\DepartmentsController');
Route::post('/departments/add-user','Api\DepartmentsController@addUser');
Route::post('/departments/remove-user','Api\DepartmentsController@removeUser');

Route::resource('/producers', 'Api\ProducersController');
Route::resource('/asset-types', 'Api\AssetTypesController');

Route::resource('/roles', 'Api\RolesController');
Route::post('/roles/add-user','Api\RolesController@addUser');
Route::post('/roles/remove-user','Api\RolesController@removeUser');

Route::resource('/users', 'Api\UsersController');