@extends('layouts.app')

@section('title', $titulo ?? 'Detalhes do Serviço')

@section('content')
<div class="container my-5">

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg mb-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-4 pb-3 border-bottom">
                        <div>
                            <h1 class="fw-bold mb-3 text-dark display-6">{{ $titulo ?? 'Título do Serviço' }}</h1>

                            <div class="d-flex align-items-center flex-wrap gap-2 mb-2">
                                @if($badges['verificado'] ?? false)
                                <span class="badge bg-success bg-gradient rounded-pill px-3 py-2">
                                    <i class="bi bi-check-circle-fill me-1"></i> Verificado
                                </span>
                                @endif

                                <span class="badge bg-primary bg-gradient rounded-pill px-3 py-2 fw-normal">
                                    <i class="bi bi-currency-dollar me-1"></i>{{ ucfirst($tipo_valor ?? 'orcamento') }}
                                </span>

                                <span class="badge bg-secondary bg-gradient rounded-pill px-3 py-2">
                                    <i class="bi bi-eye me-1"></i> {{ $visualizacoes ?? 0 }} visualizações
                                </span>
                            </div>
                        </div>

                        <div class="text-end">
                            <div class="bg-primary bg-opacity-10 p-3 rounded-3 border border-primary border-opacity-25">
                                <h4 class="text-primary fw-bold mb-0 display-6">{{ $valor_formatado ?? 'Valor a combinar' }}</h4>
                                <small class="text-muted fw-medium">
                                    @if($tipo_valor === 'hora')
                                    <i class="bi bi-clock me-1"></i>Por hora
                                    @elseif($tipo_valor === 'fixo')
                                    <i class="bi bi-cash-stack me-1"></i>Valor fixo
                                    @else
                                    <i class="bi bi-chat-square-text me-1"></i>Orçamento sob consulta
                                    @endif
                                </small>
                            </div>
                        </div>
                    </div>

                    @if($categoria)
                    <div class="mb-4">
                        <span class="badge bg-primary bg-opacity-15 text-white border border-primary border-opacity-50 rounded-pill px-3 py-2 fs-6" style="color: white;">
                            <i class="bi bi-tag-fill me-2" style="color: white;"></i>{{ $categoria->nome }}
                        </span>
                    </div>
                    @endif

                    <div class="mb-5">
                        <h5 class="fw-bold mb-4 text-dark border-bottom pb-2">
                            <i class="bi bi-card-text text-primary me-2"></i>Descrição do Serviço
                        </h5>
                        <div class="servico-descricao bg-light bg-opacity-25 p-4 rounded-3 border">
                            {!! nl2br(e($descricao ?? '')) !!}
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <h5 class="fw-bold mb-4 text-dark border-bottom pb-2">
                                <i class="bi bi-info-circle text-primary me-2"></i>Informações
                            </h5>
                            <ul class="list-unstyled">
                                <li class="mb-3 d-flex align-items-center p-2 bg-light bg-opacity-50 rounded-2">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                        <i class="bi bi-geo-alt-fill text-primary fs-5"></i>
                                    </div>
                                    <div>
                                        <strong class="d-block text-muted small">Localização</strong>
                                        <span class="fw-medium">{{ $localizacao ?? 'Não informada' }}</span>
                                    </div>
                                </li>
                                <li class="mb-3 d-flex align-items-center p-2 bg-light bg-opacity-50 rounded-2">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                        <i class="bi bi-tools text-primary fs-5"></i>
                                    </div>
                                    <div>
                                        <strong class="d-block text-muted small">Tipo de Serviço</strong>
                                        <span class="fw-medium">{{ $tipo_servico ?? 'Não informado' }}</span>
                                    </div>
                                </li>
                                <li class="mb-3 d-flex align-items-center p-2 bg-light bg-opacity-50 rounded-2">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                        <i class="bi bi-calendar-check text-primary fs-5"></i>
                                    </div>
                                    <div>
                                        <strong class="d-block text-muted small">Publicado em</strong>
                                        <span class="fw-medium">{{ $data_criacao ?? '' }}</span>
                                    </div>
                                </li>
                                @if($telefone_formatado)
                                <li class="d-flex align-items-center p-2 bg-light bg-opacity-50 rounded-2">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                        <i class="bi bi-telephone-fill text-primary fs-5"></i>
                                    </div>
                                    <div>
                                        <strong class="d-block text-muted small">Telefone</strong>
                                        <span class="fw-medium">{{ $telefone_formatado }}</span>
                                    </div>
                                </li>
                                @endif
                            </ul>
                        </div>

                        @if($localizacao && $localizacao != 'Localização não informada')
                        <div class="col-md-6">
                            <h5 class="fw-bold mb-4 text-dark border-bottom pb-2">
                                <i class="bi bi-map text-primary me-2"></i>Localização
                            </h5>
                            <div class="ratio ratio-16x9 rounded-3 overflow-hidden border shadow-sm">
                                <iframe
                                    src="https://www.google.com/maps?q={{ urlencode($localizacao) }}&output=embed"
                                    style="border:0; width:100%; height:100%;"
                                    allowfullscreen="" loading="lazy"></iframe>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-lg mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4 text-dark border-bottom pb-3">
                        <i class="bi bi-person-badge text-primary me-2"></i>Sobre o Prestador
                    </h5>
                    <div class="d-flex align-items-center bg-light bg-opacity-25 p-4 rounded-3">
                        <div class="bg-primary bg-gradient rounded-circle d-flex align-items-center justify-content-center me-4 shadow"
                            style="width: 90px; height: 90px;">
                            <span class="text-white fs-2 fw-bold">
                                {{ substr($servico->prestador->user->nome ?? $prestador['nome'] ?? 'P', 0, 1) }}
                            </span>
                        </div>

                        <div class="flex-grow-1">
                            <h4 class="fw-bold mb-2"> {{  $servico->prestador->user->name ?? $prestador['nome'] ?? 'Prestador' }}</h4>
                            <p class="text-muted mb-1 fs-5">
                                <i class="bi bi-geo-alt-fill me-2"></i>
                                {{ $localizacao ?? 'Localização não informada' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
    <div class="card border-0 shadow-lg mb-4">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-4 text-dark border-bottom pb-3">
                <i class="bi bi-hand-thumbs-up text-primary me-2"></i>Contratar Serviço
            </h5>

            <div class="mb-4 text-center bg-primary bg-opacity-5 p-4 rounded-3 border border-primary border-opacity-25">
                <h3 class="fw-bold text-white mb-2 display-6">{{ $valor_formatado ?? 'Valor a combinar' }}</h3>
                <small class="text-white d-block fs-6">
                    @if($tipo_valor === 'hora')
                    <i class="bi bi-clock me-1"></i>Valor por hora
                    @elseif($tipo_valor === 'fixo')
                    <i class="bi bi-cash-stack me-1"></i>Valor total do serviço
                    @else
                    <i class="bi bi-chat-square-text me-1"></i>Solicite orçamento
                    @endif
                </small>
            </div>

            {{-- Botão sempre visível --}}
            <button class="btn btn-primary btn-lg w-100 mb-3 shadow-sm py-3 fs-5 rounded-pill" data-bs-toggle="modal" data-bs-target="#contatarModal">
                <i class="bi bi-chat-dots-fill me-2"></i> Contatar Prestador
            </button>

            @if($telefone_formatado)
            @php
                $telefone_whatsapp = preg_replace('/[^0-9]/', '', $telefone_formatado);
                if (substr($telefone_whatsapp, 0, 1) === '0') {
                    $telefone_whatsapp = substr($telefone_whatsapp, 1);
                }
            @endphp
            <a href="https://wa.me/55{{ $telefone_whatsapp }}?text=Olá, tenho interesse no serviço: {{ urlencode($titulo ?? 'Serviço') }}"
                target="_blank"
                class="btn btn-success btn-lg w-100 mb-3 shadow-sm py-3 fs-5 rounded-pill">
                <i class="bi bi-whatsapp me-2"></i> WhatsApp
            </a>
            @endif
        </div>
    </div>

    @if(isset($outrosServicosPrestador) && $outrosServicosPrestador->count() > 0)
    <div class="card border-0 shadow-lg mb-4">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-4 text-dark border-bottom pb-3">
                <i class="bi bi-grid-3x3-gap text-primary me-2"></i>Outros Serviços
            </h5>
            <div class="list-group list-group-flush">
                @foreach($outrosServicosPrestador as $outroServico)
                <a href="{{ route('servicos.show', $outroServico->id) }}"
                    class="list-group-item list-group-item-action border-0 py-3 mb-2 rounded-2 hover-shadow bg-light bg-opacity-25">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-2">
                            <h6 class="fw-bold mb-1">{{ Str::limit($outroServico->titulo, 30) }}</h6>
                            @if($outroServico->categoria)
                            <small class="text-muted fw-medium">
                                <i class="bi bi-tag me-1"></i>{{ $outroServico->categoria->nome }}
                            </small>
                            @endif
                        </div>
                        <div class="text-end">
                            @php
                            $valor = '';
                            if($outroServico->tipo_valor == 'hora' && $outroServico->valor_hora) {
                            $valor = 'R$ ' . number_format($outroServico->valor_hora, 2, ',', '.');
                            } elseif($outroServico->tipo_valor == 'fixo' && $outroServico->valor_fixo) {
                            $valor = 'R$ ' . number_format($outroServico->valor_fixo, 2, ',', '.');
                            } else {
                            $valor = 'Orçamento';
                            }
                            @endphp
                            <span class="text-primary fw-bold fs-5">{{ $valor }}</span>
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

<div class="modal fade" id="contatarModal" tabindex="-1" aria-labelledby="contatarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white border-0 rounded-top-3">
                <h5 class="modal-title fw-bold" id="contatarModalLabel">
                    <i class="bi bi-envelope-fill me-2"></i>Contatar Prestador
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST">
                @csrf
                <div class="modal-body p-4">
                    <input type="hidden" name="servico_id" value="{{ $servico->id ?? '' }}">
                    <input type="hidden" name="prestador_id" value="{{ $servico->prestador_id ?? '' }}">

                    <div class="mb-4">
                        <label class="form-label fw-bold text-dark">Assunto</label>
                        <input type="text" class="form-control border-2 py-3 rounded-2" name="assunto" required
                            value="Interesse no serviço: {{ $titulo ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark">Mensagem</label>
                        <textarea class="form-control border-2 py-3 rounded-2" rows="5" name="mensagem" required
                            placeholder="Olá {{ $servico->prestador->user->nome ?? $prestador['nome'] ?? 'Prestador' }}, gostaria de saber mais sobre o seu serviço..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 bg-light rounded-bottom-3">
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4 rounded-pill" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary btn-lg px-4 rounded-pill">
                        <i class="bi bi-send-fill me-2"></i>Enviar Mensagem
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection