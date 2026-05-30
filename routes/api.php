<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController; 

// Daftarkan route auth untuk Register dan Login (Bisa diakses tanpa token)
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Daftarkan route untuk Category dan Item (Hanya bisa diakses dengan token)
Route::middleware('auth:sanctum')->group(function () {
    
    /* Terapkan role:admin pada delete routes Categories --- */
    Route::apiResource('categories', CategoryController::class)->except(['destroy']);
    Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->middleware('role:admin');

    /* Terapkan role:admin pada delete routes Items --- */
    Route::apiResource('items', ItemController::class)->except(['destroy']);
    Route::delete('items/{item}', [ItemController::class, 'destroy'])->middleware('role:admin');
    
});

Route::get('test', function () {
    return response()->json(['message' => 'OK']);
});