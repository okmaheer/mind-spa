@extends('layouts.app')

@section('title', 'Memory Test — Short-Term Memory Test Online | MindSnap')
@section('description', 'Free memory test online — pattern grid, number sequence & Simon-style colour sequence. Level up and beat Miller\'s Law. No signup.')
@section('canonical', config('app.url') . '/memory-test')
@section('og_image', config('app.url') . '/images/og-default.jpg')

@section('styles')
<style>
  .mem-seo-section {
    max-width: 780px;
  }
  .mem-game-area {
    min-height: 220px;
  }
  .mem-grid-cell {
    width: 52px;
    height: 52px;
    background: #e9ecef;
    cursor: default;
    transition: background 0.15s;
  }
  .mem-grid-container {
    grid-template-columns: repeat(4, 1fr);
  }
  .mem-num-input {
    max-width: 320px;
    margin: 0 auto;
  }
  .mem-color-btn {
    width: 90px;
    height: 90px;
    border: none;
    opacity: 0.4;
  }
  .mem-color-red    { background: #dc3545; }
  .mem-color-green  { background: #198754; }
  .mem-color-blue   { background: #0d6efd; }
  .mem-color-yellow { background: #ffc107; }
</style>
@endsection

@section('schema')
<script type="application/ld+json">
{"@@context":"https://schema.org","@type":"WebApplication","name":"Memory Test","url":"{{ config('app.url') }}/memory-test","description":"Free short-term memory test with three modes: Pattern Grid, Number Sequence, and Colour Sequence. Tracks level progression and gives neuroscience benchmarks.","applicationCategory":"GameApplication","operatingSystem":"Any","offers":{"@type":"Offer","price":"0","priceCurrency":"USD"},"publisher":{"@type":"Organization","name":"MindSnap","url":"{{ config('app.url') }}"}}
</script>
<script type="application/ld+json">
{"@@context":"https://schema.org","@type":"BreadcrumbList","itemListElement":[{"@type":"ListItem","position":1,"name":"Home","item":"{{ config('app.url') }}"},{"@type":"ListItem","position":2,"name":"Brain Games","item":"{{ config('app.url') }}/games"},{"@type":"ListItem","position":3,"name":"Memory Test"}]}
</script>
<script type="application/ld+json">
{"@@context":"https://schema.org","@type":"FAQPage","mainEntity":[{"@type":"Question","name":"How many items can short-term memory hold?","acceptedAnswer":{"@type":"Answer","text":"According to Miller's Law (1956), short-term memory holds 7 plus or minus 2 items. Modern research by Cowan (2001) suggests the true capacity is closer to 4 chunks. This test helps you discover your personal limit."}},{"@type":"Question","name":"What is a pattern grid memory test?","acceptedAnswer":{"@type":"Answer","text":"A pattern grid test shows you highlighted cells on a 4×4 grid for a brief period, then asks you to recall which cells were highlighted. It tests spatial working memory, which is separate from verbal memory."}},{"@type":"Question","name":"What is the Simon Says colour memory game?","acceptedAnswer":{"@type":"Answer","text":"Simon Says is a classic electronic game where you must repeat a growing sequence of coloured lights and sounds. It tests sequential short-term memory and pattern recognition across multiple sensory channels."}},{"@type":"Question","name":"Can you improve short-term memory?","acceptedAnswer":{"@type":"Answer","text":"Yes. Techniques like chunking (grouping items), spaced repetition, and regular memory training have all been shown to expand effective working memory capacity. Regular sleep also has a major impact on memory consolidation."}},{"@type":"Question","name":"What does my memory test score mean?","acceptedAnswer":{"@type":"Answer","text":"Your score equals the level you reached multiplied by 10. Level 7 (70 points) corresponds to Miller's Law average. Reaching level 9 or above puts you in the top 15% of test-takers for short-term memory capacity."}},{"@type":"Question","name":"What is working memory?","acceptedAnswer":{"@type":"Answer","text":"Working memory is the system that temporarily holds and manipulates information for use in cognitive tasks. It's separate from long-term memory and is closely linked to intelligence, learning ability, and problem-solving performance."}},{"@type":"Question","name":"How many lives do I get?","acceptedAnswer":{"@type":"Answer","text":"You start with 3 lives. Each time you make a wrong selection, you lose one life. The game ends when all 3 lives are used up, showing you your final level and score."}},{"@type":"Question","name":"Does age affect memory test scores?","acceptedAnswer":{"@type":"Answer","text":"Working memory capacity peaks in early adulthood (around age 25) and gradually declines with age. However, strategies like chunking and rehearsal can compensate significantly for age-related changes in raw capacity."}}]}
</script>
@endsection

@php
$faqs = [
    ['q'=>'How many items can short-term memory hold?','a'=>'According to Miller\'s Law (1956), short-term memory holds 7 plus or minus 2 items. Modern research by Cowan (2001) suggests the true capacity is closer to 4 chunks. This test helps you discover your personal limit.'],
    ['q'=>'What is a pattern grid memory test?','a'=>'A pattern grid test shows you highlighted cells on a 4×4 grid for a brief period, then asks you to recall which cells were highlighted. It tests spatial working memory, which is separate from verbal memory.'],
    ['q'=>'What is the Simon Says colour memory game?','a'=>'Simon Says is a classic electronic game where you must repeat a growing sequence of coloured lights and sounds. It tests sequential short-term memory and pattern recognition across multiple sensory channels.'],
    ['q'=>'Can you improve short-term memory?','a'=>'Yes. Techniques like chunking, spaced repetition, and regular memory training have all been shown to expand effective working memory capacity. Regular sleep also has a major impact on memory consolidation.'],
    ['q'=>'What does my memory test score mean?','a'=>'Your score equals the level you reached multiplied by 10. Level 7 (70 points) corresponds to Miller\'s Law average. Reaching level 9 or above puts you in the top 15% of test-takers.'],
    ['q'=>'What is working memory?','a'=>'Working memory temporarily holds and manipulates information for use in cognitive tasks. It\'s closely linked to intelligence, learning ability, and problem-solving performance.'],
    ['q'=>'How many lives do I get?','a'=>'You start with 3 lives. Each wrong selection costs one life. The game ends when all 3 lives are used up.'],
    ['q'=>'Does age affect memory test scores?','a'=>'Working memory capacity peaks around age 25 and gradually declines. However, strategies like chunking and rehearsal can compensate significantly for age-related changes in raw capacity.'],
];
$relatedTools = [
    ['icon'=>'⌨️','name'=>'Typing Speed Test','slug'=>'typing-speed-test','desc'=>'Measure your WPM, accuracy, and consistency.'],
    ['icon'=>'⚡','name'=>'Reaction Time Test','slug'=>'reaction-time-test','desc'=>'Test your visual and keyboard reflex speed.'],
    ['icon'=>'🔤','name'=>'Word Scramble','slug'=>'word-scramble','desc'=>'Unscramble words against the clock.'],
    ['icon'=>'👁️','name'=>'Colour Blind Test','slug'=>'color-blind-test','desc'=>'Screen for colour vision deficiencies online.'],
];
@endphp

@section('content')

{{-- Hero --}}
<section class="ms-hero">
  <div class="container-xl">
    <div class="row align-items-start g-5">
      <div class="col-lg-8">
        <x-breadcrumb :crumbs="[['url'=>route('home'),'name'=>'Home'],['url'=>route('category.games'),'name'=>'Brain Games'],['url'=>'','name'=>'Memory Test']]"/>
        <h1 class="mb-2 ms-hero-title">🧠 Memory Test</h1>
        <p class="ms-hero-desc">Challenge your short-term memory with three modes: Pattern Grid, Number Sequence, and Colour Sequence. How far can you go?</p>

        {{-- Tool Card --}}
        <div class="card border-0 shadow-sm rounded-4 p-4 mt-3" id="memCard">

          {{-- Mode selector --}}
          <div class="d-flex gap-2 mb-3 flex-wrap align-items-center">
            <div class="btn-group" role="group" aria-label="Memory mode">
              <input type="radio" class="btn-check" name="memMode" id="modeGrid" value="grid" checked>
              <label class="btn btn-outline-primary btn-sm" for="modeGrid">🔲 Pattern Grid</label>
              <input type="radio" class="btn-check" name="memMode" id="modeNum" value="number">
              <label class="btn btn-outline-primary btn-sm" for="modeNum">🔢 Number Seq</label>
              <input type="radio" class="btn-check" name="memMode" id="modeColor" value="color">
              <label class="btn btn-outline-primary btn-sm" for="modeColor">🎨 Colour Seq</label>
            </div>
          </div>

          {{-- Status bar --}}
          <div class="d-flex gap-4 mb-3">
            <div class="text-center">
              <div class="fs-4 fw-bold text-primary" id="statLevel">1</div>
              <div class="small text-muted">Level</div>
            </div>
            <div class="text-center">
              <div class="fs-4 fw-bold text-success" id="statScore">0</div>
              <div class="small text-muted">Score</div>
            </div>
            <div class="text-center">
              <div class="fs-4 fw-bold text-danger" id="statLives">❤️❤️❤️</div>
              <div class="small text-muted">Lives</div>
            </div>
            <div class="ms-auto text-center">
              <div class="fs-5 fw-semibold text-muted" id="statPhase">—</div>
              <div class="small text-muted">Phase</div>
            </div>
          </div>

          {{-- Game area --}}
          <div id="gameArea" class="text-center mem-game-area">
            <div id="gridArea" class="d-none">
              <div id="gridContainer" class="d-inline-grid gap-2 mem-grid-container"></div>
            </div>
            <div id="numArea" class="d-none">
              <div id="numDisplay" class="display-4 fw-bold text-primary letter-spacing-wide py-4"></div>
              <div id="numInput" class="d-none">
                <input type="text" id="numAnswer" class="form-control form-control-lg text-center font-monospace mem-num-input" placeholder="Enter number sequence" autocomplete="off">
                <button class="btn btn-primary mt-2" id="btnNumSubmit">Submit</button>
              </div>
            </div>
            <div id="colorArea" class="d-none">
              <div class="d-flex flex-column align-items-center gap-3">
                <div class="d-flex gap-3">
                  <button class="color-btn rounded-3 mem-color-btn mem-color-red" id="cb-red" data-color="red"></button>
                  <button class="color-btn rounded-3 mem-color-btn mem-color-green" id="cb-green" data-color="green"></button>
                </div>
                <div class="d-flex gap-3">
                  <button class="color-btn rounded-3 mem-color-btn mem-color-blue" id="cb-blue" data-color="blue"></button>
                  <button class="color-btn rounded-3 mem-color-btn mem-color-yellow" id="cb-yellow" data-color="yellow"></button>
                </div>
              </div>
            </div>
            <div id="startPrompt">
              <div class="fs-1">🧠</div>
              <div class="text-muted">Select a mode and press Start</div>
            </div>
          </div>

          {{-- Start button --}}
          <div class="text-center mt-3">
            <button class="btn btn-primary px-5" id="btnMemStart">Start Game</button>
          </div>

          {{-- Result message --}}
          <div id="memResult" class="d-none mt-3 text-center">
            <hr>
            <div class="fs-5 fw-bold" id="memResultTitle"></div>
            <div class="text-muted mt-1" id="memResultBody"></div>
            <div class="mt-2">
              <span class="badge bg-primary fs-6" id="memResultScore"></span>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 d-none d-lg-block">
        <div class="card border-0 bg-success bg-opacity-10 rounded-4 p-4">
          <div class="fw-bold mb-3">Miller's Law</div>
          <p class="small text-muted">George A. Miller (1956) found that short-term memory holds <strong>7 ± 2 items</strong>. This test measures where your capacity falls.</p>
          <div class="mb-1 small"><span class="badge bg-danger">Below avg</span> Level 1–4</div>
          <div class="mb-1 small"><span class="badge bg-warning text-dark">Average</span> Level 5–9 (Miller's range)</div>
          <div class="mb-1 small"><span class="badge bg-success">Above avg</span> Level 10–12</div>
          <div class="small"><span class="badge bg-primary">Exceptional</span> Level 13+</div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- SEO Sections --}}
<section class="ms-section-white">
  <div class="container-xl mem-seo-section">
    <h2 class="fw-bold mb-3">Three Ways to Test Your Short-Term Memory Online</h2>
    <p>Pattern Grid tests your spatial working memory by briefly showing highlighted cells on a 4×4 grid, then asking you to reproduce the pattern. This type of memory is handled primarily by the visuospatial sketchpad component of working memory — the same system used when reading a map, parking a car, or following a visual recipe.</p>
    <p>Number Sequence tests verbal working memory. A growing sequence of digits is displayed briefly, then you must type them back in order. This mirrors how we hold a phone number in mind long enough to dial it. Colour Sequence (our Simon-style mode) adds a sequential challenge: you must not only remember which colours appeared but in what order — taxing both memory and attention simultaneously.</p>

    <h2 class="fw-bold mb-3 mt-4">Understanding Miller's Law and Working Memory Capacity</h2>
    <p>George A. Miller's landmark 1956 paper "The Magical Number Seven, Plus or Minus Two" established that short-term memory typically holds 5–9 items. More recent research by Nelson Cowan (2001) refined this to approximately 4 "chunks" — meaningful groups of information. Our test starts at level 1 (2 items) and increases by one item per level, so level 7 corresponds exactly to Miller's average.</p>
    <p>Reaching level 9 places you above Miller's upper bound, indicating an above-average working memory capacity. Level 5 or below suggests a more limited capacity, which is perfectly normal and compensable through strategies like chunking (grouping digits into meaningful sets) and association (linking items to things you already know).</p>

    <h2 class="fw-bold mb-3 mt-4">How to Improve Your Memory Score Over Time</h2>
    <p>The most effective single change most people can make is improving sleep quality. Memory consolidation — the transfer of working memory into long-term storage — happens primarily during slow-wave and REM sleep. Even one night of poor sleep can reduce working memory capacity by up to 30%. Beyond sleep, regular aerobic exercise has been shown to increase hippocampal volume and improve memory performance measurably.</p>
    <p>Mentally, chunking is the most powerful immediate strategy. Instead of remembering 8 individual digits, group them: 38 47 19 02 is four chunks, not eight items. Mnemonics, method-of-loci (memory palace) techniques, and spaced repetition practice all expand your effective working memory over weeks of consistent training.</p>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="memoryFaq" />
<x-related-tools :tools="$relatedTools" heading="Related Tools" />

@endsection

@push('scripts')
<script>
(function(){
  let mode = 'grid';
  let level = 1;
  let score = 0;
  let lives = 3;
  let sequence = [];
  let userInput = [];
  let phase = 'idle'; // idle | show | input
  let colorPlayIndex = 0;
  let colorUserIndex = 0;

  const COLORS = ['red','green','blue','yellow'];
  const COLOR_BG = {red:'#dc3545',green:'#198754',blue:'#0d6efd',yellow:'#ffc107'};

  const statLevel  = document.getElementById('statLevel');
  const statScore  = document.getElementById('statScore');
  const statLives  = document.getElementById('statLives');
  const statPhase  = document.getElementById('statPhase');
  const btnStart   = document.getElementById('btnMemStart');
  const startPr    = document.getElementById('startPrompt');
  const gridArea   = document.getElementById('gridArea');
  const numArea    = document.getElementById('numArea');
  const colorArea  = document.getElementById('colorArea');
  const memResult  = document.getElementById('memResult');

  function getMode(){ return document.querySelector('input[name="memMode"]:checked').value; }

  function updateStats(){
    statLevel.textContent = level;
    statScore.textContent = score;
    statLives.textContent = '❤️'.repeat(lives) + '🖤'.repeat(3-lives);
  }

  function setPhase(p){
    phase = p;
    const labels = {idle:'—',show:'Watch!',input:'Your Turn'};
    statPhase.textContent = labels[p]||p;
  }

  function hideAll(){
    startPr.classList.add('d-none');
    gridArea.classList.add('d-none');
    numArea.classList.add('d-none');
    colorArea.classList.add('d-none');
  }

  function showResult(won){
    memResult.classList.remove('d-none');
    document.getElementById('memResultTitle').textContent = won ? '✅ Correct! Level up!' : '❌ Wrong answer';
    document.getElementById('memResultBody').textContent = won
      ? `You reached level ${level}. Score: ${score}`
      : lives > 0 ? `${lives} ${lives===1?'life':'lives'} remaining. Same level again.` : 'Game over! Your final score:';
    document.getElementById('memResultScore').textContent = `Score: ${score}`;
    if(lives === 0){
      document.getElementById('memResultTitle').textContent = '🏁 Game Over';
      const millerMsg = level <= 4 ? 'Keep practicing to reach Miller\'s average of 7.' :
        level <= 9 ? `Level ${level} falls within Miller's Law range (7±2). Well done!` :
        `Level ${level} — above Miller's Law! Exceptional memory.`;
      document.getElementById('memResultBody').textContent = `${millerMsg} Final score: ${score}`;
      btnStart.textContent = 'Play Again';
    }
  }

  // ── GRID MODE ──────────────────────────────────────────────────
  function buildGrid(){
    const gc = document.getElementById('gridContainer');
    gc.innerHTML = '';
    for(let i=0;i<16;i++){
      const cell = document.createElement('div');
      cell.className = 'rounded-2 border mem-grid-cell';
      cell.dataset.idx = i;
      gc.appendChild(cell);
    }
  }

  function playGrid(){
    hideAll();
    gridArea.classList.remove('d-none');
    buildGrid();
    setPhase('show');

    const count = Math.min(level + 1, 14);
    sequence = [];
    while(sequence.length < count){
      const r = Math.floor(Math.random()*16);
      if(!sequence.includes(r)) sequence.push(r);
    }

    const cells = document.querySelectorAll('#gridContainer [data-idx]');
    sequence.forEach(idx => { cells[idx].style.background='#0d6efd'; });

    setTimeout(()=>{
      cells.forEach(c=>{ c.style.background='#e9ecef'; c.style.cursor='pointer'; });
      setPhase('input');
      userInput = [];
      cells.forEach(c=>{
        c.addEventListener('click', gridCellClick);
      });
    }, 1000 + level * 200);
  }

  function gridCellClick(e){
    if(phase !== 'input') return;
    const idx = parseInt(e.currentTarget.dataset.idx);
    if(userInput.includes(idx)) return;
    userInput.push(idx);
    e.currentTarget.style.background='#6f42c1';

    if(userInput.length === sequence.length){
      document.querySelectorAll('#gridContainer [data-idx]').forEach(c=>{
        c.style.cursor='default';
        c.replaceWith(c.cloneNode(true));
      });
      const correct = sequence.every(v=>userInput.includes(v));
      handleAnswer(correct);
    }
  }

  // ── NUMBER MODE ────────────────────────────────────────────────
  function playNumber(){
    hideAll();
    numArea.classList.remove('d-none');
    setPhase('show');

    const count = level + 1;
    sequence = Array.from({length:count},()=>Math.floor(Math.random()*10));
    const numDisplay = document.getElementById('numDisplay');
    const numInput   = document.getElementById('numInput');
    numInput.classList.add('d-none');

    let i = 0;
    numDisplay.textContent = '';
    const showNext = () => {
      if(i < sequence.length){
        numDisplay.textContent = sequence[i];
        i++;
        setTimeout(showNext, 700);
      } else {
        numDisplay.textContent = '?';
        setPhase('input');
        numInput.classList.remove('d-none');
        document.getElementById('numAnswer').value='';
        document.getElementById('numAnswer').focus();
      }
    };
    setTimeout(showNext, 500);
  }

  document.getElementById('btnNumSubmit').addEventListener('click', function(){
    if(phase !== 'input') return;
    const answer = document.getElementById('numAnswer').value.trim().split('').map(Number);
    const correct = answer.length === sequence.length && answer.every((v,i)=>v===sequence[i]);
    handleAnswer(correct);
  });

  document.getElementById('numAnswer').addEventListener('keydown', function(e){
    if(e.key==='Enter') document.getElementById('btnNumSubmit').click();
  });

  // ── COLOR MODE ─────────────────────────────────────────────────
  function playColor(){
    hideAll();
    colorArea.classList.remove('d-none');
    setPhase('show');

    const count = level + 1;
    sequence = Array.from({length:count},()=>COLORS[Math.floor(Math.random()*4)]);

    document.querySelectorAll('.color-btn').forEach(b=>b.disabled=true);

    let i = 0;
    const showNext = () => {
      if(i < sequence.length){
        const color = sequence[i];
        const btn = document.getElementById('cb-'+color);
        btn.style.opacity='1';
        setTimeout(()=>{
          btn.style.opacity='0.4';
          i++;
          setTimeout(showNext, 400);
        }, 500);
      } else {
        setPhase('input');
        colorUserIndex = 0;
        document.querySelectorAll('.color-btn').forEach(b=>b.disabled=false);
      }
    };
    setTimeout(showNext, 600);
  }

  document.querySelectorAll('.color-btn').forEach(btn=>{
    btn.addEventListener('click', function(){
      if(phase !== 'input') return;
      const color = this.dataset.color;
      this.style.opacity='1';
      setTimeout(()=>this.style.opacity='0.4',300);

      if(color !== sequence[colorUserIndex]){
        handleAnswer(false);
        return;
      }
      colorUserIndex++;
      if(colorUserIndex === sequence.length){
        handleAnswer(true);
      }
    });
  });

  // ── ANSWER HANDLER ─────────────────────────────────────────────
  function handleAnswer(correct){
    setPhase('idle');
    memResult.classList.remove('d-none');
    if(correct){
      score += level * 10;
      level++;
      showResult(true);
    } else {
      lives--;
      showResult(false);
    }
    updateStats();
    if(lives > 0 && correct){
      btnStart.textContent = 'Next Level';
    } else if(lives > 0 && !correct){
      btnStart.textContent = 'Try Again';
    }
  }

  btnStart.addEventListener('click', function(){
    if(lives === 0){
      level = 1; score = 0; lives = 3;
      updateStats();
      memResult.classList.add('d-none');
      btnStart.textContent = 'Start Game';
      hideAll();
      startPr.classList.remove('d-none');
      return;
    }
    memResult.classList.add('d-none');
    mode = getMode();
    if(mode==='grid') playGrid();
    else if(mode==='number') playNumber();
    else playColor();
  });

  updateStats();
})();
</script>
@endpush
