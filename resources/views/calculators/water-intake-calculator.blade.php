@extends('layouts.app')

@section('title', 'Water Intake Calculator — Daily Water Needs by Weight & Activity | MindSnap')
@section('description', 'Free water intake calculator: find your daily hydration target based on weight, activity level, and climate. Includes water from food and drinks. No signup.')
@section('canonical', config('app.url') . '/water-intake-calculator')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "WebApplication",
  "name": "Water Intake Calculator",
  "url": "{{ config('app.url') }}/water-intake-calculator",
  "description": "Calculate your daily water intake needs based on weight, activity level, and climate.",
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
    { "@@type": "ListItem", "position": 1, "name": "Home",            "item": "{{ config('app.url') }}" },
    { "@@type": "ListItem", "position": 2, "name": "Nutrition Tools", "item": "{{ config('app.url') }}/nutrition-tools" },
    { "@@type": "ListItem", "position": 3, "name": "Water Intake Calculator" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [
    { "@@type": "Question", "name": "How much water should I drink per day?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Most adults need between 2.5 and 3.7 litres of total water per day from all sources. The US National Academies of Sciences recommends 3.7L for men and 2.7L for women, including water from food (roughly 20%). Your personal target depends on body weight, activity level, and climate. A practical rule is to drink 35ml per kilogram of body weight daily as a baseline, then adjust upward for exercise and heat." } },
    { "@@type": "Question", "name": "Is the '8 glasses a day' rule accurate?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The '8 glasses a day' (roughly 2 litres) is a rough average that works for sedentary adults in temperate climates but is not scientifically precise. It ignores body weight, activity, climate, and dietary water intake. A 90kg marathon runner training in summer heat may need 5+ litres, while a 55kg office worker in a cool climate might be fine with 1.8 litres from beverages plus food. Use a weight-based formula for a more personalised target." } },
    { "@@type": "Question", "name": "How do I know if I'm drinking enough water?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The simplest indicator is urine colour. Pale straw yellow (like lemonade) means you are well hydrated. Dark yellow or amber means you need more water. Clear urine can indicate overhydration. Other signs of adequate hydration include urinating every 2–4 hours, no persistent headaches in the afternoon, and moist lips and mouth. Thirst is a late indicator — by the time you feel thirsty you may already be mildly dehydrated." } },
    { "@@type": "Question", "name": "Does coffee and tea count toward daily water intake?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes — coffee and tea do count toward your total fluid intake despite containing caffeine. Research shows that moderate caffeine consumption (up to 400mg per day, about 4 cups of coffee) does not cause net dehydration in regular consumers because the diuretic effect is small compared to the fluid volume consumed. However, high caffeine intake and alcohol are net dehydrators, so counting them at 100% is slightly optimistic. Water, herbal teas, and milk remain the best hydration sources." } },
    { "@@type": "Question", "name": "How much extra water do I need when exercising?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The American College of Sports Medicine recommends drinking approximately 500ml (about 17oz) of water in the two hours before exercise, then 150–250ml every 15–20 minutes during exercise. After exercise, replace 1.5 times the fluid lost through sweat. As a general guide, add roughly 500ml per hour of moderate exercise and up to 1 litre per hour of intense exercise in hot conditions. Electrolytes become important for sessions lasting over 60–90 minutes." } }
  ]
}
</script>
@endsection

@php
$faqs = [
  ['q' => 'How much water should I drink per day?',
             'a' => 'Most adults need between 2.5 and 3.7 litres of total water per day from all sources. The US National Academies of Sciences recommends 3.7L for men and 2.7L for women, including water from food (roughly 20%). Your personal target depends on body weight, activity level, and climate. A practical rule is to drink 35ml per kilogram of body weight daily as a baseline, then adjust upward for exercise and heat.'],
  ['q' => 'Is the "8 glasses a day" rule accurate?',
             'a' => 'The "8 glasses a day" (roughly 2 litres) is a rough average that works for sedentary adults in temperate climates but is not scientifically precise. It ignores body weight, activity, climate, and dietary water intake. A 90kg marathon runner training in summer heat may need 5+ litres, while a 55kg office worker in a cool climate might be fine with 1.8 litres from beverages plus food.'],
  ['q' => 'How do I know if I\'m drinking enough water?',
             'a' => 'The simplest indicator is urine colour. Pale straw yellow means you are well hydrated. Dark yellow or amber means you need more water. Clear urine can indicate overhydration. Other signs of adequate hydration include urinating every 2–4 hours, no persistent afternoon headaches, and moist lips. Thirst is a late indicator — by the time you feel thirsty you may already be mildly dehydrated.'],
  ['q' => 'Does coffee and tea count toward daily water intake?',
             'a' => 'Yes — coffee and tea do count toward your total fluid intake despite containing caffeine. Research shows that moderate caffeine consumption (up to 400mg per day, about 4 cups of coffee) does not cause net dehydration in regular consumers. However, high caffeine intake and alcohol are net dehydrators, so water, herbal teas, and milk remain the best hydration sources.'],
  ['q' => 'How much extra water do I need when exercising?',
             'a' => 'The ACSM recommends drinking approximately 500ml in the two hours before exercise, then 150–250ml every 15–20 minutes during exercise. After exercise, replace 1.5× the fluid lost. As a general guide, add roughly 500ml per hour of moderate exercise and up to 1 litre per hour of intense exercise in hot conditions. Electrolytes become important for sessions lasting over 60–90 minutes.'],
  ['q' => 'Can you drink too much water?',
             'a' => 'Yes. Hyponatraemia (water intoxication) occurs when drinking large volumes dilutes sodium in the blood to dangerous levels. It is rare in everyday life but a genuine risk for endurance athletes who drink plain water without replacing electrolytes. Symptoms include nausea, headache, confusion, and in severe cases seizures. The general population does not need to worry — kidneys can excrete up to 1 litre per hour.'],
  ['q' => 'Does drinking more water help with weight loss?',
             'a' => 'Water can support weight loss through several mechanisms: it increases feelings of fullness, is calorie-free (replacing caloric drinks), and may temporarily boost metabolism by 24–30% for 60–90 minutes after drinking 500ml (cold water thermogenesis). Studies show drinking 500ml before meals reduces calorie intake. However, water alone is not a weight-loss solution — it works best as part of a calorie-controlled diet.'],
  ['q' => 'How does climate affect how much water I need?',
             'a' => 'Hot and humid conditions significantly increase sweat rate. In temperatures above 30°C with high humidity, sweat losses can exceed 1.5–2 litres per hour during moderate exercise. Cold and dry environments also increase water loss through respiration (you can see your breath) but this is partially offset by reduced sweat. This calculator applies a 15% increase for hot climates and a 5% reduction for cold, dry environments.'],
];

$relatedTools = [
  ['icon' => '⏰', 'name' => 'Intermittent Fasting Calculator', 'slug' => 'intermittent-fasting-calculator', 'desc' => 'Get your eating window and fasting schedule.'],
  ['icon' => '🔥', 'name' => 'Calorie Calculator', 'slug' => 'calorie-calculator', 'desc' => 'Find your daily calorie needs by goal.'],
  ['icon' => '⚖️', 'name' => 'Macro Calculator', 'slug' => 'macro-calculator', 'desc' => 'Calculate protein, carbs, and fat targets.'],
  ['icon' => '💪', 'name' => 'Protein Calculator', 'slug' => 'protein-calculator', 'desc' => 'How much protein do you actually need?'],
  ['icon' => '📏', 'name' => 'BMI Calculator', 'slug' => 'bmi-calculator', 'desc' => 'Check your body mass index and healthy weight range.'],
  ['icon' => '📉', 'name' => 'Calorie Deficit Calculator', 'slug' => 'calorie-deficit-calculator', 'desc' => 'Find your deficit for safe, steady fat loss.'],
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
            <li class="breadcrumb-item"><a href="/nutrition-tools">Nutrition Tools</a></li>
            <li class="breadcrumb-item active">Water Intake Calculator</li>
          </ol>
        </nav>

        <h1 class="mb-2 ms-hero-title">
          💧 Water Intake Calculator — Daily Hydration Target for Your Body
        </h1>
        <p class="ms-hero-desc">
          Find your personalised daily water target based on weight, activity level, and climate — including how much comes from food.
        </p>

        {{-- ── Tool Card ─────────────────────────────────────────────────────── --}}
        <div class="card border-0 mb-n4 ms-tool-card">
          <div class="card-body p-4 p-md-5">

            {{-- Weight --}}
            <div class="mb-3">
              <label class="form-label fw-semibold">Body Weight</label>
              <div class="input-group">
                <input type="number" id="wiWeight" class="form-control" value="70" min="20" max="300" aria-label="Weight">
                <select id="wiWeightUnit" class="form-select" style="max-width:90px;">
                  <option value="kg">kg</option>
                  <option value="lbs">lbs</option>
                </select>
              </div>
            </div>

            {{-- Activity Level --}}
            <div class="mb-3">
              <label for="wiActivity" class="form-label fw-semibold">Activity Level</label>
              <select id="wiActivity" class="form-select">
                <option value="1.0">Sedentary (desk job, little exercise)</option>
                <option value="1.1">Lightly Active (light exercise 1–3 days/week)</option>
                <option value="1.2" selected>Moderately Active (moderate exercise 3–5 days/week)</option>
                <option value="1.3">Very Active (hard exercise 6–7 days/week)</option>
                <option value="1.4">Extremely Active (athlete / physical job)</option>
              </select>
            </div>

            {{-- Climate --}}
            <div class="mb-3">
              <label for="wiClimate" class="form-label fw-semibold">Climate / Environment</label>
              <select id="wiClimate" class="form-select">
                <option value="1.0" selected>Temperate (mild weather)</option>
                <option value="1.15">Hot & Humid (summer / tropics)</option>
                <option value="0.95">Cold & Dry (winter / air conditioning)</option>
              </select>
            </div>

            {{-- Special conditions --}}
            <div class="mb-4">
              <label class="form-label fw-semibold">Special Conditions <span class="text-muted fw-normal" style="font-size:.82rem;">(optional)</span></label>
              <div class="d-flex gap-3 flex-wrap">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="wiPregnant">
                  <label class="form-check-label" for="wiPregnant">Pregnant (+300 ml)</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="wiBreastfeeding">
                  <label class="form-check-label" for="wiBreastfeeding">Breastfeeding (+700 ml)</label>
                </div>
              </div>
            </div>

            <button class="btn btn-cta w-100" onclick="wiCalculate()" style="font-size:1rem;">
              Calculate My Water Intake →
            </button>

            {{-- Results --}}
            <div id="wiResults" class="mt-4 d-none">
              <div class="ms-divider" style="margin-bottom:20px;"></div>

              <div class="row g-3 mb-3">
                <div class="col-6">
                  <div class="text-center p-3 rounded-3" style="background:#e8f7ff; border:1px solid #b8e3ff;">
                    <div id="wiTotalL" style="font-size:2rem; font-weight:700; color:var(--nutrition);"></div>
                    <div style="font-size:.78rem; color:#555; margin-top:2px;">Total daily water</div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="text-center p-3 rounded-3" style="background:#fff8f0; border:1px solid #ffd9b3;">
                    <div id="wiGlasses" style="font-size:2rem; font-weight:700; color:var(--nutrition);"></div>
                    <div style="font-size:.78rem; color:#555; margin-top:2px;">Glasses (250 ml each)</div>
                  </div>
                </div>
              </div>

              <div class="row g-3 mb-3">
                <div class="col-6">
                  <div class="p-3 rounded-3" style="background:#f8f9fa; border:1px solid #e0e0e0;">
                    <div style="font-size:.75rem; color:#888; margin-bottom:4px;">💧 From beverages</div>
                    <div id="wiBeverages" style="font-weight:700; color:var(--primary-dark);"></div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="p-3 rounded-3" style="background:#f8f9fa; border:1px solid #e0e0e0;">
                    <div style="font-size:.75rem; color:#888; margin-bottom:4px;">🥗 From food</div>
                    <div id="wiFood" style="font-weight:700; color:var(--primary-dark);"></div>
                  </div>
                </div>
              </div>

              <div class="p-3 rounded-3 mb-3" style="background:#f0fff4; border:1px solid #b3f0c8;">
                <div style="font-size:.8rem; font-weight:600; color:#1a6e3a; margin-bottom:8px;">⏰ Hourly drinking schedule (beverages only)</div>
                <div id="wiSchedule" style="font-size:.8rem; color:#444; line-height:1.8;"></div>
              </div>

              <div class="p-3 rounded-3" style="background:#fff8e1; border:1px solid #ffe082;">
                <div style="font-size:.8rem; font-weight:600; color:#e65100; margin-bottom:6px;">💡 Hydration Tips</div>
                <div id="wiTips" style="font-size:.78rem; color:#555; line-height:1.8;"></div>
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
          <h3 class="ms-facts-title">Quick Hydration Facts</h3>
          @foreach([
            ['60%',   'Of adult body weight is water'],
            ['3.7 L', 'Total daily water for men (US NAS)'],
            ['2.7 L', 'Total daily water for women (US NAS)'],
            ['20%',   'Of daily water that comes from food'],
            ['500 ml','Extra water needed per hour of exercise'],
          ] as [$stat, $label])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div class="ms-fact-pill ms-fact-pill-nutrition">{{ $stat }}</div>
            <div class="ms-fact-label">{{ $label }}</div>
          </div>
          @endforeach
          <p class="ms-fact-source">Sources: US NAS, ACSM, WHO</p>
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
        <span class="ms-badge ms-badge-nutrition mb-3">How It Works</span>
        <h2 class="mb-4">How Your Body Uses Water: Why Hydration Matters</h2>
        <p>Water is involved in virtually every biological process — regulating temperature, transporting nutrients, flushing waste, lubricating joints, and enabling cellular metabolism. Even mild dehydration (1–2% of body weight) impairs cognitive performance, reduces physical endurance by up to 10%, and increases perceived effort.</p>
        <p>Your kidneys regulate fluid balance tightly, but they rely on adequate input. In hot conditions or during exercise, sweat losses can exceed 1–2 litres per hour, outpacing what most people drink instinctively.</p>
        <p>This calculator uses the standard 35ml per kilogram of body weight formula as its base, then multiplies by your activity and climate factors — a method used by sports dietitians and consistent with ACSM guidelines.</p>
      </div>
      <div class="col-lg-7">
        <div class="p-4 rounded-3 ms-data-box">
          <p class="fw-semibold mb-3" style="color:var(--primary-dark); font-size:.88rem; text-transform:uppercase; letter-spacing:.5px;">What water does in your body</p>
          @foreach([
            ['🧠','Brain & cognition','Even 1% dehydration reduces concentration, short-term memory, and reaction time.'],
            ['❤️','Blood volume','Blood is ~90% water. Dehydration thickens blood, raising heart rate and blood pressure.'],
            ['🌡️','Temperature regulation','Sweat is your body\'s cooling system — it evaporates to remove heat during exercise.'],
            ['🦷','Joint lubrication','Synovial fluid in joints is water-based. Dehydration contributes to joint stiffness.'],
            ['🫁','Kidney function','Kidneys filter ~180 litres of blood daily. Adequate water prevents kidney stones and UTIs.'],
          ] as [$icon,$title,$desc])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div style="font-size:1.3rem; flex-shrink:0; padding-top:2px;">{{ $icon }}</div>
            <div>
              <div class="fw-semibold" style="font-size:.87rem; color:#1a1a2e;">{{ $title }}</div>
              <div style="font-size:.8rem; color:#666; line-height:1.5;">{{ $desc }}</div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ── 3. Dehydration Signs ─────────────────────────────────────────────────── --}}
<section class="ms-section-muted">
  <div class="container-xl">
    <div class="text-center mb-5">
      <h2>Signs of Dehydration by Severity</h2>
      <p class="text-muted" style="max-width:520px; margin:auto;">Recognise the warning signs before performance and health are affected.</p>
    </div>
    <div class="row g-4">
      @foreach([
        ['Mild (1–2% body weight)', '#fff8e1', '#e65100', '#ffe082', [
          'Thirst',
          'Slightly darker urine (yellow)',
          'Dry mouth',
          'Mild fatigue',
          '↓ 5–10% cognitive performance',
        ]],
        ['Moderate (3–5% body weight)', '#fff3e0', '#bf360c', '#ffcc80', [
          'Headache',
          'Reduced urine output',
          'Muscle cramps',
          'Irritability and poor concentration',
          '↓ 10–20% athletic performance',
        ]],
        ['Severe (>6% body weight)', '#fce4ec', '#880e4f', '#f48fb1', [
          'Rapid heartbeat',
          'Sunken eyes',
          'Very dark or no urine',
          'Confusion or dizziness',
          'Medical emergency — seek help',
        ]],
      ] as [$level, $bg, $text, $border, $signs])
      <div class="col-md-4">
        <div class="p-4 rounded-3 h-100" style="background:{{ $bg }}; border:1px solid {{ $border }};">
          <h3 style="font-size:.95rem; font-weight:700; color:{{ $text }}; margin-bottom:14px;">{{ $level }}</h3>
          <ul style="font-size:.84rem; color:#444; line-height:2; padding-left:18px; margin:0;">
            @foreach($signs as $sign)
            <li>{{ $sign }}</li>
            @endforeach
          </ul>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="wiAccordion" />


{{-- ── 5. Long-tail sections ─────────────────────────────────────────────────── --}}
<section class="ms-section-accent">
  <div class="container ms-longtail">

    <h2 class="mb-4" style="color:var(--primary-dark);">Water Intake Calculator for Weight Loss — Does Drinking Water Help?</h2>
    <p>Water and weight loss are genuinely connected, though not in the way most headlines imply. Drinking 500ml of cold water increases metabolic rate by 24–30% for about 60 minutes, a small but real thermogenic effect. More practically, water has zero calories and creates gastric distension — the physical sensation of fullness — before meals. A 2010 randomised controlled trial published in <em>Obesity</em> found that adults who drank 500ml of water 30 minutes before each meal lost 44% more weight over 12 weeks than those who did not. Replacing caloric beverages (juice, soda, energy drinks) with water is often the single highest-impact dietary change for weight management. This calculator helps you find the right target so you're never drinking too little — or so much that it becomes counterproductive.</p>

    <h2 class="mt-5 mb-4" style="color:var(--primary-dark);">How Much Water Should I Drink While Exercising? Per Hour?</h2>
    <p>Exercise dramatically increases water needs. Your body loses water primarily through sweat (to cool the body) and respiration (faster breathing expels water vapour). At moderate intensity (jogging, cycling), sweat losses range from 0.5 to 1 litre per hour. At high intensity in hot conditions, losses can exceed 2 litres per hour. The American College of Sports Medicine (ACSM) recommends: drink 5–7ml per kilogram of body weight in the 4 hours before exercise, 150–250ml every 15–20 minutes during exercise, and 1.5 times the weight lost after exercise. For a 70kg person, this means roughly 350–490ml pre-exercise, about 200ml every 15–20 minutes during, and careful rehydration post-exercise. For sessions over 90 minutes, replace electrolytes (sodium, potassium) alongside fluids to prevent hyponatraemia.</p>

    <h2 class="mt-5 mb-4" style="color:var(--primary-dark);">Water Intake During Pregnancy and Breastfeeding</h2>
    <p>Hydration needs increase meaningfully during pregnancy and breastfeeding. During pregnancy, blood volume expands by up to 50%, amniotic fluid must be maintained, and the developing foetus needs water for every metabolic process. The US NAS recommends pregnant women increase total water intake by approximately 300ml per day above their baseline. Morning sickness, common in the first trimester, can cause dehydration that requires active compensation. During breastfeeding, breast milk is roughly 88% water. The body needs approximately 700–900ml of extra water daily to produce an adequate milk supply — inadequate hydration is a leading cause of reduced milk production. This calculator adds 300ml for pregnancy and 700ml for breastfeeding when selected. Signs that a breastfeeding parent needs more water include dark urine, reduced milk output, and persistent thirst.</p>

  </div>
</section>

<x-related-tools :tools="$relatedTools" heading="More Nutrition Tools" />


{{-- ── 7. SEO Block ─────────────────────────────────────────────────────────── --}}
<section class="ms-section-seo">
  <div class="container-xl">
    <div class="row justify-content-center">
      <div class="col-lg-8 ms-seo-body">
        <h2 class="mb-4 ms-seo-h2">Water Intake Calculator: The Science Behind Your Target</h2>
        <p>The 35ml per kilogram formula used by this calculator is one of the most widely cited clinical guidelines for estimating baseline fluid needs in healthy adults. It aligns with recommendations from the European Food Safety Authority (EFSA), which sets adequate intake at 2.5L for men and 2.0L for women from beverages alone (excluding food water).</p>
        <h3 class="ms-seo-h3">Why the 20% Food Rule Matters</h3>
        <p>Approximately 20% of daily water intake comes from solid foods, particularly fruits and vegetables. Cucumbers, lettuce, and tomatoes are over 95% water by weight. This is why the calculator shows separate beverage and food contributions — drinking to your total target without accounting for food water would result in overhydration for most people.</p>
        <h3 class="ms-seo-h3">Hydration Is Individual</h3>
        <p>Kidney function, medications (diuretics, lithium), gastrointestinal conditions, and individual metabolic rate all affect fluid needs beyond what any formula can capture. Athletes who sweat heavily may require significantly more than the calculator suggests, while people with kidney disease or heart failure may need to restrict fluids. Always consult a healthcare provider if you have specific medical conditions.</p>
        <div class="mt-4 p-4 rounded-3 ms-note ms-note-orange">
          <p style="margin:0; font-size:.85rem; color:#6d4c00;"><strong>Note:</strong> This calculator provides general wellness guidance. It is not medical advice. If you have kidney disease, heart failure, or take medications that affect fluid balance, consult your doctor before changing your water intake significantly.</p>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')
<script>
(function () {

  window.wiCalculate = function () {
    var weight    = parseFloat(document.getElementById('wiWeight').value);
    var unit      = document.getElementById('wiWeightUnit').value;
    var activity  = parseFloat(document.getElementById('wiActivity').value);
    var climate   = parseFloat(document.getElementById('wiClimate').value);
    var pregnant  = document.getElementById('wiPregnant').checked;
    var breast    = document.getElementById('wiBreastfeeding').checked;

    if (!weight || weight <= 0) return;

    // Convert to kg
    var weightKg = unit === 'lbs' ? weight * 0.453592 : weight;

    // Base: 35ml per kg
    var baseML = weightKg * 35;

    // Apply multipliers
    var totalML = baseML * activity * climate;

    // Add bonuses
    if (pregnant)    totalML += 300;
    if (breast)      totalML += 700;

    // Round to nearest 50ml
    totalML = Math.round(totalML / 50) * 50;

    // Food contributes ~20%, so beverages = 80%
    var foodML      = Math.round(totalML * 0.2);
    var beveragesML = totalML - foodML;

    var totalL      = (totalML / 1000).toFixed(1);
    var glasses     = Math.round(totalML / 250);
    var bevL        = (beveragesML / 1000).toFixed(1);
    var foodL       = (foodML / 1000).toFixed(1);

    document.getElementById('wiTotalL').textContent    = totalL + ' L';
    document.getElementById('wiGlasses').textContent   = glasses + ' glasses';
    document.getElementById('wiBeverages').textContent = bevL + ' L (' + Math.round(beveragesML / 250) + ' glasses)';
    document.getElementById('wiFood').textContent      = foodL + ' L (from meals)';

    // Hourly schedule (7am–11pm = 16 waking hours)
    var wakingHours = 16;
    var mlPerHour   = Math.round(beveragesML / wakingHours / 50) * 50;
    var scheduleHTML = '';
    var slots = [
      ['7:00 AM',  'After waking'],
      ['9:00 AM',  'Mid-morning'],
      ['11:00 AM', 'Before lunch'],
      ['1:00 PM',  'With lunch'],
      ['3:00 PM',  'Afternoon'],
      ['5:00 PM',  'Before dinner'],
      ['7:00 PM',  'With dinner'],
      ['9:00 PM',  'Evening'],
    ];
    slots.forEach(function (s) {
      scheduleHTML += '<span style="display:inline-block; margin-right:16px;">⏰ ' + s[0] + ' — ' + mlPerHour + ' ml <span style="color:#888;">(' + s[1] + ')</span></span>';
    });
    document.getElementById('wiSchedule').innerHTML = scheduleHTML;

    // Tips
    var tips = [
      'Start your day with a full glass of water before coffee.',
      'Keep a water bottle visible on your desk as a visual cue.',
      'Drink a glass before each meal to aid digestion and fullness.',
    ];
    if (activity >= 1.2) tips.push('Drink 500 ml in the 2 hours before exercise.');
    if (climate >= 1.15) tips.push('In hot weather, check your urine colour every few hours — aim for pale yellow.');
    if (pregnant)        tips.push('Drink consistently throughout the day — morning sickness can reduce intake.');
    if (breast)          tips.push('Breastfeed and drink a glass of water simultaneously to build the habit.');

    document.getElementById('wiTips').innerHTML = tips.map(function (t) { return '• ' + t; }).join('<br>');

    document.getElementById('wiResults').classList.remove('d-none');
    document.getElementById('wiResults').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  };

})();
</script>
@endsection
