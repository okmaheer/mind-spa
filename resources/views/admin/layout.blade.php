<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex, nofollow">
  <title>@yield('title', 'Admin') — MindSnap Admin</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <style>
    :root {
      --admin-sidebar-width: 240px;
      --admin-header-height: 56px;
      --admin-dark: #1a1a2e;
      --admin-dark2: #16213e;
      --admin-accent: #e94560;
    }

    body {
      background: #f4f6f9;
      min-height: 100vh;
    }

    /* ── Header ────────────────────────────────── */
    .admin-header {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      height: var(--admin-header-height);
      background: var(--admin-dark);
      z-index: 1030;
      display: flex;
      align-items: center;
      padding: 0 1.25rem;
      gap: 1rem;
    }

    .admin-header .brand {
      font-weight: 800;
      font-size: 1rem;
      color: #fff;
      letter-spacing: .02em;
      white-space: nowrap;
    }

    .admin-header .brand span {
      color: var(--admin-accent);
    }

    .admin-header .spacer { flex: 1; }

    .admin-user-email {
      font-size: .82rem;
      color: #aaa;
    }

    /* ── Sidebar ────────────────────────────────── */
    .admin-sidebar {
      position: fixed;
      top: var(--admin-header-height);
      left: 0;
      bottom: 0;
      width: var(--admin-sidebar-width);
      background: var(--admin-dark2);
      overflow-y: auto;
      z-index: 1020;
      padding: 1.5rem 0;
    }

    .admin-sidebar .nav-section-label {
      font-size: .7rem;
      font-weight: 700;
      letter-spacing: .1em;
      text-transform: uppercase;
      color: #555;
      padding: .5rem 1.25rem .25rem;
    }

    .admin-sidebar .nav-link {
      display: flex;
      align-items: center;
      gap: .75rem;
      padding: .6rem 1.25rem;
      color: #aaa;
      font-size: .9rem;
      font-weight: 500;
      border-left: 3px solid transparent;
      transition: background .15s, color .15s, border-color .15s;
    }

    .admin-sidebar .nav-link:hover {
      background: rgba(255,255,255,.05);
      color: #fff;
    }

    .admin-sidebar .nav-link.active {
      background: rgba(233,69,96,.1);
      color: #fff;
      border-left-color: var(--admin-accent);
    }

    .admin-sidebar .nav-link .nav-icon {
      font-size: 1.1rem;
      width: 1.4rem;
      text-align: center;
    }

    .admin-sidebar hr {
      border-color: rgba(255,255,255,.07);
      margin: .75rem 1.25rem;
    }

    .admin-sidebar .nav-link.disabled-future {
      opacity: .35;
      cursor: default;
      pointer-events: none;
      font-style: italic;
    }

    /* ── Content ────────────────────────────────── */
    .admin-content {
      margin-left: var(--admin-sidebar-width);
      margin-top: var(--admin-header-height);
      padding: 2rem;
      min-height: calc(100vh - var(--admin-header-height));
    }

    /* ── Responsive: collapse sidebar on mobile ── */
    @media (max-width: 768px) {
      .admin-sidebar {
        transform: translateX(-100%);
        transition: transform .25s ease;
      }
      .admin-sidebar.show {
        transform: translateX(0);
      }
      .admin-content {
        margin-left: 0;
      }
    }
  </style>
  @yield('styles')
</head>
<body>

{{-- Header --}}
<header class="admin-header">
  <button class="btn btn-sm btn-link text-white p-0 d-md-none" id="sidebarToggle" aria-label="Toggle sidebar">
    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
      <line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>
    </svg>
  </button>

  <span class="brand">Mind<span>Snap</span> Admin</span>

  <div class="spacer"></div>

  <span class="admin-user-email d-none d-sm-inline">{{ auth()->user()->email }}</span>

  <div class="dropdown">
    <button class="btn btn-sm btn-outline-secondary text-white border-secondary dropdown-toggle ms-2" type="button" data-bs-toggle="dropdown">
      Account
    </button>
    <ul class="dropdown-menu dropdown-menu-end">
      <li>
        <form method="POST" action="{{ route('admin.logout') }}">
          @csrf
          <button type="submit" class="dropdown-item text-danger">Logout</button>
        </form>
      </li>
    </ul>
  </div>
</header>

{{-- Sidebar --}}
<nav class="admin-sidebar" id="adminSidebar">
  <span class="nav-section-label">Main</span>

  <a href="{{ route('admin.dashboard') }}"
     class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
    <span class="nav-icon">📊</span> Overview
  </a>

  <a href="{{ route('admin.tools.index') }}"
     class="nav-link {{ request()->routeIs('admin.tools.*') ? 'active' : '' }}">
    <span class="nav-icon">🔧</span> Tools
  </a>

  <hr>

  <span class="nav-section-label">Coming Soon</span>

  <span class="nav-link disabled-future">
    <span class="nav-icon">📝</span> Blog Posts
  </span>
</nav>

{{-- Main content --}}
<main class="admin-content">

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {!! session('success') !!}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.getElementById('sidebarToggle')?.addEventListener('click', function () {
    document.getElementById('adminSidebar').classList.toggle('show');
  });
</script>
@yield('scripts')
</body>
</html>
