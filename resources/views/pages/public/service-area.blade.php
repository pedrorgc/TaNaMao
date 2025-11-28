@extends('components.layouts.app')

@section('title', 'Área de Serviço')

@section('content')

    <div class="container my-5">
        <div class="row">

            <!-- Sidebar filtros -->
            <aside class="col-md-3 mb-4">
                <div class="p-3 rounded-3 shadow-sm bg-white">
                    <h6 class="fw-bold">Localização</h6>
                    <p class="mb-1">
                        @if ($categoria)
                            Categoria: <strong>{{ $categorias->find($categoria)->nome }}</strong>
                        @else
                            Categoria: <strong>Todas</strong>
                        @endif

                        <br>

                        @if ($distancia)
                            Distância: <strong>Até {{ $distancia }} km</strong>
                        @else
                            Distância: <strong>Qualquer</strong>
                        @endif
                    </p>

                    <!-- ABRE O MODAL -->
                    <button class="btn btn-sm btn-outline-secondary w-100" data-bs-toggle="modal"
                        data-bs-target="#modalFiltros">
                        Alterar filtros
                    </button>
                </div>

                <div class="mt-3 p-3 rounded-3 shadow-sm bg-white">
                    <h6 class="fw-bold">Categorias</h6>

                    <ul class="list-unstyled mb-0">
                        @foreach ($categorias as $c)
                            <li class="d-flex justify-content-between">
                                <a href="?categoria={{ $c->id }}"
                                    class="text-decoration-none {{ $categoria == $c->id ? 'fw-bold text-primary' : '' }}">
                                    {{ $c->nome }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>

            <!-- Main -->
            <main class="col-md-9">

                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3">
                    <div>
                        <h3 class="mb-1 fw-semibold">Prestadores Disponíveis</h3>
                        <p class="text-muted mb-0">
                            {{ $prestadores->count() }} prestadores encontrados na sua região
                        </p>
                    </div>
                </div>

                <div class="row g-4 mt-4 row-cols-1 row-cols-md-2">

                    @foreach ($prestadores as $p)
                        <div class="col">
                            <div class="card h-100 border-0 shadow-sm rounded-4 p-3">
                                <x-service-card :name="$p->user->name" :role="$p->categoria->nome ?? 'Categoria não informada'" :rating="4.8" :reviews="20"
                                    :distance="'1 km'" :price="'R$ 80/h'" :is-verified="true" :description="'Prestador cadastrado na categoria.'" />
                            </div>
                        </div>
                    @endforeach

                    @if ($prestadores->isEmpty())
                        <p class="text-muted">Nenhum prestador encontrado.</p>
                    @endif

                </div>
            </main>

        </div>
    </div>


    <!--filtros-->
    <div class="modal fade" id="modalFiltros" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="GET" action="{{ route('servicos.list') }}">
                    <div class="modal-header">
                        <h5 class="modal-title">Filtros de Busca</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <label class="form-label">Categoria</label>
                        <select name="categoria" class="form-select mb-3">
                            <option value="">Todas</option>
                            @foreach ($categorias as $c)
                                <option value="{{ $c->id }}" {{ request('categoria') == $c->id ? 'selected' : '' }}>
                                    {{ $c->nome }}
                                </option>
                            @endforeach
                        </select>
                        <label class="form-label">Distância máxima</label>
                        <select name="distancia" class="form-select">
                            <option value="">Qualquer distância</option>
                            <option value="1" {{ request('distancia') == 1 ? 'selected' : '' }}>Até 1 km</option>
                            <option value="5" {{ request('distancia') == 5 ? 'selected' : '' }}>Até 5 km</option>
                            <option value="10" {{ request('distancia') == 10 ? 'selected' : '' }}>Até 10 km</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Aplicar Filtros</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
