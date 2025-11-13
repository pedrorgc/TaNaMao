@extends('components.layouts.app')

@section('title', 'Painel ADM')

@section('content')

<div class="container my-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="m-0">Painel ADM - gerenciar usuários</h3>
    <div>
      @include('components.button', ['slot' => 'Sair', 'class' => 'btn-outline-light'])
    </div>
  </div>

  <div class="bg-body-secondary p-4 rounded-3">
    <div class="row mb-3">
      <div class="col-12">
        <div class="d-flex gap-3">
          <x-metric-card title="Total de Usuários" value="0.000" />
          <x-metric-card title="Prestadores Ativos" value="0.000" />
          <x-metric-card title="Serviços ativos" value="00" />
          <x-metric-card title="Receita Mensal" value="R$ 00.000" />
        </div>
      </div>
    </div>

    <div class="admin-tabs-wrap mb-4">
      <ul class="nav" id="adminTabs" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link admin-pill active" id="users-tab" data-bs-toggle="tab" data-bs-target="#users" type="button" role="tab">Gerenciar Usuários</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link admin-pill" id="providers-tab" data-bs-toggle="tab" data-bs-target="#providers" type="button" role="tab">Gerenciar Prestadores</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link admin-pill" id="services-tab" data-bs-toggle="tab" data-bs-target="#services" type="button" role="tab">Gerenciar Serviços</button>
        </li>
      </ul>

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
            <h5 class="mb-0">Usuários recentes</h5>
            <div class="d-flex align-items-center gap-2">
              <input
                class="form-control"
                placeholder="Buscar usuários"
                style="min-width:200px; max-width:250px;"
              >
              <button
                class="btn btn-primary"
                style="white-space: nowrap; height: 38px; padding: 0 16px;"
              >
                Adicionar usuário
              </button>
            </div>
          </div>

          <table class="table table-borderless mb-0 align-middle">
            <thead>
              <tr>
                <th>Usuário</th>
                <th>Tipo</th>
                <th>Data de cadastro</th>
                <th>Status</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <x-avatar-cell name="Maria Oliveira" email="maria@email.com" src="https://i.pravatar.cc/150?u=maria@example.com" bg="bg-primary" />
                </td>
                <td>Cliente</td>
                <td>24/01/2024</td>
                <td><span class="badge bg-success">Ativo</span></td>
                <td>
                  <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></button>
                    <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                  </div>
                </td>
              </tr>

              <tr>
                <td>
                  <x-avatar-cell name="João Silva" email="joao@email.com" src="https://www.petz.com.br/blog/wp-content/uploads/2022/06/lagarto-troca-de-pele-3.jpg" bg="bg-secondary" />
                </td>
                <td>Prestador</td>
                <td>23/01/2024</td>
                <td><span class="badge bg-warning text-dark">Pendente</span></td>
                <td>
                  <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></button>
                    <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                  </div>
                </td>
              </tr>

              <tr>
                <td>
                  <x-avatar-cell name="José Felipe" email="jose@email.com" bg="bg-primary" />
                </td>
                <td>Cliente</td>
                <td>22/01/2024</td>
                <td><span class="badge bg-success">Ativo</span></td>
                <td>
                  <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></button>
                    <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                  </div>
                </td>
              </tr>
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
                style="min-width:200px; max-width:250px;"
              >
              <button
                class="btn btn-primary"
                style="white-space: nowrap; height: 38px; padding: 0 16px; margin-left:8px;"
              >
                Verificar Prestador
              </button>
            </div>
          </div>
          <table class="table table-borderless mb-0 align-middle">
            <thead>
              <tr>
                <th>Prestador</th>
                <th>Categoria</th>
                <th>Avaliação</th>
                <th>Trabalhos</th>
                <th>Status</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <div class="d-flex align-items-center gap-3">
                    <x-avatar-cell name="Carlos Oliveira" email="" bg="bg-primary" :size="44" />
                  </div>
                </td>
                <td>Encanador</td>
                <td>4.8</td>
                <td>156</td>
                <td><span class="badge bg-success">Verificado</span></td>
                <td>
                  <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></button>
                    <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                  </div>
                </td>
              </tr>

              <tr>
                <td>
                  <div class="d-flex align-items-center gap-3">
                    <x-avatar-cell name="Laura Mendes" email="" bg="bg-secondary" :size="44" />
                  </div>
                </td>
                <td>Diarista</td>
                <td>4.9</td>
                <td>203</td>
                <td><span class="badge bg-success">Verificado</span></td>
                <td>
                  <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></button>
                    <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                  </div>
                </td>
              </tr>

              <tr>
                <td>
                  <div class="d-flex align-items-center gap-3">
                    <x-avatar-cell name="Roberto Silva" email="" bg="bg-primary" :size="44" />
                  </div>
                </td>
                <td>Eletricista</td>
                <td>4.7</td>
                <td>98</td>
                <td><span class="badge bg-warning text-dark">Pendente</span></td>
                <td>
                  <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></button>
                    <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Gerenciar Serviços -->
      <div class="tab-pane fade" id="services" role="tabpanel" aria-labelledby="services-tab">

        <div class="table-responsive rounded-3 bg-white shadow-sm p-3">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Serviços Recentes</h5>
            <div class="d-flex align-items-center">
              <input
                class="form-control"
                placeholder="Buscar Serviços..."
                style="min-width:200px; max-width:250px;"
              >
              <button
                class="btn btn-primary"
                style="white-space: nowrap; height: 38px; padding: 0 16px; margin-left:8px;"
              >
                Gerar Relatório
              </button>
            </div>
          </div>
          <table class="table table-borderless mb-0 align-middle">
            <thead>
              <tr>
                <th>Serviço</th>
                <th>Cliente</th>
                <th>Prestadores</th>
                <th>Valor</th>
                <th>Data</th>
                <th>Status</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Reparo Hidráulico</td>
                <td>Maria Silva</td>
                <td>Carlos Oliveira</td>
                <td>R$ 150,00</td>
                <td>24/01/2025</td>
                <td><span class="badge bg-success">Concluído</span></td>
                <td>
                  <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></button>
                    <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                  </div>
                </td>
              </tr>

              <tr>
                <td>Limpeza Residencial</td>
                <td>João Mendes</td>
                <td>Laura Mendes</td>
                <td>R$ 120,00</td>
                <td>14/01/2025</td>
                <td><span class="badge bg-warning text-dark">Em Andamento</span></td>
                <td>
                  <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></button>
                    <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                  </div>
                </td>
              </tr>

              <tr>
                <td>Instalação Elétrica</td>
                <td>Ana Costa</td>
                <td>Roberto Silva</td>
                <td>R$ 280,00</td>
                <td>23/01/2025</td>
                <td><span class="badge bg-info text-dark">Agendado</span></td>
                <td>
                  <div class="d-flex gap-2">
                    <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-eye"></i></button>
                    <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
