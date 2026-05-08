@extends('layouts.app')

@section('title', 'Heart Rate Calculator — Max HR & Training Zones | MindSnap')
@section('description', 'Free heart rate zone calculator: find your maximum heart rate and target heart rate zones for fat burning, cardio, and HIIT. Based on age and resting heart rate. No signup.')
@section('canonical', config('app.url') . '/heart-rate-calculator')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "WebApplication",
  "name": "Heart Rate Calculator",
  "url": "{{ config('app.url') }}/heart-rate-calculator",
  "description": "Calculate your maximum heart rate and target heart rate zones for fat burning, cardio, and HIIT training.",
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
    { "@@type": "ListItem", "position": 3, "name": "Heart Rate Calculator" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [
    { "@@type": "Question", "name": "What is maximum heart rate?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Maximum heart rate (MHR) is the highest number of beats per minute your heart can achieve during all-out exercise. It is primarily determined by age — the heart's intrinsic electrical system slows as you get older — and is largely unaffected by fitness level. The classic formula is 220 minus your age, which gives a good population average but has a standard deviation of about 10–12 bpm. More accurate formulas like Tanaka (208 − 0.7 × age) reduce this error somewhat. Your true MHR can only be measured precisely through a maximal exercise test, such as a VO2 max test on a treadmill or cycle ergometer." } },
    { "@@type": "Question", "name": "What heart rate zone burns the most fat?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Zone 2 (60–70% of max HR), often called the 'fat burning zone,' burns the highest proportion of calories from fat — around 60–70% fat vs 30–40% carbohydrates. However, this does not mean it burns the most total fat in a given period. Higher-intensity zones burn more total calories per minute, burning more fat in absolute terms even though the proportion from fat is lower. The 'fat burning zone' is most useful for long, easy cardio sessions and building aerobic base. For maximum fat loss over time, total calorie expenditure and diet remain the dominant factors." } },
    { "@@type": "Question", "name": "How do I calculate my target heart rate for cardio?",
      "acceptedAnswer": { "@@type": "Answer", "text": "To calculate your target heart rate for cardio training, first estimate your maximum heart rate (220 − age for a quick estimate). Then multiply by the intensity percentage for your desired zone. For general cardiovascular fitness, train at 70–80% of your max HR. For example, if you are 35 years old, your estimated max HR is 185 bpm, and your cardio training zone is 130–148 bpm. If you know your resting heart rate, the Karvonen formula (target = ((maxHR − restingHR) × intensity%) + restingHR) gives a more personalised result." } },
    { "@@type": "Question", "name": "What is the Karvonen formula?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The Karvonen formula, developed by Finnish physician Martti Karvonen, calculates target heart rate using your heart rate reserve — the difference between your maximum and resting heart rates. The formula is: Target HR = ((Max HR − Resting HR) × Intensity%) + Resting HR. Because it incorporates your actual resting heart rate, the Karvonen formula is more personalised than simple percentage-of-max formulas. A highly fit person with a low resting heart rate will get different zone targets than a sedentary person of the same age and max HR." } },
    { "@@type": "Question", "name": "Is it dangerous to exercise at 90% of max heart rate?",
      "acceptedAnswer": { "@@type": "Answer", "text": "For most healthy adults, exercising at 90–95% of maximum heart rate is safe during brief, high-intensity intervals. This is the basis of HIIT (high-intensity interval training), which is well-supported by research. However, exercising at near-maximal heart rate continuously for extended periods is not recommended. People with cardiovascular disease, hypertension, or other heart conditions should obtain medical clearance before engaging in high-intensity exercise. The American Heart Association recommends that adults new to exercise start in lower zones (50–70% max HR) and gradually progress over several weeks." } }
  ]
}
</script>
@endsection

@php
$faqs = [
  ['q' => 'What is maximum heart rate?',
   'a' => 'Maximum heart rate (MHR) is the highest number of beats per minute your heart can achieve during all-out exercise. It is primarily determined by age — the heart\'s intrinsic electrical system slows as you get older — and is largely unaffected by fitness level. The classic formula is 220 minus your age, which gives a good population average but has a standard deviation of about 10–12 bpm. More accurate formulas like Tanaka (208 − 0.7 × age) reduce this error somewhat. Your true MHR can only be measured precisely through a maximal exercise test, such as a VO2 max test on a treadmill or cycle ergometer.'],
  ['q' => 'What heart rate zone burns the most fat?',
   'a' => 'Zone 2 (60–70% of max HR), often called the \'fat burning zone,\' burns the highest proportion of calories from fat — around 60–70% fat vs 30–40% carbohydrates. However, this does not mean it burns the most total fat in a given period. Higher-intensity zones burn more total calories per minute, burning more fat in absolute terms even though the proportion from fat is lower. The \'fat burning zone\' is most useful for long, easy cardio sessions and building aerobic base. For maximum fat loss over time, total calorie expenditure and diet remain the dominant factors.'],
  ['q' => 'How do I calculate my target heart rate for cardio?',
   'a' => 'To calculate your target heart rate for cardio training, first estimate your maximum heart rate (220 − age for a quick estimate). Then multiply by the intensity percentage for your desired zone. For general cardiovascular fitness, train at 70–80% of your max HR. For example, if you are 35 years old, your estimated max HR is 185 bpm, and your cardio training zone is 130–148 bpm. If you know your resting heart rate, the Karvonen formula (target = ((maxHR − restingHR) × intensity%) + restingHR) gives a more personalised result.'],
  ['q' => 'What is the Karvonen formula?',
   'a' => 'The Karvonen formula, developed by Finnish physician Martti Karvonen, calculates target heart rate using your heart rate reserve — the difference between your maximum and resting heart rates. The formula is: Target HR = ((Max HR − Resting HR) × Intensity%) + Resting HR. Because it incorporates your actual resting heart rate, the Karvonen formula is more personalised than simple percentage-of-max formulas. A highly fit person with a low resting heart rate will get different zone targets than a sedentary person of the same age and max HR.'],
  ['q' => 'Is it dangerous to exercise at 90% of max heart rate?',
   'a' => 'For most healthy adults, exercising at 90–95% of maximum heart rate is safe during brief, high-intensity intervals. This is the basis of HIIT (high-intensity interval training), which is well-supported by research. However, exercising at near-maximal heart rate continuously for extended periods is not recommended. People with cardiovascular disease, hypertension, or other heart conditions should obtain medical clearance before engaging in high-intensity exercise. The American Heart Association recommends that adults new to exercise start in lower zones (50–70% max HR) and gradually progress over several weeks.'],
];

$relatedTools = [
  ['icon' => '🔥', 'name' => 'Calorie Calculator', 'slug' => 'calorie-calculator', 'desc' => 'Find your daily calorie needs based on activity and goals.'],
  ['icon' => '📊', 'name' => 'BMI Calculator', 'slug' => 'bmi-calculator', 'desc' => 'Calculate your body mass index and healthy weight range.'],
  ['icon' => '🏃', 'name' => 'Running Pace Calculator', 'slug' => 'running-pace-calculator', 'desc' => 'Convert between pace, speed, and finish time for any distance.'],
  ['icon' => '📏', 'name' => 'Body Fat Calculator', 'slug' => 'body-fat-calculator', 'desc' => 'Estimate your body fat percentage using Navy method measurements.'],
  ['icon' => '📊', 'name' => 'Workout Volume Calculator', 'slug' => 'workout-volume-calculator', 'desc' => 'Calculate weekly sets, reps, and load per muscle group.'],
  ['icon' => '🏋️', 'name' => 'One Rep Max Calculator', 'slug' => 'one-rep-max-calculator', 'desc' => 'Estimate your 1RM for any lift using proven formulas.'],
];
@endphp

@section('styles')
<style>
.hr-karvonen-note   { font-size:.78rem; color:var(--cta-text); }
.hr-max-label       { font-size:.8rem; color:#888; text-transform:uppercase; letter-spacing:.5px; font-weight:600; margin-bottom:4px; }
.hr-max-val         { font-size:3rem; font-weight:800; color:var(--fitness); line-height:1; }
.hr-max-sub         { font-size:.9rem; color:#888; margin-top:4px; }
.hr-table           { font-size:.82rem; }
.hr-zone-badge      { color:#fff; border-radius:6px; padding:4px 8px; font-size:.72rem; font-weight:700; min-width:54px; text-align:center; flex-shrink:0; margin-top:2px; }
.hr-zone-1          { background:#4a9fd4; }
.hr-zone-2          { background:#28a745; }
.hr-zone-3          { background:#ffc107; }
.hr-zone-4          { background:#fd7e14; }
.hr-zone-5          { background:#dc3545; }
.hr-table-wrap      { max-width:600px; margin:auto; }
.hr-rhr-table       { font-size:.87rem; }
.hr-source-note     { font-size:.78rem; }
.hr-zone-bar-row    { display:flex; border-radius:8px; overflow:hidden; height:20px; margin-bottom:6px; }
.hr-zone-segment    { flex:1; opacity:.8; }
.hr-zone-labels     { display:flex; font-size:.68rem; color:#888; }
.hr-zone-label-item { flex:1; text-align:center; }
.hr-goal-btn  { border:2px solid #dee2e6; color:#555; background:#fff; border-radius:20px; font-size:.82rem; padding:4px 14px; cursor:pointer; transition:all .15s; }
.hr-goal-fat.hr-goal-active       { border-color:#28a745; color:#28a745; background:#f0fff4; font-weight:600; }
.hr-goal-cardio.hr-goal-active    { border-color:#ffc107; color:#856404; background:#fffbf0; font-weight:600; }
.hr-goal-threshold.hr-goal-active { border-color:#fd7e14; color:#c25900; background:#fff5f0; font-weight:600; }
.hr-goal-hiit.hr-goal-active      { border-color:#dc3545; color:#b02a37; background:#fff0f0; font-weight:600; }
.hr-zone-row-highlighted td { background:#fffde7; font-weight:600; }
.hr-adv-toggle { font-size:.85rem; color:var(--fitness); text-decoration:none; }
.hr-adv-toggle:hover { text-decoration:underline; }
.hr-adv-toggle::after { content:' ▾'; }
.hr-adv-toggle[aria-expanded="true"]::after { content:' ▲'; }
.hr-vo2-value  { font-size:2rem; font-weight:700; color:var(--primary-dark); line-height:1; }
.hr-last-result { font-size:.82rem; color:#888; background:#f8f9fa; border-radius:8px; padding:8px 12px; }
</style>
@endsection

@section('content')

{{-- ── 1. Hero / Tool ───────────────────────────────────────────────────────── --}}
<section class="ms-hero">
  <div class="container-xl">
    <div class="row align-items-start g-5">

      <div class="col-lg-7">
        <x-breadcrumb :crumbs="[
          ['url' => route('home'), 'name' => 'Home'],
          ['url' => route('category.fitness'), 'name' => 'Fitness Tools'],
          ['url' => '', 'name' => 'Heart Rate Calculator'],
        ]"/>

        <h1 class="mb-2 ms-hero-title">
          ❤️ Heart Rate Calculator — Training Zones for Fat Burn & Cardio
        </h1>
        <p class="ms-hero-desc">
          Enter your age and optional resting heart rate to find your max HR and all five training zones.
        </p>

        {{-- ── Tool Card ────────────────────────────────────────────────────── --}}
        <div class="card border-0 mb-n4 ms-tool-card">
          <div class="card-body p-4 p-md-5">

            <div class="row g-3 mb-3">
              <div class="col-sm-6">
                <label for="hrAge" class="form-label fw-semibold">Age (years)</label>
                <input type="number" id="hrAge" class="form-control" placeholder="e.g. 35" min="10" max="100" step="1">
              </div>
              <div class="col-sm-6">
                <label for="hrResting" class="form-label fw-semibold">Resting HR (bpm) <small class="text-muted fw-normal">optional</small></label>
                <input type="number" id="hrResting" class="form-control" placeholder="e.g. 65" min="30" max="120" step="1">
              </div>
            </div>

            <div class="mb-4">
              <label for="hrFormula" class="form-label fw-semibold">Max HR Formula</label>
              <select id="hrFormula" class="form-select">
                <option value="simple">Simple (220 − age)</option>
                <option value="tanaka">Tanaka (208 − 0.7 × age)</option>
                <option value="karvonen">Karvonen (requires resting HR)</option>
              </select>
              <div id="hrKarvonenNote" class="mt-1 d-none hr-karvonen-note">Karvonen formula uses your resting HR for more personalised zone calculations.</div>
            </div>

            <div class="mb-4">
              <label class="form-label fw-semibold">Training goal <small class="text-muted fw-normal">optional — highlights your zone</small></label>
              <div class="d-flex gap-2 flex-wrap">
                <button type="button" class="hr-goal-btn hr-goal-fat"       data-goal="fat">🔥 Fat Burn</button>
                <button type="button" class="hr-goal-btn hr-goal-cardio"    data-goal="cardio">💨 Cardio</button>
                <button type="button" class="hr-goal-btn hr-goal-threshold" data-goal="threshold">⚡ Threshold</button>
                <button type="button" class="hr-goal-btn hr-goal-hiit"      data-goal="hiit">🚀 HIIT</button>
              </div>
            </div>

            <div id="hrLastResult" class="hr-last-result d-none mb-3"></div>
            <button class="btn btn-cta w-100" onclick="calculateHR()">
              Calculate Heart Rate Zones →
            </button>

            {{-- Results --}}
            <div id="hrResults" class="mt-4 d-none">
              <div class="ms-divider"></div>

              <div class="text-center mb-4">
                <div class="hr-max-label">Maximum Heart Rate</div>
                <div id="hrMaxDisplay" class="hr-max-val"></div>
                <div class="hr-max-sub">beats per minute</div>
              </div>

              {{-- Zone visual bar --}}
              <div id="hrZoneBar" class="mb-4"></div>

              {{-- Zone table --}}
              <div class="table-responsive">
                <table class="table table-sm mb-0 hr-table">
                  <thead class="ms-table-head">
                    <tr>
                      <th>Zone</th>
                      <th>Name</th>
                      <th>% Max HR</th>
                      <th>BPM Range</th>
                      <th>Purpose</th>
                    </tr>
                  </thead>
                  <tbody id="hrZoneTable"></tbody>
                </table>
              </div>
              {{-- Goal callout --}}
              <div id="hrGoalCallout" class="mt-3 p-3 rounded-3 ms-note d-none"></div>

              {{-- Advanced toggle --}}
              <div class="text-center mt-3">
                <button class="hr-adv-toggle btn btn-link p-0"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#hrAdvanced"
                        aria-expanded="false">
                  Show advanced metrics
                </button>
              </div>

              {{-- Advanced: VO2max + how to measure resting HR --}}
              <div class="collapse mt-3" id="hrAdvanced">
                <div class="ms-divider mb-3"></div>

                <div id="hrVo2Section" class="mb-4 d-none">
                  <p class="fw-600 mb-1 text-sm">Estimated VO₂max <span class="text-muted fw-400">(from resting HR)</span></p>
                  <div id="hrVo2Value" class="hr-vo2-value mb-1"></div>
                  <p id="hrVo2Desc" class="text-sm text-muted mb-1"></p>
                  <p class="text-xs text-muted mb-0">Formula: Uth et al. (2004) — 15 × (maxHR ÷ restingHR)</p>
                </div>

                <div>
                  <p class="fw-600 mb-2 text-sm">How to measure your resting heart rate accurately</p>
                  <ol class="text-sm text-muted ps-3 mb-0">
                    <li class="mb-1">Stay lying still in bed for at least 5 minutes after waking — before coffee, phone, or getting up</li>
                    <li class="mb-1">Find your pulse at your wrist (radial artery, below the thumb) or lightly on your neck</li>
                    <li class="mb-1">Count beats for 60 seconds — or count for 30 seconds and multiply by 2</li>
                    <li class="mb-1">Repeat on 3 consecutive mornings and use the average</li>
                    <li>Avoid alcohol the night before and caffeine before measuring</li>
                  </ol>
                </div>
              </div>

            </div>
            {{-- /Results --}}

          </div>
        </div>
        {{-- /Tool Card --}}
      </div>

      {{-- Right: Quick facts --}}
      <div class="col-lg-5 d-none d-lg-block pt-2">
        <div class="ms-facts-wrap">
          <h3 class="ms-facts-title">Quick Heart Rate Facts</h3>
          @foreach([
            ['220 − age', 'Classic max HR formula (Fox & Haskell)'],
            ['50–60%', 'Fat burning zone (% of max HR)'],
            ['70–80%', 'Cardio / aerobic training zone'],
            ['85–95%', 'HIIT / anaerobic zone'],
            ['60–100 bpm', 'Normal resting heart rate (adults)'],
          ] as [$stat, $label])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div class="ms-fact-pill ms-fact-pill-fitness">{{ $stat }}</div>
            <div class="ms-fact-label">{{ $label }}</div>
          </div>
          @endforeach
          <p class="ms-fact-source">Sources: AHA, Fox & Haskell (1970), Tanaka et al. (2001)</p>
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
        <h2 class="mb-4">How Heart Rate Zones Work: The Science of Training Intensity</h2>
        <img src="{{ asset('images/heart-rate-zones.svg') }}" alt="Heart rate training zones chart: Zone 1 recovery 50–60%, Zone 2 fat burn 60–70%, Zone 3 cardio 70–80%, Zone 4 threshold 80–90%, Zone 5 max effort 90–100% of max heart rate" width="640" height="210" loading="lazy" class="img-fluid rounded-3 mb-4">
        <p>Heart rate zones divide your intensity spectrum into meaningful bands, each with distinct physiological effects. Training in the right zone for the right purpose is one of the most evidence-backed principles in endurance sports and cardiovascular fitness.</p>
        <p>At low intensities, your body primarily burns fat for fuel. As intensity increases, it shifts toward carbohydrates, which can be metabolised faster to meet higher energy demands. At maximum intensity, the anaerobic system takes over entirely.</p>
        <p>The Karvonen formula, introduced in 1957, was a significant improvement over simple percentage-of-max methods because it uses your heart rate reserve — the functional range between your resting and max HR — as the basis for zone calculation. This personalises zones to your actual cardiovascular fitness level.</p>
      </div>
      <div class="col-lg-7">
        <div class="p-4 rounded-3 ms-data-box">
          <p class="fw-semibold mb-3 ms-panel-head">The 5 Heart Rate Training Zones</p>
          @foreach([
            ['Zone 1', '50–60%', 'hr-zone-1', 'Very Light', 'Recovery, warm-up, cool-down. Fat primary fuel. Easy conversation.'],
            ['Zone 2', '60–70%', 'hr-zone-2', 'Light / Fat Burn', 'Aerobic base building. High fat utilisation. Sustainable for hours.'],
            ['Zone 3', '70–80%', 'hr-zone-3', 'Moderate / Cardio', 'Cardiovascular fitness. Mix of fat and carbs. Slightly harder to speak.'],
            ['Zone 4', '80–90%', 'hr-zone-4', 'Hard / Threshold', 'Lactate threshold training. Primarily carbohydrates. Can speak only briefly.'],
            ['Zone 5', '90–100%', 'hr-zone-5', 'Maximum / VO2 Max', 'Anaerobic, HIIT. All-out effort. Cannot sustain for more than 1–2 minutes.'],
          ] as [$zone, $pct, $cls, $name, $desc])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div class="hr-zone-badge {{ $cls }}">{{ $zone }}</div>
            <div>
              <div class="fw-semibold ms-ref-title">{{ $name }} <span class="fw-normal text-muted">({{ $pct }})</span></div>
              <div class="ms-ref-desc">{{ $desc }}</div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ── 3. Resting Heart Rate Reference ─────────────────────────────────────── --}}
<section class="ms-section-muted">
  <div class="container-xl">
    <div class="text-center mb-5">
      <h2>Resting Heart Rate Chart by Age — What's Normal?</h2>
      <p class="text-muted ms-intro-text">Measure first thing in the morning, before getting out of bed, for the most accurate resting HR.</p>
    </div>
    <div class="table-responsive hr-table-wrap">
      <table class="table table-bordered text-center hr-rhr-table">
        <thead class="ms-table-head">
          <tr><th>Age</th><th>Athlete</th><th>Excellent</th><th>Good</th><th>Average</th><th>Poor</th></tr>
        </thead>
        <tbody>
          @foreach([
            ['18–25', '49–55', '56–61', '62–65', '66–69', '70+'],
            ['26–35', '49–54', '55–61', '62–65', '66–70', '71+'],
            ['36–45', '50–56', '57–62', '63–66', '67–70', '71+'],
            ['46–55', '50–57', '58–63', '64–67', '68–71', '72+'],
            ['56–65', '51–56', '57–61', '62–67', '68–71', '72+'],
            ['65+',   '50–55', '56–61', '62–65', '66–69', '70+'],
          ] as $row)
          <tr>
            @foreach($row as $cell)
            <td>{{ $cell }}</td>
            @endforeach
          </tr>
          @endforeach
        </tbody>
      </table>
      <p class="text-muted text-center hr-source-note">Values in bpm. Source: American Heart Association / Cooper Institute norms.</p>
    </div>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="hrFaqAccordion" />


{{-- ── 5. Long-tail keyword sections ─────────────────────────────────────────── --}}
<section class="ms-section-accent">
  <div class="container ms-longtail">
    <h2 class="mb-4 text-brand">Heart Rate Zones for Fat Burning — Is the 'Fat Burn Zone' Real?</h2>
    <p>The 'fat burning zone' (Zone 2, 60–70% max HR) is frequently misunderstood. At this intensity, your body does use fat as its primary fuel source — roughly 60–65% of calories burned come from fat oxidation. However, the total calorie burn per minute is much lower than at higher intensities. This creates a paradox: you burn a higher proportion of fat at low intensity, but more total fat in the same time period at moderate-to-high intensity.</p>
    <p>Where Zone 2 training truly shines is in developing your aerobic base — the underlying cardiovascular machinery that determines how efficiently you can use fat as fuel at all intensities. Elite endurance athletes spend enormous volumes of training in Zone 2 specifically to develop this metabolic foundation. For the average gym-goer with limited time, higher-intensity training and overall calorie deficit are more important for fat loss than staying in Zone 2.</p>

    <h2 class="mt-5 mb-4 text-brand">HIIT Heart Rate Calculator — How High Should Your Heart Rate Go?</h2>
    <p>HIIT (High-Intensity Interval Training) is most effective when work intervals push heart rate into Zone 4–5 (80–100% max HR). A common HIIT protocol is 20–40 seconds of all-out effort followed by 40–80 seconds of rest or light activity, repeated 6–10 times. During the work intervals, heart rate should climb to 85–95% of maximum. Because of the intensity, HIIT sessions are typically 20–30 minutes total.</p>
    <p>Research consistently shows that HIIT produces similar or greater cardiovascular fitness improvements as longer moderate-intensity sessions in less time. It also produces a significant EPOC (excess post-exercise oxygen consumption) effect — your metabolism stays elevated for hours after the session, contributing additional calorie burn. However, HIIT should be limited to 2–3 sessions per week due to the high recovery demand.</p>

    <h2 class="mt-5 mb-4 text-brand">Resting Heart Rate Chart by Age — What's Normal?</h2>
    <p>Resting heart rate naturally changes with age and fitness. In adolescence, resting HR tends to be slightly higher; it stabilises through adulthood and may rise slightly in later decades as cardiovascular efficiency declines. Regular aerobic exercise is the most powerful lifestyle intervention for lowering resting heart rate — even moderate amounts of cardio can reduce resting HR by 5–10 bpm over several months.</p>
    <p>Tracking your resting heart rate over time is a free and underutilised fitness metric. As your cardiovascular fitness improves, your resting HR should trend downward. A sudden unexplained elevation in resting HR can indicate overtraining, illness, stress, or poor sleep, making it a useful daily biometric for athletes to monitor.</p>
  </div>
</section>

<x-related-tools :tools="$relatedTools" heading="More Fitness Calculators" />


{{-- ── 7. SEO Block ──────────────────────────────────────────────────────────── --}}
<section class="ms-section-seo">
  <div class="container-xl">
    <div class="row justify-content-center">
      <div class="col-lg-8 ms-seo-body">
        <h2 class="mb-4 ms-seo-h2">Heart Rate Calculator: The Physiology Behind the Zones</h2>
        <p>Heart rate training zones have been used in serious endurance coaching since the 1970s. The foundational research by Fox and Haskell (1971) established the 220-minus-age formula as a population-level maximum heart rate estimate, and subsequent decades of sports science built a training zone framework on top of it.</p>
        <h3 class="ms-seo-h3">Why the 220 − Age Formula Is Only an Estimate</h3>
        <p>The 220 − age formula is a linear approximation of a non-linear biological reality. It was never intended to be used for individuals — it describes a population average with a standard deviation of ±10–12 bpm. This means two people of the same age can have maximum heart rates 20–25 bpm apart and both be completely normal. The Tanaka formula (208 − 0.7 × age) was derived from a meta-analysis of 351 studies and is more accurate, especially for older adults, where the classic formula tends to overestimate max HR.</p>
        <h3 class="ms-seo-h3">Heart Rate and Medications</h3>
        <p>Beta-blockers — commonly prescribed for hypertension and heart conditions — directly lower heart rate at rest and during exercise. If you take beta-blockers, the age-based maximum heart rate formulas will significantly overestimate your actual max HR, making zone calculations unreliable. Work with your physician to establish appropriate exercise intensity targets if you are on cardiac medications.</p>
        <div class="mt-4 p-4 rounded-3 ms-note ms-note-green">
          <p class="mb-0 ms-disclaimer"><strong>Medical Note:</strong> Heart rate zone training is intended for healthy adults. If you have heart disease, hypertension, or known cardiac arrhythmias, consult your physician before beginning exercise at elevated heart rate zones.</p>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')
<script>
(function () {

  var _maxHR, _resting, _selectedGoal = null;

  var ZONES = [
    { name: 'Very Light', minPct: 0.50, maxPct: 0.60, purpose: 'Recovery, warm-up, cool-down' },
    { name: 'Light / Fat Burn', minPct: 0.60, maxPct: 0.70, purpose: 'Fat burning, aerobic base building' },
    { name: 'Moderate / Cardio', minPct: 0.70, maxPct: 0.80, purpose: 'Cardiovascular fitness, mixed fuel' },
    { name: 'Hard / Threshold', minPct: 0.80, maxPct: 0.90, purpose: 'Lactate threshold, endurance speed' },
    { name: 'Max / VO₂ Max', minPct: 0.90, maxPct: 1.00, purpose: 'HIIT, anaerobic, peak performance' },
  ];

  var GOAL_MAP = {
    fat:       { zone: 2, note: 'For fat burning, target Zone 2 — burns the highest proportion of calories from fat and can be sustained for 30–60+ minutes.' },
    cardio:    { zone: 3, note: 'For cardiovascular fitness, train in Zone 3 — improves aerobic capacity using a mix of fat and carbohydrates.' },
    threshold: { zone: 4, note: 'For threshold training, push into Zone 4 — raises your lactate threshold so you can sustain higher speeds for longer.' },
    hiit:      { zone: 5, note: 'For HIIT, drive into Zone 5 during work intervals — builds VO₂max and produces significant post-exercise calorie burn.' },
  };

  // ── localStorage: show last result ───────────────────────────────────────
  (function () {
    try {
      var last = JSON.parse(localStorage.getItem('hr_last'));
      if (last && last.maxHR && last.date) {
        var el = document.getElementById('hrLastResult');
        el.textContent = 'Last result: Max HR ' + last.maxHR + ' bpm on ' + last.date;
        el.classList.remove('d-none');
      }
    } catch (e) {}
  })();

  // ── Formula selector note ─────────────────────────────────────────────────
  document.getElementById('hrFormula').addEventListener('change', function () {
    document.getElementById('hrKarvonenNote').classList.toggle('d-none', this.value !== 'karvonen');
  });

  // ── Goal selector ─────────────────────────────────────────────────────────
  document.querySelectorAll('.hr-goal-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var wasActive = this.classList.contains('hr-goal-active');
      document.querySelectorAll('.hr-goal-btn').forEach(function (b) { b.classList.remove('hr-goal-active'); });
      if (!wasActive) {
        this.classList.add('hr-goal-active');
        _selectedGoal = this.dataset.goal;
      } else {
        _selectedGoal = null;
      }
      if (_maxHR) applyGoalHighlight();
    });
  });

  function applyGoalHighlight() {
    // Clear all highlights
    for (var i = 1; i <= 5; i++) {
      var row = document.getElementById('hrZoneRow' + i);
      if (row) row.classList.remove('hr-zone-row-highlighted');
    }
    var callout = document.getElementById('hrGoalCallout');
    if (!_selectedGoal || !GOAL_MAP[_selectedGoal]) {
      callout.classList.add('d-none');
      return;
    }
    var g = GOAL_MAP[_selectedGoal];
    var targetRow = document.getElementById('hrZoneRow' + g.zone);
    if (targetRow) targetRow.classList.add('hr-zone-row-highlighted');
    callout.textContent = g.note;
    callout.className = 'mt-3 p-3 rounded-3 ms-note ms-note-green';
    callout.classList.remove('d-none');
  }

  // ── Main calculation ──────────────────────────────────────────────────────
  window.calculateHR = function () {
    var age     = parseInt(document.getElementById('hrAge').value);
    var resting = parseInt(document.getElementById('hrResting').value);
    var formula = document.getElementById('hrFormula').value;

    if (!age || age < 10 || age > 100) { alert('Please enter a valid age (10–100).'); return; }
    if (formula === 'karvonen' && (!resting || resting < 30)) {
      alert('Karvonen requires a valid resting heart rate. Please enter it or choose a different formula.');
      return;
    }

    var maxHR = formula === 'tanaka' ? Math.round(208 - 0.7 * age) : 220 - age;
    var useKarvonen = formula === 'karvonen' && resting >= 30;
    var hrr = useKarvonen ? (maxHR - resting) : null;

    function bpm(pct) {
      return useKarvonen ? Math.round(hrr * pct + resting) : Math.round(maxHR * pct);
    }

    _maxHR   = maxHR;
    _resting = resting;

    document.getElementById('hrMaxDisplay').textContent = maxHR;

    // Zone colour bar
    var barHtml = '<div class="hr-zone-bar-row">';
    for (var i = 0; i < 5; i++) barHtml += '<div class="hr-zone-segment hr-zone-' + (i + 1) + '"></div>';
    barHtml += '</div><div class="hr-zone-labels">';
    for (var j = 0; j < 5; j++) barHtml += '<div class="hr-zone-label-item">Z' + (j + 1) + '</div>';
    barHtml += '</div>';
    document.getElementById('hrZoneBar').innerHTML = barHtml;

    // Zone table
    var tableHtml = '';
    ZONES.forEach(function (z, i) {
      var low  = bpm(z.minPct);
      var high = bpm(z.maxPct);
      var pctLabel = Math.round(z.minPct * 100) + '–' + Math.round(z.maxPct * 100) + '%';
      tableHtml += '<tr id="hrZoneRow' + (i + 1) + '">'
        + '<td><span class="ms-dot me-2 hr-zone-' + (i + 1) + '"></span>Zone ' + (i + 1) + '</td>'
        + '<td>' + z.name + '</td>'
        + '<td>' + pctLabel + '</td>'
        + '<td><strong>' + low + '–' + high + ' bpm</strong></td>'
        + '<td class="text-muted">' + z.purpose + '</td>'
        + '</tr>';
    });
    document.getElementById('hrZoneTable').innerHTML = tableHtml;

    // Apply goal highlight if already selected
    applyGoalHighlight();

    // ── Advanced: VO2max from resting HR (Uth et al. 2004) ───────────────
    var vo2Section = document.getElementById('hrVo2Section');
    if (resting && resting >= 30) {
      var vo2 = Math.round(15 * (maxHR / resting));
      var vo2Level;
      if      (vo2 >= 60) vo2Level = 'Superior';
      else if (vo2 >= 55) vo2Level = 'Excellent';
      else if (vo2 >= 50) vo2Level = 'Good';
      else if (vo2 >= 45) vo2Level = 'Fair';
      else if (vo2 >= 40) vo2Level = 'Below average';
      else                vo2Level = 'Poor — consistent aerobic training will improve this';
      document.getElementById('hrVo2Value').textContent = vo2 + ' ml/kg/min';
      document.getElementById('hrVo2Desc').textContent  = 'Fitness level: ' + vo2Level + '. VO₂max is the gold standard of cardiovascular fitness.';
      vo2Section.classList.remove('d-none');
    } else {
      vo2Section.classList.add('d-none');
    }

    // ── localStorage save ─────────────────────────────────────────────────
    try {
      var dateStr = new Date().toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' });
      localStorage.setItem('hr_last', JSON.stringify({ maxHR: maxHR, date: dateStr }));
      var lastEl = document.getElementById('hrLastResult');
      lastEl.textContent = 'Last result: Max HR ' + maxHR + ' bpm on ' + dateStr;
      lastEl.classList.remove('d-none');
    } catch (e) {}

    var resultsEl = document.getElementById('hrResults');
    resultsEl.classList.remove('d-none');
    resultsEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  };

})();
</script>
@endsection
