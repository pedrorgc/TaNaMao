<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.public.home');
});

<<<<<<< HEAD
Route::get('/about', function () {
    return view('pages.public.about');
=======
Route::get('/login', function () {
    return view('pages.login');
>>>>>>> main
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

Route::get('/profile', function () {
    return view('pages.profile');
});