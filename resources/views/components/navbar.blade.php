<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #1D4ED8; min-height: 70px;">
    <div class="container">
        <!-- Logo maior e mais à esquerda -->
        <a class="navbar-brand d-flex align-items-center" href="home" style="margin-right: auto;">
            <img src="{{ asset('assets/logo_TaNaMao.png') }}" alt="TaNaMao" height="55" class="me-2">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item mx-3">
                    <a class="nav-link" href="#como-funciona" style="font-size: 1.1rem;">Como Funciona</a>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link" href="#sobre" style="font-size: 1.1rem;">Sobre</a>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link d-flex align-items-center" href="login" style="font-size: 1.1rem;">
                        <i class="bi bi-person-fill me-2 fs-5"></i> Entrar
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
