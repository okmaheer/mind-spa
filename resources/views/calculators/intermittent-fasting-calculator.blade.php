@extends('layouts.app')

@section('title', 'Intermittent Fasting Calculator — Eating Window & Fasting Schedule | MindSnap')
@section('description', 'Free intermittent fasting calculator: choose your IF protocol (16:8, 18:6, 5:2, OMAD) and get your exact eating window, fasting window, and daily schedule. No signup.')
@section('canonical', config('app.url') . '/intermittent-fasting-calculator')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "WebApplication",
  "name": "Intermittent Fasting Calculator",
  "url": "{{ config('app.url') }}/intermittent-fasting-calculator",
  "description": "Calculate your intermittent fasting eating window and schedule based on your chosen IF protocol.",
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
    { "@@type": "ListItem", "position": 3, "name": "Intermittent Fasting Calculator" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [
    { "@@type": "Question", "name": "What is intermittent fasting?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Intermittent fasting (IF) is an eating pattern that cycles between periods of fasting and eating. Unlike traditional diets, it does not prescribe what to eat but when to eat. Popular protocols include 16:8 (fast 16 hours, eat in an 8-hour window), 18:6, 20:4, OMAD (one meal a day), and 5:2 (two low-calorie fasting days per week). During the fasting window, the body depletes glycogen stores and shifts to burning fat, producing ketone bodies as an energy source." } },
    { "@@type": "Question", "name": "Which intermittent fasting method is best for weight loss?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Research suggests 16:8 is the most effective for sustained weight loss in most people because it is practical enough to maintain long-term without extreme hunger. A 2022 meta-analysis in Obesity Reviews found that IF produces weight loss of 0.8–13% of body weight over 8–24 weeks. The best protocol is the one you can consistently follow — 12:12 is ideal for beginners, while more advanced practitioners may benefit from 18:6 or 20:4. The 5:2 method works well for those who prefer not to restrict daily." } },
    { "@@type": "Question", "name": "Can I drink coffee during a fast?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Black coffee (no milk, sugar, or cream) does not meaningfully break a fast for metabolic purposes. It contains negligible calories (typically 2–5 kcal per cup), does not spike insulin, and may actually enhance fat oxidation and autophagy. Caffeine also suppresses appetite, making fasting windows easier to maintain. However, coffee with milk, cream, butter, or sugar does break a fast by triggering an insulin response. Herbal teas and plain water are similarly fast-safe." } },
    { "@@type": "Question", "name": "What breaks a fast?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Any food or drink containing significant calories or macronutrients breaks a fast by triggering an insulin response and stopping ketogenesis. This includes: any food, milk or cream in coffee, fruit juice, protein shakes, and most supplements containing carbohydrates or fats. Safe during fasting: water, plain black coffee, plain black or green tea, sparkling water, and electrolytes without calories. Chewing gum (even sugar-free) stimulates digestive enzymes and may weakly break a fast." } },
    { "@@type": "Question", "name": "How long does it take for intermittent fasting to work?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Most people notice reduced hunger and improved energy within the first 1–2 weeks as the body adapts to the fasting pattern. Measurable weight loss typically appears within 2–4 weeks when consistently maintaining a calorie deficit within the eating window. Metabolic markers (insulin sensitivity, fasting glucose, triglycerides) improve over 4–12 weeks. The first week is often the hardest — hunger peaks around day 3–5 as ghrelin (the hunger hormone) adjusts to the new eating pattern, then substantially decreases." } }
  ]
}
</script>
@endsection

@php
$faqs = [
  ['q' => 'What is intermittent fasting?',
             'a' => 'Intermittent fasting (IF) is an eating pattern that cycles between periods of fasting and eating. Unlike traditional diets, it does not prescribe what to eat but when to eat. Popular protocols include 16:8 (fast 16 hours, eat in an 8-hour window), 18:6, 20:4, OMAD (one meal a day), and 5:2 (two low-calorie fasting days per week). During the fasting window, the body depletes glycogen stores and shifts to burning fat, producing ketone bodies as an energy source.'],
  ['q' => 'Which intermittent fasting method is best for weight loss?',
             'a' => 'Research suggests 16:8 is the most effective for sustained weight loss in most people because it is practical enough to maintain long-term without extreme hunger. A 2022 meta-analysis in Obesity Reviews found IF produces weight loss of 0.8–13% of body weight over 8–24 weeks. The best protocol is the one you can consistently follow — 12:12 for beginners, 18:6 or 20:4 for advanced practitioners. The 5:2 method works well for those who prefer not to restrict daily.'],
  ['q' => 'Can I drink coffee during a fast?',
             'a' => 'Black coffee (no milk, sugar, or cream) does not meaningfully break a fast for metabolic purposes. It contains negligible calories (2–5 kcal per cup), does not spike insulin, and may actually enhance fat oxidation and autophagy. Caffeine also suppresses appetite, making fasting windows easier to maintain. However, coffee with milk, cream, butter, or sugar does break a fast by triggering an insulin response. Herbal teas and plain water are similarly fast-safe.'],
  ['q' => 'What breaks a fast?',
             'a' => 'Any food or drink containing significant calories or macronutrients breaks a fast by triggering an insulin response and stopping ketogenesis. This includes: any food, milk or cream in coffee, fruit juice, protein shakes, and most supplements containing carbohydrates or fats. Safe during fasting: water, plain black coffee, plain black or green tea, sparkling water, and electrolytes without calories. Chewing gum (even sugar-free) stimulates digestive enzymes and may weakly break a fast.'],
  ['q' => 'How long does it take for intermittent fasting to work?',
             'a' => 'Most people notice reduced hunger and improved energy within the first 1–2 weeks as the body adapts. Measurable weight loss typically appears within 2–4 weeks when consistently maintaining a calorie deficit within the eating window. Metabolic markers (insulin sensitivity, fasting glucose, triglycerides) improve over 4–12 weeks. The first week is often the hardest — hunger peaks around day 3–5 as ghrelin adjusts to the new pattern, then substantially decreases.'],
  ['q' => 'Is intermittent fasting safe for women?',
             'a' => 'IF can be safe and effective for many women, but research suggests women may need to approach it more gradually. Studies show some women experience hormonal disruptions — particularly in leptin, ghrelin, and reproductive hormones — with aggressive fasting protocols like 20:4 or OMAD. The 12:12 or 14:10 protocol is a safer starting point for women. Pregnant or breastfeeding women should not fast. Women with a history of disordered eating should consult a healthcare provider before starting IF.'],
  ['q' => 'What should I eat during my eating window?',
             'a' => 'IF does not dictate food choices, but quality matters for results. Prioritise whole foods: lean proteins (to preserve muscle mass and increase satiety), vegetables, healthy fats, and complex carbohydrates. Avoid using the eating window as licence to overeat ultra-processed foods — IF works primarily through caloric restriction and hormonal shifts, and poor food quality can negate both. Protein intake is especially important: aim for 1.6–2.2g per kilogram of body weight spread across your eating window.'],
  ['q' => 'What is autophagy and when does it start during fasting?',
             'a' => 'Autophagy (Greek for "self-eating") is a cellular housekeeping process where cells break down and recycle damaged proteins and organelles. It plays a role in cancer prevention, metabolic health, and longevity. Autophagy begins increasing around 12–16 hours into a fast and peaks at around 18–24 hours. The research on autophagy in humans is largely from animal models — the exact thresholds for humans are still being studied. Nobel Prize winner Yoshinori Ohsumi\'s 2016 work established the molecular mechanisms.'],
];

$relatedTools = [
  ['icon' => '💧', 'name' => 'Water Intake Calculator', 'slug' => 'water-intake-calculator', 'desc' => 'Find your personalised daily hydration target.'],
  ['icon' => '🔥', 'name' => 'Calorie Calculator', 'slug' => 'calorie-calculator', 'desc' => 'Calculate your TDEE and daily calorie needs.'],
  ['icon' => '📉', 'name' => 'Calorie Deficit Calculator', 'slug' => 'calorie-deficit-calculator', 'desc' => 'Set your deficit for safe, steady fat loss.'],
  ['icon' => '⚖️', 'name' => 'Macro Calculator', 'slug' => 'macro-calculator', 'desc' => 'Protein, carbs, and fat targets for your goal.'],
  ['icon' => '💪', 'name' => 'Protein Calculator', 'slug' => 'protein-calculator', 'desc' => 'How much protein do you actually need daily?'],
  ['icon' => '📏', 'name' => 'BMI Calculator', 'slug' => 'bmi-calculator', 'desc' => 'Check your body mass index and healthy weight range.'],
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
          ['url' => route('category.nutrition'), 'name' => 'Nutrition Tools'],
          ['url' => '', 'name' => 'Intermittent Fasting Calculator'],
        ]"/>

        <h1 class="mb-2 ms-hero-title">
          ⏰ Intermittent Fasting Calculator — Your Eating &amp; Fasting Schedule
        </h1>
        <p class="ms-hero-desc">
          Choose your IF protocol and get your exact eating window, fasting start time, and a personalised daily schedule.
        </p>

        {{-- ── Tool Card ─────────────────────────────────────────────────────── --}}
        <div class="card border-0 mb-n4 ms-tool-card">
          <div class="card-body p-4 p-md-5">

            {{-- Protocol --}}
            <div class="mb-3">
              <label for="ifProtocol" class="form-label fw-semibold">Fasting Protocol</label>
              <select id="ifProtocol" class="form-select" onchange="ifProtocolChange()">
                <option value="12:12">12:12 — Beginner (12h fast, 12h eating)</option>
                <option value="14:10">14:10 — Easy (14h fast, 10h eating)</option>
                <option value="16:8" selected>16:8 — Most Popular (16h fast, 8h eating)</option>
                <option value="18:6">18:6 — Intermediate (18h fast, 6h eating)</option>
                <option value="20:4">20:4 — Advanced (20h fast, 4h eating)</option>
                <option value="23:1">OMAD (23h fast, 1h eating)</option>
                <option value="5:2">5:2 — Weekly (2 fasting days, 500–600 kcal)</option>
                <option value="custom">Custom</option>
              </select>
            </div>

            {{-- Daily protocol inputs --}}
            <div id="ifDailyInputs">
              <div class="mb-3">
                <label for="ifEatStart" class="form-label fw-semibold">When do you want to start eating?</label>
                <input type="time" id="ifEatStart" class="form-control" value="12:00" aria-label="Eating window start time">
              </div>
            </div>

            {{-- Custom inputs --}}
            <div id="ifCustomInputs" class="d-none">
              <div class="row g-3 mb-3">
                <div class="col-6">
                  <label for="ifCustomFast" class="form-label fw-semibold">Fasting hours</label>
                  <input type="number" id="ifCustomFast" class="form-control" value="16" min="8" max="23">
                </div>
                <div class="col-6">
                  <label for="ifCustomEat" class="form-label fw-semibold">Eating hours</label>
                  <input type="number" id="ifCustomEat" class="form-control" value="8" min="1" max="16">
                </div>
              </div>
              <div class="mb-3">
                <label for="ifCustomStart" class="form-label fw-semibold">Eating window start time</label>
                <input type="time" id="ifCustomStart" class="form-control" value="12:00">
              </div>
            </div>

            {{-- 5:2 inputs --}}
            <div id="if52Inputs" class="d-none mb-3">
              <div class="p-3 rounded-3" style="background:#fff8e1; border:1px solid #ffe082;">
                <p style="font-size:.85rem; font-weight:600; color:#e65100; margin-bottom:8px;">5:2 Protocol Information</p>
                <p style="font-size:.82rem; color:#555; margin:0;">On your 2 fasting days, limit intake to 500–600 calories. Choose non-consecutive days (e.g. Monday and Thursday). Eat normally on the other 5 days.</p>
              </div>
            </div>

            {{-- Goal --}}
            <div class="mb-4">
              <label for="ifGoal" class="form-label fw-semibold">Your Goal</label>
              <select id="ifGoal" class="form-select">
                <option value="weight">Weight loss</option>
                <option value="metabolic">Metabolic health</option>
                <option value="autophagy">Autophagy / longevity</option>
                <option value="athletic">Athletic performance</option>
              </select>
            </div>

            <button class="btn btn-cta w-100" onclick="ifCalculate()" style="font-size:1rem;">
              Generate My Fasting Schedule →
            </button>

            {{-- Results --}}
            <div id="ifResults" class="mt-4 d-none">
              <div style="height:1px; background:#f0f0f0; margin-bottom:20px;"></div>

              <div id="if52Summary" class="d-none p-4 rounded-3" style="background:#fff8e1; border:1px solid #ffd566;">
                <h4 style="font-size:1rem; color:#e65100; margin-bottom:12px;">5:2 Weekly Fasting Plan</h4>
                <p style="font-size:.88rem; color:#555; margin-bottom:8px;"><strong>Fasting days:</strong> Limit to 500 kcal (women) or 600 kcal (men) on 2 non-consecutive days.</p>
                <p style="font-size:.88rem; color:#555; margin-bottom:8px;"><strong>Suggested fasting days:</strong> Monday &amp; Thursday</p>
                <p style="font-size:.88rem; color:#555; margin-bottom:0;"><strong>Eating days (5):</strong> Eat normally at maintenance calories — no restriction needed.</p>
              </div>

              <div id="ifScheduleBlock">
                <div class="row g-3 mb-4">
                  <div class="col-6">
                    <div class="text-center p-3 rounded-3" style="background:#fff8e1; border:1px solid #ffd566;">
                      <div id="ifEatOpenDisplay" style="font-size:1.5rem; font-weight:700; color:var(--nutrition);"></div>
                      <div style="font-size:.75rem; color:#666; margin-top:2px;">🍽️ Eating window opens</div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="text-center p-3 rounded-3" style="background:#e8f0ff; border:1px solid #b8d0ff;">
                      <div id="ifEatCloseDisplay" style="font-size:1.5rem; font-weight:700; color:var(--primary-mid);"></div>
                      <div style="font-size:.75rem; color:#666; margin-top:2px;">🚫 Eating window closes</div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="text-center p-3 rounded-3" style="background:#e8f0ff; border:1px solid #b8d0ff;">
                      <div id="ifFastStartDisplay" style="font-size:1.5rem; font-weight:700; color:var(--primary-mid);"></div>
                      <div style="font-size:.75rem; color:#666; margin-top:2px;">⏱️ Fast begins</div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="text-center p-3 rounded-3" style="background:#fff8e1; border:1px solid #ffd566;">
                      <div id="ifFastEndDisplay" style="font-size:1.5rem; font-weight:700; color:var(--nutrition);"></div>
                      <div style="font-size:.75rem; color:#666; margin-top:2px;">✅ Fast ends (next day)</div>
                    </div>
                  </div>
                </div>

                <div class="p-3 rounded-3 mb-3" style="background:#f0fff4; border:1px solid #b3f0c8;">
                  <div style="font-size:.8rem; font-weight:600; color:#1a6e3a; margin-bottom:8px;">⏳ What happens during your fast</div>
                  <div id="ifTimeline" style="font-size:.78rem; color:#444; line-height:1.9;"></div>
                </div>

                <div class="p-3 rounded-3" style="background:#fff8e1; border:1px solid #ffe082;">
                  <div style="font-size:.8rem; font-weight:600; color:#e65100; margin-bottom:6px;">💡 Protocol Tips</div>
                  <div id="ifTips" style="font-size:.78rem; color:#555; line-height:1.8;"></div>
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
          <h3 class="ms-facts-title">Quick IF Facts</h3>
          @foreach([
            ['16:8',      'Most popular IF protocol (16h fast)'],
            ['14–18 hrs', 'Fasting window needed for autophagy'],
            ['24 hrs',    'When glycogen depletes and fat burning peaks'],
            ['12 hrs',    'Minimum fast for metabolic benefits'],
            ['5%',        'Average body weight loss in 3-month IF studies'],
          ] as [$stat, $label])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div class="ms-fact-pill ms-fact-pill-nutrition">{{ $stat }}</div>
            <div class="ms-fact-label">{{ $label }}</div>
          </div>
          @endforeach
          <p class="ms-fact-source">Sources: Obesity Reviews, Cell Metabolism, NEJM</p>
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
        <h2 class="mb-4">How Intermittent Fasting Works: Metabolic Switching Explained</h2>
        <p>When you eat, your body digests carbohydrates into glucose and stores excess as glycogen in the liver and muscles. In a fed state, insulin is elevated and fat burning is suppressed — your body is in storage mode.</p>
        <p>After roughly 12 hours of fasting, liver glycogen depletes and insulin drops. Your body switches its primary fuel source from glucose to fatty acids and ketone bodies — a process called metabolic switching. This is when IF's metabolic benefits begin.</p>
        <p>At around 16–18 hours, autophagy (cellular "self-cleaning") ramps up significantly. At 24 hours, growth hormone spikes to preserve muscle mass. These cascading hormonal changes — not calorie restriction alone — are why IF produces different outcomes to simply eating less throughout the day.</p>
      </div>
      <div class="col-lg-7">
        <div class="p-4 rounded-3 ms-data-box">
          <p class="fw-semibold mb-3" style="color:var(--primary-dark); font-size:.88rem; text-transform:uppercase; letter-spacing:.5px;">Fasting timeline milestones</p>
          @foreach([
            ['0–4 hrs',   '#e8f5e9', '#2e7d32', 'Fed state. Insulin elevated. Body uses glucose for energy. Fat storage active.'],
            ['4–12 hrs',  '#fff8e1', '#e65100', 'Post-absorptive. Insulin falling. Glycogen being used. Early fat oxidation begins.'],
            ['12–16 hrs', '#e3f2fd', '#1565c0', 'Fasting state. Glycogen depleted. Fat burning accelerates. Ketones rising.'],
            ['16–24 hrs', '#ede7f6', '#4527a0', 'Autophagy peaks. Growth hormone rising. Deep ketosis. Maximum fat oxidation.'],
            ['24–72 hrs', '#fce4ec', '#880e4f', 'Extended fast. Stem cell activation. Significant immune system regeneration.'],
          ] as [$time, $bg, $text, $desc])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div style="background:{{ $bg }}; color:{{ $text }}; border-radius:8px; padding:5px 10px; font-weight:700; font-size:.78rem; min-width:70px; text-align:center; flex-shrink:0; border:1px solid {{ $text }}30;">{{ $time }}</div>
            <div style="font-size:.81rem; color:#555; line-height:1.5;">{{ $desc }}</div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="ifAccordion" />


{{-- ── 4. Long-tail sections ─────────────────────────────────────────────────── --}}
<section class="ms-section-accent">
  <div class="container ms-longtail">

    <h2 class="mb-4" style="color:var(--primary-dark);">16:8 Intermittent Fasting Schedule — Best Eating Window Times</h2>
    <p>The 16:8 protocol is the most researched and widely adopted form of intermittent fasting, and for good reason: a 16-hour fast is long enough to trigger meaningful metabolic benefits (glycogen depletion, fat oxidation, early autophagy) while still allowing an 8-hour eating window that fits most social and work schedules. The most popular window is 12:00 PM to 8:00 PM — this lets you skip breakfast and eat a late lunch, afternoon snack, and dinner without conflicting with evening social events. For morning exercisers, a 10:00 AM to 6:00 PM window allows a post-workout meal. For night owls, 2:00 PM to 10:00 PM works well. The specific hours matter less than consistency — your circadian rhythm adapts to the pattern within 1–2 weeks, reducing hunger outside the window substantially.</p>

    <h2 class="mt-5 mb-4" style="color:var(--primary-dark);">5:2 Fasting Calculator — How Many Calories on Fast Days?</h2>
    <p>The 5:2 protocol, popularised by Dr Michael Mosley's research, involves eating normally 5 days per week and restricting calories to 500 (women) or 600 (men) on 2 non-consecutive fasting days. The original research, published in the International Journal of Obesity (2011), compared 5:2 to continuous calorie restriction and found equivalent weight loss with better improvements in insulin sensitivity. On fasting days, spreading calories across 2 small meals (e.g., 250 kcal breakfast and 250 kcal dinner) is easier than OMAD for most people. Choosing non-consecutive days — Monday and Thursday or Tuesday and Friday — prevents two consecutive difficult days and allows recovery. Unlike daily IF protocols, 5:2 does not require watching eating window times on non-fasting days.</p>

    <h2 class="mt-5 mb-4" style="color:var(--primary-dark);">Intermittent Fasting for Women — Is It Different?</h2>
    <p>Women can absolutely benefit from intermittent fasting, but the approach may need to be more conservative, particularly at first. Female hormones — including oestrogen, progesterone, and luteinising hormone — are sensitive to caloric restriction and fasting stress. Extended fasts (18+ hours) can temporarily disrupt the hypothalamic-pituitary-ovarian axis, affecting menstrual cycles and fertility in some women. This is more likely with very long fasts, very low calorie intake within the eating window, and high exercise volume simultaneously. The evidence-based approach for women new to IF: start with 12:12, establish that for 2–4 weeks, then optionally progress to 14:10 or 16:8. Listen to cycle changes — if periods become irregular, shorten the fasting window. Women with PCOS may find IF particularly beneficial for insulin regulation, as PCOS often involves insulin resistance.</p>

  </div>
</section>

<x-related-tools :tools="$relatedTools" heading="More Nutrition Tools" />


{{-- ── 6. SEO Block ─────────────────────────────────────────────────────────── --}}
<section class="ms-section-seo">
  <div class="container-xl">
    <div class="row justify-content-center">
      <div class="col-lg-8 ms-seo-body">
        <h2 class="mb-4 ms-seo-h2">Intermittent Fasting: What the Research Actually Shows</h2>
        <p>Intermittent fasting has shifted from fringe practice to mainstream nutrition strategy, backed by a growing body of peer-reviewed evidence. A landmark 2019 review in the <em>New England Journal of Medicine</em> by Dr Mark Mattson concluded that IF produces benefits beyond simple caloric restriction: improvements in blood pressure, resting heart rate, triglycerides, and LDL cholesterol, as well as reductions in inflammatory markers.</p>
        <h3 class="ms-seo-h3">IF vs. Continuous Calorie Restriction</h3>
        <p>Multiple randomised controlled trials have compared IF to traditional continuous calorie restriction (CCR) for weight loss. The overall finding: both produce similar weight loss when calories are matched. However, IF shows advantages in adherence (people find it easier to maintain), improvements in insulin sensitivity even without weight loss, and in some studies, greater preservation of lean muscle mass — particularly relevant for older adults.</p>
        <h3 class="ms-seo-h3">Who Should Avoid IF</h3>
        <p>Intermittent fasting is not appropriate for everyone. People with type 1 diabetes (risk of hypoglycaemia), those with a history of eating disorders, children and adolescents, pregnant or breastfeeding women, and people who are underweight should not follow fasting protocols without medical supervision. If you take medications that require food, consult your doctor before starting IF.</p>
        <div class="mt-4 p-4 rounded-3 ms-note ms-note-orange">
          <p style="margin:0; font-size:.85rem; color:#6d4c00;"><strong>Note:</strong> This calculator is for general wellness guidance. Intermittent fasting is not suitable for everyone. Consult a healthcare professional before starting any fasting protocol, especially if you have diabetes, a history of eating disorders, or take prescription medications.</p>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')
<script>
(function () {

  var PROTOCOLS = {
    '12:12': { fast: 12, eat: 12 },
    '14:10': { fast: 14, eat: 10 },
    '16:8':  { fast: 16, eat:  8 },
    '18:6':  { fast: 18, eat:  6 },
    '20:4':  { fast: 20, eat:  4 },
    '23:1':  { fast: 23, eat:  1 },
    '5:2':   { fast: null, eat: null },
    'custom':{ fast: null, eat: null },
  };

  var TIPS = {
    'weight':    ['Focus on whole foods within your eating window to maximise satiety.', 'Avoid "eating back" calories you saved during the fast.', 'Track your eating window consistently — same times daily aids adherence.'],
    'metabolic': ['Prioritise complex carbohydrates and fibre during the eating window.', 'Pair IF with regular resistance training for best metabolic outcomes.', 'Monitor fasting blood glucose monthly to track progress.'],
    'autophagy': ['Longer fasting windows (18+ hours) maximise autophagy benefits.', 'Exercise during the fasting window can amplify autophagy.', 'Avoid protein during the fast — even amino acids can suppress autophagy via mTOR.'],
    'athletic':  ['Eat most of your carbohydrates within 2 hours post-workout.', 'Target 2g of protein per kg of body weight within your eating window.', 'Consider a shorter fast (14:10) on intense training days.'],
  };

  function parseTimeToMin(str) {
    var p = str.split(':');
    return parseInt(p[0]) * 60 + parseInt(p[1]);
  }

  function minToDisplay(totalMin) {
    totalMin = ((totalMin % 1440) + 1440) % 1440;
    var h = Math.floor(totalMin / 60);
    var m = totalMin % 60;
    var period = h >= 12 ? 'PM' : 'AM';
    var hd = h % 12 === 0 ? 12 : h % 12;
    return hd + ':' + (m < 10 ? '0' + m : m) + ' ' + period;
  }

  window.ifProtocolChange = function () {
    var val = document.getElementById('ifProtocol').value;
    document.getElementById('ifDailyInputs').classList.toggle('d-none',  val === '5:2' || val === 'custom');
    document.getElementById('ifCustomInputs').classList.toggle('d-none', val !== 'custom');
    document.getElementById('if52Inputs').classList.toggle('d-none',     val !== '5:2');
    document.getElementById('ifResults').classList.add('d-none');
  };

  window.ifCalculate = function () {
    var protocol = document.getElementById('ifProtocol').value;
    var goal     = document.getElementById('ifGoal').value;

    if (protocol === '5:2') {
      document.getElementById('ifResults').classList.remove('d-none');
      document.getElementById('if52Summary').classList.remove('d-none');
      document.getElementById('ifScheduleBlock').classList.add('d-none');
      return;
    }

    var fastH, eatH, startMin;
    if (protocol === 'custom') {
      fastH    = parseInt(document.getElementById('ifCustomFast').value);
      eatH     = parseInt(document.getElementById('ifCustomEat').value);
      startMin = parseTimeToMin(document.getElementById('ifCustomStart').value);
    } else {
      fastH    = PROTOCOLS[protocol].fast;
      eatH     = PROTOCOLS[protocol].eat;
      startMin = parseTimeToMin(document.getElementById('ifEatStart').value);
    }

    var eatOpenMin  = startMin;
    var eatCloseMin = startMin + eatH * 60;
    var fastStartMin = eatCloseMin;
    var fastEndMin   = eatCloseMin + fastH * 60; // = eatOpenMin next day

    document.getElementById('ifEatOpenDisplay').textContent  = minToDisplay(eatOpenMin);
    document.getElementById('ifEatCloseDisplay').textContent = minToDisplay(eatCloseMin);
    document.getElementById('ifFastStartDisplay').textContent = minToDisplay(fastStartMin);
    document.getElementById('ifFastEndDisplay').textContent   = minToDisplay(fastEndMin);

    // Timeline
    var timelineItems = [
      { h: 0,  label: 'Fast begins — insulin starts dropping.' },
      { h: 4,  label: 'Blood glucose normalises. Liver glycogen being used.' },
      { h: 12, label: 'Glycogen depleted. Ketosis begins. Fat burning accelerates.' },
      { h: 14, label: 'Autophagy starting. Growth hormone begins rising.' },
      { h: 16, label: 'Peak fat oxidation. Autophagy well established.' },
      { h: 18, label: 'Deep autophagy. Significant metabolic switching.' },
      { h: 24, label: 'Growth hormone peaks. Maximum glycogen depletion.' },
    ];
    var tlHTML = '';
    timelineItems.forEach(function (item) {
      if (item.h <= fastH) {
        var timeAtMilestone = minToDisplay(fastStartMin + item.h * 60);
        var reached = item.h <= fastH ? '✅' : '⬜';
        tlHTML += reached + ' <strong>' + item.h + 'h</strong> (' + timeAtMilestone + ') — ' + item.label + '<br>';
      }
    });
    document.getElementById('ifTimeline').innerHTML = tlHTML;

    // Tips
    var tips = TIPS[goal] || TIPS['weight'];
    document.getElementById('ifTips').innerHTML = tips.map(function (t) { return '• ' + t; }).join('<br>');

    document.getElementById('ifResults').classList.remove('d-none');
    document.getElementById('if52Summary').classList.add('d-none');
    document.getElementById('ifScheduleBlock').classList.remove('d-none');
    document.getElementById('ifResults').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  };

})();
</script>
@endsection
