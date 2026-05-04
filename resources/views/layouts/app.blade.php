<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', 'Free Health Calculators & Brain Quizzes for Everyone | MindSnap')</title>
  <meta name="description" content="@yield('description', 'MindSnap — free health tools, sleep calculators and brain quizzes for all ages. No signup. Works worldwide.')">
  <link rel="canonical" href="@yield('canonical', config('app.url'))">

  {{-- Favicon --}}
  <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
  <link rel="apple-touch-icon" href="{{ asset('favicon.svg') }}">

  {{-- Open Graph --}}
  <meta property="og:title"       content="@yield('title')">
  <meta property="og:description" content="@yield('description')">
  <meta property="og:url"         content="@yield('canonical', config('app.url'))">
  <meta property="og:image"       content="@yield('og_image', asset('images/og-default.jpg'))">
  <meta property="og:type"        content="website">
  <meta property="og:site_name"   content="MindSnap">
  <meta name="twitter:card"       content="summary_large_image">
  <meta name="twitter:site"       content="@MindSnapCo">

  {{-- Robots --}}
  <meta name="robots" content="@yield('robots', 'index, follow')">

  {{-- Fonts: preconnect first to eliminate render-blocking --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  {{-- Bootstrap 5 CSS --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    :root {
      --primary-dark: #1a1a2e;
      --primary-mid:  #0f3460;
      --primary-cta:  #e94560;
      --bg:           #f8f9fa;
      --card:         #ffffff;
      --text:         #555555;
      --text-muted:   #888888;
      --border:       #e0e0e0;
      --sleep:        #6c63ff;
      --fitness:      #28a745;
      --nutrition:    #fd7e14;
      --quiz:         #e94560;
      --kids:         #17a2b8;
      --life:         #6f42c1;
      --games:        #ffc107;
    }

    *, *::before, *::after { box-sizing: border-box; }

    body {
      font-family: 'Inter', sans-serif;
      background: var(--bg);
      color: var(--text);
      font-size: 16px;
      line-height: 1.6;
      -webkit-font-smoothing: antialiased;
    }

    /* Typography */
    h1 { font-size: clamp(1.8rem, 4vw, 2.5rem); font-weight: 700; color: var(--primary-dark); line-height: 1.3; }
    h2 { font-size: clamp(1.4rem, 3vw, 2rem);   font-weight: 700; color: var(--primary-mid);  line-height: 1.3; }
    h3 { font-size: clamp(1.1rem, 2vw, 1.5rem); font-weight: 600; color: #16213e; }
    a  { color: var(--primary-cta); text-decoration: none; }
    a:hover { text-decoration: underline; }

    /* Buttons */
    .btn-cta {
      background: var(--primary-cta);
      color: #fff;
      border-radius: 8px;
      padding: 12px 28px;
      font-weight: 600;
      min-height: 48px;
      border: none;
      transition: background .2s, transform .1s;
    }
    .btn-cta:hover  { background: #c73652; color: #fff; transform: translateY(-1px); }
    .btn-cta:active { transform: translateY(0); }

    /* Cards */
    .tool-card {
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0,0,0,.08);
      transition: transform .2s, box-shadow .2s;
      background: var(--card);
    }
    .tool-card:hover { transform: translateY(-4px); box-shadow: 0 8px 30px rgba(0,0,0,.12); }

    /* Result box */
    .result-box {
      background: #f0f2f5;
      border-radius: 8px;
      padding: 20px 24px;
      animation: fadeIn .3s ease;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(8px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    /* Badges */
    .badge-searches {
      background: rgba(233,69,96,.1);
      color: var(--primary-cta);
      border-radius: 50px;
      padding: 3px 10px;
      font-size: .75rem;
      font-weight: 600;
    }

    /* Form controls */
    .form-control, .form-select {
      min-height: 48px;
      border-radius: 8px;
      border-color: var(--border);
      font-size: 16px; /* prevents iOS zoom */
    }
    .form-control:focus, .form-select:focus {
      border-color: var(--primary-cta);
      box-shadow: 0 0 0 3px rgba(233,69,96,.15);
    }

    /* Sections */
    section { padding: 80px 0; }
    @media (max-width: 768px) {
      section { padding: 40px 0; }
      .card   { padding: 16px; }
      .btn-cta { width: 100%; min-height: 52px; }
    }

    /* Utility */
    .text-cta { color: var(--primary-cta); }
    .bg-dark-brand { background: var(--primary-dark); }
    .bg-mid-brand  { background: var(--primary-mid); }
    .border-sleep     { border-color: var(--sleep)     !important; }
    .border-fitness   { border-color: var(--fitness)   !important; }
    .border-nutrition { border-color: var(--nutrition) !important; }
    .border-quiz      { border-color: var(--quiz)      !important; }
    .border-kids      { border-color: var(--kids)      !important; }
    .border-life      { border-color: var(--life)      !important; }
    .border-games     { border-color: var(--games)     !important; }
  </style>

  {{-- Page-level schemas (WebApplication, BreadcrumbList, FAQPage) --}}
  @yield('schema')

  {{-- AdSense — excluded on kids pages --}}
  @if(config('adsense.enabled') && !request()->is('kids*'))
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"
          data-ad-client="{{ config('adsense.publisher_id') }}"></script>
  @endif

  {{-- External Third-Party Scripts --}}
  @include('partials.external-scripts')
</head>
<body>

  @include('components.navbar')

  <main id="main-content">
    @yield('content')
  </main>

  @include('components.footer')

  {{-- Bootstrap JS (deferred) --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>

  {{-- Page-specific scripts --}}
  @yield('scripts')

</body>
</html>
