<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Servico;
use Illuminate\Http\Request;
use App\Services\CategoriaService;
use App\Services\ServicoService;
use App\Http\Requests\StoreServicoRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ServicePublicController extends Controller
{
    protected $categoriaService;
    protected $servicoService;

    public function __construct(
        CategoriaService $categoriaService,
        ServicoService $servicoService
    ) {
        $this->categoriaService = $categoriaService;
        $this->servicoService = $servicoService;
    }

    public function list()
    {
        $categoria = request('categoria');
        $distancia = request('distancia');

        $prestadores = $this->servicoService->buscarPrestadoresPorCategoria($categoria);
        $categorias = Categoria::all();

        return view('pages.public.service-area', compact('prestadores', 'categorias', 'categoria', 'distancia'));
    }

    public function create()
    {
        try {
            $user = Auth::user();


            $prestador = $user->prestador;

            $categorias = Categoria::where('ativo', true)->orderBy('nome')->get();
            $dadosPrestador = $this->servicoService->prepararDadosPrestador($prestador);

            $categoriaSugerida = $prestador->categoria_id
                ? Categoria::find($prestador->categoria_id)
                : null;

            return view('pages.public.servicos.cadastrar', [
                'categorias' => $categorias,
                'prestador' => $prestador,
                'dadosPrestador' => $dadosPrestador,
                'categoriaSugerida' => $categoriaSugerida
            ]);
        } catch (\Exception $e) {
            dd('Erro no método create(): ' . $e->getMessage(), $e->getTraceAsString());
        }
    }

    public function store(StoreServicoRequest $request)
    {
        $user = Auth::user();
        $prestador = $user->prestador;

        try {
            $servico = $this->servicoService->criarServico($request->validated(), $prestador);

            return redirect()->route('prestador.dashboard')
                ->with('success', 'Serviço cadastrado com sucesso! Aguarde aprovação.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Erro ao cadastrar serviço: ' . $e->getMessage());
        }
    }



    public function index(Request $request)
    {
        $filtros = [
            'search' => $request->search,
            'categoria_slug' => $request->categoria,
            'ordenar' => $request->ordenar,
            'cidade' => $request->cidade,
            'estado' => $request->estado,
            'tipo_valor' => $request->tipo_valor,
            'tipo_servico' => $request->tipo_servico,
            'preco_min' => $request->preco_min,
            'preco_max' => $request->preco_max,
        ];

        $servicos = $this->servicoService->buscarServicosComFiltros($filtros);
        $categoriesForCard = $this->categoriaService->getCategoriesForCards();

        $estatisticas = $this->servicoService->getEstatisticasBusca();
        $sugestoesPopulares = $this->servicoService->getSugestoesPopulares();

        $showCategoriasSection = $request->has('show_categorias') && $request->show_categorias == 'true';

        return view('servicos.index', [
            'servicos' => $servicos,
            'selectedCategory' => $this->categoriaService->getCategoryBySlug($request->categoria),
            'categoriesForCard' => $categoriesForCard,
            'categories' => $categoriesForCard,
            'showCategoriasSection' => $showCategoriasSection,
            'estatisticas' => $estatisticas,
            'sugestoesPopulares' => $sugestoesPopulares,
            'filtrosAtivos' => array_filter($filtros),
        ]);
    }


    public function buscarRapido(Request $request)
    {
        $termo = $request->get('q', '');

        if (strlen($termo) < 2) {
            return response()->json([]);
        }

        $resultados = $this->servicoService->buscarRapido($termo);

        return response()->json($resultados);
    }
    public function show($id)
    {
        try {
            $servico = Servico::with([
                'prestador.user:id,name',
                'categoria:id,nome,slug,icone',
                'enderecoServico:id,cidade,estado'
            ])
                ->where('id', $id)
                ->where('status', 'ativo')
                ->where('verificado', true)
                ->firstOrFail();

            $servico->increment('visualizacoes');

            $dadosVisiveis = [
                'servico' => $servico,
                'titulo' => $servico->titulo,
                'descricao' => $servico->descricao,
                'tipo_servico' => $servico->tipo_servico,
                'tipo_valor' => $servico->tipo_valor,
                'valor_formatado' => $this->formatarValor($servico),
                'localizacao' => $this->formatarLocalizacao($servico),
                'telefone_formatado' => $this->formatarTelefone($servico),
                'visualizacoes' => $servico->visualizacoes,
                'data_criacao' => $servico->created_at->format('d/m/Y'),

                'categoria' => $servico->categoria,
                'prestador' => [
                    'id' => $servico->prestador->id,
                    'nome' => $servico->prestador->user->name ?? 'Prestador',
                    'user' => $servico->prestador->user,
                ],
                'badges' => [
                    'verificado' => $servico->verificado,
                    'status_publico' => 'Disponível'
                ]
            ];

            $dadosVisiveis['servicosRelacionados'] = Servico::with(['prestador.user', 'categoria'])
                ->where('categoria_id', $servico->categoria_id)
                ->where('id', '!=', $servico->id)
                ->where('status', 'ativo')
                ->where('verificado', true)
                ->inRandomOrder()
                ->limit(6)
                ->get();

            $dadosVisiveis['outrosServicosPrestador'] = Servico::with(['categoria'])
                ->where('prestador_id', $servico->prestador_id)
                ->where('id', '!=', $servico->id)
                ->where('status', 'ativo')
                ->where('verificado', true)
                ->inRandomOrder()
                ->limit(3)
                ->get();

            $dadosVisiveis['categorias'] = Categoria::where('ativo', true)->orderBy('nome')->get();
            $dadosVisiveis['categoriaAtual'] = $servico->categoria;

            $dadosVisiveis['relatedServices'] = $dadosVisiveis['servicosRelacionados'];
            $dadosVisiveis['endereco_completo'] = $dadosVisiveis['localizacao'];

            $dadosVisiveis['metaTitle'] = $servico->titulo . ' - ' . config('app.name');
            $dadosVisiveis['metaDescription'] = $servico->descricao
                ? substr(strip_tags($servico->descricao), 0, 160)
                : 'Confira este serviço na nossa plataforma';

            return view('servicos.show', $dadosVisiveis);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('servicos.index')
                ->with('error', 'Serviço não encontrado ou não está disponível.');
        } catch (\Exception $e) {
            if (config('app.debug')) {
                return response()->json([
                    'error' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString()
                ], 500);
            }

            return redirect()->route('servicos.index')
                ->with('error', 'Erro ao carregar detalhes do serviço.');
        }
    }

    private function formatarValor($servico)
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

    private function formatarLocalizacao($servico)
    {
        if ($servico->cidade_servico && $servico->estado_servico) {
            return $servico->cidade_servico . '/' . $servico->estado_servico;
        }

        if ($servico->enderecoServico) {
            return $servico->enderecoServico->cidade . '/' . $servico->enderecoServico->estado;
        }

        return 'Localização não informada';
    }

    private function formatarTelefone($servico)
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

        return null;
    }


    public function showByCategory($slugCategoria)
    {
        $categoria = Categoria::where('slug', $slugCategoria)->firstOrFail();
        $servicos = $this->servicoService->getServicosPorCategoria($categoria->id);
        $categorias = Categoria::where('ativo', true)->orderBy('nome')->get();

        return view('servicos.por-categoria', compact('servicos', 'categoria', 'categorias'));
    }

    public function myServices()
    {
        $user = Auth::user();
        $prestador = $user->prestador;

        $servicos = Servico::where('prestador_id', $prestador->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('prestador.servicos.index', compact('servicos', 'prestador'));
    }
}
