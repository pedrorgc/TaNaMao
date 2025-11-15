@extends('components.layouts.app')

@section('content')
    <!-- Reduzido padding-top de 100px para 80px e ajustado min-height -->
    <div style="background-color: #EAEAEA; min-height: calc(100vh - 60px); padding-top: 80px; padding-bottom: 40px;">

        <!-- Navbar superior azul -->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #1D4ED8;">
            <div class="container d-flex justify-content-between align-items-center">
                <a href="home" class="text-white text-decoration-none">
                    <i class="bi bi-arrow-left"></i> Voltar
                </a>

                <a class="navbar-brand text-white fw-bold" href="#">
                    <img src="{{ asset('assets/logo_TaNaMao.png') }}" alt="TaNaMão" height="40" class="me-2">
                </a>

                <a href="login" class="text-white text-decoration-none d-none d-md-inline">Sair</a>
            </div>
        </nav>

        <!-- Reduzido margin-top de my-5 para my-4 -->
        <div class="container my-4">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center me-3"
                            style="width: 70px; height: 70px; font-size: 1.5rem;">
                            MO
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold">Maria Oliveira</h5>
                            <p class="mb-1 text-muted">Cliente</p>
                            <small class="text-muted"><i class="bi bi-calendar"></i> Membro desde Janeiro 2024</small>
                        </div>
                    </div>
                </div>
            </div>

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
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="info">
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body">
                            <h5 class="fw-bold mb-4">Informações Pessoais</h5>

                            <div class="row mb-3 info-inputs">
                                <div class="col-md-6">
                                    <label class="form-label">Nome Completo</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                                        <input type="text" class="form-control" id="displayNome" value="Maria Oliveira" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">E-mail</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                        <input type="email" class="form-control" id="displayEmail" value="maria.oliveira@email.com" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row info-inputs">
                                <div class="col-md-6">
                                    <label class="form-label">Telefone</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                        <input type="text" class="form-control" id="displayTelefone" value="(99) 99999-9999" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Localização</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                                        <input type="text" class="form-control" id="displayLocalizacao" value="Almenara - MG" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end mt-4">
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                                    <i class="bi bi-pencil-square me-1"></i> Editar Perfil
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Configurações da Conta -->
                    <div class="bg-white shadow-sm rounded p-4 mt-4 mb-5">
                        <h5 class="fw-bold mb-3">Configurações da Conta</h5>

                        <div class="border-bottom py-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>Notificações por Email</strong>
                                    <p class="text-muted small mb-0">Receber notificações sobre serviços e atualizações</p>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" checked>
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
                                    <input class="form-check-input" type="checkbox" checked>
                                </div>
                            </div>
                        </div>

                        <div class="pt-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>Privacidade do Perfil</strong>
                                    <p class="text-muted small mb-0">Controlar a visibilidade das suas informações</p>
                                </div>
                                <button class="btn btn-outline-primary btn-sm">Gerenciar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="history">
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body">
                            <h5 class="fw-bold mb-4">Histórico de Serviços Contratados</h5>

                            <div class="row gy-4">
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
                                                <span class="badge px-3 py-2 rounded-pill"
                                                    style="background-color: #22c55e; color: #fff;">Concluído</span>
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
                                                <span class="badge px-3 py-2 rounded-pill"
                                                    style="background-color: #22c55e; color: #fff;">Concluído</span>
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
                                                <span class="badge px-3 py-2 rounded-pill"
                                                    style="background-color: #2563eb; color: #fff;">Em andamento</span>
                                                <p class="fw-bold mb-0 mt-2">R$ 150,00</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="reviews">
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body">
                            <h5 class="fw-bold mb-4">Avaliações em Serviços</h5>

                            <div class="row gy-4">
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
                                                    <strong>4</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('components.dialog-perfil')
@endsection
