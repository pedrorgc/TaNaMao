@props(['rating' => null, 'reviews' => 0, 'distance' => '', 'price' => ''])

<div class="d-flex align-items-center gap-3 small text-muted">
  <div>★ {{ $rating ?? '—' }} ({{ $reviews }})</div>
  <div>•</div>
  <div>{{ $distance }}</div>
  <div>•</div>
  <div>{{ $price }}</div>
</div>
