@if(isset($items) && $items->count() > 0)
<div class="row g-4 justify-content-center">
    @foreach($items->take(3) as $item)
    <div class="col-lg-4 col-md-6">
        @php
            $route = isset($routeName) ? route($routeName, $item->slug ?? $item->id) : '#';
            $title = data_get($item, $titleField ?? 'titulo');
            $description = data_get($item, $descriptionField ?? 'descricao');
            $badge = data_get($item, $badgeField ?? 'categoria.nome');
            $prestadorNome = data_get($item, $prestadorNameField ?? 'prestador.user.name');
        @endphp
        
        <a href="{{ $route }}" class="text-decoration-none">
            <div class="card border-0 shadow-sm h-100 hover-shadow">
                <div class="card-body p-4">
                    @if($badge)
                    <span class="badge bg-primary mb-3">{{ $badge }}</span>
                    @endif
                    
                    <h5 class="card-title fw-bold text-dark mb-3">{{ $title }}</h5>
                    <p class="card-text text-muted mb-4" style="height: 60px; overflow: hidden;">
                        {{ Str::limit($description, 100) }}
                    </p>
                    
                    @if(isset($showPrestador) && $showPrestador && $prestadorNome)
                    <div class="d-flex align-items-center mt-auto">
                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 30px; height: 30px;">
                            <span class="text-white small fw-bold">
                                {{ substr($prestadorNome, 0, 1) }}
                            </span>
                        </div>
                        <span class="text-muted small">{{ $prestadorNome }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>
@endif