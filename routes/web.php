<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/login', function () {
    return view('admin.index');
})->name('login');

Route::post('/users/login', [UserController::class, 'login'])->name('users.login');

Route::middleware('auth')->group(function(){
    Route::resource('posts', PostController::class);
    Route::post('/logout', [UserController::class, 'logout'])->name('users.logout');   
});

Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::resource('users', UserController::class);
    Route::resource('category', CategoryController::class);
});

