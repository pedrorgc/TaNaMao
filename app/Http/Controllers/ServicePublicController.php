<?php

namespace App\Http\Controllers;

class ServicePublicController extends Controller
{
    public function list()
    {
        return view('pages.public.service-area');
    }

    public function create()
    {
        return view('pages.public.service-create');
    }
}
