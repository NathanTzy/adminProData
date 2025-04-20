<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [App\Http\Controllers\api\authController::class, 'login']);
Route::get('all-user', [App\Http\Controllers\api\allUserController::class, 'index'])->middleware('auth:sanctum');
Route::post('/logout', [App\Http\Controllers\api\authController::class, 'logout'])->middleware('auth:sanctum');
Route::apiResource('barang', App\Http\Controllers\api\BarangController::class)->middleware('auth:sanctum');
Route::apiResource('reseller', App\Http\Controllers\api\resellerController::class)->middleware('auth:sanctum');
Route::apiResource('distributor', App\Http\Controllers\api\distributorController::class)->middleware('auth:sanctum');
Route::delete('barang-history/{id}', [App\Http\Controllers\api\BarangController::class, 'deleteHistory'])->middleware('auth:sanctum');
