@extends('layouts.app')

@section('title', 'Body Fat Calculator — Estimate Body Fat Percentage by Measurements | MindSnap')
@section('description', 'Free body fat percentage calculator: use Navy method measurements (neck, waist, hips) to estimate your body fat. Includes healthy range chart for men and women. No signup.')
@section('canonical', config('app.url') . '/body-fat-calculator')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "WebApplication",
  "name": "Body Fat Calculator",
  "url": "{{ config('app.url') }}/body-fat-calculator",
  "description": "Estimate your body fat percentage using the US Navy method with neck, waist, and hip measurements.",
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
    { "@@type": "ListItem", "position": 3, "name": "Body Fat Calculator" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [
    { "@@type": "Question", "name": "What is a healthy body fat percentage?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Healthy body fat ranges differ by sex. For men, the American Council on Exercise (ACE) classifies 10–20% as fit/healthy, 6–13% as athletic, and above 25% as obese. For women, 18–28% is healthy, 14–20% is athletic, and above 32% is classified as obese. Women naturally carry more essential fat (around 10–13%) than men (2–5%) due to hormonal and reproductive functions. Body fat percentage is a more meaningful health marker than body weight alone because it separates lean tissue from fat mass." } },
    { "@@type": "Question", "name": "How accurate is the Navy body fat method?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The US Navy body fat formula has been validated against DEXA scans and hydrostatic weighing and typically estimates body fat within 3–4 percentage points. Its accuracy depends on consistent, correctly taken measurements. Common errors include measuring the waist at the wrong location (it should be at the navel, not the narrowest point), not keeping the tape horizontal, or measuring over clothing. For most people, the Navy method is acceptably accurate for tracking trends over time, even if the absolute number has some margin of error." } },
    { "@@type": "Question", "name": "What body fat percentage shows abs?",
      "acceptedAnswer": { "@@type": "Answer", "text": "For most men, visible abdominal definition appears at around 10–12% body fat. A full six-pack with deep muscle separation typically requires 8–10% body fat. For women, the threshold is higher due to essential fat distribution: visible abs typically appear at 16–19% body fat, and a well-defined six-pack requires around 14–16%. These numbers vary by genetics, muscle development, and how fat is distributed on your body. Two people at the same body fat percentage can look very different depending on where they store fat." } },
    { "@@type": "Question", "name": "Is BMI or body fat percentage a better health indicator?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Body fat percentage is generally considered a more meaningful health indicator than BMI because it directly measures the proportion of fat in your body rather than using weight and height as a proxy. BMI cannot distinguish between muscle mass and fat mass — a muscular athlete may have a high BMI but low body fat, while a sedentary person at a 'normal' BMI can have a high and metabolically risky body fat percentage. This is sometimes called being 'skinny fat' or TOFI (thin outside, fat inside). Body fat percentage provides a more accurate picture of body composition and health risk." } },
    { "@@type": "Question", "name": "How do I reduce my body fat percentage?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Reducing body fat percentage requires a sustained calorie deficit combined with resistance training to preserve muscle mass. Aim for a moderate deficit of 300–500 calories per day, which produces approximately 0.3–0.5 kg of fat loss per week. Higher protein intake (1.6–2.2 g/kg bodyweight) helps preserve lean muscle during a cut. Resistance training 2–4 times per week is critical — without it, roughly 25–30% of weight lost in a calorie deficit comes from muscle, not fat, raising your body fat percentage even as weight drops." } }
  ]
}
</script>
@endsection

@php
$faqs = [
  ['q' => 'What is a healthy body fat percentage?',
   'a' => 'Healthy body fat ranges differ by sex. For men, the American Council on Exercise (ACE) classifies 10–20% as fit/healthy, 6–13% as athletic, and above 25% as obese. For women, 18–28% is healthy, 14–20% is athletic, and above 32% is classified as obese. Women naturally carry more essential fat (around 10–13%) than men (2–5%) due to hormonal and reproductive functions. Body fat percentage is a more meaningful health marker than body weight alone because it separates lean tissue from fat mass.'],
  ['q' => 'How accurate is the Navy body fat method?',
   'a' => 'The US Navy body fat formula has been validated against DEXA scans and hydrostatic weighing and typically estimates body fat within 3–4 percentage points. Its accuracy depends on consistent, correctly taken measurements. Common errors include measuring the waist at the wrong location (it should be at the navel, not the narrowest point), not keeping the tape horizontal, or measuring over clothing. For most people, the Navy method is acceptably accurate for tracking trends over time, even if the absolute number has some margin of error.'],
  ['q' => 'What body fat percentage shows abs?',
   'a' => 'For most men, visible abdominal definition appears at around 10–12% body fat. A full six-pack with deep muscle separation typically requires 8–10% body fat. For women, the threshold is higher due to essential fat distribution: visible abs typically appear at 16–19% body fat, and a well-defined six-pack requires around 14–16%. These numbers vary by genetics, muscle development, and how fat is distributed on your body. Two people at the same body fat percentage can look very different depending on where they store fat.'],
  ['q' => 'Is BMI or body fat percentage a better health indicator?',
   'a' => 'Body fat percentage is generally considered a more meaningful health indicator than BMI because it directly measures the proportion of fat in your body rather than using weight and height as a proxy. BMI cannot distinguish between muscle mass and fat mass — a muscular athlete may have a high BMI but low body fat, while a sedentary person at a \'normal\' BMI can have a high and metabolically risky body fat percentage. This is sometimes called being \'skinny fat\' or TOFI (thin outside, fat inside). Body fat percentage provides a more accurate picture of body composition and health risk.'],
  ['q' => 'How do I reduce my body fat percentage?',
   'a' => 'Reducing body fat percentage requires a sustained calorie deficit combined with resistance training to preserve muscle mass. Aim for a moderate deficit of 300–500 calories per day, which produces approximately 0.3–0.5 kg of fat loss per week. Higher protein intake (1.6–2.2 g/kg bodyweight) helps preserve lean muscle during a cut. Resistance training 2–4 times per week is critical — without it, roughly 25–30% of weight lost in a calorie deficit comes from muscle, not fat, raising your body fat percentage even as weight drops.'],
];

$relatedTools = [
  ['icon' => '📊', 'name' => 'BMI Calculator', 'slug' => 'bmi-calculator', 'desc' => 'Calculate your body mass index and healthy weight range.'],
  ['icon' => '🔥', 'name' => 'Calorie Calculator', 'slug' => 'calorie-calculator', 'desc' => 'Find your daily calorie needs based on activity and goals.'],
  ['icon' => '📉', 'name' => 'Calorie Deficit Calculator', 'slug' => 'calorie-deficit-calculator', 'desc' => 'How big a deficit do you need to reach your goal weight?'],
  ['icon' => '⚖️', 'name' => 'Ideal Weight Calculator', 'slug' => 'ideal-weight-calculator', 'desc' => 'Find your healthy weight range for your height and frame.'],
  ['icon' => '🥗', 'name' => 'Macro Calculator', 'slug' => 'macro-calculator', 'desc' => 'Calculate your daily protein, carb, and fat targets.'],
  ['icon' => '🥩', 'name' => 'Protein Calculator', 'slug' => 'protein-calculator', 'desc' => 'How much protein do you actually need per day?'],
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
          ['url' => '', 'name' => 'Body Fat Calculator'],
        ]"/>

        <h1 class="mb-2 ms-hero-title">
          📏 Body Fat Calculator — Estimate Your Body Fat Percentage
        </h1>
        <p class="ms-hero-desc">
          Use the US Navy method to estimate your body fat with a tape measure. No expensive equipment needed.
        </p>

        {{-- ── Tool Card ────────────────────────────────────────────────────── --}}
        <div class="card border-0 mb-n4 ms-tool-card">
          <div class="card-body p-4 p-md-5">

            {{-- Unit toggle --}}
            <div class="d-flex gap-2 mb-4" role="group" aria-label="Measurement unit">
              <button class="btn flex-fill bf-unit-btn active" data-unit="cm"
                style="border-radius:8px; font-weight:600; font-size:.88rem; background:var(--fitness); color:#fff; border:none;">
                cm / kg
              </button>
              <button class="btn flex-fill bf-unit-btn" data-unit="in"
                style="border-radius:8px; font-weight:600; font-size:.88rem; background:#f8f9fa; color:#555; border:1px solid #e0e0e0;">
                in / lbs
              </button>
            </div>

            {{-- Sex toggle --}}
            <div class="mb-3">
              <label class="form-label fw-semibold">Sex</label>
              <div class="d-flex gap-2">
                <button class="btn flex-fill bf-sex-btn active" data-sex="male"
                  style="border-radius:8px; font-weight:600; font-size:.88rem; background:var(--fitness); color:#fff; border:none;" onclick="bfSetSex('male', this)">
                  Male
                </button>
                <button class="btn flex-fill bf-sex-btn" data-sex="female"
                  style="border-radius:8px; font-weight:600; font-size:.88rem; background:#f8f9fa; color:#555; border:1px solid #e0e0e0;" onclick="bfSetSex('female', this)">
                  Female
                </button>
              </div>
            </div>

            <div class="row g-3 mb-3">
              <div class="col-sm-6">
                <label for="bfHeight" class="form-label fw-semibold">Height <span class="bf-unit-label">(cm)</span></label>
                <input type="number" id="bfHeight" class="form-control" placeholder="e.g. 175" min="100" max="250" step="0.5">
              </div>
              <div class="col-sm-6">
                <label for="bfWeight" class="form-label fw-semibold">Weight <span class="bf-unit-label-w">(kg)</span></label>
                <input type="number" id="bfWeight" class="form-control" placeholder="e.g. 75" min="30" max="300" step="0.1">
              </div>
              <div class="col-sm-6">
                <label for="bfWaist" class="form-label fw-semibold">Waist <span class="bf-unit-label">(cm)</span> <small class="text-muted fw-normal">at navel</small></label>
                <input type="number" id="bfWaist" class="form-control" placeholder="e.g. 85" min="40" max="200" step="0.5">
              </div>
              <div class="col-sm-6">
                <label for="bfNeck" class="form-label fw-semibold">Neck <span class="bf-unit-label">(cm)</span></label>
                <input type="number" id="bfNeck" class="form-control" placeholder="e.g. 38" min="20" max="80" step="0.5">
              </div>
              <div class="col-12" id="bfHipGroup">
                <label for="bfHip" class="form-label fw-semibold">Hip <span class="bf-unit-label">(cm)</span> <small class="text-muted fw-normal">widest point</small></label>
                <input type="number" id="bfHip" class="form-control" placeholder="e.g. 95" min="40" max="200" step="0.5">
              </div>
            </div>

            <button class="btn btn-cta w-100" onclick="calculateBodyFat()" style="font-size:1rem;">
              Calculate Body Fat →
            </button>

            {{-- Results --}}
            <div id="bfResults" class="mt-4 d-none">
              <div style="height:1px; background:#f0f0f0; margin-bottom:20px;"></div>

              <div class="text-center mb-4">
                <div style="font-size:.8rem; color:#888; text-transform:uppercase; letter-spacing:.5px; font-weight:600; margin-bottom:4px;">Body Fat Percentage</div>
                <div id="bfPercentDisplay" style="font-size:3rem; font-weight:800; color:var(--fitness); line-height:1;"></div>
                <div id="bfCategoryDisplay" style="font-size:1rem; font-weight:700; margin-top:8px; padding:4px 16px; border-radius:50px; display:inline-block;"></div>
              </div>

              <div class="row g-3 mb-4 text-center">
                <div class="col-6">
                  <div style="background:#f0fff4; border-radius:10px; padding:14px 8px;">
                    <div id="bfFatMass" style="font-size:1.3rem; font-weight:700; color:var(--fitness);"></div>
                    <div style="font-size:.75rem; color:#888; margin-top:4px;">Fat Mass</div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="ms-stat ms-stat-purple">
                    <div id="bfLeanMass" style="font-size:1.3rem; font-weight:700; color:var(--primary-mid);"></div>
                    <div style="font-size:.75rem; color:#888; margin-top:4px;">Lean Mass</div>
                  </div>
                </div>
              </div>

              {{-- Category bar --}}
              <div id="bfCategoryBar" class="mb-3"></div>

            </div>
            {{-- /Results --}}

          </div>
        </div>
        {{-- /Tool Card --}}
      </div>

      {{-- Right: Quick facts --}}
      <div class="col-lg-5 d-none d-lg-block" style="padding-top:10px;">
        <div class="ms-facts-wrap">
          <h3 class="ms-facts-title">Quick Body Fat Facts</h3>
          @foreach([
            ['10–20%', 'Healthy body fat range for men'],
            ['20–30%', 'Healthy body fat range for women'],
            ['Navy Method', 'Most widely used skinfold-free estimate'],
            ['1% BF', 'Roughly 1 kg fat per 10 kg body mass'],
            ['3–5%', 'Essential body fat (minimum for survival, men)'],
          ] as [$stat, $label])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div class="ms-fact-pill ms-fact-pill-fitness">{{ $stat }}</div>
            <div class="ms-fact-label">{{ $label }}</div>
          </div>
          @endforeach
          <p class="ms-fact-source">Sources: ACE, US Navy, ACSM</p>
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
        <h2 class="mb-4">How the US Navy Body Fat Method Works</h2>
        <p>The US Navy body fat method was developed to assess body composition without expensive lab equipment. It uses circumference measurements — waist, neck, and (for women) hips — combined with height to estimate body fat percentage.</p>
        <p>The underlying logic: the difference between abdominal circumference and neck circumference approximates visceral fat distribution. A larger waist relative to neck indicates more fat mass. Height acts as a normalising factor.</p>
        <p>The formula was validated against hydrostatic weighing (the gold standard) and found to estimate body fat within ±3–4 percentage points for most individuals. It's now used globally by military organisations, gyms, and fitness professionals for its practical accuracy.</p>
      </div>
      <div class="col-lg-7">
        <div class="p-4 rounded-3 ms-data-box">
          <p class="fw-semibold mb-3" style="color:var(--primary-dark); font-size:.88rem; text-transform:uppercase; letter-spacing:.5px;">Body Fat Categories (ACE)</p>
          @foreach([
            ['Essential Fat', '2–5%', '10–13%', '#dc3545'],
            ['Athletic', '6–13%', '14–20%', '#fd7e14'],
            ['Fitness', '14–17%', '21–24%', '#ffc107'],
            ['Average / Acceptable', '18–24%', '25–31%', '#28a745'],
            ['Obese', '25%+', '32%+', '#6c757d'],
          ] as [$cat, $men, $women, $color])
          <div class="d-flex align-items-center gap-3 mb-2">
            <div style="width:12px; height:12px; border-radius:50%; background:{{ $color }}; flex-shrink:0;"></div>
            <div style="flex:1; font-size:.86rem; color:#333; font-weight:500;">{{ $cat }}</div>
            <div style="font-size:.8rem; color:#555; min-width:50px; text-align:center;">♂ {{ $men }}</div>
            <div style="font-size:.8rem; color:#555; min-width:50px; text-align:center;">♀ {{ $women }}</div>
          </div>
          @endforeach
          <p style="font-size:.75rem; color:#aaa; margin-top:12px; margin-bottom:0;">Source: American Council on Exercise (ACE)</p>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ── 3. Measurement Guide ──────────────────────────────────────────────────── --}}
<section class="ms-section-muted">
  <div class="container-xl">
    <div class="text-center mb-5">
      <h2>How to Take Accurate Measurements</h2>
      <p class="text-muted" style="max-width:520px; margin:auto;">Small measurement errors cause large result changes. Follow these steps for reliable readings.</p>
    </div>
    <div class="row g-3 justify-content-center">
      @foreach([
        ['📏','Waist','Measure at the level of the navel (belly button), not the narrowest point of your torso. Keep the tape horizontal. Measure at the end of a normal exhale, relaxed — do not suck in.'],
        ['🔵','Neck','Measure just below the larynx (Adam\'s apple). Keep the tape perpendicular to the long axis of the neck. Do not tilt your head down — look straight ahead.'],
        ['🔴','Hip (Women)','Measure at the widest point of the hips and buttocks. Stand with feet together, tape horizontal. This is typically 7–9 inches below your navel.'],
        ['📐','General Tips','Measure at the same time of day (ideally morning). Use a flexible but non-stretch measuring tape. Take each measurement twice and use the average for best accuracy.'],
      ] as [$icon, $label, $desc])
      <div class="col-md-6 col-lg-3">
        <div class="card border-0 h-100 p-4" style="border-radius:12px; box-shadow:0 2px 12px rgba(0,0,0,.06);">
          <div style="font-size:2rem; margin-bottom:10px;">{{ $icon }}</div>
          <div class="fw-semibold mb-2" style="color:var(--primary-dark);">{{ $label }}</div>
          <div style="font-size:.82rem; color:#666; line-height:1.6;">{{ $desc }}</div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="bfFaqAccordion" />


{{-- ── 5. Long-tail keyword sections ─────────────────────────────────────────── --}}
<section class="ms-section-accent">
  <div class="container ms-longtail">
    <h2 class="mb-4" style="color:var(--primary-dark);">Body Fat Calculator for Women — Understanding Female Body Fat Ranges</h2>
    <p>Female body fat ranges are higher than male ranges at every category because of essential fat differences driven by hormones and reproductive biology. A woman at 22% body fat is in the healthy-to-fitness range, equivalent to a man at around 12–14%. This distinction matters because many women compare themselves to male body fat standards and conclude they are overfat when they are not.</p>
    <p>Women also distribute fat differently. Estrogen directs fat storage to subcutaneous depots around the hips, thighs, and breasts. This is called gynoid fat distribution. While more visible, this fat type is less metabolically dangerous than visceral fat. Android fat distribution (around the abdomen) is more associated with insulin resistance and cardiovascular risk — this pattern is more common after menopause when estrogen levels decline.</p>

    <h2 class="mt-5 mb-4" style="color:var(--primary-dark);">Body Fat Percentage for Men — What's Athletic vs Healthy?</h2>
    <p>For men, the fitness range of 14–17% body fat represents a physique with some muscle definition visible but not extreme leanness. The athletic range of 6–13% is where most serious athletes and bodybuilders operate — muscle separation is visible, and veins are apparent. Below 6% represents the essential fat threshold; bodybuilders who achieve this level for competitions experience hormonal disruption and require a rapid return to higher body fat levels.</p>
    <p>The health risk for men increases primarily at body fat percentages above 25%, which corresponds to clinical obesity levels. However, where fat is stored matters as much as how much: a man with 22% body fat concentrated in the abdomen (high waist circumference) carries more cardiovascular risk than one with the same percentage distributed more peripherally.</p>

    <h2 class="mt-5 mb-4" style="color:var(--primary-dark);">How to Reduce Body Fat Percentage Without Losing Muscle</h2>
    <p>The key to reducing body fat while preserving muscle is a combination of adequate protein, resistance training, and a moderate calorie deficit. Cutting calories too aggressively (more than 700–1000 kcal/day) forces the body to break down muscle for energy. A 300–500 kcal/day deficit is the evidence-based sweet spot for fat loss with minimal muscle loss.</p>
    <p>Protein intake during a cut should be 1.6–2.2 g/kg of bodyweight. Resistance training — at least 2–3 sessions per week — sends an anabolic signal that tells your body to maintain muscle tissue even in a deficit. Cardiovascular exercise contributes to the calorie deficit but should not replace resistance training. Many lifters find that body recomposition (losing fat while maintaining or gaining muscle) is achievable at small deficits combined with high protein and heavy training, especially for beginners and detrained individuals returning to lifting.</p>
  </div>
</section>

<x-related-tools :tools="$relatedTools" heading="More Fitness Calculators" />


{{-- ── 7. SEO Block ──────────────────────────────────────────────────────────── --}}
<section class="ms-section-seo">
  <div class="container-xl">
    <div class="row justify-content-center">
      <div class="col-lg-8 ms-seo-body">
        <h2 class="mb-4 ms-seo-h2">Body Fat Calculator: What the Number Actually Means</h2>
        <p>Body fat percentage is one of the most informative metrics in fitness assessment — but also one of the most misunderstood. The number from this calculator represents the proportion of your total body mass that is adipose tissue (fat). The remainder — muscle, bone, water, organs — is your lean mass. Both numbers matter for health, fitness performance, and appearance.</p>
        <h3 class="ms-seo-h3">Why You Should Track Trends, Not Absolutes</h3>
        <p>No circumference-based formula is perfectly accurate for every individual. The Navy method is validated to ±3–4 percentage points against DEXA. This means a result of 18% could reasonably be anywhere from 14% to 22%. For this reason, treat your result as a baseline and focus on the direction of change over time. Consistent measurements taken under the same conditions (same time of day, same tape position) reveal trends even when the absolute value has measurement uncertainty.</p>
        <h3 class="ms-seo-h3">Body Fat vs Body Weight on the Scale</h3>
        <p>Scale weight and body fat percentage can move in opposite directions. If you start resistance training while in a moderate calorie deficit, you may lose fat while gaining muscle — your scale weight barely changes, but your body fat percentage drops and your physique improves significantly. This is why serious body composition tracking uses both scale weight and body fat percentage together, not either metric alone.</p>
        <div class="mt-4 p-4 rounded-3 ms-note ms-note-green">
          <p style="margin:0; font-size:.85rem; color:#155724;"><strong>Note:</strong> This calculator provides an estimate for general wellness guidance. It is not a medical diagnostic tool. If you have concerns about your body composition or metabolic health, consult a registered dietitian or physician.</p>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')
<script>
(function () {

  var currentUnit = 'cm';
  var currentSex  = 'male';

  document.querySelectorAll('.bf-unit-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
      document.querySelectorAll('.bf-unit-btn').forEach(function (b) {
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
      var isIn = currentUnit === 'in';
      document.querySelectorAll('.bf-unit-label').forEach(function (el) { el.textContent = isIn ? '(in)' : '(cm)'; });
      document.querySelectorAll('.bf-unit-label-w').forEach(function (el) { el.textContent = isIn ? '(lbs)' : '(kg)'; });
      document.getElementById('bfResults').classList.add('d-none');
    });
  });

  window.bfSetSex = function (sex, btn) {
    currentSex = sex;
    document.querySelectorAll('.bf-sex-btn').forEach(function (b) {
      b.classList.remove('active');
      b.style.background = '#f8f9fa';
      b.style.color = '#555';
      b.style.border = '1px solid #e0e0e0';
    });
    btn.classList.add('active');
    btn.style.background = 'var(--fitness)';
    btn.style.color = '#fff';
    btn.style.border = 'none';
    document.getElementById('bfHipGroup').style.display = sex === 'female' ? '' : 'none';
    document.getElementById('bfResults').classList.add('d-none');
  };

  // Hide hip on load for male
  document.getElementById('bfHipGroup').style.display = 'none';

  window.calculateBodyFat = function () {
    var height = parseFloat(document.getElementById('bfHeight').value);
    var weight = parseFloat(document.getElementById('bfWeight').value);
    var waist  = parseFloat(document.getElementById('bfWaist').value);
    var neck   = parseFloat(document.getElementById('bfNeck').value);
    var hip    = parseFloat(document.getElementById('bfHip').value);

    if (!height || !weight || !waist || !neck || (currentSex === 'female' && !hip)) {
      alert('Please fill in all required measurements.');
      return;
    }

    // Convert to cm / kg if imperial
    var hCm, wKg, waistCm, neckCm, hipCm;
    if (currentUnit === 'in') {
      hCm    = height * 2.54;
      wKg    = weight * 0.453592;
      waistCm = waist * 2.54;
      neckCm  = neck * 2.54;
      hipCm   = hip * 2.54;
    } else {
      hCm    = height;
      wKg    = weight;
      waistCm = waist;
      neckCm  = neck;
      hipCm   = hip;
    }

    var bf;
    if (currentSex === 'male') {
      bf = 86.010 * Math.log10(waistCm - neckCm) - 70.041 * Math.log10(hCm) + 36.76;
    } else {
      bf = 163.205 * Math.log10(waistCm + hipCm - neckCm) - 97.684 * Math.log10(hCm) - 78.387;
    }

    bf = Math.max(2, Math.min(60, bf));

    var fatMassKg  = wKg * (bf / 100);
    var leanMassKg = wKg - fatMassKg;

    var category, catColor;
    if (currentSex === 'male') {
      if      (bf < 6)  { category = 'Essential Fat'; catColor = '#dc3545'; }
      else if (bf < 14) { category = 'Athletic';       catColor = '#fd7e14'; }
      else if (bf < 18) { category = 'Fitness';        catColor = '#ffc107'; }
      else if (bf < 25) { category = 'Average';        catColor = '#28a745'; }
      else              { category = 'Obese';           catColor = '#6c757d'; }
    } else {
      if      (bf < 14) { category = 'Essential Fat'; catColor = '#dc3545'; }
      else if (bf < 21) { category = 'Athletic';       catColor = '#fd7e14'; }
      else if (bf < 25) { category = 'Fitness';        catColor = '#ffc107'; }
      else if (bf < 32) { category = 'Average';        catColor = '#28a745'; }
      else              { category = 'Obese';           catColor = '#6c757d'; }
    }

    var unitW = currentUnit === 'in' ? 'lbs' : 'kg';
    var fatDisplay  = currentUnit === 'in' ? (fatMassKg * 2.20462).toFixed(1) : fatMassKg.toFixed(1);
    var leanDisplay = currentUnit === 'in' ? (leanMassKg * 2.20462).toFixed(1) : leanMassKg.toFixed(1);

    document.getElementById('bfPercentDisplay').textContent = bf.toFixed(1) + '%';
    document.getElementById('bfCategoryDisplay').textContent = category;
    document.getElementById('bfCategoryDisplay').style.background = catColor + '22';
    document.getElementById('bfCategoryDisplay').style.color = catColor;
    document.getElementById('bfFatMass').textContent  = fatDisplay + ' ' + unitW;
    document.getElementById('bfLeanMass').textContent = leanDisplay + ' ' + unitW;

    // Visual category bar
    var cats = currentSex === 'male'
      ? [['Essential', 6, '#dc3545'], ['Athletic', 14, '#fd7e14'], ['Fitness', 18, '#ffc107'], ['Average', 25, '#28a745'], ['Obese', 40, '#6c757d']]
      : [['Essential', 14, '#dc3545'], ['Athletic', 21, '#fd7e14'], ['Fitness', 25, '#ffc107'], ['Average', 32, '#28a745'], ['Obese', 45, '#6c757d']];

    var totalRange = cats[cats.length - 1][1];
    var barHtml = '<div style="display:flex; border-radius:8px; overflow:hidden; height:14px; margin-bottom:8px;">';
    cats.forEach(function (c) {
      barHtml += '<div style="flex:' + c[1] + '; background:' + c[2] + '; opacity:.7;"></div>';
    });
    barHtml += '</div>';
    var markerPct = Math.min(100, (bf / totalRange) * 100);
    barHtml += '<div style="position:relative; height:8px;">'
      + '<div style="position:absolute; left:' + markerPct.toFixed(1) + '%; transform:translateX(-50%); width:2px; height:16px; background:#1a1a2e; top:-4px; border-radius:1px;"></div>'
      + '</div>'
      + '<div style="display:flex; justify-content:space-between; font-size:.7rem; color:#aaa; margin-top:4px;">'
      + cats.map(function(c){ return '<span>' + c[0] + '</span>'; }).join('')
      + '</div>';

    document.getElementById('bfCategoryBar').innerHTML = barHtml;
    document.getElementById('bfResults').classList.remove('d-none');
    document.getElementById('bfResults').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  };

})();
</script>
@endsection
