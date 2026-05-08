@extends('layouts.app')

@section('title', 'PHQ-9 Depression Test — Free Screening Quiz | MindSnap')
@section('description', 'Take the PHQ-9 depression screening quiz free online. Get your score instantly and understand what minimal, mild, moderate, or severe results mean.')
@section('canonical', config('app.url') . '/depression-screening')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "WebApplication",
  "name": "PHQ-9 Depression Test",
  "url": "{{ config('app.url') }}/depression-screening",
  "description": "The clinically validated PHQ-9 depression screening questionnaire. 9 questions, instant score, clear interpretation of minimal, mild, moderate, and severe results.",
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
    { "@@type": "ListItem", "position": 1, "name": "Home",                "item": "{{ config('app.url') }}" },
    { "@@type": "ListItem", "position": 2, "name": "Mental Health Tools", "item": "{{ config('app.url') }}/mental-health-tools" },
    { "@@type": "ListItem", "position": 3, "name": "PHQ-9 Depression Test" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [
    { "@@type": "Question", "name": "What is the PHQ-9?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The PHQ-9 (Patient Health Questionnaire-9) is a validated clinical screening tool developed from the PRIME-MD project. It assesses the 9 core criteria for a major depressive episode as defined in the DSM-5. It is one of the most widely used depression screening instruments in primary care worldwide, with strong evidence for reliability and validity across diverse populations." } },
    { "@@type": "Question", "name": "What PHQ-9 score indicates depression?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Clinical guidelines use the following thresholds: 0–4 = minimal depression; 5–9 = mild depression; 10–14 = moderate depression; 15–19 = moderately severe depression; 20–27 = severe depression. A score of 10 or above is typically used as the clinical cut-off for major depressive disorder screening, with a sensitivity of 88% and specificity of 88% in primary care populations." } },
    { "@@type": "Question", "name": "Is the PHQ-9 a diagnosis?",
      "acceptedAnswer": { "@@type": "Answer", "text": "No. The PHQ-9 is a screening tool, not a diagnostic instrument. A high score indicates that depressive symptoms are present at a level that warrants clinical evaluation, not that you have major depressive disorder. Diagnosis requires a clinical interview by a qualified healthcare professional who can rule out other causes and assess the full clinical picture." } },
    { "@@type": "Question", "name": "What is the difference between depression and sadness?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Sadness is a normal emotional response to loss, disappointment, or difficult circumstances. Clinical depression (major depressive disorder) is characterised by persistent low mood or loss of interest or pleasure in nearly all activities, occurring most of the day, nearly every day, for at least two weeks, alongside other symptoms (sleep changes, appetite changes, energy loss, cognitive changes, worthlessness, or suicidal thoughts) causing significant impairment. The key distinctions are duration, pervasiveness, severity of associated symptoms, and inability to recover in response to positive events." } },
    { "@@type": "Question", "name": "What are the treatment options for depression?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The most effective treatments for major depressive disorder include: Cognitive Behavioural Therapy (CBT), which has the strongest evidence base; antidepressant medication (typically SSRIs as first-line); and the combination of both, which is more effective than either alone for moderate to severe depression. Other evidence-supported approaches include Interpersonal Therapy (IPT), Behavioural Activation, aerobic exercise (comparable to medication for mild-moderate depression), and mindfulness-based cognitive therapy (MBCT, especially effective for preventing relapse)." } },
    { "@@type": "Question", "name": "How do antidepressants work?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Most antidepressants work primarily by increasing the availability of neurotransmitters in synapses — particularly serotonin (SSRIs), serotonin and norepinephrine (SNRIs), or multiple neurotransmitters (tricyclics, MAOIs). However, the neurotransmitter model is an oversimplification — antidepressants also promote neuroplasticity, particularly in the hippocampus, and modulate inflammatory pathways. They take 2–6 weeks to produce clinical effects and should not be stopped abruptly. Always take and discontinue under medical supervision." } },
    { "@@type": "Question", "name": "Can depression be treated without medication?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes — for mild to moderate depression, psychotherapy alone (especially CBT) can be as effective as medication. Regular aerobic exercise has comparable effects to antidepressants in mild-moderate depression. Lifestyle factors — sleep quality, social connection, and routine — significantly affect depression outcomes. For moderate to severe depression, the combination of therapy and medication is typically most effective. The decision should be made collaboratively with a healthcare provider." } },
    { "@@type": "Question", "name": "What does question 9 (self-harm) mean on the PHQ-9?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Question 9 asks about thoughts of self-harm or being better off dead. This item is included because suicidal ideation is a core symptom of severe depression. A score above 0 on this item does not mean you are in immediate danger — passive thoughts (wishing to not wake up, for example) are different from active planning. However, any score above 0 warrants compassionate attention and professional support. If you are experiencing distressing thoughts, please contact Samaritans on 116 123 (UK) or Crisis Text Line by texting HOME to 741741 (US)." } },
    { "@@type": "Question", "name": "How often should I take the PHQ-9?",
      "acceptedAnswer": { "@@type": "Answer", "text": "In clinical settings, the PHQ-9 is typically administered every 2–4 weeks to monitor treatment response. For personal monitoring, monthly use is appropriate if you are managing depression. If your score is 10 or above, speak to your GP rather than continuing to self-monitor — earlier treatment consistently leads to better outcomes." } }
  ]
}
</script>
@endsection

@php
$faqs = [
  ['q' => 'What is the PHQ-9?',
   'a' => 'The PHQ-9 (Patient Health Questionnaire-9) is a validated clinical screening tool developed from the PRIME-MD project. It assesses the 9 core criteria for a major depressive episode as defined in the DSM-5. It is one of the most widely used depression screening instruments in primary care worldwide, with strong evidence for reliability and validity across diverse populations.'],
  ['q' => 'What PHQ-9 score indicates depression?',
   'a' => 'Clinical thresholds: 0–4 = minimal depression; 5–9 = mild; 10–14 = moderate; 15–19 = moderately severe; 20–27 = severe. A score of 10 or above is typically the clinical cut-off for major depressive disorder screening, with sensitivity and specificity both around 88% in primary care populations.'],
  ['q' => 'Is the PHQ-9 a diagnosis?',
   'a' => 'No. The PHQ-9 is a screening tool, not a diagnostic instrument. A high score indicates depressive symptoms at a level warranting clinical evaluation — not a confirmed diagnosis. Diagnosis requires a clinical interview by a qualified healthcare professional who can rule out other causes and assess the full picture.'],
  ['q' => 'What is the difference between depression and sadness?',
   'a' => 'Sadness is a normal response to loss or difficult circumstances. Clinical depression is characterised by persistent low mood or loss of interest in nearly all activities, occurring most of the day, nearly every day, for at least two weeks, alongside other symptoms (sleep changes, appetite changes, energy loss, cognitive changes, worthlessness, or suicidal thoughts) causing significant impairment. The key distinctions are duration, pervasiveness, severity, and inability to recover in response to positive events.'],
  ['q' => 'What are the treatment options for depression?',
   'a' => 'The most effective treatments include: Cognitive Behavioural Therapy (CBT) — strongest evidence base; antidepressant medication (SSRIs as first-line); and the combination of both for moderate to severe cases. Other evidence-supported approaches include Interpersonal Therapy (IPT), Behavioural Activation, aerobic exercise, and mindfulness-based cognitive therapy (MBCT) for preventing relapse.'],
  ['q' => 'Can depression be treated without medication?',
   'a' => 'Yes — for mild to moderate depression, psychotherapy alone (especially CBT) can be as effective as medication. Regular aerobic exercise has comparable effects to antidepressants in mild-moderate cases. Lifestyle factors — sleep quality, social connection, and routine — significantly affect outcomes. For moderate to severe depression, the combination of therapy and medication is typically most effective.'],
  ['q' => 'What does question 9 (self-harm) mean on the PHQ-9?',
   'a' => 'Question 9 asks about thoughts of self-harm or being better off dead. A score above 0 does not mean you are in immediate danger — passive thoughts differ from active planning. However, any score above 0 warrants compassionate attention and professional support. If you are experiencing distressing thoughts, contact Samaritans on 116 123 (UK) or text HOME to 741741 (US).'],
  ['q' => 'How often should I take the PHQ-9?',
   'a' => 'In clinical settings, the PHQ-9 is typically administered every 2–4 weeks to monitor treatment. For personal monitoring, monthly use is appropriate. If your score is 10 or above, speak to your GP rather than continuing to self-monitor — earlier treatment consistently leads to better outcomes.'],
  ['q' => 'How accurate is the PHQ-9?',
   'a' => 'At a cut-off of 10, the PHQ-9 has sensitivity of ~88% and specificity of ~88% for major depressive disorder in primary care settings. It has been validated across dozens of countries and populations and is one of the most thoroughly researched mental health screening instruments available.'],
];

$relatedTools = [
  ['icon' => '🧠', 'name' => 'GAD-7 Anxiety Test',     'slug' => 'anxiety-quiz',          'desc' => 'Clinically validated anxiety screening in 7 questions.'],
  ['icon' => '🔗', 'name' => 'Attachment Style Quiz',  'slug' => 'attachment-style-quiz',  'desc' => 'Discover your relationship attachment pattern.'],
  ['icon' => '😴', 'name' => 'Sleep Quality Quiz',     'slug' => 'sleep-quality-quiz',     'desc' => 'Score your sleep across 7 clinical domains.'],
];
@endphp

@section('styles')
<style>
.phq-disclaimer      { background:#fff8e1; border:1px solid #ffe082; border-radius:10px; }
.phq-disclaimer-icon { font-size:1.4rem; flex-shrink:0; line-height:1; }
.phq-disclaimer-text { font-size:.82rem; color:#5d4037; line-height:1.6; margin:0; }
.phq-q-label         { font-weight:700; color:var(--primary-dark); font-size:.95rem; margin-bottom:14px; line-height:1.6; }
.phq-q-num           { color:#0b7285; font-weight:800; }
.phq-option          { border:2px solid #e0e0e0; background:#fff; cursor:pointer; transition:border-color .12s, background .12s; }
.phq-option:hover    { border-color:#9ecfdb; background:#f5fdff; }
.phq-option-sel      { border-color:#0b7285 !important; background:rgba(11,114,133,.05) !important; }
.phq-radio           { accent-color:#0b7285; flex-shrink:0; }
.phq-option-label    { font-size:.88rem; color:#333; }
.phq-option-score    { font-size:.75rem; color:#aaa; margin-left:auto; flex-shrink:0; }
.phq-error           { color:#c23152; font-size:.82rem; margin-top:6px; }
.phq-prog-wrap       { flex:1; background:#f0f0f0; border-radius:4px; height:6px; }
.phq-prog-bar        { height:100%; background:#0b7285; border-radius:4px; transition:width .3s; }
.phq-prog-text       { font-size:.78rem; color:#888; min-width:46px; text-align:right; }
.phq-retake-btn      { border:2px solid #0b7285; color:#0b7285; border-radius:8px; font-weight:600; padding:12px; background:transparent; width:100%; margin-top:16px; }
.phq-retake-btn:hover { background:#0b7285; color:#fff; }
.phq-intro-subtitle  { max-width:480px; margin:0 auto 40px; }

/* Crisis alert — question 9 */
.phq-crisis-alert    { background:#fff0f0; border:2px solid rgba(194,49,82,.35); border-radius:10px; }
.phq-crisis-title    { font-weight:700; color:#721c24; font-size:.92rem; margin-bottom:6px; }
.phq-crisis-text     { font-size:.82rem; color:#5d2020; line-height:1.65; margin:0; }

/* Result cards */
.phq-result-minimal    { background:#d1eddb; border:1px solid rgba(21,87,36,.2); }
.phq-result-minimal .phq-res-score,
.phq-result-minimal .phq-res-label    { color:#155724; }
.phq-result-mild       { background:#d0eeff; border:1px solid rgba(0,64,133,.18); }
.phq-result-mild .phq-res-score,
.phq-result-mild .phq-res-label       { color:#004085; }
.phq-result-moderate   { background:#fff3cd; border:1px solid rgba(102,77,3,.2); }
.phq-result-moderate .phq-res-score,
.phq-result-moderate .phq-res-label   { color:#664d03; }
.phq-result-mod-severe { background:#ffe5c8; border:1px solid rgba(140,60,0,.2); }
.phq-result-mod-severe .phq-res-score,
.phq-result-mod-severe .phq-res-label { color:#8c3c00; }
.phq-result-severe     { background:#ffd5d5; border:1px solid rgba(114,28,36,.2); }
.phq-result-severe .phq-res-score,
.phq-result-severe .phq-res-label     { color:#721c24; }

.phq-res-icon          { font-size:2.4rem; line-height:1; margin-bottom:8px; }
.phq-res-score         { font-size:2.4rem; font-weight:800; line-height:1.2; }
.phq-res-label         { font-weight:700; font-size:.88rem; text-transform:uppercase; letter-spacing:.5px; margin:4px 0 10px; }
.phq-res-desc          { font-size:.85rem; color:#555; line-height:1.7; margin:0; }
.phq-res-disclaimer    { background:#fff5f5; border:2px solid rgba(233,69,96,.25); border-radius:10px; }
.phq-res-disclaimer p  { font-size:.82rem; color:#721c24; margin:0; line-height:1.6; }
.phq-advice-box        { background:#f0f8ff; border-radius:10px; }
.phq-advice-title      { font-weight:700; color:var(--primary-dark); font-size:.88rem; margin-bottom:12px; }
.phq-advice-item       { font-size:.82rem; color:#444; line-height:1.6; }

/* Score range reference cards */
.phq-range-card        { border-radius:12px; padding:18px; height:100%; }
.phq-range-card-min    { background:#d1eddb; }
.phq-range-card-min .phq-range-val,
.phq-range-card-min .phq-range-lbl   { color:#155724; }
.phq-range-card-mld    { background:#d0eeff; }
.phq-range-card-mld .phq-range-val,
.phq-range-card-mld .phq-range-lbl   { color:#004085; }
.phq-range-card-mod    { background:#fff3cd; }
.phq-range-card-mod .phq-range-val,
.phq-range-card-mod .phq-range-lbl   { color:#664d03; }
.phq-range-card-mods   { background:#ffe5c8; }
.phq-range-card-mods .phq-range-val,
.phq-range-card-mods .phq-range-lbl  { color:#8c3c00; }
.phq-range-card-sev    { background:#ffd5d5; }
.phq-range-card-sev .phq-range-val,
.phq-range-card-sev .phq-range-lbl   { color:#721c24; }
.phq-range-val         { font-size:1.3rem; font-weight:800; }
.phq-range-lbl         { font-weight:700; font-size:.8rem; text-transform:uppercase; letter-spacing:.4px; margin:4px 0 8px; }
.phq-range-desc        { font-size:.79rem; color:#555; line-height:1.6; margin:0; }

/* Treatment section */
.phq-treatment-card    { border-radius:12px; background:#fff; border:1px solid #eee; padding:20px; height:100%; }
.phq-treatment-icon    { font-size:1.6rem; margin-bottom:10px; }
.phq-treatment-title   { font-weight:700; color:var(--primary-dark); font-size:.9rem; margin-bottom:6px; }
.phq-treatment-body    { font-size:.82rem; color:#555; line-height:1.65; margin:0; }

/* Depression vs sadness */
.phq-vs-card           { border-radius:12px; padding:24px; height:100%; }
.phq-vs-sadness        { background:#f0f8ff; border:1px solid #b8dff8; }
.phq-vs-depression     { background:#fff0f5; border:1px solid #f8b8cc; }
.phq-vs-title          { font-weight:700; font-size:1rem; margin-bottom:14px; }
.phq-vs-sadness .phq-vs-title  { color:#004085; }
.phq-vs-depression .phq-vs-title { color:#721c24; }
.phq-vs-item           { font-size:.83rem; color:#555; line-height:1.6; margin-bottom:8px; display:flex; gap:8px; align-items:flex-start; }
.phq-vs-dot-blue       { width:7px; height:7px; border-radius:50%; background:#004085; flex-shrink:0; margin-top:6px; }
.phq-vs-dot-red        { width:7px; height:7px; border-radius:50%; background:#721c24; flex-shrink:0; margin-top:6px; }

/* Hero sidebar facts column */
.phq-fact-dot   { width:8px; height:8px; border-radius:50%; background:#0b7285; flex-shrink:0; margin-top:6px; }
.phq-fact-label { font-weight:600; font-size:.88rem; color:#fff; }
.phq-fact-desc  { font-size:.75rem; color:rgba(255,255,255,.55); }

/* Sensitive question note in JS */
.phq-sensitive-note { font-size:.78rem; padding:8px 12px; }
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
          ['url' => '',                              'name' => 'PHQ-9 Depression Test'],
        ]"/>

        <h1 class="mb-2 ms-hero-title">
          💙 PHQ-9 Depression Test — Clinically Validated Screening
        </h1>
        <p class="ms-hero-desc">
          9 questions based on the official PHQ-9 scale used by doctors worldwide. Takes under 2 minutes. Get your score with a plain-English explanation of what it means.
        </p>

        <div class="card border-0 mb-n4 ms-tool-card">
          <div class="card-body p-4 p-md-5">

            {{-- Medical disclaimer --}}
            <div class="d-flex align-items-start gap-3 p-3 mb-4 rounded-3 phq-disclaimer">
              <div class="phq-disclaimer-icon">ℹ️</div>
              <p class="phq-disclaimer-text">This is a <strong>screening tool, not a diagnosis</strong>. Results indicate whether symptoms are present — only a qualified healthcare professional can diagnose depression. If you are in crisis or having thoughts of self-harm, please contact Samaritans on <strong>116 123</strong> (UK) or text HOME to <strong>741741</strong> (US) immediately.</p>
            </div>

            <div id="phqQuizArea">
              {{-- Progress bar --}}
              <div class="d-flex align-items-center gap-2 mb-4">
                <div class="phq-prog-wrap">
                  <div id="phqProgressBar" class="phq-prog-bar"></div>
                </div>
                <span id="phqProgressText" class="phq-prog-text">0 / 9</span>
              </div>

              <p class="text-muted text-sm mb-4 fw-600">Over the last 2 weeks, how often have you been bothered by any of the following problems?</p>

              <div id="phqQuestionContainer"></div>

              <div id="phqErrorMsg" class="phq-error d-none">Please answer all questions before viewing your score.</div>

              <button class="btn btn-cta w-100 mt-4" onclick="phqSubmit()">Get My Score →</button>
            </div>

            <div id="phqResult" class="d-none">
              <div id="phqResultContent"></div>
              <button class="phq-retake-btn" onclick="phqReset()">Retake Quiz</button>
            </div>

          </div>
        </div>
      </div>

      <div class="col-lg-5 d-none d-lg-block pt-2">
        <div class="ms-facts-wrap">
          <h3 class="ms-facts-title">What PHQ-9 Measures</h3>
          @foreach([
            ['Loss of interest',     'Anhedonia — reduced ability to feel pleasure'],
            ['Depressed mood',       'Persistent feelings of hopelessness or emptiness'],
            ['Sleep disturbance',    'Insomnia, hypersomnia, or non-restorative sleep'],
            ['Fatigue',              'Persistent low energy not explained by activity'],
            ['Appetite changes',     'Significant increase or decrease in appetite'],
            ['Self-worth',           'Feelings of worthlessness or excessive guilt'],
            ['Concentration',        'Difficulty thinking, deciding, or remembering'],
            ['Psychomotor changes',  'Slowed movement or agitated restlessness'],
            ['Suicidal ideation',    'Thoughts of self-harm or death — handled sensitively'],
          ] as [$label, $desc])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div class="phq-fact-dot"></div>
            <div>
              <div class="phq-fact-label">{{ $label }}</div>
              <div class="phq-fact-desc">{{ $desc }}</div>
            </div>
          </div>
          @endforeach
          <p class="ms-fact-source mt-3">Based on the DSM-5 criteria for major depressive disorder. Validated by Kroenke K et al. (2001).</p>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- Score ranges --}}
<section class="ms-section-white">
  <div class="container-xl">
    <h2 class="text-center mb-2">Understanding Your PHQ-9 Score</h2>
<img src="{{ asset('images/phq9-severity-scale.svg') }}" alt="PHQ-9 severity scale showing depression score ranges from minimal to severe" width="640" height="130" loading="lazy" class="img-fluid rounded-3 mb-4">
    <p class="text-center text-muted mb-5 phq-intro-subtitle">Scores range from 0 to 27. Higher scores indicate greater depression symptom severity.</p>
    <div class="row g-4 justify-content-center">
      <div class="col-sm-6 col-lg">
        <div class="phq-range-card phq-range-card-min">
          <div class="phq-range-val">0–4</div>
          <div class="phq-range-lbl">Minimal</div>
          <p class="phq-range-desc">Depressive symptoms are minimal or absent. Normal mood fluctuations. No clinical action required.</p>
        </div>
      </div>
      <div class="col-sm-6 col-lg">
        <div class="phq-range-card phq-range-card-mld">
          <div class="phq-range-val">5–9</div>
          <div class="phq-range-lbl">Mild</div>
          <p class="phq-range-desc">Mild symptoms present. Self-help strategies and lifestyle changes are a good starting point. Monitor closely.</p>
        </div>
      </div>
      <div class="col-sm-6 col-lg">
        <div class="phq-range-card phq-range-card-mod">
          <div class="phq-range-val">10–14</div>
          <div class="phq-range-lbl">Moderate</div>
          <p class="phq-range-desc">Moderate depression likely affecting daily life. Clinical guidelines recommend professional assessment at this level.</p>
        </div>
      </div>
      <div class="col-sm-6 col-lg">
        <div class="phq-range-card phq-range-card-mods">
          <div class="phq-range-val">15–19</div>
          <div class="phq-range-lbl">Mod. Severe</div>
          <p class="phq-range-desc">Moderately severe depression with significant daily impairment. Prompt professional assessment is strongly recommended.</p>
        </div>
      </div>
      <div class="col-sm-6 col-lg">
        <div class="phq-range-card phq-range-card-sev">
          <div class="phq-range-val">20–27</div>
          <div class="phq-range-lbl">Severe</div>
          <p class="phq-range-desc">Severe depression. Please speak to a doctor urgently. Effective treatments exist — this is not a permanent state.</p>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Depression vs sadness --}}
<section class="ms-section-accent">
  <div class="container ms-longtail">
    <h2 class="mb-4 text-brand">Depression vs Sadness — Key Differences</h2>
    <p class="ms-body-text">Understanding the distinction between ordinary sadness and clinical depression is important — both for recognising when to seek help and for reducing unnecessary self-stigma. Sadness is a healthy and adaptive emotion. Depression is a medical condition that changes brain function in ways that require more than willpower to resolve.</p>
    <div class="row g-4 mt-2">
      <div class="col-md-6">
        <div class="phq-vs-card phq-vs-sadness">
          <div class="phq-vs-title">😢 Sadness (Normal)</div>
          @foreach([
            'Triggered by a specific event or loss',
            'Responds to positive news and comfort',
            'Usually resolves within days to weeks',
            'Motivation and pleasure can still be accessed',
            'Does not typically impair ability to function',
            'Self-esteem remains broadly intact',
          ] as $item)
          <div class="phq-vs-item"><div class="phq-vs-dot-blue"></div><span>{{ $item }}</span></div>
          @endforeach
        </div>
      </div>
      <div class="col-md-6">
        <div class="phq-vs-card phq-vs-depression">
          <div class="phq-vs-title">🔵 Clinical Depression</div>
          @foreach([
            'May have no clear external trigger',
            'Does not lift in response to positive events (anhedonia)',
            'Persists for 2+ weeks, most of the day',
            'Loss of interest in previously enjoyable activities',
            'Significant impairment in work, relationships, or self-care',
            'Often accompanied by guilt, worthlessness, or hopelessness',
          ] as $item)
          <div class="phq-vs-item"><div class="phq-vs-dot-red"></div><span>{{ $item }}</span></div>
          @endforeach
        </div>
      </div>
    </div>
    <p class="ms-body-text mt-4">If your low mood falls in the "depression" column for most of the above, a PHQ-9 score of 10 or above, or if you have been struggling for more than 2 weeks, speaking to your GP is the most productive step you can take. Depression is highly treatable — approximately 70–80% of people with depression respond to treatment.</p>
  </div>
</section>

{{-- What is the PHQ-9 --}}
<section class="ms-section-white">
  <div class="container ms-longtail">
    <h2 class="mb-4 text-brand">What Is the PHQ-9?</h2>
    <p class="ms-body-text">The PHQ-9 (Patient Health Questionnaire-9) was developed by Kroenke, Spitzer, and Williams and published in the <em>Journal of General Internal Medicine</em> in 2001. It was created to give primary care physicians a brief, validated tool for screening depression in everyday practice — a condition that is both highly prevalent and frequently under-detected.</p>
    <p class="ms-body-text">The questionnaire directly maps to the 9 diagnostic criteria for a major depressive episode in the DSM-5, making it one of the most clinically grounded screening tools available. Each item is scored 0–3 (Not at all / Several days / More than half the days / Nearly every day), with a maximum score of 27.</p>
    <p class="ms-body-text">The PHQ-9 has been validated in over 100 clinical studies across diverse settings and populations. At a cut-off score of 10, it achieves 88% sensitivity and 88% specificity for major depressive disorder in primary care. It is now embedded in standard electronic health records in the UK NHS, US Veterans Affairs system, and healthcare systems across more than 80 countries.</p>
    <p class="ms-body-text">Beyond initial screening, the PHQ-9 is also used to monitor treatment response. A reduction of 5 or more points typically indicates a clinically meaningful improvement. A score below 5 is commonly used as a remission threshold in clinical trials.</p>
  </div>
</section>

{{-- Treatment options --}}
<section class="ms-section-accent">
  <div class="container-xl">
    <h2 class="text-center mb-2">Treatment Options for Depression</h2>
    <p class="text-center text-muted mb-5 ms-intro-text">Depression is one of the most treatable mental health conditions. Around 70–80% of people respond to treatment.</p>
    <div class="row g-4">
      @foreach([
        ['🧠', 'Cognitive Behavioural Therapy (CBT)',          'CBT is the gold-standard psychological treatment for depression. It works by identifying and restructuring negative thought patterns (cognitive distortions) and increasing engagement with rewarding activities (Behavioural Activation). CBT produces durable improvements — people who complete a course of CBT have significantly lower relapse rates than those who use medication alone.'],
        ['💊', 'Antidepressant Medication',                     'SSRIs (selective serotonin reuptake inhibitors) are typically first-line antidepressants. They take 2–6 weeks to produce full effects and should be taken under medical supervision. For moderate to severe depression, the combination of medication and therapy is more effective than either alone. Always discuss starting, adjusting, or stopping antidepressants with your doctor.'],
        ['🏃', 'Aerobic Exercise',                              'Multiple meta-analyses show aerobic exercise has antidepressant effects comparable to medication for mild to moderate depression. 30 minutes of moderate-intensity exercise (brisk walking, cycling, swimming) 3–5 times per week significantly reduces PHQ-9 scores within 4–8 weeks. Exercise increases BDNF, serotonin, and dopamine, and reduces inflammatory markers implicated in depression.'],
        ['🧘', 'Mindfulness-Based Cognitive Therapy (MBCT)',    'MBCT combines mindfulness practices with cognitive therapy techniques. It is particularly effective at preventing relapse in people who have experienced 3 or more depressive episodes, reducing relapse rates by approximately 44% compared to usual care. MBCT is now recommended by NICE (UK) for recurrent depression.'],
        ['👥', 'Interpersonal Therapy (IPT)',                   'IPT focuses on improving interpersonal relationships and communication patterns that may be contributing to or maintaining depression. It is particularly effective when depression is linked to grief, role transitions (new job, divorce, becoming a parent), or relationship conflicts. IPT typically involves 12–16 structured sessions.'],
        ['🌱', 'Lifestyle and Social Connection',               'Sleep quality, physical activity, diet quality, alcohol reduction, and social connection all independently affect depression outcomes. Regular social contact — even brief, low-effort interactions — has measurable antidepressant effects. Reducing alcohol intake is particularly important: alcohol is a CNS depressant that worsens mood and disrupts sleep, creating a compounding negative cycle.'],
      ] as [$icon, $title, $body])
      <div class="col-md-6 col-lg-4">
        <div class="phq-treatment-card">
          <div class="phq-treatment-icon">{{ $icon }}</div>
          <div class="phq-treatment-title">{{ $title }}</div>
          <p class="phq-treatment-body">{{ $body }}</p>
        </div>
      </div>
      @endforeach
    </div>
    <div class="row justify-content-center mt-4">
      <div class="col-lg-8">
        <div class="ms-note ms-note-blue">
          <strong>Note:</strong> The treatment options above are for informational purposes. Do not start, stop, or change any treatment without speaking to a qualified healthcare professional. If you are in crisis, contact your GP, go to your nearest A&amp;E, or call Samaritans on <strong>116 123</strong> (UK) / Crisis Text Line at <strong>741741</strong> (US).
        </div>
      </div>
    </div>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="phqFaq" />

<x-related-tools :tools="$relatedTools" heading="More Mental Health Tools" />

@endsection

@section('scripts')
<script>
(function () {
  var QUESTIONS = [
    { id: 'q1', text: 'Little interest or pleasure in doing things' },
    { id: 'q2', text: 'Feeling down, depressed, or hopeless' },
    { id: 'q3', text: 'Trouble falling or staying asleep, or sleeping too much' },
    { id: 'q4', text: 'Feeling tired or having little energy' },
    { id: 'q5', text: 'Poor appetite or overeating' },
    { id: 'q6', text: 'Feeling bad about yourself — or that you are a failure or have let yourself or your family down' },
    { id: 'q7', text: 'Trouble concentrating on things, such as reading the newspaper or watching television' },
    { id: 'q8', text: 'Moving or speaking so slowly that other people could have noticed? Or the opposite — being so fidgety or restless that you have been moving around a lot more than usual' },
    { id: 'q9', text: 'Thoughts that you would be better off dead, or of hurting yourself in some way', sensitive: true },
  ];

  var OPTIONS = [
    { label: 'Not at all',              score: 0 },
    { label: 'Several days',            score: 1 },
    { label: 'More than half the days', score: 2 },
    { label: 'Nearly every day',        score: 3 },
  ];

  var answers = {};

  function renderQuestions() {
    var html = '';
    QUESTIONS.forEach(function (q, idx) {
      var sensitiveNote = q.sensitive
        ? '<p class="ms-note ms-note-blue mb-2 phq-sensitive-note">This question asks about thoughts of self-harm. You can answer honestly — your response is private and not shared with anyone.</p>'
        : '';
      html += '<div class="mb-4">'
        + sensitiveNote
        + '<p class="phq-q-label"><span class="phq-q-num">' + (idx + 1) + '.</span> ' + q.text + '</p>'
        + '<div class="d-flex flex-column gap-2">';
      OPTIONS.forEach(function (opt) {
        var sel = answers[q.id] === opt.score;
        html += '<label class="d-flex align-items-center gap-3 p-3 rounded-3 phq-option' + (sel ? ' phq-option-sel' : '') + '" '
          + 'onclick="phqSelect(\'' + q.id + '\',' + opt.score + ')">'
          + '<input type="radio" name="' + q.id + '" value="' + opt.score + '" ' + (sel ? 'checked' : '') + ' class="phq-radio">'
          + '<span class="phq-option-label">' + opt.label + '</span>'
          + '<span class="phq-option-score">' + opt.score + '</span>'
          + '</label>';
      });
      html += '</div></div>';
    });

    var answered = Object.keys(answers).length;
    var pct = Math.round((answered / QUESTIONS.length) * 100);
    document.getElementById('phqProgressBar').style.width = pct + '%';
    document.getElementById('phqProgressText').textContent = answered + ' / ' + QUESTIONS.length;

    document.getElementById('phqQuestionContainer').innerHTML = html;
  }

  window.phqSelect = function (id, score) {
    answers[id] = score;
    document.getElementById('phqErrorMsg').classList.add('d-none');
    renderQuestions();
  };

  window.phqSubmit = function () {
    var unanswered = QUESTIONS.filter(function (q) { return answers[q.id] === undefined; });
    if (unanswered.length > 0) {
      document.getElementById('phqErrorMsg').classList.remove('d-none');
      document.getElementById('phqQuestionContainer').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      return;
    }

    var total = 0;
    QUESTIONS.forEach(function (q) { total += answers[q.id]; });

    var q9Score = answers['q9'];
    var showCrisis = q9Score > 0;

    var resultClass, icon, label, desc;
    if (total <= 4) {
      resultClass = 'phq-result-minimal';
      icon  = '✅';
      label = 'Minimal Depression';
      desc  = 'Your score indicates minimal depressive symptoms. This is within the range of normal mood variation and everyday stress. Continue to look after your wellbeing — sleep, social connection, and physical activity are the strongest protective factors against depression.';
    } else if (total <= 9) {
      resultClass = 'phq-result-mild';
      icon  = '🔵';
      label = 'Mild Depression';
      desc  = 'Your score suggests mild depressive symptoms. These may be causing some discomfort. Self-help strategies — particularly Behavioural Activation (scheduling enjoyable activities), aerobic exercise, and sleep improvement — can make a meaningful difference at this level. Consider discussing with your GP if symptoms persist beyond 2 weeks.';
    } else if (total <= 14) {
      resultClass = 'phq-result-moderate';
      icon  = '🟡';
      label = 'Moderate Depression';
      desc  = 'Your score indicates moderate depression, likely affecting your work, relationships, or daily activities. Clinical guidelines recommend professional assessment at a PHQ-9 score of 10 or above. Speaking to your GP is a practical and important next step — CBT and medication are both effective, and the combination works better than either alone.';
    } else if (total <= 19) {
      resultClass = 'phq-result-mod-severe';
      icon  = '🟠';
      label = 'Moderately Severe Depression';
      desc  = 'Your score indicates moderately severe depression with significant daily impairment. Please speak to your GP as soon as possible. At this level, professional treatment — typically a combination of therapy and medication — produces the best outcomes. You do not need to manage this alone.';
    } else {
      resultClass = 'phq-result-severe';
      icon  = '🔴';
      label = 'Severe Depression';
      desc  = 'Your score indicates severe depression. Please contact your GP or a mental health crisis service today. Severe depression is a serious medical condition, but it is highly treatable — most people with depression, including severe depression, improve significantly with appropriate treatment. You are not alone, and this is not a permanent state.';
    }

    var crisisHtml = '';
    if (showCrisis) {
      crisisHtml = '<div class="p-3 rounded-3 mb-3 phq-crisis-alert">'
        + '<div class="phq-crisis-title">💙 You indicated you\'ve had thoughts of self-harm</div>'
        + '<p class="phq-crisis-text">Please know you are not alone in having these thoughts — they are a symptom of depression, not a reflection of your character or future. '
        + 'If these thoughts are distressing or feel urgent, please reach out right now:<br>'
        + '<strong>Samaritans (UK):</strong> 116 123 (free, 24/7) &nbsp;|&nbsp; '
        + '<strong>Crisis Text Line (US):</strong> Text HOME to 741741 &nbsp;|&nbsp; '
        + '<strong>Lifeline (AU):</strong> 13 11 14<br>'
        + 'If you are in immediate danger, call 999 (UK) or 911 (US) or go to your nearest A&amp;E.</p>'
        + '</div>';
    }

    var adviceItems = [
      'This score does <strong>not</strong> constitute a clinical diagnosis of depression.',
      'Only a qualified healthcare professional can diagnose major depressive disorder.',
      'A score of 10 or above should prompt a conversation with your GP.',
      'Scores can vary over time — retake monthly to track trends.',
    ];

    var adviceHtml = adviceItems.map(function (item) {
      return '<li class="phq-advice-item mb-1">' + item + '</li>';
    }).join('');

    var html = '<div class="p-4 rounded-3 text-center mb-4 ' + resultClass + '">'
      + '<div class="phq-res-icon">' + icon + '</div>'
      + '<div class="phq-res-score">' + total + '/27</div>'
      + '<div class="phq-res-label">' + label + '</div>'
      + '<p class="phq-res-desc">' + desc + '</p>'
      + '</div>'
      + crisisHtml
      + '<div class="p-3 rounded-3 mb-3 phq-res-disclaimer">'
      + '<p>⚕️ <strong>Medical disclaimer:</strong> This is a screening tool, not a diagnosis. If you are concerned about your mental health, please speak to a healthcare professional. In crisis, call Samaritans on <strong>116 123</strong> (UK) or text HOME to <strong>741741</strong> (US).</p>'
      + '</div>'
      + '<div class="p-3 rounded-3 phq-advice-box">'
      + '<p class="phq-advice-title">📋 About your result</p>'
      + '<ul class="ps-3 mb-0">' + adviceHtml + '</ul>'
      + '</div>';

    document.getElementById('phqQuizArea').classList.add('d-none');
    document.getElementById('phqResult').classList.remove('d-none');
    document.getElementById('phqResultContent').innerHTML = html;
    document.getElementById('phqResult').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  };

  window.phqReset = function () {
    answers = {};
    document.getElementById('phqQuizArea').classList.remove('d-none');
    document.getElementById('phqResult').classList.add('d-none');
    document.getElementById('phqErrorMsg').classList.add('d-none');
    renderQuestions();
  };

  renderQuestions();
})();
</script>
@endsection
