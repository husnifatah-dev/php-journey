<?php

use App\Http\Controllers\Api\PegawaiApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/pegawai', [PegawaiApiController::class, 'index']);
Route::post('/pegawai', [PegawaiApiController::class, 'store']);
Route::get('/pegawai/{id}', [PegawaiApiController::class, 'show']);
Route::put('/pegawai/{id}', [PegawaiApiController::class, 'update']);
Route::delete('/pegawai/{id}', [PegawaiApiController::class, 'destroy']);