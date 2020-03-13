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

Route::namespace('Image')->group(function () {
    Route::get('/user/{user:name}', 'UserController')->name('image.user');
    Route::get('/post/{post}', 'PostController')->name('image.post');
    Route::get('/home', 'HomeController')->name('image.home');
});
