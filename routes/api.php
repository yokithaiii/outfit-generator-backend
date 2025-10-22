<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/telegram', [AuthController::class, 'login']);
});

Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']);
});

Route::prefix('items')->group(function () {
    //
});
