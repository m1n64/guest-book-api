<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/login', [\Modules\Auth\Http\Controllers\AuthController::class, 'login']);
    Route::post('/register', [\Modules\Auth\Http\Controllers\AuthController::class, 'register']);

    Route::delete('/logout', [\Modules\Auth\Http\Controllers\AuthController::class, 'logout'])->middleware(['auth:sanctum']);
});
