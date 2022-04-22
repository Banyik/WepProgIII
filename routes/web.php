<?php

use App\Http\Middleware\GuestMiddleware;
use App\Http\Middleware\LoggedInMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

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
Route::group(['middleware' => 'web'], function () {
    Route::group(['middleware' => [LoggedInMiddleware::class]], function() {
        Route::get('/', [UserController::class, 'home']);
        Route::get('/home', [UserController::class, 'home']);
        Route::get('/logout', [UserController::class, 'logout']);
        Route::get('/post', [PostController::class, 'post_site'])->name('post');
        Route::post('/post', [PostController::class, 'post'])->name('postvalidate');
    });
    Route::group(['middleware' => [GuestMiddleware::class]], function() {
        Route::get('/login', [UserController::class, 'login_page']);
        Route::post('/verification', [UserController::class, 'verification'])->name('verification');
    });
});
