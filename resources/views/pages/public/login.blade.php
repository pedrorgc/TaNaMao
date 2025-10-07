<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar - TaNaMão</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
        }

        .login-wrapper {
            min-height: 100vh;
        }

        .login-box {
            max-width: 420px;
            width: 100%;
            border-radius: 12px;
        }

        .login-logo {
            height: 45px;
        }

        footer {
            position: absolute;
            bottom: 10px;
            width: 100%;
            text-align: center;
            font-size: 0.9rem;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container-fluid login-wrapper d-flex align-items-center justify-content-center">
        <div class="row w-100 d-flex justify-content-center align-items-center">

            <div class="col-lg-4 col-md-6 bg-white p-5 shadow-sm login-box mx-3">
                <div class="text-center mb-4">
                    <img src="{{ asset('assets/TANAMAO_AZUL.png') }}" alt="TaNaMão" class="login-logo mb-3">
                    <h2 class="fw-bold">Entrar</h2>
                    <p class="text-muted small">Acesse sua conta</p>
                </div>

                <form method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">E-mail ou Telefone</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                            <input type="text" id="email" name="email" class="form-control" placeholder="seu@email.com" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Senha</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-lock"></i></span>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Sua senha" required>
                            <span class="input-group-text bg-light"><i class="bi bi-eye"></i></span>
                        </div>
                    </div>

                    <!-- Lembrar e Esqueci -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label small" for="remember">Lembrar de mim</label>
                        </div>
                        <a href="#" class="small text-primary text-decoration-none">Esqueci a senha</a>
                    </div>

                    <x-button class="btn-primary w-100 py-2 mb-1" :fixed="false">
                        Entrar
                    </x-button>

                    <hr>

                    <x-button class="btn-google py-2 mb-3" :fixed="false">
                        <i class="bi bi-google"></i> Continuar com Google
                    </x-button>

                    <p class="text-center small mt-3">
                        Não tem uma conta? <a href="cadastro" class="text-primary text-decoration-none">Cadastre-se</a>
                    </p>
                </form>
            </div>

            <div class="col-lg-5 d-none d-lg-flex justify-content-center align-items-center">
                <img src="{{ asset('assets/TaNaMao-3D.png') }}" alt="TaNaMão" class="img-fluid" style="max-width: 420px;">
            </div>
        </div>
    </div>

    <footer>
        Copyright © {{ date('Y') }} TaNaMão. Todos os direitos reservados.
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
