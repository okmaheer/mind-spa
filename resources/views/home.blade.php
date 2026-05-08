@extends('layouts.app')

@section('title', 'Free Health Calculators & Brain Quizzes | MindSnap')
@section('description', 'MindSnap gives you free health tools, sleep calculators and brain quizzes — no signup, no fees, works on any device. Used by millions worldwide.')
@section('canonical', config('app.url'))

@section('schema')
<script type="application/ld+json">{"@@context":"https://schema.org","@@type":"WebSite","name":"MindSnap","url":"{{ config('app.url') }}","description":"Free health calculators, sleep tools and brain quizzes for everyone.","potentialAction":{"@@type":"SearchAction","target":"{{ config('app.url') }}/search?q={search_term_string}","query-input":"required name=search_term_string"}}</script>
<script type="application/ld+json">{"@@context":"https://schema.org","@@type":"Organization","name":"MindSnap","url":"{{ config('app.url') }}","logo":"{{ asset('favicon.svg') }}"}</script>
@endsection

@section('styles')
<style>
.hero-cta        { min-width: 160px; font-size: 1rem; }
.home-intro-text { max-width: 480px; margin: .75rem auto 0; }
.hiw-intro-text  { max-width: 440px; margin: .75rem auto 0; }
.pop-tool-icon   { font-size: 2rem; line-height: 1; }
.pop-tool-btn    { min-height: 44px; }
</style>
@endsection

@section('content')

{{-- ═══════════════════════════════════════════════════════════════════════════
     SECTION 1 — HERO
════════════════════════════════════════════════════════════════════════════ --}}
<section id="hero" class="home-hero">

  <div class="home-hero-deco" aria-hidden="true">
    <div class="home-hero-blob-1"></div>
    <div class="home-hero-blob-2"></div>
  </div>

  <div class="container position-relative">
    <div class="row align-items-center">
      <div class="col-lg-7">

        <div class="d-flex align-items-center gap-2 mb-4">
          <span class="badge home-hero-badge">🔥 New: Daily Brain Challenge</span>
        </div>

        <h1 class="home-hero-h1">
          Free Tools for a<br>
          <span class="home-hero-accent">Sharper Mind</span> &amp; Healthier Life
        </h1>

        <p class="home-hero-sub">
          Sleep calculators, fitness tools, brain quizzes — all completely free,
          no signup needed, and built to actually work on your phone.
        </p>

        <div class="d-flex flex-wrap gap-3 mb-5">
          <a href="{{ route('category.sleep') }}" class="btn btn-cta hero-cta">
            Explore Tools
          </a>
          <a href="{{ route('category.games') }}" class="btn btn-ghost-white">
            Play Brain Games →
          </a>
        </div>

        <div class="row g-3">
          @foreach([
            ['40+', 'Free Tools',    'text-sleep'],
            ['30+', 'Calculators',   'text-fitness'],
            ['5',   'Brain Games',   'text-games'],
            ['0',   'Signup Needed', 'text-kids'],
          ] as [$num, $label, $cls])
          <div class="col-6 col-sm-3">
            <div class="home-stat-card">
              <div class="home-stat-num {{ $cls }}">{{ $num }}</div>
              <div class="home-stat-label">{{ $label }}</div>
            </div>
          </div>
          @endforeach
        </div>

      </div>

      {{-- Right side decoration (desktop only) --}}
      <div class="col-lg-5 d-none d-lg-flex justify-content-end" aria-hidden="true">
        <div class="home-deco-wrap">
          <div class="home-deco-card home-deco-card-1">
            <div class="home-deco-icon">😴</div>
            <div class="home-deco-title">Sleep Calculator</div>
            <div class="home-deco-sub home-deco-sub-sleep">Find your perfect bedtime</div>
          </div>
          <div class="home-deco-card home-deco-card-2">
            <div class="home-deco-icon">💪</div>
            <div class="home-deco-title">BMI Calculator</div>
            <div class="home-deco-sub home-deco-sub-fitness">Free, instant, no signup</div>
          </div>
          <div class="home-deco-card home-deco-card-3">
            <div class="home-deco-icon">🎮</div>
            <div class="home-deco-title">Reaction Time Test</div>
            <div class="home-deco-sub home-deco-sub-games">How fast are your reflexes?</div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════════════════
     SECTION 2 — CATEGORY GRID
════════════════════════════════════════════════════════════════════════════ --}}
<section id="categories" class="section-lg bg-white">
  <div class="container">

    <div class="text-center mb-5">
      <h2>What Would You Like to Do Today?</h2>
      <p class="text-muted home-intro-text">
        Pick a category and get instant results — no account, no waiting, no cost.
      </p>
    </div>

    @php
    $categories = [
      ['emoji'=>'😴','name'=>'Sleep Tools',    'slug'=>'sleep-tools',    'key'=>'sleep',     'tools'=>'7 tools',  'desc'=>'Find your perfect bedtime, fix your sleep debt, beat jet lag'],
      ['emoji'=>'💪','name'=>'Fitness',         'slug'=>'fitness-tools',  'key'=>'fitness',   'tools'=>'11 tools', 'desc'=>'BMI, TDEE, body fat, heart rate zones and more'],
      ['emoji'=>'🥗','name'=>'Nutrition',       'slug'=>'nutrition-tools','key'=>'nutrition', 'tools'=>'2 tools',  'desc'=>'Water intake and intermittent fasting timer'],
      ['emoji'=>'👶','name'=>'Kids Zone',       'slug'=>'kids',           'key'=>'kids',      'tools'=>'5 games',  'desc'=>'Safe, ad-free learning games for ages 5–12'],
      ['emoji'=>'⏰','name'=>'Life Tools',      'slug'=>'life-tools',     'key'=>'life',      'tools'=>'7 tools',  'desc'=>'Age, pregnancy, days between dates, retirement'],
      ['emoji'=>'🎮','name'=>'Games',           'slug'=>'games',          'key'=>'games',     'tools'=>'5 games',  'desc'=>'Typing speed, reaction time, memory test and more'],
    ];
    @endphp

    <div class="row g-4">
      @foreach($categories as $cat)
      <div class="col-6 col-md-4 col-lg-3">
        <a href="{{ url($cat['slug']) }}"
           class="home-cat-card home-cat-card-{{ $cat['key'] }}">
          <div class="home-cat-icon home-cat-icon-{{ $cat['key'] }}">{{ $cat['emoji'] }}</div>
          <h3 class="home-cat-name">{{ $cat['name'] }}</h3>
          <span class="home-cat-badge home-cat-badge-{{ $cat['key'] }}">{{ $cat['tools'] }}</span>
          <p class="home-cat-desc">{{ $cat['desc'] }}</p>
          <span class="home-cat-arrow home-cat-arrow-{{ $cat['key'] }}">Explore →</span>
        </a>
      </div>
      @endforeach
    </div>

  </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════════════════
     SECTION 3 — POPULAR TOOLS
════════════════════════════════════════════════════════════════════════════ --}}
<section id="popular" class="section-lg bg-site">
  <div class="container">

    <div class="d-flex flex-wrap align-items-end justify-content-between gap-3 mb-5">
      <div>
        <h2 class="mb-1">Most Popular Tools</h2>
        <p class="text-muted mb-0">Our most-used tools, covering sleep, fitness, life and brain training.</p>
      </div>
      <a href="{{ route('category.sleep') }}" class="home-view-all">View all tools →</a>
    </div>

    @php
    $popularTools = [
      ['icon'=>'😴','name'=>'Sleep Cycle Calculator','slug'=>'sleep-calculator',   'category'=>'sleep',  'desc'=>'Wake up refreshed by timing your sleep cycles right.'],
      ['icon'=>'⚖️','name'=>'BMI Calculator',         'slug'=>'bmi-calculator',     'category'=>'fitness','desc'=>'Find out where you stand and what it actually means.'],
      ['icon'=>'🔥','name'=>'Calorie Calculator',     'slug'=>'calorie-calculator', 'category'=>'fitness','desc'=>'Your TDEE — the number behind every diet plan.'],
      ['icon'=>'⌨️','name'=>'Typing Speed Test',     'slug'=>'typing-speed-test',  'category'=>'games',  'desc'=>'Measure your WPM and see how you rank worldwide.'],
      ['icon'=>'⏱️','name'=>'Reaction Time Test',    'slug'=>'reaction-time-test', 'category'=>'games',  'desc'=>'How fast are your reflexes? Test your response speed.'],
      ['icon'=>'🎂','name'=>'Age Calculator',         'slug'=>'age-calculator',     'category'=>'life',   'desc'=>'Your exact age in years, months, weeks and days.'],
    ];
    @endphp

    <div class="row g-4">
      @foreach($popularTools as $tool)
      <div class="col-12 col-md-6 col-lg-4">
        <div class="card tool-card h-100 home-top-border-{{ $tool['category'] }}">
          <div class="card-body p-4 d-flex flex-column">
            <div class="mb-2">
              <span class="pop-tool-icon">{{ $tool['icon'] }}</span>
            </div>
            <h3 class="h6 fw-700 mt-2 mb-1">
              <a href="{{ url($tool['slug']) }}" class="home-tool-name">{{ $tool['name'] }}</a>
            </h3>
            <p class="home-tool-desc">{{ $tool['desc'] }}</p>
            <a href="{{ url($tool['slug']) }}" class="btn btn-cta btn-sm w-100 pop-tool-btn mt-auto">
              Use Free Tool →
            </a>
          </div>
        </div>
      </div>
      @endforeach
    </div>

  </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════════════════
     SECTION 4 — KIDS ZONE HIGHLIGHT
════════════════════════════════════════════════════════════════════════════ --}}
<section id="kids" class="home-kids-section">
  <div class="container">

    <div class="row align-items-center g-5">
      <div class="col-lg-5">
        <span class="home-kids-badge">👶 KIDS ZONE</span>
        <h2 class="mt-3 mb-2">Fun Learning for Kids</h2>
        <p class="text-muted lh-lg mb-3">
          Math puzzles, word games, science quizzes and animal challenges — all designed for ages 5 to 12.
          Built to be enjoyable, not overwhelming.
        </p>
        <div class="d-flex flex-wrap gap-2 mb-4">
          <span class="home-kids-pill">🚫 No Ads</span>
          <span class="home-kids-pill">🔒 No Data Collected</span>
          <span class="home-kids-pill">✓ No Account</span>
        </div>
        <a href="{{ route('category.kids') }}" class="btn btn-cta home-kids-btn">
          Explore Kids Zone →
        </a>
      </div>

      <div class="col-lg-7">
        <div class="row g-3">
          @foreach([
            ['emoji'=>'🔢','name'=>'Math Puzzles', 'slug'=>'kids/math-puzzles','desc'=>'Addition, subtraction, times tables and more'],
            ['emoji'=>'📝','name'=>'Word Games',    'slug'=>'kids/word-games',  'desc'=>'Spelling, vocabulary and word scrambles'],
            ['emoji'=>'🔬','name'=>'Science Quiz',  'slug'=>'kids/science-quiz','desc'=>'Planets, animals, the human body and nature'],
            ['emoji'=>'🦁','name'=>'Animal Quiz',   'slug'=>'kids/animal-quiz', 'desc'=>'Which animal is fastest? Where do they live?'],
          ] as $activity)
          <div class="col-6">
            <a href="{{ url($activity['slug']) }}" class="home-kids-card">
              <div class="home-kids-card-icon">{{ $activity['emoji'] }}</div>
              <div class="home-kids-card-name">{{ $activity['name'] }}</div>
              <div class="home-kids-card-desc">{{ $activity['desc'] }}</div>
            </a>
          </div>
          @endforeach
        </div>
      </div>
    </div>

  </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════════════════
     SECTION 5 — HOW IT WORKS
════════════════════════════════════════════════════════════════════════════ --}}
<section id="how-it-works" class="section-lg bg-white">
  <div class="container">

    <div class="text-center mb-5">
      <h2>Simple. Fast. Actually Free.</h2>
      <p class="text-muted hiw-intro-text">
        No hidden steps, no email wall, no "free trial" that expires.
      </p>
    </div>

    <div class="row g-4 justify-content-center">
      @foreach([
        ['num'=>1,'icon'=>'🎯','title'=>'Pick a Tool',        'desc'=>'Choose from 40+ free health calculators, quizzes and games. Search by name or browse by category.'],
        ['num'=>2,'icon'=>'⚡','title'=>'Get Instant Results', 'desc'=>'Fill in your details — results appear immediately, right there on the page. No page reload, no waiting.'],
        ['num'=>3,'icon'=>'📤','title'=>'Share with Friends',  'desc'=>'Copy your result, share it on WhatsApp or download it as an image — challenge your friends to beat your score.'],
      ] as $step)
      <div class="col-12 col-md-4">
        <div class="text-center p-4">
          <div class="home-step-icon home-step-icon-{{ $step['num'] }}">{{ $step['icon'] }}</div>
          <div class="home-step-num home-step-num-{{ $step['num'] }}">STEP 0{{ $step['num'] }}</div>
          <h3 class="home-step-title">{{ $step['title'] }}</h3>
          <p class="home-step-desc">{{ $step['desc'] }}</p>
        </div>
      </div>
      @endforeach
    </div>

    <div class="d-flex flex-wrap justify-content-center gap-3 mt-5 pt-4 home-trust-bar">
      <span class="home-trust-green">✓ Free forever</span>
      <span class="home-trust-green">✓ No email required</span>
      <span class="home-trust-teal">✓ No ads on Kids pages</span>
      <span class="home-trust-purple">✓ Works on all devices</span>
      <span class="home-trust-red">✓ 190+ countries</span>
    </div>

  </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════════════════
     SECTION 6 — SEO CONTENT BLOCK
════════════════════════════════════════════════════════════════════════════ --}}
<section id="about-mindsnap" class="section-lg bg-site">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">

        <h2 class="text-center mb-4">Free Health Tools That Actually Work</h2>

        <p class="home-seo-body">
          Most health tools online make you sign up, show you ads every three seconds, or give you results that feel
          copied from a textbook. MindSnap does none of that. We built a set of free health tools for everyday people —
          whether you're trying to figure out the right bedtime, cut calories without losing your mind, or just want to
          know how good your general knowledge really is.
        </p>

        <h3 class="home-seo-h3">Why we keep it free</h3>
        <p class="home-seo-body">
          Health information shouldn't sit behind a paywall. A sleep calculator doesn't need your credit card.
          A BMI tool doesn't need your email address. We keep MindSnap free because the tools are straightforward,
          the formulas are public, and the only thing stopping most people from using them was a bad interface.
          We fixed that.
        </p>

        <h3 class="home-seo-h3">Built for real use, on real phones</h3>
        <p class="home-seo-body mb-0">
          Every calculator is tested at 375px wide — the smallest common phone screen — before it goes live.
          All inputs are large enough to tap without squinting. Results appear instantly without any page reload.
          The kids zone has zero ads and collects no data, ever. That's not a policy update, that's how it's built.
        </p>

        <div class="d-flex flex-wrap gap-3 mt-4">
          <a href="{{ route('category.sleep') }}" class="btn btn-cta">Explore Sleep Tools</a>
          <a href="{{ route('category.fitness') }}" class="btn btn-outline-cta">Fitness Calculators</a>
        </div>

      </div>
    </div>
  </div>
</section>

@endsection
