<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    public function profile()
    {
        return view('pages.admin.profile');
    }
}
