<?php

namespace App\Http\Controllers;

use App\Services\CategoriaService;
use Illuminate\Support\Facades\Auth;

class PublicController extends Controller
{
    protected $categoriaService;

    public function __construct(CategoriaService $categoriaService)
    {
        $this->categoriaService = $categoriaService;
    }


    public function home(CategoriaService $categoriaService)
    {
        $categoriesForCard = $categoriaService->getCategoriesForCards(8);
        $featuredCategories = $categoriaService->getFeaturedCategories(4);
        $allCategories = $categoriaService->getActiveCategories();
        $categoriesForCard = $allCategories->take(8);
        $formattedCategories = $categoriaService->formatCategoriesForDisplay()->take(8);

        $user = Auth::user();

        $showFindServices = true;
        $showOfferServices = true;
        $findServicesRoute = '/servicos';
        $offerServicesRoute = '/login';

        if (!$user) {
            $findServicesRoute = '/login';
            $offerServicesRoute = '/login';
        } else {
            $findServicesRoute = '/servicos';

            if ($user->role_id == 2) {
                $offerServicesRoute = route('quero.criar.servico');
            } elseif ($user->role_id == 3) {
                $offerServicesRoute = '/cadastro/prestador';
            } elseif ($user->role_id == 1) {
                $showOfferServices = false;
            }
        }
        $categories = $formattedCategories;
        $selectedCategory = $formattedCategories;
        $showCategoriasSection = $formattedCategories->count() > 0;

        return view('pages.public.home', compact(
            'categoriesForCard',
            'categories',
            'featuredCategories',
            'formattedCategories',
            'allCategories',
            'showFindServices',
            'showOfferServices',
            'findServicesRoute',
            'offerServicesRoute',
            'selectedCategory',
            'showCategoriasSection'
        ));
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
}
