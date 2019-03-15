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

Route::get('login', 'LoginController@login')->name('login');
Route::get('callback', 'LoginController@callback')->name('callback');
Route::any('logout', 'LoginController@logout')->name('logout');

Route::get('@{name}', 'UserController')->name('user');

Route::get('tag/{name}', 'TagController')->name('tag');

Route::prefix('image')->namespace('Image')->group(function () {
    Route::get('/user/{name}', 'UserController')->name('image.user');
    Route::get('/home', 'HomeController')->name('image.home');
});


Route::prefix('profile')->namespace('Profile')->middleware('auth')->group(function () {
    Route::view('/', 'profile.edit')->name('profile.edit');
    Route::get('/user', 'UserController')->name('profile.user');
    Route::put('/', 'UpdateController')->name('profile.update');

    Route::view('destroy', 'profile.destroy')->name('profile.destroy');
    Route::delete('destroy', 'DestroyController')->name('profile.delete');
});

Route::view('privacy', 'pages.privacy')->name('privacy');

Route::get('/', 'HomeController')->name('home');
