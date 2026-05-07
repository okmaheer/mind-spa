@php
  $navTools   = \App\Models\Tool::allForNav();
  $categories = config('mindsnap.categories');

  // Detect category context from the current URL segment
  $slug = request()->segment(1) ?? '';
  $currentCategoryKey = null;

  // 1. Category page? (e.g. /sleep-tools)
  foreach ($categories as $key => $cat) {
      if ($cat['slug'] === $slug) {
          $currentCategoryKey = $key;
          break;
      }
  }

  // 2. Tool page? — check cached nav tools first
  if (!$currentCategoryKey && $slug) {
      foreach ($navTools as $catKey => $tools) {
          foreach ($tools as $t) {
              if ($t['slug'] === $slug) {
                  $currentCategoryKey = $catKey;
                  break 2;
              }
          }
      }
      // Fallback for tools not in nav (show_in_nav = false)
      if (!$currentCategoryKey) {
          $toolCat = \App\Models\Tool::where('slug', $slug)->value('category');
          if ($toolCat && isset($categories[$toolCat])) {
              $currentCategoryKey = $toolCat;
          }
      }
  }

  $contextualCat   = $currentCategoryKey ? $categories[$currentCategoryKey] : null;
  $contextualTools = $currentCategoryKey ? \App\Models\Tool::forCategory($currentCategoryKey) : [];
@endphp

<nav class="sticky-top ms-navbar" aria-label="Main navigation">
  <div class="container-xl d-flex align-items-center ms-navbar-inner gap-2">

    {{-- Logo — always visible --}}
    <a href="{{ route('home') }}"
       class="ms-navbar-logo d-flex align-items-center gap-2 text-decoration-none flex-shrink-0">
      <svg width="26" height="26" viewBox="0 0 28 28" fill="none" aria-hidden="true">
        <circle cx="14" cy="14" r="13" stroke="#e94560" stroke-width="2"/>
        <path d="M9 14c0-2.76 2.24-5 5-5s5 2.24 5 5" stroke="#fff" stroke-width="2" stroke-linecap="round"/>
        <circle cx="11" cy="16" r="1.5" fill="#e94560"/>
        <circle cx="17" cy="16" r="1.5" fill="#e94560"/>
        <path d="M11 19.5c.8.7 1.9 1 3 1s2.2-.3 3-1" stroke="#fff" stroke-width="1.5" stroke-linecap="round"/>
      </svg>
      <span class="d-none d-sm-inline">MindSnap</span>
    </a>

    @if($contextualCat)
    {{-- ── CONTEXTUAL NAV ─────────────────────────────────────────────────────── --}}

      {{-- Separator --}}
      <div class="ms-ctx-sep d-none d-md-block"></div>

      {{-- Category label links back to the category page --}}
      <a href="{{ url($contextualCat['slug']) }}" class="ms-ctx-cat-label d-none d-md-flex">
        {{ $contextualCat['icon'] }}
        <span class="d-none d-lg-inline">{{ $contextualCat['label'] }}</span>
      </a>

      {{-- Separator --}}
      <div class="ms-ctx-sep d-none d-xl-block"></div>

      {{-- Scrollable tool strip — desktop only --}}
      <div class="ms-ctx-tools-scroll d-none d-xl-block">
        <div class="ms-ctx-tools-inner">
          @foreach($contextualTools as $tool)
          <a href="{{ url($tool['slug']) }}"
             class="ms-ctx-tool-link{{ request()->segment(1) === $tool['slug'] ? ' ms-ctx-active' : '' }}">
            {{ $tool['icon'] ?? '' }} {{ $tool['name'] }}
          </a>
          @endforeach
        </div>
      </div>

    @else
    {{-- ── GLOBAL NAV ─────────────────────────────────────────────────────────── --}}

      <ul class="d-none d-xl-flex align-items-center m-0 p-0 ms-nav-ul">
        @foreach($categories as $key => $cat)
        <li class="ms-nav-item">
          <a href="{{ url($cat['slug']) }}" class="ms-nav-link">
            <span>{{ $cat['icon'] }} {{ $cat['label'] }}</span>
            <svg class="chevron" viewBox="0 0 24 24" aria-hidden="true">
              <polyline points="6 9 12 15 18 9"/>
            </svg>
          </a>

          <div class="ms-dropdown">
            <div class="ms-dropdown-header d-flex align-items-center gap-2 mb-2 pb-2">
              <span class="ms-dropdown-header-icon">{{ $cat['icon'] }}</span>
              <div class="ms-dropdown-header-label">{{ $cat['label'] }}</div>
              <a href="{{ url($cat['slug']) }}" class="ms-see-all ms-auto">
                See all <svg width="10" height="10" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><polyline points="9 18 15 12 9 6"/></svg>
              </a>
            </div>

            @if(!empty($navTools[$key]))
            <div class="ms-dropdown-tools-grid">
              @foreach($navTools[$key] as $tool)
              <a href="{{ url($tool['slug']) }}" class="ms-tool-link">
                <span class="t-icon">{{ $tool['icon'] ?? '🔧' }}</span>
                <div>
                  <div class="t-name">{{ $tool['name'] }}</div>
                  @if(!empty($tool['description']))
                  <div class="t-desc">{{ Str::limit($tool['description'], 44) }}</div>
                  @endif
                </div>
              </a>
              @endforeach
            </div>
            @else
            <p class="ms-dropdown-empty">Coming soon.</p>
            @endif
          </div>
        </li>
        @endforeach
      </ul>

    @endif

    {{-- All Categories dropdown — contextual nav only --}}
    @if($contextualCat)
    <div class="dropdown shrink-0 d-none d-md-block">
      <button class="ms-cats-btn dropdown-toggle-no-caret border-0"
              type="button"
              data-bs-toggle="dropdown"
              data-bs-auto-close="true"
              aria-expanded="false"
              aria-label="Browse all categories">
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
          <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
          <rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
        </svg>
        <span class="d-none d-lg-inline">Categories</span>
      </button>
      <ul class="dropdown-menu ms-cats-dropdown">
        <li><div class="ms-cats-dropdown-hdr">All Categories</div></li>
        @foreach($categories as $key => $cat)
        <li>
          <a href="{{ url($cat['slug']) }}"
             class="ms-cats-dropdown-item{{ $key === $currentCategoryKey ? ' ms-cats-current' : '' }}">
            <span class="ms-cats-item-icon">{{ $cat['icon'] }}</span>
            {{ $cat['label'] }}
            @if($key === $currentCategoryKey)
            <svg class="ms-auto" width="12" height="12" fill="none" stroke="#6c63ff" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
            @endif
          </a>
        </li>
        @endforeach
      </ul>
    </div>
    @endif

    {{-- Right: Search + Hamburger — always visible --}}
    <div class="d-flex align-items-center gap-1 shrink-0 ms-auto">
      <button type="button"
              class="btn btn-link p-2 ms-nav-icon-btn"
              data-bs-toggle="modal"
              data-bs-target="#searchModal"
              aria-label="Search tools">
        <svg width="19" height="19" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
          <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
      </button>

      <button class="btn btn-link p-2 d-xl-none ms-nav-icon-btn"
              type="button"
              data-bs-toggle="offcanvas"
              data-bs-target="#mobileMenu"
              aria-label="Open menu">
        <svg width="21" height="21" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
          <line x1="3" y1="6"  x2="21" y2="6"/>
          <line x1="3" y1="12" x2="21" y2="12"/>
          <line x1="3" y1="18" x2="21" y2="18"/>
        </svg>
      </button>
    </div>

  </div>
</nav>

{{-- ── Mobile Offcanvas ──────────────────────────────────────────────────────── --}}
<div class="offcanvas offcanvas-start ms-offcanvas" tabindex="-1" id="mobileMenu">
  <div class="offcanvas-header ms-offcanvas-header">
    <div class="d-flex align-items-center gap-2 ms-offcanvas-logo">
      <svg width="22" height="22" viewBox="0 0 28 28" fill="none" aria-hidden="true">
        <circle cx="14" cy="14" r="13" stroke="#e94560" stroke-width="2"/>
        <path d="M9 14c0-2.76 2.24-5 5-5s5 2.24 5 5" stroke="#fff" stroke-width="2" stroke-linecap="round"/>
        <circle cx="11" cy="16" r="1.5" fill="#e94560"/>
        <circle cx="17" cy="16" r="1.5" fill="#e94560"/>
      </svg>
      MindSnap
    </div>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>

  <div class="offcanvas-body p-0 overflow-auto">
    @if($contextualCat)
    {{-- ── Contextual mobile menu ──────────────────────────────────────────── --}}
      <a href="{{ route('home') }}" class="ms-mobile-back-link" data-bs-dismiss="offcanvas">
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><polyline points="15 18 9 12 15 6"/></svg>
        All Categories
      </a>

      <div class="ms-offcanvas-cat-hdr">{{ $contextualCat['icon'] }} {{ $contextualCat['label'] }}</div>

      @foreach($contextualTools as $tool)
      <a href="{{ url($tool['slug']) }}"
         class="d-flex align-items-center gap-2 px-4 py-2 text-decoration-none ms-mobile-tool-link{{ request()->segment(1) === $tool['slug'] ? ' ms-mobile-tool-active' : '' }}"
         data-bs-dismiss="offcanvas">
        <span class="ms-mobile-tool-icon">{{ $tool['icon'] ?? '' }}</span>
        {{ $tool['name'] }}
      </a>
      @endforeach

    @else
    {{-- ── Global mobile menu (accordion) ─────────────────────────────────── --}}
      <div class="accordion accordion-flush" id="mobileNav">
        @foreach($categories as $key => $cat)
        <div class="accordion-item ms-mobile-nav-item">
          <div class="accordion-header d-flex align-items-center">
            <button class="accordion-button collapsed grow ms-mobile-nav-btn"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#mob-{{ $key }}">
              {{ $cat['icon'] }} {{ $cat['label'] }}
            </button>
            <a href="{{ url($cat['slug']) }}"
               class="px-3 py-3 text-decoration-none ms-mobile-see-all"
               data-bs-dismiss="offcanvas">
              All →
            </a>
          </div>
          <div id="mob-{{ $key }}" class="accordion-collapse collapse">
            <div class="px-3 pb-2">
              @foreach($navTools[$key] ?? [] as $tool)
              <a href="{{ url($tool['slug']) }}"
                 class="d-flex align-items-center gap-2 py-2 text-decoration-none ms-mobile-tool-link"
                 data-bs-dismiss="offcanvas">
                <span class="ms-mobile-tool-icon">{{ $tool['icon'] ?? '' }}</span>
                {{ $tool['name'] }}
              </a>
              @endforeach
            </div>
          </div>
        </div>
        @endforeach
      </div>
    @endif
  </div>
</div>

{{-- ── Search Modal ─────────────────────────────────────────────────────────── --}}
<div class="modal fade" id="searchModal" tabindex="-1" aria-label="Search" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 ms-search-modal">
      <div class="modal-body p-4">
        <div class="d-flex align-items-center gap-3 mb-3">
          <svg width="20" height="20" fill="none" stroke="#aaa" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
            <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
          </svg>
          <input type="text"
                 id="searchInput"
                 class="form-control border-0 shadow-none ms-search-input"
                 placeholder="Search tools, quizzes, games…"
                 autocomplete="off"
                 aria-label="Search">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="ms-divider mb-3"></div>
        <div id="searchResults" class="ms-search-results" aria-live="polite"></div>
        <p id="searchEmpty" class="text-center text-muted small mt-3 d-none">Nothing found. Try a different word.</p>
      </div>
    </div>
  </div>
</div>

<script>
(function () {
  const tools = @json(\App\Models\Tool::allForSearch());
  const input = document.getElementById('searchInput');
  const box   = document.getElementById('searchResults');
  const empty = document.getElementById('searchEmpty');

  if (!input) return;

  document.getElementById('searchModal')?.addEventListener('shown.bs.modal', function () {
    input.value = '';
    box.innerHTML = '';
    empty.classList.add('d-none');
    input.focus();
  });

  input.addEventListener('input', function () {
    const q = this.value.toLowerCase().trim();
    box.innerHTML = '';
    empty.classList.add('d-none');

    if (q.length < 2) return;

    const matches = tools.filter(function (t) {
      return t.name.toLowerCase().includes(q) ||
             (t.description || '').toLowerCase().includes(q);
    }).slice(0, 8);

    if (!matches.length) { empty.classList.remove('d-none'); return; }

    box.innerHTML = matches.map(function (t) {
      return '<a href="/' + t.slug + '" class="ms-search-result">' +
        '<span class="ms-search-result-icon">' + (t.icon || '🔧') + '</span>' +
        '<div class="ms-search-result-info">' +
          '<div class="ms-search-result-name">' + t.name + '</div>' +
          '<div class="ms-search-result-desc">' + (t.description || '') + '</div>' +
        '</div>' +
        '<span class="ms-search-result-cat">' + t.category + '</span>' +
      '</a>';
    }).join('');
  });
})();
</script>
