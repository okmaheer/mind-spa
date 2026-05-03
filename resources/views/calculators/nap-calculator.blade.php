@extends('layouts.app')

@section('title', 'Nap Calculator — Best Nap Length to Wake Up Refreshed | MindSnap')
@section('description', 'Find the perfect nap duration: 10-min power nap, 20-min refresher, or full 90-min sleep cycle. Avoid sleep inertia. Enter your nap time and get the ideal wake-up.')
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

@section('content')

<section style="background:linear-gradient(135deg, var(--primary-dark) 0%, #16213e 100%); padding:60px 0 0;">
  <div class="container-xl">
    <div class="row align-items-start g-5">

      <div class="col-lg-7">
        <nav aria-label="breadcrumb" class="mb-3">
          <ol class="breadcrumb" style="font-size:.82rem; margin:0; padding:0; background:none;">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:rgba(255,255,255,.5);">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('category.sleep') }}" style="color:rgba(255,255,255,.5);">Sleep Tools</a></li>
            <li class="breadcrumb-item active" style="color:rgba(255,255,255,.8);">Nap Calculator</li>
          </ol>
        </nav>

        <h1 class="mb-2" style="color:#fff; font-size:clamp(1.9rem,4vw,2.8rem);">
          💤 Nap Calculator
        </h1>
        <p style="color:rgba(255,255,255,.7); font-size:1.05rem; max-width:520px; margin-bottom:28px;">
          Find the best nap length and exact wake-up time to restore your energy without waking up groggy.
        </p>

        <div class="card border-0 mb-n4" style="border-radius:18px; box-shadow:0 20px 60px rgba(0,0,0,.25); position:relative; z-index:2;">
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
                <label class="nap-type-btn d-flex align-items-start gap-3 p-3 rounded-3" data-val="{{ $val }}"
                       style="border:2px solid #e0e0e0; cursor:pointer; background:#fff; transition:all .15s;">
                  <input type="radio" name="napType" value="{{ $val }}" {{ $val === 'power' ? 'checked' : '' }}
                         style="margin-top:3px; accent-color:var(--sleep);" onchange="toggleNapType()">
                  <div>
                    <div style="font-weight:700; font-size:.9rem; color:var(--primary-dark);">{{ $label }}</div>
                    <div style="font-size:.8rem; color:#888; margin-top:2px;">{{ $desc }}</div>
                  </div>
                </label>
                @endforeach
              </div>
            </div>

            <div id="customDur" class="mb-4 d-none">
              <label for="customMin" class="form-label fw-600">Custom nap duration (minutes)</label>
              <input type="number" id="customMin" class="form-control" value="30" min="5" max="180" aria-label="Custom nap duration">
              <div class="mt-2 p-2 rounded" style="background:#fff8e1; border:1px solid #ffc107; font-size:.8rem; color:#856404;" id="customWarning"></div>
            </div>

            <button class="btn btn-cta w-100" onclick="calcNap()" style="font-size:1rem;">
              Calculate Nap →
            </button>

            <div id="napResult" class="mt-4 d-none">
              <div style="height:1px; background:#f0f0f0; margin-bottom:16px;"></div>
              <div id="napResultContent"></div>
            </div>

          </div>
        </div>
      </div>

      <div class="col-lg-5 d-none d-lg-block" style="padding-top:10px;">
        <div style="color:rgba(255,255,255,.85);">
          <h3 style="color:#fff; font-size:.9rem; text-transform:uppercase; letter-spacing:.5px; font-weight:600; margin-bottom:16px;">Nap Science at a Glance</h3>
          @foreach([
            ['34%',    'Performance improvement from a 26-min nap (NASA)'],
            ['20 min', 'Maximum power nap — stays in light sleep only'],
            ['90 min', 'Full cycle nap — same as one night sleep cycle'],
            ['3 PM',   'Latest recommended nap time to protect night sleep'],
            ['1–4 PM', 'Natural circadian dip — ideal nap window for most people'],
          ] as [$stat, $label])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div style="background:var(--sleep); color:#fff; border-radius:8px; padding:6px 10px; font-weight:700; font-size:.88rem; min-width:58px; text-align:center; flex-shrink:0;">{{ $stat }}</div>
            <div style="font-size:.86rem; line-height:1.5; padding-top:4px;">{{ $label }}</div>
          </div>
          @endforeach
        </div>
      </div>

    </div>
  </div>
</section>

{{-- Nap Types Guide --}}
<section style="background:#fff; padding:72px 0;">
  <div class="container-xl">
    <div class="text-center mb-5">
      <h2>Which Nap Length Is Right for You?</h2>
      <p class="text-muted" style="max-width:520px; margin:0 auto;">Not all naps are equal. The wrong duration leaves you feeling worse than no nap at all.</p>
    </div>
    <div class="row g-4">
      @foreach([
        ['⚡','10–20 Minutes','Power Nap','#d1eddb','#155724',
         'Stays in Stage 1 and early Stage 2 light sleep. No grogginess on waking — alertness and concentration restored within minutes. Ideal for office workers, students, drivers on long journeys.',
         ['Lunch break boost','Pre-exam focus','Long drive recovery','Post-workout refresh']],
        ['⚠️','30–60 Minutes','Avoid This Zone','#fff3cd','#664d03',
         'You will likely enter Stage 3 deep sleep but not complete a full cycle. Waking mid-deep-sleep causes significant sleep inertia — worse grogginess than no nap at all. This is the dead zone.',
         ['Causes grogginess','Disrupts night sleep','Reduces motivation','Performance drops']],
        ['🔄','90 Minutes','Full Cycle Nap','#cce5ff','#004085',
         'Completes one full sleep cycle including deep NREM and REM sleep. You wake at the natural end of the cycle — alert and refreshed. Includes creative REM sleep that boosts problem-solving and memory.',
         ['Shift workers','Heavy physical training','Sleep debt recovery','Creative work boost']],
      ] as [$icon,$dur,$label,$bg,$color,$desc,$uses])
      <div class="col-md-4">
        <div class="h-100 p-4 rounded-3" style="background:{{ $bg }}; border:1px solid {{ $color }}30;">
          <div style="font-size:2rem; margin-bottom:12px;">{{ $icon }}</div>
          <div style="font-size:1.3rem; font-weight:800; color:{{ $color }};">{{ $dur }}</div>
          <div style="font-weight:700; color:{{ $color }}; font-size:.85rem; margin:4px 0 12px; text-transform:uppercase; letter-spacing:.5px;">{{ $label }}</div>
          <p style="font-size:.85rem; color:#555; line-height:1.7; margin-bottom:16px;">{{ $desc }}</p>
          <ul style="list-style:none; padding:0; margin:0;">
            @foreach($uses as $u)
            <li style="font-size:.8rem; color:{{ $color }}; font-weight:600; padding:3px 0;">→ {{ $u }}</li>
            @endforeach
          </ul>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- Science of Napping --}}
<section style="padding:56px 0; background:#fff;">
  <div class="container-xl">
    <div class="row align-items-start g-5">
      <div class="col-lg-6">
        <span class="badge mb-3" style="background:rgba(108,99,255,.1); color:var(--sleep); font-size:.8rem; padding:6px 14px; border-radius:50px; font-weight:600;">The Science</span>
        <h2 class="mb-4">What Research Says About Napping</h2>
        <p>A landmark 1995 NASA study of long-haul military pilots found that a <strong>26-minute nap</strong> improved cognitive performance by 34% and alertness by 54% versus a no-nap control. This study directly led to NASA's formal nap policy for astronauts and long-haul flight crews.</p>
        <p>A 2008 University of California study compared a 90-minute nap to rote learning and found the nap group significantly outperformed on a memory test 6 hours later — with nap participants who achieved REM sleep performing best of all. REM sleep's role in memory consolidation and creative problem-solving is now well-established.</p>
        <p>A 2021 study in <em>General Psychiatry</em> found that regular nappers (1–2 times per week) had significantly better cognitive function, larger brain volume in multiple regions, and higher scores on processing speed and visuospatial ability than non-nappers — controlling for age, health, and sleep duration.</p>
      </div>
      <div class="col-lg-6">
        <h3 style="font-size:1rem;" class="mb-3">Napping Across Cultures</h3>
        <div class="d-flex flex-column gap-3">
          @foreach([
            ['🇪🇸','Spain — Siesta','The traditional Spanish siesta of 20–30 minutes has physiological backing. Spain has historically lower afternoon cardiovascular event rates during siesta hours — though modernisation has largely ended the practice.'],
            ['🇯🇵','Japan — Inemuri','Japanese workplace culture formally accepts <em>inemuri</em> (sleeping while present) as a sign of dedication — you work so hard you need to recover. Many Japanese companies now provide designated nap rooms.'],
            ['🇩🇪','Germany — Mittagsschlaf','The midday rest (Mittagsschlaf) is common in rural Germany. Research from the University of Düsseldorf confirmed cognitive benefits matching the NASA findings.'],
            ['🌍','Universal biology','The 1–3 PM circadian dip is not cultural — it occurs in populations without access to heavy meals and in people who haven\'t eaten. It is a hardwired biological rhythm.'],
          ] as [$flag,$title,$desc])
          <div class="d-flex gap-3">
            <div style="font-size:1.5rem; flex-shrink:0; line-height:1; padding-top:2px;">{{ $flag }}</div>
            <div>
              <div style="font-weight:700; font-size:.88rem; color:var(--primary-dark); margin-bottom:4px;">{{ $title }}</div>
              <div style="font-size:.8rem; color:#666; line-height:1.6;">{!! $desc !!}</div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

{{-- FAQ --}}
<section style="background:var(--bg); padding:72px 0;">
  <div class="container-xl">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <h2 class="text-center mb-5">Frequently Asked Questions</h2>
        <div class="accordion" id="napFaq">
          @foreach([
            ['How long should a nap be to avoid feeling groggy?',
             'Keep naps under 20 minutes (power nap) or exactly 90 minutes (full cycle). Both options end before or after deep sleep, so you wake during light sleep. The danger zone is 30–60 minutes — this typically ends mid-deep-sleep, causing sleep inertia that can last 30–90 minutes.'],
            ['What is the NASA nap study about?',
             'A 1995 NASA study of military pilots found that a 40-minute nap (with ~26 minutes of actual sleep) improved performance by 34% and alertness by 54% versus no nap. Subsequent studies at NASA and Harvard confirmed that short naps are one of the most effective alertness interventions available.'],
            ['Will a 90-minute nap count as part of my sleep quota?',
             'Partially. A 90-minute nap reduces nighttime sleep pressure by roughly 1–1.5 hours, so you may find it harder to fall asleep that night and may sleep 1 hour less. For most people with adequate nighttime sleep, occasional 90-minute naps are fine. For those with insomnia, all daytime sleep should be avoided.'],
            ['What is the "coffee nap" technique?',
             'Drink a coffee (or espresso) immediately before a 20-minute nap. Caffeine takes 20–30 minutes to cross the blood-brain barrier, so it kicks in exactly as you wake from light sleep — combining the alertness of a nap with caffeine. Research shows coffee naps produce significantly better alertness than either napping or coffee alone.'],
            ['When is the worst time to nap?',
             'Avoid napping after 3–4 PM. The circadian drive for sleep builds through the day; napping late reduces enough sleep pressure to significantly delay nighttime sleep onset. The natural nap window is 1–3 PM, which aligns with a minor circadian dip that most people experience after lunch.'],
            ['What is the best time of day to take a nap?',
             'The optimal window is <strong>1–3 PM</strong> — this aligns with the natural post-midday circadian dip that most people experience regardless of whether they ate lunch. Napping before 1 PM is less productive because sleep pressure is still building. Napping after 3 PM risks cutting into nighttime sleep pressure enough to delay your bedtime by 1–2 hours.'],
            ['What is a coffee nap and does it really work?',
             'Drink a shot of espresso or coffee immediately before a 20-minute power nap. Caffeine takes 20–30 minutes to reach peak blood concentration, so it kicks in precisely as you wake from light sleep. The combination produces significantly better alertness than either napping or caffeine alone. Research from Loughborough University found coffee naps reduced driving-related errors by 91% versus rest alone.'],
          ] as $i => [$q, $a])
          <div class="accordion-item border-0 mb-2" style="border-radius:10px; overflow:hidden; box-shadow:0 2px 10px rgba(0,0,0,.05);">
            <h3 class="accordion-header">
              <button class="accordion-button {{ $i > 0 ? 'collapsed' : '' }} fw-600"
                      type="button" data-bs-toggle="collapse" data-bs-target="#napFaq{{ $i }}"
                      style="font-size:.9rem; background:#fff; color:var(--primary-dark);">{{ $q }}</button>
            </h3>
            <div id="napFaq{{ $i }}" class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}" data-bs-parent="#napFaq">
              <div class="accordion-body" style="color:#555; font-size:.88rem; line-height:1.75;">{{ $a }}</div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Related Tools --}}
<section style="background:#fff; padding:60px 0;">
  <div class="container-xl">
    <h2 class="mb-4">More Sleep Tools</h2>
    <div class="row g-3">
      @foreach([
        ['sleep-calculator','😴','Sleep Calculator','Best bedtime based on your wake-up time.'],
        ['wake-up-calculator','⏰','Wake-Up Calculator','Best wake-up times from your bedtime.'],
        ['sleep-debt-calculator','📉','Sleep Debt Calculator','How much sleep are you missing this week?'],
        ['caffeine-sleep-calculator','☕','Caffeine & Sleep','Last safe coffee time for your bedtime.'],
        ['jet-lag-calculator','✈️','Jet Lag Calculator','Recovery plan for long-haul flights.'],
        ['sleep-quality-quiz','📋','Sleep Quality Quiz','Score your sleep quality in 10 questions.'],
      ] as [$slug,$icon,$name,$desc])
      <div class="col-sm-6 col-lg-4">
        <a href="{{ url($slug) }}" class="card border-0 text-decoration-none h-100 p-3"
           style="border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,.06); display:flex; flex-direction:row; align-items:center; gap:12px; transition:transform .15s;"
           onmouseover="this.style.transform='translateY(-3px)'" onmouseout="this.style.transform=''">
          <div style="font-size:1.6rem; flex-shrink:0;">{{ $icon }}</div>
          <div>
            <div class="fw-600" style="font-size:.88rem; color:var(--primary-dark);">{{ $name }}</div>
            <div style="font-size:.78rem; color:#888; margin-top:2px;">{{ $desc }}</div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
  </div>
</section>

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
      var isActive = b.dataset.val === val;
      b.style.borderColor = isActive ? 'var(--sleep)' : '#e0e0e0';
      b.style.background = isActive ? 'rgba(108,99,255,.06)' : '#fff';
    });
  };

  window.updateCustomWarning = function () {
    var min = parseInt(document.getElementById('customMin').value || 30);
    var w = document.getElementById('customWarning');
    if (min > 20 && min < 90) {
      w.textContent = '⚠️ ' + min + ' minutes may end mid-deep-sleep, causing grogginess. Consider 20 min (power nap) or 90 min (full cycle) instead.';
      w.style.display = 'block';
    } else {
      w.style.display = 'none';
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
    var html = '<div class="p-4 rounded-3 text-center" style="background:' + bg + '; border:1px solid ' + color + '30;">'
      + '<div style="font-size:2rem; margin-bottom:8px;">' + icon + '</div>'
      + '<div style="font-size:.8rem; font-weight:700; color:' + color + '; text-transform:uppercase; letter-spacing:.5px; margin-bottom:8px;">' + label + '</div>'
      + '<div style="font-size:1rem; color:#555; margin-bottom:4px;">Nap starts: <strong>' + formatTime(startMin) + '</strong></div>'
      + '<div style="font-size:2rem; font-weight:800; color:' + color + ';">' + formatTime(wakeMin) + '</div>'
      + '<div style="font-size:.85rem; color:#555; margin-bottom:4px;">← Set your alarm for this time</div>'
      + '<div style="font-size:.8rem; color:#888;">' + dur + ' minutes</div>'
      + (note ? '<div class="mt-3 p-2 rounded" style="background:rgba(255,255,255,.7); font-size:.8rem; color:' + color + '; text-align:left;">' + note + '</div>' : '')
      + '</div>';

    document.getElementById('napResultContent').innerHTML = html;
    document.getElementById('napResult').classList.remove('d-none');
    document.getElementById('napResult').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  };
})();
</script>
@endsection
