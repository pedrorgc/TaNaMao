@props([
'name' => '',
'avatarSrc' => null,
'role' => '',
'rating' => null,
'reviews' => 0,
'distance' => '',
'price' => '',
'isVerified' => false,
'href' => null,
'description' => '',
'size' => 40,
])

<div class="service-card p-3 rounded-4 bg-white shadow-sm h-100 d-flex flex-column border">
  <div class="d-flex align-items-start justify-content-between mb-3">
    <div class="d-flex align-items-center gap-3 flex-grow-1">
      <x-avatar-cell :name="$name" :src="$avatarSrc" :size="$size" :showName="false" />
      <div>
        <div class="fw-bold">
          {{ $name }}
          @if($isVerified)
          <span class="badge bg-success-subtle text-success ms-1 small px-2 py-1">Verificado</span>
          @endif
        </div>
        <div class="text-primary small">{{ $role }}</div>
      </div>
    </div>
  </div>

  @if($description)
  <p class="text-muted small mb-4">{{ $description }}</p>
  @endif

  <div class="d-flex justify-content-between align-items-center text-muted small mb-4">
    <div><i class="bi bi-star-fill text-warning"></i> <strong>{{ $rating }}</strong> ({{ $reviews }})</div>
    <div><i class="bi bi-geo-alt"></i> {{ $distance }}</div>
    <div class="fw-semibold text-dark">{{ $price }}</div>
  </div>

  <!-- Área inferior com botões -->
  <div class="mt-auto d-flex justify-content-between align-items-center pt-2 border-top">
    <a href="#" class="btn btn-primary w-75 rounded-pill fw-semibold">
      Ver Perfil
    </a>
    <button class="btn btn-outline-primary rounded-circle ms-2" style="width:42px; height:42px;">
      <i class="bi bi-chat"></i>
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