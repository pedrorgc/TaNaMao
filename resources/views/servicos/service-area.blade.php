@extends('layouts.app')

@section('title', 'Área de Serviços')

@section('content')

@include('components.category-selector', [
    'categories' => $categories ?? []
])

<div class="bg-light text-center py-5 full-width-bg">
    <div class="container">
        <h1 class="display-5 fw-bold mb-3">Área de Serviços <span class="text-primary">Profissionais</span></h1>
        <p class="lead mb-4">Encontre os melhores prestadores de serviço da sua região.
           Filtre por categoria e avalie as melhores opções.</p>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-6">
                <h2 class="fw-bold mb-0">Prestadores de Serviço</h2>
                <p class="text-muted">Encontre profissionais qualificados para seu projeto</p>
            </div>
            <div class="col-md-6">
                <form action="{{ route('servicos.index') }}" method="GET" class="d-flex">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Buscar prestador..." 
                               value="{{ request('search') }}">
                        @if(request('categoria'))
                            <input type="hidden" name="categoria" value="{{ request('categoria') }}">
                        @endif
                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @if(request('categoria') && $selectedCategory)
            <div class="alert alert-info d-flex align-items-center mb-4">
                <i class="bi bi-info-circle me-2"></i>
                Mostrando prestadores da categoria: <strong class="ms-1">{{ $selectedCategory->nome }}</strong>
                <a href="{{ route('servicos.index') }}" class="ms-3 btn btn-sm btn-outline-info">Limpar filtro</a>
            </div>
        @endif

        @if($prestadores->count() > 0)
            <div class="row g-4">
                @foreach($prestadores as $prestador)
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm h-100 hover-shadow">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-3 text-center">
                                    @if($prestador->foto)
                                        <img src="{{ asset('storage/' . $prestador->foto) }}" 
                                             class="rounded-circle img-fluid mb-3" 
                                             alt="{{ $prestador->nome }}"
                                             style="width: 100px; height: 100px; object-fit: cover;">
                                    @else
                                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3"
                                             style="width: 100px; height: 100px;">
                                            <span class="text-white fs-4 fw-bold">
                                                {{ substr($prestador->nome, 0, 1) }}
                                            </span>
                                        </div>
                                    @endif
                                    
                                    @if($prestador->categoria)
                                        <span class="badge bg-primary bg-opacity-10 text-primary">
                                            {{ $prestador->categoria->nome }}
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="col-md-9">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <h4 class="fw-bold mb-1">{{ $prestador->nome }}</h4>
                                            @if($prestador->profissao)
                                                <p class="text-muted mb-2">{{ $prestador->profissao }}</p>
                                            @endif
                                        </div>
                                        <div class="text-end">
                                            <div class="d-flex align-items-center justify-content-end mb-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= floor($prestador->avaliacao_media ?? 0))
                                                        <i class="bi bi-star-fill text-warning small"></i>
                                                    @elseif($i <= ceil($prestador->avaliacao_media ?? 0))
                                                        <i class="bi bi-star-half text-warning small"></i>
                                                    @else
                                                        <i class="bi bi-star text-warning small"></i>
                                                    @endif
                                                @endfor
                                                <span class="ms-1 small text-muted">
                                                    ({{ $prestador->total_avaliacoes ?? 0 }})
                                                </span>
                                            </div>
                                            @if($prestador->cidade || $prestador->estado)
                                                <p class="small text-muted mb-0">
                                                    <i class="bi bi-geo-alt"></i>
                                                    {{ $prestador->cidade ?? '' }}{{ $prestador->cidade && $prestador->estado ? ', ' : '' }}{{ $prestador->estado ?? '' }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    @if($prestador->descricao)
                                        <p class="mb-3">{{ Str::limit($prestador->descricao, 150) }}</p>
                                    @endif
                                    
                                    <div class="d-flex flex-wrap gap-2 mb-3">
                                        @if($prestador->experiencia)
                                            <span class="badge bg-light text-dark border">
                                                <i class="bi bi-briefcase me-1"></i>
                                                {{ $prestador->experiencia }} anos
                                            </span>
                                        @endif
                                        
                                        @if($prestador->servicos_concluidos)
                                            <span class="badge bg-light text-dark border">
                                                <i class="bi bi-check-circle me-1"></i>
                                                {{ $prestador->servicos_concluidos }} serviços
                                            </span>
                                        @endif
                                        
                                        @if($prestador->disponibilidade)
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success">
                                                <i class="bi bi-clock me-1"></i>
                                                Disponível
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <div>
                                            @if($prestador->valor_hora)
                                                <span class="fw-bold text-primary fs-5">
                                                    R$ {{ number_format($prestador->valor_hora, 2, ',', '.') }}/h
                                                </span>
                                            @else
                                                <span class="fw-bold text-primary">
                                                    Orçamento sob consulta
                                                </span>
                                            @endif
                                        </div>
                                        <div>
                                            <a href="{{ route('servicos.show', $prestador->id) }}" 
                                               class="btn btn-primary btn-sm">
                                                Ver Perfil <i class="bi bi-arrow-right ms-1"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Paginação -->
            <div class="d-flex justify-content-center mt-5">
                <nav aria-label="Paginação de prestadores">
                    <ul class="pagination">
                        {{-- Botão Anterior --}}
                        <li class="page-item {{ $prestadores->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $prestadores->previousPageUrl() }}" aria-label="Anterior">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        
                        {{-- Números das páginas --}}
                        @foreach(range(1, $prestadores->lastPage()) as $page)
                            @if($page == $prestadores->currentPage())
                                <li class="page-item active" aria-current="page">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @elseif($page <= 3 || $page >= $prestadores->lastPage() - 2 || 
                                   abs($page - $prestadores->currentPage()) <= 1)
                                <li class="page-item">
                                    <a class="page-link" href="{{ $prestadores->url($page) }}">{{ $page }}</a>
                                </li>
                            @elseif($page == 4 && $prestadores->currentPage() > 4)
                                <li class="page-item disabled">
                                    <span class="page-link">...</span>
                                </li>
                            @elseif($page == $prestadores->lastPage() - 3 && $prestadores->currentPage() < $prestadores->lastPage() - 3)
                                <li class="page-item disabled">
                                    <span class="page-link">...</span>
                                </li>
                            @endif
                        @endforeach
                        
                        {{-- Botão Próximo --}}
                        <li class="page-item {{ !$prestadores->hasMorePages() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $prestadores->nextPageUrl() }}" aria-label="Próximo">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            
            <div class="text-center text-muted mt-2">
                Mostrando {{ $prestadores->firstItem() }} a {{ $prestadores->lastItem() }} 
                de {{ $prestadores->total() }} prestadores
            </div>

        @else
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="bi bi-people fs-1 text-muted"></i>
                </div>
                <h4 class="fw-bold mb-3">Nenhum prestador encontrado</h4>
                <p class="text-muted mb-4">
                    @if(request('search') || request('categoria'))
                        Tente ajustar seus filtros de busca
                    @else
                        Não há prestadores cadastrados no momento
                    @endif
                </p>
                @if(request('search') || request('categoria'))
                    <a href="{{ route('servicos.index') }}" class="btn btn-primary">
                        <i class="bi bi-arrow-left me-1"></i> Limpar filtros
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>

<div class="bg-light py-5 full-width-bg">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Como contratar um prestador</h2>
        
        <div class="row g-4 justify-content-center">
            <div class="col-lg-3 col-md-6">
                <div class="text-center p-4">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="bi bi-search fs-4 text-primary"></i>
                    </div>
                    <h5 class="fw-bold">1. Encontre</h5>
                    <p class="text-muted small">Busque pelo serviço que precisa ou navegue pelas categorias</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="text-center p-4">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="bi bi-person-badge fs-4 text-primary"></i>
                    </div>
                    <h5 class="fw-bold">2. Analise</h5>
                    <p class="text-muted small">Veja o perfil completo, avaliações e portfólio do prestador</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="text-center p-4">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="bi bi-chat-dots fs-4 text-primary"></i>
                    </div>
                    <h5 class="fw-bold">3. Contate</h5>
                    <p class="text-muted small">Entre em contato direto para tirar dúvidas e solicitar orçamento</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="text-center p-4">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="bi bi-check-circle fs-4 text-primary"></i>
                    </div>
                    <h5 class="fw-bold">4. Contrate</h5>
                    <p class="text-muted small">Feche o negócio e avalie o serviço após a conclusão</p>
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
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }

    .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .page-link {
        color: #0d6efd;
    }

    .page-link:hover {
        color: #0a58ca;
    }

    @media (max-width: 768px) {
        .display-5 {
            font-size: 2rem;
        }
        
        .lead {
            font-size: 1rem;
        }
        
        .card-body .row {
            flex-direction: column;
            text-align: center;
        }
        
        .card-body .col-md-9 {
            text-align: center;
        }
        
        .card-body .d-flex.justify-content-between {
            flex-direction: column;
            gap: 1rem;
        }
        
        .d-flex.justify-content-end {
            justify-content: center !important;
        }
    }
</style>

@endsection