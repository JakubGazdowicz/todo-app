<?php

use App\Http\Controllers\TaskCategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/users/search', [UserController::class, 'search'])
    ->name('api.users.search');

Route::get('/task-categories/search', [TaskCategoryController::class, 'search'])
    ->name('api.task-categories.search');
