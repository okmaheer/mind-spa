@extends('layouts.app')

@section('title', 'GAD-7 Anxiety Test — Free Online Screening | MindSnap')
@section('description', 'Take the clinically validated GAD-7 anxiety screening test free online. Get your score instantly with a clear explanation of what it means for your wellbeing.')
@section('canonical', config('app.url') . '/anxiety-quiz')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "WebApplication",
  "name": "GAD-7 Anxiety Test",
  "url": "{{ config('app.url') }}/anxiety-quiz",
  "description": "The clinically validated GAD-7 generalised anxiety disorder screening questionnaire. 7 questions, instant score, clear interpretation.",
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
    { "@@type": "ListItem", "position": 1, "name": "Home",                 "item": "{{ config('app.url') }}" },
    { "@@type": "ListItem", "position": 2, "name": "Mental Health Tools",  "item": "{{ config('app.url') }}/mental-health-tools" },
    { "@@type": "ListItem", "position": 3, "name": "GAD-7 Anxiety Test" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [
    { "@@type": "Question", "name": "What is the GAD-7?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The GAD-7 (Generalised Anxiety Disorder 7-item scale) is a validated clinical screening tool developed by Spitzer et al. in 2006. It is widely used by GPs, psychiatrists, and researchers worldwide to screen for generalised anxiety disorder and measure symptom severity. A score of 10 or above indicates moderate to severe anxiety warranting clinical evaluation." } },
    { "@@type": "Question", "name": "What does a GAD-7 score of 10 mean?",
      "acceptedAnswer": { "@@type": "Answer", "text": "A GAD-7 score of 10–14 indicates moderate anxiety. At this level, anxiety is likely causing meaningful disruption to daily functioning. Clinical guidelines recommend that a score of 10 or above should prompt further assessment by a healthcare professional. It does not mean you have GAD — a diagnosis requires a clinical interview — but it does indicate symptoms worth discussing with a doctor." } },
    { "@@type": "Question", "name": "Is the GAD-7 a diagnosis?",
      "acceptedAnswer": { "@@type": "Answer", "text": "No. The GAD-7 is a screening tool, not a diagnostic instrument. A high score means anxiety symptoms are present at a level that warrants professional assessment, not that you have been diagnosed with generalised anxiety disorder. Only a qualified healthcare professional can make a clinical diagnosis following a comprehensive evaluation." } },
    { "@@type": "Question", "name": "How accurate is the GAD-7?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The GAD-7 has been validated in large primary care populations. At a cut-off of 10, it has a sensitivity of 89% and specificity of 82% for detecting generalised anxiety disorder. It also performs well as a screening tool for panic disorder, social anxiety disorder, and post-traumatic stress disorder. It is one of the most widely used and well-validated mental health screening tools in the world." } },
    { "@@type": "Question", "name": "What is the difference between anxiety and GAD?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Anxiety is a normal emotional response to stress or perceived threat. Generalised Anxiety Disorder (GAD) is a clinical condition characterised by excessive, uncontrollable worry about multiple areas of life (health, work, relationships, finances) occurring more days than not for at least 6 months, causing significant distress or functional impairment. The key distinguishing features are the breadth of worry, difficulty controlling it, chronicity, and impact on daily life." } },
    { "@@type": "Question", "name": "Can anxiety be treated without medication?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes. Cognitive Behavioural Therapy (CBT) is the gold-standard first-line treatment for generalised anxiety disorder and is as effective as medication in the short term, with better long-term outcomes and no side effects. Other evidence-based approaches include Acceptance and Commitment Therapy (ACT), mindfulness-based stress reduction (MBSR), and regular aerobic exercise. Medication (typically SSRIs or SNRIs) is often combined with therapy for moderate to severe cases." } },
    { "@@type": "Question", "name": "How often should I take the GAD-7?",
      "acceptedAnswer": { "@@type": "Answer", "text": "For monitoring purposes, the GAD-7 is typically administered every 2–4 weeks in clinical settings to track treatment response. For personal use, taking it once a month is reasonable if you are managing anxiety — this allows you to track trends without over-monitoring. If you score 10 or above consistently, speak to your GP rather than continuing to self-monitor." } },
    { "@@type": "Question", "name": "What should I do if I score in the severe range?",
      "acceptedAnswer": { "@@type": "Answer", "text": "A score of 15–21 indicates severe anxiety. You should speak to your GP or a mental health professional as soon as reasonably possible. Severe anxiety is very treatable — it is not a sign of weakness or permanent condition. Your doctor can discuss therapy options (CBT is most effective), medication if appropriate, and refer you to specialist services if needed. If you are in crisis, contact Samaritans on 116 123 (UK) or Crisis Text Line by texting HOME to 741741 (US)." } },
    { "@@type": "Question", "name": "Does the GAD-7 test for all anxiety disorders?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The GAD-7 primarily screens for generalised anxiety disorder but also has reasonable sensitivity for panic disorder, social anxiety disorder, and PTSD. It does not specifically screen for phobias, OCD, or health anxiety. If you have specific worries about a particular type of anxiety, tell your GP — different anxiety disorders have different treatment pathways, though CBT is effective across most of them." } }
  ]
}
</script>
@endsection

@php
$faqs = [
  ['q' => 'What is the GAD-7?',
   'a' => 'The GAD-7 (Generalised Anxiety Disorder 7-item scale) is a validated clinical screening tool developed by Spitzer et al. in 2006. It is used by GPs, psychiatrists, and researchers worldwide to screen for generalised anxiety disorder and measure symptom severity. A score of 10 or above indicates moderate to severe anxiety warranting clinical evaluation.'],
  ['q' => 'What does a GAD-7 score of 10 mean?',
   'a' => 'A score of 10–14 indicates moderate anxiety. Clinical guidelines recommend that a score of 10 or above should prompt further assessment by a healthcare professional. It does not mean you have GAD — only a clinical interview can establish a diagnosis — but it does indicate symptoms worth discussing with a doctor.'],
  ['q' => 'Is the GAD-7 a diagnosis?',
   'a' => 'No. The GAD-7 is a screening tool, not a diagnostic instrument. A high score means anxiety symptoms are present at a level warranting professional assessment. Only a qualified healthcare professional can make a clinical diagnosis following a comprehensive evaluation.'],
  ['q' => 'How accurate is the GAD-7?',
   'a' => 'At a cut-off of 10, the GAD-7 has a sensitivity of 89% and specificity of 82% for detecting generalised anxiety disorder. It also performs well as a screening tool for panic disorder, social anxiety disorder, and PTSD. It is one of the most widely validated mental health screening instruments in the world.'],
  ['q' => 'What is the difference between anxiety and GAD?',
   'a' => 'Anxiety is a normal response to stress. Generalised Anxiety Disorder (GAD) is a clinical condition characterised by excessive, uncontrollable worry about multiple areas of life occurring more days than not for at least 6 months, causing significant distress or functional impairment. The key features are breadth of worry, difficulty controlling it, chronicity, and impact on daily life.'],
  ['q' => 'Can anxiety be treated without medication?',
   'a' => 'Yes. Cognitive Behavioural Therapy (CBT) is the gold-standard first-line treatment for GAD and is as effective as medication in the short term with better long-term outcomes. Other evidence-based approaches include Acceptance and Commitment Therapy (ACT), mindfulness-based stress reduction (MBSR), and regular aerobic exercise. Medication (SSRIs or SNRIs) is often combined with therapy for moderate to severe cases.'],
  ['q' => 'How often should I take the GAD-7?',
   'a' => 'For monitoring, the GAD-7 is typically administered every 2–4 weeks in clinical settings. For personal use, once a month is reasonable if you are managing anxiety. If you score 10 or above consistently, speak to your GP rather than continuing to self-monitor.'],
  ['q' => 'What should I do if I score in the severe range?',
   'a' => 'A score of 15–21 indicates severe anxiety. Speak to your GP or a mental health professional as soon as reasonably possible. Severe anxiety is treatable — it is not a permanent state. Your doctor can discuss CBT, medication if appropriate, and specialist referral. In crisis, contact Samaritans on 116 123 (UK) or Crisis Text Line by texting HOME to 741741 (US).'],
  ['q' => 'Does the GAD-7 test for all anxiety disorders?',
   'a' => 'The GAD-7 primarily screens for generalised anxiety disorder but also has reasonable sensitivity for panic disorder, social anxiety disorder, and PTSD. It does not specifically screen for phobias, OCD, or health anxiety. If you have concerns about a specific type of anxiety, tell your GP — different anxiety disorders have different treatment pathways.'],
];

$relatedTools = [
  ['icon' => '😔', 'name' => 'PHQ-9 Depression Test',    'slug' => 'depression-screening',   'desc' => 'Validated depression screening in 9 questions.'],
  ['icon' => '🔗', 'name' => 'Attachment Style Quiz',    'slug' => 'attachment-style-quiz',   'desc' => 'Discover your relationship attachment pattern.'],
  ['icon' => '😴', 'name' => 'Sleep Quality Quiz',       'slug' => 'sleep-quality-quiz',      'desc' => 'Score your sleep across 7 clinical domains.'],
  ['icon' => '🧘', 'name' => 'Stress Score',             'slug' => 'stress-score',            'desc' => 'Measure your current stress burden.'],
];
@endphp

@section('styles')
<style>
.gad-disclaimer      { background:#fff8e1; border:1px solid #ffe082; border-radius:10px; }
.gad-disclaimer-icon { font-size:1.4rem; flex-shrink:0; line-height:1; }
.gad-disclaimer-text { font-size:.82rem; color:#5d4037; line-height:1.6; margin:0; }
.gad-q-label         { font-weight:700; color:var(--primary-dark); font-size:.95rem; margin-bottom:14px; line-height:1.5; }
.gad-q-num           { color:var(--mental-health); font-weight:800; }
.gad-option          { border:2px solid #e0e0e0; background:#fff; cursor:pointer; transition:border-color .12s, background .12s; }
.gad-option:hover    { border-color:#c9b8ff; background:#fafaff; }
.gad-option-sel      { border-color:var(--mental-health) !important; background:rgba(233,69,96,.05) !important; }
.gad-radio           { accent-color:var(--mental-health); flex-shrink:0; }
.gad-option-label    { font-size:.88rem; color:#333; }
.gad-option-score    { font-size:.75rem; color:#aaa; margin-left:auto; flex-shrink:0; }
.gad-error           { color:#c23152; font-size:.82rem; margin-top:6px; }
.gad-prog-wrap       { flex:1; background:#f0f0f0; border-radius:4px; height:6px; }
.gad-prog-bar        { height:100%; background:var(--mental-health); border-radius:4px; transition:width .3s; }
.gad-prog-text       { font-size:.78rem; color:#888; min-width:46px; text-align:right; }
.gad-retake-btn      { border:2px solid var(--mental-health); color:var(--mental-health); border-radius:8px; font-weight:600; padding:12px; background:transparent; width:100%; margin-top:16px; }
.gad-retake-btn:hover { background:var(--mental-health); color:#fff; }
.gad-intro-subtitle  { max-width:460px; margin:0 auto 40px; }

/* Result cards */
.gad-result-minimal  { background:#d1eddb; border:1px solid rgba(21,87,36,.2); }
.gad-result-minimal .gad-res-score,
.gad-result-minimal .gad-res-label  { color:#155724; }
.gad-result-mild     { background:#fff3cd; border:1px solid rgba(102,77,3,.2); }
.gad-result-mild .gad-res-score,
.gad-result-mild .gad-res-label     { color:#664d03; }
.gad-result-moderate { background:#ffe5c8; border:1px solid rgba(140,60,0,.2); }
.gad-result-moderate .gad-res-score,
.gad-result-moderate .gad-res-label { color:#8c3c00; }
.gad-result-severe   { background:#ffd5d5; border:1px solid rgba(114,28,36,.2); }
.gad-result-severe .gad-res-score,
.gad-result-severe .gad-res-label   { color:#721c24; }

.gad-res-icon        { font-size:2.4rem; line-height:1; margin-bottom:8px; }
.gad-res-score       { font-size:2.4rem; font-weight:800; line-height:1.2; }
.gad-res-label       { font-weight:700; font-size:.88rem; text-transform:uppercase; letter-spacing:.5px; margin:4px 0 10px; }
.gad-res-desc        { font-size:.85rem; color:#555; line-height:1.7; margin:0; }
.gad-res-disclaimer  { background:#fff5f5; border:2px solid rgba(233,69,96,.25); border-radius:10px; }
.gad-res-disclaimer p { font-size:.82rem; color:#721c24; margin:0; line-height:1.6; }
.gad-advice-box      { background:#f8f9ff; border-radius:10px; }
.gad-advice-title    { font-weight:700; color:var(--primary-dark); font-size:.88rem; margin-bottom:12px; }
.gad-advice-item     { font-size:.82rem; color:#444; line-height:1.6; }

/* Score range reference cards */
.gad-range-card      { border-radius:12px; padding:20px; height:100%; }
.gad-range-card-min  { background:#d1eddb; }
.gad-range-card-min .gad-range-val,
.gad-range-card-min .gad-range-lbl  { color:#155724; }
.gad-range-card-mld  { background:#fff3cd; }
.gad-range-card-mld .gad-range-val,
.gad-range-card-mld .gad-range-lbl  { color:#664d03; }
.gad-range-card-mod  { background:#ffe5c8; }
.gad-range-card-mod .gad-range-val,
.gad-range-card-mod .gad-range-lbl  { color:#8c3c00; }
.gad-range-card-sev  { background:#ffd5d5; }
.gad-range-card-sev .gad-range-val,
.gad-range-card-sev .gad-range-lbl  { color:#721c24; }
.gad-range-val       { font-size:1.4rem; font-weight:800; }
.gad-range-lbl       { font-weight:700; font-size:.82rem; text-transform:uppercase; letter-spacing:.4px; margin:4px 0 10px; }
.gad-range-desc      { font-size:.8rem; color:#555; line-height:1.6; margin:0; }

/* Self-help section */
.gad-tip-card        { border-radius:12px; background:#fff; border:1px solid #eee; padding:20px; height:100%; }
.gad-tip-icon        { font-size:1.6rem; margin-bottom:10px; }
.gad-tip-title       { font-weight:700; color:var(--primary-dark); font-size:.9rem; margin-bottom:6px; }
.gad-tip-body        { font-size:.82rem; color:#555; line-height:1.65; margin:0; }

/* When to seek help */
.gad-help-box        { background:#fff5f5; border:2px solid rgba(233,69,96,.25); border-radius:12px; }
.gad-help-flag       { border-left:3px solid var(--mental-health); background:rgba(233,69,96,.04); padding:10px 14px; border-radius:0 8px 8px 0; }
.gad-help-flag-title { font-weight:700; font-size:.83rem; color:#721c24; margin-bottom:3px; }
.gad-help-flag-desc  { font-size:.78rem; color:#666; line-height:1.5; margin:0; }

/* Hero sidebar facts column */
.gad-fact-dot        { width:8px; height:8px; border-radius:50%; background:var(--mental-health); flex-shrink:0; margin-top:6px; }
.gad-fact-label      { font-weight:600; font-size:.88rem; color:#fff; }
.gad-fact-desc       { font-size:.75rem; color:rgba(255,255,255,.55); }
.gad-help-h2         { font-weight:700; font-size:1.1rem; color:#721c24; }
</style>
@endsection

@section('content')

<section class="ms-hero">
  <div class="container-xl">
    <div class="row align-items-start g-5">

      <div class="col-lg-7">
        <x-breadcrumb :crumbs="[
          ['url' => route('home'),                   'name' => 'Home'],
          ['url' => route('category.mental-health'), 'name' => 'Mental Health Tools'],
          ['url' => '',                              'name' => 'GAD-7 Anxiety Test'],
        ]"/>

        <h1 class="mb-2 ms-hero-title">
          🧠 GAD-7 Anxiety Test — Clinically Validated Screening
        </h1>
        <p class="ms-hero-desc">
          7 questions based on the official GAD-7 scale used by doctors worldwide. Takes under 2 minutes. Get your score with a plain-English explanation.
        </p>

        <div class="card border-0 mb-n4 ms-tool-card">
          <div class="card-body p-4 p-md-5">

            {{-- Medical disclaimer --}}
            <div class="d-flex align-items-start gap-3 p-3 mb-4 rounded-3 gad-disclaimer">
              <div class="gad-disclaimer-icon">ℹ️</div>
              <p class="gad-disclaimer-text">This is a <strong>screening tool, not a diagnosis</strong>. Results indicate whether symptoms are present — only a qualified healthcare professional can diagnose anxiety disorders. If you are in crisis, contact Samaritans on <strong>116 123</strong> (UK) or text HOME to <strong>741741</strong> (US).</p>
            </div>

            <div id="gadQuizArea">
              {{-- Progress bar --}}
              <div class="d-flex align-items-center gap-2 mb-4">
                <div class="gad-prog-wrap">
                  <div id="gadProgressBar" class="gad-prog-bar" id="gadProgressBar"></div>
                </div>
                <span id="gadProgressText" class="gad-prog-text">0 / 7</span>
              </div>

              <p class="text-muted text-sm mb-4 fw-600">Over the last 2 weeks, how often have you been bothered by the following problems?</p>

              <div id="gadQuestionContainer"></div>

              <div id="gadErrorMsg" class="gad-error d-none">Please answer all questions before viewing your score.</div>

              <button class="btn btn-cta w-100 mt-4" onclick="gadSubmit()">Get My Score →</button>
            </div>

            <div id="gadResult" class="d-none">
              <div id="gadResultContent"></div>
              <button class="gad-retake-btn" onclick="gadReset()">Retake Quiz</button>
            </div>

          </div>
        </div>
      </div>

      <div class="col-lg-5 d-none d-lg-block pt-2">
        <div class="ms-facts-wrap">
          <h3 class="ms-facts-title">What GAD-7 Measures</h3>
          @foreach([
            ['Worry frequency',    'How often anxious thoughts intrude on daily life'],
            ['Loss of control',    'Ability to stop or redirect worrying'],
            ['Scope of anxiety',   'Whether worry spans multiple life domains'],
            ['Physical tension',   'Difficulty relaxing and somatic restlessness'],
            ['Irritability',       'Anxiety-driven emotional reactivity'],
            ['Fear and dread',     'Sense of impending threat or doom'],
            ['Functional impact',  'How symptoms affect work and relationships'],
          ] as [$label, $desc])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div class="gad-fact-dot"></div>
            <div>
              <div class="gad-fact-label">{{ $label }}</div>
              <div class="gad-fact-desc">{{ $desc }}</div>
            </div>
          </div>
          @endforeach
          <p class="ms-fact-source mt-3">Based on Spitzer RL et al. (2006). GAD-7 — validated in primary care populations across 15 countries.</p>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- Score ranges --}}
<section class="ms-section-white">
  <div class="container-xl">
    <h2 class="text-center mb-2">Understanding Your GAD-7 Score</h2>
    <p class="text-center text-muted mb-5 gad-intro-subtitle">Scores range from 0 to 21. Higher scores indicate greater anxiety symptom severity.</p>
    <div class="row g-4 justify-content-center">
      <div class="col-sm-6 col-lg-3">
        <div class="gad-range-card gad-range-card-min">
          <div class="gad-range-val">0–4</div>
          <div class="gad-range-lbl">Minimal Anxiety</div>
          <p class="gad-range-desc">Anxiety symptoms are minimal or absent. Normal stress responses are present but not impairing daily function. No action required beyond maintaining healthy habits.</p>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="gad-range-card gad-range-card-mld">
          <div class="gad-range-val">5–9</div>
          <div class="gad-range-lbl">Mild Anxiety</div>
          <p class="gad-range-desc">Mild anxiety symptoms present. May be causing some discomfort but typically not severely limiting. Self-help strategies and lifestyle changes are a good first step.</p>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="gad-range-card gad-range-card-mod">
          <div class="gad-range-val">10–14</div>
          <div class="gad-range-lbl">Moderate Anxiety</div>
          <p class="gad-range-desc">Moderate anxiety likely affecting multiple areas of daily life. Clinical guidelines recommend professional assessment at this level. Therapy (especially CBT) is highly effective.</p>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="gad-range-card gad-range-card-sev">
          <div class="gad-range-val">15–21</div>
          <div class="gad-range-lbl">Severe Anxiety</div>
          <p class="gad-range-desc">Severe anxiety causing significant impairment. Please speak to a GP or mental health professional. Treatment is very effective — severe anxiety is not a permanent state.</p>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- What is the GAD-7 --}}
<section class="ms-section-accent">
  <div class="container ms-longtail">
    <h2 class="mb-4 text-brand">What Is the GAD-7?</h2>
    <p class="ms-body-text">The GAD-7 (Generalised Anxiety Disorder 7-item scale) was developed by Robert Spitzer and colleagues and published in <em>Archives of Internal Medicine</em> in 2006. It was designed as a brief, practical screening tool that primary care physicians could use in everyday consultations to identify patients with clinically significant anxiety.</p>
    <p class="ms-body-text">Since publication, the GAD-7 has been translated into over 30 languages and validated across dozens of countries and populations. It is now one of the most commonly used mental health screening instruments in primary care globally, included in standard electronic health record systems in the UK (NHS), US, Canada, and Australia.</p>
    <p class="ms-body-text">The scale covers the core diagnostic criteria for generalised anxiety disorder as defined in the DSM-5 and ICD-11: excessive worry, difficulty controlling worry, associated physical and psychological symptoms, and functional impairment. A score of 10 is the recommended clinical cut-off for probable GAD, offering the best balance of sensitivity (89%) and specificity (82%).</p>
    <p class="ms-body-text">Importantly, the GAD-7 also has demonstrated sensitivity for other anxiety disorders — panic disorder (74%), social anxiety disorder (72%), and PTSD (66%) — making it a useful general-purpose anxiety screener even when the primary presentation is not classic GAD.</p>
  </div>
</section>

{{-- When to seek help --}}
<section class="ms-section-white">
  <div class="container-xl">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="p-4 rounded-3 gad-help-box">
          <div class="d-flex align-items-start gap-3">
            <div class="gad-disclaimer-icon">🚨</div>
            <div class="w-100">
              <h2 class="fw-700 fs-5 mb-2 gad-help-h2">When to Seek Help</h2>
              <p class="gad-disclaimer-text mb-4">You do not need to be in crisis to seek support. Seeking help early leads to better outcomes. Speak to your GP or a mental health professional if any of the following apply:</p>
              <div class="row g-2">
                @foreach([
                  ['GAD-7 score of 10 or above',          'Clinical guidelines recommend professional evaluation at moderate severity or higher. Your GP can refer you to CBT or prescribe medication if appropriate.'],
                  ['Anxiety affecting work or relationships', 'When anxiety limits what you can do or enjoy in daily life, it has crossed from normal stress into a clinical concern worth addressing.'],
                  ['Consistent worry you cannot control',  'If worry feels automatic and unstoppable — running in the background regardless of circumstances — this is a core feature of GAD and responds well to CBT.'],
                  ['Physical symptoms alongside anxiety',  'Racing heart, chronic muscle tension, digestive issues, and fatigue are common physical manifestations of anxiety that a doctor should assess.'],
                  ['Avoiding situations due to anxiety',   'Avoidance is how anxiety grows. If you are skipping work, social events, or activities because of anxiety, earlier treatment gives significantly better outcomes.'],
                  ['Self-medicating with alcohol or substances', 'Using alcohol to manage anxiety creates dependency and worsens anxiety in the long run. This pattern warrants early professional support.'],
                ] as [$flag, $detail])
                <div class="col-md-6">
                  <div class="gad-help-flag">
                    <div class="gad-help-flag-title">{{ $flag }}</div>
                    <p class="gad-help-flag-desc">{{ $detail }}</p>
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

{{-- Self-help strategies --}}
<section class="ms-section-accent">
  <div class="container-xl">
    <h2 class="text-center mb-2">Self-Help Strategies for Anxiety</h2>
    <p class="text-center text-muted mb-5 ms-intro-text">Evidence-based approaches that can meaningfully reduce anxiety symptoms — especially for mild to moderate scores.</p>
    <div class="row g-4">
      @foreach([
        ['🧠', 'Cognitive Behavioural Therapy (CBT)',  'CBT is the gold-standard treatment for anxiety disorders. Core techniques include identifying cognitive distortions (catastrophising, all-or-nothing thinking), cognitive restructuring, and gradual exposure to feared situations. Self-guided CBT workbooks and apps (such as those using MindShift or Woebot) show meaningful effects for mild to moderate anxiety.'],
        ['🌬️', 'Diaphragmatic Breathing',              'Slow, diaphragmatic breathing directly activates the parasympathetic nervous system, counteracting the fight-or-flight stress response. Try 4-7-8 breathing: inhale for 4 seconds, hold for 7, exhale for 8. Practised daily for 10 minutes, this reduces baseline anxiety within 2–4 weeks.'],
        ['🏃', 'Regular Aerobic Exercise',             'Consistent aerobic exercise (30 minutes, 5 days per week) reduces anxiety comparably to medication in mild to moderate cases. Exercise reduces cortisol, increases GABA (the brain\'s main inhibitory neurotransmitter), and promotes neuroplasticity in the prefrontal cortex — which regulates the amygdala\'s fear response.'],
        ['📋', 'Worry Time Scheduling',                'Rather than trying to suppress worry (which paradoxically increases it), schedule a dedicated 15-minute "worry period" daily. When anxious thoughts arise outside this time, note them and postpone them. This technique, drawn from CBT, significantly reduces worry frequency and intensity within 3–4 weeks.'],
        ['😴', 'Sleep Optimisation',                   'Anxiety and sleep are bidirectionally linked — poor sleep increases anxiety, and anxiety worsens sleep. Prioritise sleep consistency (same wake time daily), reduce screens 60 minutes before bed, and keep your bedroom cool (18–20°C). CBT-I (CBT for insomnia) is often necessary when anxiety is the primary driver of sleep problems.'],
        ['🧘', 'Mindfulness-Based Practice',           'Mindfulness trains sustained attention to the present moment without judgment — the opposite of the future-focused, threat-monitoring pattern that drives anxiety. Even 10 minutes per day of guided mindfulness (via apps like Headspace or Insight Timer) produces measurable reductions in anxiety after 8 weeks. MBSR (Mindfulness-Based Stress Reduction) has strong clinical trial support.'],
      ] as [$icon, $title, $body])
      <div class="col-md-6 col-lg-4">
        <div class="gad-tip-card">
          <div class="gad-tip-icon">{{ $icon }}</div>
          <div class="gad-tip-title">{{ $title }}</div>
          <p class="gad-tip-body">{{ $body }}</p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="gadFaq" />

<x-related-tools :tools="$relatedTools" heading="More Mental Health Tools" />

@endsection

@section('scripts')
<script>
(function () {
  var QUESTIONS = [
    { id: 'q1', text: 'Feeling nervous, anxious, or on edge' },
    { id: 'q2', text: 'Not being able to stop or control worrying' },
    { id: 'q3', text: 'Worrying too much about different things' },
    { id: 'q4', text: 'Trouble relaxing' },
    { id: 'q5', text: 'Being so restless that it is hard to sit still' },
    { id: 'q6', text: 'Becoming easily annoyed or irritable' },
    { id: 'q7', text: 'Feeling afraid, as if something awful might happen' },
  ];

  var OPTIONS = [
    { label: 'Not at all',             score: 0 },
    { label: 'Several days',           score: 1 },
    { label: 'More than half the days', score: 2 },
    { label: 'Nearly every day',       score: 3 },
  ];

  var answers = {};

  function renderQuestions() {
    var html = '';
    QUESTIONS.forEach(function (q, idx) {
      html += '<div class="mb-4">'
        + '<p class="gad-q-label"><span class="gad-q-num">' + (idx + 1) + '.</span> ' + q.text + '</p>'
        + '<div class="d-flex flex-column gap-2">';
      OPTIONS.forEach(function (opt) {
        var sel = answers[q.id] === opt.score;
        html += '<label class="d-flex align-items-center gap-3 p-3 rounded-3 gad-option' + (sel ? ' gad-option-sel' : '') + '" '
          + 'onclick="gadSelect(\'' + q.id + '\',' + opt.score + ')">'
          + '<input type="radio" name="' + q.id + '" value="' + opt.score + '" ' + (sel ? 'checked' : '') + ' class="gad-radio">'
          + '<span class="gad-option-label">' + opt.label + '</span>'
          + '<span class="gad-option-score">' + opt.score + '</span>'
          + '</label>';
      });
      html += '</div></div>';
    });

    var answered = Object.keys(answers).length;
    var pct = Math.round((answered / QUESTIONS.length) * 100);
    document.getElementById('gadProgressBar').style.width = pct + '%';
    document.getElementById('gadProgressText').textContent = answered + ' / ' + QUESTIONS.length;

    document.getElementById('gadQuestionContainer').innerHTML = html;
  }

  window.gadSelect = function (id, score) {
    answers[id] = score;
    document.getElementById('gadErrorMsg').classList.add('d-none');
    renderQuestions();
  };

  window.gadSubmit = function () {
    var unanswered = QUESTIONS.filter(function (q) { return answers[q.id] === undefined; });
    if (unanswered.length > 0) {
      document.getElementById('gadErrorMsg').classList.remove('d-none');
      document.getElementById('gadQuestionContainer').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      return;
    }

    var total = 0;
    QUESTIONS.forEach(function (q) { total += answers[q.id]; });

    var resultClass, icon, label, desc;
    if (total <= 4) {
      resultClass = 'gad-result-minimal';
      icon  = '✅';
      label = 'Minimal Anxiety';
      desc  = 'Your score indicates minimal anxiety symptoms. This is within the normal range of everyday stress responses. Continue to monitor your wellbeing and maintain healthy habits — good sleep, regular exercise, and social connection are the strongest protective factors against anxiety.';
    } else if (total <= 9) {
      resultClass = 'gad-result-mild';
      icon  = '🟡';
      label = 'Mild Anxiety';
      desc  = 'Your score suggests mild anxiety symptoms. These may be causing some discomfort but are not yet severely limiting your daily life. Evidence-based self-help strategies — particularly CBT techniques, breathing exercises, and regular aerobic exercise — can make a meaningful difference at this level.';
    } else if (total <= 14) {
      resultClass = 'gad-result-moderate';
      icon  = '🟠';
      label = 'Moderate Anxiety';
      desc  = 'Your score indicates moderate anxiety. Symptoms at this level are likely affecting your work, relationships, or daily activities. Clinical guidelines recommend professional assessment at a GAD-7 score of 10 or above. Speaking to your GP is a positive and practical next step — CBT is highly effective and widely available.';
    } else {
      resultClass = 'gad-result-severe';
      icon  = '🔴';
      label = 'Severe Anxiety';
      desc  = 'Your score indicates severe anxiety symptoms. Please speak to your GP or a mental health professional as soon as reasonably possible. Severe anxiety is very treatable — it is not a reflection of weakness or a permanent condition. Your doctor can discuss therapy, medication, and specialist referral options.';
    }

    var adviceItems = [
      'Your score on this screening does <strong>not</strong> constitute a clinical diagnosis.',
      'Only a qualified healthcare professional can diagnose an anxiety disorder.',
      'This result is a starting point for a conversation with your doctor, not a conclusion.',
      'Scores can fluctuate — retake the quiz monthly to track trends over time.',
    ];

    var adviceHtml = adviceItems.map(function (item) {
      return '<li class="gad-advice-item mb-1">' + item + '</li>';
    }).join('');

    var html = '<div class="p-4 rounded-3 text-center mb-4 ' + resultClass + '">'
      + '<div class="gad-res-icon">' + icon + '</div>'
      + '<div class="gad-res-score">' + total + '/21</div>'
      + '<div class="gad-res-label">' + label + '</div>'
      + '<p class="gad-res-desc">' + desc + '</p>'
      + '</div>'
      + '<div class="p-3 rounded-3 mb-3 gad-res-disclaimer">'
      + '<p>⚕️ <strong>Medical disclaimer:</strong> This is a screening tool, not a diagnosis. If you are concerned about your mental health, please speak to a healthcare professional. In crisis, call Samaritans on <strong>116 123</strong> (UK) or text HOME to <strong>741741</strong> (US).</p>'
      + '</div>'
      + '<div class="p-3 rounded-3 gad-advice-box">'
      + '<p class="gad-advice-title">📋 About your result</p>'
      + '<ul class="ps-3 mb-0">' + adviceHtml + '</ul>'
      + '</div>';

    document.getElementById('gadQuizArea').classList.add('d-none');
    document.getElementById('gadResult').classList.remove('d-none');
    document.getElementById('gadResultContent').innerHTML = html;
    document.getElementById('gadResult').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  };

  window.gadReset = function () {
    answers = {};
    document.getElementById('gadQuizArea').classList.remove('d-none');
    document.getElementById('gadResult').classList.add('d-none');
    document.getElementById('gadErrorMsg').classList.add('d-none');
    renderQuestions();
  };

  renderQuestions();
})();
</script>
@endsection
