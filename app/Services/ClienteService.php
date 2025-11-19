<?php

namespace App\Services;

use App\Models\Cliente;
use App\Models\User;

class ClienteService
{
    public function createCliente(User $user, $endereco, array $data): Cliente
    {
        return Cliente::create([
            'user_id'        => $user->id,
            'cpf'            => $data['cpf'] ?? null,
            'rg'             => $data['rg'] ?? null,
            'data_nascimento'=> $data['data_nascimento'] ?? null,
            'genero'         => $data['genero'] ?? null,
            'telefone'       => $data['telefone'] ?? null,
            'endereco_id'    => $endereco?->id,
            'role_id'        => 3,
        ]);
    }
}
