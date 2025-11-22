<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }


    public function login(LoginRequest $request): RedirectResponse
    {
        try {
            $success = $this->authService->webLogin(
                $request->email,
                $request->password,
                $request->boolean('remember')
            );

            if ($success) {
                return redirect()->intended('/home')->with('success', 'Login realizado com sucesso!');
            }

            return back()->withErrors([
                'email' => 'Credenciais inválidas.',
            ])->withInput($request->except('password'));

        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()
                ->withErrors($e->errors())
                ->withInput($request->except('password'));
        }
    }


    public function apiLogin(LoginRequest $request): JsonResponse
    {
        try {
            $result = $this->authService->apiLogin($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Login realizado com sucesso!',
                'data' => $result
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao fazer login',
                'error' => $e->getMessage()
            ], 422);
        }
    }


    public function logout(Request $request): RedirectResponse
    {
        $this->authService->webLogout();
        return redirect('/')->with('success', 'Logout realizado com sucesso!');
    }


    public function apiLogout(Request $request): JsonResponse
    {
        try {
            $result = $this->authService->apiLogout($request->user());

            return response()->json([
                'success' => true,
                'message' => $result['message']
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao fazer logout',
            ], 500);
        }
    }

    public function me(Request $request): JsonResponse
    {
        return response()->json([
            'user' => $request->user()
        ]);
    }
}
