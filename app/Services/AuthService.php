<?php

namespace App\Services;

use App\Events\UserRegistered;
use App\Models\Cliente;
use App\Models\Endereco;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(array $data)
    {
        $data['password'] = Hash::make($data['password']);

        $endereco = Endereco::create($data['endereco']);

        $user = $this->userRepository->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        $cliente = Cliente::create([
            'user_id' => $user->id,
            'telefone' => $data['telefone'] ?? null,
            'endereco_id' => $endereco->id,
            'role_id' => $this->getRoleId($data['role']),
        ]);

        Auth::login($user);

        event(new UserRegistered($user));

        return $user;
    }

    private function getRoleId(string $role)
    {
        return \DB::table('roles')->where('name', $role)->value('id');
    }
}
