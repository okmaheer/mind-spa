@extends('layouts.app')

@section('title', 'Jet Lag Calculator — Sleep Schedule Recovery Plan for Long Flights | MindSnap')
@section('description', 'Free jet lag calculator: enter your home and destination time zones and get a personalised sleep recovery schedule. Covers eastward and westward travel, 28 time zones, and melatonin timing. Free, instant, no signup.')
@section('canonical', config('app.url') . '/jet-lag-calculator')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "WebApplication",
  "name": "Jet Lag Calculator",
  "url": "{{ config('app.url') }}/jet-lag-calculator",
  "description": "Calculate jet lag recovery time and get a personalised sleep adjustment plan for travel across time zones.",
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
    { "@@type": "ListItem", "position": 3, "name": "Jet Lag Calculator" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [
    { "@@type": "Question", "name": "How long does jet lag last?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Jet lag typically lasts 1 day per time zone crossed for eastward travel and about 0.75 days per time zone for westward travel. Eastward travel is harder because it requires advancing your clock (moving bedtime earlier), which is more difficult for the circadian system than delaying it (westward travel)." } },
    { "@@type": "Question", "name": "Is jet lag worse going east or west?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Eastward travel is consistently harder. Moving east means going to bed and waking earlier — which fights the natural tendency of the circadian clock to run slightly longer than 24 hours. Westward travel delays sleep, which is easier because it aligns with the clock's natural drift. A 9-hour eastward flight typically causes more disruption than the same westward journey." } },
    { "@@type": "Question", "name": "Does melatonin help with jet lag?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes — melatonin is one of the most evidence-backed jet lag interventions. For eastward travel, take 0.5–3mg melatonin at the destination bedtime for the first 3–4 nights. For westward travel, it's less effective but can still be taken at destination bedtime. Use the lowest effective dose — higher doses don't improve effectiveness." } },
    { "@@type": "Question", "name": "How do you take melatonin for jet lag?",
      "acceptedAnswer": { "@@type": "Answer", "text": "For eastward travel: take 0.5–3mg melatonin at destination bedtime (9–11 PM local time) for the first 3–4 nights. For westward travel: melatonin is less critical but 0.5mg at destination bedtime can help anchor your clock. Use the lowest effective dose — 0.5mg is as effective as 5mg in most studies but with fewer next-day effects. Do not take melatonin in the morning or afternoon at the destination." } },
    { "@@type": "Question", "name": "How many days does it take to adjust to a new time zone?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The general rule is 1 day of recovery per time zone crossed for eastward travel, and 0.75 days per time zone for westward travel. A 9-hour eastward flight typically requires 7–9 days for full adaptation. Business travellers often report feeling fully adapted after 3–5 days as the body's clock shifts incrementally each night." } }
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
            <li class="breadcrumb-item active" style="color:rgba(255,255,255,.8);">Jet Lag Calculator</li>
          </ol>
        </nav>

        <h1 class="mb-2" style="color:#fff; font-size:clamp(1.9rem,4vw,2.8rem);">
          ✈️ Jet Lag Calculator — Personalised Sleep Recovery Plan
        </h1>
        <p style="color:rgba(255,255,255,.7); font-size:1.05rem; max-width:520px; margin-bottom:28px;">
          Enter your flight details and get a personalised jet lag recovery plan with target sleep times for your destination.
        </p>

        <div class="card border-0 mb-n4" style="border-radius:18px; box-shadow:0 20px 60px rgba(0,0,0,.25); position:relative; z-index:2;">
          <div class="card-body p-4 p-md-5">

            <div class="mb-4">
              <label for="homeOffset" class="form-label fw-600">Your home time zone (UTC offset)</label>
              <select id="homeOffset" class="form-select">
                @foreach([
                  ['-12','UTC-12 (Baker Island)'],
                  ['-11','UTC-11 (American Samoa)'],
                  ['-10','UTC-10 (Hawaii)'],
                  ['-9','UTC-9 (Alaska)'],
                  ['-8','UTC-8 (Los Angeles, Vancouver)'],
                  ['-7','UTC-7 (Denver, Phoenix)'],
                  ['-6','UTC-6 (Chicago, Mexico City)'],
                  ['-5','UTC-5 (New York, Toronto)'],
                  ['-4','UTC-4 (Halifax, Caracas)'],
                  ['-3','UTC-3 (São Paulo, Buenos Aires)'],
                  ['-2','UTC-2 (South Georgia)'],
                  ['-1','UTC-1 (Azores)'],
                  ['0','UTC+0 (London GMT, Lisbon)'],
                  ['1','UTC+1 (Paris, Berlin, Lagos)'],
                  ['2','UTC+2 (Cairo, Johannesburg)'],
                  ['3','UTC+3 (Moscow, Nairobi, Riyadh)'],
                  ['4','UTC+4 (Dubai, Baku)'],
                  ['5','UTC+5 (Karachi, Tashkent)'],
                  ['5.5','UTC+5:30 (New Delhi, Mumbai)'],
                  ['6','UTC+6 (Dhaka, Almaty)'],
                  ['7','UTC+7 (Bangkok, Jakarta)'],
                  ['8','UTC+8 (Singapore, Beijing, Perth)'],
                  ['9','UTC+9 (Tokyo, Seoul)'],
                  ['9.5','UTC+9:30 (Adelaide)'],
                  ['10','UTC+10 (Sydney, Melbourne)'],
                  ['11','UTC+11 (Solomon Islands)'],
                  ['12','UTC+12 (Auckland, Fiji)'],
                ] as [$val, $label])
                <option value="{{ $val }}" {{ $val === '0' ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
              </select>
            </div>

            <div class="mb-4">
              <label for="destOffset" class="form-label fw-600">Destination time zone (UTC offset)</label>
              <select id="destOffset" class="form-select">
                @foreach([
                  ['-12','UTC-12 (Baker Island)'],
                  ['-11','UTC-11 (American Samoa)'],
                  ['-10','UTC-10 (Hawaii)'],
                  ['-9','UTC-9 (Alaska)'],
                  ['-8','UTC-8 (Los Angeles, Vancouver)'],
                  ['-7','UTC-7 (Denver, Phoenix)'],
                  ['-6','UTC-6 (Chicago, Mexico City)'],
                  ['-5','UTC-5 (New York, Toronto)'],
                  ['-4','UTC-4 (Halifax, Caracas)'],
                  ['-3','UTC-3 (São Paulo, Buenos Aires)'],
                  ['-2','UTC-2 (South Georgia)'],
                  ['-1','UTC-1 (Azores)'],
                  ['0','UTC+0 (London GMT, Lisbon)'],
                  ['1','UTC+1 (Paris, Berlin, Lagos)'],
                  ['2','UTC+2 (Cairo, Johannesburg)'],
                  ['3','UTC+3 (Moscow, Nairobi, Riyadh)'],
                  ['4','UTC+4 (Dubai, Baku)'],
                  ['5','UTC+5 (Karachi, Tashkent)'],
                  ['5.5','UTC+5:30 (New Delhi, Mumbai)'],
                  ['6','UTC+6 (Dhaka, Almaty)'],
                  ['7','UTC+7 (Bangkok, Jakarta)'],
                  ['8','UTC+8 (Singapore, Beijing, Perth)'],
                  ['9','UTC+9 (Tokyo, Seoul)'],
                  ['9.5','UTC+9:30 (Adelaide)'],
                  ['10','UTC+10 (Sydney, Melbourne)'],
                  ['11','UTC+11 (Solomon Islands)'],
                  ['12','UTC+12 (Auckland, Fiji)'],
                ] as [$val, $label])
                <option value="{{ $val }}" {{ $val === '9' ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
              </select>
            </div>

            <div class="mb-4">
              <label for="homeBedtime" class="form-label fw-600">Your normal bedtime (home time)</label>
              <input type="time" id="homeBedtime" class="form-control" value="23:00" aria-label="Home bedtime">
            </div>

            <button class="btn btn-cta w-100" onclick="calcJetLag()" style="font-size:1rem;">
              Calculate Jet Lag Recovery →
            </button>

            <div id="jetResult" class="mt-4 d-none">
              <div style="height:1px; background:#f0f0f0; margin-bottom:16px;"></div>
              <div id="jetContent"></div>
            </div>

          </div>
        </div>
      </div>

      <div class="col-lg-5 d-none d-lg-block" style="padding-top:10px;">
        <div style="color:rgba(255,255,255,.85);">
          <h3 style="color:#fff; font-size:.9rem; text-transform:uppercase; letter-spacing:.5px; font-weight:600; margin-bottom:16px;">Jet Lag Facts</h3>
          @foreach([
            ['1 day/tz',  'Recovery time eastward per time zone crossed'],
            ['0.75d/tz',  'Recovery time westward per time zone crossed'],
            ['3–4 days',  'Recovery for a typical long-haul flight (6–8 tz)'],
            ['10+ days',  'Full circadian reset for extreme crossings (12 tz)'],
            ['0.5–3mg',   'Effective melatonin dose for jet lag'],
          ] as [$stat, $label])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div style="background:var(--sleep); color:#fff; border-radius:8px; padding:6px 10px; font-weight:700; font-size:.88rem; min-width:64px; text-align:center; flex-shrink:0;">{{ $stat }}</div>
            <div style="font-size:.86rem; line-height:1.5; padding-top:4px;">{{ $label }}</div>
          </div>
          @endforeach
        </div>
      </div>

    </div>
  </div>
</section>

{{-- Tips --}}
<section style="background:#fff; padding:72px 0;">
  <div class="container-xl">
    <h2 class="text-center mb-2">Evidence-Based Jet Lag Recovery Tips</h2>
    <p class="text-center text-muted mb-5" style="max-width:480px; margin:0 auto 40px;">What the research says — not just general travel advice.</p>
    <div class="row g-4">
      @foreach([
        ['☀️','Get morning light at destination immediately',
         'Light is the most powerful circadian synchroniser. Upon arrival, spend 30–60 minutes in outdoor light in the morning (destination time). This resets your clock faster than any supplement.'],
        ['🌑','Avoid bright light in the evenings (first 2 days)',
         'Especially for eastward travel — evening light at the destination corresponds to daytime at home, which delays your clock in the wrong direction. Use blue-light blocking glasses after 7 PM.'],
        ['💊','Take low-dose melatonin at destination bedtime',
         '0.5–3mg of melatonin at destination bedtime for the first 3–5 nights significantly reduces jet lag symptoms and speeds adaptation. Higher doses increase next-day grogginess.'],
        ['⏰','Stay awake until local bedtime on arrival day',
         'Resisting the urge to sleep at your home daytime hours (which is daytime at your destination) forces faster adaptation. Only take a brief nap (max 20 min) if absolutely necessary.'],
        ['💧','Stay hydrated on the flight',
         'Cabin humidity is 10–20% — well below comfortable levels. Dehydration worsens jet lag symptoms significantly. Drink 250ml of water per hour of flight. Avoid alcohol — it suppresses REM sleep and worsens dehydration.'],
        ['🏃','Exercise at destination time',
         'Physical activity — even a 20-minute walk — helps shift the circadian clock. Time exercise in the morning for eastward travel (helps advance your clock) or afternoon/evening for westward (helps delay it).'],
      ] as [$icon,$title,$desc])
      <div class="col-md-6 col-lg-4">
        <div class="d-flex gap-3 p-3 rounded-3 h-100" style="background:#f8f9fa; border:1px solid #e8e8e8;">
          <div style="font-size:1.6rem; flex-shrink:0; line-height:1; padding-top:2px;">{{ $icon }}</div>
          <div>
            <div class="fw-600" style="font-size:.88rem; color:var(--primary-dark); margin-bottom:6px;">{{ $title }}</div>
            <div style="font-size:.8rem; color:#666; line-height:1.6;">{{ $desc }}</div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- Melatonin Guide --}}
<section style="padding:56px 0; background:#fff;">
  <div class="container-xl">
    <div class="row align-items-start g-5">
      <div class="col-lg-6">
        <span class="badge mb-3" style="background:rgba(108,99,255,.1); color:var(--sleep); font-size:.8rem; padding:6px 14px; border-radius:50px; font-weight:600;">Melatonin Guide</span>
        <h2 class="mb-4">How to Use Melatonin for Jet Lag</h2>
        <p>Melatonin is the most evidence-backed pharmacological intervention for jet lag. A Cochrane review of 10 randomised trials (Herxheimer & Petrie, 2002) concluded it is remarkably effective at reducing jet lag symptoms, particularly for eastward travel of 5 or more time zones.</p>
        <p>The key insight is <strong>timing over dose</strong>. Taking melatonin at the wrong time can worsen jet lag rather than help it. The circadian clock is a phase-response system — melatonin in the afternoon delays your clock; melatonin in the morning advances it. Only evening use (at destination bedtime) is appropriate for jet lag recovery.</p>
        <p>Use the lowest effective dose. Most commercial melatonin tablets are 5–10mg — 5 to 20 times higher than what research shows is effective (0.5mg). Higher doses increase next-day grogginess and suppress endogenous melatonin production over time.</p>
      </div>
      <div class="col-lg-6">
        <h3 style="font-size:1rem;" class="mb-3">Melatonin Protocol by Travel Direction</h3>
        <div class="d-flex flex-column gap-3">
          <div class="p-3 rounded-3" style="background:#f0f4ff; border:1px solid var(--sleep)30;">
            <div style="font-weight:700; color:var(--sleep); margin-bottom:8px;">✈️ Eastward Travel (harder)</div>
            <ul style="margin:0; padding-left:18px; font-size:.84rem; color:#555; line-height:1.8;">
              <li>Take 0.5–3mg melatonin at destination bedtime (9–11 PM)</li>
              <li>Continue for 3–4 nights after arrival</li>
              <li>Combine with morning light exposure at destination</li>
              <li>Avoid evening bright light (especially screens) at destination</li>
            </ul>
          </div>
          <div class="p-3 rounded-3" style="background:#f0fff4; border:1px solid #28a74530;">
            <div style="font-weight:700; color:#155724; margin-bottom:8px;">✈️ Westward Travel (easier)</div>
            <ul style="margin:0; padding-left:18px; font-size:.84rem; color:#555; line-height:1.8;">
              <li>Melatonin less critical — natural delay is easier</li>
              <li>If using: 0.5mg at destination bedtime for 2–3 nights</li>
              <li>Get bright light in the late afternoon at destination</li>
              <li>Stay awake as long as possible on arrival day</li>
            </ul>
          </div>
          <div class="p-3 rounded-3" style="background:#fff8e1; border:1px solid #ffc10730;">
            <div style="font-weight:700; color:#856404; margin-bottom:8px; font-size:.82rem;">⚠️ Do Not</div>
            <div style="font-size:.8rem; color:#555; line-height:1.6;">Take melatonin in the morning or afternoon at your destination — this pushes your clock in the wrong direction and extends jet lag. Do not use if pregnant. Consult your doctor if taking anticoagulants or immunosuppressants.</div>
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
        <div class="accordion" id="jetFaq">
          @foreach([
            ['Why is jet lag worse going east than west?',
             'The human circadian clock runs slightly longer than 24 hours — about 24.2 hours on average. This means it naturally tends to drift later (westward direction). Eastward travel requires the clock to shift earlier — which fights this natural drift. Westward travel is easier because delaying the clock is its natural tendency. This is why most frequent fliers report eastward journeys as significantly more disruptive.'],
            ['Should I adjust my schedule before flying?',
             'For eastward travel of 4+ time zones: start moving your bedtime 30 minutes earlier per night for 3–5 days before departure. Get bright light exposure in the morning. For westward travel: start going to bed 30 minutes later each night. This partial pre-adaptation reduces jet lag severity on arrival.'],
            ['How does melatonin work for jet lag?',
             'Melatonin is a hormonal signal of darkness that tells the circadian system it\'s time to sleep. Taking melatonin at the destination\'s bedtime — even when it\'s daytime at home — helps re-synchronise the internal clock to local time. Research (Herxheimer, 2002) in a Cochrane review of 10 trials found melatonin was effective for jet lag, with the best results for eastward travel of 5+ time zones.'],
            ['What does "crossing the dateline" do to jet lag?',
             'Crossing the International Date Line (180° meridian) can actually reduce jet lag if you travel westward across it, because you\'re effectively gaining a day. The direction of travel matters more than the dateline crossing itself — what matters is the total time zone difference and whether you\'re going east or west to get there.'],
            ['Can children and elderly people recover faster from jet lag?',
             'Children adapt relatively quickly — their circadian clocks are more plastic. Older adults adapt more slowly because circadian amplitude (the strength of the sleep-wake signal) weakens with age. The elderly also produce less melatonin naturally, which makes night-time adaptation harder. Give extra buffer time before important commitments after flying with elderly travellers.'],
            ['How exactly should I take melatonin for jet lag?',
             'For <strong>eastward travel</strong>: 0.5–3mg at destination bedtime (9–11 PM local) for 3–4 nights. For <strong>westward travel</strong>: less critical, but 0.5mg at destination bedtime can help anchor your schedule. Key: use the <strong>lowest effective dose</strong> — 0.5mg is as effective as 5mg in most trials but produces fewer next-day side effects. Never take melatonin at the destination\'s daytime hours — it pushes your clock in the wrong direction.'],
            ['Does flight direction on a round trip affect recovery?',
             'Yes — returning east is typically harder than going west, which means for most travellers flying London → New York (westward, easier) followed by New York → London (eastward, harder), the return leg is more disruptive. Build in an extra recovery day before important commitments following an eastward return. The total adaptation time for a round trip is roughly 2–3× the one-way adaptation time.'],
          ] as $i => [$q, $a])
          <div class="accordion-item border-0 mb-2" style="border-radius:10px; overflow:hidden; box-shadow:0 2px 10px rgba(0,0,0,.05);">
            <h3 class="accordion-header">
              <button class="accordion-button {{ $i > 0 ? 'collapsed' : '' }} fw-600"
                      type="button" data-bs-toggle="collapse" data-bs-target="#jetFaq{{ $i }}"
                      style="font-size:.9rem; background:#fff; color:var(--primary-dark);">{{ $q }}</button>
            </h3>
            <div id="jetFaq{{ $i }}" class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}" data-bs-parent="#jetFaq">
              <div class="accordion-body" style="color:#555; font-size:.88rem; line-height:1.75;">{{ $a }}</div>
            </div>
          </div>
          @endforeach
          <div class="accordion-item border-0 mb-2">
  <h3 class="accordion-header">
    <button class="accordion-button collapsed fw-600" type="button" data-bs-toggle="collapse" data-bs-target="#faq-j6">
      Does melatonin help with jet lag?
    </button>
  </h3>
  <div id="faq-j6" class="accordion-collapse collapse">
    <div class="accordion-body pt-0" style="color:#555;">
      Yes — melatonin is one of the few jet lag remedies with strong scientific evidence. A Cochrane Review of 10 randomised trials found melatonin taken at the target bedtime reduced jet lag severity significantly for flights crossing 5+ time zones. The recommended dose is low: 0.5–3 mg. Higher doses (5–10 mg, common in US supplements) are no more effective and cause next-day drowsiness. Timing matters more than dose — take it at 10–11 pm destination time regardless of what your body clock says.
    </div>
  </div>
</div>
<div class="accordion-item border-0 mb-2">
  <h3 class="accordion-header">
    <button class="accordion-button collapsed fw-600" type="button" data-bs-toggle="collapse" data-bs-target="#faq-j7">
      Should I sleep on the plane to avoid jet lag?
    </button>
  </h3>
  <div id="faq-j7" class="accordion-collapse collapse">
    <div class="accordion-body pt-0" style="color:#555;">
      It depends on your destination. If you are flying eastward (e.g. London to Tokyo), try to sleep on the plane to arrive partially rested and stay awake until local bedtime. If flying westward (e.g. New York to London), sleeping less on the plane and arriving tired makes it easier to fall asleep at the earlier local bedtime. The goal is to align your first night's sleep with local time as closely as possible.
    </div>
  </div>
</div>
<div class="accordion-item border-0 mb-2">
  <h3 class="accordion-header">
    <button class="accordion-button collapsed fw-600" type="button" data-bs-toggle="collapse" data-bs-target="#faq-j8">
      How do pilots and flight attendants deal with jet lag?
    </button>
  </h3>
  <div id="faq-j8" class="accordion-collapse collapse">
    <div class="accordion-body pt-0" style="color:#555;">
      Airlines use "controlled rest" protocols — short in-seat naps (20–45 minutes) for pilots during long hauls. Crew are also trained in strategic light exposure, melatonin timing, and sleep scheduling. Many experienced crew members maintain a single home time zone mentally and use strategic naps rather than trying to fully adjust to each destination. Frequent adjustment and re-adjustment itself disrupts circadian health, which is why aviation workers have elevated rates of sleep disorders and metabolic conditions.
    </div>
  </div>
</div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="py-5" style="background:#f8f9ff;">
  <div class="container" style="max-width:860px;">
    <h2 class="mb-4" style="color:var(--primary-dark);">Jet Lag Recovery — Eastward vs Westward Flights</h2>
    <p>Eastward travel is consistently harder to recover from than westward travel. Flying east requires advancing your circadian clock (going to sleep earlier than your body wants), which conflicts with the natural human tendency toward a slightly longer-than-24-hour internal day. Flying west requires delaying your clock (staying up later), which is more natural. As a rough guide: westward recovery takes 1 day per time zone crossed; eastward recovery takes 1.5 days per time zone. A 6-hour eastward flight can take 9 days to fully recover from.</p>
    <h2 class="mt-5 mb-4" style="color:var(--primary-dark);">How Long Does Jet Lag Last?</h2>
    <p>Jet lag duration depends on the number of time zones crossed and direction of travel. For short hauls (1–3 time zones), most people adjust within 1–3 days. For long hauls (6–12 time zones), full adjustment typically takes 6–12 days. Athletes and frequent travellers often adapt faster due to practiced sleep routines. Age also matters: older adults typically experience more severe jet lag and take longer to adjust than younger adults.</p>
    <h2 class="mt-5 mb-4" style="color:var(--primary-dark);">Jet Lag Tips for Long-Haul Flights</h2>
    <p>Evidence-based strategies to minimise jet lag: (1) Pre-adjust — shift your sleep 1 hour per day toward your destination time zone for 3 days before departure. (2) Light exposure — get bright light in the morning at your destination for eastward travel; bright light in the evening for westward. (3) Melatonin — 0.5 mg taken at the target destination's bedtime helps re-anchor your circadian clock. (4) Hydration — cabin air is extremely dry; dehydration worsens jet lag symptoms significantly. (5) Avoid alcohol on the flight — it fragments sleep quality even when you feel like it helps you sleep.</p>
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
        ['nap-calculator','💤','Nap Calculator','Power nap length and timing calculator.'],
        ['caffeine-sleep-calculator','☕','Caffeine & Sleep','Last safe coffee time for your bedtime.'],
        ['sleep-debt-calculator','📉','Sleep Debt Calculator','Calculate your weekly sleep deficit.'],
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

  window.calcJetLag = function () {
    var homeOff  = parseFloat(document.getElementById('homeOffset').value);
    var destOff  = parseFloat(document.getElementById('destOffset').value);
    var bedMin   = parseTime(document.getElementById('homeBedtime').value);

    var diff     = destOff - homeOff;
    var isEast   = diff > 0;
    var absDiff  = Math.abs(diff);

    // Shift bedtime to destination local time
    var destBedMin = bedMin - diff * 60;
    // Wrap to 0-1440
    destBedMin = ((destBedMin % 1440) + 1440) % 1440;

    // Recovery: ~1 day/tz east, ~0.75 days/tz west
    var recoveryDays = isEast
      ? Math.ceil(absDiff * 1.0)
      : Math.ceil(absDiff * 0.75);

    var difficulty = absDiff <= 2 ? 'Mild' : absDiff <= 5 ? 'Moderate' : absDiff <= 8 ? 'Significant' : 'Severe';
    var diffColor  = absDiff <= 2 ? '#155724' : absDiff <= 5 ? '#664d03' : absDiff <= 8 ? '#7a4004' : '#721c24';
    var diffBg     = absDiff <= 2 ? '#d1eddb' : absDiff <= 5 ? '#fff3cd' : absDiff <= 8 ? '#ffe5cc' : '#ffd5d5';

    if (absDiff === 0) {
      document.getElementById('jetContent').innerHTML = '<div class="p-4 rounded-3 text-center" style="background:#d1eddb; border:1px solid #c3e6cb;"><div style="font-size:2rem;">✈️</div><div style="font-size:1.2rem; font-weight:700; color:#155724; margin-top:8px;">No jet lag!</div><div style="font-size:.88rem; color:#555; margin-top:8px;">You\'re staying in the same time zone.</div></div>';
      document.getElementById('jetResult').classList.remove('d-none');
      return;
    }

    var direction = isEast ? 'eastward (advancing clock)' : 'westward (delaying clock)';

    var html = '<div class="p-4 rounded-3 mb-3" style="background:' + diffBg + '; border:1px solid ' + diffColor + '30;">'
      + '<div class="row g-3 text-center">'
      + '<div class="col-4"><div style="font-size:1.3rem; font-weight:800; color:' + diffColor + ';">' + absDiff + ' hrs</div><div style="font-size:.72rem; color:#888;">Time zone gap</div></div>'
      + '<div class="col-4"><div style="font-size:1.3rem; font-weight:800; color:' + diffColor + ';">' + difficulty + '</div><div style="font-size:.72rem; color:#888;">Jet lag level</div></div>'
      + '<div class="col-4"><div style="font-size:1.3rem; font-weight:800; color:' + diffColor + ';">' + recoveryDays + ' days</div><div style="font-size:.72rem; color:#888;">Recovery time</div></div>'
      + '</div></div>';

    html += '<p style="font-size:.88rem; color:#555; margin-bottom:12px;">Travelling <strong>' + direction + '</strong>. Your body clock will feel like it\'s ' + absDiff + ' hours ' + (isEast ? 'behind' : 'ahead of') + ' local time on arrival.</p>';

    html += '<div class="p-3 rounded-3 mb-3" style="background:#f0f4ff; border:1px solid var(--sleep)30;">'
      + '<p style="font-weight:700; color:var(--primary-dark); font-size:.88rem; margin-bottom:10px;">🌙 Target sleep times at destination</p>'
      + '<div class="d-flex flex-column gap-2">';

    for (var day = 0; day <= Math.min(recoveryDays, 5); day++) {
      var fraction = day / recoveryDays;
      var adjustment = Math.round(diff * 60 * fraction);
      var adjustedBed = bedMin - adjustment;
      var adjustedBedStr = formatTime(adjustedBed);
      var adjustedWake = adjustedBed + 8 * 60;
      var adjustedWakeStr = formatTime(adjustedWake);
      var label = day === 0 ? 'Arrival night' : 'Night ' + (day + 1);
      var isTarget = day === recoveryDays;
      html += '<div class="d-flex align-items-center gap-3 p-2 rounded" style="background:rgba(255,255,255,.8);">'
        + '<div style="font-size:.75rem; font-weight:700; color:var(--sleep); min-width:70px;">' + label + '</div>'
        + '<div style="font-size:.85rem; color:var(--primary-dark);">Bed: <strong>' + adjustedBedStr + '</strong> · Wake: <strong>' + adjustedWakeStr + '</strong></div>'
        + (isTarget ? '<span style="font-size:.7rem; color:#155724; font-weight:700; margin-left:auto;">✓ Adapted</span>' : '')
        + '</div>';
    }

    html += '</div></div>';
    html += '<div class="p-3 rounded-3" style="background:#fff8e1; border:1px solid #ffc10730; font-size:.82rem; color:#555; line-height:1.7;">'
      + '<strong>Key actions on arrival:</strong><br>'
      + (isEast
        ? '• Get bright light exposure in the MORNING (destination time)<br>• Avoid bright light after 7 PM local time for first 2 nights<br>• Take 0.5–3mg melatonin at destination bedtime'
        : '• Get light exposure in the LATE AFTERNOON at destination<br>• Stay awake as long as possible on arrival day<br>• Take 0.5mg melatonin at destination bedtime if needed')
      + '</div>';

    document.getElementById('jetContent').innerHTML = html;
    document.getElementById('jetResult').classList.remove('d-none');
    document.getElementById('jetResult').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  };
})();
</script>
@endsection
