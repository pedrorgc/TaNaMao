<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PrestadorController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServicePublicController;


Route::get('/', [PublicController::class, 'home']);
Route::get('/home', [PublicController::class, 'home'])->name('home');
Route::get('/login', [PublicController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/contact', [PublicController::class, 'contact'])->name('contact');

Route::get('/servicos/create', [PublicController::class, 'serviceCreate']);
Route::get('/servicos', [ServicePublicController::class, 'list'])->name('servicos.list');

Route::get('/admin', [PublicController::class, 'adminProfile']);
Route::get('/profile', [PublicController::class, 'profile']);
Route::get('/profile/prestador', [PublicController::class, 'profilePrestador']);


Route::get('/cadastro', [PublicController::class, 'preCadastro'])->name('cadastro');
Route::get('/cadastro/cliente', [PublicController::class, 'cadastroCliente'])->name('cadastro.cliente');
Route::get('/cadastro/prestador', [ProfileController::class, 'createPrestador'])
    ->name('cadastro.prestador');


Route::post('/prestadores', [PrestadorController::class, 'storePrestador'])
    ->name('prestadores.store');

Route::post('/clientes', [ClienteController::class, 'storeCliente'])
    ->name('clientes.store');
