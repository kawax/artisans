<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Image Routes
|--------------------------------------------------------------------------
|
| Server Push無効やキャッシュのためwebから分離
|
*/

Route::namespace('Image')->name('image.')->group(function () {
    Route::get('/user/{user:name}', 'UserController')->name('user');
    Route::get('/post/{post}', 'PostController')->name('post');
    Route::get('/home', 'HomeController')->name('home');
});
