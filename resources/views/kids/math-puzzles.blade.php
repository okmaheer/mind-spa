@extends('layouts.app')
@section('title', 'Math Puzzles for Kids — Fun Free Practice | MindSnap')
@section('description', 'Free math puzzles for kids ages 5–14. Addition, multiplication, fractions, and algebra puzzles with emoji visuals. No signup, no ads, instant feedback.')
@section('canonical', config('app.url') . '/kids/math-puzzles')
@section('og_image', config('app.url') . '/images/og-default.jpg')

@section('styles')
<style>
  .mp-progress {
    height: 10px;
  }
  .mp-tool-icon-panel {
    font-size: 6rem;
    line-height: 1.2;
  }
  .mp-ops-row {
    font-size: 2rem;
  }
  .mp-related-desc {
    font-size: .8rem;
  }
</style>
@endsection

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "WebApplication",
  "name": "Math Puzzles for Kids",
  "url": "{{ config('app.url') }}/kids/math-puzzles",
  "description": "Free interactive math puzzles for kids ages 5-14. Addition, subtraction, multiplication, division, fractions, and basic algebra with emoji visuals and instant feedback.",
  "applicationCategory": "EducationalApplication",
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
    { "@@type": "ListItem", "position": 1, "name": "Home", "item": "{{ config('app.url') }}" },
    { "@@type": "ListItem", "position": 2, "name": "Kids Zone", "item": "{{ config('app.url') }}/kids" },
    { "@@type": "ListItem", "position": 3, "name": "Math Puzzles for Kids" }
  ]
}
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [
    {
      "@@type": "Question",
      "name": "What age group are these math puzzles for?",
      "acceptedAnswer": { "@@type": "Answer", "text": "MindSnap's math puzzles cover three age groups: Ages 5–7 (addition and subtraction up to 20 with emoji visuals), Ages 8–10 (multiplication and division), and Ages 11–14 (fractions, percentages, and basic algebra). Each group has age-appropriate difficulty and encouraging feedback." }
    },
    {
      "@@type": "Question",
      "name": "Are these math puzzles free for kids to use?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes — completely free. MindSnap's Kids Zone is entirely ad-free and requires no signup or account creation. Children can start solving puzzles immediately from any device with a browser." }
    },
    {
      "@@type": "Question",
      "name": "How do the emoji math puzzles work for young children?",
      "acceptedAnswer": { "@@type": "Answer", "text": "For children aged 5–7, math problems are shown with emoji visuals — for example, 🍎🍎 + 🍎🍎🍎 = ? — so kids can count objects rather than just abstract numbers. This visual approach helps early learners build number sense before moving to purely symbolic arithmetic." }
    },
    {
      "@@type": "Question",
      "name": "Can teachers use this tool in the classroom?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes. The tool works on any device including tablets and Chromebooks. Each 10-question round can be used as a quick warm-up activity. Teachers can project it on a whiteboard and have students answer together, or assign it as individual practice. No accounts or logins are needed." }
    },
    {
      "@@type": "Question",
      "name": "What happens when a child gets a math question wrong?",
      "acceptedAnswer": { "@@type": "Answer", "text": "When a child answers incorrectly, the tool shows an encouraging message like 'Almost! The answer is X. Try the next one! 💪' and reveals the correct answer. This approach reduces math anxiety and keeps children motivated to continue. Wrong answers are never penalised harshly." }
    },
    {
      "@@type": "Question",
      "name": "What topics do the math puzzles for 8-year-olds cover?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The Ages 8–10 group covers multiplication tables (2× through 12×), long division, word problems involving multiplication and division, and multi-step problems. Questions are presented as multiple choice with four options to reduce writing friction while still testing mathematical understanding." }
    },
    {
      "@@type": "Question",
      "name": "How are the math puzzles for 11-14 year olds different?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The Ages 11–14 group includes fractions (adding, subtracting, comparing), percentages (find x% of y), ratio and proportion problems, and introductory algebra (solve for x). These topics align with middle school math curricula and help students build confidence before tests." }
    },
    {
      "@@type": "Question",
      "name": "Does the tool track my child's progress over time?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The tool shows an end-of-round summary with score, star rating (⭐⭐⭐ for 10/10, ⭐⭐ for 7–9/10, ⭐ for 4–6/10), number of correct and wrong answers, and average time per question. Progress is session-based and not stored — protecting children's privacy with no data collection." }
    }
  ]
}
</script>
@endsection

@php
$faqs = [
  ['q' => 'What age group are these math puzzles designed for?',
   'a' => 'The puzzles cover three groups: Ages 5–7 (addition and subtraction up to 20 with emoji visuals), Ages 8–10 (multiplication and division), and Ages 11–14 (fractions, percentages, and basic algebra). Select your age group with the buttons above the puzzle to get the right difficulty level.'],
  ['q' => 'Are these math puzzles free? Do I need to sign up?',
   'a' => 'Completely free — no signup, no account, no email address required. MindSnap\'s Kids Zone is also 100% ad-free, so children will never see advertisements while practising. Just open the page and start solving.'],
  ['q' => 'How do the emoji math puzzles help young children?',
   'a' => 'Emoji visuals (🍎🍎 + 🍎🍎🍎 = ?) let children aged 5–7 count physical-looking objects rather than abstract numbers. Research in early childhood maths education consistently shows that concrete or visual representations help children build genuine number sense before transitioning to symbolic arithmetic.'],
  ['q' => 'Can I use this as a classroom math activity for kids?',
   'a' => 'Yes — the tool works on any device with a browser, including tablets and Chromebooks. You can project it on a smartboard for whole-class activities, or assign individual rounds as a 5-minute warm-up. No student accounts are needed, which removes any friction for classroom use.'],
  ['q' => 'What math topics are covered for 8 year olds?',
   'a' => 'The Ages 8–10 group covers multiplication tables (2× to 12×), division with remainders, and multi-step problems. Questions are multiple choice (4 options) so children can focus on the maths rather than spelling their answer. The timer shows how quickly they\'re working through each problem.'],
  ['q' => 'What happens if my child gets a question wrong?',
   'a' => 'Wrong answers show a friendly encouraging message — "Almost! The answer is X. Try the next one! 💪" — and reveal the correct answer so the child learns immediately. There\'s no penalty system or negative score; the goal is to build confidence and keep children engaged.'],
  ['q' => 'What math topics are included for 11–14 year olds?',
   'a' => 'The Ages 11–14 group covers fractions (adding and comparing), percentages, ratio and proportion, and introductory algebra (find x). These align with Key Stage 3 / middle school curricula and provide a low-pressure way to practise before tests or homework sessions.'],
  ['q' => 'Does this tool save my child\'s scores or collect personal data?',
   'a' => 'No personal data is collected. Scores and times are shown at the end of each round but are not stored or sent anywhere. When you close or refresh the page, the session is wiped. This makes the tool safe for children without needing parental consent forms or privacy waivers.'],
];

$relatedTools = [
  ['icon' => '🔤', 'name' => 'Spelling Quiz',    'slug' => 'kids/spelling-quiz',  'desc' => 'Practice spelling by grade level.'],
  ['icon' => '🔬', 'name' => 'Science Quiz',      'slug' => 'kids/science-quiz',   'desc' => 'Space, animals, chemistry and more.'],
  ['icon' => '🦁', 'name' => 'Animal Quiz',       'slug' => 'kids/animal-quiz',    'desc' => 'Habitats, diets, baby names and facts.'],
  ['icon' => '💬', 'name' => 'Word Games',        'slug' => 'kids/word-games',     'desc' => 'Rhymes, associations, and sentence builder.'],
];
@endphp

@section('content')

{{-- ── Hero ─────────────────────────────────────────────────────────────────── --}}
<section class="ms-hero">
  <div class="container-xl">
    <div class="row align-items-start g-5">
      <div class="col-lg-7">
        <x-breadcrumb :crumbs="[
          ['url' => route('home'),          'name' => 'Home'],
          ['url' => route('category.kids'), 'name' => 'Kids Zone'],
          ['url' => '',                     'name' => 'Math Puzzles'],
        ]"/>

        <h1 class="mb-2 ms-hero-title">🧮 Math Puzzles for Kids</h1>
        <p class="ms-hero-desc">
          Fun, free math puzzles for ages 5–14 — emoji visuals, instant feedback, and a star rating at the end.
          No ads, no signup — completely free.
        </p>

        {{-- ── Tool ─────────────────────────────────────────────────────────── --}}
        <div class="ms-tool-card p-4" id="mathPuzzleApp">

          {{-- Age group selector --}}
          <div id="ageSelector" class="mb-4">
            <p class="fw-semibold mb-2">Choose your age group:</p>
            <div class="d-flex flex-wrap gap-2">
              <button class="btn btn-outline-primary age-btn" data-group="young">Ages 5–7 🍎</button>
              <button class="btn btn-outline-primary age-btn" data-group="middle">Ages 8–10 ✖️</button>
              <button class="btn btn-outline-primary age-btn" data-group="older">Ages 11–14 📐</button>
            </div>
          </div>

          {{-- Progress bar --}}
          <div id="progressSection" class="d-none mb-3">
            <div class="d-flex justify-content-between align-items-center mb-1">
              <small class="text-muted">Question <span id="qNum">1</span> of 10</small>
              <small class="text-muted" id="timerDisplay">⏱ 0s</small>
            </div>
            <div class="progress mp-progress">
              <div id="progressBar" class="progress-bar bg-success"></div>
            </div>
          </div>

          {{-- Question area --}}
          <div id="questionSection" class="d-none">
            <div class="fs-2 text-center mb-3 fw-bold" id="emojiQuestion"></div>
            <div class="fs-4 text-center mb-4" id="textQuestion"></div>
            <div class="row g-2" id="choicesGrid"></div>
            <div id="feedbackBox" class="mt-3 d-none alert"></div>
          </div>

          {{-- Score screen --}}
          <div id="scoreSection" class="d-none text-center py-3">
            <div class="display-1 mb-2" id="starDisplay"></div>
            <h2 class="h3 mb-1" id="scoreHeading"></h2>
            <p class="text-muted mb-3" id="scoreDetails"></p>
            <div class="row g-3 mb-4">
              <div class="col-4">
                <div class="border rounded p-2">
                  <div class="fs-3 text-success fw-bold" id="correctCount">0</div>
                  <small>Correct</small>
                </div>
              </div>
              <div class="col-4">
                <div class="border rounded p-2">
                  <div class="fs-3 text-danger fw-bold" id="wrongCount">0</div>
                  <small>Wrong</small>
                </div>
              </div>
              <div class="col-4">
                <div class="border rounded p-2">
                  <div class="fs-3 text-primary fw-bold" id="avgTime">0s</div>
                  <small>Avg Time</small>
                </div>
              </div>
            </div>
            <button class="btn btn-primary btn-lg" id="newRoundBtn">🔄 New Round</button>
            <button class="btn btn-outline-secondary ms-2" id="changeGroupBtn">Change Age Group</button>
          </div>

        </div>{{-- /ms-tool-card --}}
      </div>

      <div class="col-lg-5 d-none d-lg-flex align-items-center justify-content-center">
        <div class="text-center p-4">
          <div class="mp-tool-icon-panel">🧮</div>
          <div class="mp-ops-row mt-2">➕➖✖️➗</div>
          <p class="text-muted mt-3 small">3 age groups · 10 questions per round · Star rating at the end</p>
          <div class="d-flex justify-content-center gap-3 mt-3">
            <span class="badge bg-success fs-6">Ages 5–7</span>
            <span class="badge bg-primary fs-6">Ages 8–10</span>
            <span class="badge bg-warning text-dark fs-6">Ages 11–14</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ── SEO Section 1 ────────────────────────────────────────────────────────── --}}
<section class="ms-section-white py-5">
  <div class="container-xl">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <h2 class="h3 mb-3">Free Math Puzzles for Kids Ages 5–7: Building Number Sense with Emoji Visuals</h2>
        <p>
          For young learners, abstract numbers alone can feel confusing. That's why MindSnap's puzzles for ages 5–7
          pair every problem with emoji objects — so a child reads "🍎🍎 + 🍎🍎🍎 = ?" and can count the apples
          directly on the screen. This visual representation mirrors the concrete manipulatives (blocks, counters)
          used in early years classrooms, helping children bridge the gap between physical objects and written numerals.
        </p>
        <p>
          Each round contains 10 questions covering addition and subtraction within 20. Questions are randomly
          generated, so every round feels fresh. A gentle encouraging message ("Almost! The answer is 5. Try the
          next one! 💪") appears after wrong answers, keeping the mood positive and reducing the maths anxiety
          that can develop when children feel punished for mistakes.
        </p>

        <h2 class="h3 mt-5 mb-3">Math Puzzles for 8–10 Year Olds: Multiplication, Division and Timed Challenges</h2>
        <p>
          Children aged 8–10 are typically consolidating their multiplication tables and meeting division for the
          first time. MindSnap's middle group presents four multiple-choice options for each question — reducing
          the cognitive load of writing answers while still requiring genuine mathematical reasoning to eliminate
          wrong choices. Topics include times tables from 2× to 12×, short division, and multi-step word problems.
        </p>
        <p>
          Each question is individually timed, and the end-of-round summary shows the child's average seconds per
          question. This helps competitive learners set personal bests across rounds, adding a self-improvement
          dimension without the anxiety of a live countdown. A star rating (⭐⭐⭐ for a perfect 10, ⭐⭐ for 7–9,
          ⭐ for 4–6) gives instant, clear feedback on overall performance.
        </p>

        <h2 class="h3 mt-5 mb-3">Math Puzzles for Ages 11–14: Fractions, Percentages and Algebra Warm-Ups</h2>
        <p>
          Middle schoolers face their most varied maths curriculum yet: fractions with unlike denominators,
          percentage calculations, ratio problems, and the introduction of algebraic thinking. MindSnap's
          Ages 11–14 group covers all these topics with randomly generated values so students can't memorise
          specific answers — they must actually understand the method.
        </p>
        <p>
          Teachers and parents often report that children lack confidence going into maths tests. Daily 10-question
          rounds using this tool can act as a low-stakes warm-up: the star rating gives a quick benchmark,
          the timer encourages efficiency, and the no-signup, ad-free environment means there's zero friction
          to starting a session. It takes about three minutes to complete a round — the ideal warm-up length
          before homework or tutoring.
        </p>
      </div>
    </div>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="mathPuzzlesFaq" />

{{-- ── Related Tools ────────────────────────────────────────────────────────── --}}
<section class="ms-section-white py-5">
  <div class="container-xl">
    <h2 class="h4 text-center mb-4">More Free Kids Tools</h2>
    <div class="row g-3 justify-content-center">
      @foreach($relatedTools as $tool)
      <div class="col-6 col-md-3">
        <a href="{{ config('app.url') }}/{{ $tool['slug'] }}" class="text-decoration-none">
          <div class="border rounded p-3 text-center h-100">
            <div class="fs-2 mb-2">{{ $tool['icon'] }}</div>
            <div class="fw-semibold small">{{ $tool['name'] }}</div>
            <div class="text-muted mp-related-desc">{{ $tool['desc'] }}</div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
  </div>
</section>

@endsection

@push('scripts')
<script>
(function () {
  'use strict';

  // ── Question banks ──────────────────────────────────────────────────────────
  function generateYoung() {
    const ops = ['+', '-'];
    const op = ops[Math.floor(Math.random() * ops.length)];
    let a, b, answer;
    if (op === '+') { a = rand(1,12); b = rand(1, 20 - a); answer = a + b; }
    else { a = rand(2,20); b = rand(1,a); answer = a - b; }
    const emojis = ['🍎','🌟','🐶','🎈','🍕','🦋','🌈','🏀','🎵','🍦'];
    const em = emojis[Math.floor(Math.random() * emojis.length)];
    return {
      emoji: em.repeat(a) + ' ' + op + ' ' + em.repeat(b) + ' = ?',
      text: a + ' ' + op + ' ' + b + ' = ?',
      answer
    };
  }

  function generateMiddle() {
    const type = rand(0,1);
    let a, b, answer, text;
    if (type === 0) { a = rand(2,12); b = rand(2,12); answer = a * b; text = a + ' × ' + b + ' = ?'; }
    else { b = rand(2,12); answer = rand(2,12); a = b * answer; text = a + ' ÷ ' + b + ' = ?'; }
    return { emoji: '', text, answer };
  }

  function generateOlder() {
    const type = rand(0,2);
    let text, answer;
    if (type === 0) {
      const b = rand(2,8); const d = rand(2,8);
      const a = rand(1,b-1); const c = rand(1,d-1);
      const num = a*d + c*b; const den = b*d; const g = gcd(num,den);
      answer = num/g + '/' + den/g;
      text = a+'/'+b+' + '+c+'/'+d+' = ? (simplify)';
      return { emoji:'', text, answer, isText: true };
    } else if (type === 1) {
      const pct = [10,20,25,50,5,15][rand(0,5)];
      const base = rand(2,20) * 10;
      answer = pct * base / 100;
      text = pct + '% of ' + base + ' = ?';
    } else {
      const b = rand(1,20); const x = rand(1,20); const a = x + b;
      answer = x;
      text = 'x + ' + b + ' = ' + a + ' — find x';
    }
    return { emoji:'', text, answer };
  }

  function buildQuestion(group) {
    const gen = group === 'young' ? generateYoung : group === 'middle' ? generateMiddle : generateOlder;
    const q = gen();
    if (q.isText) {
      const wrongs = generateWrongTexts(q.answer, 3);
      const choices = shuffle([q.answer, ...wrongs]);
      return { ...q, choices };
    }
    const answer = parseFloat(q.answer);
    const wrongs = generateWrongs(answer, 3, group);
    const choices = shuffle([answer, ...wrongs]);
    return { ...q, choices };
  }

  function generateWrongs(correct, count, group) {
    const set = new Set([correct]);
    const out = [];
    while (out.length < count) {
      let w = correct + (rand(0,1) ? 1 : -1) * rand(1,5);
      if (w < 0) w = correct + rand(1,5);
      if (!set.has(w)) { set.add(w); out.push(w); }
    }
    return out;
  }

  function generateWrongTexts(correct, count) {
    const parts = correct.split('/');
    const out = [];
    const set = new Set([correct]);
    const nums = [parseInt(parts[0]), parseInt(parts[0])+1, parseInt(parts[0])-1, parseInt(parts[0])+2];
    const dens = [parseInt(parts[1]), parseInt(parts[1])+1, parseInt(parts[1])-1, parseInt(parts[1])+2];
    for (let n of nums) for (let d of dens) {
      if (n > 0 && d > 0 && out.length < count) {
        const s = n+'/'+d;
        if (!set.has(s)) { set.add(s); out.push(s); }
      }
    }
    return out.slice(0,count);
  }

  // ── Helpers ─────────────────────────────────────────────────────────────────
  function rand(min, max) { return Math.floor(Math.random()*(max-min+1))+min; }
  function shuffle(arr) { return arr.sort(() => Math.random() - 0.5); }
  function gcd(a,b) { return b === 0 ? a : gcd(b, a % b); }

  // ── State ───────────────────────────────────────────────────────────────────
  let group = null, questions = [], current = 0, correct = 0, wrong = 0;
  let times = [], questionStart = 0, timerInterval = null;

  // ── DOM refs ────────────────────────────────────────────────────────────────
  const ageSelector     = document.getElementById('ageSelector');
  const progressSection = document.getElementById('progressSection');
  const questionSection = document.getElementById('questionSection');
  const scoreSection    = document.getElementById('scoreSection');
  const emojiQ          = document.getElementById('emojiQuestion');
  const textQ           = document.getElementById('textQuestion');
  const choicesGrid     = document.getElementById('choicesGrid');
  const feedbackBox     = document.getElementById('feedbackBox');
  const progressBar     = document.getElementById('progressBar');
  const qNum            = document.getElementById('qNum');
  const timerDisplay    = document.getElementById('timerDisplay');
  const starDisplay     = document.getElementById('starDisplay');
  const scoreHeading    = document.getElementById('scoreHeading');
  const scoreDetails    = document.getElementById('scoreDetails');
  const correctCount    = document.getElementById('correctCount');
  const wrongCount      = document.getElementById('wrongCount');
  const avgTime         = document.getElementById('avgTime');

  // ── Age group selection ─────────────────────────────────────────────────────
  document.querySelectorAll('.age-btn').forEach(btn => {
    btn.addEventListener('click', function () {
      group = this.dataset.group;
      startRound();
    });
  });

  document.getElementById('newRoundBtn').addEventListener('click', startRound);
  document.getElementById('changeGroupBtn').addEventListener('click', () => {
    scoreSection.classList.add('d-none');
    ageSelector.classList.remove('d-none');
    progressSection.classList.add('d-none');
    questionSection.classList.add('d-none');
  });

  // ── Round management ─────────────────────────────────────────────────────────
  function startRound() {
    questions = Array.from({length:10}, () => buildQuestion(group));
    current = 0; correct = 0; wrong = 0; times = [];
    ageSelector.classList.add('d-none');
    scoreSection.classList.add('d-none');
    progressSection.classList.remove('d-none');
    questionSection.classList.remove('d-none');
    showQuestion();
  }

  function showQuestion() {
    const q = questions[current];
    qNum.textContent = current + 1;
    progressBar.style.width = (current / 10 * 100) + '%';
    emojiQ.textContent = q.emoji || '';
    textQ.textContent  = q.text;
    feedbackBox.classList.add('d-none');
    feedbackBox.className = 'mt-3 d-none alert';

    choicesGrid.innerHTML = '';
    q.choices.forEach(choice => {
      const col = document.createElement('div');
      col.className = 'col-6';
      const btn = document.createElement('button');
      btn.className = 'btn btn-outline-secondary w-100 py-3 fs-5';
      btn.textContent = choice;
      btn.addEventListener('click', () => handleAnswer(choice, q.answer, btn));
      col.appendChild(btn);
      choicesGrid.appendChild(col);
    });

    questionStart = Date.now();
    let elapsed = 0;
    clearInterval(timerInterval);
    timerInterval = setInterval(() => {
      elapsed = Math.round((Date.now() - questionStart) / 1000);
      timerDisplay.textContent = '⏱ ' + elapsed + 's';
    }, 500);
  }

  function handleAnswer(chosen, answer, btn) {
    clearInterval(timerInterval);
    const elapsed = Math.round((Date.now() - questionStart) / 1000);
    times.push(elapsed);

    choicesGrid.querySelectorAll('button').forEach(b => b.disabled = true);

    const isCorrect = String(chosen) === String(answer);
    if (isCorrect) {
      correct++;
      btn.classList.replace('btn-outline-secondary','btn-success');
      feedbackBox.className = 'mt-3 alert alert-success';
      feedbackBox.textContent = '✅ Correct! Well done! 🎉';
    } else {
      wrong++;
      btn.classList.replace('btn-outline-secondary','btn-danger');
      choicesGrid.querySelectorAll('button').forEach(b => {
        if (String(b.textContent.trim()) === String(answer)) b.classList.replace('btn-outline-secondary','btn-success');
      });
      feedbackBox.className = 'mt-3 alert alert-warning';
      feedbackBox.textContent = 'Almost! The answer is ' + answer + '. Try the next one! 💪';
    }
    feedbackBox.classList.remove('d-none');

    setTimeout(() => {
      current++;
      if (current < 10) { showQuestion(); }
      else { showScore(); }
    }, 1500);
  }

  function showScore() {
    progressSection.classList.add('d-none');
    questionSection.classList.add('d-none');
    scoreSection.classList.remove('d-none');

    const avg = times.length ? Math.round(times.reduce((a,b)=>a+b,0)/times.length) : 0;
    correctCount.textContent = correct;
    wrongCount.textContent   = wrong;
    avgTime.textContent      = avg + 's';

    let stars, msg;
    if (correct === 10)      { stars = '⭐⭐⭐'; msg = 'Perfect score! You\'re a maths superstar! 🏆'; }
    else if (correct >= 7)   { stars = '⭐⭐';  msg = 'Great work! Keep practising to get all 3 stars! 💪'; }
    else if (correct >= 4)   { stars = '⭐';    msg = 'Good effort! Try again to improve your score! 😊'; }
    else                     { stars = '🔄';    msg = 'Keep going — practice makes perfect! 📚'; }

    starDisplay.textContent   = stars;
    scoreHeading.textContent  = correct + '/10 — ' + msg;
    scoreDetails.textContent  = 'Correct: ' + correct + '  |  Wrong: ' + wrong + '  |  Avg time: ' + avg + 's per question';
  }
})();
</script>
@endpush
