@extends('layouts.app')

@section('content')
<div style="background-color: #EAEAEA; min-height: calc(100vh - 60px); padding-top: 80px; padding-bottom: 40px;">



    <div class="container my-4">
        @include('components.card-pessoa', [
        'sigla' => $sigla,
        'nome' => $nome,
        'ocupacao' => $ocupacao,
        'data' => "Membro desde {$dataCadastro}",
        'status' => $status
        ])

        <ul class="nav nav-pills mb-4 bg-white p-2 rounded-4 shadow-sm justify-content-center gap-5" id="profileTabs">
            <li class="nav-item mx-5">
                <button class="nav-link active rounded-5 px-5 py-2 fw-semibold" id="info-tab" data-bs-toggle="pill"
                    data-bs-target="#info">Informações</button>
            </li>
            <li class="nav-item mx-5">
                <button class="nav-link rounded-5 px-5 py-2 fw-semibold" id="history-tab" data-bs-toggle="pill"
                    data-bs-target="#history">Histórico</button>
            </li>
            <li class="nav-item mx-5">
                <button class="nav-link rounded-5 px-5 py-2 fw-semibold" id="reviews-tab" data-bs-toggle="pill"
                    data-bs-target="#reviews">Avaliações</button>
            </li>

            @if($isPrestador)
            <li class="nav-item mx-5">
                <button class="nav-link rounded-5 px-5 py-2 fw-semibold" id="portfolio-tab" data-bs-toggle="pill"
                    data-bs-target="#portfolio">Portfólio</button>
            </li>
            @endif
        </ul>

        <div class="tab-content">
            <!-- ABA INFORMAÇÕES -->
            <div class="tab-pane fade show active" id="info">
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body">
                        <h5 class="fw-bold mb-4">Informações Pessoais</h5>

                        <div class="row mb-3 info-inputs">
                            <div class="col-md-6">
                                <label class="form-label">Nome Completo</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input type="text" class="form-control" id="displayNome" value="{{ $nome }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">E-mail</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input type="email" class="form-control" id="displayEmail" value="{{ $user->email }}" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3 info-inputs">
                            <div class="col-md-6">
                                <label class="form-label">Telefone</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                    <input type="text" class="form-control" id="displayTelefone" value="{{ $telefone }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Localização</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                                    <input type="text" class="form-control" id="displayLocalizacao" value="{{ $localizacao }}" disabled>
                                </div>
                            </div>
                        </div>

                        @if($isPrestador)
                        <div class="row info-inputs">
                            <div class="col-md-6">
                                <label class="form-label">Descrição Profissional</label>
                                <div class="input-group">
                                    <span class="input-group-text align-self-start"><i class="bi bi-briefcase"></i></span>
                                    <textarea class="form-control" placeholder="Fale sobre a sua experiência" id="displayDescricao" rows="4" disabled>{{ $descricao ?? 'Descrição não informada' }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Categoria</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-tags"></i></span>
                                    <input type="text" class="form-control" id="displayCategoria" value="{{ $categoria ?? 'Não definida' }}" disabled>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="text-end mt-4">
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                                <i class="bi bi-pencil-square me-1"></i> Editar Perfil
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal para Editar Perfil -->
                <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editProfileModalLabel">
                                    <i class="bi bi-pencil-square me-1"></i> Editar Informações Pessoais
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="editProfileForm" action="{{ route('profile.update') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="editNome" class="form-label">Nome Completo</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                                            <input type="text" class="form-control" id="editNome" name="name" value="{{ $nome }}" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editEmail" class="form-label">E-mail</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                            <input type="email" class="form-control" id="editEmail" name="email" value="{{ $user->email }}" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editTelefone" class="form-label">Telefone</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                            <input type="tel" class="form-control" id="editTelefone" name="telefone" value="{{ $telefone }}" required pattern="\([0-9]{2}\) [0-9]{5}-[0-9]{4}">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editLocalizacao" class="form-label">Localização</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                                            <input type="text" class="form-control" id="editLocalizacao" name="localizacao" value="{{ $localizacao }}" required>
                                        </div>
                                    </div>

                                    @if($isPrestador)
                                    <div class="mb-3">
                                        <label for="editDescricao" class="form-label">Descrição Profissional</label>
                                        <div class="input-group">
                                            <span class="input-group-text align-self-start"><i class="bi bi-briefcase"></i></span>
                                            <textarea class="form-control" id="editDescricao" name="descricao" rows="4" required>{{ $descricao ?? '' }}</textarea>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editCategoria" class="form-label">Categoria</label>
                                        <div class="input-group position-relative">
                                            <span class="input-group-text"><i class="bi bi-tags"></i></span>
                                            <select class="form-select categoria-select" id="editCategoria" name="categoria_id" required>
                                                <option value="" disabled>Selecione uma categoria</option>
                                                @foreach($categorias as $cat)
                                                <option value="{{ $cat->id }}" {{ ($categoria ?? '') == $cat->nome ? 'selected' : '' }}>{{ $cat->nome }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Configurações da Conta -->
                <div class="bg-white shadow-sm rounded p-4 mt-4 mb-5">
                    <h5 class="fw-bold mb-3">Configurações da Conta</h5>

                    <form action="{{ route('profile.settings.update') }}" method="POST">
                        @csrf
                        <div class="border-bottom py-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>Notificações por Email</strong>
                                    <p class="text-muted small mb-0">Receber notificações sobre serviços e atualizações</p>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="notificacao_email"
                                        {{ $user->notificacao_email ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>

                        <div class="border-bottom py-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>Notificações Push</strong>
                                    <p class="text-muted small mb-0">Receber notificações em tempo real</p>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="notificacao_push"
                                        {{ $user->notificacao_push ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>

                        <div class="pt-3">
                            <button type="submit" class="btn btn-primary w-100 py-2">
                                <i class="bi bi-save me-2"></i> Salvar Configurações
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ABA HISTÓRICO -->
            <div class="tab-pane fade" id="history">
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body">
                        <h5 class="fw-bold mb-4 mt-3">
                            {{ $isPrestador ? 'Histórico de Serviços Prestados' : 'Histórico de Serviços Contratados' }}
                        </h5>

                        @if($isPrestador)
                        <!-- Histórico para Prestador -->
                        <div class="row gy-4 mb-4">
                            <div class="col-12">
                                <div class="p-3 border rounded-3 shadow-sm bg-white">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="fw-bold mb-1">Reparo de Encanamento</h6>
                                            <p class="text-muted mb-1" style="font-size: 0.9rem;">Cliente: João Silva</p>
                                            <p class="text-muted mb-0" style="font-size: 0.9rem;">
                                                24/02/24 &nbsp;
                                                <i class="bi bi-star-fill text-warning"></i> <strong>5</strong>
                                            </p>
                                        </div>
                                        <div class="text-end">
                                            <span class="badge px-3 py-2 rounded-pill bg-success text-white">Concluído</span>
                                            <p class="fw-bold mb-0 mt-2">R$ 150,00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="p-3 border rounded-3 shadow-sm bg-white">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="fw-bold mb-1">Instalação Elétrica</h6>
                                            <p class="text-muted mb-1" style="font-size: 0.9rem;">Cliente: Maria Santos</p>
                                            <p class="text-muted mb-0" style="font-size: 0.9rem;">
                                                19/01/2024 &nbsp;
                                                <i class="bi bi-star-fill text-warning"></i> <strong>4</strong>
                                            </p>
                                        </div>
                                        <div class="text-end">
                                            <span class="badge px-3 py-2 rounded-pill bg-success text-white">Concluído</span>
                                            <p class="fw-bold mb-0 mt-2">R$ 280,00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="p-3 border rounded-3 shadow-sm bg-white">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="fw-bold mb-1">Limpeza Residencial</h6>
                                            <p class="text-muted mb-1" style="font-size: 0.9rem;">Cliente: Ana Costa</p>
                                            <p class="text-muted mb-0" style="font-size: 0.9rem;">24/01/2024</p>
                                        </div>
                                        <div class="text-end">
                                            <span class="badge px-3 py-2 rounded-pill bg-primary text-white">Em andamento</span>
                                            <p class="fw-bold mb-0 mt-2">R$ 120,00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <!-- Histórico para Cliente -->
                        <div class="row gy-4 mb-4">
                            <div class="col-12">
                                <div class="p-3 border rounded-3 shadow-sm bg-white">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="fw-bold mb-1">Reparo Encanamento</h6>
                                            <p class="text-muted mb-1" style="font-size: 0.9rem;">Prestador: João Silva</p>
                                            <p class="text-muted mb-0" style="font-size: 0.9rem;">
                                                14/01/2024 &nbsp;
                                                <i class="bi bi-star-fill text-warning"></i> <strong>5</strong>
                                            </p>
                                        </div>
                                        <div class="text-end">
                                            <span class="badge px-3 py-2 rounded-pill bg-success text-white">Concluído</span>
                                            <p class="fw-bold mb-0 mt-2">R$ 150,00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="p-3 border rounded-3 shadow-sm bg-white">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="fw-bold mb-1">Instalação Elétrica</h6>
                                            <p class="text-muted mb-1" style="font-size: 0.9rem;">Prestador: Maria Santos</p>
                                            <p class="text-muted mb-0" style="font-size: 0.9rem;">
                                                19/01/2024 &nbsp;
                                                <i class="bi bi-star-fill text-warning"></i> <strong>4</strong>
                                            </p>
                                        </div>
                                        <div class="text-end">
                                            <span class="badge px-3 py-2 rounded-pill bg-success text-white">Concluído</span>
                                            <p class="fw-bold mb-0 mt-2">R$ 280,00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="p-3 border rounded-3 shadow-sm bg-white">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="fw-bold mb-1">Limpeza Residencial</h6>
                                            <p class="text-muted mb-1" style="font-size: 0.9rem;">Prestador: Ana Costa</p>
                                            <p class="text-muted mb-0" style="font-size: 0.9rem;">24/01/2024</p>
                                        </div>
                                        <div class="text-end">
                                            <span class="badge px-3 py-2 rounded-pill bg-primary text-white">Em andamento</span>
                                            <p class="fw-bold mb-0 mt-2">R$ 150,00</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- ABA AVALIAÇÕES -->
            <div class="tab-pane fade" id="reviews">
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body">
                        <h5 class="fw-bold mb-4 mt-3">
                            {{ $isPrestador ? 'Avaliações do meu Serviço' : 'Avaliações em Serviços' }}
                        </h5>

                        <div class="row gy-4 mb-4">
                            @if($isPrestador)
                            <!-- Avaliações para Prestador -->
                            <div class="col-12">
                                <div class="p-3 border rounded-3 shadow-sm bg-white">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="fw-bold mb-1">João Silva</h6>
                                            <p class="text-muted mb-1" style="font-size: 0.9rem;">Reparo de Encanamento</p>
                                            <p class="mb-2 fst-italic" style="font-size: 0.9rem;">"Excelente profissional, pontual e muito competente!"</p>
                                            <p class="text-muted mb-0" style="font-size: 0.9rem;">14/01/2024</p>
                                        </div>
                                        <div class="text-end">
                                            <div class="mb-1">
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <strong>5</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="p-3 border rounded-3 shadow-sm bg-white">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="fw-bold mb-1">Maria Santos</h6>
                                            <p class="text-muted mb-1" style="font-size: 0.9rem;">Instalação Hidráulica</p>
                                            <p class="mb-2 fst-italic" style="font-size: 0.9rem;">"Ótimo trabalho, recomendo!"</p>
                                            <p class="text-muted mb-0" style="font-size: 0.9rem;">19/01/2024</p>
                                        </div>
                                        <div class="text-end">
                                            <div class="mb-1">
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star text-warning"></i>
                                                <strong>4</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                            <!-- Avaliações para Cliente -->
                            <div class="col-12">
                                <div class="p-3 border rounded-3 shadow-sm bg-white">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="fw-bold mb-1">João Silva</h6>
                                            <p class="text-muted mb-1" style="font-size: 0.9rem;">Reparo Encanamento</p>
                                            <p class="mb-2 fst-italic" style="font-size: 0.9rem;">"Excelente profissional, pontual e muito competente!"</p>
                                            <p class="text-muted mb-0" style="font-size: 0.9rem;">14/01/2024</p>
                                        </div>
                                        <div class="text-end">
                                            <div class="mb-1">
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <strong>5</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="p-3 border rounded-3 shadow-sm bg-white">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="fw-bold mb-1">Maria Santos</h6>
                                            <p class="text-muted mb-1" style="font-size: 0.9rem;">Instalação Elétrica</p>
                                            <p class="mb-2 fst-italic" style="font-size: 0.9rem;">"Ótimo trabalho, recomendo!"</p>
                                            <p class="text-muted mb-0" style="font-size: 0.9rem;">19/01/2024</p>
                                        </div>
                                        <div class="text-end">
                                            <div class="mb-1">
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star text-warning"></i>
                                                <strong>4</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            @if($isPrestador)
            <div class="tab-pane fade" id="portfolio">
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body">
                        <h5 class="fw-bold mb-4">Agenda de Horários</h5>

                        <form action="{{ route('prestador.agenda.update') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                @php
                                $dias = [
                                'Segunda-feira' => 'segunda',
                                'Terça-feira' => 'terca',
                                'Quarta-feira' => 'quarta',
                                'Quinta-feira' => 'quinta',
                                'Sexta-feira' => 'sexta',
                                'Sábado' => 'sabado',
                                'Domingo' => 'domingo'
                                ];
                                @endphp

                                @foreach($dias as $diaNome => $diaKey)
                                <div class="col-md-6 d-flex align-items-center justify-content-between bg-light p-3 rounded-3 shadow-sm">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="dias[{{ $diaKey }}][ativo]"
                                            {{ ($agenda[$diaKey]['ativo'] ?? false) ? 'checked' : '' }}>
                                        <label class="form-check-label fw-semibold">{{ $diaNome }}</label>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="time" class="form-control form-control-sm"
                                            name="dias[{{ $diaKey }}][inicio]"
                                            value="{{ $agenda[$diaKey]['inicio'] ?? '08:00' }}">
                                        <span class="fw-bold">-</span>
                                        <input type="time" class="form-control form-control-sm"
                                            name="dias[{{ $diaKey }}][fim]"
                                            value="{{ $agenda[$diaKey]['fim'] ?? '17:00' }}">
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <div class="text-end mt-4">
                                <button type="submit" class="btn btn-primary px-4 fw-semibold">
                                    <i class="bi bi-save me-2"></i>Salvar Agenda
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- SERVIÇOS OFERTADOS -->
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="fw-bold mb-0">Serviços Ofertados</h5>
                            <button type="button" class="btn btn-outline-primary fw-semibold" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                                <i class="bi bi-plus-circle me-1"></i> Adicionar Serviço
                            </button>
                        </div>

                        <div class="row gy-4">
                            <!-- Serviço 1 -->
                            <div class="col-md-6">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <h6 class="fw-bold mb-0">Limpeza Residencial</h6>
                                            <span class="badge bg-primary">Limpeza</span>
                                        </div>
                                        <p class="text-muted small mb-3">Limpeza completa da casa incluindo sala, cozinha, banheiros e quartos.</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="fw-bold text-primary">R$ 150,00</span>
                                            <div>
                                                <button class="btn btn-sm btn-outline-secondary me-1">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Serviço 2 -->
                            <div class="col-md-6">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <h6 class="fw-bold mb-0">Reparo de Encanamento</h6>
                                            <span class="badge bg-success">Encanamento</span>
                                        </div>
                                        <p class="text-muted small mb-3">Reparo e manutenção em sistemas hidráulicos residenciais.</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="fw-bold text-primary">R$ 200,00</span>
                                            <div>
                                                <button class="btn btn-sm btn-outline-secondary me-1">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal para Adicionar Serviço -->
@if($isPrestador)
<div class="modal fade" id="addServiceModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Adicionar Serviço</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nome do Serviço</label>
                    <input type="text" class="form-control" placeholder="Ex: Limpeza Residencial">
                </div>
                <div class="mb-3">
                    <label class="form-label">Descrição</label>
                    <textarea class="form-control" rows="3" placeholder="Descreva o serviço..."></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Categoria</label>
                    <select class="form-select">
                        <option selected>Selecione uma categoria</option>
                        <option value="1">Limpeza</option>
                        <option value="2">Encanamento</option>
                        <option value="3">Elétrica</option>
                        <option value="4">Pintura</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Valor (R$)</label>
                    <input type="number" class="form-control" placeholder="0,00">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Adicionar Serviço</button>
            </div>
        </div>
    </div>
</div>
@endif

<script>
    $isPrestador = mb_convert_encoding($isPrestador, 'UTF-8', 'auto');
    const editProfileModal = document.getElementById('editProfileModal');
    if (editProfileModal) {
        editProfileModal.addEventListener('show.bs.modal', function(event) {
            document.getElementById('editNome').value = document.getElementById('displayNome').value;
            document.getElementById('editEmail').value = document.getElementById('displayEmail').value;
            document.getElementById('editTelefone').value = document.getElementById('displayTelefone').value;
            document.getElementById('editLocalizacao').value = document.getElementById('displayLocalizacao').value;

            if (isPrestador) {
                document.getElementById('editDescricao').value = document.getElementById('displayDescricao').value;
            }
        });
    }

    document.querySelectorAll('#profileTabs .nav-link').forEach(tab => {
        tab.addEventListener('click', function() {
            document.querySelectorAll('#profileTabs .nav-link').forEach(t => t.classList.remove('active'));
            this.classList.add('active');
        });
    });
</script>

@endsection
