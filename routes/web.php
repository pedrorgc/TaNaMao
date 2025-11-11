<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.public.home');
});
Route::get('/home', function () {
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
    return view('pages.public.cadastro');
});

// Rotas que vieram da branch main
Route::get('/servicos/create', function () {
    return view('pages.public.service-create');
});

Route::get('/servicos', function () {
    return view('pages.public.service-area');
});

Route::get('/admin', function () {
    return view('pages.admin.profile');
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
