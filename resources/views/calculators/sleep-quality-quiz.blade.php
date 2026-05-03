@extends('layouts.app')

@section('title', 'Sleep Quality Quiz — Score Your Sleep in 10 Questions | MindSnap')
@section('description', 'Take our 10-question sleep quality quiz based on the Pittsburgh Sleep Quality Index. Get your sleep score, identify what\'s hurting your sleep, and get personalised tips.')
@section('canonical', config('app.url') . '/sleep-quality-quiz')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "WebApplication",
  "name": "Sleep Quality Quiz",
  "url": "{{ config('app.url') }}/sleep-quality-quiz",
  "description": "A 10-question sleep quality assessment based on validated sleep science. Get a personalised sleep score and improvement tips.",
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
    { "@@type": "ListItem", "position": 3, "name": "Sleep Quality Quiz" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [
    { "@@type": "Question", "name": "What does the sleep quality quiz measure?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The quiz measures 7 domains of sleep quality: subjective sleep quality, sleep latency, sleep duration, sleep efficiency, sleep disturbances, use of sleep aids, and daytime dysfunction. It is based on the Pittsburgh Sleep Quality Index (PSQI), one of the most widely used clinical sleep assessment tools." } },
    { "@@type": "Question", "name": "What is a good sleep quality score?",
      "acceptedAnswer": { "@@type": "Answer", "text": "In the Pittsburgh Sleep Quality Index scoring system, a global score of 5 or below indicates good sleep quality. Scores of 6–10 indicate moderate sleep problems. Scores above 10 are associated with significant sleep disorder and should prompt discussion with a healthcare provider." } },
    { "@@type": "Question", "name": "Can poor sleep quality be improved without medication?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes. Cognitive Behavioural Therapy for Insomnia (CBT-I) is the gold standard treatment for chronic insomnia and is more effective than sleep medication in the long term. Key CBT-I techniques include sleep restriction, stimulus control, and sleep hygiene education — all of which produce lasting improvements without pharmaceutical dependence." } },
    { "@@type": "Question", "name": "When should I see a doctor about my sleep?",
      "acceptedAnswer": { "@@type": "Answer", "text": "See a GP or sleep specialist if: you score 10 or above on this quiz consistently, you snore loudly or a partner has witnessed you stop breathing during sleep (possible sleep apnoea), you experience uncontrollable leg movements at night (possible restless legs syndrome), you have excessive daytime sleepiness that impairs work or driving safety, or if self-help measures and CBT-I techniques have not improved your sleep after 6 weeks." } },
    { "@@type": "Question", "name": "What is the difference between insomnia and poor sleep quality?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Insomnia disorder is characterised by difficulty falling asleep, staying asleep, or waking too early — occurring at least 3 nights per week for 3 or more months — despite adequate sleep opportunity, and causing significant daytime impairment. Poor sleep quality is broader and includes disrupted sleep, non-restorative sleep, and environmental factors. Both respond to CBT-I techniques, though insomnia disorder often benefits from professional guidance." } }
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
            <li class="breadcrumb-item active" style="color:rgba(255,255,255,.8);">Sleep Quality Quiz</li>
          </ol>
        </nav>

        <h1 class="mb-2" style="color:#fff; font-size:clamp(1.9rem,4vw,2.8rem);">
          📋 Sleep Quality Quiz
        </h1>
        <p style="color:rgba(255,255,255,.7); font-size:1.05rem; max-width:520px; margin-bottom:28px;">
          10 questions based on clinical sleep science. Get your sleep quality score and discover what's affecting your sleep the most.
        </p>

        <div class="card border-0 mb-n4" style="border-radius:18px; box-shadow:0 20px 60px rgba(0,0,0,.25); position:relative; z-index:2;">
          <div class="card-body p-4 p-md-5">

            <div id="quizArea">
              {{-- Progress bar --}}
              <div class="d-flex align-items-center gap-2 mb-4">
                <div style="flex:1; background:#f0f0f0; border-radius:4px; height:6px;">
                  <div id="progressBar" style="width:0%; height:100%; background:var(--sleep); border-radius:4px; transition:width .3s;"></div>
                </div>
                <span id="progressText" style="font-size:.78rem; color:#888; min-width:50px; text-align:right;">0 / 10</span>
              </div>

              <div id="questionBlock"></div>

              <div class="d-flex gap-2 mt-4">
                <button id="prevBtn" class="btn btn-outline-secondary flex-fill" onclick="navigate(-1)" style="display:none;">← Back</button>
                <button id="nextBtn" class="btn btn-cta flex-fill" onclick="navigate(1)" style="display:none;">Next →</button>
                <button id="submitBtn" class="btn btn-cta flex-fill" onclick="submitQuiz()" style="display:none;">See My Score →</button>
              </div>
            </div>

            <div id="quizResult" class="d-none">
              <div id="resultContent"></div>
              <button class="btn w-100 mt-3" onclick="resetQuiz()"
                      style="border:2px solid var(--sleep); color:var(--sleep); border-radius:8px; font-weight:600; padding:12px;">
                Retake Quiz
              </button>
            </div>

          </div>
        </div>
      </div>

      <div class="col-lg-5 d-none d-lg-block" style="padding-top:10px;">
        <div style="color:rgba(255,255,255,.85);">
          <h3 style="color:#fff; font-size:.9rem; text-transform:uppercase; letter-spacing:.5px; font-weight:600; margin-bottom:16px;">What We Measure</h3>
          @foreach([
            ['Sleep Latency','How long it takes you to fall asleep'],
            ['Sleep Duration','Are you getting enough total hours?'],
            ['Sleep Efficiency','Time asleep vs time in bed ratio'],
            ['Sleep Disturbances','Night wakings and disruptions'],
            ['Daytime Function','Energy, focus, and mood impact'],
            ['Sleep Aids','Reliance on medication or alcohol'],
            ['Overall Quality','Your own assessment of sleep'],
          ] as [$label, $desc])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div style="width:8px; height:8px; border-radius:50%; background:var(--sleep); flex-shrink:0; margin-top:5px;"></div>
            <div>
              <div style="font-weight:600; font-size:.88rem; color:#fff;">{{ $label }}</div>
              <div style="font-size:.8rem; color:rgba(255,255,255,.55); line-height:1.4; margin-top:1px;">{{ $desc }}</div>
            </div>
          </div>
          @endforeach
        </div>
      </div>

    </div>
  </div>
</section>

{{-- What the score means --}}
<section style="background:#fff; padding:72px 0;">
  <div class="container-xl">
    <h2 class="text-center mb-2">Understanding Your Sleep Score</h2>
    <p class="text-center text-muted mb-5" style="max-width:480px; margin:0 auto 40px;">Based on the Pittsburgh Sleep Quality Index (PSQI) scoring framework.</p>
    <div class="row g-4 justify-content-center">
      @foreach([
        ['0–4','Excellent','#d1eddb','#155724','Very good sleeper. Your sleep habits are solid. Minor tweaks may provide small gains but nothing is fundamentally broken.'],
        ['5–7','Good','#cce5ff','#004085','Mostly good sleep with occasional issues. Focus on consistency — wake time and sleep schedule regularity will sharpen your quality.'],
        ['8–14','Poor','#fff3cd','#664d03','Significant sleep disruption. Multiple factors are affecting your sleep. CBT-I techniques will make a measurable difference. Consider a sleep diary.'],
        ['15–21','Severe','#ffd5d5','#721c24','Severely disrupted sleep affecting daily life. Consult a GP or sleep specialist. Conditions like insomnia disorder or sleep apnoea should be ruled out.'],
      ] as [$range,$label,$bg,$color,$desc])
      <div class="col-sm-6 col-lg-3">
        <div class="p-4 rounded-3 h-100" style="background:{{ $bg }}; border:1px solid {{ $color }}30;">
          <div style="font-size:1.3rem; font-weight:800; color:{{ $color }}; font-variant-numeric:tabular-nums;">{{ $range }}</div>
          <div style="font-weight:700; color:{{ $color }}; font-size:.85rem; margin:4px 0 12px; text-transform:uppercase; letter-spacing:.4px;">{{ $label }}</div>
          <p style="font-size:.82rem; color:#555; line-height:1.7; margin:0;">{{ $desc }}</p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- When to See a Doctor --}}
<section style="padding:48px 0; background:#fff;">
  <div class="container-xl">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="p-4 rounded-3" style="background:#fff5f5; border:2px solid #e9456040;">
          <div class="d-flex align-items-start gap-3">
            <div style="font-size:2rem; flex-shrink:0; line-height:1;">🚨</div>
            <div>
              <h2 style="font-size:1.1rem; margin-bottom:12px; color:#721c24;">When to See a Doctor — Red Flags</h2>
              <p style="font-size:.88rem; color:#555; margin-bottom:16px; line-height:1.7;">Self-help and CBT-I techniques address most sleep problems. But some sleep issues require medical assessment. See a GP or sleep specialist if any of the following apply:</p>
              <div class="row g-2">
                @foreach([
                  ['Loud snoring + daytime sleepiness','Possible obstructive sleep apnoea — pauses in breathing cause micro-arousals hundreds of times per night. Significantly increases cardiovascular risk when untreated.'],
                  ['Uncontrollable urge to move legs at night','Possible restless legs syndrome (RLS) or periodic limb movement disorder. Responds well to iron supplementation or medication if deficiency confirmed.'],
                  ['Consistent score of 10+ on this quiz','Suggests insomnia disorder or another treatable condition. CBT-I from a sleep psychologist produces better long-term outcomes than medication.'],
                  ['Excessive sleepiness despite 8+ hours','Possible narcolepsy, undiagnosed sleep apnoea, or hypersomnia. Not fixable with sleep hygiene alone — requires specialist evaluation.'],
                  ['Acting out vivid dreams (punching, kicking)','Possible REM sleep behaviour disorder — requires neurological assessment as it can be an early marker of Parkinson\'s disease.'],
                  ['Sleep problems persist 6+ weeks despite changes','Chronic insomnia disorder. A formal CBT-I programme or referral to a sleep psychologist is the recommended first-line treatment.'],
                ] as [$flag,$detail])
                <div class="col-md-6">
                  <div class="p-2 rounded" style="border-left:3px solid #e94560; background:rgba(233,69,96,.04);">
                    <div style="font-weight:700; font-size:.83rem; color:#721c24; margin-bottom:3px;">{{ $flag }}</div>
                    <div style="font-size:.78rem; color:#666; line-height:1.5;">{{ $detail }}</div>
                  </div>
                </div>
                @endforeach
              </div>
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
        <div class="accordion" id="sqFaq">
          @foreach([
            ['What is the Pittsburgh Sleep Quality Index?',
             'The Pittsburgh Sleep Quality Index (PSQI) is a validated clinical questionnaire developed in 1989 at the University of Pittsburgh. It is one of the most widely used sleep quality assessments in both clinical practice and sleep research worldwide. It measures 7 components of sleep quality over the past month and produces a global score where higher scores indicate worse sleep.'],
            ['Why do I feel tired even though I sleep 8 hours?',
             'Several factors can cause fatigue despite adequate duration: poor sleep quality (frequent micro-arousals that don\'t fully wake you but fragment sleep architecture), undiagnosed sleep apnoea (which causes hundreds of partial wakings per night), waking mid-cycle (triggering sleep inertia), poor sleep hygiene, nutritional deficiencies (iron, B12, vitamin D), or underlying medical conditions.'],
            ['What is CBT-I and is it effective?',
             'Cognitive Behavioural Therapy for Insomnia (CBT-I) is the first-line treatment for chronic insomnia recommended by the American Academy of Sleep Medicine. It outperforms sleeping pills in long-term outcomes and produces lasting change without dependency. Core techniques: sleep restriction (building homeostatic drive), stimulus control (bed = sleep only), cognitive restructuring (addressing unhelpful sleep beliefs), and sleep hygiene.'],
            ['How do I know if I have sleep apnoea?',
             'Key indicators: loud snoring, waking gasping or choking, partner reports witnessed apneas (breathing stopping), excessive daytime sleepiness despite 7–9 hours in bed, morning headaches, and dry mouth on waking. Sleep apnoea affects approximately 4–10% of adults and is significantly underdiagnosed. Consult a GP if you have 3 or more of these symptoms.'],
            ['Can improving sleep quality really change your health?',
             'Yes — dramatically. Studies consistently show that improving sleep quality (not just duration) improves immune function, reduces inflammatory markers, improves insulin sensitivity, enhances mood and emotional regulation, sharpens cognitive performance, and reduces cardiovascular risk. Sleep is the single highest ROI health intervention for most people — and it\'s free.'],
            ['When should I see a doctor about my sleep?',
             'Seek medical advice if: you score <strong>10 or above</strong> on this quiz consistently, you snore loudly or stop breathing during sleep (possible sleep apnoea), you have uncontrollable leg urges at night (possible restless legs), you have excessive daytime sleepiness that affects driving or work safety, or CBT-I techniques haven\'t helped after 6 weeks. Sleep apnoea in particular is seriously underdiagnosed — it affects 4–10% of adults and significantly increases cardiovascular risk when untreated.'],
            ['What\'s the difference between insomnia and just poor sleep?',
             'Insomnia disorder has a clinical definition: difficulty initiating or maintaining sleep (or waking too early) on <strong>3+ nights per week for 3+ months</strong>, despite adequate sleep opportunity, causing significant daytime impairment. Poor sleep quality is broader — it includes non-restorative sleep, environmental disruption, and lifestyle factors. Both respond to CBT-I. Insomnia disorder at clinical severity benefits from a formal CBT-I programme or referral to a sleep psychologist.'],
          ] as $i => [$q, $a])
          <div class="accordion-item border-0 mb-2" style="border-radius:10px; overflow:hidden; box-shadow:0 2px 10px rgba(0,0,0,.05);">
            <h3 class="accordion-header">
              <button class="accordion-button {{ $i > 0 ? 'collapsed' : '' }} fw-600"
                      type="button" data-bs-toggle="collapse" data-bs-target="#sqFaq{{ $i }}"
                      style="font-size:.9rem; background:#fff; color:var(--primary-dark);">{{ $q }}</button>
            </h3>
            <div id="sqFaq{{ $i }}" class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}" data-bs-parent="#sqFaq">
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
        ['nap-calculator','💤','Nap Calculator','Power nap or full cycle timing.'],
        ['sleep-debt-calculator','📉','Sleep Debt Calculator','How much sleep are you missing?'],
        ['caffeine-sleep-calculator','☕','Caffeine & Sleep','Last safe coffee time for your bedtime.'],
        ['jet-lag-calculator','✈️','Jet Lag Calculator','Sleep plan for long-haul flights.'],
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
  var QUESTIONS = [
    {
      id: 'latency',
      text: 'On average, how long does it take you to fall asleep after getting into bed?',
      type: 'single',
      options: [
        { label: 'Under 15 minutes', score: 0 },
        { label: '15–30 minutes', score: 1 },
        { label: '30–60 minutes', score: 2 },
        { label: 'Over 60 minutes', score: 3 },
      ],
    },
    {
      id: 'duration',
      text: 'How many hours of actual sleep do you typically get per night?',
      type: 'single',
      options: [
        { label: 'More than 7 hours', score: 0 },
        { label: '6–7 hours', score: 1 },
        { label: '5–6 hours', score: 2 },
        { label: 'Less than 5 hours', score: 3 },
      ],
    },
    {
      id: 'quality',
      text: 'How would you rate the overall quality of your sleep over the past month?',
      type: 'single',
      options: [
        { label: 'Very good', score: 0 },
        { label: 'Fairly good', score: 1 },
        { label: 'Fairly bad', score: 2 },
        { label: 'Very bad', score: 3 },
      ],
    },
    {
      id: 'waking',
      text: 'How often do you wake up in the middle of the night or early morning?',
      type: 'single',
      options: [
        { label: 'Not during the past month', score: 0 },
        { label: 'Less than once a week', score: 1 },
        { label: '1–2 times per week', score: 2 },
        { label: '3 or more times per week', score: 3 },
      ],
    },
    {
      id: 'bedtime',
      text: 'How consistent is your bedtime?',
      type: 'single',
      options: [
        { label: 'Within 30 minutes, every day', score: 0 },
        { label: 'Within 1 hour most nights', score: 1 },
        { label: 'Varies by 1–2 hours regularly', score: 2 },
        { label: 'Very inconsistent — shifts by 2+ hours', score: 3 },
      ],
    },
    {
      id: 'efficiency',
      text: 'What percentage of your time in bed are you actually asleep?',
      type: 'single',
      options: [
        { label: '85% or more', score: 0 },
        { label: '75–84%', score: 1 },
        { label: '65–74%', score: 2 },
        { label: 'Less than 65%', score: 3 },
      ],
    },
    {
      id: 'daytime',
      text: 'How often do you have trouble staying awake or feel very sleepy during the day?',
      type: 'single',
      options: [
        { label: 'Not during the past month', score: 0 },
        { label: 'Less than once a week', score: 1 },
        { label: '1–2 times per week', score: 2 },
        { label: '3 or more times per week', score: 3 },
      ],
    },
    {
      id: 'function',
      text: 'How often has sleep problems caused difficulty with your concentration, memory, or mood?',
      type: 'single',
      options: [
        { label: 'Never', score: 0 },
        { label: 'Occasionally (less than once a week)', score: 1 },
        { label: 'Regularly (1–2 times/week)', score: 2 },
        { label: 'Most days (3+ times/week)', score: 3 },
      ],
    },
    {
      id: 'aids',
      text: 'How often have you taken medication or alcohol to help you sleep?',
      type: 'single',
      options: [
        { label: 'Never', score: 0 },
        { label: 'Less than once a week', score: 1 },
        { label: '1–2 times per week', score: 2 },
        { label: '3 or more times per week', score: 3 },
      ],
    },
    {
      id: 'environment',
      text: 'Which best describes your sleep environment?',
      type: 'single',
      options: [
        { label: 'Dark, cool, quiet — optimised for sleep', score: 0 },
        { label: 'Mostly good with minor issues', score: 1 },
        { label: 'Light, noise, or temperature problems regularly', score: 2 },
        { label: 'Significantly disruptive environment most nights', score: 3 },
      ],
    },
  ];

  var TIPS = {
    latency: { label: 'Sleep latency', tip: 'Try the 4-7-8 breathing method at lights out. No screens for 60 min before bed. Keep bedroom at 65–68°F (18–20°C).' },
    duration: { label: 'Sleep duration', tip: 'Move your bedtime earlier by 30 min per week until you reach your natural wake time without an alarm. Protect sleep like an appointment.' },
    quality: { label: 'Sleep quality', tip: 'Consider a sleep diary for 2 weeks to identify patterns. Common culprits: caffeine, alcohol, irregular schedule, and bedroom environment.' },
    waking: { label: 'Night wakings', tip: 'Common causes: sleep apnoea, bladder pressure (reduce fluids 2h before bed), noise or light, anxiety. If it persists, discuss with a GP.' },
    bedtime: { label: 'Sleep schedule', tip: 'Anchor your wake time first — same every day including weekends. Your bedtime will naturally settle once your wake time is fixed for 2 weeks.' },
    efficiency: { label: 'Sleep efficiency', tip: 'Sleep restriction therapy: start by reducing time in bed to your actual sleep time, then gradually extend by 15 min when efficiency exceeds 85%.' },
    daytime: { label: 'Daytime sleepiness', tip: 'Evaluate total sleep duration. A 20-min power nap at 1–2 PM can restore afternoon alertness without disrupting night sleep.' },
    function: { label: 'Daytime function', tip: 'Cognitive impairment from poor sleep can feel permanent but resolves within 2 weeks of improved sleep. Prioritise sleep before any performance goals.' },
    aids: { label: 'Sleep aids', tip: 'Alcohol suppresses deep sleep and REM despite making you fall asleep faster. Sleeping pills lose effectiveness within weeks. CBT-I is the long-term solution.' },
    environment: { label: 'Sleep environment', tip: 'Blackout curtains, a white noise machine, and a room temperature of 65–68°F are the three highest-ROI sleep environment changes.' },
  };

  var answers = {};
  var current = 0;

  function renderQuestion(idx) {
    var q = QUESTIONS[idx];
    var html = '<p style="font-weight:700; color:var(--primary-dark); font-size:.95rem; margin-bottom:16px; line-height:1.5;">'
      + (idx + 1) + '. ' + q.text + '</p>'
      + '<div class="d-flex flex-column gap-2">';

    q.options.forEach(function (opt, oi) {
      var isSelected = answers[q.id] === oi;
      html += '<label class="d-flex align-items-center gap-3 p-3 rounded-3" '
        + 'style="border:2px solid ' + (isSelected ? 'var(--sleep)' : '#e0e0e0') + '; '
        + 'background:' + (isSelected ? 'rgba(108,99,255,.06)' : '#fff') + '; '
        + 'cursor:pointer; transition:all .1s;" '
        + 'onclick="selectAnswer(\'' + q.id + '\',' + oi + ',' + opt.score + ')">'
        + '<input type="radio" name="q' + idx + '" value="' + oi + '" '
        + (isSelected ? 'checked' : '') + ' style="accent-color:var(--sleep);">'
        + '<span style="font-size:.9rem; color:#333;">' + opt.label + '</span>'
        + '</label>';
    });

    html += '</div>';
    document.getElementById('questionBlock').innerHTML = html;

    var pct = Math.round(((idx + 1) / QUESTIONS.length) * 100);
    document.getElementById('progressBar').style.width = pct + '%';
    document.getElementById('progressText').textContent = (idx + 1) + ' / ' + QUESTIONS.length;

    document.getElementById('prevBtn').style.display = idx > 0 ? 'block' : 'none';
    document.getElementById('nextBtn').style.display = idx < QUESTIONS.length - 1 ? 'block' : 'none';
    document.getElementById('submitBtn').style.display = idx === QUESTIONS.length - 1 ? 'block' : 'none';
  }

  window.selectAnswer = function (id, optIdx, score) {
    answers[id] = optIdx;
    answers[id + '_score'] = score;
    renderQuestion(current);
  };

  window.navigate = function (dir) {
    var q = QUESTIONS[current];
    if (dir > 0 && answers[q.id] === undefined) {
      document.getElementById('questionBlock').insertAdjacentHTML('beforeend',
        '<p style="color:#e94560; font-size:.8rem; margin-top:8px;">Please select an answer to continue.</p>');
      return;
    }
    current = Math.max(0, Math.min(QUESTIONS.length - 1, current + dir));
    renderQuestion(current);
  };

  window.submitQuiz = function () {
    var q = QUESTIONS[current];
    if (answers[q.id] === undefined) {
      document.getElementById('questionBlock').insertAdjacentHTML('beforeend',
        '<p style="color:#e94560; font-size:.8rem; margin-top:8px;">Please select an answer to see your score.</p>');
      return;
    }

    var total = 0;
    var poorDomains = [];
    QUESTIONS.forEach(function (q) {
      var s = answers[q.id + '_score'] || 0;
      total += s;
      if (s >= 2) poorDomains.push(q.id);
    });

    var label, bg, color, icon, advice;
    if (total <= 4) {
      label = 'Excellent Sleep'; bg = '#d1eddb'; color = '#155724'; icon = '🌟';
      advice = 'Your sleep is in great shape. Maintain your current habits — especially consistent wake times and good sleep hygiene.';
    } else if (total <= 7) {
      label = 'Good Sleep'; bg = '#cce5ff'; color = '#004085'; icon = '✅';
      advice = 'You\'re sleeping reasonably well. Minor improvements in the flagged areas below will make a noticeable difference.';
    } else if (total <= 14) {
      label = 'Poor Sleep'; bg = '#fff3cd'; color = '#664d03'; icon = '⚠️';
      advice = 'Multiple sleep quality issues are affecting your rest. Focus on the areas below — even 2–3 improvements will compound quickly.';
    } else {
      label = 'Severe Sleep Issues'; bg = '#ffd5d5'; color = '#721c24'; icon = '🚨';
      advice = 'Your sleep is significantly disrupted. Consider speaking to a GP or seeking a referral to a sleep specialist. CBT-I is highly effective even at this level.';
    }

    var html = '<div class="p-4 rounded-3 text-center mb-4" style="background:' + bg + '; border:1px solid ' + color + '30;">'
      + '<div style="font-size:2.5rem;">' + icon + '</div>'
      + '<div style="font-size:2.5rem; font-weight:800; color:' + color + '; line-height:1.2;">' + total + '/30</div>'
      + '<div style="font-weight:700; color:' + color + '; font-size:.9rem; margin:4px 0 8px; text-transform:uppercase; letter-spacing:.5px;">' + label + '</div>'
      + '<p style="font-size:.88rem; color:#555; margin:0;">' + advice + '</p>'
      + '</div>';

    if (poorDomains.length > 0) {
      html += '<div class="p-3 rounded-3" style="background:#f0f4ff; border:1px solid var(--sleep)30;">'
        + '<p style="font-weight:700; color:var(--primary-dark); font-size:.88rem; margin-bottom:12px;">📋 Your Focus Areas</p>'
        + '<div class="d-flex flex-column gap-3">';
      poorDomains.forEach(function (id) {
        var tip = TIPS[id];
        html += '<div><div style="font-weight:700; font-size:.85rem; color:var(--sleep); margin-bottom:3px;">→ ' + tip.label + '</div>'
          + '<div style="font-size:.82rem; color:#555; line-height:1.6;">' + tip.tip + '</div></div>';
      });
      html += '</div></div>';
    }

    document.getElementById('quizArea').classList.add('d-none');
    document.getElementById('quizResult').classList.remove('d-none');
    document.getElementById('resultContent').innerHTML = html;
    document.getElementById('quizResult').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  };

  window.resetQuiz = function () {
    answers = {};
    current = 0;
    document.getElementById('quizArea').classList.remove('d-none');
    document.getElementById('quizResult').classList.add('d-none');
    renderQuestion(0);
  };

  // Init
  renderQuestion(0);
  document.getElementById('prevBtn').style.display = 'none';
  document.getElementById('nextBtn').style.display = 'block';
  document.getElementById('submitBtn').style.display = 'none';
})();
</script>
@endsection
