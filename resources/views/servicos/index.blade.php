@extends('layouts.app')
@section('title', 'Serviços Disponíveis')

@section('content')

<style>
    .autocomplete-suggestions {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        z-index: 1050;
        max-height: 400px;
        overflow-y: auto;
    }

    .autocomplete-suggestion {
        padding: 0.75rem 1rem;
        cursor: pointer;
        background-color: white;
        transition: background-color 0.15s ease-in-out;
    }

    .autocomplete-suggestion:hover,
    .autocomplete-suggestion.focused {
        background-color: #f8f9fa;
    }

    .autocomplete-suggestion:focus {
        outline: 2px solid #0d6efd;
        outline-offset: -2px;
    }

    .search-container {
        position: relative;
    }

    .pagination {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 2rem 0 0;
        justify-content: center;
        gap: 0.5rem;
    }

    .page-item {
        margin: 0;
    }

    .page-link {
        display: block;
        padding: 0.5rem 1rem;
        color: #0d6efd;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        text-decoration: none;
        transition: all 0.2s;
    }

    .page-link:hover {
        color: #0a58ca;
        background-color: #f8f9fa;
        border-color: #dee2e6;
    }

    .page-item.active .page-link {
        color: #fff;
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
        background-color: #fff;
        border-color: #dee2e6;
    }

    .service-card {
        transition: transform 0.2s, box-shadow 0.2s;
        height: 100%;
    }

    .service-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }

    .service-card .card-body {
        display: flex;
        flex-direction: column;
    }

    .service-card .card-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
        color: #212529;
    }

    .service-card .card-text {
        flex-grow: 1;
        color: #6c757d;
        font-size: 0.9rem;
        line-height: 1.5;
        margin-bottom: 1rem;
    }

    .category-badge {
        font-size: 0.75rem;
        padding: 0.35em 0.65em;
    }

    .prestador-info {
        font-size: 0.85rem;
        color: #6c757d;
        border-top: 1px solid #f8f9fa;
        padding-top: 0.75rem;
        margin-top: auto;
    }

    .btn-see-more {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 500;
    }

    .content-toggle-buttons {
        margin-bottom: 2rem;
    }

    .content-toggle-buttons .btn {
        border-radius: 0.5rem;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
    }

    .content-toggle-buttons .btn.active {
        background-color: #0d6efd;
        color: white;
        border-color: #0d6efd;
    }


    @media (max-width: 768px) {
        .service-card .card-title {
            font-size: 1rem;
        }

        .service-card .card-text {
            font-size: 0.85rem;
        }

        .col-md-4 {
            margin-bottom: 1rem;
        }
    }
</style>

@if(request('categoria'))
<div class="container py-5">
    <div class="d-flex align-items-center mb-4">
        <a href="{{ route('servicos.index') }}" class="btn btn-outline-secondary me-4">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>

        <div class="text-center flex-grow-1">
            @php
            $selectedCategory = null;
            foreach($categoriesForCard ?? [] as $category) {
            if (($category['slug'] ?? $category->slug ?? '') == request('categoria')) {
            $selectedCategory = $category;
            break;
            }
            }
            @endphp

            @if($selectedCategory)
            <h1 class="display-5 fw-bold mb-0">
                {{ $selectedCategory['nome'] ?? $selectedCategory->nome ?? 'Categoria' }}
            </h1>
            <p class="text-muted mt-2">
                {{ $servicos->total() }} serviço{{ $servicos->total() != 1 ? 's' : '' }} encontrado{{ $servicos->total() != 1 ? 's' : '' }}
            </p>
            @endif
        </div>

        <div style="width: 100px;"></div>
    </div>

    @if(isset($servicos) && $servicos->count() > 0)
    <div class="row">
        @foreach($servicos as $servico)
        <div class="col-md-4 mb-4">
            <div class="card service-card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $servico->titulo }}</h5>
                    <p class="card-text">{{ Str::limit($servico->descricao, 100) }}</p>
                    @if($servico->categoria)
                    <span class="badge category-badge bg-primary">{{ $servico->categoria->nome }}</span>
                    @endif
                    <div class="prestador-info">
                        <small class="text-muted">
                            <i class="bi bi-person"></i> {{ $servico->prestador->user->name ?? 'Prestador' }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if($servicos->hasPages())
    <div class="mt-5">
        <nav aria-label="Navegação de páginas">
            <ul class="pagination">
                @if($servicos->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link" aria-hidden="true">&laquo;</span>
                </li>
                @else
                <li class="page-item">
                    <a class="page-link" href="{{ $servicos->previousPageUrl() }}" rel="prev" aria-label="Anterior">&laquo;</a>
                </li>
                @endif

                @foreach(range(1, $servicos->lastPage()) as $page)
                @if($page == $servicos->currentPage())
                <li class="page-item active" aria-current="page">
                    <span class="page-link">{{ $page }}</span>
                </li>
                @else
                <li class="page-item">
                    <a class="page-link" href="{{ $servicos->url($page) }}">{{ $page }}</a>
                </li>
                @endif
                @endforeach

                @if($servicos->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $servicos->nextPageUrl() }}" rel="next" aria-label="Próxima">&raquo;</a>
                </li>
                @else
                <li class="page-item disabled">
                    <span class="page-link" aria-hidden="true">&raquo;</span>
                </li>
                @endif
            </ul>
        </nav>

        <div class="text-center mt-3">
            <small class="text-muted">
                Mostrando {{ $servicos->firstItem() }} - {{ $servicos->lastItem() }} de {{ $servicos->total() }} serviços
            </small>
        </div>
    </div>
    @endif
    @else
    <div class="text-center py-5">
        <div class="alert alert-info">
            Nenhum serviço encontrado nesta categoria.
        </div>
        <a href="{{ route('servicos.index') }}" class="btn btn-primary">
            <i class="bi bi-arrow-left"></i> Ver todos os serviços
        </a>
    </div>
    @endif
</div>
@else
<div class="bg-light text-center py-5 full-width-bg">
    <div class="container">
        <h1 class="display-5 fw-bold mb-3">Serviços <span class="text-primary">Disponíveis</span></h1>
        <p class="lead mb-4">Encontre os melhores prestadores de serviço da sua região.
            Filtre por categoria e avalie as melhores opções.</p>
    </div>
</div>

<div class="container py-5">
    <div class="input-group search-container mb-4">
        <div class="position-relative flex-grow-1" style="width: 350px;">
            <input type="text"
                name="search"
                class="form-control"
                placeholder="Buscar serviço, categoria ou prestador..."
                value="{{ request('search') }}"
                id="searchInput"
                autocomplete="off"
                aria-label="Buscar serviços">
            <div class="autocomplete-suggestions" id="searchSuggestions" style="display: none;"></div>
        </div>

        <select name="categoria" class="form-select" style="max-width: 250px;">
            <option value="">Todas as categorias</option>
            @foreach($categoriesForCard ?? [] as $category)
            <option value="{{ $category['slug'] }}"
                {{ request('categoria') == $category['slug'] ? 'selected' : '' }}>
                {{ $category['nome'] }}
            </option>
            @endforeach
        </select>

        <button class="btn btn-primary" type="submit">
            <i class="bi bi-search"></i>
        </button>
    </div>

    <div class="content-toggle-buttons text-center mb-4">
        <div class="btn-group" role="group" aria-label="Alternar entre categorias e serviços">
            <button type="button" class="btn btn-outline-primary {{ $showCategoriasSection ? 'active' : '' }}"
                id="toggleCategorias" onclick="toggleContent('categorias')">
                <i class="bi bi-grid-3x3-gap"></i> Categorias
            </button>
            <button type="button" class="btn btn-outline-primary {{ !$showCategoriasSection ? 'active' : '' }}"
                id="toggleServicos" onclick="toggleContent('servicos')">
                <i class="bi bi-briefcase"></i> Serviços
            </button>
        </div>
    </div>

    <div id="categoriasContent" style="display: {{ $showCategoriasSection ? 'block' : 'none' }};">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-0">Todas as Categorias</h2>
                <p class="text-muted">Escolha uma categoria para filtrar os serviços</p>
            </div>
        </div>

        @include('components.card-categoria', [
        'categories' => $categoriesForCard ?? [],
        'selectedCategory' => $selectedCategory ?? null
        ])
    </div>

    <div id="servicosContent" style="display: {{ !$showCategoriasSection ? 'block' : 'none' }};">
        @if(isset($servicos) && $servicos->count() > 0)
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-0">Serviços Disponíveis</h2>
                <p class="text-muted">Encontre profissionais qualificados para seu projeto</p>
            </div>
            <div>
                <small class="text-muted">
                    {{ $servicos->total() }} serviço{{ $servicos->total() != 1 ? 's' : '' }} encontrado{{ $servicos->total() != 1 ? 's' : '' }}
                </small>
            </div>
        </div>
        @include('components.card-servico', [
        'items' => $servicos,
        'routeName' => 'servicos.show',
        'titleField' => 'titulo',
        'descriptionField' => 'descricao',
        'badgeField' => 'categoria.nome',
        'showPrestador' => true,
        'prestadorNameField' => 'prestador.user.name'
        ])
        @if($servicos->hasPages())
        <div class="mt-5">
            <nav aria-label="Navegação de páginas">
                <ul class="pagination">
                    @if($servicos->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link" aria-hidden="true">&laquo;</span>
                    </li>
                    @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $servicos->previousPageUrl() }}" rel="prev" aria-label="Anterior">&laquo;</a>
                    </li>
                    @endif

                    @foreach(range(1, $servicos->lastPage()) as $page)
                    @if($page == $servicos->currentPage())
                    <li class="page-item active" aria-current="page">
                        <span class="page-link">{{ $page }}</span>
                    </li>
                    @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $servicos->url($page) }}">{{ $page }}</a>
                    </li>
                    @endif
                    @endforeach

                    @if($servicos->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $servicos->nextPageUrl() }}" rel="next" aria-label="Próxima">&raquo;</a>
                    </li>
                    @else
                    <li class="page-item disabled">
                        <span class="page-link" aria-hidden="true">&raquo;</span>
                    </li>
                    @endif
                </ul>
            </nav>

            <div class="text-center mt-3">
                <small class="text-muted">
                    Mostrando {{ $servicos->firstItem() }} - {{ $servicos->lastItem() }} de {{ $servicos->total() }} serviços
                </small>
            </div>
        </div>
        @endif
        @else
        <div class="text-center py-5">
            <div class="alert alert-info">
                Nenhum serviço encontrado.
            </div>
            @if(request('search') || request('categoria'))
            <a href="{{ route('servicos.index') }}" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i> Ver todos os serviços
            </a>
            @endif
        </div>
        @endif
    </div>
</div>
@endif

<script>
    function updateCategoryFilter(categorySlug) {
        if (!categorySlug) {
            clearCategoryFilter();
            return;
        }

        const url = new URL(window.location.href);
        url.searchParams.delete('page');
        url.searchParams.delete('show_categorias');
        url.searchParams.set('categoria', categorySlug);

        window.location.href = url.toString();
    }

    function clearCategoryFilter() {
        const url = new URL(window.location.href);
        url.searchParams.delete('categoria');
        url.searchParams.delete('page');
        url.searchParams.delete('show_categorias');

        window.location.href = url.toString();
    }

    function toggleContent(type) {
        const categoriasContent = document.getElementById('categoriasContent');
        const servicosContent = document.getElementById('servicosContent');
        const toggleCategorias = document.getElementById('toggleCategorias');
        const toggleServicos = document.getElementById('toggleServicos');

        if (type === 'categorias') {
            categoriasContent.style.display = 'block';
            servicosContent.style.display = 'none';
            toggleCategorias.classList.add('active');
            toggleServicos.classList.remove('active');

            const url = new URL(window.location.href);
            url.searchParams.set('show_categorias', 'true');
            url.searchParams.delete('page');
            history.replaceState({}, '', url);
        } else {
            categoriasContent.style.display = 'none';
            servicosContent.style.display = 'block';
            toggleCategorias.classList.remove('active');
            toggleServicos.classList.add('active');

            const url = new URL(window.location.href);
            url.searchParams.delete('show_categorias');
            history.replaceState({}, '', url);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const categoriaSlug = urlParams.get('categoria');
        const showCategorias = urlParams.get('show_categorias');

        if (categoriaSlug) {
            const select = document.getElementById('categorySelect');
            if (select) {
                select.value = categoriaSlug;
            }
        }

        if (showCategorias === 'true') {
            toggleContent('categorias');
        } else {
            toggleContent('servicos');
        }

        const searchInput = document.getElementById('searchInput');
        const suggestionsContainer = document.getElementById('searchSuggestions');
        let timeoutId;
        let currentRequest = null;

        if (searchInput && suggestionsContainer) {
            searchInput.addEventListener('input', function(e) {
                const query = e.target.value.trim();

                clearTimeout(timeoutId);

                if (query.length < 2) {
                    suggestionsContainer.style.display = 'none';
                    return;
                }

                if (currentRequest) {
                    currentRequest.abort();
                }

                timeoutId = setTimeout(() => {
                    const controller = new AbortController();
                    currentRequest = controller;

                    fetch(`{{ route('servicos.busca-rapida') }}?q=${encodeURIComponent(query)}`, {
                            signal: controller.signal
                        })
                        .then(response => {
                            if (!response.ok) throw new Error('Erro na resposta');
                            return response.json();
                        })
                        .then(data => {
                            currentRequest = null;

                            if (data.length > 0) {
                                suggestionsContainer.innerHTML = '';

                                data.forEach(item => {
                                    const suggestion = document.createElement('div');
                                    suggestion.className = 'autocomplete-suggestion p-2 border-bottom';
                                    suggestion.setAttribute('role', 'button');
                                    suggestion.tabIndex = 0;
                                    suggestion.innerHTML = `
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div class="flex-grow-1">
                                                <strong class="d-block">${item.titulo}</strong>
                                                <small class="text-muted d-block">
                                                    <i class="bi bi-tag"></i> ${item.categoria}
                                                </small>
                                                <small class="text-muted d-block">
                                                    ${item.descricao_resumida}
                                                </small>
                                            </div>
                                            <div class="text-end ms-2">
                                                <small class="text-success fw-semibold d-block">
                                                    ${item.preco}
                                                </small>
                                            </div>
                                        </div>
                                    `;

                                    suggestion.addEventListener('click', function() {
                                        window.location.href = item.url;
                                    });

                                    suggestion.addEventListener('keydown', function(e) {
                                        if (e.key === 'Enter' || e.key === ' ') {
                                            e.preventDefault();
                                            window.location.href = item.url;
                                        }
                                    });

                                    suggestionsContainer.appendChild(suggestion);
                                });

                                const verTodos = document.createElement('div');
                                verTodos.className = 'autocomplete-suggestion p-2 text-center border-top';
                                verTodos.innerHTML = `
                                    <small class="text-primary">
                                        <i class="bi bi-search"></i> Ver todos os resultados para "${query}"
                                    </small>
                                `;
                                verTodos.addEventListener('click', function() {
                                    searchInput.value = query;
                                    document.getElementById('searchForm').submit();
                                });
                                suggestionsContainer.appendChild(verTodos);

                                suggestionsContainer.style.display = 'block';
                            } else {
                                suggestionsContainer.innerHTML = `
                                    <div class="autocomplete-suggestion p-2 text-muted text-center">
                                        <small>Nenhum resultado encontrado para "${query}"</small>
                                    </div>
                                `;
                                suggestionsContainer.style.display = 'block';
                            }
                        })
                        .catch(error => {
                            if (error.name !== 'AbortError') {
                                console.error('Erro na busca:', error);
                                suggestionsContainer.style.display = 'none';
                            }
                        });
                }, 300);
            });

            searchInput.addEventListener('keydown', function(e) {
                const suggestions = suggestionsContainer.querySelectorAll('.autocomplete-suggestion');

                if (!suggestions.length || suggestionsContainer.style.display === 'none') return;

                const currentFocus = suggestionsContainer.querySelector('.autocomplete-suggestion.focused');
                let index = currentFocus ? Array.from(suggestions).indexOf(currentFocus) : -1;

                switch (e.key) {
                    case 'ArrowDown':
                        e.preventDefault();
                        if (currentFocus) currentFocus.classList.remove('focused');
                        index = (index + 1) % suggestions.length;
                        suggestions[index].classList.add('focused');
                        suggestions[index].focus();
                        break;

                    case 'ArrowUp':
                        e.preventDefault();
                        if (currentFocus) currentFocus.classList.remove('focused');
                        index = index <= 0 ? suggestions.length - 1 : index - 1;
                        suggestions[index].classList.add('focused');
                        suggestions[index].focus();
                        break;

                    case 'Enter':
                        if (currentFocus) {
                            e.preventDefault();
                            currentFocus.click();
                        }
                        break;

                    case 'Escape':
                        suggestionsContainer.style.display = 'none';
                        break;
                }
            });

            document.addEventListener('click', function(e) {
                if (!searchInput.contains(e.target) && !suggestionsContainer.contains(e.target)) {
                    suggestionsContainer.style.display = 'none';
                }
            });

            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    document.getElementById('searchForm').submit();
                }
            });
        }
    });
</script>

@endsection