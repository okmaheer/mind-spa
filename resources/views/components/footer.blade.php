<footer style="background:var(--primary-dark); color:rgba(255,255,255,.8); padding:60px 0 0; border-top:3px solid var(--primary-cta);" role="contentinfo">
  <div class="container-xl">
    <div class="row g-5">

      {{-- Col 1: Brand --}}
      <div class="col-12 col-md-6 col-lg-3">
        <a href="{{ route('home') }}" class="d-flex align-items-center gap-2 mb-3 text-decoration-none" style="color:#fff;">
          <svg width="26" height="26" viewBox="0 0 28 28" fill="none" aria-hidden="true">
            <circle cx="14" cy="14" r="13" stroke="#e94560" stroke-width="2"/>
            <path d="M9 14c0-2.76 2.24-5 5-5s5 2.24 5 5" stroke="#fff" stroke-width="2" stroke-linecap="round"/>
            <circle cx="11" cy="16" r="1.5" fill="#e94560"/>
            <circle cx="17" cy="16" r="1.5" fill="#e94560"/>
          </svg>
          <span class="fw-700 fs-5">MindSnap</span>
        </a>
        <p style="font-size:.88rem; color:rgba(255,255,255,.6); line-height:1.7;">
          Free health calculators, sleep tools, and brain quizzes for everyone.
          No signup. No fees. Works worldwide.
        </p>
        <div class="d-flex gap-2 flex-wrap mt-3">
          <span class="badge" style="background:rgba(255,255,255,.1); color:rgba(255,255,255,.8); border-radius:50px; font-size:.75rem;">✓ 100% Free</span>
          <span class="badge" style="background:rgba(255,255,255,.1); color:rgba(255,255,255,.8); border-radius:50px; font-size:.75rem;">✓ No Signup</span>
          <span class="badge" style="background:rgba(255,255,255,.1); color:rgba(255,255,255,.8); border-radius:50px; font-size:.75rem;">✓ 190+ Countries</span>
        </div>
      </div>

      {{-- Col 2: Health Tools --}}
      <div class="col-6 col-lg-3">
        <p class="text-white fw-700 mb-3" style="font-size:.9rem; letter-spacing:.5px; text-transform:uppercase;">Health Tools</p>
        <ul class="list-unstyled" style="font-size:.875rem;">
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
            <a href="{{ $href }}" style="color:rgba(255,255,255,.7); transition:color .15s;"
               onmouseover="this.style.color='#e94560'"
               onmouseout="this.style.color='rgba(255,255,255,.7)'">{{ $label }}</a>
          </li>
          @endforeach
        </ul>
      </div>

      {{-- Col 3: Quizzes & Games --}}
      <div class="col-6 col-lg-3">
        <p class="text-white fw-700 mb-3" style="font-size:.9rem; letter-spacing:.5px; text-transform:uppercase;">Quizzes & Games</p>
        <ul class="list-unstyled" style="font-size:.875rem;">
          @foreach([
            ['GK Quiz',           '/quiz/general-knowledge'],
            ['History Quiz',      '/quiz/history'],
            ['IQ Test',           '/iq-test'],
            ['Biology Quiz',      '/quiz/biology'],
            ['Word Scramble',      '/word-scramble'],
            ['Typing Speed Test', '/typing-speed-test'],
            ['Reaction Time',     '/reaction-time-test'],
            ['Memory Test',       '/memory-test'],
          ] as [$label, $href])
          <li class="mb-2">
            <a href="{{ $href }}" style="color:rgba(255,255,255,.7); transition:color .15s;"
               onmouseover="this.style.color='#e94560'"
               onmouseout="this.style.color='rgba(255,255,255,.7)'">{{ $label }}</a>
          </li>
          @endforeach
        </ul>
      </div>

      {{-- Col 4: Company --}}
      <div class="col-12 col-md-6 col-lg-3">
        <p class="text-white fw-700 mb-3" style="font-size:.9rem; letter-spacing:.5px; text-transform:uppercase;">Company</p>
        <ul class="list-unstyled" style="font-size:.875rem;">
          @foreach([
            ['About MindSnap',   '/about'],
            ['Privacy Policy',   '/privacy'],
            ['Sitemap',          '/sitemap.xml'],
            ['Kids Zone',        '/kids'],
            ['Life Tools',       '/life-tools'],
          ] as [$label, $href])
          <li class="mb-2">
            <a href="{{ $href }}" style="color:rgba(255,255,255,.7); transition:color .15s;"
               onmouseover="this.style.color='#e94560'"
               onmouseout="this.style.color='rgba(255,255,255,.7)'">{{ $label }}</a>
          </li>
          @endforeach
        </ul>
        <div class="mt-3 p-3 rounded" style="background:rgba(23,162,184,.15); border:1px solid rgba(23,162,184,.3);">
          <span style="font-size:.82rem; color:#17a2b8; font-weight:600;">👶 Safe for Kids</span>
          <p style="font-size:.78rem; color:rgba(255,255,255,.6); margin:4px 0 0;">
            Kids Zone has no ads, no data collection, no accounts required.
          </p>
        </div>
      </div>

    </div>

    {{-- Bottom bar --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center py-4 mt-5"
         style="border-top:1px solid rgba(255,255,255,.1); gap:12px;">
      <p style="font-size:.82rem; color:rgba(255,255,255,.4); margin:0;">
        © {{ date('Y') }} MindSnap.co — All rights reserved.
      </p>
      <div class="d-flex flex-wrap gap-2">
        @foreach(config('mindsnap.categories') as $key => $cat)
        <a href="{{ url($cat['slug']) }}"
           class="badge text-decoration-none"
           style="background:rgba(255,255,255,.08); color:rgba(255,255,255,.6); border-radius:50px; font-size:.72rem; padding:4px 10px;"
           onmouseover="this.style.background='rgba(233,69,96,.2)'; this.style.color='#e94560';"
           onmouseout="this.style.background='rgba(255,255,255,.08)'; this.style.color='rgba(255,255,255,.6)';">
          {{ $cat['icon'] }} {{ $cat['label'] }}
        </a>
        @endforeach
      </div>
    </div>

  </div>
</footer>
