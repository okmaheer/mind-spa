   @extends('layouts.app')

@section('title', 'BMI Calculator — Body Mass Index for Men, Women & Teens | MindSnap')
@section('description', 'Free BMI calculator: enter height and weight to get your body mass index, weight category, and healthy weight range. Works in kg/cm or lbs/ft. No signup.')
@section('canonical', config('app.url') . '/bmi-calculator')

@section('styles')
<style>
.bmi-value      { font-size:3rem; font-weight:700; color:var(--primary-dark); line-height:1; }
.bmi-category   { display:inline-block; margin-top:8px; padding:6px 18px; border-radius:50px; font-weight:700; font-size:.95rem; }
.bmi-details    { font-size:.9rem; color:#555; text-align:center; }
.bmi-scale-bar  { position:relative; height:20px; border-radius:10px; overflow:visible;
                  background:linear-gradient(to right,#4fc3f7 0%,#66bb6a 20%,#66bb6a 45%,#ffa726 65%,#ef5350 100%); }
.bmi-marker     { position:absolute; top:-5px; width:4px; height:30px; background:#1a1a2e;
                  border-radius:2px; transform:translateX(-50%); transition:left .4s ease; }
.bmi-scale-labels { font-size:.7rem; color:#888; }
.bmi-age-note   { font-size:.82rem; }
.bmi-formula-box { background:#f8f9fa; border-left:4px solid var(--fitness); font-family:monospace; font-size:1rem; color:var(--primary-dark); }
.bmi-measures-badge-green { font-size:.75rem; font-weight:700; min-width:64px; padding-top:2px; color:var(--green-text); }
.bmi-measures-badge-red   { font-size:.75rem; font-weight:700; min-width:64px; padding-top:2px; color:var(--cta-text); }
.bmi-measures-desc { font-size:.87rem; color:#555; line-height:1.5; }
.bmi-dot-uw  { background: #4fc3f7; }
.bmi-dot-nm  { background: #66bb6a; }
.bmi-dot-ow  { background: #ffa726; }
.bmi-dot-ob1 { background: #ef9a9a; }
.bmi-dot-ob2 { background: #e57373; }
.bmi-dot-ob3 { background: #c62828; }
.bmi-td-sm   { font-size: .85rem; }
</style>
@endsection

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "WebApplication",
  "name": "BMI Calculator",
  "url": "{{ config('app.url') }}/bmi-calculator",
  "description": "Calculate your Body Mass Index (BMI) instantly with height and weight in metric or imperial units.",
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
    { "@@type": "ListItem", "position": 3, "name": "BMI Calculator" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [
    { "@@type": "Question", "name": "What is a healthy BMI range?",
      "acceptedAnswer": { "@@type": "Answer", "text": "According to the World Health Organization, a healthy BMI range is 18.5 to 24.9. Below 18.5 is classified as underweight, 25–29.9 as overweight, and 30 or above as obese. These thresholds were established from large population studies linking BMI to disease risk, though they are population averages and may not apply to all individuals equally." } },
    { "@@type": "Question", "name": "How accurate is BMI as a health measurement?",
      "acceptedAnswer": { "@@type": "Answer", "text": "BMI is a useful screening tool for population-level health trends but has notable limitations for individuals. It does not distinguish between fat mass and lean muscle mass, does not account for fat distribution, and may misclassify muscular athletes as overweight and older adults with low muscle as healthy. It is most accurate when used alongside other assessments such as waist circumference, body fat percentage, and blood markers." } },
    { "@@type": "Question", "name": "What is a good BMI for a woman?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The WHO healthy BMI range of 18.5–24.9 applies to adult women. However, research suggests women naturally carry a higher percentage of body fat than men at the same BMI, which is physiologically normal. Some studies suggest the lower end of the healthy range (18.5–21) is associated with slightly higher fracture risk in post-menopausal women. Most clinicians use BMI alongside waist measurement for a more complete picture." } },
    { "@@type": "Question", "name": "What is a healthy BMI for men?",
      "acceptedAnswer": { "@@type": "Answer", "text": "For adult men, a healthy BMI is 18.5–24.9 per WHO guidelines. Men tend to carry more muscle mass than women, which means a man with a BMI of 26–27 who exercises regularly may have a healthy body fat percentage. Conversely, older men with BMIs in the 'normal' range can have excess visceral fat — a risk factor for metabolic disease — emphasising that BMI alone is not sufficient." } },
    { "@@type": "Question", "name": "Does BMI change with age?",
      "acceptedAnswer": { "@@type": "Answer", "text": "BMI thresholds do not officially change with age for adults, but body composition naturally shifts as we age. Adults typically lose muscle mass and gain fat mass after age 30 even if their weight stays constant. Some research suggests that a BMI of 25–27 in adults over 65 is associated with better outcomes than a BMI under 23, suggesting the 'optimal' BMI may actually be slightly higher for older adults." } },
    { "@@type": "Question", "name": "What BMI is considered obese?",
      "acceptedAnswer": { "@@type": "Answer", "text": "A BMI of 30 or above is classified as obese by the WHO. Obesity is further divided into three classes: Class I is BMI 30–34.9, Class II is 35–39.9, and Class III (severe obesity) is 40 or above. Higher obesity classes are associated with progressively greater risk of type 2 diabetes, cardiovascular disease, sleep apnea, and certain cancers." } },
    { "@@type": "Question", "name": "Can you have a high BMI but still be healthy?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes — this is common in athletes and highly muscular individuals. A body builder or rugby player may have a BMI of 27–30 while carrying very little body fat. Research on 'metabolically healthy obesity' shows some people with high BMI have normal blood pressure, blood sugar, and lipid profiles. However, most large studies find that sustained high BMI is associated with increased long-term health risks regardless of metabolic markers." } },
    { "@@type": "Question", "name": "How do I lower my BMI?",
      "acceptedAnswer": { "@@type": "Answer", "text": "BMI decreases when you reduce body fat through a sustained calorie deficit combined with physical activity. A deficit of 500 calories per day produces roughly 0.5 kg (1 lb) of fat loss per week. Resistance training preserves muscle mass during weight loss, which is important because losing muscle raises health risks. Gradual, sustainable changes — rather than extreme restriction — produce better long-term outcomes and lower the risk of weight regain." } }
  ]
}
</script>
@endsection

@php
$faqs = [
  ['q' => 'What is a healthy BMI range?',
             'a' => 'According to the World Health Organization, a healthy BMI range is 18.5 to 24.9. Below 18.5 is classified as underweight; 25–29.9 as overweight; and 30 or above as obese. These thresholds were established from large population studies linking BMI to disease risk. They are useful population averages but may not apply equally to all individuals, particularly athletes, older adults, or people of South or East Asian descent where health risks often emerge at lower BMI values.'],
  ['q' => 'How accurate is BMI as a health measurement?',
             'a' => 'BMI is a useful screening tool at the population level but has real limitations for individuals. It cannot distinguish between fat mass and lean muscle mass, does not account for where fat is stored (visceral vs. subcutaneous), and does not adjust for age, sex, or ethnicity. A 2016 study in the International Journal of Obesity found that nearly half of people with "normal" BMIs had unhealthy cardiometabolic profiles, while a third of "overweight" people had healthy ones. BMI works best when combined with waist circumference measurements and blood panels.'],
  ['q' => 'What is a good BMI for a woman?',
             'a' => 'The WHO healthy range of 18.5–24.9 applies to adult women, but women naturally carry a higher percentage of body fat than men at the same BMI — which is physiologically normal and supports hormonal health and reproductive function. Some research suggests women at the lower end of the healthy range (18.5–21) face slightly higher fracture risk post-menopause. Most clinicians use BMI alongside waist-to-hip ratio for a more accurate individual assessment.'],
  ['q' => 'What is a healthy BMI for men?',
             'a' => 'For adult men, a healthy BMI is 18.5–24.9 per WHO guidelines. Because men typically carry more muscle than women, a muscular man with a BMI of 25–27 may have a completely healthy body composition. Conversely, older men with "normal" BMIs can still harbour excess visceral fat — a key risk factor for metabolic disease. The most comprehensive assessment combines BMI with waist circumference (target: under 94 cm / 37 inches for men) and body fat percentage.'],
  ['q' => 'Does BMI change with age?',
             'a' => 'BMI thresholds do not change with age for adults in standard guidelines, but body composition naturally shifts after age 30. Adults typically lose 3–5% of muscle mass per decade (sarcopenia) while potentially gaining fat mass, even if their scale weight stays the same. This means the same BMI at age 65 often reflects more fat and less muscle than at age 30. Some geriatric medicine guidelines suggest that a BMI of 25–27 may actually be optimal for adults over 65, associated with lower mortality than a BMI under 22.'],
  ['q' => 'What BMI is considered obese?',
             'a' => 'The WHO classifies obesity as a BMI of 30 or above, subdivided into three classes: Class I (30–34.9) carries high health risk; Class II (35–39.9) carries very high risk; and Class III or morbid obesity (40+) carries extremely high risk. Each class is associated with progressively greater likelihood of type 2 diabetes, hypertension, cardiovascular disease, sleep apnea, osteoarthritis, and certain cancers. Effective treatment typically requires a multidisciplinary approach.'],
  ['q' => 'Can you have a high BMI but still be healthy?',
             'a' => 'Yes — this is common in athletes and highly muscular individuals. A body builder or rugby player may carry a BMI of 27–30 while having very low body fat. Research on "metabolically healthy obesity" shows some people with high BMI maintain normal blood pressure, blood glucose, and lipid profiles. However, long-term follow-up studies consistently find that sustained high BMI is associated with increased health risks regardless of current metabolic markers, suggesting it is a risk state even when current biomarkers appear normal.'],
  ['q' => 'How do I lower my BMI?',
             'a' => 'BMI decreases when you reduce body fat through a sustained calorie deficit combined with physical activity. A deficit of 500 calories per day produces roughly 0.5 kg (1 lb) of fat loss per week, which is considered a safe and sustainable rate. Resistance training during weight loss helps preserve muscle mass — critical because muscle loss worsens metabolic health even as BMI falls. Gradual changes (6–12 month timelines) produce significantly better long-term results than crash diets, which cause muscle loss and almost always lead to weight regain.'],
];

$relatedTools = [
  ['icon' => '🔥', 'name' => 'Calorie Calculator', 'slug' => 'calorie-calculator', 'desc' => 'Find your Total Daily Energy Expenditure (TDEE) by activity level.'],
  ['icon' => '📉', 'name' => 'Calorie Deficit Calculator', 'slug' => 'calorie-deficit-calculator', 'desc' => 'Set a goal weight and get your daily calorie target and timeline.'],
  ['icon' => '🥩', 'name' => 'Protein Calculator', 'slug' => 'protein-calculator', 'desc' => 'Find your daily protein target for muscle gain, fat loss, or maintenance.'],
  ['icon' => '🥗', 'name' => 'Macro Calculator', 'slug' => 'macro-calculator', 'desc' => 'Get personalised protein, carb, and fat targets for your goal.'],
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
          ['url' => '', 'name' => 'BMI Calculator'],
        ]"/>

        <h1 class="mb-2 ms-hero-title">
          💪 BMI Calculator — Body Mass Index for Men, Women &amp; Teens
        </h1>
        <p class="ms-hero-desc">
          Enter your height and weight to instantly calculate your BMI, weight category, and healthy weight range. Supports metric and imperial units.
        </p>

        {{-- ── Tool Card ────────────────────────────────────────────────────── --}}
        <div class="card border-0 mb-n4 ms-tool-card">
          <div class="card-body p-4 p-md-5">

            {{-- Unit toggle --}}
            <div class="d-flex gap-2 mb-4" role="group" aria-label="Unit system">
              <button class="btn flex-fill mode-btn mode-btn-fitness bmi-unit-btn active" data-unit="metric">
                Metric (kg / cm)
              </button>
              <button class="btn flex-fill mode-btn bmi-unit-btn" data-unit="imperial">
                Imperial (lbs / ft)
              </button>
            </div>

            {{-- Metric inputs --}}
            <div id="bmiMetric">
              <div class="mb-3">
                <label for="bmiHeightCm" class="form-label fw-600">Height (cm)</label>
                <input type="number" id="bmiHeightCm" class="form-control" placeholder="e.g. 175" min="100" max="250" aria-label="Height in centimetres">
              </div>
              <div class="mb-3">
                <label for="bmiWeightKg" class="form-label fw-600">Weight (kg)</label>
                <input type="number" id="bmiWeightKg" class="form-control" placeholder="e.g. 70" min="20" max="300" aria-label="Weight in kilograms">
              </div>
            </div>

            {{-- Imperial inputs --}}
            <div id="bmiImperial" class="d-none">
              <div class="mb-3">
                <label class="form-label fw-600">Height</label>
                <div class="row g-2">
                  <div class="col-6">
                    <input type="number" id="bmiHeightFt" class="form-control" placeholder="Feet" min="3" max="8" aria-label="Height feet">
                  </div>
                  <div class="col-6">
                    <input type="number" id="bmiHeightIn" class="form-control" placeholder="Inches" min="0" max="11" aria-label="Height inches">
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <label for="bmiWeightLbs" class="form-label fw-600">Weight (lbs)</label>
                <input type="number" id="bmiWeightLbs" class="form-control" placeholder="e.g. 154" min="44" max="660" aria-label="Weight in pounds">
              </div>
            </div>

            <div class="row g-3 mb-4">
              <div class="col-6">
                <label for="bmiSex" class="form-label fw-600">Sex</label>
                <select id="bmiSex" class="form-select">
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                </select>
              </div>
              <div class="col-6">
                <label for="bmiAge" class="form-label fw-600">Age <span class="text-muted fw-400 bmi-age-note">(optional)</span></label>
                <input type="number" id="bmiAge" class="form-control" placeholder="e.g. 30" min="2" max="120" aria-label="Age in years">
              </div>
            </div>

            <button class="btn btn-cta w-100" onclick="calcBMI()">
              Calculate BMI →
            </button>

            {{-- Results --}}
            <div id="results" class="mt-4 d-none">
              <div class="ms-divider"></div>

              <div class="text-center mb-3">
                <div id="bmiValue" class="bmi-value"></div>
                <div id="bmiCategory" class="bmi-category"></div>
              </div>

              <div id="bmiDetails" class="bmi-details mb-3"></div>

              {{-- BMI Scale Bar --}}
              <div class="bmi-scale-bar mb-2">
                <div id="bmiMarker" class="bmi-marker"></div>
              </div>
              <div class="d-flex justify-content-between bmi-scale-labels mb-3">
                <span>Underweight<br>&lt;18.5</span>
                <span class="text-center">Normal<br>18.5–24.9</span>
                <span class="text-center">Overweight<br>25–29.9</span>
                <span class="text-end">Obese<br>30+</span>
              </div>

              <div id="bmiHealthyRange" class="p-3 rounded-3 ms-note ms-note-green"></div>
            </div>

          </div>
        </div>
      </div>

      {{-- Right: Quick facts --}}
      <div class="col-lg-5 d-none d-lg-block pt-2">
        <div class="ms-facts-wrap">
          <h3 class="ms-facts-title">Quick BMI Facts</h3>
          @foreach([
            ['18.5–24.9', 'Healthy BMI range (WHO)'],
            ['39%',       'Global adults overweight or obese'],
            ['30+',       'BMI threshold for obesity classification'],
            ['±3 pts',    'BMI error margin for athletes (muscle mass)'],
            ['1832',      'Year BMI formula was invented (Quetelet)'],
          ] as [$stat, $label])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div class="ms-fact-pill ms-fact-pill-fitness">{{ $stat }}</div>
            <div class="ms-fact-label">{{ $label }}</div>
          </div>
          @endforeach
          <p class="ms-fact-source">Sources: WHO, CDC, NCHS</p>
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
        <h2 class="mb-4">How BMI Is Calculated: The Quetelet Index Explained</h2>
        <p>BMI (Body Mass Index) was developed in 1832 by Belgian mathematician Adolphe Quetelet. The formula divides your weight in kilograms by the square of your height in metres:</p>
        <div class="p-3 mb-3 rounded-3 bmi-formula-box">
          BMI = weight (kg) ÷ height (m)²
        </div>
        <p>In imperial units, the formula adds a conversion factor: <strong>BMI = 703 × weight (lbs) ÷ height (inches)²</strong>.</p>
        <p>BMI is a population-level screening tool. It does not directly measure body fat, and it cannot distinguish between fat mass and lean muscle mass. An athlete with significant muscle may have a "high" BMI despite low body fat. Conversely, an older adult with low muscle mass may fall in the "normal" BMI range despite excess visceral fat.</p>
      </div>
      <div class="col-lg-7">
        <div class="p-4 rounded-3 ms-data-box">
          <p class="ms-panel-head mb-3">What BMI measures vs. what it misses</p>
          @foreach([
            ['✅ Measures', 'Weight relative to height — useful for population comparisons'],
            ['✅ Measures', 'General weight category — underweight, normal, overweight, obese'],
            ['✅ Measures', 'Rough health risk screening tool in clinical settings'],
            ['❌ Misses',   'Distinction between fat mass and muscle mass'],
            ['❌ Misses',   'Fat distribution (visceral vs. subcutaneous fat)'],
            ['❌ Misses',   'Bone density, age-related muscle loss, and ethnicity differences'],
          ] as [$badge, $desc])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div class="{{ str_starts_with($badge,'✅') ? 'bmi-measures-badge-green' : 'bmi-measures-badge-red' }}">{{ $badge }}</div>
            <div class="bmi-measures-desc">{{ $desc }}</div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ── 3. BMI Categories Table ──────────────────────────────────────────────── --}}
<section class="ms-section-muted">
  <div class="container-xl">
    <div class="text-center mb-5">
      <h2>BMI Categories and What They Mean</h2>
      <p class="text-muted ms-intro-text">World Health Organization classification for adults aged 18 and over.</p>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-9">
        <div class="table-responsive ms-table-rounded">
          <table class="table table-bordered mb-0">
            <thead class="ms-table-head">
              <tr>
                <th class="px-3 py-3">Category</th>
                <th class="px-3 py-3">BMI Range</th>
                <th class="px-3 py-3">Health Risk</th>
                <th class="px-3 py-3">Common Causes</th>
              </tr>
            </thead>
            <tbody>
              @foreach([
                ['Underweight',     '< 18.5',    'Moderate',      'bmi-dot-uw',  'Malnutrition, eating disorders, hyperthyroidism, chronic illness'],
                ['Normal Weight',   '18.5–24.9', 'Minimal',       'bmi-dot-nm',  'Healthy diet, regular physical activity, balanced energy balance'],
                ['Overweight',      '25.0–29.9', 'Increased',     'bmi-dot-ow',  'Excess calorie intake, sedentary lifestyle, hormonal factors'],
                ['Obese (Class I)', '30.0–34.9', 'High',          'bmi-dot-ob1', 'Significant calorie surplus, genetic predisposition, medical conditions'],
                ['Obese (Class II)','35.0–39.9', 'Very High',     'bmi-dot-ob2', 'Severe calorie imbalance, limited mobility, metabolic disorders'],
                ['Obese (Class III)','≥ 40.0',   'Extremely High','bmi-dot-ob3', 'Morbid obesity — complex multifactorial causes'],
              ] as [$cat, $range, $risk, $dotCls, $causes])
              <tr>
                <td class="px-3 py-2 fw-600">
                  <span class="ms-dot me-2 {{ $dotCls }}"></span>
                  {{ $cat }}
                </td>
                <td class="px-3 py-2">{{ $range }}</td>
                <td class="px-3 py-2">{{ $risk }}</td>
                <td class="px-3 py-2 text-muted bmi-td-sm">{{ $causes }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <p class="ms-source">Source: World Health Organization (WHO) Global Database on Body Mass Index.</p>
      </div>
    </div>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="faqAccordion" />


{{-- ── 5. Long-tail Keyword Sections ───────────────────────────────────────── --}}
<section class="ms-section-accent">
  <div class="container ms-longtail">

    <h2 class="mb-4 text-brand">BMI Calculator for Women — Understanding Female Body Composition</h2>
    <p>Women's bodies are biologically designed to carry 6–11% more body fat than men of equivalent BMI, primarily to support hormonal function, fertility, and pregnancy. This means the standard BMI table — derived largely from male-dominated datasets — may slightly overestimate health risk for women with a BMI of 25–27. The American College of Obstetricians and Gynecologists recommends using BMI alongside waist circumference (goal: under 88 cm / 35 inches) for a more accurate picture.</p>
    <p>For women approaching or past menopause, estrogen decline triggers a shift in fat distribution from the hips and thighs to the abdomen — often without any change in BMI. This makes abdominal obesity screening especially important for women over 50, even when BMI appears normal. Bone density (DEXA) scans are more accurate than BMI for assessing health status in this age group.</p>

    <h2 class="mt-5 mb-4 text-brand">BMI Chart for Men by Age — How Age Affects Healthy BMI</h2>
    <p>While the WHO healthy BMI range (18.5–24.9) applies to all adult men, age significantly changes what a given BMI means in practice. Men in their 20s with a BMI of 22 typically have 15–20% body fat. A 60-year-old man with the same BMI may have 25–30% body fat due to age-related muscle loss (sarcopenia), despite appearing "normal" by the chart.</p>
    <p>A large analysis in The Lancet found that men over 65 with BMIs of 25–27 ("overweight" by standard classification) had lower all-cause mortality than those in the 22–24.9 range, suggesting that the optimal BMI shifts upward as men age and the protective effects of modest fat reserves outweigh the metabolic risks. For men in their 60s and beyond, maintaining muscle mass through resistance training is more important than achieving a particular BMI number.</p>

    <h2 class="mt-5 mb-4 text-brand">Is BMI Accurate for Athletes and Muscular People?</h2>
    <p>BMI is notoriously inaccurate for athletes. Muscle tissue is approximately 18% denser than fat tissue — meaning a highly muscular person weighs more per unit of volume than someone with equivalent fat. An NFL lineman, competitive powerlifter, or professional rugby player may have a BMI of 30–35 (classified as "obese") while carrying under 10% body fat and having excellent cardiovascular health metrics.</p>
    <p>For athletes and regularly exercising individuals, better alternatives include DEXA body composition scans (gold standard), hydrostatic weighing, or skinfold caliper measurements. The US military uses a tape-measure-based body fat estimation rather than BMI specifically because BMI misclassifies muscular recruits. If you exercise regularly and lift weights, treat your BMI result as one data point rather than a definitive health verdict — your body fat percentage and waist circumference are far more informative.</p>

  </div>
</section>

<x-related-tools :tools="$relatedTools" heading="More Fitness Calculators" />


{{-- ── 7. SEO Block ──────────────────────────────────────────────────────────── --}}
<section class="ms-section-seo">
  <div class="container-xl">
    <div class="row justify-content-center">
      <div class="col-lg-8 ms-seo-body">
        <h2 class="mb-4 ms-seo-h2">BMI Calculator: Limitations, History, and When to Use It</h2>
        <p>The Body Mass Index was never designed as an individual diagnostic tool. Adolphe Quetelet invented it in the 1830s as a statistical measure for studying human populations — not for assessing the health of any single person. It entered clinical use in the 1970s when Ancel Keys popularised it as a convenient proxy for obesity in epidemiological research, largely because measuring actual body fat at scale was impractical.</p>
        <h3 class="ms-seo-h3">What Your BMI Result Actually Tells You</h3>
        <p>A BMI result places you in a statistical category associated with certain average health outcomes. It does not diagnose disease, measure fitness, or predict your individual health trajectory. Two people with identical BMIs can have very different body compositions, metabolic health, and disease risk profiles. Use your BMI result as a starting point for a conversation with your doctor — not as a conclusion.</p>
        <h3 class="ms-seo-h3">Ethnic Differences in BMI Thresholds</h3>
        <p>Research consistently shows that health risks associated with excess body fat begin at lower BMI values in South Asian, East Asian, and some other ethnic populations. The WHO has proposed adjusted cut-offs for Asian populations: overweight at BMI 23+ and obesity at BMI 27.5+. If you are of South or East Asian descent, discuss these adjusted thresholds with your healthcare provider, as the standard 25/30 cut-offs may underestimate your risk.</p>
        <div class="mt-4 p-4 rounded-3 ms-note ms-note-green">
          <p class="mb-0 ms-disclaimer"><strong>Disclaimer:</strong> This BMI calculator is for informational and educational purposes only. It is not a medical device and does not provide medical advice, diagnosis, or treatment. Always consult a qualified healthcare provider before making changes to your diet, exercise routine, or health management plan.</p>
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

  // Unit toggle
  document.querySelectorAll('.bmi-unit-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
      document.querySelectorAll('.bmi-unit-btn').forEach(function (b) {
        b.classList.remove('active');
      });
      this.classList.add('active');
      currentUnit = this.dataset.unit;
      document.getElementById('bmiMetric').classList.toggle('d-none', currentUnit !== 'metric');
      document.getElementById('bmiImperial').classList.toggle('d-none', currentUnit !== 'imperial');
      document.getElementById('results').classList.add('d-none');
    });
  });

  window.calcBMI = function () {
    var heightM, weightKg;

    if (currentUnit === 'metric') {
      var cm = parseFloat(document.getElementById('bmiHeightCm').value);
      var kg = parseFloat(document.getElementById('bmiWeightKg').value);
      if (!cm || !kg || cm < 100 || cm > 250 || kg < 20 || kg > 300) {
        alert('Please enter valid height (100–250 cm) and weight (20–300 kg).');
        return;
      }
      heightM  = cm / 100;
      weightKg = kg;
    } else {
      var ft  = parseFloat(document.getElementById('bmiHeightFt').value) || 0;
      var ins = parseFloat(document.getElementById('bmiHeightIn').value) || 0;
      var lbs = parseFloat(document.getElementById('bmiWeightLbs').value);
      if (!lbs || (ft === 0 && ins === 0)) {
        alert('Please enter valid height and weight.');
        return;
      }
      var totalInches = ft * 12 + ins;
      heightM  = totalInches * 0.0254;
      weightKg = lbs * 0.453592;
    }

    var bmi = weightKg / (heightM * heightM);
    bmi = Math.round(bmi * 10) / 10;

    var cat, badgeBg, badgeColor;
    if      (bmi < 18.5) { cat = 'Underweight';  badgeBg = '#e3f4fd'; badgeColor = '#0277bd'; }
    else if (bmi < 25)   { cat = 'Normal Weight'; badgeBg = '#e8f5e9'; badgeColor = '#2e7d32'; }
    else if (bmi < 30)   { cat = 'Overweight';    badgeBg = '#fff3e0'; badgeColor = '#e65100'; }
    else                 { cat = 'Obese';          badgeBg = '#ffebee'; badgeColor = '#c62828'; }

    // Marker position (BMI 15 = 0%, BMI 40 = 100%)
    var pct = Math.min(100, Math.max(0, ((bmi - 15) / 25) * 100));

    // Healthy weight range for this height
    var minKg  = Math.round(18.5 * heightM * heightM * 10) / 10;
    var maxKg  = Math.round(24.9 * heightM * heightM * 10) / 10;
    var minLbs = Math.round(minKg * 2.20462 * 10) / 10;
    var maxLbs = Math.round(maxKg * 2.20462 * 10) / 10;

    document.getElementById('bmiValue').textContent = bmi.toFixed(1);
    document.getElementById('bmiCategory').textContent = cat;
    document.getElementById('bmiCategory').style.background = badgeBg;
    document.getElementById('bmiCategory').style.color = badgeColor;
    document.getElementById('bmiMarker').style.left = pct + '%';

    var sex = document.getElementById('bmiSex').value;
    var age = parseInt(document.getElementById('bmiAge').value);
    var ageNote = (!isNaN(age) && age >= 65) ? ' Note: for adults 65+, a BMI of 25–27 may be optimal.' : '';

    document.getElementById('bmiDetails').innerHTML =
      'Your BMI is <strong>' + bmi.toFixed(1) + '</strong> — ' + cat + '.' + ageNote;

    document.getElementById('bmiHealthyRange').innerHTML =
      '<strong>Healthy weight range for your height:</strong> ' +
      minKg + ' – ' + maxKg + ' kg &nbsp;|&nbsp; ' +
      minLbs + ' – ' + maxLbs + ' lbs';

    var resultsEl = document.getElementById('results');
    resultsEl.classList.remove('d-none');
    resultsEl.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  };

})();
</script>
@endsection
