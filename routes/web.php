<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/profile', [ProfileController::class, 'index']);

Route::group(['prefix' => 'ideas/', 'as' => 'idea.'], function () {

    Route::post('', [IdeaController::class, 'store'])->name('store');
    Route::get('/{idea}', [IdeaController::class, 'show'])->name('show');

    Route::group(['middleware' => ['auth']], function () {
        Route::delete('/{idea}', [IdeaController::class, 'destroy'])->name('destroy');
        Route::get('/{idea}/edit', [IdeaController::class, 'edit'])->name('edit');
        Route::put('/{idea}', [IdeaController::class, 'update'])->name('update');
        Route::post('/{idea}/comments', [CommentController::class, 'store'])->name('comments.store');
    });
});



Route::get('/terms', function () {
    return view('terms');
});




// https://laravel.com/docs/11.x/controllers#actions-handled-by-resource-controllers
 