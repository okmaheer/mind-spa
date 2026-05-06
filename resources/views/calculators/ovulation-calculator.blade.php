@extends('layouts.app')

@section('title', 'Ovulation Calculator — Fertile Window & Best Days to Conceive | MindSnap')
@section('description', 'Free ovulation calculator: enter your last period date and cycle length to find your fertile window, ovulation day, and best days to conceive. No signup.')
@section('canonical', config('app.url') . '/ovulation-calculator')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "WebApplication",
  "name": "Ovulation Calculator",
  "url": "{{ config('app.url') }}/ovulation-calculator",
  "description": "Find your fertile window, ovulation day, and best days to conceive based on your last period date and average cycle length.",
  "applicationCategory": "HealthApplication",
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
    { "@@type": "ListItem", "position": 3, "name": "Ovulation Calculator" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [
    { "@@type": "Question", "name": "When do I ovulate?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Ovulation typically occurs about 14 days before your next expected period, regardless of your cycle length. For a standard 28-day cycle, this is around day 14. For a 35-day cycle, ovulation would typically occur around day 21. This 14-day gap is called the luteal phase and is relatively consistent across women (12–16 days). The follicular phase (from period to ovulation) is what varies most between individuals and cycle lengths." } },
    { "@@type": "Question", "name": "How is ovulation day calculated?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Ovulation day is estimated by subtracting 14 days from the expected length of your cycle. For a 28-day cycle: day 14. For a 30-day cycle: day 16. For a 35-day cycle: day 21. This is because the luteal phase (from ovulation to period) is approximately 14 days for most women. The formula is: Ovulation Day = Cycle Length − 14. This gives you the day of your cycle on which ovulation is most likely to occur." } },
    { "@@type": "Question", "name": "What is the fertile window?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The fertile window is the 6-day period during which conception is possible. It spans 5 days before ovulation and the day of ovulation itself. This window exists because sperm can survive in the female reproductive tract for up to 5 days in fertile cervical mucus, while the egg survives for only 12–24 hours after ovulation. The highest probability days for conception are the 2 days immediately before ovulation and the day of ovulation itself." } },
    { "@@type": "Question", "name": "Can I get pregnant outside my fertile window?",
      "acceptedAnswer": { "@@type": "Answer", "text": "It is very unlikely but not impossible. Conception requires a live egg and live sperm in the fallopian tube at the same time. The egg survives for 12–24 hours after ovulation, and sperm can survive up to 5 days. Outside the 6-day fertile window, the probability of conception drops to near zero. However, unpredictable cycle variation means ovulation can occasionally shift, so unprotected sex at any point in the cycle carries some theoretical risk if ovulation timing varies." } },
    { "@@type": "Question", "name": "What are the signs of ovulation?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Common physical signs of ovulation include: a rise and change in cervical mucus (from dry or sticky to clear, slippery, and stretchy — often compared to raw egg white); a slight increase in basal body temperature (BBT) of 0.2–0.5°C after ovulation; mild one-sided pelvic pain known as Mittelschmerz; breast tenderness; and increased libido. LH surge tests (ovulation predictor kits) detect the hormonal surge that triggers ovulation 24–36 hours before it occurs." } }
  ]
}
</script>
@endsection

@php
$faqs = [
  ['q' => 'ov-faq-1', 'a' => 'When do I ovulate?',
             'Ovulation typically occurs about 14 days before your next expected period, regardless of your overall cycle length. On a 28-day cycle this falls around day 14; on a 35-day cycle it is closer to day 21. The 14-day gap between ovulation and menstruation is called the luteal phase, and it remains relatively constant (12–16 days) across most women. The follicular phase (from period start to ovulation) is what varies most and is the reason cycle length differs between individuals. Ovulation predictor kits (OPKs) detect the LH surge that occurs 24–36 hours before release.'],
  ['q' => 'ov-faq-2', 'a' => 'How is ovulation day calculated?',
             'Ovulation day is calculated by subtracting 14 from your cycle length. For a 28-day cycle: 28 − 14 = day 14. For a 30-day cycle: 30 − 14 = day 16. For a 35-day cycle: 35 − 14 = day 21. This formula works because the luteal phase is approximately 14 days for most women. Our calculator uses this formula automatically — enter your cycle length and last period date and it will compute your most likely ovulation day for each selected cycle.'],
  ['q' => 'ov-faq-3', 'a' => 'What is the fertile window?',
             'The fertile window is the 6-day period during each menstrual cycle when conception is biologically possible. It spans the 5 days leading up to ovulation and ovulation day itself. This window exists because sperm can survive inside the female reproductive tract for up to 5 days when fertile-quality cervical mucus is present, while the egg survives for only 12–24 hours after being released. The peak probability days are the 2 days immediately before ovulation and ovulation day itself — these three days give you the highest chance of conception per cycle.'],
  ['q' => 'ov-faq-4', 'a' => 'Can I get pregnant outside my fertile window?',
             'The probability of conceiving outside the 6-day fertile window is extremely low but not mathematically zero. If ovulation occurs unpredictably early or late in a given cycle — which can happen due to stress, illness, hormonal fluctuations, or travel — unprotected sex that appeared to be outside the fertile window might coincide with ovulation. For contraceptive purposes this means fertility awareness methods alone are not highly reliable unless combined with rigorous cycle tracking using BBT and cervical mucus observation.'],
  ['q' => 'ov-faq-5', 'a' => 'What are the signs of ovulation?',
             'Physical signs of ovulation include: a change in cervical mucus to clear, slippery, stretchy consistency (like raw egg white); mild one-sided pelvic pain (Mittelschmerz) as the follicle ruptures; a slight rise in basal body temperature (0.2–0.5°C) after ovulation; breast tenderness; increased sexual desire; and occasionally light spotting. Ovulation predictor kits (OPKs) detect the LH surge in urine 24–36 hours before ovulation — these are the most reliable home method for timing. Note that BBT confirms ovulation after the fact rather than predicting it.'],
  ['q' => 'ov-faq-6', 'a' => 'How does an irregular cycle affect ovulation?',
             'Irregular cycles mean ovulation does not occur at a predictable time each month, making it harder to estimate your fertile window from cycle length alone. If your cycle varies by more than 7–9 days from month to month, ovulation may shift by a week or more. In this case, combining a calculator (which gives a rough estimate) with BBT charting, cervical mucus observation, and ovulation predictor kits gives a much more accurate picture. Tracking 3–6 months of cycle data helps identify patterns even in irregular cycles.'],
  ['q' => 'ov-faq-7', 'a' => 'Can I use an ovulation calculator with PCOS?',
             'Ovulation calculators are less reliable for women with polycystic ovary syndrome (PCOS), because PCOS disrupts the hormonal signals that regulate ovulation. Many women with PCOS have irregular or absent ovulation, meaning the standard formula (cycle length minus 14 days) may not apply. LH surge tests can also give false positives with PCOS due to chronically elevated LH levels. If you have PCOS and are trying to conceive, a fertility specialist can use transvaginal ultrasound to directly monitor follicle development and confirm ovulation.'],
  ['q' => 'ov-faq-8', 'a' => 'How many days after my period do I ovulate?',
             'For most women with regular cycles, ovulation occurs approximately 12–16 days after the first day of their period. On a 28-day cycle, this is around day 14 (counting from the first day of your period as day 1). On shorter cycles (e.g., 21 days) ovulation can occur as early as day 7–8. On longer cycles (e.g., 35 days) ovulation may not happen until day 21. This wide range is why knowing your cycle length is crucial — ovulation timing is not the same as "2 weeks after your period" unless your cycle is exactly 28 days.'],
];

$relatedTools = [
  ['icon' => '🤰', 'name' => 'Due Date Calculator', 'slug' => '/due-date-calculator', 'desc' => 'Calculate your pregnancy due date by LMP, conception, or IVF.'],
  ['icon' => '🎂', 'name' => 'Age Calculator', 'slug' => '/age-calculator', 'desc' => 'Find your exact age in years, months, days, and hours.'],
  ['icon' => '📅', 'name' => 'Days Between Dates', 'slug' => '/days-between-dates', 'desc' => 'Count the exact number of days between any two dates.'],
  ['icon' => '⌛', 'name' => 'Life Percentage Calculator', 'slug' => '/life-percentage-calculator', 'desc' => 'See what percentage of your life has passed.'],
  ['icon' => '⏳', 'name' => 'Days Until Calculator', 'slug' => '/days-until-calculator', 'desc' => 'Find out how many days until any future date.'],
  ['icon' => '🏖️', 'name' => 'Retirement Calculator', 'slug' => '/retirement-calculator', 'desc' => 'Plan your retirement savings and find out when you can stop working.'],
];
@endphp

@section('styles')
<style>
.ov-unit-hint      { font-size: .82rem; }
.ov-stat-pill      { background: var(--life); color: #fff; border-radius: 8px; padding: 6px 10px; font-weight: 700; font-size: .85rem; min-width: 80px; text-align: center; flex-shrink: 0; }
.ov-phase-pill     { background: var(--life); color: #fff; border-radius: 8px; padding: 5px 8px; font-weight: 700; font-size: .75rem; min-width: 90px; text-align: center; flex-shrink: 0; margin-top: 2px; }
.ov-phase-name     { font-weight: 600; color: var(--primary-dark); font-size: .9rem; margin-bottom: 2px; }
.ov-phase-desc     { font-size: .85rem; color: #555; line-height: 1.5; }
.ov-how-section    { background: #fff; padding: 80px 0 72px; }
.ov-data-heading   { font-size: .88rem; color: var(--primary-dark); text-transform: uppercase; letter-spacing: .5px; }
.ov-formula-box    { background: #f8f9fa; border-left: 4px solid var(--life); font-family: monospace; font-size: .95rem; color: var(--primary-dark); }
.ov-sub            { max-width: 580px; margin: auto; }
.ov-tbl            { border-radius: 12px; overflow: hidden; font-size: .92rem; }
.ov-th             { padding: 14px 18px; }
.ov-td             { padding: 12px 18px; font-size: .85rem; }
.ov-td-phase       { padding: 12px 18px; font-weight: 600; font-size: .88rem; }
.ov-td-status-peak  { padding: 12px 18px; font-size: .85rem; font-weight: 600; color: var(--life); }
.ov-td-status-max   { padding: 12px 18px; font-size: .85rem; font-weight: 600; color: #155724; }
.ov-td-status-low   { padding: 12px 18px; font-size: .85rem; font-weight: 600; color: #666; }
.ov-td-status-other { padding: 12px 18px; font-size: .85rem; font-weight: 600; color: #856404; }
.ov-tbl-note       { font-size: .8rem; color: #888; margin-top: 12px; }
.ov-section-longtail { background: #f8f9ff; padding: 72px 0; }
/* JS-generated calendar classes */
.ov-cal-wrap       { display: flex; flex-wrap: wrap; }
.ov-cycle-box      { background: #f8f4ff; border: 1px solid #d4c5f9; }
.ov-cycle-title    { font-weight: 700; color: var(--life); font-size: 1rem; }
.ov-cycle-period   { font-size: .85rem; color: #666; }
.ov-mini-stat      { border: 1px solid #d4c5f9; background: #ede7ff; }
.ov-mini-stat-best { border: 1px solid #b9a0f0; background: #d4c5f9; }
.ov-mini-stat-next { border: 1px solid #fca5a5; background: #fee2e2; }
.ov-mini-val       { font-size: .9rem; font-weight: 700; color: var(--life); }
.ov-mini-val-best  { font-size: .9rem; font-weight: 700; color: #4a1a8c; }
.ov-mini-val-next  { font-size: .9rem; font-weight: 700; color: #991b1b; }
.ov-mini-lbl       { font-size: .7rem; font-weight: 600; text-transform: uppercase; color: #6f42c1; }
.ov-mini-lbl-best  { font-size: .7rem; font-weight: 600; text-transform: uppercase; color: #4a1a8c; }
.ov-mini-lbl-next  { font-size: .7rem; font-weight: 600; text-transform: uppercase; color: #991b1b; }
.ov-legend         { font-size: .75rem; }
.ov-legend-dot     { display: inline-block; width: 10px; height: 10px; border-radius: 50%; margin-right: 4px; }
.ov-legend-dot-period { background: #fee2e2; border: 1px solid #fca5a5; }
.ov-legend-dot-fert   { background: #ede7ff; border: 1px solid #d4c5f9; }
.ov-legend-dot-best   { background: #d4c5f9; border: 1px solid #b9a0f0; }
.ov-legend-dot-ov     { background: var(--life); }
.ov-day-lbl        { width: calc(100%/7); text-align: center; font-size: .7rem; color: #888; font-weight: 600; padding: 4px 0; }
.ov-cell           { width: calc(100%/7); aspect-ratio: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; border-radius: 6px; font-size: .8rem; margin: 1px; }
.ov-cell-ov        { background: var(--life); color: #fff; border: none; font-weight: 700; }
.ov-cell-best      { background: #d4c5f9; color: #4a1a8c; border: 1px solid #b9a0f0; font-weight: 700; }
.ov-cell-fert      { background: #ede7ff; color: #6f42c1; border: 1px solid #d4c5f9; font-weight: 400; }
.ov-cell-period    { background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; font-weight: 400; }
.ov-cell-incycle   { background: #fff; color: #333; border: 1px solid #e8e8e8; font-weight: 400; }
.ov-cell-out       { background: #f8f9fa; color: #ccc; border: 1px solid #e8e8e8; font-weight: 400; }
.ov-cell-sublabel  { font-size: .55rem; line-height: 1; }
</style>
@endsection

@section('content')

{{-- ── 1. Hero / Tool ───────────────────────────────────────────────────────── --}}
<section class="ms-hero">
  <div class="container-xl">
    <div class="row align-items-start g-5">

      <div class="col-lg-7">
        <x-breadcrumb :crumbs="[
          ['url' => route('home'), 'name' => 'Home'],
          ['url' => route('category.life'), 'name' => 'Life Tools'],
          ['url' => '', 'name' => 'Ovulation Calculator'],
        ]"/>

        <h1 class="mb-2 ms-hero-title">
          🌸 Ovulation Calculator — Find Your Fertile Window
        </h1>
        <p class="ms-hero-desc">
          Enter your last period date and average cycle length to instantly see your ovulation day, fertile window, best days to conceive, and up to 3 cycles ahead.
        </p>

        {{-- ── Tool Card ────────────────────────────────────────────────────── --}}
        <div class="card border-0 mb-n4 ms-tool-card">
          <div class="card-body p-4 p-md-5">

            <div class="mb-3">
              <label for="ovLmpDate" class="form-label fw-semibold">First Day of Last Menstrual Period</label>
              <input type="date" id="ovLmpDate" class="form-control" aria-label="First day of last period">
            </div>

            <div class="row g-3 mb-4">
              <div class="col-sm-6">
                <label for="ovCycleLen" class="form-label fw-semibold">Average Cycle Length <span class="text-muted fw-normal ov-unit-hint">(days)</span></label>
                <input type="number" id="ovCycleLen" class="form-control" value="28" min="21" max="35" aria-label="Average cycle length">
              </div>
              <div class="col-sm-6">
                <label for="ovCycles" class="form-label fw-semibold">Cycles to Show</label>
                <select id="ovCycles" class="form-select">
                  <option value="1">1 cycle</option>
                  <option value="2" selected>2 cycles</option>
                  <option value="3">3 cycles</option>
                </select>
              </div>
            </div>

            <button class="btn btn-cta w-100" onclick="calcOvulation()">
              Find My Fertile Window →
            </button>

            {{-- Results --}}
            <div id="ovResults" class="mt-4 d-none">
              <div class="ms-divider mb-4"></div>
              <div id="ovCycleResults"></div>
            </div>

          </div>
        </div>
      </div>

      {{-- Right: Quick facts --}}
      <div class="col-lg-5 d-none d-lg-block pt-2">
        <div class="ms-facts-wrap">
          <h3 class="ms-facts-title">Fertility Quick Facts</h3>
          @foreach([
            ['12–24 hrs', 'How long an egg survives after ovulation'],
            ['5 days',    'How long sperm can survive in fertile fluid'],
            ['6 days',    'Total fertile window per cycle'],
            ['Day 14',    'Typical ovulation day on a 28-day cycle'],
            ['±2 days',   'Variation in ovulation day even with regular cycles'],
          ] as [$stat, $label])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div class="ov-stat-pill">{{ $stat }}</div>
            <div class="ms-fact-label">{{ $label }}</div>
          </div>
          @endforeach
          <p class="ms-fact-source">Sources: NICE, ACOG, American Pregnancy Association</p>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- ── 2. How It Works ──────────────────────────────────────────────────────── --}}
<section class="ov-how-section">
  <div class="container-xl">
    <div class="row align-items-center g-5">
      <div class="col-lg-5">
        <span class="ms-badge ms-badge-life mb-3">How It Works</span>
        <h2 class="mb-4">How Ovulation Works: The Menstrual Cycle Explained</h2>
        <p>The menstrual cycle has two main phases separated by ovulation. During the <strong>follicular phase</strong>, rising oestrogen causes one dominant follicle to mature in the ovary. A surge in luteinising hormone (LH) triggers the release of the egg — ovulation — typically around day 14 of a 28-day cycle.</p>
        <div class="p-3 mb-3 rounded-3 ov-formula-box">
          Ovulation Day = Cycle Length − 14
        </div>
        <p>After ovulation, the <strong>luteal phase</strong> lasts approximately 14 days. If the egg is not fertilised, progesterone drops and menstruation begins. The luteal phase is quite consistent at 12–16 days; the follicular phase varies most between women.</p>
      </div>
      <div class="col-lg-7">
        <div class="p-4 rounded-3 ms-data-box">
          <p class="fw-semibold mb-3 ov-data-heading">The four phases of the menstrual cycle</p>
          @foreach([
            ['Menstruation',     'Days 1–5',    'Uterine lining sheds. Oestrogen and progesterone are at lowest levels.'],
            ['Follicular Phase', 'Days 1–13',   'Oestrogen rises. Follicles develop. Cervical mucus increases.'],
            ['Ovulation',        'Day ~14',     'LH surge. Egg released. Peak fertility — 12–24 hour window.'],
            ['Luteal Phase',     'Days 15–28',  'Progesterone dominates. Cervical mucus thickens. Period begins if no conception.'],
          ] as [$phase, $days, $desc])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div class="ov-phase-pill">{{ $days }}</div>
            <div>
              <div class="ov-phase-name">{{ $phase }}</div>
              <div class="ov-phase-desc">{{ $desc }}</div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ── 3. Cervical Mucus & BBT Reference ────────────────────────────────────── --}}
<section class="ms-section-muted">
  <div class="container-xl">
    <div class="text-center mb-5">
      <h2>Cervical Mucus &amp; BBT Changes Through Your Cycle</h2>
      <p class="text-muted ov-sub">Tracking these two signs alongside a calculator gives you the most accurate picture of your fertile window.</p>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="table-responsive">
          <table class="table table-bordered ov-tbl">
            <thead class="ms-table-head">
              <tr>
                <th class="ov-th">Cycle Phase</th>
                <th class="ov-th">Cervical Mucus</th>
                <th class="ov-th">Basal Body Temp (BBT)</th>
                <th class="ov-th">Fertility Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach([
                ['Menstruation (Days 1–5)',        'Absent or masked by flow',                             'Low (36.1–36.4°C / 97–97.5°F)',                'Non-fertile'],
                ['Post-period (Days 6–9)',          'Dry or sticky, white/yellow, breaks easily',           'Low, fairly stable',                           'Low fertility'],
                ['Pre-ovulation (Days 10–12)',      'Creamy, lotion-like, white',                           'Still low but beginning to rise',              'Increasing fertility'],
                ['Peak fertile days (Days 13–14)',  'Clear, slippery, stretchy (like raw egg white)',       'Low — LH surge occurs just before ovulation',  'Peak fertility'],
                ['Ovulation (Day 14)',               'Clear and very stretchy (spinnbarkeit >8 cm)',         'Thermal shift upward (rises 0.2–0.5°C)',        'Maximum fertility'],
                ['Luteal phase (Days 15–28)',        'Thick, tacky, opaque — becomes dry near period',      'Elevated (36.6–37.0°C / 97.9–98.6°F)',         'Non-fertile'],
              ] as [$phase, $mucus, $bbt, $status])
              <tr>
                <td class="ov-td-phase">{{ $phase }}</td>
                <td class="ov-td">{{ $mucus }}</td>
                <td class="ov-td">{{ $bbt }}</td>
                <td class="{{ str_contains($status,'Peak') ? 'ov-td-status-peak' : (str_contains($status,'Maximum') ? 'ov-td-status-max' : (str_contains($status,'Low') || str_contains($status,'Non') ? 'ov-td-status-low' : 'ov-td-status-other')) }}">{{ $status }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <p class="ov-tbl-note">Based on the Billings Ovulation Method and standard BBT charting guidelines. Individual variation applies.</p>
      </div>
    </div>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="ovFaqAccordion" />


{{-- ── 5. Long-tail SEO Sections ────────────────────────────────────────────── --}}
<section class="ov-section-longtail">
  <div class="container-xl">

    <div class="row justify-content-center mb-5">
      <div class="col-lg-8">
        <h2 class="mb-3">Ovulation Calculator for Irregular Cycles — How to Estimate Your Window</h2>
        <p>An irregular cycle is typically defined as one that varies by more than 8 days between your shortest and longest cycle over a 3-month period. This makes calculator-based predictions less reliable, because the formula (cycle length minus 14) assumes a consistent follicular phase.</p>
        <p>The best strategy for irregular cycles is to track the range of your cycle lengths over several months. If your cycles range from 26 to 34 days, your fertile window could fall anywhere from day 12 to day 20. Using this range, you can identify a broader "possible fertile window" and focus tracking efforts within it.</p>
        <p>To improve accuracy with irregular cycles, combine the calculator with: ovulation predictor kits (which detect the actual LH surge), basal body temperature (BBT) charting (which confirms ovulation after it occurs), and cervical mucus monitoring. Together these three methods — sometimes called the sympto-thermal method — are significantly more accurate than any single technique alone.</p>
        <p>Apps that log your cycle history over many months can also improve predictions by learning your individual pattern, though they rely on the same statistical methods as manual calculation.</p>
      </div>
    </div>

    <div class="row justify-content-center mb-5">
      <div class="col-lg-8">
        <h2 class="mb-3">Signs of Ovulation — How to Know When You're Fertile Without a Calculator</h2>
        <p>While calculators provide a useful estimate, your body also produces physical signs that can help you identify your fertile window in real time. Learning to recognise these signs, a practice known as fertility awareness, can be used alone or alongside a calculator for greater confidence.</p>
        <p><strong>Cervical mucus changes</strong> are the most reliable observable sign. As oestrogen rises in the lead-up to ovulation, mucus transitions from dry or sticky to creamy, then to clear, slippery, and stretchy — the classic "egg white" consistency. This fertile-quality mucus supports sperm survival and navigation. After ovulation, progesterone causes the mucus to become thick and tacky again.</p>
        <p><strong>Basal body temperature (BBT)</strong> rises by 0.2–0.5°C after ovulation due to progesterone's thermogenic effect. Tracking BBT each morning before getting out of bed, using a BBT thermometer, reveals a distinct temperature shift that confirms ovulation occurred. This is retrospective — you see the shift after the egg has been released — so it is most useful for identifying your pattern over several cycles.</p>
        <p><strong>Ovulation predictor kits (OPKs)</strong> detect the LH surge in urine 24–36 hours before ovulation. A positive test means ovulation is imminent, giving you advance notice. Digital OPKs (such as Clearblue Advanced) also detect the oestrogen rise several days earlier, identifying an even broader fertile window.</p>
        <p>Other signs include mild one-sided pelvic pain (Mittelschmerz), breast tenderness, increased libido, and in some women, light mid-cycle spotting (caused by the drop in oestrogen just before the LH surge).</p>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-8">
        <h2 class="mb-3">Ovulation Calculator for PCOS — How Irregular Cycles Affect Fertility</h2>
        <p>Polycystic ovary syndrome (PCOS) is the most common hormonal disorder affecting women of reproductive age, affecting approximately 1 in 10 women. It disrupts the normal hormonal signalling that regulates ovulation, often resulting in infrequent, irregular, or absent ovulation (anovulation).</p>
        <p>Standard ovulation calculators are unreliable for women with PCOS because they depend on consistent cycle lengths. Women with PCOS may experience cycles ranging from 35 days to several months, or no period at all, making the "cycle length minus 14" formula meaningless.</p>
        <p>OPKs are also less reliable in PCOS because LH levels are often chronically elevated, producing multiple positive-like readings without ovulation actually occurring. Digital OPKs that also measure oestrogen (estradiol) can help distinguish a true LH surge from background LH noise.</p>
        <p>The most reliable approach for women with PCOS who are trying to conceive is to work with a gynaecologist or reproductive endocrinologist. Treatments that help induce ovulation include lifestyle modification (weight loss in those who are overweight can restore ovulation in up to 80% of cases), letrozole (first-line medical treatment), clomiphene citrate, metformin, and injectable gonadotrophins. Transvaginal ultrasound monitoring of follicle growth is the gold standard for confirming ovulation timing.</p>
      </div>
    </div>

  </div>
</section>

<x-related-tools :tools="$relatedTools" heading="Related Life Tools" />


{{-- ── 7. SEO Text Block ────────────────────────────────────────────────────── --}}
<section class="ms-section-white">
  <div class="container-xl">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <h2 class="mb-4">About This Ovulation &amp; Fertile Window Calculator</h2>
        <p>MindSnap's ovulation calculator uses the standard luteal phase method to estimate ovulation timing: ovulation day equals your cycle length minus 14 days. The fertile window is defined as the 5 days before ovulation plus ovulation day itself. Best conception days are the 2 days before ovulation and ovulation day.</p>
        <p>Calculations are based on a consistent luteal phase of 14 days, which holds true for most women but varies between 12 and 16 days individually. For highly irregular cycles (varying by more than 8 days), the estimates should be treated as a starting point to be refined with BBT charting, cervical mucus observation, and ovulation predictor tests.</p>
        <p>This tool is for informational purposes only and should not replace advice from a qualified healthcare professional. If you have been trying to conceive for 12 months (or 6 months if you are over 35) without success, consult a GP, gynaecologist, or fertility specialist for a comprehensive evaluation.</p>
      </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')
<script>
(function() {

  function addDays(date, n) {
    const d = new Date(date);
    d.setDate(d.getDate() + n);
    return d;
  }

  function fmtDate(d) {
    return d.toLocaleDateString('en-GB', { weekday:'short', day:'numeric', month:'short', year:'numeric' });
  }

  function fmtShort(d) {
    return d.toLocaleDateString('en-GB', { day:'numeric', month:'short' });
  }

  function buildCycleCalendar(lmpDate, cycleLen, cycleNum) {
    const ovDay       = cycleLen - 14;
    const ovDate      = addDays(lmpDate, ovDay);
    const fertStart   = addDays(ovDate, -5);
    const fertEnd     = ovDate;
    const bestStart   = addDays(ovDate, -2);
    const nextPeriod  = addDays(lmpDate, cycleLen);
    const lutealLen   = 14;

    // Build 5-week calendar grid starting from lmpDate
    const gridStart = new Date(lmpDate);
    // Align to Monday
    const dow = gridStart.getDay(); // 0=Sun
    gridStart.setDate(gridStart.getDate() - ((dow + 6) % 7));

    const cells = [];
    for (let i = 0; i < 35; i++) {
      const d = addDays(gridStart, i);
      const t = d.getTime();
      const inCycle  = t >= lmpDate.getTime() && t < nextPeriod.getTime();
      const isOv     = t === ovDate.getTime();
      const isFert   = t >= fertStart.getTime() && t <= fertEnd.getTime();
      const isBest   = t >= bestStart.getTime() && t <= fertEnd.getTime();
      const isPeriod = t >= lmpDate.getTime() && t < addDays(lmpDate, 5).getTime();

      let cellClass = 'ov-cell '; let label = '';
      if (!inCycle)      { cellClass += 'ov-cell-out'; }
      else if (isOv)     { cellClass += 'ov-cell-ov';     label = '◉'; }
      else if (isBest)   { cellClass += 'ov-cell-best';   label = '★'; }
      else if (isFert)   { cellClass += 'ov-cell-fert'; }
      else if (isPeriod) { cellClass += 'ov-cell-period'; }
      else               { cellClass += 'ov-cell-incycle'; }

      cells.push(`<div class="${cellClass}">${d.getDate()}${label ? `<span class="ov-cell-sublabel">${label}</span>` : ''}</div>`);
    }

    const dayLabels = ['Mo','Tu','We','Th','Fr','Sa','Su'].map(d =>
      `<div class="ov-day-lbl">${d}</div>`
    ).join('');

    return `
      <div class="mb-4 p-4 rounded-3 ov-cycle-box">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <span class="ov-cycle-title">Cycle ${cycleNum}</span>
          <span class="ov-cycle-period">Period starts ${fmtShort(lmpDate)}</span>
        </div>

        <div class="row g-2 mb-3">
          <div class="col-6 col-sm-3">
            <div class="p-2 rounded-3 text-center ov-mini-stat">
              <div class="ov-mini-lbl">Ovulation</div>
              <div class="ov-mini-val">${fmtShort(ovDate)}</div>
            </div>
          </div>
          <div class="col-6 col-sm-3">
            <div class="p-2 rounded-3 text-center ov-mini-stat-best">
              <div class="ov-mini-lbl-best">Best Days</div>
              <div class="ov-mini-val-best">${fmtShort(bestStart)} – ${fmtShort(fertEnd)}</div>
            </div>
          </div>
          <div class="col-6 col-sm-3">
            <div class="p-2 rounded-3 text-center ov-mini-stat">
              <div class="ov-mini-lbl">Fertile Window</div>
              <div class="ov-mini-val">${fmtShort(fertStart)} – ${fmtShort(fertEnd)}</div>
            </div>
          </div>
          <div class="col-6 col-sm-3">
            <div class="p-2 rounded-3 text-center ov-mini-stat-next">
              <div class="ov-mini-lbl-next">Next Period</div>
              <div class="ov-mini-val-next">${fmtShort(nextPeriod)}</div>
            </div>
          </div>
        </div>

        <div class="ov-cal-wrap">
          ${dayLabels}
          ${cells.join('')}
        </div>

        <div class="d-flex flex-wrap gap-3 mt-3 ov-legend">
          <span><span class="ov-legend-dot ov-legend-dot-period"></span>Period</span>
          <span><span class="ov-legend-dot ov-legend-dot-fert"></span>Fertile</span>
          <span><span class="ov-legend-dot ov-legend-dot-best"></span>★ Best days</span>
          <span><span class="ov-legend-dot ov-legend-dot-ov"></span>◉ Ovulation</span>
        </div>
      </div>`;
  }

  window.calcOvulation = function() {
    const raw = document.getElementById('ovLmpDate').value;
    if (!raw) { alert('Please enter the first day of your last period.'); return; }
    const cycleLen = parseInt(document.getElementById('ovCycleLen').value) || 28;
    const numCycles = parseInt(document.getElementById('ovCycles').value) || 2;

    let html = '';
    let lmp = new Date(raw); lmp.setHours(0,0,0,0);

    for (let c = 1; c <= numCycles; c++) {
      html += buildCycleCalendar(lmp, cycleLen, c);
      lmp = addDays(lmp, cycleLen);
    }

    document.getElementById('ovCycleResults').innerHTML = html;
    document.getElementById('ovResults').classList.remove('d-none');
  };

})();
</script>
@endsection
