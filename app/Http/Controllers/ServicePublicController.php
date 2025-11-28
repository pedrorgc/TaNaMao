<?php

namespace App\Http\Controllers;

use App\Models\Prestador;
use App\Models\Categoria;


class ServicePublicController extends Controller
{
    public function list()
    {
        $categoria = request('categoria');
        $distancia = request('distancia');

        $prestadores = Prestador::with(['user', 'endereco'])
            ->when($categoria, function ($query, $categoria) {
                $query->where('categoria_id', $categoria);
            })
            ->get();

        $categorias = Categoria::all();

        return view('pages.public.service-area', compact('prestadores', 'categorias', 'categoria', 'distancia'));
    }

    public function create()
    {
        return view('pages.public.service-create');
    }
}
