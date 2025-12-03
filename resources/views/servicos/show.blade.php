@extends('components.layouts.app')

@section('title', $servico->titulo)

@section('content')

<div class="container my-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('servicos.index') }}">Serviços</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($servico->titulo, 30) }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h1 class="fw-bold mb-2">{{ $servico->titulo }}</h1>
                            <div class="d-flex align-items-center mb-3">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= floor($servico->avaliacao_media ?? 0))
                                        <i class="bi bi-star-fill text-warning fs-5"></i>
                                    @elseif($i <= ceil($servico->avaliacao_media ?? 0))
                                        <i class="bi bi-star-half text-warning fs-5"></i>
                                    @else
                                        <i class="bi bi-star text-warning fs-5"></i>
                                    @endif
                                @endfor
                                <span class="ms-2">
                                    {{ number_format($servico->avaliacao_media, 1) }} 
                                    ({{ $servico->avaliacoes->count() }} avaliações)
                                </span>
                            </div>
                        </div>
                        <span class="badge bg-primary bg-opacity-10 text-primary fs-6">
                            {{ $servico->valor_formatado }}
                        </span>
                    </div>
                    
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3">Descrição do Serviço</h5>
                        <p class="mb-0">{{ nl2br($servico->descricao) }}</p>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5 class="fw-bold mb-3">Detalhes</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="bi bi-tools text-primary me-2"></i>
                                    <strong>Tipo:</strong> {{ $servico->tipo_servico }}
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-geo-alt text-primary me-2"></i>
                                    <strong>Localização:</strong> {{ $servico->endereco_completo }}
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-clock text-primary me-2"></i>
                                    <strong>Status:</strong> 
                                    <span class="badge bg-success">{{ ucfirst($servico->status) }}</span>
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-eye text-primary me-2"></i>
                                    <strong>Visualizações:</strong> {{ $servico->visualizacoes }}
                                </li>
                            </ul>
                        </div>
                        
                        <div class="col-md-6">
                            <h5 class="fw-bold mb-3">Categorias</h5>
                            <div class="d-flex flex-wrap gap-2">
                                @if($servico->categoria)
                                    <span class="badge bg-primary">{{ $servico->categoria->nome }}</span>
                                @endif
                                @foreach($servico->categorias as $categoria)
                                    <span class="badge bg-secondary">{{ $categoria->nome }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Seção do Prestador -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Sobre o Prestador</h5>
                    <div class="d-flex align-items-center">
                        @if($servico->prestador->user->foto)
                            <img src="{{ asset('storage/' . $servico->prestador->user->foto) }}" 
                                 class="rounded-circle me-3"
                                 style="width: 80px; height: 80px; object-fit: cover;"
                                 alt="{{ $servico->prestador->nome }}">
                        @else
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3"
                                 style="width: 80px; height: 80px;">
                                <span class="text-white fs-4 fw-bold">
                                    {{ substr($servico->prestador->nome, 0, 1) }}
                                </span>
                            </div>
                        @endif
                        <div>
                            <h6 class="fw-bold mb-1">{{ $servico->prestador->nome }}</h6>
                            <p class="text-muted mb-1">
                                <i class="bi bi-geo-alt"></i> 
                                {{ $servico->prestador->endereco->cidade ?? '' }}, {{ $servico->prestador->endereco->estado ?? '' }}
                            </p>
                            <div class="d-flex align-items-center">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= floor($servico->prestador->avaliacao_media ?? 0))
                                        <i class="bi bi-star-fill text-warning small"></i>
                                    @else
                                        <i class="bi bi-star text-warning small"></i>
                                    @endif
                                @endfor
                                <span class="ms-1 small text-muted">
                                    ({{ $servico->prestador->avaliacoes->count() ?? 0 }} avaliações)
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Avaliações -->
            @if($servico->avaliacoes->count() > 0)
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Avaliações ({{ $servico->avaliacoes->count() }})</h5>
                    <div class="row">
                        @foreach($servico->avaliacoes->take(3) as $avaliacao)
                        <div class="col-md-6 mb-3">
                            <div class="border rounded p-3 h-100">
                                <div class="d-flex justify-content-between mb-2">
                                    <div>
                                        <strong>{{ $avaliacao->cliente->user->name ?? 'Cliente' }}</strong>
                                    </div>
                                    <div>
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $avaliacao->nota)
                                                <i class="bi bi-star-fill text-warning small"></i>
                                            @else
                                                <i class="bi bi-star text-warning small"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                                @if($avaliacao->titulo)
                                    <h6 class="fw-bold">{{ $avaliacao->titulo }}</h6>
                                @endif
                                @if($avaliacao->comentario)
                                    <p class="mb-0">{{ Str::limit($avaliacao->comentario, 100) }}</p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @if($servico->avaliacoes->count() > 3)
                        <div class="text-center mt-3">
                            <a href="#" class="btn btn-outline-primary btn-sm">
                                Ver todas as avaliações
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
        
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Contratar Serviço</h5>
                    
                    <div class="mb-4">
                        <h4 class="fw-bold text-primary">{{ $servico->valor_formatado }}</h4>
                        @if($servico->tipo_valor === 'hora')
                            <p class="text-muted">Valor por hora de serviço</p>
                        @elseif($servico->tipo_valor === 'fixo')
                            <p class="text-muted">Valor fixo pelo serviço</p>
                        @else
                            <p class="text-muted">Orçamento sob consulta</p>
                        @endif
                    </div>
                    
                    @auth
                        @if(Auth::user()->role_id == 3) <!-- Cliente -->
                            <button class="btn btn-primary w-100 mb-3" data-bs-toggle="modal" data-bs-target="#contatarModal">
                                <i class="bi bi-chat-dots me-2"></i> Contatar Prestador
                            </button>
                            
                            <button class="btn btn-outline-primary w-100 mb-3" data-bs-toggle="modal" data-bs-target="#agendarModal">
                                <i class="bi bi-calendar-plus me-2"></i> Agendar Serviço
                            </button>
                        @endif
                        
                        @if(Auth::user()->id === $servico->prestador->user_id)
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle me-2"></i>
                                Este é o seu serviço cadastrado.
                            </div>
                            <a href="{{ route('servicos.edit', $servico->id) }}" class="btn btn-outline-primary w-100 mb-2">
                                <i class="bi bi-pencil me-2"></i> Editar Serviço
                            </a>
                        @endif
                    @else
                        <div class="alert alert-warning">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            Faça login para contatar o prestador ou agendar este serviço.
                        </div>
                        <a href="{{ route('login') }}" class="btn btn-primary w-100 mb-2">
                            <i class="bi bi-box-arrow-in-right me-2"></i> Fazer Login
                        </a>
                    @endauth
                    
                    <hr class="my-4">
                    
                    <div>
                        <h6 class="fw-bold mb-3">Compartilhar</h6>
                        <div class="d-flex gap-2">
                            <a href="#" class="btn btn-outline-secondary">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="#" class="btn btn-outline-secondary">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                            <a href="#" class="btn btn-outline-secondary">
                                <i class="bi bi-twitter"></i>
                            </a>
                            <a href="#" class="btn btn-outline-secondary">
                                <i class="bi bi-link-45deg"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Mapa -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-0">
                    <div class="ratio ratio-16x9">
                        <iframe
                            src="https://www.google.com/maps?q={{ urlencode($servico->endereco_completo) }}&output=embed"
                            style="border:0; width:100%; height:100%;"
                            allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
            
            <!-- Serviços Relacionados -->
            @if($relatedServices->count() > 0)
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Serviços Relacionados</h5>
                    <div class="list-group list-group-flush">
                        @foreach($relatedServices as $related)
                        <a href="{{ route('servicos.show', $related->id) }}" 
                           class="list-group-item list-group-item-action border-0 py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="fw-bold mb-1">{{ Str::limit($related->titulo, 30) }}</h6>
                                    <small class="text-muted">{{ $related->prestador->nome }}</small>
                                </div>
                                <div class="text-end">
                                    <span class="text-primary fw-bold">{{ $related->valor_formatado }}</span>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal para contatar -->
<div class="modal fade" id="contatarModal" tabindex="-1" aria-labelledby="contatarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contatarModalLabel">Contatar Prestador</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="contatoForm">
                    @csrf
                    <input type="hidden" name="servico_id" value="{{ $servico->id }}">
                    <div class="mb-3">
                        <label class="form-label">Assunto</label>
                        <input type="text" class="form-control" name="assunto" 
                               value="Interesse no serviço: {{ $servico->titulo }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mensagem</label>
                        <textarea class="form-control" rows="4" name="mensagem" 
                                  placeholder="Olá {{ $servico->prestador->nome }}, gostaria de saber mais sobre o seu serviço..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="enviarContato()">Enviar Mensagem</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para agendar -->
<div class="modal fade" id="agendarModal" tabindex="-1" aria-labelledby="agendarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agendarModalLabel">Agendar Serviço</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="agendamentoForm">
                    @csrf
                    <input type="hidden" name="servico_id" value="{{ $servico->id }}">
                    <div class="mb-3">
                        <label class="form-label">Data</label>
                        <input type="date" class="form-control" name="data" min="{{ date('Y-m-d') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Horário</label>
                        <input type="time" class="form-control" name="hora">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Observações</label>
                        <textarea class="form-control" rows="3" name="observacoes" 
                                  placeholder="Detalhes adicionais sobre o serviço..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="enviarAgendamento()">Solicitar Agendamento</button>
            </div>
        </div>
    </div>
</div>

<script>
function enviarContato() {
    // Implementar envio de contato via AJAX
    alert('Funcionalidade de contato em desenvolvimento!');
}

function enviarAgendamento() {
    // Implementar envio de agendamento via AJAX
    alert('Funcionalidade de agendamento em desenvolvimento!');
}
</script>

<style>
    .breadcrumb {
        background-color: transparent;
        padding: 0;
    }
    
    .breadcrumb-item a {
        text-decoration: none;
        color: #6c757d;
    }
    
    .breadcrumb-item.active {
        color: #0d6efd;
    }
    
    .list-group-item:hover {
        background-color: #f8f9fa;
    }
</style>

@endsection