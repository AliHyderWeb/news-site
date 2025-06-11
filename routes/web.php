<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('admin/index');
})->name('home');

Route::get('/posts', function () {
    return view('admin/post');
})->name('posts');

Route::resource('users', UserController::class);

Route::post('/users/login', [UserController::class, 'login'])->name('users.login');

Route::post('/logout', [UserController::class, 'logout'])->name('users.logout');

Route::resource('/category', CategoryController::class)->name('category.index', 'category');

Route::get('/categories', function () {
    return view('admin/category');
})->name('categories');

Route::get('/add-category', function () {
    return view('admin/add-category');
})->name('add.category');

Route::get('/add-post', function () {
    return view('admin/add-post');
})->name('add.post');

Route::get('/add-user', function () {
    return view('admin/add-user');
})->name('add.user');