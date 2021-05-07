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

Auth::routes();

/*
|--------------------------------------------------------------------------
| 1) User 認証不要
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect('/home');
});

/*
|--------------------------------------------------------------------------
| 2) User ログイン後
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'auth:user'], function() {
Route::get('/home', 'HomeController@index')->name('home');});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
