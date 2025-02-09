<?php

declare(strict_types=1);

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::as('api.')->group(static function () {
    Route::as('auth.register')->post('register', [AuthController::class, 'register']);
    Route::as('auth.login')->post('login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(static function () {
        Route::as('auth.logout')->post('logout', [AuthController::class, 'logout']);
        Route::apiResource('tasks', TaskController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
        Route::apiResource('users', UserController::class)->only(['index', 'destroy']);
        Route::as('users.update')->put('users', [UserController::class, 'update']);
        Route::as('users.me')->get('users/me', [UserController::class, 'me']);
    });
});
