<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
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
    return view('home');
});



Route::resource('post', 'App\Http\Controllers\PostController');
Route::resource('profile', 'App\Http\Controllers\ProfileController');
Route::resource('profile/show', 'App\Http\Controllers\CommentController');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Auth::routes();
