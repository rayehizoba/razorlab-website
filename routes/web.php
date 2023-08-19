<?php

use App\Http\Controllers\PostController;
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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/create-post', [PostController::class, 'createPost'])->name('create-post');
    Route::get('/edit-post/{id}', [PostController::class, 'editPost'])->name('edit-post');
    Route::get('/posts', [PostController::class, 'listPosts'])->name('list-posts');

});

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/work', function () {
    return view('works');
})->name('works');

Route::get('/work/{slug}', function ($slug) {
    return view('work', ['slug' => $slug]);
})->name('work');

Route::get('/services', function () {
    return view('services');
})->name('services');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/blog', [PostController::class, 'blog'])->name('blog');
Route::get('/post/{slug}', [PostController::class, 'showPost'])->name('single-post');


