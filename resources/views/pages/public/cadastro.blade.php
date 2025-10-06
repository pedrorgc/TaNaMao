<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta - TaNaMao</title>

    @vite(['resources/scss/app.scss', 'resources/js/dialog.js'])
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    @include('layouts.styles.dialog')
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
        <div class="auth-header">
            <img src="{{ asset('Imagem/logo.png') }}" alt="Logo TaNaMao" class="logo">
            <h1>Criar Conta</h1>
            <p>Escolha o tipo de conta</p>
        </div>

            @include('components.auth-header')
            @include('components.tab-switcher')
            @include('components.auth-form')
            @include('components.auth-footer')

        </div>
    </div>

    @include('components.dialog-endereco')
</body>
</html>
