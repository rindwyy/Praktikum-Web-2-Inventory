<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;

// Membungkus seluruh route dengan prefix v1
Route::prefix('v1')->group(function () {

    // Rute Publik (Menjadi api/v1/register & api/v1/login)
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    // Rute Terproteksi Token
    Route::middleware([
    'auth:sanctum',
    'throttle:60,1'
    ])->group(function () {

    Route::apiResource('categories', CategoryController::class)->except(['destroy']);
    Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->middleware('role:admin');

    Route::apiResource('items', ItemController::class)->except(['destroy']);
    Route::delete('items/{item}', [ItemController::class, 'destroy'])->middleware('role:admin');

    });

});
