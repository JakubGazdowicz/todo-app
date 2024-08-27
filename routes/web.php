<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskCategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard.index');

    Route::prefix('/profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])
            ->name('profile.edit');

        Route::patch('/', [ProfileController::class, 'update'])
            ->name('profile.update');

        Route::delete('/', [ProfileController::class, 'destroy'])
            ->name('profile.destroy');
    });

    Route::prefix('/users')->group(function () {
        Route::get('/', [UserController::class, 'index'])
            ->name('users.index');

        Route::get('/{user}', [UserController::class, 'show'])
            ->name('users.show');

        Route::post('/', [UserController::class, 'store'])
            ->name('users.store');

        Route::put('/{user}', [UserController::class, 'update'])
            ->name('users.update');

        Route::delete('/{user}', [UserController::class, 'destroy'])
            ->name('users.destroy');
    });

    Route::prefix('/task-categories')->group(function () {
        Route::get('/', [TaskCategoryController::class, 'index'])
            ->name('task-categories.index');

        Route::get('/{taskCategory}', [TaskCategoryController::class, 'show'])
            ->name('task-categories.show');

        Route::post('/', [TaskCategoryController::class, 'store'])
            ->name('task-categories.store');

        Route::put('/{taskCategory}', [TaskCategoryController::class, 'update'])
            ->name('task-categories.update');

        Route::delete('/{taskCategory}', [TaskCategoryController::class, 'destroy'])
            ->name('task-categories.destroy');
    });
});

require __DIR__.'/auth.php';
