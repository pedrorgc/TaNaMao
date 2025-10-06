<div class="d-block {{ $wrapperClass ?? '' }}">
    <a href="{{ $href ?? '#' }}" 
       class="btn {{ $class ?? 'btn-primary' }} {{ $size ?? 'btn-lg' }} custom-btn w-100">
        {{ $slot }}
    </a>
</div>

<style>
  .custom-btn {
    min-width: 200px;
    min-height: 45px;
    padding: 10px 0;
    font-weight: 500;
    border-radius: 8px;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }

  .custom-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
  }

  /* Aparência do botão Google */
  .btn-google {
    background-color: #fff;
    border: 1px solid #ddd;
    color: #444;
    font-weight: 500;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: all 0.3s ease;
  }

  .btn-google:hover {
    background-color: #f8f9fa;
    border-color: #ccc;
  }

  .btn-google i {
    background-color: #fff;
    border-radius: 50%;
    padding: 4px;
    font-size: 1.2rem;
    color: #db4437; /* Vermelho Google */
  }
</style>
