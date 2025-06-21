<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;



Route::get('/admin/login', function () {
    return view('admin.index');
})->name('login');

Route::post('/users/login', [UserController::class, 'login'])->name('users.login');

Route::middleware('auth')->group(function(){
    Route::resource('posts', PostController::class)->except('show');
    Route::post('/logout', [UserController::class, 'logout'])->name('users.logout');   
});

Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::resource('users', UserController::class);
    Route::resource('category', CategoryController::class);
});


Route::get('/', [PostController::class, 'showPosts'])->name('posts.show');
Route::get('/posts/{id}', [PostController::class, 'showSinglePost'])->name('posts.show.single');
Route::get('/posts/category/{id}', [PostController::class, 'categroyPosts'])->name('posts.show.category');
Route::get('/posts/author/{id}', [PostController::class, 'authorsPosts'])->name('posts.show.author');
