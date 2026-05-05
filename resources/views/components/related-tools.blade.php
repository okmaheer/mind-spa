@props(['tools' => [], 'heading' => 'Related Tools'])

@if(count($tools))
<section class="ms-section-related">
  <div class="container-xl">
    <h2 class="mb-4 ms-related-h2">{{ $heading }}</h2>
    <div class="row g-3">
      @foreach($tools as $tool)
      <div class="col-sm-6 col-lg-3">
        <a href="{{ url($tool['slug'] ?? '/') }}"
           class="tool-card d-flex align-items-center gap-3 p-3 text-decoration-none h-100 ms-tool-link">
          <span class="ms-related-icon">{{ $tool['icon'] ?? '🔧' }}</span>
          <div>
            <div class="ms-related-label">{{ $tool['name'] }}</div>
            <div class="ms-related-desc">{{ $tool['desc'] ?? ($tool['description'] ?? '') }}</div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endif
