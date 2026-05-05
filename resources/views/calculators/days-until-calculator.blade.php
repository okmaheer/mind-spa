@extends('layouts.app')

@section('title', 'Days Until Calculator — Countdown to Any Event or Date | MindSnap')
@section('description', 'Free days until calculator: find how many days until any event, holiday, birthday, or custom date. Includes countdown in weeks, hours, and minutes. No signup.')
@section('canonical', config('app.url') . '/days-until-calculator')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "WebApplication",
  "name": "Days Until Calculator",
  "url": "{{ config('app.url') }}/days-until-calculator",
  "description": "Count down the days, weeks, and hours until any event, holiday, birthday, or custom date.",
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
    { "@@type": "ListItem", "position": 3, "name": "Days Until Calculator" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [
    { "@@type": "Question", "name": "How many days until New Year?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The number of days until New Year (January 1) changes every day. Use the calculator above and select 'New Year' from the presets for an instant count. As a rough guide: if today is in October, there are roughly 60–90 days until New Year; in November, 30–60 days; in December, under 30 days." } },
    { "@@type": "Question", "name": "How many days until Christmas?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Christmas is December 25. The number of days remaining depends on today's date. Select the 'Christmas' preset in the calculator for an exact count updated to today. From January 1, Christmas is exactly 358 days away (359 in a leap year). From December 1, it is 24 days away." } },
    { "@@type": "Question", "name": "How do I count down days to an event?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Enter today's date as the start and your event date as the end in any days-between calculator. The difference is your countdown. This calculator makes it easier by accepting just the target date and calculating the difference from now automatically. It also shows the result in weeks, hours, and the day of the week your event falls on." } },
    { "@@type": "Question", "name": "How many days until my birthday?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Enter your birthday date (this year or next, whichever is upcoming) into the custom date field and press Calculate. The calculator shows the exact days remaining, the day of the week your birthday falls on, and how many weeks away it is. If your birthday has already passed this year, use next year's date." } },
    { "@@type": "Question", "name": "How many weeks until my vacation?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Enter your vacation start date into the custom field. The calculator divides the total days by 7 to give you complete weeks plus remaining days. For example, 45 days = 6 weeks and 3 days. This is more useful for planning than a raw day count because most people think in terms of weeks when anticipating future events." } }
  ]
}
</script>
@endsection

@php
$faqs = [
  ['q' => 'How many days until New Year?',
             'a' => 'The number of days until New Year (January 1) changes every day. Select "New Year" from the presets above for an instant count. As a rough guide: in October, roughly 60–90 days; November, 30–60 days; December, under 30 days. In January, the counter immediately resets to approximately 364 days until the next New Year.'],
  ['q' => 'How many days until Christmas?',
             'a' => 'Christmas is December 25. Select the "Christmas" preset above for an exact count from today. From January 1, Christmas is 358 days away (359 in a leap year). From December 1, it\'s 24 days away. From November 1, it\'s 54 days away.'],
  ['q' => 'How do I count down days to an event?',
             'a' => 'Enter your event\'s date into the custom date field and press Count Down. The calculator subtracts today\'s date from the target date and shows the result in days, weeks, and hours. For recurring annual events (holidays, birthdays), it automatically shows the next occurrence if the date has already passed this year.'],
  ['q' => 'How many days until my birthday?',
             'a' => 'Enter your birthday date (this year or next, whichever is upcoming) into the custom date field. The calculator shows the exact days remaining, the day of the week your birthday falls on, and how many weeks away it is. If your birthday has already passed this year, enter next year\'s date.'],
  ['q' => 'How many weeks until my vacation?',
             'a' => 'Enter your vacation start date into the custom field. The calculator divides total days by 7 to give complete weeks plus remaining days. For example, 45 days = 6 weeks and 3 days. Weeks are often a more intuitive unit than raw days for planning purposes — especially when thinking about work schedules.'],
  ['q' => '{{ $q }}', 'a' => '{{ $a }}'],
];

$relatedTools = [
  ['icon' => '🎂', 'name' => 'Age Calculator', 'slug' => 'age-calculator', 'desc' => 'Find your exact age in years, months, days, and hours.'],
  ['icon' => '📅', 'name' => 'Days Between Dates', 'slug' => 'days-between-dates', 'desc' => 'Count days, weeks, and months between two specific dates.'],
  ['icon' => '🤰', 'name' => 'Due Date Calculator', 'slug' => 'due-date-calculator', 'desc' => 'Find your pregnancy due date from last period or conception.'],
  ['icon' => '🏖️', 'name' => 'Retirement Calculator', 'slug' => 'retirement-calculator', 'desc' => 'Calculate when you can retire based on savings goals.'],
  ['icon' => '⌛', 'name' => 'Life Percentage', 'slug' => 'life-percentage-calculator', 'desc' => 'See what percentage of your expected life has already passed.'],
  ['icon' => '🌸', 'name' => 'Ovulation Calculator', 'slug' => 'ovulation-calculator', 'desc' => 'Find your fertile window and best conception dates.'],
];
@endphp

@section('content')

{{-- Hero --}}
<section class="ms-hero">
  <div class="container-xl">
    <div class="row align-items-start g-5">
      <div class="col-lg-7">
        <nav aria-label="breadcrumb" class="mb-3">
          <ol class="breadcrumb ms-breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('category.life') }}">Life Tools</a></li>
            <li class="breadcrumb-item active">Days Until Calculator</li>
          </ol>
        </nav>
        <h1 class="mb-2 ms-hero-title">
          ⏳ Days Until Calculator — Countdown to Any Date or Event
        </h1>
        <p class="ms-hero-desc">
          Instantly count down days, weeks, and hours to any holiday, birthday, deadline, or custom date.
        </p>

        <div class="card border-0 mb-n4 ms-tool-card">
          <div class="card-body p-4 p-md-5">
            <p class="fw-600 mb-3" style="font-size:.9rem; color:var(--primary-dark);">Quick presets:</p>
            <div class="d-flex flex-wrap gap-2 mb-4" id="presetBtns">
              @foreach(['New Year','Christmas','Valentine\'s Day','Halloween','Easter']) as $event)
              <button type="button" class="btn preset-btn"
                      style="border-radius:50px; border:2px solid #e0e0e0; padding:6px 14px; font-size:.82rem; font-weight:600; color:#555; background:#fff;"
                      onclick="selectPreset('{{ $event }}')">{{ $event }}</button>
              @endforeach
            </div>
            <label class="form-label fw-600">Or enter any date:</label>
            <div class="row g-2">
              <div class="col-sm-8">
                <input type="date" id="duTarget" class="form-control">
              </div>
              <div class="col-sm-4">
                <input type="text" id="duEventName" class="form-control" placeholder="Event name (optional)">
              </div>
            </div>
            <button class="btn btn-cta w-100 mt-4" onclick="calcDaysUntil()" style="font-size:1rem;">Count Down →</button>

            <div id="duResults" class="mt-4 d-none">
              <div class="ms-divider"></div>
              <p id="duEventLabel" class="fw-600 mb-3 text-center" style="font-size:1rem; color:var(--primary-dark);"></p>
              <div class="row g-3 text-center">
                <div class="col-6 col-sm-3">
                  <div class="ms-stat ms-stat-purple">
                    <div id="duDays" style="font-size:1.8rem; font-weight:700; color:var(--life);">—</div>
                    <div class="ms-stat-label">Days</div>
                  </div>
                </div>
                <div class="col-6 col-sm-3">
                  <div style="background:#f0fff4; border-radius:10px; padding:14px 8px;">
                    <div id="duWeeks" style="font-size:1.4rem; font-weight:700; color:var(--green-text);">—</div>
                    <div class="ms-stat-label">Weeks</div>
                  </div>
                </div>
                <div class="col-6 col-sm-3">
                  <div class="ms-stat ms-stat-orange">
                    <div id="duHours" style="font-size:1.2rem; font-weight:700; color:#e97b1e;">—</div>
                    <div class="ms-stat-label">Hours</div>
                  </div>
                </div>
                <div class="col-6 col-sm-3">
                  <div class="ms-stat ms-stat-pink">
                    <div id="duWeekends" style="font-size:1.4rem; font-weight:700; color:var(--cta-text);">—</div>
                    <div class="ms-stat-label">Weekends</div>
                  </div>
                </div>
              </div>
              <div id="duDetail" class="mt-3 p-3 rounded text-center" style="background:#f8f9fa; font-size:.88rem; color:#555;"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-5 d-none d-lg-block" style="padding-top:10px;">
        <div class="ms-facts-wrap">
          <h3 class="ms-facts-title">Time Facts</h3>
          @foreach([
            ['365 days','In a regular year'],
            ['52 weeks','Weeks per year'],
            ['8,760 hrs','Hours per year'],
            ['525,960 min','Minutes per year'],
            ['24 hrs','Hours in a day (86,400 seconds)'],
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
      <div class="col-lg-5">
        <span class="ms-badge ms-badge-life mb-3">How It Works</span>
        <h2 class="mb-4">How Date Countdown Calculators Work</h2>
        <p>The calculator takes the target date (at midnight) and subtracts the current date and time. The result in milliseconds is converted to days, weeks, and hours.</p>
        <p>For recurring annual events like Christmas and New Year, the calculator automatically finds the next occurrence — so if Christmas has passed this year, it shows the count to next December 25.</p>
        <p>Easter is a moveable feast calculated using the Computus algorithm — a formula combining lunar and solar calendars. The calculator computes the correct Easter date for the current or next year automatically.</p>
      </div>
      <div class="col-lg-7">
        <div class="p-4 rounded-3 ms-data-box">
          <p class="fw-600 mb-3" style="font-size:.88rem; color:var(--primary-dark); text-transform:uppercase; letter-spacing:.5px;">Fixed holiday dates (recurring annually)</p>
          @foreach([
            ['🎉','New Year\'s Day','January 1'],
            ['❤️','Valentine\'s Day','February 14'],
            ['🌍','Earth Day','April 22'],
            ['🎃','Halloween','October 31'],
            ['🎄','Christmas Day','December 25'],
            ['🥂','New Year\'s Eve','December 31'],
          ] as [$icon,$name,$date])
          <div class="d-flex align-items-center gap-3 mb-2">
            <div style="width:28px; text-align:center; font-size:1.1rem;">{{ $icon }}</div>
            <div style="flex:1; font-size:.87rem; color:#333;">{{ $name }}</div>
            <div style="font-size:.82rem; color:#888; font-weight:600;">{{ $date }}</div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Coming up --}}
<section class="ms-section-muted">
  <div class="container-xl">
    <div class="text-center mb-5">
      <h2>Days Until Major 2025–2026 Events</h2>
      <p class="text-muted" style="max-width:480px; margin:auto;">Quick-access countdown panel — updates automatically from today's date.</p>
    </div>
    <div class="row g-3 justify-content-center" id="holidayGrid"></div>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="duFaq" />


{{-- Long-tail --}}
<section class="ms-section-accent">
  <div class="container ms-longtail">
    <h2 class="mb-4" style="color:var(--primary-dark);">Days Until Christmas — Countdown to December 25</h2>
    <p>Christmas Day falls on December 25 every year. The countdown from January 1 starts at 358 days (359 in a leap year) and ticks down every day. Many people begin Christmas planning in October when there are roughly 80–90 days remaining. Retailers typically begin Christmas merchandising when there are 100+ days left. Use the Christmas preset above for an up-to-the-day count.</p>

    <h2 class="mt-5 mb-4" style="color:var(--primary-dark);">Days Until My Birthday Calculator — How Long Until I Turn [Age]?</h2>
    <p>To count down to your next birthday, enter the birthday date (this year if it hasn't happened yet, next year if it has) into the custom field. The calculator shows the exact days remaining and the day of the week your birthday falls on. If you want to count down to a milestone birthday (like turning 30 or 40), simply enter that specific date in the custom field and add a label like "30th Birthday" in the event name field.</p>

    <h2 class="mt-5 mb-4" style="color:var(--primary-dark);">How Many Days Until the New Year?</h2>
    <p>New Year's Day is January 1. The countdown depends entirely on today's date. On January 2, the count resets to 364 days (365 in a leap year) until the next January 1. The final week of December is when "days until New Year" becomes a genuine topic of conversation — most people are tracking single digits by December 28–29. The New Year preset auto-detects whether January 1 of this year or next year is the correct target.</p>
  </div>
</section>

<x-related-tools :tools="$relatedTools" heading="More Life Calculators" />


@endsection

@section('scripts')
<script>
(function () {
  var DAYS = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
  var MONTHS = ['January','February','March','April','May','June','July','August','September','October','November','December'];

  function nextOccurrence(month, day) {
    var now = new Date();
    var d = new Date(now.getFullYear(), month - 1, day);
    if (d <= now) d.setFullYear(d.getFullYear() + 1);
    return d;
  }

  function easterDate(year) {
    var a = year % 19, b = Math.floor(year / 100), c = year % 100;
    var d = Math.floor(b / 4), e = b % 4, f = Math.floor((b + 8) / 25);
    var g = Math.floor((b - f + 1) / 3), h = (19 * a + b - d - g + 15) % 30;
    var i = Math.floor(c / 4), k = c % 4, l = (32 + 2 * e + 2 * i - h - k) % 7;
    var m = Math.floor((a + 11 * h + 22 * l) / 451);
    var month = Math.floor((h + l - 7 * m + 114) / 31);
    var day   = ((h + l - 7 * m + 114) % 31) + 1;
    return new Date(year, month - 1, day);
  }

  function nextEaster() {
    var now = new Date();
    var e = easterDate(now.getFullYear());
    if (e <= now) e = easterDate(now.getFullYear() + 1);
    return e;
  }

  var presetDates = {
    'New Year':        function(){ return nextOccurrence(1, 1); },
    'Christmas':       function(){ return nextOccurrence(12, 25); },
    "Valentine's Day": function(){ return nextOccurrence(2, 14); },
    'Halloween':       function(){ return nextOccurrence(10, 31); },
    'Easter':          function(){ return nextEaster(); },
  };

  window.selectPreset = function (name) {
    var d = presetDates[name]();
    var iso = d.toISOString().substring(0, 10);
    document.getElementById('duTarget').value    = iso;
    document.getElementById('duEventName').value = name;
    document.querySelectorAll('.preset-btn').forEach(function(b){
      b.style.background = b.textContent.trim() === name ? 'var(--life)' : '#fff';
      b.style.color      = b.textContent.trim() === name ? '#fff' : '#555';
      b.style.borderColor = b.textContent.trim() === name ? 'var(--life)' : '#e0e0e0';
    });
    calcDaysUntil();
  };

  window.calcDaysUntil = function () {
    var targetVal = document.getElementById('duTarget').value;
    var eventName = document.getElementById('duEventName').value.trim() || 'Your Event';
    if (!targetVal) return;

    var now    = new Date();
    var target = new Date(targetVal + 'T00:00:00');
    var diff   = target - now;

    if (diff < 0) {
      document.getElementById('duEventLabel').textContent = eventName + ' has already passed!';
      document.getElementById('duDays').textContent   = '0';
      document.getElementById('duWeeks').textContent  = '0w 0d';
      document.getElementById('duHours').textContent  = '0';
      document.getElementById('duWeekends').textContent = '0';
      document.getElementById('duDetail').textContent = 'The selected date is in the past. Enter a future date to count down.';
      document.getElementById('duResults').classList.remove('d-none');
      return;
    }

    var days     = Math.ceil(diff / 86400000);
    var weeks    = Math.floor(days / 7);
    var remDays  = days % 7;
    var hours    = Math.ceil(diff / 3600000);
    var weekends = Math.floor(days / 7) * 2 + ([0,1].indexOf(target.getDay()) >= 0 ? 1 : 0);

    var dayOfWeek = DAYS[target.getDay()];
    var dateStr   = MONTHS[target.getMonth()] + ' ' + target.getDate() + ', ' + target.getFullYear();

    document.getElementById('duEventLabel').textContent = eventName + ' is in:';
    document.getElementById('duDays').textContent    = days.toLocaleString();
    document.getElementById('duWeeks').textContent   = weeks + 'w ' + remDays + 'd';
    document.getElementById('duHours').textContent   = hours.toLocaleString() + 'h';
    document.getElementById('duWeekends').textContent = weekends;
    document.getElementById('duDetail').innerHTML =
      '<strong>' + dayOfWeek + ', ' + dateStr + '</strong><br>'
      + days + ' days · ' + weeks + ' weeks ' + (remDays > 0 ? 'and ' + remDays + ' days' : 'exactly') + '<br>'
      + '<span style="color:#888; font-size:.82rem;">That\'s about ' + weekends + ' weekends away</span>';

    document.getElementById('duResults').classList.remove('d-none');
    document.getElementById('duResults').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  };

  // Holiday grid
  var holidays = [
    { name: 'New Year',        fn: function(){ return nextOccurrence(1,1); },   icon:'🎉' },
    { name: "Valentine's",     fn: function(){ return nextOccurrence(2,14); },  icon:'❤️' },
    { name: 'Easter',          fn: function(){ return nextEaster(); },           icon:'🐣' },
    { name: 'Halloween',       fn: function(){ return nextOccurrence(10,31); }, icon:'🎃' },
    { name: 'Christmas',       fn: function(){ return nextOccurrence(12,25); }, icon:'🎄' },
    { name: "New Year's Eve",  fn: function(){ return nextOccurrence(12,31); }, icon:'🥂' },
  ];
  var grid = document.getElementById('holidayGrid');
  holidays.forEach(function(h) {
    var d    = h.fn();
    var diff = Math.ceil((d - new Date()) / 86400000);
    var col  = document.createElement('div');
    col.className = 'col-6 col-md-4 col-lg-2';
    col.innerHTML = '<div class="card border-0 text-center p-3 h-100" style="border-radius:12px; box-shadow:0 2px 12px rgba(0,0,0,.06); cursor:pointer;" onclick="selectPreset(\''+h.name+'\')">'
      + '<div style="font-size:1.8rem; margin-bottom:6px;">'+h.icon+'</div>'
      + '<div class="fw-600" style="font-size:.82rem; color:var(--primary-dark);">'+h.name+'</div>'
      + '<div class="fw-700 mt-1" style="font-size:1.2rem; color:var(--life);">'+diff+'</div>'
      + '<div class="ms-stat-label">days away</div>'
      + '</div>';
    grid.appendChild(col);
  });

  // Default target date
  var d = new Date(); d.setDate(d.getDate() + 30);
  document.getElementById('duTarget').value = d.toISOString().substring(0, 10);
})();
</script>
@endsection
