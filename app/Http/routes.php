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


Route::get('/', 'FilmController@index');

// Registration routes...
Route::get('auth/registration', 'Auth\AuthController@getRegister');
Route::post('auth/registration', 'Auth\AuthController@postRegister');

// Authentication routes...
Route::get('auth/authorization', 'Auth\AuthController@getLogin');
Route::post('auth/authorization', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');


//Administration
Route::get('admin', 'AdminController@index');
Route::get('film/create', 'AdminController@createFilm');
Route::get('admin/users', 'AdminController@userMng');
Route::get('admin/comments', 'AdminController@commentMng');

Route::delete('admin/comments', 'AdminController@deleteComment');
Route::patch('admin/users', 'AdminController@switchUserStatus');


// Films routes...
//Route::resource('film','FilmController');

Route::post('film', 'FilmController@store');
//Route::get('film/create', 'FilmController@create');

Route::get('film/{id}', 'FilmController@view');
Route::patch('film/{id}', 'FilmController@update');

Route::put('film/{id}', 'FilmController@rate');
Route::post('film/{id}', 'FilmController@comment');

Route::get('film/{id}/edit', 'FilmController@edit');

Route::get('film/{id}/{status}', 'FilmController@switchSubStatus');








