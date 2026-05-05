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

  {{-- Preconnect to all CDN origins early --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>

  {{-- Fonts: async load (non-render-blocking) --}}
  <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"></noscript>

  {{-- Bootstrap 5 CSS: synchronous (async loading caused CLS=1 due to full layout shift) --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

  {{-- MindSnap design system: tokens, base styles, and utility classes --}}
  <link rel="stylesheet" href="{{ asset('css/mindsnap.css') }}">

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
