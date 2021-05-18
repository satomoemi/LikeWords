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
    Route::get('/home', 'HomeController@home')->name('home');
    Route::get('/push', 'HomeController@push')->name('push');
    Route::get('/unsubsc', 'UnsubscribeController@UnsubscForm')->name('unsubsc');
    Route::post('/unsubsc','UnsubscribeController@delete');
});
//ユーザー編集
Route::group(['middleware' => ['auth']], function() {    
    
    Route::get('/user', 'UserEditController@UserEditForm')->name('user');
    Route::post('/user/edit/name','UserEditController@NameUpdate')->name('edit.name');
    Route::post('/user/edit/email','UserEditController@EmailUpdate')->name('edit.email');
    Route::post('/user/edit/birthday','UserEditController@BirthdayUpdate')->name('edit.birthday');
    Route::post('/user/edit/gender','UserEditController@GenderUpdate')->name('edit.gender');
    Route::post('/user/edit/password','UserEditController@PasswordChange')->name('edit.password');

});


/*
|--------------------------------------------------------------------------
| 3) Admin 認証不要
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin'], function() {
    Route::get('/',         function () { return redirect('/admin/home'); });
    Route::get('login',     'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login',    'Admin\LoginController@login');
});

/*
|--------------------------------------------------------------------------
| 4) Admin ログイン後
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
    Route::post('logout',   'Admin\LoginController@logout')->name('admin.logout');
    Route::get('home',      'Admin\HomeController@user_index')->name('admin.home');
    Route::get('unsubsc/reason',      'Admin\HomeController@unsubsc_reason_index')->name('admin.unsubsc.reason');

});

