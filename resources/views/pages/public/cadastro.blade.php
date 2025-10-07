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
                @include('components.auth-header')
                @include('components.tab-switcher')
                @include('components.auth-form')
                @include('components.auth-footer')
            </div>
        </div>
    </div>

    @include('components.dialog-endereco')
</body>
</html>
