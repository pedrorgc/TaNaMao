@extends('layouts.app')

@section('title', 'Página Inicial')

@section('content')
<div class="text-center mt-5">
    <h1>Encontre o profissional <span class="text-primary">certo para você</span></h1>
    <p>Conectamos você aos melhores prestadores de serviço da sua região. 
       Rápido, confiável e na palma da sua mão.</p>

    <div class="d-flex gap-2 justify-content-center">
        @include('components.button', [
            'slot' => 'Encontrar Serviços', 
            'class' => 'btn-primary'
        ])

        @include('components.button', [
            'slot' => 'Prestar Serviços', 
            'class' => 'btn-secondary'
        ])
    </div>
</div>


<div class="text-center mt-5">
    <h1>Categorias de Serviços</h1>

    <div class="row mt-4">
        <div class="col-md-3">
            @include('components.card', ['icon' => 'bi-wrench', 'title' => 'Encanador', 'slot' => 'Reparos hidráulicos'])
        </div>
        <div class="col-md-3">
            @include('components.card', ['icon' => 'bi-lightning-charge-fill', 'title' => 'Eletricista', 'slot' => 'Instalações elétricas'])
        </div>
        <div class="col-md-3">
            @include('components.card', ['icon' => 'bi-house-door-fill', 'title' => 'Diarista', 'slot' => 'Limpeza Residencial'])
        </div>
        <div class="col-md-3">
            @include('components.card', ['icon' => 'bi-gear-fill', 'title' => 'Mecânico', 'slot' => 'Manutenção Automotiva'])
        </div>
    </div>
</div>

<div class="text-center mt-5">
    <h1 class="fw-bold">O que nossos usuários dizem</h1>
    
    <div class="row justify-content-center mt-4">
        <!-- Card 1 -->
        <div class="col-md-3 m-2">
            <div class="p-4 bg-light rounded-3 shadow-sm h-100">
                <!-- Estrelas -->
                <div class="mb-2">
                    <i class="bi bi-star-fill text-dark"></i>
                    <i class="bi bi-star-fill text-dark"></i>
                    <i class="bi bi-star-fill text-dark"></i>
                    <i class="bi bi-star-fill text-dark"></i>
                    <i class="bi bi-star-fill text-dark"></i>
                </div>
                <!-- Depoimento -->
                <p class="fst-italic">“Encontrei um eletricista excelente em poucos minutos”</p>
                <!-- Nome -->
                <p class="fw-bold mb-0">Raí</p>
                <!-- Tipo de usuário -->
                <a href="#" class="text-primary text-decoration-none">Cliente</a>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col-md-3 m-2">
            <div class="p-4 bg-light rounded-3 shadow-sm h-100">
                <div class="mb-2">
                    <i class="bi bi-star-fill text-dark"></i>
                    <i class="bi bi-star-fill text-dark"></i>
                    <i class="bi bi-star-fill text-dark"></i>
                    <i class="bi bi-star-fill text-dark"></i>
                    <i class="bi bi-star-fill text-dark"></i>
                </div>
                <p class="fst-italic">“Consegui mais clientes e organizei melhor meu negócio”</p>
                <p class="fw-bold mb-0">Pedro</p>
                <a href="#" class="text-primary text-decoration-none">Prestador</a>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-md-3 m-2">
            <div class="p-4 bg-light rounded-3 shadow-sm h-100">
                <div class="mb-2">
                    <i class="bi bi-star-fill text-dark"></i>
                    <i class="bi bi-star-fill text-dark"></i>
                    <i class="bi bi-star-fill text-dark"></i>
                    <i class="bi bi-star-fill text-dark"></i>
                    <i class="bi bi-star-fill text-dark"></i>
                </div>
                <p class="fst-italic">“Serviço rápido e confiável, recomendo”</p>
                <p class="fw-bold mb-0">Luiz</p>
                <a href="#" class="text-primary text-decoration-none">Cliente</a>
            </div>
        </div>
    </div>
</div>

@endsection
