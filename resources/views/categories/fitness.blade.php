@extends('layouts.app')

@section('title', 'Free Fitness Calculators — BMI, Calorie, Macro & Body Fat | MindSnap')
@section('description', 'Free fitness calculators: BMI calculator, calorie calculator, calorie deficit, macro calculator, protein intake, body fat percentage, one rep max, heart rate zones, running pace, and ideal weight. Instant results, no signup.')
@section('canonical', config('app.url') . '/fitness-tools')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@graph": [
    {
      "@@type": "CollectionPage",
      "@@id": "{{ config('app.url') }}/fitness-tools#collection",
      "url": "{{ config('app.url') }}/fitness-tools",
      "name": "Free Fitness Calculators",
      "description": "11 free fitness calculators including BMI, TDEE, calorie deficit, macro, protein, body fat, heart rate zones, running pace, ideal weight, and workout volume.",
      "inLanguage": "en",
      "publisher": { "@@type": "Organization", "name": "MindSnap", "url": "{{ config('app.url') }}" }
    },
    {
      "@@type": "BreadcrumbList",
      "itemListElement": [
        { "@@type": "ListItem", "position": 1, "name": "Home",          "item": "{{ config('app.url') }}" },
        { "@@type": "ListItem", "position": 2, "name": "Fitness Tools", "item": "{{ config('app.url') }}/fitness-tools" }
      ]
    },
    {
      "@@type": "FAQPage",
      "mainEntity": [
        { "@@type": "Question", "name": "What is a healthy BMI?",                    "acceptedAnswer": { "@@type": "Answer", "text": "A healthy BMI is between 18.5 and 24.9. Underweight is below 18.5, overweight is 25–29.9, and obese is 30 or above." } },
        { "@@type": "Question", "name": "How many calories should I eat to lose weight?", "acceptedAnswer": { "@@type": "Answer", "text": "A safe calorie deficit is 500–750 calories per day. Calculate your TDEE first, then subtract your deficit." } },
        { "@@type": "Question", "name": "What are macros and how do I calculate them?",   "acceptedAnswer": { "@@type": "Answer", "text": "Macros are protein, carbohydrates, and fats. A standard split is 30% protein, 40% carbs, 30% fat." } },
        { "@@type": "Question", "name": "How much protein do I need per day?",            "acceptedAnswer": { "@@type": "Answer", "text": "For muscle building, aim for 1.6–2.2g of protein per kg of bodyweight." } },
        { "@@type": "Question", "name": "How do I calculate my daily calorie needs?",     "acceptedAnswer": { "@@type": "Answer", "text": "Daily calorie needs = BMR × activity factor. BMR is calculated from age, sex, weight, and height using the Mifflin-St Jeor equation." } }
      ]
    }
  ]
}
</script>
@endsection

@php
$cat  = config('mindsnap.categories')['fitness'];
$faqs = [
  ['q' => 'What is a healthy BMI?',
   'a' => 'A healthy BMI is <strong>18.5–24.9</strong>. Below 18.5 is underweight, 25–29.9 is overweight, and 30+ is obese. BMI doesn\'t distinguish fat from muscle — athletes often show high BMI with low body fat. Pair it with a <a href="/body-fat-calculator">body fat calculator</a> for accuracy.'],
  ['q' => 'How many calories should I eat to lose weight?',
   'a' => 'Calculate your TDEE first with our <a href="/calorie-calculator">Calorie Calculator</a>, then subtract 500–750 kcal/day for safe fat loss (0.5–0.75 kg/week). Never go below 1,200 kcal (women) or 1,500 kcal (men) without medical supervision.'],
  ['q' => 'What are macros and how do I calculate them?',
   'a' => 'Macros are protein, carbohydrates, and fat. A common split for fat loss is <strong>40% protein / 30% carbs / 30% fat</strong>. For muscle gain: 30% protein / 50% carbs / 20% fat. Use our <a href="/macro-calculator">Macro Calculator</a> for a personalised breakdown.'],
  ['q' => 'How much protein do I need per day?',
   'a' => 'For muscle building: <strong>1.6–2.2g per kg of bodyweight</strong> (0.7–1g/lb). For maintenance: 0.8g/kg. Spread intake across 3–5 meals for optimal muscle protein synthesis. Our <a href="/protein-calculator">Protein Calculator</a> gives your exact daily target.'],
  ['q' => 'How do I calculate my one rep max?',
   'a' => 'The most accurate formula is <strong>Epley: 1RM = weight × (1 + reps/30)</strong>. Perform 3–5 reps at a challenging weight and plug the numbers into our <a href="/one-rep-max-calculator">One Rep Max Calculator</a>. Never attempt a true 1RM without a spotter.'],
  ['q' => 'How do I calculate my daily calorie needs?',
   'a' => 'Calorie needs = BMR × activity multiplier. BMR uses the <strong>Mifflin-St Jeor equation</strong> (age, sex, height, weight). Sedentary × 1.2; moderately active × 1.55; very active × 1.725. Our <a href="/calorie-calculator">Calorie Calculator</a> shows targets for loss, maintenance, and gain.'],
  ['q' => 'How many calories should I eat to lose 1 kg per week?',
   'a' => 'To lose 1 kg per week, you need a 1,000-calorie daily deficit below your TDEE — though this rate risks muscle loss and is difficult to sustain. Most professionals recommend a 500-calorie deficit (0.5 kg/week) for steady fat loss. Use our <a href="/calorie-deficit-calculator">Calorie Deficit Calculator</a>.'],
  ['q' => 'What is a healthy BMI for women?',
   'a' => 'The standard healthy BMI range (18.5–24.9) applies to both men and women. However, women naturally carry a higher percentage of body fat than men at the same BMI. Some researchers argue the healthy range for women extends to 25–27 without increased health risk, particularly for women over 60.'],
  ['q' => 'How do I calculate my macros for weight loss?',
   'a' => 'Start with your calorie target (TDEE minus deficit). Allocate protein first at 1.6–2g/kg (critical for preserving muscle), fat at a minimum of 0.8g/kg (hormonal health), then fill remaining calories with carbohydrates. Use our <a href="/macro-calculator">Macro Calculator</a> for your personalised split.'],
];

$relatedTools = [
  ['icon' => '😴', 'name' => 'Sleep Tools',     'slug' => '/sleep-tools',     'desc' => 'Bedtime, sleep cycles & nap calculators'],
  ['icon' => '🥗', 'name' => 'Nutrition Tools',  'slug' => '/nutrition-tools', 'desc' => 'Water intake & fasting schedule'],
  ['icon' => '🧠', 'name' => 'Brain Quizzes',    'slug' => '/quizzes',         'desc' => 'IQ test, GK quiz & more'],
  ['icon' => '⏰', 'name' => 'Life Tools',        'slug' => '/life-tools',      'desc' => 'Age, dates & life calculators'],
];
@endphp

@section('content')

<nav aria-label="Breadcrumb" class="ms-cat-nav">
  <div class="container-xl">
    <ol class="breadcrumb mb-0">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Fitness Tools</li>
    </ol>
  </div>
</nav>

{{-- Hero --}}
<section class="ms-hero">
  <div class="container-xl">
    <div class="row align-items-center g-4">
      <div class="col-lg-8">
        <div class="d-flex align-items-center gap-3 mb-3">
          <span class="ms-hero-icon">{{ $cat['icon'] }}</span>
          <span class="badge ms-badge ms-badge-fitness">{{ $cat['label'] }}</span>
        </div>
        <h1 class="ms-hero-title">Free Fitness Calculators — BMI, Calories, Macros &amp; More</h1>
        <p class="ms-hero-desc-wide">
          Calculate your BMI, daily calories, macro split, protein needs, body fat percentage, one rep max, heart rate zones, and more.
          11 science-based calculators — free, instant, no signup.
        </p>
        <div class="d-flex flex-wrap gap-3">
          <div class="ms-hero-feature d-flex align-items-center gap-2">
            <svg width="16" height="16" fill="none" stroke="#28a745" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            Science-based formulas
          </div>
          <div class="ms-hero-feature d-flex align-items-center gap-2">
            <svg width="16" height="16" fill="none" stroke="#28a745" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            Metric &amp; imperial
          </div>
          <div class="ms-hero-feature d-flex align-items-center gap-2">
            <svg width="16" height="16" fill="none" stroke="#28a745" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            Instant, no signup
          </div>
        </div>
      </div>
      <div class="col-lg-4 d-none d-lg-flex justify-content-end">
        <div class="ms-hero-stat-box ms-hero-stat-box-fitness">
          <div class="ms-hero-stat-num">11</div>
          <div class="ms-hero-stat-sub">Fitness Tools</div>
          <div class="ms-hero-stat-div"></div>
          <div class="ms-hero-stat-val">5M+</div>
          <div class="ms-hero-stat-sub">Monthly searches</div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Tools Grid --}}
<section class="ms-section-tools">
  <div class="container-xl">
    <div class="d-flex align-items-center justify-content-between mb-4">
      <h2 class="ms-section-h2">All Fitness Calculators</h2>
      <span class="text-muted text-sm">{{ count($tools) ?: 11 }} tools</span>
    </div>
    @if(count($tools))
    <div class="row g-4">
      @foreach($tools as $tool)
      <div class="col-sm-6 col-lg-4">
        <a href="/{{ $tool['slug'] }}" class="tool-card d-block p-4 h-100 text-decoration-none ms-tool-card-fitness">
          <div class="d-flex align-items-start gap-3">
            <span class="ms-tool-icon">{{ $tool['icon'] ?? '💪' }}</span>
            <div>
              <div class="ms-tool-name">{{ $tool['name'] }}</div>
              <div class="ms-tool-desc">{{ $tool['description'] }}</div>
              @if(!empty($tool['monthly_searches']) && $tool['monthly_searches'] > 0)
              <div class="mt-2"><span class="badge-searches">{{ number_format($tool['monthly_searches'] / 1000) }}K searches/mo</span></div>
              @endif
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
    @else
    <div class="row g-4">
      @foreach([
        ['⚖️','BMI Calculator',           '/bmi-calculator',            'Calculate your Body Mass Index and healthy weight range.',         '4,090K'],
        ['🔥','Calorie Calculator',        '/calorie-calculator',        'Find your TDEE and daily calorie needs.',                          '1,000K'],
        ['📉','Calorie Deficit Calculator','/calorie-deficit-calculator','Set a safe deficit to lose fat without losing muscle.',             '301K'],
        ['🥩','Macro Calculator',          '/macro-calculator',          'Get your protein, carb, and fat split for your goal.',             '165K'],
        ['💊','Protein Calculator',        '/protein-calculator',        'Daily protein intake for your weight and activity level.',         '135K'],
        ['🏋️','One Rep Max Calculator',    '/one-rep-max-calculator',    'Estimate your 1RM for any lift from reps and weight.',             '90K'],
        ['📏','Body Fat Calculator',       '/body-fat-calculator',       'Estimate body fat % using the US Navy method.',                    '550K'],
        ['❤️','Heart Rate Calculator',     '/heart-rate-calculator',     'Find your max heart rate and 5 training zones.',                   '201K'],
        ['🏃','Running Pace Calculator',   '/running-pace-calculator',   'Pace, speed, and finish time for any race distance.',              '135K'],
        ['🎯','Ideal Weight Calculator',   '/ideal-weight-calculator',   'Your healthy weight range based on height.',                       '301K'],
        ['📋','Workout Volume Calculator', '/workout-volume-calculator', 'Track sets × reps × weight for progressive overload.',             '18K'],
      ] as [$icon,$name,$slug,$desc,$searches])
      <div class="col-sm-6 col-lg-4">
        <a href="{{ $slug }}" class="tool-card d-block p-4 h-100 text-decoration-none ms-tool-card-fitness">
          <div class="d-flex align-items-start gap-3">
            <span class="ms-tool-icon">{{ $icon }}</span>
            <div>
              <div class="ms-tool-name">{{ $name }}</div>
              <div class="ms-tool-desc">{{ $desc }}</div>
              <div class="mt-2"><span class="badge-searches">{{ $searches }} searches/mo</span></div>
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
    @endif
  </div>
</section>

{{-- Quick Reference --}}
<section class="ms-section-white">
  <div class="container-xl">
    <h2 class="mb-4 text-center">Quick Fitness Reference</h2>
    <div class="row g-3 justify-content-center">
      @foreach([
        ['⚖️','18.5–24.9','Healthy BMI range (WHO)'],
        ['🔥','500 kcal', 'Safe daily deficit for fat loss'],
        ['💊','1.6–2.2g/kg','Protein for muscle building'],
        ['❤️','220 – age','Max heart rate formula (BPM)'],
        ['💧','0.033L/kg','Daily water intake baseline'],
        ['🎯','70–80%', 'Ideal body fat reduction zone'],
      ] as [$icon,$stat,$label])
      <div class="col-6 col-md-4 col-lg-2">
        <div class="tool-card p-3 text-center h-100">
          <div class="ms-mini-icon">{{ $icon }}</div>
          <div class="ms-mini-val">{{ $stat }}</div>
          <div class="ms-mini-label">{{ $label }}</div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- SEO Content --}}
<section class="ms-section-accent">
  <div class="container ms-longtail">
    <h2 class="mb-4 text-brand">Free Fitness Calculators for Weight Loss</h2>
    <p>Losing weight requires a calorie deficit — burning more than you consume. Our fitness calculators give you every number you need: your TDEE (total daily energy expenditure) tells you how many calories you burn at your current activity level, the calorie deficit calculator tells you how large a deficit to create for your target rate of loss, and the macro calculator splits that calorie target into protein, carbohydrates, and fat based on your goals. Together, these three calculators replace a dietitian's first consultation.</p>
    <h2 class="mt-5 mb-4 text-brand">Free Fitness Calculators for Building Muscle</h2>
    <p>Building muscle requires a calorie surplus paired with adequate protein. Use the protein calculator to find your daily protein target (typically 1.6–2.2g per kg of bodyweight for muscle gain), the one rep max calculator to structure your progressive overload, and the workout volume calculator to optimise your weekly training sets per muscle group. The body fat calculator gives you a baseline so you can track body composition changes rather than relying solely on the scales.</p>
    <h2 class="mt-5 mb-4 text-brand">BMI Calculator — Is BMI Still Useful in 2025?</h2>
    <p>BMI (Body Mass Index) is widely criticised for ignoring muscle mass, bone density, and fat distribution — a muscular athlete and a sedentary person of the same height and weight get the same BMI score. Despite its limitations, BMI remains a useful first-pass population health screening tool. For a more complete picture, pair your BMI with a body fat percentage measurement. Our body fat calculator uses the Navy method (neck, waist, and hip measurements) which is more accurate than BMI for assessing body composition.</p>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="fitnessFaq" />

<x-related-tools :tools="$relatedTools" heading="Explore More Tools" />

@endsection
