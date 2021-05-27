<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




// posts route 
Route::get('post/index', [App\Http\Controllers\PostController::class, 'index'])->name('post/index');
Route::get('post/create', [App\Http\Controllers\PostController::class, 'create_index'])->name('post/create');
Route::post('post/create', [App\Http\Controllers\PostController::class, 'store'])->name('post/create');
Route::post('post/comment', [App\Http\Controllers\PostController::class, 'post_comment'])->name('post/comment');

Route::post('like_post', [App\Http\Controllers\PostController::class, 'like_post']);

Route::post('unlike_post', [App\Http\Controllers\PostController::class, 'unlike_post']);

