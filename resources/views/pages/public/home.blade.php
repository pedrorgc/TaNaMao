@extends('layouts.app')

@section('title', 'Página Inicial')

@section('content')

@include('components.category-selector', [
'categories' => $categories ?? []
])
@php
    $servicosLimitados = $servicosDestaque->slice(0, 3);
@endphp
@if(isset($servicosDestaque) && $servicosDestaque->count() > 0)
<div class="py-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Serviços em Destaque</h2>

        @include('components.card-servico-destaque', [
            'items' => $servicosDestaque,
            'routeName' => 'servicos.show',
            'titleField' => 'titulo',
            'descriptionField' => 'descricao',
            'badgeField' => 'categoria.nome',
            'showPrestador' => true,
            'prestadorNameField' => 'prestador.user.name'
        ])

        <div class="text-center mt-4">
            <a href="{{ route('servicos.index') }}" class="btn btn-outline-primary">
                Ver Todos os Serviços <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</div>
@endif

<div class="bg-light text-center py-5 full-width-bg">
    <div class="container">
        <h1 class="display-5 fw-bold mb-3">Encontre o profissional <span class="text-primary">certo para você</span></h1>
        <p class="lead mb-4">Conectamos você aos melhores prestadores de serviço da sua região.
            Rápido, confiável e na palma da sua mão.</p>

        <div class="d-flex gap-3 justify-content-center flex-wrap">

            @if ($showFindServices)
            @include('components.button', [
            'slot' => 'Encontrar Serviços',
            'class' => 'btn-primary btn-lg px-4 py-2',
            'href' => $findServicesRoute
            ])
            @endif

            @if ($showOfferServices)
            @include('components.button', [
            'slot' => 'Prestar Serviços',
            'class' => 'btn-outline-primary btn-lg px-4 py-2',
            'href' => $offerServicesRoute
            ])
            @endif

        </div>
    </div>
</div>

<div class="py-5">
    <div class="container">
    <h2 class="text-center fw-bold mb-5">Categorias Populares</h2>

    <div class="row g-4">
        @foreach($featuredCategories as $category)
        <div class="col-lg-3 col-md-6">
            @php
                $categoriaRoute = null;

                if (Route::has('categorias.show')) {
                    $categoriaRoute = route('categorias.show', $category->slug);
                } elseif (Route::has('servicos.categoria')) {
                    $categoriaRoute = route('servicos.categoria', $category->slug);
                } elseif (Route::has('servicos.index')) {
                    $categoriaRoute = route('servicos.index', ['categoria' => $category->slug]);
                } else {
                    $categoriaRoute = '/servicos?categoria=' . $category->slug;
                }
            @endphp

            <a href="{{ $categoriaRoute }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100 text-center hover-shadow">
                    <div class="card-body py-4">
                        <i class="bi {{ $category->icone }} fs-1 text-primary mb-3"></i>
                        <h5 class="card-title fw-bold text-dark">{{ $category->nome }}</h5>
                        <p class="card-text text-muted small">{{ $category->descricao }}</p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>

    @if($allCategories->count() > 4)
    <div class="text-center mt-5">
        @php
            $todasCategoriasRoute = null;

            if (Route::has('categorias.index')) {
                $todasCategoriasRoute = route('categorias.index');
            } elseif (Route::has('servicos.index')) {
                $todasCategoriasRoute = route('servicos.index');
            } else {
                $todasCategoriasRoute = '/servicos';
            }
        @endphp

        <a href="{{ $todasCategoriasRoute }}" class="btn btn-outline-primary">
            Ver Todas as Categorias <i class="bi bi-arrow-right ms-1"></i>
        </a>
    </div>
    @endif
</div>
</div>

<div id="como-funciona" class="bg-light py-5 full-width-bg">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Como Funciona</h2>

        <div class="row g-4 justify-content-center">
            <div class="col-lg-4 col-md-6">
                <div class="text-center p-4">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="bi bi-search fs-3 text-primary"></i>
                    </div>
                    <h4 class="fw-bold">1. Busque</h4>
                    <p class="text-muted">Procure o serviço que precisa na sua região</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="text-center p-4">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="bi bi-people fs-3 text-primary"></i>
                    </div>
                    <h4 class="fw-bold" >2. Compare</h4>
                    <p class="text-muted">Veja perfis, avaliações e escolha o melhor</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="text-center p-4">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="bi bi-check-circle fs-3 text-primary"></i>
                    </div>
                    <h4 class="fw-bold">3. Contrate</h4>
                    <p class="text-muted">Contrate direto pela plataforma</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">O que dizem nossos usuários</h2>

        <div class="row g-4 justify-content-center">
            @foreach([
            ['name' => 'Raí', 'type' => 'Cliente', 'comment' => 'Encontrei um eletricista excelente em poucos minutos', 'rating' => 5],
            ['name' => 'Pedro', 'type' => 'Prestador', 'comment' => 'Consegui mais clientes e organizei melhor meu negócio', 'rating' => 5],
            ['name' => 'Luiz', 'type' => 'Cliente', 'comment' => 'Serviço rápido e confiável, recomendo', 'rating' => 5]
            ] as $testimonial)
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            @for($i = 0; $i < $testimonial['rating']; $i++)
                                <i class="bi bi-star-fill text-warning"></i>
                                @endfor
                        </div>
                        <p class="fst-italic mb-4">"{{ $testimonial['comment'] }}"</p>
                        <div class="d-flex align-items-center">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                <span class="text-white fw-bold">{{ substr($testimonial['name'], 0, 1) }}</span>
                            </div>
                            <div>
                                <p class="fw-bold mb-0">{{ $testimonial['name'] }}</p>
                                <span class="text-muted small">{{ $testimonial['type'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div id="sobre" class="bg-light py-5 full-width-bg">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 text-center mb-4 mb-lg-0">
                <img src="{{ asset('assets/TaNaMao-3D.png') }}" alt="TaNaMão" class="img-fluid" style="max-height: 300px;">
            </div>
            <div class="col-lg-6">
                <h2 class="fw-bold mb-4">Sobre Nós</h2>
                <p class="lead mb-4">
                    O TaNaMão surgiu com o propósito de conectar quem precisa com quem sabe fazer.
                    Somos um sistema que conecta clientes e profissionais que buscam um mesmo propósito.
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    @include('components.button', [
                    'slot' => 'Cadastre-se Grátis',
                    'class' => 'btn-primary px-4 py-2',
                    'href' => '/pre-cadastro'
                    ])
                    @include('components.button', [
                    'slot' => 'Conheça Mais',
                    'class' => 'btn-outline-primary px-4 py-2',
                    'href' => '#'
                    ])
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .full-width-bg {
        position: relative;
        width: 100vw;
        left: 50%;
        right: 50%;
        margin-left: -50vw;
        margin-right: -50vw;
        overflow-x: hidden;
    }

    .hover-shadow {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }

    html {
        scroll-padding-top: 120px;
    }

    @media (max-width: 768px) {
        .display-5 {
            font-size: 2rem;
        }

        .lead {
            font-size: 1rem;
        }

        .btn-lg {
            padding: 0.5rem 1rem !important;
            font-size: 0.9rem !important;
        }

        html {
            scroll-padding-top: 100px;
        }
    }
</style>

@endsection
