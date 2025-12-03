@php
$categories = $categories ?? $categoriesForCard ?? $formattedCategories ?? [];
@endphp

@if(count($categories) > 0)
<div class="category-selector-container" style="position: sticky; top: 70px; z-index: 999;">
    <div class="bg-light py-3 shadow-sm full-width-bg">
        <div class="container">
            <div class="category-selector-wrapper position-relative">
                <button class="category-nav-btn category-nav-prev" aria-label="Categorias anteriores">
                    <i class="bi bi-chevron-left"></i>
                </button>

                <div class="category-selector-scroll" id="categorySelector">
                    <div class="category-selector d-flex gap-4 flex-nowrap px-2">
                        <a href="{{ route('servicos.index', ['show_categorias' => 'true']) }}"
                            class="text-dark text-decoration-none fw-semibold selector-item px-3 py-1 rounded-pill {{ !request('categoria') ? 'active' : '' }}">
                            <i class="bi bi-grid-fill me-2"></i>Todas
                        </a>

                        @foreach ($categories as $category)
                        @php
                        $slug = $category['slug'] ?? $category->slug ?? null;
                        $nome = $category['nome'] ?? $category->nome ?? null;
                        $icone = $category['icone'] ?? $category->icone ?? null;
                        $href = $category['href'] ?? url('/servicos?categoria=' . $slug);

                        $isActive = request('categoria') == $slug;
                        @endphp

                        @if($slug)
                        <a href="{{ $href }}"
                            class="text-dark text-decoration-none fw-semibold selector-item px-3 py-1 rounded-pill {{ $isActive ? 'active' : '' }}">
                            @if($icone)
                            <i class="{{ $icone }} me-2"></i>
                            @endif
                            {{ $nome }}
                        </a>
                        @endif
                        @endforeach
                    </div>
                </div>

                <button class="category-nav-btn category-nav-next" aria-label="Próximas categorias">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .category-selector-container {
        position: sticky;
        top: 70px;
        z-index: 999;
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
    }

    .full-width-bg {
        position: relative;
        width: 100vw;
        left: 50%;
        right: 50%;
        margin-left: -50vw;
        margin-right: -50vw;
        overflow-x: hidden;
    }

    .category-selector-wrapper {
        display: flex;
        align-items: center;
        gap: 10px;
        position: relative;
    }

    .category-selector-scroll {
        flex: 1;
        overflow-x: auto;
        scroll-behavior: smooth;
        scrollbar-width: none;
        -ms-overflow-style: none;
        padding: 2px 0;
    }

    .category-selector-scroll::-webkit-scrollbar {
        display: none;
    }

    .category-selector {
        min-width: max-content;
    }

    .selector-item {
        font-size: 0.9rem;
        padding: 6px 16px;
        transition: all 0.2s ease;
        white-space: nowrap;
        border: 1px solid transparent;
        background-color: white;
        flex-shrink: 0;
        display: inline-flex;
        align-items: center;
    }

    .selector-item:hover {
        color: #0d6efd !important;
        background-color: #f8f9fa;
        border-color: #dee2e6;
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .selector-item.active {
        color: #0d6efd !important;
        background-color: #e7f1ff;
        border-color: #0d6efd;
        font-weight: 600;
    }

    .category-nav-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border: 1px solid #dee2e6;
        background-color: white;
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.2s ease;
        flex-shrink: 0;
        z-index: 10;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .category-nav-btn:hover {
        background-color: #f8f9fa;
        border-color: #0d6efd;
        color: #0d6efd;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .category-nav-btn i {
        font-size: 1.2rem;
    }

    .category-selector-wrapper:not(.has-scroll) .category-nav-btn {
        display: none;
    }

    @media (max-width: 768px) {
        .category-selector-container {
            top: 60px;
        }

        .category-nav-btn {
            display: none;
        }

        .category-selector-scroll {
            padding: 0 10px;
        }

        .selector-item {
            padding: 5px 12px;
            font-size: 0.85rem;
        }

        .selector-item i {
            font-size: 0.9rem;
            margin-right: 4px;
        }
    }

    @media (max-width: 576px) {
        .selector-item {
            padding: 4px 10px;
            font-size: 0.8rem;
        }

        .category-selector-container {
            top: 56px;
        }

        .selector-item i {
            margin-right: 2px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelector = document.getElementById('categorySelector');
        if (!categorySelector) return;

        const scrollContainer = categorySelector;
        const prevBtn = document.querySelector('.category-nav-prev');
        const nextBtn = document.querySelector('.category-nav-next');
        const wrapper = document.querySelector('.category-selector-wrapper');

        function checkScroll() {
            if (scrollContainer && scrollContainer.scrollWidth > scrollContainer.clientWidth) {
                if (wrapper) wrapper.classList.add('has-scroll');
                return true;
            } else {
                if (wrapper) wrapper.classList.remove('has-scroll');
                return false;
            }
        }

        function scrollCategories(direction) {
            if (!scrollContainer) return;

            const scrollAmount = 200;
            const currentScroll = scrollContainer.scrollLeft;

            if (direction === 'next') {
                scrollContainer.scrollLeft = currentScroll + scrollAmount;
            } else {
                scrollContainer.scrollLeft = currentScroll - scrollAmount;
            }
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', () => scrollCategories('prev'));
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', () => scrollCategories('next'));
        }

        function setActiveCategory() {
            const urlParams = new URLSearchParams(window.location.search);
            const currentCategory = urlParams.get('categoria');
            const selectorItems = document.querySelectorAll('.selector-item');

            selectorItems.forEach(item => item.classList.remove('active'));

            if (!currentCategory) {
                const allCategoriesItem = document.querySelector('a[href="{{ url(' / servicos ') }}"]');
                if (allCategoriesItem) allCategoriesItem.classList.add('active');
                return;
            }

            selectorItems.forEach(item => {
                const href = item.getAttribute('href');
                if (href) {
                    if (href.includes(`categoria=${currentCategory}`) ||
                        href.includes(`/categorias/${currentCategory}`) ||
                        href.includes(`/servicos/${currentCategory}`)) {
                        item.classList.add('active');
                    }
                }
            });
        }

        function scrollToActiveCategory() {
            if (!scrollContainer) return;

            const activeItem = document.querySelector('.selector-item.active');
            if (activeItem && checkScroll()) {
                const containerWidth = scrollContainer.clientWidth;
                const itemLeft = activeItem.offsetLeft;
                const itemWidth = activeItem.offsetWidth;

                // Centralizar o item ativo
                scrollContainer.scrollLeft = itemLeft - (containerWidth / 2) + (itemWidth / 2);
            }
        }

        setTimeout(() => {
            checkScroll();
            setActiveCategory();
            scrollToActiveCategory();
        }, 100);

        window.addEventListener('resize', () => {
            setTimeout(checkScroll, 100);
        });

        const selectorItems = document.querySelectorAll('.selector-item');
        selectorItems.forEach(item => {
            item.addEventListener('dragstart', (e) => e.preventDefault());
        });

        if (scrollContainer) {
            let startX;
            let scrollLeft;

            scrollContainer.addEventListener('touchstart', (e) => {
                startX = e.touches[0].pageX - scrollContainer.offsetLeft;
                scrollLeft = scrollContainer.scrollLeft;
            });

            scrollContainer.addEventListener('touchmove', (e) => {
                if (!startX) return;
                e.preventDefault();
                const x = e.touches[0].pageX - scrollContainer.offsetLeft;
                const walk = (x - startX) * 2;
                scrollContainer.scrollLeft = scrollLeft - walk;
            });
        }
    });
</script>
@endif