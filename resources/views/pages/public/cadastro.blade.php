<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta - TaNaMao</title>

    @vite(['resources/scss/app.scss', 'resources/js/dialog.js'])
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

</head>
<body>
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="row w-100 justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="auth-header">
    
    <img src="{{ asset('assets/TaNaMao-3D.png') }}" class="logo" alt="TaNaMao">
    <h1>Criar Conta</h1>
    <p>Escolha o tipo de conta</p>
</div>
<div class="tab-switcher">
    <button class="tab-button active" data-tab-button="cliente">Cliente</button>
    <button class="tab-button" data-tab-button="prestador">Prestador</button>
</div>

                @include('components.auth-form')
                <div class="auth-footer">
    <p>Já tem uma conta? <a href="login">Entrar</a></p>
</div>
            </div>
        </div>
    </div>

    @include('components.dialog-endereco')
</body>
</html>
