<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/profile', [ProfileController::class, 'index']);

Route::post('/ideas', [IdeaController::class, 'store'])->name('idea.store');
Route::delete('/ideas/{idea}', [IdeaController::class, 'destroy'])->name('idea.destroy');
Route::get('/ideas/{idea}', [IdeaController::class, 'show'])->name('idea.show');
Route::get('/ideas/{idea}/edit', [IdeaController::class, 'edit'])->name('idea.edit');
Route::put('/ideas/{idea}', [IdeaController::class, 'update'])->name('idea.update');

Route::get('/terms', function () {
    return view('terms');
});

Route::post('/ideas/{idea}/comments', [CommentController::class, 'store'])->name('idea.comments.store');

// Register
Route::get('/register', [AuthController::class,'register'])->name('register');
Route::post('/register', [AuthController::class,'store']);

//Login
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// https://laravel.com/docs/11.x/controllers#actions-handled-by-resource-controllers
 