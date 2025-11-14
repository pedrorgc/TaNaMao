<div class="form-group">
    <label for="{{ $id }}">{{ $label }}</label>
    <div class="input-with-icon">
        @if($icon)
            <i class="ph {{ $icon }}"></i>
        @endif
        <input type="{{ $type }}" id="{{ $id }}" name="{{ $name ?? $id }}" placeholder="{{ $placeholder }}" value="{{ $value ?? old($name ?? $id) }}" class="{{ $errors->has($name ?? $id) ? 'is-invalid' : '' }}">
    </div>
</div>
