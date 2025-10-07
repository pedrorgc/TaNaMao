<div class="card mb-3">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div>
                <h6 class="mb-1 fw-bold">{{$servico}}</h6>
                <p class="text-muted mb-1" style="font-size: 0.9rem;">{{$tipo}}</p>
                <h6 class="mb-1"><strong>Categoria: </strong><small>{{$categoria}}</small></h6>
                <h6 class="mb-1"><strong>Preço: </strong> <small>R$ {{$valor}}</small></h6>
            </div>
        </div>
        @include('components.button', ['slot' => 'Editar'])
    </div>
</div>

