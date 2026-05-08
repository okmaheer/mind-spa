@extends('layouts.app')

@section('title', 'Life Percentage Calculator — % of Life Passed | MindSnap')
@section('description', 'Free life percentage calculator: find out what percentage of your life has passed based on your age and country life expectancy. Includes days remaining and milestones. No signup.')
@section('canonical', config('app.url') . '/life-percentage-calculator')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "WebApplication",
  "name": "Life Percentage Calculator",
  "url": "{{ config('app.url') }}/life-percentage-calculator",
  "description": "Calculate what percentage of your expected life has passed, how many days you have lived, and how many remain.",
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
    { "@@type": "ListItem", "position": 3, "name": "Life Percentage Calculator" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [
    { "@@type": "Question", "name": "What is life expectancy?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Life expectancy is the average number of years a person born in a given year can expect to live, based on current age-specific mortality rates. Global average life expectancy is approximately 72.8 years (WHO 2024). It varies significantly by country — Japan has one of the highest at 83.7 years, while some sub-Saharan African countries average below 60 years. Life expectancy at birth is a statistical average, not a prediction for any individual." } },
    { "@@type": "Question", "name": "How is life expectancy calculated?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Life expectancy is calculated from life tables — statistical tables that track the probability of dying at each age within a population. Demographers use current mortality rates by age and sex to project how long a newborn would live if those rates held throughout their life. Because mortality rates improve over time, actual lifespan often exceeds the life expectancy figure at birth." } },
    { "@@type": "Question", "name": "Does life expectancy differ between men and women?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes — women live longer than men in virtually every country. Globally, women outlive men by an average of 4–5 years. In some countries (Russia, for example), the gap exceeds 10 years. Biological factors include oestrogen's protective effect on cardiovascular health and men's higher rates of risk-taking behaviour. The calculator adjusts life expectancy by sex when you select your sex, using country-specific data." } },
    { "@@type": "Question", "name": "Which country has the highest life expectancy?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Japan consistently ranks among the highest globally at approximately 83.7 years overall (2024 WHO data). Switzerland, South Korea, Australia, and Spain also rank in the top 10. The longest-lived populations share common factors: Mediterranean or traditional diets, high social cohesion, universal healthcare, low obesity rates, and — particularly in Japan — ikigai (sense of purpose in daily life)." } },
    { "@@type": "Question", "name": "Can I increase my life expectancy?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Research suggests lifestyle factors account for roughly 25% of lifespan variation (genetics determines the rest). Evidence-backed behaviours that extend life: not smoking (adds 10+ years), maintaining a healthy weight (reduces cardiovascular mortality significantly), regular physical activity (150+ minutes moderate exercise/week), strong social connections, adequate sleep (7–9 hours), and avoiding excessive alcohol. The impact compounds over decades rather than showing up immediately." } }
  ]
}
</script>
@endsection

@php
$faqs = [
  ['q' => 'What is life expectancy?',
             'a' => 'Life expectancy is the average number of years a person can expect to live based on current age-specific mortality rates in their country. Global average life expectancy is approximately 72.8 years (WHO 2024). It varies significantly by country — Japan averages 83.7 years, while some nations average below 60. Life expectancy is a statistical average, not a prediction for any individual.'],
  ['q' => 'How is life expectancy calculated?',
             'a' => 'Life expectancy is calculated from life tables — demographic tools that track the probability of dying at each age within a population. Demographers use current mortality rates by age and sex to project how long a newborn would live if those rates held throughout their life. Because mortality rates have improved over time, actual lifespan often exceeds the life expectancy figure at birth.'],
  ['q' => 'Does life expectancy differ between men and women?',
             'a' => 'Yes — women outlive men in virtually every country, by an average of 4–5 years globally. Biological factors include oestrogen\'s protective effect on cardiovascular health. Social factors include men\'s higher rates of risk-taking behaviour, occupational hazards, and lower health-seeking rates. The calculator adjusts life expectancy by sex using country-specific data.'],
  ['q' => 'Which country has the highest life expectancy?',
             'a' => 'Japan consistently ranks among the highest globally at approximately 83.7 years (WHO 2024). Switzerland, South Korea, Australia, and Spain also rank in the top 5. The longest-lived populations share common factors: Mediterranean or traditional diets high in fish and vegetables, high social cohesion, universal healthcare access, low obesity rates, and strong cultural purpose in daily life.'],
  ['q' => 'Can I increase my life expectancy?',
             'a' => 'Research suggests lifestyle factors account for roughly 25% of lifespan variation (genetics determines most of the rest). Evidence-backed life-extending behaviours: not smoking (adds 10+ years), maintaining a healthy weight, getting 150+ minutes of moderate exercise per week, cultivating strong social relationships, sleeping 7–9 hours nightly, and avoiding excessive alcohol. These effects compound over decades.'],
  ['q' => '{{ $q }}', 'a' => '{{ $a }}'],
];

$relatedTools = [
  ['icon' => '🎂', 'name' => 'Age Calculator', 'slug' => 'age-calculator', 'desc' => 'Find your exact age in years, months, days, and hours.'],
  ['icon' => '🏖️', 'name' => 'Retirement Calculator', 'slug' => 'retirement-calculator', 'desc' => 'Calculate when you can retire based on savings and contributions.'],
  ['icon' => '📅', 'name' => 'Days Between Dates', 'slug' => 'days-between-dates', 'desc' => 'Count exact days between any two dates.'],
  ['icon' => '⏳', 'name' => 'Days Until', 'slug' => 'days-until-calculator', 'desc' => 'Countdown to any event, holiday, or deadline.'],
  ['icon' => '🤰', 'name' => 'Due Date Calculator', 'slug' => 'due-date-calculator', 'desc' => 'Find your pregnancy due date from LMP or conception.'],
  ['icon' => '🌸', 'name' => 'Ovulation Calculator', 'slug' => 'ovulation-calculator', 'desc' => 'Find your fertile window and best days to conceive.'],
];
@endphp

@section('styles')
<style>
.lp-bar-legend  { font-size:.82rem; color:#888; }
.lp-pct-label   { font-weight:700; color:var(--primary-dark); font-size:.95rem; }
.lp-bar-track   { background:#f0f0f0; border-radius:50px; height:24px; overflow:hidden; box-shadow:inset 0 2px 6px rgba(0,0,0,.06); }
.lp-bar-fill    { height:100%; border-radius:50px; transition:width 1s ease; background:linear-gradient(90deg,#28a745 0%,#fd7e14 60%,#e94560 100%); width:0%; }
.lp-bar-markers { font-size:.72rem; color:#ccc; }
.lp-stat-val    { font-size:1.2rem; font-weight:700; }
.lp-detail-box  { background:#f8f9fa; font-size:.88rem; color:#555; }
.lp-data-num    { font-weight:700; min-width:120px; font-size:.9rem; }
.lp-data-desc   { font-size:.83rem; color:#666; }
.lp-table-sub   { max-width:480px; margin:auto; }
.lp-country-tbl { font-size:.88rem; }
.lp-milestone   { font-size:.82rem; }
.lp-orange      { color:#e97b1e; }
</style>
@endsection

@section('content')

{{-- Hero --}}
<section class="ms-hero">
  <div class="container-xl">
    <div class="row align-items-start g-5">
      <div class="col-lg-7">
        <x-breadcrumb :crumbs="[
          ['url' => route('home'), 'name' => 'Home'],
          ['url' => route('category.life'), 'name' => 'Life Tools'],
          ['url' => '', 'name' => 'Life Percentage Calculator'],
        ]"/>
        <h1 class="mb-2 ms-hero-title">
          ⌛ Life Percentage Calculator — How Much of Your Life Has Passed?
        </h1>
        <p class="ms-hero-desc">
          Find out what percentage of your life has elapsed — and how many days you have remaining — based on your country's life expectancy.
        </p>

        <div class="card border-0 mb-n4 ms-tool-card">
          <div class="card-body p-4 p-md-5">
            <div class="row g-3">
              <div class="col-sm-6">
                <label class="form-label fw-600">Date of Birth</label>
                <input type="date" id="lpDob" class="form-control">
              </div>
              <div class="col-sm-6">
                <label class="form-label fw-600">Sex</label>
                <select id="lpSex" class="form-select">
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                </select>
              </div>
              <div class="col-12">
                <label class="form-label fw-600">Country</label>
                <select id="lpCountry" class="form-select">
                  <option value="73">🌍 Global Average (72.8 yrs)</option>
                  <option value="79">🇺🇸 United States (79 yrs)</option>
                  <option value="81">🇬🇧 United Kingdom (81 yrs)</option>
                  <option value="83">🇦🇺 Australia (83 yrs)</option>
                  <option value="82">🇨🇦 Canada (82 yrs)</option>
                  <option value="84">🇯🇵 Japan (83.7 yrs)</option>
                  <option value="81">🇩🇪 Germany (81 yrs)</option>
                  <option value="82">🇫🇷 France (82 yrs)</option>
                  <option value="83">🇨🇭 Switzerland (83 yrs)</option>
                  <option value="80">🇮🇹 Italy (80 yrs)</option>
                  <option value="80">🇪🇸 Spain (83 yrs)</option>
                  <option value="69">🇮🇳 India (69 yrs)</option>
                  <option value="76">🇧🇷 Brazil (76 yrs)</option>
                  <option value="73">🇨🇳 China (77 yrs)</option>
                  <option value="71">🇲🇽 Mexico (71 yrs)</option>
                  <option value="65">🇵🇰 Pakistan (65 yrs)</option>
                  <option value="custom">✏️ Enter custom life expectancy</option>
                </select>
              </div>
              <div id="lpCustomRow" class="col-12 d-none">
                <label class="form-label fw-600">Custom life expectancy (years)</label>
                <input type="number" id="lpCustomLE" class="form-control" value="80" min="40" max="120">
              </div>
            </div>
            <button class="btn btn-cta w-100 mt-4" onclick="calcLifePercent()">Calculate →</button>

            <div id="lpResults" class="mt-4 d-none">
              <div class="ms-divider"></div>

              {{-- The progress bar — centrepiece --}}
              <div class="mb-4">
                <div class="d-flex justify-content-between mb-2 lp-bar-legend">
                  <span>Birth</span>
                  <span id="lpPctLabel" class="lp-pct-label"></span>
                  <span id="lpLeLabel"></span>
                </div>
                <div class="lp-bar-track">
                  <div id="lpBar" class="lp-bar-fill"></div>
                </div>
                <div class="d-flex justify-content-between mt-1 lp-bar-markers">
                  <span>0%</span><span>25%</span><span>50%</span><span>75%</span><span>100%</span>
                </div>
              </div>

              <div class="row g-3 text-center">
                <div class="col-6 col-sm-3">
                  <div class="ms-stat ms-stat-green">
                    <div id="lpDaysLived" class="lp-stat-val text-green">—</div>
                    <div class="ms-stat-label">Days Lived</div>
                  </div>
                </div>
                <div class="col-6 col-sm-3">
                  <div class="ms-stat ms-stat-orange">
                    <div id="lpDaysLeft" class="lp-stat-val lp-orange">—</div>
                    <div class="ms-stat-label">Days Remaining</div>
                  </div>
                </div>
                <div class="col-6 col-sm-3">
                  <div class="ms-stat ms-stat-purple">
                    <div id="lpYearsLeft" class="lp-stat-val text-life">—</div>
                    <div class="ms-stat-label">Years Remaining</div>
                  </div>
                </div>
                <div class="col-6 col-sm-3">
                  <div class="ms-stat ms-stat-pink">
                    <div id="lpWeeksLeft" class="lp-stat-val text-cta">—</div>
                    <div class="ms-stat-label">Weeks Remaining</div>
                  </div>
                </div>
              </div>
              <div id="lpDetail" class="mt-3 p-3 rounded lp-detail-box"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-5 d-none d-lg-block pt-2">
        <div class="ms-facts-wrap">
          <h3 class="ms-facts-title">Life Expectancy Facts</h3>
          @foreach([
            ['72.8 yrs','Global average life expectancy (WHO 2024)'],
            ['83.7 yrs','Japan — one of the longest-lived nations'],
            ['28,835','Days in an average 79-year life'],
            ['~4,000','Weeks in an average human life'],
            ['31.7 yrs','Age when you reach 1 billion seconds lived'],
          ] as [$stat,$label])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div class="ms-fact-pill ms-fact-pill-life">{{ $stat }}</div>
            <div class="ms-fact-label">{{ $label }}</div>
          </div>
          @endforeach
          <p class="ms-fact-source">Source: WHO Global Health Observatory 2024</p>
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
        <h2 class="mb-4">How Life Expectancy Is Calculated and What It Really Means</h2>
<img src="{{ asset('images/life-percentage-bar.svg') }}" alt="Life percentage bar showing years lived versus expected years remaining" width="640" height="130" loading="lazy" class="img-fluid rounded-3 mb-4">
        <p>Life expectancy at birth is calculated from life tables — demographic tools that track death probabilities at every age within a population. It represents how long someone born today would live if current mortality rates never changed.</p>
        <p>In practice, mortality rates have improved year over year for most of the past century. This means the actual lifespan of today's children will likely exceed the life expectancy figure. As a reference for the calculator, it's most useful as "an average approximation" rather than a personal prediction.</p>
        <p>The calculator adjusts for sex because women outlive men by an average of 4–5 years globally. Select your country and sex to get the most relevant estimate.</p>
      </div>
      <div class="col-lg-7">
        <div class="p-4 rounded-3 ms-data-box">
          <p class="fw-600 mb-3 ms-data-label">Life in numbers — an average 79-year life</p>
          @foreach([
            ['28,835 days','Total days in a 79-year life'],
            ['4,119 weeks','Weeks — a humbling number to see'],
            ['692,040 hours','Hours of life available'],
            ['11 years','Time spent at work (average career)'],
            ['26 years','Time spent sleeping (33% of life)'],
            ['4.5 years','Time spent eating and drinking'],
            ['31.7 years','Age when you hit 1 billion seconds lived'],
          ] as [$n,$l])
          <div class="d-flex align-items-center gap-3 mb-2">
            <div class="lp-data-num text-life">{{ $n }}</div>
            <div class="lp-data-desc">{{ $l }}</div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Life expectancy table --}}
<section class="ms-section-muted">
  <div class="container-xl">
    <div class="text-center mb-5">
      <h2>Life Expectancy by Country</h2>
      <p class="text-muted lp-table-sub">Top countries and global average — WHO 2024 estimates.</p>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="table-responsive">
          <table class="table table-bordered lp-country-tbl">
            <thead class="ms-table-head">
              <tr><th>#</th><th>Country</th><th>Overall</th><th>Male</th><th>Female</th></tr>
            </thead>
            <tbody>
              @foreach([
                [1,'🇯🇵 Japan','83.7','80.5','86.9'],
                [2,'🇨🇭 Switzerland','83.4','81.1','85.6'],
                [3,'🇰🇷 South Korea','83.3','80.3','86.1'],
                [4,'🇦🇺 Australia','83.2','81.3','85.1'],
                [5,'🇪🇸 Spain','83.2','80.5','86.0'],
                [6,'🇮🇹 Italy','82.9','80.5','85.2'],
                [7,'🇫🇷 France','82.3','79.4','85.2'],
                [8,'🇨🇦 Canada','82.3','80.2','84.4'],
                [9,'🇬🇧 United Kingdom','81.0','79.0','83.0'],
                [10,'🇩🇪 Germany','81.0','78.5','83.4'],
                [11,'🇺🇸 United States','78.8','76.1','81.4'],
                [12,'🇨🇳 China','77.1','74.7','79.8'],
                [13,'🇧🇷 Brazil','75.9','72.4','79.4'],
                [14,'🇮🇳 India','69.4','68.2','70.7'],
                ['—','🌍 Global Average','72.8','70.4','75.2'],
              ] as [$rank,$country,$overall,$male,$female])
              <tr>
                <td class="text-muted">{{ $rank }}</td>
                <td>{{ $country }}</td>
                <td class="fw-600 text-life">{{ $overall }}</td>
                <td>{{ $male }}</td>
                <td>{{ $female }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="lpFaq" />


{{-- Long-tail --}}
<section class="ms-section-accent">
  <div class="container ms-longtail">
    <h2 class="mb-4 text-brand">Life Expectancy by Country — Which Nations Live the Longest?</h2>
    <p>Japan leads global life expectancy rankings largely due to a combination of diet (fish, vegetables, minimal processed food), social cohesion (strong community bonds reduce chronic stress), universal healthcare with high utilisation rates, and the cultural concept of ikigai — a sense of purpose and reason to get up in the morning. The island of Okinawa is particularly studied as a "Blue Zone" where an unusually high proportion of people live past 100.</p>
    <p>The gap between the longest and shortest-lived nations exceeds 25 years — a difference entirely attributable to socioeconomic factors, healthcare access, diet, and environment, not genetics.</p>

    <h2 class="mt-5 mb-4 text-brand">How Many Days Have I Been Alive? — The Perspective Behind the Number</h2>
    <p>At 30 years old, you've been alive for approximately 10,957 days. At 40, approximately 14,610. These numbers sound large until you consider the total: an 80-year life is only 29,200 days. Seeing your life in days rather than years gives a different kind of clarity — the average human year contains 365 days, most of which are fairly ordinary. The proportion of truly memorable days is much smaller. This perspective is what tools like this calculator (and the concept of memento mori in Stoic philosophy) aim to make viscerally real.</p>

    <h2 class="mt-5 mb-4 text-brand">How Lifestyle Choices Affect Life Expectancy — What the Research Says</h2>
    <p>A landmark 2018 study published in Circulation (Harvard School of Public Health) found that five lifestyle factors add an average of 14 years to a woman's life and 12 years to a man's life: never smoking, maintaining a healthy BMI (18.5–24.9), at least 30 minutes of moderate activity per day, moderate alcohol consumption (if any), and a high-quality diet. The combined effect of all five factors was dramatically larger than any single factor alone — suggesting that lifestyle changes compound over time rather than simply adding years linearly.</p>
  </div>
</section>

<x-related-tools :tools="$relatedTools" heading="More Life Calculators" />


@endsection

@section('scripts')
<script>
(function () {
  document.getElementById('lpCountry').addEventListener('change', function () {
    document.getElementById('lpCustomRow').classList.toggle('d-none', this.value !== 'custom');
  });

  // Set default DOB to 30 years ago
  var dob30 = new Date();
  dob30.setFullYear(dob30.getFullYear() - 30);
  document.getElementById('lpDob').value = dob30.toISOString().substring(0, 10);

  window.calcLifePercent = function () {
    var dobVal  = document.getElementById('lpDob').value;
    var sex     = document.getElementById('lpSex').value;
    var country = document.getElementById('lpCountry').value;

    if (!dobVal) return;

    var baseLE = country === 'custom'
      ? parseFloat(document.getElementById('lpCustomLE').value) || 80
      : parseInt(country);

    // Sex adjustment: women +4 years, men -0
    var le = sex === 'female' ? baseLE + 4 : baseLE;

    var dob  = new Date(dobVal + 'T00:00:00');
    var now  = new Date();
    var daysLived = Math.floor((now - dob) / 86400000);
    var totalDays = Math.floor(le * 365.25);
    var daysLeft  = Math.max(0, totalDays - daysLived);
    var yearsLeft = (daysLeft / 365.25).toFixed(1);
    var weeksLeft = Math.floor(daysLeft / 7).toLocaleString();
    var pct       = Math.min(100, (daysLived / totalDays * 100));
    var pctDisplay = pct.toFixed(1);

    var ageYears = (daysLived / 365.25).toFixed(1);

    // Milestones
    var milestones = [];
    var billion1 = new Date(dob.getTime() + 1000000000 * 1000);
    var billion2 = new Date(dob.getTime() + 2000000000 * 1000);
    if (billion1 > now) milestones.push('1 billion seconds on ' + billion1.toDateString() + ' (age ~31.7)');
    if (billion2 > now) milestones.push('2 billion seconds on ' + billion2.toDateString() + ' (age ~63.4)');

    // Generation
    var birthYear = dob.getFullYear();
    var gen = birthYear >= 2013 ? 'Generation Alpha'
            : birthYear >= 1997 ? 'Generation Z'
            : birthYear >= 1981 ? 'Millennial'
            : birthYear >= 1965 ? 'Generation X'
            : birthYear >= 1946 ? 'Baby Boomer'
            : 'Silent Generation';

    document.getElementById('lpDaysLived').textContent = daysLived.toLocaleString();
    document.getElementById('lpDaysLeft').textContent  = daysLeft.toLocaleString();
    document.getElementById('lpYearsLeft').textContent = yearsLeft + ' yrs';
    document.getElementById('lpWeeksLeft').textContent = weeksLeft + ' wks';
    document.getElementById('lpPctLabel').textContent  = pctDisplay + '% of life lived';
    document.getElementById('lpLeLabel').textContent   = le + ' yr life expectancy';

    // Animate bar
    setTimeout(function () {
      document.getElementById('lpBar').style.width = pctDisplay + '%';
    }, 100);

    var detailHtml = '<strong>Age: ' + ageYears + ' years</strong> · Generation: ' + gen + '<br>'
      + 'Life expectancy used: ' + le + ' years (' + (sex === 'female' ? 'female +4yr' : 'male base') + ')<br>'
      + daysLived.toLocaleString() + ' days lived · ' + daysLeft.toLocaleString() + ' days remaining<br>';
    if (milestones.length > 0) {
      detailHtml += '<span class="text-life lp-milestone">Upcoming: ' + milestones.join(' | ') + '</span>';
    }

    document.getElementById('lpDetail').innerHTML = detailHtml;
    document.getElementById('lpResults').classList.remove('d-none');
    document.getElementById('lpResults').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  };
})();
</script>
@endsection
