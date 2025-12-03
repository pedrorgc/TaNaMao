<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #1D4ED8; min-height: 70px;">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="home" style="margin-right: auto;">
            <img src="{{ asset('assets/logo_TaNaMao.png') }}" alt="TaNaMao" height="55" class="me-2">
        </a>

        <div class="d-none d-lg-flex mx-auto" style="max-width: 500px; width: 100%;">
            <form class="w-100" action="/servicos" method="GET">
                <div class="input-group search-container">
                    <div class="position-relative flex-grow-1">
                        <input type="text"
                            name="search"
                            class="form-control"
                            placeholder="Buscar serviço, categoria ou prestador..."
                            value="{{ request('search') }}"
                            id="searchInputNav"
                            autocomplete="off"
                            aria-label="Buscar serviços"
                            style="border-radius: 25px 0 0 25px;">
                        <div class="autocomplete-suggestions" id="searchSuggestionsNav" style="display: none;"></div>
                    </div>

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
                    <a class="nav-link" href="/sobre" style="font-size: 1.1rem;">Sobre</a>
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
                        <li><a class="dropdown-item" href="{{ url('/profile') }}">Meu Perfil </a></li>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInputNav = document.getElementById('searchInputNav');
        const suggestionsNav = document.getElementById('searchSuggestionsNav');

        if (searchInputNav) {
            searchInputNav.addEventListener('input', function(e) {
                const query = e.target.value;

                if (query.length < 2) {
                    suggestionsNav.style.display = 'none';
                    return;
                }

                fetch(`/api/buscar-sugestoes?q=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length > 0) {
                            suggestionsNav.innerHTML = data.map(item =>
                                `<div class="suggestion-item">${item.nome}</div>`
                            ).join('');
                            suggestionsNav.style.display = 'block';
                        } else {
                            suggestionsNav.style.display = 'none';
                        }
                    })
                    .catch(error => {
                        console.error('Erro ao buscar sugestões:', error);
                        suggestionsNav.style.display = 'none';
                    });
            });

            document.addEventListener('click', function(e) {
                if (!searchInputNav.contains(e.target) && !suggestionsNav.contains(e.target)) {
                    suggestionsNav.style.display = 'none';
                }
            });

            suggestionsNav.addEventListener('click', function(e) {
                if (e.target.classList.contains('suggestion-item')) {
                    searchInputNav.value = e.target.textContent;
                    suggestionsNav.style.display = 'none';
                }
            });
        }
    });
</script>