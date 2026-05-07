@extends('layouts.app')

@section('title', 'Free Pet Age Calculators — Dog & Cat Age in Human Years | MindSnap')
@section('description', 'Free pet age calculators — convert dog or cat age to human years instantly. Dog calculator adjusts for breed size. Cat calculator uses AAFP life stages.')
@section('canonical', config('app.url') . '/pet-tools')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@graph": [
    {
      "@@type": "CollectionPage",
      "@@id": "{{ config('app.url') }}/pet-tools#collection",
      "url": "{{ config('app.url') }}/pet-tools",
      "name": "Free Pet Age Calculators",
      "description": "Free pet age calculators — convert dog or cat age to human years instantly. Dog calculator adjusts for breed size. Cat calculator uses AAFP life stages.",
      "inLanguage": "en",
      "publisher": { "@@type": "Organization", "name": "MindSnap", "url": "{{ config('app.url') }}" },
      "hasPart": [
        { "@@type": "WebApplication", "name": "Dog Age Calculator", "url": "{{ config('app.url') }}/dog-age-calculator", "applicationCategory": "UtilityApplication" },
        { "@@type": "WebApplication", "name": "Cat Age Calculator", "url": "{{ config('app.url') }}/cat-age-calculator", "applicationCategory": "UtilityApplication" }
      ]
    },
    {
      "@@type": "BreadcrumbList",
      "itemListElement": [
        { "@@type": "ListItem", "position": 1, "name": "Home",      "item": "{{ config('app.url') }}" },
        { "@@type": "ListItem", "position": 2, "name": "Pet Tools", "item": "{{ config('app.url') }}/pet-tools" }
      ]
    },
    {
      "@@type": "FAQPage",
      "mainEntity": [
        { "@@type": "Question", "name": "How do you calculate a dog's age in human years?",     "acceptedAnswer": { "@@type": "Answer", "text": "The old '1 dog year = 7 human years' rule is inaccurate. Dogs age faster in early life and more slowly later, and larger breeds age faster than small breeds. A more accurate method adjusts for breed size and uses a non-linear scale based on life expectancy data." } },
        { "@@type": "Question", "name": "How old is a 1-year-old dog in human years?",         "acceptedAnswer": { "@@type": "Answer", "text": "A 1-year-old dog is roughly equivalent to a 15-year-old human for small breeds, 15 years for medium breeds, and 15 years for large breeds. By age 2, the human-year equivalent diverges significantly by breed size." } },
        { "@@type": "Question", "name": "How do you calculate a cat's age in human years?",     "acceptedAnswer": { "@@type": "Answer", "text": "The American Association of Feline Practitioners (AAFP) framework assigns life stages to cats: kitten (0–6 months), junior (7 months–2 years), prime (3–6 years), mature (7–10 years), senior (11–14 years), and super-senior (15+ years). These stages roughly correspond to equivalent human life periods." } },
        { "@@type": "Question", "name": "Is a 10-year-old cat old?",                            "acceptedAnswer": { "@@type": "Answer", "text": "Yes — a 10-year-old cat is considered 'mature' by AAFP standards, roughly equivalent to a human in their mid-50s. They may begin showing age-related health changes and benefit from more frequent veterinary check-ups." } },
        { "@@type": "Question", "name": "Do large dogs age faster than small dogs?",            "acceptedAnswer": { "@@type": "Answer", "text": "Yes. Large and giant breeds (e.g. Great Danes) have shorter lifespans — typically 8–10 years — compared to small breeds (e.g. Chihuahuas) that can live 15+ years. This means a 5-year-old Great Dane is proportionally older in human-equivalent terms than a 5-year-old Chihuahua." } },
        { "@@type": "Question", "name": "How accurate is the 7-to-1 dog age rule?",            "acceptedAnswer": { "@@type": "Answer", "text": "The 7-to-1 rule is a rough average and is widely considered an oversimplification. Dogs mature rapidly in their first two years (a 2-year-old dog is more like a 24-year-old human, not a 14-year-old), and then age more slowly. A 2019 study using DNA methylation data proposed a logarithmic formula as more accurate." } }
      ]
    }
  ]
}
</script>
@endsection

@php
$cat  = config('mindsnap.categories')['pets'];
$faqs = [
  ['q' => 'How do you calculate a dog\'s age in human years?',
   'a' => 'The popular <strong>"1 dog year = 7 human years"</strong> rule is a crude average that ignores two important factors: dogs age very rapidly in their first two years, and larger breeds age faster than smaller ones. Accurate calculators use breed-size-specific non-linear scales based on veterinary life expectancy data. A small dog\'s age in human years at 10 years old is quite different from a large dog\'s at the same age.'],
  ['q' => 'How old is a 1-year-old dog in human years?',
   'a' => 'At 1 year, most dogs are roughly equivalent to a <strong>15-year-old human</strong> — they have reached sexual maturity and most of their physical growth. By age 2, the divergence by breed size begins: a 2-year-old small dog is approximately 24 human years, while a 2-year-old large dog may be closer to 28–30 human years, reflecting the faster aging trajectory of larger breeds.'],
  ['q' => 'How do you calculate a cat\'s age in human years?',
   'a' => 'The <strong>American Association of Feline Practitioners (AAFP)</strong> life stage framework is the most widely used approach. It divides a cat\'s life into: kitten (0–6 months), junior (7 months–2 years), prime (3–6 years), mature (7–10 years), senior (11–14 years), and super-senior (15+ years). These stages map to approximate human age equivalents — for example, a 2-year-old cat is roughly equivalent to a 24-year-old human.'],
  ['q' => 'Is a 10-year-old cat old?',
   'a' => 'By AAFP standards, a 10-year-old cat is in the <strong>mature stage</strong> — roughly equivalent to a human in their early-to-mid 50s. They remain active and healthy in most cases but may begin developing age-related conditions such as kidney disease, hyperthyroidism, or arthritis. Twice-yearly vet check-ups are generally recommended for cats over 10.'],
  ['q' => 'Do large dogs age faster than small dogs?',
   'a' => 'Yes — significantly. Giant breeds like Great Danes have average lifespans of 7–9 years, while small breeds like Chihuahuas or Dachshunds regularly live 15–17 years. A <strong>5-year-old Great Dane</strong> is proportionally much older in human-equivalent terms than a <strong>5-year-old Chihuahua</strong>. This is why breed size is the single most important variable in any accurate dog age calculator.'],
  ['q' => 'How accurate is the 7-to-1 dog age rule?',
   'a' => 'Not very. The rule assumes a linear relationship between dog years and human years, which contradicts what we know about canine development. Dogs reach adulthood by age 1–2 (equivalent to ~15–24 human years), not age 7–14. A <strong>2019 study</strong> published in Cell Systems used DNA methylation data to propose a logarithmic formula: Human age ≈ 16 × ln(dog age) + 31. Our calculator uses a validated, breed-size-adjusted scale.'],
];

$relatedTools = [
  ['icon' => '⏰', 'name' => 'Life Tools',    'slug' => '/life-tools',    'desc' => 'Age, dates & life calculators'],
  ['icon' => '😴', 'name' => 'Sleep Tools',   'slug' => '/sleep-tools',   'desc' => 'Bedtime, sleep cycles & nap calculators'],
  ['icon' => '💪', 'name' => 'Fitness Tools', 'slug' => '/fitness-tools', 'desc' => 'BMI, calories, macros & more'],
  ['icon' => '🎮', 'name' => 'Brain Games',   'slug' => '/games',         'desc' => 'Typing speed, memory & reaction tests'],
];
@endphp

@section('content')

{{-- Breadcrumb --}}
<nav aria-label="Breadcrumb" class="ms-cat-nav">
  <div class="container-xl">
    <ol class="breadcrumb mb-0">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Pet Tools</li>
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
          <span class="badge ms-badge ms-badge-pets">{{ $cat['label'] }}</span>
        </div>
        <h1 class="ms-hero-title">Free Pet Age Calculators</h1>
        <p class="ms-hero-desc-wide">
          Convert your dog or cat's age to human years instantly. Our dog calculator adjusts for breed size; our cat calculator uses AAFP life stages. No signup, instant results.
        </p>
        <div class="d-flex flex-wrap gap-3">
          <div class="ms-hero-feature d-flex align-items-center gap-2">
            <svg width="16" height="16" fill="none" stroke="#5a9e4f" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            Dog: adjusts for breed size
          </div>
          <div class="ms-hero-feature d-flex align-items-center gap-2">
            <svg width="16" height="16" fill="none" stroke="#5a9e4f" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            Cat: uses AAFP life stages
          </div>
          <div class="ms-hero-feature d-flex align-items-center gap-2">
            <svg width="16" height="16" fill="none" stroke="#5a9e4f" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            Instant results, no signup
          </div>
        </div>
      </div>
      <div class="col-lg-4 d-none d-lg-flex justify-content-end">
        <div class="ms-hero-stat-box ms-hero-stat-box-pets">
          <div class="ms-hero-stat-num">{{ count($tools) }}</div>
          <div class="ms-hero-stat-sub">Pet Tools</div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Tools Grid --}}
<section class="ms-section-tools">
  <div class="container-xl">
    <div class="d-flex align-items-center justify-content-between mb-4">
      <h2 class="ms-section-h2">All Pet Tools</h2>
      <span class="text-muted-sm">{{ count($tools) }} tools</span>
    </div>
    <div class="row g-4">
      @foreach($tools as $tool)
      <div class="col-sm-6 col-lg-4">
        <a href="/{{ $tool['slug'] }}" class="tool-card ms-tool-card-pets d-block p-4 h-100 text-decoration-none">
          <div class="d-flex align-items-start gap-3">
            <span class="ms-tool-icon">{{ $tool['icon'] ?? '🐾' }}</span>
            <div>
              <div class="ms-tool-name">{{ $tool['name'] }}</div>
              <div class="ms-tool-desc">{{ $tool['description'] }}</div>
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- Why Breed Size Matters --}}
<section class="ms-section-white">
  <div class="container-xl">
    <div class="row g-5 align-items-center">
      <div class="col-lg-6">
        <h2>Why the 7-to-1 Rule is Wrong</h2>
        <p class="ms-body-text">
          The idea that one dog year equals seven human years is a simplification that has been passed around for decades — but it does not match the biology. Dogs mature very rapidly in their first two years of life, reaching a physical and sexual maturity equivalent to a human teenager by age one.
        </p>
        <p class="ms-body-text">
          After that initial burst of aging, the rate slows — and it slows at very different rates depending on breed size. A 10-year-old Chihuahua and a 10-year-old Great Dane are at very different points in their life journeys, despite sharing the same calendar age.
        </p>
        <a href="/dog-age-calculator" class="btn btn-cta">
          Try the Dog Age Calculator →
        </a>
      </div>
      <div class="col-lg-6">
        <div class="row g-3">
          @foreach([
            ['🐕','Small breeds','15+ year average lifespan'],
            ['🐕‍🦺','Large breeds','8–12 year average lifespan'],
            ['🐈','Cats','12–18 year average lifespan'],
            ['👴','Senior pets','7+ years for dogs, 11+ for cats'],
          ] as [$icon,$stat,$label])
          <div class="col-6">
            <div class="tool-card p-4 text-center h-100">
              <div class="ms-cycle-icon">{{ $icon }}</div>
              <div class="ms-cycle-val">{{ $stat }}</div>
              <div class="ms-cycle-label">{{ $label }}</div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

{{-- SEO Content --}}
<section class="ms-section-accent">
  <div class="container ms-longtail">
    <h2 class="mb-4 text-brand">How the Dog Age Calculator Works</h2>
    <p>Our dog age calculator uses breed-size-adjusted scales rather than the blunt 7-to-1 formula. You enter your dog's age and select their size category (small, medium, large, or giant). The calculator then applies a non-linear conversion based on veterinary life expectancy data, reflecting the fact that dogs age rapidly in puppyhood and more slowly in maturity. The result gives you a human-equivalent age that accurately reflects where your dog is in their life cycle.</p>
    <h2 class="mt-5 mb-4 text-brand">How the Cat Age Calculator Uses AAFP Life Stages</h2>
    <p>The American Association of Feline Practitioners (AAFP) developed a life stage framework used by vets worldwide to guide health recommendations. The six stages — kitten, junior, prime, mature, senior, and super-senior — correspond to distinct biological phases with different nutritional needs, activity levels, and health risks. Our cat age calculator maps your cat's age to the appropriate AAFP life stage alongside a human-equivalent age, giving you a richer picture than a single number.</p>
    <h2 class="mt-5 mb-4 text-brand">What Your Pet's Human-Equivalent Age Tells You</h2>
    <p>Knowing your pet's human-equivalent age helps you understand what health checks and lifestyle adjustments are appropriate at each stage of life. A dog in their "middle age" equivalent may benefit from joint supplements. A cat entering their "senior" life stage should have biannual vet visits. These calculators are a starting point for a more informed conversation with your veterinarian about your pet's individual needs.</p>
  </div>
</section>

{{-- FAQ --}}
<x-faq-section :faqs="$faqs" id="pageFaq" />

{{-- Related Tools --}}
<x-related-tools :tools="$relatedTools" heading="Explore More Tools" />

@endsection
