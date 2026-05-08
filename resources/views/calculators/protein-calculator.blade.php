@extends('layouts.app')

@section('title', 'Protein Calculator — Daily Protein for Muscle | MindSnap')
@section('description', 'Free protein intake calculator: find your daily protein target based on weight, goal, and activity level. Science-backed recommendations for athletes and beginners. No signup.')
@section('canonical', config('app.url') . '/protein-calculator')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "WebApplication",
  "name": "Protein Calculator",
  "url": "{{ config('app.url') }}/protein-calculator",
  "description": "Calculate your optimal daily protein intake based on weight, goal, and activity level.",
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
    { "@@type": "ListItem", "position": 3, "name": "Protein Calculator" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [
    { "@@type": "Question", "name": "How much protein do I need per day?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The minimum recommended by the WHO is 0.8g per kg of body weight for sedentary adults. For active individuals, research supports 1.2–1.6g/kg for general fitness, 1.6–2.2g/kg for muscle building, and up to 2.4g/kg during aggressive fat loss to preserve muscle. A 70kg active person building muscle should aim for roughly 112–154g per day." } },
    { "@@type": "Question", "name": "Can you eat too much protein?",
      "acceptedAnswer": { "@@type": "Answer", "text": "For healthy adults without kidney disease, research consistently shows that high-protein diets (up to 3.5g/kg) are safe. The kidneys of healthy people adapt to handle larger protein loads without damage. The main downside is caloric — excess protein can contribute to a calorie surplus. People with existing kidney disease should consult a doctor before increasing protein intake significantly." } },
    { "@@type": "Question", "name": "How much protein do I need to build muscle?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The research-backed optimal range for muscle protein synthesis is 1.6–2.2g per kg of body weight per day. A comprehensive 2018 meta-analysis by Morton et al. found that protein intakes beyond 1.62g/kg/day provided no additional muscle gain benefit on average. However, individuals with very high training volumes or during cutting phases may benefit from the upper end of this range." } },
    { "@@type": "Question", "name": "What is the best protein source for muscle gain?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Complete protein sources containing all essential amino acids are best. Animal sources (chicken, beef, eggs, fish, dairy) are highly bioavailable. Among plant sources, soy and quinoa are complete proteins. Whey protein has the highest leucine content and fastest absorption, making it particularly effective post-workout. Casein digests slowly and is ideal before sleep for overnight muscle protein synthesis." } },
    { "@@type": "Question", "name": "Does protein help with weight loss?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes — protein is the most satiating macronutrient and has the highest thermic effect (25–30% of protein calories are burned just digesting it). High-protein diets reduce hunger hormones (ghrelin) and increase satiety hormones (GLP-1, PYY). During a calorie deficit, eating 1.6–2.4g/kg of protein helps preserve lean muscle mass, which keeps metabolism from dropping." } }
  ]
}
</script>
@endsection

@php
$faqs = [
  ['q' => 'How much protein do I need per day?',
             'a' => 'The minimum recommended by the WHO is 0.8g per kg of body weight for sedentary adults. For active individuals, research supports 1.2–1.6g/kg for general fitness, 1.6–2.2g/kg for muscle building, and up to 2.4g/kg during aggressive fat loss to preserve muscle. A 70kg active person aiming to build muscle should target roughly 112–154g of protein per day.'],
  ['q' => 'Can you eat too much protein?',
             'a' => 'For healthy adults without kidney disease, research consistently shows high-protein diets (up to 3.5g/kg) are safe. The kidneys of healthy people adapt to handle larger protein loads. The practical downside is caloric — excess protein contributes to a calorie surplus if total intake isn\'t managed. People with existing kidney disease should consult a doctor before significantly increasing protein.'],
  ['q' => 'How much protein do I need to build muscle?',
             'a' => 'The evidence-backed optimal range for muscle protein synthesis is 1.6–2.2g per kg of body weight per day. A comprehensive 2018 meta-analysis by Morton et al. (49 studies, 1800+ participants) found protein beyond 1.62g/kg/day provided no additional muscle gain on average. Individuals with high training volumes or in a calorie deficit may benefit from the upper end of this range.'],
  ['q' => 'What is the best protein source for muscle gain?',
             'a' => 'Complete protein sources containing all essential amino acids are most effective. Animal sources — chicken breast, beef, eggs, fish, dairy — are highly bioavailable. Whey protein has the highest leucine content and absorbs fastest, making it excellent post-workout. Casein digests slowly and is ideal before sleep for overnight muscle protein synthesis. Among plant sources, soy and pea protein are the most complete.'],
  ['q' => 'Does protein help with weight loss?',
             'a' => 'Yes — protein is the most satiating macronutrient with a thermic effect of 25–30% (meaning 25–30% of protein calories are burned digesting it). High-protein diets reduce hunger hormones (ghrelin) and increase satiety hormones (PYY, GLP-1). During a calorie deficit, eating 1.6–2.4g/kg of protein preserves lean muscle mass and prevents the metabolic slowdown associated with low-protein diets.'],
  ['q' => 'How should I spread protein across the day?',
             'a' => 'Distribute protein across 3–5 meals rather than concentrating it in one or two large servings. Research shows that muscle protein synthesis is maximised when each meal contains at least 2–3g of leucine — the branched-chain amino acid that acts as the anabolic trigger. For most adults, this means 30–50g of protein per meal, 3–5 times per day. Eating protein throughout the day keeps amino acid levels elevated, which supports muscle repair and growth over a longer window.'],
];

$relatedTools = [
  ['icon' => '🔥', 'name' => 'Calorie Calculator', 'slug' => 'calorie-calculator', 'desc' => 'Find your total daily energy expenditure (TDEE).'],
  ['icon' => '🥗', 'name' => 'Macro Calculator', 'slug' => 'macro-calculator', 'desc' => 'Get your protein, carb, and fat targets in grams.'],
  ['icon' => '📉', 'name' => 'Calorie Deficit', 'slug' => 'calorie-deficit-calculator', 'desc' => 'Find the exact calorie target to reach your goal weight.'],
  ['icon' => '💪', 'name' => 'BMI Calculator', 'slug' => 'bmi-calculator', 'desc' => 'Check if your weight is in a healthy range for your height.'],
  ['icon' => '📏', 'name' => 'Body Fat Calculator', 'slug' => 'body-fat-calculator', 'desc' => 'Estimate your body fat percentage from measurements.'],
  ['icon' => '⚖️', 'name' => 'Ideal Weight', 'slug' => 'ideal-weight-calculator', 'desc' => 'Find your healthy weight range using 4 clinical formulas.'],
];
@endphp

@section('styles')
<style>
.prot-unit-select   { max-width: 80px; }
.prot-goal-label    { border: 2px solid #e0e0e0; cursor: pointer; font-size: .88rem; }
.prot-optional      { font-size: .83rem; }
.prot-details       { background: #f8f9fa; font-size: .88rem; color: #555; }
.prot-note          { color: #888; font-size: .82rem; }
.prot-food-card     { border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,.06); }
.prot-food-icon     { font-size: 2rem; margin-bottom: 8px; }
.prot-food-name     { font-size: .88rem; color: var(--primary-dark); }
.prot-food-note     { font-size: .74rem; color: #999; margin-top: 6px; line-height: 1.5; }
.prot-badge         { color: #fff; border-radius: 6px; padding: 4px 8px; font-size: .75rem; font-weight: 700; min-width: 80px; text-align: center; flex-shrink: 0; margin-top: 2px; }
.prot-badge-grey    { background: #6c757d; }
.prot-badge-teal    { background: #0b7285; }
.prot-badge-orange  { background: #e97b1e; }
.prot-badge-green   { background: var(--fitness); }
.prot-badge-indigo  { background: #5048d6; }
.prot-adv-toggle    { font-size: .85rem; font-weight: 600; color: var(--fitness); cursor: pointer; border: none; background: none; padding: 4px 0; }
.prot-adv-toggle::after { content: '  ▾'; }
.prot-adv-toggle[aria-expanded="true"]::after { content: '  ▲'; }
.prot-meal-btn      { border-radius: 8px; border: 1px solid #e0e0e0; background: #f8f9fa; font-size: .82rem; padding: 5px 14px; }
.prot-meal-btn.active { background: var(--fitness); color: #fff; border-color: transparent; }
.prot-meal-card     { background: #f8f9fa; border-radius: 10px; padding: 12px; text-align: center; }
.prot-meal-g        { font-size: 1.3rem; font-weight: 800; color: var(--fitness); }
.prot-leucine-box   { background: #e8f5e9; border-radius: 10px; padding: 12px 16px; font-size: .82rem; margin-top: 10px; }
.prot-last-result   { font-size: .8rem; color: #888; padding: 6px 10px; background: #f8f9fa; border-radius: 6px; margin-bottom: 10px; }
</style>
@endsection

@section('content')

{{-- Hero --}}
<section class="ms-hero">
  <div class="container-xl">
    <div class="row align-items-start g-5">
      <div class="col-lg-7">
        <x-breadcrumb :crumbs="[
          ['url' => route('home'), 'name' => 'Home'],
          ['url' => route('category.fitness'), 'name' => 'Fitness Tools'],
          ['url' => '', 'name' => 'Protein Calculator'],
        ]"/>
        <h1 class="mb-2 ms-hero-title">
          🥩 Protein Calculator — Daily Protein Intake for Your Goal
        </h1>
        <p class="ms-hero-desc">
          Find your ideal daily protein target based on your weight, activity level, and goal — with meal-by-meal breakdown.
        </p>

        <div class="card border-0 mb-n4 ms-tool-card">
          <div class="card-body p-4 p-md-5">
            <div class="row g-3">
              <div class="col-sm-6">
                <label class="form-label fw-600">Weight</label>
                <div class="input-group">
                  <input type="number" id="protWeight" class="form-control" value="70" min="30" max="300">
                  <select id="protUnit" class="form-select prot-unit-select">
                    <option value="kg">kg</option>
                    <option value="lbs">lbs</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <label class="form-label fw-600">Activity Level</label>
                <select id="protActivity" class="form-select">
                  <option value="sedentary">Sedentary (desk job, no exercise)</option>
                  <option value="light">Lightly Active (1–3x/week)</option>
                  <option value="moderate" selected>Moderately Active (3–5x/week)</option>
                  <option value="active">Very Active (6–7x/week)</option>
                  <option value="athlete">Athlete (2x/day training)</option>
                </select>
              </div>
              <div class="col-12">
                <label class="form-label fw-600">Goal</label>
                <div class="row g-2">
                  @foreach([['maintain','Maintain Muscle'],['fat-loss','Lose Fat'],['muscle','Build Muscle'],['athlete','Athletic Performance']] as [$v,$l])
                  <div class="col-6">
                    <label class="d-flex align-items-center gap-2 p-2 rounded prot-goal-label">
                      <input type="radio" name="protGoal" value="{{ $v }}" {{ $v==='muscle'?'checked':'' }}> {{ $l }}
                    </label>
                  </div>
                  @endforeach
                </div>
              </div>
              <div class="col-12">
                <label class="form-label fw-600">Body Fat % <span class="text-muted fw-400 prot-optional">optional — improves accuracy</span></label>
                <input type="number" id="protBF" class="form-control" placeholder="e.g. 20" min="3" max="60">
              </div>
            </div>
            <div id="protLastResult" class="prot-last-result d-none"></div>
            <button class="btn btn-cta w-100 mt-4" onclick="calcProtein()">Calculate Protein →</button>

            <div id="protResults" class="mt-4 d-none">
              <div class="ms-divider"></div>
              <div class="row g-3 text-center">
                <div class="col-4">
                  <div class="ms-stat ms-stat-green">
                    <div id="protMin" class="ms-stat-val text-green-brand">—</div>
                    <div class="ms-stat-label">Minimum (g/day)</div>
                  </div>
                </div>
                <div class="col-4">
                  <div class="ms-stat ms-stat-blue">
                    <div id="protTarget" class="ms-stat-val-lg text-mid">—</div>
                    <div class="ms-stat-label">Target (g/day)</div>
                  </div>
                </div>
                <div class="col-4">
                  <div class="ms-stat ms-stat-orange">
                    <div id="protMax" class="ms-stat-val text-orange-brand">—</div>
                    <div class="ms-stat-label">Upper (g/day)</div>
                  </div>
                </div>
              </div>
              <div id="protDetails" class="mt-3 p-3 rounded prot-details"></div>

              <div class="mt-3">
                <button class="prot-adv-toggle" type="button" data-bs-toggle="collapse"
                        data-bs-target="#protAdvanced" aria-expanded="false"
                        aria-controls="protAdvanced">
                  Show meal distribution &amp; leucine guide
                </button>
                <div class="collapse mt-3" id="protAdvanced">
                  <div class="d-flex gap-2 mb-3" id="protMealBtns">
                    <button class="btn btn-sm prot-meal-btn active" data-meals="3">3 meals</button>
                    <button class="btn btn-sm prot-meal-btn" data-meals="4">4 meals</button>
                    <button class="btn btn-sm prot-meal-btn" data-meals="5">5 meals</button>
                  </div>
                  <div id="protMealGrid" class="row g-2 mb-2"></div>
                  <div id="protLeuBox" class="prot-leucine-box"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-5 d-none d-lg-block pt-2">
        <div class="ms-facts-wrap">
          <h3 class="ms-facts-title">Protein Quick Facts</h3>
          @foreach([
            ['0.8g/kg','Minimum for sedentary adults (WHO)'],
            ['1.6–2.2g/kg','Optimal range for muscle building'],
            ['4 cal/g','Calories per gram of protein'],
            ['25–30%','Thermic effect — calories burned digesting protein'],
            ['~30g','Leucine threshold per meal for muscle synthesis'],
          ] as [$stat,$label])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div class="ms-fact-pill ms-fact-pill-fitness">{{ $stat }}</div>
            <div class="ms-fact-label">{{ $label }}</div>
          </div>
          @endforeach
          <p class="ms-fact-source">Sources: WHO, Morton et al. 2018, Stokes et al. 2018</p>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- How It Works --}}
<section class="ms-section-white">
  <div class="container-xl">
    <div class="row align-items-center g-5">
      <div class="col-lg-5">
        <span class="ms-badge ms-badge-fitness mb-3">How It Works</span>
        <h2 class="mb-4">How Much Protein Do You Actually Need? The Research</h2>
        <img src="{{ asset('images/protein-intake-scale.svg') }}" alt="Daily protein intake scale: 0.8g per kg for sedentary adults, 1.2–1.6g for active people, 1.6–2.2g per kg for muscle building" width="640" height="130" loading="lazy" class="img-fluid rounded-3 mb-4">
        <p>Protein recommendations vary widely — from the bare-minimum WHO figure of 0.8g/kg to the upper athlete range of 2.4g/kg. The difference matters enormously: a 80kg person following the minimum gets 64g/day, while an athlete may target 192g/day.</p>
        <p>The key variable is your goal. For muscle gain, a landmark 2018 meta-analysis by Morton et al. covering 49 studies found the threshold for additional benefit sits at 1.62g/kg/day. Beyond that point, extra protein didn't produce more muscle. During fat loss, however, going higher (2.0–2.4g/kg) helps preserve muscle despite the calorie deficit.</p>
        <p>If you know your body fat percentage, the calculator bases intake on lean mass — a more accurate method since fat tissue doesn't require protein for maintenance.</p>
      </div>
      <div class="col-lg-7">
        <div class="p-4 rounded-3 ms-data-box">
          <p class="ms-panel-head mb-3">Protein targets by goal (per kg body weight)</p>
          @foreach([
            ['Sedentary / Maintenance','0.8–1.0g/kg','Meet basic tissue repair needs','grey'],
            ['General Fitness','1.2–1.4g/kg','Support activity and recovery','teal'],
            ['Fat Loss (cutting)','1.6–2.2g/kg','Preserve muscle in calorie deficit','orange'],
            ['Muscle Gain (bulking)','1.6–2.0g/kg','Maximise muscle protein synthesis','green'],
            ['Athletic Performance','1.8–2.4g/kg','High-volume training recovery','indigo'],
          ] as [$goal,$range,$desc,$key])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div class="prot-badge prot-badge-{{ $key }}">{{ $range }}</div>
            <div>
              <div class="fw-600 ms-ref-title">{{ $goal }}</div>
              <div class="ms-ref-desc">{{ $desc }}</div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Food sources --}}
<section class="ms-section-muted">
  <div class="container-xl">
    <div class="text-center mb-5">
      <h2>High-Protein Foods: Grams per 100g</h2>
      <p class="text-muted ms-intro-text">The most protein-dense foods to help you hit your daily target.</p>
    </div>
    <div class="row g-3 justify-content-center">
      @foreach([
        ['🍗','Chicken breast (cooked)','31g','Low fat, high bioavailability'],
        ['🐟','Tuna (canned in water)','26g','Cheap, convenient, omega-3 rich'],
        ['🥚','Eggs (whole)','13g','Complete amino acid profile'],
        ['🧀','Cottage cheese (low-fat)','11g','High casein — slow digesting'],
        ['🥩','Beef (lean mince, cooked)','26g','High in creatine and zinc'],
        ['🐠','Salmon (cooked)','25g','High protein + omega-3 fatty acids'],
        ['🫘','Edamame (cooked)','11g','Best plant-based protein source'],
        ['🥛','Greek yoghurt (plain)','10g','Probiotic + high protein snack'],
      ] as [$icon,$food,$protein,$note])
      <div class="col-6 col-md-3">
        <div class="card border-0 h-100 text-center p-3 prot-food-card">
          <div class="prot-food-icon">{{ $icon }}</div>
          <div class="fw-700 prot-food-name">{{ $food }}</div>
          <div class="fw-700 mt-1 ms-stat-val-sm text-fitness">{{ $protein }}</div>
          <div class="prot-food-note">{{ $note }}</div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="protFaq" />


{{-- Long-tail sections --}}
<section class="ms-section-accent">
  <div class="container ms-longtail">
    <h2 class="mb-4 text-brand">Protein Calculator for Muscle Gain — How Much Is Enough?</h2>
    <p>When building muscle, the sweet spot for protein is 1.6–2.2g per kg of body weight per day. Research by Morton et al. (2018) found that above 1.62g/kg, additional protein provides diminishing returns for muscle gain in most people. However, during a calorie surplus (bulking), staying toward the upper end (2.0–2.2g/kg) ensures amino acids are never the limiting factor for muscle protein synthesis — even if training volume is high.</p>
    <p>Distribute protein evenly across 3–5 meals. Each meal should contain at least 2–3g of leucine — the key branched-chain amino acid that triggers muscle protein synthesis. Practical targets: 30–50g of protein per meal for most adults.</p>

    <h2 class="mt-5 mb-4 text-brand">Protein Intake for Weight Loss — Does High Protein Help?</h2>
    <p>During a calorie deficit, protein becomes more critical, not less. When calories are restricted, the body increases the rate at which it breaks down muscle for energy. Eating 1.8–2.4g/kg of protein during fat loss preserves lean muscle mass, keeping your metabolism from slowing as much as it otherwise would. High-protein diets also significantly reduce hunger — protein suppresses ghrelin (the hunger hormone) more than carbohydrates or fat, making a calorie deficit easier to sustain.</p>

    <h2 class="mt-5 mb-4 text-brand">Protein Calculator for Women — Are Requirements Different?</h2>
    <p>Women's protein requirements per kilogram of lean body mass are essentially the same as men's. The total gram target is lower simply because women typically have less muscle mass and lower body weight. For women focused on body composition, 1.6–2.0g/kg supports both muscle maintenance and fat loss. Women during pregnancy need an additional 25g/day (roughly 1.1g/kg total). Breastfeeding adds another 20g/day above baseline. These increases support fetal development and milk production without compromising maternal muscle mass.</p>
  </div>
</section>

<x-related-tools :tools="$relatedTools" heading="More Fitness Calculators" />


{{-- SEO block --}}
<section class="ms-section-seo">
  <div class="container-xl">
    <div class="row justify-content-center">
      <div class="col-lg-8 ms-seo-body">
        <h2 class="mb-4 ms-seo-h2">Protein Calculator: What the Science Actually Says</h2>
        <p>Protein recommendations have been revised upward repeatedly over the past two decades as research techniques have improved. The longstanding 0.8g/kg guideline was set to prevent deficiency in sedentary populations — not to optimise muscle retention, recovery, or body composition in active people.</p>
        <h3 class="ms-seo-h3">The Leucine Threshold</h3>
        <p>Each meal needs to clear the leucine threshold — approximately 2–3g of leucine — to trigger muscle protein synthesis. Below that threshold, the anabolic signal is weak even if total daily protein is adequate. This is why protein quality and meal distribution matter alongside total intake. Whey protein, eggs, and chicken breast all clear the leucine threshold in a 30g serving; plant sources may require larger portions or combination.</p>
        <h3 class="ms-seo-h3">Why Protein Timing Matters Less Than You Think</h3>
        <p>The "anabolic window" — the idea that you must consume protein within 30 minutes of training — has been largely debunked. Total daily protein is far more important than precise timing. That said, consuming protein within 2 hours post-workout is still a sensible practice, particularly in a fasted state.</p>
        <div class="mt-4 p-4 rounded-3 ms-note ms-note-green">
          <p class="mb-0 ms-disclaimer"><strong>Note:</strong> This tool provides general nutrition guidance. Individual protein needs can vary based on medical conditions, age, and health status. Consult a registered dietitian or physician before making significant dietary changes, especially if you have kidney disease, liver conditions, or other chronic health issues.</p>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')
<script>
(function () {
  var lastTargetG = null;

  // Load saved inputs
  (function () {
    try {
      var s = JSON.parse(localStorage.getItem('prot_last') || 'null');
      if (!s) return;
      if (s.weight) document.getElementById('protWeight').value  = s.weight;
      if (s.unit)   document.getElementById('protUnit').value    = s.unit;
      if (s.act)    document.getElementById('protActivity').value = s.act;
      if (s.goal) {
        var radio = document.querySelector('input[name="protGoal"][value="' + s.goal + '"]');
        if (radio) radio.checked = true;
      }
      if (s.bf)     document.getElementById('protBF').value      = s.bf;
      if (s.targetG) {
        var el = document.getElementById('protLastResult');
        el.textContent = 'Last: ' + s.targetG + 'g/day protein target';
        el.classList.remove('d-none');
      }
    } catch (e) {}
  })();

  function buildMealGrid(n) {
    if (!lastTargetG) return;
    var perMeal = Math.round(lastTargetG / n);
    var html = '';
    for (var i = 1; i <= n; i++) {
      html += '<div class="col-' + (n === 3 ? '4' : (n === 4 ? '3' : (i <= 2 ? '6' : '4'))) + '">'
        + '<div class="prot-meal-card">'
        + '<div class="text-muted fw-semibold" style="font-size:.72rem">Meal ' + i + '</div>'
        + '<div class="prot-meal-g">' + perMeal + 'g</div>'
        + '</div></div>';
    }
    document.getElementById('protMealGrid').innerHTML = html;

    var leuPerMeal = perMeal >= 30 ? '2.5–3.5g' : (perMeal >= 20 ? '1.5–2.5g' : '<1.5g');
    var leuStatus  = perMeal >= 30 ? '✅ Clears the leucine threshold' : '⚠️ May not fully trigger muscle protein synthesis — consider larger meals or fewer per day';
    document.getElementById('protLeuBox').innerHTML =
      '<strong>Leucine content per meal (~' + perMeal + 'g protein):</strong> ' + leuPerMeal + '. '
      + leuStatus + '.<br>'
      + '<span class="text-muted">Aim for at least 2–3g leucine per meal to fully activate mTOR signalling (the anabolic switch). Whey, eggs, and chicken easily clear this threshold at 30g+ protein.</span>';
  }

  document.getElementById('protMealBtns').addEventListener('click', function (e) {
    var btn = e.target.closest('.prot-meal-btn');
    if (!btn) return;
    document.querySelectorAll('.prot-meal-btn').forEach(function (b) { b.classList.remove('active'); });
    btn.classList.add('active');
    buildMealGrid(parseInt(btn.dataset.meals));
  });

  window.calcProtein = function () {
    var weight = parseFloat(document.getElementById('protWeight').value);
    var unit   = document.getElementById('protUnit').value;
    var act    = document.getElementById('protActivity').value;
    var goal   = document.querySelector('input[name="protGoal"]:checked').value;
    var bf     = parseFloat(document.getElementById('protBF').value);

    if (!weight || weight <= 0) return;
    var kg = unit === 'lbs' ? weight / 2.2046 : weight;
    var leanKg = (!isNaN(bf) && bf > 0 && bf < 80) ? kg * (1 - bf / 100) : kg;

    var ranges = {
      sedentary: { min: 0.8,  target: 1.0,  max: 1.2 },
      light:     { min: 1.0,  target: 1.3,  max: 1.5 },
      moderate:  { min: 1.2,  target: 1.5,  max: 1.8 },
      active:    { min: 1.4,  target: 1.7,  max: 2.0 },
      athlete:   { min: 1.6,  target: 2.0,  max: 2.4 },
    };

    var goalMult = { maintain: 1.0, 'fat-loss': 1.2, muscle: 1.1, athlete: 1.15 };
    var r = ranges[act];
    var m = goalMult[goal];

    var minG    = Math.round(r.min   * m * leanKg);
    var targetG = Math.round(r.target * m * leanKg);
    var maxG    = Math.round(r.max   * m * leanKg);
    lastTargetG = targetG;

    var mealsPerDay = 4;
    var perMeal = Math.round(targetG / mealsPerDay);
    var cals    = Math.round(targetG * 4);
    var bfNote  = (!isNaN(bf) && bf > 0) ? ' (based on ' + Math.round(leanKg) + 'kg lean mass)' : '';

    document.getElementById('protMin').textContent    = minG + 'g';
    document.getElementById('protTarget').textContent = targetG + 'g';
    document.getElementById('protMax').textContent    = maxG + 'g';
    document.getElementById('protDetails').innerHTML  =
      '<strong>Daily target: ' + targetG + 'g</strong>' + bfNote + '<br>' +
      'Calories from protein: ' + cals + ' kcal<br>' +
      '<span class="prot-note">≈ ' + Math.round(targetG / 31) + ' chicken breasts · ' +
      Math.round(targetG / 13) + ' eggs · ' + Math.round(targetG / 25) + ' cans of tuna</span>';

    // Save to localStorage
    try {
      localStorage.setItem('prot_last', JSON.stringify({ weight: weight, unit: unit, act: act, goal: goal, bf: isNaN(bf) ? '' : bf, targetG: targetG }));
    } catch (e) {}
    var lastEl = document.getElementById('protLastResult');
    lastEl.textContent = 'Last: ' + targetG + 'g/day protein target';
    lastEl.classList.remove('d-none');

    // Build default meal grid
    var activeMeals = document.querySelector('.prot-meal-btn.active');
    buildMealGrid(activeMeals ? parseInt(activeMeals.dataset.meals) : 3);

    // Reset advanced
    document.getElementById('protAdvanced').classList.remove('show');
    var advBtn = document.querySelector('[data-bs-target="#protAdvanced"]');
    if (advBtn) advBtn.setAttribute('aria-expanded', 'false');

    document.getElementById('protResults').classList.remove('d-none');
    document.getElementById('protResults').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  };
})();
</script>
@endsection
