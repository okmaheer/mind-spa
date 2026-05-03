@props(['tools' => [], 'heading' => 'Related Tools You Might Like'])

@if(count($tools))
<section style="padding:60px 0; background:var(--bg);">
  <div class="container">
    <h2 class="mb-4">{{ $heading }}</h2>
    <div class="row g-4">
      @foreach($tools as $tool)
      <div class="col-12 col-md-6 col-lg-4">
        <div class="card tool-card h-100" style="border-left:4px solid var(--{{ $tool['category'] ?? 'sleep' }});">
          <div class="card-body p-4">
            <span style="font-size:2rem;">{{ $tool['icon'] ?? '🔧' }}</span>
            <h3 class="h6 mt-2 mb-1">
              <a href="{{ url($tool['slug']) }}" style="color:var(--primary-dark); font-weight:700;">{{ $tool['name'] }}</a>
            </h3>
            <p class="text-muted small mb-3">{{ Str::limit($tool['description'] ?? '', 80) }}</p>
            <a href="{{ url($tool['slug']) }}" class="btn btn-cta btn-sm w-100">Use Free Tool →</a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endif
