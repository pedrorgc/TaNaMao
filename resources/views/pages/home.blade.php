@extends('layouts.app')

@section('title', 'Página Inicial')


@endsection
@section('content')
<div class="text-center">
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
