@php
  $navTools   = \App\Models\Tool::allForNav();
  $categories = config('mindsnap.categories');
@endphp

<style>
/* ── Hover dropdown ────────────────────────────────────────────────────────── */
.ms-nav-item { position: relative; }

.ms-nav-item > .ms-nav-link {
  display: flex;
  align-items: center;
  gap: 4px;
  padding: 8px 14px;
  color: rgba(255,255,255,.82);
  font-size: .875rem;
  font-weight: 500;
  text-decoration: none;
  border-radius: 6px;
  white-space: nowrap;
  transition: color .15s, background .15s;
  cursor: pointer;
}
.ms-nav-item > .ms-nav-link:hover,
.ms-nav-item:hover > .ms-nav-link {
  color: #fff;
  background: rgba(255,255,255,.08);
}

/* Chevron */
.ms-nav-link .chevron {
  width: 12px; height: 12px;
  stroke: currentColor; stroke-width: 2.5;
  fill: none; flex-shrink: 0;
  transition: transform .2s;
}
.ms-nav-item:hover .chevron { transform: rotate(180deg); }

/* Dropdown panel */
.ms-dropdown {
  position: absolute;
  top: calc(100% + 6px);
  left: 50%;
  transform: translateX(-50%);
  min-width: 360px;
  max-width: 420px;
  width: max-content;
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 10px 40px rgba(0,0,0,.13);
  padding: 14px;
  opacity: 0;
  visibility: hidden;
  pointer-events: none;
  transition: opacity .18s, transform .18s;
  transform: translateX(-50%) translateY(6px);
  z-index: 1050;
}
.ms-nav-item:hover .ms-dropdown {
  opacity: 1;
  visibility: visible;
  pointer-events: auto;
  transform: translateX(-50%) translateY(0);
}

/* Keep open when mouse moves into the panel */
.ms-dropdown::before {
  content: '';
  position: absolute;
  top: -10px; left: 0; right: 0;
  height: 10px;
}

/* Tool link inside dropdown */
.ms-tool-link {
  display: flex;
  align-items: center;
  gap: 7px;
  padding: 6px 8px;
  border-radius: 6px;
  text-decoration: none;
  transition: background .12s;
}
.ms-tool-link:hover { background: #f5f6f8; }
.ms-tool-link .t-icon { font-size: 1rem; line-height: 1; flex-shrink: 0; }
.ms-tool-link .t-name { font-size: .8rem; font-weight: 600; color: #1a1a2e; line-height: 1.2; }
.ms-tool-link .t-desc { font-size: .7rem; color: #999; margin-top: 1px; }

/* Category footer link */
.ms-see-all {
  display: inline-flex;
  align-items: center;
  gap: 4px;
  font-size: .8rem;
  font-weight: 600;
  color: var(--primary-cta);
  text-decoration: none;
  margin-top: 4px;
}
.ms-see-all:hover { text-decoration: underline; }
</style>

<nav class="sticky-top" style="background:var(--primary-dark); z-index:1040;" aria-label="Main navigation">
  <div class="container-xl d-flex align-items-center justify-content-between" style="height:60px;">

    {{-- Logo --}}
    <a href="{{ route('home') }}"
       class="d-flex align-items-center gap-2 text-decoration-none flex-shrink-0"
       style="color:#fff; font-weight:700; font-size:1.1rem;">
      <svg width="26" height="26" viewBox="0 0 28 28" fill="none" aria-hidden="true">
        <circle cx="14" cy="14" r="13" stroke="#e94560" stroke-width="2"/>
        <path d="M9 14c0-2.76 2.24-5 5-5s5 2.24 5 5" stroke="#fff" stroke-width="2" stroke-linecap="round"/>
        <circle cx="11" cy="16" r="1.5" fill="#e94560"/>
        <circle cx="17" cy="16" r="1.5" fill="#e94560"/>
        <path d="M11 19.5c.8.7 1.9 1 3 1s2.2-.3 3-1" stroke="#fff" stroke-width="1.5" stroke-linecap="round"/>
      </svg>
      MindSnap
    </a>

    {{-- Desktop nav — categories with hover dropdowns --}}
    <ul class="d-none d-xl-flex align-items-center m-0 p-0" style="list-style:none; gap:2px;">
      @foreach($categories as $key => $cat)
      <li class="ms-nav-item">
        <a href="{{ url($cat['slug']) }}" class="ms-nav-link">
          <span>{{ $cat['icon'] }} {{ $cat['label'] }}</span>
          <svg class="chevron" viewBox="0 0 24 24" aria-hidden="true">
            <polyline points="6 9 12 15 18 9"/>
          </svg>
        </a>

        {{-- Mega dropdown --}}
        <div class="ms-dropdown">
          {{-- Category header --}}
          <div class="d-flex align-items-center gap-2 mb-2 pb-2" style="border-bottom:1px solid #f0f0f0;">
            <span style="font-size:1.1rem;">{{ $cat['icon'] }}</span>
            <div style="font-weight:700; font-size:.85rem; color:#1a1a2e;">{{ $cat['label'] }}</div>
            <a href="{{ url($cat['slug']) }}" class="ms-see-all ms-auto">
              See all <svg width="10" height="10" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true"><polyline points="9 18 15 12 9 6"/></svg>
            </a>
          </div>

          {{-- Tools grid --}}
          @if(!empty($navTools[$key]))
          <div style="display:grid; grid-template-columns:repeat(2,1fr); gap:2px;">
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
          <p style="color:#888; font-size:.85rem; margin:0;">Coming soon.</p>
          @endif
        </div>
      </li>
      @endforeach
    </ul>

    {{-- Right: Search + hamburger --}}
    <div class="d-flex align-items-center gap-1 flex-shrink-0">
      <button type="button"
              class="btn btn-link p-2"
              style="color:rgba(255,255,255,.8);"
              data-bs-toggle="modal"
              data-bs-target="#searchModal"
              aria-label="Search tools">
        <svg width="19" height="19" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
          <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
      </button>

      {{-- Hamburger — visible below xl --}}
      <button class="btn btn-link p-2 d-xl-none"
              style="color:rgba(255,255,255,.8);"
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
<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileMenu"
     style="background:var(--primary-dark); max-width:300px; border-right:1px solid rgba(255,255,255,.08);">
  <div class="offcanvas-header" style="border-bottom:1px solid rgba(255,255,255,.1); padding:16px 20px;">
    <div class="d-flex align-items-center gap-2" style="color:#fff; font-weight:700; font-size:1rem;">
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

  <div class="offcanvas-body p-0" style="overflow-y:auto;">
    {{-- Accordion per category --}}
    <div class="accordion accordion-flush" id="mobileNav">
      @foreach($categories as $key => $cat)
      <div class="accordion-item" style="background:transparent; border:none; border-bottom:1px solid rgba(255,255,255,.07);">
        <div class="accordion-header d-flex align-items-center">
          <button class="accordion-button collapsed flex-grow-1"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#mob-{{ $key }}"
                  style="background:transparent; color:rgba(255,255,255,.85); font-weight:600;
                         font-size:.88rem; box-shadow:none; padding:13px 20px; gap:8px;">
            {{ $cat['icon'] }} {{ $cat['label'] }}
          </button>
          <a href="{{ url($cat['slug']) }}"
             class="px-3 py-3 text-decoration-none"
             style="color:rgba(255,255,255,.4); font-size:.7rem; white-space:nowrap;"
             data-bs-dismiss="offcanvas">
            All →
          </a>
        </div>
        <div id="mob-{{ $key }}" class="accordion-collapse collapse">
          <div class="pb-2" style="padding-left:20px; padding-right:20px;">
            @foreach($navTools[$key] ?? [] as $tool)
            <a href="{{ url($tool['slug']) }}"
               class="d-flex align-items-center gap-2 py-2 text-decoration-none"
               style="color:rgba(255,255,255,.7); font-size:.84rem; border-bottom:1px solid rgba(255,255,255,.04);"
               data-bs-dismiss="offcanvas">
              <span style="font-size:1rem;">{{ $tool['icon'] ?? '' }}</span>
              {{ $tool['name'] }}
            </a>
            @endforeach
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>

{{-- ── Search Modal ─────────────────────────────────────────────────────────── --}}
<div class="modal fade" id="searchModal" tabindex="-1" aria-label="Search" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0" style="border-radius:16px; box-shadow:0 20px 60px rgba(0,0,0,.18);">
      <div class="modal-body p-4">
        <div class="d-flex align-items-center gap-3 mb-3">
          <svg width="20" height="20" fill="none" stroke="#aaa" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
            <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
          </svg>
          <input type="text"
                 id="searchInput"
                 class="form-control border-0 shadow-none"
                 placeholder="Search tools, quizzes, games…"
                 autocomplete="off"
                 aria-label="Search"
                 style="font-size:1.05rem; padding:0;">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div style="height:1px; background:#f0f0f0; margin-bottom:12px;"></div>
        <div id="searchResults" style="max-height:380px; overflow-y:auto;" aria-live="polite"></div>
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

  // Re-focus when modal opens
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
      return '<a href="/' + t.slug + '" class="d-flex align-items-center gap-3 p-3 rounded text-decoration-none mb-1" style="color:var(--text); background:#f8f9fa; border-radius:8px !important;">' +
        '<span style="font-size:1.4rem; line-height:1;">' + (t.icon || '🔧') + '</span>' +
        '<div style="min-width:0;">' +
          '<div style="font-weight:600; color:#1a1a2e; font-size:.9rem;">' + t.name + '</div>' +
          '<div style="font-size:.78rem; color:#888; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">' + (t.description || '') + '</div>' +
        '</div>' +
        '<span style="margin-left:auto; font-size:.72rem; color:var(--primary-cta); text-transform:capitalize; flex-shrink:0;">' + t.category + '</span>' +
      '</a>';
    }).join('');
  });
})();
</script>
