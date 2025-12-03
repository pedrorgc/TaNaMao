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

    public function updateEndereco(?Endereco $endereco, array $data): Endereco
    {
        if (!$endereco) {
            return $this->createEndereco($data);
        }

        $endereco->update([
            'cep'        => $data['cep'] ?? $endereco->cep,
            'estado'     => $data['estado'] ?? $endereco->estado,
            'cidade'     => $data['cidade'] ?? $endereco->cidade,
            'logradouro' => $data['logradouro'] ?? $endereco->logradouro,
            'numero'     => $data['numero'] ?? $endereco->numero,
            'bairro'     => $data['bairro'] ?? $endereco->bairro,
            'complemento' => $data['complemento'] ?? $endereco->complemento,
            'pais'       => $data['pais'] ?? $endereco->pais,
        ]);

        return $endereco;
    }
}
