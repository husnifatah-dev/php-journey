<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PegawaiApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::get('/pegawai', [PegawaiApiController::class, 'index']);
    Route::post('/pegawai', [PegawaiApiController::class, 'store']);
    Route::get('/pegawai/{id}', [PegawaiApiController::class, 'show']);
    Route::put('/pegawai/{id}', [PegawaiApiController::class, 'update']);
    Route::delete('/pegawai/{id}', [PegawaiApiController::class, 'destroy']);
});
