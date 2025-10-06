@props(['title' => '', 'value' => '', 'class' => ''])

<div {{ $attributes->merge(['class' => 'p-3 bg-white rounded-3 shadow-sm flex-fill text-center ' . $class]) }}>
  <div class="fw-bold">{{ $title }}</div>
  <div class="fs-4">{{ $value }}</div>
</div>
