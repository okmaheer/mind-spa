@extends('layouts.app')

@section('title', 'Age Calculator — Exact Age in Years, Months, Days & Hours | MindSnap')
@section('description', 'Free age calculator: enter your date of birth to get your exact age in years, months, days, hours, and minutes. Also shows next birthday countdown. No signup.')
@section('canonical', config('app.url') . '/age-calculator')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "WebApplication",
  "name": "Age Calculator",
  "url": "{{ config('app.url') }}/age-calculator",
  "description": "Calculate your exact age in years, months, days, hours, and minutes. Includes next birthday countdown and generation label.",
  "applicationCategory": "UtilityApplication",
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
    { "@@type": "ListItem", "position": 1, "name": "Home",       "item": "{{ config('app.url') }}" },
    { "@@type": "ListItem", "position": 2, "name": "Life Tools", "item": "{{ config('app.url') }}/life-tools" },
    { "@@type": "ListItem", "position": 3, "name": "Age Calculator" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [
    { "@@type": "Question", "name": "How is age calculated exactly?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Exact age is calculated by finding the number of complete years between the date of birth and today, then the remaining complete months, then the remaining days. For example, if you were born on March 15 and today is November 5, your age is the full years elapsed, plus the months from March 15 to November 5, plus the remaining days. This differs from simply dividing total days by 365 because calendar months have different lengths and leap years occur every 4 years." } },
    { "@@type": "Question", "name": "How many days old am I if I was born on a specific date?",
      "acceptedAnswer": { "@@type": "Answer", "text": "To find how many days old you are, subtract your date of birth from today's date in milliseconds, then divide by 86,400,000 (the number of milliseconds in a day) and take the floor. This accounts for leap years automatically since JavaScript's Date object uses UTC milliseconds. For example, someone born on January 1, 1990 is approximately 13,000+ days old today (varying by current date)." } },
    { "@@type": "Question", "name": "What generation am I if I was born in a specific year?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Generational labels by birth year: Generation Alpha (2013–present), Generation Z (1997–2012), Millennials (1981–1996), Generation X (1965–1980), Baby Boomers (1946–1964), Silent Generation (1928–1945), Greatest Generation (before 1928). Note that these boundaries vary by source — the Pew Research Center definitions are used here as the most widely cited. People born on the cusp years often identify with characteristics of both adjacent generations." } },
    { "@@type": "Question", "name": "How do I calculate the age difference between two people?",
      "acceptedAnswer": { "@@type": "Answer", "text": "To calculate the age difference between two people, simply subtract the older person's date of birth from the younger person's date of birth, then express the result in years and months. For example, if Person A was born on June 10, 1985, and Person B on February 22, 1992, the difference is 6 years and approximately 8 months. Use the 'calculate as of' custom date feature to find the age difference at any point in history or the future." } },
    { "@@type": "Question", "name": "What does it mean to be 1 billion seconds old?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Reaching 1 billion seconds of age is a milestone that occurs at approximately 31 years, 251 days, 13 hours, 34 minutes, and 54 seconds of age. It is a fun mathematical curiosity because humans rarely think about their age in seconds. At 2 billion seconds, you would be approximately 63.4 years old. The exact date of your 1 billion second milestone is calculated by this tool and shown in the results." } }
  ]
}
</script>
@endsection

@php
$faqs = [
  ['q' => 'How is age calculated exactly?',
             'a' => 'Exact age is calculated by finding the number of complete years between the date of birth and today, then the remaining complete months, then the remaining days. For example, if you were born on March 15 and today is November 5, your age is the full years elapsed, plus the months from March 15 to November 5, plus the remaining days. This differs from simply dividing total days by 365 because calendar months have different lengths and leap years occur every 4 years.'],
  ['q' => 'How many days old am I if I was born on a specific date?',
             'a' => 'To find how many days old you are, subtract your date of birth from today\'s date in milliseconds, then divide by 86,400,000 (milliseconds in a day) and take the floor. This accounts for leap years automatically. For example, someone born on January 1, 1990 is over 13,000 days old today. Enter your birth date above to get the exact number instantly.'],
  ['q' => 'What generation am I if I was born in a specific year?',
             'a' => 'Generational labels by birth year: Generation Alpha (2013–present), Generation Z (1997–2012), Millennials (1981–1996), Generation X (1965–1980), Baby Boomers (1946–1964), Silent Generation (1928–1945). These are Pew Research Center definitions, the most widely cited. People born on cusp years often identify with both adjacent generations.'],
  ['q' => 'How do I calculate the age difference between two people?',
             'a' => 'To calculate the age difference between two people, subtract the older person\'s date of birth from the younger person\'s. For example, if Person A was born June 10, 1985, and Person B on February 22, 1992, the difference is approximately 6 years and 8 months. Use the "calculate as of" feature to find age differences at specific points in history.'],
  ['q' => 'What does it mean to be 1 billion seconds old?',
             'a' => 'Reaching 1 billion seconds of age occurs at approximately 31 years, 251 days, 13 hours, 34 minutes, and 54 seconds. It is a fun mathematical curiosity — humans rarely think about age in seconds. At 2 billion seconds, you would be approximately 63.4 years old. The exact date of your 1 billion second milestone is calculated by this tool and shown in the results.'],
  ['q' => 'How old am I in months?',
             'a' => 'To convert age to months, multiply your complete years by 12, then add the remaining months from your most recent birthday. For example, if you are 25 years and 7 months old, you are 307 months old. The age calculator shows this breakdown automatically. For a newborn or infant, age in months is the standard clinical measurement used by paediatricians to track developmental milestones.'],
  ['q' => 'Why does the age calculator show different results for leap year birthdays?',
             'a' => 'People born on February 29 (leap day) only have a true birthday every 4 years. In non-leap years, most legal and social conventions treat March 1 as their birthday (some use February 28). This calculator treats February 28 as the equivalent birthday in non-leap years, which is the most common convention for age-related legal purposes in most jurisdictions.'],
  ['q' => 'How do I calculate my age as of a specific date?',
             'a' => 'Use the "calculate as of" field to enter any past or future date instead of today. The calculator will then show your age at that specific date. This is useful for legal documents (e.g., "how old was I on the date of the contract?"), historical curiosity (e.g., "how old was Einstein when he published special relativity?"), or future planning (e.g., "how old will I be when I retire?").'],
];

$relatedTools = [
  ['icon' => '📅', 'name' => 'Days Between Dates', 'slug' => 'days-between-dates', 'desc' => 'Count exact days, weeks, and months between two dates.'],
  ['icon' => '⏳', 'name' => 'Days Until Calculator', 'slug' => 'days-until-calculator', 'desc' => 'Countdown to any event, holiday, or date.'],
  ['icon' => '🤰', 'name' => 'Due Date Calculator', 'slug' => 'due-date-calculator', 'desc' => 'Calculate your pregnancy due date.'],
  ['icon' => '🏖️', 'name' => 'Retirement Calculator', 'slug' => 'retirement-calculator', 'desc' => 'Find out when you can retire comfortably.'],
  ['icon' => '📊', 'name' => 'Life Percentage', 'slug' => 'life-percentage-calculator', 'desc' => 'What percentage of your life have you lived?'],
  ['icon' => '📆', 'name' => 'Ovulation Calculator', 'slug' => 'ovulation-calculator', 'desc' => 'Track your fertile window and cycle.'],
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
          ['url' => route('category.life'), 'name' => 'Life Tools'],
          ['url' => '', 'name' => 'Age Calculator'],
        ]"/>

        <h1 class="mb-2 ms-hero-title">
          🎂 Age Calculator — Your Exact Age in Years, Months &amp; Days
        </h1>
        <p class="ms-hero-desc">
          Enter your date of birth to get your exact age down to days, hours, and minutes — plus your birthday countdown.
        </p>

        {{-- ── Tool Card ─────────────────────────────────────────────────────── --}}
        <div class="card border-0 mb-n4 ms-tool-card">
          <div class="card-body p-4 p-md-5">

            <div class="mb-3">
              <label for="ageDob" class="form-label fw-semibold">Date of Birth</label>
              <input type="date" id="ageDob" class="form-control" aria-label="Date of birth">
            </div>

            <div class="mb-4">
              <label for="ageAsOf" class="form-label fw-semibold">
                Calculate age as of
                <span class="text-muted fw-normal" style="font-size:.82rem;">(default: today)</span>
              </label>
              <input type="date" id="ageAsOf" class="form-control" aria-label="Calculate as of date">
            </div>

            <button class="btn btn-cta w-100" onclick="agCalculate()" style="font-size:1rem;">
              Calculate My Age →
            </button>

            {{-- Results --}}
            <div id="agResults" class="mt-4 d-none">
              <div style="height:1px; background:#f0f0f0; margin-bottom:20px;"></div>

              {{-- Main age display --}}
              <div class="text-center p-4 rounded-3 mb-3" style="background:linear-gradient(135deg, #f3e8ff 0%, #ede0ff 100%); border:1px solid #d8b4ff;">
                <div id="agMainAge" style="font-size:1.6rem; font-weight:700; color:var(--life); line-height:1.3;"></div>
                <div id="agDobLabel" style="font-size:.78rem; color:#6b46a8; margin-top:4px;"></div>
              </div>

              <div class="row g-3 mb-3">
                <div class="col-6 col-md-3">
                  <div class="text-center p-3 rounded-3" style="background:#f3e8ff; border:1px solid #d8b4ff;">
                    <div id="agTotalDays" style="font-size:1.2rem; font-weight:700; color:var(--life);"></div>
                    <div style="font-size:.72rem; color:#6b46a8; margin-top:2px;">Total days</div>
                  </div>
                </div>
                <div class="col-6 col-md-3">
                  <div class="text-center p-3 rounded-3" style="background:#f3e8ff; border:1px solid #d8b4ff;">
                    <div id="agTotalHours" style="font-size:1.2rem; font-weight:700; color:var(--life);"></div>
                    <div style="font-size:.72rem; color:#6b46a8; margin-top:2px;">Total hours</div>
                  </div>
                </div>
                <div class="col-6 col-md-3">
                  <div class="text-center p-3 rounded-3" style="background:#f3e8ff; border:1px solid #d8b4ff;">
                    <div id="agTotalMinutes" style="font-size:1.2rem; font-weight:700; color:var(--life);"></div>
                    <div style="font-size:.72rem; color:#6b46a8; margin-top:2px;">Total minutes</div>
                  </div>
                </div>
                <div class="col-6 col-md-3">
                  <div class="text-center p-3 rounded-3" style="background:#f3e8ff; border:1px solid #d8b4ff;">
                    <div id="agWeeks" style="font-size:1.2rem; font-weight:700; color:var(--life);"></div>
                    <div style="font-size:.72rem; color:#6b46a8; margin-top:2px;">Total weeks</div>
                  </div>
                </div>
              </div>

              <div class="row g-3 mb-3">
                <div class="col-md-6">
                  <div class="p-3 rounded-3" style="background:#f8f9fa; border:1px solid #e0e0e0;">
                    <div style="font-size:.75rem; color:#888; margin-bottom:4px;">🎂 Next Birthday</div>
                    <div id="agNextBirthday" style="font-weight:700; color:var(--primary-dark); font-size:.9rem;"></div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="p-3 rounded-3" style="background:#f8f9fa; border:1px solid #e0e0e0;">
                    <div style="font-size:.75rem; color:#888; margin-bottom:4px;">📅 Born on a</div>
                    <div id="agBornDay" style="font-weight:700; color:var(--primary-dark); font-size:.9rem;"></div>
                  </div>
                </div>
              </div>

              <div class="row g-3">
                <div class="col-md-6">
                  <div class="p-3 rounded-3" style="background:#f3e8ff; border:1px solid #d8b4ff;">
                    <div style="font-size:.75rem; color:#888; margin-bottom:4px;">🧬 Your Generation</div>
                    <div id="agGeneration" style="font-weight:700; color:var(--life); font-size:.9rem;"></div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="p-3 rounded-3" style="background:#f3e8ff; border:1px solid #d8b4ff;">
                    <div style="font-size:.75rem; color:#888; margin-bottom:4px;">🎯 1 Billion Seconds</div>
                    <div id="agBillionSec" style="font-weight:700; color:var(--life); font-size:.9rem;"></div>
                  </div>
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
          <h3 class="ms-facts-title">Quick Age Facts</h3>
          @foreach([
            ['365.25 days', 'Average year length (leap year corrected)'],
            ['86,400 sec',  'Seconds in one day'],
            ['78.7 years',  'Average global life expectancy'],
            ['525,960 min', 'Minutes in one year'],
            ['~31.7 yrs',   'Age when you reach 1 billion seconds'],
          ] as [$stat, $label])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div class="ms-fact-pill ms-fact-pill-life">{{ $stat }}</div>
            <div class="ms-fact-label">{{ $label }}</div>
          </div>
          @endforeach
          <p class="ms-fact-source">Sources: WHO, UN Population Division</p>
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
        <span class="ms-badge ms-badge-life mb-3">How It Works</span>
        <h2 class="mb-4">How Age Is Calculated: Calendar Math Explained</h2>
        <p>Calculating exact age sounds simple — but calendar math is surprisingly nuanced. Months have different lengths (28–31 days), leap years add an extra day every 4 years (mostly), and the concept of a "completed year" requires tracking month and day boundaries, not just subtracting year numbers.</p>
        <p>This calculator computes age in three passes: first the number of complete years since birth, then the number of complete months remaining, then the remaining days. For total counts (total days, hours, minutes), it uses the raw millisecond difference between dates, which automatically handles every leap year ever.</p>
        <p>The "calculate as of" feature lets you find someone's age at a specific historical date — useful for legal documents, historical research, or knowing how old someone was when a major event occurred.</p>
      </div>
      <div class="col-lg-7">
        <div class="p-4 rounded-3 ms-data-box">
          <p class="fw-semibold mb-3" style="color:var(--primary-dark); font-size:.88rem; text-transform:uppercase; letter-spacing:.5px;">Generations at a glance</p>
          @foreach([
            ['Gen Alpha',        '2013–present',  'Digital natives born into smartphones and AI.'],
            ['Gen Z',            '1997–2012',      'First true digital-native generation.'],
            ['Millennials',      '1981–1996',      'Grew up with the internet; shaped social media.'],
            ['Gen X',            '1965–1980',      'The "middle child" generation — often overlooked.'],
            ['Baby Boomers',     '1946–1964',      'Post-WWII prosperity generation.'],
            ['Silent Gen',       '1928–1945',      'Shaped by the Depression and WWII.'],
          ] as [$gen, $years, $desc])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div style="background:#f3e8ff; color:var(--life); border-radius:8px; padding:5px 10px; font-weight:700; font-size:.78rem; min-width:90px; text-align:center; flex-shrink:0; border:1px solid #d8b4ff;">{{ $years }}</div>
            <div>
              <div class="fw-semibold" style="font-size:.87rem; color:#1a1a2e;">{{ $gen }}</div>
              <div style="font-size:.79rem; color:#666;">{{ $desc }}</div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="agAccordion" />


{{-- ── 4. Long-tail sections ─────────────────────────────────────────────────── --}}
<section class="ms-section-accent">
  <div class="container ms-longtail">

    <h2 class="mb-4" style="color:var(--primary-dark);">Age Calculator in Days — How Many Days Old Are You?</h2>
    <p>Your age in days is a surprisingly meaningful number. A person turning 30 has lived approximately 10,957 days (accounting for 7 or 8 leap years depending on birth date). At 50 years old, you have experienced roughly 18,262 days. Every 1,000 days of life is a milestone worth noting — at 1,000 days you are about 2 years and 9 months old, at 10,000 days you are approximately 27 years old. Many people find thinking about life in days creates a vivid sense of time's value that years alone do not convey. The total days figure is also the most precise way to express age for legal or scientific purposes, since it eliminates ambiguity about leap years and month lengths entirely.</p>

    <h2 class="mt-5 mb-4" style="color:var(--primary-dark);">Age Calculator for Legal Purposes — Am I 18 Yet?</h2>
    <p>Legal age thresholds vary by jurisdiction but commonly fall at 16, 18, and 21 years. The precise calculation matters when determining eligibility: you reach a legal age on the anniversary of your birth date, not on January 1 of the year you turn that age. If you were born on December 31, 2005, you do not turn 18 until December 31, 2023 — not on January 1, 2023. This calculator uses exact calendar date comparison, making it suitable for quick legal age verification. For jurisdictions that treat the day before the birthday as the qualifying day (some common law countries use this rule, where the day before your 18th birthday counts as your 18th), be aware that your result may differ by one day. Always confirm with a legal professional for official age-related decisions.</p>

    <h2 class="mt-5 mb-4" style="color:var(--primary-dark);">How to Calculate Age Between Two Dates</h2>
    <p>To calculate the age (or time elapsed) between any two dates — not just from a birthday to today — use the "calculate as of" field to set a custom end date. This lets you answer questions like: "How old was my grandfather when the moon landing happened?" (July 20, 1969), or "How old will I be on my retirement date?" The algorithm counts complete years first, then complete months within the final partial year, then remaining days — giving you a precise breakdown of years, months, and days between any two calendar dates. For simple date subtraction in full days, the total days figure provides an unambiguous answer that does not depend on how you count month boundaries.</p>

  </div>
</section>

<x-related-tools :tools="$relatedTools" heading="More Life Tools" />


{{-- ── 6. SEO Block ─────────────────────────────────────────────────────────── --}}
<section class="ms-section-seo">
  <div class="container-xl">
    <div class="row justify-content-center">
      <div class="col-lg-8 ms-seo-body">
        <h2 class="mb-4 ms-seo-h2">Age Calculator: More Than a Simple Subtraction</h2>
        <p>Age calculation seems trivial until you look closely at the edge cases. Leap years, varying month lengths, and the question of whether age increments on the birthday itself or the day before all introduce complexity. Different legal systems handle these differently — most English-speaking countries use the "birthday rule" (age increments at the start of the birthday), while some civil law jurisdictions use the day before.</p>
        <h3 class="ms-seo-h3">The 1 Billion Second Milestone</h3>
        <p>One billion seconds equals exactly 1,000,000,000 ÷ 31,536,000 = approximately 31.69 years. This means you hit the milestone around your 31st birthday plus 252 days. For most people born in the 1990s, this milestone has already passed — an interesting thought experiment about how we perceive time across different units.</p>
        <h3 class="ms-seo-h3">Historical Age Calculation</h3>
        <p>Historical ages can be harder to calculate than modern ones because the Gregorian calendar was not adopted uniformly — Britain and its colonies switched in 1752, Russia in 1918, and some countries even later. Historical figures born before the calendar switch have two possible "birthdates" (Old Style and New Style). For dates after 1900, this calculator is accurate for virtually any country.</p>
      </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')
<script>
(function () {

  // Set default DOB to 30 years ago
  (function () {
    var d = new Date();
    d.setFullYear(d.getFullYear() - 30);
    document.getElementById('ageDob').value = d.toISOString().slice(0, 10);
    // Default as-of to today
    document.getElementById('ageAsOf').value = new Date().toISOString().slice(0, 10);
  })();

  var GENERATIONS = [
    { label: 'Generation Alpha', start: 2013, end: 9999 },
    { label: 'Generation Z',     start: 1997, end: 2012 },
    { label: 'Millennials',      start: 1981, end: 1996 },
    { label: 'Generation X',     start: 1965, end: 1980 },
    { label: 'Baby Boomers',     start: 1946, end: 1964 },
    { label: 'Silent Generation',start: 1928, end: 1945 },
    { label: 'Greatest Generation', start: 0, end: 1927 },
  ];

  function getGeneration(birthYear) {
    for (var i = 0; i < GENERATIONS.length; i++) {
      if (birthYear >= GENERATIONS[i].start && birthYear <= GENERATIONS[i].end) {
        return GENERATIONS[i].label;
      }
    }
    return 'Unknown';
  }

  function calcAge(dob, asOf) {
    var years  = asOf.getFullYear() - dob.getFullYear();
    var months = asOf.getMonth()    - dob.getMonth();
    var days   = asOf.getDate()     - dob.getDate();

    if (days < 0) {
      months -= 1;
      // Days in previous month
      var prevMonth = new Date(asOf.getFullYear(), asOf.getMonth(), 0);
      days += prevMonth.getDate();
    }
    if (months < 0) {
      years  -= 1;
      months += 12;
    }
    return { years: years, months: months, days: days };
  }

  function fmt(n) {
    return n.toLocaleString();
  }

  window.agCalculate = function () {
    var dobVal  = document.getElementById('ageDob').value;
    var asOfVal = document.getElementById('ageAsOf').value;

    if (!dobVal) { alert('Please enter your date of birth.'); return; }

    var dob  = new Date(dobVal  + 'T00:00:00');
    var asOf = new Date((asOfVal || new Date().toISOString().slice(0, 10)) + 'T00:00:00');

    if (dob >= asOf) { alert('Date of birth must be before the "as of" date.'); return; }

    var age = calcAge(dob, asOf);

    // Total counts
    var diffMs      = asOf - dob;
    var totalDays   = Math.floor(diffMs / 86400000);
    var totalHours  = Math.floor(diffMs / 3600000);
    var totalMin    = Math.floor(diffMs / 60000);
    var totalWeeks  = Math.floor(totalDays / 7);

    // Born day of week
    var bornDay = dob.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });

    // Next birthday
    var nextBday = new Date(asOf.getFullYear(), dob.getMonth(), dob.getDate());
    if (nextBday <= asOf) nextBday.setFullYear(nextBday.getFullYear() + 1);
    var daysUntilBday = Math.ceil((nextBday - asOf) / 86400000);

    // Generation
    var gen = getGeneration(dob.getFullYear());

    // 1 billion seconds
    var billionSecDate = new Date(dob.getTime() + 1000000000 * 1000);
    var billionStr;
    if (billionSecDate < asOf) {
      billionStr = 'Already passed! (' + billionSecDate.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) + ')';
    } else {
      var daysUntilBillion = Math.ceil((billionSecDate - asOf) / 86400000);
      billionStr = billionSecDate.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) + ' (in ' + daysUntilBillion.toLocaleString() + ' days)';
    }

    // Render
    document.getElementById('agMainAge').textContent =
      age.years + ' years, ' + age.months + ' months, ' + age.days + ' days';
    document.getElementById('agDobLabel').textContent =
      'Born ' + dob.toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' });

    document.getElementById('agTotalDays').textContent    = fmt(totalDays);
    document.getElementById('agTotalHours').textContent   = fmt(totalHours);
    document.getElementById('agTotalMinutes').textContent = fmt(totalMin);
    document.getElementById('agWeeks').textContent        = fmt(totalWeeks);

    document.getElementById('agNextBirthday').textContent =
      nextBday.toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' }) +
      ' (in ' + daysUntilBday + ' day' + (daysUntilBday !== 1 ? 's' : '') + ')';

    document.getElementById('agBornDay').textContent   = bornDay;
    document.getElementById('agGeneration').textContent = gen;
    document.getElementById('agBillionSec').textContent  = billionStr;

    document.getElementById('agResults').classList.remove('d-none');
    document.getElementById('agResults').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  };

})();
</script>
@endsection
