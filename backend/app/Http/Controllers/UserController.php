<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Example data, replace with actual user retrieval logic
        $users = [
            ['id' => 1, 'name' => 'Pedro'],
            ['id' => 2, 'name' => 'Luiz'],
        ];

        return response()->json($users);
    }
}
