<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Meu Projeto Laravel')</title>
    <!-- Aqui você pode adicionar CSS/JS -->
</head>
<body>
    <header>
        <nav>
            <a href="{{ url('/') }}">Dashboard</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    @include('components.footer')
</body>
</html>
