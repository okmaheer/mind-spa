@extends('layouts.app')

@section('title', 'Free Online Brain Quizzes — IQ Test, General Knowledge & More | MindSnap')
@section('description', 'Free online brain quizzes: IQ test, general knowledge quiz, history quiz, biology, science, geography, maths, World War 2, and human body quiz. 20 questions each. Instant results, no signup required.')
@section('canonical', config('app.url') . '/quizzes')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@graph": [
    {
      "@@type": "CollectionPage",
      "@@id": "{{ config('app.url') }}/quizzes#collection",
      "url": "{{ config('app.url') }}/quizzes",
      "name": "Free Online Brain Quizzes",
      "description": "Free brain quizzes including IQ test, general knowledge, history, biology, science, geography, math, WW2, and human body quizzes. Instant results.",
      "inLanguage": "en",
      "publisher": { "@@type": "Organization", "name": "MindSnap", "url": "{{ config('app.url') }}" }
    },
    {
      "@@type": "BreadcrumbList",
      "itemListElement": [
        { "@@type": "ListItem", "position": 1, "name": "Home", "item": "{{ config('app.url') }}" },
        { "@@type": "ListItem", "position": 2, "name": "Brain Quizzes", "item": "{{ config('app.url') }}/quizzes" }
      ]
    },
    {
      "@@type": "FAQPage",
      "mainEntity": [
        {
          "@@type": "Question",
          "name": "Are these quizzes free?",
          "acceptedAnswer": { "@@type": "Answer", "text": "Yes, all quizzes on MindSnap are completely free. No account, no email, no payment required. Just click a quiz and start immediately." }
        },
        {
          "@@type": "Question",
          "name": "How accurate is the free IQ test?",
          "acceptedAnswer": { "@@type": "Answer", "text": "Our IQ test is a 20-question screener covering logic, pattern recognition, and spatial reasoning. It gives a strong general indication of cognitive ability but is not a certified clinical assessment. For official IQ measurement, consult a psychologist." }
        },
        {
          "@@type": "Question",
          "name": "How many questions are in each quiz?",
          "acceptedAnswer": { "@@type": "Answer", "text": "Most quizzes on MindSnap have 20 questions. The IQ test has 20 questions designed to test logical reasoning and pattern recognition. Results are shown instantly at the end with correct answers." }
        },{
          "@@type": "Question",
          "name": "Can I retake a quiz on MindSnap?",
          "acceptedAnswer": { "@@type": "Answer", "text": "Yes — you can retake any quiz as many times as you like. Questions are drawn from a larger bank, so you may see different questions each time. This makes MindSnap quizzes useful for ongoing revision and knowledge building, not just a one-time test." }
        },
        {
          "@@type": "Question",
          "name": "Are the quizzes suitable for all ages?",
          "acceptedAnswer": { "@@type": "Answer", "text": "The adult quizzes (general knowledge, history, science, etc.) are designed for ages 14+. For younger children, visit the Kids Zone for age-appropriate science, animal, and spelling quizzes designed for ages 5-14." }
        }
      ]
    }
  ]
}
</script>
@endsection

@section('content')

<nav aria-label="Breadcrumb" style="background:#f0f2f5; padding:10px 0; border-bottom:1px solid var(--border);">
  <div class="container-xl">
    <ol class="breadcrumb mb-0" style="font-size:.84rem;">
      <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:var(--primary-cta);">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page" style="color:var(--text-muted);">Brain Quizzes</li>
    </ol>
  </div>
</nav>

{{-- Hero --}}
<section style="background:linear-gradient(135deg,#1a1a2e 0%,#16213e 50%,#0f3460 100%); padding:64px 0 48px;">
  <div class="container-xl">
    <div class="row align-items-center g-4">
      <div class="col-lg-8">
        <div class="d-flex align-items-center gap-3 mb-3">
          <span style="font-size:2.8rem; line-height:1;">🧠</span>
          <span class="badge" style="background:rgba(233,69,96,.2); color:#ff8fa3; border:1px solid rgba(233,69,96,.4); border-radius:50px; font-size:.8rem; padding:5px 14px;">Brain Quizzes</span>
        </div>
        <h1 style="color:#fff; margin-bottom:16px;">Free Online Brain Quizzes</h1>
        <p style="color:rgba(255,255,255,.75); font-size:1.1rem; line-height:1.7; max-width:620px; margin-bottom:24px;">
          Test your IQ, general knowledge, history, science, geography, and more.
          9 free quizzes with instant results — no signup, no time limit, works anywhere.
        </p>
        <div class="d-flex flex-wrap gap-3">
          <div class="d-flex align-items-center gap-2" style="color:rgba(255,255,255,.65); font-size:.88rem;">
            <svg width="16" height="16" fill="none" stroke="#e94560" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            20 questions per quiz
          </div>
          <div class="d-flex align-items-center gap-2" style="color:rgba(255,255,255,.65); font-size:.88rem;">
            <svg width="16" height="16" fill="none" stroke="#e94560" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            Instant score & answers
          </div>
          <div class="d-flex align-items-center gap-2" style="color:rgba(255,255,255,.65); font-size:.88rem;">
            <svg width="16" height="16" fill="none" stroke="#e94560" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            100% free, no signup
          </div>
        </div>
      </div>
      <div class="col-lg-4 d-none d-lg-flex justify-content-end">
        <div style="background:rgba(233,69,96,.12); border:1px solid rgba(233,69,96,.25); border-radius:16px; padding:28px 32px; text-align:center;">
          <div style="font-size:3rem; margin-bottom:8px;">9</div>
          <div style="color:rgba(255,255,255,.7); font-size:.9rem;">Quizzes & Tests</div>
          <div style="height:1px; background:rgba(255,255,255,.1); margin:14px 0;"></div>
          <div style="font-size:1.6rem; margin-bottom:4px;">2M+</div>
          <div style="color:rgba(255,255,255,.7); font-size:.9rem;">Monthly searches</div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Featured: IQ Test --}}
<section style="padding:48px 0 0;">
  <div class="container-xl">
    <div class="row">
      <div class="col-12">
        <div style="background:linear-gradient(135deg,#e94560 0%,#c73652 100%); border-radius:16px; padding:36px 40px; position:relative; overflow:hidden;">
          <div style="position:absolute; right:-20px; top:-20px; font-size:8rem; opacity:.1; line-height:1;">🧩</div>
          <div class="row align-items-center g-3">
            <div class="col-lg-8">
              <div class="d-flex align-items-center gap-2 mb-2">
                <span style="background:rgba(255,255,255,.2); color:#fff; border-radius:50px; padding:3px 12px; font-size:.75rem; font-weight:600;">⭐ Most Popular</span>
                <span style="background:rgba(255,255,255,.2); color:#fff; border-radius:50px; padding:3px 12px; font-size:.75rem; font-weight:600;">1.8M searches/mo</span>
              </div>
              <h2 style="color:#fff; margin-bottom:10px; font-size:1.6rem;">Free IQ Test — 20 Questions</h2>
              <p style="color:rgba(255,255,255,.85); margin-bottom:0; font-size:.95rem; line-height:1.7;">
                Logic, pattern recognition, and spatial reasoning. Get your IQ score estimate instantly. No email required.
              </p>
            </div>
            <div class="col-lg-4 text-lg-end">
              <a href="/iq-test" class="btn" style="background:#fff; color:#e94560; font-weight:700; border-radius:8px; padding:14px 32px; font-size:1rem;">
                Take the IQ Test →
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- All Quizzes Grid --}}
<section style="padding:48px 0;">
  <div class="container-xl">
    <h2 class="mb-4" style="font-size:1.5rem;">All Quizzes</h2>

    <div class="row g-4">
      {{-- Always show all quizzes hardcoded so we have full content even if DB empty --}}
      @php
        $quizList = [
          ['🌍','General Knowledge Quiz','/quiz/general-knowledge','Science, history, geography & culture. How many of 20 can you get right?','246K'],
          ['🏛️','History Quiz','/quiz/history','Ancient civilisations, world wars & modern history. 20 questions.','90K'],
          ['🔬','Biology Quiz','/quiz/biology','Cells, genetics, evolution, anatomy & ecosystems. 20 questions.','55K'],
          ['⚗️','Science Quiz','/quiz/science','Physics, chemistry, space, and technology. 20 questions.','80K'],
          ['🗺️','Geography Quiz','/quiz/geography','Capitals, countries, rivers, mountains & oceans. 20 questions.','72K'],
          ['➗','Maths Quiz','/quiz/math','Arithmetic, algebra, geometry & number theory. 20 questions.','48K'],
          ['🪖','World War 2 Quiz','/quiz/world-war-2','Battles, leaders, dates & turning points. 20 questions.','40K'],
          ['🫀','Human Body Quiz','/quiz/human-body','Organs, systems, bones & functions. 20 questions.','33K'],
        ];
      @endphp

      @foreach($quizList as $quiz)
      <div class="col-sm-6 col-lg-4">
        <a href="{{ $quiz[2] }}" class="tool-card d-block p-4 h-100 text-decoration-none"
           style="border-left:4px solid #e94560;">
          <div class="d-flex align-items-start gap-3">
            <span style="font-size:2rem; line-height:1; flex-shrink:0;">{{ $quiz[0] }}</span>
            <div style="min-width:0;">
              <div style="font-weight:700; color:var(--primary-dark); font-size:.95rem; margin-bottom:4px;">{{ $quiz[1] }}</div>
              <div style="font-size:.83rem; color:var(--text-muted); line-height:1.5;">{{ $quiz[3] }}</div>
              <div class="mt-2"><span class="badge-searches">{{ $quiz[4] }} searches/mo</span></div>
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- Quick Stats --}}
<section style="padding:48px 0; background:#fff;">
  <div class="container-xl">
    <h2 class="text-center mb-2">MindSnap Quiz Fast Facts</h2>
    <p class="text-center mb-5" style="color:var(--text-muted); max-width:480px; margin:0 auto 40px;">Numbers from our quiz library and player data.</p>
    <div class="row g-3 justify-content-center">
      @foreach([
        ['🧩','9','Quiz categories available'],
        ['❓','20','Questions per quiz'],
        ['⚡','~5 min','Average time to complete'],
        ['📊','Instant','Results with full answer review'],
      ] as [$icon,$stat,$label])
      <div class="col-6 col-md-3">
        <div class="tool-card p-4 text-center h-100">
          <div style="font-size:1.8rem; margin-bottom:8px;">{{ $icon }}</div>
          <div style="font-weight:800; font-size:1.2rem; color:var(--primary-dark);">{{ $stat }}</div>
          <div style="font-size:.8rem; color:var(--text-muted); margin-top:4px;">{{ $label }}</div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- Quiz Categories explainer --}}
<section style="padding:48px 0; background:#fff;">
  <div class="container-xl">
    <h2 class="text-center mb-2">Train Your Brain Every Day</h2>
    <p class="text-center mb-5" style="color:var(--text-muted); max-width:540px; margin:0 auto 40px;">
      Regular quiz practice improves memory retention, general knowledge, and cognitive flexibility.
    </p>
    <div class="row g-4 justify-content-center">
      @foreach([
        ['🎯','Pick a topic','Choose from 9 quiz categories — GK, science, history, and more'],
        ['📝','Answer 20 questions','Multiple choice questions with instant feedback after each answer'],
        ['📊','See your score','Get your result, correct answers, and a shareable score card'],
      ] as [$icon,$title,$desc])
      <div class="col-md-4">
        <div class="text-center p-4">
          <div style="font-size:2.5rem; margin-bottom:12px;">{{ $icon }}</div>
          <div style="font-weight:700; color:var(--primary-dark); font-size:1rem; margin-bottom:6px;">{{ $title }}</div>
          <div style="font-size:.88rem; color:var(--text-muted); line-height:1.6;">{{ $desc }}</div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<section class="py-5" style="background:#f8f9ff;">
  <div class="container" style="max-width:860px;">
    <h2 class="mb-4" style="color:var(--primary-dark);">Free IQ Test Online — How Accurate Are They?</h2>
    <p>Online IQ tests vary enormously in accuracy. Most free tests are significantly easier than clinically validated instruments (like the Wechsler or Stanford-Binet), which causes systematic score inflation — people score 15–20 points higher online than in clinical settings. MindSnap's IQ test is designed to measure relative cognitive performance across verbal reasoning, pattern recognition, and numerical reasoning without inflating scores. It is best understood as a cognitive performance benchmark, not a clinical IQ score, and scores should not be compared to clinically administered tests.</p>
    <h2 class="mt-5 mb-4" style="color:var(--primary-dark);">General Knowledge Quiz — Test Yourself Across Every Subject</h2>
    <p>General knowledge quizzes test breadth of knowledge across history, science, geography, literature, sport, and current events. Research in cognitive psychology shows that testing yourself on knowledge (rather than re-reading) is one of the most effective learning strategies — a phenomenon known as the "testing effect" or retrieval practice. Taking a quiz is not just a test of what you know; it actively strengthens memory for the information you recall correctly and highlights gaps for further study.</p>
    <h2 class="mt-5 mb-4" style="color:var(--primary-dark);">Brain Quizzes for Adults — Cognitive Fitness Benefits</h2>
    <p>Regular cognitive challenges — quizzes, puzzles, learning new skills — are associated with a lower risk of cognitive decline in older adults. A 2014 study in PLOS ONE found that adults who regularly engaged in mentally stimulating activities had a 2.5-year delay in memory decline compared to those who did not. Brain quizzes alone will not prevent dementia, but they represent one component of a cognitively active lifestyle alongside physical exercise, social engagement, and adequate sleep.</p>
  </div>
</section>

{{-- FAQ --}}
<section style="padding:56px 0;">
  <div class="container-xl">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <h2 class="text-center mb-5">Frequently Asked Questions</h2>
        <div class="accordion" id="quizFaq">
          @foreach([
            ['Are these quizzes completely free?',
             'Yes — every quiz on MindSnap is 100% free. No account, no email, no payment. Click any quiz and start immediately. Results are shown instantly at the end.'],
            ['How accurate is the free IQ test?',
             'Our <a href="/iq-test">IQ test</a> is a 20-question cognitive screener covering logic, pattern recognition, and spatial reasoning. It gives a strong general indication but is not a certified clinical assessment. For official IQ testing, consult a licensed psychologist.'],
            ['How many questions are in each quiz?',
             'Most quizzes have <strong>20 questions</strong>. The IQ test also has 20 questions. Questions are multiple choice — tap or click the answer, see instant feedback, and get your final score at the end.'],
            ['Can I retake a quiz?',
             'Yes — you can retake any quiz as many times as you like. Questions are drawn from a larger bank, so you may see different questions each time.'],
            ['Are the quizzes suitable for all ages?',
             'The adult quizzes (GK, history, science, etc.) are designed for ages 14+. For younger children, visit our <a href="/kids">Kids Zone</a> for age-appropriate science, animal, and spelling quizzes.'],
          ] as $i => [$q,$a])
          <div class="accordion-item" style="border:1px solid var(--border); border-radius:10px !important; margin-bottom:10px; overflow:hidden;">
            <h3 class="accordion-header">
              <button class="accordion-button {{ $i > 0 ? 'collapsed' : '' }}" type="button"
                      data-bs-toggle="collapse" data-bs-target="#qFaq{{ $i }}"
                      style="font-weight:600; font-size:.95rem; background:transparent; color:var(--primary-dark);">
                {{ $q }}
              </button>
            </h3>
            <div id="qFaq{{ $i }}" class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}" data-bs-parent="#quizFaq">
              <div class="accordion-body" style="font-size:.92rem; line-height:1.8; color:var(--text);">{!! $a !!}</div>
            </div>
          </div>
          @endforeach

          <div class="accordion-item border-0 mb-2">
            <h3 class="accordion-header">
              <button class="accordion-button collapsed fw-600" type="button" data-bs-toggle="collapse" data-bs-target="#faq-qz6">
                What is a good IQ score?
              </button>
            </h3>
            <div id="faq-qz6" class="accordion-collapse collapse">
              <div class="accordion-body pt-0" style="color:#555;">
                On a standard IQ scale with a mean of 100 and standard deviation of 15: below 70 is considered significantly below average, 85–115 is the average range (covers approximately 68% of the population), 115–130 is above average, 130–145 is gifted, and above 145 is exceptionally gifted. Roughly 95% of the population scores between 70 and 130. IQ measures specific cognitive abilities — pattern recognition, verbal reasoning, working memory — not general intelligence, creativity, or life success.
              </div>
            </div>
          </div>
          <div class="accordion-item border-0 mb-2">
            <h3 class="accordion-header">
              <button class="accordion-button collapsed fw-600" type="button" data-bs-toggle="collapse" data-bs-target="#faq-qz7">
                Can you improve your IQ score?
              </button>
            </h3>
            <div id="faq-qz7" class="accordion-collapse collapse">
              <div class="accordion-body pt-0" style="color:#555;">
                IQ scores are relatively stable in adulthood, but cognitive performance — the practical expression of intelligence — can be significantly improved. Regular aerobic exercise increases BDNF (brain-derived neurotrophic factor), improving memory and processing speed. Adequate sleep dramatically improves cognitive performance — even one night of poor sleep reduces IQ-equivalent performance by 5–10 points. Learning new complex skills (a musical instrument, a language) builds new neural connections. You may not raise your IQ ceiling, but you can operate much closer to it.
              </div>
            </div>
          </div>
          <div class="accordion-item border-0 mb-2">
            <h3 class="accordion-header">
              <button class="accordion-button collapsed fw-600" type="button" data-bs-toggle="collapse" data-bs-target="#faq-qz8">
                How often should you take a brain quiz?
              </button>
            </h3>
            <div id="faq-qz8" class="accordion-collapse collapse">
              <div class="accordion-body pt-0" style="color:#555;">
                For cognitive training benefits, consistency matters more than frequency. Taking a brain quiz or engaging in a cognitive challenge 3–5 times per week for 15–20 minutes produces more benefit than sporadic long sessions. Variety is also important — repeating the same quiz measures familiarity, not cognitive ability. Rotate between different quiz types (general knowledge, pattern recognition, verbal, numerical) to challenge different cognitive domains and avoid the "practice effect" inflating your results.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Related --}}
<section style="padding:40px 0 64px; background:#f8f9fa;">
  <div class="container-xl">
    <h2 class="mb-4" style="font-size:1.3rem;">Explore More Tools</h2>
    <div class="row g-3">
      @foreach([
        ['🎮','Brain Games','/games','Typing speed, memory & reaction tests','#ffc107'],
        ['👶','Kids Zone','/kids','Safe quizzes & games for children','#17a2b8'],
        ['😴','Sleep Tools','/sleep-tools','Bedtime & sleep cycle calculators','#6c63ff'],
        ['💪','Fitness Tools','/fitness-tools','BMI, calories & macro calculators','#28a745'],
      ] as [$icon,$label,$slug,$desc,$color])
      <div class="col-sm-6 col-lg-3">
        <a href="{{ $slug }}" class="tool-card d-flex align-items-center gap-3 p-3 text-decoration-none h-100">
          <span style="font-size:1.8rem; line-height:1; flex-shrink:0;">{{ $icon }}</span>
          <div>
            <div style="font-weight:700; color:var(--primary-dark); font-size:.9rem;">{{ $label }}</div>
            <div style="font-size:.78rem; color:var(--text-muted);">{{ $desc }}</div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
  </div>
</section>

@endsection
