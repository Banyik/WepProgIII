<?php

use App\Http\Middleware\AnyMiddleware;
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
        Route::get('/logout', [UserController::class, 'logout'])->name('logout');
        Route::get('/create-post', [PostController::class, 'post_site'])->name('create_post');
        Route::post('/post-validate', [PostController::class, 'post_validate'])->name('post_validate');
        Route::get('/post/{id}', [PostController::class, 'post'])->name('post');
        Route::post('/post-comment/{id}', [PostController::class, 'post_comment'])->name('post_comment');
        Route::get('/user/{id}', [PostController::class, 'user_site'])->name('user_site');
        Route::post('/delete/{id}', [PostController::class, 'delete_post'])->name('delete_post');
    });
    Route::group(['middleware' => [GuestMiddleware::class]], function() {
        Route::get('/login', [UserController::class, 'login_page'])->name('login');
        Route::get('/register', [UserController::class, 'register_page'])->name('register');
        Route::post('/register-verification', [UserController::class, 'register_verification'])->name('register_verification');
        Route::post('/verification', [UserController::class, 'verification'])->name('verification');
    });
    Route::group(['middleware' => [AnyMiddleware::class]], function() {
        Route::get('/', [UserController::class, 'home'])->name('home');
        Route::get('/home', [UserController::class, 'home']);
    });
});
