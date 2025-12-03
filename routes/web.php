<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PrestadorController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServicePublicController;
use Illuminate\Support\Facades\Auth;

Route::get('/', [PublicController::class, 'home']);
Route::get('/home', [PublicController::class, 'home'])->name('home');
Route::get('/login', [PublicController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/sobre', [PublicController::class, 'sobre'])->name('sobre');

Route::get('/cadastro', [PublicController::class, 'preCadastro'])->name('cadastro');
Route::get('/cadastro/cliente', [PublicController::class, 'cadastroCliente'])->name('cadastro.cliente');
Route::get('/cadastro/prestador', [PrestadorController::class, 'create'])->name('cadastro.prestador');

Route::post('/clientes', [ClienteController::class, 'storeCliente'])->name('clientes.store');
Route::post('/prestadores', [PrestadorController::class, 'storePrestador'])->name('prestadores.store');

Route::get('/area-servicos', [ServicePublicController::class, 'list'])->name('area-servicos');
Route::get('/servicos', [ServicePublicController::class, 'index'])->name('servicos.index');
Route::get('/servicos/{slug}', [ServicePublicController::class, 'showByCategory'])->name('servicos.by-category');
Route::get('/servico/{id}', [ServicePublicController::class, 'show'])->name('servicos.show');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');

Route::get('/servicos/busca-rapida', [ServicePublicController::class, 'buscarRapido'])
    ->name('servicos.busca-rapida');

Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('/profile/settings', [ProfileController::class, 'updateSettings'])->name('profile.settings.update');
    Route::post('/prestador/agenda', [PrestadorController::class, 'updateAgenda'])->name('prestador.agenda.update');

    Route::middleware(['role:prestador'])->group(function () {
        Route::get('/prestador/dashboard', [PrestadorController::class, 'dashboard'])->name('prestador.dashboard');
        Route::get('/prestador/servicos', [ServicePublicController::class, 'myServices'])->name('prestador.servicos.index');

        Route::get('/servicos/create', [ServicePublicController::class, 'create'])->name('servicos.create');
        Route::post('/servicos', [ServicePublicController::class, 'store'])->name('servicos.store');
        Route::get('/servicos/{id}/edit', [ServicePublicController::class, 'edit'])->name('servicos.edit');
        Route::put('/servicos/{id}', [ServicePublicController::class, 'update'])->name('servicos.update');
        Route::delete('/servicos/{id}', [ServicePublicController::class, 'destroy'])->name('servicos.destroy');

        Route::get('/prestador/profile', [PrestadorController::class, 'profile'])->name('prestador.profile');
        Route::get('/prestador/editar', [PrestadorController::class, 'edit'])->name('prestador.edit');
        Route::put('/prestador/update', [PrestadorController::class, 'update'])->name('prestador.update');
    });

    Route::middleware(['role:cliente'])->group(function () {
        Route::get('/cliente/dashboard', [ClienteController::class, 'dashboard'])->name('cliente.dashboard');
        Route::get('/cliente/profile', [ClienteController::class, 'profile'])->name('cliente.profile');
        Route::get('/cliente/servicos', [ClienteController::class, 'myServices'])->name('cliente.servicos');
    });
});
