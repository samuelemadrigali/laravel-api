<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Authentication routes
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/user', [UserController::class, 'user'])->name('user');

    Route::prefix('/projects')->name('projects.')->group(function () {
        Route::get('/', [ProjectController::class, 'index'])->name('index');
        Route::get('/{project}', [ProjectController::class, 'show'])->name('show')->middleware('can:view,project');
        Route::post('/', [ProjectController::class, 'store'])->name('store');
        Route::put('/{project}', [ProjectController::class, 'update'])->name('update')->middleware('can:update,project');
        Route::delete('/{project}', [ProjectController::class, 'destroy'])->name('destroy')->middleware('can:delete,project');
    });
});
