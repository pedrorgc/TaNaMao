<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #1D4ED8; min-height: 70px;">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="home" style="margin-right: auto;">
            <img src="{{ asset('assets/logo_TaNaMao.png') }}" alt="TaNaMao" height="55" class="me-2">
        </a>

        <div class="d-none d-lg-flex mx-auto" style="max-width: 500px; width: 100%;">
            <form class="w-100" action="#" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Buscar serviços..." 
                           aria-label="Buscar" style="border-radius: 25px 0 0 25px;">
                    <button class="btn btn-light" type="submit" 
                            style="border-radius: 0 25px 25px 0;">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="d-lg-none mb-3 mt-2">
                <form action="#" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Buscar serviços..." 
                               aria-label="Buscar">
                        <button class="btn btn-light" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>

            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item mx-3">
                    <a class="nav-link" href="/servicos" style="font-size: 1.1rem;">Serviços</a>
                </li>
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
                $primeiroNome = explode(' ', $user->name)[0];
                @endphp

                <li class="nav-item dropdown mx-3">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 1.1rem;">
                        <i class="bi bi-person-circle me-2 fs-5"></i>
                        {{ $primeiroNome }}
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