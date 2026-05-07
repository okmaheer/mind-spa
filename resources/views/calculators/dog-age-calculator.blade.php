@extends('layouts.app')

@section('title', 'Dog Age Calculator — Human Years by Breed Size | MindSnap')
@section('description', 'Convert your dog\'s age to human years instantly. Free calculator adjusts for breed size — small, medium, and large dogs age at very different rates.')
@section('canonical', config('app.url') . '/dog-age-calculator')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "WebApplication",
  "name": "Dog Age Calculator",
  "url": "{{ config('app.url') }}/dog-age-calculator",
  "description": "Convert your dog's age to human years, adjusted for breed size. Science-based formula for small, medium, and large dogs.",
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
    { "@@type": "ListItem", "position": 3, "name": "Dog Age Calculator" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [
    { "@@type": "Question", "name": "How do you convert dog years to human years?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The old '1 dog year = 7 human years' rule is a myth. The science-based method: year 1 equals 15 human years, year 2 adds 9 more (24 total), then each additional year adds 4–7 human years depending on breed size. Large dogs age faster than small dogs after the first two years." } },
    { "@@type": "Question", "name": "Why do large dogs age faster than small dogs?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Larger dogs experience accelerated cellular aging — their hearts work harder relative to body mass, they accumulate age-related tissue damage faster, and research suggests larger body size correlates with shorter telomere length and higher rates of age-related disease. A Great Dane at 7 is geriatric; a Chihuahua at 7 is middle-aged." } },
    { "@@type": "Question", "name": "Is the 7-year rule for dogs accurate?",
      "acceptedAnswer": { "@@type": "Answer", "text": "No. The 7-year rule is a rough average that ignores breed size and the non-linear nature of dog aging. Dogs develop extremely rapidly in year 1 (equivalent to ~15 human years) and year 2 (another ~9), then slow down. A 2-year-old dog has already lived through the human equivalent of adolescence and early adulthood." } },
    { "@@type": "Question", "name": "What life stage is my dog in?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Dog life stages by age: Puppy (0–1 year), Junior (1–3 years), Adult (3–7 years), Mature (7–10 years), Senior (10–12 years), Geriatric (12+ years). Large breeds enter mature and senior stages earlier than small breeds, which is why regular veterinary check-ups become more frequent after age 5–7 for larger dogs." } },
    { "@@type": "Question", "name": "How long do dogs live on average?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Average dog life expectancy varies significantly by size: small dogs (under 20 lbs) typically live 14–16 years, medium dogs (20–50 lbs) live 12–14 years, and large dogs (over 50 lbs) live 8–12 years. Individual factors like genetics, diet, exercise, and veterinary care have a major impact on longevity." } },
    { "@@type": "Question", "name": "What was the oldest dog ever recorded?",
      "acceptedAnswer": { "@@type": "Answer", "text": "As of 2023, Bobi — a Portuguese Rafeiro do Alentejo — was officially recognised as the world's oldest living dog at 31 years and 165 days. He surpassed the previous record holder, Bluey, an Australian cattle dog who lived to 29 years and 5 months." } },
    { "@@type": "Question", "name": "At what age is a dog considered a senior?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Veterinarians generally classify dogs as senior at 7–10 years depending on size. Large and giant breeds are considered senior from around 7 years, medium breeds from around 8–9, and small breeds from 10–12. Senior dogs benefit from more frequent vet visits, age-appropriate nutrition, and joint support." } },
    { "@@type": "Question", "name": "Do mixed-breed dogs live longer than purebreds?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Generally yes — a phenomenon called 'hybrid vigour' or heterosis. Mixed-breed dogs have greater genetic diversity, which reduces the risk of inheriting the breed-specific genetic diseases that affect many purebred dogs. Studies show mixed-breed dogs live on average 1–1.5 years longer than size-matched purebreds." } }
  ]
}
</script>
@endsection

@php
$faqs = [
  ['q' => 'How do you convert dog years to human years?',
   'a' => 'The old "1 dog year = 7 human years" rule is a myth. The science-based method: year 1 equals 15 human years, year 2 adds 9 more (24 total), then each additional year adds 4–7 human years depending on breed size. Large dogs age faster than small dogs after the first two years.'],
  ['q' => 'Why do large dogs age faster than small dogs?',
   'a' => 'Larger dogs experience accelerated cellular aging — their hearts work harder relative to body mass, they accumulate age-related tissue damage faster, and research suggests larger body size correlates with shorter telomere length and higher rates of age-related disease. A Great Dane at 7 is geriatric; a Chihuahua at 7 is middle-aged.'],
  ['q' => 'Is the 7-year rule for dogs accurate?',
   'a' => 'No. The 7-year rule is a rough average that ignores breed size and the non-linear nature of dog aging. Dogs develop extremely rapidly in year 1 (equivalent to ~15 human years) and year 2 (another ~9), then slow down. A 2-year-old dog has already lived through the human equivalent of adolescence and early adulthood.'],
  ['q' => 'What life stage is my dog in?',
   'a' => 'Dog life stages by age: Puppy (0–1 year), Junior (1–3 years), Adult (3–7 years), Mature (7–10 years), Senior (10–12 years), Geriatric (12+ years). Large breeds enter mature and senior stages earlier than small breeds, which is why regular vet visits become more frequent after age 5–7 for large dogs.'],
  ['q' => 'How long do dogs live on average?',
   'a' => 'Average dog life expectancy varies significantly by size: small dogs (under 20 lbs) typically live 14–16 years, medium dogs (20–50 lbs) live 12–14 years, and large dogs (over 50 lbs) live 8–12 years. Individual factors like genetics, diet, exercise, and veterinary care have a major impact on longevity.'],
  ['q' => 'What was the oldest dog ever recorded?',
   'a' => 'As of 2023, Bobi — a Portuguese Rafeiro do Alentejo — was officially recognised as the world\'s oldest living dog at 31 years and 165 days. He surpassed the previous record holder, Bluey, an Australian cattle dog who lived to 29 years and 5 months.'],
  ['q' => 'At what age is a dog considered a senior?',
   'a' => 'Veterinarians generally classify dogs as senior at 7–10 years depending on size. Large and giant breeds are considered senior from around 7 years, medium breeds from around 8–9, and small breeds from 10–12. Senior dogs benefit from more frequent vet visits, age-appropriate nutrition, and joint support.'],
  ['q' => 'Do mixed-breed dogs live longer than purebreds?',
   'a' => 'Generally yes — a phenomenon called "hybrid vigour" or heterosis. Mixed-breed dogs have greater genetic diversity, which reduces the risk of inheriting breed-specific genetic diseases. Studies show mixed-breed dogs live on average 1–1.5 years longer than size-matched purebreds.'],
  ['q' => 'How can I help my dog live longer?',
   'a' => 'Key factors for canine longevity include maintaining a healthy weight (obesity shortens dog life by up to 2 years), regular exercise appropriate for age and breed, annual or bi-annual vet check-ups, dental care (dental disease is linked to heart and kidney disease), a nutritionally balanced diet, and minimising chronic stress.'],
  ['q' => 'Does spaying or neutering affect a dog\'s lifespan?',
   'a' => 'The evidence is mixed. Spayed and neutered dogs historically showed longer lifespans due to elimination of reproductive cancers. However, more recent studies suggest timing matters — early neutering in large breeds may increase risk of certain joint disorders and some cancers. Discuss the optimal timing with your vet based on your dog\'s breed and size.'],
];

$relatedTools = [
  ['icon' => '🐱', 'name' => 'Cat Age Calculator',         'slug' => 'cat-age-calculator',         'desc' => 'Convert your cat\'s age to human years using the AAFP formula.'],
  ['icon' => '📅', 'name' => 'Life Percentage Calculator', 'slug' => 'life-percentage-calculator',  'desc' => 'See what percentage of your life you\'ve lived.'],
  ['icon' => '🎂', 'name' => 'Age Calculator',             'slug' => 'age-calculator',              'desc' => 'Exact age in years, months, and days.'],
  ['icon' => '⚖️', 'name' => 'BMI Calculator',            'slug' => 'bmi-calculator',              'desc' => 'Check your Body Mass Index instantly.'],
];
@endphp

@section('styles')
<style>
.dac-size-btn           { border: 2px solid #e0e0e0; cursor: pointer; background: #fff; transition: all .15s; }
.dac-size-btn.dac-active{ border-color: var(--pets); background: rgba(90,158,79,.06); }
.dac-size-radio         { margin-top: 3px; accent-color: var(--pets); }
.dac-size-name          { font-weight: 700; font-size: .9rem; color: var(--primary-dark); }
.dac-size-sub           { font-size: .8rem; color: #888; margin-top: 2px; }
.dac-result-wrap        { background: linear-gradient(135deg, rgba(90,158,79,.08) 0%, rgba(90,158,79,.03) 100%); border: 1px solid rgba(90,158,79,.25); }
.dac-human-age          { font-size: 4rem; font-weight: 800; color: var(--pets); line-height: 1; }
.dac-human-label        { font-size: .85rem; color: #666; margin-top: 4px; }
.dac-stage-badge        { display: inline-block; border-radius: 50px; padding: 5px 16px; font-size: .82rem; font-weight: 700; }
.dac-stage-puppy        { background: rgba(255,193,7,.15);  color: #856404; }
.dac-stage-junior       { background: rgba(23,162,184,.12); color: #0b7285; }
.dac-stage-adult        { background: rgba(40,167,69,.12);  color: #1a7a32; }
.dac-stage-mature       { background: rgba(108,99,255,.12); color: #5048d6; }
.dac-stage-senior       { background: rgba(253,126,20,.12); color: #a04800; }
.dac-stage-geriatric    { background: rgba(233,69,96,.12);  color: #c23152; }
.dac-fun-fact           { font-size: .88rem; color: #555; line-height: 1.7; }
.dac-life-exp           { font-size: .82rem; color: #777; }
.dac-table-wrap         { border-radius: 12px; overflow: hidden; }
.dac-tip-icon           { font-size: 1.4rem; flex-shrink: 0; margin-top: 2px; }
.dac-fact-pill          { background: var(--pets); border-radius: 8px; padding: 6px 10px; font-weight: 700; font-size: .82rem; min-width: 70px; text-align: center; flex-shrink: 0; color: #fff; }
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
          ['url' => '',                    'name' => 'Dog Age Calculator'],
        ]"/>

        <h1 class="mb-2 ms-hero-title">
          🐶 Dog Age Calculator — Human Years by Breed Size
        </h1>
        <p class="ms-hero-desc">
          Find out how old your dog really is in human years. Our formula adjusts for breed size — because a 10-year-old Chihuahua and a 10-year-old Great Dane are very different ages.
        </p>

        <div class="card border-0 mb-n4 ms-tool-card">
          <div class="card-body p-4 p-md-5">

            <div class="mb-4">
              <label for="dacAge" class="form-label fw-600">Dog's age in years</label>
              <input type="number" id="dacAge" class="form-control" placeholder="e.g. 5" min="0" max="30" step="0.5" aria-label="Dog age in years">
            </div>

            <div class="mb-4">
              <label class="form-label fw-600 d-block mb-2">Breed size</label>
              <div class="d-flex flex-column gap-2" id="dacSizeGroup">
                @foreach([
                  ['small',  '🐩 Small (under 20 lbs)',    'Chihuahua, Pomeranian, Maltese, Shih Tzu — live 14–16 years on average.', '+4 yrs/yr after age 2'],
                  ['medium', '🐕 Medium (20–50 lbs)',       'Beagle, Cocker Spaniel, Border Collie — live 12–14 years on average.',     '+5 yrs/yr after age 2'],
                  ['large',  '🦮 Large (over 50 lbs)',      'Labrador, German Shepherd, Golden Retriever, Great Dane — live 8–12 yrs.', '+7 yrs/yr after age 2'],
                ] as [$val, $label, $desc, $note])
                <label class="dac-size-btn d-flex align-items-start gap-3 p-3 rounded-3" data-val="{{ $val }}">
                  <input type="radio" name="dacSize" value="{{ $val }}" {{ $val === 'medium' ? 'checked' : '' }}
                         class="dac-size-radio" onchange="dacToggleSize()">
                  <div>
                    <div class="dac-size-name">{{ $label }}</div>
                    <div class="dac-size-sub">{{ $desc }}</div>
                  </div>
                </label>
                @endforeach
              </div>
            </div>

            <button class="btn btn-cta w-100" onclick="dacCalculate()">
              Calculate Dog's Human Age →
            </button>

            <div id="dacResult" class="mt-4 d-none">
              <div class="ms-divider"></div>
              <div id="dacResultContent"></div>
            </div>

          </div>
        </div>
      </div>

      <div class="col-lg-5 d-none d-lg-block pt-2">
        <div class="ms-facts-wrap">
          <h3 class="ms-facts-title">Dog Age Facts</h3>
          @foreach([
            ['31 yrs',  'Bobi — world\'s oldest recorded dog (2023)'],
            ['15 yrs',  'Human equivalent of a dog\'s 1st birthday'],
            ['14–16',   'Average lifespan for small dog breeds (yrs)'],
            ['8–12',    'Average lifespan for large dog breeds (yrs)'],
            ['84%',     'DNA shared between dogs and humans'],
          ] as [$stat, $label])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div class="dac-fact-pill">{{ $stat }}</div>
            <div class="ms-fact-label">{{ $label }}</div>
          </div>
          @endforeach
        </div>
      </div>

    </div>
  </div>
</section>

{{-- Why Don't All Dogs Age the Same? --}}
<section class="ms-section-white">
  <div class="container-xl">
    <div class="row align-items-start g-5">
      <div class="col-lg-6">
        <span class="ms-badge ms-badge-pets mb-3">The Science</span>
        <h2 class="mb-4">Why Don't All Dogs Age the Same?</h2>
        <p>The familiar "multiply by 7" shortcut has been repeated for decades, but it was never based on biology — it was a rough marketing device. Modern veterinary science paints a far more nuanced picture.</p>
        <p>Dogs age non-linearly and at radically different rates depending on body size. In the first two years of life, all dogs — regardless of breed — go through an intense developmental sprint. By the end of year one, a puppy has matured through the human equivalent of childhood, puberty, and adolescence all at once, reaching a human-equivalent age of roughly 15. By year two, they've added another 9 human years, reaching the equivalent of a 24-year-old adult.</p>
        <p>After year two, breed size becomes the dominant factor. A small dog (under 20 lbs) adds roughly <strong>4 human years per dog year</strong>. A medium dog adds <strong>5 human years per year</strong>. A large dog adds <strong>7 human years per year</strong> — meaning a 10-year-old Great Dane is already in geriatric territory, while a 10-year-old Chihuahua is still in its senior but active years.</p>
        <p>The underlying cause is accelerated cellular aging in larger bodies. Research published in <em>The American Naturalist</em> found that each additional 4.4 lbs of body weight in dogs reduces life expectancy by approximately one month — a consistent, size-dependent gradient not seen in most other species.</p>
      </div>
      <div class="col-lg-6">
        <h3 class="mb-3">Signs Your Dog Is Aging</h3>
        <div class="d-flex flex-column gap-3">
          @foreach([
            ['🦳', 'Grey muzzle and coat', 'Greying typically starts around the muzzle and eyebrows, often from age 5–7 in larger breeds and 8–10 in smaller breeds. Early greying can also indicate anxiety or stress.'],
            ['💤', 'Increased sleep', 'Senior dogs sleep 14–18 hours per day compared to the 12–14 of adults. A sudden major increase in sleep can signal pain, hypothyroidism, or cognitive decline — worth mentioning at the next vet visit.'],
            ['🐾', 'Stiffness and slower movement', 'Arthritis affects an estimated 80% of dogs over 8 years old. You may notice difficulty rising, reluctance to use stairs, or a change in gait. Many dogs hide pain effectively — stiffness after rest is a key early sign.'],
            ['👁️', 'Cloudy eyes', 'Nuclear sclerosis — a normal age-related change — creates a bluish-grey haze over the lens. This differs from cataracts, which are white and opaque. Both can cause reduced vision, particularly in low light.'],
            ['🧠', 'Canine cognitive dysfunction', 'Similar to dementia in humans, CCD affects an estimated 28% of dogs aged 11–12 and 68% of dogs aged 15–16. Signs include disorientation, disrupted sleep, house-training accidents, and changes in social behaviour.'],
          ] as [$icon, $title, $desc])
          <div class="d-flex gap-3 align-items-start">
            <div class="dac-tip-icon">{{ $icon }}</div>
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
      <h2>Dog Years vs Human Years — Full Comparison Table</h2>
      <p class="text-muted ms-intro-text">Based on the science-based formula: Year 1 = 15, Year 2 = +9, then +4/+5/+7 per year by size.</p>
    </div>
    <div class="dac-table-wrap">
      <table class="table table-bordered table-hover mb-0 bg-white">
        <thead class="ms-table-head">
          <tr>
            <th class="py-3">Dog Age</th>
            <th class="py-3">Small (&lt;20 lbs)</th>
            <th class="py-3">Medium (20–50 lbs)</th>
            <th class="py-3">Large (&gt;50 lbs)</th>
            <th class="py-3">Life Stage</th>
          </tr>
        </thead>
        <tbody class="text-sm">
          @foreach([
            [1,  15,  15,  15,  'Puppy'],
            [2,  24,  24,  24,  'Junior'],
            [3,  28,  29,  31,  'Junior'],
            [4,  32,  34,  38,  'Adult'],
            [5,  36,  39,  45,  'Adult'],
            [6,  40,  44,  52,  'Adult'],
            [7,  44,  49,  59,  'Mature'],
            [8,  48,  54,  66,  'Mature'],
            [9,  52,  59,  73,  'Mature'],
            [10, 56,  64,  80,  'Senior'],
            [11, 60,  69,  87,  'Senior'],
            [12, 64,  74,  94,  'Senior'],
            [13, 68,  79, 101,  'Geriatric'],
            [14, 72,  84, 108,  'Geriatric'],
            [15, 76,  89, 115,  'Geriatric'],
          ] as [$dog, $sm, $md, $lg, $stage])
          <tr>
            <td class="fw-600">{{ $dog }} {{ $dog === 1 ? 'year' : 'years' }}</td>
            <td>{{ $sm }}</td>
            <td>{{ $md }}</td>
            <td>{{ $lg }}</td>
            <td><span class="badge bg-secondary">{{ $stage }}</span></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <p class="ms-source">Formula: Year 1 = 15 human yrs; Year 2 = +9; Small +4/yr, Medium +5/yr, Large +7/yr thereafter.</p>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="pageFaq" />

<section class="ms-section-accent">
  <div class="container ms-longtail">
    <h2 class="mb-4 text-brand">How to Keep Your Dog Healthy at Every Life Stage</h2>
    <p>Understanding your dog's true age in human years isn't just a curiosity — it's a practical tool for better care. A dog at the human equivalent of 50 has very different nutritional, exercise, and medical needs than one at the human equivalent of 25.</p>

    <h3 class="mt-5 mb-3 ms-seo-h3">Puppy &amp; Junior (0–3 dog years)</h3>
    <p>The first three years are a period of explosive development. Puppies require calorie-dense food formulated for growth, a full vaccination schedule, early socialisation with people and other dogs, and positive reinforcement training. The first 12–16 weeks are the critical socialisation window — experiences during this time shape behaviour for life. Large-breed puppies should not be over-exercised before growth plates close (typically 12–18 months) to avoid joint damage.</p>

    <h3 class="mt-4 mb-3 ms-seo-h3">Adult (3–7 dog years)</h3>
    <p>Adult dogs need consistent exercise — most medium and large breeds require 45–90 minutes of activity per day. Annual vet check-ups are appropriate at this stage. Dental disease affects 80% of dogs by age 3, so daily teeth brushing or dental chews are important. Maintain a lean body condition — every pound of excess weight on a small dog is proportionally equivalent to 10+ lbs on a human.</p>

    <h3 class="mt-4 mb-3 ms-seo-h3">Mature &amp; Senior (7–12 dog years)</h3>
    <p>From the mature stage onward, bi-annual vet visits are recommended for large breeds. Blood and urine panels can detect kidney disease, hypothyroidism, and diabetes before symptoms appear. Switch to a senior-formulated food appropriate to your dog's size. Low-impact exercise like swimming and short, frequent walks is better than long runs that stress ageing joints.</p>

    <h3 class="mt-4 mb-3 ms-seo-h3">Geriatric (12+ dog years)</h3>
    <p>Geriatric dogs may need prescription diets for kidney or heart support, pain management for arthritis, and environmental modifications such as ramps and orthopedic beds. Cognitive dysfunction syndrome is common — mental stimulation through sniff work, puzzle feeders, and gentle training sessions can slow decline. Quality of life discussions with your vet are appropriate at this stage.</p>
  </div>
</section>

<x-related-tools :tools="$relatedTools" heading="More Tools You Might Like" />

@endsection

@section('scripts')
<script>
(function () {
  var stages = [
    { maxDogYr: 1,  label: 'Puppy',     cls: 'dac-stage-puppy',    fun: 'Your dog is in the puppy stage — the equivalent of a child still in school. Boundless energy, rapid learning, and a world full of new things to explore.' },
    { maxDogYr: 3,  label: 'Junior',    cls: 'dac-stage-junior',   fun: 'Your dog is a junior — think teenager to young adult in human terms. Full of energy and confidence, still testing boundaries, but maturing fast.' },
    { maxDogYr: 7,  label: 'Adult',     cls: 'dac-stage-adult',    fun: 'Your dog is in their prime adult years — confident, settled, and at peak physical condition. The equivalent of a human in their 30s or 40s.' },
    { maxDogYr: 10, label: 'Mature',    cls: 'dac-stage-mature',   fun: 'Your dog has reached the mature stage — the canine equivalent of middle age. Still active and engaged, but benefiting from regular health monitoring.' },
    { maxDogYr: 12, label: 'Senior',    cls: 'dac-stage-senior',   fun: 'Your dog is a senior — wise, loyal, and deserving of extra comfort and care. Bi-annual vet visits and joint-friendly exercise keep seniors thriving.' },
    { maxDogYr: 99, label: 'Geriatric', cls: 'dac-stage-geriatric', fun: 'Your dog has reached geriatric age — every day is a gift. Focus on comfort, quality time, and working closely with your vet to manage any health conditions.' },
  ];

  var lifeExp = {
    small:  'Small dogs typically live <strong>14–16 years</strong>. Your dog still has wonderful years ahead.',
    medium: 'Medium dogs typically live <strong>12–14 years</strong>. Great care now extends healthy years.',
    large:  'Large dogs typically live <strong>8–12 years</strong>. Regular vet check-ups are especially important for larger breeds.',
  };

  function calcHumanAge(dogYrs, size) {
    if (dogYrs <= 0) return 0;
    if (dogYrs <= 1) return Math.round(15 * dogYrs);
    if (dogYrs <= 2) return Math.round(15 + (dogYrs - 1) * 9);
    var perYear = size === 'small' ? 4 : size === 'medium' ? 5 : 7;
    return Math.round(24 + (dogYrs - 2) * perYear);
  }

  function getStage(dogYrs) {
    for (var i = 0; i < stages.length; i++) {
      if (dogYrs <= stages[i].maxDogYr) return stages[i];
    }
    return stages[stages.length - 1];
  }

  window.dacToggleSize = function () {
    var val = document.querySelector('input[name="dacSize"]:checked').value;
    document.querySelectorAll('.dac-size-btn').forEach(function (b) {
      b.classList.toggle('dac-active', b.dataset.val === val);
    });
  };

  window.dacCalculate = function () {
    var ageVal = parseFloat(document.getElementById('dacAge').value);
    var size   = document.querySelector('input[name="dacSize"]:checked').value;

    if (isNaN(ageVal) || ageVal < 0) {
      document.getElementById('dacAge').focus();
      return;
    }
    if (ageVal > 30) ageVal = 30;

    var humanAge = calcHumanAge(ageVal, size);
    var stage    = getStage(ageVal);
    var exp      = lifeExp[size];

    var html = '<div class="dac-result-wrap rounded-3 p-4 text-center">'
      + '<div class="dac-human-age">' + humanAge + '</div>'
      + '<div class="dac-human-label mb-3">human years equivalent</div>'
      + '<div class="mb-3"><span class="dac-stage-badge ' + stage.cls + '">' + stage.label + '</span></div>'
      + '<p class="dac-fun-fact mb-3">' + stage.fun + '</p>'
      + '<div class="ms-note ms-note-green dac-life-exp text-start">'
      + '<strong>Life expectancy:</strong> ' + exp
      + '</div>'
      + '</div>';

    document.getElementById('dacResultContent').innerHTML = html;
    document.getElementById('dacResult').classList.remove('d-none');
    document.getElementById('dacResult').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  };

  // init highlight
  dacToggleSize();
})();
</script>
@endsection
