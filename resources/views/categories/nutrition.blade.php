@extends('layouts.app')

@section('title', 'Free Nutrition Calculators — Water Intake & Intermittent Fasting | MindSnap')
@section('description', 'Free nutrition calculators: daily water intake calculator based on your weight and activity level, plus intermittent fasting calculator for 16:8, 18:6, OMAD, and 5:2 protocols. Instant results, no signup.')
@section('canonical', config('app.url') . '/nutrition-tools')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@graph": [
    {
      "@@type": "CollectionPage",
      "@@id": "{{ config('app.url') }}/nutrition-tools#collection",
      "url": "{{ config('app.url') }}/nutrition-tools",
      "name": "Free Nutrition Calculators",
      "description": "Free nutrition calculators including daily water intake calculator and intermittent fasting schedule calculator for 16:8, 18:6, and 5:2 protocols.",
      "inLanguage": "en",
      "publisher": { "@@type": "Organization", "name": "MindSnap", "url": "{{ config('app.url') }}" }
    },
    {
      "@@type": "BreadcrumbList",
      "itemListElement": [
        { "@@type": "ListItem", "position": 1, "name": "Home",            "item": "{{ config('app.url') }}" },
        { "@@type": "ListItem", "position": 2, "name": "Nutrition Tools", "item": "{{ config('app.url') }}/nutrition-tools" }
      ]
    },
    {
      "@@type": "FAQPage",
      "mainEntity": [
        { "@@type": "Question", "name": "How much water should I drink per day?",          "acceptedAnswer": { "@@type": "Answer", "text": "The general baseline is 0.033 litres per kg of bodyweight per day. Active people, those in hot climates, or pregnant women need more." } },
        { "@@type": "Question", "name": "What is intermittent fasting and how does it work?", "acceptedAnswer": { "@@type": "Answer", "text": "Intermittent fasting cycles between eating and fasting windows. The most popular protocol is 16:8 — fast for 16 hours, eat within an 8-hour window." } },
        { "@@type": "Question", "name": "Is the 16:8 fasting method effective for weight loss?", "acceptedAnswer": { "@@type": "Answer", "text": "Yes. 16:8 reduces your eating window, naturally lowering calorie intake. Research also shows benefits for insulin sensitivity and cellular repair (autophagy)." } }
      ]
    }
  ]
}
</script>
@endsection

@php
$cat  = config('mindsnap.categories')['nutrition'];
$faqs = [
  ['q' => 'How much water should I drink per day?',
   'a' => 'The general baseline is <strong>0.033 litres per kg of bodyweight</strong> (about 8 cups for a 70kg adult). Add 500ml for every hour of exercise. Hot climates or pregnancy increase needs further. Our <a href="/water-intake-calculator">Water Intake Calculator</a> gives your exact daily target.'],
  ['q' => 'What is intermittent fasting and which protocol is best?',
   'a' => '<strong>16:8</strong> (fast 16h, eat within 8h window) is the most sustainable for beginners. 18:6 offers faster results. 5:2 means eating normally 5 days and limiting to ~500 kcal on 2 non-consecutive days. Use our <a href="/intermittent-fasting-calculator">IF Calculator</a> to set your eating window times.'],
  ['q' => 'Can I drink coffee or tea during intermittent fasting?',
   'a' => 'Yes — black coffee and plain tea (no milk or sugar) have near-zero calories and do not break a fast. They may actually enhance fasting benefits by slightly raising metabolism. Avoid adding cream, milk, or sweeteners during your fasting window.'],
  ['q' => 'Does drinking more water help with weight loss?',
   'a' => 'Yes. Drinking 500ml of water 30 minutes before meals reduces calorie intake by 13% on average (2015 clinical trial). Water also boosts metabolism by ~30% for 30–40 minutes. Replace sugary drinks with water to cut hundreds of daily calories effortlessly.'],
  ['q' => 'Is intermittent fasting safe for women?',
   'a' => 'IF is generally safe for healthy adult women. Some women are more sensitive to caloric restriction — particularly during reproductive years. The gentler <strong>14:10 protocol</strong> is often recommended as a starting point. Pregnant or breastfeeding women should not fast. Consult a doctor if you have a history of eating disorders or hormonal conditions.'],
  ['q' => 'Can I combine water intake tracking with intermittent fasting?',
   'a' => 'Yes — staying well hydrated is particularly important during fasting windows. Water, black coffee, and plain tea do not break a fast. Use our <a href="/water-intake-calculator">Water Intake Calculator</a> to set your daily hydration target and aim to reach it primarily during your eating window, with 500ml first thing in the morning.'],
  ['q' => 'Can I drink coffee while intermittent fasting?',
   'a' => 'Black coffee (no milk, sugar, or cream) contains effectively zero calories and does not break a fast. It may also enhance the benefits of fasting by suppressing appetite and mildly increasing fat oxidation. However, coffee on an empty stomach can cause acid reflux or anxiety in sensitive individuals.'],
  ['q' => 'How much water should I drink to lose weight?',
   'a' => 'Drinking water before meals reduces calorie intake by an average of 13% (Obesity journal). While water itself does not directly burn fat, adequate hydration supports metabolism and prevents hunger signals that are actually thirst. Drinking 500ml of water 30 minutes before each meal is the most evidence-backed strategy.'],
  ['q' => 'What is the best intermittent fasting schedule for beginners?',
   'a' => 'The 16:8 protocol is the most studied, but beginners often find it too restrictive initially. Starting with 12:12 for 1–2 weeks allows the body to adapt before progressing to 14:10, then 16:8. Choose an eating window that fits your natural schedule — sustainability matters more than the exact protocol.'],
];

$relatedTools = [
  ['icon' => '💪', 'name' => 'Fitness Tools',  'slug' => '/fitness-tools',  'desc' => 'BMI, calories & macro calculators'],
  ['icon' => '😴', 'name' => 'Sleep Tools',    'slug' => '/sleep-tools',    'desc' => 'Bedtime & sleep cycle calculators'],
  ['icon' => '🎮', 'name' => 'Brain Games',    'slug' => '/games',          'desc' => 'Typing speed, memory & reaction tests'],
  ['icon' => '⏰', 'name' => 'Life Tools',      'slug' => '/life-tools',     'desc' => 'Age, dates & life calculators'],
];
@endphp

@section('content')

<nav aria-label="Breadcrumb" class="ms-cat-nav">
  <div class="container-xl">
    <ol class="breadcrumb mb-0">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Nutrition Tools</li>
    </ol>
  </div>
</nav>

{{-- Hero --}}
<section class="ms-cat-hero">
  <div class="container-xl">
    <div class="row align-items-center g-4">
      <div class="col-lg-8">
        <div class="d-flex align-items-center gap-3 mb-3">
          <span class="ms-hero-icon">{{ $cat['icon'] }}</span>
          <span class="ms-cat-badge-nutrition">{{ $cat['label'] }}</span>
        </div>
        <h1 class="ms-cat-hero-h1">Free Nutrition Calculators — Water Intake &amp; Fasting</h1>
        <p class="ms-cat-hero-p">
          Know exactly how much to drink and when to eat. Personalised water intake targets and intermittent fasting schedules — free, instant, no signup.
        </p>
        <div class="d-flex flex-wrap gap-3">
          <div class="ms-hero-feature d-flex align-items-center gap-2">
            <svg width="16" height="16" fill="none" stroke="#fd7e14" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            Personalised to your weight &amp; activity
          </div>
          <div class="ms-hero-feature d-flex align-items-center gap-2">
            <svg width="16" height="16" fill="none" stroke="#fd7e14" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            All fasting protocols covered
          </div>
          <div class="ms-hero-feature d-flex align-items-center gap-2">
            <svg width="16" height="16" fill="none" stroke="#fd7e14" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            100% free, no signup
          </div>
        </div>
      </div>
      <div class="col-lg-4 d-none d-lg-flex justify-content-end">
        <div class="ms-hero-stat-box ms-hero-stat-box-nutrition">
          <div class="ms-hero-stat-num">2</div>
          <div class="ms-hero-stat-sub">Nutrition Tools</div>
          <div class="ms-hero-stat-div"></div>
          <div class="ms-hero-stat-val">570K+</div>
          <div class="ms-hero-stat-sub">Monthly searches</div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Tools --}}
<section class="ms-section-tools">
  <div class="container-xl">
    <div class="d-flex align-items-center justify-content-between mb-4">
      <h2 class="ms-section-h2">Nutrition Calculators</h2>
      <span class="text-muted-sm">{{ count($tools) ?: 2 }} tools</span>
    </div>
    @if(count($tools))
    <div class="row g-4">
      @foreach($tools as $tool)
      <div class="col-sm-6 col-lg-5">
        <a href="/{{ $tool['slug'] }}" class="tool-card d-block p-5 h-100 text-decoration-none ms-tool-card-nutrition">
          <div class="d-flex align-items-start gap-3">
            <span class="ms-tool-icon-lg">{{ $tool['icon'] ?? '🥗' }}</span>
            <div>
              <div class="ms-tool-name-lg">{{ $tool['name'] }}</div>
              <div class="ms-tool-desc-lg">{{ $tool['description'] }}</div>
              @if(!empty($tool['monthly_searches']) && $tool['monthly_searches'] > 0)
              <div class="mt-3"><span class="badge-searches">{{ number_format($tool['monthly_searches'] / 1000) }}K searches/mo</span></div>
              @endif
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
    @else
    <div class="row g-4 justify-content-center">
      @foreach([
        ['💧','Water Intake Calculator',         '/water-intake-calculator',         'Calculate your daily hydration target based on weight, climate, and activity level. Metric and imperial.','368K'],
        ['🕐','Intermittent Fasting Calculator', '/intermittent-fasting-calculator', 'Plan your eating and fasting windows for 16:8, 18:6, 5:2, and other IF protocols. Get your exact schedule.','201K'],
      ] as [$icon,$name,$slug,$desc,$searches])
      <div class="col-sm-10 col-lg-5">
        <a href="{{ $slug }}" class="tool-card d-block p-5 h-100 text-decoration-none ms-tool-card-nutrition">
          <div class="d-flex align-items-start gap-3">
            <span class="ms-tool-icon-lg">{{ $icon }}</span>
            <div>
              <div class="ms-tool-name-lg">{{ $name }}</div>
              <div class="ms-tool-desc-lg">{{ $desc }}</div>
              <div class="mt-3"><span class="badge-searches">{{ $searches }} searches/mo</span></div>
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
    @endif
  </div>
</section>

{{-- Quick Facts --}}
<section class="ms-section-stats">
  <div class="container-xl">
    <h2 class="mb-4 text-center">Nutrition at a Glance</h2>
    <div class="row g-3 justify-content-center">
      @foreach([
        ['💧','2.5–3.5L','Recommended daily water for adults'],
        ['🕐','16:8',    'Most popular IF protocol'],
        ['🔬','12–16 hrs','When autophagy begins during fasting'],
        ['🌡️','+500ml', 'Extra water needed per hour of exercise'],
      ] as [$icon,$stat,$label])
      <div class="col-6 col-md-3">
        <div class="tool-card p-4 text-center h-100">
          <div class="ms-cycle-icon">{{ $icon }}</div>
          <div class="ms-stat-val-md">{{ $stat }}</div>
          <div class="ms-cycle-label">{{ $label }}</div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- SEO Content --}}
<section class="ms-section-seo-alt">
  <div class="container ms-longtail">
    <h2 class="mb-4 text-brand">How Much Water Should I Drink Per Day?</h2>
    <p>The popular "8 glasses a day" rule has no scientific basis — it originated from a 1945 US Food and Nutrition Board recommendation that was later misquoted without the crucial second sentence: "most of this quantity is contained in prepared foods." Actual water needs vary significantly by body weight, activity level, climate, and diet. A 50 kg sedentary woman in a cool climate needs far less than a 90 kg athlete training in summer heat. Our water intake calculator gives you a personalised daily target based on your individual factors rather than a blanket recommendation.</p>
    <h2 class="mt-5 mb-4 text-brand">Intermittent Fasting for Women — What Is Different</h2>
    <p>Most intermittent fasting research has been conducted on male subjects, and emerging evidence suggests women may respond differently. Some women report menstrual cycle disruption, increased cortisol, and worsening sleep when following strict 16:8 fasting, particularly those who are already lean or under stress. Modified approaches — such as a 14:10 window or 5:2 (rather than daily fasting) — appear better tolerated. Women who are pregnant, breastfeeding, or have a history of disordered eating should not fast without medical supervision.</p>
    <h2 class="mt-5 mb-4 text-brand">Intermittent Fasting for Weight Loss — Does It Work?</h2>
    <p>A major 2022 New England Journal of Medicine study found intermittent fasting (16:8) produced similar weight loss to continuous calorie restriction over 12 months. The mechanism is primarily calorie reduction (eating in a shorter window naturally reduces total intake for most people) rather than any metabolic "fasting state" magic. IF works well for people who prefer skipping breakfast over counting calories — it is a structure that makes calorie reduction easier, not a superior metabolic strategy.</p>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="nutritionFaq" />

<x-related-tools :tools="$relatedTools" heading="Explore More Tools" />

@endsection
