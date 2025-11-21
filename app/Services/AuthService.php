<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    /**
     * Login via Web (Session) - VERIFICA NO BANCO DE DADOS
     */
    public function webLogin($email, $password, $remember = false): bool
    {
        $credentials = [
            'email' => $email,
            'password' => $password,
        ];

        // Tentativa de autenticação
        if (Auth::attempt($credentials, $remember)) {
            // Regenerar session ID para prevenir fixation attacks
            request()->session()->regenerate();
            return true;
        }

        // Se não encontrou, lançar exceção de validação
        throw ValidationException::withMessages([
            'email' => ['As credenciais fornecidas estão incorretas.'],
        ]);
    }

    /**
     * Login via API (Sanctum)
     */
    public function apiLogin(array $credentials): array
    {
        $user = User::where('email', $credentials['email'])->first();

        // Verificar se usuário existe e senha está correta
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['As credenciais fornecidas estão incorretas.'],
            ]);
        }

        // Criar token Sanctum
        $token = $user->createToken('auth-token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    /**
     * Logout via Web (Session)
     */
    public function webLogout(): void
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }

    /**
     * Logout via API (Sanctum)
     */
    public function apiLogout($user): array
    {
        // Revogar o token atual
        $user->currentAccessToken()->delete();

        return [
            'message' => 'Logout realizado com sucesso.'
        ];
    }

    /**
     * Obter usuário autenticado
     */
    public function getUser()
    {
        return Auth::user();
    }
}
