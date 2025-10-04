<div class="card mb-3">
    <div class="card-body">
        <i class="{{ $icon }} fs-1 mb-2"></i>
        <h5 class="card-title">{{ $title }}</h5>
        <p class="card-text">{{ $slot }}</p>
    </div>
</div>

<style>
    .card{
        cursor: pointer;
        transition: transform 0.3s, box-shadow 0.3s;
        padding: 20px;
    }
    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }
</style>
