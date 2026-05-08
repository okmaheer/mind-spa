@extends('layouts.app')

@section('title', 'Workout Volume Calculator — Sets per Muscle Group | MindSnap')
@section('description', 'Free workout volume calculator: track total training volume (sets × reps × weight) per muscle group and see if you are in the MEV, MAV, or MRV range. No signup.')
@section('canonical', config('app.url') . '/workout-volume-calculator')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "WebApplication",
  "name": "Workout Volume Calculator",
  "url": "{{ config('app.url') }}/workout-volume-calculator",
  "description": "Calculate total training volume per muscle group and identify your MEV, MAV, and MRV training landmarks.",
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
    { "@@type": "ListItem", "position": 1, "name": "Home",          "item": "{{ config('app.url') }}" },
    { "@@type": "ListItem", "position": 2, "name": "Fitness Tools", "item": "{{ config('app.url') }}/fitness-tools" },
    { "@@type": "ListItem", "position": 3, "name": "Workout Volume Calculator" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [
    { "@@type": "Question", "name": "What is training volume in weightlifting?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Training volume is the total mechanical work done in a workout. It's usually calculated as sets × reps × weight (also called tonnage). Volume can also be expressed as just sets per muscle group per week — a simpler metric that research has linked strongly to hypertrophy outcomes. Higher weekly volume generally produces more muscle growth, up to a recoverable maximum." } },
    { "@@type": "Question", "name": "How many sets per week should I do per muscle group?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Research by Dr. Mike Israetel suggests the Minimum Effective Volume (MEV) for most muscle groups is 8–10 sets per week. The Maximum Adaptive Volume (MAV) — the sweet spot for growth — is roughly 12–20 sets per week per muscle group. The Maximum Recoverable Volume (MRV) is 20–25+ sets, beyond which recovery is compromised and gains stall. Beginners respond to lower volumes; advanced trainees need more." } },
    { "@@type": "Question", "name": "What is MEV, MAV, and MRV in training?",
      "acceptedAnswer": { "@@type": "Answer", "text": "MEV (Minimum Effective Volume) is the least work needed to trigger muscle growth. MAV (Maximum Adaptive Volume) is the range that produces the best growth while remaining recoverable. MRV (Maximum Recoverable Volume) is the most work you can recover from — beyond this, performance declines and overtraining risk rises. These landmarks vary by muscle group, individual recovery capacity, and training history." } },
    { "@@type": "Question", "name": "Can too much volume hurt muscle growth?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes — exceeding your MRV means you're creating more damage than you can recover from. Symptoms include persistent soreness lasting more than 72 hours, declining performance week over week, poor sleep, and elevated resting heart rate. Volume should increase gradually (5–10% per week) and drop back down in a deload week every 4–8 weeks. More volume is only better if you can recover from it." } },
    { "@@type": "Question", "name": "How should I split volume across the week?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Muscle protein synthesis peaks 24–36 hours after a training stimulus and returns to baseline after about 48–72 hours. This means training each muscle group 2–3 times per week is more effective than a once-weekly bro split. Spreading 16 sets of chest across 2 sessions (8 sets each) produces more muscle than doing all 16 in one session, because each session triggers a fresh MPS spike." } }
  ]
}
</script>
@endsection

@php
$faqs = [
  ['q' => 'What is training volume in weightlifting?',
             'a' => 'Training volume is the total mechanical work done in a training session or week. It\'s calculated as sets × reps × weight (called tonnage), though for hypertrophy purposes, sets per muscle group per week is the most useful metric. Research consistently shows that weekly volume is one of the strongest predictors of muscle hypertrophy — more sets per muscle (up to a recoverable limit) means more growth.'],
  ['q' => 'How many sets per week should I do per muscle group?',
             'a' => 'Research by Dr. Mike Israetel suggests the Minimum Effective Volume (MEV) is 8–10 sets per week for most muscle groups. The Maximum Adaptive Volume (MAV) — the growth sweet spot — is roughly 12–20 sets per week. The Maximum Recoverable Volume (MRV) is 20–25+ sets, beyond which recovery is compromised. Beginners respond to lower volumes; advanced trainees need more stimulus to keep progressing.'],
  ['q' => 'What is MEV, MAV, and MRV in training?',
             'a' => 'MEV (Minimum Effective Volume) is the least training needed to trigger muscle growth. MAV (Maximum Adaptive Volume) is the range producing the best growth while remaining recoverable week over week. MRV (Maximum Recoverable Volume) is the most work you can recover from — beyond this, performance and recovery both decline. These landmarks are not fixed numbers; they shift based on exercise selection, intensity, sleep, nutrition, and individual recovery capacity.'],
  ['q' => 'Can too much volume hurt muscle growth?',
             'a' => 'Yes — exceeding your MRV means creating more tissue damage than you can repair in time for the next session. Symptoms include soreness lasting more than 72 hours, strength declining week over week, disrupted sleep, elevated resting heart rate, and persistent fatigue. Volume should increase gradually (add 2 sets per week, not 8) and should drop back down in a planned deload week every 4–8 weeks.'],
  ['q' => 'How should I split volume across the week?',
             'a' => 'Muscle protein synthesis (MPS) peaks 24–36 hours after training and returns to baseline at 48–72 hours. Training each muscle group 2–3 times per week is more effective than once-weekly training at equal total volume. Splitting 16 sets of chest across two 8-set sessions triggers two separate MPS spikes instead of one, producing more total protein synthesis across the week. This is why full-body or upper-lower splits often outperform bro splits for hypertrophy.'],
  ['q' => '{{ $q }}', 'a' => '{{ $a }}'],
];

$relatedTools = [
  ['icon' => '🏋️', 'name' => 'One Rep Max', 'slug' => 'one-rep-max-calculator', 'desc' => 'Estimate your 1RM and get training % for every rep range.'],
  ['icon' => '🔥', 'name' => 'Calorie Calculator', 'slug' => 'calorie-calculator', 'desc' => 'Find your TDEE to support your training goals.'],
  ['icon' => '🥩', 'name' => 'Protein Calculator', 'slug' => 'protein-calculator', 'desc' => 'Get your daily protein target for muscle recovery.'],
  ['icon' => '📏', 'name' => 'Body Fat Calculator', 'slug' => 'body-fat-calculator', 'desc' => 'Estimate body fat % and lean mass from measurements.'],
  ['icon' => '❤️', 'name' => 'Heart Rate Zones', 'slug' => 'heart-rate-calculator', 'desc' => 'Find your cardio training zones for conditioning.'],
  ['icon' => '💪', 'name' => 'BMI Calculator', 'slug' => 'bmi-calculator', 'desc' => 'Check your weight-to-height ratio.'],
];
@endphp

@section('styles')
<style>
.wv-add-btn    { border:2px dashed #e0e0e0; border-radius:10px; color:var(--cta-text); font-weight:600; padding:12px; }
.wv-tbl-sm     { font-size:.83rem; }
.wv-mev        { color:var(--fitness); }
.wv-mav        { color:#0b7285; }
.wv-mrv        { color:#c23152; }
.wv-sub        { max-width:480px; margin:auto; }
.wv-prog-card  { border-radius:12px; box-shadow:0 2px 12px rgba(0,0,0,.06); }
.wv-prog-w1 { background:#edfff3; }
.wv-prog-w2 { background:#e8f4ff; }
.wv-prog-w3 { background:#fff3e0; }
.wv-prog-w4 { background:#fff0f3; }
.wv-prog-w1 .wv-prog-val { color:var(--fitness); }
.wv-prog-w2 .wv-prog-val { color:#0b7285; }
.wv-prog-w3 .wv-prog-val { color:#e97b1e; }
.wv-prog-w4 .wv-prog-val { color:#c23152; }
.wv-week-label { font-size:.8rem; color:#888; text-transform:uppercase; letter-spacing:.5px; }
.wv-prog-val   { font-size:1.4rem; }
.wv-prog-desc  { font-size:.82rem; color:#555; margin-bottom:6px; }
.wv-form-label { font-size:.82rem; }
.wv-input      { min-height:42px; }
.wv-select     { min-height:42px; font-size:.85rem; }
.wv-rm-btn     { border:1px solid #eee; color:#aaa; min-height:42px; }
.wv-muscle-col { min-width:120px; }
.wv-bar-track  { background:#e0e0e0; border-radius:50px; height:8px; overflow:hidden; }
.wv-bar-fill   { height:8px; border-radius:50px; }
.wv-bar-labels { font-size:.7rem; color:#aaa; }
.wv-sets-val   { font-size:1.1rem; font-weight:700; }
.wv-sets-txt   { font-size:.68rem; color:#888; }
.wv-status-txt { font-size:.72rem; font-weight:600; }
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
          ['url' => route('category.fitness'), 'name' => 'Fitness Tools'],
          ['url' => '', 'name' => 'Workout Volume Calculator'],
        ]"/>
        <h1 class="mb-2 ms-hero-title">
          📊 Workout Volume Calculator — Sets, Reps & Load for Muscle Growth
        </h1>
        <p class="ms-hero-desc">
          Log your exercises, see weekly volume per muscle group, and find out if you're in the MEV, MAV, or MRV range.
        </p>

        <div class="card border-0 mb-n4 ms-tool-card">
          <div class="card-body p-4 p-md-5">
            <p class="fw-600 mb-3 text-sm text-brand">Add exercises to your week:</p>
            <div id="exerciseList"></div>
            <button type="button" onclick="addExercise()" class="btn w-100 mb-4 wv-add-btn">
              + Add Exercise
            </button>
            <button class="btn btn-cta w-100" onclick="calcVolume()">Calculate Volume →</button>

            <div id="volResults" class="mt-4 d-none">
              <div class="ms-divider"></div>
              <p class="fw-600 mb-3 text-sm text-brand">Weekly volume by muscle group:</p>
              <div id="volGrid"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-5 d-none d-lg-block pt-2">
        <div class="ms-facts-wrap">
          <h3 class="ms-facts-title">Volume Landmarks</h3>
          @foreach([
            ['MEV','Minimum Effective Volume — ~8–10 sets/wk per muscle'],
            ['MAV','Maximum Adaptive Volume — ~12–20 sets/wk (growth zone)'],
            ['MRV','Maximum Recoverable Volume — ~20–25+ sets/wk (overtraining risk)'],
            ['2–3×/wk','Optimal training frequency per muscle group'],
            ['48–72h','Minimum recovery time between sessions per muscle'],
          ] as [$stat,$label])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div class="ms-fact-pill ms-fact-pill-fitness">{{ $stat }}</div>
            <div class="ms-fact-label">{{ $label }}</div>
          </div>
          @endforeach
          <p class="ms-fact-source">Source: Israetel, Hoffmann & Smith 2019</p>
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
        <span class="ms-badge ms-badge-fitness mb-3">How It Works</span>
        <h2 class="mb-4">What Is Training Volume and Why Does It Drive Muscle Growth?</h2>
<img src="{{ asset('images/workout-volume-guide.svg') }}" alt="Workout volume guide showing recommended weekly sets per muscle group for hypertrophy" width="640" height="160" loading="lazy" class="img-fluid rounded-3 mb-4">
        <p>Volume is the primary driver of muscle hypertrophy. A landmark 2017 meta-analysis by Schoenfeld et al. found a clear dose-response relationship: more weekly sets per muscle group = more muscle growth, up to a recoverable threshold. The relationship held across beginners and intermediates alike.</p>
        <p>The concept of volume landmarks — MEV, MAV, and MRV — comes from Dr. Mike Israetel's RP Strength research. MEV is the minimum you need to grow. MAV is where optimal growth happens. MRV is the ceiling above which recovery breaks down.</p>
        <p>This calculator tracks your total sets per muscle group across all your logged exercises, then positions you within these landmarks so you can make informed programming decisions.</p>
      </div>
      <div class="col-lg-7">
        <div class="p-4 rounded-3 ms-data-box">
          <p class="ms-data-label fw-600 mb-3">Volume landmarks by muscle group (sets/week)</p>
          <div class="table-responsive">
            <table class="table table-sm mb-0 wv-tbl-sm">
              <thead><tr class="text-muted"><th>Muscle Group</th><th>MEV</th><th>MAV</th><th>MRV</th></tr></thead>
              <tbody>
                @foreach([
                  ['Chest','8','12–20','22'],
                  ['Back','10','14–22','25'],
                  ['Shoulders','8','16–22','26'],
                  ['Biceps','8','14–20','26'],
                  ['Triceps','8','14–18','22'],
                  ['Quads','8','12–20','25'],
                  ['Hamstrings','6','10–16','20'],
                  ['Calves','8','12–16','20'],
                  ['Glutes','4','10–16','20'],
                ] as [$m,$mev,$mav,$mrv])
                <tr><td>{{ $m }}</td><td class="wv-mev">{{ $mev }}</td><td class="wv-mav">{{ $mav }}</td><td class="wv-mrv">{{ $mrv }}+</td></tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Volume principles --}}
<section class="ms-section-muted">
  <div class="container-xl">
    <div class="text-center mb-5">
      <h2>Progressive Overload: How to Increase Volume Over Time</h2>
      <p class="text-muted wv-sub">Volume should increase gradually. Here's a sustainable 4-week progression model.</p>
    </div>
    <div class="row g-3 justify-content-center">
      @foreach([
        ['Week 1','MEV','Start at minimum effective volume','8–10 sets per muscle group','wv-prog-w1'],
        ['Week 2','+2 sets','Add 2 sets across major muscles','10–12 sets per muscle group','wv-prog-w2'],
        ['Week 3','+2 sets','Push into the MAV range','12–14 sets per muscle group','wv-prog-w3'],
        ['Week 4','Deload','Drop back to MEV or below','5–6 sets — let the gains consolidate','wv-prog-w4'],
      ] as [$week,$label,$desc,$sets,$cls])
      <div class="col-sm-6 col-lg-3">
        <div class="card border-0 h-100 text-center p-3 wv-prog-card {{ $cls }}">
          <div class="fw-700 wv-week-label">{{ $week }}</div>
          <div class="fw-700 my-2 wv-prog-val">{{ $label }}</div>
          <div class="wv-prog-desc">{{ $desc }}</div>
          <div class="text-xs text-muted">{{ $sets }}</div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="wvFaq" />


{{-- Long-tail --}}
<section class="ms-section-accent">
  <div class="container ms-longtail">
    <h2 class="mb-4 text-brand">How Many Sets Per Week for Maximum Muscle Growth?</h2>
    <p>The dose-response curve for volume and hypertrophy shows increasing returns up to roughly 20 hard sets per muscle group per week for most people. Beyond that, returns flatten and recovery becomes the limiting factor. For beginners, as few as 10 sets per week per muscle produces near-maximal hypertrophy — the nervous system adaptations early in training don't require high volumes. As you advance, your muscles adapt to the stimulus and need progressively more volume to keep growing.</p>
    <p>The most important practical point: 16 sets per week in 2–3 sessions beats 16 sets per week in 1 session. Frequency is how you earn more productive volume.</p>

    <h2 class="mt-5 mb-4 text-brand">Beginner vs Advanced Workout Volume — How Much Is Too Much?</h2>
    <p>Beginners can grow with 6–12 sets per muscle group per week and often see their best gains in the first 6–12 months with relatively low volume. The rapid gains come primarily from neural adaptations — the brain learns to recruit more motor units, not from dramatic muscle growth. Intermediate lifters (1–3 years) typically need 12–18 sets per week to keep progressing. Advanced trainees (3+ years) often need 16–22+ sets in periodised programs with planned deloads.</p>

    <h2 class="mt-5 mb-4 text-brand">How to Track Weekly Training Volume for Progressive Overload</h2>
    <p>Keep a training log (notebook, app, or spreadsheet) with every set: exercise, reps, weight. At the end of each week, sum the sets per muscle group. Over a 4-week mesocycle, increase sets by 2 per week until you approach your MRV, then deload. Compare your tonnage (sets × reps × weight) from week 1 to week 4 — an increase in tonnage at the same RPE means you got stronger. This is the most reliable indicator that your volume is calibrated correctly.</p>
  </div>
</section>

<x-related-tools :tools="$relatedTools" heading="More Fitness Calculators" />


{{-- SEO block --}}
<section class="ms-section-seo">
  <div class="container-xl">
    <div class="row justify-content-center">
      <div class="col-lg-8 ms-seo-body">
        <h2 class="mb-4 ms-seo-h2">Training Volume: The Most Underrated Variable in Muscle Building</h2>
        <p>Most gym-goers focus obsessively on which exercises to do and how heavy to go — but the biggest predictor of long-term hypertrophy is simpler: how many hard sets per muscle group do you do each week, consistently, over months and years?</p>
        <h3 class="ms-seo-h3">Why Consistency Beats Intensity</h3>
        <p>A single brutal session doesn't build muscle — repeated, manageable stimuli do. Taking every set to absolute failure generates enormous amounts of muscle damage and metabolic stress, but the recovery demand is so high that frequency suffers. Training to 1–2 reps in reserve (RIR) and doing more sets per week consistently produces better long-term results than grinding to failure on fewer sets.</p>
        <div class="mt-4 p-4 rounded-3 ms-note ms-note-green">
          <p class="mb-0 text-sm"><strong>Note:</strong> Volume recommendations are general guidelines based on research populations. Individual recovery capacity, sleep quality, nutrition, stress levels, and training history all affect your personal MEV, MAV, and MRV. If in doubt, start at lower volumes and increase gradually.</p>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')
<script>
(function () {
  var MUSCLES = ['Chest','Back','Shoulders','Biceps','Triceps','Quads','Hamstrings','Glutes','Calves','Core','Full Body'];
  var MEV = { Chest:8, Back:10, Shoulders:8, Biceps:8, Triceps:8, Quads:8, Hamstrings:6, Glutes:4, Calves:8, Core:6, 'Full Body':0 };
  var MAV = { Chest:16, Back:18, Shoulders:19, Biceps:17, Triceps:15, Quads:16, Hamstrings:13, Glutes:13, Calves:14, Core:16, 'Full Body':0 };
  var MRV = { Chest:22, Back:25, Shoulders:26, Biceps:26, Triceps:22, Quads:25, Hamstrings:20, Glutes:20, Calves:20, Core:25, 'Full Body':0 };

  var exCount = 0;

  window.addExercise = function () {
    exCount++;
    var div = document.createElement('div');
    div.className = 'row g-2 mb-3 align-items-end exercise-row';
    div.id = 'ex' + exCount;

    var muscleOpts = MUSCLES.map(function(m){ return '<option value="'+m+'">'+m+'</option>'; }).join('');
    div.innerHTML = '<div class="col-12 col-sm-4">'
      + '<label class="form-label fw-600 wv-form-label">Exercise name</label>'
      + '<input type="text" class="form-control ex-name wv-input" placeholder="e.g. Bench Press">'
      + '</div>'
      + '<div class="col-6 col-sm-2">'
      + '<label class="form-label fw-600 wv-form-label">Muscle group</label>'
      + '<select class="form-select ex-muscle wv-select">'+muscleOpts+'</select>'
      + '</div>'
      + '<div class="col-3 col-sm-1">'
      + '<label class="form-label fw-600 wv-form-label">Sets</label>'
      + '<input type="number" class="form-control ex-sets wv-input" value="3" min="1" max="20">'
      + '</div>'
      + '<div class="col-3 col-sm-1">'
      + '<label class="form-label fw-600 wv-form-label">Reps</label>'
      + '<input type="number" class="form-control ex-reps wv-input" value="10" min="1" max="50">'
      + '</div>'
      + '<div class="col-6 col-sm-2">'
      + '<label class="form-label fw-600 wv-form-label">Weight (kg)</label>'
      + '<input type="number" class="form-control ex-weight wv-input" value="60" min="0">'
      + '</div>'
      + '<div class="col-6 col-sm-2 d-flex align-items-end">'
      + '<button type="button" onclick="document.getElementById(\'ex'+exCount+'\').remove()" class="btn w-100 wv-rm-btn">✕ Remove</button>'
      + '</div>';

    document.getElementById('exerciseList').appendChild(div);
  };

  window.calcVolume = function () {
    var rows = document.querySelectorAll('.exercise-row');
    if (rows.length === 0) { addExercise(); return; }

    var totals = {};
    MUSCLES.forEach(function(m){ totals[m] = { sets: 0, tonnage: 0 }; });

    rows.forEach(function (row) {
      var muscle  = row.querySelector('.ex-muscle').value;
      var sets    = parseInt(row.querySelector('.ex-sets').value) || 0;
      var reps    = parseInt(row.querySelector('.ex-reps').value) || 0;
      var weight  = parseFloat(row.querySelector('.ex-weight').value) || 0;
      if (muscle === 'Full Body') {
        ['Chest','Back','Shoulders','Quads','Hamstrings','Glutes'].forEach(function(m){
          totals[m].sets    += Math.ceil(sets * 0.5);
          totals[m].tonnage += sets * reps * weight * 0.5;
        });
      } else {
        totals[muscle].sets    += sets;
        totals[muscle].tonnage += sets * reps * weight;
      }
    });

    var html = '';
    var active = MUSCLES.filter(function(m){ return m !== 'Full Body' && totals[m].sets > 0; });
    if (active.length === 0) { html = '<p class="text-muted">No exercises logged yet.</p>'; }

    active.forEach(function (m) {
      var sets = totals[m].sets;
      var mev = MEV[m], mav = MAV[m], mrv = MRV[m];
      var status, color, bg;
      if (sets < mev)       { status = 'Below MEV'; color='#888';         bg='#f5f5f5'; }
      else if (sets <= mav) { status = 'In MAV ✓';  color='var(--fitness)'; bg='#edfff3'; }
      else if (sets <= mrv) { status = 'Near MRV ⚠'; color='#e97b1e';    bg='#fff8ec'; }
      else                  { status = 'Over MRV ✗'; color='#c23152';    bg='#fff0f3'; }

      html += '<div class="d-flex align-items-center gap-3 p-3 mb-2 rounded" style="background:'+bg+'; border-left:4px solid '+color+';">'
        + '<div class="wv-muscle-col"><div class="fw-600 text-sm text-brand">'+m+'</div>'
        + '<div class="text-xs text-muted">Tonnage: '+(totals[m].tonnage/1000).toFixed(1)+'t</div></div>'
        + '<div class="flex-grow-1">'
        + '<div class="wv-bar-track">'
        + '<div class="wv-bar-fill" style="background:'+color+'; width:'+Math.min(100, (sets/mrv)*100).toFixed(0)+'%;"></div>'
        + '</div>'
        + '<div class="d-flex justify-content-between mt-1 wv-bar-labels">'
        + '<span>MEV '+mev+'</span><span>MAV '+mav+'</span><span>MRV '+mrv+'</span>'
        + '</div></div>'
        + '<div class="text-end"><div class="wv-sets-val" style="color:'+color+';">'+sets+'</div>'
        + '<div class="wv-sets-txt">sets</div>'
        + '<div class="wv-status-txt" style="color:'+color+';">'+status+'</div>'
        + '</div></div>';
    });

    document.getElementById('volGrid').innerHTML = html;
    document.getElementById('volResults').classList.remove('d-none');
    document.getElementById('volResults').scrollIntoView({ behavior:'smooth', block:'nearest' });
  };

  // Add one exercise row on load
  addExercise();
})();
</script>
@endsection
