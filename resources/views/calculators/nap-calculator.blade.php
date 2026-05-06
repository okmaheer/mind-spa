@extends('layouts.app')

@section('title', 'Nap Calculator — Best Nap Length to Wake Up Refreshed | MindSnap')
@section('description', 'Free nap calculator: find the perfect nap length — 10-min power nap, 20-min refresher, or full 90-min sleep cycle. Avoid sleep inertia. Works for shift workers, students, and adults. No signup.')
@section('canonical', config('app.url') . '/nap-calculator')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "WebApplication",
  "name": "Nap Calculator",
  "url": "{{ config('app.url') }}/nap-calculator",
  "description": "Calculate the best nap length and wake-up time to feel refreshed and avoid sleep inertia.",
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
    { "@@type": "ListItem", "position": 1, "name": "Home",        "item": "{{ config('app.url') }}" },
    { "@@type": "ListItem", "position": 2, "name": "Sleep Tools", "item": "{{ config('app.url') }}/sleep-tools" },
    { "@@type": "ListItem", "position": 3, "name": "Nap Calculator" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [
    { "@@type": "Question", "name": "How long should a nap be?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The best nap lengths are 10–20 minutes (power nap — stays in light sleep, no grogginess) or exactly 90 minutes (one full sleep cycle — includes deep and REM sleep). Avoid 30–60 minute naps which typically end mid-way through deep sleep, causing significant sleep inertia." } },
    { "@@type": "Question", "name": "What is a power nap?",
      "acceptedAnswer": { "@@type": "Answer", "text": "A power nap is 10–20 minutes of light sleep (Stage 1 and early Stage 2). It restores alertness, reduces sleepiness, and improves mood without entering deep sleep, so you wake feeling refreshed rather than groggy. NASA research found 26-minute naps improved pilot performance by 34% and alertness by 54%." } },
    { "@@type": "Question", "name": "Will napping ruin my night sleep?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Naps before 3 PM generally don't affect night sleep for most people. Napping after 3 PM or napping longer than 90 minutes can reduce sleep pressure (adenosine buildup) enough to delay night-time sleep onset by 1–2 hours. If you have insomnia, avoid daytime napping entirely." } }
    ,{ "@@type": "Question", "name": "What is the best time of day to nap?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The optimal nap window is 1–3 PM, which coincides with a natural circadian dip most people experience after midday — independent of lunch. Napping before 1 PM may not be productive (sleep pressure is still low). Napping after 3 PM risks reducing nighttime sleep pressure enough to delay sleep onset by 1–2 hours." } },
    { "@@type": "Question", "name": "What is a coffee nap and does it work?",
      "acceptedAnswer": { "@@type": "Answer", "text": "A coffee nap involves drinking a coffee immediately before a 20-minute nap. Caffeine takes 20–30 minutes to cross the blood-brain barrier, so it kicks in exactly as you wake from light sleep — combining the alertness restoration of a nap with caffeine stimulation. Multiple studies show coffee naps outperform either napping or coffee alone for post-nap alertness." } }
  ]
}
</script>
@endsection

@php
$faqs = [
  ['q' => 'How long should a nap be to avoid feeling groggy?',
             'a' => 'Keep naps under 20 minutes (power nap) or exactly 90 minutes (full cycle). Both options end before or after deep sleep, so you wake during light sleep. The danger zone is 30–60 minutes — this typically ends mid-deep-sleep, causing sleep inertia that can last 30–90 minutes.'],
  ['q' => 'What is the NASA nap study about?',
             'a' => 'A 1995 NASA study of military pilots found that a 40-minute nap (with ~26 minutes of actual sleep) improved performance by 34% and alertness by 54% versus no nap. Subsequent studies at NASA and Harvard confirmed that short naps are one of the most effective alertness interventions available.'],
  ['q' => 'Will a 90-minute nap count as part of my sleep quota?',
             'a' => 'Partially. A 90-minute nap reduces nighttime sleep pressure by roughly 1–1.5 hours, so you may find it harder to fall asleep that night and may sleep 1 hour less. For most people with adequate nighttime sleep, occasional 90-minute naps are fine. For those with insomnia, all daytime sleep should be avoided.'],
  ['q' => 'What is the "coffee nap" technique?',
             'a' => 'Drink a coffee (or espresso) immediately before a 20-minute nap. Caffeine takes 20–30 minutes to cross the blood-brain barrier, so it kicks in exactly as you wake from light sleep — combining the alertness of a nap with caffeine. Research shows coffee naps produce significantly better alertness than either napping or coffee alone.'],
  ['q' => 'When is the worst time to nap?',
             'a' => 'Avoid napping after 3–4 PM. The circadian drive for sleep builds through the day; napping late reduces enough sleep pressure to significantly delay nighttime sleep onset. The natural nap window is 1–3 PM, which aligns with a minor circadian dip that most people experience after lunch.'],
  ['q' => 'What is the best time of day to take a nap?',
             'a' => 'The optimal window is <strong>1–3 PM</strong> — this aligns with the natural post-midday circadian dip that most people experience regardless of whether they ate lunch. Napping before 1 PM is less productive because sleep pressure is still building. Napping after 3 PM risks cutting into nighttime sleep pressure enough to delay your bedtime by 1–2 hours.'],
  ['q' => 'What is a coffee nap and does it really work?',
             'a' => 'Drink a shot of espresso or coffee immediately before a 20-minute power nap. Caffeine takes 20–30 minutes to reach peak blood concentration, so it kicks in precisely as you wake from light sleep. The combination produces significantly better alertness than either napping or caffeine alone. Research from Loughborough University found coffee naps reduced driving-related errors by 91% versus rest alone.'],
  ['q' => 'Is a 2-hour nap too long?', 'a' => 'A 2-hour nap (approximately 1.3 sleep cycles) lands you mid-cycle at wake time, causing significant sleep inertia and grogginess. It also substantially reduces nighttime sleep pressure, making it harder to fall asleep at bedtime. Unless you are severely sleep-deprived or ill, a 2-hour nap is too long. Stick to either 20 minutes or a full 90 minutes.'],
  ['q' => 'What is a NASA nap and does it work?', 'a' => 'A NASA nap is a 26-minute nap studied by NASA researchers on sleepy military pilots. The study found a 26-minute nap improved performance by 34% and alertness by 100%. It works because 26 minutes is long enough to gain restorative light sleep but short enough to avoid slow-wave deep sleep — meaning you wake alert, not groggy. It has since become the gold standard for workplace napping.'],
  ['q' => 'Should I nap every day?', 'a' => 'Daily napping is healthy and normal — over a third of the world\'s population naps regularly. Countries with siesta cultures (Spain, Greece, Mexico) have historically lower rates of cardiovascular disease. For most adults, a daily 10–20 minute nap improves afternoon alertness, mood, and performance. The only people who should avoid daily napping are those with chronic insomnia, as napping reduces nighttime sleep pressure.'],
];

$relatedTools = [
  ['icon' => '😴', 'name' => 'Sleep Calculator', 'slug' => 'sleep-calculator', 'desc' => 'Best bedtime based on your wake-up time.'],
  ['icon' => '⏰', 'name' => 'Wake-Up Calculator', 'slug' => 'wake-up-calculator', 'desc' => 'Best wake-up times from your bedtime.'],
  ['icon' => '📉', 'name' => 'Sleep Debt Calculator', 'slug' => 'sleep-debt-calculator', 'desc' => 'How much sleep are you missing this week?'],
  ['icon' => '☕', 'name' => 'Caffeine & Sleep', 'slug' => 'caffeine-sleep-calculator', 'desc' => 'Last safe coffee time for your bedtime.'],
  ['icon' => '✈️', 'name' => 'Jet Lag Calculator', 'slug' => 'jet-lag-calculator', 'desc' => 'Recovery plan for long-haul flights.'],
  ['icon' => '📋', 'name' => 'Sleep Quality Quiz', 'slug' => 'sleep-quality-quiz', 'desc' => 'Score your sleep quality in 10 questions.'],
];
@endphp

@section('styles')
<style>
.nap-type-btn           { border:2px solid #e0e0e0; cursor:pointer; background:#fff; transition:all .15s; }
.nap-type-btn.nap-active{ border-color:var(--sleep); background:rgba(108,99,255,.06); }
.nap-type-radio         { margin-top:3px; accent-color:var(--sleep); }
.nap-type-name          { font-weight:700; font-size:.9rem; color:var(--primary-dark); }
.nap-type-sub           { font-size:.8rem; color:#888; margin-top:2px; }
.nap-custom-warn        { background:#fff8e1; border:1px solid #ffc107; font-size:.8rem; color:#856404; }
.nap-card-green         { background:#d1eddb; border:1px solid rgba(21,87,36,.19); }
.nap-card-yellow        { background:#fff3cd; border:1px solid rgba(102,77,3,.19); }
.nap-card-blue          { background:#cce5ff; border:1px solid rgba(0,64,133,.19); }
.nap-card-icon          { font-size:2rem; margin-bottom:12px; }
.nap-card-dur           { font-size:1.3rem; font-weight:800; }
.nap-card-label         { font-weight:700; font-size:.85rem; margin:4px 0 12px; text-transform:uppercase; letter-spacing:.5px; }
.nap-card-desc          { font-size:.85rem; color:#555; line-height:1.7; margin-bottom:16px; }
.nap-card-li            { font-size:.8rem; font-weight:600; padding:3px 0; }
.nap-card-green .nap-card-dur,.nap-card-green .nap-card-label,.nap-card-green .nap-card-li { color:#155724; }
.nap-card-yellow .nap-card-dur,.nap-card-yellow .nap-card-label,.nap-card-yellow .nap-card-li { color:#664d03; }
.nap-card-blue .nap-card-dur,.nap-card-blue .nap-card-label,.nap-card-blue .nap-card-li { color:#004085; }
.nap-culture-h          { font-size:1rem; }
.nap-culture-flag       { font-size:1.5rem; flex-shrink:0; line-height:1; padding-top:2px; }
.nap-result-power       { background:#d1eddb; border:1px solid rgba(21,87,36,.19); }
.nap-result-full        { background:#cce5ff; border:1px solid rgba(0,64,133,.19); }
.nap-result-warn        { background:#fff3cd; border:1px solid rgba(102,77,3,.19); }
.nap-result-power .nap-result-label,.nap-result-power .nap-result-time,.nap-result-power .nap-result-note { color:#155724; }
.nap-result-full .nap-result-label,.nap-result-full .nap-result-time,.nap-result-full .nap-result-note { color:#004085; }
.nap-result-warn .nap-result-label,.nap-result-warn .nap-result-time,.nap-result-warn .nap-result-note { color:#664d03; }
.nap-result-icon        { font-size:2rem; margin-bottom:8px; }
.nap-result-label       { font-size:.8rem; font-weight:700; text-transform:uppercase; letter-spacing:.5px; margin-bottom:8px; }
.nap-result-start       { font-size:1rem; color:#555; margin-bottom:4px; }
.nap-result-time        { font-size:2rem; font-weight:800; }
.nap-result-cta         { font-size:.85rem; color:#555; margin-bottom:4px; }
.nap-result-dur         { font-size:.8rem; color:#888; }
.nap-result-note        { background:rgba(255,255,255,.7); font-size:.8rem; text-align:left; }
</style>
@endsection

@section('content')

<section class="ms-hero">
  <div class="container-xl">
    <div class="row align-items-start g-5">

      <div class="col-lg-7">
        <x-breadcrumb :crumbs="[
          ['url' => route('home'), 'name' => 'Home'],
          ['url' => route('category.sleep'), 'name' => 'Sleep Tools'],
          ['url' => '', 'name' => 'Nap Calculator'],
        ]"/>

        <h1 class="mb-2 ms-hero-title">
          💤 Nap Calculator — Best Nap Length & Wake-Up Time
        </h1>
        <p class="ms-hero-desc">
          Find the best nap length and exact wake-up time to restore your energy without waking up groggy.
        </p>

        <div class="card border-0 mb-n4 ms-tool-card">
          <div class="card-body p-4 p-md-5">

            <div class="mb-4">
              <label for="napStart" class="form-label fw-600">What time will you start your nap?</label>
              <input type="time" id="napStart" class="form-control" value="14:00" aria-label="Nap start time">
            </div>

            <div class="mb-4">
              <label class="form-label fw-600 d-block mb-2">Choose your nap type:</label>
              <div class="d-flex flex-column gap-2" id="napTypeGroup">
                @foreach([
                  ['power','⚡ Power Nap (10–20 min)','Light sleep only. Zero grogginess. Best for work breaks.','10'],
                  ['full','🔄 Full Cycle (90 min)','Deep + REM sleep. Ideal for recovery, creativity, shift workers.','90'],
                  ['custom','⏱ Custom duration','I know exactly how long I want to nap.',''],
                ] as [$val,$label,$desc,$mins])
                <label class="nap-type-btn d-flex align-items-start gap-3 p-3 rounded-3" data-val="{{ $val }}">
                  <input type="radio" name="napType" value="{{ $val }}" {{ $val === 'power' ? 'checked' : '' }}
                         class="nap-type-radio" onchange="toggleNapType()">
                  <div>
                    <div class="nap-type-name">{{ $label }}</div>
                    <div class="nap-type-sub">{{ $desc }}</div>
                  </div>
                </label>
                @endforeach
              </div>
            </div>

            <div id="customDur" class="mb-4 d-none">
              <label for="customMin" class="form-label fw-600">Custom nap duration (minutes)</label>
              <input type="number" id="customMin" class="form-control" value="30" min="5" max="180" aria-label="Custom nap duration">
              <div class="mt-2 p-2 rounded nap-custom-warn d-none" id="customWarning"></div>
            </div>

            <button class="btn btn-cta w-100" onclick="calcNap()">
              Calculate Nap →
            </button>

            <div id="napResult" class="mt-4 d-none">
              <div class="ms-divider"></div>
              <div id="napResultContent"></div>
            </div>

          </div>
        </div>
      </div>

      <div class="col-lg-5 d-none d-lg-block pt-2">
        <div class="ms-facts-wrap">
          <h3 class="ms-facts-title">Nap Science at a Glance</h3>
          @foreach([
            ['34%',    'Performance improvement from a 26-min nap (NASA)'],
            ['20 min', 'Maximum power nap — stays in light sleep only'],
            ['90 min', 'Full cycle nap — same as one night sleep cycle'],
            ['3 PM',   'Latest recommended nap time to protect night sleep'],
            ['1–4 PM', 'Natural circadian dip — ideal nap window for most people'],
          ] as [$stat, $label])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div class="ms-fact-pill ms-fact-pill-sleep">{{ $stat }}</div>
            <div class="ms-fact-label">{{ $label }}</div>
          </div>
          @endforeach
        </div>
      </div>

    </div>
  </div>
</section>

{{-- Nap Types Guide --}}
<section class="ms-section-white">
  <div class="container-xl">
    <div class="text-center mb-5">
      <h2>Which Nap Length Is Right for You?</h2>
      <p class="text-muted ms-intro-text">Not all naps are equal. The wrong duration leaves you feeling worse than no nap at all.</p>
    </div>
    <div class="row g-4">
      @foreach([
        ['⚡','10–20 Minutes','Power Nap','nap-card-green','#155724',
         'Stays in Stage 1 and early Stage 2 light sleep. No grogginess on waking — alertness and concentration restored within minutes. Ideal for office workers, students, drivers on long journeys.',
         ['Lunch break boost','Pre-exam focus','Long drive recovery','Post-workout refresh']],
        ['⚠️','30–60 Minutes','Avoid This Zone','nap-card-yellow','#664d03',
         'You will likely enter Stage 3 deep sleep but not complete a full cycle. Waking mid-deep-sleep causes significant sleep inertia — worse grogginess than no nap at all. This is the dead zone.',
         ['Causes grogginess','Disrupts night sleep','Reduces motivation','Performance drops']],
        ['🔄','90 Minutes','Full Cycle Nap','nap-card-blue','#004085',
         'Completes one full sleep cycle including deep NREM and REM sleep. You wake at the natural end of the cycle — alert and refreshed. Includes creative REM sleep that boosts problem-solving and memory.',
         ['Shift workers','Heavy physical training','Sleep debt recovery','Creative work boost']],
      ] as [$icon,$dur,$label,$cardCls,$color,$desc,$uses])
      <div class="col-md-4">
        <div class="h-100 p-4 rounded-3 {{ $cardCls }}">
          <div class="nap-card-icon">{{ $icon }}</div>
          <div class="nap-card-dur">{{ $dur }}</div>
          <div class="nap-card-label">{{ $label }}</div>
          <p class="nap-card-desc">{{ $desc }}</p>
          <ul class="list-unstyled mb-0">
            @foreach($uses as $u)
            <li class="nap-card-li">→ {{ $u }}</li>
            @endforeach
          </ul>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- Science of Napping --}}
<section class="ms-section-white">
  <div class="container-xl">
    <div class="row align-items-start g-5">
      <div class="col-lg-6">
        <span class="ms-badge ms-badge-sleep mb-3">The Science</span>
        <h2 class="mb-4">The Science of Napping: What Studies Actually Show</h2>
        <p>A landmark 1995 NASA study of long-haul military pilots found that a <strong>26-minute nap</strong> improved cognitive performance by 34% and alertness by 54% versus a no-nap control. This study directly led to NASA's formal nap policy for astronauts and long-haul flight crews.</p>
        <p>A 2008 University of California study compared a 90-minute nap to rote learning and found the nap group significantly outperformed on a memory test 6 hours later — with nap participants who achieved REM sleep performing best of all. REM sleep's role in memory consolidation and creative problem-solving is now well-established.</p>
        <p>A 2021 study in <em>General Psychiatry</em> found that regular nappers (1–2 times per week) had significantly better cognitive function, larger brain volume in multiple regions, and higher scores on processing speed and visuospatial ability than non-nappers — controlling for age, health, and sleep duration.</p>
      </div>
      <div class="col-lg-6">
        <h3 class="nap-culture-h mb-3">Napping Across Cultures</h3>
        <div class="d-flex flex-column gap-3">
          @foreach([
            ['🇪🇸','Spain — Siesta','The traditional Spanish siesta of 20–30 minutes has physiological backing. Spain has historically lower afternoon cardiovascular event rates during siesta hours — though modernisation has largely ended the practice.'],
            ['🇯🇵','Japan — Inemuri','Japanese workplace culture formally accepts <em>inemuri</em> (sleeping while present) as a sign of dedication — you work so hard you need to recover. Many Japanese companies now provide designated nap rooms.'],
            ['🇩🇪','Germany — Mittagsschlaf','The midday rest (Mittagsschlaf) is common in rural Germany. Research from the University of Düsseldorf confirmed cognitive benefits matching the NASA findings.'],
            ['🌍','Universal biology','The 1–3 PM circadian dip is not cultural — it occurs in populations without access to heavy meals and in people who haven\'t eaten. It is a hardwired biological rhythm.'],
          ] as [$flag,$title,$desc])
          <div class="d-flex gap-3">
            <div class="nap-culture-flag">{{ $flag }}</div>
            <div>
              <div class="fw-bold ms-ref-title mb-1">{{ $title }}</div>
              <div class="ms-ref-desc">{!! $desc !!}</div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="napFaq" />


<section class="ms-section-accent">
  <div class="container ms-longtail">
    <h2 class="mb-4 text-brand">Best Nap Time for Night Shift Workers</h2>
    <p>Night shift workers benefit most from a "split sleep" strategy: a primary sleep period of 5–6 hours after the shift ends, followed by a 20–30 minute power nap 1–2 hours before the next shift. This pre-shift nap significantly improves alertness during the first half of a night shift without interfering with the main sleep period. Avoid napping longer than 30 minutes before a shift — you risk entering deep sleep and waking groggy.</p>
    <h2 class="mt-5 mb-4 text-brand">How Long Should a Nap Be for Adults?</h2>
    <p>For most adults, the ideal nap is either 10–20 minutes (power nap — light sleep only, no grogginess) or exactly 90 minutes (one full cycle — includes REM, restores creativity and memory). The 30–60 minute range is the worst choice: long enough to enter deep slow-wave sleep, but not long enough to complete a cycle. You wake mid-cycle feeling worse than before the nap. If you cannot spare 90 minutes, always choose under 25 minutes.</p>
    <h2 class="mt-5 mb-4 text-brand">Is Napping Good or Bad for Nighttime Sleep?</h2>
    <p>Napping is not bad for nighttime sleep when timed correctly. The critical rule: finish all naps by 3:00 pm. Napping after 3:00 pm reduces sleep pressure (adenosine build-up) enough to delay sleep onset by 1–2 hours and reduce deep sleep in the following night. Morning naps (before noon) have the least impact on nighttime sleep and highest REM content, making them ideal for creative recovery and memory consolidation.</p>
  </div>
</section>

<x-related-tools :tools="$relatedTools" heading="More Sleep Tools" />


@endsection

@section('scripts')
<script>
(function () {
  function parseTime(str) {
    var p = str.split(':');
    return parseInt(p[0]) * 60 + parseInt(p[1]);
  }

  function formatTime(m) {
    m = ((m % 1440) + 1440) % 1440;
    var h = Math.floor(m / 60), mn = m % 60;
    var period = h >= 12 ? 'PM' : 'AM';
    var hd = h % 12 === 0 ? 12 : h % 12;
    return hd + ':' + (mn < 10 ? '0' + mn : mn) + ' ' + period;
  }

  window.toggleNapType = function () {
    var val = document.querySelector('input[name="napType"]:checked').value;
    document.getElementById('customDur').classList.toggle('d-none', val !== 'custom');
    updateCustomWarning();
    // highlight selected
    document.querySelectorAll('.nap-type-btn').forEach(function (b) {
      b.classList.toggle('nap-active', b.dataset.val === val);
    });
  };

  window.updateCustomWarning = function () {
    var min = parseInt(document.getElementById('customMin').value || 30);
    var w = document.getElementById('customWarning');
    if (min > 20 && min < 90) {
      w.textContent = '⚠️ ' + min + ' minutes may end mid-deep-sleep, causing grogginess. Consider 20 min (power nap) or 90 min (full cycle) instead.';
      w.classList.remove('d-none');
    } else {
      w.classList.add('d-none');
    }
  };

  document.getElementById('customMin').addEventListener('input', updateCustomWarning);

  // init highlight
  toggleNapType();

  window.calcNap = function () {
    var startVal = document.getElementById('napStart').value;
    if (!startVal) return;
    var startMin = parseTime(startVal);
    var type = document.querySelector('input[name="napType"]:checked').value;
    var dur, label, note, icon, bg, color;

    if (type === 'power') {
      dur = 20; icon = '⚡'; label = 'Power Nap'; bg = '#d1eddb'; color = '#155724';
      note = 'You\'ll stay in light sleep (Stage 1–2). Set your alarm firmly — no snoozing. You\'ll feel alert within 2–3 minutes of waking.';
    } else if (type === 'full') {
      dur = 90; icon = '🔄'; label = 'Full Sleep Cycle'; bg = '#cce5ff'; color = '#004085';
      note = 'This completes one full cycle including deep and REM sleep. You\'ll wake at the natural cycle end — refreshed. Allow 5 minutes to fully orient.';
    } else {
      dur = parseInt(document.getElementById('customMin').value || 30);
      icon = '⏱'; label = dur + '-Minute Nap'; bg = '#fff3cd'; color = '#664d03';
      if (dur > 20 && dur < 90) {
        note = '⚠️ This duration likely ends mid-deep-sleep. You may wake feeling groggy. Consider adjusting to 20 or 90 minutes.';
      } else {
        note = '';
      }
    }

    var wakeMin = startMin + dur;
    var theme = type === 'power' ? 'nap-result-power' : (type === 'full' ? 'nap-result-full' : 'nap-result-warn');
    var html = '<div class="p-4 rounded-3 text-center ' + theme + '">'
      + '<div class="nap-result-icon">' + icon + '</div>'
      + '<div class="nap-result-label">' + label + '</div>'
      + '<div class="nap-result-start">Nap starts: <strong>' + formatTime(startMin) + '</strong></div>'
      + '<div class="nap-result-time">' + formatTime(wakeMin) + '</div>'
      + '<div class="nap-result-cta">← Set your alarm for this time</div>'
      + '<div class="nap-result-dur">' + dur + ' minutes</div>'
      + (note ? '<div class="mt-3 p-2 rounded nap-result-note">' + note + '</div>' : '')
      + '</div>';

    document.getElementById('napResultContent').innerHTML = html;
    document.getElementById('napResult').classList.remove('d-none');
    document.getElementById('napResult').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  };
})();
</script>
@endsection
