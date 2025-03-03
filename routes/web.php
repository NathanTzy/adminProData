<?php

use App\Http\Controllers\distributorController;
use App\Http\Controllers\homeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.auth.login');
});

Route::get('/home', [homeController::class, 'index'])->name('home');

Route::resource('distributor', distributorController::class);
 