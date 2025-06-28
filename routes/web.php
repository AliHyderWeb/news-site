<?php

use App\Models\Post;
use App\Models\User;
use App\Exports\GenericPDFExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;



Route::get('/admin/login', function () {
    return view('admin.index');
})->name('login');

Route::post('/users/login', [UserController::class, 'login'])->name('users.login');

Route::middleware('auth')->group(function(){
    Route::resource('posts', PostController::class)->except('show');
    Route::get('/posts/filter', [PostController::class, 'filterPosts'])->name('posts.filter');
    Route::post('/logout', [UserController::class, 'logout'])->name('users.logout');
    
    Route::get('/export-user-pdf/{id}', function ($id) {
    $user = User::findOrFail($id);
    return (new GenericPDFExport(
        ['user' => $user], 
        'pdf.users', 
        'user_' . $user->id . '.pdf'
        ))->download();
    })->name('users.pdf');

    Route::get('/export-post-pdf/{id}', function ($id) {
    $post = Post::findOrFail($id);
    return (new GenericPDFExport(
        ['post' => $post], 
        'pdf.post', 
        'post_' . $post->id . '.pdf'
        ))->download();
    })->name('post.pdf');
});

Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::resource('users', UserController::class);
    Route::resource('category', CategoryController::class);
    Route::Post('/update-status', [PostController::class, 'updatePostStatus'])->name('posts.update.status');
});


Route::get('/', [PostController::class, 'showPosts'])->name('posts.show');
Route::get('/posts/{id}', [PostController::class, 'showSinglePost'])->name('posts.show.single');
Route::get('/posts/category/{id}', [PostController::class, 'categroyPosts'])->name('posts.show.category');
Route::get('/posts/author/{id}', [PostController::class, 'authorsPosts'])->name('posts.show.author');
