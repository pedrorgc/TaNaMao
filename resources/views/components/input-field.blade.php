<div class="form-group">
    <label for="{{ $id }}">{{ $label }}</label>
    <div class="input-with-icon">
        @if(!empty($icon))
            <i class="ph {{ $icon }}"></i>
        @endif
        @php $fieldName = $name ?? $id; @endphp
        <input
            type="{{ $type }}"
            id="{{ $id }}"
            name="{{ $fieldName }}"
            value="{{ old($fieldName) }}"
            placeholder="{{ $placeholder }}"
            @if(!empty($required)) required @endif
            class="form-control"
        >
    </div>
    @error($fieldName)
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>
