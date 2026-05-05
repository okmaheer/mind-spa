@extends('layouts.app')

@section('title', 'Running Pace Calculator — Pace, Speed & Finish Time for 5K, 10K, Half Marathon | MindSnap')
@section('description', 'Free running pace calculator: convert between pace, speed, and finish time for any distance. Works for 5K, 10K, half marathon, and full marathon. No signup.')
@section('canonical', config('app.url') . '/running-pace-calculator')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "WebApplication",
  "name": "Running Pace Calculator",
  "url": "{{ config('app.url') }}/running-pace-calculator",
  "description": "Convert between pace, speed, and finish time for any running distance including 5K, 10K, half marathon, and marathon.",
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
    { "@@type": "ListItem", "position": 1, "name": "Home", "item": "{{ config('app.url') }}" },
    { "@@type": "ListItem", "position": 2, "name": "Fitness Tools", "item": "{{ config('app.url') }}/fitness-tools" },
    { "@@type": "ListItem", "position": 3, "name": "Running Pace Calculator" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [
    { "@@type": "Question", "name": "What is running pace?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Running pace is the time it takes to cover a set distance, most commonly expressed as minutes per kilometre (min/km) or minutes per mile (min/mi). It is the inverse of speed — a faster runner has a lower pace number. For example, running at 5:00 min/km means you cover one kilometre every five minutes, which equals a speed of 12 km/h. Pace is the preferred metric for runners because it directly relates to how long a race will take, making it easier to set realistic finish time goals and monitor workout intensity." } },
    { "@@type": "Question", "name": "What is a good 5K pace for a beginner?",
      "acceptedAnswer": { "@@type": "Answer", "text": "For a beginner runner, completing a 5K in any time is a great achievement. A typical beginner finishes a 5K in 35–45 minutes, which corresponds to a pace of 7:00–9:00 min/km (11:15–14:30 min/mile). After 3–6 months of consistent training, many beginner runners progress to 30 minutes or under (6:00 min/km). The average recreational runner finishes a 5K in around 30–35 minutes for men and 35–40 minutes for women. Race finishing time should not be compared across age groups without considering age-grading." } },
    { "@@type": "Question", "name": "How do I calculate my marathon finish time?",
      "acceptedAnswer": { "@@type": "Answer", "text": "To calculate your marathon finish time, multiply your target pace (in seconds per km) by 42.195 km, then convert the total seconds to hours, minutes, and seconds. For example, a 5:30 min/km pace: 330 seconds × 42.195 = 13,924 seconds = 3 hours, 52 minutes, and 4 seconds. Use this calculator's 'Calculate Time' mode to get this instantly. Most coaches recommend basing your marathon goal pace on your recent half marathon time multiplied by 2.1–2.15, to account for the additional fatigue of the second half." } },
    { "@@type": "Question", "name": "What's the difference between pace and speed?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Pace and speed are inverses of each other. Pace measures time per distance (e.g., 5:00 min/km) while speed measures distance per time (e.g., 12 km/h). Runners typically use pace because it directly answers the question 'how long will this race take?' Athletes in cycling, swimming, and most other sports use speed. To convert between them: speed (km/h) = 60 ÷ pace (min/km). At 5:00 min/km pace, speed = 60 ÷ 5 = 12 km/h. At 4:00 min/km, speed = 15 km/h." } },
    { "@@type": "Question", "name": "What pace should I run for a half marathon?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Your target half marathon pace depends on your fitness level and goal. For a sub-2-hour half marathon (a common beginner goal), you need to run at 5:41 min/km (9:09 min/mile) or faster. For a sub-1:45, the target pace is 4:58 min/km. For a sub-1:30, you need 4:16 min/km — which requires a high level of running fitness. A useful rule of thumb: your sustainable half marathon pace is roughly 15–30 seconds per km faster than your easy conversational pace, and about 20–30 seconds slower than your 10K race pace." } }
  ]
}
</script>
@endsection

@php
$faqs = [
  ['q' => 'What is running pace?',
   'a' => 'Running pace is the time it takes to cover a set distance, most commonly expressed as minutes per kilometre (min/km) or minutes per mile (min/mi). It is the inverse of speed — a faster runner has a lower pace number. For example, running at 5:00 min/km means you cover one kilometre every five minutes, which equals a speed of 12 km/h. Pace is the preferred metric for runners because it directly relates to how long a race will take, making it easier to set realistic finish time goals and monitor workout intensity.'],
  ['q' => 'What is a good 5K pace for a beginner?',
   'a' => 'For a beginner runner, completing a 5K in any time is a great achievement. A typical beginner finishes a 5K in 35–45 minutes, which corresponds to a pace of 7:00–9:00 min/km (11:15–14:30 min/mile). After 3–6 months of consistent training, many beginner runners progress to 30 minutes or under (6:00 min/km). The average recreational runner finishes a 5K in around 30–35 minutes for men and 35–40 minutes for women. Race finishing time should not be compared across age groups without considering age-grading.'],
  ['q' => 'How do I calculate my marathon finish time?',
   'a' => 'To calculate your marathon finish time, multiply your target pace (in seconds per km) by 42.195 km, then convert the total seconds to hours, minutes, and seconds. For example, a 5:30 min/km pace: 330 seconds × 42.195 = 13,924 seconds = 3 hours, 52 minutes, and 4 seconds. Use this calculator\'s \'Calculate Time\' mode to get this instantly. Most coaches recommend basing your marathon goal pace on your recent half marathon time multiplied by 2.1–2.15, to account for the additional fatigue of the second half.'],
  ['q' => 'What\'s the difference between pace and speed?',
   'a' => 'Pace and speed are inverses of each other. Pace measures time per distance (e.g., 5:00 min/km) while speed measures distance per time (e.g., 12 km/h). Runners typically use pace because it directly answers the question \'how long will this race take?\' Athletes in cycling, swimming, and most other sports use speed. To convert between them: speed (km/h) = 60 ÷ pace (min/km). At 5:00 min/km pace, speed = 60 ÷ 5 = 12 km/h. At 4:00 min/km, speed = 15 km/h.'],
  ['q' => 'What pace should I run for a half marathon?',
   'a' => 'Your target half marathon pace depends on your fitness level and goal. For a sub-2-hour half marathon (a common beginner goal), you need to run at 5:41 min/km (9:09 min/mile) or faster. For a sub-1:45, the target pace is 4:58 min/km. For a sub-1:30, you need 4:16 min/km — which requires a high level of running fitness. A useful rule of thumb: your sustainable half marathon pace is roughly 15–30 seconds per km faster than your easy conversational pace, and about 20–30 seconds slower than your 10K race pace.'],
];

$relatedTools = [
  ['icon' => '❤️', 'name' => 'Heart Rate Calculator', 'slug' => 'heart-rate-calculator', 'desc' => 'Find your max heart rate and training zones.'],
  ['icon' => '🔥', 'name' => 'Calorie Calculator', 'slug' => 'calorie-calculator', 'desc' => 'How many calories does running burn per session?'],
  ['icon' => '📊', 'name' => 'BMI Calculator', 'slug' => 'bmi-calculator', 'desc' => 'Calculate your body mass index and healthy weight range.'],
  ['icon' => '📏', 'name' => 'Body Fat Calculator', 'slug' => 'body-fat-calculator', 'desc' => 'Estimate your body fat percentage with a tape measure.'],
  ['icon' => '📊', 'name' => 'Workout Volume Calculator', 'slug' => 'workout-volume-calculator', 'desc' => 'Track weekly training load and muscle group volume.'],
  ['icon' => '⚖️', 'name' => 'Ideal Weight Calculator', 'slug' => 'ideal-weight-calculator', 'desc' => 'Find your healthy weight range for your height and frame.'],
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
          ['url' => route('category.fitness'), 'name' => 'Fitness Tools'],
          ['url' => '', 'name' => 'Running Pace Calculator'],
        ]"/>

        <h1 class="mb-2 ms-hero-title">
          🏃 Running Pace Calculator — Pace, Speed & Finish Time
        </h1>
        <p class="ms-hero-desc">
          Calculate your pace from a finish time, estimate your finish time from a pace, or find out how far you'll run in a set time.
        </p>

        {{-- ── Tool Card ────────────────────────────────────────────────────── --}}
        <div class="card border-0 mb-n4 ms-tool-card">
          <div class="card-body p-4 p-md-5">

            {{-- Mode tabs --}}
            <div class="d-flex gap-2 mb-4 flex-wrap" role="group" aria-label="Calculation mode">
              <button class="btn rp-mode-btn active" data-mode="pace"
                style="border-radius:8px; font-weight:600; font-size:.84rem; background:var(--fitness); color:#fff; border:none; padding:8px 14px;">
                Calculate Pace
              </button>
              <button class="btn rp-mode-btn" data-mode="time"
                style="border-radius:8px; font-weight:600; font-size:.84rem; background:#f8f9fa; color:#555; border:1px solid #e0e0e0; padding:8px 14px;">
                Calculate Time
              </button>
              <button class="btn rp-mode-btn" data-mode="distance"
                style="border-radius:8px; font-weight:600; font-size:.84rem; background:#f8f9fa; color:#555; border:1px solid #e0e0e0; padding:8px 14px;">
                Calculate Distance
              </button>
            </div>

            {{-- Unit toggle --}}
            <div class="d-flex gap-2 mb-4" role="group" aria-label="Distance unit">
              <button class="btn rp-unit-btn active" data-unit="km"
                style="border-radius:8px; font-weight:600; font-size:.82rem; background:var(--fitness); color:#fff; border:none; padding:6px 14px;">
                km
              </button>
              <button class="btn rp-unit-btn" data-unit="mi"
                style="border-radius:8px; font-weight:600; font-size:.82rem; background:#f8f9fa; color:#555; border:1px solid #e0e0e0; padding:6px 14px;">
                miles
              </button>
            </div>

            {{-- Distance selector --}}
            <div class="mb-3">
              <label class="form-label fw-semibold">Distance</label>
              <div class="d-flex gap-2 flex-wrap mb-2">
                <button class="btn btn-sm rp-dist-btn" data-km="5" style="border-radius:6px; border:1px solid #e0e0e0; background:#f8f9fa; font-size:.82rem;">5K</button>
                <button class="btn btn-sm rp-dist-btn" data-km="10" style="border-radius:6px; border:1px solid #e0e0e0; background:#f8f9fa; font-size:.82rem;">10K</button>
                <button class="btn btn-sm rp-dist-btn" data-km="21.0975" style="border-radius:6px; border:1px solid #e0e0e0; background:#f8f9fa; font-size:.82rem;">Half Marathon</button>
                <button class="btn btn-sm rp-dist-btn" data-km="42.195" style="border-radius:6px; border:1px solid #e0e0e0; background:#f8f9fa; font-size:.82rem;">Marathon</button>
              </div>
              <input type="number" id="rpDistance" class="form-control" placeholder="Or enter custom distance (km)" min="0.1" max="1000" step="0.01">
            </div>

            {{-- Pace mode inputs --}}
            <div id="rpPaceMode">
              <label class="form-label fw-semibold">Finish Time</label>
              <div class="row g-2 mb-3">
                <div class="col-4">
                  <input type="number" id="rpPaceH" class="form-control" placeholder="hrs" min="0" max="23" step="1">
                  <div style="font-size:.72rem; color:#aaa; text-align:center; margin-top:2px;">Hours</div>
                </div>
                <div class="col-4">
                  <input type="number" id="rpPaceM" class="form-control" placeholder="min" min="0" max="59" step="1">
                  <div style="font-size:.72rem; color:#aaa; text-align:center; margin-top:2px;">Minutes</div>
                </div>
                <div class="col-4">
                  <input type="number" id="rpPaceS" class="form-control" placeholder="sec" min="0" max="59" step="1">
                  <div style="font-size:.72rem; color:#aaa; text-align:center; margin-top:2px;">Seconds</div>
                </div>
              </div>
            </div>

            {{-- Time mode inputs --}}
            <div id="rpTimeMode" class="d-none">
              <label class="form-label fw-semibold">Pace <span id="rpPaceUnitLabel">(min:sec per km)</span></label>
              <div class="row g-2 mb-3">
                <div class="col-6">
                  <input type="number" id="rpTimePaceM" class="form-control" placeholder="min" min="0" max="30" step="1">
                  <div style="font-size:.72rem; color:#aaa; text-align:center; margin-top:2px;">Minutes</div>
                </div>
                <div class="col-6">
                  <input type="number" id="rpTimePaceS" class="form-control" placeholder="sec" min="0" max="59" step="1">
                  <div style="font-size:.72rem; color:#aaa; text-align:center; margin-top:2px;">Seconds</div>
                </div>
              </div>
            </div>

            {{-- Distance mode inputs --}}
            <div id="rpDistMode" class="d-none">
              <label class="form-label fw-semibold">Time Available</label>
              <div class="row g-2 mb-2">
                <div class="col-4">
                  <input type="number" id="rpDistH" class="form-control" placeholder="hrs" min="0" max="23" step="1">
                  <div style="font-size:.72rem; color:#aaa; text-align:center; margin-top:2px;">Hours</div>
                </div>
                <div class="col-4">
                  <input type="number" id="rpDistM" class="form-control" placeholder="min" min="0" max="59" step="1">
                  <div style="font-size:.72rem; color:#aaa; text-align:center; margin-top:2px;">Minutes</div>
                </div>
                <div class="col-4">
                  <input type="number" id="rpDistS" class="form-control" placeholder="sec" min="0" max="59" step="1">
                  <div style="font-size:.72rem; color:#aaa; text-align:center; margin-top:2px;">Seconds</div>
                </div>
              </div>
              <label class="form-label fw-semibold mt-2">Pace <span id="rpPaceUnitLabel2">(min:sec per km)</span></label>
              <div class="row g-2 mb-3">
                <div class="col-6">
                  <input type="number" id="rpDistPaceM" class="form-control" placeholder="min" min="0" max="30" step="1">
                  <div style="font-size:.72rem; color:#aaa; text-align:center; margin-top:2px;">Minutes</div>
                </div>
                <div class="col-6">
                  <input type="number" id="rpDistPaceS" class="form-control" placeholder="sec" min="0" max="59" step="1">
                  <div style="font-size:.72rem; color:#aaa; text-align:center; margin-top:2px;">Seconds</div>
                </div>
              </div>
            </div>

            <button class="btn btn-cta w-100" onclick="calculatePace()" style="font-size:1rem;">
              Calculate →
            </button>

            {{-- Results --}}
            <div id="rpResults" class="mt-4 d-none">
              <div style="height:1px; background:#f0f0f0; margin-bottom:20px;"></div>

              <div class="row g-3 text-center mb-4" id="rpPrimaryResults"></div>

              <div id="rpRaceTable" class="d-none">
                <p class="fw-semibold mb-2" style="font-size:.85rem; color:var(--primary-dark);">Race Finish Times at This Pace</p>
                <div class="table-responsive">
                  <table class="table table-sm table-bordered mb-0" style="font-size:.82rem;">
                    <thead class="ms-table-head">
                      <tr><th>Distance</th><th>Finish Time</th><th>Speed</th></tr>
                    </thead>
                    <tbody id="rpRaceTableBody"></tbody>
                  </table>
                </div>
              </div>
            </div>
            {{-- /Results --}}

          </div>
        </div>
        {{-- /Tool Card --}}
      </div>

      {{-- Right: Quick facts --}}
      <div class="col-lg-5 d-none d-lg-block" style="padding-top:10px;">
        <div class="ms-facts-wrap">
          <h3 class="ms-facts-title">Quick Running Facts</h3>
          @foreach([
            ['4:30 min/km', 'Average amateur 5K pace'],
            ['42.195 km', 'Official marathon distance'],
            ['9:58/km', 'World record marathon pace (Kipchoge)'],
            ['65–75%', 'Recommended easy run heart rate (% max)'],
            ['80%', 'Long runs should be at easy pace'],
          ] as [$stat, $label])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div style="background:var(--fitness); color:#fff; border-radius:8px; padding:6px 10px; font-weight:700; font-size:.8rem; min-width:80px; text-align:center; flex-shrink:0;">{{ $stat }}</div>
            <div class="ms-fact-label">{{ $label }}</div>
          </div>
          @endforeach
          <p class="ms-fact-source">Sources: World Athletics, IAAF, running research literature</p>
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
        <span class="ms-badge ms-badge-fitness mb-3">How It Works</span>
        <h2 class="mb-4">Running Pace vs Speed: What's the Difference?</h2>
        <p>Running pace and speed express the same thing from opposite directions. Pace is time per unit distance (minutes per km or mile). Speed is distance per unit time (km/h or mph). Runners use pace because it directly answers "how long will this take?" — crucial when planning races and training sessions.</p>
        <p>The core calculation is simple: if you run 10 km in 50 minutes, your pace is 50 ÷ 10 = 5:00 min/km. Your speed is 10 ÷ (50/60) = 12 km/h. To convert between the two: speed (km/h) = 60 ÷ pace (min/km).</p>
        <p>This calculator handles three calculation types: given distance and time, it computes pace; given distance and pace, it computes finish time; given time and pace, it computes distance covered. All three are essential for race planning and workout tracking.</p>
      </div>
      <div class="col-lg-7">
        <div class="p-4 rounded-3 ms-data-box">
          <p class="fw-semibold mb-3" style="color:var(--primary-dark); font-size:.88rem; text-transform:uppercase; letter-spacing:.5px;">Common Race Paces</p>
          @foreach([
            ['Sub-20 min 5K', '3:59 min/km', '15.0 km/h', 'Elite amateur / competitive club runner'],
            ['Sub-25 min 5K', '4:59 min/km', '12.0 km/h', 'Strong recreational runner'],
            ['Sub-30 min 5K', '5:59 min/km', '10.0 km/h', 'Average recreational runner'],
            ['Sub-2 hr Half', '5:41 min/km', '10.6 km/h', 'Popular beginner half marathon goal'],
            ['Sub-4 hr Marathon', '5:41 min/km', '10.6 km/h', 'Popular recreational marathon goal'],
          ] as [$label, $pace, $speed, $note])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div style="background:var(--fitness); color:#fff; border-radius:6px; padding:4px 10px; font-size:.75rem; font-weight:700; min-width:70px; text-align:center; flex-shrink:0; margin-top:2px;">{{ $pace }}</div>
            <div>
              <div class="fw-semibold" style="font-size:.86rem; color:#1a1a2e;">{{ $label }} <span style="font-weight:400; color:#888;">({{ $speed }})</span></div>
              <div style="font-size:.8rem; color:#666; line-height:1.5;">{{ $note }}</div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ── 3. Training Paces Reference ──────────────────────────────────────────── --}}
<section class="ms-section-muted">
  <div class="container-xl">
    <div class="text-center mb-5">
      <h2>Training Paces: Easy, Tempo, Threshold, and Interval</h2>
      <p class="text-muted" style="max-width:520px; margin:auto;">Based on a 5K time of 25 minutes. Adjust proportionally for your pace.</p>
    </div>
    <div class="row g-3 justify-content-center">
      @foreach([
        ['Easy Run', '6:30–7:30 min/km', '#4a9fd4', '60–70% max HR', 'Conversational pace. Should feel effortless. 80% of training.'],
        ['Tempo Run', '5:10–5:30 min/km', '#28a745', '80–90% max HR', 'Comfortably hard. Can speak in short phrases only. 20-40 min sustained.'],
        ['Threshold', '5:00–5:20 min/km', '#ffc107', '85–92% max HR', 'Lactate threshold pace. Improves your race pace ceiling.'],
        ['Interval', '4:20–4:40 min/km', '#dc3545', '95–100% max HR', '400m–1600m repeats with recovery. Develops speed and VO2 max.'],
      ] as [$type, $pace, $color, $hrZone, $desc])
      <div class="col-md-6 col-lg-3">
        <div class="card border-0 h-100 p-4" style="border-radius:12px; box-shadow:0 2px 12px rgba(0,0,0,.06);">
          <div style="background:{{ $color }}; color:#fff; border-radius:8px; padding:6px 12px; font-size:.82rem; font-weight:700; display:inline-block; margin-bottom:12px;">{{ $type }}</div>
          <div class="fw-semibold mb-1" style="color:var(--primary-dark); font-size:1rem;">{{ $pace }}</div>
          <div style="font-size:.78rem; color:#888; margin-bottom:8px;">{{ $hrZone }}</div>
          <div style="font-size:.82rem; color:#666; line-height:1.6;">{{ $desc }}</div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="rpFaqAccordion" />


{{-- ── 5. Long-tail keyword sections ─────────────────────────────────────────── --}}
<section class="ms-section-accent">
  <div class="container ms-longtail">
    <h2 class="mb-4" style="color:var(--primary-dark);">Running Pace Calculator for 5K — What Pace Do I Need?</h2>
    <p>The 5K is the most popular race distance in recreational running and a natural benchmark for progress. To run a sub-30-minute 5K, you need to average 5:59 min/km or faster. For sub-25, your average pace needs to be 4:59 min/km. For sub-20 — a significant milestone that puts you in the top 5–10% of recreational runners — you need to sustain 3:59 min/km for the entire distance.</p>
    <p>A useful rule for 5K race day: the first kilometre should feel slightly too easy. Your goal pace should feel comfortable but focused around kilometres 2–3, and you should be pushing your limit in the final kilometre. If you're already at maximum effort in kilometre 1, you've gone out too fast. Use the 'Calculate Time' mode in this calculator to find out what finish time corresponds to your target pace before race day.</p>

    <h2 class="mt-5 mb-4" style="color:var(--primary-dark);">Marathon Pace Calculator — How to Set a Realistic Finish Time Goal</h2>
    <p>Setting a realistic marathon goal is one of the most important decisions a marathon runner makes. The most reliable predictor of marathon performance is your recent half marathon time. Multiply your half marathon time by 2.1 for a conservative estimate, or 2.05 if you have strong long-run training history. A runner who has run 1:45 for the half marathon can target approximately 3:39–3:41 for the full marathon.</p>
    <p>The 'wall' — a dramatic slowdown typically occurring around kilometre 30–35 — is caused by glycogen depletion. Runners who start at their true capability pace almost always hit the wall; those who start 5–10 seconds per km conservative and build through the second half typically do not. This calculator lets you plan kilometer splits in advance so you can race with precision rather than guesswork.</p>

    <h2 class="mt-5 mb-4" style="color:var(--primary-dark);">Easy Run Pace vs Tempo Pace — What's the Right Training Pace?</h2>
    <p>One of the most common training mistakes is running easy days too fast and therefore not recovering adequately for hard days. Your easy pace should feel genuinely easy — you can hold a full conversation, your breathing is relaxed, and you feel like you could continue for hours. For many runners, this means slowing down by 90 seconds to 2 minutes per km compared to their race pace.</p>
    <p>Tempo pace, by contrast, should feel 'comfortably hard' — you can speak a sentence but not a paragraph. It sits at the lactate threshold, which is the training intensity that most directly improves race performance. Typical tempo sessions are 20–40 minutes sustained or broken into shorter tempo intervals with brief recovery. Enter your target race pace into this calculator and use the speed output to calibrate your training zones accordingly.</p>
  </div>
</section>

<x-related-tools :tools="$relatedTools" heading="More Fitness Calculators" />


{{-- ── 7. SEO Block ──────────────────────────────────────────────────────────── --}}
<section class="ms-section-seo">
  <div class="container-xl">
    <div class="row justify-content-center">
      <div class="col-lg-8 ms-seo-body">
        <h2 class="mb-4 ms-seo-h2">Running Pace Calculator: The Mathematics of Racing</h2>
        <p>The relationship between pace, distance, and time is the fundamental equation of endurance running. Every training decision — how fast to run, how far to go, whether a workout was appropriately challenging — ultimately comes back to this triangle. Understanding it deeply is what separates runners who progress systematically from those who plateau.</p>
        <h3 class="ms-seo-h3">Why GPS Devices Still Need Pace Calculators</h3>
        <p>GPS running watches are accurate under open sky but exhibit significant drift in tunnels, dense urban canyons, and forests. Over a marathon, GPS drift can add or subtract 200–400 metres, making the displayed pace unreliable in these environments. Knowing how to calculate your own pace from manual splits — using a stopwatch and known distance markers — remains a valuable skill for race day. This calculator can reverse-engineer any split: enter the distance of a lap and your split time to find your exact pace for that segment.</p>
        <div class="mt-4 p-4 rounded-3 ms-note ms-note-green">
          <p style="margin:0; font-size:.85rem; color:#155724;"><strong>Note:</strong> Running calculators assume even effort across the distance. Real-world performance is affected by terrain, temperature, hills, fatigue accumulation, and fuelling. Use calculator results as targets and starting points, adjusting in real time during training and racing.</p>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')
<script>
(function () {

  var currentMode = 'pace';
  var currentUnit = 'km';
  var KM_PER_MI   = 1.60934;

  // Mode toggle
  document.querySelectorAll('.rp-mode-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
      document.querySelectorAll('.rp-mode-btn').forEach(function (b) {
        b.classList.remove('active');
        b.style.background = '#f8f9fa';
        b.style.color = '#555';
        b.style.border = '1px solid #e0e0e0';
      });
      this.classList.add('active');
      this.style.background = 'var(--fitness)';
      this.style.color = '#fff';
      this.style.border = 'none';
      currentMode = this.dataset.mode;
      document.getElementById('rpPaceMode').classList.toggle('d-none', currentMode !== 'pace');
      document.getElementById('rpTimeMode').classList.toggle('d-none', currentMode !== 'time');
      document.getElementById('rpDistMode').classList.toggle('d-none', currentMode !== 'distance');
      document.getElementById('rpResults').classList.add('d-none');
    });
  });

  // Unit toggle
  document.querySelectorAll('.rp-unit-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
      document.querySelectorAll('.rp-unit-btn').forEach(function (b) {
        b.classList.remove('active');
        b.style.background = '#f8f9fa';
        b.style.color = '#555';
        b.style.border = '1px solid #e0e0e0';
      });
      this.classList.add('active');
      this.style.background = 'var(--fitness)';
      this.style.color = '#fff';
      this.style.border = 'none';
      currentUnit = this.dataset.unit;
      var lbl = 'min:sec per ' + currentUnit;
      document.getElementById('rpPaceUnitLabel').textContent = '(' + lbl + ')';
      document.getElementById('rpPaceUnitLabel2').textContent = '(' + lbl + ')';
      var ph = currentUnit === 'km' ? 'Or enter custom distance (km)' : 'Or enter custom distance (miles)';
      document.getElementById('rpDistance').placeholder = ph;
      document.getElementById('rpResults').classList.add('d-none');
    });
  });

  // Distance preset buttons
  document.querySelectorAll('.rp-dist-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
      document.querySelectorAll('.rp-dist-btn').forEach(function (b) {
        b.style.background = '#f8f9fa';
        b.style.borderColor = '#e0e0e0';
        b.style.color = '#555';
      });
      this.style.background = 'var(--fitness)';
      this.style.borderColor = 'var(--fitness)';
      this.style.color = '#fff';
      var km = parseFloat(this.dataset.km);
      var dist = currentUnit === 'km' ? km : (km / KM_PER_MI);
      document.getElementById('rpDistance').value = parseFloat(dist.toFixed(3));
    });
  });

  function fmtTime(totalSec) {
    totalSec = Math.round(totalSec);
    var h = Math.floor(totalSec / 3600);
    var m = Math.floor((totalSec % 3600) / 60);
    var s = totalSec % 60;
    if (h > 0) return h + ':' + pad(m) + ':' + pad(s);
    return m + ':' + pad(s);
  }

  function pad(n) { return n < 10 ? '0' + n : n; }

  function fmtPace(secPerUnit) {
    var m = Math.floor(secPerUnit / 60);
    var s = Math.round(secPerUnit % 60);
    if (s === 60) { m++; s = 0; }
    return m + ':' + pad(s);
  }

  window.calculatePace = function () {
    var dist = parseFloat(document.getElementById('rpDistance').value);

    if (currentMode === 'pace') {
      var h = parseInt(document.getElementById('rpPaceH').value) || 0;
      var m = parseInt(document.getElementById('rpPaceM').value) || 0;
      var s = parseInt(document.getElementById('rpPaceS').value) || 0;
      var totalSec = h * 3600 + m * 60 + s;
      if (!dist || !totalSec) { alert('Please enter a distance and finish time.'); return; }
      var distKm  = currentUnit === 'km' ? dist : dist * KM_PER_MI;
      var secPerKm = totalSec / distKm;
      var secPerMi = secPerKm * KM_PER_MI;
      var speedKmh = 3600 / secPerKm;
      var speedMph = speedKmh * 0.621371;
      showPaceResults(secPerKm, secPerMi, speedKmh, speedMph);

    } else if (currentMode === 'time') {
      var pm = parseInt(document.getElementById('rpTimePaceM').value) || 0;
      var ps = parseInt(document.getElementById('rpTimePaceS').value) || 0;
      var secPerUnit = pm * 60 + ps;
      if (!dist || !secPerUnit) { alert('Please enter a distance and pace.'); return; }
      var secPerKm = currentUnit === 'km' ? secPerUnit : secPerUnit / KM_PER_MI;
      var distKm  = currentUnit === 'km' ? dist : dist * KM_PER_MI;
      var totalSec = secPerKm * distKm;
      var speedKmh = 3600 / secPerKm;
      var speedMph = speedKmh * 0.621371;
      showTimeResults(totalSec, secPerKm, speedKmh, speedMph);

    } else {
      var h = parseInt(document.getElementById('rpDistH').value) || 0;
      var m = parseInt(document.getElementById('rpDistM').value) || 0;
      var s = parseInt(document.getElementById('rpDistS').value) || 0;
      var pm = parseInt(document.getElementById('rpDistPaceM').value) || 0;
      var ps = parseInt(document.getElementById('rpDistPaceS').value) || 0;
      var totalSec = h * 3600 + m * 60 + s;
      var secPerUnit = pm * 60 + ps;
      if (!totalSec || !secPerUnit) { alert('Please enter a time and pace.'); return; }
      var secPerKm = currentUnit === 'km' ? secPerUnit : secPerUnit / KM_PER_MI;
      var distKm  = totalSec / secPerKm;
      var distOut = currentUnit === 'km' ? distKm : distKm / KM_PER_MI;
      showDistResults(distKm, distOut);
    }
  };

  function showPaceResults(secPerKm, secPerMi, speedKmh, speedMph) {
    var html = '<div class="col-6 col-md-3"><div style="background:#f0fff4; border-radius:10px; padding:14px 8px; text-align:center;">'
      + '<div style="font-size:1.4rem; font-weight:800; color:var(--fitness);">' + fmtPace(secPerKm) + '</div>'
      + '<div style="font-size:.72rem; color:#888; margin-top:4px;">min per km</div></div></div>'
      + '<div class="col-6 col-md-3"><div style="background:#f0f4ff; border-radius:10px; padding:14px 8px; text-align:center;">'
      + '<div style="font-size:1.4rem; font-weight:800; color:var(--primary-mid);">' + fmtPace(secPerMi) + '</div>'
      + '<div style="font-size:.72rem; color:#888; margin-top:4px;">min per mile</div></div></div>'
      + '<div class="col-6 col-md-3"><div style="background:#fff8ec; border-radius:10px; padding:14px 8px; text-align:center;">'
      + '<div style="font-size:1.4rem; font-weight:800; color:#e97b1e;">' + speedKmh.toFixed(1) + '</div>'
      + '<div style="font-size:.72rem; color:#888; margin-top:4px;">km/h</div></div></div>'
      + '<div class="col-6 col-md-3"><div style="background:#fff0f3; border-radius:10px; padding:14px 8px; text-align:center;">'
      + '<div style="font-size:1.4rem; font-weight:800; color:var(--cta-text);">' + speedMph.toFixed(1) + '</div>'
      + '<div style="font-size:.72rem; color:#888; margin-top:4px;">mph</div></div></div>';
    document.getElementById('rpPrimaryResults').innerHTML = html;
    buildRaceTable(secPerKm);
    document.getElementById('rpResults').classList.remove('d-none');
    document.getElementById('rpResults').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  }

  function showTimeResults(totalSec, secPerKm, speedKmh, speedMph) {
    var html = '<div class="col-6 col-md-3"><div style="background:#f0fff4; border-radius:10px; padding:14px 8px; text-align:center;">'
      + '<div style="font-size:1.4rem; font-weight:800; color:var(--fitness);">' + fmtTime(totalSec) + '</div>'
      + '<div style="font-size:.72rem; color:#888; margin-top:4px;">finish time</div></div></div>'
      + '<div class="col-6 col-md-3"><div style="background:#f0f4ff; border-radius:10px; padding:14px 8px; text-align:center;">'
      + '<div style="font-size:1.4rem; font-weight:800; color:var(--primary-mid);">' + fmtPace(secPerKm) + '</div>'
      + '<div style="font-size:.72rem; color:#888; margin-top:4px;">min/km</div></div></div>'
      + '<div class="col-6 col-md-3"><div style="background:#fff8ec; border-radius:10px; padding:14px 8px; text-align:center;">'
      + '<div style="font-size:1.4rem; font-weight:800; color:#e97b1e;">' + speedKmh.toFixed(1) + '</div>'
      + '<div style="font-size:.72rem; color:#888; margin-top:4px;">km/h</div></div></div>'
      + '<div class="col-6 col-md-3"><div style="background:#fff0f3; border-radius:10px; padding:14px 8px; text-align:center;">'
      + '<div style="font-size:1.4rem; font-weight:800; color:var(--cta-text);">' + speedMph.toFixed(1) + '</div>'
      + '<div style="font-size:.72rem; color:#888; margin-top:4px;">mph</div></div></div>';
    document.getElementById('rpPrimaryResults').innerHTML = html;
    buildRaceTable(secPerKm);
    document.getElementById('rpResults').classList.remove('d-none');
    document.getElementById('rpResults').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  }

  function showDistResults(distKm, distDisplay) {
    var unit = currentUnit;
    var html = '<div class="col-12 col-md-6 mx-auto"><div style="background:#f0fff4; border-radius:10px; padding:20px; text-align:center;">'
      + '<div style="font-size:2rem; font-weight:800; color:var(--fitness);">' + distDisplay.toFixed(2) + ' ' + unit + '</div>'
      + '<div style="font-size:.82rem; color:#888; margin-top:4px;">distance covered</div></div></div>';
    document.getElementById('rpPrimaryResults').innerHTML = html;
    document.getElementById('rpRaceTable').classList.add('d-none');
    document.getElementById('rpResults').classList.remove('d-none');
    document.getElementById('rpResults').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  }

  function buildRaceTable(secPerKm) {
    var races = [
      ['1K', 1], ['5K', 5], ['10K', 10], ['15K', 15],
      ['Half Marathon', 21.0975], ['30K', 30], ['Marathon', 42.195]
    ];
    var rows = '';
    var speedKmh = 3600 / secPerKm;
    races.forEach(function (r) {
      var totalSec = secPerKm * r[1];
      var distDisplay = currentUnit === 'km' ? r[1] + ' km' : (r[1] / KM_PER_MI).toFixed(2) + ' mi';
      rows += '<tr><td>' + r[0] + '</td><td><strong>' + fmtTime(totalSec) + '</strong></td><td>' + speedKmh.toFixed(1) + ' km/h</td></tr>';
    });
    document.getElementById('rpRaceTableBody').innerHTML = rows;
    document.getElementById('rpRaceTable').classList.remove('d-none');
  }

})();
</script>
@endsection
