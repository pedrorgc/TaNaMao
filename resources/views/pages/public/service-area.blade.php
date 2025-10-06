@extends('layouts.app')

@section('title', 'Área de Serviço')

@section('content')

<div class="container my-5">
  <div class="row">
    <!-- Sidebar filtros -->
    <aside class="col-md-3 mb-4">
      <div class="p-3 rounded-3 shadow-sm bg-white">
        <h6 class="fw-bold">Localização</h6>
        <p class="mb-1">Almenara, MG - 5 km</p>
        <button class="btn btn-sm btn-outline-secondary w-100">Alterar filtros</button>
      </div>

      <div class="mt-3 p-3 rounded-3 shadow-sm bg-white">
        <h6 class="fw-bold">Categorias</h6>
        <ul class="list-unstyled mb-0">
          <li class="d-flex justify-content-between"><span>Encanador</span><span class="text-muted">25</span></li>
          <li class="d-flex justify-content-between"><span>Eletricista</span><span class="text-muted">18</span></li>
          <li class="d-flex justify-content-between"><span>Diarista</span><span class="text-muted">42</span></li>
          <li class="d-flex justify-content-between"><span>Mecânico</span><span class="text-muted">12</span></li>
        </ul>
      </div>
    </aside>

    <!-- Main -->
<main class="col-md-9">
  <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3">
    <div>
      <h3 class="mb-1 fw-semibold">Prestadores Disponíveis</h3>
      <p class="text-muted mb-0">4 prestadores encontrados na sua região</p>
    </div>
  </div>

  @php
    $providers = [
      ['name' => 'João Silva', 'role' => 'Encanador', 'rating' => '4.8', 'reviews' => 127, 'distance' => '0.25 km', 'price' => 'R$ 80 - 120/h', 'desc' => 'Especialista em reparos hidráulicos residenciais e comerciais.', 'verified' => true],
      ['name' => 'Laura Mendes', 'role' => 'Diarista', 'rating' => '4.9', 'reviews' => 203, 'distance' => '1.2 km', 'price' => 'R$ 60 - 90/h', 'desc' => 'Limpeza residencial e organização de pequenos espaços.', 'verified' => true],
      ['name' => 'Roberto Silva', 'role' => 'Eletricista', 'rating' => '4.7', 'reviews' => 98, 'distance' => '2.1 km', 'price' => 'R$ 80 - 150/h', 'desc' => 'Instalações elétricas residenciais e comerciais.', 'verified' => false],
      ['name' => 'Ana Costa', 'role' => 'Mecânico', 'rating' => '4.6', 'reviews' => 54, 'distance' => '0.9 km', 'price' => 'R$ 70 - 110/h', 'desc' => 'Manutenção e revisão de pequenos motores e peças.', 'verified' => false],
    ];
  @endphp

  <!-- Cards -->
  <div class="row g-4 mt-4 row-cols-1 row-cols-md-2">
    @foreach($providers as $p)
      <div class="col">
        <div class="card h-100 border-0 shadow-sm rounded-4 p-3 transition-all hover-shadow-lg">
          <x-service-card 
            :name="$p['name']" 
            :role="$p['role']" 
            :rating="$p['rating']" 
            :reviews="$p['reviews']" 
            :distance="$p['distance']" 
            :price="$p['price']" 
            :is-verified="$p['verified']" 
            :description="$p['desc']" 
          />
        </div>
      </div>
    @endforeach
  </div>
</main>

  </div>
</div>

@endsection
