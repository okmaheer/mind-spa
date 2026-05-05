@extends('layouts.app')

@section('title', 'Days Between Dates — Count Days, Weeks & Months Between Two Dates | MindSnap')
@section('description', 'Free days between dates calculator: find the exact number of days, weeks, and months between any two dates. Includes business days count. No signup.')
@section('canonical', config('app.url') . '/days-between-dates')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "WebApplication",
  "name": "Days Between Dates Calculator",
  "url": "{{ config('app.url') }}/days-between-dates",
  "description": "Calculate the exact number of days, weeks, months, and business days between any two dates.",
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
    { "@@type": "ListItem", "position": 3, "name": "Days Between Dates" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [
    { "@@type": "Question", "name": "How do I count the days between two dates?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Subtract the earlier date from the later date. In days, this is the difference in milliseconds divided by 86,400,000 (ms per day). For example, from January 1 to March 1 (non-leap year) is 59 days. This calculator does that arithmetic instantly and also breaks the result down into weeks, months, and business days." } },
    { "@@type": "Question", "name": "How many business days are between two dates?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Business days exclude Saturdays and Sundays (and optionally public holidays). The calculator counts every calendar day in the range and subtracts those falling on weekends. For example, a period of 14 calendar days spanning two full weeks contains exactly 10 business days. Holiday exclusions vary by country and are not currently included." } },
    { "@@type": "Question", "name": "Does the calculator include or exclude the start and end dates?",
      "acceptedAnswer": { "@@type": "Answer", "text": "By default, the calculator counts from the start of day 1 to the end of the last day — meaning it includes both the start and end dates. You can toggle this with the 'Include end date' option. Excluding the end date gives you the number of full days elapsed; including it gives you the total days in the span (e.g., from Monday to Friday is 4 elapsed days or 5 total days)." } },
    { "@@type": "Question", "name": "How many weeks between two dates?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Divide the total days by 7. The result is the number of complete weeks plus any remaining days. For example, 30 days is 4 weeks and 2 days. This calculator shows both the total weeks figure and the remainder so you can see the full picture at a glance." } },
    { "@@type": "Question", "name": "How do I calculate months between two dates?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Calculating exact months is trickier than days because months have different lengths. The calculator counts complete calendar months (e.g., February 15 to May 15 = exactly 3 months) and shows the remaining days separately. This gives you a result like '3 months and 12 days' rather than a decimal fraction of a month." } }
  ]
}
</script>
@endsection

@php
$faqs = [
  ['q' => 'How do I count the days between two dates?',
             'a' => 'Subtract the earlier date from the later date. In days, this is the difference in milliseconds divided by 86,400,000 (ms per day). From January 1 to March 1 (non-leap year) is 59 days. This calculator does that arithmetic instantly and also breaks the result down into weeks, months, and business days.'],
  ['q' => 'How many business days are between two dates?',
             'a' => 'Business days exclude Saturdays and Sundays. The calculator counts every calendar day in the range and subtracts those falling on weekends. A period of 14 calendar days spanning two full weeks contains exactly 10 business days. Public holiday exclusions vary by country and are not currently included — subtract them manually for project planning purposes.'],
  ['q' => 'Does the calculator include or exclude the start and end dates?',
             'a' => 'By default, the calculator includes both the start and end date in its count. You can toggle the "Include end date" option to change this. Excluding the end date gives you elapsed days; including it gives you the total span in days. Example: Monday to Friday is 4 elapsed days or 5 total days.'],
  ['q' => 'How many weeks between two dates?',
             'a' => 'Divide the total days by 7. The result is complete weeks plus remaining days. 30 days = 4 weeks and 2 days. The calculator shows both figures. For project planning, it\'s often more useful to round up to the next complete week to ensure you have buffer time.'],
  ['q' => 'How do I calculate months between two dates?',
             'a' => 'Calculating exact months is trickier than days because months have different lengths. The calculator counts complete calendar months (February 15 to May 15 = exactly 3 months) and shows remaining days separately, giving a result like "3 months and 12 days" rather than a decimal.'],
  ['q' => '{{ $q }}', 'a' => '{{ $a }}'],
];

$relatedTools = [
  ['icon' => '🎂', 'name' => 'Age Calculator', 'slug' => 'age-calculator', 'desc' => 'Find your exact age in years, months, days, and hours.'],
  ['icon' => '⏳', 'name' => 'Days Until Calculator', 'slug' => 'days-until-calculator', 'desc' => 'Count down to any event, holiday, or date.'],
  ['icon' => '🤰', 'name' => 'Due Date Calculator', 'slug' => 'due-date-calculator', 'desc' => 'Calculate your pregnancy due date from LMP or conception.'],
  ['icon' => '🏖️', 'name' => 'Retirement Calculator', 'slug' => 'retirement-calculator', 'desc' => 'Find when you can retire based on savings and contributions.'],
  ['icon' => '⌛', 'name' => 'Life Percentage', 'slug' => 'life-percentage-calculator', 'desc' => 'See what percentage of your life has passed.'],
  ['icon' => '🌸', 'name' => 'Ovulation Calculator', 'slug' => 'ovulation-calculator', 'desc' => 'Find your fertile window and best days to conceive.'],
];
@endphp

@section('content')

{{-- Hero --}}
<section class="ms-hero">
  <div class="container-xl">
    <div class="row align-items-start g-5">
      <div class="col-lg-7">
        <x-breadcrumb :crumbs="[
          ['url' => route('home'), 'name' => 'Home'],
          ['url' => route('category.life'), 'name' => 'Life Tools'],
          ['url' => '', 'name' => 'Days Between Dates'],
        ]"/>
        <h1 class="mb-2 ms-hero-title">
          📅 Days Between Dates — Count Days, Weeks & Months Between Any Two Dates
        </h1>
        <p class="ms-hero-desc">
          Instantly find the number of days, weeks, months, and business days between any two dates.
        </p>

        <div class="card border-0 mb-n4 ms-tool-card">
          <div class="card-body p-4 p-md-5">
            <div class="row g-3">
              <div class="col-sm-6">
                <label class="form-label fw-600">Start Date</label>
                <input type="date" id="dbStart" class="form-control">
              </div>
              <div class="col-sm-6">
                <label class="form-label fw-600">End Date</label>
                <input type="date" id="dbEnd" class="form-control">
              </div>
              <div class="col-12 d-flex gap-4 flex-wrap">
                <label class="d-flex align-items-center gap-2" style="cursor:pointer; font-size:.88rem;">
                  <input type="checkbox" id="dbIncludeEnd" checked> Include end date
                </label>
                <label class="d-flex align-items-center gap-2" style="cursor:pointer; font-size:.88rem;">
                  <input type="checkbox" id="dbBizDays"> Business days only
                </label>
              </div>
            </div>
            <button class="btn btn-cta w-100 mt-4" onclick="calcDaysBetween()" style="font-size:1rem;">Calculate →</button>

            <div id="dbResults" class="mt-4 d-none">
              <div class="ms-divider"></div>
              <div class="row g-3 text-center">
                <div class="col-6 col-sm-3">
                  <div class="ms-stat ms-stat-purple">
                    <div id="dbDays" style="font-size:1.6rem; font-weight:700; color:var(--life);">—</div>
                    <div class="ms-stat-label">Days</div>
                  </div>
                </div>
                <div class="col-6 col-sm-3">
                  <div style="background:#f0fff4; border-radius:10px; padding:14px 8px;">
                    <div id="dbWeeks" style="font-size:1.4rem; font-weight:700; color:var(--green-text);">—</div>
                    <div class="ms-stat-label">Weeks</div>
                  </div>
                </div>
                <div class="col-6 col-sm-3">
                  <div class="ms-stat ms-stat-orange">
                    <div id="dbMonths" style="font-size:1.4rem; font-weight:700; color:#e97b1e;">—</div>
                    <div class="ms-stat-label">Months</div>
                  </div>
                </div>
                <div class="col-6 col-sm-3">
                  <div class="ms-stat ms-stat-pink">
                    <div id="dbBiz" style="font-size:1.4rem; font-weight:700; color:var(--cta-text);">—</div>
                    <div class="ms-stat-label">Business Days</div>
                  </div>
                </div>
              </div>
              <div id="dbDetail" class="mt-3 p-3 rounded" style="background:#f8f9fa; font-size:.88rem; color:#555; text-align:center;"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-5 d-none d-lg-block" style="padding-top:10px;">
        <div class="ms-facts-wrap">
          <h3 class="ms-facts-title">Date Facts</h3>
          @foreach([
            ['365 days','In a regular year'],
            ['366 days','In a leap year (every 4 years)'],
            ['252 days','Average working/business days per year'],
            ['604,800','Seconds in one week'],
            ['86,400','Seconds in one day'],
          ] as [$stat,$label])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div class="ms-fact-pill ms-fact-pill-life">{{ $stat }}</div>
            <div class="ms-fact-label">{{ $label }}</div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

{{-- How It Works --}}
<section class="ms-section-white">
  <div class="container-xl">
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <span class="ms-badge ms-badge-life mb-3">How It Works</span>
        <h2 class="mb-4">How to Count Days Between Two Dates</h2>
        <p>At its core, the calculation subtracts one date from another. In JavaScript (and most programming languages), dates are stored as milliseconds since January 1, 1970. The difference in milliseconds divided by 86,400,000 gives the number of days.</p>
        <p>Weeks are days ÷ 7. Months are more complex — they require counting full calendar months between the two dates and then the remaining days separately, since months have different lengths.</p>
        <p>Business days require checking each individual day in the range and excluding Saturdays and Sundays. For project planning purposes, you can treat this calculator's business day count as correct for countries where Mon–Fri are working days.</p>
      </div>
      <div class="col-lg-6">
        <div class="p-4 rounded-3 ms-data-box">
          <p class="fw-600 mb-3" style="font-size:.88rem; color:var(--primary-dark); text-transform:uppercase; letter-spacing:.5px;">Days in each month</p>
          <div class="row g-2">
            @foreach([
              ['Jan','31'],['Feb','28/29'],['Mar','31'],['Apr','30'],
              ['May','31'],['Jun','30'],['Jul','31'],['Aug','31'],
              ['Sep','30'],['Oct','31'],['Nov','30'],['Dec','31'],
            ] as [$m,$d])
            <div class="col-3">
              <div class="text-center p-2 rounded" style="background:#fff; border:1px solid #e8e8e8;">
                <div style="font-size:.75rem; color:#888;">{{ $m }}</div>
                <div style="font-size:.9rem; font-weight:700; color:var(--life);">{{ $d }}</div>
              </div>
            </div>
            @endforeach
          </div>
          <p style="font-size:.75rem; color:#aaa; margin:10px 0 0;">Feb has 29 days in leap years (divisible by 4, except century years unless also divisible by 400).</p>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Common date spans --}}
<section class="ms-section-muted">
  <div class="container-xl">
    <div class="text-center mb-5">
      <h2>Common Date Spans at a Glance</h2>
      <p class="text-muted" style="max-width:480px; margin:auto;">Quick reference for frequently needed date counts.</p>
    </div>
    <div class="row g-3 justify-content-center">
      @foreach([
        ['1 week','7 days','5 business days'],
        ['1 month','~30 days','~22 business days'],
        ['1 quarter','~91 days','~65 business days'],
        ['6 months','~182 days','~130 business days'],
        ['1 year','365 days','~252 business days'],
        ['2 years','730 days','~504 business days'],
      ] as [$period,$days,$biz])
      <div class="col-6 col-md-4 col-lg-2">
        <div class="card border-0 text-center p-3 h-100" style="border-radius:12px; box-shadow:0 2px 12px rgba(0,0,0,.06);">
          <div class="fw-700" style="font-size:.85rem; color:var(--primary-dark);">{{ $period }}</div>
          <div class="fw-700 my-2" style="font-size:1.2rem; color:var(--life);">{{ $days }}</div>
          <div style="font-size:.74rem; color:#888;">{{ $biz }}</div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="dbFaq" />


{{-- Long-tail --}}
<section class="ms-section-accent">
  <div class="container ms-longtail">
    <h2 class="mb-4" style="color:var(--primary-dark);">How Many Business Days Between Two Dates?</h2>
    <p>For contracts, project timelines, and legal deadlines, business days are what matter. Weekends don't count. If a contract says "deliver in 10 business days" and you start on a Monday, the deadline is two weeks away (the following Friday), not 10 calendar days later. This calculator counts business days by checking every day in the range individually and skipping Saturdays and Sundays — giving you an accurate count for planning purposes.</p>

    <h2 class="mt-5 mb-4" style="color:var(--primary-dark);">Days Between Dates for Project Planning and Deadlines</h2>
    <p>Project managers use date-span calculators to build timelines, set milestones, and calculate buffer time. A useful technique: calculate the total calendar days between your start and your hard deadline, then subtract weekends and known holiday dates to get your available business days. Divide that by the number of tasks to find how many working days each task can consume without pushing the deadline.</p>

    <h2 class="mt-5 mb-4" style="color:var(--primary-dark);">How Many Days Until My Vacation, Event, or Holiday?</h2>
    <p>Enter today's date as the start and your event date as the end to count down to any future date. The calculator shows the total days remaining, the weeks and days breakdown, and the number of working days — useful if you're tracking how many working days remain before an annual leave period. For a dedicated countdown timer with presets for major holidays, use the Days Until Calculator.</p>
  </div>
</section>

<x-related-tools :tools="$relatedTools" heading="More Life Calculators" />


@endsection

@section('scripts')
<script>
(function () {
  var today = new Date();
  var yyyy  = today.getFullYear();
  var mm    = String(today.getMonth() + 1).padStart(2, '0');
  var dd    = String(today.getDate()).padStart(2, '0');
  var todayStr = yyyy + '-' + mm + '-' + dd;

  var pastStr = new Date(today.getTime() - 30 * 86400000).toISOString().substring(0, 10);
  document.getElementById('dbStart').value = pastStr;
  document.getElementById('dbEnd').value   = todayStr;

  function countBusinessDays(start, end) {
    var count = 0;
    var d = new Date(start.getTime());
    while (d <= end) {
      var day = d.getDay();
      if (day !== 0 && day !== 6) count++;
      d.setDate(d.getDate() + 1);
    }
    return count;
  }

  function monthsDiff(d1, d2) {
    var months = (d2.getFullYear() - d1.getFullYear()) * 12 + (d2.getMonth() - d1.getMonth());
    if (d2.getDate() < d1.getDate()) months--;
    var tempDate = new Date(d1.getFullYear(), d1.getMonth() + months, d1.getDate());
    var remainDays = Math.round((d2 - tempDate) / 86400000);
    return { months: months, days: remainDays };
  }

  window.calcDaysBetween = function () {
    var startVal = document.getElementById('dbStart').value;
    var endVal   = document.getElementById('dbEnd').value;
    if (!startVal || !endVal) return;

    var start = new Date(startVal + 'T00:00:00');
    var end   = new Date(endVal   + 'T00:00:00');
    var includeEnd = document.getElementById('dbIncludeEnd').checked;
    var bizOnly    = document.getElementById('dbBizDays').checked;

    if (end < start) { var tmp = start; start = end; end = tmp; }

    var effectiveEnd = includeEnd ? new Date(end.getTime() + 86400000) : end;
    var totalDays    = Math.round((effectiveEnd - start) / 86400000);
    var weeks        = Math.floor(totalDays / 7);
    var remDays      = totalDays % 7;
    var md           = monthsDiff(start, effectiveEnd);
    var bizDays      = countBusinessDays(start, includeEnd ? end : new Date(end.getTime() - 86400000));
    var weekends     = totalDays - bizDays;

    document.getElementById('dbDays').textContent   = totalDays.toLocaleString();
    document.getElementById('dbWeeks').textContent  = weeks + 'w ' + remDays + 'd';
    document.getElementById('dbMonths').textContent = md.months + 'm ' + md.days + 'd';
    document.getElementById('dbBiz').textContent    = bizDays.toLocaleString();

    document.getElementById('dbDetail').innerHTML =
      '<strong>' + totalDays.toLocaleString() + ' days</strong> · '
      + weeks + ' weeks ' + (remDays > 0 ? 'and ' + remDays + ' days' : 'exactly') + ' · '
      + md.months + ' months and ' + md.days + ' days<br>'
      + '<span style="color:#888; font-size:.82rem;">'
      + bizDays + ' business days · ' + weekends + ' weekend days</span>';

    document.getElementById('dbResults').classList.remove('d-none');
    document.getElementById('dbResults').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  };
})();
</script>
@endsection
