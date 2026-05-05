@extends('layouts.app')

@section('title', 'Sleep Debt Calculator — How Much Sleep Do You Owe? | MindSnap')
@section('description', 'Free sleep debt calculator: enter your actual vs ideal sleep each night and see exactly how much sleep debt you\'ve built up. Get a science-based recovery plan to fix chronic sleep deprivation. No signup.')
@section('canonical', config('app.url') . '/sleep-debt-calculator')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "WebApplication",
  "name": "Sleep Debt Calculator",
  "url": "{{ config('app.url') }}/sleep-debt-calculator",
  "description": "Calculate your cumulative sleep debt and get a personalised recovery plan.",
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
    { "@@type": "ListItem", "position": 3, "name": "Sleep Debt Calculator" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [
    { "@@type": "Question", "name": "What is sleep debt?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Sleep debt is the cumulative difference between the sleep your body needs and the sleep it actually gets. If you need 8 hours but sleep 6 for 5 nights, you carry a 10-hour sleep debt. The effects compound — cognitive impairment worsens with each night of insufficient sleep, often without the person realising how impaired they are." } },
    { "@@type": "Question", "name": "Can you recover sleep debt by sleeping in at weekends?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Partially. Short-term acute sleep debt (less than a week) can be partially recovered by extending sleep for several nights. However, chronic sleep debt accumulated over months or years causes lasting cellular and metabolic changes that weekend catch-up sleep does not fully reverse. The best approach is consistent daily sleep meeting your individual need." } },
    { "@@type": "Question", "name": "How long does it take to recover from sleep debt?",
      "acceptedAnswer": { "@@type": "Answer", "text": "A 2021 study in Current Biology found that recovery from short-term sleep debt requires approximately 4 full nights of extended sleep. For every hour of deficit, the brain requires roughly 2–3 days of adequate sleep to return to baseline cognitive performance. Gradual daily increases of 30–60 minutes are more effective than massive weekend catch-up." } }
    ,{ "@@type": "Question", "name": "How does sleep debt compound over time?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Sleep debt is cumulative and compounds cognitively. A 2003 UPenn study found that 14 consecutive nights of 6-hour sleep produced cognitive impairment equivalent to 48 hours of total sleep deprivation. More alarmingly, subjects rated their own sleepiness as only 'slightly impaired' — the brain loses its ability to gauge its own deficit. Each additional night of insufficient sleep worsens performance without the person realising it." } },
    { "@@type": "Question", "name": "Does exercise help pay off sleep debt?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Exercise improves sleep quality and can increase deep sleep duration in subsequent nights, which accelerates recovery from sleep debt. However, it does not replace sleep itself. Vigorous exercise within 3 hours of bedtime raises core temperature and cortisol, which can delay sleep onset — counterproductive when you're trying to recover. Morning or afternoon exercise is best for sleep debt recovery." } }
  ]
}
</script>
@endsection

@php
$faqs = [
  ['q' => 'Can you catch up on sleep debt at weekends?',
             'a' => 'Partially. Research (Spiegel et al., 2019) shows that weekend recovery sleep can restore some cognitive functions and reduce subjective sleepiness. However, metabolic markers — including insulin sensitivity, inflammation, and appetite hormones — do not fully normalise. The best strategy is consistent sleep throughout the week, not binge-sleeping at weekends.'],
  ['q' => 'How much sleep debt is dangerous?',
             'a' => 'Any consistent sleep debt has measurable effects. A 2003 landmark study (Van Dongen, UPenn) found that 14 consecutive nights of 6-hour sleep produced cognitive impairment equivalent to 2 days of total sleep deprivation. Critically, subjects rated their own impairment as minimal — the brain loses the ability to gauge its own deficit.'],
  ['q' => 'Does everyone need 8 hours of sleep?',
             'a' => 'No. Sleep need is genetically determined and varies from 6 to 10 hours among healthy adults. A tiny minority (under 3%) carry a genetic variant (DEC2 mutation) allowing function on 6 hours. But most people who claim to "be fine" on 6 hours are in fact chronically impaired — they just can\'t tell. True low-sleep-need individuals are rare.'],
  ['q' => 'How can I tell if I have a sleep debt?',
             'a' => 'Key signs: you need an alarm to wake up most mornings, you\'d sleep longer on a free day, you fall asleep within 5 minutes of sitting still in a warm room, you rely on caffeine to feel functional before noon, and you sleep more than 2 hours extra on weekends. All of these indicate meaningful sleep debt.'],
  ['q' => 'What is the fastest way to recover from sleep debt?',
             'a' => 'Gradually extend sleep by 30–60 minutes per night rather than attempting massive catch-up sessions. Going from 6 to 9 hours suddenly disrupts your circadian rhythm. Aim for your target sleep duration consistently for 10–14 days. Avoid stimulants after 2 PM, maintain consistent wake times, and address any sleep environment issues first.'],
  ['q' => 'How does sleep debt compound — why does it get worse each day?',
             'a' => 'Sleep debt accumulates because each insufficient night increases adenosine (the brain\'s sleepiness chemical) without full clearance. A 2003 UPenn study showed that <strong>14 nights of 6h sleep</strong> produced cognitive impairment matching 48 hours of total sleep deprivation. The insidious part: subjects rated themselves as only "slightly impaired" — the brain loses its ability to gauge its own deficit after about day 5.'],
  ['q' => 'Does exercise help recover sleep debt faster?',
             'a' => 'Regular aerobic exercise increases slow-wave deep sleep — the most restorative stage — in subsequent nights, which can accelerate debt recovery. However, time it correctly: <strong>exercise before 3 PM</strong> for best effect. Late-evening vigorous exercise raises core temperature and cortisol, delaying sleep onset. Morning outdoor exercise (with sunlight exposure) is the highest-ROI combination for sleep debt recovery.'],
  ['q' => 'Does sleeping in on weekends pay off sleep debt?', 'a' => 'Partially — but with a cost. Weekend lie-ins do help recover some sleep debt, but sleeping 2–3 hours later than your weekday wake time shifts your circadian rhythm, creating "social jet lag." This makes Monday mornings feel like jet lag and actually makes weekday sleep worse. A better strategy: go to bed slightly earlier on weeknights rather than sleeping dramatically later on weekends.'],
  ['q' => 'How much sleep debt is dangerous?', 'a' => 'Any sleep debt impairs function, but research suggests cognitive performance begins measurably declining after a cumulative deficit of 20+ hours (roughly 3 nights of 6-hour sleep instead of 8). A deficit of 40+ hours produces impairment equivalent to being legally drunk. Chronic sleep debt of 2+ hours per night sustained over months is associated with increased risk of obesity, type 2 diabetes, cardiovascular disease, and depression.'],
  ['q' => 'Can you build a tolerance to sleep deprivation?', 'a' => 'You can build a subjective tolerance — you stop feeling as sleepy — but your objective cognitive impairment continues to worsen. This is one of the most well-documented findings in sleep research (Van Dongen et al., 2003): people chronically restricted to 6 hours per night stopped reporting feeling sleepy after a few days, yet their reaction times and cognitive tests continued declining to levels equivalent to total sleep deprivation. Feeling fine does not mean you are performing fine.'],
];

$relatedTools = [
  ['icon' => '😴', 'name' => 'Sleep Calculator', 'slug' => 'sleep-calculator', 'desc' => 'Best bedtime based on your wake-up time.'],
  ['icon' => '⏰', 'name' => 'Wake-Up Calculator', 'slug' => 'wake-up-calculator', 'desc' => 'Best wake-up times from your bedtime.'],
  ['icon' => '💤', 'name' => 'Nap Calculator', 'slug' => 'nap-calculator', 'desc' => 'Recover sleep debt with a properly timed nap.'],
  ['icon' => '📋', 'name' => 'Sleep Quality Quiz', 'slug' => 'sleep-quality-quiz', 'desc' => 'Score your sleep quality in 10 questions.'],
  ['icon' => '☕', 'name' => 'Caffeine & Sleep', 'slug' => 'caffeine-sleep-calculator', 'desc' => 'Stop caffeine at the right time.'],
  ['icon' => '✈️', 'name' => 'Jet Lag Calculator', 'slug' => 'jet-lag-calculator', 'desc' => 'Plan sleep around long flights.'],
];
@endphp

@section('content')

<section class="ms-hero">
  <div class="container-xl">
    <div class="row align-items-start g-5">

      <div class="col-lg-7">
        <nav aria-label="breadcrumb" class="mb-3">
          <ol class="breadcrumb ms-breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('category.sleep') }}">Sleep Tools</a></li>
            <li class="breadcrumb-item active">Sleep Debt Calculator</li>
          </ol>
        </nav>

        <h1 class="mb-2 ms-hero-title">
          📉 Sleep Debt Calculator — How Much Sleep Are You Missing?
        </h1>
        <p class="ms-hero-desc">
          Enter how much sleep you're actually getting versus what you need. See your debt in hours and get a recovery plan.
        </p>

        <div class="card border-0 mb-n4 ms-tool-card">
          <div class="card-body p-4 p-md-5">

            <div class="mb-4">
              <label for="ageGroup" class="form-label fw-600">Your age group</label>
              <select id="ageGroup" class="form-select" onchange="updateNeeded()">
                <option value="8.5">Child (6–12 years) — 9–11 hrs recommended</option>
                <option value="9">Teenager (13–17 years) — 8–10 hrs recommended</option>
                <option value="8" selected>Young Adult / Adult (18–64 years) — 7–9 hrs recommended</option>
                <option value="7.5">Older Adult (65+) — 7–8 hrs recommended</option>
              </select>
            </div>

            <div class="mb-4">
              <label for="neededHours" class="form-label fw-600">
                Hours of sleep you personally need per night
                <span class="text-muted fw-400" style="font-size:.83rem;">pre-filled from age group average</span>
              </label>
              <div class="d-flex align-items-center gap-3">
                <input type="range" id="neededSlider" min="6" max="10" step="0.5" value="8"
                       class="form-range flex-grow-1" oninput="syncSlider('needed')">
                <span id="neededVal" style="min-width:40px; font-weight:700; color:var(--sleep);">8h</span>
              </div>
            </div>

            <div class="mb-4">
              <label class="form-label fw-600">Average sleep per night this week (each day)</label>
              <div class="row g-2" id="dayInputs">
                @foreach(['Mon','Tue','Wed','Thu','Fri','Sat','Sun'] as $day)
                <div class="col">
                  <label style="font-size:.72rem; color:#888; display:block; text-align:center; margin-bottom:4px;">{{ $day }}</label>
                  <input type="number" class="form-control day-input text-center" data-day="{{ strtolower($day) }}"
                         value="7" min="0" max="14" step="0.5"
                         style="font-size:.9rem; padding:8px 4px;"
                         aria-label="{{ $day }} sleep hours">
                </div>
                @endforeach
              </div>
            </div>

            <button class="btn btn-cta w-100" onclick="calcDebt()" style="font-size:1rem;">
              Calculate My Sleep Debt →
            </button>

            <div id="debtResult" class="mt-4 d-none">
              <div class="ms-divider"></div>
              <div id="debtContent"></div>
            </div>

          </div>
        </div>
      </div>

      <div class="col-lg-5 d-none d-lg-block" style="padding-top:10px;">
        <div class="ms-facts-wrap">
          <h3 class="ms-facts-title">Sleep Debt Impact</h3>
          @foreach([
            ['3×',    'Higher cold risk after <7 hrs/night (Carnegie Mellon)'],
            ['48h',   'Equivalent impairment from 2 weeks of 6h sleep'],
            ['13%',   'Lower reaction time per night of 6h vs 8h sleep'],
            ['4 nts', 'Recovery time needed after short-term sleep debt'],
            ['23%',   'Adults sleeping under 7 hours per night (CDC)'],
          ] as [$stat, $label])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div class="ms-fact-pill ms-fact-pill-sleep">{{ $stat }}</div>
            <div class="ms-fact-label">{{ $label }}</div>
          </div>
          @endforeach
          <p class="ms-fact-source">Sources: CMU, UPenn, CDC, NIH</p>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- Effects --}}
<section class="ms-section-white">
  <div class="container-xl">
    <h2 class="text-center mb-2">The Real Cost of Sleep Debt</h2>
    <p class="text-center text-muted mb-5" style="max-width:540px; margin:0 auto 40px;">Research-backed effects of cumulative sleep deprivation at different debt levels.</p>
    <div class="row g-4">
      @foreach([
        ['0–2 hrs','Mild Deficit','#d1eddb','#155724','Slightly reduced attention and reaction time. Most people don\'t notice. Manageable with one recovery night.'],
        ['2–5 hrs','Moderate Deficit','#fff3cd','#664d03','Measurable decline in memory, mood, and decision-making. 2–3× higher risk of microsleeps while driving. Feels like normal tiredness.'],
        ['5–10 hrs','Significant Deficit','#ffe5cc','#7a4004','Equivalent to mild alcohol intoxication. Reaction time, working memory, and creativity are all impaired — but subjects rate themselves as only "slightly sleepy." Requires 3–5 recovery nights.'],
        ['10+ hrs','Severe Deficit','#ffd5d5','#721c24','Equivalent to 48h of total sleep deprivation. Immune function suppressed, metabolic markers disrupted, emotional regulation breaks down. Requires 1–2 weeks of recovery sleep.'],
      ] as [$debt,$label,$bg,$color,$desc])
      <div class="col-sm-6 col-lg-3">
        <div class="p-4 rounded-3 h-100" style="background:{{ $bg }}; border:1px solid {{ $color }}30;">
          <div style="font-size:1.2rem; font-weight:800; color:{{ $color }};">{{ $debt }}</div>
          <div style="font-weight:700; color:{{ $color }}; font-size:.85rem; margin:4px 0 12px; text-transform:uppercase; letter-spacing:.4px;">{{ $label }}</div>
          <p style="font-size:.82rem; color:#555; line-height:1.7; margin:0;">{{ $desc }}</p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- Compound Effect --}}
<section class="ms-section-white">
  <div class="container-xl">
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <span class="ms-badge ms-badge-sleep mb-3">The Research</span>
        <h2 class="mb-4">Why Sleep Debt Feels "Fine" Until It's Not</h2>
        <p>The most dangerous aspect of sleep debt isn't the impairment itself — it's that the brain loses its ability to accurately gauge that impairment. A landmark 2003 study by Van Dongen and colleagues at the University of Pennsylvania had participants sleep 6 or 4 hours per night for 14 consecutive nights.</p>
        <p>By day 14, the 6-hour group showed cognitive performance equivalent to someone who had been awake for <strong>48 straight hours</strong>. Yet subjective sleepiness ratings plateaued around day 5 — participants thought they had adapted. They hadn't. They had simply lost the neurological sensitivity to detect their own deficit.</p>
        <p>This is the core problem with modern sleep culture: we benchmark our performance against our impaired baseline, not against our rested potential. The productivity gains from recovering sleep debt are often invisible because people cannot remember what "fully rested" feels like.</p>
      </div>
      <div class="col-lg-6">
        <h3 style="font-size:1rem;" class="mb-4">Cumulative Effect of 6h Sleep Over 2 Weeks</h3>
        @foreach([
          ['Days 1–3','Slightly impaired attention and reaction time. Most people don\'t notice.',10,'#d1eddb','#155724'],
          ['Days 4–7','Measurable decline in memory, decision-making, and emotional regulation.',35,'#fff3cd','#664d03'],
          ['Days 8–11','Equivalent to missing 1 full night of sleep. Significant cognitive deficit.',65,'#ffe5cc','#7a4004'],
          ['Days 12–14','Equivalent to 48h sleep deprivation. Brain cannot self-assess impairment.',100,'#ffd5d5','#721c24'],
        ] as [$period,$desc,$pct,$bg,$color])
        <div class="mb-3">
          <div class="d-flex justify-content-between mb-1">
            <span style="font-size:.82rem; font-weight:700; color:{{ $color }};">{{ $period }}</span>
            <span style="font-size:.75rem; color:#888;">{{ $desc }}</span>
          </div>
          <div style="background:#f0f0f0; border-radius:4px; height:8px;">
            <div style="width:{{ $pct }}%; height:100%; background:{{ $color }}; border-radius:4px;"></div>
          </div>
        </div>
        @endforeach
        <p style="font-size:.78rem; color:#888; margin-top:12px;">Source: Van Dongen et al. (2003), Sleep, University of Pennsylvania</p>
      </div>
    </div>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="debtFaq" />


<section class="ms-section-accent">
  <div class="container ms-longtail">
    <h2 class="mb-4" style="color:var(--primary-dark);">Can You Recover from Chronic Sleep Deprivation?</h2>
    <p>Yes — but not as quickly as most people think. Research from the University of Colorado found that one or two "recovery" nights does not fully reverse the cognitive impairments from a week of sleep restriction. Full cognitive recovery typically requires 3 consecutive nights of adequate sleep after moderate sleep debt, and up to 2–3 weeks of consistent sleep after chronic deprivation. Metabolic markers (insulin sensitivity, cortisol levels) take even longer to normalise.</p>
    <h2 class="mt-5 mb-4" style="color:var(--primary-dark);">How Long Does It Take to Pay Back Sleep Debt?</h2>
    <p>A commonly cited "rule of thumb" is that you need approximately 4 days of adequate sleep to recover from 1 hour of sleep debt. In practice: mild debt (1–5 hours) resolves in 1–2 weeks of consistent sleep. Moderate debt (5–20 hours, built over months) takes 2–4 weeks. Severe chronic sleep deprivation (years of insufficient sleep) may never be fully reversed, with some research suggesting permanent changes to brain structure in extreme cases. The strongest message from sleep science: prevention is far easier than recovery.</p>
    <h2 class="mt-5 mb-4" style="color:var(--primary-dark);">Sleep Debt Symptoms — How to Know You Are Sleep Deprived</h2>
    <p>Common symptoms of significant sleep debt include: falling asleep within 5 minutes of lying down (healthy is 10–20 minutes), microsleeps (involuntary 1–30 second sleep episodes while awake), increased appetite particularly for high-carbohydrate foods, emotional reactivity disproportionate to the situation, impaired decision-making that you cannot perceive yourself, and a feeling of being "fine" that disappears the moment you stop being busy. The inability to accurately assess your own impairment is one of the most dangerous aspects of sleep debt.</p>
  </div>
</section>

<x-related-tools :tools="$relatedTools" heading="More Sleep Tools" />


@endsection

@section('scripts')
<script>
(function () {
  window.updateNeeded = function () {
    var val = parseFloat(document.getElementById('ageGroup').value);
    document.getElementById('neededSlider').value = val;
    document.getElementById('neededVal').textContent = val + 'h';
  };

  window.syncSlider = function (type) {
    var v = parseFloat(document.getElementById('neededSlider').value);
    document.getElementById('neededVal').textContent = v + 'h';
  };

  window.calcDebt = function () {
    var needed = parseFloat(document.getElementById('neededSlider').value);
    var days = document.querySelectorAll('.day-input');
    var totalActual = 0;
    days.forEach(function (d) { totalActual += parseFloat(d.value) || 0; });

    var totalNeeded = needed * 7;
    var debt = totalNeeded - totalActual;
    var avgActual = totalActual / 7;

    var level, bg, color, icon, recoveryNights;
    if (debt <= 0) {
      level = 'No Sleep Debt'; bg = '#d1eddb'; color = '#155724'; icon = '✅';
      recoveryNights = 0;
    } else if (debt <= 2) {
      level = 'Mild Deficit'; bg = '#d1eddb'; color = '#155724'; icon = '🟡';
      recoveryNights = 1;
    } else if (debt <= 5) {
      level = 'Moderate Deficit'; bg = '#fff3cd'; color = '#664d03'; icon = '⚠️';
      recoveryNights = 3;
    } else if (debt <= 10) {
      level = 'Significant Deficit'; bg = '#ffe5cc'; color = '#7a4004'; icon = '🔴';
      recoveryNights = 5;
    } else {
      level = 'Severe Deficit'; bg = '#ffd5d5'; color = '#721c24'; icon = '🚨';
      recoveryNights = 10;
    }

    var debtText = debt <= 0
      ? 'You met your sleep need this week. Great work!'
      : 'You\'re missing <strong>' + debt.toFixed(1) + ' hours</strong> of sleep this week.';

    var html = '<div class="p-4 rounded-3 mb-3" style="background:' + bg + '; border:1px solid ' + color + '30;">'
      + '<div style="font-size:2rem; margin-bottom:8px;">' + icon + '</div>'
      + '<div style="font-size:1.6rem; font-weight:800; color:' + color + ';">'
      + (debt <= 0 ? '0h debt' : debt.toFixed(1) + 'h debt') + '</div>'
      + '<div style="font-weight:700; color:' + color + '; margin:4px 0 8px; text-transform:uppercase; font-size:.8rem; letter-spacing:.5px;">' + level + '</div>'
      + '<p style="font-size:.88rem; color:#555; margin:0;">' + debtText + '</p>'
      + '</div>';

    html += '<div class="row g-3 mb-3">'
      + '<div class="col-4 text-center"><div style="background:#f8f9fa; border-radius:10px; padding:12px;">'
      + '<div style="font-size:1.3rem; font-weight:800; color:var(--sleep);">' + avgActual.toFixed(1) + 'h</div>'
      + '<div class="ms-stat-label">Avg per night</div></div></div>'
      + '<div class="col-4 text-center"><div style="background:#f8f9fa; border-radius:10px; padding:12px;">'
      + '<div style="font-size:1.3rem; font-weight:800; color:var(--sleep);">' + needed + 'h</div>'
      + '<div class="ms-stat-label">You need</div></div></div>'
      + '<div class="col-4 text-center"><div style="background:#f8f9fa; border-radius:10px; padding:12px;">'
      + '<div style="font-size:1.3rem; font-weight:800; color:' + color + ';">'
      + (debt <= 0 ? '0' : '-' + (needed - avgActual).toFixed(1)) + 'h</div>'
      + '<div class="ms-stat-label">Per night gap</div></div></div>'
      + '</div>';

    if (debt > 0) {
      html += '<div class="p-3 rounded-3" style="background:#f0f4ff; border:1px solid var(--sleep)30;">'
        + '<p style="font-weight:700; color:var(--primary-dark); font-size:.88rem; margin-bottom:8px;">📋 Recovery Plan</p>'
        + '<ul style="margin:0; padding-left:18px; font-size:.85rem; color:#555; line-height:1.8;">'
        + '<li>Add <strong>' + Math.min(60, Math.ceil(debt / 7 * 60)) + ' minutes</strong> of sleep per night over the next ' + recoveryNights + ' nights</li>'
        + '<li>Keep wake time consistent — only extend the bedtime earlier</li>'
        + '<li>Avoid alcohol, caffeine after 2 PM, and screens 1 hour before bed</li>'
        + '<li>A 20-min power nap at 1–2 PM can offset 1–2 hours of night deficit</li>'
        + '<li>Full cognitive recovery may take <strong>' + recoveryNights + '–' + (recoveryNights + 2) + ' days</strong> of adequate sleep</li>'
        + '</ul></div>';
    }

    document.getElementById('debtContent').innerHTML = html;
    document.getElementById('debtResult').classList.remove('d-none');
    document.getElementById('debtResult').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  };

  updateNeeded();
})();
</script>
@endsection
