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

    public function getEstatisticasBusca(): array
    {
        $servicosPorCategoria = Categoria::withCount(['servicos' => function ($query) {
            $query->where('status', 'ativo')->where('verificado', true);
        }])
            ->where('ativo', true)
            ->orderBy('servicos_count', 'desc')
            ->limit(10)
            ->get()
            ->pluck('servicos_count', 'nome')
            ->toArray();

        return [
            'total_servicos' => Servico::where('status', 'ativo')
                ->where('verificado', true)
                ->count(),
            'total_categorias' => Categoria::where('ativo', true)->count(),
            'servicos_por_categoria' => $servicosPorCategoria,
        ];
    }

    public function getSugestoesPopulares(int $limit = 8): array
    {
        return [
            'eletricista',
            'encanador',
            'pintor',
            'pedreiro',
            'limpeza',
            'mecânico',
            'informática',
            'jardineiro',
        ];
    }

    public function formatarPreco(Servico $servico): string
    {
        if ($servico->tipo_valor === 'hora' && $servico->valor_hora) {
            return 'R$ ' . number_format($servico->valor_hora, 2, ',', '.') . '/hora';
        }

        if ($servico->tipo_valor === 'fixo' && $servico->valor_fixo) {
            return 'R$ ' . number_format($servico->valor_fixo, 2, ',', '.');
        }

        return 'Orçamento';
    }

    public function buscarRapido(string $term, int $limit = 10): array
    {
        if (strlen($term) < 2) {
            return [];
        }

        $servicos = Servico::with('categoria')
            ->where('status', 'ativo')
            ->where('verificado', true)
            ->where(function ($query) use ($term) {
                $query->where('titulo', 'like', "%{$term}%")
                    ->orWhere('descricao', 'like', "%{$term}%")
                    ->orWhereHas('categoria', function ($catQuery) use ($term) {
                        $catQuery->where('nome', 'like', "%{$term}%");
                    })
                    ->orWhereHas('prestador.user', function ($userQuery) use ($term) {
                        $userQuery->where('name', 'like', "%{$term}%");
                    });
            })
            ->limit($limit)
            ->get();

        return $servicos->map(function ($servico) {
            return [
                'id' => $servico->id,
                'titulo' => $servico->titulo,
                'categoria' => $servico->categoria->nome ?? 'Sem categoria',
                'preco' => $this->formatarPreco($servico),
                'url' => route('servicos.show', $servico->id),
                'descricao_resumida' => Str::limit($servico->descricao, 60),
            ];
        })->toArray();
    }

    public function buscarServicosComFiltros(array $filtros = [], $perPage = 8)
    {
        $query = Servico::with(['prestador.user', 'categoria'])
            ->where('status', 'ativo')
            ->where('verificado', true);

        if (!empty($filtros['categoria_slug'])) {
            $query->whereHas('categoria', function ($q) use ($filtros) {
                $q->where('slug', $filtros['categoria_slug']);
            });
        }

        if (!empty($filtros['search'])) {
            $search = $filtros['search'];
            $query->where(function ($q) use ($search) {
                $q->where('titulo', 'like', "%{$search}%")
                    ->orWhere('descricao', 'like', "%{$search}%")
                    ->orWhere('tipo_servico', 'like', "%{$search}%")
                    ->orWhereHas('categoria', function ($catQuery) use ($search) {
                        $catQuery->where('nome', 'like', "%{$search}%")
                            ->orWhere('descricao', 'like', "%{$search}%");
                    })
                    ->orWhereHas('prestador.user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        if (!empty($filtros['tipo_valor'])) {
            $query->where('tipo_valor', $filtros['tipo_valor']);
        }

        if (!empty($filtros['tipo_servico'])) {
            $query->where('tipo_servico', $filtros['tipo_servico']);
        }

        if (!empty($filtros['cidade'])) {
            $query->where('cidade_servico', 'like', "%{$filtros['cidade']}%")
                ->orWhereHas('prestador.endereco', function ($q) use ($filtros) {
                    $q->where('cidade', 'like', "%{$filtros['cidade']}%");
                });
        }

        if (!empty($filtros['estado'])) {
            $query->where('estado_servico', $filtros['estado'])
                ->orWhereHas('prestador.endereco', function ($q) use ($filtros) {
                    $q->where('estado', $filtros['estado']);
                });
        }

        if (!empty($filtros['preco_min']) || !empty($filtros['preco_max'])) {
            $query->where(function ($q) use ($filtros) {
                $q->where(function ($hourQuery) use ($filtros) {
                    $hourQuery->where('tipo_valor', 'hora')
                        ->when(!empty($filtros['preco_min']), function ($subQuery) use ($filtros) {
                            $subQuery->where('valor_hora', '>=', $filtros['preco_min']);
                        })
                        ->when(!empty($filtros['preco_max']), function ($subQuery) use ($filtros) {
                            $subQuery->where('valor_hora', '<=', $filtros['preco_max']);
                        });
                })
                    ->orWhere(function ($fixedQuery) use ($filtros) {
                        $fixedQuery->where('tipo_valor', 'fixo')
                            ->when(!empty($filtros['preco_min']), function ($subQuery) use ($filtros) {
                                $subQuery->where('valor_fixo', '>=', $filtros['preco_min']);
                            })
                            ->when(!empty($filtros['preco_max']), function ($subQuery) use ($filtros) {
                                $subQuery->where('valor_fixo', '<=', $filtros['preco_max']);
                            });
                    });
            });
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
            case 'visualizacoes':
                $query->orderBy('visualizacoes', 'desc');
                break;
            case 'recentes':
            default:
                $query->orderBy('created_at', 'desc');
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

    public function buscarServicoParaVisualizacao($id)
    {
        return Servico::with([
            'prestador' => function ($query) {
                $query->with([
                    'user:id,name',
                    'categoria:id,nome',
                    'endereco:id,cidade,estado'
                ]);
            },
            'categoria:id,nome,slug,icone',
            'enderecoServico:id,cidade,estado'
        ])
        ->where('id', $id)
        ->where('status', 'ativo')
        ->where('verificado', true)
        ->firstOrFail();
    }

    public function prepararDadosVisiveisServico(Servico $servico)
    {
        $nomePrestador = $servico->prestador->user->name ?? 'Prestador';
        
        $fotos = [];
        if (class_exists('App\Models\ServicoImagem')) {
            $fotos = $servico->servicoImagens ?? [];
        }
        
        $avaliacoes = [];
        if (class_exists('App\Models\Avaliacao')) {
            $avaliacoes = $servico->avaliacoes ?? [];
        }

        return [
            'servico' => $servico,
            'titulo' => $servico->titulo,
            'descricao' => $servico->descricao,
            'tipo_servico' => $servico->tipo_servico,
            'tipo_valor' => $servico->tipo_valor,
            'valor_formatado' => $this->formatarValorServico($servico),
            'localizacao' => $this->formatarLocalizacaoServico($servico),
            'telefone' => $this->formatarTelefoneServico($servico),
            'visualizacoes' => $servico->visualizacoes,
            'data_criacao' => $servico->created_at->format('d/m/Y'),
            
            'categoria' => $servico->categoria,
            'fotos' => $fotos,
            'avaliacoes' => $avaliacoes,
            'comentarios' => $avaliacoes,
            
            'prestador' => [
                'id' => $servico->prestador->id,
                'nome' => $nomePrestador,
                'user_id' => $servico->prestador->user_id,
                'categoria' => $servico->prestador->categoria,
                'endereco' => $servico->prestador->endereco,
            ],
            
            'badges' => [
                'verificado' => $servico->verificado,
                'status_publico' => 'Disponível'
            ]
        ];
    }


    public function formatarValorServico(Servico $servico): string
    {
        switch ($servico->tipo_valor) {
            case 'hora':
                return $servico->valor_hora
                    ? 'R$ ' . number_format($servico->valor_hora, 2, ',', '.') . '/hora'
                    : 'Valor por hora a combinar';
            case 'fixo':
                return $servico->valor_fixo
                    ? 'R$ ' . number_format($servico->valor_fixo, 2, ',', '.')
                    : 'Valor fixo a combinar';
            default:
                return 'Orçamento sob consulta';
        }
    }

    public function formatarLocalizacaoServico(Servico $servico): string
    {
        if ($servico->cidade_servico && $servico->estado_servico) {
            return $servico->cidade_servico . '/' . $servico->estado_servico;
        }

        if ($servico->enderecoServico) {
            return $servico->enderecoServico->cidade . '/' . $servico->enderecoServico->estado;
        }

        if ($servico->prestador->endereco) {
            return $servico->prestador->endereco->cidade . '/' . $servico->prestador->endereco->estado;
        }

        return 'Localização não informada';
    }

    public function formatarTelefoneServico(Servico $servico): ?string
    {
        if ($servico->telefone_servico) {
            $telefone = preg_replace('/[^0-9]/', '', $servico->telefone_servico);
            
            if (strlen($telefone) == 11) {
                return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $telefone);
            } elseif (strlen($telefone) == 10) {
                return preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $telefone);
            }
            
            return $servico->telefone_servico;
        }
        if ($servico->prestador->telefone) {
            $telefone = preg_replace('/[^0-9]/', '', $servico->prestador->telefone);
            return '****-****' . substr($telefone, -4);
        }

        return null;
    }
    private function formatarNumeroTelefone($telefone): string
    {
        $telefone = preg_replace('/[^0-9]/', '', $telefone);

        if (strlen($telefone) == 11) {
            return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $telefone);
        } elseif (strlen($telefone) == 10) {
            return preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $telefone);
        }

        return $telefone;
    }


    public function incrementarVisualizacoes(Servico $servico): void
    {
        $servico->increment('visualizacoes');
    }

    public function buscarServicosRelacionadosPorCategoria(Servico $servico, $limit = 6)
    {
        return Servico::with(['prestador', 'categoria'])
            ->where('categoria_id', $servico->categoria_id)
            ->where('id', '!=', $servico->id)
            ->where('status', 'ativo')
            ->where('verificado', true)
            ->inRandomOrder()
            ->limit($limit)
            ->get();
    }

    public function buscarOutrosServicosDoPrestador(Servico $servico, $limit = 3)
    {
        return Servico::with(['categoria'])
            ->where('prestador_id', $servico->prestador_id)
            ->where('id', '!=', $servico->id)
            ->where('status', 'ativo')
            ->where('verificado', true)
            ->inRandomOrder()
            ->limit($limit)
            ->get();
    }
}
