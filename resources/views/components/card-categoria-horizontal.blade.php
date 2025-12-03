<!-- components/card-categoria-horizontal.blade.php -->
@props(['categories' => [], 'selectedCategory' => null])

<div class="card-categoria-horizontal-container py-4">
    <div class="container">
        @if(count($categories) > 0)
            <h5 class="fw-bold mb-4">Categorias Populares</h5>
            
            <div class="d-flex gap-3 overflow-auto pb-3" style="scrollbar-width: thin;">
                @foreach($categories as $category)
                    @php
                        $isSelected = $selectedCategory && $selectedCategory->id == $category['id'];
                    @endphp
                    
                    <button type="button" 
                            class="category-card-horizontal flex-shrink-0 d-flex align-items-center gap-3 p-3 rounded-3 border-0"
                            data-category-id="{{ $category['id'] }}"
                            onclick="filterByCategory('{{ $category['id'] }}', '{{ $category['name'] }}')"
                            style="background: {{ $isSelected ? '#e7f1ff' : '#fff' }};
                                   min-width: 250px;
                                   transition: all 0.3s ease;">
                        
                        <div class="category-icon">
                            <i class="bi {{ $category['icon'] ?? 'bi-grid' }} fs-4 {{ $isSelected ? 'text-primary' : 'text-muted' }}"></i>
                        </div>
                        
                        <div class="text-start">
                            <h6 class="fw-bold mb-0 {{ $isSelected ? 'text-primary' : 'text-dark' }}">
                                {{ $category['name'] }}
                            </h6>
                            @if(isset($category['count']))
                                <small class="text-muted">{{ $category['count'] }} serviços</small>
                            @endif
                        </div>
                        
                        @if($isSelected)
                            <i class="bi bi-check-circle-fill text-primary ms-auto"></i>
                        @endif
                    </button>
                @endforeach
            </div>
        @endif
    </div>
</div>

<style>
    .category-card-horizontal {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        border: 1px solid #e9ecef !important;
        cursor: pointer;
    }
    
    .category-card-horizontal:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        border-color: #0d6efd !important;
    }
    
    .category-card-horizontal.selected {
        border-color: #0d6efd !important;
        background: #e7f1ff !important;
    }
</style>