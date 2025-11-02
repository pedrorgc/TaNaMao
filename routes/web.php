<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('pages.public.home');
});
Route::get('/home', function () {
    return view('pages.public.home');
});
Route::get('/login', function () {
    return view('pages.public.login');
})->name('login')->middleware('guest');

// auth form handlers
Route::post('/login', [AuthController::class, 'login'])->name('login.perform');
Route::post('/register', [AuthController::class, 'register'])->name('register.perform');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Sua rota de cadastro (visível para guests so que possam se registrar)
Route::get('/cadastro', function () {
    return view('pages.public.cadastro');
})->middleware('guest');

// Rotas protegidas - requer autenticação
Route::middleware('auth')->group(function () {
    Route::get('/contact', function () {
        return view('pages.public.contact');
    })->name('contact');

    // Rotas que vieram da branch main e agora protegidas
    Route::get('/servicos/create', function () {
    $user = Auth::user();
        // only prestador can create services
        if (! $user || ! $user->cliente || ! $user->cliente->role || $user->cliente->role->name !== 'prestador') {
            abort(403, 'Apenas prestadores podem anunciar serviços.');
        }
        return view('pages.public.service-create');
    })->name('servicos.create');

    Route::get('/servicos', function () {
        return view('pages.public.service-area');
    })->name('servicos.index');

    Route::get('/admin', function () {
    $user = Auth::user();
        if (! $user || ! $user->cliente || ! $user->cliente->role || $user->cliente->role->name !== 'admin') {
            abort(403, 'Acesso negado.');
        }
        return view('pages.admin.profile');
    })->name('admin.dashboard');

    Route::get('/profile', function () {
    $user = Auth::user();
        // if prestador, redirect to prestador profile
        if ($user && $user->cliente && $user->cliente->role && $user->cliente->role->name === 'prestador') {
            return redirect()->route('profile.prestador');
        }
        return view('pages.public.profile');
    })->name('profile');

    Route::get('/profile/prestador', function () {
    $user = Auth::user();
        if (! $user || ! $user->cliente || ! $user->cliente->role || $user->cliente->role->name !== 'prestador') {
            abort(403, 'Apenas prestadores podem ver esta página.');
        }
        return view('pages.public.profile-prestador');
    })->name('profile.prestador');
});
