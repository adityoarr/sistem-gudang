<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\UserController;

Route::post('/login', [UserController::class, 'login']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/barang', [BarangController::class, 'index']);
    Route::get('/barang/{kode}', [BarangController::class, 'show']);
    Route::post('/barang', [BarangController::class, 'store']);
    Route::put('/barang/{kode}', [BarangController::class, 'update']);
    Route::delete('/barang/{kode}', [BarangController::class, 'destroy']);

    Route::get('/mutasi', [MutasiController::class, 'index']);
    Route::get('/mutasi/{id}', [MutasiController::class, 'show']);
    Route::post('/mutasi', [MutasiController::class, 'store']);
    Route::put('/mutasi/{id}', [MutasiController::class, 'update']);
    Route::delete('/mutasi/{id}', [MutasiController::class, 'destroy']);
    Route::get('/history-mutasi-barang/{kodeBarang}', [MutasiController::class, 'history_mutasi_barang']);
    Route::get('/history-mutasi-user/{idUser}', [MutasiController::class, 'history_mutasi_user']);

    Route::get('/user', [UserController::class, 'index']);
    Route::get('/user/{id}', [UserController::class, 'show']);
    Route::post('/user', [UserController::class, 'store']);
    Route::put('/user/{id}', [UserController::class, 'update']);
    Route::delete('/user/{id}', [UserController::class, 'destroy']);
});
