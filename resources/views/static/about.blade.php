@extends('layouts.app')

@section('title', 'About MindSnap — Free Health Tools & Quizzes')
@section('description', 'MindSnap is a free collection of health calculators, sleep tools, fitness calculators, and brain quizzes. No signup, no ads on kids pages, no data sold. Built for everyone.')
@section('canonical', config('app.url') . '/about')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@graph": [
    {
      "@@type": "AboutPage",
      "@@id": "{{ config('app.url') }}/about#page",
      "url": "{{ config('app.url') }}/about",
      "name": "About MindSnap",
      "description": "MindSnap is a free collection of health calculators, brain quizzes, and cognitive games.",
      "publisher": { "@@type": "Organization", "name": "MindSnap", "url": "{{ config('app.url') }}" }
    },
    {
      "@@type": "BreadcrumbList",
      "itemListElement": [
        { "@@type": "ListItem", "position": 1, "name": "Home",  "item": "{{ config('app.url') }}" },
        { "@@type": "ListItem", "position": 2, "name": "About", "item": "{{ config('app.url') }}/about" }
      ]
    }
  ]
}
</script>
@endsection

@section('styles')
<style>
.about-cat-sleep     { border-top: 3px solid var(--sleep); }
.about-cat-fitness   { border-top: 3px solid var(--fitness); }
.about-cat-nutrition { border-top: 3px solid var(--nutrition); }
.about-cat-life      { border-top: 3px solid var(--life); }
.about-cat-games     { border-top: 3px solid var(--games); }
.about-cat-kids      { border-top: 3px solid var(--kids); }
.about-principle-icon { font-size: 2rem; margin-bottom: 12px; line-height: 1; }
.about-cta-title     { color: #fff; font-size: 1.8rem; font-weight: 800; margin-bottom: 12px; }
.about-cta-sub       { color: rgba(255,255,255,.8); font-size: 1rem; margin-bottom: 28px; max-width: 480px; margin-left: auto; margin-right: auto; }
.about-btn-white     { background: #fff; color: var(--primary-dark); font-weight: 700; padding: 14px 32px; border-radius: 8px; font-size: 1rem; }
.about-btn-white:hover { background: #f0f0f0; color: var(--primary-dark); }
.about-btn-ghost     { background: rgba(255,255,255,.15); color: #fff; border: 2px solid rgba(255,255,255,.4); font-weight: 600; padding: 14px 28px; border-radius: 8px; font-size: 1rem; }
.about-btn-ghost:hover { background: rgba(255,255,255,.25); color: #fff; }
.about-contact-wrap  { max-width: 640px; text-align: center; }
.about-contact-text  { color: #555; line-height: 1.8; }
.about-contact-link  { font-size: 1.1rem; font-weight: 700; color: var(--primary-cta); text-decoration: none; }
.about-contact-link:hover { text-decoration: underline; }
</style>
@endsection

@section('content')

{{-- Breadcrumb --}}
<nav aria-label="Breadcrumb" class="ms-cat-nav">
  <div class="container-xl">
    <ol class="breadcrumb mb-0">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">About</li>
    </ol>
  </div>
</nav>

{{-- Hero --}}
<section class="ms-hero">
  <div class="container-xl">
    <div class="row align-items-center g-4">
      <div class="col-lg-8">
        <div class="d-flex align-items-center gap-3 mb-3">
          <span class="ms-hero-icon">🧠</span>
          <span class="ms-cat-badge-quiz">About MindSnap</span>
        </div>
        <h1 class="ms-hero-title">Free Tools for a Sharper Mind &amp; Healthier Life</h1>
        <p class="ms-hero-desc-wide">
          MindSnap is a free collection of health calculators, brain quizzes, and cognitive games — built for everyone.
          No signup. No paywall. No nonsense.
        </p>
        <div class="d-flex flex-wrap gap-3">
          <div class="ms-hero-feature d-flex align-items-center gap-2">
            <svg width="16" height="16" fill="none" stroke="#e94560" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            100% free, always
          </div>
          <div class="ms-hero-feature d-flex align-items-center gap-2">
            <svg width="16" height="16" fill="none" stroke="#e94560" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            No account required
          </div>
          <div class="ms-hero-feature d-flex align-items-center gap-2">
            <svg width="16" height="16" fill="none" stroke="#e94560" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            Safe for kids
          </div>
        </div>
      </div>
      <div class="col-lg-4 d-none d-lg-flex justify-content-end">
        <div class="ms-hero-stat-box ms-hero-stat-box-quiz">
          <div class="ms-hero-stat-num">70+</div>
          <div class="ms-hero-stat-sub">Free Tools &amp; Quizzes</div>
          <div class="ms-hero-stat-div"></div>
          <div class="ms-hero-stat-val">7</div>
          <div class="ms-hero-stat-sub">Categories</div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Stats --}}
<section class="ms-section-stats">
  <div class="container-xl">
    <div class="row g-3 justify-content-center">
      @foreach([
        ['😴', '8',   'Sleep tools'],
        ['💪', '11',  'Fitness calculators'],
        ['🧠', '9',   'Brain quizzes'],
        ['🎮', '5',   'Brain games'],
        ['👶', '5',   'Kids activities'],
        ['⏰', '7',   'Life tools'],
        ['🥗', '2',   'Nutrition tools'],
        ['🔬', '0',   'Data sold'],
      ] as [$icon, $stat, $label])
      <div class="col-6 col-md-3">
        <div class="tool-card p-4 text-center h-100">
          <div class="ms-cycle-icon">{{ $icon }}</div>
          <div class="ms-stat-val-quiz">{{ $stat }}</div>
          <div class="ms-cycle-label">{{ $label }}</div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- What We Do --}}
<section class="ms-section-white">
  <div class="container-xl">
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <h2 class="ms-section-h2 text-start">What is MindSnap?</h2>
        <p class="ms-body-text">
          MindSnap started with a simple idea: give everyone access to the health and brain tools that used to be locked behind
          expensive apps, gym memberships, or cluttered ad-ridden websites.
        </p>
        <p class="ms-body-text">
          Every calculator uses established scientific formulas — Mifflin-St Jeor for calorie estimation, WHO guidelines for BMI,
          CDC recommendations for sleep. We cite our sources. We don't invent numbers.
        </p>
        <p class="ms-body-text">
          All tools are browser-based, work on any device, and load in under a second. No app download, no account,
          no email address required — ever.
        </p>
      </div>
      <div class="col-lg-6">
        <div class="row g-3">
          @foreach([
            ['🎯', 'Science-backed',  'Every formula is sourced from peer-reviewed research and official health guidelines.'],
            ['⚡', 'Instant results', 'No loading screens. Results appear as you type — calculated locally in your browser.'],
            ['🌍', 'Works anywhere',  'Metric and imperial units. Works on any browser, any device, in any country.'],
            ['🔒', 'Private by design','We do not build user profiles. No tracking on kids pages. No data sold, ever.'],
          ] as [$icon, $title, $desc])
          <div class="col-6">
            <div class="tool-card p-4 h-100">
              <div class="ms-mini-icon">{{ $icon }}</div>
              <div class="ms-tool-name mb-1">{{ $title }}</div>
              <div class="ms-tool-desc">{{ $desc }}</div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

{{-- What We Offer --}}
<section class="ms-section-tools">
  <div class="container-xl">
    <h2 class="ms-section-h2 text-center mb-2">Everything We Offer</h2>
    <p class="text-center mb-5 text-muted-sm ms-intro-text">
      Seven categories, one goal — give you the right number instantly.
    </p>
    <div class="row g-4">
      @foreach([
        ['😴', 'Sleep Tools',       '/sleep-tools',     'sleep',     'Sleep calculator, bedtime planner, sleep debt tracker, jet lag guide, and more.'],
        ['💪', 'Fitness Tools',     '/fitness-tools',   'fitness',   'BMI, calories, body fat, one-rep max, running pace, ideal weight, and more.'],
        ['🥗', 'Nutrition Tools',   '/nutrition-tools', 'nutrition', 'Water intake calculator and intermittent fasting planner.'],
        ['⏰', 'Life Tools',        '/life-tools',      'life',      'Age calculator, due date, days between dates, ovulation, retirement planner.'],
        ['🎮', 'Brain Games',       '/games',           'games',     'Typing speed, reaction time, memory test, word scramble, colour blind test.'],
        ['👶', 'Kids Zone',         '/kids',            'kids',      'Ad-free educational quizzes and games for children aged 5–14.'],
      ] as [$icon, $name, $slug, $key, $desc])
      <div class="col-sm-6 col-lg-4">
        <a href="{{ $slug }}" class="tool-card d-block p-4 h-100 text-decoration-none about-cat-{{ $key }}">
          <div class="d-flex align-items-start gap-3">
            <span class="ms-tool-icon">{{ $icon }}</span>
            <div>
              <div class="ms-tool-name">{{ $name }}</div>
              <div class="ms-tool-desc">{{ $desc }}</div>
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- Our Principles --}}
<section class="ms-section-stats">
  <div class="container-xl">
    <h2 class="text-center mb-2">Our Principles</h2>
    <p class="text-center mb-5 text-muted-sm ms-intro-text">
      The decisions we make every day as we build MindSnap.
    </p>
    <div class="row g-4 justify-content-center">
      @foreach([
        ['🆓', 'Free, always',           'MindSnap is and will remain completely free. No premium tier, no credits, no subscriptions. Ever.'],
        ['🚫', 'No data sales',           'We do not sell your data to third parties. We do not run retargeting campaigns. What you do on MindSnap stays on MindSnap.'],
        ['👶', 'Kids come first',         'The Kids Zone has zero ads and zero tracking. Children\'s safety is a non-negotiable design constraint, not an afterthought.'],
        ['📐', 'Accuracy over simplicity','We use the correct formula even when it\'s harder to explain. We cite sources. We correct mistakes.'],
        ['⚡', 'Speed matters',           'Every tool should load in under a second and give an instant answer. Slow tools are bad tools.'],
        ['🌍', 'Built for everyone',      'Metric and imperial. Works on a $50 Android phone with a slow connection. No app required.'],
      ] as [$icon, $title, $desc])
      <div class="col-md-6 col-lg-4">
        <div class="tool-card p-4 h-100">
          <div class="about-principle-icon">{{ $icon }}</div>
          <div class="ms-tool-name mb-2">{{ $title }}</div>
          <div class="ms-tool-desc-lg">{{ $desc }}</div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- CTA --}}
<section class="ms-section-accent">
  <div class="container-xl text-center">
    <h2 class="about-cta-title">Ready to get started?</h2>
    <p class="about-cta-sub">Browse every tool and quiz — no signup, no ads, no wait.</p>
    <div class="d-flex justify-content-center flex-wrap gap-3">
      <a href="{{ route('home') }}" class="btn about-btn-white">Explore All Tools</a>
      <a href="{{ route('category.games') }}" class="btn about-btn-ghost">Try a Quiz →</a>
    </div>
  </div>
</section>

{{-- Contact --}}
<section class="ms-section-seo-alt">
  <div class="container about-contact-wrap">
    <h2 class="mb-3 text-brand">Get in Touch</h2>
    <p class="about-contact-text">
      Found a bug? Have a suggestion for a new tool? Want to report an inaccurate formula?
      We read every message.
    </p>
    <p class="mt-3">
      <a href="mailto:hello@mindsnap.co" class="about-contact-link">hello@mindsnap.co</a>
    </p>
  </div>
</section>

@endsection
