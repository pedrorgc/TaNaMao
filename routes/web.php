<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.public.home');
});

Route::get('/about', function () {
    return view('pages.public.about');
});

Route::get('/contact', function () {
    return view('pages.public.contact');
});

Route::get('/servicos/create', function () {
    return view('pages.public.service-create');
});

Route::get('/admin', function () {
    return view('pages.admin.profile');
});
