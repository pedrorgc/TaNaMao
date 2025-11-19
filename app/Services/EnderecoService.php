<?php

namespace App\Services;

use App\Models\Endereco;

class EnderecoService
{
    public function createEndereco(array $data): ?Endereco
    {
        $enderecoData = collect($data)->only([
            'cep',
            'logradouro',
            'numero',
            'complemento',
            'bairro',
            'cidade',
            'estado'
        ])->filter()->all();

        return empty($enderecoData)
            ? null
            : Endereco::create($enderecoData);
    }
}
