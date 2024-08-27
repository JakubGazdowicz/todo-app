<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
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
});

require __DIR__.'/auth.php';
