@extends('layouts.app')

@section('title', 'Attachment Style Quiz — Free 4-Style Test | MindSnap')
@section('description', 'Discover your attachment style in 2 minutes. Free quiz identifies Secure, Anxious, Avoidant, or Disorganized patterns with science-backed questions.')
@section('canonical', config('app.url') . '/attachment-style-quiz')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "WebApplication",
  "name": "Attachment Style Quiz",
  "url": "{{ config('app.url') }}/attachment-style-quiz",
  "description": "An 18-question attachment style assessment identifying Secure, Anxious, Avoidant, or Disorganized patterns. Get your primary attachment style and all four scores instantly.",
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
    { "@@type": "ListItem", "position": 3, "name": "Attachment Style Quiz" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [
    { "@@type": "Question", "name": "What are the 4 attachment styles?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The four attachment styles are: Secure (comfortable with closeness and independence, trusts partners), Anxious or Preoccupied (fears abandonment, needs reassurance, hypervigilant to partner behaviour), Avoidant or Dismissive (values independence, uncomfortable with emotional closeness, suppresses feelings), and Disorganized or Fearful-Avoidant (simultaneously craves and fears closeness, often linked to early trauma). These categories originate from Ainsworth's Strange Situation studies and Bartholomew and Horowitz's adult attachment model." } },
    { "@@type": "Question", "name": "Can my attachment style change over time?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes. Attachment styles are not fixed traits. Research shows they can shift through corrective emotional experiences — including a stable, supportive romantic relationship, meaningful friendships, and especially therapy. Attachment-focused therapies such as Emotionally Focused Therapy (EFT) and schema therapy are particularly effective at moving people toward more secure functioning. The change is gradual but well-documented in longitudinal studies." } },
    { "@@type": "Question", "name": "Is this attachment style quiz clinically validated?",
      "acceptedAnswer": { "@@type": "Answer", "text": "This quiz is based on the theoretical framework of adult attachment research by Bowlby, Ainsworth, and later Bartholomew and Horowitz. It is designed as an educational self-reflection tool, not a clinical instrument. Validated clinical measures include the Experiences in Close Relationships scale (ECR-R) and the Relationship Structures questionnaire (ECR-RS). For a thorough assessment, consult a psychologist or attachment-informed therapist." } },
    { "@@type": "Question", "name": "What causes disorganized attachment?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Disorganized attachment typically develops when early caregivers are simultaneously a source of comfort and fear — for example, through abuse, neglect, or severe emotional unpredictability. The child faces an irresolvable dilemma: the person who should provide safety is the source of threat. This disrupts the normal attachment behavioural system and can result in fragmented, contradictory strategies in adult relationships. Trauma-informed therapy is the most effective intervention." } },
    { "@@type": "Question", "name": "How do anxious and avoidant attachment styles interact in relationships?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The anxious-avoidant pairing is one of the most common and challenging relationship dynamics. The anxious partner pursues closeness and reassurance; the avoidant partner withdraws when feeling overwhelmed. This creates a demand-withdrawal cycle that amplifies both people's core fears. The anxious partner's pursuit confirms to the avoidant partner that closeness is threatening; the avoidant's withdrawal confirms to the anxious partner that they will be abandoned. Both partners benefit from understanding this cycle before it escalates." } },
    { "@@type": "Question", "name": "What therapy works best for anxious attachment?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Emotionally Focused Therapy (EFT) is the most evidence-based approach for attachment-related relationship patterns. For individuals, Cognitive Behavioural Therapy (CBT) targeting reassurance-seeking behaviours, schema therapy for early maladaptive schemas (particularly abandonment and mistrust), and mindfulness-based approaches to manage hypervigilance are all effective. The goal is building what researchers call 'earned security' — developing secure functioning through insight and experience despite an insecure history." } },
    { "@@type": "Question", "name": "Can someone have more than one attachment style?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes. Most people have a primary attachment style with elements of others. You may be predominantly secure but show anxious patterns under high stress, or be primarily avoidant with some fearful-avoidant characteristics in very intimate relationships. Attachment also varies somewhat by relationship type — you might be more secure with friends than with romantic partners. This quiz shows all four scores to capture this nuance rather than reducing you to a single category." } },
    { "@@type": "Question", "name": "What does secure attachment look like in adult relationships?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Securely attached adults are comfortable with emotional intimacy without becoming enmeshed, and comfortable with independence without becoming avoidant. They communicate needs directly rather than through protest or withdrawal, trust partners without excessive surveillance, handle relationship conflict without catastrophising, and recover relatively quickly from relationship setbacks. Secure attachment is associated with higher relationship satisfaction, better emotional regulation, and stronger social support networks." } }
  ]
}
</script>
@endsection

@php
$faqs = [
  ['q' => 'What are the 4 attachment styles?',
   'a' => 'The four attachment styles are: <strong>Secure</strong> (comfortable with closeness and independence, trusts partners), <strong>Anxious/Preoccupied</strong> (fears abandonment, needs reassurance, hypervigilant to partner behaviour), <strong>Avoidant/Dismissive</strong> (values independence, uncomfortable with emotional closeness, suppresses feelings), and <strong>Disorganized/Fearful-Avoidant</strong> (simultaneously craves and fears closeness, often linked to early trauma). These categories originate from Ainsworth\'s Strange Situation studies and Bartholomew and Horowitz\'s adult attachment model.'],
  ['q' => 'Can my attachment style change over time?',
   'a' => 'Yes. Attachment styles are not fixed traits. Research shows they can shift through corrective emotional experiences — including a stable, supportive romantic relationship, meaningful friendships, and especially therapy. Attachment-focused therapies such as Emotionally Focused Therapy (EFT) and schema therapy are particularly effective at moving people toward more secure functioning. The change is gradual but well-documented in longitudinal studies.'],
  ['q' => 'Is this attachment style quiz clinically validated?',
   'a' => 'This quiz is based on the theoretical framework of adult attachment research by Bowlby, Ainsworth, and later Bartholomew and Horowitz. It is designed as an educational self-reflection tool, not a clinical instrument. Validated clinical measures include the Experiences in Close Relationships scale (ECR-R) and the Relationship Structures questionnaire (ECR-RS). For a thorough assessment, consult a psychologist or attachment-informed therapist.'],
  ['q' => 'What causes disorganized attachment?',
   'a' => 'Disorganized attachment typically develops when early caregivers are simultaneously a source of comfort and fear — for example, through abuse, neglect, or severe emotional unpredictability. The child faces an irresolvable dilemma: the person who should provide safety is the source of threat. This disrupts the normal attachment behavioural system and can result in fragmented, contradictory strategies in adult relationships. Trauma-informed therapy is the most effective intervention.'],
  ['q' => 'How do anxious and avoidant attachment styles interact in relationships?',
   'a' => 'The anxious-avoidant pairing is one of the most common and challenging relationship dynamics. The anxious partner pursues closeness and reassurance; the avoidant partner withdraws when feeling overwhelmed. This creates a demand-withdrawal cycle that amplifies both people\'s core fears. The anxious partner\'s pursuit confirms to the avoidant partner that closeness is threatening; the avoidant\'s withdrawal confirms to the anxious partner that they will be abandoned. Both partners benefit from understanding this cycle before it escalates.'],
  ['q' => 'What therapy works best for anxious attachment?',
   'a' => 'Emotionally Focused Therapy (EFT) is the most evidence-based approach for attachment-related relationship patterns. For individuals, Cognitive Behavioural Therapy (CBT) targeting reassurance-seeking behaviours, schema therapy for early maladaptive schemas (particularly abandonment and mistrust), and mindfulness-based approaches to manage hypervigilance are all effective. The goal is building what researchers call "earned security" — developing secure functioning through insight and experience despite an insecure history.'],
  ['q' => 'Can someone have more than one attachment style?',
   'a' => 'Yes. Most people have a primary attachment style with elements of others. You may be predominantly secure but show anxious patterns under high stress, or be primarily avoidant with some fearful-avoidant characteristics in very intimate relationships. Attachment also varies somewhat by relationship type — you might be more secure with friends than with romantic partners. This quiz shows all four scores to capture this nuance rather than reducing you to a single category.'],
  ['q' => 'What does secure attachment look like in adult relationships?',
   'a' => 'Securely attached adults are comfortable with emotional intimacy without becoming enmeshed, and comfortable with independence without becoming avoidant. They communicate needs directly rather than through protest or withdrawal, trust partners without excessive surveillance, handle relationship conflict without catastrophising, and recover relatively quickly from relationship setbacks. Secure attachment is associated with higher relationship satisfaction, better emotional regulation, and stronger social support networks.'],
  ['q' => 'How does childhood experience shape adult attachment?',
   'a' => 'Bowlby\'s attachment theory proposes that early interactions with primary caregivers form an "internal working model" — a mental template of what relationships are like, how trustworthy others are, and how worthy of care you are. Consistently responsive caregiving builds secure attachment. Inconsistent responsiveness (sometimes attuned, sometimes unavailable) tends to produce anxious attachment. Consistently dismissive or emotionally unavailable caregiving produces avoidant attachment. Both sources of fear and safety together produce disorganized attachment.'],
  ['q' => 'What is "earned security" in attachment theory?',
   'a' => 'Earned security refers to achieving secure attachment functioning in adulthood despite having had an insecure attachment history. It is well-documented in the research of Mary Main, who found that some adults with difficult childhoods develop coherent, secure narratives about their past through reflective insight. Therapy, stable relationships, and deliberate self-understanding are the main pathways. Earned security produces relationship outcomes nearly identical to those with continuous secure attachment from childhood.'],
];

$relatedTools = [
  ['icon' => '😰', 'name' => 'GAD-7 Anxiety Test',          'slug' => 'gad-7-anxiety-test',          'desc' => 'Clinically validated 7-item generalised anxiety scale.'],
  ['icon' => '😔', 'name' => 'PHQ-9 Depression Test',        'slug' => 'phq-9-depression-test',        'desc' => 'Standard 9-item depression severity questionnaire.'],
  ['icon' => '😴', 'name' => 'Sleep Quality Quiz',            'slug' => 'sleep-quality-quiz',            'desc' => 'Score your sleep in 10 questions.'],
  ['icon' => '🧠', 'name' => 'Emotional Intelligence Quiz',   'slug' => 'emotional-intelligence-quiz',   'desc' => 'Measure your EQ across five core dimensions.'],
];
@endphp

@section('styles')
<style>
.asq-prog-wrap        { flex:1; background:#f0f0f0; border-radius:4px; height:6px; }
.asq-prog-bar         { height:100%; background:var(--mental-health); border-radius:4px; transition:width .3s; width:0%; }
.asq-prog-text        { font-size:.78rem; color:#888; min-width:50px; text-align:right; }
.asq-scale-wrap       { display:grid; grid-template-columns:repeat(5,1fr); gap:8px; }
.asq-scale-opt        { border:2px solid #e0e0e0; background:#fff; cursor:pointer; border-radius:10px; padding:10px 6px; text-align:center; transition:all .15s; }
.asq-scale-opt:hover  { border-color:var(--mental-health); background:rgba(233,69,96,.04); }
.asq-scale-opt-sel    { border-color:var(--mental-health); background:rgba(233,69,96,.08); }
.asq-scale-num        { font-size:1.2rem; font-weight:800; color:var(--primary-dark); display:block; line-height:1; margin-bottom:4px; }
.asq-scale-label      { font-size:.68rem; color:#777; line-height:1.2; }
.asq-q-text           { font-weight:700; color:var(--primary-dark); font-size:.97rem; margin-bottom:20px; line-height:1.55; }
.asq-q-num            { font-size:.78rem; color:var(--mental-health); font-weight:700; text-transform:uppercase; letter-spacing:.5px; margin-bottom:6px; }
.asq-error-msg        { color:#e94560; font-size:.8rem; margin-top:10px; }
.asq-retake-btn       { border:2px solid var(--mental-health); color:var(--mental-health); border-radius:8px; font-weight:600; padding:12px; background:transparent; }
.asq-retake-btn:hover { background:var(--mental-health); color:#fff; }

/* Result theming blocks */
.asq-result-secure      { --asq-color:#28a745; --asq-bg:#edfff3; --asq-border:rgba(40,167,69,.25); }
.asq-result-anxious     { --asq-color:#e65100; --asq-bg:#fff8ec; --asq-border:rgba(230,81,0,.25); }
.asq-result-avoidant    { --asq-color:#0b7285; --asq-bg:#e8f7f9; --asq-border:rgba(11,114,133,.25); }
.asq-result-disorganized{ --asq-color:#c23152; --asq-bg:#fff0f3; --asq-border:rgba(194,49,82,.25); }

.asq-result-panel       { border-radius:14px; padding:28px; border:2px solid var(--asq-border); background:var(--asq-bg); animation:fadeIn .35s ease; }
.asq-result-badge       { display:inline-block; padding:4px 14px; border-radius:50px; font-size:.78rem; font-weight:700; background:var(--asq-color); color:#fff; margin-bottom:12px; }
.asq-result-style       { font-size:1.5rem; font-weight:800; color:var(--asq-color); margin-bottom:8px; }
.asq-result-desc        { font-size:.9rem; color:#444; line-height:1.75; margin-bottom:0; }

/* Score bars */
.asq-bar-label          { font-size:.82rem; font-weight:600; color:var(--primary-dark); min-width:110px; }
.asq-bar-track          { flex:1; background:#f0f0f0; border-radius:4px; height:10px; overflow:hidden; }
.asq-bar-fill           { height:100%; border-radius:4px; transition:width .6s ease; }
.asq-bar-fill-secure      { background:#28a745; }
.asq-bar-fill-anxious     { background:#e65100; }
.asq-bar-fill-avoidant    { background:#0b7285; }
.asq-bar-fill-disorganized{ background:#c23152; }
.asq-bar-pct            { font-size:.78rem; color:#888; min-width:36px; text-align:right; }

/* Detail cards */
.asq-detail-row         { display:grid; gap:12px; }
.asq-detail-item        { padding:12px 14px; border-radius:8px; background:#f8f9fa; }
.asq-detail-head        { font-size:.75rem; font-weight:700; text-transform:uppercase; letter-spacing:.5px; margin-bottom:6px; }
.asq-detail-text        { font-size:.82rem; color:#555; line-height:1.65; margin:0; }

/* Style explanation cards */
.asq-style-card         { border-radius:12px; padding:20px; }
.asq-style-card-secure      { background:#edfff3; border:1px solid rgba(40,167,69,.2); }
.asq-style-card-anxious     { background:#fff8ec; border:1px solid rgba(230,81,0,.2); }
.asq-style-card-avoidant    { background:#e8f7f9; border:1px solid rgba(11,114,133,.2); }
.asq-style-card-disorganized{ background:#fff0f3; border:1px solid rgba(194,49,82,.2); }
.asq-style-title-secure      { color:#1a7a32; }
.asq-style-title-anxious     { color:#e65100; }
.asq-style-title-avoidant    { color:#0b7285; }
.asq-style-title-disorganized{ color:#c23152; }
.asq-style-dot              { width:10px; height:10px; border-radius:50%; flex-shrink:0; margin-top:5px; }
.asq-style-dot-secure        { background:#28a745; }
.asq-style-dot-anxious       { background:#e65100; }
.asq-style-dot-avoidant      { background:#0b7285; }
.asq-style-dot-disorganized  { background:#c23152; }
.asq-style-trait            { font-size:.82rem; color:#555; line-height:1.5; }

/* Disclaimer */
.asq-disclaimer { background:#f8f9ff; border-left:4px solid var(--mental-health); border-radius:0 8px 8px 0; padding:14px 18px; font-size:.83rem; color:#555; line-height:1.65; }

/* Facts column */
.asq-fact-dot  { width:8px; height:8px; border-radius:50%; background:var(--mental-health); flex-shrink:0; margin-top:5px; }
.asq-fact-title { font-weight:600; font-size:.88rem; color:#fff; }
.asq-fact-desc  { font-size:.8rem; color:rgba(255,255,255,.55); line-height:1.4; margin-top:1px; }
</style>
@endsection

@section('content')

<section class="ms-hero">
  <div class="container-xl">
    <div class="row align-items-start g-5">

      <div class="col-lg-7">
        <x-breadcrumb :crumbs="[
          ['url' => route('home'),                    'name' => 'Home'],
          ['url' => route('category.mental-health'),  'name' => 'Mental Health Tools'],
          ['url' => '',                               'name' => 'Attachment Style Quiz'],
        ]"/>

        <h1 class="mb-2 ms-hero-title">
          💞 Attachment Style Quiz — Discover Your Pattern
        </h1>
        <p class="ms-hero-desc">
          18 questions, 2 minutes. Identify whether you're Secure, Anxious, Avoidant, or Disorganized — and understand what drives your relationship patterns.
        </p>

        <div class="card border-0 mb-n4 ms-tool-card">
          <div class="card-body p-4 p-md-5">

            {{-- Quiz area --}}
            <div id="quizArea">
              <div class="d-flex align-items-center gap-2 mb-4">
                <div class="asq-prog-wrap">
                  <div id="progressBar" class="asq-prog-bar"></div>
                </div>
                <span id="progressText" class="asq-prog-text">1 / 18</span>
              </div>

              <div id="questionBlock"></div>

              <div class="d-flex gap-2 mt-4">
                <button id="prevBtn" class="btn btn-outline-secondary flex-fill d-none" onclick="asqNavigate(-1)">← Back</button>
              </div>
            </div>

            {{-- Result area --}}
            <div id="quizResult" class="d-none">
              <div id="resultContent"></div>
              <button class="btn w-100 mt-4 asq-retake-btn" onclick="asqReset()">
                Retake Quiz
              </button>
            </div>

          </div>
        </div>
      </div>

      <div class="col-lg-5 d-none d-lg-block pt-2">
        <div class="ms-facts-wrap">
          <h3 class="ms-facts-title">What This Quiz Measures</h3>
          @foreach([
            ['Comfort with closeness',       'How you handle emotional intimacy and vulnerability'],
            ['Trust and security',           'Whether you feel safe depending on others'],
            ['Anxiety about abandonment',    'Hypervigilance to partner withdrawal or rejection'],
            ['Avoidance of dependence',      'Preference for self-reliance over emotional sharing'],
            ['Fear-approach conflict',       'Simultaneously wanting and dreading closeness'],
            ['Communication of needs',       'How directly you express what you need in relationships'],
            ['Recovery after conflict',      'How quickly you return to baseline after relationship stress'],
          ] as [$label, $desc])
          <div class="d-flex align-items-start gap-3 mb-3">
            <div class="asq-fact-dot mt-2"></div>
            <div>
              <div class="asq-fact-title">{{ $label }}</div>
              <div class="asq-fact-desc">{{ $desc }}</div>
            </div>
          </div>
          @endforeach
        </div>
      </div>

    </div>
  </div>
</section>

{{-- The 4 Attachment Styles Explained --}}
<section class="ms-section-white">
  <div class="container-xl">
    <h2 class="text-center mb-2">The 4 Attachment Styles Explained</h2>
<img src="{{ asset('images/attachment-styles-quadrant.svg') }}" alt="Attachment styles quadrant showing the four attachment types on anxiety and avoidance axes" width="640" height="160" loading="lazy" class="img-fluid rounded-3 mb-4">
    <p class="text-center text-muted mb-5 ms-intro-text">Based on decades of research by Bowlby, Ainsworth, and Bartholomew.</p>

    <div class="row g-4">
      <div class="col-md-6">
        <div class="asq-style-card asq-style-card-secure h-100">
          <h3 class="asq-style-title-secure mb-3">✅ Secure</h3>
          <div class="d-flex flex-column gap-2">
            @foreach([
              'Comfortable with both closeness and independence',
              'Trusts partners without excessive monitoring',
              'Expresses needs clearly and without fear',
              'Handles conflict without catastrophising',
              'Recovers quickly from relationship setbacks',
            ] as $trait)
            <div class="d-flex align-items-start gap-2">
              <div class="asq-style-dot asq-style-dot-secure"></div>
              <span class="asq-style-trait">{{ $trait }}</span>
            </div>
            @endforeach
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="asq-style-card asq-style-card-anxious h-100">
          <h3 class="asq-style-title-anxious mb-3">🔶 Anxious (Preoccupied)</h3>
          <div class="d-flex flex-column gap-2">
            @foreach([
              'Fears abandonment and rejection deeply',
              'Needs frequent reassurance from partners',
              'Hypervigilant to signals of withdrawal',
              'May protest or pursue when partner pulls away',
              'Often replays interactions looking for signs of trouble',
            ] as $trait)
            <div class="d-flex align-items-start gap-2">
              <div class="asq-style-dot asq-style-dot-anxious"></div>
              <span class="asq-style-trait">{{ $trait }}</span>
            </div>
            @endforeach
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="asq-style-card asq-style-card-avoidant h-100">
          <h3 class="asq-style-title-avoidant mb-3">🔵 Avoidant (Dismissive)</h3>
          <div class="d-flex flex-column gap-2">
            @foreach([
              'Strongly values independence and self-reliance',
              'Uncomfortable when others get emotionally close',
              'Tends to suppress or minimise feelings',
              'May pull away when a relationship deepens',
              'Often frames not needing others as a strength',
            ] as $trait)
            <div class="d-flex align-items-start gap-2">
              <div class="asq-style-dot asq-style-dot-avoidant"></div>
              <span class="asq-style-trait">{{ $trait }}</span>
            </div>
            @endforeach
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="asq-style-card asq-style-card-disorganized h-100">
          <h3 class="asq-style-title-disorganized mb-3">🔴 Disorganized (Fearful-Avoidant)</h3>
          <div class="d-flex flex-column gap-2">
            @foreach([
              'Craves closeness but fears it at the same time',
              'Relationships feel both necessary and threatening',
              'Emotional states in relationships shift rapidly',
              'May push people away when they get close',
              'Often linked to earlier experiences with unsafe caregivers',
            ] as $trait)
            <div class="d-flex align-items-start gap-2">
              <div class="asq-style-dot asq-style-dot-disorganized"></div>
              <span class="asq-style-trait">{{ $trait }}</span>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Origins section --}}
<section class="ms-section-accent">
  <div class="container ms-longtail">
    <h2 class="mb-4 text-brand">Where Do Attachment Styles Come From?</h2>
    <p>Attachment theory was developed by British psychiatrist John Bowlby in the 1960s and 1970s. Bowlby proposed that humans are biologically predisposed to form close emotional bonds with caregivers, and that the quality of early caregiving shapes an internal working model — a mental blueprint of how trustworthy other people are and how worthy of care you are yourself.</p>
    <p>Mary Ainsworth's "Strange Situation" experiments in the 1970s provided the first empirical evidence for distinct attachment patterns in infants. She identified three original styles: secure, anxious-ambivalent, and avoidant. A fourth category, disorganized, was added by Mary Main and Judith Solomon in 1986 to describe children whose behaviour couldn't be classified by the original three patterns — typically children who had experienced frightening or frightened caregiving.</p>
    <p>Research on adult attachment, pioneered by Cindy Hazan and Phillip Shaver in 1987, demonstrated that the same patterns show up in romantic relationships. Kim Bartholomew and Leonard Horowitz later proposed the two-dimensional model still used today: attachment anxiety (fear of abandonment) and attachment avoidance (discomfort with closeness) — producing the four quadrants this quiz assesses.</p>

    <h2 class="mt-5 mb-4 text-brand">Can Your Attachment Style Change?</h2>
    <p>Yes — and this is one of the most important findings in attachment research. Attachment styles are tendencies shaped by experience, not fixed personality traits. They can shift through three main pathways.</p>
    <p>The first is a long-term, consistently secure relationship — romantic or otherwise — that provides enough corrective emotional experience to gradually update the internal working model. The second is therapy, particularly Emotionally Focused Therapy (EFT), schema therapy, and other attachment-informed approaches that directly target the beliefs and patterns driving insecure attachment. The third is deliberate reflective work: developing a coherent, compassionate narrative about your early experiences, which Mary Main's research shows is the single strongest predictor of earned security in adulthood.</p>
    <p>Change typically takes time and is rarely linear — you may revert to insecure patterns under stress even as your baseline shifts. But the research is clear: adults raised with insecure attachment can and do achieve fully secure functioning.</p>

    <h2 class="mt-5 mb-4 text-brand">Attachment Styles in Relationships</h2>
    <p>The most well-studied relational dynamic is the <strong>anxious-avoidant trap</strong>. The anxious partner's need for closeness triggers the avoidant partner's discomfort with it, causing withdrawal. The withdrawal confirms the anxious partner's fear of abandonment, intensifying pursuit. This cycle can continue until one or both partners understand the pattern and interrupt it consciously.</p>
    <p>Two anxiously attached people in a relationship often experience high emotional intensity — both need reassurance and both fear abandonment — which can feel passionate but destabilising. Two avoidantly attached people may experience a relatively peaceful surface while both maintain significant emotional distance, leaving underlying intimacy needs unmet.</p>
    <p>Disorganized attachment presents the most complexity in relationships because the approach-avoidance conflict is internal — the person simultaneously moves toward and away from closeness, often confusing both themselves and their partners. Therapy, particularly trauma-focused work, is strongly recommended.</p>
    <p>Secure partners tend to have a regulating effect on insecurely attached partners over time. Research by Brooke Feeney and others shows that relationships with securely attached individuals are one of the most reliable pathways to earned security.</p>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="pageFaq" />

<x-related-tools :tools="$relatedTools" heading="Related Mental Health Tools" />

@endsection

@section('scripts')
<script>
(function () {
  var QUESTIONS = [
    { id: 'anx1',  style: 'anxious',      text: 'I often worry that my partner will stop loving me.' },
    { id: 'anx2',  style: 'anxious',      text: 'I need a lot of reassurance from people I care about.' },
    { id: 'anx3',  style: 'anxious',      text: 'I feel anxious when someone I care about doesn\'t respond quickly.' },
    { id: 'anx4',  style: 'anxious',      text: 'I worry that others don\'t care about me as much as I care about them.' },
    { id: 'anx5',  style: 'anxious',      text: 'I often replay arguments in my head, wondering what I did wrong.' },
    { id: 'avo1',  style: 'avoidant',     text: 'I prefer not to depend on others for emotional support.' },
    { id: 'avo2',  style: 'avoidant',     text: 'I feel uncomfortable when people get too emotionally close to me.' },
    { id: 'avo3',  style: 'avoidant',     text: 'I tend to keep my feelings to myself rather than sharing them.' },
    { id: 'avo4',  style: 'avoidant',     text: 'I value my independence more than deep emotional connections.' },
    { id: 'avo5',  style: 'avoidant',     text: 'When people want to get closer, I find myself pulling away.' },
    { id: 'sec1',  style: 'secure',       text: 'I find it easy to trust others.' },
    { id: 'sec2',  style: 'secure',       text: 'I\'m comfortable turning to others when I need support.' },
    { id: 'sec3',  style: 'secure',       text: 'I feel secure in my relationships even when apart from loved ones.' },
    { id: 'sec4',  style: 'secure',       text: 'I can express my needs without fearing rejection.' },
    { id: 'sec5',  style: 'secure',       text: 'I bounce back relatively quickly after relationship difficulties.' },
    { id: 'dis1',  style: 'disorganized', text: 'I sometimes want closeness desperately but push people away when they get close.' },
    { id: 'dis2',  style: 'disorganized', text: 'My feelings in relationships can shift quickly and feel overwhelming.' },
    { id: 'dis3',  style: 'disorganized', text: 'I struggle to know whether I want closeness or distance in relationships.' },
  ];

  var SCALE_LABELS = ['Strongly\nDisagree', 'Disagree', 'Neutral', 'Agree', 'Strongly\nAgree'];

  var RESULTS = {
    secure: {
      label: 'Secure',
      badge: 'Primary Style',
      description: 'You have a secure attachment style. You\'re comfortable with intimacy and independence in equal measure. You trust partners, communicate needs clearly, and handle relationship stress without catastrophising. Secure attachment is the healthiest pattern and a foundation for stable, fulfilling relationships.',
      strengths: ['Comfortable with emotional intimacy', 'Able to depend on others and be depended upon', 'Communicates needs and feelings directly', 'Handles conflict constructively'],
      growth: ['Patience with insecurely attached partners', 'Recognising when your security may obscure a partner\'s distress'],
      tips: ['You are well positioned to be a regulating presence for insecurely attached partners. Continue prioritising open communication and responsiveness.'],
    },
    anxious: {
      label: 'Anxious (Preoccupied)',
      badge: 'Primary Style',
      description: 'You lean anxious (preoccupied) attachment. You value closeness deeply but often fear it won\'t last. Anxiety about abandonment can trigger hypervigilance to partner behaviour, and you may need more reassurance than others. With awareness, anxious attachment is very manageable.',
      strengths: ['Deeply empathetic and attuned to others', 'Values connection and intimacy highly', 'Committed and emotionally invested in relationships'],
      growth: ['Reducing reassurance-seeking behaviours', 'Building self-soothing capacity', 'Learning to trust without constant verification'],
      tips: ['CBT and EFT are particularly effective for anxious attachment. Identifying the difference between a real threat and an attachment trigger is the key first skill to develop.'],
    },
    avoidant: {
      label: 'Avoidant (Dismissive)',
      badge: 'Primary Style',
      description: 'You lean avoidant (dismissive) attachment. You\'re self-reliant and value independence, but may find deep emotional intimacy uncomfortable. You may minimise relationship problems or pull back when things get close. Avoidant attachment often develops as a protective strategy.',
      strengths: ['Self-sufficient and emotionally stable under stress', 'Rarely overwhelmed by relationship anxiety', 'Thoughtful and measured in conflict'],
      growth: ['Allowing vulnerability with trusted others', 'Tolerating the discomfort of emotional intimacy', 'Recognising emotional needs rather than suppressing them'],
      tips: ['Start with small acts of emotional disclosure and notice the outcome. Avoidant patterns often maintain themselves because the predicted catastrophe (loss of self or rejection) never gets tested.'],
    },
    disorganized: {
      label: 'Disorganized (Fearful-Avoidant)',
      badge: 'Primary Style',
      description: 'You show disorganized (fearful-avoidant) attachment. You may simultaneously crave and fear closeness — wanting connection but finding it threatening. This pattern is often linked to earlier experiences where caregivers were both a source of comfort and fear. Therapy, particularly trauma-informed approaches, can be transformative.',
      strengths: ['High capacity for insight and self-reflection', 'Deep understanding of relational complexity', 'Often highly empathetic due to lived experience of relational difficulty'],
      growth: ['Developing consistency in relationship behaviour', 'Processing early relational experiences with professional support', 'Building a coherent narrative about past and present'],
      tips: ['Trauma-informed therapy (EMDR, somatic approaches, or IFS) alongside attachment-focused work is the most effective combination. You are not broken — disorganized attachment is a logical response to an impossible early situation.'],
    },
  };

  var answers = {};
  var current = 0;

  function renderQuestion(idx) {
    var q = QUESTIONS[idx];
    var sel = answers[q.id];

    var html = '<p class="asq-q-num">Question ' + (idx + 1) + ' of ' + QUESTIONS.length + '</p>';
    html += '<p class="asq-q-text">' + q.text + '</p>';
    html += '<div class="asq-scale-wrap">';

    for (var i = 1; i <= 5; i++) {
      var isSelected = sel === i;
      html += '<div class="asq-scale-opt' + (isSelected ? ' asq-scale-opt-sel' : '') + '" '
        + 'onclick="asqSelect(\'' + q.id + '\',' + i + ',' + idx + ')">'
        + '<span class="asq-scale-num">' + i + '</span>'
        + '<span class="asq-scale-label">' + SCALE_LABELS[i - 1].replace('\n', '<br>') + '</span>'
        + '</div>';
    }

    html += '</div>';
    document.getElementById('questionBlock').innerHTML = html;

    var pct = Math.round((idx / QUESTIONS.length) * 100);
    document.getElementById('progressBar').style.width = pct + '%';
    document.getElementById('progressText').textContent = (idx + 1) + ' / ' + QUESTIONS.length;

    var prevBtn = document.getElementById('prevBtn');
    prevBtn.classList.toggle('d-none', idx === 0);
  }

  window.asqSelect = function (id, value, idx) {
    answers[id] = value;
    if (idx < QUESTIONS.length - 1) {
      current = idx + 1;
      renderQuestion(current);
    } else {
      renderQuestion(current);
      setTimeout(asqSubmit, 300);
    }
  };

  window.asqNavigate = function (dir) {
    current = Math.max(0, Math.min(QUESTIONS.length - 1, current + dir));
    renderQuestion(current);
  };

  function asqSubmit() {
    var scores = { secure: 0, anxious: 0, avoidant: 0, disorganized: 0 };
    var maxPossible = { secure: 0, anxious: 0, avoidant: 0, disorganized: 0 };

    QUESTIONS.forEach(function (q) {
      var val = answers[q.id] || 0;
      scores[q.style] += val;
      maxPossible[q.style] += 5;
    });

    var pcts = {
      secure:       Math.round((scores.secure       / maxPossible.secure)       * 100),
      anxious:      Math.round((scores.anxious       / maxPossible.anxious)      * 100),
      avoidant:     Math.round((scores.avoidant      / maxPossible.avoidant)     * 100),
      disorganized: Math.round((scores.disorganized  / maxPossible.disorganized) * 100),
    };

    var primary = Object.keys(scores).reduce(function (a, b) {
      return scores[a] >= scores[b] ? a : b;
    });

    var res = RESULTS[primary];

    var html = '<div class="asq-result-' + primary + '">';
    html += '<div class="asq-result-panel mb-4">';
    html += '<span class="asq-result-badge">' + res.badge + '</span>';
    html += '<div class="asq-result-style">' + res.label + '</div>';
    html += '<p class="asq-result-desc">' + res.description + '</p>';
    html += '</div>';

    html += '<div class="mb-4">';
    html += '<p class="ms-panel-head mb-3">Your 4 Style Scores</p>';

    var styleOrder = ['secure', 'anxious', 'avoidant', 'disorganized'];
    var styleLabels = { secure: 'Secure', anxious: 'Anxious', avoidant: 'Avoidant', disorganized: 'Disorganized' };

    styleOrder.forEach(function (s) {
      html += '<div class="d-flex align-items-center gap-2 mb-2">';
      html += '<span class="asq-bar-label">' + styleLabels[s] + '</span>';
      html += '<div class="asq-bar-track"><div class="asq-bar-fill asq-bar-fill-' + s + '" id="bar-' + s + '"></div></div>';
      html += '<span class="asq-bar-pct">' + pcts[s] + '%</span>';
      html += '</div>';
    });
    html += '</div>';

    html += '<div class="asq-detail-row mb-4">';

    html += '<div class="asq-detail-item">';
    html += '<div class="asq-detail-head text-green-brand">Strengths</div>';
    html += '<ul class="mb-0 ps-3">';
    res.strengths.forEach(function (s) {
      html += '<li class="asq-detail-text">' + s + '</li>';
    });
    html += '</ul></div>';

    html += '<div class="asq-detail-item">';
    html += '<div class="asq-detail-head text-orange-brand">Growth Areas</div>';
    html += '<ul class="mb-0 ps-3">';
    res.growth.forEach(function (g) {
      html += '<li class="asq-detail-text">' + g + '</li>';
    });
    html += '</ul></div>';

    html += '<div class="asq-detail-item">';
    html += '<div class="asq-detail-head text-teal-brand">What Helps</div>';
    res.tips.forEach(function (t) {
      html += '<p class="asq-detail-text mb-0">' + t + '</p>';
    });
    html += '</div>';

    html += '</div>';

    html += '<div class="asq-disclaimer">';
    html += '<strong>Disclaimer:</strong> This quiz is for educational purposes. It is not a clinical assessment. If you\'d like to explore your attachment patterns professionally, a therapist can provide a more thorough evaluation.';
    html += '</div>';

    html += '</div>';

    document.getElementById('quizArea').classList.add('d-none');
    document.getElementById('quizResult').classList.remove('d-none');
    document.getElementById('resultContent').innerHTML = html;

    setTimeout(function () {
      styleOrder.forEach(function (s) {
        var el = document.getElementById('bar-' + s);
        if (el) { el.style.width = pcts[s] + '%'; }
      });
    }, 50);

    document.getElementById('quizResult').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
  }

  window.asqReset = function () {
    answers = {};
    current = 0;
    document.getElementById('quizArea').classList.remove('d-none');
    document.getElementById('quizResult').classList.add('d-none');
    renderQuestion(0);
  };

  renderQuestion(0);
})();
</script>
@endsection
