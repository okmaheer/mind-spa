@extends('layouts.app')

@section('title', 'Due Date Calculator — Pregnancy Due Date by LMP or Conception | MindSnap')
@section('description', 'Free pregnancy due date calculator: enter your last period or conception date to get your estimated due date, trimester dates, and week-by-week timeline. No signup.')
@section('canonical', config('app.url') . '/due-date-calculator')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "WebApplication",
  "name": "Due Date Calculator",
  "url": "{{ config('app.url') }}/due-date-calculator",
  "description": "Calculate your pregnancy due date by last menstrual period, conception date, or IVF transfer date. Get trimester dates and key milestone weeks.",
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
    { "@@type": "ListItem", "position": 3, "name": "Due Date Calculator" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [
    { "@@type": "Question", "name": "How is a pregnancy due date calculated?",
      "acceptedAnswer": { "@@type": "Answer", "text": "A pregnancy due date is most commonly calculated using Naegele's rule: add 280 days (40 weeks) to the first day of your last menstrual period (LMP). This assumes a 28-day cycle and ovulation on day 14. If your cycle is longer or shorter, the due date is adjusted accordingly — each day your cycle differs from 28 adds or subtracts a day from the estimate. Your healthcare provider may also use ultrasound dating, which becomes the reference point if it differs significantly from LMP dating." } },
    { "@@type": "Question", "name": "How accurate is a due date calculator?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Due date calculators are accurate to within 1–2 weeks for most women with regular cycles. Only about 5% of babies are born on their exact due date, and roughly 80% arrive within two weeks either side. Early ultrasound (before 12 weeks) is the most accurate dating method, as the embryo's size closely tracks gestational age. Dating becomes less reliable as pregnancy progresses, since babies grow at more variable rates in the second and third trimesters." } },
    { "@@type": "Question", "name": "What is the difference between gestational age and embryonic age?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Gestational age counts from the first day of your last menstrual period (LMP), which is typically 2 weeks before conception. So at the moment of conception you are already considered '2 weeks pregnant' in gestational terms. Embryonic (or fetal) age counts from the actual moment of fertilisation. This is why a pregnancy is 40 weeks gestationally but only about 38 weeks embryonically. Doctors and calculators almost universally use gestational age, so a due date of 40 weeks means 40 weeks from LMP." } },
    { "@@type": "Question", "name": "What is Naegele's rule?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Naegele's rule is the standard formula for estimating a pregnancy due date. Developed by German obstetrician Franz Karl Naegele in the early 19th century, it states: take the first day of the last menstrual period, add one year, subtract three months, and add seven days — which is equivalent to adding 280 days (40 weeks). The rule assumes a 28-day menstrual cycle with ovulation on day 14. For cycles longer or shorter than 28 days, the due date is adjusted by the difference." } },
    { "@@type": "Question", "name": "Can I calculate my due date from conception?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes. If you know your conception date (for example, through ovulation tracking or a known single encounter), your due date is approximately 266 days (38 weeks) after conception. This is because conception-based dating starts from fertilisation rather than the last period, so it is two weeks shorter than LMP-based dating. Most calculators accept a conception date as an alternative input and add 266 days to produce the estimated due date." } }
  ]
}
</script>
@endsection

@php
$faqs = [
  ['q' => 'dd-faq-1', 'a' => 'How is a pregnancy due date calculated?',
             'A pregnancy due date is most commonly calculated using Naegele\'s rule: add 280 days (40 weeks) to the first day of your last menstrual period. This assumes a standard 28-day cycle with ovulation on day 14. If your cycle is longer or shorter, the estimate is adjusted by the difference in days. Your healthcare provider may also use early ultrasound dating (before 12 weeks), which is the most accurate method and becomes the reference point if it differs by more than 7 days from LMP dating.'],
  ['q' => 'dd-faq-2', 'a' => 'How accurate is a due date calculator?',
             'Due date calculators are accurate to within 1–2 weeks for most women with regular cycles. Only about 5% of babies are born on their exact due date, and roughly 80% arrive within two weeks either side. Early first-trimester ultrasound (before 12 weeks) is the gold standard for dating, as embryo size closely tracks gestational age at this stage. Second and third trimester ultrasounds are less reliable for dating because baby growth becomes more variable.'],
  ['q' => 'dd-faq-3', 'a' => 'What is the difference between gestational age and embryonic age?',
             'Gestational age counts from the first day of your last menstrual period, which is typically two weeks before conception actually occurs. So at the moment of fertilisation you are already considered "2 weeks pregnant" in gestational terms. Embryonic (or fetal) age counts from actual fertilisation. A 40-week pregnancy is 40 weeks gestational but only 38 weeks embryonic. All standard due date calculators and clinical measurements use gestational age as the reference.'],
  ['q' => 'dd-faq-4', 'a' => 'What is Naegele\'s rule?',
             'Naegele\'s rule is the standard formula for estimating a pregnancy due date. Developed by German obstetrician Franz Karl Naegele in the early 19th century, it states: take the first day of the last menstrual period, add one year, subtract three months, and add seven days — which is equivalent to simply adding 280 days (40 weeks). The formula assumes a 28-day cycle with ovulation on day 14. For cycles that differ from 28 days, the due date is adjusted by the number of days of difference.'],
  ['q' => 'dd-faq-5', 'a' => 'Can I calculate my due date from conception?',
             'Yes. If you know your conception date through ovulation tracking, a positive LH surge test, or a known single encounter, your due date is approximately 266 days (38 weeks) from that date. Conception-based calculation starts from fertilisation rather than the last period — it is two weeks shorter than LMP-based dating because it skips the first two weeks of the gestational calendar. Most calculators accept a conception date as an input and add 266 days automatically.'],
  ['q' => 'dd-faq-6', 'a' => 'How do I calculate my due date after IVF?',
             'IVF due dates are calculated from the egg retrieval date or the transfer date, using the embryo\'s age at transfer. For a Day 5 blastocyst transfer, add 261 days to the transfer date (266 days from fertilisation, minus 5 days already elapsed). For a Day 3 cleavage-stage transfer, add 263 days. IVF due dates are often considered more accurate than LMP-based dates since the exact fertilisation timing is known.'],
  ['q' => 'dd-faq-7', 'a' => 'What is considered full-term pregnancy?',
             'Full-term pregnancy is defined as 39 weeks 0 days to 40 weeks 6 days of gestation, according to ACOG (American College of Obstetricians and Gynecologists). Babies born at 37–38 weeks 6 days are considered "early term" — their lungs and brain are still maturing during those final weeks. Babies born at 41 weeks or beyond are considered "late term" (41–41w6d) or "post-term" (42+ weeks). Induction of labour is often offered at 41–42 weeks to avoid post-maturity complications.'],
  ['q' => 'dd-faq-8', 'a' => 'What happens if my baby comes before or after the due date?',
             'Most healthy babies arrive between weeks 37 and 42 of gestation. Babies born before 37 weeks are classified as premature and may need specialist care depending on their gestational age and health. Babies arriving after 42 weeks (post-term) face a slightly increased risk of placental insufficiency, so most care providers will recommend induction of labour by 41–42 weeks. If you go past your due date without labour starting naturally, your midwife or doctor will monitor you closely and discuss your options.'],
];

$relatedTools = [
  ['icon' => '🌸', 'name' => 'Ovulation Calculator', 'slug' => '/ovulation-calculator', 'desc' => 'Find your fertile window and best days to conceive.'],
  ['icon' => '🎂', 'name' => 'Age Calculator', 'slug' => '/age-calculator', 'desc' => 'Calculate your exact age in years, months, days, and hours.'],
  ['icon' => '📅', 'name' => 'Days Between Dates', 'slug' => '/days-between-dates', 'desc' => 'Count the exact number of days between any two dates.'],
  ['icon' => '⏳', 'name' => 'Days Until Calculator', 'slug' => '/days-until-calculator', 'desc' => 'Find out how many days until any upcoming date.'],
  ['icon' => '⌛', 'name' => 'Life Percentage Calculator', 'slug' => '/life-percentage-calculator', 'desc' => 'See what percentage of your life has passed.'],
  ['icon' => '🏖️', 'name' => 'Retirement Calculator', 'slug' => '/retirement-calculator', 'desc' => 'Find out when you can retire and how much you need.'],
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
          ['url' => '', 'name' => 'Due Date Calculator'],
        ]"/>

        <h1 class="mb-2 ms-hero-title">
          🤰 Due Date Calculator — Find Your Pregnancy Due Date
        </h1>
        <p class="ms-hero-desc">
          Enter your last menstrual period, conception date, or IVF transfer date to get your estimated due date, trimester timeline, and key milestone weeks.
        </p>

        {{-- ── Tool Card ────────────────────────────────────────────────────── --}}
        <div class="card border-0 mb-n4 ms-tool-card">
          <div class="card-body p-4 p-md-5">

            {{-- Method selector --}}
            <div class="mb-4">
              <label for="ddMethod" class="form-label fw-semibold">Calculation Method</label>
              <select id="ddMethod" class="form-select" onchange="ddToggleMethod()">
                <option value="lmp">By Last Menstrual Period (LMP)</option>
                <option value="conception">By Conception Date</option>
                <option value="ivf">By IVF Transfer Date</option>
              </select>
            </div>

            {{-- LMP inputs --}}
            <div id="ddLmpInputs">
              <div class="mb-3">
                <label for="ddLmpDate" class="form-label fw-semibold">First Day of Last Menstrual Period</label>
                <input type="date" id="ddLmpDate" class="form-control" aria-label="Last menstrual period date">
              </div>
              <div class="mb-4">
                <label for="ddCycleLen" class="form-label fw-semibold">Average Cycle Length <span class="text-muted fw-normal" style="font-size:.82rem;">(days)</span></label>
                <input type="number" id="ddCycleLen" class="form-control" value="28" min="21" max="35" aria-label="Average cycle length in days">
                <div class="form-text">Default is 28. Adjust for more accurate results.</div>
              </div>
            </div>

            {{-- Conception inputs --}}
            <div id="ddConceptionInputs" class="d-none">
              <div class="mb-4">
                <label for="ddConceptionDate" class="form-label fw-semibold">Conception Date</label>
                <input type="date" id="ddConceptionDate" class="form-control" aria-label="Conception date">
              </div>
            </div>

            {{-- IVF inputs --}}
            <div id="ddIvfInputs" class="d-none">
              <div class="mb-3">
                <label for="ddIvfDate" class="form-label fw-semibold">IVF Transfer Date</label>
                <input type="date" id="ddIvfDate" class="form-control" aria-label="IVF transfer date">
              </div>
              <div class="mb-4">
                <label class="form-label fw-semibold">Embryo Age at Transfer</label>
                <div class="d-flex gap-3">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="ddEmbryoAge" id="ddDay5" value="5" checked>
                    <label class="form-check-label" for="ddDay5">Day 5 (blastocyst)</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="ddEmbryoAge" id="ddDay3" value="3">
                    <label class="form-check-label" for="ddDay3">Day 3 (cleavage)</label>
                  </div>
                </div>
              </div>
            </div>

            <button class="btn btn-cta w-100" onclick="calcDueDate()" style="font-size:1rem;">
              Calculate Due Date →
            </button>

            {{-- Results --}}
            <div id="ddResults" class="mt-4 d-none">
              <div style="height:1px; background:#f0f0f0; margin-bottom:20px;"></div>

              <div class="text-center mb-4">
                <div style="font-size:.85rem; color:#888; text-transform:uppercase; letter-spacing:.5px; margin-bottom:4px;">Estimated Due Date</div>
                <div id="ddDueDate" style="font-size:2.2rem; font-weight:700; color:var(--life);"></div>
                <div id="ddDayOfWeek" style="font-size:1rem; color:#666;"></div>
              </div>

              <div id="ddGestAge" class="p-3 rounded-3 mb-3" style="background:#f8f4ff; border:1px solid #d4c5f9; font-size:.92rem; color:#4a1a8c;"></div>

              <p class="fw-semibold mb-2" style="font-size:.88rem; color:var(--primary-dark);">TRIMESTER TIMELINE</p>
              <div id="ddTrimesters" class="mb-3"></div>

              <p class="fw-semibold mb-2" style="font-size:.88rem; color:var(--primary-dark);">KEY MILESTONE WEEKS</p>
              <div id="ddMilestones"></div>
            </div>

          </div>
        </div>
      </div>

      {{-- Right: Quick facts --}}
      <div class="col-lg-5 d-none d-lg-block" style="padding-top:10px;">
        <div class="ms-facts-wrap">
          <h3 class="ms-facts-title">Pregnancy Quick Facts</h3>
          @foreach([
            ['280 days',  'Average pregnancy length (40 weeks from LMP)'],
            ['38 weeks',  'Pregnancy length from conception'],
            ['5%',        'Babies born on exact due date'],
            ['80%',       'Born within 2 weeks of due date'],
            ['3 trimesters', 'Each approximately 13 weeks long'],
          ] as [$stat, $label])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div style="background:var(--life); color:#fff; border-radius:8px; padding:6px 10px; font-weight:700; font-size:.85rem; min-width:90px; text-align:center; flex-shrink:0;">{{ $stat }}</div>
            <div class="ms-fact-label">{{ $label }}</div>
          </div>
          @endforeach
          <p class="ms-fact-source">Sources: ACOG, WHO, NICE guidelines</p>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- ── 2. How It Works ──────────────────────────────────────────────────────── --}}
<section style="background:#fff; padding:72px 0; padding-top:80px;">
  <div class="container-xl">
    <div class="row align-items-center g-5">
      <div class="col-lg-5">
        <span class="ms-badge ms-badge-life mb-3">How It Works</span>
        <h2 class="mb-4">How Your Due Date Is Calculated: Naegele's Rule Explained</h2>
        <p>The most widely used method for calculating a due date is <strong>Naegele's rule</strong>, developed by German obstetrician Franz Karl Naegele in 1812. The formula adds <strong>280 days (40 weeks)</strong> to the first day of your last menstrual period.</p>
        <div class="p-3 mb-3 rounded-3" style="background:#f8f9fa; border-left:4px solid var(--life); font-family:monospace; font-size:.95rem; color:var(--primary-dark);">
          Due Date = LMP + 280 days + (cycle − 28) days
        </div>
        <p>If your cycle is longer than 28 days, ovulation happens later, so the due date shifts forward. A 35-day cycle adds 7 days; a 21-day cycle subtracts 7 days.</p>
        <p>When calculating from a conception date, 266 days (38 weeks) are added, since fertilisation typically occurs 14 days after the LMP — 280 − 14 = 266.</p>
      </div>
      <div class="col-lg-7">
        <div class="p-4 rounded-3 ms-data-box">
          <p class="fw-semibold mb-3" style="color:var(--primary-dark); font-size:.88rem; text-transform:uppercase; letter-spacing:.5px;">Three ways to calculate your due date</p>
          @foreach([
            ['LMP Method', 'Add 280 days to your last period. Adjust for cycle length (±1 day per day difference from 28).', '📅'],
            ['Conception Method', 'Add 266 days (38 weeks) to your known conception or ovulation date.', '🥚'],
            ['IVF Transfer', 'Day 5 transfer: add 261 days. Day 3 transfer: add 263 days to transfer date.', '🔬'],
          ] as [$title, $desc, $icon])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div style="font-size:1.4rem; min-width:36px; text-align:center;">{{ $icon }}</div>
            <div>
              <div style="font-weight:600; color:var(--primary-dark); margin-bottom:4px;">{{ $title }}</div>
              <div style="font-size:.87rem; color:#555; line-height:1.5;">{{ $desc }}</div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ── 3. Trimester Milestone Table ─────────────────────────────────────────── --}}
<section class="ms-section-muted">
  <div class="container-xl">
    <div class="text-center mb-5">
      <h2>Trimester Timeline &amp; Key Development Milestones</h2>
      <p class="text-muted" style="max-width:560px; margin:auto;">A week-by-week guide to the major stages of pregnancy and what to expect at each.</p>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="table-responsive">
          <table class="table table-bordered" style="border-radius:12px; overflow:hidden; font-size:.92rem;">
            <thead class="ms-table-head">
              <tr>
                <th style="padding:14px 18px;">Trimester</th>
                <th style="padding:14px 18px;">Weeks</th>
                <th style="padding:14px 18px;">Key Events &amp; Milestones</th>
                <th style="padding:14px 18px;">What to Expect</th>
              </tr>
            </thead>
            <tbody>
              @foreach([
                ['First Trimester',  'Weeks 1–13',  'Implantation (wk 3), heartbeat (wk 6), all major organs forming, nuchal scan (wk 11–14)', 'Nausea, fatigue, breast tenderness, frequent urination. Risk of miscarriage highest.'],
                ['Week 20',          'Anatomy Scan', 'Detailed ultrasound to check baby\'s anatomy, sex can often be determined', 'Baby is now about 25 cm. Movement (quickening) felt around this time.'],
                ['Week 24',          'Viability',   'Baby reaches threshold of survival outside the womb with intensive medical care', 'Lung development continues. Baby responds to sounds.'],
                ['Second Trimester', 'Weeks 14–26', 'Baby grows rapidly, hair and fingerprints form, movement felt', 'Nausea usually subsides. Energy returns. Baby bump visible.'],
                ['Week 28',          'Third Trimester', 'Baby\'s eyes open, brain development accelerates, immune system matures', 'Braxton Hicks contractions may start. Glucose screening test.'],
                ['Week 37',          'Full Term',   'Baby is considered full term. Lungs fully mature, ready for birth', 'Baby may engage (drop) into the pelvis. Nesting instinct common.'],
                ['Third Trimester',  'Weeks 27–40', 'Final weight gain, lung maturation, baby turns head-down', 'Heartburn, back pain, swelling. Birth plan preparation.'],
                ['Week 40',          'Due Date',    'Estimated due date based on Naegele\'s rule', 'Only 5% of babies arrive on this exact day. Labour signs: contractions, water breaking.'],
              ] as [$trimester, $weeks, $events, $expect])
              <tr>
                <td style="padding:12px 18px; font-weight:600; color:var(--life);">{{ $trimester }}</td>
                <td style="padding:12px 18px; white-space:nowrap;">{{ $weeks }}</td>
                <td style="padding:12px 18px; font-size:.85rem;">{{ $events }}</td>
                <td style="padding:12px 18px; color:#666; font-size:.85rem;">{{ $expect }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <p style="font-size:.8rem; color:#888; margin-top:12px;">Source: ACOG, NHS, American Pregnancy Association.</p>
      </div>
    </div>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="ddFaqAccordion" />


{{-- ── 5. Long-tail SEO Sections ────────────────────────────────────────────── --}}
<section style="background:#f8f9ff; padding:72px 0;">
  <div class="container-xl">

    <div class="row justify-content-center mb-5">
      <div class="col-lg-8">
        <h2 class="mb-3">Due Date Calculator by Last Period — How Accurate Is It?</h2>
        <p>The LMP (last menstrual period) method is the most common way to calculate a due date, and it works well for women with regular 28-day cycles. The formula, known as Naegele's rule, simply adds 280 days to the start of your last period.</p>
        <p>The accuracy depends heavily on cycle regularity. A woman with a consistent 28-day cycle will get a very reliable estimate. However, if your cycles vary by more than a few days month to month, the LMP estimate can be off by a week or more. This is why cycle length adjustment matters — our calculator lets you input your actual average cycle length (21–35 days) to refine the estimate.</p>
        <p>Early ultrasound (6–12 weeks) is the most accurate dating method. A crown-rump length (CRL) measurement at the first trimester scan can pinpoint gestational age to within 5–7 days. If the ultrasound date differs from your LMP date by more than 7 days (in the first trimester), clinicians typically revise the due date to the ultrasound estimate.</p>
        <p>Factors that reduce LMP accuracy include: irregular periods, recent hormonal contraception use, breastfeeding cycles, postpartum return to fertility, and polycystic ovary syndrome (PCOS). In these situations, a conception-based calculation or early ultrasound dating is recommended.</p>
      </div>
    </div>

    <div class="row justify-content-center mb-5">
      <div class="col-lg-8">
        <h2 class="mb-3">IVF Due Date Calculator — Day 3 vs Day 5 Transfer</h2>
        <p>For pregnancies achieved through IVF (in vitro fertilisation), the due date is calculated differently because the exact timing of fertilisation and embryo development is known. The two most common transfer types are Day 3 (cleavage stage) and Day 5 (blastocyst stage).</p>
        <p><strong>Day 5 blastocyst transfer:</strong> Add 261 days to the transfer date. This is because the embryo is already 5 days old at transfer, so 266 − 5 = 261 days remain until the estimated due date from fertilisation.</p>
        <p><strong>Day 3 cleavage transfer:</strong> Add 263 days to the transfer date. The embryo is 3 days old at transfer, so 266 − 3 = 263 days remain.</p>
        <p>IVF due dates are generally considered more precise than LMP-based dates, since there is no guesswork about when ovulation or fertilisation occurred. The equivalent LMP date (sometimes called the "paper LMP") is calculated as the transfer date minus 17 days for Day 5, or minus 15 days for Day 3 — this is used by some clinical systems to harmonise IVF records with standard gestational age calculations.</p>
        <p>It is worth noting that even with IVF, only about 5% of babies arrive on the exact due date. The useful window is 37–42 weeks, with most healthy IVF pregnancies delivering within this range just like naturally conceived pregnancies.</p>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-8">
        <h2 class="mb-3">What Week of Pregnancy Am I In? — Gestational Age Explained</h2>
        <p>Gestational age is measured in weeks and days from the first day of your last menstrual period (LMP). So "6 weeks pregnant" means 6 weeks have elapsed since your LMP — your actual embryo is only about 4 weeks old at this point, since fertilisation typically occurs around day 14 of the cycle.</p>
        <p>To find your current gestational age, simply count the number of days from your LMP to today, then divide by 7. For example, if your LMP was 10 weeks and 3 days ago, you are 10 weeks and 3 days pregnant (written as 10+3 in clinical shorthand).</p>
        <p>Our calculator shows your current gestational age automatically if today's date is after your LMP. Key thresholds to know:</p>
        <ul>
          <li><strong>Week 6:</strong> Heartbeat typically detectable on transvaginal ultrasound</li>
          <li><strong>Week 12:</strong> End of highest miscarriage risk period; nuchal scan window</li>
          <li><strong>Week 20:</strong> Anatomy (anomaly) scan; sex often determinable</li>
          <li><strong>Week 24:</strong> Viability threshold — survival possible with intensive care</li>
          <li><strong>Week 28:</strong> Start of third trimester; glucose tolerance test</li>
          <li><strong>Week 37:</strong> Full term — lungs mature, baby ready for delivery</li>
          <li><strong>Week 40:</strong> Estimated due date (Naegele's rule)</li>
          <li><strong>Week 42:</strong> Post-term — induction usually offered</li>
        </ul>
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
        <h2 class="mb-4">About This Pregnancy Due Date Calculator</h2>
        <p>MindSnap's due date calculator uses clinically validated methods to estimate your baby's arrival. For LMP-based calculations it applies Naegele's rule with cycle-length adjustment; for conception dates it uses the standard 266-day embryonic period; and for IVF transfers it uses embryo-age-specific offsets (261 days for Day 5, 263 days for Day 3).</p>
        <p>This tool is for informational purposes only. Due dates are estimates — not predictions. Always confirm your due date with a qualified healthcare provider or midwife, who will use ultrasound scanning alongside your menstrual history to establish the most accurate gestational age for your individual pregnancy.</p>
        <p>The trimester dates and milestone weeks displayed are based on standard ACOG definitions: Trimester 1 runs from the LMP to the end of week 13 (day 91); Trimester 2 from week 14 to the end of week 26 (day 182); and Trimester 3 from week 27 to delivery. Key scan dates (20 weeks anatomy scan) and viability thresholds (24 weeks) are indicative and vary by country and individual clinical circumstances.</p>
      </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')
<script>
(function() {

  function ddToggleMethod() {
    const method = document.getElementById('ddMethod').value;
    document.getElementById('ddLmpInputs').classList.toggle('d-none', method !== 'lmp');
    document.getElementById('ddConceptionInputs').classList.toggle('d-none', method !== 'conception');
    document.getElementById('ddIvfInputs').classList.toggle('d-none', method !== 'ivf');
  }

  window.ddToggleMethod = ddToggleMethod;

  function addDays(date, days) {
    const d = new Date(date);
    d.setDate(d.getDate() + days);
    return d;
  }

  function fmtDate(d) {
    return d.toLocaleDateString('en-GB', { day: 'numeric', month: 'long', year: 'numeric' });
  }

  function fmtShort(d) {
    return d.toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' });
  }

  function dayName(d) {
    return d.toLocaleDateString('en-GB', { weekday: 'long' });
  }

  window.calcDueDate = function() {
    const method = document.getElementById('ddMethod').value;
    let lmpDate, dueDate;
    const today = new Date(); today.setHours(0,0,0,0);

    if (method === 'lmp') {
      const raw = document.getElementById('ddLmpDate').value;
      if (!raw) { alert('Please enter your last menstrual period date.'); return; }
      lmpDate = new Date(raw); lmpDate.setHours(0,0,0,0);
      const cycleLen = parseInt(document.getElementById('ddCycleLen').value) || 28;
      const adjustment = cycleLen - 28;
      dueDate = addDays(lmpDate, 280 + adjustment);
    } else if (method === 'conception') {
      const raw = document.getElementById('ddConceptionDate').value;
      if (!raw) { alert('Please enter your conception date.'); return; }
      const conDate = new Date(raw); conDate.setHours(0,0,0,0);
      dueDate = addDays(conDate, 266);
      lmpDate = addDays(conDate, -14);
    } else {
      const raw = document.getElementById('ddIvfDate').value;
      if (!raw) { alert('Please enter your IVF transfer date.'); return; }
      const ivfDate = new Date(raw); ivfDate.setHours(0,0,0,0);
      const embryoAge = parseInt(document.querySelector('input[name="ddEmbryoAge"]:checked').value);
      const offset = embryoAge === 5 ? 261 : 263;
      dueDate = addDays(ivfDate, offset);
      lmpDate = addDays(ivfDate, -(17 - (5 - embryoAge)));
    }

    // Gestational age
    const msPerDay = 86400000;
    const daysFromLmp = Math.floor((today - lmpDate) / msPerDay);
    const gestWeeks = Math.floor(daysFromLmp / 7);
    const gestDays  = daysFromLmp % 7;

    // Trimesters
    const t1End = addDays(lmpDate, 91);
    const t2End = addDays(lmpDate, 182);

    // Milestones (as dates)
    const milestones = [
      { week: 20, label: 'Anatomy scan window',    date: addDays(lmpDate, 140) },
      { week: 24, label: 'Viability threshold',    date: addDays(lmpDate, 168) },
      { week: 28, label: 'Third trimester begins', date: addDays(lmpDate, 196) },
      { week: 37, label: 'Full term',              date: addDays(lmpDate, 259) },
      { week: 40, label: 'Estimated due date',     date: dueDate               },
    ];

    // Render
    document.getElementById('ddDueDate').textContent = fmtDate(dueDate);
    document.getElementById('ddDayOfWeek').textContent = dayName(dueDate);

    const gestEl = document.getElementById('ddGestAge');
    if (daysFromLmp > 0 && daysFromLmp < 294) {
      gestEl.textContent = `You are currently ${gestWeeks} weeks and ${gestDays} day${gestDays !== 1 ? 's' : ''} pregnant (${daysFromLmp} days from LMP).`;
      gestEl.classList.remove('d-none');
    } else {
      gestEl.classList.add('d-none');
    }

    // Trimesters
    const triEl = document.getElementById('ddTrimesters');
    triEl.innerHTML = [
      ['1st Trimester', fmtShort(lmpDate), fmtShort(t1End), '#d4edda', '#155724'],
      ['2nd Trimester', fmtShort(addDays(t1End,1)), fmtShort(t2End), '#d1ecf1', '#0c5460'],
      ['3rd Trimester', fmtShort(addDays(t2End,1)), fmtShort(dueDate), '#f8d7da', '#721c24'],
    ].map(([label, start, end, bg, fg]) =>
      `<div class="d-flex justify-content-between align-items-center p-2 rounded-3 mb-2" style="background:${bg}; color:${fg}; font-size:.88rem;">
        <span class="fw-semibold">${label}</span>
        <span>${start} – ${end}</span>
      </div>`
    ).join('');

    // Milestones
    const msEl = document.getElementById('ddMilestones');
    msEl.innerHTML = milestones.map(m =>
      `<div class="d-flex justify-content-between align-items-center p-2 rounded-3 mb-2" style="background:#f8f4ff; border:1px solid #e8dff8; font-size:.88rem;">
        <span style="color:var(--life); font-weight:600;">Week ${m.week}</span>
        <span style="color:#444;">${m.label}</span>
        <span style="color:#888;">${fmtShort(m.date)}</span>
      </div>`
    ).join('');

    document.getElementById('ddResults').classList.remove('d-none');
  };

})();
</script>
@endsection
