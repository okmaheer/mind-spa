@extends('layouts.app')

@section('title', 'Free Online Brain Quizzes — IQ Test, General Knowledge & More | MindSnap')
@section('description', 'Free online brain quizzes: IQ test, general knowledge quiz, history quiz, biology, science, geography, maths, World War 2, and human body quiz. 20 questions each. Instant results, no signup required.')
@section('canonical', config('app.url') . '/quizzes')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@graph": [
    {
      "@@type": "CollectionPage",
      "@@id": "{{ config('app.url') }}/quizzes#collection",
      "url": "{{ config('app.url') }}/quizzes",
      "name": "Free Online Brain Quizzes",
      "description": "Free brain quizzes including IQ test, general knowledge, history, biology, science, geography, math, WW2, and human body quizzes. Instant results.",
      "inLanguage": "en",
      "publisher": { "@@type": "Organization", "name": "MindSnap", "url": "{{ config('app.url') }}" }
    },
    {
      "@@type": "BreadcrumbList",
      "itemListElement": [
        { "@@type": "ListItem", "position": 1, "name": "Home",         "item": "{{ config('app.url') }}" },
        { "@@type": "ListItem", "position": 2, "name": "Brain Quizzes","item": "{{ config('app.url') }}/quizzes" }
      ]
    },
    {
      "@@type": "FAQPage",
      "mainEntity": [
        { "@@type": "Question", "name": "Are these quizzes free?",                   "acceptedAnswer": { "@@type": "Answer", "text": "Yes, all quizzes on MindSnap are completely free. No account, no email, no payment required." } },
        { "@@type": "Question", "name": "How accurate is the free IQ test?",         "acceptedAnswer": { "@@type": "Answer", "text": "Our IQ test is a 20-question screener covering logic, pattern recognition, and spatial reasoning. It gives a strong general indication but is not a certified clinical assessment." } },
        { "@@type": "Question", "name": "How many questions are in each quiz?",      "acceptedAnswer": { "@@type": "Answer", "text": "Most quizzes on MindSnap have 20 questions. Results are shown instantly at the end with correct answers." } },
        { "@@type": "Question", "name": "Can I retake a quiz on MindSnap?",          "acceptedAnswer": { "@@type": "Answer", "text": "Yes — you can retake any quiz as many times as you like. Questions are drawn from a larger bank, so you may see different questions each time." } },
        { "@@type": "Question", "name": "Are the quizzes suitable for all ages?",   "acceptedAnswer": { "@@type": "Answer", "text": "The adult quizzes are designed for ages 14+. For younger children, visit the Kids Zone for age-appropriate quizzes designed for ages 5–14." } }
      ]
    }
  ]
}
</script>
@endsection

@php
$cat  = config('mindsnap.categories')['quiz'];
$faqs = [
  ['q' => 'Are these quizzes completely free?',
   'a' => 'Yes — every quiz on MindSnap is 100% free. No account, no email, no payment. Click any quiz and start immediately. Results are shown instantly at the end.'],
  ['q' => 'How accurate is the free IQ test?',
   'a' => 'Our <a href="/iq-test">IQ test</a> is a 20-question cognitive screener covering logic, pattern recognition, and spatial reasoning. It gives a strong general indication but is not a certified clinical assessment. For official IQ testing, consult a licensed psychologist.'],
  ['q' => 'How many questions are in each quiz?',
   'a' => 'Most quizzes have <strong>20 questions</strong>. Questions are multiple choice — tap or click the answer, see instant feedback, and get your final score at the end.'],
  ['q' => 'Can I retake a quiz?',
   'a' => 'Yes — you can retake any quiz as many times as you like. Questions are drawn from a larger bank, so you may see different questions each time.'],
  ['q' => 'Are the quizzes suitable for all ages?',
   'a' => 'The adult quizzes (GK, history, science, etc.) are designed for ages 14+. For younger children, visit our <a href="/kids">Kids Zone</a> for age-appropriate science, animal, and spelling quizzes.'],
  ['q' => 'What is a good IQ score?',
   'a' => 'On a standard IQ scale (mean 100, SD 15): below 70 is significantly below average, 85–115 is average (covers ~68% of the population), 115–130 is above average, 130–145 is gifted, and above 145 is exceptionally gifted. IQ measures specific cognitive abilities — pattern recognition, verbal reasoning, working memory — not general intelligence or life success.'],
  ['q' => 'Can you improve your IQ score?',
   'a' => 'IQ scores are relatively stable in adulthood, but cognitive performance can be significantly improved. Regular aerobic exercise increases BDNF, improving memory and processing speed. Adequate sleep dramatically improves cognitive performance — even one night of poor sleep reduces IQ-equivalent performance by 5–10 points.'],
  ['q' => 'How often should you take a brain quiz?',
   'a' => 'For cognitive training benefits, consistency matters more than frequency. Taking a brain quiz 3–5 times per week for 15–20 minutes produces more benefit than sporadic long sessions. Rotate between different quiz types (general knowledge, pattern recognition, verbal, numerical) to challenge different cognitive domains.'],
];

$relatedTools = [
  ['icon' => '🎮', 'name' => 'Brain Games', 'slug' => '/games',        'desc' => 'Typing speed, memory & reaction tests'],
  ['icon' => '👶', 'name' => 'Kids Zone',   'slug' => '/kids',         'desc' => 'Safe quizzes & games for children'],
  ['icon' => '😴', 'name' => 'Sleep Tools', 'slug' => '/sleep-tools',  'desc' => 'Bedtime & sleep cycle calculators'],
  ['icon' => '💪', 'name' => 'Fitness Tools','slug' => '/fitness-tools','desc' => 'BMI, calories & macro calculators'],
];
@endphp

@section('content')

<nav aria-label="Breadcrumb" class="ms-cat-nav">
  <div class="container-xl">
    <ol class="breadcrumb mb-0">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Brain Quizzes</li>
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
          <span class="ms-cat-badge-quiz">{{ $cat['label'] }}</span>
        </div>
        <h1 class="ms-cat-hero-h1">Free Online Brain Quizzes</h1>
        <p class="ms-cat-hero-p">
          Test your IQ, general knowledge, history, science, geography, and more.
          9 free quizzes with instant results — no signup, no time limit, works anywhere.
        </p>
        <div class="d-flex flex-wrap gap-3">
          <div class="ms-hero-feature d-flex align-items-center gap-2">
            <svg width="16" height="16" fill="none" stroke="#e94560" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            20 questions per quiz
          </div>
          <div class="ms-hero-feature d-flex align-items-center gap-2">
            <svg width="16" height="16" fill="none" stroke="#e94560" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            Instant score &amp; answers
          </div>
          <div class="ms-hero-feature d-flex align-items-center gap-2">
            <svg width="16" height="16" fill="none" stroke="#e94560" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            100% free, no signup
          </div>
        </div>
      </div>
      <div class="col-lg-4 d-none d-lg-flex justify-content-end">
        <div class="ms-hero-stat-box ms-hero-stat-box-quiz">
          <div class="ms-hero-stat-num">9</div>
          <div class="ms-hero-stat-sub">Quizzes &amp; Tests</div>
          <div class="ms-hero-stat-div"></div>
          <div class="ms-hero-stat-val">2M+</div>
          <div class="ms-hero-stat-sub">Monthly searches</div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Featured: IQ Test -- unique design, kept as one-off --}}
<section class="ms-section-tools pb-0">
  <div class="container-xl">
    <div class="row">
      <div class="col-12">
        <div style="background:linear-gradient(135deg,#e94560 0%,#c73652 100%); border-radius:16px; padding:36px 40px; position:relative; overflow:hidden;">
          <div style="position:absolute; right:-20px; top:-20px; font-size:8rem; opacity:.1; line-height:1;">🧩</div>
          <div class="row align-items-center g-3">
            <div class="col-lg-8">
              <div class="d-flex align-items-center gap-2 mb-2">
                <span style="background:rgba(255,255,255,.2); color:#fff; border-radius:50px; padding:3px 12px; font-size:.75rem; font-weight:600;">⭐ Most Popular</span>
                <span style="background:rgba(255,255,255,.2); color:#fff; border-radius:50px; padding:3px 12px; font-size:.75rem; font-weight:600;">1.8M searches/mo</span>
              </div>
              <h2 style="color:#fff; margin-bottom:10px; font-size:1.6rem;">Free IQ Test — 20 Questions</h2>
              <p style="color:rgba(255,255,255,.85); margin-bottom:0; font-size:.95rem; line-height:1.7;">
                Logic, pattern recognition, and spatial reasoning. Get your IQ score estimate instantly. No email required.
              </p>
            </div>
            <div class="col-lg-4 text-lg-end">
              <a href="/iq-test" class="btn" style="background:#fff; color:#e94560; font-weight:700; border-radius:8px; padding:14px 32px; font-size:1rem;">
                Take the IQ Test →
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- All Quizzes Grid --}}
<section class="ms-section-tools">
  <div class="container-xl">
    <h2 class="mb-4 ms-section-h2">All Quizzes</h2>
    <div class="row g-4">
      @php
      $quizList = [
        ['🌍','General Knowledge Quiz', '/quiz/general-knowledge','Science, history, geography & culture. How many of 20 can you get right?','246K'],
        ['🏛️','History Quiz',           '/quiz/history',          'Ancient civilisations, world wars & modern history. 20 questions.',      '90K'],
        ['🔬','Biology Quiz',           '/quiz/biology',          'Cells, genetics, evolution, anatomy & ecosystems. 20 questions.',        '55K'],
        ['⚗️','Science Quiz',           '/quiz/science',          'Physics, chemistry, space, and technology. 20 questions.',               '80K'],
        ['🗺️','Geography Quiz',         '/quiz/geography',        'Capitals, countries, rivers, mountains & oceans. 20 questions.',         '72K'],
        ['➗','Maths Quiz',             '/quiz/math',             'Arithmetic, algebra, geometry & number theory. 20 questions.',           '48K'],
        ['🪖','World War 2 Quiz',       '/quiz/world-war-2',      'Battles, leaders, dates & turning points. 20 questions.',                '40K'],
        ['🫀','Human Body Quiz',        '/quiz/human-body',       'Organs, systems, bones & functions. 20 questions.',                      '33K'],
      ];
      @endphp
      @foreach($quizList as $quiz)
      <div class="col-sm-6 col-lg-4">
        <a href="{{ $quiz[2] }}" class="tool-card d-block p-4 h-100 text-decoration-none ms-tool-card-quiz">
          <div class="d-flex align-items-start gap-3">
            <span class="ms-tool-icon">{{ $quiz[0] }}</span>
            <div>
              <div class="ms-tool-name">{{ $quiz[1] }}</div>
              <div class="ms-tool-desc">{{ $quiz[3] }}</div>
              <div class="mt-2"><span class="badge-searches">{{ $quiz[4] }} searches/mo</span></div>
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- Quick Stats --}}
<section class="ms-section-stats">
  <div class="container-xl">
    <h2 class="text-center mb-2">MindSnap Quiz Fast Facts</h2>
    <p class="text-center mb-5 text-muted-sm" style="max-width:480px; margin:0 auto 40px;">Numbers from our quiz library and player data.</p>
    <div class="row g-3 justify-content-center">
      @foreach([
        ['🧩','9',        'Quiz categories available'],
        ['❓','20',       'Questions per quiz'],
        ['⚡','~5 min',   'Average time to complete'],
        ['📊','Instant',  'Results with full answer review'],
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

{{-- How It Works --}}
<section class="ms-section-stats">
  <div class="container-xl">
    <h2 class="text-center mb-2">Train Your Brain Every Day</h2>
    <p class="text-center mb-5 text-muted-sm" style="max-width:540px; margin:0 auto 40px;">
      Regular quiz practice improves memory retention, general knowledge, and cognitive flexibility.
    </p>
    <div class="row g-4 justify-content-center">
      @foreach([
        ['🎯','Pick a topic',       'Choose from 9 quiz categories — GK, science, history, and more'],
        ['📝','Answer 20 questions','Multiple choice questions with instant feedback after each answer'],
        ['📊','See your score',     'Get your result, correct answers, and a shareable score card'],
      ] as [$icon,$title,$desc])
      <div class="col-md-4">
        <div class="text-center p-4">
          <div class="ms-icon-xl mb-3">{{ $icon }}</div>
          <div class="ms-tool-name mb-2">{{ $title }}</div>
          <div class="ms-tool-desc-lg">{{ $desc }}</div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- SEO Content --}}
<section class="ms-section-seo-alt">
  <div class="container ms-longtail">
    <h2 class="mb-4 text-brand">Free IQ Test Online — How Accurate Are They?</h2>
    <p>Online IQ tests vary enormously in accuracy. Most free tests are significantly easier than clinically validated instruments (like the Wechsler or Stanford-Binet), which causes systematic score inflation — people score 15–20 points higher online than in clinical settings. MindSnap's IQ test is designed to measure relative cognitive performance across verbal reasoning, pattern recognition, and numerical reasoning without inflating scores. It is best understood as a cognitive performance benchmark, not a clinical IQ score.</p>
    <h2 class="mt-5 mb-4 text-brand">General Knowledge Quiz — Test Yourself Across Every Subject</h2>
    <p>General knowledge quizzes test breadth of knowledge across history, science, geography, literature, sport, and current events. Research in cognitive psychology shows that testing yourself on knowledge (rather than re-reading) is one of the most effective learning strategies — a phenomenon known as the "testing effect" or retrieval practice. Taking a quiz is not just a test of what you know; it actively strengthens memory for the information you recall correctly.</p>
    <h2 class="mt-5 mb-4 text-brand">Brain Quizzes for Adults — Cognitive Fitness Benefits</h2>
    <p>Regular cognitive challenges — quizzes, puzzles, learning new skills — are associated with a lower risk of cognitive decline in older adults. A 2014 study in PLOS ONE found that adults who regularly engaged in mentally stimulating activities had a 2.5-year delay in memory decline. Brain quizzes represent one component of a cognitively active lifestyle alongside physical exercise, social engagement, and adequate sleep.</p>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="quizFaq" />

<x-related-tools :tools="$relatedTools" heading="Explore More Tools" />

@endsection
