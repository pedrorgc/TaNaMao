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

@endsection
