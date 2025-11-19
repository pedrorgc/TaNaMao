<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocalidadesController;

Route::get('/cep/{cep}', [LocalidadesController::class, 'cep']);
