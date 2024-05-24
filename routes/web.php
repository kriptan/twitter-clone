<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/profile', [ProfileController::class, 'index']);

Route::post('/ideas', [IdeaController::class, 'store'])->name('idea.store');
Route::delete('/ideas/{idea}', [IdeaController::class, 'destroy'])->name('idea.destroy');
Route::get('/ideas/{idea}', [IdeaController::class, 'show'])->name('idea.show');

Route::get('/terms', function () {
    return view('terms');
});

// https://laravel.com/docs/11.x/controllers#actions-handled-by-resource-controllers
