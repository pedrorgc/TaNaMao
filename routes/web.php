<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.public.home');
});

Route::get('/login', function () {
    return view('pages.public.login');
});

Route::get('/contact', function () {
    return view('pages.public.contact');
});

// Sua rota de cadastro
Route::get('/cadastro', function () {
    return view('pages.cadastro');
});

// Rotas que vieram da branch main
Route::get('/servicos/create', function () {
    return view('pages.public.service-create');
});

Route::get('/admin', function () {
    return view('pages.admin.profile');
});

Route::get('/profile', function () {
    return view('pages.public.profile');
});

// A rota de perfilUsuario que você já tinha
Route::view('/perfilUsuario', 'pages.profile')->name('pages.profile');