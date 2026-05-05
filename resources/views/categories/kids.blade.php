@extends('layouts.app')

@section('title', 'Kids Zone — Free Educational Games & Quizzes for Children | MindSnap')
@section('description', 'Free educational activities for kids aged 5–14: math puzzles, word games, science quiz, animal quiz, and spelling quiz. Ad-free, no accounts, no data collection. Safe for classroom and home use.')
@section('canonical', config('app.url') . '/kids')
@section('robots', 'index, follow')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@graph": [
    {
      "@@type": "CollectionPage",
      "@@id": "{{ config('app.url') }}/kids#collection",
      "url": "{{ config('app.url') }}/kids",
      "name": "Kids Zone — Free Educational Games & Quizzes",
      "description": "Free educational games and quizzes for children: math puzzles, word games, science quiz, animal quiz, and spelling quiz. No ads, no accounts.",
      "audience": { "@@type": "EducationalAudience", "educationalRole": "student" },
      "inLanguage": "en",
      "publisher": { "@@type": "Organization", "name": "MindSnap", "url": "{{ config('app.url') }}" }
    },
    {
      "@@type": "BreadcrumbList",
      "itemListElement": [
        { "@@type": "ListItem", "position": 1, "name": "Home",      "item": "{{ config('app.url') }}" },
        { "@@type": "ListItem", "position": 2, "name": "Kids Zone", "item": "{{ config('app.url') }}/kids" }
      ]
    },
    {
      "@@type": "FAQPage",
      "mainEntity": [
        { "@@type": "Question", "name": "Are the kids activities safe and ad-free?",        "acceptedAnswer": { "@@type": "Answer", "text": "Yes. The MindSnap Kids Zone has zero ads, no data collection, no accounts required. It is completely safe for children of all ages." } },
        { "@@type": "Question", "name": "What age group is the Kids Zone designed for?",    "acceptedAnswer": { "@@type": "Answer", "text": "The Kids Zone is designed for children aged 5–14. Activities are levelled by age group." } },
        { "@@type": "Question", "name": "Can teachers use MindSnap in the classroom?",     "acceptedAnswer": { "@@type": "Answer", "text": "Yes. All Kids Zone activities work on tablets, Chromebooks, and desktop browsers with no installation. No school accounts or licences are required." } },
        { "@@type": "Question", "name": "Is MindSnap COPPA and GDPR compliant for children?", "acceptedAnswer": { "@@type": "Answer", "text": "MindSnap Kids Zone collects zero personal data from children, requires no registration, and serves no advertisements. This approach exceeds the requirements of COPPA and GDPR-K." } }
      ]
    }
  ]
}
</script>
@endsection

@php
$cat  = config('mindsnap.categories')['kids'];
$faqs = [
  ['q' => 'Is the Kids Zone completely free and safe?',
   'a' => 'Yes — 100% free, zero ads, zero data collection, no accounts needed. The Kids Zone on MindSnap is one of the few truly safe, ad-free educational platforms available online.'],
  ['q' => 'What age group is the Kids Zone designed for?',
   'a' => 'Content is designed for children aged <strong>5–14</strong>. Spelling and maths activities are levelled by year group (Year 1–6). Science, animal, and word activities suit ages 8–14. Younger children should use the site with a parent.'],
  ['q' => 'Can teachers use MindSnap in the classroom?',
   'a' => 'Yes — teachers are welcome to use any Kids Zone activity in the classroom. All activities work on tablets, Chromebooks, and desktop browsers with no installation required. No school accounts or licences needed.'],
  ['q' => 'How many questions do the kids quizzes have?',
   'a' => 'Most kids quizzes have <strong>15 questions</strong>. Answers are marked instantly after each question. A score screen is shown at the end — a great way for children to track improvement.'],
  ['q' => 'Is MindSnap compliant with child safety laws (COPPA/GDPR)?',
   'a' => 'The MindSnap Kids Zone collects <strong>zero personal data</strong> from children. No registration, no cookies, no tracking, no ads. This approach exceeds COPPA (USA) and GDPR-K (UK/EU) requirements. Parents can let their children use the site with complete confidence.'],
  ['q' => 'What age are MindSnap kids activities suitable for?',
   'a' => 'MindSnap\'s kids activities are designed for children aged 5–14. Younger children (5–7) benefit most from the spelling quiz and animal quiz. Children aged 8–11 suit the science quiz, math puzzles, and word games. Children aged 12–14 can also explore the general knowledge quizzes in the main quizzes section.'],
  ['q' => 'Are these activities suitable for classroom use?',
   'a' => 'Yes — MindSnap\'s kids activities are used by teachers as warm-up activities, end-of-lesson rewards, and homework supplements. They require no accounts or logins, work on school computers and tablets, and comply with typical school technology policies.'],
  ['q' => 'Do the kids activities work on a tablet or phone?',
   'a' => 'Yes — all MindSnap activities are fully responsive and work on smartphones, tablets, laptops, and desktop computers. No app download is required. They are tested on iOS Safari, Android Chrome, and major desktop browsers.'],
];

$relatedTools = [
  ['icon' => '🧠', 'name' => 'Brain Quizzes', 'slug' => '/quizzes',       'desc' => 'IQ test & knowledge quizzes'],
  ['icon' => '🎮', 'name' => 'Brain Games',   'slug' => '/games',         'desc' => 'Typing speed, memory & reaction'],
  ['icon' => '😴', 'name' => 'Sleep Tools',   'slug' => '/sleep-tools',   'desc' => 'Bedtime & sleep cycle calculators'],
  ['icon' => '💪', 'name' => 'Fitness Tools', 'slug' => '/fitness-tools', 'desc' => 'BMI, calories & macros'],
];
@endphp

@section('content')

<nav aria-label="Breadcrumb" class="ms-cat-nav">
  <div class="container-xl">
    <ol class="breadcrumb mb-0">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Kids Zone</li>
    </ol>
  </div>
</nav>

{{-- Hero — unique teal gradient for kids --}}
<section class="ms-cat-hero-kids">
  <div class="container-xl">
    <div class="row align-items-center g-4">
      <div class="col-lg-8">
        <div class="d-flex align-items-center gap-3 mb-3">
          <span class="ms-hero-icon">{{ $cat['icon'] }}</span>
          <div class="d-flex gap-2 flex-wrap">
            <span class="badge" style="background:rgba(255,255,255,.2); color:#fff; border-radius:50px; font-size:.8rem; padding:5px 14px;">Kids Zone</span>
            <span class="badge" style="background:rgba(255,255,255,.15); color:#fff; border-radius:50px; font-size:.78rem; padding:5px 14px;">✓ No Ads</span>
            <span class="badge" style="background:rgba(255,255,255,.15); color:#fff; border-radius:50px; font-size:.78rem; padding:5px 14px;">✓ No Signup</span>
          </div>
        </div>
        <h1 class="ms-cat-hero-h1">Kids Zone — Free Educational Games &amp; Quizzes</h1>
        <p class="ms-cat-hero-p-bright">
          Fun, safe, and educational activities for children aged 5–14. Maths puzzles, spelling, science, word games, and animal quizzes —
          completely free with no ads, no accounts, and no data collected.
        </p>
        <div style="background:rgba(255,255,255,.15); border:1px solid rgba(255,255,255,.3); border-radius:10px; padding:14px 20px; display:inline-flex; align-items:center; gap:10px;">
          <span style="font-size:1.4rem;">🔒</span>
          <span style="color:#fff; font-size:.88rem; font-weight:600;">Safe for Kids — Zero ads, zero tracking, zero data collection</span>
        </div>
      </div>
      <div class="col-lg-4 d-none d-lg-flex justify-content-end">
        <div style="background:rgba(255,255,255,.15); border:1px solid rgba(255,255,255,.25); border-radius:16px; padding:28px 32px; text-align:center;">
          <div class="ms-hero-stat-num">5</div>
          <div style="color:rgba(255,255,255,.8); font-size:.9rem;">Activities</div>
          <div style="height:1px; background:rgba(255,255,255,.2); margin:14px 0;"></div>
          <div class="ms-hero-stat-val">Ages 5–14</div>
          <div style="color:rgba(255,255,255,.8); font-size:.9rem;">Designed for</div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Activities Grid --}}
<section class="ms-section-tools">
  <div class="container-xl">
    <h2 class="mb-2 ms-section-h2">Learning Activities</h2>
    <p class="mb-4 text-muted-sm">Tap any activity to start — no loading screens, no signups.</p>

    @if(count($tools))
    <div class="row g-4">
      @foreach($tools as $tool)
      <div class="col-sm-6 col-lg-4">
        <a href="/{{ $tool['slug'] }}" class="tool-card d-block p-4 h-100 text-decoration-none ms-tool-card-kids">
          <div class="d-flex align-items-start gap-3">
            <span class="ms-tool-icon">{{ $tool['icon'] ?? '👶' }}</span>
            <div>
              <div class="ms-tool-name">{{ $tool['name'] }}</div>
              <div class="ms-tool-desc">{{ $tool['description'] }}</div>
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
    @else
    <div class="row g-4">
      @foreach([
        ['🔢','Maths Puzzles', '/kids/math-puzzles',  'Addition, subtraction, multiplication & more. Levelled by age for children 6–12.','Ages 6–12'],
        ['📝','Word Games',    '/kids/word-games',     'Vocabulary building, word matching, and spelling activities. Fun and educational.','Ages 7–13'],
        ['🔬','Science Quiz',  '/kids/science-quiz',   'Biology, chemistry, physics & space. 15 illustrated questions for curious minds.', 'Ages 8–14'],
        ['🦁','Animal Quiz',   '/kids/animal-quiz',    'Mammals, reptiles, ocean creatures & birds. 15 fun animal questions.',             'Ages 5–12'],
        ['🔤','Spelling Quiz', '/kids/spelling-quiz',  'Graded word lists from Year 1 through Year 6. Practice anytime.',                  'Ages 5–12'],
      ] as [$icon,$name,$slug,$desc,$age])
      <div class="col-sm-6 col-lg-4">
        <a href="{{ $slug }}" class="tool-card d-block p-4 h-100 text-decoration-none ms-tool-card-kids">
          <div class="d-flex align-items-start gap-3">
            <span class="ms-tool-icon">{{ $icon }}</span>
            <div>
              <div class="ms-tool-name">{{ $name }}</div>
              <div class="ms-tool-desc mb-2">{{ $desc }}</div>
              <span style="background:rgba(23,162,184,.12); color:#0d7a8d; border-radius:50px; padding:2px 10px; font-size:.75rem; font-weight:600;">{{ $age }}</span>
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
    @endif
  </div>
</section>

{{-- Safety Promise --}}
<section class="ms-section-stats">
  <div class="container-xl">
    <div class="row g-4 align-items-center">
      <div class="col-lg-6">
        <h2>Safe for Every Child</h2>
        <p class="ms-body-text">
          The MindSnap Kids Zone was built with one rule: <strong>children come first</strong>.
          Every activity is reviewed for age-appropriateness, accuracy, and educational value.
        </p>
        <p class="ms-body-text">
          Unlike other free educational sites, we show <strong>zero advertisements</strong> in the Kids Zone,
          collect <strong>no personal data</strong>, and require <strong>no accounts</strong> — ever.
        </p>
      </div>
      <div class="col-lg-6">
        <div class="row g-3">
          @foreach([
            ['🚫','No Ads',            'Zero advertising in the entire Kids Zone — no banners, no video ads, no pop-ups'],
            ['🔒','No Data',           'We collect no personal data from children. No cookies, no tracking'],
            ['👤','No Accounts',       'No registration or login required. Just open and play'],
            ['✅','Age-Appropriate',   'All content reviewed and graded for specific age groups'],
          ] as [$icon,$title,$desc])
          <div class="col-6">
            <div class="tool-card p-4 h-100">
              <div class="ms-mini-icon">{{ $icon }}</div>
              <div class="ms-tool-name">{{ $title }}</div>
              <div class="ms-tool-desc">{{ $desc }}</div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

{{-- SEO Content --}}
<section class="ms-section-seo-alt">
  <div class="container ms-longtail">
    <h2 class="mb-4 text-brand">Free Educational Games for Kids Aged 5–14</h2>
    <p>Educational games are most effective when they balance challenge and achievement — the "flow state" described by psychologist Mihaly Csikszentmihalyi. MindSnap's kids activities are designed to sit at the edge of each age group's ability: familiar enough to engage, challenging enough to build real skills. Math puzzles build number sense and arithmetic fluency. Spelling quizzes reinforce phonics patterns. Science and animal quizzes develop factual knowledge — all without screen-time pressure or in-app purchases.</p>
    <h2 class="mt-5 mb-4 text-brand">Educational Quizzes for Kids — How Quizzing Helps Learning</h2>
    <p>The testing effect is one of the most replicated findings in educational psychology: being tested on information strengthens memory far more effectively than re-reading or passive review. A child who takes a quiz about animals remembers more animal facts one week later than a child who read the same facts in a book. This is why quizzing is a legitimate, research-backed learning strategy — not just assessment.</p>
    <h2 class="mt-5 mb-4 text-brand">Safe Online Activities for Children — Our Approach</h2>
    <p>MindSnap Kids is built with child safety as the primary design constraint. There are no user accounts, no data collection, no behavioural tracking, no social features, no in-app purchases, and no advertising. Children interact only with educational content. All activities work on any device with a browser — no app download required. The site is fully compliant with COPPA (US) and GDPR-K (EU) because we collect no personal data whatsoever.</p>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="kidsFaq" />

<x-related-tools :tools="$relatedTools" heading="For Adults — Explore More" />

@endsection
