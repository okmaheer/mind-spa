@extends('layouts.app')

@section('title', 'Pomodoro Timer — Free 25/5 Focus Timer Online | MindSnap')
@section('description', 'Free Pomodoro timer — no sign-up needed. Run 25-minute focus sessions with 5-minute breaks and stay productive with the proven Pomodoro Technique.')
@section('canonical', config('app.url') . '/pomodoro-timer')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "WebApplication",
  "name": "Pomodoro Timer",
  "url": "{{ config('app.url') }}/pomodoro-timer",
  "description": "Free online Pomodoro timer with 25-minute focus sessions, short breaks, and long breaks. Configurable durations and audio notifications.",
  "applicationCategory": "ProductivityApplication",
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
    { "@@type": "ListItem", "position": 1, "name": "Home",                "item": "{{ config('app.url') }}" },
    { "@@type": "ListItem", "position": 2, "name": "Productivity Tools",  "item": "{{ config('app.url') }}/productivity-tools" },
    { "@@type": "ListItem", "position": 3, "name": "Pomodoro Timer" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [
    { "@@type": "Question", "name": "What is the Pomodoro Technique?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The Pomodoro Technique is a time management method developed by Francesco Cirillo in the late 1980s. It breaks work into 25-minute focused sessions (called 'pomodoros') separated by 5-minute short breaks. After four consecutive pomodoros, you take a longer 15–30 minute break." } },
    { "@@type": "Question", "name": "Why are Pomodoro sessions 25 minutes long?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Francesco Cirillo chose 25 minutes because it matches a natural attention window — long enough to make meaningful progress, short enough to sustain intense focus without cognitive fatigue. Research on ultradian rhythms supports cycles of roughly 90 minutes, making 25-minute intervals a practical sub-unit that aligns with natural concentration peaks." } },
    { "@@type": "Question", "name": "Can I change the Pomodoro timer duration?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes. While 25 minutes is the traditional default, many practitioners adjust the focus duration to match their work style. Common alternatives are 20, 30, 45, or 60 minutes. Use the settings panel on this timer to customise focus, short break, and long break durations." } },
    { "@@type": "Question", "name": "How many Pomodoros should I do per day?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Most productivity experts recommend 8–12 pomodoros per working day for knowledge workers. Cirillo originally suggested tracking completed pomodoros and aiming for consistency. Beginners often start with 4–6 per day and build up gradually as their focus capacity improves." } },
    { "@@type": "Question", "name": "What happens after 4 Pomodoros?",
      "acceptedAnswer": { "@@type": "Answer", "text": "After completing four consecutive pomodoros, you earn a long break — typically 15 to 30 minutes. This longer rest allows deeper cognitive recovery before starting the next set of four. This timer automatically prompts a long break after your fourth pomodoro and then resets the counter." } },
    { "@@type": "Question", "name": "Should I reset the timer if I get interrupted?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes. The Pomodoro Technique treats interruptions strictly: if you cannot postpone an interruption, you must abandon the current pomodoro, handle the interruption, and restart a fresh 25-minute session. Completing a pomodoro only counts if the full uninterrupted session finishes. This builds awareness of how often you are interrupted." } },
    { "@@type": "Question", "name": "Can the Pomodoro Technique work for creative work?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes, though creative flow states can sometimes be disrupted by a timer alarm. Many creatives adapt the technique by extending focus sessions to 45 or 60 minutes once they are in deep work mode, or by using the timer to establish a starting ritual rather than a rigid countdown. The technique is most valuable for tasks you tend to procrastinate on." } },
    { "@@type": "Question", "name": "Is the Pomodoro Technique backed by science?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Multiple studies support the core mechanisms. Research on attention restoration theory (Kaplan, 1995) shows that brief mental breaks significantly restore directed-attention capacity. A 2011 study in Cognition found that brief diversions from a task dramatically improved sustained attention over extended periods. The Pomodoro Technique operationalises these findings into a simple daily practice." } }
  ]
}
</script>
@endsection

@php
$faqs = [
  ['q' => 'What is the Pomodoro Technique?',
   'a' => 'The Pomodoro Technique is a time management method developed by Francesco Cirillo in the late 1980s. It divides work into 25-minute focused sessions — called pomodoros — separated by 5-minute short breaks. After four consecutive pomodoros, you take a longer 15–30 minute break to allow deeper cognitive recovery.'],
  ['q' => 'Why are Pomodoro sessions 25 minutes long?',
   'a' => 'Francesco Cirillo chose 25 minutes because it aligns with a natural attention window — long enough to make meaningful progress on a task, short enough to sustain full concentration without fatigue. Research on ultradian rhythms shows humans naturally cycle through peaks and troughs of alertness roughly every 90 minutes, making 25-minute sub-units practical and effective.'],
  ['q' => 'Can I change the Pomodoro timer duration?',
   'a' => 'Yes. While 25 minutes is traditional, the duration can be adjusted to match your workflow. Common alternatives are 20, 30, 45, or 60 minutes for focus sessions, and proportionally adjusted break lengths. Use the Settings panel on this timer to customise all three durations.'],
  ['q' => 'How many Pomodoros should I aim for per day?',
   'a' => 'Most productivity experts recommend 8–12 pomodoros per working day for knowledge workers. Beginners often start with 4–6 per day and build up. Cirillo himself emphasised tracking actual completed pomodoros to build a realistic picture of your true productive capacity.'],
  ['q' => 'What happens after 4 Pomodoros?',
   'a' => 'After four consecutive completed pomodoros, you earn a long break — typically 15 to 30 minutes. This extended rest period allows deeper cognitive recovery before the next set begins. This timer automatically switches to a long break after your fourth pomodoro and resets the session counter.'],
  ['q' => 'Should I reset the timer if I get interrupted?',
   'a' => 'Yes. The technique is strict on this point: if an interruption cannot be postponed, abandon the current pomodoro entirely, handle the interruption, and restart a fresh 25-minute session from zero. A pomodoro only counts if the full session completes uninterrupted. This discipline builds awareness of how often you are actually interrupted.'],
  ['q' => 'Can the Pomodoro Technique work for creative work?',
   'a' => 'Yes, though some creatives find timer alarms disruptive when they are in a deep flow state. A common adaptation is to extend focus sessions to 45 or 60 minutes once in flow, or to use the timer primarily as a starting ritual — starting a pomodoro to overcome procrastination rather than as a rigid countdown.'],
  ['q' => 'Is the Pomodoro Technique scientifically supported?',
   'a' => 'Yes. A 2011 study in Cognition found that brief mental diversions from a sustained task dramatically improved performance compared to no breaks — directly supporting the technique\'s core mechanism. Attention Restoration Theory (Kaplan, 1995) also shows that brief breaks restore directed-attention capacity. The Pomodoro Technique operationalises these findings into a practical daily structure.'],
  ['q' => 'What does "pomodoro" mean?',
   'a' => 'Pomodoro is Italian for "tomato." Cirillo named the technique after the tomato-shaped kitchen timer he used as a university student when developing the method in the late 1980s. The humble tomato timer became the icon of one of the world\'s most widely used productivity systems.'],
  ['q' => 'Does this Pomodoro timer work offline?',
   'a' => 'Yes. Once the page is loaded, the timer runs entirely in your browser using JavaScript. It does not require an internet connection to continue running. The audio notification uses the Web Audio API, which is built into modern browsers — no external sound files are needed.'],
];

$relatedTools = [
  ['icon' => '📖', 'name' => 'Reading Speed Test',   'slug' => 'reading-speed-test',   'desc' => 'Test your WPM and compare to average readers.'],
  ['icon' => '😴', 'name' => 'Sleep Calculator',     'slug' => 'sleep-calculator',     'desc' => 'Best bedtime based on your wake-up time.'],
  ['icon' => '🧠', 'name' => 'Memory Test',          'slug' => 'memory-test',          'desc' => 'Test and train your working memory.'],
  ['icon' => '⚡', 'name' => 'Nap Calculator',       'slug' => 'nap-calculator',       'desc' => 'Perfect nap length to wake up refreshed.'],
  ['icon' => '🎮', 'name' => 'Brain Games',          'slug' => 'brain-games',          'desc' => 'Sharpen focus and reaction time.'],
  ['icon' => '📋', 'name' => 'Productivity Tools',   'slug' => 'productivity-tools',   'desc' => 'All tools to boost your output.'],
];
@endphp

@section('styles')
<style>
/* ── Timer wrapper — mode-aware background ── */
.pom-wrap                { transition: background .4s, border-color .4s; }
.pom-mode-focus          { background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%); }
.pom-mode-break          { background: linear-gradient(135deg, #0b3d2e 0%, #0f4d3a 100%); }

/* ── Mode tabs ── */
.pom-tabs                { display: flex; gap: 8px; justify-content: center; flex-wrap: wrap; }
.pom-tab                 { border: 2px solid rgba(255,255,255,.2); background: transparent; color: rgba(255,255,255,.6); border-radius: 50px; padding: 8px 20px; font-size: .85rem; font-weight: 600; cursor: pointer; transition: all .2s; }
.pom-tab:hover           { border-color: rgba(255,255,255,.5); color: #fff; }
.pom-tab-active          { border-color: #fff; background: rgba(255,255,255,.15); color: #fff; }

/* ── Countdown display ── */
.pom-display             { font-size: clamp(4rem, 18vw, 7rem); font-weight: 800; color: #fff; letter-spacing: -2px; line-height: 1; font-variant-numeric: tabular-nums; }

/* ── Session label ── */
.pom-session-label       { font-size: .9rem; color: rgba(255,255,255,.6); letter-spacing: .5px; text-transform: uppercase; }

/* ── Progress dots ── */
.pom-dots                { display: flex; gap: 10px; justify-content: center; }
.pom-dot                 { width: 14px; height: 14px; border-radius: 50%; background: rgba(255,255,255,.25); border: 2px solid rgba(255,255,255,.35); transition: background .3s, border-color .3s; }
.pom-dot-done            { background: #fff; border-color: #fff; }

/* ── Start / Pause button ── */
.pom-btn-start           { min-width: 160px; padding: 14px 36px; font-size: 1.05rem; font-weight: 700; border-radius: 50px; border: none; background: #e94560; color: #fff; cursor: pointer; transition: background .2s, transform .1s; }
.pom-btn-start:hover     { background: #c73652; transform: translateY(-2px); }
.pom-btn-start:active    { transform: translateY(0); }

/* ── Reset button ── */
.pom-btn-reset           { background: transparent; border: 2px solid rgba(255,255,255,.3); color: rgba(255,255,255,.7); border-radius: 50px; padding: 10px 24px; font-weight: 600; font-size: .88rem; cursor: pointer; transition: border-color .2s, color .2s; }
.pom-btn-reset:hover     { border-color: rgba(255,255,255,.7); color: #fff; }

/* ── Settings toggle ── */
.pom-settings-toggle     { background: transparent; border: none; color: rgba(255,255,255,.5); font-size: .82rem; font-weight: 600; cursor: pointer; letter-spacing: .3px; padding: 0; }
.pom-settings-toggle:hover { color: rgba(255,255,255,.85); }

/* ── Settings panel ── */
.pom-settings-panel      { background: rgba(255,255,255,.08); border-radius: 14px; border: 1px solid rgba(255,255,255,.12); }
.pom-settings-label      { font-size: .78rem; color: rgba(255,255,255,.6); font-weight: 600; text-transform: uppercase; letter-spacing: .4px; margin-bottom: 6px; display: block; }
.pom-settings-select     { background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.2); color: #fff; border-radius: 8px; padding: 8px 12px; font-size: .9rem; width: 100%; cursor: pointer; }
.pom-settings-select option { background: #1a1a2e; color: #fff; }

/* ── Done banner ── */
.pom-done-banner         { background: rgba(255,255,255,.12); border: 1px solid rgba(255,255,255,.2); border-radius: 12px; color: #fff; font-size: 1rem; font-weight: 600; }

/* ── Info tiles (right column) ── */
.pom-info-tile           { background: rgba(255,255,255,.07); border: 1px solid rgba(255,255,255,.1); border-radius: 12px; }
.pom-info-num            { font-size: 1.8rem; font-weight: 800; color: #fff; line-height: 1; }
.pom-info-lbl            { font-size: .78rem; color: rgba(255,255,255,.55); margin-top: 4px; }

/* ── Content sections ── */
.pom-tip-num             { width: 32px; height: 32px; border-radius: 50%; background: rgba(11,114,133,.12); border: 2px solid rgba(11,114,133,.25); color: var(--productivity); font-weight: 800; font-size: .9rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.pom-tip-title           { font-weight: 700; color: var(--primary-dark); font-size: .95rem; }
.pom-tip-desc            { font-size: .88rem; color: var(--text-muted); line-height: 1.65; margin-top: 3px; }

/* ── Task input ── */
.pom-task-input          { background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.2); color: #fff; border-radius: 10px; font-size: .9rem; padding: 10px 14px; width: 100%; }
.pom-task-input::placeholder { color: rgba(255,255,255,.4); }
.pom-task-input:focus    { outline: none; border-color: rgba(255,255,255,.5); background: rgba(255,255,255,.15); }
.pom-task-lbl            { font-size: .82rem; color: rgba(255,255,255,.55); text-align: center; min-height: 1.2em; font-style: italic; }

/* ── Advanced panel ── */
.pom-adv-toggle          { background: transparent; border: none; color: rgba(255,255,255,.5); font-size: .82rem; font-weight: 600; cursor: pointer; padding: 0; }
.pom-adv-toggle:hover    { color: rgba(255,255,255,.85); }
.pom-adv-panel           { background: rgba(255,255,255,.05); border: 1px solid rgba(255,255,255,.1); border-radius: 14px; }
.pom-streak-num          { font-size: 2rem; font-weight: 800; color: #fff; }
.pom-streak-lbl          { font-size: .72rem; color: rgba(255,255,255,.5); }
.pom-week-wrap           { display: flex; gap: 4px; align-items: flex-end; height: 64px; }
.pom-week-col            { flex: 1; display: flex; flex-direction: column; align-items: center; }
.pom-week-bar            { width: 100%; border-radius: 3px 3px 0 0; min-height: 4px; }
.pom-week-day-lbl        { font-size: .58rem; color: rgba(255,255,255,.4); margin-top: 3px; }
.pom-queue-input         { background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.2); color: #fff; border-radius: 8px; font-size: .85rem; padding: 7px 10px; flex: 1; }
.pom-queue-input::placeholder { color: rgba(255,255,255,.35); }
.pom-queue-add-btn       { background: rgba(255,255,255,.15); border: 1px solid rgba(255,255,255,.25); color: #fff; border-radius: 8px; padding: 7px 14px; font-size: .82rem; cursor: pointer; white-space: nowrap; }
.pom-queue-add-btn:hover { background: rgba(255,255,255,.25); }
.pom-queue-list          { list-style: none; padding: 0; margin: 0; }
.pom-queue-item          { display: flex; align-items: center; gap: 8px; padding: 6px 0; border-bottom: 1px solid rgba(255,255,255,.08); font-size: .85rem; color: rgba(255,255,255,.8); cursor: pointer; }
.pom-queue-item:last-child { border-bottom: none; }
.pom-queue-item-done     { text-decoration: line-through; color: rgba(255,255,255,.3); }
.pom-adv-lbl             { font-size: .72rem; color: rgba(255,255,255,.45); text-transform: uppercase; letter-spacing: .5px; font-weight: 600; margin-bottom: 8px; }
</style>
@endsection

@section('content')

<section class="pom-wrap pom-mode-focus" id="pomWrap">
  <div class="container-xl">
    <div class="row align-items-start g-5">

      <div class="col-lg-7">
        <x-breadcrumb :crumbs="[
          ['url' => route('home'),                   'name' => 'Home'],
          ['url' => route('category.productivity'),  'name' => 'Productivity Tools'],
          ['url' => '',                              'name' => 'Pomodoro Timer'],
        ]"/>

        <h1 class="mb-2 ms-hero-title">🍅 Pomodoro Timer — Free 25/5 Focus Timer</h1>
        <p class="ms-hero-desc">Work in focused 25-minute sprints, rest, repeat. The proven Pomodoro Technique — no sign-up, no ads, works offline.</p>

        <div class="card border-0 mb-n4 ms-tool-card" id="pomCard">
          <div class="card-body p-4 p-md-5">

            {{-- Task input --}}
            <div class="mb-3">
              <input type="text" id="pomTask" class="pom-task-input"
                     placeholder="What are you working on? (optional)" maxlength="80"
                     oninput="pomUpdateTaskLabel()">
            </div>

            {{-- Mode tabs --}}
            <div class="pom-tabs mb-4" role="tablist" aria-label="Timer mode">
              <button class="pom-tab pom-tab-active" id="tabFocus"      onclick="pomSetMode('focus')"      aria-pressed="true">Focus</button>
              <button class="pom-tab"                id="tabShort"      onclick="pomSetMode('short')"      aria-pressed="false">Short Break</button>
              <button class="pom-tab"                id="tabLong"       onclick="pomSetMode('long')"       aria-pressed="false">Long Break</button>
            </div>

            {{-- Session label --}}
            <div class="text-center mb-1">
              <div class="pom-session-label" id="pomSessionLabel">Pomodoro 1 of 4</div>
            </div>
            <div class="pom-task-lbl mb-2" id="pomTaskLabel"></div>

            {{-- Countdown --}}
            <div class="text-center mb-3">
              <div class="pom-display" id="pomDisplay" aria-live="polite" aria-label="Timer">25:00</div>
            </div>

            {{-- Progress dots --}}
            <div class="pom-dots mb-4" id="pomDots" aria-label="Completed pomodoros">
              <div class="pom-dot" id="dot0"></div>
              <div class="pom-dot" id="dot1"></div>
              <div class="pom-dot" id="dot2"></div>
              <div class="pom-dot" id="dot3"></div>
            </div>

            {{-- Controls --}}
            <div class="d-flex gap-3 justify-content-center align-items-center flex-wrap mb-4">
              <button class="pom-btn-start" id="pomBtnStart" onclick="pomToggle()">Start</button>
              <button class="pom-btn-reset" onclick="pomReset()">Reset</button>
            </div>

            {{-- Done banner (hidden until session ends) --}}
            <div class="pom-done-banner text-center p-3 mb-4 d-none" id="pomDoneBanner"></div>

            {{-- Settings toggle --}}
            <div class="text-center mb-2">
              <button class="pom-settings-toggle" onclick="pomToggleSettings()" id="pomSettingsToggleBtn">⚙ Settings</button>
            </div>

            {{-- Settings panel --}}
            <div class="pom-settings-panel p-4 d-none" id="pomSettingsPanel">
              <div class="row g-3">
                <div class="col-sm-4">
                  <label class="pom-settings-label" for="pomSetFocus">Focus (min)</label>
                  <select class="pom-settings-select" id="pomSetFocus" onchange="pomApplySettings()">
                    <option value="15">15</option>
                    <option value="20">20</option>
                    <option value="25" selected>25</option>
                    <option value="30">30</option>
                    <option value="45">45</option>
                    <option value="60">60</option>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label class="pom-settings-label" for="pomSetShort">Short Break (min)</label>
                  <select class="pom-settings-select" id="pomSetShort" onchange="pomApplySettings()">
                    <option value="3">3</option>
                    <option value="5" selected>5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                  </select>
                </div>
                <div class="col-sm-4">
                  <label class="pom-settings-label" for="pomSetLong">Long Break (min)</label>
                  <select class="pom-settings-select" id="pomSetLong" onchange="pomApplySettings()">
                    <option value="10">10</option>
                    <option value="15" selected>15</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                  </select>
                </div>
              </div>
            </div>

            {{-- Advanced: Streak + Week + Task Queue --}}
            <div class="text-center mt-3">
              <button class="pom-adv-toggle" onclick="pomToggleAdvanced()" id="pomAdvBtn">
                📊 Stats &amp; Task Queue
              </button>
            </div>
            <div class="pom-adv-panel p-4 mt-2 d-none" id="pomAdvPanel">
              <div class="row g-4 mb-4">
                <div class="col-6 text-center">
                  <div class="pom-adv-lbl">🔥 Current Streak</div>
                  <div class="pom-streak-num" id="pomStreakNum">0</div>
                  <div class="pom-streak-lbl">consecutive days (≥4 pomodoros)</div>
                </div>
                <div class="col-6 text-center">
                  <div class="pom-adv-lbl">This Week</div>
                  <div class="pom-week-wrap" id="pomWeekChart"></div>
                </div>
              </div>
              <div class="pom-adv-lbl">Task Queue</div>
              <div class="d-flex gap-2 mb-2">
                <input type="text" id="pomQueueInput" class="pom-queue-input"
                       placeholder="Add a task..." maxlength="80">
                <button class="pom-queue-add-btn" onclick="pomAddTask()">+ Add</button>
              </div>
              <ul class="pom-queue-list" id="pomQueueList"></ul>
            </div>

          </div>
        </div>
      </div>

      {{-- Right column facts --}}
      <div class="col-lg-5 d-none d-lg-block pt-2">
        <div class="ms-facts-wrap">
          <h3 class="ms-facts-title">Pomodoro at a Glance</h3>
          @foreach([
            ['25 min',  'Traditional focus session — light enough to start, long enough to finish'],
            ['5 min',   'Short break — enough to reset attention without losing momentum'],
            ['15 min',  'Long break after every 4 pomodoros — allows deeper recovery'],
            ['1987',    'Year Francesco Cirillo invented the technique at university'],
            ['2 M+',    'Practitioners worldwide using some form of the Pomodoro Technique'],
          ] as [$stat, $label])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div class="ms-fact-pill ms-fact-pill-dark">{{ $stat }}</div>
            <div class="ms-fact-label">{{ $label }}</div>
          </div>
          @endforeach

          <div class="d-flex gap-3 mt-4">
            <div class="pom-info-tile p-3 flex-fill text-center">
              <div class="pom-info-num" id="statTotalDone">0</div>
              <div class="pom-info-lbl">Completed today</div>
            </div>
            <div class="pom-info-tile p-3 flex-fill text-center">
              <div class="pom-info-num" id="statFocusMin">0</div>
              <div class="pom-info-lbl">Focus minutes</div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- What Is the Pomodoro Technique --}}
<section class="ms-section-white">
  <div class="container-xl">
    <div class="row align-items-start g-5">
      <div class="col-lg-6">
        <span class="ms-badge ms-badge-productivity mb-3">The Method</span>
        <h2 class="mb-4">What Is the Pomodoro Technique?</h2>
<img src="{{ asset('images/pomodoro-technique.svg') }}" alt="Pomodoro technique diagram showing 25-minute work intervals and break structure" width="640" height="160" loading="lazy" class="img-fluid rounded-3 mb-4">
        <p>The Pomodoro Technique was developed by Francesco Cirillo in the late 1980s while he was a university student struggling to focus. He picked up a tomato-shaped kitchen timer (<em>pomodoro</em> is Italian for tomato), set it for 25 minutes, and committed to working on a single task until it rang. The result was a structured approach to focus that has since been adopted by millions of professionals worldwide.</p>
        <p>The core cycle is simple: work for 25 minutes without interruption, take a 5-minute break, and repeat. After four completed sessions — one full "set" — you earn a longer 15–30 minute break. Each 25-minute block is one pomodoro. Incomplete sessions reset to zero; a pomodoro only counts if finished uninterrupted.</p>
        <p>The technique's power comes from several mechanisms: it makes large tasks feel approachable by breaking them into 25-minute commitments; it creates urgency through the countdown; it forces you to confront and track interruptions; and it builds in mandatory recovery before cognitive fatigue accumulates.</p>
      </div>
      <div class="col-lg-6">
        <h3 class="mb-3">The Four-Step Cycle</h3>
        <div class="d-flex flex-column gap-3">
          @foreach([
            ['1', '🍅', 'Choose a task', 'Select one specific task before starting the timer. Do not multi-task within a pomodoro — single-tasking is the whole point.'],
            ['2', '⏱', 'Work for 25 minutes', 'Start the timer and focus exclusively on that task. If an interruption arises that cannot be postponed, abandon the pomodoro and restart after handling it.'],
            ['3', '☕', 'Take a 5-minute break', 'When the timer rings, stop immediately. Stretch, walk, breathe — but do not continue working. The break is mandatory, not optional.'],
            ['4', '🔄', 'Repeat — long break after 4', 'After four complete pomodoros, take a 15–30 minute long break. Then start a new set. Track your daily count to build a realistic picture of your focus capacity.'],
          ] as [$num, $icon, $title, $desc])
          <div class="d-flex gap-3 align-items-start">
            <div class="ms-stage-pill bg-sleep">{{ $num }}</div>
            <div>
              <div class="fw-700 text-brand mb-1">{{ $icon }} {{ $title }}</div>
              <div class="ms-ref-desc">{{ $desc }}</div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Science Behind 25-Minute Focus Blocks --}}
<section class="ms-section-accent">
  <div class="container ms-longtail">
    <span class="ms-badge ms-badge-productivity mb-3">The Science</span>
    <h2 class="mb-4 text-brand">The Science Behind 25-Minute Focus Blocks</h2>
    <p>The Pomodoro Technique aligns closely with what cognitive science tells us about sustained attention. Human attention is not a constant resource — it fluctuates in cycles governed by what researchers call ultradian rhythms, oscillating roughly every 90 minutes. Within each 90-minute cycle, we move through peaks and troughs of alertness. The 25-minute pomodoro fits comfortably within a single alertness peak, making it sustainable without relying on willpower alone.</p>
    <p>A landmark 2011 study published in <em>Cognition</em> by Atsunori Ariga and Alejandro Lleras found that brief diversions from a task can dramatically improve sustained attention over extended periods. Participants who took short breaks during a 50-minute task maintained consistent performance throughout, while those who worked without breaks showed steady decline — providing direct experimental support for the break structure at the core of the technique.</p>
    <p>Attention Restoration Theory (Kaplan, 1995) explains why breaks work: directed attention — the focused concentration needed for demanding tasks — is a finite resource that depletes with continuous use. Brief exposure to effortless, restorative activities (even just staring out a window) allows the directed-attention system to recover. Five minutes is sufficient for partial restoration, which is precisely what the short Pomodoro break provides.</p>
    <p>The technique also benefits from the psychological principle of implementation intentions. By committing in advance to work on a specific task for a defined interval, you significantly increase the probability of starting and continuing that task — overcoming the initiation barrier that causes most procrastination.</p>
  </div>
</section>

{{-- How to Get the Most from Pomodoro --}}
<section class="ms-section-white">
  <div class="container-xl">
    <div class="text-center mb-5">
      <h2>How to Get the Most from the Pomodoro Technique</h2>
      <p class="text-muted ms-intro-text">Five practical tips to get better results from every session.</p>
    </div>
    <div class="row g-4">
      @foreach([
        ['Plan your pomodoros the night before',
         'Before bed, list tomorrow\'s tasks and estimate how many pomodoros each will take. This removes the decision-making overhead at the start of your workday — you simply start the timer and follow the list. Research on implementation intentions shows that pre-planning specific tasks dramatically increases follow-through.'],
        ['Batch small tasks together',
         'Tasks that take less than one full pomodoro should be grouped together into a single session. Checking emails, making a quick call, and reviewing a short document can all fit into one 25-minute block. This prevents the waste of dedicating a full session to a 5-minute task.'],
        ['Protect your pomodoro from notifications',
         'Put your phone on Do Not Disturb and close non-essential browser tabs before starting. One of the technique\'s core rules is that a pomodoro interrupted by a non-urgent distraction must be abandoned and restarted from zero. The cost of interruption makes protecting the session feel worthwhile.'],
        ['Use breaks for genuine rest — not screens',
         'The 5-minute break works best when you step away from all screens. Stand up, move around, look at something distant, or do a short breathing exercise. Switching to social media or news does not restore directed attention — it depletes it further through a different kind of stimulation.'],
        ['Track completed pomodoros and review weekly',
         'The original technique includes recording every completed pomodoro and reviewing at the end of the week. This data reveals your true productive capacity, helps you estimate future tasks more accurately, and shows patterns — times of day when you are consistently interrupted, tasks that always take longer than expected, and your personal average daily pomodoro count.'],
      ] as $idx => [$title, $desc])
      <div class="col-md-6 col-lg-4">
        <div class="d-flex gap-3 align-items-start h-100">
          <div class="pom-tip-num">{{ $idx + 1 }}</div>
          <div>
            <div class="pom-tip-title">{{ $title }}</div>
            <div class="pom-tip-desc">{{ $desc }}</div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="pageFaq" />

<x-related-tools :tools="$relatedTools" heading="More Productivity Tools" />

@endsection

@section('scripts')
<script>
(function () {
  var MODES = { focus: 25, short: 5, long: 15 };
  var today = new Date().toISOString().slice(0, 10);
  var taskQueue = [];

  // ── localStorage helpers ──
  function loadTodayStats() {
    try {
      var data = JSON.parse(localStorage.getItem('pom_day') || '{}');
      if (data.date === today) return { done: data.done || 0, focusMin: data.focusMin || 0 };
    } catch (e) {}
    return { done: 0, focusMin: 0 };
  }

  function saveTodayStats(done, focusMin) {
    var data = { date: today, done: done, focusMin: focusMin };
    try { localStorage.setItem('pom_day', JSON.stringify(data)); } catch (e) {}
    // Also push to weekly history
    try {
      var hist = JSON.parse(localStorage.getItem('pom_hist') || '[]');
      var existing = hist.findIndex(function (h) { return h.date === today; });
      if (existing >= 0) {
        hist[existing] = data;
      } else {
        hist.push(data);
        if (hist.length > 14) hist = hist.slice(-14);
      }
      localStorage.setItem('pom_hist', JSON.stringify(hist));
    } catch (e) {}
  }

  function loadHistory() {
    try { return JSON.parse(localStorage.getItem('pom_hist') || '[]'); } catch (e) { return []; }
  }

  function calcStreak(history) {
    var streak = 0;
    var d = new Date();
    d.setDate(d.getDate() - 1); // start from yesterday
    for (var i = 0; i < 30; i++) {
      var ds = d.toISOString().slice(0, 10);
      var entry = history.find(function (h) { return h.date === ds; });
      if (entry && entry.done >= 4) {
        streak++;
        d.setDate(d.getDate() - 1);
      } else {
        break;
      }
    }
    return streak;
  }

  function buildWeekChart(history) {
    var days = ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'];
    var cols = '';
    var maxCount = 1;
    var week = [];
    for (var i = 6; i >= 0; i--) {
      var d = new Date();
      d.setDate(d.getDate() - i);
      var ds = d.toISOString().slice(0, 10);
      var entry = history.find(function (h) { return h.date === ds; });
      var count = entry ? entry.done : 0;
      if (count > maxCount) maxCount = count;
      week.push({ lbl: days[d.getDay()], count: count, isToday: ds === today });
    }
    week.forEach(function (w) {
      var pct = Math.round((w.count / maxCount) * 56);
      var bg = w.isToday ? 'rgba(255,255,255,.8)' : (w.count >= 4 ? 'rgba(255,255,255,.6)' : 'rgba(255,255,255,.2)');
      cols += '<div class="pom-week-col">'
        + '<div class="pom-week-bar" style="height:' + pct + 'px;background:' + bg + ';"></div>'
        + '<div class="pom-week-day-lbl">' + w.lbl + '</div>'
        + '</div>';
    });
    document.getElementById('pomWeekChart').innerHTML = cols;
  }

  function renderAdvanced() {
    var hist = loadHistory();
    var streak = calcStreak(hist);
    document.getElementById('pomStreakNum').textContent = streak;
    buildWeekChart(hist);
    renderQueue();
  }

  // ── Task queue ──
  function renderQueue() {
    var html = '';
    taskQueue.forEach(function (t, i) {
      html += '<li class="pom-queue-item' + (t.done ? ' pom-queue-item-done' : '') + '" onclick="pomToggleTask(' + i + ')">'
        + (t.done ? '✅' : '◻') + ' ' + t.text
        + '</li>';
    });
    document.getElementById('pomQueueList').innerHTML = html || '<li class="pom-queue-item" style="opacity:.4;cursor:default">No tasks yet</li>';
  }

  function saveQueue() {
    try { localStorage.setItem('pom_queue', JSON.stringify(taskQueue)); } catch (e) {}
  }

  // Load persisted state
  var todayStats = loadTodayStats();
  try {
    taskQueue = JSON.parse(localStorage.getItem('pom_queue') || '[]');
  } catch (e) { taskQueue = []; }

  var state = {
    mode: 'focus',
    running: false,
    secondsLeft: 25 * 60,
    totalSeconds: 25 * 60,
    pomodorosDone: todayStats.done,
    currentSet: 0,
    intervalId: null,
    totalFocusMin: todayStats.focusMin,
  };

  function getMins() {
    return {
      focus: parseInt(document.getElementById('pomSetFocus').value),
      short: parseInt(document.getElementById('pomSetShort').value),
      long:  parseInt(document.getElementById('pomSetLong').value),
    };
  }

  function formatTime(s) {
    var m = Math.floor(s / 60);
    var sec = s % 60;
    return (m < 10 ? '0' : '') + m + ':' + (sec < 10 ? '0' : '') + sec;
  }

  function updateDisplay() {
    var t = formatTime(state.secondsLeft);
    document.getElementById('pomDisplay').textContent = t;
    if (state.running) {
      var label = state.mode === 'focus'
        ? 'Pomodoro ' + (state.currentSet + 1) + ' of 4 — ' + t
        : (state.mode === 'short' ? 'Short Break — ' : 'Long Break — ') + t;
      document.title = label + ' | MindSnap';
    } else {
      document.title = 'Pomodoro Timer — Free 25/5 Focus Timer Online | MindSnap';
    }
  }

  function updateDots() {
    for (var i = 0; i < 4; i++) {
      var dot = document.getElementById('dot' + i);
      if (i < state.currentSet) {
        dot.classList.add('pom-dot-done');
      } else {
        dot.classList.remove('pom-dot-done');
      }
    }
  }

  function updateSessionLabel() {
    var lbl = document.getElementById('pomSessionLabel');
    if (state.mode === 'focus') {
      lbl.textContent = 'Pomodoro ' + (state.currentSet + 1) + ' of 4';
    } else if (state.mode === 'short') {
      lbl.textContent = 'Short Break';
    } else {
      lbl.textContent = 'Long Break — Well Earned!';
    }
  }

  function updateStats() {
    document.getElementById('statTotalDone').textContent = state.pomodorosDone;
    document.getElementById('statFocusMin').textContent = state.totalFocusMin;
    saveTodayStats(state.pomodorosDone, state.totalFocusMin);
  }

  function setMode(mode, autoStart) {
    state.mode = mode;
    clearInterval(state.intervalId);
    state.running = false;
    var mins = getMins();
    state.secondsLeft = mins[mode] * 60;
    state.totalSeconds = state.secondsLeft;
    document.getElementById('pomBtnStart').textContent = 'Start';

    var wrap = document.getElementById('pomWrap');
    wrap.classList.remove('pom-mode-focus', 'pom-mode-break');
    wrap.classList.add(mode === 'focus' ? 'pom-mode-focus' : 'pom-mode-break');

    var tabs = ['tabFocus', 'tabShort', 'tabLong'];
    var modeMap = { focus: 0, short: 1, long: 2 };
    tabs.forEach(function (id, i) {
      var el = document.getElementById(id);
      var active = (i === modeMap[mode]);
      el.classList.toggle('pom-tab-active', active);
      el.setAttribute('aria-pressed', active ? 'true' : 'false');
    });

    hideDoneBanner();
    updateDisplay();
    updateSessionLabel();

    if (autoStart) {
      pomToggle();
    }
  }

  function tick() {
    if (state.secondsLeft <= 0) {
      clearInterval(state.intervalId);
      state.running = false;
      document.getElementById('pomBtnStart').textContent = 'Start';
      document.title = 'Pomodoro Timer — Free 25/5 Focus Timer Online | MindSnap';
      onSessionEnd();
      return;
    }
    state.secondsLeft--;
    updateDisplay();
  }

  function onSessionEnd() {
    playBeep();
    if (state.mode === 'focus') {
      state.currentSet++;
      state.pomodorosDone++;
      var mins = getMins();
      state.totalFocusMin += mins.focus;
      updateDots();
      updateStats();
      if (state.currentSet >= 4) {
        state.currentSet = 0;
        updateDots();
        showDoneBanner('🎉 4 pomodoros done! Take a long break — you earned it.');
        setTimeout(function () { setMode('long', true); }, 1800);
      } else {
        showDoneBanner('✅ Pomodoro complete! Take a short break.');
        setTimeout(function () { setMode('short', true); }, 1800);
      }
    } else {
      showDoneBanner('⏱ Break over — ready to focus again?');
      setMode('focus', false);
      updateSessionLabel();
    }
  }

  function showDoneBanner(msg) {
    var el = document.getElementById('pomDoneBanner');
    el.textContent = msg;
    el.classList.remove('d-none');
  }

  function hideDoneBanner() {
    document.getElementById('pomDoneBanner').classList.add('d-none');
  }

  function playBeep() {
    try {
      var ctx = new (window.AudioContext || window.webkitAudioContext)();
      var osc = ctx.createOscillator();
      var gain = ctx.createGain();
      osc.connect(gain);
      gain.connect(ctx.destination);
      osc.frequency.value = 800;
      gain.gain.setValueAtTime(0.3, ctx.currentTime);
      gain.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.8);
      osc.start(ctx.currentTime);
      osc.stop(ctx.currentTime + 0.8);
    } catch (e) {}
  }

  window.pomToggle = function () {
    hideDoneBanner();
    if (state.running) {
      clearInterval(state.intervalId);
      state.running = false;
      document.getElementById('pomBtnStart').textContent = 'Resume';
      document.title = 'Pomodoro Timer — Free 25/5 Focus Timer Online | MindSnap';
    } else {
      state.running = true;
      document.getElementById('pomBtnStart').textContent = 'Pause';
      state.intervalId = setInterval(tick, 1000);
    }
  };

  window.pomReset = function () {
    clearInterval(state.intervalId);
    state.running = false;
    var mins = getMins();
    state.secondsLeft = mins[state.mode] * 60;
    state.totalSeconds = state.secondsLeft;
    document.getElementById('pomBtnStart').textContent = 'Start';
    document.title = 'Pomodoro Timer — Free 25/5 Focus Timer Online | MindSnap';
    hideDoneBanner();
    updateDisplay();
  };

  window.pomSetMode = function (mode) {
    clearInterval(state.intervalId);
    state.running = false;
    setMode(mode, false);
  };

  window.pomApplySettings = function () {
    clearInterval(state.intervalId);
    state.running = false;
    var mins = getMins();
    state.secondsLeft = mins[state.mode] * 60;
    state.totalSeconds = state.secondsLeft;
    document.getElementById('pomBtnStart').textContent = 'Start';
    hideDoneBanner();
    updateDisplay();
  };

  window.pomToggleSettings = function () {
    var panel = document.getElementById('pomSettingsPanel');
    var btn = document.getElementById('pomSettingsToggleBtn');
    var hidden = panel.classList.contains('d-none');
    panel.classList.toggle('d-none', !hidden);
    btn.textContent = hidden ? '✕ Close Settings' : '⚙ Settings';
  };

  window.pomUpdateTaskLabel = function () {
    var val = document.getElementById('pomTask').value.trim();
    document.getElementById('pomTaskLabel').textContent = val ? '🎯 ' + val : '';
  };

  window.pomToggleAdvanced = function () {
    var panel = document.getElementById('pomAdvPanel');
    var hidden = panel.classList.contains('d-none');
    panel.classList.toggle('d-none', !hidden);
    if (hidden) renderAdvanced();
  };

  window.pomAddTask = function () {
    var inp = document.getElementById('pomQueueInput');
    var text = inp.value.trim();
    if (!text) return;
    taskQueue.push({ text: text, done: false });
    saveQueue();
    renderQueue();
    inp.value = '';
  };

  window.pomToggleTask = function (i) {
    taskQueue[i].done = !taskQueue[i].done;
    saveQueue();
    renderQueue();
  };

  document.getElementById('pomQueueInput').addEventListener('keydown', function (e) {
    if (e.key === 'Enter') pomAddTask();
  });

  updateDisplay();
  updateDots();
  updateSessionLabel();
  updateStats();
  renderQueue();
})();
</script>
@endsection
