<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IdeaLikeController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/terms', function () {
    return view('terms');
})->name('terms');


Route::resource('idea', IdeaController::class)->except(['index', 'create','show'])->middleware('auth');
Route::resource('idea', IdeaController::class)->only(['show']);

Route::resource('idea.comments', CommentController::class)->only(['store'])->middleware('auth');

Route::resource('users', UserController::class)->only(['edit', 'update'])->middleware('auth');
Route::resource('users', UserController::class)->only(['show']);

Route::get('profile', [UserController::class,'profile'])->name('profile')->middleware('auth');
// https://laravel.com/docs/11.x/controllers#actions-handled-by-resource-controllers
 
Route::post('users/{user}/follow', [FollowerController::class, 'follow'])->name('users.follow')->middleware('auth');
Route::post('users/{user}/unfollow', [FollowerController::class, 'unfollow'])->name('users.unfollow')->middleware('auth');

Route::post('ideas/{idea}/like', [IdeaLikeController::class, 'like'])->name('ideas.like')->middleware('auth');
Route::post('ideas/{idea}/unlike', [IdeaLikeController::class, 'unlike'])->name('ideas.unlike')->middleware('auth');
