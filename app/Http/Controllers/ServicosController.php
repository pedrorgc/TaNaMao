<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use App\Models\Prestador;
use App\Models\Cliente;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ServicosController extends Controller
{
    public function dashboard()
    {
        $totalServicos = Servico::count();
        $servicosConcluidos = Servico::where('status', 'concluido')->count();
        $servicosEmAndamento = Servico::where('status', 'em_andamento')->count();
        $servicosAgendados = Servico::where('status', 'agendado')->count();

        $servicos = Servico::with(['cliente', 'prestador', 'endereco'])
            ->latest()
            ->paginate(10);

        $servicosPorCategoria = Categoria::withCount('prestadores')
            ->orderBy('prestadores_count', 'desc')
            ->take(5)
            ->get();

        $servicosPorStatus = [
            'concluido' => Servico::where('status', 'concluido')->count(),
            'em_andamento' => Servico::where('status', 'em_andamento')->count(),
            'agendado' => Servico::where('status', 'agendado')->count(),
            'cancelado' => Servico::where('status', 'cancelado')->count(),
        ];

        $estatisticas = [
            'total' => $totalServicos,
            'concluidos' => $servicosConcluidos,
            'em_andamento' => $servicosEmAndamento,
            'agendados' => $servicosAgendados,
        ];

        return view('pages.admin.servicos-dashboard', compact(
            'estatisticas',
            'servicos',
            'servicosPorCategoria',
            'servicosPorStatus'
        ));
    }

    public function show($id)
    {
        $servico = Servico::with(['cliente', 'prestador', 'endereco'])->findOrFail($id);
        return view('pages.admin.servico-detalhes', compact('servico'));
    }

    public function updateStatus(Request $request, $id)
    {
        $servico = Servico::findOrFail($id);
        $servico->status = $request->input('status');
        $servico->save();

        return redirect()->back()->with('success', 'Status atualizado com sucesso!');
    }
}
