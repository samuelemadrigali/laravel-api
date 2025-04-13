<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Authentication routes
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/user', [UserController::class, 'user'])->name('user');
});
