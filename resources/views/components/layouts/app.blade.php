<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TaNaMão')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css">

    <style>
        .toast-message {
            transition: all 0.3s ease-in-out !important;
            align-items: center !important;
        }

        .toast-message * {
            box-sizing: border-box;
        }

        /* Garantir que todos os ícones MDI tenham o mesmo tamanho base */
        .mdi {
            display: inline-block;
            font-size: inherit;
            line-height: 1;
        }
    </style>
    <!-- AlpineJS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="d-flex flex-column min-vh-100" style="overflow-x: hidden; padding-top: 50px;">

    <!-- Navbar -->
    @include('components.navbar')

    <div class="container">
        <!-- Conteúdo principal -->
        <main class="flex-fill container">
            <!-- Conteúdo da página -->
            @yield('content')
        </main>
    </div>

    <!-- Footer -->
    @include('components.footer')

    <div class="toast-container">
        <x-flash-success />
        <x-form-errors />
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
