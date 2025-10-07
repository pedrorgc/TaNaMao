@extends('layouts.app_no_nav')

@section('content')
    <div style="background-color: #EAEAEA; min-height: 100vh; padding-top: 100px;">

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

        <div class="container my-5">
            @include('components.card-pessoa',['sigla' => 'LF', 'nome' => 'Luiz Felipe', 'ocupacao' => 'Prestador', 'data' => 'Membro desde janeiro de 2024', 'status' => 'Status do perfil: Ativo'])

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
                <li class="nav-item mx-5">
                    <button class="nav-link rounded-5 px-5 py-2 fw-semibold" id="reviews-tab" data-bs-toggle="pill"
                        data-bs-target="#portfolio">Portfólio</button>
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
                                        <input type="text" class="form-control" id="displayNome" value="Maria Oliveira" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">E-mail</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                        <input type="email" class="form-control" id="displayEmail" value="maria.oliveira@email.com" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3 info-inputs"> 
                                <div class="col-md-6">
                                    <label class="form-label">Telefone</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                        <input type="text" class="form-control" id="displayTelefone" value="(99) 99999-9999" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Localização</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                                        <input type="text" class="form-control" id="displayLocalizacao" value="Almenara - MG" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="row info-inputs">
                                <div class="col-md-6">
                                    <label class="form-label">Descrição Profissional</label>
                                    <div class="input-group">
                                        <div class="mb-3">
                                            <textarea class="form-control" id="displayDescricao" value="Fale sobre a sua experiência " rows="4" cols="100" disabled></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Categoria</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="displayCategoria" value="Selecione" disabled>
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
                    <!-- Modal para Editar Perfil (adicionado aqui) -->
                            <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editProfileModalLabel">
                                                <i class="bi bi-pencil-square me-1"></i> Editar Informações Pessoais
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="editProfileForm">
                                                <div class="mb-3">
                                                    <label for="editNome" class="form-label">Nome Completo</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                                                        <input type="text" class="form-control" id="editNome" required>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editEmail" class="form-label">E-mail</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                                        <input type="email" class="form-control" id="editEmail" required>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editTelefone" class="form-label">Telefone</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                                        <input type="tel" class="form-control" id="editTelefone" required pattern="\([0-9]{2}\) [0-9]{5}-[0-9]{4}">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editLocalizacao" class="form-label">Localização</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                                                        <input type="text" class="form-control" id="editLocalizacao" required>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editTelefone" class="form-label">Descrição Profissional</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                                        <input type="text" class="form-control" id="editDescricao" required>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editLocalizacao" class="form-label">Categoria</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                                                        <input type="text" class="form-control" id="editCategoria" required>
                                                    </div>
                                                </div>
                                            </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="button" class="btn btn-primary" id="saveProfileBtn">Salvar Alterações</button>
                                    </div>
                                </div>
                            </div>
                        </div>
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

                            <h5 class="fw-bold mb-4 mt-3">Histórico de Serviços Contratados</h5>
                            <div class="row gy-4 mb-4">
                                <div class="col-12">
                                    @include('components.bloco-historic-concluido', ['servico' => 'Reparo de Encanamento', 'prestador' => 'João silva', 'valor' => '150,00', 'data' => '24/02/24', 'stars' => '5'])
                                </div>

                                <div class="col-12">
                                    @include('components.bloco-historic-concluido', ['servico' => 'Instalação Elétrica', 'prestador' => 'Maria Santos', 'valor' => '280,00', 'data' => '19/01/2024', 'stars' => '4'])
                                </div>

                                <div class="col-12">
                                    @include('components.bloco-historic-andamento', ['servico' => 'Limpeza Residencial', 'prestador' => 'Ana Costa', 'valor' => '280,00', 'data' => '24/01/2024'])
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body">
                            <h5 class="fw-bold mb-4 mt-3">Histórico de Serviços Prestados</h5>
                            <div class="row gy-4 mb-4">
                                <div class="col-12">
                                    @include('components.bloco-historic-concluido', ['servico' => 'Reparo de Encanamento', 'prestador' => 'Luiz Felipe', 'valor' => '150,00', 'data' => '24/02/24', 'stars' => '5'])
                                </div>

                                <div class="col-12">
                                     @include('components.bloco-historic-concluido', ['servico' => 'Instalação Elétrica', 'prestador' => 'Luiz Felipe', 'valor' => '280,00', 'data' => '19/01/2024', 'stars' => '4'])
                                </div>

                                <div class="col-12">
                                    @include('components.bloco-historic-andamento', ['servico' => 'Limpeza Residencial', 'prestador' => 'Luiz Felipe', 'valor' => '280,00', 'data' => '24/01/2024'])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="reviews">
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body">
                            <h5 class="fw-bold mb-4 mt-3">Minhas Avaliações</h5>

                            <div class="row gy-4 mb-4">
                                <div class="col-12">
                                    @include('components.bloco-avaliacao', ['nome' => 'João Silva', 'servico' => 'Reparo de Encanamento', 'avaliacao' => 'Excelente profissional, pontual e muito competente!',
                                    'data' => '14/01/24', 'stars' => '5'])
                                </div>

                                <div class="col-12">
                                    @include('components.bloco-avaliacao', ['nome' => 'João Silva', 'servico' => 'Reparo de Encanamento', 'avaliacao' => 'Excelente profissional, pontual e muito competente!',
                                    'data' => '14/01/24', 'stars' => '5'])
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body">
                            <h5 class="fw-bold mb-4 mt-3">Avaliações do meu Serviço</h5>

                            <div class="row gy-4 mb-4">
                                <div class="col-12">
                                    @include('components.bloco-avaliacao', ['nome' => 'João Silva', 'servico' => 'Reparo de Encanamento', 'avaliacao' => 'Excelente profissional, pontual e muito competente!',
                                    'data' => '14/01/24', 'stars' => '5'])
                                </div>

                                <div class="col-12">
                                    @include('components.bloco-avaliacao', ['nome' => 'Maria Santos', 'servico' => 'Instalação Hidraulica', 'avaliacao' => 'Ótimo trabalho, recomendo!',
                                    'data' => '19/01/24', 'stars' => '4'])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="portfolio">
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body">
                            <h5 class="fw-bold mb-4">Informações Pessoais</h5>

                            <div class="row mb-3 info-inputs">
                                <div class="col-md-6">
                                    <label class="form-label">Segunda a Sexta</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" Placeholder="08h - 18h">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">E-mail</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" Placeholder="09h - 15h" >
                                    </div>
                                </div>
                            </div>
                            @include('components.button', ['slot' => 'Salvar Agenda'])
                        </div>
                    </div>
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body align-items-center">
                            <h5 class="fw-bold mb-4 mt-3">Serviços Ofertados</h5>
                            <div class="text-end mt-4">
                                <button type="button" class="btn btn-outline-primary">
                                    <i class="bi bi-pencil-square me-1"></i> Adicionar Serviço
                                </button>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-6 mt-5">
                                @include('components.card-servico', ['servico' => 'Limpeza Residencial', 'tipo' => 'Limpeza completa da casa',
                                'categoria' => 'Limpeza', 'valor' => '150,00'])
                                </div>
                                <div class="col-md-6 mt-5">
                                @include('components.card-servico', ['servico' => 'Limpeza Residencial', 'tipo' => 'Limpeza completa da casa',
                                'categoria' => 'Limpeza', 'valor' => '150,00'])
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-6 mt-5">
                                @include('components.card-servico', ['servico' => 'Limpeza Residencial', 'tipo' => 'Limpeza completa da casa',
                                'categoria' => 'Limpeza', 'valor' => '150,00'])
                                </div>
                                <div class="col-md-6 mt-5">
                                @include('components.card-servico', ['servico' => 'Limpeza Residencial', 'tipo' => 'Limpeza completa da casa',
                                'categoria' => 'Limpeza', 'valor' => '150,00'])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

        const editProfileModal = document.getElementById('editProfileModal');
        editProfileModal.addEventListener('show.bs.modal', function (event) {
            const nome = document.getElementById('displayNome').value;
            const email = document.getElementById('displayEmail').value;
            const telefone = document.getElementById('displayTelefone').value;
            const localizacao = document.getElementById('displayLocalizacao').value;
            const categoria = document.getElementById('displayCategoria').value;
            const descricao = document.getElementById('displayDescricao').value;

            document.getElementById('editCategoria').value = categoria;
            document.getElementById('editDescricao').value = descricao;
            document.getElementById('editNome').value = nome;
            document.getElementById('editEmail').value = email;
            document.getElementById('editTelefone').value = telefone;
            document.getElementById('editLocalizacao').value = localizacao;
        });

        document.getElementById('saveProfileBtn').addEventListener('click', function () {
            const form = document.getElementById('editProfileForm');
            if (form.checkValidity()) {
                document.getElementById('displayNome').value = document.getElementById('editNome').value;
                document.getElementById('displayEmail').value = document.getElementById('editEmail').value;
                document.getElementById('displayTelefone').value = document.getElementById('editTelefone').value;
                document.getElementById('displayLocalizacao').value = document.getElementById('editLocalizacao').value;
                document.getElementById('displayCategoria').value = document.getElementById('editCategoria').value;
                document.getElementById('displayDescricao').value = document.getElementById('editDescricao').value;


                                const modal = bootstrap.Modal.getInstance(editProfileModal);
                modal.hide();
            } else {
                form.reportValidity();
            }
        });
    </script>
@endsection
