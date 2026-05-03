@extends('layouts.app')

@section('title', 'Free Sleep Calculators & Tools — Bedtime, Cycles & Sleep Schedule | MindSnap')
@section('description', 'Free sleep calculators for bedtime, wake-up times, nap schedules, sleep debt, jet lag, caffeine cut-off, and baby sleep. Based on 90-minute sleep cycles. No signup.')
@section('canonical', config('app.url') . '/sleep-tools')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@graph": [
    {
      "@@type": "CollectionPage",
      "@@id": "{{ config('app.url') }}/sleep-tools#collection",
      "url": "{{ config('app.url') }}/sleep-tools",
      "name": "Free Sleep Calculators & Tools",
      "description": "Free sleep tools including sleep cycle calculator, wake-up calculator, nap calculator, sleep debt, jet lag, and caffeine calculators.",
      "inLanguage": "en",
      "publisher": { "@@type": "Organization", "name": "MindSnap", "url": "{{ config('app.url') }}" },
      "hasPart": [
        { "@@type": "WebApplication", "name": "Sleep Calculator", "url": "{{ config('app.url') }}/sleep-calculator", "applicationCategory": "HealthApplication" },
        { "@@type": "WebApplication", "name": "Wake-Up Calculator", "url": "{{ config('app.url') }}/wake-up-calculator", "applicationCategory": "HealthApplication" },
        { "@@type": "WebApplication", "name": "Nap Calculator", "url": "{{ config('app.url') }}/nap-calculator", "applicationCategory": "HealthApplication" },
        { "@@type": "WebApplication", "name": "Sleep Debt Calculator", "url": "{{ config('app.url') }}/sleep-debt-calculator", "applicationCategory": "HealthApplication" },
        { "@@type": "WebApplication", "name": "Caffeine Calculator", "url": "{{ config('app.url') }}/caffeine-sleep-calculator", "applicationCategory": "HealthApplication" },
        { "@@type": "WebApplication", "name": "Jet Lag Calculator", "url": "{{ config('app.url') }}/jet-lag-calculator", "applicationCategory": "HealthApplication" }
      ]
    },
    {
      "@@type": "BreadcrumbList",
      "itemListElement": [
        { "@@type": "ListItem", "position": 1, "name": "Home", "item": "{{ config('app.url') }}" },
        { "@@type": "ListItem", "position": 2, "name": "Sleep Tools", "item": "{{ config('app.url') }}/sleep-tools" }
      ]
    },
    {
      "@@type": "FAQPage",
      "mainEntity": [
        {
          "@@type": "Question",
          "name": "What time should I go to sleep?",
          "acceptedAnswer": { "@@type": "Answer", "text": "The best bedtime depends on your wake-up time. Sleep works in 90-minute cycles, so aim to wake up at the end of a cycle. For a 7am wake-up, ideal bedtimes are 9:30pm (6 cycles), 11:00pm (5 cycles), or 12:30am (4 cycles). Use our Sleep Calculator to find your exact bedtime." }
        },
        {
          "@@type": "Question",
          "name": "How many hours of sleep do I need?",
          "acceptedAnswer": { "@@type": "Answer", "text": "Adults aged 18–64 need 7–9 hours per night. Teenagers need 8–10 hours. Children aged 6–12 need 9–12 hours. Older adults (65+) need 7–8 hours. These are recommendations from the National Sleep Foundation." }
        },
        {
          "@@type": "Question",
          "name": "What is a sleep cycle?",
          "acceptedAnswer": { "@@type": "Answer", "text": "A sleep cycle lasts approximately 90 minutes and includes light sleep, deep sleep (slow-wave), and REM sleep. Waking up mid-cycle causes grogginess called sleep inertia. Most people complete 4–6 cycles per night." }
        },
        {
          "@@type": "Question",
          "name": "How do I reduce sleep debt?",
          "acceptedAnswer": { "@@type": "Answer", "text": "You can repay sleep debt by sleeping an extra 1–2 hours per night over several days. Avoid trying to catch up all at once on weekends — this disrupts your circadian rhythm. Our Sleep Debt Calculator shows exactly how many hours you need to recover." }
        }
      ]
    }
  ]
}
</script>
@endsection

@section('content')

{{-- ── Breadcrumb ──────────────────────────────────────────────────────────── --}}
<nav aria-label="Breadcrumb" style="background:#f0f2f5; padding:10px 0; border-bottom:1px solid var(--border);">
  <div class="container-xl">
    <ol class="breadcrumb mb-0" style="font-size:.84rem;">
      <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:var(--primary-cta);">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page" style="color:var(--text-muted);">Sleep Tools</li>
    </ol>
  </div>
</nav>

{{-- ── Hero ────────────────────────────────────────────────────────────────── --}}
<section style="background:linear-gradient(135deg,#1a1a2e 0%,#16213e 50%,#0f3460 100%); padding:64px 0 48px;">
  <div class="container-xl">
    <div class="row align-items-center g-4">
      <div class="col-lg-8">
        <div class="d-flex align-items-center gap-3 mb-3">
          <span style="font-size:2.8rem; line-height:1;">😴</span>
          <span class="badge" style="background:rgba(108,99,255,.2); color:#a99cff; border:1px solid rgba(108,99,255,.4); border-radius:50px; font-size:.8rem; padding:5px 14px;">Sleep Tools</span>
        </div>
        <h1 style="color:#fff; margin-bottom:16px;">Free Sleep Calculators & Tools</h1>
        <p style="color:rgba(255,255,255,.75); font-size:1.1rem; line-height:1.7; max-width:620px; margin-bottom:24px;">
          Find your ideal bedtime, wake-up time, and sleep schedule using science-backed 90-minute sleep cycle calculations.
          8 free tools — no signup, no ads, works on any device.
        </p>
        <div class="d-flex flex-wrap gap-3">
          <div class="d-flex align-items-center gap-2" style="color:rgba(255,255,255,.65); font-size:.88rem;">
            <svg width="16" height="16" fill="none" stroke="#6c63ff" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            Based on 90-min sleep cycles
          </div>
          <div class="d-flex align-items-center gap-2" style="color:rgba(255,255,255,.65); font-size:.88rem;">
            <svg width="16" height="16" fill="none" stroke="#6c63ff" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            Instant results
          </div>
          <div class="d-flex align-items-center gap-2" style="color:rgba(255,255,255,.65); font-size:.88rem;">
            <svg width="16" height="16" fill="none" stroke="#6c63ff" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            100% free, no signup
          </div>
        </div>
      </div>
      <div class="col-lg-4 d-none d-lg-flex justify-content-end">
        <div style="background:rgba(108,99,255,.12); border:1px solid rgba(108,99,255,.25); border-radius:16px; padding:28px 32px; text-align:center;">
          <div style="font-size:3rem; margin-bottom:8px;">8</div>
          <div style="color:rgba(255,255,255,.7); font-size:.9rem;">Sleep Tools</div>
          <div style="height:1px; background:rgba(255,255,255,.1); margin:14px 0;"></div>
          <div style="font-size:1.6rem; margin-bottom:4px;">2.2M+</div>
          <div style="color:rgba(255,255,255,.7); font-size:.9rem;">Monthly searches</div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ── Tools Grid ──────────────────────────────────────────────────────────── --}}
<section style="padding:56px 0;">
  <div class="container-xl">

    <div class="d-flex align-items-center justify-content-between mb-4">
      <h2 style="font-size:1.5rem; margin:0;">All Sleep Tools</h2>
      <span style="color:var(--text-muted); font-size:.88rem;">{{ count($tools) }} tools</span>
    </div>

    @if(count($tools))
    <div class="row g-4">
      @foreach($tools as $tool)
      <div class="col-sm-6 col-lg-4">
        <a href="/{{ $tool['slug'] }}" class="tool-card d-block p-4 h-100 text-decoration-none"
           style="border-left:4px solid #6c63ff;">
          <div class="d-flex align-items-start gap-3">
            <span style="font-size:2rem; line-height:1; flex-shrink:0;">{{ $tool['icon'] ?? '😴' }}</span>
            <div style="min-width:0;">
              <div style="font-weight:700; color:var(--primary-dark); font-size:.95rem; margin-bottom:4px;">{{ $tool['name'] }}</div>
              <div style="font-size:.83rem; color:var(--text-muted); line-height:1.5;">{{ $tool['description'] }}</div>
              @if(!empty($tool['monthly_searches']) && $tool['monthly_searches'] > 0)
              <div class="mt-2">
                <span class="badge-searches">{{ number_format($tool['monthly_searches'] / 1000) }}K searches/mo</span>
              </div>
              @endif
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
    @else
    {{-- Fallback hardcoded list if DB not seeded --}}
    <div class="row g-4">
      @foreach([
        ['😴','Sleep Calculator','/sleep-calculator','Find your ideal bedtime based on 90-minute sleep cycles.','2,200K'],
        ['⏰','Wake-Up Calculator','/wake-up-calculator','Get the best times to wake up feeling fully rested.','480K'],
        ['💤','Nap Calculator','/nap-calculator','Find the perfect nap length to boost alertness without grogginess.','90K'],
        ['👶','Baby Sleep Calculator','/baby-sleep-calculator','Build a sleep schedule for your newborn or infant.','74K'],
        ['📉','Sleep Debt Calculator','/sleep-debt-calculator','See how many hours of sleep you owe your body.','40K'],
        ['☕','Caffeine Calculator','/caffeine-sleep-calculator','Find the latest time you should have coffee today.','60K'],
        ['✈️','Jet Lag Calculator','/jet-lag-calculator','Get a recovery plan for your timezone change.','33K'],
        ['🌙','Sleep Quality Quiz','/sleep-quality-quiz','Rate your sleep quality with 10 science-based questions.','22K'],
      ] as [$icon,$name,$slug,$desc,$searches])
      <div class="col-sm-6 col-lg-4">
        <a href="{{ $slug }}" class="tool-card d-block p-4 h-100 text-decoration-none"
           style="border-left:4px solid #6c63ff;">
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

{{-- ── Why Sleep Matters ───────────────────────────────────────────────────── --}}
<section style="padding:56px 0; background:#fff;">
  <div class="container-xl">
    <div class="row g-5 align-items-center">
      <div class="col-lg-6">
        <h2>Why Sleep Cycles Matter</h2>
        <p style="color:var(--text); line-height:1.8; margin-bottom:16px;">
          Sleep is not one long block — it's a series of 90-minute cycles, each containing light sleep, deep (slow-wave) sleep, and REM sleep.
          Waking up mid-cycle causes <strong>sleep inertia</strong> — the groggy, disoriented feeling that can last for hours.
        </p>
        <p style="color:var(--text); line-height:1.8; margin-bottom:16px;">
          Our sleep calculators align your schedule to natural cycle boundaries so you wake at the lightest sleep stage,
          feeling alert and refreshed — even if you slept fewer total hours.
        </p>
        <a href="/sleep-calculator" class="btn btn-cta" style="font-size:.95rem;">
          Try the Sleep Calculator →
        </a>
      </div>
      <div class="col-lg-6">
        <div class="row g-3">
          @foreach([
            ['😴','7–9 hours','Recommended for adults per night'],
            ['🔄','90 min','Length of one sleep cycle'],
            ['🌙','4–6 cycles','Ideal number of cycles per night'],
            ['⚡','20 min','Perfect nap length for alertness'],
          ] as [$icon,$stat,$label])
          <div class="col-6">
            <div class="tool-card p-4 text-center h-100">
              <div style="font-size:1.8rem; margin-bottom:8px;">{{ $icon }}</div>
              <div style="font-weight:800; font-size:1.3rem; color:var(--primary-dark);">{{ $stat }}</div>
              <div style="font-size:.8rem; color:var(--text-muted); margin-top:4px;">{{ $label }}</div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ── FAQ ─────────────────────────────────────────────────────────────────── --}}
<section style="padding:56px 0;">
  <div class="container-xl">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <h2 class="text-center mb-5">Frequently Asked Questions</h2>

        <div class="accordion" id="sleepFaq">
          @foreach([
            ['What time should I go to sleep?',
             'The best bedtime depends on your wake-up time. For a <strong>7:00am</strong> wake-up, ideal bedtimes are <strong>9:30pm</strong> (6 cycles / 9h), <strong>11:00pm</strong> (5 cycles / 7.5h), or <strong>12:30am</strong> (4 cycles / 6h). Use our <a href="/sleep-calculator">Sleep Calculator</a> to find your exact bedtime.'],
            ['How many hours of sleep do I need?',
             'Adults aged 18–64 need <strong>7–9 hours</strong>. Teenagers need 8–10 hours. Children (6–12) need 9–12 hours. Older adults (65+) need 7–8 hours. Quality matters as much as quantity — completing full sleep cycles prevents morning grogginess.'],
            ['What is a sleep cycle and why does it matter?',
             'A sleep cycle lasts ~90 minutes and moves through light sleep → deep sleep (slow-wave) → REM sleep. Waking mid-cycle triggers sleep inertia. Timing your alarm to the end of a cycle — using a <a href="/sleep-calculator">sleep calculator</a> — means waking at the lightest stage.'],
            ['How do I fix my sleep schedule?',
             'Go to bed and wake at the same time every day, including weekends. Avoid screens 60 minutes before bed. Keep your room cool (65–68°F / 18–20°C) and dark. Cut caffeine after 2pm. Use our <a href="/caffeine-sleep-calculator">Caffeine Calculator</a> to find your personal cut-off time.'],
            ['How do I recover from jet lag?',
             'On the day of travel, adjust your watch to the destination timezone immediately. Use our <a href="/jet-lag-calculator">Jet Lag Calculator</a> for a personalized recovery plan. Expose yourself to natural light in the morning at your destination and avoid napping over 20 minutes.'],
          ] as $i => [$q, $a])
          <div class="accordion-item" style="border:1px solid var(--border); border-radius:10px !important; margin-bottom:10px; overflow:hidden;">
            <h3 class="accordion-header">
              <button class="accordion-button {{ $i > 0 ? 'collapsed' : '' }}" type="button"
                      data-bs-toggle="collapse" data-bs-target="#sleepFaq{{ $i }}"
                      style="font-weight:600; font-size:.95rem; background:transparent; color:var(--primary-dark);">
                {{ $q }}
              </button>
            </h3>
            <div id="sleepFaq{{ $i }}" class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}" data-bs-parent="#sleepFaq">
              <div class="accordion-body" style="font-size:.92rem; line-height:1.8; color:var(--text);">
                {!! $a !!}
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ── Related Categories ───────────────────────────────────────────────────── --}}
<section style="padding:40px 0 64px; background:#f8f9fa;">
  <div class="container-xl">
    <h2 class="mb-4" style="font-size:1.3rem;">Explore More Tools</h2>
    <div class="row g-3">
      @foreach([
        ['💪','Fitness Tools','/fitness-tools','BMI, calories, macros & more','#28a745'],
        ['🥗','Nutrition Tools','/nutrition-tools','Water intake & fasting','#fd7e14'],
        ['🧠','Brain Quizzes','/quizzes','IQ test, GK quiz & more','#e94560'],
        ['⏰','Life Tools','/life-tools','Age, dates & life calculators','#6f42c1'],
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
