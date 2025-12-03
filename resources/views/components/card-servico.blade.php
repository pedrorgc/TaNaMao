@props([
    'servicos' => [],
    'showPrestador' => true,
    'showCategoria' => true,
    'showValor' => true,
    'showLocalizacao' => true,
    'showBadges' => true,
    'columns' => 3, // md-4 (3 colunas) por padrão
])

@php
    $colClass = match($columns) {
        1 => 'col-12',
        2 => 'col-md-6',
        4 => 'col-md-3',
        default => 'col-md-4',
    };
@endphp

<div class="row">
    @foreach($servicos as $servico)
    @php
        $valorFormatado = '';
        if (isset($servico->tipo_valor)) {
            switch($servico->tipo_valor) {
                case 'hora' && isset($servico->valor_hora):
                    $valorFormatado = 'R$ ' . number_format($servico->valor_hora, 2, ',', '.') . '/hora';
                    break;
                case 'fixo' && isset($servico->valor_fixo):
                    $valorFormatado = 'R$ ' . number_format($servico->valor_fixo, 2, ',', '.');
                    break;
                default:
                    $valorFormatado = 'Valor a combinar';
            }
        }

        $localizacao = '';
        if (isset($servico->cidade_servico) && isset($servico->estado_servico)) {
            $localizacao = $servico->cidade_servico . '/' . $servico->estado_servico;
        } elseif (isset($servico->enderecoServico)) {
            $localizacao = $servico->enderecoServico->cidade . '/' . $servico->enderecoServico->estado;
        }

        $isAtivo = isset($servico->status) && $servico->status === 'ativo';
        $isVerificado = isset($servico->verificado) && $servico->verificado;
    @endphp

    <div class="{{ $colClass }} mb-4">
        <div class="card service-card h-100 shadow-sm border-hover">
            <a href="{{ route('servicos.show', $servico->id) }}" class="text-decoration-none text-dark">
                @if($servico->fotos && $servico->fotos->isNotEmpty())
                <div class="card-img-top-container" style="height: 180px; overflow: hidden;">
                    <img src="{{ asset('storage/' . $servico->fotos->first()->caminho) }}" 
                         class="card-img-top" 
                         alt="{{ $servico->titulo }}"
                         style="height: 100%; width: 100%; object-fit: cover;">
                </div>
                @else
                <div class="card-img-top-placeholder d-flex align-items-center justify-content-center bg-light" 
                     style="height: 180px;">
                    <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                </div>
                @endif

                <div class="card-body">
                    @if($showBadges)
                    <div class="d-flex justify-content-between mb-2">
                        <div>
                            @if($isVerificado)
                            <span class="badge bg-success">
                                <i class="bi bi-check-circle-fill me-1"></i>Verificado
                            </span>
                            @endif
                            
                            @if(!$isAtivo)
                            <span class="badge bg-warning text-dark">
                                <i class="bi bi-clock me-1"></i>Pendente
                            </span>
                            @endif
                        </div>
                        
                        @if(isset($servico->visualizacoes))
                        <small class="text-muted">
                            <i class="bi bi-eye"></i> {{ $servico->visualizacoes }}
                        </small>
                        @endif
                    </div>
                    @endif

                    <h5 class="card-title fw-bold mb-2">{{ $servico->titulo }}</h5>

                    @if($showCategoria && $servico->categoria)
                    <div class="mb-2">
                        <span class="badge bg-primary bg-opacity-10 text-primary">
                            <i class="bi bi-tag me-1"></i>{{ $servico->categoria->nome }}
                        </span>
                    </div>
                    @endif

                    <p class="card-text text-muted small mb-3">
                        {{ Str::limit(strip_tags($servico->descricao), 100) }}
                    </p>

                    <div class="service-meta">
                        @if($showValor && $valorFormatado)
                        <div class="mb-2">
                            <strong class="text-primary fs-5">{{ $valorFormatado }}</strong>
                        </div>
                        @endif

                        @if($showLocalizacao && $localizacao)
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-geo-alt text-muted me-2"></i>
                            <small class="text-muted">{{ $localizacao }}</small>
                        </div>
                        @endif

                        @if($showPrestador)
                        <div class="d-flex align-items-center border-top pt-2">
                            @if(isset($servico->prestador->foto_perfil) && $servico->prestador->foto_perfil)
                            <img src="{{ asset('storage/' . $servico->prestador->foto_perfil) }}" 
                                 class="rounded-circle me-2" 
                                 width="30" 
                                 height="30" 
                                 alt="{{  $servico->prestador->user->name }}">
                            @else
                            <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center me-2" 
                                 style="width: 30px; height: 30px;">
                                <i class="bi bi-person text-white"></i>
                            </div>
                            @endif
                            
                            <div>
                                <small class="text-dark fw-medium d-block">
                                    {{  $servico->prestador->user->name }}
                                </small>
                                
                                @if(isset($servico->prestador->avaliacao_media))
                                <div class="small">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <span class="text-muted">
                                        {{ number_format($servico->prestador->avaliacao_media, 1) }}
                                        @if(isset($servico->prestador->total_avaliacoes))
                                        <span class="ms-1">({{ $servico->prestador->total_avaliacoes }})</span>
                                        @endif
                                    </span>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </a>
        </div>
    </div>
    @endforeach
</div>

@if($servicos->isEmpty())
<div class="text-center py-5">
    <div class="mb-3">
        <i class="bi bi-search" style="font-size: 3rem; color: #ccc;"></i>
    </div>
    <h5 class="text-muted">Nenhum serviço encontrado</h5>
    <p class="text-muted">Tente ajustar seus filtros de busca</p>
</div>
@endif

@push('styles')
<style>
    .service-card {
        transition: all 0.3s ease;
        border: 1px solid #e9ecef;
    }
    
    .service-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
        border-color: var(--bs-primary);
    }
    
    .card-img-top-placeholder {
        background: linear-gradient(45deg, #f8f9fa 25%, #e9ecef 25%, #e9ecef 50%, #f8f9fa 50%, #f8f9fa 75%, #e9ecef 75%, #e9ecef);
        background-size: 20px 20px;
    }
    
    .border-hover {
        position: relative;
    }
    
    .border-hover::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--bs-primary), var(--bs-info));
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .border-hover:hover::before {
        opacity: 1;
    }
</style>
@endpush