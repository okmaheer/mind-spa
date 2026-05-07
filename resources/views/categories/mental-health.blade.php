@extends('layouts.app')

@section('title', 'Free Mental Health Tests & Quizzes — Anxiety, Depression & More | MindSnap')
@section('description', 'Free clinically-based mental health screening tools — GAD-7 anxiety test, PHQ-9 depression screening, and attachment style quiz. Not a substitute for professional care.')
@section('canonical', config('app.url') . '/mental-health-tools')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@graph": [
    {
      "@@type": "CollectionPage",
      "@@id": "{{ config('app.url') }}/mental-health-tools#collection",
      "url": "{{ config('app.url') }}/mental-health-tools",
      "name": "Free Mental Health Tests & Screening Quizzes",
      "description": "Free clinically-based mental health screening tools including GAD-7 anxiety test, PHQ-9 depression screening, and attachment style quiz.",
      "inLanguage": "en",
      "publisher": { "@@type": "Organization", "name": "MindSnap", "url": "{{ config('app.url') }}" },
      "hasPart": [
        { "@@type": "WebApplication", "name": "GAD-7 Anxiety Test",      "url": "{{ config('app.url') }}/anxiety-test",          "applicationCategory": "HealthApplication" },
        { "@@type": "WebApplication", "name": "PHQ-9 Depression Test",   "url": "{{ config('app.url') }}/depression-test",       "applicationCategory": "HealthApplication" },
        { "@@type": "WebApplication", "name": "Attachment Style Quiz",   "url": "{{ config('app.url') }}/attachment-style-quiz", "applicationCategory": "HealthApplication" }
      ]
    },
    {
      "@@type": "BreadcrumbList",
      "itemListElement": [
        { "@@type": "ListItem", "position": 1, "name": "Home",                "item": "{{ config('app.url') }}" },
        { "@@type": "ListItem", "position": 2, "name": "Mental Health Tools", "item": "{{ config('app.url') }}/mental-health-tools" }
      ]
    },
    {
      "@@type": "FAQPage",
      "mainEntity": [
        { "@@type": "Question", "name": "Are these mental health quizzes a real diagnosis?",        "acceptedAnswer": { "@@type": "Answer", "text": "No. These are self-report screening tools, not clinical diagnoses. They can indicate whether symptoms are present and how severe they may be, but only a licensed mental health professional can diagnose a condition." } },
        { "@@type": "Question", "name": "What is the GAD-7 anxiety test?",                        "acceptedAnswer": { "@@type": "Answer", "text": "The GAD-7 is a 7-item questionnaire validated for screening generalised anxiety disorder. Scores range from 0–21: 5 is mild, 10 is moderate, and 15 is severe anxiety. It is widely used by GPs and psychologists worldwide." } },
        { "@@type": "Question", "name": "What is the PHQ-9 depression screening?",                "acceptedAnswer": { "@@type": "Answer", "text": "The PHQ-9 (Patient Health Questionnaire-9) is a 9-item scale for measuring depression severity. Scores range from 0–27. A score of 10 or above indicates at least moderate depression and warrants a conversation with a clinician." } },
        { "@@type": "Question", "name": "What is an attachment style and why does it matter?",    "acceptedAnswer": { "@@type": "Answer", "text": "Attachment style describes how you relate to others in close relationships — secure, anxious, avoidant, or disorganised. It is shaped in early childhood and influences adult relationships, communication, and emotional regulation." } },
        { "@@type": "Question", "name": "How accurate are online mental health screening tools?",  "acceptedAnswer": { "@@type": "Answer", "text": "Clinically validated tools like GAD-7 and PHQ-9 have strong sensitivity and specificity in research settings. However, self-report relies on honest answers, and context matters. Think of a score as a starting point for a conversation with a professional, not a final verdict." } },
        { "@@type": "Question", "name": "What should I do if my score is high?",                  "acceptedAnswer": { "@@type": "Answer", "text": "A high score on a screening quiz means you should speak with a GP, therapist, or mental health professional. In a crisis, contact a helpline such as the Samaritans (116 123 in the UK) or the 988 Suicide & Crisis Lifeline in the US." } }
      ]
    }
  ]
}
</script>
@endsection

@php
$cat  = config('mindsnap.categories')['mental-health'];
$faqs = [
  ['q' => 'Are these mental health quizzes a real diagnosis?',
   'a' => 'No. These are <strong>self-report screening tools</strong>, not clinical diagnoses. A high score indicates your symptoms may be significant enough to warrant professional attention — it does not confirm a disorder. Only a licensed mental health professional (psychiatrist, psychologist, or GP) can diagnose a condition after a full clinical assessment.'],
  ['q' => 'What is the GAD-7 anxiety test?',
   'a' => 'The <strong>GAD-7</strong> (Generalised Anxiety Disorder 7-item scale) is one of the most widely used anxiety screening tools in clinical practice. It asks about seven anxiety symptoms over the past two weeks. Scores range from 0–21: <strong>5–9 = mild</strong>, <strong>10–14 = moderate</strong>, <strong>15+ = severe</strong>. A score of 10 or above typically prompts further evaluation.'],
  ['q' => 'What is the PHQ-9 depression screening?',
   'a' => 'The <strong>PHQ-9</strong> (Patient Health Questionnaire-9) measures depression severity across nine criteria from the DSM. Scores range from 0–27: <strong>5–9 = mild</strong>, <strong>10–14 = moderate</strong>, <strong>15–19 = moderately severe</strong>, <strong>20+ = severe</strong>. It is used by millions of clinicians worldwide as a first-line screening tool.'],
  ['q' => 'What is an attachment style and why does it matter?',
   'a' => 'Attachment style describes your default pattern of relating to close others — rooted in early childhood caregiving experiences. The four main styles are <strong>secure</strong>, <strong>anxious-preoccupied</strong>, <strong>dismissive-avoidant</strong>, and <strong>disorganised</strong>. Knowing your style can explain recurring patterns in relationships and is often a starting point in therapy.'],
  ['q' => 'How accurate are online mental health screening tools?',
   'a' => 'Validated tools like GAD-7 and PHQ-9 have strong clinical evidence behind them — the PHQ-9 has sensitivity and specificity both above 80% for major depression in primary care settings. That said, self-report accuracy depends on honest answers and awareness of your own symptoms. Use scores as a <strong>conversation starter with a professional</strong>, not a definitive result.'],
  ['q' => 'What should I do if my score is high?',
   'a' => 'Speak with your GP, a therapist, or a mental health helpline. <strong>In the UK</strong>: Samaritans — 116 123 (free, 24/7). <strong>In the US</strong>: 988 Suicide & Crisis Lifeline — call or text 988. <strong>In Australia</strong>: Lifeline — 13 11 14. A high screening score is not a crisis in itself, but it is a signal worth taking seriously.'],
];

$relatedTools = [
  ['icon' => '💪', 'name' => 'Fitness Tools', 'slug' => '/fitness-tools', 'desc' => 'BMI, calories, macros & more'],
  ['icon' => '😴', 'name' => 'Sleep Tools',   'slug' => '/sleep-tools',   'desc' => 'Bedtime, sleep cycles & nap calculators'],
  ['icon' => '⏰', 'name' => 'Life Tools',    'slug' => '/life-tools',    'desc' => 'Age, dates & life calculators'],
  ['icon' => '🎮', 'name' => 'Brain Games',   'slug' => '/games',         'desc' => 'Typing speed, memory & reaction tests'],
];
@endphp

@section('content')

{{-- Breadcrumb --}}
<nav aria-label="Breadcrumb" class="ms-cat-nav">
  <div class="container-xl">
    <ol class="breadcrumb mb-0">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Mental Health Tools</li>
    </ol>
  </div>
</nav>

{{-- Hero --}}
<section class="ms-hero">
  <div class="container-xl">
    <div class="row align-items-center g-4">
      <div class="col-lg-8">
        <div class="d-flex align-items-center gap-3 mb-3">
          <span class="ms-hero-icon">{{ $cat['icon'] }}</span>
          <span class="badge ms-badge ms-badge-mental-health">{{ $cat['label'] }}</span>
        </div>
        <h1 class="ms-hero-title">Free Mental Health Tests & Screening Quizzes</h1>
        <p class="ms-hero-desc-wide">
          Clinically validated screening tools — GAD-7, PHQ-9, and attachment style. Get instant results with clear score explanations. Not a diagnosis — a starting point.
        </p>
        <div class="d-flex flex-wrap gap-3">
          <div class="ms-hero-feature d-flex align-items-center gap-2">
            <svg width="16" height="16" fill="none" stroke="#e94560" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            Based on clinical scales (GAD-7, PHQ-9)
          </div>
          <div class="ms-hero-feature d-flex align-items-center gap-2">
            <svg width="16" height="16" fill="none" stroke="#e94560" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            Instant results + score explanation
          </div>
          <div class="ms-hero-feature d-flex align-items-center gap-2">
            <svg width="16" height="16" fill="none" stroke="#e94560" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            100% free, no signup, anonymous
          </div>
        </div>
      </div>
      <div class="col-lg-4 d-none d-lg-flex justify-content-end">
        <div class="ms-hero-stat-box ms-hero-stat-box-mental-health">
          <div class="ms-hero-stat-num">{{ count($tools) }}</div>
          <div class="ms-hero-stat-sub">Mental Health Tools</div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Tools Grid --}}
<section class="ms-section-tools">
  <div class="container-xl">
    <div class="d-flex align-items-center justify-content-between mb-4">
      <h2 class="ms-section-h2">All Mental Health Tools</h2>
      <span class="text-muted-sm">{{ count($tools) }} tools</span>
    </div>
    <div class="row g-4">
      @foreach($tools as $tool)
      <div class="col-sm-6 col-lg-4">
        <a href="/{{ $tool['slug'] }}" class="tool-card ms-tool-card-mental-health d-block p-4 h-100 text-decoration-none">
          <div class="d-flex align-items-start gap-3">
            <span class="ms-tool-icon">{{ $tool['icon'] ?? '🧠' }}</span>
            <div>
              <div class="ms-tool-name">{{ $tool['name'] }}</div>
              <div class="ms-tool-desc">{{ $tool['description'] }}</div>
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- About These Screening Tools --}}
<section class="ms-section-white">
  <div class="container-xl">
    <div class="row g-5 align-items-center">
      <div class="col-lg-6">
        <h2>About These Screening Tools</h2>
        <p class="ms-body-text">
          The GAD-7 and PHQ-9 are among the most widely used mental health screening instruments in the world. Developed and validated in large clinical studies, they are recommended by the NHS, the American Psychiatric Association, and the WHO as first-line screening tools in primary care.
        </p>
        <p class="ms-body-text">
          A score is not a diagnosis. These tools measure how frequently certain symptoms have occurred over the past two weeks and produce a severity score. That score helps you and a clinician understand whether a deeper assessment is warranted — it does not replace one.
        </p>
        <p class="ms-body-text">
          If your results concern you, please speak with a GP or licensed mental health professional. Early conversation leads to better outcomes.
        </p>
      </div>
      <div class="col-lg-6">
        <div class="row g-3">
          @foreach([
            ['🧠','GAD-7','Validated anxiety screen — 7 questions'],
            ['💬','PHQ-9','Validated depression scale — 9 questions'],
            ['🔗','Attachment','4 adult attachment styles identified'],
            ['🔒','Anonymous','No account, no data stored'],
          ] as [$icon,$stat,$label])
          <div class="col-6">
            <div class="tool-card p-4 text-center h-100">
              <div class="ms-cycle-icon">{{ $icon }}</div>
              <div class="ms-cycle-val">{{ $stat }}</div>
              <div class="ms-cycle-label">{{ $label }}</div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

{{-- SEO Content --}}
<section class="ms-section-accent">
  <div class="container ms-longtail">
    <h2 class="mb-4 text-brand">Clinically Validated Anxiety and Depression Screening</h2>
    <p>The GAD-7 and PHQ-9 were developed through rigorous academic research and are used by tens of thousands of clinicians every day. The PHQ-9 was derived directly from the DSM diagnostic criteria for major depressive disorder, while the GAD-7 was developed to screen for generalised anxiety disorder in busy primary care settings where clinicians need a reliable, fast tool. Both instruments have published sensitivity and specificity data, meaning there is real-world evidence about how accurately they detect what they measure.</p>
    <h2 class="mt-5 mb-4 text-brand">Understanding Your Score</h2>
    <p>When you complete a GAD-7 or PHQ-9, you receive a numerical score alongside a severity band. Mild scores (5–9) may indicate symptoms worth monitoring. Moderate scores (10–14) suggest it is worth speaking to a GP. Severe scores (15+) indicate significant distress and warrant prompt professional support. No score should be read in isolation — context, life circumstances, and a clinician's judgement all matter.</p>
    <h2 class="mt-5 mb-4 text-brand">Attachment Style and Relationship Patterns</h2>
    <p>Attachment theory, developed by John Bowlby and later expanded by Mary Ainsworth, explains how early experiences with caregivers shape our emotional responses in adult relationships. Understanding whether you tend toward a secure, anxious, avoidant, or disorganised attachment pattern can be a powerful starting point for self-reflection and therapeutic work. Many people find that naming their attachment style helps them understand their own reactions in relationships more clearly.</p>
  </div>
</section>

{{-- FAQ --}}
<x-faq-section :faqs="$faqs" id="pageFaq" />

{{-- Related Tools --}}
<x-related-tools :tools="$relatedTools" heading="Explore More Tools" />

@endsection
