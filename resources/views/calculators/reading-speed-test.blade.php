@extends('layouts.app')

@section('title', 'Reading Speed Test — Free WPM Test Online | MindSnap')
@section('description', 'Test your reading speed in words per minute — free and instant. Find out your WPM, see how you compare to the average reader, and get tips to improve.')
@section('canonical', config('app.url') . '/reading-speed-test')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "WebApplication",
  "name": "Reading Speed Test",
  "url": "{{ config('app.url') }}/reading-speed-test",
  "description": "Free online reading speed test. Measure your words per minute, compare to average readers, and get personalised tips to read faster.",
  "applicationCategory": "EducationApplication",
  "operatingSystem": "Any",
  "offers": { "@@type": "Offer", "price": "0", "priceCurrency": "USD" },
  "publisher": { "@@type": "Organization", "name": "MindSnap", "url": "{{ config('app.url') }}" }
}
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "BreadcrumbList",
  "itemListElement": [
    { "@@type": "ListItem", "position": 1, "name": "Home",        "item": "{{ config('app.url') }}" },
    { "@@type": "ListItem", "position": 2, "name": "Study Tools", "item": "{{ config('app.url') }}/study-tools" },
    { "@@type": "ListItem", "position": 3, "name": "Reading Speed Test" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [
    { "@@type": "Question", "name": "What is the average reading speed for adults?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The average adult reads at approximately 238 words per minute (WPM) when reading silently for comprehension. College students average around 300 WPM. These figures come from studies by Marc Brysbaert at Ghent University, which analysed reading speeds across 17 languages and nearly 1,800 participants." } },
    { "@@type": "Question", "name": "What is a good reading speed?",
      "acceptedAnswer": { "@@type": "Answer", "text": "A good reading speed for comprehension is 250–350 WPM (above average). Speed readers who maintain high comprehension typically reach 400–500 WPM. Anything above 500 WPM with retained comprehension is considered exceptional. Faster is not always better — comprehension is more important than raw WPM." } },
    { "@@type": "Question", "name": "Can I actually improve my reading speed?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes. Research shows that targeted practice — particularly reducing subvocalization (the inner voice), expanding eye span to take in groups of words, and minimising regressions (re-reading) — can increase reading speed by 20–50% with maintained comprehension. However, extreme speed-reading claims of 1,000+ WPM with full comprehension are not supported by cognitive science." } },
    { "@@type": "Question", "name": "What is subvocalization and how does it limit reading speed?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Subvocalization is the internal speech most readers engage in — silently pronouncing words as they read. Because speech is limited to roughly 150 words per minute, subvocalizing every word caps reading speed near that rate. Reducing (not eliminating) subvocalization is one of the most effective ways to increase WPM." } },
    { "@@type": "Question", "name": "How accurate is this WPM test?",
      "acceptedAnswer": { "@@type": "Answer", "text": "This test measures the time from when you start reading to when you click 'I'm Done', then calculates WPM from the passage word count divided by elapsed minutes. The result reflects your natural reading pace for a given passage — it does not measure comprehension. For the most accurate result, read at your normal pace without skimming." } },
    { "@@type": "Question", "name": "Does reading speed differ by content type?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes, significantly. People read fiction faster than non-fiction, and non-fiction faster than technical or academic content. The average adult reads fiction at around 260 WPM, non-fiction at 230 WPM, and technical material at 180–200 WPM. Your WPM on this test may differ from your speed on other types of material." } },
    { "@@type": "Question", "name": "How many words per minute is speed reading?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Speed reading is generally defined as sustained reading above 400 WPM with retained comprehension. Skilled speed readers reach 500–700 WPM. Some speed reading courses claim 1,000–2,000 WPM, but cognitive research indicates comprehension drops significantly above 600 WPM. The most realistic achievable target with training is 400–600 WPM." } },
    { "@@type": "Question", "name": "How long does it take to read a 300-page book?",
      "acceptedAnswer": { "@@type": "Answer", "text": "A standard 300-page novel contains approximately 90,000 words. At the average reading speed of 238 WPM, that takes roughly 6.3 hours of continuous reading — or more realistically, 8–10 hours over several sittings. At 400 WPM, it drops to about 3.75 hours. The calculator in this tool shows your personalised estimate." } }
  ]
}
</script>
@endsection

@php
$faqs = [
  ['q' => 'What is the average reading speed for adults?',
   'a' => 'The average adult reads at approximately 238 words per minute (WPM) when reading silently for comprehension. College students average around 300 WPM. These figures come from a landmark study by Marc Brysbaert at Ghent University, which analysed reading speeds across 17 languages and nearly 1,800 participants — one of the largest and most methodologically rigorous studies on reading speed.'],
  ['q' => 'What is a good reading speed?',
   'a' => 'A reading speed of 250–350 WPM with good comprehension is above average. Speed readers who maintain high comprehension typically reach 400–600 WPM. Anything above 600 WPM with genuine understanding is exceptional and rare. Raw WPM is less important than comprehension — a 200 WPM reader who retains everything outperforms a 400 WPM reader who remembers little.'],
  ['q' => 'Can I actually improve my reading speed?',
   'a' => 'Yes. Research shows that targeted practice — reducing subvocalization, expanding your eye span, and minimising backward regressions — can increase reading speed by 20–50% with maintained comprehension. However, extreme claims of 1,000+ WPM with full comprehension are not supported by cognitive science. Realistic targets for trained readers are 400–600 WPM.'],
  ['q' => 'What is subvocalization and how does it limit reading speed?',
   'a' => 'Subvocalization is the inner voice that silently pronounces words as you read. Because natural speech is limited to roughly 120–150 words per minute, readers who fully subvocalize every word are capped near that rate. Reducing (not eliminating) subvocalization — particularly for familiar words — is the single most effective technique for increasing reading speed.'],
  ['q' => 'How accurate is this WPM test?',
   'a' => 'This test measures elapsed time from when you begin reading to when you click "I\'m Done", then calculates WPM from the passage word count divided by elapsed minutes. It reflects your natural silent reading pace. For the most accurate result, read at your normal pace without skimming. The test does not measure comprehension — it measures speed only.'],
  ['q' => 'Does reading speed differ by content type?',
   'a' => 'Yes, significantly. People typically read fiction at around 260 WPM, general non-fiction at 230 WPM, and technical or academic content at 180–200 WPM. Your result on this test (general interest passages) may be faster than your speed on complex academic papers or slower than your speed on light fiction. Always interpret WPM in context of content type.'],
  ['q' => 'How many words per minute is speed reading?',
   'a' => 'Speed reading is generally defined as sustained reading above 400 WPM with retained comprehension. Most skilled speed readers reach 500–700 WPM. Some courses claim 1,000–2,000 WPM, but cognitive research (particularly studies on eye movements and working memory) indicates comprehension degrades significantly above 600 WPM. A realistic achievable target with focused practice is 400–600 WPM.'],
  ['q' => 'How long does it take to read a 300-page book?',
   'a' => 'A standard 300-page novel contains approximately 90,000 words. At the average reading speed of 238 WPM, that takes roughly 6.3 hours of continuous reading — or 8–10 hours over typical reading sessions. At 400 WPM, it drops to about 3.75 hours. The result card in this test shows your personalised estimate based on your actual WPM.'],
  ['q' => 'Why is my WPM different each time I test?',
   'a' => 'Reading speed varies with topic familiarity, time of day, fatigue, focus level, and the specific passage content. Testing with three different passages (as this tool allows) and averaging the results gives a more accurate picture of your typical reading speed than a single test. Expect 10–20% natural variation between sessions.'],
  ['q' => 'Should children\'s reading speed be measured differently?',
   'a' => 'Yes. Children\'s reading speeds are significantly lower than adults and develop rapidly with age and practice. A typical 10-year-old reads at 100–150 WPM, a 14-year-old at 150–200 WPM, and reading speed typically reaches adult levels by the late teens. Fluency norms for children are better assessed with age-appropriate passages and standardised assessments.'],
];

$relatedTools = [
  ['icon' => '🍅', 'name' => 'Pomodoro Timer',       'slug' => 'pomodoro-timer',       'desc' => 'Focus in 25-minute sessions with the Pomodoro Technique.'],
  ['icon' => '⌨️', 'name' => 'Typing Speed Test',    'slug' => 'typing-speed-test',    'desc' => 'Test your WPM on the keyboard.'],
  ['icon' => '🧠', 'name' => 'Memory Test',           'slug' => 'memory-test',          'desc' => 'Test and train your working memory.'],
  ['icon' => '📚', 'name' => 'Study Tools',           'slug' => 'study-tools',          'desc' => 'All tools to study smarter, not harder.'],
  ['icon' => '🎯', 'name' => 'Focus Mode',            'slug' => 'focus-mode',           'desc' => 'Block distractions and enter deep work.'],
  ['icon' => '💡', 'name' => 'Brain Games',           'slug' => 'brain-games',          'desc' => 'Sharpen your mind with cognitive challenges.'],
];
@endphp

@section('styles')
<style>
/* ── Passage selector ── */
.rst-passage-btn          { border: 2px solid var(--border); border-radius: 50px; background: #fff; color: var(--text); font-size: .82rem; font-weight: 600; padding: 7px 18px; cursor: pointer; transition: border-color .2s, background .2s, color .2s; }
.rst-passage-btn:hover    { border-color: var(--study); color: var(--study); }
.rst-passage-btn-active   { border-color: var(--study); background: var(--study); color: #fff; }

/* ── Instruction block ── */
.rst-instruction          { background: #f0f7ff; border: 1px solid #cce0ff; border-radius: 12px; }
.rst-instruction-text     { font-size: .93rem; color: #1a4a7a; line-height: 1.7; }

/* ── Passage text ── */
.rst-passage-wrap         { background: #fafafa; border: 1px solid #e8e8e8; border-radius: 12px; }
.rst-passage-text         { font-size: 1rem; line-height: 1.9; color: var(--text); }

/* ── Timer badge ── */
.rst-timer-badge          { background: var(--primary-dark); color: #fff; border-radius: 8px; font-variant-numeric: tabular-nums; font-weight: 700; font-size: .95rem; padding: 6px 14px; }

/* ── Start / Done buttons ── */
.rst-btn-start            { padding: 14px 40px; font-size: 1rem; font-weight: 700; border-radius: 50px; border: none; background: var(--study); color: #fff; cursor: pointer; transition: background .2s, transform .1s; }
.rst-btn-start:hover      { background: #016db0; transform: translateY(-1px); }
.rst-btn-done             { padding: 14px 40px; font-size: 1rem; font-weight: 700; border-radius: 50px; border: none; background: var(--fitness); color: #fff; cursor: pointer; transition: background .2s, transform .1s; }
.rst-btn-done:hover       { background: #1e8c38; transform: translateY(-1px); }
.rst-btn-again            { padding: 12px 32px; font-size: .95rem; font-weight: 700; border-radius: 50px; border: 2px solid var(--study); background: transparent; color: var(--study); cursor: pointer; transition: background .2s, color .2s; }
.rst-btn-again:hover      { background: var(--study); color: #fff; }

/* ── WPM display ── */
.rst-wpm-number           { font-size: clamp(3.5rem, 14vw, 6rem); font-weight: 800; line-height: 1; color: var(--primary-dark); }
.rst-wpm-unit             { font-size: 1rem; font-weight: 600; color: var(--text-muted); margin-top: 4px; }

/* ── Category badge ── */
.rst-cat-badge            { display: inline-block; border-radius: 50px; padding: 6px 18px; font-size: .82rem; font-weight: 700; }
.rst-result-slow          { background: #ffecec; color: #b91c1c; }
.rst-result-average       { background: #fff8e1; color: #92400e; }
.rst-result-above         { background: #e6f7ee; color: #065f46; }
.rst-result-fast          { background: #e0f2fe; color: #0369a1; }
.rst-result-speed         { background: #f0f4ff; color: #3730a3; }
.rst-result-exceptional   { background: #fdf4ff; color: #7e22ce; }

/* ── Result stat cards ── */
.rst-stat-card            { border-radius: 12px; text-align: center; padding: 16px 10px; }
.rst-stat-val             { font-size: 1.4rem; font-weight: 800; color: var(--primary-dark); }
.rst-stat-lbl             { font-size: .73rem; color: #888; margin-top: 3px; }

/* ── Percentile bar ── */
.rst-pct-track            { background: #eef0f2; border-radius: 50px; height: 10px; overflow: hidden; }
.rst-pct-bar              { height: 100%; border-radius: 50px; background: linear-gradient(90deg, var(--study) 0%, #6c63ff 100%); transition: width 1s ease; }

/* ── Benchmarks table ── */
.rst-bench-row            { border-bottom: 1px solid #f0f0f0; }
.rst-bench-row:last-child { border-bottom: none; }
.rst-bench-dot            { width: 10px; height: 10px; border-radius: 50%; display: inline-block; flex-shrink: 0; }
.rst-dot-slow             { background: #b91c1c; }
.rst-dot-average          { background: #92400e; }
.rst-dot-above            { background: #065f46; }
.rst-dot-fast             { background: #0369a1; }
.rst-dot-speed            { background: #3730a3; }
.rst-dot-exceptional      { background: #7e22ce; }
/* ── Percentile bar starts at zero width ── */
.rst-pct-bar              { width: 0; }

/* ── Tips list ── */
.rst-tip-icon             { font-size: 1.4rem; flex-shrink: 0; margin-top: 2px; }
.rst-tip-title            { font-weight: 700; color: var(--primary-dark); font-size: .95rem; }
.rst-tip-desc             { font-size: .88rem; color: var(--text-muted); line-height: 1.65; margin-top: 3px; }

/* ── Comprehension quiz ── */
.rst-quiz-q               { font-weight: 600; font-size: .9rem; margin-bottom: 8px; }
.rst-quiz-opt             { display: flex; align-items: center; gap: 8px; padding: 8px 12px; border-radius: 8px; border: 1px solid #e0e0e0; margin-bottom: 6px; cursor: pointer; font-size: .88rem; transition: background .15s, border-color .15s; }
.rst-quiz-opt:hover       { background: #f0f7ff; border-color: #90c8f0; }
.rst-quiz-opt-selected    { background: #e3f2fd; border-color: #2196f3; }
.rst-quiz-opt-correct     { background: #e8f5e9; border-color: #28a745; color: #155724; }
.rst-quiz-opt-wrong       { background: #ffecec; border-color: #dc3545; color: #b91c1c; text-decoration: line-through; }
.rst-comp-box             { border-radius: 10px; padding: 12px 16px; font-size: .85rem; }
.rst-comp-ok              { background: #e8f5e9; color: #155724; }
.rst-comp-warn            { background: #fff3cd; color: #664d03; }
.rst-adv-toggle           { font-size: .85rem; font-weight: 600; color: var(--study); cursor: pointer; border: none; background: none; padding: 4px 0; margin-top: 8px; }
.rst-adv-toggle::after    { content: '  ▾'; }
.rst-adv-toggle[aria-expanded="true"]::after { content: '  ▲'; }
.rst-hist-item            { display: flex; align-items: center; gap: 10px; padding: 8px 0; border-bottom: 1px solid #f0f0f0; font-size: .85rem; }
.rst-hist-item:last-child { border-bottom: none; }
.rst-hist-wpm             { font-weight: 800; color: var(--primary-dark); min-width: 60px; }
</style>
@endsection

@section('content')

<section class="ms-hero">
  <div class="container-xl">
    <div class="row align-items-start g-5">

      <div class="col-lg-7">
        <x-breadcrumb :crumbs="[
          ['url' => route('home'),           'name' => 'Home'],
          ['url' => route('category.study'), 'name' => 'Study Tools'],
          ['url' => '',                      'name' => 'Reading Speed Test'],
        ]"/>

        <h1 class="mb-2 ms-hero-title">📖 Reading Speed Test — Free WPM Test</h1>
        <p class="ms-hero-desc">Find out how many words per minute you read, how you compare to the average adult, and how long it would take you to finish a novel.</p>

        <div class="card border-0 mb-n4 ms-tool-card">
          <div class="card-body p-4 p-md-5">

            {{-- Passage selector --}}
            <div class="mb-4">
              <div class="fw-600 mb-2 text-brand" id="rstPassageLabel">Choose a passage:</div>
              <div class="d-flex gap-2 flex-wrap" id="rstPassageBtns">
                <button class="rst-passage-btn rst-passage-btn-active" onclick="rstSelectPassage(0)" id="rstPBtn0">Sleep &amp; Cognition</button>
                <button class="rst-passage-btn"                        onclick="rstSelectPassage(1)" id="rstPBtn1">History of the Internet</button>
                <button class="rst-passage-btn"                        onclick="rstSelectPassage(2)" id="rstPBtn2">Nutrition &amp; the Body</button>
              </div>
            </div>

            {{-- Instruction block (shown before test starts) --}}
            <div class="rst-instruction p-4 mb-4" id="rstInstruction">
              <div class="rst-instruction-text">
                <strong>How it works:</strong> Click <em>Start Reading</em> below — the timer begins and the passage appears. Read at your natural pace (do not skim). When you finish, click <em>I'm Done</em> to see your result.
              </div>
            </div>

            {{-- Passage area (hidden until started) --}}
            <div class="rst-passage-wrap p-4 mb-4 d-none" id="rstPassageWrap">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="fw-600 text-sm text-muted" id="rstPassageTitle">Passage 1</div>
                <div class="rst-timer-badge" id="rstTimerBadge">0:00</div>
              </div>
              <div class="rst-passage-text" id="rstPassageText"></div>
            </div>

            {{-- Comprehension quiz (shown after reading, before result) --}}
            <div class="d-none" id="rstQuizWrap">
              <div class="ms-divider mb-3"></div>
              <p class="fw-semibold mb-3 text-brand">Quick check — 3 questions about what you just read:</p>
              <div id="rstQuizQuestions"></div>
              <button class="btn btn-cta w-100 mt-3" onclick="rstSubmitQuiz()">Check Answers →</button>
            </div>

            {{-- Result section (hidden until done) --}}
            <div class="d-none" id="rstResult">
              <div class="ms-divider"></div>
              <div class="text-center mb-4">
                <div class="text-muted text-sm mb-1">Your reading speed</div>
                <div class="rst-wpm-number" id="rstWpmNumber">0</div>
                <div class="rst-wpm-unit">words per minute</div>
                <div class="mt-3" id="rstCatBadgeWrap"></div>
              </div>

              <div class="row g-3 mb-4">
                <div class="col-6 col-md-3">
                  <div class="rst-stat-card ms-stat-blue">
                    <div class="rst-stat-val" id="rstStatWpm">—</div>
                    <div class="rst-stat-lbl">WPM</div>
                  </div>
                </div>
                <div class="col-6 col-md-3">
                  <div class="rst-stat-card ms-stat-green">
                    <div class="rst-stat-val" id="rstStatPct">—</div>
                    <div class="rst-stat-lbl">% of readers</div>
                  </div>
                </div>
                <div class="col-6 col-md-3">
                  <div class="rst-stat-card ms-stat-orange">
                    <div class="rst-stat-val" id="rstStatTime">—</div>
                    <div class="rst-stat-lbl">Secs elapsed</div>
                  </div>
                </div>
                <div class="col-6 col-md-3">
                  <div class="rst-stat-card ms-stat-purple">
                    <div class="rst-stat-val" id="rstStatBook">—</div>
                    <div class="rst-stat-lbl">Hrs for 300pp book</div>
                  </div>
                </div>
              </div>

              <div class="mb-3">
                <div class="d-flex justify-content-between mb-1">
                  <span class="text-sm fw-600 text-muted">Better than <span id="rstPctText">0</span>% of readers</span>
                  <span class="text-sm text-muted">Avg: 238 WPM</span>
                </div>
                <div class="rst-pct-track">
                  <div class="rst-pct-bar" id="rstPctBar"></div>
                </div>
              </div>

              <div id="rstCompBox" class="rst-comp-box rst-comp-ok mb-3 d-none"></div>

              <div class="text-center mb-2">
                <button class="rst-btn-again" onclick="rstReset()">Test Again</button>
              </div>

              <div class="text-center">
                <button class="rst-adv-toggle" type="button" data-bs-toggle="collapse"
                        data-bs-target="#rstHistory" aria-expanded="false"
                        aria-controls="rstHistory">
                  Show WPM history
                </button>
                <div class="collapse mt-2 text-start" id="rstHistory">
                  <div id="rstHistList"></div>
                </div>
              </div>
            </div>

            {{-- CTA buttons --}}
            <div class="text-center mt-2" id="rstBtnArea">
              <button class="rst-btn-start" id="rstBtnStart" onclick="rstStart()">Start Reading</button>
              <button class="rst-btn-done  d-none" id="rstBtnDone" onclick="rstFinish()">I'm Done</button>
            </div>

          </div>
        </div>
      </div>

      {{-- Right column --}}
      <div class="col-lg-5 d-none d-lg-block pt-2">
        <div class="ms-facts-wrap">
          <h3 class="ms-facts-title">Reading Speed Benchmarks</h3>
          @foreach([
            ['238 WPM', 'Average silent reading speed for adults'],
            ['300 WPM', 'Average college student reading speed'],
            ['150 WPM', 'Average out-loud reading speed'],
            ['500 WPM', 'Skilled speed reader threshold'],
            ['90,000',  'Words in a typical 300-page novel'],
          ] as [$stat, $label])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div class="ms-fact-pill ms-fact-pill-dark">{{ $stat }}</div>
            <div class="ms-fact-label">{{ $label }}</div>
          </div>
          @endforeach
        </div>
      </div>

    </div>
  </div>
</section>

{{-- What Is a Good Reading Speed --}}
<section class="ms-section-white">
  <div class="container-xl">
    <div class="text-center mb-5">
      <h2>What Is a Good Reading Speed?</h2>
<img src="{{ asset('images/reading-speed-scale.svg') }}" alt="Reading speed scale showing average WPM ranges from slow reader to speed reader" width="640" height="130" loading="lazy" class="img-fluid rounded-3 mb-4">
      <p class="text-muted ms-intro-text">Reading speed varies widely by age, education, and practice. Here is how different WPM ranges compare.</p>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-9">
        <div class="card border-0 ms-card-data">
          <div class="table-responsive">
            <table class="table mb-0">
              <thead class="ms-table-head">
                <tr>
                  <th class="py-3 ps-4">Category</th>
                  <th class="py-3">WPM Range</th>
                  <th class="py-3">Description</th>
                </tr>
              </thead>
              <tbody>
                @foreach([
                  ['rst-dot-slow',        'Below 150',   'Slow reader',         'Below average — common with reading difficulties, unfamiliar content, or infrequent reading practice.'],
                  ['rst-dot-average',     '150–250',     'Average adult',       'The typical silent reading range for adults across most content types.'],
                  ['rst-dot-above',       '250–350',     'Above average',       'Readers in this range typically read frequently and have strong vocabulary.'],
                  ['rst-dot-fast',        '350–500',     'Fast / proficient',   'Fast readers who maintain high comprehension — above 85th percentile.'],
                  ['rst-dot-speed',       '500–700',     'Speed reader',        'Skilled speed readers using chunking and reduced subvocalization.'],
                  ['rst-dot-exceptional', '700+',        'Exceptional',         'Highly trained readers. Comprehension should be verified at this range.'],
                ] as [$dotCls, $range, $cat, $desc])
                <tr class="rst-bench-row">
                  <td class="ps-4 py-3">
                    <div class="d-flex align-items-center gap-2">
                      <span class="rst-bench-dot {{ $dotCls }}"></span>
                      <span class="fw-600 text-sm">{{ $cat }}</span>
                    </div>
                  </td>
                  <td class="py-3 fw-700">{{ $range }}</td>
                  <td class="py-3 text-sm text-muted">{{ $desc }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <p class="ms-source">Source: Brysbaert (2019), "How many words do we read per minute?" — Psychological Bulletin.</p>
      </div>
    </div>
  </div>
</section>

{{-- How to Read Faster --}}
<section class="ms-section-accent">
  <div class="container-xl">
    <div class="text-center mb-5">
      <span class="ms-badge ms-badge-study mb-3">Science-Backed Techniques</span>
      <h2>How to Read Faster</h2>
      <p class="text-muted ms-intro-text">These five techniques are supported by research in cognitive psychology and reading science.</p>
    </div>
    <div class="row g-4">
      @foreach([
        ['🗣', 'Reduce Subvocalization',
         'Subvocalization — the inner voice that pronounces words as you read — is the biggest limiter for most readers. Practice consciously suppressing it for common, short words while keeping it for complex or unfamiliar terms. This alone can increase speed by 30–50% for fluent readers.'],
        ['👁', 'Expand Your Eye Span',
         'The average reader fixates on individual words. Trained readers learn to capture clusters of 2–4 words per eye fixation. Practice by focusing on the middle of a line and trying to perceive the surrounding words without moving your eyes. This reduces the total number of eye movements per page.'],
        ['↩', 'Eliminate Regressions',
         'Regressions are backward eye movements — re-reading words or sentences you have already passed. Studies show that up to 30% of an average reader\'s eye movements are regressions. Use a finger or pointer moving forward at a constant pace to train your eyes to keep moving.'],
        ['🧱', 'Chunk Text into Phrases',
         'Rather than reading word by word, train yourself to read in meaningful phrases. Your brain can process an entire phrase as a unit if the words are familiar enough. Reading in chunks reduces the total number of processing steps per sentence and naturally accelerates pace.'],
        ['🔄', 'Practice Daily with a Timer',
         'Reading speed, like any skill, improves with deliberate practice. Set a 10-minute daily reading session with a timer — read slightly faster than is comfortable, then test comprehension. Research on spaced practice shows that even 15 minutes per day, consistently applied, produces measurable WPM gains within 4–6 weeks.'],
      ] as [$icon, $title, $desc])
      <div class="col-md-6">
        <div class="d-flex gap-3 align-items-start">
          <div class="rst-tip-icon">{{ $icon }}</div>
          <div>
            <div class="rst-tip-title">{{ $title }}</div>
            <div class="rst-tip-desc">{{ $desc }}</div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- Average Reading Speed by Age --}}
<section class="ms-section-white">
  <div class="container-xl">
    <div class="text-center mb-5">
      <h2>Average Reading Speed by Age</h2>
      <p class="text-muted ms-intro-text">Reading speed develops rapidly through childhood and stabilises in early adulthood.</p>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card border-0 ms-card-data">
          <div class="table-responsive">
            <table class="table mb-0">
              <thead class="ms-table-head">
                <tr>
                  <th class="py-3 ps-4">Age / Stage</th>
                  <th class="py-3">Avg WPM</th>
                  <th class="py-3">Notes</th>
                </tr>
              </thead>
              <tbody>
                @foreach([
                  ['Child (age 6–8)',         '30–80',    'Learning to decode — phonics-based reading, word-by-word.'],
                  ['Child (age 9–11)',         '100–150',  'Fluency developing; reading for meaning begins.'],
                  ['Teen (age 12–14)',         '150–200',  'Near-adult comprehension; speed catching up.'],
                  ['Teen (age 15–18)',         '200–250',  'Approaching adult average; vocabulary expanding rapidly.'],
                  ['Adult (general)',          '238',      'Average silent reading speed for adults (Brysbaert 2019).'],
                  ['College student',          '300',      'Higher vocabulary and reading exposure raise the average.'],
                  ['Proficient adult reader',  '350–500',  'Regular readers with broad vocabulary and strong focus.'],
                ] as [$stage, $wpm, $note])
                <tr class="rst-bench-row">
                  <td class="ps-4 py-3 fw-600 text-sm">{{ $stage }}</td>
                  <td class="py-3 fw-700">{{ $wpm }}</td>
                  <td class="py-3 text-sm text-muted">{{ $note }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <p class="ms-source">Sources: Carver (1992); Brysbaert (2019); Rasinski (2017) oral fluency norms.</p>
      </div>
    </div>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="pageFaq" />

<x-related-tools :tools="$relatedTools" heading="More Study Tools" />

@endsection

@section('scripts')
<script>
(function () {
  var PASSAGES = [
    {
      title: 'Passage 1 — Sleep & Cognition',
      text: 'Sleep is far more than a passive state of rest. During the hours we spend unconscious, the brain is engaged in a cascade of restorative and consolidating processes that are essential to waking function. Chief among these is memory consolidation — the transfer of newly acquired information from short-term hippocampal storage to longer-term cortical networks. Without adequate sleep, this transfer is incomplete, and the information is effectively lost.\n\nResearchers at the University of California found that a single night of sleep deprivation reduced the brain\'s ability to form new memories by up to forty percent. The affected region was the hippocampus, which showed dramatically reduced activity in sleep-deprived participants when compared to those who had slept normally. Crucially, this deficit could not be fully recovered by subsequent rest — some of that day\'s learning was permanently impaired.\n\nBeyond memory, sleep plays a critical role in emotional regulation. The amygdala — the brain\'s primary threat-detection centre — becomes hyperreactive after sleep loss, responding up to sixty percent more intensely to negative stimuli. This explains why even moderate sleep deprivation leaves people feeling emotionally reactive and irritable. A well-rested brain, by contrast, is better at distinguishing genuine threats from minor inconveniences.\n\nThe relationship between sleep and creativity is equally striking. REM sleep — the stage in which vivid dreaming occurs — has been specifically linked to the formation of novel associations between distantly related concepts. Studies show that participants woken from REM sleep consistently outperform others on creative problem-solving tasks, suggesting that the dreaming brain is actively forging connections that the waking mind cannot easily access on its own.',
    },
    {
      title: 'Passage 2 — History of the Internet',
      text: 'The internet as we know it today emerged from a military research project that had very different goals in mind. In the late 1960s, the United States Department of Defense funded a project called ARPANET — the Advanced Research Projects Agency Network — with the aim of creating a communication system that could survive a nuclear strike. Rather than routing information through a single centralised hub, which could be destroyed in an attack, ARPANET distributed data across a web of interconnected nodes. If any single node was destroyed, information would automatically reroute through others.\n\nThe first message ever sent over ARPANET was transmitted on October 29, 1969, between computers at UCLA and the Stanford Research Institute. The intended message was the word "login," but the system crashed after just two letters — making "lo" the accidental first words of the internet age.\n\nThroughout the 1970s and 1980s, the network expanded slowly, connecting universities and research institutions. The transformative moment came in 1989, when British computer scientist Tim Berners-Lee, working at CERN in Switzerland, proposed a system of linked documents that could be shared across the network. He called it the World Wide Web. His invention of hypertext markup language — HTML — and the uniform resource locator — URL — created the foundations that still underpin every website today.\n\nThe web opened to the public in 1991 and grew with astonishing speed. By 1995, companies like Amazon and eBay had launched. By 2000, the dot-com bubble had inflated and burst, wiping out trillions in market value. But the underlying infrastructure survived, and within a decade the internet had become the defining technology of the twenty-first century.',
    },
    {
      title: 'Passage 3 — Nutrition & the Human Body',
      text: 'The human body is a remarkably sophisticated machine that extracts usable energy and building materials from the food we eat through a complex series of chemical reactions collectively known as metabolism. Everything we consume — whether protein, carbohydrate, or fat — is ultimately broken down into simpler molecules that cells can use, store, or eliminate.\n\nCarbohydrates are the body\'s preferred source of immediate energy. When you eat bread, fruit, or any starchy food, digestive enzymes break the complex carbohydrates down into glucose, which enters the bloodstream. The pancreas responds by releasing insulin, a hormone that acts like a key — unlocking cells to allow glucose in, where it is burned for energy or stored as glycogen in the liver and muscles for later use. When glycogen stores are full, excess glucose is converted to fat.\n\nProtein serves a different primary purpose. Rather than being used primarily for energy, dietary protein is broken down into amino acids — the raw materials the body uses to build and repair tissues, synthesise hormones and enzymes, and support immune function. The nine essential amino acids cannot be produced by the body and must come exclusively from food, which is why dietary variety matters so much.\n\nFats have long been misunderstood as inherently harmful, but they serve critical functions. Dietary fats form the membranes of every cell in the body, carry fat-soluble vitamins such as A, D, E, and K, provide insulation for vital organs, and serve as a dense long-term energy reserve. The distinction between fat types — saturated, unsaturated, and trans — matters more than total fat intake for cardiovascular health.',
    },
  ];

  var WORD_COUNTS = PASSAGES.map(function (p) {
    return p.text.trim().split(/\s+/).length;
  });

  var QUIZZES = [
    [
      { q: 'By what percentage did sleep deprivation reduce the brain\'s ability to form new memories?',
        opts: ['20%', '40%', '60%', '80%'], correct: 1 },
      { q: 'Which brain region showed dramatically reduced activity in sleep-deprived participants?',
        opts: ['Amygdala', 'Prefrontal cortex', 'Hippocampus', 'Cerebellum'], correct: 2 },
      { q: 'Which sleep stage is specifically linked to forming novel associations and creative thinking?',
        opts: ['Deep sleep (N3)', 'REM sleep', 'Light sleep (N1)', 'NREM stage 2'], correct: 1 },
    ],
    [
      { q: 'What were the first two letters accidentally transmitted over ARPANET?',
        opts: ['lo', 'hi', 'he', 'la'], correct: 0 },
      { q: 'Who invented the World Wide Web?',
        opts: ['Vint Cerf', 'Steve Jobs', 'Tim Berners-Lee', 'Bill Gates'], correct: 2 },
      { q: 'At which institution did Tim Berners-Lee work when he proposed the web?',
        opts: ['MIT', 'Stanford', 'DARPA', 'CERN'], correct: 3 },
    ],
    [
      { q: 'What is the body\'s preferred source of immediate energy?',
        opts: ['Protein', 'Fat', 'Carbohydrates', 'Fibre'], correct: 2 },
      { q: 'How many essential amino acids cannot be produced by the body?',
        opts: ['5', '7', '9', '12'], correct: 2 },
      { q: 'Which fat-soluble vitamins do dietary fats help transport?',
        opts: ['B and C', 'A, D, E, and K', 'D and E only', 'C and K'], correct: 1 },
    ],
  ];

  var rstState = {
    passageIdx: 0,
    startTime: null,
    timerInterval: null,
    running: false,
    pendingWpm: null,
    pendingElapsed: null,
    selectedAnswers: [null, null, null],
    quizSubmitted: false,
  };

  function wpmToPercentile(wpm) {
    if (wpm >= 700) return 99;
    if (wpm >= 500) return 95;
    if (wpm >= 400) return 85;
    if (wpm >= 350) return 75;
    if (wpm >= 300) return 65;
    if (wpm >= 250) return 50;
    if (wpm >= 200) return 35;
    if (wpm >= 150) return 18;
    return 5;
  }

  function wpmCategory(wpm) {
    if (wpm < 150)       return { label: 'Slow Reader',          cls: 'rst-result-slow' };
    if (wpm < 250)       return { label: 'Average Adult Reader', cls: 'rst-result-average' };
    if (wpm < 350)       return { label: 'Above Average',        cls: 'rst-result-above' };
    if (wpm < 500)       return { label: 'Fast Reader',          cls: 'rst-result-fast' };
    if (wpm < 700)       return { label: 'Speed Reader',         cls: 'rst-result-speed' };
    return               { label: 'Exceptional Reader',          cls: 'rst-result-exceptional' };
  }

  function formatElapsed(seconds) {
    var m = Math.floor(seconds / 60);
    var s = seconds % 60;
    return m + ':' + (s < 10 ? '0' : '') + s;
  }

  window.rstSelectPassage = function (idx) {
    if (rstState.running) return;
    rstState.passageIdx = idx;
    for (var i = 0; i < 3; i++) {
      var btn = document.getElementById('rstPBtn' + i);
      btn.classList.toggle('rst-passage-btn-active', i === idx);
    }
  };

  window.rstStart = function () {
    var p = PASSAGES[rstState.passageIdx];

    document.getElementById('rstInstruction').classList.add('d-none');
    document.getElementById('rstResult').classList.add('d-none');

    var passageText = document.getElementById('rstPassageText');
    passageText.textContent = p.text;
    document.getElementById('rstPassageTitle').textContent = p.title;
    document.getElementById('rstPassageWrap').classList.remove('d-none');

    document.getElementById('rstBtnStart').classList.add('d-none');
    document.getElementById('rstBtnDone').classList.remove('d-none');

    document.getElementById('rstPassageLabel').textContent = 'Reading — take your time:';
    for (var i = 0; i < 3; i++) {
      document.getElementById('rstPBtn' + i).disabled = true;
    }

    rstState.startTime = Date.now();
    rstState.running = true;
    var elapsed = 0;
    rstState.timerInterval = setInterval(function () {
      elapsed = Math.floor((Date.now() - rstState.startTime) / 1000);
      document.getElementById('rstTimerBadge').textContent = formatElapsed(elapsed);
    }, 1000);
  };

  function showResult(wpm, elapsedSec, compScore) {
    var pct = wpmToPercentile(wpm);
    var cat = wpmCategory(wpm);
    var bookHours = ((90000 / wpm) / 60).toFixed(1);

    document.getElementById('rstWpmNumber').textContent = wpm;
    document.getElementById('rstStatWpm').textContent = wpm;
    document.getElementById('rstStatPct').textContent = pct + '%';
    document.getElementById('rstStatTime').textContent = elapsedSec + 's';
    document.getElementById('rstStatBook').textContent = bookHours + 'h';
    document.getElementById('rstPctText').textContent = pct;

    var badgeWrap = document.getElementById('rstCatBadgeWrap');
    badgeWrap.innerHTML = '<span class="rst-cat-badge ' + cat.cls + '">' + cat.label + '</span>';

    var compBox = document.getElementById('rstCompBox');
    if (compScore !== null) {
      var compPct = Math.round((compScore / 3) * 100);
      if (compScore >= 2) {
        compBox.className = 'rst-comp-box rst-comp-ok mb-3';
        compBox.innerHTML = '✅ <strong>Comprehension: ' + compScore + '/3 (' + compPct + '%)</strong> — Great retention at this speed.';
      } else {
        var effWpm = Math.round(wpm * (compScore / 3));
        compBox.className = 'rst-comp-box rst-comp-warn mb-3';
        compBox.innerHTML = '⚠️ <strong>Comprehension: ' + compScore + '/3 (' + compPct + '%)</strong> — Try reading a bit slower. Effective reading speed: ~' + effWpm + ' WPM.';
      }
      compBox.classList.remove('d-none');
    } else {
      compBox.classList.add('d-none');
    }

    var bar = document.getElementById('rstPctBar');
    setTimeout(function () { bar.style.width = pct + '%'; }, 100);

    // Save to history
    try {
      var hist = JSON.parse(localStorage.getItem('rst_hist') || '[]');
      hist.unshift({
        date: new Date().toLocaleDateString(),
        wpm: wpm,
        passage: rstState.passageIdx + 1,
        comp: compScore !== null ? compScore + '/3' : '—'
      });
      if (hist.length > 5) hist = hist.slice(0, 5);
      localStorage.setItem('rst_hist', JSON.stringify(hist));
      renderHistory(hist);
    } catch (e) {}

    document.getElementById('rstResult').classList.remove('d-none');
    document.getElementById('rstPassageLabel').textContent = 'Choose a passage:';
    for (var i = 0; i < 3; i++) {
      document.getElementById('rstPBtn' + i).disabled = false;
    }
    document.getElementById('rstResult').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  }

  function renderHistory(hist) {
    if (!hist || !hist.length) { document.getElementById('rstHistList').innerHTML = '<p class="text-muted text-sm">No previous tests yet.</p>'; return; }
    var html = '';
    hist.forEach(function (h) {
      var cat = wpmCategory(h.wpm);
      html += '<div class="rst-hist-item">'
        + '<span class="rst-hist-wpm">' + h.wpm + ' WPM</span>'
        + '<span class="rst-cat-badge ' + cat.cls + '" style="font-size:.7rem;padding:2px 8px">' + cat.label + '</span>'
        + '<span class="text-muted">P' + h.passage + ' · ' + h.comp + ' comp · ' + h.date + '</span>'
        + '</div>';
    });
    document.getElementById('rstHistList').innerHTML = html;
  }

  // Load history on page load
  try {
    var initHist = JSON.parse(localStorage.getItem('rst_hist') || '[]');
    if (initHist.length) renderHistory(initHist);
  } catch (e) {}

  window.rstSelectAnswer = function (qIdx, optIdx) {
    if (rstState.quizSubmitted) return;
    rstState.selectedAnswers[qIdx] = optIdx;
    var allOpts = document.querySelectorAll('[data-q="' + qIdx + '"] .rst-quiz-opt');
    allOpts.forEach(function (el) { el.classList.remove('rst-quiz-opt-selected'); });
    var selected = document.querySelector('[data-q="' + qIdx + '"][data-opt="' + optIdx + '"] .rst-quiz-opt');
    if (selected) selected.classList.add('rst-quiz-opt-selected');
  };

  window.rstSubmitQuiz = function () {
    var quiz = QUIZZES[rstState.passageIdx];
    var score = 0;
    rstState.quizSubmitted = true;
    quiz.forEach(function (q, qi) {
      var selected = rstState.selectedAnswers[qi];
      for (var oi = 0; oi < q.opts.length; oi++) {
        var el = document.querySelector('[data-q="' + qi + '"][data-opt="' + oi + '"] .rst-quiz-opt');
        if (!el) continue;
        if (oi === q.correct) {
          el.classList.add('rst-quiz-opt-correct');
        } else if (oi === selected && selected !== q.correct) {
          el.classList.add('rst-quiz-opt-wrong');
        }
      }
      if (selected === q.correct) score++;
    });
    document.querySelector('#rstQuizWrap .btn-cta').textContent = 'See Results →';
    document.querySelector('#rstQuizWrap .btn-cta').onclick = function () {
      document.getElementById('rstQuizWrap').classList.add('d-none');
      document.getElementById('rstBtnStart').classList.remove('d-none');
      document.getElementById('rstBtnStart').textContent = 'Read Another Passage';
      document.getElementById('rstBtnStart').onclick = rstReset;
      showResult(rstState.pendingWpm, rstState.pendingElapsed, score);
    };
  };

  window.rstFinish = function () {
    if (!rstState.running) return;
    clearInterval(rstState.timerInterval);
    rstState.running = false;

    var elapsedMs = Date.now() - rstState.startTime;
    var elapsedSec = Math.max(1, Math.round(elapsedMs / 1000));
    var words = WORD_COUNTS[rstState.passageIdx];
    var wpm = Math.round((words / elapsedSec) * 60);

    rstState.pendingWpm = wpm;
    rstState.pendingElapsed = elapsedSec;
    rstState.selectedAnswers = [null, null, null];
    rstState.quizSubmitted = false;

    document.getElementById('rstPassageWrap').classList.add('d-none');
    document.getElementById('rstBtnDone').classList.add('d-none');

    // Show comprehension quiz
    var quiz = QUIZZES[rstState.passageIdx];
    var html = '';
    quiz.forEach(function (q, qi) {
      html += '<div class="mb-4">'
        + '<div class="rst-quiz-q">' + (qi + 1) + '. ' + q.q + '</div>';
      q.opts.forEach(function (opt, oi) {
        html += '<div data-q="' + qi + '" data-opt="' + oi + '" onclick="rstSelectAnswer(' + qi + ',' + oi + ')">'
          + '<div class="rst-quiz-opt">' + opt + '</div>'
          + '</div>';
      });
      html += '</div>';
    });
    document.getElementById('rstQuizQuestions').innerHTML = html;
    document.getElementById('rstQuizWrap').classList.remove('d-none');
    document.getElementById('rstQuizWrap').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  };

  window.rstReset = function () {
    clearInterval(rstState.timerInterval);
    rstState.running = false;
    rstState.startTime = null;
    rstState.pendingWpm = null;
    rstState.selectedAnswers = [null, null, null];
    rstState.quizSubmitted = false;

    document.getElementById('rstInstruction').classList.remove('d-none');
    document.getElementById('rstPassageWrap').classList.add('d-none');
    document.getElementById('rstQuizWrap').classList.add('d-none');
    document.getElementById('rstResult').classList.add('d-none');
    document.getElementById('rstBtnDone').classList.add('d-none');
    document.getElementById('rstBtnStart').classList.remove('d-none');
    document.getElementById('rstBtnStart').textContent = 'Start Reading';
    document.getElementById('rstBtnStart').onclick = rstStart;
    document.getElementById('rstTimerBadge').textContent = '0:00';
    document.getElementById('rstPassageLabel').textContent = 'Choose a passage:';
    for (var i = 0; i < 3; i++) {
      document.getElementById('rstPBtn' + i).disabled = false;
    }
    // Reload history in case it was updated
    try {
      var h = JSON.parse(localStorage.getItem('rst_hist') || '[]');
      renderHistory(h);
    } catch (e) {}
  };
})();
</script>
@endsection
