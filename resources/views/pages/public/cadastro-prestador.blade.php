<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro - Prestador de Serviço</title>

    @vite(['resources/scss/app.scss', 'resources/js/dialog.js'])
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="{{ asset('js/localidades.js') }}"></script>

    <style>
        .logo {
            width: 150px;
            height: auto;
        }

        /* ====== LAYOUT GERAL ====== */
        body {
            background-color: #f8f9fb;
            font-family: "Inter", sans-serif;
        }

        .auth-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .auth-body {
            background: #fff;
            padding: 2.5rem;
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        /* ====== TÍTULOS ====== */
        .auth-body h1 {
            text-align: center;
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 0.3rem;
        }

        .auth-body p {
            text-align: center;
            color: #6c757d;
            font-size: 0.95rem;
            margin-bottom: 2rem;
        }

        /* ====== CAMPOS ====== */
        .form-label {
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 0.3rem;
        }

        .input-group {
            position: relative;
            margin-bottom: 1.25rem;
            /* espaçamento entre campos */
        }

        .input-group i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #adb5bd;
            font-size: 1.1rem;
            pointer-events: none;
        }

        .input-group .form-control,
        .input-group select {
            width: 100%;
            padding: 0.85rem 0.75rem 0.85rem 2.5rem;
            border: 1px solid #dee2e6;
            border-radius: 0.6rem;
            font-size: 0.95rem;
            transition: border-color 0.2s, box-shadow 0.2s;
            background-color: #fff;
        }

        .input-group .form-control:focus,
        .input-group select:focus {
            border-color: #6c63ff;
            box-shadow: 0 0 0 2px rgba(108, 99, 255, 0.1);
            outline: none;
        }

        /* ====== SEÇÃO DE ENDEREÇO ====== */
        .section-divider {
            margin: 2.5rem 0 1.5rem;
            border-top: 2px solid #e9ecef;
            position: relative;
        }

        .section-title {
            background: #fff;
            padding: 0 1rem;
            position: absolute;
            top: -13px;
            left: 50%;
            transform: translateX(-50%);
            font-weight: 600;
            color: #495057;
            font-size: 0.85rem;
        }

        /* ====== CAMPOS EM LINHA ====== */
        .row-field {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.25rem;
        }

        .row-field>div {
            flex: 1;
        }

        /* ====== BOTÃO ====== */
        .btn-primary {
            width: 100%;
            background-color: #6c63ff;
            border: none;
            border-radius: 0.6rem;
            padding: 0.9rem;
            font-size: 1rem;
            font-weight: 600;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .btn-primary:hover {
            background-color: #5a52e0;
        }

        /* ====== RESPONSIVIDADE ====== */
        @media (max-width: 768px) {
            .auth-body {
                padding: 2rem 1.5rem;
            }

            .row-field {
                flex-direction: column;
                gap: 0.75rem;
            }
        }
    </style>

</head>

<body>
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="row w-100 justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="auth-header">
                    <img src="{{ asset('assets/TaNaMao-3D.png') }}" class="logo" alt="TaNaMao">
                </div>
                <div class="auth-body">
                    <h1>Cadastro - Prestador de Serviço</h1>
                    <p>Preencha os dados abaixo para criar sua conta</p>
                    <form method="POST" action="{{ route('prestadores.store') }}">
                        @csrf
                        <!-- Dados Pessoais/Empresariais -->
                        @include('components.input-field', ['label' => 'Nome Completo / Razão Social', 'icon' => 'ph-user', 'type' => 'text', 'id' => 'nome', 'placeholder' => 'Seu nome ou nome da empresa', 'name' => 'name'])

                        @include('components.input-field', ['label' => 'E-mail', 'icon' => 'ph-envelope-simple', 'type' => 'email', 'id' => 'email', 'placeholder' => 'seu@email.com', 'name' => 'email'])

                        @include('components.input-field', ['label' => 'CPF/CNPJ', 'icon' => 'ph-identification-card', 'type' => 'text', 'id' => 'documento', 'placeholder' => 'CPF ou CNPJ', 'name' => 'documento'])

                        @include('components.input-field', ['label' => 'Telefone', 'icon' => 'ph-phone', 'type' => 'tel', 'id' => 'telefone', 'placeholder' => '(99) 99999-9999', 'name' => 'telefone'])

                        <div class="mb-3">
                            <label for="categoria" class="form-label">Categoria de Serviço</label>
                            <div class="input-group">
                                <i class="ph ph-briefcase"></i>
                                <select class="form-control form-select" id="categoria" required name="categoria_id">
                                    <option value="">Selecione uma categoria</option>
                                    @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        @include('components.input-field', ['label' => 'Senha', 'icon' => 'ph-lock', 'type' => 'password', 'id' => 'senha', 'placeholder' => 'Mínimo 8 caracteres', 'name' => 'password'])

                        @include('components.input-field', ['label' => 'Confirmar Senha', 'icon' => 'ph-lock', 'type' => 'password', 'id' => 'confirmar-senha', 'placeholder' => 'Confirme sua senha', 'name' => 'password_confirmation'])

                        <div class="section-divider">
                            <span class="section-title">ENDEREÇO</span>
                        </div>
                        <div class="row-field mb-1">

                            <div class="col-small">
                                <label for="estado" class="form-label">Estado</label>
                                <div class="input-group">
                                    <i class="ph ph-map-trifold"></i>
                                    <select class="form-control" id="estado" name="estado">
                                        <option value="">Selecione o estado</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-small">
                                <div class="input-group">
                                    <i class="ph ph-buildings"></i>
                                    <label for="cidade" class="form-label">Cidade</label>
                                    <select class="form-control" id="cidade" name="cidade">
                                        <option value="">Selecione o estado primeiro</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        @include('components.input-field', ['label' => 'CEP', 'icon' => 'ph-map-pin', 'type' => 'text', 'id' => 'cep', 'placeholder' => '00000-000', 'name' => 'cep'])

                        <div class="row-field mb-3">
                            <div class="col-large">
                                <label for="rua" class="form-label">Rua</label>
                                <div class="input-group">
                                    <i class="ph ph-road-horizon"></i>
                                    <input type="text" class="form-control" id="rua" placeholder="Nome da rua" name="logradouro">
                                </div>
                            </div>
                            <div class="col-small">
                                <label for="numero" class="form-label">Número</label>
                                <div class="input-group">
                                    <i class="ph ph-hash"></i>
                                    <input type="text" class="form-control" id="numero" placeholder="123" name="numero">
                                </div>
                            </div>
                        </div>

                        @include('components.input-field', ['label' => 'Complemento', 'icon' => 'ph-info', 'type' => 'text', 'id' => 'complemento', 'placeholder' => 'Sala, andar, etc (opcional)', 'name' => 'complemento'])

                        @include('components.input-field', ['label' => 'Bairro', 'icon' => 'ph-buildings', 'type' => 'text', 'id' => 'bairro', 'placeholder' => 'Nome do bairro', 'name' => 'bairro'])



                        <button type="submit" class="btn btn-primary w-100 mt-5">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/formats.js') }}" defer></script>
</body>

</html>
