<?php

use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\AuthController;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartemenController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);

ROute::middleware('auth')->group(function () {

    Route::get('/pegawai', [PegawaiController::class, 'index']);
    Route::get('/pegawai/create', [PegawaiController::class, 'create']);
    Route::post('/pegawai', [PegawaiController::class, 'store']);
    Route::get('/pegawai/{id}/detail', [PegawaiController::class, 'show']);
    Route::get('/pegawai/{id}/edit', [PegawaiController::class, 'edit']);
    Route::put('/pegawai/{id}', [PegawaiController::class, 'update']);
    Route::delete('/pegawai/{id}', [PegawaiController::class, 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::get('/pegawai/sampah', [PegawaiController::class, 'sampah']);
    Route::post('/pegawai/{id}/restore', [PegawaiController::class, 'restore']);
    Route::delete('/pegawai/{id}/force-delete', [PegawaiController::class, 'forceDelete']);
    Route::resource('departemen', DepartemenController::class)->except(['create', 'show', 'edit']);
    Route::get('/pegawai/{id}/cetak-id-card', [PegawaiController::class, 'cetakIdCard']);

});

Route::get('/pegawai/export/excel', [PegawaiController::class, 'exportExcel']);
Route::get('dashboard', [DashboardController::class, 'index']);