<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LocalidadesController;
use App\Http\Controllers\ServicePublicController;
use Illuminate\Support\Facades\Route;

Route::get('/cep/{cep}', [LocalidadesController::class, 'cep']);

Route::post('/login', [AuthController::class, 'apiLogin']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'apiLogout']);
    Route::get('/me', [AuthController::class, 'me']);
});

