@props([
'servico' => '',
'descricao' => '',
'categoria' => '',
'valor' => '',
])

<div class="service-card p-4 rounded-4 bg-white shadow-sm h-100 d-flex flex-column border hover-shadow-sm">
  <div class="mb-3">
    <h5 class="fw-bold text-primary mb-2">{{ $servico }}</h5>
    @if($descricao)
    <p class="text-muted mb-2">{{ $descricao }}</p>
    @endif
    <p class="mb-1"><strong>Categoria:</strong> {{ $categoria }}</p>
    <p class="mb-0"><strong>Valor:</strong> R$ {{ $valor }}</p>
  </div>

  <div class="mt-auto text-end border-top pt-3">
    <button class="btn btn-outline-primary fw-semibold rounded-pill px-4">
      <i class="bi bi-pencil-square me-1"></i> Editar
    </button>
  </div>
</div>

<style>
  .service-card {
    transition: all 0.25s ease;
  }

  .service-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 0.75rem 1.25rem rgba(0, 0, 0, 0.08);
    border-color: #0d6efd !important;
  }
</style>