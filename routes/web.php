<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('app');
});

// api routes
Route::get('/contacts', 'ContactController@index');
Route::post('/contacts', 'ContactController@create');
Route::get('/contacts/{id}', 'ContactController@show');
Route::put('/contacts/{id}', 'ContactController@update');
Route::delete('/contacts/{id}', 'ContactController@destroy');
