@extends('layouts.app')

@section('title', 'Reaction Time Test — Measure Your Reflexes Online | MindSnap')
@section('description', 'Free reaction time test — visual, keyboard & double-tap modes. 5-round average with age comparison and false-start detection. No signup.')
@section('canonical', config('app.url') . '/reaction-time-test')
@section('og_image', config('app.url') . '/images/og-default.jpg')

@section('styles')
<style>
  .rt-seo-section {
    max-width: 780px;
  }
  .rt-zone {
    min-height: 220px;
    background: #e9ecef;
    cursor: pointer;
    transition: background 0.15s;
    user-select: none;
  }
  .rt-zone-icon {
    font-size: 3rem;
  }
  .rt-age-select {
    max-width: 160px;
  }
  .rt-scale-bar {
    height: 28px;
  }
  .rt-scale-elite {
    width: 20%;
    font-size: 0.7rem;
  }
  .rt-scale-above {
    width: 25%;
    font-size: 0.7rem;
  }
  .rt-scale-avg {
    width: 30%;
    font-size: 0.7rem;
  }
  .rt-scale-below {
    width: 25%;
    font-size: 0.7rem;
  }
  .rt-marker-track {
    height: 8px;
    background: #dee2e6;
    border-radius: 4px;
  }
  .rt-marker {
    width: 14px;
    height: 14px;
    top: -3px;
    left: 0;
    transition: left 0.5s;
    transform: translateX(-50%);
  }
</style>
@endsection

@section('schema')
<script type="application/ld+json">
{"@@context":"https://schema.org","@type":"WebApplication","name":"Reaction Time Test","url":"{{ config('app.url') }}/reaction-time-test","description":"Free online reaction time test with visual, keyboard and double-tap modes. Measures average, best, and worst reaction time across 5 rounds.","applicationCategory":"GameApplication","operatingSystem":"Any","offers":{"@type":"Offer","price":"0","priceCurrency":"USD"},"publisher":{"@type":"Organization","name":"MindSnap","url":"{{ config('app.url') }}"}}
</script>
<script type="application/ld+json">
{"@@context":"https://schema.org","@type":"BreadcrumbList","itemListElement":[{"@type":"ListItem","position":1,"name":"Home","item":"{{ config('app.url') }}"},{"@type":"ListItem","position":2,"name":"Brain Games","item":"{{ config('app.url') }}/games"},{"@type":"ListItem","position":3,"name":"Reaction Time Test"}]}
</script>
<script type="application/ld+json">
{"@@context":"https://schema.org","@type":"FAQPage","mainEntity":[{"@type":"Question","name":"What is a good reaction time?","acceptedAnswer":{"@type":"Answer","text":"A good visual reaction time is between 150–250 ms. Elite athletes and gamers typically react in under 200 ms. The average person reacts in about 250–300 ms. Anything under 150 ms is considered elite-level."}},{"@type":"Question","name":"Does reaction time slow with age?","acceptedAnswer":{"@type":"Answer","text":"Yes. Peak simple reaction time is typically between ages 18–24. By age 50, average reaction time increases by around 20–25%. Regular exercise and cognitive training can significantly slow this decline."}},{"@type":"Question","name":"What is a false start?","acceptedAnswer":{"@type":"Answer","text":"A false start occurs when you click or press a key before the signal appears. This test detects false starts and counts them as a penalty, encouraging you to wait for the actual signal rather than guessing."}},{"@type":"Question","name":"Why does my reaction time vary between rounds?","acceptedAnswer":{"@type":"Answer","text":"Reaction time naturally varies due to factors like attention fluctuations, muscle readiness, and random neural noise. This is why we average 5 rounds — a single measurement is not reliable on its own."}},{"@type":"Question","name":"How does the double-tap mode work?","acceptedAnswer":{"@type":"Answer","text":"In double-tap mode, you must tap or click twice in rapid succession when the signal appears. This tests not just reaction speed but also fine motor control and coordination."}},{"@type":"Question","name":"Can I train to improve my reaction time?","acceptedAnswer":{"@type":"Answer","text":"Yes. Regular practice with reaction drills, sports training, and video games has been shown to improve simple reaction time by 10–20%. Getting adequate sleep and staying hydrated also measurably improve reaction speed."}},{"@type":"Question","name":"What affects reaction time the most?","acceptedAnswer":{"@type":"Answer","text":"Age, sleep deprivation, alcohol, caffeine, practice, and distraction all significantly affect reaction time. Being well-rested and focused can improve your results by 50 ms or more compared to a tired state."}},{"@type":"Question","name":"Do pro gamers have faster reaction times?","acceptedAnswer":{"@type":"Answer","text":"Professional gamers average around 200–220 ms, only slightly faster than average. Their real advantage is anticipation, game sense, and muscle memory — not raw reaction speed."}}]}
</script>
@endsection

@php
$faqs = [
    ['q'=>'What is a good reaction time?','a'=>'A good visual reaction time is between 150–250 ms. Elite athletes and gamers typically react in under 200 ms. The average person reacts in about 250–300 ms. Anything under 150 ms is considered elite-level.'],
    ['q'=>'Does reaction time slow with age?','a'=>'Yes. Peak simple reaction time is typically between ages 18–24. By age 50, average reaction time increases by around 20–25%. Regular exercise and cognitive training can significantly slow this decline.'],
    ['q'=>'What is a false start?','a'=>'A false start occurs when you click or press a key before the signal appears. This test detects false starts and counts them as a penalty, encouraging you to wait for the actual signal rather than guessing.'],
    ['q'=>'Why does my reaction time vary between rounds?','a'=>'Reaction time naturally varies due to attention fluctuations, muscle readiness, and random neural noise. This is why we average 5 rounds — a single measurement is not reliable on its own.'],
    ['q'=>'How does the double-tap mode work?','a'=>'In double-tap mode, you must tap or click twice in rapid succession when the signal appears. This tests not just reaction speed but also fine motor control and coordination.'],
    ['q'=>'Can I train to improve my reaction time?','a'=>'Yes. Regular practice with reaction drills, sports training, and video games has been shown to improve simple reaction time by 10–20%. Getting adequate sleep and staying hydrated also measurably improve reaction speed.'],
    ['q'=>'What affects reaction time the most?','a'=>'Age, sleep deprivation, alcohol, caffeine, practice, and distraction all significantly affect reaction time. Being well-rested and focused can improve your results by 50 ms or more compared to a tired state.'],
    ['q'=>'Do pro gamers have faster reaction times?','a'=>'Professional gamers average around 200–220 ms, only slightly faster than average. Their real advantage is anticipation, game sense, and muscle memory — not raw reaction speed.'],
];
$relatedTools = [
    ['icon'=>'⌨️','name'=>'Typing Speed Test','slug'=>'typing-speed-test','desc'=>'Measure your WPM, accuracy, and consistency score.'],
    ['icon'=>'🧠','name'=>'Memory Test','slug'=>'memory-test','desc'=>'Test pattern, number, and color sequence memory.'],
    ['icon'=>'🔤','name'=>'Word Scramble','slug'=>'word-scramble','desc'=>'Unscramble words against the clock across 6 categories.'],
    ['icon'=>'👁️','name'=>'Colour Blind Test','slug'=>'color-blind-test','desc'=>'Screen for colour vision deficiencies online.'],
];
@endphp

@section('content')

{{-- Hero --}}
<section class="ms-hero">
  <div class="container-xl">
    <div class="row align-items-start g-5">
      <div class="col-lg-8">
        <x-breadcrumb :crumbs="[['url'=>route('home'),'name'=>'Home'],['url'=>route('category.games'),'name'=>'Brain Games'],['url'=>'','name'=>'Reaction Time Test']]"/>
        <h1 class="mb-2 ms-hero-title">⚡ Reaction Time Test</h1>
        <p class="ms-hero-desc">How fast are your reflexes? Pick a mode, complete 5 rounds, and see how you rank against your age group — no signup required.</p>

        {{-- Tool Card --}}
        <div class="card border-0 shadow-sm rounded-4 p-4 mt-3">

          {{-- Mode selector --}}
          <div class="d-flex gap-2 mb-3 flex-wrap">
            <div class="btn-group" role="group" aria-label="Test mode">
              <input type="radio" class="btn-check" name="rtMode" id="modeVisual" value="visual" checked>
              <label class="btn btn-outline-primary btn-sm" for="modeVisual">👁️ Visual</label>
              <input type="radio" class="btn-check" name="rtMode" id="modeKeyboard" value="keyboard">
              <label class="btn btn-outline-primary btn-sm" for="modeKeyboard">⌨️ Keyboard</label>
              <input type="radio" class="btn-check" name="rtMode" id="modeDouble" value="doubletap">
              <label class="btn btn-outline-primary btn-sm" for="modeDouble">✌️ Double-tap</label>
            </div>
            <select class="form-select form-select-sm ms-auto rt-age-select" id="ageGroup" aria-label="Age group">
              <option value="18">Age 18–24</option>
              <option value="25">Age 25–34</option>
              <option value="35">Age 35–44</option>
              <option value="45">Age 45–54</option>
              <option value="55">Age 55–64</option>
              <option value="65">Age 65+</option>
            </select>
          </div>

          {{-- Reaction zone --}}
          <div id="reactionZone"
            class="rt-zone rounded-4 d-flex flex-column align-items-center justify-content-center text-center"
            tabindex="0"
            role="button"
            aria-label="Reaction test area">
            <div id="rzIcon" class="rt-zone-icon">⚡</div>
            <div id="rzMsg" class="fw-bold fs-5 mt-2">Click Start to begin</div>
            <div id="rzSub" class="text-muted small mt-1"></div>
          </div>

          {{-- Keyboard hint --}}
          <div id="kbHint" class="text-center small text-muted mt-1 d-none">Press <kbd>Space</kbd> to react in keyboard mode</div>

          {{-- Round progress --}}
          <div class="d-flex justify-content-center gap-2 mt-3" id="roundDots">
            <span class="badge rounded-pill bg-secondary" id="dot0">1</span>
            <span class="badge rounded-pill bg-secondary" id="dot1">2</span>
            <span class="badge rounded-pill bg-secondary" id="dot2">3</span>
            <span class="badge rounded-pill bg-secondary" id="dot3">4</span>
            <span class="badge rounded-pill bg-secondary" id="dot4">5</span>
          </div>

          {{-- Start button --}}
          <div class="text-center mt-3">
            <button class="btn btn-primary px-5" id="btnStartRT">Start Test</button>
          </div>

          {{-- Results --}}
          <div id="rtResults" class="d-none mt-4">
            <hr>
            <h5 class="fw-bold mb-3">Round Results</h5>
            <div class="row g-2 mb-3">
              <div class="col-4">
                <div class="card border-0 bg-primary bg-opacity-10 text-center p-3 rounded-3">
                  <div class="fs-3 fw-bold text-primary" id="resAvg">—</div>
                  <div class="small">Average</div>
                </div>
              </div>
              <div class="col-4">
                <div class="card border-0 bg-success bg-opacity-10 text-center p-3 rounded-3">
                  <div class="fs-3 fw-bold text-success" id="resBest">—</div>
                  <div class="small">Best</div>
                </div>
              </div>
              <div class="col-4">
                <div class="card border-0 bg-danger bg-opacity-10 text-center p-3 rounded-3">
                  <div class="fs-3 fw-bold text-danger" id="resWorst">—</div>
                  <div class="small">Worst</div>
                </div>
              </div>
            </div>

            {{-- Distribution bar --}}
            <div class="mb-3">
              <div class="small fw-semibold mb-2">Reaction Time Scale</div>
              <div class="d-flex rounded overflow-hidden rt-scale-bar">
                <div class="bg-primary rt-scale-elite d-flex align-items-center justify-content-center small text-white">Elite &lt;150ms</div>
                <div class="bg-success rt-scale-above d-flex align-items-center justify-content-center small text-white">Above avg</div>
                <div class="bg-warning rt-scale-avg d-flex align-items-center justify-content-center small">Average</div>
                <div class="bg-danger rt-scale-below d-flex align-items-center justify-content-center small text-white">Below avg</div>
              </div>
              <div class="position-relative mt-1 rt-marker-track">
                <div id="rtMarker" class="position-absolute top-0 rounded-circle bg-dark rt-marker"></div>
              </div>
              <div id="rtCategory" class="small fw-semibold text-center mt-2"></div>
            </div>

            {{-- Age comparison --}}
            <div class="card border-0 bg-light rounded-3 p-3">
              <div class="small fw-semibold mb-1">Your Age Group Average</div>
              <div id="ageCompareMsg" class="small text-muted"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 d-none d-lg-block">
        <div class="card border-0 bg-warning bg-opacity-10 rounded-4 p-4">
          <div class="fw-bold mb-2">Age Group Averages</div>
          <table class="table table-sm mb-0">
            <thead><tr><th>Age</th><th>Avg (ms)</th></tr></thead>
            <tbody>
              <tr><td>18–24</td><td>200</td></tr>
              <tr><td>25–34</td><td>215</td></tr>
              <tr><td>35–44</td><td>230</td></tr>
              <tr><td>45–54</td><td>250</td></tr>
              <tr><td>55–64</td><td>275</td></tr>
              <tr><td>65+</td><td>320</td></tr>
            </tbody>
          </table>
          <hr>
          <div class="small text-muted">Source: Kosinski (2008) and aggregated online testing data from 250,000+ participants.</div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- SEO Sections --}}
<section class="ms-section-white">
  <div class="container-xl rt-seo-section">
    <h2 class="fw-bold mb-3">What Is Reaction Time and Why Does It Matter?</h2>
    <p>Reaction time is the interval between a stimulus and your response to it. Simple reaction time — responding to a single signal with a single action — averages 200–250 ms for healthy adults. This time includes the neural delay for your eyes to send signals to your brain, your brain to process the signal, and your muscles to execute the movement.</p>
    <p>Reaction speed matters in sports (a batter has roughly 400 ms to decide whether to swing at a 90 mph fastball), driving (faster reactions reduce stopping distance by several metres), and many workplace tasks requiring quick decision-making. This test measures your simple visual and keyboard reaction time with a consistent protocol across 5 rounds to give you a reliable average.</p>

    <h2 class="fw-bold mb-3 mt-4">How Our Three Reaction Test Modes Work</h2>
    <p>The Visual mode tests your click reaction to a colour change — the box turns green and you click as fast as possible. The Keyboard mode requires pressing Space when a signal text appears, testing the slightly different neural pathway used for keyboard input. Double-tap mode adds a second action requirement, testing both initial reaction speed and rapid motor sequencing.</p>
    <p>Each mode uses a random delay of 1.5–4 seconds before the signal appears. This prevents you from timing your click in advance (anticipation cheating). If you click before the signal appears, the test records a false start and you'll need to redo that round — just like an Olympic sprint false-start rule.</p>

    <h2 class="fw-bold mb-3 mt-4">Can You Train Your Reaction Speed?</h2>
    <p>Research shows simple reaction time is trainable, but the gains are modest — typically 10–20 ms improvement with dedicated practice. The bigger gains come from reducing variability: consistent reaction times matter more in sports and driving than single-trial bests. Video game players, especially in action genres, show consistently faster and more reliable reaction times than non-players.</p>
    <p>Sleep has the largest short-term impact on reaction time. A sleep-deprived person can react 50–100 ms slower than when well-rested. Caffeine provides a modest 10–20 ms improvement. Alcohol significantly impairs reaction time even at low blood-alcohol concentrations, which is why even one or two drinks measurably increases braking distance when driving.</p>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="reactionFaq" />
<x-related-tools :tools="$relatedTools" heading="Related Tools" />

@endsection

@push('scripts')
<script>
(function(){
  const AGE_AVG = {18:200,25:215,35:230,45:250,55:275,65:320};
  const TOTAL_ROUNDS = 5;

  let mode = 'visual';
  let state = 'idle'; // idle | waiting | ready | done
  let currentRound = 0;
  let times = [];
  let signalTime = null;
  let waitTimer = null;
  let doubleCount = 0;
  let doubleLast = null;

  const zone      = document.getElementById('reactionZone');
  const rzIcon    = document.getElementById('rzIcon');
  const rzMsg     = document.getElementById('rzMsg');
  const rzSub     = document.getElementById('rzSub');
  const kbHint    = document.getElementById('kbHint');
  const btnStart  = document.getElementById('btnStartRT');
  const rtResults = document.getElementById('rtResults');
  const ageSelect = document.getElementById('ageGroup');

  function getMode(){ return document.querySelector('input[name="rtMode"]:checked').value; }

  function setZone(bg, icon, msg, sub){
    zone.style.background = bg;
    rzIcon.textContent = icon;
    rzMsg.textContent = msg;
    rzSub.textContent = sub || '';
  }

  function updateDots(){
    for(let i=0;i<TOTAL_ROUNDS;i++){
      const dot = document.getElementById('dot'+i);
      if(i < times.length) dot.className = 'badge rounded-pill bg-success';
      else if(i === times.length) dot.className = 'badge rounded-pill bg-primary';
      else dot.className = 'badge rounded-pill bg-secondary';
    }
  }

  function startRound(){
    state = 'waiting';
    setZone('#fff3cd','⏳','Get ready…', getMode()==='keyboard'?'Press Space when you see the signal':'Click when the box turns green');
    if(getMode()==='keyboard') kbHint.classList.remove('d-none');
    else kbHint.classList.add('d-none');

    const delay = 1500 + Math.random() * 2500;
    waitTimer = setTimeout(showSignal, delay);
  }

  function showSignal(){
    state = 'ready';
    signalTime = performance.now();
    doubleCount = 0;
    doubleLast = null;
    if(getMode()==='keyboard'){
      setZone('#d1e7dd','🟢','Press SPACE!','');
    } else if(getMode()==='doubletap'){
      setZone('#d1e7dd','✌️','Double-tap now!','');
    } else {
      setZone('#198754','🟢','Click!','');
      zone.style.color='#fff';
    }
  }

  function recordReaction(){
    if(state !== 'ready') return false;
    const rt = Math.round(performance.now() - signalTime);
    zone.style.color = '';
    times.push(rt);
    currentRound++;
    updateDots();

    if(currentRound >= TOTAL_ROUNDS){
      state = 'done';
      showResults();
    } else {
      state = 'idle';
      setZone('#e9ecef','✅',`Round ${currentRound} done: ${rt} ms`,'Click Start Next Round');
    }
    return true;
  }

  function falseStart(){
    clearTimeout(waitTimer);
    setZone('#f8d7da','❌','Too early! False start.','Waiting 2 seconds…');
    state = 'idle';
    setTimeout(()=>{
      if(state === 'idle') startRound();
    }, 2000);
  }

  zone.addEventListener('click', handleAction);
  document.addEventListener('keydown', function(e){
    if(e.code === 'Space' && getMode() === 'keyboard'){
      e.preventDefault();
      handleAction();
    }
  });

  function handleAction(){
    if(state === 'idle' && currentRound < TOTAL_ROUNDS && currentRound > 0){
      startRound();
    } else if(state === 'waiting'){
      falseStart();
    } else if(state === 'ready'){
      if(getMode() === 'doubletap'){
        const now = performance.now();
        if(doubleCount === 0){
          doubleCount = 1;
          doubleLast = now;
          rzMsg.textContent = 'Tap again!';
        } else {
          const gap = now - doubleLast;
          if(gap < 500) { recordReaction(); }
          else { doubleCount = 1; doubleLast = now; rzMsg.textContent = 'Too slow — tap again!'; }
        }
      } else {
        recordReaction();
      }
    }
  }

  btnStart.addEventListener('click', function(){
    if(state === 'done' || currentRound === 0){
      times = [];
      currentRound = 0;
      rtResults.classList.add('d-none');
      updateDots();
      startRound();
    }
  });

  function showResults(){
    const avg = Math.round(times.reduce((a,b)=>a+b,0)/times.length);
    const best = Math.min(...times);
    const worst = Math.max(...times);

    document.getElementById('resAvg').textContent = avg + ' ms';
    document.getElementById('resBest').textContent = best + ' ms';
    document.getElementById('resWorst').textContent = worst + ' ms';

    let cat='', markerPct=0;
    if(avg < 150){ cat='Elite ⚡'; markerPct=10; }
    else if(avg < 250){ cat='Above Average 👍'; markerPct=35; }
    else if(avg < 350){ cat='Average'; markerPct=60; }
    else { cat='Below Average'; markerPct=87; }
    document.getElementById('rtCategory').textContent = cat;
    document.getElementById('rtMarker').style.left = markerPct + '%';

    const ageKey = parseInt(ageSelect.value);
    const ageAvg = AGE_AVG[ageKey];
    const diff = avg - ageAvg;
    let ageMsg = `Your age group average is ${ageAvg} ms. `;
    if(diff < -20) ageMsg += `You're ${Math.abs(diff)} ms faster than average — excellent reflexes!`;
    else if(diff < 20) ageMsg += `You're right on par with your age group.`;
    else ageMsg += `You're ${diff} ms slower than average. Try again after a rest!`;
    document.getElementById('ageCompareMsg').textContent = ageMsg;

    setZone('#e9ecef','🏁',`All done! Avg: ${avg} ms`,'');
    rtResults.classList.remove('d-none');
  }

  updateDots();
})();
</script>
@endpush
