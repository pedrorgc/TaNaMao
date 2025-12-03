<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TaNaMão')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
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

        .mdi {
            display: inline-block;
            font-size: inherit;
            line-height: 1;
        }

        html {
            scroll-padding-top: 120px;
        }

        body {
            padding-top: 70px !important;
        }

        @media (max-width: 768px) {
            html {
                scroll-padding-top: 100px;
            }

            body {
                padding-top: 60px !important;
            }
        }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="d-flex flex-column min-vh-100" style="overflow-x: hidden;">

    @include('components.navbar')


    <main class="flex-fill">
        @yield('content')
    </main>

    @include('components.footer')

    <div class="toast-container">
        <x-flash-success />
        <x-form-errors />
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>