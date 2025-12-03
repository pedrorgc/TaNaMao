<?php

namespace App\Services;

use App\Models\Servico;
use App\Models\Prestador;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ServicoService
{
    public function buscarPrestadoresPorCategoria($categoriaId = null)
    {
        $query = Prestador::with(['user', 'endereco']);

        if ($categoriaId) {
            $query->where('categoria_id', $categoriaId);
        }

        return $query->get();
    }

    public function prepararDadosPrestador(Prestador $prestador)
    {
        $dados = [
            'cpf_cnpj' => $prestador->documento ?? '',
            'telefone' => $prestador->telefone ?? '',
            'categoria_id' => $prestador->categoria_id ?? '',
            'progresso' => 0,
            'tem_documento' => false,
            'tem_telefone' => false,
            'tem_categoria' => false,
            'tem_endereco_completo' => false,
            'logradouro' => '',
            'numero' => '',
            'complemento' => '',
            'bairro' => '',
            'pais' => 'Brasil',
            'cep' => '',
            'estado' => '',
            'cidade' => '',
            'endereco' => '',
            'categoria_nome' => ''
        ];

        $pontos = 0;
        $totalPontos = 4;

        if (!empty($prestador->documento)) {
            $dados['tem_documento'] = true;
            $pontos++;
        }

        if (!empty($prestador->telefone)) {
            $dados['tem_telefone'] = true;
            $pontos++;
        }

        if (!empty($prestador->categoria_id)) {
            $dados['tem_categoria'] = true;
            $pontos++;

            $categoria = Categoria::find($prestador->categoria_id);
            if ($categoria) {
                $dados['categoria_nome'] = $categoria->nome;
            }
        }

        if ($prestador->endereco) {
            $endereco = $prestador->endereco;

            $dados['logradouro'] = $endereco->logradouro ?? '';
            $dados['numero'] = $endereco->numero ?? '';
            $dados['complemento'] = $endereco->complemento ?? '';
            $dados['bairro'] = $endereco->bairro ?? '';
            $dados['pais'] = $endereco->pais ?? 'Brasil';
            $dados['cep'] = $endereco->cep ?? '';
            $dados['estado'] = $endereco->estado ?? '';
            $dados['cidade'] = $endereco->cidade ?? '';

            if (
                !empty($endereco->logradouro) && !empty($endereco->numero) &&
                !empty($endereco->cidade) && !empty($endereco->estado)
            ) {
                $dados['tem_endereco_completo'] = true;
                $pontos++;
            }

            $dados['endereco'] = $this->formatarEndereco($endereco);
        }

        $dados['progresso'] = ($pontos / $totalPontos) * 100;

        return $dados;
    }

    private function formatarEndereco($endereco)
    {
        $parts = [];
        if ($endereco->logradouro) $parts[] = $endereco->logradouro;
        if ($endereco->numero) $parts[] = 'Nº ' . $endereco->numero;
        if ($endereco->complemento) $parts[] = $endereco->complemento;
        if ($endereco->bairro) $parts[] = $endereco->bairro;

        $enderecoFormatado = implode(', ', $parts);

        if ($endereco->cidade || $endereco->estado) {
            $enderecoFormatado .= ' - ' . $endereco->cidade . '/' . $endereco->estado;
        }

        if ($endereco->cep) {
            $enderecoFormatado .= ' - CEP: ' . $endereco->cep;
        }

        return $enderecoFormatado;
    }

    public function verificarPrestadorUsuario($userId)
    {
        return Prestador::with(['endereco', 'categoria'])
            ->where('user_id', $userId)
            ->first();
    }

    public function criarServico(array $data, Prestador $prestador)
    {
        return DB::transaction(function () use ($data, $prestador) {
            $usarEnderecoCadastro = isset($data['usar_endereco_cadastro'])
                && $prestador->endereco
                && $data['usar_endereco_cadastro'] == '1';

            $servicoData = [
                'prestador_id' => $prestador->id,
                'categoria_id' => $data['categoria_id'],
                'titulo' => $data['titulo'],
                'descricao' => $data['descricao'],
                'tipo_servico' => $data['tipo_servico'],
                'tipo_valor' => $data['tipo_valor'],
                'status' => 'pendente',
                'verificado' => false,
                'visualizacoes' => 0,
            ];

            $servicoData['cpf_cnpj_servico'] = !empty($data['cpf_cnpj_servico'])
                ? $data['cpf_cnpj_servico']
                : null;

            $servicoData['telefone_servico'] = !empty($data['telefone_servico'])
                ? $data['telefone_servico']
                : null;

            if ($data['tipo_valor'] == 'hora' && isset($data['valor_hora'])) {
                $servicoData['valor_hora'] = $data['valor_hora'];
            } elseif ($data['tipo_valor'] == 'fixo' && isset($data['valor_fixo'])) {
                $servicoData['valor_fixo'] = $data['valor_fixo'];
            }

            if ($usarEnderecoCadastro && $prestador->endereco) {
                $servicoData['endereco_servico_id'] = $prestador->endereco_id;
                $servicoData['cidade_servico'] = $prestador->endereco->cidade;
                $servicoData['estado_servico'] = $prestador->endereco->estado;
                $servicoData['cep_servico'] = $prestador->endereco->cep;
            } else {
                $servicoData['cidade_servico'] = $data['cidade_servico'] ?? null;
                $servicoData['estado_servico'] = $data['estado_servico'] ?? null;
                $servicoData['cep_servico'] = $data['cep_servico'] ?? null;
            }

            $servico = Servico::create($servicoData);

            $servico->slug = Str::slug($servico->titulo);
            $servico->save();

            return $servico;
        });
    }

    public function buscarServicosComFiltros(array $filtros = [], $perPage = 8)
    {
        $query = Servico::with(['prestador', 'categoria'])
            ->where('status', 'ativo')
            ->where('verificado', true);

        if (isset($filtros['search']) && $filtros['search']) {
            $search = $filtros['search'];
            $query->where(function ($q) use ($search) {
                $q->where('titulo', 'like', "%{$search}%")
                    ->orWhere('descricao', 'like', "%{$search}%")
                    ->orWhere('tipo_servico', 'like', "%{$search}%")
                    ->orWhereHas('prestador.user', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        }

        if (isset($filtros['categoria_slug']) && $filtros['categoria_slug']) {
            $query->whereHas('categoria', function ($q) use ($filtros) {
                $q->where('slug', $filtros['categoria_slug']);
            });
        } elseif (isset($filtros['categoria_id']) && $filtros['categoria_id']) {
            $query->where('categoria_id', $filtros['categoria_id']);
        }

        $ordenacao = $filtros['ordenar'] ?? 'recentes';
        switch ($ordenacao) {
            case 'avaliacao':
                $query->orderBy('avaliacao_media', 'desc');
                break;
            case 'preco_asc':
                $query->orderByRaw('COALESCE(valor_fixo, valor_hora) ASC');
                break;
            case 'preco_desc':
                $query->orderByRaw('COALESCE(valor_fixo, valor_hora) DESC');
                break;
            case 'recentes':
                $query->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('visualizacoes', 'desc');
                break;
        }

        return $query->paginate($perPage);
    }

    public function getServicosPorCategoria($categoriaId, $perPage = 12)
    {
        return Servico::with(['prestador', 'categoria'])
            ->where('categoria_id', $categoriaId)
            ->where('status', 'ativo')
            ->where('verificado', true)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function getServicoCompleto($id)
    {
        return Servico::with(['prestador.user', 'categoria', 'avaliacoes.cliente.user', 'categorias'])
            ->where('status', 'ativo')
            ->where('verificado', true)
            ->find($id);
    }

    public function getServicosRelacionados(Servico $servico, $limit = 3)
    {
        return Servico::with('prestador')
            ->where('categoria_id', $servico->categoria_id)
            ->where('id', '!=', $servico->id)
            ->where('status', 'ativo')
            ->where('verificado', true)
            ->limit($limit)
            ->get();
    }
}
