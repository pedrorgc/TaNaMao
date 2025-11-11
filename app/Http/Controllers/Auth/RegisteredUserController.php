<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class RegisteredUserController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function create()
    {
        return view('pages.public.cadastro');
    }

    public function store(RegisterUserRequest $request)
    {
        $validated = $request->validated();

        $user = $this->authService->register($validated);

        return redirect('/home')->with('success', 'Conta criada com sucesso!');
    }
}
