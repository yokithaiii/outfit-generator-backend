<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/telegram', [AuthController::class, 'login']);
});

//Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index']);
    });

    Route::prefix('items')->group(function () {
        Route::get('/', [ItemsController::class, 'index']);
        Route::get('/{item}', [ItemsController::class, 'show']);
        Route::post('/', [ItemsController::class, 'store']);
        Route::post('/{item}', [ItemsController::class, 'update']);
        Route::delete('/{item}', [ItemsController::class, 'destroy']);
    });

    Route::prefix('upload')->group(function () {
        Route::post('/', [UploadController::class, 'upload']);
    });

//});
