@extends('layouts.app')
@section('title', 'Serviços Disponíveis')

@section('content')


@include('components.category-selector', [
'categories' => $categories
])

@if(request('categoria'))
<div class="container py-5">
    <div class="d-flex align-items-center mb-4">
        {{-- Botão de voltar totalmente à esquerda --}}
        <a href="{{ route('servicos.index') }}" class="btn btn-outline-secondary me-4">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>

        {{-- Título da categoria centralizado --}}
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
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $servico->titulo }}</h5>
                    <p class="card-text">{{ Str::limit($servico->descricao, 100) }}</p>
                    @if($servico->categoria)
                    <span class="badge bg-primary">{{ $servico->categoria->nome }}</span>
                    @endif

                    {{-- Detalhes adicionais --}}
                    <div class="mt-3">
                        <small class="text-muted">
                            <i class="bi bi-person"></i> {{ $servico->prestador->name ?? 'Prestador' }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Paginação abaixo --}}
    <div class="mt-5">
        {{ $servicos->withQueryString()->links() }}
    </div>
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

@if($showCategoriasSection)
<div class="container py-5">
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
@endif

<div class="py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-6">
                <h2 class="fw-bold mb-0">Serviços Disponíveis</h2>
                <p class="text-muted">Encontre profissionais qualificados para seu projeto</p>
            </div>
            <div class="col-md-6">
                <form action="{{ route('servicos.index') }}" method="GET" class="d-flex" id="searchForm">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Buscar serviço..."
                            value="{{ request('search') }}">

                        <select name="categoria" class="form-select" style="max-width: 200px;"
                            id="categorySelect" onchange="updateCategoryFilter(this.value)">
                            <option value="">Todas as categorias</option>
                            @foreach($categoriesForCard ?? [] as $category)
                            @php
                            if ($category instanceof \App\Models\Categoria) {
                            $categoryId = $category->id;
                            $categoryName = $category->nome;
                            $categorySlug = $category->slug;
                            } else {
                            $categoryId = $category['id'] ?? $category['id'] ?? null;
                            $categoryName = $category['nome'] ?? $category['name'] ?? '';
                            $categorySlug = $category['slug'] ?? '';
                            }

                            $selected = request('categoria') == $categorySlug;
                            @endphp

                            <option value="{{ $categorySlug }}"
                                {{ $selected ? 'selected' : '' }}
                                data-category-id="{{ $categoryId }}">
                                {{ $categoryName }}
                            </option>
                            @endforeach
                        </select>

                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @if(isset($servicos) && $servicos->count() > 0)
        <div class="row">
            @foreach($servicos as $servico)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $servico->titulo }}</h5>
                        <p class="card-text">{{ Str::limit($servico->descricao, 100) }}</p>
                        @if($servico->categoria)
                        <span class="badge bg-primary">{{ $servico->categoria->nome }}</span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>


        )

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

    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const categoriaSlug = urlParams.get('categoria');

        if (categoriaSlug) {
            const select = document.getElementById('categorySelect');
            if (select) {
                select.value = categoriaSlug;
            }
        }

        const showCategorias = urlParams.get('show_categorias');
        if (showCategorias === 'true') {
            const categoriasSection = document.querySelector('.card-categoria-container');
            if (categoriasSection) {
                setTimeout(() => {
                    categoriasSection.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }, 100);
            }
        }
    });
</script>

@endsection