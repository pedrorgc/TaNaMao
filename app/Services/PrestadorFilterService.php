<?php

namespace App\Services;

use App\Models\Prestador;
use App\Models\Categoria;

class PrestadorFilterService
{
    public function filter(array $filtros, int $perPage = 12)
    {
        $query = Prestador::with(['user', 'endereco', 'categoria']);

        // Filtro por nome ou email do prestador
        if (!empty($filtros['search'])) {
            $search = $filtros['search'];
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filtro por categoria
        if (!empty($filtros['categoria'])) {
            $query->where('categoria_id', $filtros['categoria']);
        }

        // Filtro por cidade
        if (!empty($filtros['cidade'])) {
            $cidade = $filtros['cidade'];
            $query->whereHas('endereco', function ($q) use ($cidade) {
                $q->where('cidade', 'like', "%{$cidade}%");
            });
        }

        // Filtro por estado
        if (!empty($filtros['estado'])) {
            $estado = $filtros['estado'];
            $query->whereHas('endereco', function ($q) use ($estado) {
                $q->where('estado', 'like', "%{$estado}%");
            });
        }

        return $query->paginate($perPage);
    }

    public function getCategorias()
    {
        return Categoria::all();
    }
}
