<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\BlogSinglePostController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WelcomeController;

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

Route::get('/', [WelcomeController::class, 'index'])->name('website');
Route::get('/blog/authors/{author}', [WelcomeController::class, 'author'])->name('blog.author');
Route::get('/blog/post/{post}', [BlogSinglePostController::class, 'show'])->name('blog.post');
Route::get('/blog/categories/{category}', [WelcomeController::class, 'category'])->name('blog.category');
Route::get('/blog/tags/{tag}', [WelcomeController::class, 'tag'])->name('blog.tag');

Route::get('/dashboard', function () {
    return view('dashboard')->with('dashboard', true);
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::middleware('auth')->group(function (){
    Route::resource('categories', CategoriesController::class);
    Route::resource('posts', PostsController::class);
    Route::resource('tags', TagsController::class);
    Route::get('trashed-posts', [PostsController::class, 'trashed'])->name('trashed-posts.index');
    Route::put('restore-posts/{post}',[PostsController::class, 'restore'])->name('restore-posts');
});

Route::middleware(['auth', 'admin'])->group(function (){
    Route::resource('users', UsersController::class);
    Route::post('users/{user}/make-admin', [UsersController::class, 'makeAdmin'])->name('users.make-admin');
});
