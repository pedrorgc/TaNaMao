<div class="d-inline-block">
    <a href="{{ $href ?? '#' }}" class="btn {{ $class ?? 'btn-primary' }} btn-sm btn-fixed">
        {{ $slot }}
    </a>
</div>

<style>
  .btn-fixed {
    width: 160px;
    transition: transform 0.3s, box-shadow 0.3s;
  }
  .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
  }
</style>
