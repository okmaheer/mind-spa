@extends('layouts.app')

@section('title', 'Free Study Tools — Reading Speed Test & More | MindSnap')
@section('description', 'Free study tools including reading speed test (WPM). Shareable results, instant scores, no sign-up.')
@section('canonical', config('app.url') . '/study-tools')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@graph": [
    {
      "@@type": "CollectionPage",
      "@@id": "{{ config('app.url') }}/study-tools#collection",
      "url": "{{ config('app.url') }}/study-tools",
      "name": "Free Study & Learning Tools",
      "description": "Free study tools including reading speed test (WPM). Shareable results, instant scores, no sign-up.",
      "inLanguage": "en",
      "publisher": { "@@type": "Organization", "name": "MindSnap", "url": "{{ config('app.url') }}" },
      "hasPart": [
        { "@@type": "WebApplication", "name": "Reading Speed Test", "url": "{{ config('app.url') }}/reading-speed-test", "applicationCategory": "EducationApplication" }
      ]
    },
    {
      "@@type": "BreadcrumbList",
      "itemListElement": [
        { "@@type": "ListItem", "position": 1, "name": "Home",        "item": "{{ config('app.url') }}" },
        { "@@type": "ListItem", "position": 2, "name": "Study Tools", "item": "{{ config('app.url') }}/study-tools" }
      ]
    },
    {
      "@@type": "FAQPage",
      "mainEntity": [
        { "@@type": "Question", "name": "What is the average reading speed?",              "acceptedAnswer": { "@@type": "Answer", "text": "The average adult reads approximately 200–250 words per minute (WPM) with around 60% comprehension. College students average slightly higher at around 300 WPM." } },
        { "@@type": "Question", "name": "How is reading speed measured in WPM?",          "acceptedAnswer": { "@@type": "Answer", "text": "WPM (words per minute) is calculated by counting the total words read and dividing by the time taken in minutes. A reading speed test presents a timed passage and measures how many words you completed in the allotted time." } },
        { "@@type": "Question", "name": "Can I improve my reading speed?",                "acceptedAnswer": { "@@type": "Answer", "text": "Yes. Techniques include reducing subvocalisation (the habit of silently pronouncing words), using a pointer to guide your eyes, and widening your eye span to take in more words per fixation. Regular practice with timed reading is the most effective method." } },
        { "@@type": "Question", "name": "What is a good reading speed for a student?",   "acceptedAnswer": { "@@type": "Answer", "text": "A reading speed of 300–400 WPM with good comprehension is considered above average and is beneficial for students handling large volumes of text. Elite readers can reach 600+ WPM, but comprehension typically declines above 400 WPM." } },
        { "@@type": "Question", "name": "Does reading speed affect learning?",            "acceptedAnswer": { "@@type": "Answer", "text": "Reading speed affects how much material you can cover, but comprehension matters more than raw speed. A student reading at 250 WPM with 80% retention will learn more than one reading at 500 WPM with 30% retention." } },
        { "@@type": "Question", "name": "How can I share my reading speed result?",       "acceptedAnswer": { "@@type": "Answer", "text": "After completing the reading speed test on MindSnap, your result is displayed with a shareable score card. You can share it directly to social media or copy the link to send to friends." } }
      ]
    }
  ]
}
</script>
@endsection

@php
$cat  = config('mindsnap.categories')['study'];
$faqs = [
  ['q' => 'What is the average reading speed?',
   'a' => 'The average adult reads <strong>200–250 words per minute (WPM)</strong> with around 60% comprehension of the material. College students average slightly higher at around 300 WPM. Professionals who read a great deal for their work (lawyers, academics, journalists) often sit at 400+ WPM.'],
  ['q' => 'How is reading speed measured in WPM?',
   'a' => 'WPM is calculated by counting the total number of words in a passage and dividing by the time taken to read it in minutes. A reading speed test presents a timed passage — when you finish, the tool calculates your WPM automatically. Some tests also include a comprehension check to give you a <strong>reading efficiency score</strong> (WPM × comprehension %).'],
  ['q' => 'Can I improve my reading speed?',
   'a' => 'Yes — with deliberate practice. The most effective techniques are: <strong>reduce subvocalisation</strong> (silently "saying" each word as you read, which caps you at speaking speed), use a pointer or your finger to guide your eye and prevent re-reading, and practice <strong>chunking</strong> — taking in groups of 2–3 words per eye fixation rather than reading word-by-word.'],
  ['q' => 'What is a good reading speed for a student?',
   'a' => 'For academic reading with good retention, <strong>300–400 WPM</strong> is an excellent target. Below 200 WPM, large reading assignments become time-prohibitive. Above 400 WPM, comprehension tends to decline for dense material. For light fiction or familiar topics, 400–600 WPM is achievable without significant comprehension loss.'],
  ['q' => 'Does reading speed affect learning?',
   'a' => 'Reading speed determines how much you can cover, but <strong>comprehension and retention matter more</strong>. A student reading at 250 WPM with 85% retention will outperform one reading at 500 WPM with 40% retention on any test. The goal is not to read as fast as possible — it is to find the fastest speed at which you still understand and remember the material.'],
  ['q' => 'How can I share my reading speed result?',
   'a' => 'After completing the reading speed test, your result is shown as a score card with your WPM and a comparison to average readers. You can share your result directly to social media or copy the link to compare scores with friends, classmates, or colleagues.'],
];

$relatedTools = [
  ['icon' => '⚡', 'name' => 'Productivity Tools', 'slug' => '/productivity-tools', 'desc' => 'Pomodoro timer & focus sessions'],
  ['icon' => '🎮', 'name' => 'Brain Games',        'slug' => '/games',              'desc' => 'Typing speed, memory & reaction tests'],
  ['icon' => '😴', 'name' => 'Sleep Tools',        'slug' => '/sleep-tools',        'desc' => 'Bedtime, sleep cycles & nap calculators'],
  ['icon' => '⏰', 'name' => 'Life Tools',         'slug' => '/life-tools',         'desc' => 'Age, dates & life calculators'],
];
@endphp

@section('content')

{{-- Breadcrumb --}}
<nav aria-label="Breadcrumb" class="ms-cat-nav">
  <div class="container-xl">
    <ol class="breadcrumb mb-0">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Study Tools</li>
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
          <span class="badge ms-badge ms-badge-study">{{ $cat['label'] }}</span>
        </div>
        <h1 class="ms-hero-title">Free Study & Learning Tools</h1>
        <p class="ms-hero-desc-wide">
          Test and improve your reading speed in words per minute. Get an instant WPM score, see how you compare to average readers, and share your result. No sign-up required.
        </p>
        <div class="d-flex flex-wrap gap-3">
          <div class="ms-hero-feature d-flex align-items-center gap-2">
            <svg width="16" height="16" fill="none" stroke="#0277bd" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            Instant WPM score
          </div>
          <div class="ms-hero-feature d-flex align-items-center gap-2">
            <svg width="16" height="16" fill="none" stroke="#0277bd" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            Shareable results
          </div>
          <div class="ms-hero-feature d-flex align-items-center gap-2">
            <svg width="16" height="16" fill="none" stroke="#0277bd" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            No sign-up required
          </div>
        </div>
      </div>
      <div class="col-lg-4 d-none d-lg-flex justify-content-end">
        <div class="ms-hero-stat-box ms-hero-stat-box-study">
          <div class="ms-hero-stat-num">{{ count($tools) }}</div>
          <div class="ms-hero-stat-sub">Study Tools</div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Tools Grid --}}
<section class="ms-section-tools">
  <div class="container-xl">
    <div class="d-flex align-items-center justify-content-between mb-4">
      <h2 class="ms-section-h2">All Study Tools</h2>
      <span class="text-muted-sm">{{ count($tools) }} tools</span>
    </div>
    <div class="row g-4">
      @foreach($tools as $tool)
      <div class="col-sm-6 col-lg-4">
        <a href="/{{ $tool['slug'] }}" class="tool-card ms-tool-card-study d-block p-4 h-100 text-decoration-none">
          <div class="d-flex align-items-start gap-3">
            <span class="ms-tool-icon">{{ $tool['icon'] ?? '📚' }}</span>
            <div>
              <div class="ms-tool-name">{{ $tool['name'] }}</div>
              <div class="ms-tool-desc">{{ $tool['description'] }}</div>
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- Reading Speed Explained --}}
<section class="ms-section-white">
  <div class="container-xl">
    <div class="row g-5 align-items-center">
      <div class="col-lg-6">
        <h2>What Your WPM Score Means</h2>
        <p class="ms-body-text">
          Words per minute (WPM) is the most widely used measure of reading speed. It captures how quickly you process written text, which directly affects how long it takes to get through a textbook chapter, a research paper, or a long report.
        </p>
        <p class="ms-body-text">
          Most adults read at 200–250 WPM — roughly the speed of comfortable speech. With targeted practice, many people can reach 350–400 WPM without sacrificing comprehension. Beyond that, gains in raw speed typically come at the cost of understanding.
        </p>
        <a href="/reading-speed-test" class="btn btn-cta">
          Test Your Reading Speed →
        </a>
      </div>
      <div class="col-lg-6">
        <div class="row g-3">
          @foreach([
            ['📖','200–250 WPM','Average adult reading speed'],
            ['🎓','300 WPM','Average college student'],
            ['🚀','400+ WPM','Above-average proficient reader'],
            ['⚡','600+ WPM','Advanced speed reader'],
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
    <h2 class="mb-4 text-brand">How to Improve Your Reading Speed</h2>
    <p>The single biggest limiter for most adults is subvocalisation — the habit of silently pronouncing each word as you read. Because you cannot "speak" faster than about 250 WPM, this habit creates a ceiling. Techniques like using a visual pointer to guide your eye, practising peripheral reading to widen your eye span, and doing timed reading drills can all help you push past 300 WPM while maintaining comprehension.</p>
    <h2 class="mt-5 mb-4 text-brand">Reading Speed vs. Reading Comprehension</h2>
    <p>Speed without comprehension is not useful reading — it is skimming. Research consistently shows a trade-off: as WPM increases, comprehension percentage tends to decrease. The sweet spot for most study contexts is the fastest speed at which you can still summarise, explain, and apply what you read. For dense academic material, this is usually 200–300 WPM. For familiar or narrative content, it can be 400–600 WPM.</p>
    <h2 class="mt-5 mb-4 text-brand">Reading and Sleep — What the Research Shows</h2>
    <p>Cognitive performance, including reading speed and reading comprehension, degrades measurably with sleep deprivation. Studies show that after 17 hours of wakefulness, cognitive performance is equivalent to a blood alcohol level of 0.05%. If you are studying for exams, adequate sleep the night before is more valuable than an extra hour of reading. Use our <a href="/sleep-calculator">Sleep Calculator</a> to optimise your schedule around study sessions.</p>
  </div>
</section>

{{-- FAQ --}}
<x-faq-section :faqs="$faqs" id="pageFaq" />

{{-- Related Tools --}}
<x-related-tools :tools="$relatedTools" heading="Explore More Tools" />

@endsection
