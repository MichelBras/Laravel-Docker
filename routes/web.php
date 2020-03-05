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
    // $redis = app()->make('redis');
    // $redis->set('key1', 'foo');
    // return $redis->get('key1');
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
