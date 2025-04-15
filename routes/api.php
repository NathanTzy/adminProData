<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [App\Http\Controllers\api\authController::class, 'login']);
Route::apiResource('user', App\Http\Controllers\api\UserController::class)->middleware('auth:sanctum');
Route::post('/logout', [App\Http\Controllers\api\authController::class, 'logout'])->middleware('auth:sanctum');
