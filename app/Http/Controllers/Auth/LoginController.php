<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function showLoginForm()
    {
        return view('pages.public.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $remember = $request->boolean('remember');

        try {
            $this->authService->login($data, $remember);
            return redirect()->intended('/home');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Erro ao tentar fazer login.'])->withInput();
        }
    }

    public function logout(): RedirectResponse
    {
        $this->authService->logout();
        return redirect('/login')->with('success', 'Você saiu da sua conta.');
    }
}
