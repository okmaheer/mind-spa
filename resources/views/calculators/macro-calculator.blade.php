@extends('layouts.app')

@section('title', 'Macro Calculator — Daily Protein, Carb & Fat Targets for Your Goal | MindSnap')
@section('description', 'Free macro calculator: get personalized protein, carbohydrate, and fat targets based on your weight, goal, and activity level. Instant macro split. No signup.')
@section('canonical', config('app.url') . '/macro-calculator')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "WebApplication",
  "name": "Macro Calculator",
  "url": "{{ config('app.url') }}/macro-calculator",
  "description": "Calculate personalised daily macronutrient targets — protein, carbohydrates, and fat — based on your body stats and fitness goal.",
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
    { "@@type": "ListItem", "position": 3, "name": "Macro Calculator" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [
    { "@@type": "Question", "name": "What are macros (macronutrients)?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Macronutrients are the three primary nutrients that provide calories: protein (4 cal/g), carbohydrates (4 cal/g), and fat (9 cal/g). Every food you eat contains some combination of these three. Tracking macros goes beyond tracking total calories — it ensures you get the right balance of nutrients for your specific goal, whether that's fat loss, muscle building, or athletic performance." } },
    { "@@type": "Question", "name": "How much protein do I need per day?",
      "acceptedAnswer": { "@@type": "Answer", "text": "For sedentary adults, the minimum is 0.8 g per kg of bodyweight. For active individuals and those wanting to maintain muscle while losing fat, 1.2–1.6 g per kg is more appropriate. For muscle building, the evidence supports 1.6–2.2 g per kg as the optimal range. Most research finds diminishing returns above 2.2 g per kg for natural trainees, though there is no evidence of harm from higher intakes in healthy people." } },
    { "@@type": "Question", "name": "What is the best macro split for fat loss?",
      "acceptedAnswer": { "@@type": "Answer", "text": "For fat loss, a higher-protein split is consistently supported by research. A common effective split is 35–40% protein, 30–35% carbohydrates, and 25–30% fat. The high protein preserves muscle mass in a deficit and increases satiety. The moderate fat intake supports hormonal function. Carbohydrates fuel exercise performance. The exact percentages matter less than getting sufficient protein — prioritise this above all other macro targets." } },
    { "@@type": "Question", "name": "What macros should I eat to build muscle?",
      "acceptedAnswer": { "@@type": "Answer", "text": "For muscle building, aim for a calorie surplus with a macro split of approximately 30–35% protein, 40–50% carbohydrates, and 20–25% fat. Carbohydrates are particularly important for muscle gain — they fuel resistance training sessions (the primary driver of muscle growth) and replenish muscle glycogen for recovery. Protein targets should be 1.6–2.2 g per kg of bodyweight. The calorie surplus should be modest: 200–400 calories above TDEE to minimise fat gain." } },
    { "@@type": "Question", "name": "Do carbohydrates make you fat?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Carbohydrates do not inherently cause fat gain — excess total calories do. Carbohydrates are stored as glycogen in the liver and muscles (approximately 400–500 g total storage capacity). Only when glycogen stores are full does significant conversion of carbohydrate to fat (de novo lipogenesis) occur, and this requires very large amounts of carbohydrate consumed consistently above energy needs. The low-carb diet research shows that weight loss from carbohydrate restriction is primarily from initial water and glycogen loss, not accelerated fat loss when calories are matched." } },
    { "@@type": "Question", "name": "How many grams of fat per day is healthy?",
      "acceptedAnswer": { "@@type": "Answer", "text": "General guidelines recommend that 20–35% of total calories come from fat. For a 2,000-calorie diet, this equates to approximately 44–78 grams of fat per day. Fat is essential — it supports hormone production (including testosterone and estrogen), fat-soluble vitamin absorption (A, D, E, K), brain function, and cell membrane integrity. Going below 15% of calories from fat for extended periods can impair hormonal health, particularly in women." } },
    { "@@type": "Question", "name": "What is a keto macro split?",
      "acceptedAnswer": { "@@type": "Answer", "text": "A ketogenic macro split is typically 70–75% fat, 20–25% protein, and only 5% carbohydrates (approximately 20–50 g of carbs per day). This severe carbohydrate restriction forces the liver to produce ketone bodies from fat as an alternative fuel. Ketosis occurs when liver glycogen is depleted, typically after 2–4 days of very low carbohydrate intake. Keto can be effective for fat loss and has specific medical applications, but evidence for superior long-term outcomes over other calorie-matched diets is limited." } },
    { "@@type": "Question", "name": "Should I count macros or just calories?",
      "acceptedAnswer": { "@@type": "Answer", "text": "For most people, tracking total calories is sufficient for weight management, as overall energy balance is the primary determinant of weight change. Tracking macros adds value when you have specific body composition goals — particularly muscle building or fat loss while preserving muscle — or when you want to ensure adequate protein, which has the greatest impact on satiety and muscle retention in a deficit. If macro tracking feels overwhelming, prioritise hitting your protein target and let total calories guide the rest." } }
  ]
}
</script>
@endsection

@php
$faqs = [
  ['q' => 'What are macros (macronutrients)?',
             'a' => 'Macronutrients are the three major classes of nutrients that provide dietary energy: protein (4 cal/g), carbohydrates (4 cal/g), and fat (9 cal/g). Every food you eat contains some combination of these three. Unlike micronutrients (vitamins and minerals), which are needed in small amounts, macronutrients are needed in large quantities and make up the bulk of your dietary intake. Tracking macros goes beyond simply counting total calories — it ensures your calorie intake has the right composition for your specific goal.'],
  ['q' => 'How much protein do I need per day?',
             'a' => 'The minimum daily protein requirement for sedentary adults is 0.8 g per kg of bodyweight (WHO/DRI). For active individuals, muscle preservation during fat loss, and general health, 1.2–1.6 g per kg is more appropriate. For maximising muscle building with resistance training, the evidence supports 1.6–2.2 g per kg of bodyweight as the optimal range. Most research finds no additional muscle-building benefit above 2.2 g per kg for natural trainees, though higher intakes are not harmful for healthy individuals with adequate kidney function.'],
  ['q' => 'What is the best macro split for fat loss?',
             'a' => 'For fat loss, prioritising protein is the most evidence-backed strategy. A higher-protein split of 35–40% protein, 30–35% carbohydrates, and 25–30% fat is commonly used and well-supported by research. High protein intake increases satiety (reducing hunger in a deficit), preserves lean muscle mass (maintaining metabolic rate), and has the highest thermic effect of any macronutrient (burning 25–30% of its calories in digestion). The carbohydrate and fat split within the remaining calories is largely a matter of personal preference and dietary tolerance.'],
  ['q' => 'What macros should I eat to build muscle?',
             'a' => 'For muscle building, aim for a calorie surplus with a macro split of approximately 30–35% protein (1.6–2.2 g per kg bodyweight), 45–50% carbohydrates, and 20–25% fat. Carbohydrates are particularly valuable for muscle gain — they are the primary fuel for resistance training, the anabolic stimulus for muscle growth. They also drive insulin secretion, which shuttles nutrients into muscle cells post-workout and reduces muscle protein breakdown. The calorie surplus should be modest: 200–400 above TDEE minimises fat gain while providing the energetic substrate for muscle protein synthesis.'],
  ['q' => 'Do carbohydrates make you fat?',
             'a' => 'Carbohydrates do not inherently cause fat storage — excess total calorie intake does. Dietary carbohydrates are preferentially stored as muscle and liver glycogen (capacity approximately 400–500 g total). Conversion of carbohydrates to fat (de novo lipogenesis) requires glycogen stores to be completely full and a significant calorie surplus — it does not readily occur during normal eating patterns. The weight loss commonly seen on low-carb diets in the first 1–2 weeks is primarily water and glycogen loss (each gram of glycogen holds approximately 3 g of water), not accelerated fat loss.'],
  ['q' => 'How many grams of fat per day is healthy?',
             'a' => 'General nutrition guidelines recommend that 20–35% of total daily calories come from fat. For a 2,000-calorie diet, this equates to 44–78 grams of fat per day. Fat is nutritionally essential — it produces steroid hormones (including testosterone, estrogen, and cortisol), enables absorption of fat-soluble vitamins A, D, E, and K, maintains cell membrane integrity, and provides essential fatty acids (omega-3 and omega-6) that the body cannot synthesise. Chronically eating below 20% fat from calories for extended periods can impair hormonal health and reduce fat-soluble vitamin absorption.'],
  ['q' => 'What is a keto macro split?',
             'a' => 'A ketogenic macro split is typically 70–75% fat, 20–25% protein, and only 5% carbohydrates — equivalent to approximately 20–50 g of carbs per day. This severe carbohydrate restriction depletes liver and muscle glycogen within 2–4 days, at which point the liver begins producing ketone bodies from fat as an alternative fuel source. Ketosis is a metabolic state, not a specific weight loss mechanism — when calories are matched, keto diets produce similar long-term fat loss to other approaches. Keto has specific medical applications (epilepsy management, type 2 diabetes) and may suit people with strong preferences for high-fat foods.'],
  ['q' => 'Should I count macros or just calories?',
             'a' => 'For general weight management, counting total calories is sufficient. For specific body composition goals — particularly preserving or building muscle while controlling body fat — macro tracking provides significant additional benefit. At minimum, tracking protein ensures you hit your muscle-preservation target. Research consistently shows that protein intake is the macro most strongly associated with favourable body composition changes, while total calorie balance drives weight change. A practical middle ground: track protein and total calories, and eat a balanced diet for the remaining calories without obsessing over precise carb and fat splits.'],
];

$relatedTools = [
  ['icon' => '🔥', 'name' => 'Calorie Calculator', 'slug' => 'calorie-calculator', 'desc' => 'Find your TDEE and daily calorie needs by activity level.'],
  ['icon' => '📉', 'name' => 'Calorie Deficit Calculator', 'slug' => 'calorie-deficit-calculator', 'desc' => 'Calculate your fat loss calorie target and projected timeline.'],
  ['icon' => '🥩', 'name' => 'Protein Calculator', 'slug' => 'protein-calculator', 'desc' => 'Get a precise daily protein target based on your goal.'],
  ['icon' => '💪', 'name' => 'BMI Calculator', 'slug' => 'bmi-calculator', 'desc' => 'Calculate your body mass index and healthy weight range.'],
  ['icon' => '📐', 'name' => 'Body Fat Calculator', 'slug' => 'body-fat-calculator', 'desc' => 'Estimate your body fat percentage using body measurements.'],
  ['icon' => '⚖️', 'name' => 'Ideal Weight Calculator', 'slug' => 'ideal-weight-calculator', 'desc' => 'Find your ideal weight range for your height and frame.'],
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
            <li class="breadcrumb-item active">Macro Calculator</li>
          </ol>
        </nav>

        <h1 class="mb-2 ms-hero-title">
          🥗 Macro Calculator — Daily Protein, Carbs &amp; Fat for Your Goal
        </h1>
        <p class="ms-hero-desc">
          Get your personalised macronutrient targets — protein, carbohydrates, and fat in grams — based on your body stats and fitness goal.
        </p>

        {{-- ── Tool Card ────────────────────────────────────────────────────── --}}
        <div class="card border-0 mb-n4 ms-tool-card">
          <div class="card-body p-4 p-md-5">

            {{-- Unit toggle --}}
            <div class="d-flex gap-2 mb-4" role="group" aria-label="Unit system">
              <button class="btn flex-fill mac-unit-btn active" data-unit="metric"
                      style="border-radius:8px; font-weight:600; font-size:.88rem; background:var(--fitness); color:#fff; border:none;">
                Metric (kg / cm)
              </button>
              <button class="btn flex-fill mac-unit-btn" data-unit="imperial"
                      style="border-radius:8px; font-weight:600; font-size:.88rem; background:#f8f9fa; color:#555; border:1px solid #e0e0e0;">
                Imperial (lbs / ft)
              </button>
            </div>

            <div class="row g-3 mb-3">
              <div class="col-6">
                <label for="macSex" class="form-label fw-600">Sex</label>
                <select id="macSex" class="form-select">
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                </select>
              </div>
              <div class="col-6">
                <label for="macAge" class="form-label fw-600">Age (years)</label>
                <input type="number" id="macAge" class="form-control" placeholder="e.g. 28" min="15" max="100">
              </div>
            </div>

            {{-- Metric --}}
            <div id="macMetric">
              <div class="row g-3 mb-3">
                <div class="col-6">
                  <label for="macHeightCm" class="form-label fw-600">Height (cm)</label>
                  <input type="number" id="macHeightCm" class="form-control" placeholder="e.g. 175">
                </div>
                <div class="col-6">
                  <label for="macWeightKg" class="form-label fw-600">Weight (kg)</label>
                  <input type="number" id="macWeightKg" class="form-control" placeholder="e.g. 75">
                </div>
              </div>
            </div>

            {{-- Imperial --}}
            <div id="macImperial" class="d-none">
              <div class="mb-3">
                <label class="form-label fw-600">Height</label>
                <div class="row g-2">
                  <div class="col-6"><input type="number" id="macHeightFt" class="form-control" placeholder="Feet"></div>
                  <div class="col-6"><input type="number" id="macHeightIn" class="form-control" placeholder="Inches"></div>
                </div>
              </div>
              <div class="mb-3">
                <label for="macWeightLbs" class="form-label fw-600">Weight (lbs)</label>
                <input type="number" id="macWeightLbs" class="form-control" placeholder="e.g. 165">
              </div>
            </div>

            <div class="mb-3">
              <label for="macActivity" class="form-label fw-600">Activity Level</label>
              <select id="macActivity" class="form-select">
                <option value="1.2">Sedentary</option>
                <option value="1.375">Lightly Active</option>
                <option value="1.55" selected>Moderately Active</option>
                <option value="1.725">Very Active</option>
                <option value="1.9">Extra Active</option>
              </select>
            </div>

            <div class="mb-4">
              <label for="macGoal" class="form-label fw-600">Goal</label>
              <select id="macGoal" class="form-select" onchange="toggleCustom(this.value)">
                <option value="lose">Fat Loss (40% protein / 30% carbs / 30% fat)</option>
                <option value="maintain" selected>Maintain Weight (30% protein / 40% carbs / 30% fat)</option>
                <option value="gain">Muscle Gain (35% protein / 45% carbs / 20% fat)</option>
                <option value="keto">Keto (25% protein / 5% carbs / 70% fat)</option>
                <option value="custom">Custom Split</option>
              </select>
            </div>

            {{-- Custom split --}}
            <div id="macCustom" class="d-none mb-4 p-3 rounded-3" style="background:#f8f9fa; border:1px solid #e0e0e0;">
              <p class="fw-600 mb-2" style="font-size:.85rem; color:var(--primary-dark);">Custom macro split (must total 100%)</p>
              <div class="row g-2">
                <div class="col-4">
                  <label for="macProtPct" class="form-label" style="font-size:.82rem;">Protein %</label>
                  <input type="number" id="macProtPct" class="form-control" value="30" min="10" max="60">
                </div>
                <div class="col-4">
                  <label for="macCarbPct" class="form-label" style="font-size:.82rem;">Carbs %</label>
                  <input type="number" id="macCarbPct" class="form-control" value="40" min="5" max="70">
                </div>
                <div class="col-4">
                  <label for="macFatPct" class="form-label" style="font-size:.82rem;">Fat %</label>
                  <input type="number" id="macFatPct" class="form-control" value="30" min="10" max="75">
                </div>
              </div>
            </div>

            <button class="btn btn-cta w-100" onclick="calcMacros()" style="font-size:1rem;">
              Calculate Macros →
            </button>

            {{-- Results --}}
            <div id="results" class="mt-4 d-none">
              <div style="height:1px; background:#f0f0f0; margin-bottom:20px;"></div>

              <div class="text-center mb-3">
                <div style="font-size:.8rem; color:#888; margin-bottom:4px;">Total daily calories</div>
                <div id="macTotalCal" style="font-size:2.2rem; font-weight:700; color:var(--primary-dark);"></div>
              </div>

              <div class="row g-3 mb-4 text-center">
                <div class="col-4">
                  <div style="background:#e8f5e9; border-radius:12px; padding:16px 8px;">
                    <div id="macProtG" style="font-size:1.6rem; font-weight:700; color:var(--green-text);"></div>
                    <div style="font-size:.7rem; color:#555; margin-top:2px;">Protein (g)</div>
                    <div id="macProtCal" style="font-size:.75rem; color:#888; margin-top:2px;"></div>
                    <div id="macProtPctDisp" style="font-size:.72rem; color:var(--green-text); font-weight:600;"></div>
                  </div>
                </div>
                <div class="col-4">
                  <div style="background:#fff8e1; border-radius:12px; padding:16px 8px;">
                    <div id="macCarbG" style="font-size:1.6rem; font-weight:700; color:#e65100;"></div>
                    <div style="font-size:.7rem; color:#555; margin-top:2px;">Carbs (g)</div>
                    <div id="macCarbCal" style="font-size:.75rem; color:#888; margin-top:2px;"></div>
                    <div id="macCarbPctDisp" style="font-size:.72rem; color:#e65100; font-weight:600;"></div>
                  </div>
                </div>
                <div class="col-4">
                  <div style="background:#e3f2fd; border-radius:12px; padding:16px 8px;">
                    <div id="macFatG" style="font-size:1.6rem; font-weight:700; color:var(--teal-text);"></div>
                    <div style="font-size:.7rem; color:#555; margin-top:2px;">Fat (g)</div>
                    <div id="macFatCal" style="font-size:.75rem; color:#888; margin-top:2px;"></div>
                    <div id="macFatPctDisp" style="font-size:.72rem; color:var(--teal-text); font-weight:600;"></div>
                  </div>
                </div>
              </div>

              {{-- Visual macro bar --}}
              <div style="margin-bottom:8px; font-size:.8rem; color:#888; font-weight:600;">Macro split</div>
              <div id="macBar" style="display:flex; border-radius:8px; overflow:hidden; height:20px; width:100%;"></div>
              <div class="d-flex gap-3 mt-2" style="font-size:.75rem; color:#666;">
                <span style="display:flex; align-items:center; gap:4px;"><span style="width:10px; height:10px; border-radius:2px; background:#4caf50; display:inline-block;"></span> Protein</span>
                <span style="display:flex; align-items:center; gap:4px;"><span style="width:10px; height:10px; border-radius:2px; background:#ff9800; display:inline-block;"></span> Carbs</span>
                <span style="display:flex; align-items:center; gap:4px;"><span style="width:10px; height:10px; border-radius:2px; background:#2196f3; display:inline-block;"></span> Fat</span>
              </div>
            </div>

          </div>
        </div>
      </div>

      {{-- Right: Quick facts --}}
      <div class="col-lg-5 d-none d-lg-block" style="padding-top:10px;">
        <div class="ms-facts-wrap">
          <h3 class="ms-facts-title">Quick Macro Facts</h3>
          @foreach([
            ['4 cal/g',   'Calories per gram of protein or carb'],
            ['9 cal/g',   'Calories per gram of fat'],
            ['0.8–1g/lb', 'Protein target for muscle building'],
            ['20–35%',    'Recommended fat intake (% of calories)'],
            ['45–65%',    'Recommended carbohydrate range (% of calories)'],
          ] as [$stat, $label])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div class="ms-fact-pill ms-fact-pill-fitness">{{ $stat }}</div>
            <div class="ms-fact-label">{{ $label }}</div>
          </div>
          @endforeach
          <p class="ms-fact-source">Sources: USDA Dietary Guidelines, ISSN Position Stand</p>
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
        <h2 class="mb-4">How Macros Work: Protein, Carbs, and Fat Explained</h2>
        <p>The three macronutrients provide all of your dietary calories. Each plays distinct and irreplaceable roles:</p>
        <p><strong style="color:var(--green-text);">Protein</strong> builds and repairs muscle tissue, produces enzymes and hormones, and is the most satiating macronutrient. At 4 cal/g, it is equally calorie-dense to carbohydrates, but its thermic effect (25–30% of its calories are burned in digestion) makes it the most metabolically "expensive" food.</p>
        <p><strong style="color:#e65100;">Carbohydrates</strong> are the body's preferred fuel, especially for high-intensity exercise. They are stored as glycogen in muscles and the liver. At 4 cal/g, they are calorie-efficient and essential for performance.</p>
        <p><strong style="color:var(--teal-text);">Fat</strong> is calorie-dense at 9 cal/g and is essential for hormone production, fat-soluble vitamin absorption, and brain function. Dietary fat does not directly cause body fat gain — excess calories from any source do.</p>
      </div>
      <div class="col-lg-7">
        <div class="p-4 rounded-3 ms-data-box">
          <p class="fw-600 mb-3" style="color:var(--primary-dark); font-size:.88rem; text-transform:uppercase; letter-spacing:.5px;">Macro splits by goal</p>
          @foreach([
            ['Fat Loss',      '40% protein', '30% carbs', '30% fat', 'High protein preserves muscle; moderate carbs fuel training'],
            ['Maintenance',   '30% protein', '40% carbs', '30% fat', 'Balanced split for general health and weight maintenance'],
            ['Muscle Gain',   '35% protein', '45% carbs', '20% fat', 'Higher carbs fuel training sessions and glycogen replenishment'],
            ['Ketogenic',     '25% protein', '5% carbs',  '70% fat', 'Very low carb; forces ketosis as primary energy state'],
          ] as [$goal, $prot, $carb, $fat, $note])
          <div class="mb-4">
            <div class="fw-600 mb-2" style="font-size:.88rem; color:var(--primary-dark);">{{ $goal }}</div>
            <div class="d-flex gap-2 mb-1">
              <span style="background:#e8f5e9; color:var(--green-text); border-radius:4px; padding:2px 10px; font-size:.78rem; font-weight:600;">{{ $prot }}</span>
              <span style="background:#fff8e1; color:#e65100; border-radius:4px; padding:2px 10px; font-size:.78rem; font-weight:600;">{{ $carb }}</span>
              <span style="background:#e3f2fd; color:var(--teal-text); border-radius:4px; padding:2px 10px; font-size:.78rem; font-weight:600;">{{ $fat }}</span>
            </div>
            <div style="font-size:.78rem; color:#888; line-height:1.5;">{{ $note }}</div>
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
      <h2>Macronutrient Calorie Conversions Reference</h2>
      <p class="text-muted" style="max-width:520px; margin:auto;">Use this table to convert between grams and calories for each macronutrient.</p>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-9">
        <div class="table-responsive">
          <table class="table table-bordered" style="border-radius:12px; overflow:hidden; font-size:.9rem;">
            <thead class="ms-table-head">
              <tr>
                <th style="padding:12px 18px;">Macronutrient</th>
                <th style="padding:12px 18px;">Calories per gram</th>
                <th style="padding:12px 18px;">50g =</th>
                <th style="padding:12px 18px;">100g =</th>
                <th style="padding:12px 18px;">Primary role</th>
              </tr>
            </thead>
            <tbody>
              @foreach([
                ['Protein',       '4 cal/g', '200 cal', '400 cal', 'Muscle repair, enzyme production, satiety'],
                ['Carbohydrate',  '4 cal/g', '200 cal', '400 cal', 'Fuel for brain and muscles, glycogen storage'],
                ['Fat',           '9 cal/g', '450 cal', '900 cal', 'Hormones, vitamin absorption, cell membranes'],
                ['Alcohol',       '7 cal/g', '350 cal', '700 cal', 'No nutritional role; metabolised as priority fuel'],
              ] as [$mac, $cpg, $f50, $f100, $role])
              <tr>
                <td style="padding:10px 18px; font-weight:600;">{{ $mac }}</td>
                <td style="padding:10px 18px;">{{ $cpg }}</td>
                <td style="padding:10px 18px;">{{ $f50 }}</td>
                <td style="padding:10px 18px;">{{ $f100 }}</td>
                <td style="padding:10px 18px; color:#666; font-size:.85rem;">{{ $role }}</td>
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

    <h2 class="mb-4" style="color:var(--primary-dark);">Macro Calculator for Weight Loss — High Protein vs Low Carb</h2>
    <p>The great macronutrient debate for weight loss — high protein vs. low carb vs. low fat — has been studied extensively. A landmark 2020 DIETFITS trial compared low-fat and low-carb diets in 609 adults over 12 months and found no significant difference in weight loss between the groups. The consistent finding across the literature is that protein intake is the macro that most reliably improves body composition outcomes. Diets higher in protein produce greater fat loss and better muscle retention at equivalent calorie deficits, regardless of carbohydrate or fat content.</p>
    <p>For practical weight loss, aim for at least 30–35% of calories from protein (or 1.6 g per kg bodyweight), and then distribute carbohydrates and fat based on personal preference and dietary tolerability. The macro split you can stick to consistently produces better results than the theoretically optimal split you abandon after two weeks.</p>

    <h2 class="mt-5 mb-4" style="color:var(--primary-dark);">Macro Calculator for Muscle Gain — Bulking Macros Explained</h2>
    <p>Building muscle requires both an adequate calorie surplus and sufficient macronutrient distribution. A "dirty bulk" — eating in a large surplus of 500–1,000+ calories per day — is a common approach that produces rapid scale weight gain, but research shows the majority of that gain is fat, not muscle. A lean bulk of 200–400 calories above TDEE, with 30–35% protein, 45–50% carbohydrates, and 20–25% fat, maximises the ratio of muscle to fat gained.</p>
    <p>Carbohydrates deserve particular attention during a muscle-building phase. Glycogen-loaded muscles perform better in resistance training, and the post-workout insulin spike from carbohydrate intake enhances amino acid uptake into muscle cells. Protein timing also matters more when bulking: distributing protein intake across 4–5 meals of 30–40 g each (rather than 2 large meals) optimises muscle protein synthesis over the day.</p>

    <h2 class="mt-5 mb-4" style="color:var(--primary-dark);">Keto Macros Calculator — 70/25/5 Split Explained</h2>
    <p>A ketogenic diet maintains carbohydrates below 20–50 g per day — typically 5% of total calories — while providing 70–75% of calories from fat and 20–25% from protein. At this carbohydrate intake, liver glycogen depletes within 2–4 days, and the liver begins converting fatty acids to ketone bodies (beta-hydroxybutyrate, acetoacetate, and acetone) as an alternative fuel. This state is called nutritional ketosis.</p>
    <p>Protein is deliberately kept moderate on keto because excess amino acids can be converted to glucose via gluconeogenesis, potentially disrupting ketosis. This distinguishes keto from high-protein diets, where protein intake of 2+ g per kg is common. For athletes on keto, performance in high-intensity activities typically suffers due to the lack of readily available glycogen — keto tends to suit lower-intensity activities like steady-state cardio and endurance events better than explosive or strength sports.</p>

  </div>
</section>

<x-related-tools :tools="$relatedTools" heading="More Fitness Calculators" />


{{-- ── 7. SEO Block ──────────────────────────────────────────────────────────── --}}
<section class="ms-section-seo">
  <div class="container-xl">
    <div class="row justify-content-center">
      <div class="col-lg-8 ms-seo-body">
        <h2 class="mb-4 ms-seo-h2">Macro Calculator: How to Use Your Results</h2>
        <p>Your macro targets from this calculator are starting points — not rigid daily quotas. Body weight fluctuates daily by 1–2 kg due to water, food volume, and glycogen, so the scale is not a reliable short-term feedback tool. Assess macro adherence over weekly averages and adjust targets based on real-world results over 3–4 weeks rather than daily data.</p>
        <h3 class="ms-seo-h3">Protein: The Most Important Macro to Track</h3>
        <p>If tracking all three macros feels overwhelming, start with protein alone. Research by Layne Norton and others consistently shows that adequate protein intake is the macro most strongly associated with favourable body composition outcomes — more than total calorie deficit size, carbohydrate content, or eating frequency. Hit your protein target daily, keep total calories roughly aligned with your goal, and let the fat and carbohydrate distribution find its natural balance.</p>
        <h3 class="ms-seo-h3">Reassess Every 4–6 Weeks</h3>
        <p>As your body weight changes, your TDEE and macro targets should be recalculated. A 5 kg reduction in body weight reduces maintenance calories by approximately 100–150 per day — meaning the same deficit that produced results at the start will produce less over time. Recalculate every 4–6 weeks, or whenever weight loss has stalled for more than three weeks despite consistent tracking.</p>
        <div class="mt-4 p-4 rounded-3 ms-note ms-note-green">
          <p style="margin:0; font-size:.85rem; color:#155724;"><strong>Disclaimer:</strong> This macro calculator is for general informational purposes only. Nutritional needs vary by individual, medical history, and specific goals. Consult a registered dietitian or sports nutritionist for personalised advice, particularly if you have metabolic conditions, kidney disease, or a history of disordered eating.</p>
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

  window.toggleCustom = function (val) {
    document.getElementById('macCustom').classList.toggle('d-none', val !== 'custom');
  };

  document.querySelectorAll('.mac-unit-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
      document.querySelectorAll('.mac-unit-btn').forEach(function (b) {
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
      document.getElementById('macMetric').classList.toggle('d-none', currentUnit !== 'metric');
      document.getElementById('macImperial').classList.toggle('d-none', currentUnit !== 'imperial');
      document.getElementById('results').classList.add('d-none');
    });
  });

  window.calcMacros = function () {
    var sex      = document.getElementById('macSex').value;
    var age      = parseFloat(document.getElementById('macAge').value);
    var activity = parseFloat(document.getElementById('macActivity').value);
    var goal     = document.getElementById('macGoal').value;
    var heightCm, weightKg;

    if (currentUnit === 'metric') {
      heightCm = parseFloat(document.getElementById('macHeightCm').value);
      weightKg = parseFloat(document.getElementById('macWeightKg').value);
    } else {
      var ft = parseFloat(document.getElementById('macHeightFt').value) || 0;
      var ins = parseFloat(document.getElementById('macHeightIn').value) || 0;
      heightCm = (ft * 12 + ins) * 2.54;
      weightKg = parseFloat(document.getElementById('macWeightLbs').value) * 0.453592;
    }

    if (!age || !heightCm || !weightKg) {
      alert('Please fill in all required fields.');
      return;
    }

    // Mifflin-St Jeor BMR then TDEE
    var bmr;
    if (sex === 'male') {
      bmr = (10 * weightKg) + (6.25 * heightCm) - (5 * age) + 5;
    } else {
      bmr = (10 * weightKg) + (6.25 * heightCm) - (5 * age) - 161;
    }
    var tdee = bmr * activity;

    // Calorie adjustment by goal
    var totalCal;
    if (goal === 'lose')     totalCal = tdee - 500;
    else if (goal === 'gain') totalCal = tdee + 300;
    else                      totalCal = tdee;
    totalCal = Math.round(Math.max(1200, totalCal));

    // Macro percentages
    var protPct, carbPct, fatPct;
    if (goal === 'lose')     { protPct = 0.40; carbPct = 0.30; fatPct = 0.30; }
    else if (goal === 'gain'){ protPct = 0.35; carbPct = 0.45; fatPct = 0.20; }
    else if (goal === 'keto'){ protPct = 0.25; carbPct = 0.05; fatPct = 0.70; }
    else if (goal === 'custom') {
      protPct = parseFloat(document.getElementById('macProtPct').value) / 100;
      carbPct = parseFloat(document.getElementById('macCarbPct').value) / 100;
      fatPct  = parseFloat(document.getElementById('macFatPct').value)  / 100;
      if (Math.abs(protPct + carbPct + fatPct - 1) > 0.02) {
        alert('Your custom percentages must total 100%. Please adjust and try again.');
        return;
      }
    } else {
      protPct = 0.30; carbPct = 0.40; fatPct = 0.30;
    }

    var protCal = Math.round(totalCal * protPct);
    var carbCal = Math.round(totalCal * carbPct);
    var fatCal  = Math.round(totalCal * fatPct);
    var protG   = Math.round(protCal / 4);
    var carbG   = Math.round(carbCal / 4);
    var fatG    = Math.round(fatCal  / 9);

    document.getElementById('macTotalCal').textContent = totalCal.toLocaleString() + ' calories';
    document.getElementById('macProtG').textContent    = protG + 'g';
    document.getElementById('macCarbG').textContent    = carbG + 'g';
    document.getElementById('macFatG').textContent     = fatG  + 'g';
    document.getElementById('macProtCal').textContent  = protCal + ' cal';
    document.getElementById('macCarbCal').textContent  = carbCal + ' cal';
    document.getElementById('macFatCal').textContent   = fatCal  + ' cal';
    document.getElementById('macProtPctDisp').textContent = Math.round(protPct * 100) + '%';
    document.getElementById('macCarbPctDisp').textContent = Math.round(carbPct * 100) + '%';
    document.getElementById('macFatPctDisp').textContent  = Math.round(fatPct  * 100) + '%';

    // Visual bar
    document.getElementById('macBar').innerHTML =
      '<div style="width:' + Math.round(protPct * 100) + '%; background:#4caf50; transition:width .4s;"></div>' +
      '<div style="width:' + Math.round(carbPct * 100) + '%; background:#ff9800; transition:width .4s;"></div>' +
      '<div style="width:' + Math.round(fatPct  * 100) + '%; background:#2196f3; transition:width .4s;"></div>';

    var resultsEl = document.getElementById('results');
    resultsEl.classList.remove('d-none');
    resultsEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  };

})();
</script>
@endsection
