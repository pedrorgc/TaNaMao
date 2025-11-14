<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Events\UserRegistered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(array $data): \App\Models\User
    {
        // Hash da senha
        $data['password'] = Hash::make($data['password']);

        // Remove password_confirmation antes de criar
        unset($data['password_confirmation']);

        // Cria o usuário através do repositório
        $user = $this->userRepository->create($data);

        // Loga o usuário automaticamente
        Auth::login($user);

        // Dispara o evento de registro
        event(new UserRegistered($user));

        return $user;
    }
}
