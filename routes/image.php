<?php

use App\Http\Controllers\Image\HomeController;
use App\Http\Controllers\Image\PostController;
use App\Http\Controllers\Image\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Image Routes
|--------------------------------------------------------------------------
|
| Server Push無効やキャッシュのためwebから分離
|
*/

Route::name('image.')->group(
    function () {
        Route::get('/user/{user:name}', UserController::class)->name('user');
        Route::get('/post/{post}', PostController::class)->name('post');
        Route::get('/home', HomeController::class)->name('home');
    }
);
