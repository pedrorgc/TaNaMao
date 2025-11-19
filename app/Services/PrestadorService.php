<?php

namespace App\Services;

use App\Models\Prestador;
use App\Models\User;

class PrestadorService
{
    public function createPrestador(User $user, $endereco, array $data): Prestador
    {
        return Prestador::create([
            'user_id'     => $user->id,
            'documento'   => $data['documento'] ?? null,
            'telefone'    => $data['telefone'] ?? null,
            'categoria_id'=> $data['categoria_id'] ?? null,
            'endereco_id' => $endereco?->id,
            'role_id'     => 2,
        ]);
    }
}
