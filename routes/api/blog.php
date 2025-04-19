<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

Route::prefix('/blogs')->group(function () {
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::controller(BlogController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/{id}', 'show');
            Route::post('/', 'store');
            Route::post('/comment', 'comment');
            Route::post('/like', 'like');
        });
    });
});
