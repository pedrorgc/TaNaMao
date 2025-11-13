<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('pages.public.home');
});
Route::get('/home', function () {
    return view('pages.public.home');
});

// Parte de login e logout
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login'); // formulario
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');   // processa
});

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout'); // logout

Route::get('/contact', function () {
    return view('pages.public.contact');
});

Route::get('/servicos/create', function () {
    return view('pages.public.service-create');
});

Route::get('/servicos', function () {
    return view('pages.public.service-area');
});

Route::middleware('auth')->group(function () {
    Route::get('/admin', function () {
        return view('pages.admin.profile');
    })->name('admin.dashboard');
});

Route::get('/profile', function () {
    return view('pages.public.profile');
});

Route::get('/profile/prestador', function () {
    return view('pages.public.profile-prestador');
});

Route::get('/pre-cadastro', function () {
    return view('pages.public.pre-cadastro');
});

Route::get('/cadastro-cliente', function () {
    return view('pages.public.cadastro-cliente');
});

Route::get('/cadastro-prestador', function () {
    return view('pages.public.cadastro-prestador');
});
