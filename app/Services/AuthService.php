<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    
    public function webLogin($email, $password, $remember = false): bool
    {
        $credentials = [
            'email' => $email,
            'password' => $password,
        ];

       
        if (Auth::attempt($credentials, $remember)) {
            
            request()->session()->regenerate();
            return true;
        }

        throw ValidationException::withMessages([
            'email' => ['As credenciais fornecidas estão incorretas.'],
        ]);
    }

    public function apiLogin(array $credentials): array
    {
        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['As credenciais fornecidas estão incorretas.'],
            ]);
        }

        $token = $user->createToken('auth-token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    public function webLogout(): void
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }

   
    public function apiLogout($user): array
    {
        $user->currentAccessToken()->delete();

        return [
            'message' => 'Logout realizado com sucesso.'
        ];
    }

    public function getUser()
    {
        return Auth::user();
    }
}
