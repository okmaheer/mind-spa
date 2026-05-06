@extends('layouts.app')

@section('title', 'Typing Speed Test — WPM & Accuracy Checker | MindSnap')
@section('description', 'Free typing speed test — measure WPM, accuracy & consistency score. Choose General, Code, Literature or News text. No signup.')
@section('canonical', config('app.url') . '/typing-speed-test')
@section('og_image', config('app.url') . '/images/og-default.jpg')

@section('styles')
<style>
  .ts-text-display {
    font-size: 1.05rem;
    min-height: 90px;
    word-break: break-word;
    cursor: text;
    user-select: none;
  }
  .ts-custom-time {
    width: 80px;
  }
  .ts-progress {
    height: 12px;
  }
  .ts-seo-section {
    max-width: 780px;
  }
</style>
@endsection

@section('schema')
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"WebApplication","name":"Typing Speed Test","url":"{{ config('app.url') }}/typing-speed-test","description":"Free online typing speed test measuring WPM, accuracy and consistency score across multiple text categories.","applicationCategory":"GameApplication","operatingSystem":"Any","offers":{"@type":"Offer","price":"0","priceCurrency":"USD"},"publisher":{"@type":"Organization","name":"MindSnap","url":"{{ config('app.url') }}"}}
</script>
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"BreadcrumbList","itemListElement":[{"@type":"ListItem","position":1,"name":"Home","item":"{{ config('app.url') }}"},{"@type":"ListItem","position":2,"name":"Brain Games","item":"{{ config('app.url') }}/games"},{"@type":"ListItem","position":3,"name":"Typing Speed Test"}]}
</script>
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"FAQPage","mainEntity":[{"@type":"Question","name":"What is a good typing speed in WPM?","acceptedAnswer":{"@type":"Answer","text":"A good typing speed for most people is 40–60 WPM. Professional typists average 65–75 WPM, while top performers can exceed 100 WPM. The average office worker types around 40 WPM."}},{"@type":"Question","name":"How is WPM calculated?","acceptedAnswer":{"@type":"Answer","text":"WPM (words per minute) is calculated as the number of correctly typed characters divided by 5 (standard word length), then divided by the elapsed time in minutes. Only correct characters count toward your WPM score."}},{"@type":"Question","name":"What does accuracy percentage mean?","acceptedAnswer":{"@type":"Answer","text":"Accuracy percentage is the ratio of correctly typed characters to total characters you typed, expressed as a percentage. A score above 95% is considered excellent typing accuracy."}},{"@type":"Question","name":"What is a consistency score?","acceptedAnswer":{"@type":"Answer","text":"Consistency score measures how steady your typing speed is throughout the test. It's calculated from the standard deviation of your WPM sampled every 5 seconds. A lower deviation means more consistent typing."}},{"@type":"Question","name":"How can I improve my typing speed?","acceptedAnswer":{"@type":"Answer","text":"Practice daily for 15–20 minutes, focus on accuracy before speed, use all 10 fingers with proper home-row technique, and choose text in your domain (e.g., programming code if you're a developer)."}},{"@type":"Question","name":"What is the average typing speed by profession?","acceptedAnswer":{"@type":"Answer","text":"Average typist: 40 WPM. Administrative professional: 60 WPM. Software developer: 65 WPM. Medical transcriptionist: 70 WPM. Court reporter (stenographer): 225 WPM."}},{"@type":"Question","name":"Does typing on a phone count?","acceptedAnswer":{"@type":"Answer","text":"This test is optimized for keyboard typing. Mobile touchscreen typing typically averages 35–40 WPM compared to 55+ WPM on a physical keyboard, so results may differ."}},{"@type":"Question","name":"What timer length should I choose?","acceptedAnswer":{"@type":"Answer","text":"30 seconds gives a quick snapshot suitable for beginners. 60 seconds is the standard benchmark used by most typing speed records. Custom timers let you practice for longer sessions to build endurance."}}]}
</script>
@endsection

@php
$faqs = [
    ['q'=>'What is a good typing speed in WPM?','a'=>'A good typing speed for most people is 40–60 WPM. Professional typists average 65–75 WPM, while top performers can exceed 100 WPM. The average office worker types around 40 WPM.'],
    ['q'=>'How is WPM calculated?','a'=>'WPM is calculated as the number of correctly typed characters divided by 5 (standard word length), then divided by elapsed time in minutes. Only correct characters count toward your WPM score.'],
    ['q'=>'What does accuracy percentage mean?','a'=>'Accuracy percentage is the ratio of correctly typed characters to total characters you typed. A score above 95% is considered excellent typing accuracy.'],
    ['q'=>'What is a consistency score?','a'=>'Consistency score measures how steady your typing speed is throughout the test. It\'s calculated from the standard deviation of your WPM sampled every 5 seconds. A lower deviation means more consistent typing.'],
    ['q'=>'How can I improve my typing speed?','a'=>'Practice daily for 15–20 minutes, focus on accuracy before speed, use all 10 fingers with proper home-row technique, and choose text in your domain (e.g., programming code if you\'re a developer).'],
    ['q'=>'What is the average typing speed by profession?','a'=>'Average typist: 40 WPM. Administrative professional: 60 WPM. Software developer: 65 WPM. Medical transcriptionist: 70 WPM. Court reporter (stenographer): 225 WPM.'],
    ['q'=>'Does typing on a phone count?','a'=>'This test is optimized for keyboard typing. Mobile touchscreen typing typically averages 35–40 WPM compared to 55+ WPM on a physical keyboard, so results may differ.'],
    ['q'=>'What timer length should I choose?','a'=>'30 seconds gives a quick snapshot suitable for beginners. 60 seconds is the standard benchmark used by most typing speed records. Custom timers let you practice for longer sessions to build endurance.'],
];
$relatedTools = [
    ['icon'=>'🧠','name'=>'Memory Test','slug'=>'memory-test','desc'=>'Test your short-term memory with pattern grids and sequences.'],
    ['icon'=>'⚡','name'=>'Reaction Time Test','slug'=>'reaction-time-test','desc'=>'Measure your visual and keyboard reaction speed.'],
    ['icon'=>'🔤','name'=>'Word Scramble','slug'=>'word-scramble','desc'=>'Unscramble words against the clock across 6 categories.'],
    ['icon'=>'👁️','name'=>'Colour Blind Test','slug'=>'color-blind-test','desc'=>'Screen for colour vision deficiencies with 10 Ishihara-style plates.'],
];
@endphp

@section('content')

{{-- Hero --}}
<section class="ms-hero">
  <div class="container-xl">
    <div class="row align-items-start g-5">
      <div class="col-lg-8">
        <x-breadcrumb :crumbs="[['url'=>route('home'),'name'=>'Home'],['url'=>route('category.games'),'name'=>'Brain Games'],['url'=>'','name'=>'Typing Speed Test']]"/>
        <h1 class="mb-2 ms-hero-title">⌨️ Typing Speed Test</h1>
        <p class="ms-hero-desc">Measure your WPM, accuracy, and consistency in real time. Choose your text category and timer — results in seconds.</p>

        {{-- Tool Card --}}
        <div class="card border-0 shadow-sm rounded-4 p-4 mt-3" id="typingCard">

          {{-- Controls --}}
          <div class="d-flex flex-wrap gap-2 mb-3 align-items-center">
            <div class="btn-group" role="group" aria-label="Text category">
              <input type="radio" class="btn-check" name="txtCat" id="catGeneral" value="general" checked>
              <label class="btn btn-outline-primary btn-sm" for="catGeneral">General</label>
              <input type="radio" class="btn-check" name="txtCat" id="catCode" value="code">
              <label class="btn btn-outline-primary btn-sm" for="catCode">Code</label>
              <input type="radio" class="btn-check" name="txtCat" id="catLit" value="literature">
              <label class="btn btn-outline-primary btn-sm" for="catLit">Literature</label>
              <input type="radio" class="btn-check" name="txtCat" id="catNews" value="news">
              <label class="btn btn-outline-primary btn-sm" for="catNews">News</label>
            </div>
            <div class="btn-group ms-auto" role="group" aria-label="Timer">
              <input type="radio" class="btn-check" name="timerOpt" id="t30" value="30" checked>
              <label class="btn btn-outline-secondary btn-sm" for="t30">30s</label>
              <input type="radio" class="btn-check" name="timerOpt" id="t60" value="60">
              <label class="btn btn-outline-secondary btn-sm" for="t60">60s</label>
              <input type="radio" class="btn-check" name="timerOpt" id="tCustom" value="custom">
              <label class="btn btn-outline-secondary btn-sm" for="tCustom">Custom</label>
            </div>
            <input type="number" id="customTime" class="form-control form-control-sm d-none ts-custom-time" min="10" max="300" placeholder="sec">
          </div>

          {{-- Live stats bar --}}
          <div class="d-flex gap-4 mb-3" id="liveStats">
            <div class="text-center">
              <div class="fs-3 fw-bold text-primary" id="statWpm">0</div>
              <div class="small text-muted">WPM</div>
            </div>
            <div class="text-center">
              <div class="fs-3 fw-bold text-success" id="statAcc">100%</div>
              <div class="small text-muted">Accuracy</div>
            </div>
            <div class="text-center">
              <div class="fs-3 fw-bold text-warning" id="statConsist">—</div>
              <div class="small text-muted">Consistency</div>
            </div>
            <div class="text-center ms-auto">
              <div class="fs-3 fw-bold" id="statTimer">30</div>
              <div class="small text-muted">Seconds</div>
            </div>
          </div>

          {{-- Text display --}}
          <div id="textDisplay" class="font-monospace p-3 rounded-3 bg-light mb-3 lh-lg ts-text-display" tabindex="0" aria-label="Typing text display"></div>

          {{-- Hidden input to capture keystrokes --}}
          <input type="text" id="typingInput" class="form-control font-monospace" placeholder="Click on the text above or start typing here…" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">

          {{-- Action buttons --}}
          <div class="d-flex gap-2 mt-3">
            <button class="btn btn-primary" id="btnStart">Start Test</button>
            <button class="btn btn-outline-secondary" id="btnRestart">↺ Restart</button>
          </div>

          {{-- Results panel --}}
          <div id="resultsPanel" class="d-none mt-4">
            <hr>
            <h5 class="fw-bold mb-3">Your Results</h5>
            <div class="row g-3 mb-3">
              <div class="col-6 col-md-3">
                <div class="card border-0 bg-primary bg-opacity-10 text-center p-3 rounded-3">
                  <div class="fs-2 fw-bold text-primary" id="resWpm">—</div>
                  <div class="small">WPM</div>
                </div>
              </div>
              <div class="col-6 col-md-3">
                <div class="card border-0 bg-success bg-opacity-10 text-center p-3 rounded-3">
                  <div class="fs-2 fw-bold text-success" id="resAcc">—</div>
                  <div class="small">Accuracy</div>
                </div>
              </div>
              <div class="col-6 col-md-3">
                <div class="card border-0 bg-warning bg-opacity-10 text-center p-3 rounded-3">
                  <div class="fs-2 fw-bold text-warning" id="resConsist">—</div>
                  <div class="small">Consistency</div>
                </div>
              </div>
              <div class="col-6 col-md-3">
                <div class="card border-0 bg-danger bg-opacity-10 text-center p-3 rounded-3">
                  <div class="fs-2 fw-bold text-danger" id="resErrors">—</div>
                  <div class="small">Errors</div>
                </div>
              </div>
            </div>

            {{-- Percentile comparison --}}
            <div class="mb-3">
              <div class="d-flex justify-content-between small mb-1">
                <span>You vs. average typists</span>
                <span id="percentileLabel" class="fw-semibold"></span>
              </div>
              <div class="progress ts-progress">
                <div class="progress-bar bg-primary" id="percentileBar"></div>
              </div>
            </div>

            {{-- Profession benchmarks --}}
            <div class="card border-0 bg-light rounded-3 p-3">
              <div class="small fw-semibold mb-2">Profession Benchmarks</div>
              <div class="d-flex flex-wrap gap-2">
                <span class="badge bg-secondary">Average typist: 40 WPM</span>
                <span class="badge bg-primary">Admin professional: 60 WPM</span>
                <span class="badge bg-success">Developer: 65 WPM</span>
                <span class="badge bg-warning text-dark">Court reporter: 225 WPM</span>
              </div>
              <div id="benchmarkMsg" class="small text-muted mt-2"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 d-none d-lg-block">
        <div class="card border-0 bg-primary bg-opacity-10 rounded-4 p-4 text-center">
          <div class="fs-1">⌨️</div>
          <div class="fw-bold mt-2 mb-1">World Record</div>
          <div class="fs-1 fw-bold text-primary">212</div>
          <div class="small text-muted">WPM — Barbara Blackburn (2005)</div>
          <hr>
          <div class="small text-start text-muted">
            <div class="mb-1"><span class="badge bg-danger">Below avg</span> &lt; 40 WPM</div>
            <div class="mb-1"><span class="badge bg-warning text-dark">Average</span> 40–60 WPM</div>
            <div class="mb-1"><span class="badge bg-success">Above avg</span> 60–80 WPM</div>
            <div><span class="badge bg-primary">Pro</span> 80+ WPM</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- SEO Section 1 --}}
<section class="ms-section-white">
  <div class="container-xl ts-seo-section">
    <h2 class="fw-bold mb-3">How to Improve Your Typing Speed Fast</h2>
    <p>Most people plateau at their current typing speed because they keep reinforcing bad habits. The key to breaking through is deliberate practice — slow down, focus on accuracy first, and let speed come naturally over time. Studies show that typists who prioritize accuracy above 98% during practice sessions improve their WPM 3× faster than those who just type as quickly as possible.</p>
    <p>Use the text category selector above to practice in your domain. Software developers benefit most from the Code category, which includes real syntax like function declarations, loops, and conditional statements. Writers and students improve fastest with Literature quotes. If you're training for an office job, News Articles mirror the kind of text you'll encounter daily.</p>

    <h2 class="fw-bold mb-3 mt-4">Understanding WPM, Accuracy, and Consistency Scores</h2>
    <p>Your WPM score counts only correctly typed characters — each group of 5 characters counts as one "word." This is the industry-standard calculation used by competitive typists worldwide. Accuracy reflects how many of your total keystrokes were correct. A score below 90% means errors are slowing you down more than your raw speed helps; a score above 97% is considered professional-grade.</p>
    <p>The consistency score is unique to MindSnap's typing test. It measures the standard deviation of your WPM across every 5-second interval during the test. A highly consistent typist maintains a steady rhythm, which reduces errors and improves endurance. Top typists typically show consistency scores under 10 WPM standard deviation even during long tests.</p>

    <h2 class="fw-bold mb-3 mt-4">Typing Speed Benchmarks by Profession and Age</h2>
    <p>The average person types between 38 and 45 WPM. Administrative and clerical roles typically require a minimum of 60 WPM. Software developers, despite writing code all day, often type in the 55–70 WPM range because code typing involves more pauses for thinking. Medical transcriptionists aim for 70–80 WPM, while court reporters use stenotype machines to achieve 225 WPM or more.</p>
    <p>Age affects typing speed too. Teens and young adults (15–30) tend to score the highest on standardized tests, averaging 52 WPM. Adults aged 30–50 average around 44 WPM, and those over 50 average around 37 WPM. However, regular practice completely offsets age-related decline — many 60-year-old touch typists outperform 20-year-olds who hunt-and-peck.</p>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="typingFaq" />
<x-related-tools :tools="$relatedTools" heading="Related Tools" />

@endsection

@push('scripts')
<script>
(function(){
  const TEXTS = {
    general: [
      "The quick brown fox jumps over the lazy dog. Pack my box with five dozen liquor jugs. How vexingly quick daft zebras jump! The five boxing wizards jump quickly. Sphinx of black quartz, judge my vow.",
      "Technology has transformed the way we communicate, work, and learn. From smartphones to artificial intelligence, innovation continues to reshape society at an unprecedented pace. Adaptability and curiosity are the most valuable skills anyone can develop in the modern world."
    ],
    code: [
      "function calculateWPM(correctChars, elapsedMs) { const minutes = elapsedMs / 60000; return Math.round((correctChars / 5) / minutes); } const accuracy = (correct / total * 100).toFixed(1); console.log(`WPM: ${wpm}, Accuracy: ${accuracy}%`);",
      "const fetchData = async (url) => { try { const response = await fetch(url); if (!response.ok) throw new Error('Network error'); const data = await response.json(); return data; } catch (error) { console.error('Failed:', error.message); return null; } };"
    ],
    literature: [
      "It was the best of times, it was the worst of times, it was the age of wisdom, it was the age of foolishness, it was the epoch of belief, it was the epoch of incredulity, it was the season of Light, it was the season of Darkness.",
      "Call me Ishmael. Some years ago — never mind how long precisely — having little money in my purse, and nothing particular to interest me on shore, I thought I would sail about a little and see the watery part of the world."
    ],
    news: [
      "Scientists have discovered a new species of deep-sea creature living more than four kilometers below the surface of the Pacific Ocean. The organism, which resembles a translucent jellyfish, uses bioluminescence to attract prey in the pitch-black environment.",
      "Global temperatures reached a new record high last month, prompting renewed calls for international action on carbon emissions. Experts warn that without significant policy changes, average temperatures could rise by two degrees Celsius within the next thirty years."
    ]
  };

  let currentText = '';
  let charIndex = 0;
  let correctChars = 0;
  let totalTyped = 0;
  let errorCount = 0;
  let startTime = null;
  let timerInterval = null;
  let wpmInterval = null;
  let wpmSamples = [];
  let testDuration = 30;
  let timeLeft = 30;
  let testActive = false;
  let testFinished = false;

  const display = document.getElementById('textDisplay');
  const input   = document.getElementById('typingInput');
  const btnStart   = document.getElementById('btnStart');
  const btnRestart = document.getElementById('btnRestart');
  const statWpm    = document.getElementById('statWpm');
  const statAcc    = document.getElementById('statAcc');
  const statConsist= document.getElementById('statConsist');
  const statTimer  = document.getElementById('statTimer');
  const resultsPanel = document.getElementById('resultsPanel');
  const customTimeInput = document.getElementById('customTime');

  function getCategory() {
    return document.querySelector('input[name="txtCat"]:checked').value;
  }
  function getTimerValue() {
    const v = document.querySelector('input[name="timerOpt"]:checked').value;
    if (v === 'custom') {
      const cv = parseInt(customTimeInput.value) || 60;
      return Math.min(300, Math.max(10, cv));
    }
    return parseInt(v);
  }

  document.querySelector('input[value="custom"]').addEventListener('change', function(){
    customTimeInput.classList.remove('d-none');
  });
  ['t30','t60'].forEach(id => {
    document.getElementById(id).addEventListener('change', () => customTimeInput.classList.add('d-none'));
  });

  function pickText(cat) {
    const pool = TEXTS[cat];
    return pool[Math.floor(Math.random() * pool.length)];
  }

  function renderText() {
    let html = '';
    for (let i = 0; i < currentText.length; i++) {
      if (i < charIndex) {
        const ch = currentText[i];
        html += `<span class="${display.dataset['c'+i] === '1' ? 'text-success' : 'text-danger'}">${ch === ' ' ? '&nbsp;' : ch}</span>`;
      } else if (i === charIndex) {
        const ch = currentText[i];
        html += `<span class="bg-primary text-white rounded-1">${ch === ' ' ? '&nbsp;' : ch}</span>`;
      } else {
        html += `<span class="text-muted">${currentText[i] === ' ' ? '&nbsp;' : currentText[i]}</span>`;
      }
    }
    display.innerHTML = html;
  }

  function initTest() {
    testActive = false;
    testFinished = false;
    charIndex = 0;
    correctChars = 0;
    totalTyped = 0;
    errorCount = 0;
    startTime = null;
    wpmSamples = [];
    clearInterval(timerInterval);
    clearInterval(wpmInterval);

    testDuration = getTimerValue();
    timeLeft = testDuration;
    statTimer.textContent = timeLeft;
    statWpm.textContent = '0';
    statAcc.textContent = '100%';
    statConsist.textContent = '—';

    currentText = pickText(getCategory());
    for (let k in display.dataset) { delete display.dataset[k]; }
    renderText();
    resultsPanel.classList.add('d-none');
    input.value = '';
    input.disabled = false;
    input.focus();
  }

  function startTimer() {
    testActive = true;
    startTime = Date.now();
    timerInterval = setInterval(() => {
      timeLeft--;
      statTimer.textContent = timeLeft;
      if (timeLeft <= 0) { endTest(); }
    }, 1000);

    wpmInterval = setInterval(() => {
      if (!startTime) return;
      const elapsed = (Date.now() - startTime) / 60000;
      if (elapsed > 0) {
        wpmSamples.push(Math.round((correctChars / 5) / elapsed));
      }
    }, 5000);
  }

  function calcConsistency(samples) {
    if (samples.length < 2) return null;
    const mean = samples.reduce((a,b)=>a+b,0)/samples.length;
    const variance = samples.reduce((s,v)=>s+Math.pow(v-mean,2),0)/samples.length;
    return Math.sqrt(variance).toFixed(1);
  }

  function percentile(wpm) {
    const pct = Math.min(99, Math.max(1, Math.round(((wpm - 10) / 90) * 100)));
    return pct;
  }

  function endTest() {
    clearInterval(timerInterval);
    clearInterval(wpmInterval);
    testActive = false;
    testFinished = true;
    input.disabled = true;

    const elapsed = testDuration - timeLeft;
    const elapsedMin = Math.max(elapsed, 1) / 60;
    const wpm = Math.round((correctChars / 5) / elapsedMin);
    const acc = totalTyped > 0 ? ((correctChars / totalTyped) * 100).toFixed(1) : '100.0';
    const consist = calcConsistency(wpmSamples);

    document.getElementById('resWpm').textContent = wpm;
    document.getElementById('resAcc').textContent = acc + '%';
    document.getElementById('resConsist').textContent = consist ? consist + ' σ' : 'N/A';
    document.getElementById('resErrors').textContent = errorCount;

    const pct = percentile(wpm);
    document.getElementById('percentileBar').style.width = pct + '%';
    document.getElementById('percentileLabel').textContent = `Faster than ${pct}% of typists`;

    let msg = '';
    if (wpm >= 80) msg = 'You type at a professional level — faster than most office workers!';
    else if (wpm >= 60) msg = 'You match an administrative professional. Keep pushing toward 80 WPM!';
    else if (wpm >= 40) msg = 'You\'re at the average typist level. With practice you can reach 60 WPM.';
    else msg = 'Keep practicing! Focus on accuracy first, then speed will follow naturally.';
    document.getElementById('benchmarkMsg').textContent = msg;

    statWpm.textContent = wpm;
    statAcc.textContent = acc + '%';
    statConsist.textContent = consist ? consist + ' σ' : 'N/A';
    resultsPanel.classList.remove('d-none');
  }

  input.addEventListener('input', function(e) {
    if (testFinished) return;
    if (!testActive && input.value.length > 0) startTimer();

    const typed = input.value;
    const lastChar = typed[typed.length - 1];
    if (!lastChar) return;

    totalTyped++;
    const expected = currentText[charIndex];
    if (lastChar === expected) {
      correctChars++;
      display.dataset['c' + charIndex] = '1';
    } else {
      errorCount++;
      display.dataset['c' + charIndex] = '0';
    }
    charIndex++;
    input.value = '';

    if (startTime) {
      const elapsed = (Date.now() - startTime) / 60000;
      if (elapsed > 0) {
        statWpm.textContent = Math.round((correctChars / 5) / elapsed);
        const acc = ((correctChars / totalTyped) * 100).toFixed(1);
        statAcc.textContent = acc + '%';
      }
    }

    if (charIndex >= currentText.length) { endTest(); return; }
    renderText();
  });

  display.addEventListener('click', () => input.focus());

  btnStart.addEventListener('click', initTest);
  btnRestart.addEventListener('click', initTest);

  initTest();
})();
</script>
@endpush
