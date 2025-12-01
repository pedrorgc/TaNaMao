<?php

namespace App\Http\Controllers;

class PublicController extends Controller
{
    public function home()
    {
        return view('pages.public.home');
    }

    public function login()
    {
        return view('pages.public.login');
    }

    public function contact()
    {
        return view('pages.public.contact');
    }

    public function profile()
    {
        return view('pages.public.profile');
    }

    public function profilePrestador()
    {
        return view('pages.public.profile-prestador');
    }

    public function preCadastro()
    {
        return view('pages.public.pre-cadastro');
    }

    public function cadastroCliente()
    {
        return view('pages.public.cadastro-cliente');
    }

    public function adminProfile()
    {
        return view('pages.admin.dashboard');
    }
}
