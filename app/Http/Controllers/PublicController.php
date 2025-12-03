<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Servico;
use App\Services\CategoriaService;
use App\Services\ServicoService;
use Illuminate\Support\Facades\Auth;

class PublicController extends Controller
{
    protected $categoriaService;

    public function __construct(CategoriaService $categoriaService)
    {
        $this->categoriaService = $categoriaService;
    }


    public function home(CategoriaService $categoriaService, ServicoService $servicoService)
    {
        $categoriesForCard = $categoriaService->getCategoriesForCards(8);
        $featuredCategories = $categoriaService->getFeaturedCategories(4);
        $allCategories = $categoriaService->getActiveCategories();

        $categories = $allCategories->take(8)->map(function ($category) {;

            return [
                'slug' => $category->slug,
                'nome' => $category->nome,
                'icone' => $category->icone,
            ];
        });

        $servicos = $servicoService->buscarServicosComFiltros([]);
        $estatisticas = $servicoService->getEstatisticasBusca();
        $sugestoesPopulares = $servicoService->getSugestoesPopulares();

        $filtrosAtivos = [];
        $user = Auth::user();

        $showFindServices = true;
        $showOfferServices = true;
        $findServicesRoute = '/servicos';
        $offerServicesRoute = '/login';

        $servicosDestaque = Servico::with(['categoria', 'prestador.user'])
            ->where('status', 'ativo')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $featuredCategories = Categoria::withCount('servicos')
            ->orderBy('servicos_count', 'desc')
            ->limit(4)
            ->get();
        if (!$user) {
            $findServicesRoute = '/login';
            $offerServicesRoute = '/login';
        } else {
            $findServicesRoute = '/servicos';

            if ($user->role_id == 2) {
                $offerServicesRoute = '/servicos/create';
            } elseif ($user->role_id == 3) {
                $offerServicesRoute = '/cadastro/prestador';
            } elseif ($user->role_id == 1) {
                $showOfferServices = false;
            }
        }

        $selectedCategory = null;
        $showCategoriasSection = $categories->count() > 0;

        return view('pages.public.home', [
            'servicos' => $servicos,
            'selectedCategory' => $selectedCategory,
            'categories' => $categories,
            'showCategoriasSection' => $showCategoriasSection,
            'estatisticas' => $estatisticas,
            'sugestoesPopulares' => $sugestoesPopulares,
            'filtrosAtivos' => $filtrosAtivos,

            'categoriesForCard' => $categoriesForCard,
            'featuredCategories' => $featuredCategories,
            'allCategories' => $allCategories,
            'formattedCategories' => $categories,

            'showFindServices' => $showFindServices,
            'showOfferServices' => $showOfferServices,
            'findServicesRoute' => $findServicesRoute,
            'offerServicesRoute' => $offerServicesRoute,
            'servicosDestaque' => $servicosDestaque,
            'todasServicosRoute' => route('servicos.index'),
        ]);
    }

    public function login()
    {
        return view('pages.public.login');
    }

    public function contact()
    {
        return view('pages.public.contact');
    }

    public function profile()
    {
        return view('pages.public.profile');
    }

    public function profilePrestador()
    {
        return view('pages.public.profile-prestador');
    }

    public function preCadastro()
    {
        return view('pages.public.pre-cadastro');
    }

    public function cadastroCliente()
    {
        return view('pages.public.cadastro-cliente');
    }

    public function areaServicos()
    {
        return view('pages.public.servicos.area-servicos');
    }
    public function sobre()
    {
        return view('pages.public.about');
    }
}
