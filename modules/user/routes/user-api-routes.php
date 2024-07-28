<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->prefix('user')->group(function () {
    Route::get('/', \Modules\User\Http\Controllers\UserController::class);
});
