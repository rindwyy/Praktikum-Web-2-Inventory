<?php
use Illuminate\Support\Facades\Route;

Route::apiResource('categories', App\Http\Controllers\CategoryController::class);
Route::apiResource('items', App\Http\Controllers\ItemController::class);

Route::get('test', function () {
return response()->json(['message' => 'OK']);


});