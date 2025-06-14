<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () { return view('admin/index'); })->name('home');
Route::post('/users/login', [UserController::class, 'login'])->name('users.login');

Route::prefix('auth')->middleware('auth')->group(function(){

    Route::resource('users', UserController::class);
    Route::resource('/category', CategoryController::class)->name('category.index', 'category');
    Route::resource('posts', PostController::class);

    Route::post('/logout', [UserController::class, 'logout'])->name('users.logout');
});
