@extends('layouts.app')

@section('title', 'Wake-Up Time Calculator — Best Time to Wake Up From Your Bedtime | MindSnap')
@section('description', 'Enter your bedtime and instantly find the best wake-up times based on 90-minute sleep cycles. Avoid morning grogginess by waking between sleep cycles. Free wake-up calculator, no signup.')
@section('canonical', config('app.url') . '/wake-up-calculator')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "WebApplication",
  "name": "Wake-Up Time Calculator",
  "url": "{{ config('app.url') }}/wake-up-calculator",
  "description": "Calculate the best wake-up times based on your bedtime and 90-minute sleep cycles.",
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
    { "@@type": "ListItem", "position": 3, "name": "Wake-Up Calculator" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [
    { "@@type": "Question", "name": "What is the best time to wake up?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The best wake-up time is at the end of a complete 90-minute sleep cycle, not in the middle of one. Waking mid-cycle triggers sleep inertia — deep grogginess lasting 15–60 minutes. This calculator shows you exactly which times align with cycle endings so you surface naturally alert." } },
    { "@@type": "Question", "name": "Why do I feel worse after 8 hours than 7.5 hours?",
      "acceptedAnswer": { "@@type": "Answer", "text": "If 8 hours puts your alarm mid-cycle but 7.5 hours (5 complete 90-minute cycles) ends at a natural break, you'll feel considerably better on 7.5. Total sleep time matters less than where in a cycle your alarm falls. Use this calculator to find cycle-aligned wake times." } },
    { "@@type": "Question", "name": "How long does it take to fall asleep?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The average healthy adult takes 10–20 minutes to fall asleep. This is called sleep onset latency. The calculator adds your fall-asleep time to your bedtime before counting cycles, so the results reflect actual sleep time rather than time in bed." } }
    ,{ "@@type": "Question", "name": "Should I keep the same wake time on weekends?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes. Keeping a consistent wake time every day — including weekends — is the single most effective sleep hygiene habit. Sleeping in on weekends creates 'social jet lag': a circadian misalignment equivalent to flying 1–3 time zones every weekend. Research links social jet lag to higher BMI, worse mood, and increased cardiovascular risk. Fix your wake time first; your bedtime will follow naturally." } },
    { "@@type": "Question", "name": "Why do I feel worse on days I sleep longer?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Sleeping significantly longer than usual disrupts your circadian rhythm and can cause 'sleep drunkenness' — a form of sleep inertia triggered by waking during a deep cycle you would not normally be in. Additionally, excess sleep time often means waking mid-deep-sleep at an unusual hour. The solution is consistent timing, not varying duration." } }
  ]
}
</script>
@endsection

@php
$faqs = [
  ['q' => 'Why do I feel worse after 8 hours than 7.5 hours?',
             'a' => 'If 8 hours puts your alarm mid-cycle but 7.5 hours (5 complete 90-minute cycles) ends at a natural break, you\'ll feel considerably better on 7.5 hours. Total sleep time matters less than where in a cycle your alarm falls. This calculator shows you the cycle-aligned times.'],
  ['q' => 'What is sleep inertia and how long does it last?',
             'a' => 'Sleep inertia is the grogginess caused by waking during deep Stage 3 sleep. Adenosine (the brain\'s sleepiness chemical) is still elevated, core temperature is low, and cognitive function — including reaction time and decision-making — is measurably impaired. It typically lasts 15–60 minutes, though full recovery can take up to 4 hours after severe interruption.'],
  ['q' => 'Can I train myself to need less sleep?',
             'a' => 'No. Research consistently shows that people who believe they\'ve adapted to less sleep have only adapted to feeling less sleepy — their measured cognitive performance continues to decline. There is no evidence that sleep need can be permanently reduced through training. The only sustainable strategy is getting the sleep your body requires.'],
  ['q' => 'What if I naturally wake before my alarm?',
             'a' => 'This is a sign your body completed its cycles and naturally surfaced. It means the calculator\'s timing is working well for your physiology. On these mornings, get up — lying in bed after a natural wake often triggers a new cycle, leaving you worse off when the alarm finally sounds.'],
  ['q' => 'Does the 90-minute cycle length vary by person?',
             'a' => 'Yes. The average is 90 minutes but individual cycles range from 80–110 minutes. If you consistently wake naturally 20–30 minutes before a calculated time, your cycles may run closer to 80 minutes. Adjust by using the sleep-calculator\'s bedtime mode and experimenting with 85-minute blocks.'],
  ['q' => 'Should I keep the same wake time on weekends?',
             'a' => 'Yes — this is the single most effective sleep hygiene habit. Sleeping in on weekends creates <strong>social jet lag</strong>: a circadian misalignment equivalent to flying 1–3 time zones every weekend. Research links it to higher BMI, worse mood, and increased cardiovascular risk. Fix your wake time first; your body will naturally shift your bedtime earlier within 2 weeks.'],
  ['q' => 'Why do I feel worse when I sleep longer on weekends?',
             'a' => 'Sleeping much longer than usual disrupts your circadian rhythm and often causes you to wake mid-cycle in a deep sleep stage you wouldn\'t normally be in at that hour. This produces sleep inertia — grogginess that can last 1–2 hours. The fix is consistent wake timing, not variable duration. Use the same wake time every day and let your body adjust bedtime naturally.'],
  ['q' => 'What is the best time to wake up for productivity?', 'a' => 'Research suggests waking between 6:00 am and 7:30 am correlates with higher reported productivity and wellbeing — but only when it aligns with completing full sleep cycles. Waking at 5:00 am after 6 hours of sleep is less productive than waking at 7:30 am after 7.5 hours. The key is cycle completion, not the clock time itself.'],
  ['q' => 'If I go to sleep at midnight, what time should I wake up?', 'a' => 'If you fall asleep at midnight (after ~15 min to fall asleep, so sleep starts at 12:15 am), ideal wake-up times are: 1:45 am (1 cycle — emergency only), 3:15 am (2 cycles), 4:45 am (3 cycles), 6:15 am (4 cycles), 7:45 am (5 cycles — recommended), 9:15 am (6 cycles). The 7:45 am option gives you 7.5 hours of quality sleep.'],
  ['q' => 'Why do I feel worse after 8 hours than after 7.5?', 'a' => 'Eight hours (480 minutes) does not divide evenly into 90-minute cycles — it gives 5.33 cycles, meaning you wake 30 minutes into a cycle. That mid-cycle interruption triggers sleep inertia — the groggy, disoriented feeling that can last 1–2 hours. Seven and a half hours (5 complete cycles) or 9 hours (6 complete cycles) avoid this completely.'],
];

$relatedTools = [
  ['icon' => '😴', 'name' => 'Sleep Calculator', 'slug' => 'sleep-calculator', 'desc' => 'Find your ideal bedtime based on when you need to wake up.'],
  ['icon' => '💤', 'name' => 'Nap Calculator', 'slug' => 'nap-calculator', 'desc' => 'Power nap or full cycle? Find the right nap length.'],
  ['icon' => '📉', 'name' => 'Sleep Debt Calculator', 'slug' => 'sleep-debt-calculator', 'desc' => 'How much sleep do you owe your body this week?'],
  ['icon' => '☕', 'name' => 'Caffeine & Sleep', 'slug' => 'caffeine-sleep-calculator', 'desc' => 'Last safe coffee time based on your bedtime.'],
  ['icon' => '✈️', 'name' => 'Jet Lag Calculator', 'slug' => 'jet-lag-calculator', 'desc' => 'Sleep schedule recovery after long-haul flights.'],
  ['icon' => '📋', 'name' => 'Sleep Quality Quiz', 'slug' => 'sleep-quality-quiz', 'desc' => '10-question quiz to score your sleep quality.'],
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
            <li class="breadcrumb-item active">Wake-Up Calculator</li>
          </ol>
        </nav>

        <h1 class="mb-2 ms-hero-title">
          ⏰ Wake-Up Time Calculator — Wake Up Refreshed
        </h1>
        <p class="ms-hero-desc">
          Enter your bedtime and find the ideal wake-up times based on complete 90-minute sleep cycles — so you never wake up groggy again.
        </p>

        <div class="card border-0 mb-n4 ms-tool-card">
          <div class="card-body p-4 p-md-5">

            <div class="mb-4">
              <label for="bedtime" class="form-label fw-600">What time are you going to bed?</label>
              <input type="time" id="bedtime" class="form-control" value="23:00" aria-label="Bedtime">
            </div>

            <div class="mb-4">
              <label for="fallAsleep" class="form-label fw-600">
                How long does it take you to fall asleep?
                <span class="text-muted fw-400" style="font-size:.83rem;">average: 10–20 min</span>
              </label>
              <select id="fallAsleep" class="form-select">
                <option value="5">5 minutes (falls asleep very fast)</option>
                <option value="10">10 minutes</option>
                <option value="14" selected>14 minutes (average)</option>
                <option value="20">20 minutes</option>
                <option value="30">30 minutes (takes a while)</option>
                <option value="45">45+ minutes (insomnia risk)</option>
              </select>
            </div>

            <button class="btn btn-cta w-100" onclick="calcWakeUp()" style="font-size:1rem;">
              Show Best Wake-Up Times →
            </button>

            <div id="results" class="mt-4 d-none">
              <div class="ms-divider"></div>
              <p class="mb-3" style="color:var(--primary-dark); font-size:.9rem; font-weight:600;">
                Best wake-up times if you're in bed at <span id="bedtimeLabel"></span>:
              </p>
              <div class="row g-3" id="wakeCards"></div>
              <p class="mt-3 mb-0" style="font-size:.8rem; color:#888;">
                ⭐ marks the optimal window (5–6 cycles = 7.5–9 hours). Waking at these times means you surface at the end of a natural sleep cycle.
              </p>
            </div>

          </div>
        </div>
      </div>

      <div class="col-lg-5 d-none d-lg-block" style="padding-top:10px;">
        <div class="ms-facts-wrap">
          <h3 class="ms-facts-title">Sleep Cycle Quick Facts</h3>
          @foreach([
            ['90 min',  'Length of one complete sleep cycle'],
            ['4–6',     'Cycles in a full night (6–9 hours)'],
            ['14 min',  'Average sleep onset latency for adults'],
            ['7–9 hrs', 'Recommended sleep for adults (CDC)'],
            ['Stage 3', 'Hardest stage to wake from (deep NREM)'],
          ] as [$stat, $label])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div class="ms-fact-pill ms-fact-pill-sleep">{{ $stat }}</div>
            <div class="ms-fact-label">{{ $label }}</div>
          </div>
          @endforeach
        </div>
      </div>

    </div>
  </div>
</section>

{{-- How It Works --}}
<section class="ms-section-white">
  <div class="container-xl">
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <span class="ms-badge ms-badge-sleep mb-3">How It Works</span>
        <h2 class="mb-4">Why Your Wake-Up Time Affects How You Feel All Day</h2>
        <p>Your brain moves through sleep in 90-minute cycles all night. Each cycle ends with a brief transition through light sleep — the natural point to wake. At this moment, your body temperature is rising, sleep pressure is lowest, and your brain is practically ready to surface on its own.</p>
        <p>Interrupt a cycle mid-way through Stage 3 (deep sleep) and you trigger sleep inertia: elevated adenosine, low core temperature, and impaired cognitive function that can persist for 30–60 minutes despite a full night of sleep.</p>
        <p>This calculator adds your fall-asleep delay to your bedtime, then counts forward in 90-minute blocks. The result is the exact clock time each cycle ends — the windows where waking feels natural and easy.</p>
      </div>
      <div class="col-lg-6">
        <div class="p-4 rounded-3 ms-data-box">
          <p class="fw-600 mb-3" style="color:var(--primary-dark); font-size:.88rem; text-transform:uppercase; letter-spacing:.5px;">Sleep stages within each 90-min cycle</p>
          @foreach([
            ['Stage 1','~5 min','#aacde8','Light sleep. Easy to wake, muscles relax.'],
            ['Stage 2','~25 min','#4a9fd4','Sleep spindles. Memory consolidation begins.'],
            ['Stage 3','~35 min','#1a5fa8','Deep sleep. Physical repair. Hard to wake.'],
            ['REM','~25 min','#7c6ff7','Dreaming. Emotional processing. Expands in later cycles.'],
          ] as [$s,$d,$c,$desc])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div style="background:{{ $c }}; color:#fff; border-radius:6px; padding:4px 8px; font-size:.75rem; font-weight:700; min-width:50px; text-align:center; flex-shrink:0; margin-top:2px;">{{ $d }}</div>
            <div>
              <div class="fw-600" style="font-size:.87rem; color:#1a1a2e;">{{ $s }}</div>
              <div style="font-size:.8rem; color:#666; line-height:1.5;">{{ $desc }}</div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Signs Mid-Cycle --}}
<section class="ms-section-muted">
  <div class="container-xl">
    <div class="row g-5">
      <div class="col-lg-6">
        <h2 class="mb-4">Signs You're Waking Mid-Cycle</h2>
        <div class="d-flex flex-column gap-2 mb-4">
          @foreach([
            'You need 2–3 snooze alarms before you can get up',
            'You feel thick-headed for 20–30 minutes even on a "full" night',
            'You perform significantly better on days you wake without an alarm',
            'Weekend wake times are 2+ hours later than weekdays',
            'You feel most alert mid-morning, not within 30 minutes of waking',
          ] as $s)
          <div class="d-flex gap-2 p-2 rounded-3" style="background:#fff3f3;">
            <div style="color:var(--primary-cta); flex-shrink:0; font-weight:700;">✗</div>
            <div style="font-size:.88rem; color:#555;">{{ $s }}</div>
          </div>
          @endforeach
        </div>
      </div>
      <div class="col-lg-6">
        <h2 class="mb-4">Signs You're Waking at the Right Time</h2>
        <div class="d-flex flex-column gap-2">
          @foreach([
            'Alert and oriented within 2–3 minutes of waking',
            'No urge to lie back down after the alarm sounds',
            'Consistent energy through the morning without caffeine',
            'You remember the content of a dream (indicates light-sleep wake)',
            'Energy on weekdays matches weekends at the same wake time',
          ] as $s)
          <div class="d-flex gap-2 p-2 rounded-3" style="background:#f0fff4;">
            <div style="color:#28a745; flex-shrink:0; font-weight:700;">✓</div>
            <div style="font-size:.88rem; color:#555;">{{ $s }}</div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="wuFaq" />


<section class="ms-section-accent">
  <div class="container ms-longtail">
    <h2 class="mb-4" style="color:var(--primary-dark);">Best Wake-Up Time for Night Shift Workers</h2>
    <p>For night shift workers, "wake-up time" means the time you need to be alert for work — not the morning. Enter your shift start time as your target wake-up time, subtract 15 minutes for grogginess, and use the calculator to find when to go to sleep. If your shift starts at 10:00 pm, target a wake-up of 9:30 pm and work backwards to find your ideal daytime sleep start.</p>
    <h2 class="mt-5 mb-4" style="color:var(--primary-dark);">Wake-Up Calculator for Early Birds vs Night Owls</h2>
    <p>Chronotype — your genetic sleep preference — determines whether you are a natural early bird (morning type) or night owl (evening type). Early birds naturally complete their cycles earlier and wake easily at 5–6 am. Night owls have a delayed circadian phase and function best waking at 8–10 am. Neither is wrong — but forcing a night owl to wake at 5 am long-term increases cardiovascular risk. Use this calculator to find wake times that work with your chronotype, not against it.</p>
    <h2 class="mt-5 mb-4" style="color:var(--primary-dark);">Why 5 or 6 Sleep Cycles Is the Sweet Spot</h2>
    <p>Most adults perform best after 5 complete sleep cycles (7.5 hours) or 6 cycles (9 hours). Four cycles (6 hours) is sufficient for a night when sleep time is limited, but chronically sleeping 4 cycles builds significant sleep debt. Three cycles or fewer (under 4.5 hours) impairs cognitive performance, reaction time, and emotional regulation — even if it does not feel that way.</p>
  </div>
</section>

<x-related-tools :tools="$relatedTools" heading="More Sleep Tools" />


@endsection

@section('scripts')
<script>
(function () {
  var CYCLE_MIN = 90;

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
    return hd + ':' + (m < 10 ? '0' + m : m) + ' ' + period;
  }

  function hoursLabel(cycles) {
    var h = cycles * 1.5;
    return Number.isInteger(h) ? h + 'h' : Math.floor(h) + 'h 30m';
  }

  function rating(cycles) {
    if (cycles <= 3) return { label: 'Very Short', color: '#856404', bg: '#ffeeba' };
    if (cycles === 4) return { label: 'Below Optimal', color: '#664d03', bg: '#fff3cd' };
    if (cycles === 5) return { label: 'Good ✓', color: '#155724', bg: '#d1eddb' };
    return { label: 'Optimal ⭐', color: '#004085', bg: '#cce5ff' };
  }

  window.calcWakeUp = function () {
    var bedVal = document.getElementById('bedtime').value;
    var delay  = parseInt(document.getElementById('fallAsleep').value);
    if (!bedVal) return;

    var bedMin   = parseTime(bedVal);
    var sleepStart = bedMin + delay;

    document.getElementById('bedtimeLabel').textContent = formatTime(bedMin);

    var html = '';
    [3, 4, 5, 6].forEach(function (cycles) {
      var wakeMin = sleepStart + cycles * CYCLE_MIN;
      var r = rating(cycles);
      var isOpt = cycles >= 5;
      html += '<div class="col-6 col-md-3">'
        + '<div class="p-3 rounded-3 text-center h-100" style="background:' + r.bg + '; border:1px solid ' + r.color + '30;">'
        + (isOpt ? '<div style="font-size:.65rem; font-weight:700; color:' + r.color + '; text-transform:uppercase; letter-spacing:.5px; margin-bottom:4px;">⭐ Recommended</div>' : '')
        + '<div style="font-size:1.4rem; font-weight:800; color:' + r.color + ';">' + formatTime(wakeMin) + '</div>'
        + '<div style="font-size:.75rem; color:' + r.color + '; font-weight:600; margin:4px 0;">' + cycles + ' cycles · ' + hoursLabel(cycles) + '</div>'
        + '<div style="font-size:.72rem; color:#666; margin-top:6px;">' + r.label + '</div>'
        + '</div></div>';
    });

    document.getElementById('wakeCards').innerHTML = html;
    document.getElementById('results').classList.remove('d-none');
    document.getElementById('results').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  };
})();
</script>
@endsection
