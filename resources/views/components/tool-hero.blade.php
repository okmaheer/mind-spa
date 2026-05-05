@props([
    'title',
    'description',
    'badge',
    'badgeColor' => 'sleep',  {{-- sleep | fitness | nutrition | life | quiz | kids | games --}}
    'icon'       => '',
    'crumbs'     => [],
    'slot',
])

<section class="ms-hero">
  <div class="container-xl">
    <div class="row align-items-end g-4">
      <div class="col-lg-8">

        {{-- Breadcrumb --}}
        <x-breadcrumb :crumbs="$crumbs" />

        {{-- Badge + Title --}}
        <div class="d-flex align-items-center gap-3 mb-3">
          @if($icon)
          <span class="ms-hero-icon" aria-hidden="true">{{ $icon }}</span>
          @endif
          <span class="badge ms-badge ms-badge-{{ $badgeColor }}">{{ $badge }}</span>
        </div>

        <h1 class="ms-hero-title">{{ $title }}</h1>
        <p class="ms-hero-desc">{{ $description }}</p>
      </div>

      {{-- Optional right-column slot (quick-facts, stat box, etc.) --}}
      @if(!$slot->isEmpty())
      <div class="col-lg-4 d-none d-lg-block">
        {{ $slot }}
      </div>
      @endif
    </div>

    {{-- Tool card overlapping next section --}}
    <div class="row mt-4">
      <div class="col-12">
        {{ $tool ?? '' }}
      </div>
    </div>
  </div>
</section>
