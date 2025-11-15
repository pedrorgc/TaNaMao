<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.public.home');
});
Route::get('/home', function () {
    return view('pages.public.home');
});
Route::get('/login', function () {
    return view('pages.public.login');
})->name('login');

Route::get('/contact', function () {
    return view('pages.public.contact');
})->name('contact');

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

Route::get('/cadastro', function () {
    return view('pages.public.pre-cadastro');
})->name('cadastro');

Route::get('/cadastro/cliente', function () {
    return view('pages.public.cadastro-cliente');
})->name('cadastro.cliente');

Route::get('/cadastro/prestador', function () {
    return view('pages.public.cadastro-prestador');
})->name('cadastro.prestador');

Route::post('/prestadores', [ProfileController::class, 'storePrestador'])->name('prestadores.store');
