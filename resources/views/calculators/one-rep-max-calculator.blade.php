@extends('layouts.app')

@section('title', 'One Rep Max Calculator — Estimate Your 1RM for Any Lift | MindSnap')
@section('description', 'Free one rep max calculator: enter weight lifted and reps to estimate your 1RM using Epley, Brzycki, and Lander formulas. Works for bench press, squat, deadlift. No signup.')
@section('canonical', config('app.url') . '/one-rep-max-calculator')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "WebApplication",
  "name": "One Rep Max Calculator",
  "url": "{{ config('app.url') }}/one-rep-max-calculator",
  "description": "Estimate your one rep max (1RM) for any lift using Epley, Brzycki, and Lander formulas.",
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
    { "@@type": "ListItem", "position": 1, "name": "Home", "item": "{{ config('app.url') }}" },
    { "@@type": "ListItem", "position": 2, "name": "Fitness Tools", "item": "{{ config('app.url') }}/fitness-tools" },
    { "@@type": "ListItem", "position": 3, "name": "One Rep Max Calculator" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [
    { "@@type": "Question", "name": "What is a one rep max (1RM)?",
      "acceptedAnswer": { "@@type": "Answer", "text": "A one rep max (1RM) is the maximum amount of weight you can lift for a single repetition of a given exercise with proper form. It is the gold standard for measuring absolute strength in weightlifting and powerlifting. Your 1RM is used to calculate training loads as percentages — for example, lifting at 75% of your 1RM for hypertrophy or 90% for maximal strength work. Knowing your 1RM lets you program workouts scientifically rather than guessing at weights." } },
    { "@@type": "Question", "name": "Which 1RM formula is most accurate?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Research suggests the Epley formula (weight × (1 + reps/30)) and Brzycki formula (weight × 36/(37 - reps)) are the most widely validated for most lifters. The Lander formula tends to perform well at higher rep ranges. Accuracy drops for all formulas above 10 reps — the best 1RM estimates come from sets of 3 to 5 reps at near-maximal effort. Using the average of all three formulas reduces individual formula error and gives a reliable central estimate." } },
    { "@@type": "Question", "name": "How do I test my 1RM safely?",
      "acceptedAnswer": { "@@type": "Answer", "text": "To test your 1RM safely, warm up thoroughly with progressive sets at 50%, 70%, 85%, and 95% of your estimated max. Rest 3–5 minutes between warm-up sets. For the actual attempt, load the bar to your target weight and attempt a single rep with full control. Always use a spotter for barbell exercises like bench press and squat. Alternatively, use this calculator with a heavy set of 3–5 reps to estimate your 1RM without the injury risk of an all-out single." } },
    { "@@type": "Question", "name": "What is a good bench press 1RM for my bodyweight?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Strength standards vary by training level. For men: untrained is below 0.75× bodyweight, beginner is around 1× bodyweight, intermediate is 1.25–1.5×, and advanced is 1.75× or above. For women: untrained is below 0.5× bodyweight, beginner is 0.65×, intermediate is 0.8–1.0×, and advanced is 1.25× or above. These are general benchmarks — individual factors like limb length, muscle insertion points, and training history all affect your ratio." } },
    { "@@type": "Question", "name": "How often should I test my 1RM?",
      "acceptedAnswer": { "@@type": "Answer", "text": "For most lifters, testing a true 1RM every 8–12 weeks is sufficient. Testing too frequently is fatiguing and carries injury risk without providing useful programming data. Between formal tests, you can use sub-maximal rep records (e.g., a new 5-rep PR) entered into this calculator to update your estimated 1RM. Powerlifters who compete often peak and test 1RM every 12–16 weeks aligned with their competition calendar." } }
  ]
}
</script>
@endsection

@php
$faqs = [
  ['q' => 'What is a one rep max (1RM)?',
   'a' => 'A one rep max (1RM) is the maximum amount of weight you can lift for a single repetition of a given exercise with proper form. It is the gold standard for measuring absolute strength in weightlifting and powerlifting. Your 1RM is used to calculate training loads as percentages — for example, lifting at 75% of your 1RM for hypertrophy or 90% for maximal strength work. Knowing your 1RM lets you program workouts scientifically rather than guessing at weights.'],
  ['q' => 'Which 1RM formula is most accurate?',
   'a' => 'Research suggests the Epley formula (weight × (1 + reps/30)) and Brzycki formula (weight × 36/(37 - reps)) are the most widely validated for most lifters. The Lander formula tends to perform well at higher rep ranges. Accuracy drops for all formulas above 10 reps — the best 1RM estimates come from sets of 3 to 5 reps at near-maximal effort. Using the average of all three formulas reduces individual formula error and gives a reliable central estimate.'],
  ['q' => 'How do I test my 1RM safely?',
   'a' => 'To test your 1RM safely, warm up thoroughly with progressive sets at 50%, 70%, 85%, and 95% of your estimated max. Rest 3–5 minutes between warm-up sets. For the actual attempt, load the bar to your target weight and attempt a single rep with full control. Always use a spotter for barbell exercises like bench press and squat. Alternatively, use this calculator with a heavy set of 3–5 reps to estimate your 1RM without the injury risk of an all-out single.'],
  ['q' => 'What is a good bench press 1RM for my bodyweight?',
   'a' => 'Strength standards vary by training level. For men: untrained is below 0.75× bodyweight, beginner is around 1× bodyweight, intermediate is 1.25–1.5×, and advanced is 1.75× or above. For women: untrained is below 0.5× bodyweight, beginner is 0.65×, intermediate is 0.8–1.0×, and advanced is 1.25× or above. These are general benchmarks — individual factors like limb length, muscle insertion points, and training history all affect your ratio.'],
  ['q' => 'How often should I test my 1RM?',
   'a' => 'For most lifters, testing a true 1RM every 8–12 weeks is sufficient. Testing too frequently is fatiguing and carries injury risk without providing useful programming data. Between formal tests, you can use sub-maximal rep records (e.g., a new 5-rep PR) entered into this calculator to update your estimated 1RM. Powerlifters who compete often peak and test 1RM every 12–16 weeks aligned with their competition calendar.'],
];

$relatedTools = [
  ['icon' => '📊', 'name' => 'BMI Calculator', 'slug' => 'bmi-calculator', 'desc' => 'Calculate your body mass index and healthy weight range.'],
  ['icon' => '🔥', 'name' => 'Calorie Calculator', 'slug' => 'calorie-calculator', 'desc' => 'Find your daily calorie needs based on activity and goals.'],
  ['icon' => '🥩', 'name' => 'Protein Calculator', 'slug' => 'protein-calculator', 'desc' => 'How much protein do you actually need per day?'],
  ['icon' => '📏', 'name' => 'Body Fat Calculator', 'slug' => 'body-fat-calculator', 'desc' => 'Estimate your body fat percentage using Navy method measurements.'],
  ['icon' => '❤️', 'name' => 'Heart Rate Calculator', 'slug' => 'heart-rate-calculator', 'desc' => 'Find your max heart rate and training zones for cardio.'],
  ['icon' => '📊', 'name' => 'Workout Volume Calculator', 'slug' => 'workout-volume-calculator', 'desc' => 'Calculate weekly sets, reps, and load per muscle group.'],
];
@endphp

@section('content')

{{-- ── 1. Hero / Tool ───────────────────────────────────────────────────────── --}}
<section class="ms-hero">
  <div class="container-xl">
    <div class="row align-items-start g-5">

      <div class="col-lg-7">
        <nav aria-label="breadcrumb" class="mb-3">
          <ol class="breadcrumb ms-breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/fitness-tools') }}">Fitness Tools</a></li>
            <li class="breadcrumb-item active">One Rep Max Calculator</li>
          </ol>
        </nav>

        <h1 class="mb-2 ms-hero-title">
          🏋️ One Rep Max Calculator — Estimate Your 1RM for Any Lift
        </h1>
        <p class="ms-hero-desc">
          Enter the weight you lifted and the reps you completed. Get your estimated 1RM plus a full training percentage breakdown.
        </p>

        {{-- ── Tool Card ────────────────────────────────────────────────────── --}}
        <div class="card border-0 mb-n4 ms-tool-card">
          <div class="card-body p-4 p-md-5">

            {{-- Unit toggle --}}
            <div class="d-flex gap-2 mb-4" role="group" aria-label="Weight unit">
              <button class="btn flex-fill orm-unit-btn active" data-unit="kg"
                style="border-radius:8px; font-weight:600; font-size:.88rem; background:var(--fitness); color:#fff; border:none;">
                kg
              </button>
              <button class="btn flex-fill orm-unit-btn" data-unit="lbs"
                style="border-radius:8px; font-weight:600; font-size:.88rem; background:#f8f9fa; color:#555; border:1px solid #e0e0e0;">
                lbs
              </button>
            </div>

            <div class="row g-3 mb-3">
              <div class="col-sm-6">
                <label for="ormWeight" class="form-label fw-semibold">Weight Lifted <span id="ormUnitLabel">(kg)</span></label>
                <input type="number" id="ormWeight" class="form-control" placeholder="e.g. 100" min="1" max="1000" step="0.5" aria-label="Weight lifted">
              </div>
              <div class="col-sm-6">
                <label for="ormReps" class="form-label fw-semibold">Reps Performed</label>
                <input type="number" id="ormReps" class="form-control" placeholder="e.g. 5" min="1" max="30" step="1" aria-label="Reps performed">
              </div>
            </div>

            <div id="ormRepsWarning" class="alert alert-warning py-2 px-3 mb-3 d-none" style="font-size:.83rem;">
              ⚠️ Accuracy decreases above 10 reps. For best results, use a set of 3–5 reps.
            </div>

            <div class="mb-4">
              <label for="ormFormula" class="form-label fw-semibold">Formula</label>
              <select id="ormFormula" class="form-select">
                <option value="average">Average of All Three</option>
                <option value="epley">Epley (1985)</option>
                <option value="brzycki">Brzycki</option>
                <option value="lander">Lander</option>
              </select>
            </div>

            <button class="btn btn-cta w-100" onclick="calculateORM()" style="font-size:1rem;">
              Calculate 1RM →
            </button>

            {{-- Results --}}
            <div id="ormResults" class="mt-4 d-none">
              <div style="height:1px; background:#f0f0f0; margin-bottom:20px;"></div>

              <div class="text-center mb-4">
                <div style="font-size:.8rem; color:#888; text-transform:uppercase; letter-spacing:.5px; font-weight:600; margin-bottom:4px;">Estimated 1RM</div>
                <div id="ormPrimary" style="font-size:2.8rem; font-weight:800; color:var(--fitness); line-height:1;"></div>
                <div id="ormUnitDisplay" style="font-size:.9rem; color:#888; margin-top:4px;"></div>
              </div>

              {{-- Formula comparison --}}
              <div class="mb-4">
                <p class="fw-semibold mb-2" style="font-size:.85rem; color:var(--primary-dark);">Formula Comparison</p>
                <div class="row g-2" id="ormFormulaBreakdown"></div>
              </div>

              {{-- Training percentages table --}}
              <div>
                <p class="fw-semibold mb-2" style="font-size:.85rem; color:var(--primary-dark);">Training Percentage Table</p>
                <div class="table-responsive">
                  <table class="table table-sm table-bordered mb-0" style="font-size:.82rem;">
                    <thead class="ms-table-head">
                      <tr>
                        <th>% of 1RM</th>
                        <th>Weight</th>
                        <th>Reps (approx)</th>
                        <th>Purpose</th>
                      </tr>
                    </thead>
                    <tbody id="ormPercentTable"></tbody>
                  </table>
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
          <h3 class="ms-facts-title">Quick Strength Facts</h3>
          @foreach([
            ['1RM', 'Maximum weight you can lift for one rep'],
            ['Epley', 'Most widely used 1RM formula (1985)'],
            ['3–5 reps', 'Best rep range for accurate 1RM estimate'],
            ['85% 1RM', 'Threshold for strength development'],
            ['30–40%', 'Strength loss from 2 weeks of detraining'],
          ] as [$stat, $label])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div class="ms-fact-pill ms-fact-pill-fitness">{{ $stat }}</div>
            <div class="ms-fact-label">{{ $label }}</div>
          </div>
          @endforeach
          <p class="ms-fact-source">Sources: NSCA, Epley (1985), Brzycki (1993)</p>
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
        <span class="ms-badge ms-badge-fitness mb-3">How It Works</span>
        <h2 class="mb-4">How 1RM Formulas Work: Epley, Brzycki, and Lander Compared</h2>
        <p>One rep max formulas were developed by sports scientists to predict maximal strength from sub-maximal lifting. Instead of attempting a dangerous true 1RM every training session, you perform a heavy set at 3–10 reps and plug the weight and reps into a formula.</p>
        <p>The three most validated formulas are Epley (1985), Brzycki (1993), and Lander (1985). Each uses a slightly different mathematical model. Epley uses an additive factor; Brzycki uses a ratio; Lander was specifically validated against actual 1RM tests in a lab setting.</p>
        <p>All formulas become less accurate above 10 reps because fatigue and muscular endurance play larger roles. For the most reliable estimate, use a weight you can lift for 3–5 strict reps before failure.</p>
      </div>
      <div class="col-lg-7">
        <div class="p-4 rounded-3 ms-data-box">
          <p class="fw-semibold mb-3" style="color:var(--primary-dark); font-size:.88rem; text-transform:uppercase; letter-spacing:.5px;">The Three Formulas</p>
          @foreach([
            ['Epley (1985)', 'weight × (1 + reps ÷ 30)', 'Most widely cited. Slightly overestimates at high reps. Best for sets of 1–10 reps.'],
            ['Brzycki (1993)', 'weight × 36 ÷ (37 − reps)', 'Very close to Epley at low reps. Diverges at 10+ reps. Popular in strength coaching.'],
            ['Lander (1985)', '(100 × weight) ÷ (101.3 − 2.67 × reps)', 'Lab-validated formula. Performs well across a wide rep range including higher reps.'],
          ] as [$name, $formula, $note])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div style="background:var(--fitness); color:#fff; border-radius:6px; padding:4px 10px; font-size:.75rem; font-weight:700; min-width:90px; text-align:center; flex-shrink:0; margin-top:2px;">{{ $name }}</div>
            <div>
              <div class="fw-semibold" style="font-size:.87rem; color:#1a1a2e; font-family:monospace;">{{ $formula }}</div>
              <div style="font-size:.8rem; color:#666; line-height:1.5;">{{ $note }}</div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ── 3. Strength Standards ─────────────────────────────────────────────────── --}}
<section class="ms-section-muted">
  <div class="container-xl">
    <div class="text-center mb-5">
      <h2>1RM Strength Standards by Experience Level</h2>
      <p class="text-muted" style="max-width:520px; margin:auto;">1RM as a multiple of bodyweight. Based on aggregated data from competitive powerlifting and sports science research.</p>
    </div>
    <div class="table-responsive">
      <table class="table table-bordered text-center" style="font-size:.87rem; max-width:700px; margin:auto;">
        <thead class="ms-table-head">
          <tr>
            <th>Level</th>
            <th>Bench Press (M)</th>
            <th>Bench Press (F)</th>
            <th>Squat (M)</th>
            <th>Deadlift (M)</th>
          </tr>
        </thead>
        <tbody>
          @foreach([
            ['Untrained', '< 0.75×', '< 0.50×', '< 1.0×', '< 1.0×'],
            ['Beginner', '1.0×', '0.65×', '1.25×', '1.5×'],
            ['Intermediate', '1.25×', '0.85×', '1.5×', '2.0×'],
            ['Advanced', '1.5×', '1.0×', '2.0×', '2.5×'],
            ['Elite', '1.75×+', '1.25×+', '2.5×+', '3.0×+'],
          ] as $row)
          <tr>
            @foreach($row as $i => $cell)
            <td style="{{ $i === 0 ? 'font-weight:600; color:var(--primary-dark);' : '' }}">{{ $cell }}</td>
            @endforeach
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <p class="text-center text-muted mt-3" style="font-size:.8rem;">Values are approximate bodyweight multiples. Individual variation is significant.</p>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="ormFaqAccordion" />


{{-- ── 5. Long-tail keyword sections ─────────────────────────────────────────── --}}
<section class="ms-section-accent">
  <div class="container ms-longtail">
    <h2 class="mb-4" style="color:var(--primary-dark);">One Rep Max Calculator for Bench Press — How to Test Safely</h2>
    <p>The bench press is the most commonly tested 1RM lift. Before attempting a bench press max, ensure you have a qualified spotter or use a power rack with properly set safety pins. Warm up with at least 3 progressive sets before your working attempt. A good warm-up protocol: 50% × 10, 70% × 5, 85% × 2, 95% × 1, then your max attempt. For estimated 1RM, use a weight where you reach failure between rep 3 and rep 6. This calculator's Epley and Brzycki results will be within 3–5% of your true max at that rep range.</p>
    <p>Grip width affects your bench press 1RM. A wider grip reduces range of motion and typically allows heavier weights but increases shoulder stress. Most strength standards are based on a grip approximately 1.5× shoulder width. Arch and leg drive are legal and widely used in powerlifting but reduce the effective range of motion — if you use them, your gym max may not translate directly to competition-style norms.</p>

    <h2 class="mt-5 mb-4" style="color:var(--primary-dark);">Squat and Deadlift 1RM Calculator — Powerlifting Standards</h2>
    <p>The squat and deadlift are the two highest-load lifts in most programs, meaning a true 1RM test carries more systemic fatigue and injury risk than the bench press. Estimated 1RM from a 3–5 rep set is especially valuable here. For the squat, depth matters — a 1RM achieved above parallel should not be compared to parallel or below-parallel standards. For the deadlift, conventional and sumo stances are biomechanically different enough that lifters often have significantly different 1RMs across the two variations.</p>
    <p>Elite powerlifting totals (squat + bench + deadlift combined) typically exceed 6–8× bodyweight for men and 4–5× bodyweight for women. Using this calculator for all three lifts gives you a combined total you can track as your overall strength progresses.</p>

    <h2 class="mt-5 mb-4" style="color:var(--primary-dark);">How to Use 1RM Percentages for Programming Your Training</h2>
    <p>Once you have your 1RM estimate, the training percentage table this calculator generates tells you exactly what weight to load for every rep target. If your bench press 1RM is 100 kg, training at 75% means 75 kg — typically allowing about 10 clean reps. At 85%, you're at 85 kg for 5–6 reps. This predictable relationship lets you auto-regulate training load as your max strength improves.</p>
    <p>Programs like 5/3/1 (Jim Wendler) use 90% of your true 1RM as a "training max" to build in buffer and reduce fatigue accumulation. If using such a program, enter 90% of your calculator result as your programming 1RM, not the full estimate. This approach produces consistent long-term progress without grinding close to failure every session.</p>
  </div>
</section>

<x-related-tools :tools="$relatedTools" heading="More Fitness Calculators" />


{{-- ── 7. SEO Block ──────────────────────────────────────────────────────────── --}}
<section class="ms-section-seo">
  <div class="container-xl">
    <div class="row justify-content-center">
      <div class="col-lg-8 ms-seo-body">
        <h2 class="mb-4 ms-seo-h2">One Rep Max Calculator: The Science Behind the Estimate</h2>
        <p>The concept of estimating maximal strength from submaximal efforts has roots in sports science going back to the 1970s. The Epley formula, published in 1985, became the most widely adopted because it was simple, usable without a calculator, and performed well across a range of lifters and exercises. Boyd Epley, the strength coach who developed it, needed a practical tool for programming hundreds of athletes without running 1RM tests constantly.</p>
        <h3 class="ms-seo-h3">Why Different Formulas Give Different Results</h3>
        <p>The Epley, Brzycki, and Lander formulas make different assumptions about the rate at which rep performance drops off as load increases. At low reps (1–5), all three formulas converge and give similar results. At higher reps (8–15), the formulas diverge because the relationship between load and reps is not perfectly linear — it curves, and each formula models that curve differently. This is why using the average of all three formulas is the most conservative and often most accurate approach.</p>
        <h3 class="ms-seo-h3">The Role of Fiber Type in 1RM Estimation</h3>
        <p>Lifters with a higher proportion of fast-twitch (Type II) muscle fibers tend to have higher true 1RMs relative to their rep performance at moderate loads. Conversely, lifters with more slow-twitch (Type I) fibers can sustain more reps at a given percentage of 1RM — meaning the formulas may slightly underestimate their true max. This individual variation is one reason no formula is universally accurate, and why using the average across multiple formulas reduces this error.</p>
        <div class="mt-4 p-4 rounded-3 ms-note ms-note-green">
          <p style="margin:0; font-size:.85rem; color:#155724;"><strong>Note:</strong> This calculator provides estimates for training guidance purposes. True 1RM testing carries injury risk. Always prioritise form over weight, use appropriate safety equipment, and consult a certified strength coach if you are new to maximal effort lifting.</p>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')
<script>
(function () {

  var currentUnit = 'kg';

  document.querySelectorAll('.orm-unit-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
      document.querySelectorAll('.orm-unit-btn').forEach(function (b) {
        b.classList.remove('active');
        b.style.background = '#f8f9fa';
        b.style.color = '#555';
        b.style.border = '1px solid #e0e0e0';
      });
      this.classList.add('active');
      this.style.background = 'var(--fitness)';
      this.style.color = '#fff';
      this.style.border = 'none';
      currentUnit = this.dataset.unit;
      document.getElementById('ormUnitLabel').textContent = '(' + currentUnit + ')';
      document.getElementById('ormResults').classList.add('d-none');
    });
  });

  document.getElementById('ormReps').addEventListener('input', function () {
    var reps = parseInt(this.value);
    document.getElementById('ormRepsWarning').classList.toggle('d-none', !(reps > 10));
  });

  window.calculateORM = function () {
    var weight = parseFloat(document.getElementById('ormWeight').value);
    var reps   = parseInt(document.getElementById('ormReps').value);
    var formula = document.getElementById('ormFormula').value;

    if (!weight || weight <= 0 || !reps || reps < 1 || reps > 30) {
      alert('Please enter a valid weight and reps (1–30).');
      return;
    }

    if (reps === 1) {
      showResults(weight, weight, weight, weight, reps, formula);
      return;
    }

    var epley   = weight * (1 + reps / 30);
    var brzycki = weight * 36 / (37 - reps);
    var lander  = (100 * weight) / (101.3 - 2.67123 * reps);
    var average = (epley + brzycki + lander) / 3;

    showResults(epley, brzycki, lander, average, reps, formula);
  };

  function showResults(epley, brzycki, lander, average, reps, formula) {
    var chosen;
    if (formula === 'epley')   chosen = epley;
    else if (formula === 'brzycki') chosen = brzycki;
    else if (formula === 'lander') chosen = lander;
    else chosen = average;

    document.getElementById('ormPrimary').textContent = chosen.toFixed(1);
    document.getElementById('ormUnitDisplay').textContent = currentUnit + ' estimated 1RM';

    // Formula comparison
    var breakdownHtml = '';
    var formulas = [
      { name: 'Epley', val: epley },
      { name: 'Brzycki', val: brzycki },
      { name: 'Lander', val: lander },
      { name: 'Average', val: average },
    ];
    formulas.forEach(function (f) {
      breakdownHtml += '<div class="col-6 col-md-3">'
        + '<div class="text-center p-2 rounded-2" style="background:#f8f9fa; border:1px solid #e0e0e0;">'
        + '<div style="font-size:1.1rem; font-weight:700; color:var(--fitness);">' + f.val.toFixed(1) + '</div>'
        + '<div class="ms-stat-label">' + f.name + '</div>'
        + '</div></div>';
    });
    document.getElementById('ormFormulaBreakdown').innerHTML = breakdownHtml;

    // Training percentage table
    var percentData = [
      { pct: 50, reps: '20+', purpose: 'Warm-up / Rehab' },
      { pct: 60, reps: '15–20', purpose: 'Endurance' },
      { pct: 70, reps: '12–15', purpose: 'Hypertrophy (volume)' },
      { pct: 75, reps: '10–12', purpose: 'Hypertrophy' },
      { pct: 80, reps: '8–10', purpose: 'Hypertrophy / Strength' },
      { pct: 85, reps: '5–6', purpose: 'Strength' },
      { pct: 90, reps: '3–4', purpose: 'Near-max strength' },
      { pct: 95, reps: '1–2', purpose: 'Peak / Competition prep' },
    ];
    var tableHtml = '';
    percentData.forEach(function (row) {
      var w = (chosen * row.pct / 100).toFixed(1);
      tableHtml += '<tr><td>' + row.pct + '%</td><td><strong>' + w + ' ' + currentUnit + '</strong></td><td>' + row.reps + '</td><td>' + row.purpose + '</td></tr>';
    });
    document.getElementById('ormPercentTable').innerHTML = tableHtml;

    document.getElementById('ormResults').classList.remove('d-none');
    document.getElementById('ormResults').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  }

})();
</script>
@endsection
