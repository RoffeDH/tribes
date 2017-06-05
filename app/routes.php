<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
Route::get('/login', 'HomeController@getLogin');
Route::post('/login', 'HomeController@doLogin');
Route::get('/logout', 'HomeController@doLogout');
Route::post('/register', 'HomeController@doRegister');

Route::resource('tribe', 'TribeController');
Route::resource('character', 'CharacterController');
Route::resource('action', 'ActionController');
Route::resource('trade', 'TradeController');