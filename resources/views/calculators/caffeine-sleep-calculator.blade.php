@extends('layouts.app')

@section('title', 'Caffeine & Sleep Calculator — Last Safe Time to Drink Coffee | MindSnap')
@section('description', 'Free caffeine and sleep calculator: find the last safe time to drink coffee, tea, or energy drinks before bed. Based on your bedtime, caffeine sensitivity, and metabolism speed. See exactly how caffeine disrupts deep sleep.')
@section('canonical', config('app.url') . '/caffeine-sleep-calculator')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "WebApplication",
  "name": "Caffeine & Sleep Calculator",
  "url": "{{ config('app.url') }}/caffeine-sleep-calculator",
  "description": "Calculate the last safe time to consume caffeine based on your bedtime and individual caffeine metabolism.",
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
    { "@@type": "ListItem", "position": 3, "name": "Caffeine & Sleep Calculator" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [
    { "@@type": "Question", "name": "How long does caffeine stay in your system?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Caffeine has a half-life of 5–7 hours in most adults. This means that if you drink a 200mg coffee at 2 PM, roughly 100mg is still in your system at 8 PM and 50mg at 2 AM. Even when you fall asleep, residual caffeine suppresses slow-wave deep sleep as measured by EEG — even if you don't notice it subjectively." } },
    { "@@type": "Question", "name": "Does caffeine affect sleep quality even if I fall asleep easily?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes. A landmark 2023 study found that caffeine consumed 6 hours before bedtime had no effect on self-reported sleep quality — but polysomnography (EEG sleep study) showed a 20% reduction in slow-wave deep sleep. You may not feel the difference the next day, but accumulated deep sleep reduction leads to cognitive impairment over time." } },
    { "@@type": "Question", "name": "What is the best time to stop drinking coffee?",
      "acceptedAnswer": { "@@type": "Answer", "text": "For most people, the last coffee should be 8–10 hours before bed. If you sleep at 11 PM and have a normal caffeine metabolism, your cutoff is around 1–3 PM. Slow metabolisers (common genetic variant in CYP1A2) should stop by noon. Fast metabolisers can sometimes drink coffee at 5 PM without sleep impact." } },
    { "@@type": "Question", "name": "How does caffeine affect deep sleep?",
      "acceptedAnswer": { "@@type": "Answer", "text": "A 2023 double-blind study measured brain activity with EEG in participants who consumed caffeine 3 or 6 hours before bed. Even at 6 hours before bed, caffeine reduced slow-wave deep sleep by approximately 20% — despite no subjective difference in sleep quality reported by participants. This means caffeine can silently degrade the most restorative sleep stage without you knowing it." } },
    { "@@type": "Question", "name": "What is caffeine half-life and why does it matter for sleep?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Caffeine half-life is the time for your body to eliminate half of the caffeine from a drink. For most adults it is 5–7 hours. If you drink a 200mg coffee at 2 PM with a 6-hour half-life, you still have 100mg in your system at 8 PM and 50mg at 2 AM — enough to suppress deep sleep. The half-life varies 3-fold between individuals based on CYP1A2 gene variants." } }
  ]
}
</script>
@endsection

@php
$faqs = [
  ['q' => 'Does caffeine tolerance reduce sleep disruption?',
             'a' => 'Caffeine tolerance reduces the stimulant feel of caffeine — the alertness boost becomes less pronounced. However, multiple studies show that tolerance does NOT reduce caffeine\'s suppressive effect on deep sleep. Regular coffee drinkers lose the same amount of deep sleep from late-day caffeine as non-drinkers, but don\'t notice the sleep disruption as obviously.'],
  ['q' => 'Can I drink decaf coffee without sleep impact?',
             'a' => 'Decaf contains 2–15mg of caffeine per cup (depending on brand and preparation), versus 95–200mg in regular coffee. For most people, decaf has minimal sleep impact, especially when consumed before 7 PM. For those with very slow caffeine metabolism, even decaf in the afternoon could have minor effects.'],
  ['q' => 'Why do some people sleep fine after coffee?',
             'a' => 'Caffeine metabolism is primarily controlled by the CYP1A2 gene. Fast metabolisers (roughly 40–50% of the population) process caffeine twice as quickly as slow metabolisers, with a half-life of 3–4 hours versus 6–10 hours. Fast metabolisers genuinely sleep better after late caffeine — but slow metabolisers who think they\'re tolerant are often simply failing to notice the deep sleep reduction.'],
  ['q' => 'What about pre-workout supplements?',
             'a' => 'Most pre-workout supplements contain 150–400mg of caffeine — equivalent to 2–4 espressos. If you train in the evening, your pre-workout could be delivering significant caffeine within hours of bedtime. Switch to a stimulant-free pre-workout for evening sessions, or train before 4 PM.'],
  ['q' => 'How can I reduce caffeine dependence?',
             'a' => 'Taper gradually — reduce by 25% per week to avoid withdrawal headaches. Replace afternoon coffees with decaf or herbal tea. Drink a large glass of water first thing in the morning (dehydration worsens fatigue). Get outdoor light within 1 hour of waking — it\'s more effective than coffee at setting your circadian clock.'],
  ['q' => 'How does caffeine affect deep sleep specifically?',
             'a' => 'Even when caffeine doesn\'t prevent you from falling asleep, it silently suppresses Stage 3 deep sleep (slow-wave sleep). A 2023 double-blind EEG study found that caffeine consumed 6 hours before bed reduced deep sleep by <strong>~20%</strong> — with no subjective awareness of the disruption. Over weeks, this accumulates into significant sleep debt and cognitive impairment despite what feels like adequate sleep.'],
  ['q' => 'What does caffeine half-life mean for daily drinkers?',
             'a' => 'If your caffeine half-life is 6 hours and you drink a 200mg coffee at 2 PM: at 8 PM you still have <strong>100mg</strong> active; at 2 AM <strong>50mg</strong> remains. The threshold for sleep disruption is roughly 25–50mg. This is why even afternoon coffee affects the quality of overnight deep sleep — not just how easily you fall asleep.'],
  ['q' => 'How many hours before bed should I stop drinking coffee?', 'a' => 'For the average adult, stopping caffeine 6 hours before bedtime is the minimum. For sensitive individuals or slow metabolisers, 8–10 hours is safer. If you go to bed at 11:00 pm, your latest coffee should be around 3:00–5:00 pm. The calculator on this page gives you your exact cut-off based on your metabolism type and bedtime.'],
  ['q' => 'Does green tea affect sleep less than coffee?', 'a' => 'Yes — green tea contains 25–50 mg of caffeine per cup (versus 80–120 mg in coffee) and also contains L-theanine, an amino acid that promotes calm alertness and partially counteracts caffeine\'s stimulating effects. However, green tea still contains enough caffeine to disrupt sleep for sensitive individuals. For sleep-safe evening drinks, choose chamomile, peppermint, or rooibos tea — all naturally caffeine-free.'],
  ['q' => 'Can caffeine cause insomnia?', 'a' => 'Yes — caffeine is one of the most common reversible causes of insomnia. It works by blocking adenosine receptors (adenosine is the chemical that makes you feel sleepy). Even when you feel tired, caffeine in your system prevents the normal sleep pressure from translating into deep sleep. People who struggle to fall asleep or wake frequently during the night should eliminate all caffeine for 2 weeks as a diagnostic test before exploring other causes.'],
];

$relatedTools = [
  ['icon' => '😴', 'name' => 'Sleep Calculator', 'slug' => 'sleep-calculator', 'desc' => 'Best bedtime based on your wake-up time.'],
  ['icon' => '⏰', 'name' => 'Wake-Up Calculator', 'slug' => 'wake-up-calculator', 'desc' => 'Best wake-up times from your bedtime.'],
  ['icon' => '💤', 'name' => 'Nap Calculator', 'slug' => 'nap-calculator', 'desc' => 'Power nap or full cycle — when and how long.'],
  ['icon' => '📉', 'name' => 'Sleep Debt Calculator', 'slug' => 'sleep-debt-calculator', 'desc' => 'Calculate your weekly sleep deficit.'],
  ['icon' => '✈️', 'name' => 'Jet Lag Calculator', 'slug' => 'jet-lag-calculator', 'desc' => 'Plan sleep around long flights.'],
  ['icon' => '📋', 'name' => 'Sleep Quality Quiz', 'slug' => 'sleep-quality-quiz', 'desc' => 'Score your sleep quality in 10 questions.'],
];
@endphp

@section('content')

<section class="ms-hero">
  <div class="container-xl">
    <div class="row align-items-start g-5">

      <div class="col-lg-7">
        <nav aria-label="breadcrumb" class="mb-3">
          <ol class="breadcrumb ms-breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('category.sleep') }}">Sleep Tools</a></li>
            <li class="breadcrumb-item active">Caffeine & Sleep</li>
          </ol>
        </nav>

        <h1 class="mb-2 ms-hero-title">
          ☕ Caffeine & Sleep Calculator — Last Safe Time to Drink Coffee
        </h1>
        <p class="ms-hero-desc">
          Find the last safe time to drink coffee or tea so caffeine doesn't wreck your sleep — based on your bedtime and metabolism.
        </p>

        <div class="card border-0 mb-n4 ms-tool-card">
          <div class="card-body p-4 p-md-5">

            <div class="mb-4">
              <label for="cafBedtime" class="form-label fw-600">Your target bedtime</label>
              <input type="time" id="cafBedtime" class="form-control" value="23:00" aria-label="Bedtime">
            </div>

            <div class="mb-4">
              <label for="metabolism" class="form-label fw-600">Your caffeine metabolism</label>
              <select id="metabolism" class="form-select">
                <option value="4">Fast metaboliser — caffeine wears off quickly, rarely affects sleep</option>
                <option value="5.5" selected>Average — caffeine half-life ~5–6 hours (most people)</option>
                <option value="9">Slow metaboliser — caffeine lasts much longer, easily disrupts sleep</option>
                <option value="12">Very sensitive — even morning coffee can affect sleep quality</option>
              </select>
              <div style="font-size:.8rem; color:#888; margin-top:6px;">Not sure? Start with "average." If you sleep fine after a 5pm coffee, you may be a fast metaboliser.</div>
            </div>

            <div class="mb-4">
              <label for="cafDrink" class="form-label fw-600">Drink type</label>
              <select id="cafDrink" class="form-select">
                <option value="95">Filter coffee / drip coffee (1 cup, ~95mg)</option>
                <option value="150">Double espresso / large coffee (150mg)</option>
                <option value="200" selected>Large espresso-based (latte, flat white, ~200mg)</option>
                <option value="300">Large energy drink or cold brew (300mg)</option>
                <option value="50">Black tea (1 cup, ~50mg)</option>
                <option value="30">Green tea (1 cup, ~30mg)</option>
              </select>
            </div>

            <button class="btn btn-cta w-100" onclick="calcCaffeine()" style="font-size:1rem;">
              Find My Caffeine Cutoff →
            </button>

            <div id="cafResult" class="mt-4 d-none">
              <div class="ms-divider"></div>
              <div id="cafContent"></div>
            </div>

          </div>
        </div>
      </div>

      <div class="col-lg-5 d-none d-lg-block" style="padding-top:10px;">
        <div class="ms-facts-wrap">
          <h3 class="ms-facts-title">Caffeine Facts</h3>
          @foreach([
            ['5–7h',  'Caffeine half-life in average adults'],
            ['20%',   'Deep sleep reduction from late-day caffeine (EEG study)'],
            ['95mg',  'Caffeine in a standard filter coffee'],
            ['400mg', 'Safe daily caffeine limit for healthy adults (FDA)'],
            ['2×',    'Caffeine metabolism slowdown during pregnancy'],
          ] as [$stat, $label])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div class="ms-fact-pill ms-fact-pill-sleep">{{ $stat }}</div>
            <div class="ms-fact-label">{{ $label }}</div>
          </div>
          @endforeach
          <p class="ms-fact-source">Sources: FDA, NIH, Walker (2017)</p>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- Caffeine in drinks table --}}
<section class="ms-section-white">
  <div class="container-xl">
    <div class="row align-items-start g-5">
      <div class="col-lg-6">
        <h2 class="mb-4">Caffeine Content by Drink</h2>
        <div class="table-responsive">
          <table class="table" style="font-size:.88rem;">
            <thead style="background:#f8f9fa;">
              <tr>
                <th style="font-weight:700; color:var(--primary-dark);">Drink</th>
                <th>Caffeine</th>
                <th>Half gone by</th>
              </tr>
            </thead>
            <tbody>
              @foreach([
                ['Espresso (single)','63mg','5–6h later'],
                ['Filter coffee (1 cup)','95mg','5–6h later'],
                ['Flat white / latte','150–180mg','6–7h later'],
                ['Energy drink (250ml)','80mg','5–6h later'],
                ['Large energy drink (500ml)','160mg','6–7h later'],
                ['Cold brew (12oz)','200–300mg','7–8h later'],
                ['Black tea (1 cup)','47mg','4–5h later'],
                ['Green tea (1 cup)','28mg','3–4h later'],
                ['Cola (330ml)','34mg','3–4h later'],
                ['Dark chocolate (30g)','~20mg','3–4h later'],
              ] as [$drink,$caf,$halflife])
              <tr>
                <td style="color:var(--primary-dark);">{{ $drink }}</td>
                <td style="font-weight:600; color:var(--sleep);">{{ $caf }}</td>
                <td style="color:#888; font-size:.82rem;">{{ $halflife }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="col-lg-6">
        <h2 class="mb-4">How Caffeine Disrupts Sleep</h2>
        <p>Caffeine works by blocking adenosine receptors. Adenosine is the brain's sleep-pressure chemical — it builds up throughout the day and drives the urge to sleep. Caffeine doesn't reduce adenosine; it simply blocks the receptors that sense it. When caffeine wears off, all the accumulated adenosine floods the receptors at once — the classic "caffeine crash."</p>
        <p>The critical insight: even when caffeine no longer keeps you awake, it continues to reduce slow-wave deep sleep as measured by brain activity monitors. A 2023 double-blind study showed that 400mg of caffeine taken 6 hours before bed caused a 20% reduction in deep sleep without any subjective sleep quality difference reported by participants.</p>
        <div class="p-4 rounded-3" style="background:#f0f4ff; border-left:4px solid var(--sleep);">
          <p style="margin:0; font-size:.88rem; color:#333; line-height:1.7;"><strong>The sleep debt cycle:</strong> Caffeine → reduced deep sleep → more daytime fatigue → more caffeine → less deep sleep → compounding debt. Breaking this cycle requires 5–7 days of caffeine restriction while sleep rebuilds.</p>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Genetics --}}
<section class="ms-section-muted">
  <div class="container-xl">
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <span class="ms-badge ms-badge-sleep mb-3">Caffeine Genetics</span>
        <h2 class="mb-4">Why Your Friend Can Drink Coffee at 8 PM and You Can't</h2>
        <p>Caffeine metabolism is primarily controlled by the <strong>CYP1A2 gene</strong>. People with the fast-metaboliser variant (roughly 40–50% of the population) process caffeine at nearly twice the rate of slow metabolisers, with a half-life of just 3–4 hours versus 7–10 hours.</p>
        <p>For a fast metaboliser who drinks coffee at 5 PM: by 9 PM their caffeine levels are already minimal. For a slow metaboliser drinking the same coffee: significant caffeine remains active at 2 AM — silently suppressing deep sleep even if they fall asleep easily.</p>
        <p>You can't get tested cheaply, but your sleep pattern tells you: if afternoon coffee consistently doesn't affect your sleep, you're likely a fast metaboliser. If even morning coffee seems to affect sleep quality, you may be a very slow metaboliser — often linked to hormonal contraceptive use, which inhibits CYP1A2.</p>
      </div>
      <div class="col-lg-6">
        <h3 style="font-size:1rem;" class="mb-3">Caffeine Metabolism Types</h3>
        @foreach([
          ['⚡','Fast Metaboliser','~40–50% of people','Half-life: 3–4h','Can typically handle coffee until 5–6 PM without sleep impact.'],
          ['🔄','Average Metaboliser','~30–40% of people','Half-life: 5–7h','Should stop caffeine by 2–3 PM for a 11 PM bedtime.'],
          ['🐢','Slow Metaboliser','~15–20% of people','Half-life: 8–12h','Even noon coffee can affect deep sleep. Caffeine sensitivity is high.'],
          ['⚠️','Very Sensitive','Hormonal OC, CYP1A2 inhibitors','Half-life: up to 16h','Hormonal birth control can double caffeine half-life. Morning-only caffeine recommended.'],
        ] as [$icon,$type,$pct,$halflife,$desc])
        <div class="d-flex gap-3 p-3 mb-2 rounded-3" style="background:#f8f9fa; border:1px solid #e8e8e8;">
          <div style="font-size:1.3rem; flex-shrink:0; line-height:1; padding-top:2px;">{{ $icon }}</div>
          <div>
            <div style="font-weight:700; font-size:.85rem; color:var(--primary-dark);">{{ $type }} <span style="font-weight:400; color:#888; font-size:.78rem;">{{ $pct }}</span></div>
            <div style="font-size:.78rem; color:var(--sleep); font-weight:600; margin:2px 0;">{{ $halflife }}</div>
            <div style="font-size:.78rem; color:#666; line-height:1.5;">{{ $desc }}</div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="cafFaq" />


<section class="ms-section-accent">
  <div class="container ms-longtail">
    <h2 class="mb-4" style="color:var(--primary-dark);">How Late Is Too Late to Drink Coffee?</h2>
    <p>The general rule supported by research (including a 2013 study in the Journal of Clinical Sleep Medicine): avoid caffeine within 6 hours of your intended bedtime. However, this is an average. Fast metabolisers (CYP1A2 fast allele) may tolerate coffee up to 3–4 hours before bed. Slow metabolisers and those with caffeine sensitivity should cut off 8–10 hours before bed. The calculator uses your selected metabolism speed to give you a personalised cut-off time rather than a one-size-fits-all rule.</p>
    <h2 class="mt-5 mb-4" style="color:var(--primary-dark);">Caffeine Calculator for Night Shift Workers</h2>
    <p>Night shift workers face a particular caffeine challenge: they need to stay alert during the shift but must sleep during the day. The key strategy: use caffeine strategically in the first half of the shift only. If your shift runs 10 pm–6 am, limit caffeine to before 2:00 am. A second tactic is the "caffeine nap" — drink a coffee immediately before a 20-minute nap. By the time you wake, the caffeine has been absorbed and you get the combined benefit of both. Avoid caffeine within 6 hours of your planned daytime sleep period.</p>
    <h2 class="mt-5 mb-4" style="color:var(--primary-dark);">Does Decaf Coffee Affect Sleep?</h2>
    <p>Decaffeinated coffee still contains 2–25 mg of caffeine per cup (compared to 80–120 mg in regular coffee). For most people, this small amount is negligible. However, highly sensitive individuals or those with slow caffeine metabolism may notice even decaf disrupts sleep when consumed in the evening. Decaf also contains chlorogenic acids and other compounds that can slightly elevate cortisol. For the best sleep, switch to herbal tea (not green or black tea) after 6 pm.</p>
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

  window.calcCaffeine = function () {
    var bedMin    = parseTime(document.getElementById('cafBedtime').value);
    var halfLife  = parseFloat(document.getElementById('metabolism').value);
    var cafMg     = parseInt(document.getElementById('cafDrink').value);

    // Number of half-lives needed to bring caffeine below 25mg (light threshold)
    // C(t) = cafMg * (0.5)^(t/halfLife) < 25
    var hoursNeeded = halfLife * Math.log(cafMg / 25) / Math.log(2);
    hoursNeeded = Math.max(6, Math.ceil(hoursNeeded));

    var cutoffMin = bedMin - hoursNeeded * 60;
    var cutoffStr = formatTime(cutoffMin);

    // Residual at bedtime if you drank NOW
    var nowHours = hoursNeeded; // for display, show residual at bedtime
    var residualAtBed = cafMg * Math.pow(0.5, hoursNeeded / halfLife);

    var isSafe = residualAtBed < 25;
    var isWarning = residualAtBed >= 25 && residualAtBed < 50;
    var bg = isSafe ? '#d1eddb' : isWarning ? '#fff3cd' : '#ffd5d5';
    var color = isSafe ? '#155724' : isWarning ? '#664d03' : '#721c24';
    var icon = isSafe ? '✅' : isWarning ? '⚠️' : '🚫';

    var html = '<div class="p-4 rounded-3 mb-3 text-center" style="background:' + bg + '; border:1px solid ' + color + '30;">'
      + '<div style="font-size:2rem; margin-bottom:8px;">' + icon + '</div>'
      + '<div style="font-size:.8rem; font-weight:700; color:' + color + '; text-transform:uppercase; letter-spacing:.5px; margin-bottom:8px;">Last safe caffeine time</div>'
      + '<div style="font-size:2.5rem; font-weight:800; color:' + color + ';">' + cutoffStr + '</div>'
      + '<div style="font-size:.88rem; color:#555; margin-top:8px;">Based on ' + hoursNeeded + 'h clearance time for ' + cafMg + 'mg caffeine</div>'
      + '</div>';

    html += '<div class="row g-3 mb-3">'
      + '<div class="col-4 text-center"><div style="background:#f8f9fa; border-radius:10px; padding:12px;">'
      + '<div style="font-size:1.1rem; font-weight:800; color:var(--sleep);">' + cafMg + 'mg</div>'
      + '<div class="ms-stat-label">Caffeine dose</div></div></div>'
      + '<div class="col-4 text-center"><div style="background:#f8f9fa; border-radius:10px; padding:12px;">'
      + '<div style="font-size:1.1rem; font-weight:800; color:var(--sleep);">' + halfLife + 'h</div>'
      + '<div class="ms-stat-label">Half-life</div></div></div>'
      + '<div class="col-4 text-center"><div style="background:#f8f9fa; border-radius:10px; padding:12px;">'
      + '<div style="font-size:1.1rem; font-weight:800; color:' + color + ';">' + Math.round(residualAtBed) + 'mg</div>'
      + '<div class="ms-stat-label">At bedtime</div></div></div>'
      + '</div>';

    html += '<div class="p-3 rounded-3" style="background:#f0f4ff; border:1px solid var(--sleep)30; font-size:.85rem; color:#444; line-height:1.7;">'
      + '<strong>Tips:</strong><br>'
      + '• Drink water first thing in the morning before any caffeine<br>'
      + '• Don\'t drink coffee within 90 minutes of waking — cortisol is already high<br>'
      + '• Replace afternoon coffee with a 10–20 min power nap for better alertness'
      + '</div>';

    document.getElementById('cafContent').innerHTML = html;
    document.getElementById('cafResult').classList.remove('d-none');
    document.getElementById('cafResult').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  };
})();
</script>
@endsection
