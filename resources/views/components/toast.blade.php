@props(['type' => 'success', 'message' => ''])

@php
    $styles = [
        'success' => [
            'background' => '#10b981',
            'icon' => '✅', // Emoji check verde
            'border' => '#059669',
            'icon_color' => '#ffffff'
        ],
        'error' => [
            'background' => '#ef4444',
            'icon' => '❌', // Emoji X vermelho
            'border' => '#dc2626',
            'icon_color' => '#ffffff'
        ],
        'warning' => [
            'background' => '#f59e0b',
            'icon' => '⚠️', // Emoji alerta
            'border' => '#d97706',
            'icon_color' => '#ffffff'
        ],
        'info' => [
            'background' => '#3b82f6',
            'icon' => 'ℹ️', // Emoji informação
            'border' => '#2563eb',
            'icon_color' => '#ffffff'
        ]
    ];

    $style = $styles[$type] ?? $styles['success'];
    $toastId = 'toast-' . uniqid();
@endphp

<div
    id="{{ $toastId }}"
    class="toast-message"
    style="
        position: fixed;
        top: 20px;
        right: 20px;
        background: {{ $style['background'] }};
        color: white;
        padding: 16px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 9999;
        max-width: 350px;
        border-left: 4px solid {{ $style['border'] }};
        display: flex;
        align-items: center;
        gap: 12px;
        cursor: pointer;
    "
    role="alert"
    onclick="closeToast('{{ $toastId }}')"
>
    <!-- Ícone - EMOJI GRANDE E VISÍVEL -->
    <div style="display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 20px;">
        {{ $style['icon'] }}
    </div>

    <!-- Mensagem -->
    <div style="flex: 1; display: flex; align-items: center;">
        <span style="font-size: 14px; line-height: 1.4; font-weight: 500;">{{ $message }}</span>
    </div>

    <!-- Botão Fechar -->
    <div style="display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
        <button
            onclick="event.stopPropagation(); closeToast('{{ $toastId }}')"
            style="
                background: none;
                border: none;
                color: white;
                cursor: pointer;
                padding: 4px;
                opacity: 0.8;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 4px;
                transition: opacity 0.2s;
                font-size: 18px;
            "
            onmouseover="this.style.opacity='1'"
            onmouseout="this.style.opacity='0.8'"
            aria-label="Fechar mensagem"
        >
            ×
        </button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        initializeToast('{{ $toastId }}');
    });

    function initializeToast(toastId) {
        const toast = document.getElementById(toastId);
        if (!toast) return;

        const autoCloseTimer = setTimeout(() => {
            closeToast(toastId);
        }, 5000);

        toast.addEventListener('mouseenter', function() {
            clearTimeout(autoCloseTimer);
        });

        toast.addEventListener('mouseleave', function() {
            setTimeout(() => {
                closeToast(toastId);
            }, 5000);
        });

        toast.autoCloseTimer = autoCloseTimer;
    }

    function closeToast(toastId) {
        const toast = document.getElementById(toastId);
        if (!toast) return;

        if (toast.autoCloseTimer) {
            clearTimeout(toast.autoCloseTimer);
        }

        toast.style.opacity = '0';
        toast.style.transform = 'translateX(100%)';

        setTimeout(() => {
            if (toast.parentNode) {
                toast.parentNode.removeChild(toast);
            }
        }, 300);
    }
</script>
