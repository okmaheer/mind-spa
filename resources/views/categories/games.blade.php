@extends('layouts.app')

@section('title', 'Free Online Brain Games — Typing Speed, Memory & Reaction Test | MindSnap')
@section('description', 'Free online brain games: typing speed test, reaction time test, memory test, word scramble game, and colour blind test. Train and test your brain in minutes. No download, no signup needed.')
@section('canonical', config('app.url') . '/games')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@graph": [
    {
      "@@type": "CollectionPage",
      "@@id": "{{ config('app.url') }}/games#collection",
      "url": "{{ config('app.url') }}/games",
      "name": "Free Online Brain Games",
      "description": "5 free browser-based brain games: typing speed test, reaction time test, memory test, word scramble, and colour blind test.",
      "inLanguage": "en",
      "publisher": { "@@type": "Organization", "name": "MindSnap", "url": "{{ config('app.url') }}" }
    },
    {
      "@@type": "BreadcrumbList",
      "itemListElement": [
        { "@@type": "ListItem", "position": 1, "name": "Home",  "item": "{{ config('app.url') }}" },
        { "@@type": "ListItem", "position": 2, "name": "Games", "item": "{{ config('app.url') }}/games" }
      ]
    },
    {
      "@@type": "FAQPage",
      "mainEntity": [
        { "@@type": "Question", "name": "What is a good typing speed?",                       "acceptedAnswer": { "@@type": "Answer", "text": "The average typing speed for adults is 40 WPM. A good speed is 60–80 WPM. Professional typists reach 100 WPM or more." } },
        { "@@type": "Question", "name": "What is a normal reaction time?",                    "acceptedAnswer": { "@@type": "Answer", "text": "The average human reaction time is 200–250 milliseconds. Under 200ms is excellent." } },
        { "@@type": "Question", "name": "Do brain games actually improve cognitive function?", "acceptedAnswer": { "@@type": "Answer", "text": "Practicing specific cognitive tasks improves performance in those tasks. Regular brain game practice can also help maintain cognitive function as we age." } }
      ]
    }
  ]
}
</script>
@endsection

@php
$cat  = config('mindsnap.categories')['games'];
$faqs = [
  ['q' => 'What is a good typing speed in WPM?',
   'a' => 'The average adult types at <strong>40 WPM</strong>. A good speed is <strong>60–80 WPM</strong>. Professional typists and programmers typically reach 80–120 WPM. Take our <a href="/typing-speed-test">Typing Speed Test</a> to measure yours and get a personalised improvement tip.'],
  ['q' => 'What is a normal reaction time?',
   'a' => 'Average reaction time to a visual stimulus is <strong>200–250 milliseconds</strong>. Under 200ms is excellent (top ~10%). Reaction time worsens with age, fatigue, alcohol, and distractions. Measure yours at our <a href="/reaction-time-test">Reaction Time Test</a>.'],
  ['q' => 'How does the colour blind test work?',
   'a' => 'Our <a href="/color-blind-test">Colour Blind Test</a> uses Ishihara-style plates — circular patterns of coloured dots hiding numbers or shapes. People with red-green colour deficiency cannot see the hidden number. The test can detect the most common types of colour vision deficiency.'],
  ['q' => 'Can brain games improve memory?',
   'a' => 'Studies show that regularly practicing memory tasks improves performance in those specific tasks. Working memory training can also have modest transfer effects on attention and executive function. The best approach is variety — combine memory games with physical exercise and adequate sleep.'],
  ['q' => 'How can I improve my typing speed?',
   'a' => 'The most effective method is to focus on accuracy first, speed second — typing slowly and correctly builds correct muscle memory faster. Touch typing is approximately 35% faster than hunt-and-peck typing on average. Practice in 15–20 minute focused sessions. Most people can increase from 40 WPM to 70 WPM within 4–6 weeks of daily practice.'],
  ['q' => 'Does reaction time slow with age?',
   'a' => 'Yes — reaction time slows progressively from around age 24, declining approximately 10–15% per decade. By age 70, average reaction time is roughly 50–60% slower than peak. However, experience and anticipation can partially compensate. Regular physical exercise, good sleep, and cognitive stimulation slow the age-related decline.'],
  ['q' => 'Are online brain games scientifically proven to improve memory?',
   'a' => 'The scientific evidence is mixed. A large 2014 Stanford study concluded that commercial brain training programs had not been shown to produce meaningful improvements in real-world cognitive ability. However, specific skills like working memory capacity and processing speed show modest improvements with targeted practice. The strongest evidence for long-term brain health points to physical exercise, quality sleep, and learning new complex skills.'],
];

$relatedTools = [
  ['icon' => '💪', 'name' => 'Fitness Tools', 'slug' => '/fitness-tools', 'desc' => 'BMI, calories & macro calculators'],
  ['icon' => '👶', 'name' => 'Kids Zone',     'slug' => '/kids',          'desc' => 'Safe games & quizzes for children'],
  ['icon' => '😴', 'name' => 'Sleep Tools',   'slug' => '/sleep-tools',   'desc' => 'Bedtime & sleep cycle calculators'],
  ['icon' => '💪', 'name' => 'Fitness Tools', 'slug' => '/fitness-tools', 'desc' => 'BMI, calories & macro calculators'],
];
@endphp

@section('content')

<nav aria-label="Breadcrumb" class="ms-cat-nav">
  <div class="container-xl">
    <ol class="breadcrumb mb-0">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Games</li>
    </ol>
  </div>
</nav>

{{-- Hero --}}
<section class="ms-cat-hero">
  <div class="container-xl">
    <div class="row align-items-center g-4">
      <div class="col-lg-8">
        <div class="d-flex align-items-center gap-3 mb-3">
          <span class="ms-hero-icon">{{ $cat['icon'] }}</span>
          <span class="ms-cat-badge-games">{{ $cat['label'] }}</span>
        </div>
        <h1 class="ms-cat-hero-h1">Free Online Brain Games — Typing, Memory &amp; Reaction Tests</h1>
        <p class="ms-cat-hero-p">
          Test and train your typing speed, reaction time, memory, vocabulary, and colour vision.
          5 browser-based games — play instantly, no download, no signup.
        </p>
        <div class="d-flex flex-wrap gap-3">
          <div class="ms-hero-feature d-flex align-items-center gap-2">
            <svg width="16" height="16" fill="none" stroke="#ffc107" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            No download required
          </div>
          <div class="ms-hero-feature d-flex align-items-center gap-2">
            <svg width="16" height="16" fill="none" stroke="#ffc107" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            Works on any device
          </div>
          <div class="ms-hero-feature d-flex align-items-center gap-2">
            <svg width="16" height="16" fill="none" stroke="#ffc107" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            100% free, no signup
          </div>
        </div>
      </div>
      <div class="col-lg-4 d-none d-lg-flex justify-content-end">
        <div class="ms-hero-stat-box ms-hero-stat-box-games">
          <div class="ms-hero-stat-num">5</div>
          <div class="ms-hero-stat-sub">Brain Games</div>
          <div class="ms-hero-stat-div"></div>
          <div class="ms-hero-stat-val">~2 min</div>
          <div class="ms-hero-stat-sub">Average play time</div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Games Grid --}}
<section class="ms-section-tools">
  <div class="container-xl">
    <div class="d-flex align-items-center justify-content-between mb-4">
      <h2 class="ms-section-h2">All Brain Games</h2>
      <span class="text-muted-sm">{{ count($tools) ?: 5 }} games</span>
    </div>
    @if(count($tools))
    <div class="row g-4">
      @foreach($tools as $tool)
      <div class="col-sm-6 col-lg-4">
        <a href="/{{ $tool['slug'] }}" class="tool-card d-block p-4 h-100 text-decoration-none ms-tool-card-games">
          <div class="d-flex align-items-start gap-3">
            <span class="ms-tool-icon">{{ $tool['icon'] ?? '🎮' }}</span>
            <div>
              <div class="ms-tool-name">{{ $tool['name'] }}</div>
              <div class="ms-tool-desc">{{ $tool['description'] }}</div>
              @if(!empty($tool['monthly_searches']) && $tool['monthly_searches'] > 0)
              <div class="mt-2"><span class="badge-searches">{{ number_format($tool['monthly_searches'] / 1000) }}K searches/mo</span></div>
              @endif
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
    @else
    <div class="row g-4">
      @foreach([
        ['⌨️','Typing Speed Test', '/typing-speed-test', 'Measure your WPM and accuracy. See how you rank against global averages.', '90K'],
        ['⚡','Reaction Time Test', '/reaction-time-test','How fast are your reflexes? Measure reaction time in milliseconds.',       '74K'],
        ['🃏','Memory Test',        '/memory-test',       'Test your visual memory by matching and recalling sequences of cards.',     '50K'],
        ['🔀','Word Scramble',      '/word-scramble',     'Unscramble words against the clock. Great for vocabulary and spelling.',    '33K'],
        ['🎨','Colour Blind Test',  '/color-blind-test',  'Check your colour vision with Ishihara-style plates.',                     '27K'],
      ] as [$icon,$name,$slug,$desc,$searches])
      <div class="col-sm-6 col-lg-4">
        <a href="{{ $slug }}" class="tool-card d-block p-4 h-100 text-decoration-none ms-tool-card-games">
          <div class="d-flex align-items-start gap-3">
            <span class="ms-tool-icon">{{ $icon }}</span>
            <div>
              <div class="ms-tool-name">{{ $name }}</div>
              <div class="ms-tool-desc">{{ $desc }}</div>
              <div class="mt-2"><span class="badge-searches">{{ $searches }} searches/mo</span></div>
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
    @endif
  </div>
</section>

{{-- Stats --}}
<section class="ms-section-stats">
  <div class="container-xl">
    <h2 class="text-center mb-4">How Do You Compare?</h2>
    <div class="row g-3 justify-content-center">
      @foreach([
        ['⌨️','40 WPM', 'Average adult typing speed'],
        ['⚡','250ms',  'Average human reaction time'],
        ['🃏','7±2',    'Items in short-term memory (Miller\'s Law)'],
        ['👁️','8%',     'Men affected by colour blindness'],
      ] as [$icon,$stat,$label])
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

{{-- SEO Content --}}
<section class="ms-section-seo-alt">
  <div class="container ms-longtail">
    <h2 class="mb-4 text-brand">Free Typing Speed Test — What Is a Good WPM?</h2>
    <p>The average typing speed for adults is 40 words per minute (WPM). Professional typists average 65–75 WPM. Competitive typists reach 100–150 WPM. For reference, the average person speaks at 125–150 WPM — most people speak faster than they type. A typing speed above 60 WPM is generally considered fast enough for professional work without typing being a bottleneck. Our typing speed test measures your WPM and accuracy across a standardised passage, giving you a comparable score you can track over time.</p>
    <h2 class="mt-5 mb-4 text-brand">Reaction Time Test — What Is a Good Reaction Time?</h2>
    <p>Average human reaction time to a visual stimulus is 200–250 milliseconds. Athletes typically average 150–200 ms. Reaction time worsens measurably with sleep deprivation (each hour of missed sleep adds approximately 10 ms), alcohol (even at legal driving limits), and ageing (reaction time slows roughly 10–15% per decade from age 30). Our reaction time test measures your average across multiple attempts to reduce the effect of individual variation.</p>
    <h2 class="mt-5 mb-4 text-brand">Memory Test Online — How Good Is Your Short-Term Memory?</h2>
    <p>Short-term (working) memory capacity averages 7 items (plus or minus 2) — a finding established by psychologist George Miller in 1956 and still broadly accurate. This capacity declines with age and is impaired by sleep deprivation, stress, and distraction. Our memory test measures your digit span — the number of items you can hold and recall in sequence. It is a quick, validated measure of working memory capacity used in neuropsychological assessment.</p>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="gamesFaq" />

<x-related-tools :tools="$relatedTools" heading="Explore More Tools" />

@endsection
