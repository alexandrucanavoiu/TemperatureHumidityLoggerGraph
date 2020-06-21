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
    return view('auth/login');
});

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
  ]);

Route::get('/home', ['as' => 'auth.home',   'uses' => 'HomeController@index']);
Route::get('/search', ['as' => 'auth.search',   'uses' => 'HomeController@search']);
Route::post('/search', ['as' => 'auth.search.create',   'uses' => 'HomeController@search_post']);
Route::get('/chart', 'ChartController@index');
