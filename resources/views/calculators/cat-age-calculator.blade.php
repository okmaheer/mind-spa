@extends('layouts.app')

@section('title', 'Cat Age Calculator — Human Years Converter | MindSnap')
@section('description', 'Find out how old your cat is in human years — free and instant. Uses the AAFP\'s updated cat life stages from kitten to senior and geriatric.')
@section('canonical', config('app.url') . '/cat-age-calculator')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "WebApplication",
  "name": "Cat Age Calculator",
  "url": "{{ config('app.url') }}/cat-age-calculator",
  "description": "Convert your cat's age to human years using the AAFP's updated life stage guidelines. Covers kitten through geriatric stages.",
  "applicationCategory": "LifestyleApplication",
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
    { "@@type": "ListItem", "position": 1, "name": "Home",      "item": "{{ config('app.url') }}" },
    { "@@type": "ListItem", "position": 2, "name": "Pet Tools", "item": "{{ config('app.url') }}/pet-tools" },
    { "@@type": "ListItem", "position": 3, "name": "Cat Age Calculator" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [
    { "@@type": "Question", "name": "How do you convert cat years to human years?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The AAFP (American Association of Feline Practitioners) formula: Year 1 = 15 human years, Year 2 = +9 (24 total), Year 3 = +4 (28 total), then +3 human years for every year after that. So a 10-year-old cat is approximately 56 in human years." } },
    { "@@type": "Question", "name": "Is the 7-year rule accurate for cats?",
      "acceptedAnswer": { "@@type": "Answer", "text": "No. Cats age very rapidly in their first two years — reaching the human equivalent of a 24-year-old by their second birthday. After that, aging slows to roughly 3–4 human years per cat year. The 7-year rule significantly underestimates how old cats are in their early years and overestimates it in later years." } },
    { "@@type": "Question", "name": "What are the AAFP cat life stages?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The American Association of Feline Practitioners (AAFP) defines six life stages: Kitten (0–6 months), Junior (7 months–2 years), Prime (3–6 years), Mature (7–10 years), Senior (11–14 years), and Geriatric (15+ years). Each stage has specific healthcare needs and recommended screening tests." } },
    { "@@type": "Question", "name": "How long do indoor cats live compared to outdoor cats?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Indoor cats live an average of 12–18 years, with many reaching their 20s with good care. Outdoor cats live only 5–7 years on average due to exposure to traffic, predators, infectious disease, toxins, and weather. The difference represents roughly double the lifespan for indoor cats." } },
    { "@@type": "Question", "name": "What was the oldest cat ever recorded?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Creme Puff of Austin, Texas holds the Guinness World Record for oldest cat ever, living 38 years and 3 days (1967–2005). Her owner Jake Perry also kept another cat, Granpa, who lived to 34 years. Both cats reportedly ate an unconventional diet including bacon and eggs." } },
    { "@@type": "Question", "name": "At what age is a cat considered senior?",
      "acceptedAnswer": { "@@type": "Answer", "text": "According to the AAFP, cats are classified as Senior from 11–14 years (approximately 60–72 in human years) and Geriatric from 15 years onward (76+ human years). Veterinarians recommend twice-yearly health check-ups from the senior stage, as age-related conditions are much easier to manage when caught early." } },
    { "@@type": "Question", "name": "How much do cats sleep and does it change with age?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Adult cats sleep 12–16 hours per day. Senior and geriatric cats often sleep 18–20 hours. Kittens also sleep extensively — up to 20 hours — as growth hormone is primarily released during sleep. A sudden major increase in sleep can indicate illness, pain, or cognitive decline and warrants a vet visit." } },
    { "@@type": "Question", "name": "What are signs of aging in cats?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Common signs of aging in cats include: coat changes (dullness, reduced grooming, greying), weight loss or muscle wasting, increased vocalization (especially at night), changes in litter box habits, reduced jumping ability due to arthritis, cloudiness in the eyes, increased water consumption (possible kidney disease or diabetes), and changes in personality or cognitive function." } }
  ]
}
</script>
@endsection

@php
$faqs = [
  ['q' => 'How do you convert cat years to human years?',
   'a' => 'The AAFP (American Association of Feline Practitioners) formula: Year 1 = 15 human years, Year 2 = +9 (24 total), Year 3 = +4 (28 total), then +3 human years for every year after that. So a 10-year-old cat is approximately 56 in human years.'],
  ['q' => 'Is the 7-year rule accurate for cats?',
   'a' => 'No. Cats age very rapidly in their first two years — reaching the human equivalent of a 24-year-old by their second birthday. After that, aging slows to roughly 3–4 human years per cat year. The 7-year rule significantly underestimates how old cats are in their early years.'],
  ['q' => 'What are the AAFP cat life stages?',
   'a' => 'The American Association of Feline Practitioners (AAFP) defines six life stages: Kitten (0–6 months), Junior (7 months–2 years), Prime (3–6 years), Mature (7–10 years), Senior (11–14 years), and Geriatric (15+ years). Each stage has specific healthcare needs and recommended screening tests.'],
  ['q' => 'How long do indoor cats live compared to outdoor cats?',
   'a' => 'Indoor cats live an average of 12–18 years, with many reaching their 20s with good care. Outdoor cats live only 5–7 years on average due to exposure to traffic, predators, infectious disease, toxins, and weather. The difference represents roughly double the lifespan for indoor cats.'],
  ['q' => 'What was the oldest cat ever recorded?',
   'a' => 'Creme Puff of Austin, Texas holds the Guinness World Record for oldest cat ever, living 38 years and 3 days (1967–2005). Her owner Jake Perry also kept another cat, Granpa, who lived to 34 years. Both cats reportedly ate an unconventional diet including bacon and eggs.'],
  ['q' => 'At what age is a cat considered senior?',
   'a' => 'According to the AAFP, cats are classified as Senior from 11–14 years (approximately 60–72 in human years) and Geriatric from 15 years onward (76+ human years). Veterinarians recommend twice-yearly health check-ups from the senior stage, as age-related conditions are much easier to manage when caught early.'],
  ['q' => 'How much do cats sleep and does it change with age?',
   'a' => 'Adult cats sleep 12–16 hours per day. Senior and geriatric cats often sleep 18–20 hours. Kittens also sleep extensively — up to 20 hours — as growth hormone is primarily released during sleep. A sudden major increase in sleep can indicate illness, pain, or cognitive decline.'],
  ['q' => 'What are signs of aging in cats?',
   'a' => 'Common signs of aging in cats include: coat changes (dullness, reduced grooming, greying), weight loss or muscle wasting, increased vocalization especially at night, changes in litter box habits, reduced jumping ability due to arthritis, cloudiness in the eyes, increased water consumption (possible kidney disease or diabetes), and personality changes.'],
  ['q' => 'Should I change my cat\'s diet as they age?',
   'a' => 'Yes. Senior cats (11+) often benefit from higher-protein, lower-phosphorus diets to support kidney health. Older cats also produce less salivary amylase, making wet food easier to digest. Portion size may need to decrease as metabolism slows, though some seniors lose weight and need calorie-dense food. Work with your vet to tailor nutrition to your cat\'s individual needs.'],
  ['q' => 'What is feline cognitive dysfunction syndrome?',
   'a' => 'Feline cognitive dysfunction syndrome (FCDS) is the feline equivalent of dementia, estimated to affect 28% of cats aged 11–14 and over 50% of cats aged 15+. Signs include disorientation, aimless wandering, increased vocalization at night, forgetting the litter box location, changes in sleep patterns, and reduced interaction with family members. Environmental enrichment and veterinary support can help manage symptoms.'],
];

$relatedTools = [
  ['icon' => '🐶', 'name' => 'Dog Age Calculator',          'slug' => 'dog-age-calculator',         'desc' => 'Convert your dog\'s age to human years by breed size.'],
  ['icon' => '📅', 'name' => 'Life Percentage Calculator',  'slug' => 'life-percentage-calculator',  'desc' => 'See what percentage of your life you\'ve lived.'],
  ['icon' => '🎂', 'name' => 'Age Calculator',              'slug' => 'age-calculator',              'desc' => 'Exact age in years, months, and days.'],
  ['icon' => '🍼', 'name' => 'Baby Sleep Calculator',       'slug' => 'baby-sleep-calculator',       'desc' => 'Sleep schedules for babies and toddlers by age.'],
];
@endphp

@section('styles')
<style>
.cac-toggle-wrap        { background: #f0f2f5; border-radius: 10px; padding: 4px; display: inline-flex; gap: 4px; }
.cac-toggle-btn         { border: none; background: transparent; border-radius: 8px; padding: 8px 20px; font-weight: 600; font-size: .88rem; color: #555; cursor: pointer; transition: all .15s; }
.cac-toggle-btn.cac-on  { background: #fff; color: var(--pets); box-shadow: 0 2px 6px rgba(0,0,0,.1); }
.cac-result-wrap        { background: linear-gradient(135deg, rgba(90,158,79,.08) 0%, rgba(90,158,79,.03) 100%); border: 1px solid rgba(90,158,79,.25); }
.cac-human-age          { font-size: 4rem; font-weight: 800; color: var(--pets); line-height: 1; }
.cac-human-label        { font-size: .85rem; color: #666; margin-top: 4px; }
.cac-stage-badge        { display: inline-block; border-radius: 50px; padding: 5px 16px; font-size: .82rem; font-weight: 700; }
.cac-stage-kitten       { background: rgba(255,193,7,.15);  color: #856404; }
.cac-stage-junior       { background: rgba(23,162,184,.12); color: #0b7285; }
.cac-stage-prime        { background: rgba(40,167,69,.12);  color: #1a7a32; }
.cac-stage-mature       { background: rgba(108,99,255,.12); color: #5048d6; }
.cac-stage-senior       { background: rgba(253,126,20,.12); color: #a04800; }
.cac-stage-geriatric    { background: rgba(233,69,96,.12);  color: #c23152; }
.cac-fun-fact           { font-size: .88rem; color: #555; line-height: 1.7; }
.cac-life-exp           { font-size: .82rem; }
.cac-table-wrap         { border-radius: 12px; overflow: hidden; }
.cac-tip-icon           { font-size: 1.4rem; flex-shrink: 0; margin-top: 2px; }
.cac-fact-pill          { background: var(--pets); border-radius: 8px; padding: 6px 10px; font-weight: 700; font-size: .82rem; min-width: 70px; text-align: center; flex-shrink: 0; color: #fff; }
</style>
@endsection

@section('content')

<section class="ms-hero">
  <div class="container-xl">
    <div class="row align-items-start g-5">

      <div class="col-lg-7">
        <x-breadcrumb :crumbs="[
          ['url' => route('home'),         'name' => 'Home'],
          ['url' => route('category.pets'),'name' => 'Pet Tools'],
          ['url' => '',                    'name' => 'Cat Age Calculator'],
        ]"/>

        <h1 class="mb-2 ms-hero-title">
          🐱 Cat Age Calculator — Human Years Converter
        </h1>
        <p class="ms-hero-desc">
          Find out how old your cat really is in human years using the AAFP's updated life stage formula — from kitten all the way to geriatric.
        </p>

        <div class="card border-0 mb-n4 ms-tool-card">
          <div class="card-body p-4 p-md-5">

            <div class="mb-4">
              <label for="cacAge" class="form-label fw-600">Cat's age in years</label>
              <input type="number" id="cacAge" class="form-control" placeholder="e.g. 8" min="0" max="30" step="0.5" aria-label="Cat age in years">
              <div class="text-muted-sm mt-1">For kittens under 1 year, enter a decimal — e.g. 0.5 for 6 months.</div>
            </div>

            <div class="mb-4">
              <label class="form-label fw-600 d-block mb-2">Lifestyle</label>
              <div class="cac-toggle-wrap" role="group" aria-label="Cat lifestyle">
                <button type="button" class="cac-toggle-btn cac-on" id="cacIndoorBtn" onclick="cacSetLifestyle('indoor')">🏠 Indoor</button>
                <button type="button" class="cac-toggle-btn" id="cacOutdoorBtn" onclick="cacSetLifestyle('outdoor')">🌿 Outdoor / Mixed</button>
              </div>
              <div class="text-muted-sm mt-2">Affects life expectancy shown in results — not the age conversion formula.</div>
            </div>

            <button class="btn btn-cta w-100" onclick="cacCalculate()">
              Calculate Cat's Human Age →
            </button>

            <div id="cacResult" class="mt-4 d-none">
              <div class="ms-divider"></div>
              <div id="cacResultContent"></div>
            </div>

          </div>
        </div>
      </div>

      <div class="col-lg-5 d-none d-lg-block pt-2">
        <div class="ms-facts-wrap">
          <h3 class="ms-facts-title">Cat Age Facts</h3>
          @foreach([
            ['38 yrs',  'Creme Puff — oldest cat ever recorded (Austin, TX)'],
            ['15 yrs',  'Human equivalent of a cat\'s 1st birthday'],
            ['12–18',   'Average lifespan of an indoor cat (years)'],
            ['5–7',     'Average lifespan of an outdoor cat (years)'],
            ['12–16',   'Hours a day the average cat sleeps'],
          ] as [$stat, $label])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div class="cac-fact-pill">{{ $stat }}</div>
            <div class="ms-fact-label">{{ $label }}</div>
          </div>
          @endforeach
        </div>
      </div>

    </div>
  </div>
</section>

{{-- How the AAFP Formula Works --}}
<section class="ms-section-white">
  <div class="container-xl">
    <div class="row align-items-start g-5">
      <div class="col-lg-6">
        <span class="ms-badge ms-badge-pets mb-3">The Science</span>
        <h2 class="mb-4">How the AAFP Cat Age Formula Works</h2>
<img src="{{ asset('images/cat-age-chart.svg') }}" alt="Cat age chart showing how cat years compare to human years across a cat's lifespan" width="640" height="160" loading="lazy" class="img-fluid rounded-3 mb-4">
        <p>The American Association of Feline Practitioners (AAFP) overhauled cat life stage guidelines after decades of research revealed that feline aging is far more complex than any simple multiplier can capture.</p>
        <p>The key insight is that cats age <strong>non-linearly</strong>. In their first year of life, cats undergo the most dramatic developmental changes of any period — equivalent to a human child going from birth to 15 years old. By the end of year two, they've added another 9 human years, reaching a human-equivalent age of 24.</p>
        <p>From year three onward, the pace slows significantly. Each cat year adds approximately <strong>4 human years</strong> in the Prime stage (years 3–6), then settling to <strong>3 human years per cat year</strong> in the Mature, Senior, and Geriatric stages (years 7+). This non-linear model reflects the biological reality: the most rapid physical and neurological change happens early, while mid-to-late life proceeds more gradually.</p>
        <p>This formula is used by veterinarians to guide health screening recommendations at each life stage. A "Mature" cat aged 7–10 (human equivalent 44–56) benefits from the same kind of preventive health tests a human in their 50s would receive — cholesterol, blood pressure, kidney function, and glucose screening.</p>
      </div>
      <div class="col-lg-6">
        <h3 class="mb-3">Signs of Aging in Cats — by Life Stage</h3>
        <div class="d-flex flex-column gap-3">
          @foreach([
            ['🟢', 'Prime (3–6 years)', 'Generally the healthiest period. Annual vet check-ups are appropriate. Dental disease begins developing silently — professional cleaning may be recommended from age 3.'],
            ['🟡', 'Mature (7–10 years)', 'Subtle signs of aging may appear: slight coat changes, slower recovery from exertion, mild joint stiffness. Bi-annual vet visits are advisable. Bloodwork can detect early kidney disease before symptoms emerge.'],
            ['🟠', 'Senior (11–14 years)', 'Arthritis affects roughly 90% of cats over 12. Weight loss, increased vocalization at night, and litter box changes are common. Hyperthyroidism, kidney disease, and high blood pressure become more prevalent — all manageable with early detection.'],
            ['🔴', 'Geriatric (15+ years)', 'Cognitive dysfunction syndrome affects over 50% of cats at this stage. Extra warmth, easy-access litter trays, soft food, and minimal changes to routine help maintain quality of life. Palliative care discussions with your vet are appropriate.'],
          ] as [$dot, $title, $desc])
          <div class="d-flex gap-3 align-items-start">
            <div class="cac-tip-icon">{{ $dot }}</div>
            <div>
              <div class="fw-600 mb-1 ms-ref-title">{{ $title }}</div>
              <div class="ms-ref-desc">{{ $desc }}</div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Comparison Table --}}
<section class="ms-section-muted">
  <div class="container-xl">
    <div class="text-center mb-5">
      <h2>Cat Years vs Human Years — Full Comparison Table</h2>
      <p class="text-muted ms-intro-text">Using the AAFP formula: Year 1 = 15, Year 2 = +9, Year 3 = +4, Years 4+ = +3 per year.</p>
    </div>
    <div class="cac-table-wrap">
      <table class="table table-bordered table-hover mb-0 bg-white">
        <thead class="ms-table-head">
          <tr>
            <th class="py-3">Cat Age</th>
            <th class="py-3">Human Years</th>
            <th class="py-3">AAFP Life Stage</th>
            <th class="py-3">Vet Schedule</th>
          </tr>
        </thead>
        <tbody class="text-sm">
          @foreach([
            ['6 months', 10,  'Kitten',    'Monthly vet visits, vaccinations'],
            ['1 year',   15,  'Junior',    'Annual check-up'],
            ['2 years',  24,  'Junior',    'Annual check-up'],
            ['3 years',  28,  'Prime',     'Annual check-up + dental'],
            ['4 years',  32,  'Prime',     'Annual check-up'],
            ['5 years',  36,  'Prime',     'Annual check-up'],
            ['6 years',  40,  'Prime',     'Annual check-up + bloodwork'],
            ['7 years',  44,  'Mature',    'Bi-annual check-up'],
            ['8 years',  48,  'Mature',    'Bi-annual + bloodwork'],
            ['9 years',  52,  'Mature',    'Bi-annual + bloodwork'],
            ['10 years', 56,  'Mature',    'Bi-annual + full panel'],
            ['11 years', 60,  'Senior',    'Bi-annual + full panel'],
            ['12 years', 64,  'Senior',    'Bi-annual + full panel'],
            ['13 years', 68,  'Senior',    'Bi-annual + full panel'],
            ['14 years', 72,  'Senior',    'Bi-annual + full panel'],
            ['15 years', 76,  'Geriatric', 'Quarterly check-ups'],
            ['16 years', 80,  'Geriatric', 'Quarterly check-ups'],
            ['18 years', 88,  'Geriatric', 'Quarterly check-ups'],
            ['20 years', 96,  'Geriatric', 'Monthly monitoring'],
          ] as [$cat, $human, $stage, $vet])
          <tr>
            <td class="fw-600">{{ $cat }}</td>
            <td>{{ $human }}</td>
            <td><span class="badge bg-secondary">{{ $stage }}</span></td>
            <td class="text-sm text-muted">{{ $vet }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <p class="ms-source">Source: AAFP Feline Life Stage Guidelines (updated). Vet schedule recommendations are general guidelines — follow your vet's specific advice.</p>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="pageFaq" />

<section class="ms-section-accent">
  <div class="container ms-longtail">
    <h2 class="mb-4 text-brand">How to Care for Your Cat at Every Life Stage</h2>
    <p>Knowing your cat's true age in human years helps you understand what kind of care they need right now — not generic advice, but stage-specific guidance that matches where your cat is in their life journey.</p>

    <h3 class="mt-5 mb-3 ms-seo-h3">Kitten (0–6 months) — Rapid Development</h3>
    <p>The kitten phase is the most intensive period of development. Kittens need frequent small meals (3–4 times daily) of high-calorie kitten food to fuel their rapid growth. The critical socialisation window is 2–7 weeks — exposure to people, sounds, and other pets during this period shapes their adult temperament permanently. Vaccinations, parasite prevention, and spay/neuter discussions are all key milestones before 6 months.</p>

    <h3 class="mt-4 mb-3 ms-seo-h3">Junior &amp; Prime (1–6 years) — Peak Condition</h3>
    <p>These are generally the easiest years healthwise. Maintain your cat at a healthy weight — obesity affects roughly 60% of domestic cats and significantly shortens lifespan. Provide environmental enrichment: puzzle feeders, climbing structures, and regular interactive play stimulate natural hunting behaviour and prevent stress-related behavioural problems. Annual dental check-ups are important from age 3; dental disease is the most common feline health issue and is linked to heart and kidney damage.</p>

    <h3 class="mt-4 mb-3 ms-seo-h3">Mature (7–10 years) — Proactive Monitoring</h3>
    <p>The mature stage is when proactive veterinary care pays its biggest dividends. Chronic kidney disease (CKD) affects 31% of cats over 12, but damage begins accumulating silently years earlier. Annual bloodwork from age 7 can catch early kidney changes when dietary intervention can meaningfully slow progression. Hyperthyroidism, diabetes, and hypertension are also increasingly common in mature cats — all diagnosed with routine screening.</p>

    <h3 class="mt-4 mb-3 ms-seo-h3">Senior &amp; Geriatric (11+ years) — Comfort and Quality of Life</h3>
    <p>Senior cats benefit enormously from small environmental modifications: low-sided litter trays (arthritis makes high sides painful), warm resting spots (older cats thermoregulate poorly), and food placed at a comfortable height. Wet food is preferable as cats' thirst drive decreases with age, making hydration critical for kidney health. Cognitive dysfunction syndrome is common — predictable routine, gentle interaction, and veterinary-prescribed supplements or medications can help maintain mental clarity.</p>

    <h2 class="mt-5 mb-4 text-brand">Why Indoor Cats Live So Much Longer</h2>
    <p>The lifespan difference between indoor and outdoor cats is dramatic — roughly 12–18 years versus 5–7 years. The risks outdoor cats face include road traffic accidents (the leading cause of outdoor cat death), attacks from dogs and other wildlife, infectious diseases like FIV and FeLV spread through cat-to-cat contact, ingestion of rodenticide and other toxins, and exposure to extreme weather. Keeping cats indoors — with adequate enrichment, climbing space, and interactive play to compensate for the reduced stimulation — is one of the most impactful decisions a cat owner can make for longevity.</p>
  </div>
</section>

<x-related-tools :tools="$relatedTools" heading="More Tools You Might Like" />

@endsection

@section('scripts')
<script>
(function () {
  var lifestyle = 'indoor';

  var stages = [
    { maxYr: 0.5,  label: 'Kitten',    cls: 'cac-stage-kitten',    fun: 'Your cat is in the kitten stage — the fastest period of development in their entire life. Every day brings new discoveries, skills, and personality traits.' },
    { maxYr: 2,    label: 'Junior',    cls: 'cac-stage-junior',    fun: 'Your cat is a junior — the equivalent of a teenager to young adult. Full of energy and curiosity, still finding their personality and place in the world.' },
    { maxYr: 6,    label: 'Prime',     cls: 'cac-stage-prime',     fun: 'Your cat is in their Prime — confident, playful, and at peak physical condition. Think of them as being in their 30s or early 40s in human terms.' },
    { maxYr: 10,   label: 'Mature',    cls: 'cac-stage-mature',    fun: 'Your cat has reached the Mature stage — settled, wise, and comfortable in their routine. Like a human in their late 40s to 50s, regular health monitoring pays dividends now.' },
    { maxYr: 14,   label: 'Senior',    cls: 'cac-stage-senior',    fun: 'Your cat is a Senior — experienced, dignified, and deserving of extra care and comfort. Bi-annual vet visits and joint-friendly environments make a big difference.' },
    { maxYr: 99,   label: 'Geriatric', cls: 'cac-stage-geriatric', fun: 'Your cat has reached geriatric age — a remarkable achievement. Focus on warmth, comfort, easy food access, and close veterinary partnership to maximise quality of life.' },
  ];

  var lifeExpData = {
    indoor:  { text: 'Indoor cats typically live <strong>12–18 years</strong>. With attentive care many reach their early 20s.', cls: 'ms-note-green' },
    outdoor: { text: 'Outdoor/mixed-lifestyle cats typically live <strong>5–7 years</strong> due to higher exposure to hazards.', cls: 'ms-note-orange' },
  };

  function calcHumanAge(catYrs) {
    if (catYrs <= 0) return 0;
    if (catYrs <= 1) return Math.round(15 * catYrs);
    if (catYrs <= 2) return Math.round(15 + (catYrs - 1) * 9);
    if (catYrs <= 3) return Math.round(24 + (catYrs - 2) * 4);
    return Math.round(28 + (catYrs - 3) * 3);
  }

  function getStage(catYrs) {
    for (var i = 0; i < stages.length; i++) {
      if (catYrs <= stages[i].maxYr) return stages[i];
    }
    return stages[stages.length - 1];
  }

  window.cacSetLifestyle = function (mode) {
    lifestyle = mode;
    document.getElementById('cacIndoorBtn').classList.toggle('cac-on', mode === 'indoor');
    document.getElementById('cacOutdoorBtn').classList.toggle('cac-on', mode === 'outdoor');
  };

  window.cacCalculate = function () {
    var ageVal = parseFloat(document.getElementById('cacAge').value);

    if (isNaN(ageVal) || ageVal < 0) {
      document.getElementById('cacAge').focus();
      return;
    }
    if (ageVal > 30) ageVal = 30;

    var humanAge = calcHumanAge(ageVal);
    var stage    = getStage(ageVal);
    var exp      = lifeExpData[lifestyle];

    var html = '<div class="cac-result-wrap rounded-3 p-4 text-center">'
      + '<div class="cac-human-age">' + humanAge + '</div>'
      + '<div class="cac-human-label mb-3">human years equivalent</div>'
      + '<div class="mb-2"><span class="cac-stage-badge ' + stage.cls + '">' + stage.label + '</span></div>'
      + '<div class="mb-1 text-muted-sm">AAFP Life Stage</div>'
      + '<p class="cac-fun-fact mb-3">' + stage.fun + '</p>'
      + '<div class="ms-note ' + exp.cls + ' cac-life-exp text-start">'
      + '<strong>Life expectancy (' + (lifestyle === 'indoor' ? 'indoor' : 'outdoor/mixed') + '):</strong> ' + exp.text
      + '</div>'
      + '</div>';

    document.getElementById('cacResultContent').innerHTML = html;
    document.getElementById('cacResult').classList.remove('d-none');
    document.getElementById('cacResult').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  };
})();
</script>
@endsection
