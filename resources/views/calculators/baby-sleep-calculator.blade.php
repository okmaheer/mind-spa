@extends('layouts.app')

@section('title', 'Baby Sleep Calculator — Nap Schedule & Bedtime by Age | MindSnap')
@section('description', 'Free baby sleep calculator. Get the ideal nap schedule, number of naps, and bedtime for your baby\'s age — from newborn to 3 years. Based on pediatric sleep guidelines.')
@section('canonical', config('app.url') . '/baby-sleep-calculator')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "WebApplication",
  "name": "Baby Sleep Calculator",
  "url": "{{ config('app.url') }}/baby-sleep-calculator",
  "description": "Calculate the ideal sleep schedule, nap times, and bedtime for babies and toddlers based on age.",
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
    { "@@type": "ListItem", "position": 3, "name": "Baby Sleep Calculator" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [
    { "@@type": "Question", "name": "How much sleep does a newborn need?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Newborns (0–3 months) need 14–17 hours of total sleep per day, spread across multiple short sleep periods. They do not yet have an established circadian rhythm and sleep in 2–4 hour blocks. Night feeds are expected and normal." } },
    { "@@type": "Question", "name": "When do babies sleep through the night?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Most babies can sleep 6–8 hour stretches by 4–6 months when they have sufficient weight and caloric intake. However, sleeping through the night (8–12 hours) is more typical at 6–9 months. Every baby is different — genetics, feeding method, and temperament all play roles." } },
    { "@@type": "Question", "name": "What is a wake window for babies?",
      "acceptedAnswer": { "@@type": "Answer", "text": "A wake window is the maximum time a baby can comfortably stay awake between sleeps. It increases with age: newborns can manage only 45–60 minutes, while a 12-month-old can handle 3–4 hours. Exceeding the wake window causes overtiredness, which paradoxically makes it harder for the baby to fall and stay asleep." } }
    ,{ "@@type": "Question", "name": "Is room-sharing or bed-sharing safer for babies?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The AAP (American Academy of Pediatrics) recommends room-sharing (baby's crib or bassinet in the parents' room) for at least the first 6 months and ideally the first year. Room sharing reduces SIDS risk by up to 50%. Bed sharing (sharing the same sleep surface) is not recommended by the AAP due to increased risk of suffocation and SIDS, particularly for infants under 4 months." } },
    { "@@type": "Question", "name": "How do I know if my baby is overtired?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Signs of an overtired baby include: increased fussiness beyond normal hunger cues, arching the back, difficulty settling despite obvious sleepiness, rubbing eyes vigorously, pulling ears, yawning frequently, losing interest in stimulation, and crying that escalates rather than settles. Acting on early sleep cues before overtiredness sets in makes settling significantly easier and reduces night waking." } }
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
            <li class="breadcrumb-item active" style="color:rgba(255,255,255,.8);">Baby Sleep Calculator</li>
          </ol>
        </nav>

        <h1 class="mb-2" style="color:#fff; font-size:clamp(1.9rem,4vw,2.8rem);">
          👶 Baby Sleep Calculator
        </h1>
        <p style="color:rgba(255,255,255,.7); font-size:1.05rem; max-width:520px; margin-bottom:28px;">
          Enter your baby's age and first wake-up time to get a personalised nap schedule, bedtime, and total sleep target.
        </p>

        <div class="card border-0 mb-n4" style="border-radius:18px; box-shadow:0 20px 60px rgba(0,0,0,.25); position:relative; z-index:2;">
          <div class="card-body p-4 p-md-5">

            <div class="mb-4">
              <label for="babyAge" class="form-label fw-600">Baby's age</label>
              <select id="babyAge" class="form-select" onchange="updateAgeInfo()">
                <option value="0">Newborn (0–4 weeks)</option>
                <option value="1">1 month</option>
                <option value="2">2 months</option>
                <option value="3">3 months</option>
                <option value="4">4 months</option>
                <option value="5">5 months</option>
                <option value="6">6 months</option>
                <option value="7">7 months</option>
                <option value="8">8 months</option>
                <option value="9">9 months</option>
                <option value="10">10 months</option>
                <option value="11">11 months</option>
                <option value="12">12 months (1 year)</option>
                <option value="15">15 months</option>
                <option value="18">18 months</option>
                <option value="24">2 years</option>
                <option value="30">2.5 years</option>
                <option value="36">3 years</option>
              </select>
            </div>

            <div id="ageInfo" class="mb-4 p-3 rounded-3" style="background:#f0f4ff; border:1px solid var(--sleep)30; font-size:.85rem; color:#444; line-height:1.6;"></div>

            <div class="mb-4">
              <label for="morningWake" class="form-label fw-600">Typical morning wake-up time</label>
              <input type="time" id="morningWake" class="form-control" value="07:00" aria-label="Morning wake time">
            </div>

            <button class="btn btn-cta w-100" onclick="calcBabySleep()" style="font-size:1rem;">
              Generate Sleep Schedule →
            </button>

            <div id="babyResult" class="mt-4 d-none">
              <div style="height:1px; background:#f0f0f0; margin-bottom:16px;"></div>
              <div id="babySchedule"></div>
            </div>

          </div>
        </div>
      </div>

      <div class="col-lg-5 d-none d-lg-block" style="padding-top:10px;">
        <div style="color:rgba(255,255,255,.85);">
          <h3 style="color:#fff; font-size:.9rem; text-transform:uppercase; letter-spacing:.5px; font-weight:600; margin-bottom:16px;">Baby Sleep at a Glance</h3>
          @foreach([
            ['14–17h', 'Total sleep needed: Newborns'],
            ['12–15h', 'Total sleep needed: 4–11 months'],
            ['11–14h', 'Total sleep needed: 1–2 years'],
            ['45–60m', 'Max wake window: Newborns'],
            ['3–4h',   'Max wake window: 12 months'],
          ] as [$stat, $label])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div style="background:var(--sleep); color:#fff; border-radius:8px; padding:6px 10px; font-weight:700; font-size:.88rem; min-width:64px; text-align:center; flex-shrink:0;">{{ $stat }}</div>
            <div style="font-size:.86rem; line-height:1.5; padding-top:4px;">{{ $label }}</div>
          </div>
          @endforeach
          <p style="font-size:.75rem; color:rgba(255,255,255,.35); margin-top:20px;">Sources: AASM, AAP, NHS</p>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- Age Chart --}}
<section style="background:#fff; padding:72px 0;">
  <div class="container-xl">
    <h2 class="text-center mb-2">Sleep Needs by Age</h2>
    <p class="text-center text-muted mb-5" style="max-width:520px; margin:0 auto 40px;">Recommendations from the American Academy of Sleep Medicine and AAP.</p>
    <div class="table-responsive">
      <table class="table" style="font-size:.88rem;">
        <thead style="background:#f8f9fa;">
          <tr>
            <th style="font-weight:700; color:var(--primary-dark);">Age</th>
            <th>Total Sleep</th>
            <th>Night Sleep</th>
            <th>Naps</th>
            <th>Wake Window</th>
          </tr>
        </thead>
        <tbody>
          @foreach([
            ['Newborn (0–3 mo)','14–17h','8–9h','3–5 naps','45–60 min'],
            ['3–4 months','14–16h','9–10h','3–4 naps','60–90 min'],
            ['4–6 months','12–15h','10–11h','3 naps','1.5–2.5h'],
            ['6–8 months','12–15h','10–11h','2–3 naps','2–3h'],
            ['8–10 months','12–15h','10–11h','2 naps','2.5–3.5h'],
            ['10–12 months','12–15h','10–11h','2 naps','3–4h'],
            ['12–18 months','11–14h','10–11h','1–2 naps','3–4h'],
            ['18–24 months','11–14h','11h','1 nap','4–6h'],
            ['2–3 years','11–14h','10–11h','1 nap (optional)','5–6h'],
          ] as [$age,$total,$night,$naps,$window])
          <tr>
            <td style="font-weight:600; color:var(--primary-dark);">{{ $age }}</td>
            <td><span style="color:var(--sleep); font-weight:700;">{{ $total }}</span></td>
            <td>{{ $night }}</td>
            <td>{{ $naps }}</td>
            <td>{{ $window }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</section>

{{-- Safe Sleep --}}
<section style="padding:48px 0; background:#fff;">
  <div class="container-xl">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="p-4 rounded-3" style="background:#f0f7ff; border:2px solid var(--sleep)40;">
          <div class="d-flex align-items-start gap-3">
            <div style="font-size:2rem; flex-shrink:0; line-height:1;">🛡️</div>
            <div>
              <h2 style="font-size:1.1rem; margin-bottom:12px; color:var(--primary-dark);">Safe Sleep Checklist (AAP Guidelines)</h2>
              <p style="font-size:.88rem; color:#555; margin-bottom:16px; line-height:1.7;">Following safe sleep practices significantly reduces the risk of SIDS (Sudden Infant Death Syndrome) and sleep-related infant deaths. The AAP recommends:</p>
              <div class="row g-2">
                @foreach([
                  ['Always place baby on their BACK','For every sleep — naps and nighttime. The back sleep position is the safest until the baby can roll both ways independently.'],
                  ['Firm, flat sleep surface','Use a safety-approved crib, bassinet, or play yard mattress. No soft mattresses, sofas, armchairs, or adult beds.'],
                  ['Room-share, don\'t bed-share','Baby in your room on a separate surface for at least 6 months. This halves SIDS risk while keeping night feeds manageable.'],
                  ['Keep sleep space bare','No pillows, blankets, bumpers, positioners, or toys in the sleep area. Use a sleep sack instead of blankets.'],
                  ['Avoid overheating','Keep room at 68–72°F (20–22°C). Dress baby in one more layer than you\'re comfortable in. No hats indoors during sleep.'],
                  ['Offer a dummy/pacifier at sleep time','After breastfeeding is established (3–4 weeks). Pacifier use at sleep onset is associated with reduced SIDS risk.'],
                ] as [$title,$desc])
                <div class="col-md-6">
                  <div class="p-2 rounded" style="border-left:3px solid var(--sleep); background:rgba(108,99,255,.04);">
                    <div style="font-weight:700; font-size:.83rem; color:var(--primary-dark); margin-bottom:3px;">✓ {{ $title }}</div>
                    <div style="font-size:.78rem; color:#666; line-height:1.5;">{{ $desc }}</div>
                  </div>
                </div>
                @endforeach
              </div>
              <p style="font-size:.78rem; color:#888; margin-top:16px; margin-bottom:0;">Source: American Academy of Pediatrics Safe Sleep Guidelines (2022). Always consult your paediatrician for personalised advice.</p>
            </div>
          </div>
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
        <div class="accordion" id="babyFaq">
          @foreach([
            ['What is a wake window and why does it matter?',
             'A wake window is the maximum time a baby can comfortably stay awake between sleeps. Exceeding the wake window causes overtiredness — a paradoxical state where elevated cortisol makes it harder for the baby to fall asleep and stay asleep. Watching wake windows is one of the most effective tools for reducing infant sleep problems.'],
            ['When do babies develop a circadian rhythm?',
             'Babies begin developing a circadian rhythm between 3–6 months as melatonin production matures. Before this, they have no meaningful internal clock — which is why newborn sleep is distributed evenly around the clock rather than concentrated at night. Exposure to natural light during the day and darkness at night from birth helps the rhythm develop faster.'],
            ['Is it normal for babies to wake at night?',
             'Yes. Infant sleep is biologically different from adult sleep. Babies spend proportionally more time in lighter REM sleep and have shorter sleep cycles (45–50 minutes vs. 90 minutes in adults). Night waking is normal and expected through at least the first year. Frequent waking after 6 months can sometimes be addressed with sleep training approaches, but consult your paediatrician first.'],
            ['What is the safe sleep recommendation?',
             'The AAP recommends placing babies on their back on a firm, flat surface for every sleep, in the parents\' room but on a separate sleep surface for at least the first 6 months. No soft bedding, pillows, bumpers, or toys in the sleep space. Room sharing (not bed sharing) reduces SIDS risk by up to 50%.'],
            ['How do I know if my baby is overtired?',
             'Signs of overtiredness include: difficulty falling asleep despite showing sleep cues, arching back, increased fussiness after sleep cues appear, rubbing eyes vigorously, pulling ears, yawning, losing interest in activity, and sudden crying episodes. Acting on early sleep cues (yawning, eye rubbing, glazed look) before overtiredness sets in makes settling much easier.'],
            ['Is room-sharing or bed-sharing safer?',
             'The <strong>AAP recommends room-sharing</strong> (baby in their own sleep surface in your room) for at least the first 6 months — this reduces SIDS risk by up to 50%. Bed-sharing (same sleep surface) is not recommended due to suffocation and SIDS risk, especially under 4 months. If you choose to bedshare, follow safe bedsharing guidelines: firm mattress, no alcohol or sedatives, no soft bedding near the baby.'],
            ['When should my baby sleep through the night?',
             'Most babies can manage 6–8 hour stretches by <strong>4–6 months</strong> when they have sufficient weight and are feeding well. Full 8–12 hour nights are typical from 6–9 months, though every baby is different. Before 4 months, night feeds are biologically necessary — not a habit to be broken. After 6 months, if frequent waking continues, gentle sleep training approaches can be discussed with your paediatrician.'],
          ] as $i => [$q, $a])
          <div class="accordion-item border-0 mb-2" style="border-radius:10px; overflow:hidden; box-shadow:0 2px 10px rgba(0,0,0,.05);">
            <h3 class="accordion-header">
              <button class="accordion-button {{ $i > 0 ? 'collapsed' : '' }} fw-600"
                      type="button" data-bs-toggle="collapse" data-bs-target="#babyFaq{{ $i }}"
                      style="font-size:.9rem; background:#fff; color:var(--primary-dark);">{{ $q }}</button>
            </h3>
            <div id="babyFaq{{ $i }}" class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}" data-bs-parent="#babyFaq">
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
        ['sleep-calculator','😴','Sleep Calculator','Bedtime calculator for adults based on wake-up time.'],
        ['nap-calculator','💤','Nap Calculator','Best nap length for adults — power nap or full cycle.'],
        ['sleep-debt-calculator','📉','Sleep Debt Calculator','Calculate your weekly sleep deficit.'],
        ['sleep-quality-quiz','📋','Sleep Quality Quiz','Score your sleep quality in 10 questions.'],
      ] as [$slug,$icon,$name,$desc])
      <div class="col-sm-6 col-lg-3">
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
  var AGE_DATA = {
    0:  { totalH: 16, nightH: 8.5, naps: 4, wakeW: 0.75, napLen: 45, label: 'Newborn (0–4 weeks)' },
    1:  { totalH: 15.5, nightH: 8.5, naps: 4, wakeW: 1, napLen: 45, label: '1 month' },
    2:  { totalH: 15, nightH: 9, naps: 4, wakeW: 1.25, napLen: 50, label: '2 months' },
    3:  { totalH: 15, nightH: 10, naps: 3, wakeW: 1.5, napLen: 60, label: '3 months' },
    4:  { totalH: 14.5, nightH: 10, naps: 3, wakeW: 1.75, napLen: 60, label: '4 months' },
    5:  { totalH: 14, nightH: 10, naps: 3, wakeW: 2, napLen: 60, label: '5 months' },
    6:  { totalH: 14, nightH: 11, naps: 2.5, wakeW: 2.5, napLen: 75, label: '6 months' },
    7:  { totalH: 13.5, nightH: 11, naps: 2, wakeW: 3, napLen: 90, label: '7 months' },
    8:  { totalH: 13.5, nightH: 11, naps: 2, wakeW: 3, napLen: 90, label: '8 months' },
    9:  { totalH: 13, nightH: 11, naps: 2, wakeW: 3.25, napLen: 90, label: '9 months' },
    10: { totalH: 13, nightH: 11, naps: 2, wakeW: 3.5, napLen: 90, label: '10 months' },
    11: { totalH: 13, nightH: 11, naps: 2, wakeW: 3.5, napLen: 90, label: '11 months' },
    12: { totalH: 12.5, nightH: 11, naps: 1.5, wakeW: 3.75, napLen: 90, label: '12 months (1 year)' },
    15: { totalH: 12.5, nightH: 11, naps: 1, wakeW: 4, napLen: 90, label: '15 months' },
    18: { totalH: 12, nightH: 11, naps: 1, wakeW: 5, napLen: 90, label: '18 months' },
    24: { totalH: 12, nightH: 11, naps: 1, wakeW: 5.5, napLen: 90, label: '2 years' },
    30: { totalH: 11.5, nightH: 11, naps: 0.5, wakeW: 6, napLen: 60, label: '2.5 years' },
    36: { totalH: 11, nightH: 10.5, naps: 0, wakeW: 6, napLen: 0, label: '3 years' },
  };

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

  function hm(totalMin) {
    var h = Math.floor(totalMin / 60), m = totalMin % 60;
    return (h > 0 ? h + 'h ' : '') + (m > 0 ? m + 'min' : '');
  }

  window.updateAgeInfo = function () {
    var age = parseInt(document.getElementById('babyAge').value);
    var d = AGE_DATA[age];
    if (!d) return;
    var napsText = d.naps === 0 ? 'Naps typically dropping (optional)'
      : d.naps < 1 ? 'Transitioning from 1 nap to none'
      : d.naps % 1 !== 0 ? 'Transitioning between ' + Math.floor(d.naps) + '–' + Math.ceil(d.naps) + ' naps'
      : d.naps + ' nap' + (d.naps > 1 ? 's' : '') + ' per day';
    document.getElementById('ageInfo').innerHTML =
      '<strong>' + d.label + '</strong>: ' + d.totalH + 'h total sleep · ' + d.nightH + 'h at night · '
      + napsText + ' · Wake window: ' + d.wakeW + 'h';
  };

  window.calcBabySleep = function () {
    var age = parseInt(document.getElementById('babyAge').value);
    var wakeVal = document.getElementById('morningWake').value;
    if (!wakeVal) return;
    var d = AGE_DATA[age];
    var wakeMin = parseTime(wakeVal);

    var schedule = [];
    var current = wakeMin;
    var wakeWMin = Math.round(d.wakeW * 60);
    var napCount = Math.round(d.naps);

    // Generate nap schedule
    if (d.naps === 0) {
      schedule.push({ type: 'wake', time: current, label: 'Morning wake-up' });
    } else {
      schedule.push({ type: 'wake', time: current, label: 'Morning wake-up' });
      for (var i = 0; i < napCount; i++) {
        var napStart = current + wakeWMin;
        var napEnd = napStart + d.napLen;
        schedule.push({ type: 'nap', time: napStart, label: 'Nap ' + (i + 1) + ' start (' + d.napLen + ' min)' });
        schedule.push({ type: 'napend', time: napEnd, label: 'Nap ' + (i + 1) + ' end' });
        current = napEnd;
      }
    }

    // Bedtime = wake + total awake time (totalH - nightH = daytime sleep is in naps)
    var totalAwakeMin = Math.round((24 - d.totalH) * 60);
    var bedtime = wakeMin + totalAwakeMin;

    var html = '<p style="font-weight:700; color:var(--primary-dark); margin-bottom:12px; font-size:.92rem;">Suggested schedule for a ' + AGE_DATA[age].label + ':</p>';
    html += '<div class="d-flex flex-column gap-2">';
    schedule.forEach(function (s) {
      var isNapStart = s.type === 'nap';
      var isNapEnd = s.type === 'napend';
      var icon = s.type === 'wake' ? '☀️' : isNapStart ? '😴' : '😊';
      var bg = s.type === 'wake' ? '#fff8e1' : isNapStart ? '#f0f4ff' : '#f0fff4';
      var col = s.type === 'wake' ? '#856404' : isNapStart ? 'var(--sleep)' : '#155724';
      html += '<div class="d-flex align-items-center gap-3 p-2 rounded-3" style="background:' + bg + '; border:1px solid ' + col + '20;">'
        + '<span style="font-size:1.2rem;">' + icon + '</span>'
        + '<div><div style="font-weight:700; color:' + col + '; font-size:.9rem;">' + formatTime(s.time) + '</div>'
        + '<div style="font-size:.78rem; color:#666;">' + s.label + '</div></div></div>';
    });

    html += '<div class="d-flex align-items-center gap-3 p-2 rounded-3" style="background:#f3f0ff; border:1px solid var(--sleep)30;">'
      + '<span style="font-size:1.2rem;">🌙</span>'
      + '<div><div style="font-weight:700; color:var(--sleep); font-size:.9rem;">' + formatTime(bedtime) + '</div>'
      + '<div style="font-size:.78rem; color:#666;">Bedtime (target ' + d.nightH + 'h night sleep)</div></div></div>';
    html += '</div>';

    html += '<p class="mt-3 mb-0 p-3 rounded-3" style="font-size:.8rem; color:#555; background:#f8f9fa; border:1px solid #e8e8e8; line-height:1.7;">'
      + '⏰ <strong>Wake window reminder:</strong> Watch for sleep cues after ' + hm(wakeWMin) + ' of awake time — '
      + 'drowsy eyes, yawning, decreased activity. Putting baby down before overtiredness sets in makes settling easier.'
      + '</p>';

    document.getElementById('babySchedule').innerHTML = html;
    document.getElementById('babyResult').classList.remove('d-none');
    document.getElementById('babyResult').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  };

  // Init age info
  updateAgeInfo();
})();
</script>
@endsection
