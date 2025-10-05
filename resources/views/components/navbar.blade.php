<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #1D4ED8;">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('assets/logo_TaNaMao.png') }}" alt="TaNaMao" height="40" class="me-2">
        </a>

        <!-- Menu Hamburger -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item mx-3">
                    <a class="nav-link" href="#como-funciona">Como Funciona</a>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link" href="#sobre">Sobre</a>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link d-flex align-items-center" href="login">
                        <i class="bi bi-person-fill me-2 fs-5"></i> Entrar
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
