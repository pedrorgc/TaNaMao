<?php

namespace App\Http\Controllers;

use App\Models\Prestador;
use App\Models\Cliente;
use App\Models\Categoria;
use App\Models\User;

class AdminController extends Controller
{
    public function profile()
    {
        $metricas = [
            'total_usuarios' => User::count(),
            'prestadores_ativos' => Prestador::count(),
            'servicos_ativos' => 0,
            'receita_mensal' => 'R$ 0,00',
        ];

        $usuarios = User::with('role')->latest()->take(10)->get();
        $prestadores = Prestador::with(['user', 'categoria', 'endereco'])->latest()->take(10)->get();
        $totalCategorias = Categoria::count();

        return view('pages.admin.profile', compact('metricas', 'usuarios', 'prestadores', 'totalCategorias'));
    }
}
