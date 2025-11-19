<div
    x-data="{ show: true }"
    x-show="show"
    x-init="setTimeout(() => show = false, 4000)"
    x-transition.opacity.duration.300ms
    class="toast-message"
    style="
        position: fixed;
        top: 20px;
        right: 20px;
        background: #ff4d4d;
        color: #fff;
        padding: 1rem 1.3rem;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        font-weight: 600;
        z-index: 9999;
        max-width: 300px;
    "
>
    {{ $message }}
</div>
