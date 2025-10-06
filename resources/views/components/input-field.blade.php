<div class="form-group">
    <label for="{{ $id }}">{{ $label }}</label>
    <div class="input-with-icon">
        @if($icon)
            <i class="ph {{ $icon }}"></i>
        @endif
        <input type="{{ $type }}" id="{{ $id }}" placeholder="{{ $placeholder }}">
    </div>
</div>
