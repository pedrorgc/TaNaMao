<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RegisterController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function create(): View
    {
        return view('auth.register');
    }

    public function store(RegisterUserRequest $request): RedirectResponse
    {
        // Os dados já vêm validados do RegisterUserRequest
        $user = $this->authService->register($request->validated());

        return back()
            ->with('success', 'Cadastro realizado com sucesso!');
    }

    public function createCliente(): View
    {
        return view('pages.public.cadastro-cliente');
    }

    public function createPrestador(): View
    {
        return view('pages.public.cadastro-prestador');
    }
}
