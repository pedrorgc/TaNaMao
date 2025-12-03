<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function perfil()
    {
        return view('pages.admin.profile');
    }
}
