<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocalidadesController;

Route::get('/estados', [LocalidadesController::class, 'estados']);
Route::get('/estados/{uf}/cidades', [LocalidadesController::class, 'cidades']);
