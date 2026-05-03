@extends('layouts.app')

@section('title', 'Free Life Calculators — Age, Date, Pregnancy & Retirement | MindSnap')
@section('description', 'Free life calculators: exact age calculator, days between dates, due date, ovulation, retirement countdown, days until any event, and life percentage lived. Instant results.')
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
        { "@@type": "ListItem", "position": 1, "name": "Home", "item": "{{ config('app.url') }}" },
        { "@@type": "ListItem", "position": 2, "name": "Life Tools", "item": "{{ config('app.url') }}/life-tools" }
      ]
    },
    {
      "@@type": "FAQPage",
      "mainEntity": [
        {
          "@@type": "Question",
          "name": "How do I calculate my exact age?",
          "acceptedAnswer": { "@@type": "Answer", "text": "Enter your date of birth into our Age Calculator and get your exact age in years, months, weeks, days, hours, and even minutes. It accounts for leap years and time zones automatically." }
        },
        {
          "@@type": "Question",
          "name": "How do I calculate my due date?",
          "acceptedAnswer": { "@@type": "Answer", "text": "Enter the date of your last menstrual period (LMP) into our Due Date Calculator. It adds 280 days (40 weeks) to give your estimated due date. Also shows your current trimester and how many weeks along you are." }
        },
        {
          "@@type": "Question",
          "name": "What percentage of my life have I lived?",
          "acceptedAnswer": { "@@type": "Answer", "text": "Our Life Percentage Calculator divides your current age by the average life expectancy for your country and gender. It gives you a sobering (or motivating!) percentage of life lived and how many days you statistically have remaining." }
        }
      ]
    }
  ]
}
</script>
@endsection

@section('content')

<nav aria-label="Breadcrumb" style="background:#f0f2f5; padding:10px 0; border-bottom:1px solid var(--border);">
  <div class="container-xl">
    <ol class="breadcrumb mb-0" style="font-size:.84rem;">
      <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:var(--primary-cta);">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page" style="color:var(--text-muted);">Life Tools</li>
    </ol>
  </div>
</nav>

{{-- Hero --}}
<section style="background:linear-gradient(135deg,#1a1a2e 0%,#16213e 50%,#0f3460 100%); padding:64px 0 48px;">
  <div class="container-xl">
    <div class="row align-items-center g-4">
      <div class="col-lg-8">
        <div class="d-flex align-items-center gap-3 mb-3">
          <span style="font-size:2.8rem; line-height:1;">⏰</span>
          <span class="badge" style="background:rgba(111,66,193,.2); color:#c9a8f5; border:1px solid rgba(111,66,193,.4); border-radius:50px; font-size:.8rem; padding:5px 14px;">Life Tools</span>
        </div>
        <h1 style="color:#fff; margin-bottom:16px;">Free Life Calculators</h1>
        <p style="color:rgba(255,255,255,.75); font-size:1.1rem; line-height:1.7; max-width:620px; margin-bottom:24px;">
          Calculate your exact age, days between any two dates, pregnancy due date, ovulation window, retirement countdown, and more.
          7 free tools — instant results, no signup.
        </p>
        <div class="d-flex flex-wrap gap-3">
          <div class="d-flex align-items-center gap-2" style="color:rgba(255,255,255,.65); font-size:.88rem;">
            <svg width="16" height="16" fill="none" stroke="#6f42c1" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            Accurate to the day
          </div>
          <div class="d-flex align-items-center gap-2" style="color:rgba(255,255,255,.65); font-size:.88rem;">
            <svg width="16" height="16" fill="none" stroke="#6f42c1" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            Leap year aware
          </div>
          <div class="d-flex align-items-center gap-2" style="color:rgba(255,255,255,.65); font-size:.88rem;">
            <svg width="16" height="16" fill="none" stroke="#6f42c1" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            100% free, no signup
          </div>
        </div>
      </div>
      <div class="col-lg-4 d-none d-lg-flex justify-content-end">
        <div style="background:rgba(111,66,193,.12); border:1px solid rgba(111,66,193,.25); border-radius:16px; padding:28px 32px; text-align:center;">
          <div style="font-size:3rem; margin-bottom:8px;">7</div>
          <div style="color:rgba(255,255,255,.7); font-size:.9rem;">Life Tools</div>
          <div style="height:1px; background:rgba(255,255,255,.1); margin:14px 0;"></div>
          <div style="font-size:1.6rem; margin-bottom:4px;">4.4M+</div>
          <div style="color:rgba(255,255,255,.7); font-size:.9rem;">Monthly searches</div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Tools Grid --}}
<section style="padding:56px 0;">
  <div class="container-xl">
    <div class="d-flex align-items-center justify-content-between mb-4">
      <h2 style="font-size:1.5rem; margin:0;">All Life Calculators</h2>
      <span style="color:var(--text-muted); font-size:.88rem;">{{ count($tools) ?: 7 }} tools</span>
    </div>

    @if(count($tools))
    <div class="row g-4">
      @foreach($tools as $tool)
      <div class="col-sm-6 col-lg-4">
        <a href="/{{ $tool['slug'] }}" class="tool-card d-block p-4 h-100 text-decoration-none"
           style="border-left:4px solid #6f42c1;">
          <div class="d-flex align-items-start gap-3">
            <span style="font-size:2rem; line-height:1; flex-shrink:0;">{{ $tool['icon'] ?? '⏰' }}</span>
            <div style="min-width:0;">
              <div style="font-weight:700; color:var(--primary-dark); font-size:.95rem; margin-bottom:4px;">{{ $tool['name'] }}</div>
              <div style="font-size:.83rem; color:var(--text-muted); line-height:1.5;">{{ $tool['description'] }}</div>
              @if(!empty($tool['monthly_searches']) && $tool['monthly_searches'] > 0)
              <div class="mt-2"><span class="badge-searches">{{ number_format($tool['monthly_searches'] / 1000) }}K searches/mo</span></div>
              @endif
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
    @else
    <div class="row g-4">
      @foreach([
        ['🎂','Age Calculator','/age-calculator','Exact age in years, months, weeks, days & hours.','4,400K'],
        ['📅','Days Between Dates','/days-between-dates','Count exact days, weeks, and months between any two dates.','301K'],
        ['⏳','Days Until Calculator','/days-until-calculator','Countdown to birthdays, holidays, events, or deadlines.','74K'],
        ['🤰','Due Date Calculator','/due-date-calculator','Pregnancy due date and trimester from your last period.','201K'],
        ['🌸','Ovulation Calculator','/ovulation-calculator','Fertile window and ovulation day from your cycle length.','368K'],
        ['🏖️','Retirement Countdown','/retirement-calculator','Days, months, and years until your retirement date.','40K'],
        ['⌛','Life Percentage Calculator','/life-percentage-calculator','See what % of your expected life you\'ve lived so far.','22K'],
      ] as [$icon,$name,$slug,$desc,$searches])
      <div class="col-sm-6 col-lg-4">
        <a href="{{ $slug }}" class="tool-card d-block p-4 h-100 text-decoration-none"
           style="border-left:4px solid #6f42c1;">
          <div class="d-flex align-items-start gap-3">
            <span style="font-size:2rem; line-height:1; flex-shrink:0;">{{ $icon }}</span>
            <div>
              <div style="font-weight:700; color:var(--primary-dark); font-size:.95rem; margin-bottom:4px;">{{ $name }}</div>
              <div style="font-size:.83rem; color:var(--text-muted); line-height:1.5;">{{ $desc }}</div>
              <div class="mt-2"><span class="badge-searches">{{ $searches }} searches/mo</span></div>
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
    @endif
  </div>
</section>

{{-- FAQ --}}
<section style="padding:56px 0; background:#fff;">
  <div class="container-xl">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <h2 class="text-center mb-5">Frequently Asked Questions</h2>
        <div class="accordion" id="lifeFaq">
          @foreach([
            ['How do I calculate my exact age?',
             'Enter your date of birth in our <a href="/age-calculator">Age Calculator</a> to get your exact age in years, months, weeks, days, and hours. It automatically accounts for leap years and the current date.'],
            ['How is a pregnancy due date calculated?',
             'The standard method adds <strong>280 days (40 weeks)</strong> to the first day of your last menstrual period (LMP). Our <a href="/due-date-calculator">Due Date Calculator</a> also shows your current trimester and weeks of gestation.'],
            ['When is my fertile window?',
             'Ovulation typically occurs <strong>14 days before your next period</strong>. The fertile window is 5 days before ovulation plus the day of ovulation itself. Enter your cycle length and period start date in our <a href="/ovulation-calculator">Ovulation Calculator</a> to get your exact fertile window.'],
            ['How do I count the days between two dates?',
             'Enter any two dates in our <a href="/days-between-dates">Days Between Dates</a> calculator to get the exact count of days, weeks, months, and years between them. Perfect for anniversaries, contracts, and deadlines.'],
            ['What does the Life Percentage Calculator show?',
             'It divides your current age by the statistical life expectancy for your country and gender to show what percentage of your expected lifespan you\'ve lived — and how many days remain. It\'s a powerful perspective tool. Try the <a href="/life-percentage-calculator">Life Percentage Calculator</a>.'],
          ] as $i => [$q,$a])
          <div class="accordion-item" style="border:1px solid var(--border); border-radius:10px !important; margin-bottom:10px; overflow:hidden;">
            <h3 class="accordion-header">
              <button class="accordion-button {{ $i > 0 ? 'collapsed' : '' }}" type="button"
                      data-bs-toggle="collapse" data-bs-target="#lFaq{{ $i }}"
                      style="font-weight:600; font-size:.95rem; background:transparent; color:var(--primary-dark);">
                {{ $q }}
              </button>
            </h3>
            <div id="lFaq{{ $i }}" class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}" data-bs-parent="#lifeFaq">
              <div class="accordion-body" style="font-size:.92rem; line-height:1.8; color:var(--text);">{!! $a !!}</div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Related --}}
<section style="padding:40px 0 64px; background:#f8f9fa;">
  <div class="container-xl">
    <h2 class="mb-4" style="font-size:1.3rem;">Explore More Tools</h2>
    <div class="row g-3">
      @foreach([
        ['😴','Sleep Tools','/sleep-tools','Bedtime & sleep cycle calculators','#6c63ff'],
        ['💪','Fitness Tools','/fitness-tools','BMI, calories & macro calculators','#28a745'],
        ['🥗','Nutrition Tools','/nutrition-tools','Water intake & fasting schedule','#fd7e14'],
        ['🧠','Brain Quizzes','/quizzes','IQ test & knowledge quizzes','#e94560'],
      ] as [$icon,$label,$slug,$desc,$color])
      <div class="col-sm-6 col-lg-3">
        <a href="{{ $slug }}" class="tool-card d-flex align-items-center gap-3 p-3 text-decoration-none h-100">
          <span style="font-size:1.8rem; line-height:1; flex-shrink:0;">{{ $icon }}</span>
          <div>
            <div style="font-weight:700; color:var(--primary-dark); font-size:.9rem;">{{ $label }}</div>
            <div style="font-size:.78rem; color:var(--text-muted);">{{ $desc }}</div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
  </div>
</section>

@endsection
