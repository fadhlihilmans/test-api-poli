<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PendaftaranController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::apiResource('poli', PoliController::class);
Route::apiResource('pasien', PasienController::class);
Route::apiResource('dokter', DokterController::class);
Route::apiResource('pendaftaran', PendaftaranController::class);