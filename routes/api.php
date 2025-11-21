<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LocalidadesController;
use Illuminate\Support\Facades\Route;

Route::get('/cep/{cep}', [LocalidadesController::class, 'cep']);

// API Routes
Route::post('/login', [AuthController::class, 'apiLogin']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'apiLogout']);
    Route::get('/me', [AuthController::class, 'me']);
});
