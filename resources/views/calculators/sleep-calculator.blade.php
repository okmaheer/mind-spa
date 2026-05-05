@extends('layouts.app')

@section('title', 'Sleep Calculator — Free Bedtime & Wake-Up Time Finder | MindSnap')
@section('description', 'Free sleep calculator: enter your wake-up time and instantly find the best bedtime based on 90-minute sleep cycles. Works for adults, teenagers, shift workers, and night owls. No signup.')
@section('canonical', config('app.url') . '/sleep-calculator')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "WebApplication",
  "name": "Sleep Calculator",
  "url": "{{ config('app.url') }}/sleep-calculator",
  "description": "Calculate your ideal bedtime or wake-up time based on 90-minute sleep cycles.",
  "applicationCategory": "HealthApplication",
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
    { "@@type": "ListItem", "position": 2, "name": "Sleep Tools", "item": "{{ config('app.url') }}/sleep-tools" },
    { "@@type": "ListItem", "position": 3, "name": "Sleep Calculator" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [
    { "@@type": "Question", "name": "How does the sleep calculator work?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The calculator counts backward from your wake-up time in 90-minute blocks — the average length of one complete sleep cycle. It shows four options (3–6 cycles) so you can wake at the natural end of a cycle instead of mid-cycle, which eliminates the grogginess caused by sleep inertia." } },
    { "@@type": "Question", "name": "How many hours of sleep do adults need?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The CDC and American Academy of Sleep Medicine recommend 7–9 hours for adults aged 18–60. Consistently sleeping fewer than 7 hours is linked to higher risk of obesity, diabetes, cardiovascular disease, and impaired cognitive function." } },
    { "@@type": "Question", "name": "What is a 90-minute sleep cycle?",
      "acceptedAnswer": { "@@type": "Answer", "text": "A sleep cycle is a sequence of four stages: Stage 1 light sleep, Stage 2 light sleep, Stage 3 deep slow-wave sleep, and REM sleep. Each full cycle takes roughly 80–100 minutes. Deep sleep dominates early cycles; REM lengthens in later cycles." } },
    { "@@type": "Question", "name": "What does the sleep chart show?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The hypnogram chart shows your estimated sleep architecture — which stages your brain cycles through, how long you spend in deep sleep versus REM, and exactly where your alarm falls. Deep sleep peaks in the first two cycles; REM builds in cycles 3–6." } },
    { "@@type": "Question", "name": "What is a chronotype and why does it matter?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Your chronotype is your natural sleep-wake preference driven by genetics. Lions (early birds) peak before 8 AM; Bears (majority) follow the solar cycle; Wolves (night owls) run 1–2 hours later. Forcing a wolf schedule onto a lion, or vice versa, creates chronic misalignment and reduces sleep quality even at the same total hours." } }
  ]
}
</script>
@endsection

@php
$faqs = [
  ['q' => 'How does the sleep calculator work?',
             'a' => 'The calculator counts backward from your wake-up time in 90-minute blocks — the average length of one complete sleep cycle. It shows four options (3–6 cycles) so you can wake at the natural end of a cycle instead of mid-cycle, eliminating the grogginess of sleep inertia.'],
  ['q' => 'How many hours of sleep do adults need?',
             'a' => 'The CDC and AASM recommend 7–9 hours for adults aged 18–60. Teenagers need 8–10 hours; school-age children need 9–12. Consistently sleeping under 7 hours is linked to higher risk of obesity, diabetes, cardiovascular disease, and impaired cognitive function.'],
  ['q' => 'What does the sleep chart on this page show?',
             'a' => 'The hypnogram (sleep architecture chart) shows your estimated night in visual form: which stages your brain cycles through, how long you spend in deep versus REM sleep, and where your alarm falls. Deep sleep (blue) peaks in cycles 1–2; REM (purple) builds through cycles 3–6.'],
  ['q' => 'What is a chronotype and why does it matter?',
             'a' => 'Your chronotype is your genetically-driven sleep-wake preference. Lions (early birds) naturally wake before 6 AM; Bears (the majority) follow the solar cycle; Wolves (night owls) run 1–2 hours later. Forcing a wolf schedule onto a lion creates chronic circadian misalignment, reducing sleep quality even at identical total hours.'],
  ['q' => 'Why does waking mid-cycle feel so much worse?',
             'a' => 'Waking during deep Stage 3 sleep leaves adenosine — the brain\'s sleepiness chemical — still elevated. Combined with low core body temperature, this produces sleep inertia: measurably impaired reaction time, memory, and decision-making that persists 15–60 minutes. Waking at a cycle\'s end means adenosine has already cleared naturally.'],
  ['q' => 'What time should I go to sleep if I wake up at 6am?', 'a' => 'If you wake up at 6:00 am, your ideal bedtimes are 8:30 pm (6 cycles), 10:00 pm (5 cycles), 11:30 pm (4 cycles), or 1:00 am (3 cycles). Account for roughly 15 minutes to fall asleep. The 10:00 pm bedtime is ideal for most adults — 5 complete cycles of 90 minutes each.'],
  ['q' => 'Is a sleep calculator accurate?', 'a' => 'Sleep calculators are accurate in their cycle mathematics but approximate in their application. The 90-minute cycle length is an average — individual cycles range from 70 to 120 minutes and change across the night. The calculator is most useful as a planning guide: it reliably tells you which bedtimes are likely to result in waking between cycles rather than inside them.'],
  ['q' => 'How many hours of sleep do I need by age?', 'a' => 'The CDC recommends: infants (4–12 months) 12–16 hours, toddlers (1–2 years) 11–14 hours, preschool (3–5) 10–13 hours, school age (6–12) 9–12 hours, teenagers (13–18) 8–10 hours, adults (18–60) 7–9 hours, older adults (61+) 7–9 hours. Individual needs vary — genetics, health, and activity level all play a role.'],
];

$relatedTools = [
  ['icon' => '⏰', 'name' => 'Wake-Up Calculator', 'slug' => 'wake-up-calculator', 'desc' => 'Find the best times to wake up based on when you fall asleep.'],
  ['icon' => '💤', 'name' => 'Nap Calculator', 'slug' => 'nap-calculator', 'desc' => 'Is 20 minutes enough, or do you need a full cycle? Find out.'],
  ['icon' => '📉', 'name' => 'Sleep Debt Calculator', 'slug' => 'sleep-debt-calculator', 'desc' => 'How much sleep do you owe your body? Get a recovery plan.'],
  ['icon' => '☕', 'name' => 'Caffeine & Sleep', 'slug' => 'caffeine-sleep-calculator', 'desc' => 'Find the last safe time to drink coffee for your bedtime.'],
  ['icon' => '✈️', 'name' => 'Jet Lag Calculator', 'slug' => 'jet-lag-calculator', 'desc' => 'Plan your sleep schedule around a long-haul flight.'],
  ['icon' => '📋', 'name' => 'Sleep Quality Quiz', 'slug' => 'sleep-quality-quiz', 'desc' => 'Rate your sleep with a 10-question science-backed questionnaire.'],
];
@endphp

@section('content')

{{-- ── 1. Hero / Tool ───────────────────────────────────────────────────────── --}}
<section class="ms-hero">
  <div class="container-xl">
    <div class="row align-items-start g-5">

      <div class="col-lg-7">
        <x-breadcrumb :crumbs="[
          ['url' => route('home'), 'name' => 'Home'],
          ['url' => route('category.sleep'), 'name' => 'Sleep Tools'],
          ['url' => '', 'name' => 'Sleep Calculator'],
        ]"/>

        <h1 class="mb-2 ms-hero-title">
          😴 Sleep Calculator — Find Your Ideal Bedtime
        </h1>
        <p class="ms-hero-desc">
          Find your best bedtime or wake-up time based on 90-minute sleep cycles — with a visual breakdown of your entire night.
        </p>

        {{-- ── Tool Card ────────────────────────────────────────────────────── --}}
        <div class="card border-0 mb-n4 ms-tool-card">
          <div class="card-body p-4 p-md-5">

            {{-- Mode toggle --}}
            <div class="d-flex gap-2 mb-4" role="group" aria-label="Calculator mode">
              <button class="btn flex-fill mode-btn active" data-mode="bedtime" style="border-radius:8px; font-weight:600; font-size:.88rem; background:var(--sleep); color:#fff; border:none;">
                🌙 I need to wake up at…
              </button>
              <button class="btn flex-fill mode-btn" data-mode="wakeup" style="border-radius:8px; font-weight:600; font-size:.88rem; background:#f8f9fa; color:#555; border:1px solid #e0e0e0;">
                ☀️ I'm going to bed at…
              </button>
            </div>

            {{-- Bedtime mode --}}
            <div id="bedtimeMode">
              <label for="wakeTime" class="form-label fw-600">What time do you need to wake up?</label>
              <input type="time" id="wakeTime" class="form-control mb-3" value="07:00" aria-label="Wake-up time">
              <label for="fallAsleepBedtime" class="form-label fw-600">
                Time to fall asleep?
                <span class="text-muted fw-400" style="font-size:.83rem;">most people: 10–20 min</span>
              </label>
              <select id="fallAsleepBedtime" class="form-select mb-3">
                <option value="5">5 minutes</option>
                <option value="10">10 minutes</option>
                <option value="14" selected>14 minutes (average)</option>
                <option value="20">20 minutes</option>
                <option value="30">30 minutes</option>
              </select>
            </div>

            {{-- Wake-up mode --}}
            <div id="wakeupMode" class="d-none">
              <label for="sleepTime" class="form-label fw-600">What time are you going to bed?</label>
              <input type="time" id="sleepTime" class="form-control mb-3" value="23:00" aria-label="Sleep time">
              <label for="fallAsleepWakeup" class="form-label fw-600">Time to fall asleep?</label>
              <select id="fallAsleepWakeup" class="form-select mb-3">
                <option value="5">5 minutes</option>
                <option value="10">10 minutes</option>
                <option value="14" selected>14 minutes (average)</option>
                <option value="20">20 minutes</option>
                <option value="30">30 minutes</option>
              </select>
            </div>

            {{-- Chronotype --}}
            <div class="mb-4">
              <button type="button" id="chronoToggleBtn"
                      onclick="document.getElementById('chronoPanel').classList.toggle('d-none')"
                      style="background:none; border:none; color:var(--sleep); font-size:.82rem; font-weight:600; cursor:pointer; padding:0; display:flex; align-items:center; gap:5px;">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M12 2v2M12 20v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M2 12h2M20 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"/></svg>
                Personalise for your chronotype
              </button>
              <div id="chronoPanel" class="d-none mt-2 p-3 rounded-3" style="background:#f0f2ff; border:1px solid #dde0ff;">
                <p style="font-size:.82rem; color:#444; font-weight:600; margin-bottom:10px;">When do you naturally wake up on free days?</p>
                <div class="d-flex gap-2 flex-wrap">
                  <button class="chrono-btn" data-chrono="lion"    onclick="setChronotype('lion', this)"  style="border-radius:8px; padding:7px 14px; font-size:.8rem; font-weight:600; background:#fff; border:2px solid #e0e0e0; cursor:pointer;">🦁 Before 6am</button>
                  <button class="chrono-btn active" data-chrono="bear" onclick="setChronotype('bear', this)" style="border-radius:8px; padding:7px 14px; font-size:.8rem; font-weight:600; background:var(--sleep); color:#fff; border:2px solid var(--sleep); cursor:pointer;">🐻 6–8am</button>
                  <button class="chrono-btn" data-chrono="wolf"    onclick="setChronotype('wolf', this)"  style="border-radius:8px; padding:7px 14px; font-size:.8rem; font-weight:600; background:#fff; border:2px solid #e0e0e0; cursor:pointer;">🐺 After 8am</button>
                </div>
                <p id="chronoDesc" style="font-size:.78rem; color:#666; margin:8px 0 0; line-height:1.5;">
                  <strong>Bear (most common):</strong> Your sleep follows the solar cycle. 7–8 hours with a 7–8 AM wake-up is your sweet spot.
                </p>
              </div>
            </div>

            <button class="btn btn-cta w-100" onclick="runCalc()" style="font-size:1rem;">
              Calculate →
            </button>

            {{-- Results --}}
            <div id="results" class="mt-4 d-none">
              <div class="ms-divider"></div>
              <p id="resultLabel" class="mb-3" style="color:var(--primary-dark); font-size:.9rem; font-weight:600;"></p>

              {{-- Result cards --}}
              <div id="resultCards" class="d-flex gap-2 flex-wrap"></div>

              {{-- Viz section --}}
              <div id="vizSection" class="d-none mt-4">
                <div class="ms-divider"></div>

                <div class="d-flex align-items-center justify-content-between mb-2 flex-wrap gap-2">
                  <p style="font-weight:700; font-size:.88rem; color:var(--primary-dark); margin:0;">Your Night Visualized</p>
                  <div class="d-flex flex-wrap gap-3">
                    @foreach([['#d0d0d0','Awake'],['#4a9fd4','Light'],['#1a5fa8','Deep'],['#7c6ff7','REM']] as [$col,$lbl])
                    <div class="d-flex align-items-center gap-1" style="font-size:.72rem; color:#777;">
                      <div style="width:10px; height:10px; border-radius:2px; background:{{ $col }};"></div> {{ $lbl }}
                    </div>
                    @endforeach
                    <div class="d-flex align-items-center gap-1" style="font-size:.72rem; color:#e94560;">
                      <div style="width:2px; height:10px; background:#e94560; border-radius:1px;"></div> Alarm
                    </div>
                  </div>
                </div>

                <div id="sleepViz" style="border-radius:10px; overflow:hidden; border:1px solid #e8eaed;"></div>

                {{-- Night stats --}}
                <div class="row g-2 mt-2 text-center">
                  <div class="col-3">
                    <div style="background:#eef3ff; border-radius:8px; padding:10px 4px;">
                      <div style="font-size:.95rem; font-weight:700; color:#1a5fa8;" id="statDeep">—</div>
                      <div style="font-size:.68rem; color:#888;">Deep sleep</div>
                    </div>
                  </div>
                  <div class="col-3">
                    <div style="background:#f3f0ff; border-radius:8px; padding:10px 4px;">
                      <div style="font-size:.95rem; font-weight:700; color:#7c6ff7;" id="statREM">—</div>
                      <div style="font-size:.68rem; color:#888;">REM sleep</div>
                    </div>
                  </div>
                  <div class="col-3">
                    <div style="background:#fff8ec; border-radius:8px; padding:10px 4px;">
                      <div style="font-size:.95rem; font-weight:700; color:#e97b1e;" id="statCycles">—</div>
                      <div style="font-size:.68rem; color:#888;">Cycles</div>
                    </div>
                  </div>
                  <div class="col-3">
                    <div style="background:#edfff3; border-radius:8px; padding:10px 4px;">
                      <div style="font-size:.88rem; font-weight:700; color:#28a745; letter-spacing:1px;" id="statScore">—</div>
                      <div style="font-size:.68rem; color:#888;">Rating</div>
                    </div>
                  </div>
                </div>

                <p id="chronoNote" class="mt-3 mb-0 p-2 rounded" style="font-size:.78rem; color:#555; background:#f8f8f8; display:none;"></p>
              </div>
              {{-- /viz --}}

            </div>
            {{-- /results --}}

          </div>
        </div>
        {{-- /Tool Card --}}
      </div>

      {{-- Right: Quick facts --}}
      <div class="col-lg-5 d-none d-lg-block" style="padding-top:10px;">
        <div class="ms-facts-wrap">
          <h3 class="ms-facts-title">Quick Sleep Facts</h3>
          @foreach([
            ['7–9 hrs', 'Recommended sleep for adults (CDC)'],
            ['90 min',  'Average length of one sleep cycle'],
            ['4–6',     'Cycles completed in a full night'],
            ['15 min',  'Average time to fall asleep'],
            ['23%',     'Adults sleeping under 7 hours nightly'],
          ] as [$stat, $label])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div class="ms-fact-pill ms-fact-pill-sleep">{{ $stat }}</div>
            <div class="ms-fact-label">{{ $label }}</div>
          </div>
          @endforeach
          <p class="ms-fact-source">Sources: CDC, NIH, AASM</p>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- ── 2. How It Works ──────────────────────────────────────────────────────── --}}
<section class="ms-section-white">
  <div class="container-xl">
    <div class="row align-items-center g-5">
      <div class="col-lg-5">
        <span class="ms-badge ms-badge-sleep mb-3">How It Works</span>
        <h2 class="mb-4">How Sleep Cycles Work: The 90-Minute Science</h2>
        <p>Your brain doesn't sleep in one long block. It cycles through four distinct stages — light sleep, deeper light sleep, slow-wave deep sleep, and REM — roughly every 90 minutes all night long.</p>
        <p>The trick is not just how long you sleep, but <em>when</em> you wake. Interrupting deep sleep triggers sleep inertia: that thick, cotton-headed grogginess that can persist for up to an hour. Wake during light sleep at the end of a cycle and you surface alert within seconds.</p>
        <p>This calculator counts backward from your alarm time in 90-minute blocks, adds your personal fall-asleep delay, then draws the actual sleep architecture of your night — so you can see exactly what you're trading off between the 6-hour and 7.5-hour options.</p>
      </div>
      <div class="col-lg-7">
        <div class="p-4 rounded-3 ms-data-box">
          <p class="fw-600 mb-3" style="color:var(--primary-dark); font-size:.88rem; text-transform:uppercase; letter-spacing:.5px;">A single 90-minute cycle</p>
          @foreach([
            ['Stage 1 — Light NREM', '~5 min',  '#aacde8', 'Drowsy, easy to wake. Muscles relax, heartbeat slows.'],
            ['Stage 2 — Light NREM', '~20 min', '#4a9fd4', 'Body temperature drops, sleep spindles appear. Memory consolidation begins.'],
            ['Stage 3 — Deep NREM',  '~40 min', '#1a5fa8', 'Hardest to wake from. Physical repair and immune function happen here.'],
            ['REM',                  '~25 min', '#7c6ff7', 'Dreaming. Emotional memory processing. Gets longer in later cycles.'],
          ] as [$stage, $duration, $color, $desc])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div style="background:{{ $color }}; color:#fff; border-radius:6px; padding:4px 8px; font-size:.75rem; font-weight:700; min-width:50px; text-align:center; flex-shrink:0; margin-top:2px;">{{ $duration }}</div>
            <div>
              <div class="fw-600" style="font-size:.87rem; color:#1a1a2e;">{{ $stage }}</div>
              <div style="font-size:.8rem; color:#666; line-height:1.5;">{{ $desc }}</div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ── 3. Sleep by Age ───────────────────────────────────────────────────────── --}}
<section class="ms-section-muted">
  <div class="container-xl">
    <div class="text-center mb-5">
      <h2>How Much Sleep Does Your Age Group Need?</h2>
      <p class="text-muted" style="max-width:520px; margin:auto;">Recommendations from the AASM and CDC, based on population research.</p>
    </div>
    <div class="row g-3 justify-content-center">
      @foreach([
        ['🍼','Newborns','0–3 mo','14–17 hrs','Includes naps throughout the day and night.'],
        ['👶','Infants','4–11 mo','12–16 hrs','Daytime naps gradually consolidate.'],
        ['🧒','Toddlers','1–2 yrs','11–14 hrs','One long nap plus uninterrupted night sleep.'],
        ['👦','Preschoolers','3–5 yrs','10–13 hrs','Afternoon naps become optional.'],
        ['🎒','School Age','6–12 yrs','9–12 hrs','Consistent bedtimes improve school performance.'],
        ['📱','Teenagers','13–18 yrs','8–10 hrs','Circadian shift runs later — early start times fight biology.'],
        ['💼','Adults','18–64 yrs','7–9 hrs','Below 7 hrs triples cold susceptibility (Carnegie Mellon).'],
        ['🧓','Seniors','65+ yrs','7–8 hrs','More wake-ups are normal; total need stays high.'],
      ] as [$icon,$group,$age,$hours,$note])
      <div class="col-6 col-md-3">
        <div class="card border-0 h-100 text-center p-3" style="border-radius:12px; box-shadow:0 2px 12px rgba(0,0,0,.06);">
          <div style="font-size:2rem; margin-bottom:8px;">{{ $icon }}</div>
          <div class="fw-700" style="font-size:.88rem; color:var(--primary-dark);">{{ $group }}</div>
          <div style="font-size:.78rem; color:#888; margin-bottom:8px;">{{ $age }}</div>
          <div class="fw-700" style="font-size:1.05rem; color:var(--sleep);">{{ $hours }}</div>
          <div style="font-size:.74rem; color:#999; margin-top:8px; line-height:1.5;">{{ $note }}</div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="sleepFaq" />


{{-- ── 5. Science ───────────────────────────────────────────────────────────── --}}
<section class="ms-section-muted">
  <div class="container-xl">
    <div class="row align-items-start g-5">
      <div class="col-lg-6">
        <h2 class="mb-4">The Real Cost of Broken Sleep Cycles</h2>
        <p>A landmark 2003 study by Van Dongen et al. at the University of Pennsylvania found that 14 consecutive nights of 6-hour sleep produced cognitive impairment equivalent to 48 hours of total sleep deprivation — yet subjects rated their own sleepiness as only "slightly impaired." They had simply lost the ability to gauge their own deficit.</p>
        <p>A 2007 study in <em>Sleep</em> found that sleeping under 6 hours tripled the risk of the common cold compared to those sleeping 7+ hours, regardless of age, stress, or smoking status.</p>
        <p>The 90-minute framework comes from Nathaniel Kleitman, who co-discovered REM sleep in 1953 and described the Basic Rest-Activity Cycle. Subsequent polysomnography research confirmed that waking at a cycle's natural end — rather than mid-cycle — dramatically reduces sleep inertia and produces better subjective sleep quality ratings.</p>
      </div>
      <div class="col-lg-6">
        <h3 class="mb-3" style="font-size:1.1rem;">Signs You're Waking Mid-Cycle</h3>
        <div class="d-flex flex-column gap-2 mb-4">
          @foreach(['You feel groggy 20–30 minutes after waking even on a "full" night','You need multiple snooze alarms before feeling alert','You perform significantly better on days you wake without an alarm','Weekday vs weekend energy is dramatically different at the same total hours'] as $s)
          <div class="d-flex gap-2"><div style="color:var(--primary-cta); flex-shrink:0;">✗</div><div style="font-size:.88rem; color:#555;">{{ $s }}</div></div>
          @endforeach
        </div>
        <h3 class="mb-3" style="font-size:1.1rem;">Signs You're Waking at the Right Time</h3>
        <div class="d-flex flex-column gap-2">
          @foreach(['Alert and oriented within 2–3 minutes of waking','No urge to lie back down after turning the alarm off','Consistent energy through the morning without caffeine','You remember the content of your last dream (indicates light-sleep wake)'] as $s)
          <div class="d-flex gap-2"><div style="color:#28a745; flex-shrink:0;">✓</div><div style="font-size:.88rem; color:#555;">{{ $s }}</div></div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ── 6. Sleep Tips ─────────────────────────────────────────────────────────── --}}
<section class="ms-section-white">
  <div class="container-xl">
    <div class="text-center mb-5">
      <h2>How to Improve Sleep Quality: 10 Evidence-Based Tips</h2>
      <p class="text-muted" style="max-width:480px; margin:auto;">Each one is backed by peer-reviewed research — not generic wellness advice.</p>
    </div>
    <div class="row g-3">
      @foreach([
        ['🌡️','Keep bedroom at 65–68°F (18–20°C)','Core body temperature must drop 1–2°F to initiate sleep. A cool room accelerates this. NSF identifies room temperature as one of the top predictors of sleep quality.'],
        ['📱','No screens 60 minutes before bed','Blue light (450–480nm) suppresses melatonin by up to 85% and delays the circadian clock by ~1.5 hours (Harvard Medical School, 2015).'],
        ['☕','Cut caffeine 8–10 hours before bed','Caffeine\'s half-life is 5–6 hours. Even when you "fall asleep fine," caffeine significantly reduces slow-wave deep sleep measured by EEG.'],
        ['📅','Keep wake time consistent, even weekends','Social jet lag — the gap between weekday and weekend wake times — is associated with higher BMI, worse mood, and cardiovascular risk. Consistency anchors your clock.'],
        ['🚶','Get outdoor light within 1 hour of waking','Morning light sets the circadian clock and triggers a 12–16 hour cortisol pulse that governs when you get sleepy. Cloudy outdoor light still exceeds indoor lighting 20×.'],
        ['🍷','Avoid alcohol within 3 hours of bed','Alcohol induces sleep but fragments it. It suppresses REM in the first half of the night and causes rebound wakefulness in the second, degrading quality even if total hours are maintained.'],
        ['🏃','Exercise — but not within 3 hours of bed','Regular aerobic exercise increases deep slow-wave sleep. Late evening exercise raises core temperature and cortisol, delaying sleep onset.'],
        ['🧘','Use a 20–30 minute wind-down ritual','Your nervous system can\'t switch off instantly. A consistent pre-sleep routine signals the brain to downregulate arousal. The routine itself becomes a conditioned sleep cue.'],
        ['🛏️','Use the bed only for sleep and sex','Stimulus control therapy (one of the most evidence-backed insomnia treatments) works by reserving the bed exclusively as a sleep cue. Working or watching TV in bed creates wakefulness associations.'],
        ['⏰','If you can\'t sleep in 20 min, get up','Lying awake trains the brain that bed equals wakefulness. Get up, do something quiet in low light, return only when genuinely sleepy. This is the core of CBT-I — the gold standard insomnia treatment.'],
      ] as $i => [$icon,$title,$desc])
      <div class="col-md-6">
        <div class="d-flex gap-3 p-3 rounded-3" style="background:#f8f9fa; border:1px solid #e8e8e8;">
          <div style="font-size:1.4rem; flex-shrink:0; line-height:1; padding-top:2px;">{{ $icon }}</div>
          <div>
            <div class="fw-600" style="font-size:.88rem; color:var(--primary-dark); margin-bottom:4px;">{{ ($i+1) }}. {{ $title }}</div>
            <div style="font-size:.8rem; color:#666; line-height:1.6;">{{ $desc }}</div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- Long-tail keyword sections --}}
<section class="ms-section-accent">
  <div class="container ms-longtail">
    <h2 class="mb-4" style="color:var(--primary-dark);">Sleep Calculator for Shift Workers</h2>
    <p>Night shift and rotating shift workers face a unique challenge: their sleep window changes constantly. Use this calculator by entering your actual wake-up target for your next shift. For rotating shifts, aim for a consistent number of cycles (5 or 6) rather than a fixed bedtime. Research from the Journal of Sleep Research shows shift workers who align sleep with 90-minute cycles report 34% fewer sleep complaints than those who simply aim for "8 hours."</p>
    <h2 class="mt-5 mb-4" style="color:var(--primary-dark);">Sleep Calculator for Teenagers</h2>
    <p>Teenagers need 8–10 hours of sleep per night — more than adults — because the brain undergoes significant development during adolescence. A common mistake is assuming a teen who sleeps until noon is lazy; biologically, the teenage circadian rhythm shifts later, making early school start times a genuine health issue. Use this calculator with a school wake-up time to find the ideal bedtime that completes full 90-minute cycles for a 9-hour sleep duration.</p>
    <h2 class="mt-5 mb-4" style="color:var(--primary-dark);">Sleep Calculator for 8 Hours of Sleep</h2>
    <p>Exactly 8 hours is a common target, but 8 hours does not divide evenly into 90-minute cycles (it gives 5.3 cycles). You are better off targeting either 7.5 hours (5 complete cycles) or 9 hours (6 complete cycles). Waking mid-cycle — even after 8 exact hours — produces the same grogginess as waking after 5 hours. This calculator automatically shows you cycle-aligned times so you never wake at the wrong stage.</p>
  </div>
</section>

<x-related-tools :tools="$relatedTools" heading="More Sleep Tools" />


{{-- ── 8. SEO Block ──────────────────────────────────────────────────────────── --}}
<section class="ms-section-seo">
  <div class="container-xl">
    <div class="row justify-content-center">
      <div class="col-lg-8 ms-seo-body">
        <h2 class="mb-4 ms-seo-h2">Sleep Calculator: What the Research Actually Says</h2>
        <p>If you've ever woken to an alarm feeling destroyed on what should have been a full night's sleep, you've experienced the sharp difference between sleep duration and sleep timing. Total hours matter — but finishing a complete cycle matters just as much.</p>
        <h3 class="ms-seo-h3">Why the Fall-Asleep Delay Is Often Ignored</h3>
        <p>One overlooked variable is sleep onset latency — how long it takes you to actually fall asleep after lying down. The average is 7–20 minutes for healthy adults. If you need to wake at 7:00 AM and want 7.5 hours of sleep, you might calculate an 11:30 PM bedtime. But if it takes 20 minutes to fall asleep, sleep doesn't start until 11:50 PM — short-changing you by nearly one full cycle. The calculator compensates for this directly.</p>
        <h3 class="ms-seo-h3">The Alarm vs. No-Alarm Test</h3>
        <p>Try this on a weekend: go to bed at your calculated bedtime with no alarm set. Note your natural wake time. If it falls within 15–20 minutes of the cycle-aligned times the calculator suggests, the model is working for your physiology. Most people run close to 90-minute cycles, but some run 85 and some 100 minutes. If you consistently wake 30+ minutes before a calculated time, build your schedule around 85-minute blocks instead.</p>
        <h3 class="ms-seo-h3">Snooze Buttons Make Things Worse</h3>
        <p>Hitting snooze doesn't help. The 7–9 minutes between alarms doesn't complete a meaningful sleep stage — it just repeatedly interrupts the body's attempt to re-enter deeper sleep without delivering any restorative benefit. You'd be better off setting the alarm 9 minutes later and sleeping straight through.</p>
        <div class="mt-4 p-4 rounded-3 ms-note ms-note-blue">
          <p style="margin:0; font-size:.85rem; color:#1a4a7a;"><strong>Note:</strong> This tool is for general wellness guidance. If you consistently struggle with sleep quality, experience excessive daytime sleepiness, or have symptoms like loud snoring, please consult a physician or sleep specialist. Conditions like sleep apnea and insomnia disorder require professional assessment.</p>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')
<script>
(function () {

  // ── Data ──────────────────────────────────────────────────────────────────
  var CYCLE_MIN = 90;

  // Sleep stage breakdown per cycle [s1, s2, deep, rem] in minutes
  var CYCLE_STAGES = [
    { s1: 5, s2: 25, deep: 40, rem: 20 },  // Cycle 1 — most deep sleep
    { s1: 5, s2: 20, deep: 30, rem: 35 },  // Cycle 2
    { s1: 5, s2: 20, deep: 15, rem: 50 },  // Cycle 3 — deep fading, REM rising
    { s1: 5, s2: 25, deep:  5, rem: 55 },  // Cycle 4
    { s1: 5, s2: 30, deep:  0, rem: 55 },  // Cycle 5 — no deep, max REM
    { s1: 5, s2: 30, deep:  0, rem: 55 },  // Cycle 6
  ];

  var CHRONO_DESCS = {
    lion: 'Early bird (Lion): Your peak alertness is before 8 AM. Recommendations shift toward earlier bedtimes. Sleeping past 8 AM on weekends undermines your natural rhythm.',
    bear: 'Average sleeper (Bear): Your sleep follows the solar cycle. 7–8 AM wake-ups and 10:30 PM–midnight bedtimes are your sweet spot.',
    wolf: 'Night owl (Wolf): Your circadian rhythm runs 1–2 hours later than average. Forcing early wake-ups creates ongoing sleep debt. Later bedtimes (midnight–1 AM) work better for you.',
  };

  var currentChronotype = 'bear';
  var lastCalcArgs = null;

  // ── Utilities ─────────────────────────────────────────────────────────────
  function parseTime(str) {
    var p = str.split(':');
    return parseInt(p[0]) * 60 + parseInt(p[1]);
  }

  function formatTime(totalMin) {
    totalMin = ((totalMin % 1440) + 1440) % 1440;
    var h = Math.floor(totalMin / 60);
    var m = totalMin % 60;
    var period = h >= 12 ? 'PM' : 'AM';
    var hd = h % 12 === 0 ? 12 : h % 12;
    return hd + ':' + (m < 10 ? '0' + m : m) + ' ' + period;
  }

  function fmtDuration(minutes) {
    if (minutes <= 0) return '0m';
    var h = Math.floor(minutes / 60), m = minutes % 60;
    return (h > 0 ? h + 'h ' : '') + (m > 0 ? m + 'm' : '');
  }

  // ── Alertness score (1–5 stars) ───────────────────────────────────────────
  function alertnessScore(cycles, wakeMinutes, chrono) {
    var score = 5;
    var hrs = cycles * 1.5;

    // Total hours component
    if      (hrs < 4.5) score -= 3;
    else if (hrs < 6)   score -= 2;
    else if (hrs < 7)   score -= 1;

    // Cycles component
    if (cycles < 4) score -= 1;

    // Circadian zone
    var wh = (((wakeMinutes % 1440) + 1440) % 1440) / 60;
    if      (wh >= 3   && wh < 5)   score -= 2;
    else if (wh >= 5   && wh < 6)   score -= 1;
    else if (wh > 9.5)              score -= 1;

    // Chronotype adjustment
    if (chrono === 'wolf' && wh < 7)   score -= 1;
    if (chrono === 'lion' && wh > 8.5) score -= 1;

    return Math.max(1, Math.min(5, score));
  }

  function scoreLabel(s) {
    return ['','Very Short','Insufficient','Below Optimal','Good','Optimal'][s];
  }

  function stars(score, filled, empty) {
    var out = '';
    for (var i = 1; i <= 5; i++) out += i <= score ? filled : empty;
    return out;
  }

  // ── Mode toggle ───────────────────────────────────────────────────────────
  document.querySelectorAll('.mode-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
      document.querySelectorAll('.mode-btn').forEach(function (b) {
        b.classList.remove('active');
        b.style.background = '#f8f9fa';
        b.style.color = '#555';
        b.style.border = '1px solid #e0e0e0';
      });
      this.classList.add('active');
      this.style.background = 'var(--sleep)';
      this.style.color = '#fff';
      this.style.border = 'none';
      var mode = this.dataset.mode;
      document.getElementById('bedtimeMode').classList.toggle('d-none', mode !== 'bedtime');
      document.getElementById('wakeupMode').classList.toggle('d-none', mode !== 'wakeup');
      document.getElementById('results').classList.add('d-none');
    });
  });

  // ── Chronotype ────────────────────────────────────────────────────────────
  window.setChronotype = function (chrono, btn) {
    currentChronotype = chrono;
    document.querySelectorAll('.chrono-btn').forEach(function (b) {
      b.classList.remove('active');
      b.style.background = '#fff';
      b.style.color = '#333';
      b.style.borderColor = '#e0e0e0';
    });
    btn.classList.add('active');
    btn.style.background = 'var(--sleep)';
    btn.style.color = '#fff';
    btn.style.borderColor = 'var(--sleep)';
    document.getElementById('chronoDesc').innerHTML = '<strong>' + { lion: '🦁 Lion', bear: '🐻 Bear', wolf: '🐺 Wolf' }[chrono] + ':</strong> ' + CHRONO_DESCS[chrono].split(':')[1];
    if (lastCalcArgs) runCalc();
  };

  // ── Main calc entry point ─────────────────────────────────────────────────
  window.runCalc = function () {
    var mode = document.querySelector('.mode-btn.active').dataset.mode;
    if (mode === 'bedtime') {
      var t = document.getElementById('wakeTime').value;
      var d = parseInt(document.getElementById('fallAsleepBedtime').value);
      if (!t) return;
      lastCalcArgs = { mode: 'bedtime', time: parseTime(t), delay: d };
    } else {
      var t = document.getElementById('sleepTime').value;
      var d = parseInt(document.getElementById('fallAsleepWakeup').value);
      if (!t) return;
      lastCalcArgs = { mode: 'wakeup', time: parseTime(t), delay: d };
    }
    renderResults(lastCalcArgs);
  };

  // ── Render result cards ───────────────────────────────────────────────────
  function renderResults(args) {
    var isBedtime = args.mode === 'bedtime';
    var html = '';

    [3, 4, 5, 6].forEach(function (cycles) {
      var targetTime, wakeMin, bedMin;
      if (isBedtime) {
        wakeMin  = args.time;
        bedMin   = wakeMin - cycles * CYCLE_MIN - args.delay;
        targetTime = bedMin;
      } else {
        bedMin   = args.time;
        wakeMin  = bedMin + args.delay + cycles * CYCLE_MIN;
        targetTime = wakeMin;
      }

      var sc    = alertnessScore(cycles, wakeMin, currentChronotype);
      var lbl   = scoreLabel(sc);
      var isOpt = sc === 5;
      var hrs   = cycles * 1.5;
      var hrsStr = Number.isInteger(hrs) ? hrs + 'h' : Math.floor(hrs) + 'h 30m';

      var bg = isOpt
        ? 'background:var(--sleep); color:#fff;'
        : 'background:#f8f9fa; color:var(--primary-dark); border:1px solid #e8e8e8;';
      var sub = isOpt ? 'rgba(255,255,255,.7)' : '#999';
      var starColor = isOpt ? 'rgba(255,255,255,.95)' : '#f5a623';
      var optBadge = isOpt ? '<div style="font-size:.6rem; font-weight:700; text-transform:uppercase; letter-spacing:.5px; opacity:.9; margin-bottom:2px;">⭐ Optimal</div>' : '';

      html += '<div class="result-card" data-cycles="' + cycles + '" '
        + 'onclick="selectCard(this,' + cycles + ',' + JSON.stringify(args) + ')" '
        + 'style="border-radius:12px; padding:12px 14px; text-align:center; cursor:pointer; '
        + 'transition:all .15s; flex:1; min-width:80px; ' + bg + '">'
        + optBadge
        + '<div style="font-size:1.1rem; font-weight:700; line-height:1.1;">' + formatTime(targetTime) + '</div>'
        + '<div style="font-size:.7rem; margin-top:3px; color:' + sub + '">' + cycles + ' cycles · ' + hrsStr + '</div>'
        + '<div style="font-size:.85rem; margin-top:4px; color:' + starColor + '; letter-spacing:1px;">' + stars(sc, '★', '☆') + '</div>'
        + '<div style="font-size:.62rem; color:' + sub + ';">' + lbl + '</div>'
        + '</div>';
    });

    var lbl = isBedtime
      ? 'Bedtimes for a <strong>' + formatTime(args.time) + '</strong> wake-up:'
      : 'Wake-up times if you\'re in bed by <strong>' + formatTime(args.time) + '</strong>:';

    document.getElementById('resultLabel').innerHTML = lbl;
    document.getElementById('resultCards').innerHTML = html;
    document.getElementById('results').classList.remove('d-none');

    // Auto-select best card
    var best = document.querySelector('.result-card[data-cycles="5"]');
    if (best) selectCard(best, 5, args);

    document.getElementById('results').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  }

  // ── Select a result card → update viz ────────────────────────────────────
  window.selectCard = function (el, cycles, args) {
    document.querySelectorAll('.result-card').forEach(function (c) {
      c.style.outline = '';
    });
    el.style.outline = '3px solid var(--primary-cta)';
    el.style.outlineOffset = '2px';

    var bedMin, sleepStartMin, wakeMin;
    if (args.mode === 'bedtime') {
      wakeMin       = args.time;
      sleepStartMin = wakeMin - cycles * CYCLE_MIN;
      bedMin        = sleepStartMin - args.delay;
    } else {
      bedMin        = args.time;
      sleepStartMin = bedMin + args.delay;
      wakeMin       = sleepStartMin + cycles * CYCLE_MIN;
    }

    document.getElementById('sleepViz').innerHTML = generateHypnogram(
      args.delay, cycles, formatTime(bedMin), formatTime(wakeMin)
    );
    document.getElementById('vizSection').classList.remove('d-none');
    updateStats(cycles, wakeMin);
  };

  // ── Night stats ───────────────────────────────────────────────────────────
  function updateStats(cycles, wakeMin) {
    var deep = 0, rem = 0;
    for (var c = 0; c < cycles && c < CYCLE_STAGES.length; c++) {
      deep += CYCLE_STAGES[c].deep;
      rem  += CYCLE_STAGES[c].rem;
    }
    var sc = alertnessScore(cycles, wakeMin, currentChronotype);
    document.getElementById('statDeep').textContent   = fmtDuration(deep);
    document.getElementById('statREM').textContent    = fmtDuration(rem);
    document.getElementById('statCycles').textContent = cycles + ' cycles';
    document.getElementById('statScore').textContent  = stars(sc, '★', '☆');

    var noteEl = document.getElementById('chronoNote');
    if (currentChronotype !== 'bear') {
      noteEl.textContent = CHRONO_DESCS[currentChronotype];
      noteEl.style.display = 'block';
    } else {
      noteEl.style.display = 'none';
    }
  }

  // ── Hypnogram SVG generator ───────────────────────────────────────────────
  function generateHypnogram(delayMin, numCycles, bedLabel, wakeLabel) {
    var W = 760, totalH = 148;
    var LEFT = 36, RIGHT = 8, TOP = 14;
    var baseline = 106;
    var plotW = W - LEFT - RIGHT;
    var totalMin = delayMin + numCycles * CYCLE_MIN;

    function toX(min) { return LEFT + (min / totalMin) * plotW; }

    // Y positions per stage (lower = deeper sleep)
    var SY = { awake: TOP, rem: TOP + 22, s1: TOP + 40, s2: TOP + 57, deep: TOP + 77 };

    var COLORS = {
      awake: '#c8c8c8',
      rem:   '#7c6ff7',
      s1:    '#90cae0',
      s2:    '#4a9fd4',
      deep:  '#1a5fa8',
    };
    var FILLS = {
      awake: 'rgba(200,200,200,.10)',
      rem:   'rgba(124,111,247,.12)',
      s1:    'rgba(144,202,224,.13)',
      s2:    'rgba(74,159,212,.14)',
      deep:  'rgba(26,95,168,.18)',
    };

    // Build timeline
    var timeline = [];
    var t = 0;
    if (delayMin > 0) { timeline.push({ start: 0, end: delayMin, stage: 'awake' }); t = delayMin; }
    for (var c = 0; c < numCycles && c < CYCLE_STAGES.length; c++) {
      var sp = CYCLE_STAGES[c];
      ['s1','s2','deep','rem'].forEach(function (stage) {
        if (sp[stage] > 0) {
          timeline.push({ start: t, end: t + sp[stage], stage: stage });
          t += sp[stage];
        }
      });
    }

    var svg = '<svg viewBox="0 0 ' + W + ' ' + totalH + '" width="100%" xmlns="http://www.w3.org/2000/svg" style="display:block;">';
    svg += '<rect width="' + W + '" height="' + totalH + '" fill="#f9fafb"/>';

    // Horizontal grid lines
    Object.keys(SY).forEach(function (k) {
      svg += '<line x1="' + LEFT + '" y1="' + SY[k] + '" x2="' + (W - RIGHT) + '" y2="' + SY[k] + '" stroke="#ebebeb" stroke-width="1"/>';
    });

    // Y-axis labels
    [['Wake', SY.awake], ['REM', SY.rem], ['N1', SY.s1], ['N2', SY.s2], ['N3', SY.deep]].forEach(function (l) {
      svg += '<text x="' + (LEFT - 4) + '" y="' + (l[1] + 4) + '" text-anchor="end" font-size="9" fill="#bbb" font-family="Inter,sans-serif">' + l[0] + '</text>';
    });

    // Filled areas + horizontal stage lines
    timeline.forEach(function (seg) {
      var x1 = toX(seg.start).toFixed(1);
      var x2 = toX(seg.end).toFixed(1);
      var y  = SY[seg.stage];
      var fillH = baseline - y;
      svg += '<rect x="' + x1 + '" y="' + y + '" width="' + (parseFloat(x2) - parseFloat(x1)).toFixed(1) + '" height="' + fillH + '" fill="' + FILLS[seg.stage] + '"/>';
      svg += '<line x1="' + x1 + '" y1="' + y + '" x2="' + x2 + '" y2="' + y + '" stroke="' + COLORS[seg.stage] + '" stroke-width="2.5" stroke-linecap="round"/>';
    });

    // Vertical connectors between stages
    for (var i = 0; i < timeline.length - 1; i++) {
      var cx = toX(timeline[i].end).toFixed(1);
      svg += '<line x1="' + cx + '" y1="' + SY[timeline[i].stage] + '" x2="' + cx + '" y2="' + SY[timeline[i + 1].stage] + '" stroke="#ccc" stroke-width="1"/>';
    }

    // Baseline
    svg += '<line x1="' + LEFT + '" y1="' + baseline + '" x2="' + (W - RIGHT) + '" y2="' + baseline + '" stroke="#ddd" stroke-width="1"/>';

    // Cycle separators + labels
    var ct = delayMin;
    for (var c = 0; c < numCycles - 1; c++) {
      ct += CYCLE_MIN;
      var sx = toX(ct).toFixed(1);
      svg += '<line x1="' + sx + '" y1="' + TOP + '" x2="' + sx + '" y2="' + baseline + '" stroke="#ddd" stroke-width="1" stroke-dasharray="3,2"/>';
    }
    var lt = delayMin;
    for (var c = 0; c < numCycles; c++) {
      var midX = toX(lt + 45).toFixed(1);
      svg += '<text x="' + midX + '" y="' + (baseline + 13) + '" text-anchor="middle" font-size="8" fill="#ccc" font-family="Inter,sans-serif">C' + (c + 1) + '</text>';
      lt += CYCLE_MIN;
    }

    // Time labels
    svg += '<text x="' + LEFT + '" y="' + (baseline + 26) + '" text-anchor="middle" font-size="9" fill="#999" font-family="Inter,sans-serif">' + bedLabel + '</text>';
    svg += '<text x="' + (W - RIGHT) + '" y="' + (baseline + 26) + '" text-anchor="end" font-size="9" fill="#999" font-family="Inter,sans-serif">' + wakeLabel + '</text>';

    // Alarm marker
    var ax = toX(totalMin).toFixed(1);
    svg += '<line x1="' + ax + '" y1="' + TOP + '" x2="' + ax + '" y2="' + baseline + '" stroke="#e94560" stroke-width="2"/>';
    svg += '<circle cx="' + ax + '" cy="' + TOP + '" r="4" fill="#e94560"/>';
    svg += '<text x="' + ax + '" y="' + (TOP - 6) + '" text-anchor="middle" font-size="8" fill="#e94560" font-family="Inter,sans-serif">alarm</text>';

    svg += '</svg>';
    return svg;
  }

})();
</script>
@endsection
