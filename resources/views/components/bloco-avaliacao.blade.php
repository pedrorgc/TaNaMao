<div class="p-3 border rounded-3 shadow-sm bg-white">
    <div class="d-flex justify-content-between align-items-start">
        <div>
            <h6 class="fw-bold mb-1">{{$nome}}</h6>
            <p class="text-muted mb-1" style="font-size: 0.9rem;">{{$servico}}</p>
            <p class="mb-2 fst-italic" style="font-size: 0.9rem;">"{{$avaliacao}}"</p>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">{{$data}}</p>
        </div>
        <div class="text-end">
            <div class="mb-1">
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <strong>{{$stars}}</strong>
            </div>
        </div>
    </div>
</div>
