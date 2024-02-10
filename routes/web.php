<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/rumpi.com/home', [PostController::class, 'index'])->name('home');
Route::get('/rumpi.com/{idPost}/comment}', [CommentController::class, 'showComment'])->name('comment.show');



Route::get('/rumpi.com//login', [AuthController::class, 'login'])->name('login');
Route::post('/rumpi.com//login', [AuthController::class, 'authenticating']);


Route::group(['prefix' => 'rumpi.com', 'middleware' => ['auth']], function () {


    Route::get('/logout', [AuthController::class, 'logout']);


    Route::get('/create_post', [PostController::class, 'create'])->name('post.create');
    Route::post('/store', [PostController::class, 'store'])->name('post.store');
    Route::get('/edit_pos/{idPost}', [PostController::class, 'edit'])->name('post.edit');
    Route::post('/update/{idPost}', [PostController::class, 'update'])->name('post.update');
    Route::post('/delete/{idPost}', [PostController::class, 'destroy'])->name('post.delete');

    Route::get('/rumpi.com/{idLogin}', [ProfileController::class, 'showProfile'])->name('profile.show');
    Route::post('/rumpi.com/{idLogin}', [ProfileController::class, 'updateProfile'])->name('profile.update');
});







//Route::get('/rumpi.com/comment}', [CommentController::class, 'showComment'])->name('comment');
