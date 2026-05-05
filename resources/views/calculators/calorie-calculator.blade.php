@extends('layouts.app')

@section('title', 'Calorie Calculator — Daily Calorie Needs (TDEE) for Weight Loss & Gain | MindSnap')
@section('description', 'Free TDEE calorie calculator: find your total daily energy expenditure based on age, height, weight, sex, and activity level. Instant results. No signup.')
@section('canonical', config('app.url') . '/calorie-calculator')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "WebApplication",
  "name": "Calorie Calculator",
  "url": "{{ config('app.url') }}/calorie-calculator",
  "description": "Calculate your Total Daily Energy Expenditure (TDEE) and daily calorie needs based on your stats and activity level.",
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
    { "@@type": "ListItem", "position": 3, "name": "Calorie Calculator" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [
    { "@@type": "Question", "name": "What is TDEE and how is it calculated?",
      "acceptedAnswer": { "@@type": "Answer", "text": "TDEE stands for Total Daily Energy Expenditure — the total number of calories your body burns in a day. It is calculated by first estimating your Basal Metabolic Rate (the calories burned at rest) using the Harris-Benedict or Mifflin-St Jeor equation, then multiplying it by an activity factor that reflects how much you move. TDEE is the calorie intake at which your weight stays stable." } },
    { "@@type": "Question", "name": "How many calories should I eat to lose weight?",
      "acceptedAnswer": { "@@type": "Answer", "text": "To lose weight sustainably, aim for a calorie deficit of 300–500 calories below your TDEE. A 500-calorie daily deficit produces approximately 0.5 kg (1 lb) of fat loss per week, which is considered a safe and sustainable rate. Deficits larger than 1,000 calories per day risk significant muscle loss, micronutrient deficiencies, and metabolic adaptation." } },
    { "@@type": "Question", "name": "What is BMR (Basal Metabolic Rate)?",
      "acceptedAnswer": { "@@type": "Answer", "text": "BMR is the number of calories your body burns to maintain basic physiological functions at rest — breathing, circulation, cell production, and temperature regulation. It accounts for 60–75% of total daily calorie expenditure for most people. BMR decreases with age (roughly 1–2% per decade after 20) and is higher in people with more lean muscle mass." } },
    { "@@type": "Question", "name": "How many calories does a woman need per day?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Most adult women need between 1,600 and 2,400 calories per day, depending on age, height, weight, and activity level. Sedentary women in their 30s typically need around 1,800–2,000 calories. Active women or those doing significant exercise may need 2,200–2,600. The calorie calculator above gives you a personalised estimate based on your specific stats." } },
    { "@@type": "Question", "name": "How many calories should a man eat per day?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Most adult men need between 2,000 and 3,000 calories per day. A sedentary man in his 30s typically needs around 2,200–2,500 calories to maintain weight. Very active men — those doing intense daily exercise — may need 3,000–4,000 calories. Use the calculator above with your actual stats and activity level for a precise personalised estimate." } },
    { "@@type": "Question", "name": "What activity level should I choose?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Choose Sedentary if you have a desk job and do little formal exercise. Lightly Active suits 1–3 days of light exercise per week. Moderately Active fits 3–5 days of moderate exercise. Very Active is for 6–7 days of hard exercise. Extra Active is for athletes, physical labourers, or those training twice a day. Most people underestimate their activity level — if in doubt, choose one level lower and adjust based on results." } },
    { "@@type": "Question", "name": "Is a 500 calorie deficit safe?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes — a 500-calorie daily deficit is widely considered safe and effective for most healthy adults. It produces approximately 0.45 kg (1 lb) of fat loss per week and is large enough to drive consistent results without triggering significant metabolic adaptation or muscle loss. It should be achieved primarily through moderate dietary reduction, with exercise used to improve health rather than simply burn calories." } },
    { "@@type": "Question", "name": "How many calories do I need to build muscle?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Building muscle requires a calorie surplus above your TDEE — typically 200–500 extra calories per day for most natural trainees. A modest surplus of 300 calories per day minimises fat gain while providing enough energy for muscle protein synthesis. Combined with progressive resistance training and adequate protein (1.6–2.2 g per kg of bodyweight), this produces lean muscle gains of approximately 0.5–1 kg per month for beginners." } }
  ]
}
</script>
@endsection

@php
$faqs = [
  ['q' => 'What is TDEE and how is it calculated?',
             'a' => 'TDEE stands for Total Daily Energy Expenditure — the total calories your body burns in a day including all activity. It is calculated by first estimating your Basal Metabolic Rate (calories burned at rest) using the Harris-Benedict or Mifflin-St Jeor formula, then multiplying by an activity factor. TDEE is the calorie intake at which your weight stays perfectly stable. Eating above TDEE creates a surplus that promotes muscle and fat gain; eating below creates a deficit that drives fat loss.'],
  ['q' => 'How many calories should I eat to lose weight?',
             'a' => 'For sustainable fat loss, aim for a 300–500 calorie daily deficit below your TDEE. A 500-calorie deficit produces approximately 0.45 kg (1 lb) of fat loss per week. This rate is considered safe for most healthy adults and is slow enough to preserve muscle mass. Avoid deficits larger than 750–1,000 calories per day — they trigger metabolic adaptation (your body burning fewer calories) and significantly increase muscle loss, making long-term success much harder.'],
  ['q' => 'What is BMR (Basal Metabolic Rate)?',
             'a' => 'BMR is the number of calories your body burns at complete rest — the energy required just to keep you alive: breathing, circulation, cell production, digestion, and temperature regulation. It accounts for 60–75% of total calorie expenditure for sedentary people. BMR is higher in people with more lean muscle mass (muscle burns roughly 6 cal/lb/day vs 2 cal/lb/day for fat) and decreases about 1–2% per decade after age 20 due to age-related muscle loss.'],
  ['q' => 'How many calories does a woman need per day?',
             'a' => 'Most adult women need between 1,600 and 2,400 calories per day, depending on age, height, weight, and activity level. A sedentary woman in her 30s at average height and weight typically needs around 1,800–2,000 calories. Active women doing 5+ hours of exercise per week may need 2,200–2,600. Pregnant women need an additional 300–500 calories daily in the second and third trimester. The personalised calculator above provides a more precise estimate.'],
  ['q' => 'How many calories should a man eat per day?',
             'a' => 'Most adult men need between 2,000 and 3,000 calories per day. A sedentary man in his 30s at average height and weight typically needs around 2,200–2,500 calories to maintain weight. Men doing significant exercise — 5+ sessions per week — may need 2,800–3,500. Elite endurance athletes or those in physical labour can exceed 4,000 calories. Individual needs vary widely; use the calculator above with your actual stats for a personalised target.'],
  ['q' => 'What activity level should I choose?',
             'a' => 'Select Sedentary if you have a desk job and do little formal exercise outside of daily movement. Lightly Active suits one to three days of moderate exercise per week. Moderately Active fits three to five days of deliberate exercise. Very Active applies to six or seven days of hard training. Extra Active is reserved for athletes training twice daily or people in intensive manual labour. Research consistently shows most people underestimate their sedentariness — if unsure, go one level below your instinct and adjust based on results over 2–3 weeks.'],
  ['q' => 'Is a 500 calorie deficit safe?',
             'a' => 'Yes — a 500-calorie daily deficit is widely considered safe and effective for most healthy adults without underlying medical conditions. It drives approximately 0.45 kg (1 lb) of fat loss per week while largely preserving muscle mass, especially when combined with sufficient protein intake (1.6 g per kg bodyweight) and resistance training. The deficit should come primarily from dietary reduction, not extreme exercise, to avoid chronic energy availability problems that impair hormonal health.'],
  ['q' => 'How many calories do I need to build muscle?',
             'a' => 'Effective muscle building requires a modest calorie surplus above TDEE — typically 200–500 calories per day. A surplus of 300 calories minimises fat gain while providing adequate energy for muscle protein synthesis. Without sufficient calories, the body cannot build new tissue even with heavy training. Combined with progressive resistance training and protein intake of 1.6–2.2 g per kg, a 300-calorie surplus supports natural muscle gains of approximately 0.5–1 kg per month for beginners, and 0.25–0.5 kg per month for intermediate trainees.'],
];

$relatedTools = [
  ['icon' => '💪', 'name' => 'BMI Calculator', 'slug' => 'bmi-calculator', 'desc' => 'Calculate your body mass index and healthy weight range.'],
  ['icon' => '📉', 'name' => 'Calorie Deficit Calculator', 'slug' => 'calorie-deficit-calculator', 'desc' => 'Set a goal weight and get your daily calorie target and timeline.'],
  ['icon' => '🥗', 'name' => 'Macro Calculator', 'slug' => 'macro-calculator', 'desc' => 'Get personalised protein, carb, and fat targets for your goal.'],
  ['icon' => '🥩', 'name' => 'Protein Calculator', 'slug' => 'protein-calculator', 'desc' => 'Find your daily protein target for muscle gain, fat loss, or maintenance.'],
  ['icon' => '📐', 'name' => 'Body Fat Calculator', 'slug' => 'body-fat-calculator', 'desc' => 'Estimate body fat percentage using circumference measurements.'],
  ['icon' => '⚖️', 'name' => 'Ideal Weight Calculator', 'slug' => 'ideal-weight-calculator', 'desc' => 'Find your ideal weight range based on height, sex, and frame size.'],
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
          ['url' => '', 'name' => 'Calorie Calculator'],
        ]"/>

        <h1 class="mb-2 ms-hero-title">
          🔥 Calorie Calculator — Find Your Daily Calorie Needs (TDEE)
        </h1>
        <p class="ms-hero-desc">
          Calculate your Total Daily Energy Expenditure and daily calorie target for weight loss, maintenance, or muscle gain.
        </p>

        {{-- ── Tool Card ────────────────────────────────────────────────────── --}}
        <div class="card border-0 mb-n4 ms-tool-card">
          <div class="card-body p-4 p-md-5">

            {{-- Unit toggle --}}
            <div class="d-flex gap-2 mb-4" role="group" aria-label="Unit system">
              <button class="btn flex-fill cal-unit-btn active" data-unit="metric"
                      style="border-radius:8px; font-weight:600; font-size:.88rem; background:var(--fitness); color:#fff; border:none;">
                Metric (kg / cm)
              </button>
              <button class="btn flex-fill cal-unit-btn" data-unit="imperial"
                      style="border-radius:8px; font-weight:600; font-size:.88rem; background:#f8f9fa; color:#555; border:1px solid #e0e0e0;">
                Imperial (lbs / ft)
              </button>
            </div>

            <div class="row g-3 mb-3">
              <div class="col-6">
                <label for="calSex" class="form-label fw-600">Sex</label>
                <select id="calSex" class="form-select">
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                </select>
              </div>
              <div class="col-6">
                <label for="calAge" class="form-label fw-600">Age (years)</label>
                <input type="number" id="calAge" class="form-control" placeholder="e.g. 30" min="15" max="100">
              </div>
            </div>

            {{-- Metric height/weight --}}
            <div id="calMetric">
              <div class="row g-3 mb-3">
                <div class="col-6">
                  <label for="calHeightCm" class="form-label fw-600">Height (cm)</label>
                  <input type="number" id="calHeightCm" class="form-control" placeholder="e.g. 175" min="100" max="250">
                </div>
                <div class="col-6">
                  <label for="calWeightKg" class="form-label fw-600">Weight (kg)</label>
                  <input type="number" id="calWeightKg" class="form-control" placeholder="e.g. 70" min="20" max="300">
                </div>
              </div>
            </div>

            {{-- Imperial height/weight --}}
            <div id="calImperial" class="d-none">
              <div class="mb-3">
                <label class="form-label fw-600">Height</label>
                <div class="row g-2">
                  <div class="col-6"><input type="number" id="calHeightFt" class="form-control" placeholder="Feet" min="3" max="8"></div>
                  <div class="col-6"><input type="number" id="calHeightIn" class="form-control" placeholder="Inches" min="0" max="11"></div>
                </div>
              </div>
              <div class="mb-3">
                <label for="calWeightLbs" class="form-label fw-600">Weight (lbs)</label>
                <input type="number" id="calWeightLbs" class="form-control" placeholder="e.g. 154" min="44" max="660">
              </div>
            </div>

            <div class="mb-3">
              <label for="calActivity" class="form-label fw-600">Activity Level</label>
              <select id="calActivity" class="form-select">
                <option value="1.2">Sedentary (desk job, little exercise)</option>
                <option value="1.375">Lightly Active (1–3 days exercise/week)</option>
                <option value="1.55" selected>Moderately Active (3–5 days/week)</option>
                <option value="1.725">Very Active (6–7 days hard exercise/week)</option>
                <option value="1.9">Extra Active (athlete / physical job)</option>
              </select>
            </div>

            <div class="mb-4">
              <label for="calGoal" class="form-label fw-600">Goal</label>
              <select id="calGoal" class="form-select">
                <option value="lose">Lose Weight (−500 cal/day)</option>
                <option value="maintain" selected>Maintain Weight</option>
                <option value="gain">Gain Muscle (+300 cal/day)</option>
              </select>
            </div>

            <button class="btn btn-cta w-100" onclick="calcCalories()" style="font-size:1rem;">
              Calculate Calories →
            </button>

            {{-- Results --}}
            <div id="results" class="mt-4 d-none">
              <div style="height:1px; background:#f0f0f0; margin-bottom:20px;"></div>

              <div class="row g-3 mb-4 text-center">
                <div class="col-6">
                  <div style="background:#f0fff4; border-radius:12px; padding:16px 10px;">
                    <div id="calBMR" style="font-size:1.8rem; font-weight:700; color:var(--green-text);"></div>
                    <div style="font-size:.75rem; color:#555; margin-top:4px;">BMR (calories at rest)</div>
                  </div>
                </div>
                <div class="col-6">
                  <div style="background:#e8f4fd; border-radius:12px; padding:16px 10px;">
                    <div id="calTDEE" style="font-size:1.8rem; font-weight:700; color:var(--teal-text);"></div>
                    <div style="font-size:.75rem; color:#555; margin-top:4px;">TDEE (maintenance)</div>
                  </div>
                </div>
              </div>

              <div class="p-4 rounded-3 mb-4 text-center" style="background:var(--primary-dark); color:#fff;">
                <div style="font-size:.8rem; opacity:.7; margin-bottom:6px;" id="calGoalLabel"></div>
                <div id="calTarget" style="font-size:2.4rem; font-weight:700;"></div>
                <div style="font-size:.8rem; opacity:.7; margin-top:4px;">calories per day</div>
              </div>

              <div class="mb-3">
                <div class="fw-600 mb-2" style="font-size:.88rem; color:var(--primary-dark);">Estimated Macronutrient Split</div>
                <div id="calMacros" class="row g-2 text-center"></div>
              </div>
            </div>

          </div>
        </div>
      </div>

      {{-- Right: Quick facts --}}
      <div class="col-lg-5 d-none d-lg-block" style="padding-top:10px;">
        <div class="ms-facts-wrap">
          <h3 class="ms-facts-title">Quick Calorie Facts</h3>
          @foreach([
            ['2,000–2,500', 'Average adult daily calorie need'],
            ['500 cal/day', 'Deficit needed to lose 1 lb per week'],
            ['25–30%',      'Calories from protein recommended'],
            ['1.2–1.9×',   'BMR multiplier for activity level'],
            ['1919',        'Year Harris-Benedict equation was published'],
          ] as [$stat, $label])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div class="ms-fact-pill ms-fact-pill-fitness">{{ $stat }}</div>
            <div class="ms-fact-label">{{ $label }}</div>
          </div>
          @endforeach
          <p class="ms-fact-source">Sources: Harris & Benedict (1919), Mifflin et al. (1990)</p>
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
        <h2 class="mb-4">How the Harris-Benedict Equation Calculates Your BMR</h2>
        <p>Your Basal Metabolic Rate (BMR) is the number of calories your body burns at complete rest to sustain life — breathing, circulation, cell production, and temperature regulation. The Harris-Benedict equation, first published in 1919 and revised in 1984, estimates BMR from your sex, age, height, and weight:</p>
        <div class="p-3 mb-3 rounded-3" style="background:#f8f9fa; border-left:4px solid var(--fitness); font-size:.85rem; color:var(--primary-dark);">
          <strong>Male BMR</strong> = 88.362 + (13.397 × kg) + (4.799 × cm) − (5.677 × age)<br>
          <strong>Female BMR</strong> = 447.593 + (9.247 × kg) + (3.098 × cm) − (4.330 × age)
        </div>
        <p>Your TDEE is calculated by multiplying your BMR by an activity factor. This gives your calorie maintenance level — the intake at which your weight stays stable. Eating below TDEE creates a deficit; eating above creates a surplus.</p>
      </div>
      <div class="col-lg-7">
        <div class="p-4 rounded-3 ms-data-box">
          <p class="fw-600 mb-3" style="color:var(--primary-dark); font-size:.88rem; text-transform:uppercase; letter-spacing:.5px;">Activity Level Multipliers</p>
          @foreach([
            ['1.2×',   'Sedentary',        'Desk job, no formal exercise, mostly sitting'],
            ['1.375×', 'Lightly Active',   '1–3 days of light exercise or sport per week'],
            ['1.55×',  'Moderately Active','3–5 days of moderate exercise per week'],
            ['1.725×', 'Very Active',      '6–7 days of hard training or physical work'],
            ['1.9×',   'Extra Active',     'Twice-daily training or very heavy physical labour'],
          ] as [$mult, $level, $desc])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div style="background:var(--fitness); color:#fff; border-radius:6px; padding:4px 10px; font-size:.82rem; font-weight:700; min-width:50px; text-align:center; flex-shrink:0; margin-top:2px;">{{ $mult }}</div>
            <div>
              <div class="fw-600" style="font-size:.87rem; color:#1a1a2e;">{{ $level }}</div>
              <div style="font-size:.8rem; color:#666; line-height:1.5;">{{ $desc }}</div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ── 3. Data table ─────────────────────────────────────────────────────────── --}}
<section class="ms-section-muted">
  <div class="container-xl">
    <div class="text-center mb-5">
      <h2>Estimated Daily Calorie Needs by Age and Activity</h2>
      <p class="text-muted" style="max-width:520px; margin:auto;">Based on average height and weight. Use the calculator above for your personalised figure.</p>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="table-responsive">
          <table class="table table-bordered" style="border-radius:12px; overflow:hidden; font-size:.88rem;">
            <thead class="ms-table-head">
              <tr>
                <th style="padding:12px 16px;">Age Group</th>
                <th style="padding:12px 16px;">Men — Sedentary</th>
                <th style="padding:12px 16px;">Men — Active</th>
                <th style="padding:12px 16px;">Women — Sedentary</th>
                <th style="padding:12px 16px;">Women — Active</th>
              </tr>
            </thead>
            <tbody>
              @foreach([
                ['19–30', '2,400', '3,000', '1,800', '2,400'],
                ['31–50', '2,200', '2,800', '1,800', '2,200'],
                ['51–70', '2,000', '2,600', '1,600', '2,000'],
                ['71+',   '2,000', '2,400', '1,600', '2,000'],
              ] as [$age, $ms, $ma, $ws, $wa])
              <tr>
                <td style="padding:10px 16px; font-weight:600;">{{ $age }}</td>
                <td style="padding:10px 16px;">{{ $ms }} cal</td>
                <td style="padding:10px 16px;">{{ $ma }} cal</td>
                <td style="padding:10px 16px;">{{ $ws }} cal</td>
                <td style="padding:10px 16px;">{{ $wa }} cal</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <p style="font-size:.8rem; color:#888; margin-top:12px;">Source: Dietary Guidelines for Americans 2020–2025, USDA.</p>
      </div>
    </div>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="faqAccordion" />


{{-- ── 5. Long-tail Keyword Sections ───────────────────────────────────────── --}}
<section class="ms-section-accent">
  <div class="container ms-longtail">

    <h2 class="mb-4" style="color:var(--primary-dark);">Calorie Calculator for Weight Loss — How Big a Deficit Is Safe?</h2>
    <p>The most common weight loss mistake is creating a deficit that is too large. A 1,000+ calorie daily deficit feels faster in theory, but research consistently shows it accelerates muscle loss, triggers metabolic adaptation (where your body lowers its resting energy expenditure), and leads to rebound weight gain in the majority of cases within two years.</p>
    <p>A well-designed deficit of 400–600 calories — roughly 20–25% below TDEE — produces steady fat loss while preserving muscle when combined with adequate protein and resistance training. At this rate, someone with 10 kg to lose would reach their goal in approximately 20–25 weeks. This is not slow — it is the speed at which fat loss sticks permanently.</p>

    <h2 class="mt-5 mb-4" style="color:var(--primary-dark);">TDEE Calculator for Women — Why Calorie Needs Differ by Sex</h2>
    <p>Women's calorie needs are genuinely lower than men's at equivalent height, weight, and activity — not due to any metabolic disadvantage, but because women typically carry proportionally more body fat and less lean muscle mass. Since muscle tissue burns approximately three times more calories at rest than fat tissue, the difference in body composition directly reduces TDEE.</p>
    <p>Additionally, women's calorie needs fluctuate across the menstrual cycle by approximately 100–300 calories per day, rising in the luteal phase (after ovulation) as progesterone increases resting metabolic rate. This is a well-documented physiological phenomenon and is one reason why appetite, hunger, and energy naturally vary across the month. Tracking calories rigidly without accounting for this cycle can be counterproductive.</p>

    <h2 class="mt-5 mb-4" style="color:var(--primary-dark);">Calorie Calculator for Muscle Gain — Eating in a Surplus</h2>
    <p>Building muscle is a slow, energetically expensive process. Even in optimal conditions — heavy resistance training, ideal nutrition, adequate sleep — a natural trainee can only build 0.5–2 kg of muscle per month. This means the energy surplus required is modest: 200–500 extra calories per day is sufficient.</p>
    <p>A common mistake is "dirty bulking" — eating in a large surplus of 700–1,000+ calories per day. While it accelerates scale weight gain, a significant portion of that gain is fat, not muscle. This requires an extended cut phase to reverse, often resulting in net muscle gain no greater than a more modest approach. A "lean bulk" of +300 calories, high protein, and progressive training maximises the muscle-to-fat ratio of weight gained.</p>

  </div>
</section>

<x-related-tools :tools="$relatedTools" heading="More Fitness Calculators" />


{{-- ── 7. SEO Block ──────────────────────────────────────────────────────────── --}}
<section class="ms-section-seo">
  <div class="container-xl">
    <div class="row justify-content-center">
      <div class="col-lg-8 ms-seo-body">
        <h2 class="mb-4 ms-seo-h2">Calorie Calculator: The Science Behind Energy Balance</h2>
        <p>Calorie balance — the relationship between energy consumed and energy expended — is the fundamental driver of body weight change. While the "calories in, calories out" model is frequently criticised as oversimplistic (and it is, in certain nuanced contexts), decades of controlled metabolic ward research confirm that no one has gained or lost weight in a genuine calorie balance. The debate is not about whether energy balance matters, but about the many factors that influence it.</p>
        <h3 class="ms-seo-h3">Why Calorie Tracking Is Harder Than It Looks</h3>
        <p>Food labelling regulations in many countries allow a ±20% error margin on stated calorie counts. Restaurant meals are consistently under-reported in studies, sometimes by 40–100%. Most people also underestimate portion sizes. These real-world inaccuracies mean your actual intake may differ significantly from tracked intake — one reason why self-reported dietary data is notoriously unreliable in nutrition research. Using calorie counts as estimates — not precise figures — is the right frame.</p>
        <h3 class="ms-seo-h3">Non-Exercise Activity Thermogenesis (NEAT)</h3>
        <p>The most variable component of TDEE is NEAT — all the non-exercise movement in a day: fidgeting, walking, standing, housework, gesturing. Research by Dr. James Levine at the Mayo Clinic found NEAT varies by up to 2,000 calories per day between individuals of similar size. When people overeat, NEAT often unconsciously rises; when they undereat, it falls. This explains why two people with the same TDEE calculation respond differently to the same deficit — and why the calculator's output is a starting point, not a final answer.</p>
        <div class="mt-4 p-4 rounded-3 ms-note ms-note-green">
          <p style="margin:0; font-size:.85rem; color:#155724;"><strong>Disclaimer:</strong> This calorie calculator provides an estimate based on established equations and is intended for general informational use. Individual calorie needs vary. Consult a registered dietitian or physician before making significant changes to your diet, especially if you have a medical condition.</p>
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

  document.querySelectorAll('.cal-unit-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
      document.querySelectorAll('.cal-unit-btn').forEach(function (b) {
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
      document.getElementById('calMetric').classList.toggle('d-none', currentUnit !== 'metric');
      document.getElementById('calImperial').classList.toggle('d-none', currentUnit !== 'imperial');
      document.getElementById('results').classList.add('d-none');
    });
  });

  window.calcCalories = function () {
    var sex = document.getElementById('calSex').value;
    var age = parseFloat(document.getElementById('calAge').value);
    var activity = parseFloat(document.getElementById('calActivity').value);
    var goal = document.getElementById('calGoal').value;
    var heightCm, weightKg;

    if (currentUnit === 'metric') {
      heightCm = parseFloat(document.getElementById('calHeightCm').value);
      weightKg = parseFloat(document.getElementById('calWeightKg').value);
    } else {
      var ft = parseFloat(document.getElementById('calHeightFt').value) || 0;
      var ins = parseFloat(document.getElementById('calHeightIn').value) || 0;
      heightCm = (ft * 12 + ins) * 2.54;
      weightKg = parseFloat(document.getElementById('calWeightLbs').value) * 0.453592;
    }

    if (!age || !heightCm || !weightKg || isNaN(activity)) {
      alert('Please fill in all required fields.');
      return;
    }

    // Harris-Benedict revised BMR
    var bmr;
    if (sex === 'male') {
      bmr = 88.362 + (13.397 * weightKg) + (4.799 * heightCm) - (5.677 * age);
    } else {
      bmr = 447.593 + (9.247 * weightKg) + (3.098 * heightCm) - (4.330 * age);
    }
    bmr = Math.round(bmr);
    var tdee = Math.round(bmr * activity);

    var targetCal, goalLabel;
    if (goal === 'lose') {
      targetCal = tdee - 500;
      goalLabel = 'Calories for weight loss (−500/day)';
    } else if (goal === 'gain') {
      targetCal = tdee + 300;
      goalLabel = 'Calories for muscle gain (+300/day)';
    } else {
      targetCal = tdee;
      goalLabel = 'Calories to maintain weight';
    }
    targetCal = Math.max(1200, targetCal);

    // Macros for maintenance goal
    var proteinPct = goal === 'lose' ? 0.35 : (goal === 'gain' ? 0.30 : 0.30);
    var carbPct    = goal === 'lose' ? 0.35 : (goal === 'gain' ? 0.45 : 0.40);
    var fatPct     = 1 - proteinPct - carbPct;

    var proteinCal = Math.round(targetCal * proteinPct);
    var carbCal    = Math.round(targetCal * carbPct);
    var fatCal     = Math.round(targetCal * fatPct);
    var proteinG   = Math.round(proteinCal / 4);
    var carbG      = Math.round(carbCal / 4);
    var fatG       = Math.round(fatCal / 9);

    document.getElementById('calBMR').textContent  = bmr.toLocaleString();
    document.getElementById('calTDEE').textContent = tdee.toLocaleString();
    document.getElementById('calTarget').textContent = targetCal.toLocaleString();
    document.getElementById('calGoalLabel').textContent = goalLabel;

    document.getElementById('calMacros').innerHTML =
      '<div class="col-4"><div style="background:#e8f5e9; border-radius:10px; padding:12px 6px;">' +
        '<div style="font-size:1.3rem; font-weight:700; color:var(--green-text);">' + proteinG + 'g</div>' +
        '<div style="font-size:.72rem; color:#555; margin-top:2px;">Protein<br>' + proteinCal + ' cal</div>' +
      '</div></div>' +
      '<div class="col-4"><div style="background:#fff3e0; border-radius:10px; padding:12px 6px;">' +
        '<div style="font-size:1.3rem; font-weight:700; color:#e65100;">' + carbG + 'g</div>' +
        '<div style="font-size:.72rem; color:#555; margin-top:2px;">Carbs<br>' + carbCal + ' cal</div>' +
      '</div></div>' +
      '<div class="col-4"><div style="background:#e3f2fd; border-radius:10px; padding:12px 6px;">' +
        '<div style="font-size:1.3rem; font-weight:700; color:var(--teal-text);">' + fatG + 'g</div>' +
        '<div style="font-size:.72rem; color:#555; margin-top:2px;">Fat<br>' + fatCal + ' cal</div>' +
      '</div></div>';

    var resultsEl = document.getElementById('results');
    resultsEl.classList.remove('d-none');
    resultsEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  };

})();
</script>
@endsection
