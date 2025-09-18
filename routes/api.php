<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LocationController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/location', [LocationController::class, 'store']);     // simpan lokasi
    Route::get('/location/last', [LocationController::class, 'last']); // lokasi terakhir
    Route::get('/location/history', [LocationController::class, 'history']); // histori per tanggal
});