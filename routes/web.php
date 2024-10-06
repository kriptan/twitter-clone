<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IdeaLikeController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/terms', function () {
    return view('terms');
})->name('terms');
Route::middleware(['auth'])->group(function () {
    Route::resource('idea', IdeaController::class)->except(['index', 'create','show']);
    Route::resource('idea.comments', CommentController::class)->only(['store']);

    Route::resource('users', UserController::class)->only(['edit', 'update']);
    Route::get('profile', [UserController::class,'profile'])->name('profile');

    Route::post('users/{user}/follow', [FollowerController::class, 'follow'])->name('users.follow');
    Route::post('users/{user}/unfollow', [FollowerController::class, 'unfollow'])->name('users.unfollow');

    Route::post('ideas/{idea}/like', [IdeaLikeController::class, 'like'])->name('ideas.like');
    Route::post('ideas/{idea}/unlike', [IdeaLikeController::class, 'unlike'])->name('ideas.unlike');

    Route::get('/feed', FeedController::class)->name('feed');
});

Route::resource('idea', IdeaController::class)->only(['show']);
Route::resource('users', UserController::class)->only(['show']);

// Admin 
Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard')->middleware(['auth', 'admin']);


// https://laravel.com/docs/11.x/controllers#actions-handled-by-resource-controllers

