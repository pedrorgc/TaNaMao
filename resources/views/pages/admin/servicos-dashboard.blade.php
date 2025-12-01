@extends('components.layouts.app')

@section('title', 'Dashboard de Serviços')

@section('content')

<div class="container-fluid py-4" style="background-color: #f8f9fa; min-height: calc(100vh - 60px);">

    <!-- Header -->
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h1 class="fw-bold mb-2">Dashboard de Serviços</h1>
            <p class="text-muted">Gerencie todos os serviços da plataforma</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Voltar ao Admin
        </a>
    </div>

    <!-- Cards de Estatísticas -->
    <div class="row mb-4 g-3">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Total de Serviços</p>
                            <h3 class="fw-bold mb-0">{{ $estatisticas['total'] }}</h3>
                        </div>
                        <div style="font-size: 2rem; color: #1D4ED8;">
                            <i class="bi bi-briefcase-fill"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Concluídos</p>
                            <h3 class="fw-bold mb-0">{{ $estatisticas['concluidos'] }}</h3>
                        </div>
                        <div style="font-size: 2rem; color: #10B981;">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Em Andamento</p>
                            <h3 class="fw-bold mb-0">{{ $estatisticas['em_andamento'] }}</h3>
                        </div>
                        <div style="font-size: 2rem; color: #F59E0B;">
                            <i class="bi bi-hourglass-split"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Agendados</p>
                            <h3 class="fw-bold mb-0">{{ $estatisticas['agendados'] }}</h3>
                        </div>
                        <div style="font-size: 2rem; color: #8B5CF6;">
                            <i class="bi bi-calendar-check-fill"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">

        <!-- Tabela de Serviços -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white border-0 p-3">
                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-list-task me-2"></i>Últimos Serviços
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0">Serviço</th>
                                    <th class="border-0">Cliente</th>
                                    <th class="border-0">Prestador</th>
                                    <th class="border-0">Valor</th>
                                    <th class="border-0">Status</th>
                                    <th class="border-0">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($servicos as $servico)
                                    <tr>
                                        <td>
                                            <strong>{{ $servico->titulo ?? 'Serviço' }}</strong><br>
                                            <small class="text-muted">{{ $servico->descricao ? substr($servico->descricao, 0, 50) . '...' : 'Sem descrição' }}</small>
                                        </td>
                                        <td>
                                            @if($servico->cliente)
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="avatar rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 0.9rem;">
                                                        {{ strtoupper(substr($servico->cliente->name ?? 'N/A', 0, 1)) }}
                                                    </div>
                                                    <span>{{ $servico->cliente->name ?? 'N/A' }}</span>
                                                </div>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($servico->prestador)
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="avatar rounded-circle bg-success text-white d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 0.9rem;">
                                                        {{ strtoupper(substr($servico->prestador->name ?? 'N/A', 0, 1)) }}
                                                    </div>
                                                    <span>{{ $servico->prestador->name ?? 'N/A' }}</span>
                                                </div>
                                            @else
                                                <span class="text-muted">Não atribuído</span>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $servico->valor ? 'R$ ' . number_format($servico->valor, 2, ',', '.') : 'N/A' }}</strong>
                                        </td>
                                        <td>
                                            @php
                                                $statusColors = [
                                                    'concluido' => 'success',
                                                    'em_andamento' => 'warning',
                                                    'agendado' => 'info',
                                                    'cancelado' => 'danger'
                                                ];
                                                $statusLabels = [
                                                    'concluido' => 'Concluído',
                                                    'em_andamento' => 'Em Andamento',
                                                    'agendado' => 'Agendado',
                                                    'cancelado' => 'Cancelado'
                                                ];
                                            @endphp
                                            <span class="badge bg-{{ $statusColors[$servico->status] ?? 'secondary' }}">
                                                {{ $statusLabels[$servico->status] ?? ucfirst($servico->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('servicos.show', $servico->id) }}" class="btn btn-sm btn-outline-secondary" title="Visualizar">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            Nenhum serviço cadastrado
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($servicos->hasPages())
                    <div class="card-footer bg-white border-top p-3">
                        {{ $servicos->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Gráfico de Status -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-header bg-white border-0 p-3">
                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-pie-chart me-2"></i>Serviços por Status
                    </h5>
                </div>
                <div class="card-body">
                    @foreach($servicosPorStatus as $status => $quantidade)
                        @php
                            $statusLabels = [
                                'concluido' => 'Concluídos',
                                'em_andamento' => 'Em Andamento',
                                'agendado' => 'Agendados',
                                'cancelado' => 'Cancelados'
                            ];
                            $statusColors = [
                                'concluido' => '#10B981',
                                'em_andamento' => '#F59E0B',
                                'agendado' => '#3B82F6',
                                'cancelado' => '#EF4444'
                            ];
                            $total = array_sum($servicosPorStatus);
                            $percentual = $total > 0 ? ($quantidade / $total) * 100 : 0;
                        @endphp
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <strong>{{ $statusLabels[$status] ?? ucfirst($status) }}</strong>
                                <span class="badge" style="background-color: {{ $statusColors[$status] }};">{{ $quantidade }}</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar" role="progressbar"
                                    style="width: {{ $percentual }}%; background-color: {{ $statusColors[$status] }};">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Top Categorias -->
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-white border-0 p-3">
                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-tags me-2"></i>Top Categorias
                    </h5>
                </div>
                <div class="card-body">
                    @forelse($servicosPorCategoria as $categoria)
                        <div class="mb-3 pb-3 border-bottom">
                            <div class="d-flex justify-content-between align-items-center">
                                <strong>{{ $categoria->nome }}</strong>
                                <span class="badge bg-primary">{{ $categoria->prestadores_count }}</span>
                            </div>
                            <small class="text-muted">{{ $categoria->prestadores_count }} prestador(es)</small>
                        </div>
                    @empty
                        <p class="text-muted text-center">Nenhuma categoria cadastrada</p>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

</div>

<style>
    .avatar {
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 0.85rem;
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }

    .progress {
        background-color: #e9ecef;
    }
</style>

@endsection
