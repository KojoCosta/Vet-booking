@props([
  'title',         // string: card heading
  'value',         // int|string: main metric
  'icon'   => 'bi-speedometer2', // Bootstrap Icon class
  'color'  => 'primary'         // Bootstrap color: primary, success, warning...
])

<div {{ $attributes->merge(['class' => "card text-{$color} border-0 dashboard-card"]) }}>
  <div class="card-body d-flex align-items-center">
    <i class="bi {{ $icon }} fs-1 me-3"></i>
    <div>
      <h6 class="card-title text-uppercase">{{ $title }}</h6>
      <p class="fs-3 fw-bold mb-0">{{ $value }}</p>
    </div>
  </div>
</div>