<div class="form-group" style="margin-bottom: 1.25rem;">
    <label for="{{ $id }}" style="font-weight: 600; margin-bottom: 0.3rem; display:block;">
        {{ $label }}
    </label>

    <div style="
        position: relative;
        display: flex;
        align-items: center;
        width: 100%;
    ">
        @if($icon)
            <i class="ph {{ $icon }}"
               style="
                    position:absolute;
                    left:14px;
                    color:#adb5bd;
                    font-size:1.2rem;
                    pointer-events:none;
               ">
            </i>
        @endif

        <input
            type="{{ $type }}"
            id="{{ $id }}"
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            class="form-control"
            style="
                width: 100%;
                padding-left: {{ $icon ? '2.8rem' : '0.85rem' }};
                padding-right: {{ $type === 'password' ? '3rem' : '0.85rem' }};
                height: 2.9rem;
                border-radius: .6rem;
            "
        >

        @if($type === 'password')
            <i class="ph ph-eye"
               onclick="togglePassword('{{ $id }}', this)"
               style="
                    position: absolute;
                    right: 14px;
                    font-size: 1.35rem;
                    color: #6c757d;
                    cursor: pointer;
               ">
            </i>
        @endif
    </div>
</div>
