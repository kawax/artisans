<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\Profile\MeController;

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

Route::namespace('Auth')->group(
    function () {
        Route::get('login', [LoginController::class, 'login'])
             ->name('login');
        Route::get('callback', [LoginController::class, 'callback'])
             ->name('callback');
        Route::any('logout', [LoginController::class, 'logout'])
             ->name('logout');
    }
);

Route::get('@{user:name}', [UserController::class, '__invoke'])->name('user');
Route::view('user', 'user.index')->name('user.index');

Route::get('tag/{tag:tag}', 'TagController')->name('tag');

Route::prefix('profile')
     ->name('profile.')
     ->namespace('Profile')
     ->middleware('auth')
     ->group(
         function () {
             Route::view('/', 'profile.edit')
                  ->name('edit');
             Route::get('/me', 'MeController')
                  ->name('me');
             Route::put('/', 'UpdateController')
                  ->name('update');

             Route::view('destroy', 'profile.destroy')
                  ->name('destroy');
             Route::delete('destroy', 'DestroyController')
                  ->name('delete');
         }
     );

Route::namespace('Post')->group(
    function () {
        Route::get('post/edit/{post}', 'EditController')
             ->middleware('can:update,post');

        Route::get('post/confirm/{post}', 'ConfirmController')
             ->name('post.confirm')
             ->middleware('can:delete,post');

        Route::post('post/report/{post}', 'ReportController')
             ->name('post.report')
             ->middleware('auth');
    }
);

Route::resource('post', 'PostController');

Route::view('terms', 'pages.terms')->name('pages.terms');
Route::view('privacy', 'pages.privacy')->name('pages.privacy');
Route::view('api', 'pages.api')->name('pages.api');

Route::get('/', 'HomeController')->name('home');

Route::feeds();
