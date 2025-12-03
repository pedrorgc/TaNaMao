@props([
    'items' => [],
    'routeName' => null,
    'routeParam' => 'id',
    'selectedItem' => null,
    'titleField' => 'titulo',
    'descriptionField' => 'descricao',
    'badgeField' => null,
    'badgeLabel' => null,
    'imageField' => null
])

@if(count($items) > 0)
<div class="row">
    @foreach($items as $item)
        @php
            $isSelected = $selectedItem && $selectedItem->id == $item->id;
            $cardClass = $isSelected ? 'selected' : '';
            $route = $routeName ? route($routeName, [$routeParam => $item->id]) : '#';
        @endphp
        
        <div class="col-md-4 mb-4">
            @if($routeName)
            <a href="{{ $route }}" class="text-decoration-none">
            @endif
            
                <div class="card service-card h-100 shadow-sm {{ $cardClass }}">
                    @if($imageField && $item->{$imageField})
                    <img src="{{ $item->{$imageField} }}" class="card-img-top" alt="{{ $item->{$titleField} }}">
                    @endif
                    
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->{$titleField} }}</h5>
                        <p class="card-text">{{ Str::limit($item->{$descriptionField}, 100) }}</p>
                        
                        @if($badgeField && $item->{$badgeField})
                        <span class="badge bg-primary">
                            {{ $badgeLabel ?: $item->{$badgeField} }}
                        </span>
                        @endif
                        
                    </div>
                </div>
                
            @if($routeName)
            </a>
            @endif
        </div>
    @endforeach
</div>
@endif