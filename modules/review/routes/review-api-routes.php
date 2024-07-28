<?php

use Illuminate\Support\Facades\Route;

Route::prefix('reviews')->group(function () {
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('/', [\Modules\Review\Http\Controllers\ReviewController::class, 'store']);
        Route::post('/reply/{review}', [\Modules\Review\Http\Controllers\ReviewController::class, 'reply'])->middleware(['admin']);
    });

    Route::get('/', [\Modules\Review\Http\Controllers\ReviewController::class, 'index']);
});
