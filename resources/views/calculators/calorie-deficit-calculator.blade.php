@extends('layouts.app')

@section('title', 'Calorie Deficit Calculator — How Many Calories to Cut for Weight Loss | MindSnap')
@section('description', 'Free calorie deficit calculator: enter your goal weight and timeline to find your daily calorie target. Includes safe deficit ranges and weekly loss projections. No signup.')
@section('canonical', config('app.url') . '/calorie-deficit-calculator')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "WebApplication",
  "name": "Calorie Deficit Calculator",
  "url": "{{ config('app.url') }}/calorie-deficit-calculator",
  "description": "Calculate your daily calorie deficit target based on current weight, goal weight, and timeline for fat loss.",
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
    { "@@type": "ListItem", "position": 1, "name": "Home",          "item": "{{ config('app.url') }}" },
    { "@@type": "ListItem", "position": 2, "name": "Fitness Tools", "item": "{{ config('app.url') }}/fitness-tools" },
    { "@@type": "ListItem", "position": 3, "name": "Calorie Deficit Calculator" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [
    { "@@type": "Question", "name": "What is a calorie deficit?",
      "acceptedAnswer": { "@@type": "Answer", "text": "A calorie deficit occurs when you consume fewer calories than your body burns in a day. When this happens, your body draws on stored energy — primarily body fat — to make up the shortfall. A deficit of 3,500 calories equates to approximately 0.45 kg (1 lb) of fat loss. Sustained over time, a daily deficit produces consistent, measurable fat loss without requiring dramatic dietary changes." } },
    { "@@type": "Question", "name": "How big a deficit do I need to lose 1 kg per week?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Losing 1 kg per week requires a total weekly deficit of approximately 7,700 calories, which works out to a 1,100 calorie daily deficit. This is near the upper limit of what is considered safe for most adults, and this rate risks significant muscle loss unless protein intake is very high (2+ g per kg) and resistance training is maintained. A more sustainable approach is 0.5 kg per week (500 calorie daily deficit), which produces comparable long-term fat loss with far less muscle loss." } },
    { "@@type": "Question", "name": "What is the minimum safe calorie intake?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Most health authorities set the minimum safe calorie intake at 1,200 calories per day for women and 1,500 calories per day for men. Below these thresholds it becomes very difficult to meet micronutrient needs, and the body increasingly breaks down muscle tissue for energy. Very low calorie diets (under 800 calories) should only be undertaken under direct medical supervision." } },
    { "@@type": "Question", "name": "Can I lose fat without losing muscle?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes — this is achievable through a combination of a moderate calorie deficit (300–500 calories/day), high protein intake (1.6–2.2 g per kg of bodyweight), and consistent resistance training. The protein provides amino acids for muscle protein synthesis; the resistance training gives your body a stimulus to preserve muscle even in an energy-deficient state. Larger deficits and very low protein intakes make muscle preservation increasingly difficult." } },
    { "@@type": "Question", "name": "Why am I not losing weight in a deficit?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The most common reason is inaccurate calorie tracking — people consistently underestimate food intake and overestimate calorie burn from exercise. Other factors include water retention masking fat loss on the scale (especially with increased exercise, hormonal fluctuation, or high dietary sodium), adaptive thermogenesis where TDEE decreases in response to prolonged restriction, and stress or poor sleep elevating cortisol which promotes water retention and fat storage. If the scale hasn't moved in 3+ weeks of consistent tracking, reducing intake by 100–150 calories or increasing activity is a reasonable next step." } },
    { "@@type": "Question", "name": "Is a 1000 calorie deficit too much?",
      "acceptedAnswer": { "@@type": "Answer", "text": "A 1,000-calorie daily deficit is at the upper limit of what most guidelines consider safe, producing approximately 1 kg per week of weight loss. While some individuals do this successfully with medical supervision, the evidence consistently shows that larger deficits increase the proportion of weight lost from muscle rather than fat, trigger greater metabolic adaptation, and are associated with much higher rates of regain. For most people, 500 calories is the sweet spot for sustainable fat loss." } },
    { "@@type": "Question", "name": "How do I calculate my calorie deficit?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Calculate your TDEE (Total Daily Energy Expenditure) using the Mifflin-St Jeor equation multiplied by your activity factor. Then subtract your target daily deficit from that number to get your calorie goal. For example, if your TDEE is 2,400 calories and you want a 500-calorie deficit, eat 1,900 calories per day. This calculator does all of this automatically — just enter your stats, goal weight, and preferred weekly loss rate." } },
    { "@@type": "Question", "name": "What is the best calorie deficit for beginners?",
      "acceptedAnswer": { "@@type": "Answer", "text": "For beginners, a deficit of 300–500 calories per day is ideal. This is large enough to produce noticeable fat loss (0.3–0.5 kg per week) without feeling overly restrictive, without significantly impacting energy levels for exercise, and without triggering the metabolic adaptation that makes longer-term weight loss progressively harder. Starting conservatively also allows room to reduce calories further if progress stalls — an option that aggressive restrictors do not have." } }
  ]
}
</script>
@endsection

@php
$faqs = [
  ['q' => 'What is a calorie deficit?',
             'a' => 'A calorie deficit occurs when you consume fewer calories than your Total Daily Energy Expenditure (TDEE). When your body does not receive enough calories from food, it draws on stored energy — predominantly body fat — to bridge the gap. A deficit of 7,700 calories (over any time period) equates to approximately 1 kg of fat loss. Creating a consistent, moderate daily deficit is the fundamental mechanism behind all effective fat loss — regardless of which dietary approach is used.'],
  ['q' => 'How big a deficit do I need to lose 1 kg per week?',
             'a' => 'Losing 1 kg per week requires a total weekly deficit of approximately 7,700 calories — roughly 1,100 calories per day. This is at the upper limit of what most guidelines consider safe and sustainable. At this rate, a significant proportion of weight lost will be muscle rather than pure fat unless protein intake is very high (2 g+ per kg bodyweight) and resistance training is maintained. Most people achieve better long-term outcomes with a 0.5 kg per week target, which requires only a 550-calorie daily deficit.'],
  ['q' => 'What is the minimum safe calorie intake?',
             'a' => 'General guidelines set the minimum safe calorie intake at 1,200 calories per day for women and 1,500 calories per day for men. Below these thresholds it becomes very difficult to consume adequate protein, vitamins, and minerals, and the body increasingly catabolises muscle tissue for energy. Very low calorie diets (under 800 calories per day) can cause serious health problems including gallstones, nutrient deficiencies, cardiac arrhythmias, and severe muscle loss — these should only be undertaken with direct medical supervision.'],
  ['q' => 'Can I lose fat without losing muscle?',
             'a' => 'Yes — muscle preservation during fat loss is achievable through three key factors. First, eat enough protein: 1.6–2.2 g per kg of bodyweight per day provides amino acids for muscle protein synthesis even in a deficit. Second, train with resistance: lifting weights gives your body a strong anabolic signal to maintain muscle even when energy is restricted. Third, keep the deficit moderate: deficits larger than 750 calories per day make muscle preservation progressively more difficult regardless of protein intake.'],
  ['q' => 'Why am I not losing weight in a deficit?',
             'a' => 'The most common reason is that the deficit is smaller than assumed due to inaccurate calorie tracking. People consistently underestimate food intake by 20–40% in studies, and calorie labels can be 20% inaccurate. Other factors include water retention masking fat loss (especially in the early weeks of a new exercise programme or during hormonal fluctuations), adaptive thermogenesis reducing TDEE after prolonged restriction, and genuine metabolic rate variation between individuals. If progress has stalled for 3+ weeks with consistent, verified tracking, reducing intake by 100–200 calories or adding 30 minutes of walking daily is a sensible next step.'],
  ['q' => 'Is a 1000 calorie deficit too much?',
             'a' => 'A 1,000-calorie daily deficit sits at the upper limit of what established guidelines consider safe, producing approximately 1 kg of weight loss per week. While achievable under the right conditions — high protein diet, resistance training, medical monitoring — research consistently shows that larger deficits increase the proportion of weight lost from lean mass versus fat, significantly increase hunger and dietary fatigue, trigger greater metabolic adaptation, and are associated with much higher rates of weight regain. For most people without medical oversight, 500 calories is the recommended maximum daily deficit.'],
  ['q' => 'How do I calculate my calorie deficit?',
             'a' => 'Calculate your TDEE using the Mifflin-St Jeor equation (this calculator does it automatically): Male TDEE = [(10 × kg) + (6.25 × cm) − (5 × age) + 5] × activity factor; Female TDEE = [(10 × kg) + (6.25 × cm) − (5 × age) − 161] × activity factor. Then subtract your target daily deficit: 0.5 kg per week = subtract ~550 calories. Eat that many calories consistently, reassess every 2–3 weeks, and adjust based on actual results rather than theory.'],
  ['q' => 'What is the best calorie deficit for beginners?',
             'a' => 'For beginners, a 300–500 calorie daily deficit is ideal. It is large enough to produce visible, motivating results (0.3–0.5 kg per week) without being so aggressive that it causes excessive hunger, fatigue, or muscle loss. A conservative start also preserves the option to reduce calories further if progress slows — an option not available to those who start aggressively. Combine the deficit with sufficient protein (at least 1.6 g per kg bodyweight) and resistance training for the best body composition outcome.'],
];

$relatedTools = [
  ['icon' => '🔥', 'name' => 'Calorie Calculator', 'slug' => 'calorie-calculator', 'desc' => 'Calculate your TDEE and daily calorie needs by activity level.'],
  ['icon' => '💪', 'name' => 'BMI Calculator', 'slug' => 'bmi-calculator', 'desc' => 'Find your body mass index and healthy weight range.'],
  ['icon' => '🥗', 'name' => 'Macro Calculator', 'slug' => 'macro-calculator', 'desc' => 'Get personalised protein, carb, and fat targets for your goal.'],
  ['icon' => '🥩', 'name' => 'Protein Calculator', 'slug' => 'protein-calculator', 'desc' => 'Find your optimal daily protein intake for fat loss or muscle gain.'],
  ['icon' => '⚖️', 'name' => 'Ideal Weight Calculator', 'slug' => 'ideal-weight-calculator', 'desc' => 'Find your ideal weight range based on height, sex, and frame.'],
  ['icon' => '📐', 'name' => 'Body Fat Calculator', 'slug' => 'body-fat-calculator', 'desc' => 'Estimate your body fat percentage using body measurements.'],
];
@endphp

@section('content')

{{-- ── 1. Hero / Tool ───────────────────────────────────────────────────────── --}}
<section class="ms-hero">
  <div class="container-xl">
    <div class="row align-items-start g-5">

      <div class="col-lg-7">
        <nav aria-label="breadcrumb" class="mb-3">
          <ol class="breadcrumb ms-breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('category.fitness') }}">Fitness Tools</a></li>
            <li class="breadcrumb-item active">Calorie Deficit Calculator</li>
          </ol>
        </nav>

        <h1 class="mb-2 ms-hero-title">
          📉 Calorie Deficit Calculator — Find Your Fat Loss Calorie Target
        </h1>
        <p class="ms-hero-desc">
          Enter your goal weight and preferred weekly loss rate to calculate your daily calorie target, projected timeline, and safe deficit range.
        </p>

        {{-- ── Tool Card ────────────────────────────────────────────────────── --}}
        <div class="card border-0 mb-n4 ms-tool-card">
          <div class="card-body p-4 p-md-5">

            {{-- Unit toggle --}}
            <div class="d-flex gap-2 mb-4" role="group" aria-label="Unit system">
              <button class="btn flex-fill cd-unit-btn active" data-unit="metric"
                      style="border-radius:8px; font-weight:600; font-size:.88rem; background:var(--fitness); color:#fff; border:none;">
                Metric (kg / cm)
              </button>
              <button class="btn flex-fill cd-unit-btn" data-unit="imperial"
                      style="border-radius:8px; font-weight:600; font-size:.88rem; background:#f8f9fa; color:#555; border:1px solid #e0e0e0;">
                Imperial (lbs / ft)
              </button>
            </div>

            <div class="row g-3 mb-3">
              <div class="col-6">
                <label for="cdSex" class="form-label fw-600">Sex</label>
                <select id="cdSex" class="form-select">
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                </select>
              </div>
              <div class="col-6">
                <label for="cdAge" class="form-label fw-600">Age (years)</label>
                <input type="number" id="cdAge" class="form-control" placeholder="e.g. 30" min="15" max="100">
              </div>
            </div>

            {{-- Metric --}}
            <div id="cdMetric">
              <div class="row g-3 mb-3">
                <div class="col-4">
                  <label for="cdHeightCm" class="form-label fw-600">Height (cm)</label>
                  <input type="number" id="cdHeightCm" class="form-control" placeholder="175">
                </div>
                <div class="col-4">
                  <label for="cdCurrentKg" class="form-label fw-600">Current (kg)</label>
                  <input type="number" id="cdCurrentKg" class="form-control" placeholder="80">
                </div>
                <div class="col-4">
                  <label for="cdGoalKg" class="form-label fw-600">Goal (kg)</label>
                  <input type="number" id="cdGoalKg" class="form-control" placeholder="70">
                </div>
              </div>
            </div>

            {{-- Imperial --}}
            <div id="cdImperial" class="d-none">
              <div class="mb-3">
                <label class="form-label fw-600">Height</label>
                <div class="row g-2">
                  <div class="col-6"><input type="number" id="cdHeightFt" class="form-control" placeholder="Feet"></div>
                  <div class="col-6"><input type="number" id="cdHeightIn" class="form-control" placeholder="Inches"></div>
                </div>
              </div>
              <div class="row g-3 mb-3">
                <div class="col-6">
                  <label for="cdCurrentLbs" class="form-label fw-600">Current weight (lbs)</label>
                  <input type="number" id="cdCurrentLbs" class="form-control" placeholder="176">
                </div>
                <div class="col-6">
                  <label for="cdGoalLbs" class="form-label fw-600">Goal weight (lbs)</label>
                  <input type="number" id="cdGoalLbs" class="form-control" placeholder="154">
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="cdActivity" class="form-label fw-600">Activity Level</label>
              <select id="cdActivity" class="form-select">
                <option value="1.2">Sedentary</option>
                <option value="1.375">Lightly Active</option>
                <option value="1.55" selected>Moderately Active</option>
                <option value="1.725">Very Active</option>
                <option value="1.9">Extra Active</option>
              </select>
            </div>

            <div class="mb-4">
              <label for="cdRate" class="form-label fw-600">Weekly loss goal</label>
              <select id="cdRate" class="form-select">
                <option value="0.25">0.25 kg / week (0.55 lbs) — Slow &amp; gentle</option>
                <option value="0.5" selected>0.5 kg / week (1.1 lbs) — Recommended</option>
                <option value="0.75">0.75 kg / week (1.65 lbs) — Faster</option>
                <option value="1">1 kg / week (2.2 lbs) — Aggressive</option>
              </select>
            </div>

            <button class="btn btn-cta w-100" onclick="calcDeficit()" style="font-size:1rem;">
              Calculate My Deficit →
            </button>

            {{-- Results --}}
            <div id="results" class="mt-4 d-none">
              <div style="height:1px; background:#f0f0f0; margin-bottom:20px;"></div>

              <div class="row g-3 mb-4 text-center">
                <div class="col-6">
                  <div style="background:#f0fff4; border-radius:12px; padding:16px 10px;">
                    <div id="cdTDEE" style="font-size:1.7rem; font-weight:700; color:var(--green-text);"></div>
                    <div style="font-size:.75rem; color:#555; margin-top:4px;">TDEE (maintenance)</div>
                  </div>
                </div>
                <div class="col-6">
                  <div style="background:#e8f4fd; border-radius:12px; padding:16px 10px;">
                    <div id="cdDeficitDay" style="font-size:1.7rem; font-weight:700; color:var(--teal-text);"></div>
                    <div style="font-size:.75rem; color:#555; margin-top:4px;">Daily deficit</div>
                  </div>
                </div>
              </div>

              <div class="p-4 rounded-3 mb-4 text-center" style="background:var(--primary-dark); color:#fff;">
                <div style="font-size:.8rem; opacity:.7; margin-bottom:6px;">Your daily calorie target</div>
                <div id="cdTarget" style="font-size:2.4rem; font-weight:700;"></div>
                <div style="font-size:.8rem; opacity:.7; margin-top:4px;">calories per day</div>
              </div>

              <div class="row g-3 text-center mb-3">
                <div class="col-6">
                  <div style="background:#fff8e1; border-radius:10px; padding:14px 8px;">
                    <div id="cdWeeks" style="font-size:1.4rem; font-weight:700; color:#e65100;"></div>
                    <div style="font-size:.75rem; color:#555; margin-top:4px;">Weeks to goal</div>
                  </div>
                </div>
                <div class="col-6">
                  <div style="background:#f3e5f5; border-radius:10px; padding:14px 8px;">
                    <div id="cdWeeklyLoss" style="font-size:1.4rem; font-weight:700; color:var(--purple-text);"></div>
                    <div style="font-size:.75rem; color:#555; margin-top:4px;">Weekly loss target</div>
                  </div>
                </div>
              </div>

              <div id="cdWarning" class="d-none p-3 rounded-3" style="background:#fff3cd; border:1px solid #ffc107; font-size:.85rem; color:#664d03;"></div>
            </div>

          </div>
        </div>
      </div>

      {{-- Right: Quick facts --}}
      <div class="col-lg-5 d-none d-lg-block" style="padding-top:10px;">
        <div class="ms-facts-wrap">
          <h3 class="ms-facts-title">Quick Deficit Facts</h3>
          @foreach([
            ['3,500 cal',  'Calories in 1 lb of body fat'],
            ['500 cal/day','Safe deficit for ~1 lb/week loss'],
            ['1,000 cal',  'Max safe daily deficit (2 lbs/week)'],
            ['1,200 cal',  'Minimum safe daily calories for women'],
            ['12–16 wks',  'Typical cut duration for athletes'],
          ] as [$stat, $label])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div class="ms-fact-pill ms-fact-pill-fitness">{{ $stat }}</div>
            <div class="ms-fact-label">{{ $label }}</div>
          </div>
          @endforeach
          <p class="ms-fact-source">Sources: NIH, NIDDK, Dietary Guidelines for Americans</p>
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
        <h2 class="mb-4">How a Calorie Deficit Creates Fat Loss: The Science Explained</h2>
        <p>Fat cells store energy in the form of triglycerides. When your calorie intake is lower than your total daily expenditure, your body draws on these stores to fuel its functions. One kilogram of body fat contains approximately 7,700 calories of stored energy.</p>
        <p>This calculator uses the <strong>Mifflin-St Jeor equation</strong> — considered more accurate than the original Harris-Benedict formula — to estimate your TDEE:</p>
        <div class="p-3 rounded-3 mb-3" style="background:#f8f9fa; border-left:4px solid var(--fitness); font-size:.83rem; color:var(--primary-dark);">
          <strong>Male:</strong> (10 × kg) + (6.25 × cm) − (5 × age) + 5<br>
          <strong>Female:</strong> (10 × kg) + (6.25 × cm) − (5 × age) − 161
        </div>
        <p>Your weekly loss target converts to a daily calorie deficit: 0.5 kg/week = 3,850 ÷ 7 = 550 cal/day. The calculator subtracts this from your TDEE to find your daily calorie target.</p>
      </div>
      <div class="col-lg-7">
        <div class="p-4 rounded-3 ms-data-box">
          <p class="fw-600 mb-3" style="color:var(--primary-dark); font-size:.88rem; text-transform:uppercase; letter-spacing:.5px;">Safe deficit ranges</p>
          @foreach([
            ['250 cal/day',  '0.25 kg/week', 'low',  'Best for those close to goal or preserving athletic performance'],
            ['500 cal/day',  '0.5 kg/week',  'good', 'Sweet spot for most people — sustainable with minimal muscle loss'],
            ['750 cal/day',  '0.75 kg/week', 'mod',  'Achievable but requires diligent protein intake and training'],
            ['1,000 cal/day','1 kg/week',    'high', 'Near upper limit — significant risk of muscle loss without high protein'],
            ['>1,000 cal/day','> 1 kg/week', 'warn', 'Not recommended — medical supervision required above this threshold'],
          ] as [$def, $loss, $level, $desc])
          @php
            $colors = ['low' => ['#e8f5e9','#2e7d32'], 'good' => ['#e3f2fd','#0277bd'], 'mod' => ['#fff8e1','#e65100'], 'high' => ['#fce4ec','#c62828'], 'warn' => ['#ffebee','#b71c1c']];
            $c = $colors[$level];
          @endphp
          <div class="d-flex align-items-start gap-3 mb-3">
            <div style="background:{{ $c[0] }}; color:{{ $c[1] }}; border-radius:6px; padding:4px 8px; font-size:.75rem; font-weight:700; min-width:86px; text-align:center; flex-shrink:0; margin-top:2px;">{{ $def }}</div>
            <div>
              <div class="fw-600" style="font-size:.87rem; color:#1a1a2e;">{{ $loss }}</div>
              <div style="font-size:.8rem; color:#666; line-height:1.5;">{{ $desc }}</div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ── 3. Reference table ─────────────────────────────────────────────────────── --}}
<section class="ms-section-muted">
  <div class="container-xl">
    <div class="text-center mb-5">
      <h2>Calorie Deficit: Weekly Loss Rate Reference</h2>
      <p class="text-muted" style="max-width:520px; margin:auto;">How calorie deficits translate to fat loss over time. Based on 7,700 cal per kg of fat.</p>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="table-responsive">
          <table class="table table-bordered" style="border-radius:12px; overflow:hidden; font-size:.9rem;">
            <thead class="ms-table-head">
              <tr>
                <th style="padding:12px 16px;">Daily Deficit</th>
                <th style="padding:12px 16px;">Weekly Loss</th>
                <th style="padding:12px 16px;">Monthly Loss</th>
                <th style="padding:12px 16px;">10 kg in…</th>
                <th style="padding:12px 16px;">Safety Rating</th>
              </tr>
            </thead>
            <tbody>
              @foreach([
                ['250 cal',   '0.23 kg', '~1 kg',  '~43 wks', '✅ Very Safe'],
                ['500 cal',   '0.45 kg', '~2 kg',  '~22 wks', '✅ Recommended'],
                ['750 cal',   '0.68 kg', '~3 kg',  '~15 wks', '⚠️ Moderate'],
                ['1,000 cal', '0.91 kg', '~4 kg',  '~11 wks', '⚠️ High Risk'],
                ['1,500 cal', '1.36 kg', '~6 kg',  '~7 wks',  '❌ Not Advised'],
              ] as [$def, $wk, $mo, $ten, $safety])
              <tr>
                <td style="padding:10px 16px; font-weight:600;">{{ $def }}</td>
                <td style="padding:10px 16px;">{{ $wk }}</td>
                <td style="padding:10px 16px;">{{ $mo }}</td>
                <td style="padding:10px 16px;">{{ $ten }}</td>
                <td style="padding:10px 16px;">{{ $safety }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="faqAccordion" />


{{-- ── 5. Long-tail Keyword Sections ───────────────────────────────────────── --}}
<section class="ms-section-accent">
  <div class="container ms-longtail">

    <h2 class="mb-4" style="color:var(--primary-dark);">Calorie Deficit Calculator for Women — Safe Minimums and Muscle Preservation</h2>
    <p>Women face a specific challenge when creating a calorie deficit: the 1,200-calorie minimum is low enough that many women in a deficit are eating within 200–300 calories of it, leaving almost no margin for adjustments when progress stalls. This is why many nutrition researchers argue that women are better served by increasing activity to create part of their deficit rather than restricting food intake to the minimum.</p>
    <p>Women also experience calorie need fluctuations across the menstrual cycle of approximately 100–300 calories, peaking in the luteal phase (days 15–28). Rigidly maintaining the same daily target throughout the month can feel significantly harder in the second half of the cycle — and this is physiological, not a willpower failure. Some practitioners recommend slightly relaxing the deficit in the luteal phase and compensating in the follicular phase, which tends to have lower hunger and higher energy for exercise.</p>

    <h2 class="mt-5 mb-4" style="color:var(--primary-dark);">How Long to Lose 10kg in a Calorie Deficit?</h2>
    <p>At the recommended 0.5 kg per week loss rate, losing 10 kg takes approximately 20 weeks (5 months). This assumes the deficit is maintained consistently, which research shows is the primary variable — not the size of the deficit. A person maintaining a 400-calorie deficit for 20 weeks will achieve better results than someone who maintains a 700-calorie deficit for 8 weeks before giving up.</p>
    <p>It is also worth noting that scale weight rarely drops linearly. Water retention from increased exercise, hormonal fluctuations, dietary sodium, and muscle glycogen storage can mask fat loss for 1–3 weeks at a time. Tracking a 4-week rolling average of body weight, alongside progress photos and measurements, gives a more accurate picture of genuine fat loss progress than daily weigh-ins.</p>

    <h2 class="mt-5 mb-4" style="color:var(--primary-dark);">Calorie Deficit vs. Exercise: Which Burns More Fat?</h2>
    <p>Diet creates a far larger calorie deficit than exercise for most people. A 60-minute moderate jog burns approximately 400–600 calories — roughly equivalent to a single missed snack. Exercise is excellent for health, cardiovascular fitness, muscle preservation during a cut, and metabolic health, but it is a poor primary tool for creating a calorie deficit because it also increases appetite proportionally.</p>
    <p>The most effective approach combines a dietary deficit of 300–500 calories with 3–5 hours per week of exercise (2–3 resistance training sessions and 2–3 cardio sessions). This approach creates the deficit primarily through food, while exercise preserves or builds muscle, improves insulin sensitivity, and provides health benefits that dietary restriction alone cannot deliver.</p>

  </div>
</section>

<x-related-tools :tools="$relatedTools" heading="More Fitness Calculators" />


{{-- ── 7. SEO Block ──────────────────────────────────────────────────────────── --}}
<section class="ms-section-seo">
  <div class="container-xl">
    <div class="row justify-content-center">
      <div class="col-lg-8 ms-seo-body">
        <h2 class="mb-4 ms-seo-h2">Understanding Calorie Deficits: Beyond Simple Arithmetic</h2>
        <p>The "3,500 calories = 1 lb of fat" rule is a useful approximation but not a precise prediction. As you lose weight, your TDEE decreases because you are moving a lighter body and your body down-regulates energy expenditure through adaptive thermogenesis. This means the same 500-calorie deficit produces less loss over time — a phenomenon that explains why weight loss always slows as you approach your goal.</p>
        <h3 class="ms-seo-h3">Diet Breaks and Refeed Days</h3>
        <p>Periodic diet breaks — one to two weeks eating at TDEE maintenance after 6–8 weeks of deficit — have been shown in research to partially reverse adaptive thermogenesis and improve adherence. Refeed days (eating at maintenance for 1–2 days per week) have a smaller but real effect. Both strategies can improve long-term results by giving the body periodic recovery from the metabolic stress of sustained restriction.</p>
        <h3 class="ms-seo-h3">Body Recomposition: Losing Fat While Building Muscle</h3>
        <p>True body recomposition — simultaneously losing fat and gaining muscle — is possible but mainly occurs in specific circumstances: beginners who have never trained, people returning after a long break, individuals with significant excess body fat, and those using certain performance-enhancing substances. For most trained individuals, dedicated cut and bulk phases produce better body composition outcomes than trying to achieve both simultaneously.</p>
        <div class="mt-4 p-4 rounded-3 ms-note ms-note-green">
          <p style="margin:0; font-size:.85rem; color:#155724;"><strong>Disclaimer:</strong> This calculator provides estimates for informational purposes only and does not constitute medical or nutritional advice. Calorie needs vary significantly between individuals. Consult a registered dietitian or physician before undertaking a significant calorie deficit, especially if you have any medical conditions or a history of disordered eating.</p>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')
<script>
(function () {

  var currentUnit = 'metric';

  document.querySelectorAll('.cd-unit-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
      document.querySelectorAll('.cd-unit-btn').forEach(function (b) {
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
      document.getElementById('cdMetric').classList.toggle('d-none', currentUnit !== 'metric');
      document.getElementById('cdImperial').classList.toggle('d-none', currentUnit !== 'imperial');
      document.getElementById('results').classList.add('d-none');
    });
  });

  window.calcDeficit = function () {
    var sex      = document.getElementById('cdSex').value;
    var age      = parseFloat(document.getElementById('cdAge').value);
    var activity = parseFloat(document.getElementById('cdActivity').value);
    var rate     = parseFloat(document.getElementById('cdRate').value); // kg/week
    var heightCm, currentKg, goalKg;

    if (currentUnit === 'metric') {
      heightCm  = parseFloat(document.getElementById('cdHeightCm').value);
      currentKg = parseFloat(document.getElementById('cdCurrentKg').value);
      goalKg    = parseFloat(document.getElementById('cdGoalKg').value);
    } else {
      var ft  = parseFloat(document.getElementById('cdHeightFt').value) || 0;
      var ins = parseFloat(document.getElementById('cdHeightIn').value) || 0;
      heightCm  = (ft * 12 + ins) * 2.54;
      currentKg = parseFloat(document.getElementById('cdCurrentLbs').value) * 0.453592;
      goalKg    = parseFloat(document.getElementById('cdGoalLbs').value) * 0.453592;
    }

    if (!age || !heightCm || !currentKg || !goalKg || isNaN(rate)) {
      alert('Please fill in all required fields.');
      return;
    }
    if (goalKg >= currentKg) {
      alert('Goal weight must be less than current weight for a deficit calculation.');
      return;
    }

    // Mifflin-St Jeor BMR
    var bmr;
    if (sex === 'male') {
      bmr = (10 * currentKg) + (6.25 * heightCm) - (5 * age) + 5;
    } else {
      bmr = (10 * currentKg) + (6.25 * heightCm) - (5 * age) - 161;
    }
    var tdee = Math.round(bmr * activity);

    // Daily deficit from weekly rate: 1 kg = 7,700 cal
    var dailyDeficit = Math.round((rate * 7700) / 7);
    var targetCal    = Math.max(1200, tdee - dailyDeficit);
    var actualDeficit = tdee - targetCal;

    var totalKg  = currentKg - goalKg;
    var weeks    = Math.ceil(totalKg / rate);

    // Format
    var rateDisplay = rate + ' kg (' + (rate * 2.20462).toFixed(2) + ' lbs)/week';

    document.getElementById('cdTDEE').textContent     = tdee.toLocaleString() + ' cal';
    document.getElementById('cdDeficitDay').textContent = actualDeficit.toLocaleString() + ' cal';
    document.getElementById('cdTarget').textContent   = targetCal.toLocaleString();
    document.getElementById('cdWeeks').textContent    = weeks + ' weeks';
    document.getElementById('cdWeeklyLoss').textContent = rateDisplay;

    var warningEl = document.getElementById('cdWarning');
    if (actualDeficit > 1000) {
      warningEl.innerHTML = '⚠️ <strong>Warning:</strong> Your calculated deficit exceeds 1,000 calories per day. This is considered aggressive and risks significant muscle loss. Consider choosing a slower weekly loss rate or consult a healthcare professional.';
      warningEl.classList.remove('d-none');
    } else if (targetCal <= 1200 && sex === 'female') {
      warningEl.innerHTML = '⚠️ <strong>Note:</strong> Your target is at or near the minimum recommended intake of 1,200 calories for women. Ensure adequate protein and micronutrient intake, and consider consulting a registered dietitian.';
      warningEl.classList.remove('d-none');
    } else {
      warningEl.classList.add('d-none');
    }

    var resultsEl = document.getElementById('results');
    resultsEl.classList.remove('d-none');
    resultsEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  };

})();
</script>
@endsection
