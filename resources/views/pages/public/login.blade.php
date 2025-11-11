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

        /* Botão Google moderno */
        .btn-google {
            background-color: #ffffff;
            border: 1px solid #dadce0;
            color: #3c4043;
            font-weight: 500;
            font-size: 14px;
            padding: 10px 12px;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            transition: all 0.15s ease-in-out;
            box-shadow: 0 1px 2px 0 rgba(60, 64, 67, 0.3), 0 1px 3px 1px rgba(60, 64, 67, 0.15);
        }

        .btn-google:hover {
            background-color: #f8f9fa;
            border-color: #d2e3fc;
            box-shadow: 0 1px 3px 0 rgba(60, 64, 67, 0.3), 0 4px 8px 3px rgba(60, 64, 67, 0.15);
        }

        .btn-google:active {
            background-color: #ecf3fe;
            border-color: #d2e3fc;
        }

        .google-icon {
            width: 18px;
            height: 18px;
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
                    <img src="assets/TANAMAO_AZUL.png" alt="TaNaMão" class="login-logo mb-3">
                    <h2 class="fw-bold">Entrar</h2>
                    <p class="text-muted small">Acesse sua conta</p>
                </div>

                <form method="POST">
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

                    <button type="submit" class="btn btn-primary w-100 py-2 mb-3">
                        Entrar
                    </button>

                    <div class="text-center text-muted small mb-3" style="position: relative;">
                        <span style="background: white; padding: 0 10px; position: relative; z-index: 1;">ou</span>
                        <hr style="position: absolute; top: 50%; left: 0; right: 0; margin: 0; z-index: 0;">
                    </div>

                    <!-- Botão Google Moderno -->
                    <button type="button" class="btn btn-google w-100 mb-3">
                        <svg class="google-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                        </svg>
                        <span>Continuar com Google</span>
                    </button>

                    <p class="text-center small mt-3">
                        Não tem uma conta? <a href="cadastro" class="text-primary text-decoration-none fw-semibold">Cadastre-se</a>
                    </p>
                </form>
            </div>

            <div class="col-lg-5 d-none d-lg-flex justify-content-center align-items-center">
                <img src="assets/TaNaMao-3D.png" alt="TaNaMão" class="img-fluid" style="max-width: 420px;">
            </div>
        </div>
    </div>

    <footer>
        Copyright © 2024 TaNaMão. Todos os direitos reservados.
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>