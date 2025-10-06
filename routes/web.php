<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/about', function () {
    return view('pages.about');
});

Route::get('/contact', function () {
    return view('pages.contact');
});

// ADICIONE A NOVA ROTA AQUI
Route::get('/cadastro', function () {
    return view('pages.cadastro');
});
// FIM DA NOVA ROTA

Route::view('/perfilUsuario', 'pages.profile')->name('pages.profile');