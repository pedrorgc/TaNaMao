<?php

namespace App\Services;

use App\Models\User;
use App\Models\Prestador;
use App\Models\Cliente;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;

class ProfileService
{
    public function getUserProfileData(User $user): array
    {
        $isPrestador = $user->isPrestador();
        $isCliente = $user->isCliente();

        $baseData = [
            'user' => $user,
            'isPrestador' => $isPrestador,
            'isCliente' => $isCliente,
            'sigla' => strtoupper(substr($user->name, 0, 2)),
            'nome' => $user->name,
            'ocupacao' => $isPrestador ? 'Prestador' : 'Cliente',
            'dataCadastro' => $user->created_at->format('F Y'),
            'status' => $isPrestador ? 'Status do perfil: Ativo' : '',
            'categorias' => Categoria::all(),
        ];

        if ($isPrestador) {
            return array_merge($baseData, $this->getPrestadorData($user));
        }

        return array_merge($baseData, $this->getClienteData($user));
    }

    private function getPrestadorData(User $user): array
    {
        // Usa eager loading (with) para performance
        $prestador = Prestador::where('user_id', $user->id)
            ->with(['endereco', 'categoria'])
            ->first();

        // Evita erro se prestador não existir (embora deva existir)
        if (!$prestador) {
            return []; 
        }

        $endereco = $prestador->endereco ?? null;
        $categoria = $prestador->categoria ?? null;

        return [
            'prestador' => $prestador,
            'telefone' => $prestador->telefone ?? '',
            'descricao' => $prestador->descricao ?? '', // <--- O CAMPO NOVO
            'categoria' => $categoria->nome ?? 'Não definida',
            'categoria_id' => $prestador->categoria_id ?? null,
            'localizacao' => $endereco ? "{$endereco->cidade} - {$endereco->estado}" : 'Endereço não cadastrado',
            'agenda' => json_decode($prestador->agenda ?? '{}', true),
        ];
    }

    private function getClienteData(User $user): array
    {
        $cliente = Cliente::where('user_id', $user->id)
            ->with('endereco')
            ->first();
            
        if (!$cliente) {
            return [];
        }

        $endereco = $cliente->endereco ?? null;

        return [
            'cliente' => $cliente,
            'telefone' => $cliente->telefone ?? '',
            'localizacao' => $endereco ? "{$endereco->cidade} - {$endereco->estado}" : 'Endereço não cadastrado',
        ];
    }

    public function updateUserProfile(User $user, array $data): void
    {
        DB::transaction(function () use ($user, $data) {
            $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
            ]);

            if ($user->isPrestador()) {
                $this->updatePrestadorProfile($user, $data);
            } else if ($user->isCliente()) {
                $this->updateClienteProfile($user, $data);
            }
        });
    }

    private function updatePrestadorProfile(User $user, array $data): void
    {
        $prestador = Prestador::where('user_id', $user->id)->first();

        if ($prestador) {
            $updateData = [
                'telefone' => $data['telefone'] ?? $prestador->telefone,
            ];

            // Verifica se a chave existe (mesmo que seja null/vazio) para permitir apagar
            if (array_key_exists('descricao', $data)) {
                $updateData['descricao'] = $data['descricao'];
            }

            if (array_key_exists('categoria_id', $data)) {
                $updateData['categoria_id'] = $data['categoria_id'];
            }

            $prestador->update($updateData);
        }
    }

    private function updateClienteProfile(User $user, array $data): void
    {
        $cliente = Cliente::where('user_id', $user->id)->first();

        if ($cliente) {
            $cliente->update([
                'telefone' => $data['telefone'] ?? $cliente->telefone,
            ]);
        }
    }

    public function updateUserSettings(User $user, array $settings): void
    {
        $user->update([
            'notificacao_email' => $settings['notificacao_email'] ?? false,
            'notificacao_push' => $settings['notificacao_push'] ?? false,
        ]);
    }

    public function updatePrestadorAgenda(User $user, array $agendaData): void
    {
        if (!$user->isPrestador()) {
            throw new \Exception('Apenas prestadores podem atualizar agenda.');
        }

        $prestador = Prestador::where('user_id', $user->id)->first();

        $agenda = [];
        $dias = ['segunda', 'terca', 'quarta', 'quinta', 'sexta', 'sabado', 'domingo'];

        foreach ($dias as $dia) {
            $agenda[$dia] = [
                'ativo' => $agendaData[$dia]['ativo'] ?? false,
                'inicio' => $agendaData[$dia]['inicio'] ?? '08:00',
                'fim' => $agendaData[$dia]['fim'] ?? '17:00',
            ];
        }

        $prestador->update([
            'agenda' => json_encode($agenda)
        ]);
    }
}