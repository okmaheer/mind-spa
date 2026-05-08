@extends('layouts.app')

@section('title', 'Free Life Calculators — Age, Date & Retirement | MindSnap')
@section('description', 'Free online life calculators: exact age calculator, days between two dates, pregnancy due date calculator, ovulation calculator, retirement age countdown, days until any event, and life percentage lived. Instant, no signup.')
@section('canonical', config('app.url') . '/life-tools')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@graph": [
    {
      "@@type": "CollectionPage",
      "@@id": "{{ config('app.url') }}/life-tools#collection",
      "url": "{{ config('app.url') }}/life-tools",
      "name": "Free Life Calculators",
      "description": "7 free life calculators: exact age, days between dates, days until, pregnancy due date, ovulation, retirement countdown, and life percentage.",
      "inLanguage": "en",
      "publisher": { "@@type": "Organization", "name": "MindSnap", "url": "{{ config('app.url') }}" }
    },
    {
      "@@type": "BreadcrumbList",
      "itemListElement": [
        { "@@type": "ListItem", "position": 1, "name": "Home",       "item": "{{ config('app.url') }}" },
        { "@@type": "ListItem", "position": 2, "name": "Life Tools", "item": "{{ config('app.url') }}/life-tools" }
      ]
    },
    {
      "@@type": "FAQPage",
      "mainEntity": [
        { "@@type": "Question", "name": "How do I calculate my exact age?",           "acceptedAnswer": { "@@type": "Answer", "text": "Enter your date of birth into our Age Calculator to get your exact age in years, months, weeks, days, hours, and minutes." } },
        { "@@type": "Question", "name": "How do I calculate my due date?",            "acceptedAnswer": { "@@type": "Answer", "text": "Enter the date of your last menstrual period. The Due Date Calculator adds 280 days (40 weeks) to give your estimated due date." } },
        { "@@type": "Question", "name": "What percentage of my life have I lived?",   "acceptedAnswer": { "@@type": "Answer", "text": "Our Life Percentage Calculator divides your current age by the average life expectancy for your country and gender." } },
        { "@@type": "Question", "name": "How accurate are due date calculators?",    "acceptedAnswer": { "@@type": "Answer", "text": "Due date calculators using Naegele's rule (LMP + 280 days) are accurate to within 2 weeks for 90% of pregnancies." } },
        { "@@type": "Question", "name": "How do I calculate how many days until a future event?", "acceptedAnswer": { "@@type": "Answer", "text": "Our Days Until Calculator lets you enter any future date and instantly shows the exact number of days, weeks, and months remaining." } }
      ]
    }
  ]
}
</script>
@endsection

@php
$cat  = config('mindsnap.categories')['life'];
$faqs = [
  ['q' => 'How do I calculate my exact age?',
   'a' => 'Enter your date of birth in our <a href="/age-calculator">Age Calculator</a> to get your exact age in years, months, weeks, days, and hours. It automatically accounts for leap years and the current date.'],
  ['q' => 'How is a pregnancy due date calculated?',
   'a' => 'The standard method adds <strong>280 days (40 weeks)</strong> to the first day of your last menstrual period (LMP). Our <a href="/due-date-calculator">Due Date Calculator</a> also shows your current trimester and weeks of gestation.'],
  ['q' => 'When is my fertile window?',
   'a' => 'Ovulation typically occurs <strong>14 days before your next period</strong>. The fertile window is 5 days before ovulation plus the day of ovulation itself. Enter your cycle length and period start date in our <a href="/ovulation-calculator">Ovulation Calculator</a> to get your exact fertile window.'],
  ['q' => 'How do I count the days between two dates?',
   'a' => 'Enter any two dates in our <a href="/days-between-dates">Days Between Dates</a> calculator to get the exact count of days, weeks, months, and years between them. Perfect for anniversaries, contracts, and deadlines.'],
  ['q' => 'What does the Life Percentage Calculator show?',
   'a' => 'It divides your current age by the statistical life expectancy for your country and gender to show what percentage of your expected lifespan you\'ve lived — and how many days remain. Try the <a href="/life-percentage-calculator">Life Percentage Calculator</a>.'],
  ['q' => 'How accurate are due date calculators?',
   'a' => 'Naegele\'s rule (LMP + 280 days) is accurate to within 2 weeks for 90% of pregnancies. Only 5% of babies arrive on their exact due date. Early ultrasound (before 14 weeks) is used to confirm or adjust the estimated due date.'],
  ['q' => 'How do I calculate days until an event?',
   'a' => 'Our <a href="/days-until-calculator">Days Until Calculator</a> lets you enter any future date — a birthday, holiday, exam, or trip — and shows the exact countdown in days, weeks, and months. It accounts for leap years automatically.'],
  ['q' => 'How accurate is an online due date calculator?',
   'a' => 'Online due date calculators using Naegele\'s Rule are moderately accurate. Only about 4% of babies are born on their exact due date; 80% are born within 2 weeks either side. The biggest source of error is cycle irregularity — Naegele\'s Rule assumes a 28-day cycle. A first-trimester ultrasound (dating scan) is the most accurate method.'],
  ['q' => 'What percentage of my life have I lived?',
   'a' => 'Your life percentage depends on your age and the life expectancy used. Global average life expectancy is approximately 73 years (WHO, 2024). A 30-year-old has lived approximately 41% of an average life. Our <a href="/life-percentage-calculator">life percentage calculator</a> lets you set your own expected lifespan for a personalised result.'],
];

$relatedTools = [
  ['icon' => '😴', 'name' => 'Sleep Tools',     'slug' => '/sleep-tools',     'desc' => 'Bedtime & sleep cycle calculators'],
  ['icon' => '💪', 'name' => 'Fitness Tools',   'slug' => '/fitness-tools',   'desc' => 'BMI, calories & macro calculators'],
  ['icon' => '🥗', 'name' => 'Nutrition Tools', 'slug' => '/nutrition-tools', 'desc' => 'Water intake & fasting schedule'],
  ['icon' => '🎮', 'name' => 'Brain Games',     'slug' => '/games',           'desc' => 'Typing speed, memory & reaction tests'],
];
@endphp

@section('content')

<nav aria-label="Breadcrumb" class="ms-cat-nav">
  <div class="container-xl">
    <ol class="breadcrumb mb-0">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Life Tools</li>
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
          <span class="ms-cat-badge-life">{{ $cat['label'] }}</span>
        </div>
        <h1 class="ms-cat-hero-h1">Free Life Calculators — Age, Date, Pregnancy &amp; More</h1>
        <p class="ms-cat-hero-p">
          Calculate your exact age, days between any two dates, pregnancy due date, ovulation window, retirement countdown, and more.
          7 free tools — instant results, no signup.
        </p>
        <div class="d-flex flex-wrap gap-3">
          <div class="ms-hero-feature d-flex align-items-center gap-2">
            <svg width="16" height="16" fill="none" stroke="#6f42c1" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            Accurate to the day
          </div>
          <div class="ms-hero-feature d-flex align-items-center gap-2">
            <svg width="16" height="16" fill="none" stroke="#6f42c1" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            Leap year aware
          </div>
          <div class="ms-hero-feature d-flex align-items-center gap-2">
            <svg width="16" height="16" fill="none" stroke="#6f42c1" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            100% free, no signup
          </div>
        </div>
      </div>
      <div class="col-lg-4 d-none d-lg-flex justify-content-end">
        <div class="ms-hero-stat-box ms-hero-stat-box-life">
          <div class="ms-hero-stat-num">7</div>
          <div class="ms-hero-stat-sub">Life Tools</div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Tools Grid --}}
<section class="ms-section-tools">
  <div class="container-xl">
    <div class="d-flex align-items-center justify-content-between mb-4">
      <h2 class="ms-section-h2">All Life Calculators</h2>
      <span class="text-muted-sm">{{ count($tools) }} tools</span>
    </div>
    <div class="row g-4">
      @foreach($tools as $tool)
      <div class="col-sm-6 col-lg-4">
        <a href="/{{ $tool['slug'] }}" class="tool-card d-block p-4 h-100 text-decoration-none ms-tool-card-life">
          <div class="d-flex align-items-start gap-3">
            <span class="ms-tool-icon">{{ $tool['icon'] ?? '⏰' }}</span>
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

{{-- SEO Content --}}
<section class="ms-section-seo-alt">
  <div class="container ms-longtail">
    <h2 class="mb-4 text-brand">Free Pregnancy Calculators — Due Date &amp; Ovulation</h2>
    <p>Pregnancy planning involves two key calculations: ovulation timing (when conception is most likely) and due date estimation (when the baby will arrive). Our ovulation calculator uses your cycle length and last period date to predict your fertile window and peak ovulation day. Our due date calculator uses Naegele's Rule — the standard obstetric method — to estimate your expected delivery date from your last menstrual period or conception date. Both tools give instant results with no registration required.</p>
    <h2 class="mt-5 mb-4 text-brand">Age Calculator — How Old Am I Exactly?</h2>
    <p>Most people know their age in years, but fewer know their exact age in years, months, and days — or in total days, hours, or minutes lived. Our age calculator gives you all of these from your date of birth. Beyond the novelty, exact age calculations matter for legal purposes (age-restricted services, pension eligibility), medical contexts (age-specific health screening guidelines), and insurance. The calculator also shows your next birthday and how many days away it is.</p>
    <h2 class="mt-5 mb-4 text-brand">Retirement Calculator — When Can I Retire?</h2>
    <p>Retirement age varies by country, employer, and personal financial situation. Our retirement calculator helps you see exactly how many years, months, and days remain until a target retirement age — whether that is your country's state pension age or your own personal FIRE (Financial Independence, Retire Early) target. Seeing retirement as a concrete number of days rather than a vague future date is a powerful motivator for long-term financial planning.</p>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="lifeFaq" />

<x-related-tools :tools="$relatedTools" heading="Explore More Tools" />

@endsection
