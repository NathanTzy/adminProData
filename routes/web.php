<?php

use App\Http\Controllers\barangController;
use App\Http\Controllers\distributorController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\resellerController;
use App\Http\Controllers\userController;
use App\Http\Controllers\userResellerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.auth.login');
});

Route::get('/home', [homeController::class, 'index'])->name('home');

Route::middleware(['auth', 'cekRole:distributor,reseller'])->group(function () {
    Route::get('/inventori', fn () => view('pages.inventori.index'));
    Route::delete('/barang/history/{id}', [BarangController::class, 'deleteHistory'])->name('barang.history.destroy');
    Route::get('/reseller', fn () => view('pages.reseller.index'));
});

Route::resource('distributor', distributorController::class);
Route::resource('reseller', resellerController::class);
Route::resource('barang', barangController::class);
Route::resource('user', userController::class);
Route::resource('user-reseller', userResellerController::class);
Route::delete('/barang/history/{id}', [BarangController::class, 'deleteHistory'])->name('barang.history.destroy');



 