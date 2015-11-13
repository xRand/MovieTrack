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
Route::get('admin/admin_panel', function(){
    return view('admin/admin_panel');
});


// Films routes...
//Route::resource('film','FilmController');

Route::post('film', 'FilmController@store');
Route::get('film/create', 'FilmController@create');

Route::get('film/{id}', 'FilmController@show');
Route::patch('film/{id}', 'FilmController@update');

Route::get('film/{id}/edit', 'FilmController@edit');

Route::get('film/{id}/{status}', 'FilmController@switchSubStatus');








