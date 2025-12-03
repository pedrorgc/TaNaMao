{{-- resources/views/components/input-field.blade.php --}}
@props([
    'label',
    'icon',
    'type',
    'id',
    'placeholder',
    'name',
    'value' => null,
    'required' => false,
    'readonly' => false,
    'auto' => false
])

<div class="mb-3 position-relative">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <div class="input-group">
        <i class="ph {{ $icon }}"></i>
        <input 
            type="{{ $type }}" 
            class="form-control @if($auto) campo-auto-preenchido @endif" 
            id="{{ $id }}" 
            name="{{ $name }}" 
            value="{{ old($name, $value) }}" 
            placeholder="{{ $placeholder }}" 
            {{ $required ? 'required' : '' }}
            {{ $readonly ? 'readonly' : '' }}>
        @if($auto)
        <span class="badge-auto">Automático</span>
        @endif
    </div>
</div>