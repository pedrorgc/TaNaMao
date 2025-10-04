@extends('layouts.app')

@section('title', 'Página Inicial')

@section('content')
<div class="text-center mt-5">
    <h1>Encontre o profissional <span class="text-primary">certo para você</span></h1>
    <p>Conectamos você aos melhores prestadores de serviço da sua região.
       Rápido, confiável e na palma da sua mão.</p>

    <div class="d-flex gap-2 justify-content-center mt-3">
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

    <div class="row mt-5">
        <div class="col-md-3 mt-5">
            @include('components.card', ['icon' => 'bi-wrench', 'title' => 'Encanador', 'slot' => 'Reparos hidráulicos'])
        </div>
        <div class="col-md-3 mt-5">
            @include('components.card', ['icon' => 'bi-lightning-charge-fill', 'title' => 'Eletricista', 'slot' => 'Instalações elétricas'])
        </div>
        <div class="col-md-3 mt-5">
            @include('components.card', ['icon' => 'bi-house-door-fill', 'title' => 'Diarista', 'slot' => 'Limpeza Residencial'])
        </div>
        <div class="col-md-3 mt-5">
            @include('components.card', ['icon' => 'bi-gear-fill', 'title' => 'Mecânico', 'slot' => 'Manutenção Automotiva'])
        </div>
    </div>
</div>

<div>
    <h1 class='text-center mt-5'>Como Funciona</h1>
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-md-4 mt-5">
                <i class="bi bi-geo-alt-fill fs-1"></i>
                <h3>1. Busque</h3>
                <p>Procure o serviço que precisa na sua região</p>
            </div>
            <div class="col-md-4 mt-5">
                <i class="bi bi-people-fill fs-1"></i>
                <h3>2. Compare</h3>
                <p>Veja perfis, avaliações e escolha o melhor</p>
            </div>
            <div class="col-md-4 mt-5">
                <i class="bi bi-check-lg fs-1"></i>
                <h3>3. Contrate</h3>
                <p>Contrate direto pela plataforma</p>
            </div>
        </div>
    </div>
</div>

@endsection
