<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Servico;
use Illuminate\Http\Request;
use App\Services\CategoriaService;
use App\Services\ServicoService;
use App\Http\Requests\StoreServicoRequest;
use Illuminate\Support\Facades\Auth;

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

    public function showByCategory($slugCategoria)
    {
        $categoria = Categoria::where('slug', $slugCategoria)->firstOrFail();

        $servicos = Servico::with(['prestador', 'categoria'])
            ->where('categoria_id', $categoria->id)
            ->where('status', 'ativo')
            ->where('verificado', true)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

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
}
