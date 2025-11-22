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
                @auth
                @php
                $user = auth()->user();
                $role_id = $user->role_id;
                @endphp

                <li class="nav-item dropdown mx-3">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 1.1rem;">
                        <i class="bi bi-person-circle me-2 fs-5"></i>
                        {{ $user->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        @if ($role_id === 1)
                        <li><a class="dropdown-item" href="{{ url('/admin') }}">Painel Administrativo</a></li>
                        @elseif ($role_id === 2)
                        <li><a class="dropdown-item" href="{{ url('/profile') }}">Meu Perfil de Prestador</a></li>
                        <li><a class="dropdown-item" href="{{ url('/servicos/create') }}">Cadastrar Serviço</a></li>
                        @elseif ($role_id === 3)
                        <li><a class="dropdown-item" href="{{ url('/profile') }}">Meu Perfil</a></li>
                        @else
                        <li><a class="dropdown-item" href="{{ url('/profile') }}">Completar Cadastro</a></li>
                        @endif

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">Sair</button>
                            </form>
                        </li>
                    </ul>
                </li>
                @else
                  <li class="nav-item mx-3">
                        <a class="nav-link d-flex align-items-center" href="{{ route('login') }}" style="font-size: 1.1rem;">
                            <i class="bi bi-person-fill me-2 fs-5"></i> Entrar
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
