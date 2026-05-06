<footer class="ms-footer" role="contentinfo">
  <div class="container-xl">
    <div class="row g-5">

      {{-- Col 1: Brand --}}
      <div class="col-12 col-md-6 col-lg-3">
        <a href="{{ route('home') }}" class="ms-footer-brand d-flex align-items-center gap-2 mb-3 text-decoration-none">
          <svg width="26" height="26" viewBox="0 0 28 28" fill="none" aria-hidden="true">
            <circle cx="14" cy="14" r="13" stroke="#e94560" stroke-width="2"/>
            <path d="M9 14c0-2.76 2.24-5 5-5s5 2.24 5 5" stroke="#fff" stroke-width="2" stroke-linecap="round"/>
            <circle cx="11" cy="16" r="1.5" fill="#e94560"/>
            <circle cx="17" cy="16" r="1.5" fill="#e94560"/>
          </svg>
          <span class="fw-700 fs-5">MindSnap</span>
        </a>
        <p class="ms-footer-desc">
          Free health calculators, sleep tools, and brain games for everyone.
          No signup. No fees. Works worldwide.
        </p>
        <div class="d-flex gap-2 flex-wrap mt-3">
          <span class="badge ms-footer-badge">✓ 100% Free</span>
          <span class="badge ms-footer-badge">✓ No Signup</span>
          <span class="badge ms-footer-badge">✓ 190+ Countries</span>
        </div>
      </div>

      {{-- Col 2: Health Tools --}}
      <div class="col-6 col-lg-3">
        <p class="text-white fw-700 mb-3 ms-footer-col-heading">Health Tools</p>
        <ul class="list-unstyled ms-footer-list">
          @foreach([
            ['Sleep Calculator', '/sleep-calculator'],
            ['BMI Calculator',   '/bmi-calculator'],
            ['TDEE Calculator',  '/calorie-calculator'],
            ['Water Intake',     '/water-intake-calculator'],
            ['Protein Intake',   '/protein-calculator'],
            ['Body Fat %',       '/body-fat-calculator'],
            ['All Sleep Tools',  '/sleep-tools'],
            ['All Fitness Tools','/fitness-tools'],
          ] as [$label, $href])
          <li class="mb-2">
            <a href="{{ $href }}" class="ms-footer-link">{{ $label }}</a>
          </li>
          @endforeach
        </ul>
      </div>

      {{-- Col 3: Games --}}
      <div class="col-6 col-lg-3">
        <p class="text-white fw-700 mb-3 ms-footer-col-heading">Brain Games</p>
        <ul class="list-unstyled ms-footer-list">
          @foreach([
            ['Typing Speed Test', '/typing-speed-test'],
            ['Reaction Time',     '/reaction-time-test'],
            ['Memory Test',       '/memory-test'],
            ['Word Scramble',     '/word-scramble'],
            ['Colour Blind Test', '/color-blind-test'],
            ['All Games',         '/games'],
          ] as [$label, $href])
          <li class="mb-2">
            <a href="{{ $href }}" class="ms-footer-link">{{ $label }}</a>
          </li>
          @endforeach
        </ul>
      </div>

      {{-- Col 4: Company --}}
      <div class="col-12 col-md-6 col-lg-3">
        <p class="text-white fw-700 mb-3 ms-footer-col-heading">Company</p>
        <ul class="list-unstyled ms-footer-list">
          @foreach([
            ['About MindSnap',   '/about'],
            ['Privacy Policy',   '/privacy'],
            ['Sitemap',          '/sitemap.xml'],
            ['Kids Zone',        '/kids'],
            ['Life Tools',       '/life-tools'],
          ] as [$label, $href])
          <li class="mb-2">
            <a href="{{ $href }}" class="ms-footer-link">{{ $label }}</a>
          </li>
          @endforeach
        </ul>
        <div class="mt-3 p-3 rounded ms-footer-kids-box">
          <span class="ms-footer-kids-label">👶 Safe for Kids</span>
          <p class="ms-footer-kids-text">
            Kids Zone has no ads, no data collection, no accounts required.
          </p>
        </div>
      </div>

    </div>

    {{-- Bottom bar --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center py-4 mt-5 ms-footer-bottom">
      <p class="ms-footer-copy">
        © {{ date('Y') }} MindSnap.co — All rights reserved.
      </p>
      <div class="d-flex flex-wrap gap-2">
        @foreach(config('mindsnap.categories') as $key => $cat)
        <a href="{{ url($cat['slug']) }}" class="badge text-decoration-none ms-footer-cat-badge">
          {{ $cat['icon'] }} {{ $cat['label'] }}
        </a>
        @endforeach
      </div>
    </div>

  </div>
</footer>
