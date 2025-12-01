@extends('components.layouts.app')

@section('title', 'Painel ADM')

@section('content')

<div class="container my-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="m-0">Painel ADM - Gerenciar Usuários</h3>
    <div>
      @include('components.button', ['slot' => 'Sair', 'class' => 'btn-outline-light', 'href' => route('logout')])
    </div>
  </div>

  <div class="bg-body-secondary p-4 rounded-3">
    <div class="row mb-3">
      <div class="col-12">
        <div class="d-flex gap-3 flex-wrap">
          <x-metric-card title="Total de Usuários" value="{{ $metricas['total_usuarios'] }}" />
          <x-metric-card title="Prestadores Ativos" value="{{ $metricas['prestadores_ativos'] }}" />
          <x-metric-card title="Categorias" value="{{ $totalCategorias }}" />
          <x-metric-card title="Receita Mensal" value="{{ $metricas['receita_mensal'] }}" />
        </div>
      </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
      <div class="admin-tabs-wrap">
        <ul class="nav" id="adminTabs" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link admin-pill active" id="users-tab" data-bs-toggle="tab" data-bs-target="#users" type="button" role="tab">Gerenciar Usuários</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link admin-pill" id="providers-tab" data-bs-toggle="tab" data-bs-target="#providers" type="button" role="tab">Gerenciar Prestadores</button>
          </li>
        </ul>
      </div>
      <a href="{{ route('servicos.dashboard') }}" class="btn btn-primary">
        <i class="bi bi-briefcase-fill me-2"></i>Ver Dashboard de Serviços
      </a>
    </div>

    <div class="admin-tabs-wrap d-none">
      <ul class="nav" id="adminTabs" role="tablist">

      <style>
        .admin-tabs-wrap{
          background: #f1f3f5;
          padding: 8px;
          border-radius: 999px;
        }
        .admin-tabs-wrap .nav{
          display:flex;
          gap:12px;
          justify-content:space-between;
          align-items:center;
          width:100%;
        }
        .admin-tabs-wrap .nav .nav-item{
          flex: 1 1 0;
          display:flex;
          justify-content:center;
        }
        .admin-pill{
          background: transparent;
          border: 0;
          color: #6c757d;
          padding: 8px 12px;
          border-radius: 999px;
          box-shadow: none;
          transition: all .12s ease-in-out;
          font-weight: 600;
          width: 100%;
          max-width: 100%;
          text-align: center;
        }
        .admin-pill.active{
          background: #ffffff;
          color: #212529;
          box-shadow: 0 6px 18px rgba(16,24,40,0.08);
        }
        .admin-pill:focus{
          outline: none;
          box-shadow: 0 6px 18px rgba(16,24,40,0.08);
        }
        .admin-pill:hover{
          transform: translateY(-2px);
        }
        @media (max-width: 767px){
          .admin-pill{min-width:120px;padding:6px 14px;font-size:14px}
        }
      </style>
    </div>

    <div class="tab-content" id="adminTabsContent">
      <!-- Gerenciar Usuários -->
      <div class="tab-pane fade show active" id="users" role="tabpanel" aria-labelledby="users-tab">

        <div class="table-responsive rounded-3 bg-white shadow-sm p-3">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Usuários Recentes</h5>
            <div class="d-flex align-items-center gap-2">
              <input
                class="form-control"
                placeholder="Buscar usuários"
                id="userSearch"
                style="min-width:200px; max-width:250px;"
              >
            </div>
          </div>

          <table class="table table-borderless mb-0 align-middle">
            <thead>
              <tr>
                <th>Usuário</th>
                <th>Tipo</th>
                <th>Email</th>
                <th>Data de Cadastro</th>
                <th>Status</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              @forelse($usuarios as $user)
                <tr>
                  <td>
                    <div class="d-flex align-items-center gap-2">
                      <div class="avatar rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; font-weight: bold;">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                      </div>
                      <span>{{ $user->name }}</span>
                    </div>
                  </td>
                  <td>
                    <span class="badge bg-info">
                      {{ $user->role->name ?? 'N/A' }}
                    </span>
                  </td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->created_at->format('d/m/Y') }}</td>
                  <td>
                    <span class="badge bg-success">Ativo</span>
                  </td>
                  <td>
                    <div class="d-flex gap-2">
                      <button class="btn btn-sm btn-outline-secondary" title="Visualizar">
                        <i class="bi bi-eye"></i>
                      </button>
                      <button class="btn btn-sm btn-outline-secondary" title="Editar">
                        <i class="bi bi-pencil"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="text-center text-muted py-4">
                    Nenhum usuário cadastrado
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

      <!-- Gerenciar Prestadores -->
      <div class="tab-pane fade" id="providers" role="tabpanel" aria-labelledby="providers-tab">

        <div class="table-responsive rounded-3 bg-white shadow-sm p-3">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Prestadores Recentes</h5>
            <div class="d-flex align-items-center">
              <input
                class="form-control"
                placeholder="Buscar prestadores"
                id="providerSearch"
                style="min-width:200px; max-width:250px;"
              >
            </div>
          </div>

          <table class="table table-borderless mb-0 align-middle">
            <thead>
              <tr>
                <th>Prestador</th>
                <th>Categoria</th>
                <th>Telefone</th>
                <th>Cidade</th>
                <th>Data de Cadastro</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              @forelse($prestadores as $prestador)
                <tr>
                  <td>
                    <div class="d-flex align-items-center gap-2">
                      <div class="avatar rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; font-weight: bold;">
                        {{ strtoupper(substr($prestador->user->name, 0, 1)) }}
                      </div>
                      <div>
                        <strong>{{ $prestador->user->name }}</strong><br>
                        <small class="text-muted">{{ $prestador->user->email }}</small>
                      </div>
                    </div>
                  </td>
                  <td>
                    <span class="badge bg-warning">
                      {{ $prestador->categoria->nome ?? 'Não definida' }}
                    </span>
                  </td>
                  <td>{{ $prestador->telefone }}</td>
                  <td>
                    {{ $prestador->endereco->cidade ?? 'N/A' }},
                    {{ $prestador->endereco->estado ?? 'N/A' }}
                  </td>
                  <td>{{ $prestador->created_at->format('d/m/Y') }}</td>
                  <td>
                    <div class="d-flex gap-2">
                      <button class="btn btn-sm btn-outline-secondary" title="Visualizar">
                        <i class="bi bi-eye"></i>
                      </button>
                      <button class="btn btn-sm btn-outline-secondary" title="Editar">
                        <i class="bi bi-pencil"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="text-center text-muted py-4">
                    Nenhum prestador cadastrado
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</div>

<script>
  // Busca em tempo real para usuários
  document.getElementById('userSearch').addEventListener('keyup', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const rows = document.querySelectorAll('#users tbody tr');

    rows.forEach(row => {
      const text = row.textContent.toLowerCase();
      row.style.display = text.includes(searchTerm) ? '' : 'none';
    });
  });

  // Busca em tempo real para prestadores
  document.getElementById('providerSearch').addEventListener('keyup', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const rows = document.querySelectorAll('#providers tbody tr');

    rows.forEach(row => {
      const text = row.textContent.toLowerCase();
      row.style.display = text.includes(searchTerm) ? '' : 'none';
    });
  });
</script>

@endsection
