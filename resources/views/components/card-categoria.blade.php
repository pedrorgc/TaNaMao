<!-- components/card-categoria.blade.php -->
@props(['categories' => [], 'selectedCategory' => null])

<div class="card-categoria-container py-4">
    <div class="container">
        @if(count($categories) > 0)
            <h5 class="fw-bold mb-4">Escolha uma Categoria</h5>
            
            <div class="row g-3">
                @foreach($categories as $category)
                    @php
                        if ($category instanceof \App\Models\Categoria) {
                            $categoryId = $category->id;
                            $categoryName = $category->nome;
                            $categoryIcon = $category->icone;
                            $categorySlug = $category->slug;
                        } else {
                            $categoryId = $category['id'] ?? $category['id'] ?? null;
                            $categoryName = $category['nome'] ?? $category['name'] ?? '';
                            $categoryIcon = $category['icone'] ?? $category['icon'] ?? 'bi-briefcase-fill';
                            $categorySlug = $category['slug'] ?? '';
                        }
                        
                    
                        $isSelected = false;
                        $urlCategory = request('categoria');
                        
                        if ($urlCategory) {
                            $isSelected = $urlCategory == $categorySlug;
                        } elseif ($selectedCategory) {
                            if ($selectedCategory instanceof \App\Models\Categoria) {
                                $isSelected = $selectedCategory->slug == $categorySlug;
                            } elseif (is_array($selectedCategory)) {
                                $isSelected = ($selectedCategory['slug'] ?? '') == $categorySlug;
                            }
                        }
                    @endphp
                    
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                        <button type="button" 
                                class="category-card-btn w-100 text-start p-3 rounded-3 border-0 position-relative overflow-hidden {{ $isSelected ? 'selected' : '' }}"
                                data-category-id="{{ $categoryId }}"
                                data-category-name="{{ htmlspecialchars($categoryName) }}"
                                data-category-slug="{{ $categorySlug }}"
                                onclick="filterByCategorySlug('{{ $categorySlug }}', '{{ addslashes($categoryName) }}')"
                                style="background: {{ $isSelected ? '#e7f1ff' : '#fff' }}; 
                                       transition: all 0.3s ease; 
                                       min-height: 120px;">
                            
                            @if($isSelected)
                                <div class="position-absolute top-0 end-0 p-2">
                                    <i class="bi bi-check-circle-fill text-primary fs-5"></i>
                                </div>
                            @endif
                            
                            <div class="mb-3 d-flex justify-content-center">
                                <div class="rounded-circle p-3 d-flex align-items-center justify-content-center"
                                     style="width: 60px; height: 60px; 
                                            background: {{ $isSelected ? '#0d6efd' : '#f8f9fa' }};">
                                    <i class="bi {{ $categoryIcon }} fs-4 {{ $isSelected ? 'text-white' : 'text-primary' }}"></i>
                                </div>
                            </div>
                            
                            <h6 class="fw-bold mb-1 text-center {{ $isSelected ? 'text-primary' : 'text-dark' }}">
                                {{ $categoryName }}
                            </h6>
                        </button>
                    </div>
                @endforeach
            </div>
            
            @if(request('categoria'))
                <div class="text-center mt-4">
                    <button type="button" 
                            class="btn btn-outline-primary"
                            onclick="clearCategoryFilter()">
                        <i class="bi bi-x-circle me-1"></i> Limpar Filtro de Categoria
                    </button>
                </div>
            @endif
        @else
            <div class="text-center py-3">
                <i class="bi bi-folder-x fs-1 text-muted"></i>
                <p class="text-muted mt-2">Nenhuma categoria disponível</p>
            </div>
        @endif
    </div>
</div>

<style>
    .category-card-btn {
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        border: 1px solid #e9ecef !important;
        transition: all 0.3s ease !important;
    }
    
    .category-card-btn:hover:not(.selected) {
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        border-color: #0d6efd !important;
        background: #f8f9fa !important;
    }
    
    .category-card-btn.selected {
        border-color: #0d6efd !important;
        background: #e7f1ff !important;
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.2);
    }
</style>

<script>
function filterByCategorySlug(categorySlug, categoryName) {
    console.log(`Filtrando por categoria: ${categoryName} (Slug: ${categorySlug})`);
    
    const url = new URL(window.location.href);
    
    url.searchParams.delete('categoria_id');
    url.searchParams.delete('page');
    
    url.searchParams.set('categoria', categorySlug);
    
    const newUrl = `${url.toString()}#${categorySlug}`;
    
    const select = document.getElementById('categorySelect');
    if (select) {
        const option = select.querySelector(`option[value="${categorySlug}"]`);
        if (option) {
            select.value = categorySlug;
        }
    }
    
    window.location.href = newUrl;
}

function clearCategoryFilter() {
    const url = new URL(window.location.href);
    url.searchParams.delete('categoria');
    url.searchParams.delete('categoria_id');
    url.searchParams.delete('page');
    url.hash = '';
    
    window.location.href = url.toString();
}

document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const urlCategory = urlParams.get('categoria');
    
    if (urlCategory) {
        const card = document.querySelector(`.category-card-btn[data-category-slug="${urlCategory}"]`);
        if (card) {
            card.classList.add('selected');
        }
    }
});

window.filterByCategorySlug = filterByCategorySlug;
window.clearCategoryFilter = clearCategoryFilter;
</script>