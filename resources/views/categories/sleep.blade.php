@extends('layouts.app')

@section('title', 'Free Sleep Calculators & Tools — Bedtime, Cycles & Sleep Schedule | MindSnap')
@section('description', 'Free sleep calculators: bedtime calculator, wake-up time, nap calculator, sleep debt tracker, jet lag recovery, caffeine cut-off time, baby sleep schedule, and sleep quality quiz. Based on 90-minute sleep cycles. No signup.')
@section('canonical', config('app.url') . '/sleep-tools')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@graph": [
    {
      "@@type": "CollectionPage",
      "@@id": "{{ config('app.url') }}/sleep-tools#collection",
      "url": "{{ config('app.url') }}/sleep-tools",
      "name": "Free Sleep Calculators & Tools",
      "description": "Free sleep tools including sleep cycle calculator, wake-up calculator, nap calculator, sleep debt, jet lag, and caffeine calculators.",
      "inLanguage": "en",
      "publisher": { "@@type": "Organization", "name": "MindSnap", "url": "{{ config('app.url') }}" },
      "hasPart": [
        { "@@type": "WebApplication", "name": "Sleep Calculator",      "url": "{{ config('app.url') }}/sleep-calculator",        "applicationCategory": "HealthApplication" },
        { "@@type": "WebApplication", "name": "Wake-Up Calculator",    "url": "{{ config('app.url') }}/wake-up-calculator",      "applicationCategory": "HealthApplication" },
        { "@@type": "WebApplication", "name": "Nap Calculator",        "url": "{{ config('app.url') }}/nap-calculator",          "applicationCategory": "HealthApplication" },
        { "@@type": "WebApplication", "name": "Sleep Debt Calculator", "url": "{{ config('app.url') }}/sleep-debt-calculator",   "applicationCategory": "HealthApplication" },
        { "@@type": "WebApplication", "name": "Caffeine Calculator",   "url": "{{ config('app.url') }}/caffeine-sleep-calculator","applicationCategory": "HealthApplication" },
        { "@@type": "WebApplication", "name": "Jet Lag Calculator",    "url": "{{ config('app.url') }}/jet-lag-calculator",      "applicationCategory": "HealthApplication" }
      ]
    },
    {
      "@@type": "BreadcrumbList",
      "itemListElement": [
        { "@@type": "ListItem", "position": 1, "name": "Home",        "item": "{{ config('app.url') }}" },
        { "@@type": "ListItem", "position": 2, "name": "Sleep Tools", "item": "{{ config('app.url') }}/sleep-tools" }
      ]
    },
    {
      "@@type": "FAQPage",
      "mainEntity": [
        { "@@type": "Question", "name": "What time should I go to sleep?",    "acceptedAnswer": { "@@type": "Answer", "text": "The best bedtime depends on your wake-up time. Sleep works in 90-minute cycles, so aim to wake up at the end of a cycle. For a 7am wake-up, ideal bedtimes are 9:30pm (6 cycles), 11:00pm (5 cycles), or 12:30am (4 cycles)." } },
        { "@@type": "Question", "name": "How many hours of sleep do I need?", "acceptedAnswer": { "@@type": "Answer", "text": "Adults aged 18–64 need 7–9 hours per night. Teenagers need 8–10 hours. Children aged 6–12 need 9–12 hours. Older adults (65+) need 7–8 hours." } },
        { "@@type": "Question", "name": "What is a sleep cycle?",             "acceptedAnswer": { "@@type": "Answer", "text": "A sleep cycle lasts approximately 90 minutes and includes light sleep, deep sleep (slow-wave), and REM sleep. Most people complete 4–6 cycles per night." } },
        { "@@type": "Question", "name": "How do I reduce sleep debt?",        "acceptedAnswer": { "@@type": "Answer", "text": "Repay sleep debt by sleeping an extra 1–2 hours per night over several days. Avoid trying to catch up all at once on weekends." } }
      ]
    }
  ]
}
</script>
@endsection

@php
$cat  = config('mindsnap.categories')['sleep'];
$faqs = [
  ['q' => 'What time should I go to sleep?',
   'a' => 'The best bedtime depends on your wake-up time. For a <strong>7:00am</strong> wake-up, ideal bedtimes are <strong>9:30pm</strong> (6 cycles / 9h), <strong>11:00pm</strong> (5 cycles / 7.5h), or <strong>12:30am</strong> (4 cycles / 6h). Use our <a href="/sleep-calculator">Sleep Calculator</a> to find your exact bedtime.'],
  ['q' => 'How many hours of sleep do I need?',
   'a' => 'Adults aged 18–64 need <strong>7–9 hours</strong>. Teenagers need 8–10 hours. Children (6–12) need 9–12 hours. Older adults (65+) need 7–8 hours. Quality matters as much as quantity — completing full sleep cycles prevents morning grogginess.'],
  ['q' => 'What is a sleep cycle and why does it matter?',
   'a' => 'A sleep cycle lasts ~90 minutes and moves through light sleep → deep sleep (slow-wave) → REM sleep. Waking mid-cycle triggers sleep inertia. Timing your alarm to the end of a cycle — using a <a href="/sleep-calculator">sleep calculator</a> — means waking at the lightest stage.'],
  ['q' => 'How do I fix my sleep schedule?',
   'a' => 'Go to bed and wake at the same time every day, including weekends. Avoid screens 60 minutes before bed. Keep your room cool (65–68°F / 18–20°C) and dark. Cut caffeine after 2pm. Use our <a href="/caffeine-sleep-calculator">Caffeine Calculator</a> to find your personal cut-off time.'],
  ['q' => 'How do I recover from jet lag?',
   'a' => 'On the day of travel, adjust your watch to the destination timezone immediately. Use our <a href="/jet-lag-calculator">Jet Lag Calculator</a> for a personalized recovery plan. Expose yourself to natural light in the morning at your destination.'],
  ['q' => 'What is the best free sleep calculator?',
   'a' => 'The best free sleep calculator is one that uses 90-minute sleep cycle mathematics rather than simply recommending "8 hours." MindSnap\'s sleep calculator lets you enter either your desired wake-up time or bedtime and instantly shows you all cycle-aligned sleep times.'],
  ['q' => 'How do I fix a severely disrupted sleep schedule?',
   'a' => 'Anchor your wake-up time first — pick a consistent wake time and stick to it every day, including weekends, regardless of how late you slept. Your bedtime will naturally adjust within 1–2 weeks. Avoid napping after 3 pm and get bright light within 30 minutes of waking.'],
  ['q' => 'Is 6 hours of sleep enough?',
   'a' => 'For most adults, 6 hours is not enough on a sustained basis. Research shows that adults sleeping 6 hours per night for two weeks perform equivalently to someone who has been awake for 24 hours straight — yet they report feeling only "slightly tired." Only ~3% of people carry a gene that genuinely allows 6-hour sleep.'],
];

$relatedTools = [
  ['icon' => '💪', 'name' => 'Fitness Tools',   'slug' => '/fitness-tools',  'desc' => 'BMI, calories, macros & more'],
  ['icon' => '🥗', 'name' => 'Nutrition Tools',  'slug' => '/nutrition-tools','desc' => 'Water intake & fasting'],
  ['icon' => '🧠', 'name' => 'Brain Quizzes',    'slug' => '/quizzes',        'desc' => 'IQ test, GK quiz & more'],
  ['icon' => '⏰', 'name' => 'Life Tools',        'slug' => '/life-tools',     'desc' => 'Age, dates & life calculators'],
];
@endphp

@section('content')

{{-- Breadcrumb --}}
<nav aria-label="Breadcrumb" class="ms-cat-nav">
  <div class="container-xl">
    <ol class="breadcrumb mb-0">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Sleep Tools</li>
    </ol>
  </div>
</nav>

{{-- Hero --}}
<section class="ms-hero">
  <div class="container-xl">
    <div class="row align-items-center g-4">
      <div class="col-lg-8">
        <div class="d-flex align-items-center gap-3 mb-3">
          <span class="ms-hero-icon">{{ $cat['icon'] }}</span>
          <span class="badge ms-badge ms-badge-sleep">{{ $cat['label'] }}</span>
        </div>
        <h1 class="ms-hero-title">Free Sleep Calculators & Tools — Bedtime, Nap & Sleep Schedule</h1>
        <p class="ms-hero-desc-wide">
          Find your ideal bedtime, wake-up time, and sleep schedule using science-backed 90-minute sleep cycle calculations.
          8 free tools — no signup, no ads, works on any device.
        </p>
        <div class="d-flex flex-wrap gap-3">
          <div class="ms-hero-feature d-flex align-items-center gap-2">
            <svg width="16" height="16" fill="none" stroke="#6c63ff" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            Based on 90-min sleep cycles
          </div>
          <div class="ms-hero-feature d-flex align-items-center gap-2">
            <svg width="16" height="16" fill="none" stroke="#6c63ff" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            Instant results
          </div>
          <div class="ms-hero-feature d-flex align-items-center gap-2">
            <svg width="16" height="16" fill="none" stroke="#6c63ff" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            100% free, no signup
          </div>
        </div>
      </div>
      <div class="col-lg-4 d-none d-lg-flex justify-content-end">
        <div class="ms-hero-stat-box ms-hero-stat-box-sleep">
          <div class="ms-hero-stat-num">8</div>
          <div class="ms-hero-stat-sub">Sleep Tools</div>
          <div class="ms-hero-stat-div"></div>
          <div class="ms-hero-stat-val">2.2M+</div>
          <div class="ms-hero-stat-sub">Monthly searches</div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Tools Grid --}}
<section class="ms-section-tools">
  <div class="container-xl">
    <div class="d-flex align-items-center justify-content-between mb-4">
      <h2 class="ms-section-h2">All Sleep Tools</h2>
      <span class="text-muted-sm">{{ count($tools) }} tools</span>
    </div>
    <div class="row g-4">
      @foreach($tools as $tool)
      <div class="col-sm-6 col-lg-4">
        <a href="/{{ $tool['slug'] }}" class="tool-card ms-tool-card-sleep d-block p-4 h-100 text-decoration-none">
          <div class="d-flex align-items-start gap-3">
            <span class="ms-tool-icon">{{ $tool['icon'] ?? '😴' }}</span>
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
  </div>
</section>

{{-- Why Sleep Cycles Matter --}}
<section class="ms-section-white">
  <div class="container-xl">
    <div class="row g-5 align-items-center">
      <div class="col-lg-6">
        <h2>Why Sleep Cycles Matter</h2>
        <p class="ms-body-text">
          Sleep is not one long block — it's a series of 90-minute cycles, each containing light sleep, deep (slow-wave) sleep, and REM sleep.
          Waking up mid-cycle causes <strong>sleep inertia</strong> — the groggy, disoriented feeling that can last for hours.
        </p>
        <p class="ms-body-text">
          Our sleep calculators align your schedule to natural cycle boundaries so you wake at the lightest sleep stage,
          feeling alert and refreshed — even if you slept fewer total hours.
        </p>
        <a href="/sleep-calculator" class="btn btn-cta" style="font-size:.95rem;">
          Try the Sleep Calculator →
        </a>
      </div>
      <div class="col-lg-6">
        <div class="row g-3">
          @foreach([
            ['😴','7–9 hours','Recommended for adults per night'],
            ['🔄','90 min','Length of one sleep cycle'],
            ['🌙','4–6 cycles','Ideal number of cycles per night'],
            ['⚡','20 min','Perfect nap length for alertness'],
          ] as [$icon,$stat,$label])
          <div class="col-6">
            <div class="tool-card p-4 text-center h-100">
              <div class="ms-cycle-icon">{{ $icon }}</div>
              <div class="ms-cycle-val">{{ $stat }}</div>
              <div class="ms-cycle-label">{{ $label }}</div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

{{-- SEO Content --}}
<section class="ms-section-accent">
  <div class="container ms-longtail">
    <h2 class="mb-4 text-brand">Free Sleep Calculators for Every Sleep Problem</h2>
    <p>Whether you struggle to fall asleep, wake up groggy, work night shifts, or are trying to fix a newborn's schedule, there is a specific calculator for your situation. Our sleep tools cover every major sleep challenge: finding the right bedtime based on sleep cycles, calculating how much sleep debt you have built up, determining when to stop drinking caffeine, recovering from jet lag, and assessing your overall sleep quality with a clinically validated quiz.</p>
    <h2 class="mt-5 mb-4 text-brand">How Sleep Calculators Work — The 90-Minute Cycle Science</h2>
    <p>All sleep timing calculators on this site are based on the 90-minute sleep cycle model, supported by decades of polysomnography research. A complete sleep cycle moves through four stages: N1 (light sleep), N2 (consolidated sleep), N3 (deep slow-wave sleep), and REM (rapid eye movement sleep). Waking at the end of a complete cycle — when you are in the lightest sleep stage — results in feeling refreshed. Waking mid-cycle, particularly during N3 deep sleep, causes sleep inertia.</p>
    <h2 class="mt-5 mb-4 text-brand">Sleep Tools for Shift Workers, Parents, and Students</h2>
    <p>Standard sleep advice assumes a 9-to-5 schedule — but shift workers, new parents, and students face fundamentally different sleep challenges. Night shift workers need to optimise a daytime sleep window. New parents need to understand infant sleep cycles to plan their own rest. Students pulling late nights need to know the minimum effective sleep duration before an exam.</p>
  </div>
</section>

{{-- FAQ --}}
<x-faq-section :faqs="$faqs" id="sleepFaq" />

{{-- Related Tools --}}
<x-related-tools :tools="$relatedTools" heading="Explore More Tools" />

@endsection
