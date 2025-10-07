@props([
  'name' => '',
  'email' => '',
  'src' => null,
  'initials' => null,
  'bg' => 'bg-primary',
  'size' => 40,
  'href' => null,
  'showName' => true,
])

@php
    $computedInitials = $initials;
    if (empty($computedInitials) && !empty($name)) {
        $parts = preg_split('/\s+/', trim($name));
        $computedInitials = '';
        if (count($parts) > 0) {
            $computedInitials .= mb_substr($parts[0], 0, 1);
            if (count($parts) > 1) {
                $computedInitials .= mb_substr($parts[1], 0, 1);
            } else {
                $computedInitials .= (mb_substr($parts[0], 1, 1) ?: '');
            }
        }
        $computedInitials = strtoupper($computedInitials);
    }

    $bgMap = [
        'bg-primary' => '#0d6efd',
        'bg-secondary' => '#6c757d',
        'bg-success' => '#198754',
        'bg-danger' => '#dc3545',
        'bg-warning' => '#ffc107',
        'bg-info' => '#0dcaf0',
        'bg-light' => '#f8f9fa',
        'bg-dark' => '#212529',
    ];
    $fill = $bgMap[$bg] ?? '#6c757d';

    $svgSize = max(24, (int)$size);
    $fontSize = (int)floor($svgSize * 0.45);
    $svg = "<svg xmlns='http://www.w3.org/2000/svg' width='{$svgSize}' height='{$svgSize}'><rect width='100%' height='100%' rx='50%' ry='50%' fill='{$fill}'/><text x='50%' y='50%' dominant-baseline='middle' text-anchor='middle' font-family='Segoe UI, Roboto, Helvetica, Arial, sans-serif' font-size='{$fontSize}' fill='%23ffffff'>".htmlspecialchars($computedInitials)."</text></svg>";
    $dataUrl = 'data:image/svg+xml;utf8,' . rawurlencode($svg);
@endphp

@php

  $wrapperTag = !empty($href) ? 'a' : 'div';
  $wrapperAttrs = !empty($href)
      ? 'href="' . e($href) . '" class="text-decoration-none d-inline-flex align-items-center gap-3"'
      : 'class="d-flex align-items-center gap-3"';
@endphp

<{!! $wrapperTag !!} {!! $wrapperAttrs !!} aria-label="{{ e($name) }}">
  <div style="width:{{ $size }}px;height:{{ $size }}px;flex:0 0 {{ $size }}px;" role="img" aria-label="{{ e($name) }}">
    @if(!empty($src))
      <img src="{{ $src }}" alt="{{ $name }}" loading="lazy" class="rounded-circle" style="width:100%;height:100%;object-fit:cover;display:block;" onerror="this.onerror=null;this.src={{ json_encode($dataUrl) }}">
    @else
      <div class="{{ $bg }} d-flex justify-content-center align-items-center rounded-circle" style="width:100%;height:100%;">
        <small class="fw-bold">{{ $computedInitials }}</small>
      </div>
    @endif
  </div>

  {{-- Mostra nome e e-mail só se showName = true --}}
  @if($showName)
    <div>
      <div class="fw-bold mb-0">{{ $name }}</div>
      @if($email)
        <small class="text-muted">{{ $email }}</small>
      @endif
    </div>
  @endif
</{!! $wrapperTag !!}>
