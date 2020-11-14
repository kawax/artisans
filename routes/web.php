<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Post\ConfirmController;
use App\Http\Controllers\Post\EditController;
use App\Http\Controllers\Post\ReportController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Profile\DestroyController;
use App\Http\Controllers\Profile\MeController;
use App\Http\Controllers\Profile\UpdateController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

// Auth
Route::get('login', [LoginController::class, 'login'])
     ->name('login');
Route::get('callback', [LoginController::class, 'callback'])
     ->name('callback');
Route::any('logout', [LoginController::class, 'logout'])
     ->name('logout');

Route::get('@{user:name}', UserController::class)->name('user');
Route::view('user', 'user.index')->name('user.index');

Route::get('tag/{tag:tag}', TagController::class)->name('tag');

// Profile
Route::prefix('profile')
     ->name('profile.')
     ->middleware('auth')
     ->group(
         function () {
             Route::view('/', 'profile.edit')
                  ->name('edit');
             Route::get('/me', MeController::class)
                  ->name('me');
             Route::put('/', UpdateController::class)
                  ->name('update');

             Route::view('destroy', 'profile.destroy')
                  ->name('destroy');
             Route::delete('destroy', DestroyController::class)
                  ->name('delete');
         }
     );

// Post
Route::get('post/edit/{post}', EditController::class)
     ->middleware('can:update,post');
Route::get('post/confirm/{post}', ConfirmController::class)
     ->name('post.confirm')
     ->middleware('can:delete,post');
Route::post('post/report/{post}', ReportController::class)
     ->name('post.report')
     ->middleware('auth');

Route::resource('post', PostController::class);

Route::view('privacy', 'pages.privacy')->name('pages.privacy');
Route::view('api', 'pages.api')->name('pages.api');

Route::get('/', HomeController::class)->name('home');

Route::feeds();
