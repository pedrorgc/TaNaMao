<div class="p-3 border rounded-3 shadow-sm bg-white">
    <div class="d-flex justify-content-between align-items-start">
        <div>
            <h6 class="fw-bold mb-1">{{$servico}}</h6>
            <p class="text-muted mb-1" style="font-size: 0.9rem;">Prestador: {{$prestador}}</p>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">
                {{$data}} &nbsp;
                <i class="bi bi-star-fill text-warning"></i> <strong>{{$stars}}</strong>
            </p>
        </div>
        <div class="text-end">
            <span class="badge px-3 py-2 rounded-pill"
                style="background-color: #22c55e; color: #fff;">Concluído</span>
            <p class="fw-bold mb-0 mt-2">R$ {{$valor}}</p>
        </div>
    </div>
</div>
