<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escolha seu Perfil - TaNaMão</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
        }

        .container-pre-cadastro {
            max-width: 900px;
            padding-top: 60px;
            padding-bottom: 60px;
        }

        .logo-top {
            height: 60px;
            margin-bottom: 40px;
        }

        .title-section {
            color: #212529;
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 50px;
        }

        .profile-card {
            background: white;
            border-radius: 16px;
            padding: 40px 30px;
            text-align: center;
            transition: all 0.3s ease;
            border: 2px solid #e9ecef;
            cursor: pointer;
            height: 100%;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .profile-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 24px rgba(29, 78, 216, 0.15);
            border-color: #1D4ED8;
        }

        .profile-icon {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            font-size: 3rem;
            background-color: #1D4ED8;
            color: white;
        }

        .profile-title {
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 15px;
            color: #212529;
        }

        .profile-description {
            color: #6c757d;
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 30px;
            min-height: 75px;
        }

        .btn-select {
            background-color: #1D4ED8;
            border: none;
            color: white;
            padding: 12px 35px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .btn-select:hover {
            background-color: #1e40af;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(29, 78, 216, 0.3);
        }

        footer {
            position: fixed;
            bottom: 20px;
            width: 100%;
            text-align: center;
            color: #6c757d;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .title-section {
                font-size: 1.5rem;
                margin-bottom: 30px;
            }

            .profile-card {
                padding: 30px 20px;
                margin-bottom: 20px;
            }

            .profile-icon {
                width: 80px;
                height: 80px;
                font-size: 2.5rem;
            }

            .profile-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container container-pre-cadastro">
        <div class="text-center">
            <img src="assets/TANAMAO_AZUL.png" alt="TaNaMão" class="logo-top">
            <h1 class="title-section">Como deseja usar o TaNaMão?</h1>
        </div>

        <div class="row g-4">
            <!-- Card Cliente -->
            <div class="col-md-6">
                <div class="profile-card" onclick="selecionarPerfil('cliente')">
                    <div class="profile-icon">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <h2 class="profile-title">Cliente</h2>
                    <p class="profile-description">
                        Encontre profissionais qualificados para realizar serviços que você precisa. 
                        Contrate com segurança e praticidade.
                    </p>
                    <button class="btn btn-select w-100" onclick="event.stopPropagation(); irParaCadastro('cliente')">
                        Continuar como Cliente
                    </button>
                </div>
            </div>

            <!-- Card Prestador -->
            <div class="col-md-6">
                <div class="profile-card" onclick="selecionarPerfil('prestador')">
                    <div class="profile-icon">
                        <i class="bi bi-briefcase-fill"></i>
                    </div>
                    <h2 class="profile-title">Prestador</h2>
                    <p class="profile-description">
                        Ofereça seus serviços e encontre novos clientes. 
                        Gerencie sua agenda e aumente seus ganhos.
                    </p>
                    <button class="btn btn-select w-100" onclick="event.stopPropagation(); irParaCadastro('prestador')">
                        Continuar como Prestador
                    </button>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <p class="text-muted">
                Já tem uma conta? <a href="login" class="text-decoration-none fw-semibold" style="color: #1D4ED8;">Entrar</a>
            </p>
        </div>
    </div>

    <footer>
        Copyright © 2024 TaNaMão. Todos os direitos reservados.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function selecionarPerfil(tipo) {
            // Adiciona feedback visual ao clicar no card
            const cards = document.querySelectorAll('.profile-card');
            cards.forEach(card => card.style.borderColor = '#e9ecef');
            event.currentTarget.style.borderColor = '#1D4ED8';
        }

        function irParaCadastro(tipo) {
            // Redireciona para a página de cadastro com o tipo selecionado
            if (tipo === 'cliente') {
                window.location.href = 'cadastro?tipo=cliente';
            } else if (tipo === 'prestador') {
                window.location.href = 'cadastro?tipo=prestador';
            }
        }
    </script>
</body>
</html>