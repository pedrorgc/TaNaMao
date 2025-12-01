@extends('components.layouts.app')

@section('title', 'Área de Serviço')

@section('content')

    <div class="container my-5">
        <div class="row">

            <!-- Sidebar filtros -->
            <aside class="col-md-3 mb-4">
                <div class="p-3 rounded-3 shadow-sm bg-white">
                    <h6 class="fw-bold mb-3">Filtros Ativos</h6>

                    @if($filtros['search'] || $filtros['categoria'] || $filtros['cidade'] || $filtros['estado'])
                        <p class="small mb-2">
                            @if($filtros['search'])
                                <strong>Busca:</strong> {{ $filtros['search'] }}<br>
                            @endif
                            @if($filtros['categoria'])
                                <strong>Categoria:</strong> {{ $categorias->find($filtros['categoria'])->nome ?? 'N/A' }}<br>
                            @endif
                            @if($filtros['cidade'])
                                <strong>Cidade:</strong> {{ $filtros['cidade'] }}<br>
                            @endif
                            @if($filtros['estado'])
                                <strong>Estado:</strong> {{ $filtros['estado'] }}<br>
                            @endif
                        </p>
                        <a href="{{ route('servicos.list') }}" class="btn btn-sm btn-outline-danger w-100 mb-2">
                            Limpar Filtros
                        </a>
                    @else
                        <p class="text-muted small mb-2">Nenhum filtro aplicado</p>
                    @endif

                    <!-- ABRE O MODAL -->
                    <button class="btn btn-sm btn-outline-primary w-100" data-bs-toggle="modal"
                        data-bs-target="#modalFiltros">
                        <i class="bi bi-funnel me-1"></i> Alterar Filtros
                    </button>
                </div>

                <div class="mt-3 p-3 rounded-3 shadow-sm bg-white">
                    <h6 class="fw-bold mb-3">Categorias</h6>

                    <ul class="list-unstyled mb-0">
                        <li class="d-flex justify-content-between mb-2">
                            <a href="{{ route('servicos.list') }}"
                                class="text-decoration-none {{ !$filtros['categoria'] ? 'fw-bold text-primary' : '' }}">
                                Todas as Categorias
                            </a>
                        </li>
                        @foreach ($categorias as $c)
                            <li class="d-flex justify-content-between mb-2">
                                <a href="{{ route('servicos.list', array_merge($filtros, ['categoria' => $c->id])) }}"
                                    class="text-decoration-none {{ $filtros['categoria'] == $c->id ? 'fw-bold text-primary' : '' }}">
                                    {{ $c->nome }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>

            <!-- Main -->
            <main class="col-md-9">

                <!-- Barra de Busca -->
                <div class="mb-4">
                    <form method="GET" action="{{ route('servicos.list') }}" class="d-flex gap-2">
                        @foreach($filtros as $key => $value)
                            @if($key !== 'search' && $value)
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endif
                        @endforeach

                        <input
                            type="text"
                            name="search"
                            class="form-control rounded-3"
                            placeholder="Buscar por nome do prestador..."
                            value="{{ $filtros['search'] ?? '' }}">
                        <button type="submit" class="btn btn-primary rounded-3">
                            <i class="bi bi-search"></i> Buscar
                        </button>
                    </form>
                </div>

                <!-- Informações de Resultados -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3">
                    <div>
                        <h3 class="mb-1 fw-semibold">Prestadores Disponíveis</h3>
                        <p class="text-muted mb-0">
                            <strong>{{ $prestadores->total() }}</strong> prestadores encontrados
                            @if($filtros['search'] || $filtros['categoria'] || $filtros['cidade'] || $filtros['estado'])
                                com os filtros aplicados
                            @else
                                na sua região
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Grid de Prestadores -->
                <div class="row g-4 mt-2 row-cols-1 row-cols-md-2">

                    @forelse ($prestadores as $p)
                        <div class="col">
                            <a href="{{ route('servicos.show', $p->id) }}" class="text-decoration-none">
                                <div class="card h-100 border-0 shadow-sm rounded-4 p-3 transition-all" style="cursor: pointer; transition: all 0.3s ease;">
                                    <div class="card-body p-0">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <div>
                                                <h6 class="fw-bold mb-1 text-dark">{{ $p->user->name }}</h6>
                                                <p class="text-muted small mb-1">
                                                    <i class="bi bi-briefcase"></i> {{ $p->categoria->nome ?? 'Categoria não informada' }}
                                                </p>
                                            </div>
                                            @if($p->documento)
                                                <span class="badge bg-success">
                                                    <i class="bi bi-check-circle"></i> Verificado
                                                </span>
                                            @endif
                                        </div>

                                        <p class="text-muted small mb-2">
                                            <i class="bi bi-geo-alt"></i>
                                            {{ $p->endereco->cidade ?? 'N/A' }}, {{ $p->endereco->estado ?? 'N/A' }}
                                        </p>

                                        <p class="text-muted small mb-2">
                                            <i class="bi bi-telephone"></i> {{ $p->telefone }}
                                        </p>

                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="small">
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <strong>4.8</strong> (20 avaliações)
                                            </div>
                                            <span class="badge bg-primary">Ver Perfil</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info rounded-3 text-center" role="alert">
                                <i class="bi bi-info-circle me-2"></i>
                                <strong>Nenhum prestador encontrado</strong>
                                <p class="mb-0 small mt-2">Tente ajustar os filtros ou fazer uma nova busca.</p>
                            </div>
                        </div>
                    @endforelse

                </div>

                <!-- Paginação -->
                @if($prestadores->hasPages())
                    <div class="mt-5 d-flex justify-content-center">
                        {{ $prestadores->appends(request()->query())->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </main>

        </div>
    </div>

    <!-- Modal de Filtros Avançados -->
    <div class="modal fade" id="modalFiltros" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="GET" action="{{ route('servicos.list') }}">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="bi bi-funnel me-2"></i>Filtros de Busca
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">

                        <!-- Filtro por Nome -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nome do Prestador</label>
                            <input type="text" name="search" class="form-control"
                                placeholder="Digite o nome..."
                                value="{{ $filtros['search'] ?? '' }}">
                        </div>

                        <!-- Filtro por Categoria -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Categoria</label>
                            <select name="categoria" class="form-select">
                                <option value="">Todas as categorias</option>
                                @foreach ($categorias as $c)
                                    <option value="{{ $c->id }}"
                                        {{ $filtros['categoria'] == $c->id ? 'selected' : '' }}>
                                        {{ $c->nome }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Filtro por Cidade -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Cidade</label>
                            <input type="text" name="cidade" class="form-control"
                                placeholder="Digite a cidade..."
                                value="{{ $filtros['cidade'] ?? '' }}">
                        </div>

                        <!-- Filtro por Estado -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Estado</label>
                            <select name="estado" class="form-select">
                                <option value="">Todos os estados</option>
                                <option value="AC" {{ $filtros['estado'] == 'AC' ? 'selected' : '' }}>Acre</option>
                                <option value="AL" {{ $filtros['estado'] == 'AL' ? 'selected' : '' }}>Alagoas</option>
                                <option value="AP" {{ $filtros['estado'] == 'AP' ? 'selected' : '' }}>Amapá</option>
                                <option value="AM" {{ $filtros['estado'] == 'AM' ? 'selected' : '' }}>Amazonas</option>
                                <option value="BA" {{ $filtros['estado'] == 'BA' ? 'selected' : '' }}>Bahia</option>
                                <option value="CE" {{ $filtros['estado'] == 'CE' ? 'selected' : '' }}>Ceará</option>
                                <option value="DF" {{ $filtros['estado'] == 'DF' ? 'selected' : '' }}>Distrito Federal</option>
                                <option value="ES" {{ $filtros['estado'] == 'ES' ? 'selected' : '' }}>Espírito Santo</option>
                                <option value="GO" {{ $filtros['estado'] == 'GO' ? 'selected' : '' }}>Goiás</option>
                                <option value="MA" {{ $filtros['estado'] == 'MA' ? 'selected' : '' }}>Maranhão</option>
                                <option value="MT" {{ $filtros['estado'] == 'MT' ? 'selected' : '' }}>Mato Grosso</option>
                                <option value="MS" {{ $filtros['estado'] == 'MS' ? 'selected' : '' }}>Mato Grosso do Sul</option>
                                <option value="MG" {{ $filtros['estado'] == 'MG' ? 'selected' : '' }}>Minas Gerais</option>
                                <option value="PA" {{ $filtros['estado'] == 'PA' ? 'selected' : '' }}>Pará</option>
                                <option value="PB" {{ $filtros['estado'] == 'PB' ? 'selected' : '' }}>Paraíba</option>
                                <option value="PR" {{ $filtros['estado'] == 'PR' ? 'selected' : '' }}>Paraná</option>
                                <option value="PE" {{ $filtros['estado'] == 'PE' ? 'selected' : '' }}>Pernambuco</option>
                                <option value="PI" {{ $filtros['estado'] == 'PI' ? 'selected' : '' }}>Piauí</option>
                                <option value="RJ" {{ $filtros['estado'] == 'RJ' ? 'selected' : '' }}>Rio de Janeiro</option>
                                <option value="RN" {{ $filtros['estado'] == 'RN' ? 'selected' : '' }}>Rio Grande do Norte</option>
                                <option value="RS" {{ $filtros['estado'] == 'RS' ? 'selected' : '' }}>Rio Grande do Sul</option>
                                <option value="RO" {{ $filtros['estado'] == 'RO' ? 'selected' : '' }}>Rondônia</option>
                                <option value="RR" {{ $filtros['estado'] == 'RR' ? 'selected' : '' }}>Roraima</option>
                                <option value="SC" {{ $filtros['estado'] == 'SC' ? 'selected' : '' }}>Santa Catarina</option>
                                <option value="SP" {{ $filtros['estado'] == 'SP' ? 'selected' : '' }}>São Paulo</option>
                                <option value="SE" {{ $filtros['estado'] == 'SE' ? 'selected' : '' }}>Sergipe</option>
                                <option value="TO" {{ $filtros['estado'] == 'TO' ? 'selected' : '' }}>Tocantins</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search me-1"></i>Aplicar Filtros
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1) !important;
        }
    </style>

@endsection
