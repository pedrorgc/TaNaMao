<?php

namespace App\Http\Controllers;

use App\Services\PrestadorFilterService;
use App\Models\Prestador;
use Illuminate\Http\Request;

class ServicePublicController extends Controller
{
    protected $filterService;

    public function __construct(PrestadorFilterService $filterService)
    {
        $this->filterService = $filterService;
    }

    public function list(Request $request)
    {
        $filtros = [
            'search' => $request->input('search'),
            'categoria' => $request->input('categoria'),
            'cidade' => $request->input('cidade'),
            'estado' => $request->input('estado'),
        ];

        $prestadores = $this->filterService->filter($filtros);
        $categorias = $this->filterService->getCategorias();

        return view('pages.public.service-area', compact('prestadores', 'categorias', 'filtros'));
    }

    public function show($id)
    {
        $prestador = Prestador::with(['user', 'endereco', 'categoria'])->findOrFail($id);
        return view('pages.public.profile-prestador', compact('prestador'));
    }

    public function create()
    {
        return view('pages.public.service-create');
    }
}
