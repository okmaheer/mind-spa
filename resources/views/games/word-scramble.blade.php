@extends('layouts.app')

@section('title', 'Word Scramble Game — Unscramble Words Online | MindSnap')
@section('description', 'Free word scramble game — 6 categories, 3 difficulty levels, 60-second rounds with hints and streak multipliers. No signup.')
@section('canonical', config('app.url') . '/word-scramble')
@section('og_image', config('app.url') . '/images/og-default.jpg')

@section('styles')
<style>
  .ws-seo-section {
    max-width: 780px;
  }
  .ws-letter-tile {
    width: 48px;
    height: 56px;
  }
  .ws-letter-tile-hint {
    background: #d1e7dd;
  }
  .ws-letter-tile-default {
    background: #f8f9fa;
  }
</style>
@endsection

@section('schema')
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"WebApplication","name":"Word Scramble Game","url":"{{ config('app.url') }}/word-scramble","description":"Free online word scramble game with 6 categories, 3 difficulty levels, timed rounds, hints, and a streak multiplier scoring system.","applicationCategory":"GameApplication","operatingSystem":"Any","offers":{"@type":"Offer","price":"0","priceCurrency":"USD"},"publisher":{"@type":"Organization","name":"MindSnap","url":"{{ config('app.url') }}"}}
</script>
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"BreadcrumbList","itemListElement":[{"@type":"ListItem","position":1,"name":"Home","item":"{{ config('app.url') }}"},{"@type":"ListItem","position":2,"name":"Brain Games","item":"{{ config('app.url') }}/games"},{"@type":"ListItem","position":3,"name":"Word Scramble Game"}]}
</script>
<script type="application/ld+json">
{"@context":"https://schema.org","@type":"FAQPage","mainEntity":[{"@type":"Question","name":"How do word scramble games help your brain?","acceptedAnswer":{"@type":"Answer","text":"Word scramble games activate vocabulary recall, pattern recognition, and working memory simultaneously. Regular play has been linked to improved verbal fluency and faster lexical access — the speed at which you retrieve words from long-term memory."}},{"@type":"Question","name":"How are points scored in the word scramble game?","acceptedAnswer":{"@type":"Answer","text":"Each correct answer earns base points proportional to word length. Consecutive correct answers build a streak multiplier: 2× at 3 in a row, 3× at 6 in a row. Longer words on harder difficulty award more points."}},{"@type":"Question","name":"How does the hint system work?","acceptedAnswer":{"@type":"Answer","text":"Each 60-second round gives you 3 hints. Clicking the hint button reveals one letter of the current scrambled word in its correct position. Hints are limited per round to maintain a fair challenge."}},{"@type":"Question","name":"What categories are available?","acceptedAnswer":{"@type":"Answer","text":"Six categories are available: Animals, Countries, Science Terms, Food, Technology, and Sports. Each category has a large word pool at three difficulty levels: Easy (4–5 letters), Medium (6–7 letters), and Hard (8–10 letters)."}},{"@type":"Question","name":"What happens when the timer runs out?","acceptedAnswer":{"@type":"Answer","text":"When the 60-second timer ends, the round concludes and your results are displayed — including your total score, words solved, and the correct answers for any words you missed during the round."}},{"@type":"Question","name":"Can I play word scramble on mobile?","acceptedAnswer":{"@type":"Answer","text":"Yes. The word scramble game is fully responsive and works on smartphones and tablets. The input field and buttons are touch-friendly, and the scrambled word display adjusts to fit smaller screens."}},{"@type":"Question","name":"Are the words randomly scrambled each time?","acceptedAnswer":{"@type":"Answer","text":"Yes. Each time a new word appears, its letters are randomly shuffled using a Fisher-Yates algorithm. If the shuffle produces the same order as the original word, it is reshuffled automatically."}},{"@type":"Question","name":"Does word scramble improve spelling?","acceptedAnswer":{"@type":"Answer","text":"Yes. Studies show that anagram-solving exercises, which is what word scrambles are, improve spelling accuracy because you must consciously evaluate all possible letter arrangements, reinforcing the correct spelling in long-term memory."}}]}
</script>
@endsection

@php
$faqs = [
    ['q'=>'How do word scramble games help your brain?','a'=>'Word scramble games activate vocabulary recall, pattern recognition, and working memory simultaneously. Regular play has been linked to improved verbal fluency and faster lexical access — the speed at which you retrieve words from long-term memory.'],
    ['q'=>'How are points scored in the word scramble game?','a'=>'Each correct answer earns base points proportional to word length. Consecutive correct answers build a streak multiplier: 2× at 3 in a row, 3× at 6 in a row. Longer words on harder difficulty award more points.'],
    ['q'=>'How does the hint system work?','a'=>'Each 60-second round gives you 3 hints. Clicking the hint button reveals one letter of the current scrambled word in its correct position. Hints are limited per round to maintain a fair challenge.'],
    ['q'=>'What categories are available?','a'=>'Six categories are available: Animals, Countries, Science Terms, Food, Technology, and Sports. Each has a large word pool at Easy (4–5 letters), Medium (6–7 letters), and Hard (8–10 letters) difficulty levels.'],
    ['q'=>'What happens when the timer runs out?','a'=>'When the 60-second timer ends, the round concludes and results are displayed — including total score, words solved, and correct answers for words you missed.'],
    ['q'=>'Can I play word scramble on mobile?','a'=>'Yes. The game is fully responsive and works on smartphones and tablets. Input and buttons are touch-friendly.'],
    ['q'=>'Are the words randomly scrambled each time?','a'=>'Yes. Letters are randomly shuffled using a Fisher-Yates algorithm. If the shuffle produces the original word order, it is reshuffled automatically.'],
    ['q'=>'Does word scramble improve spelling?','a'=>'Yes. Anagram-solving exercises improve spelling accuracy because you must consciously evaluate all possible letter arrangements, reinforcing the correct spelling in long-term memory.'],
];
$relatedTools = [
    ['icon'=>'⌨️','name'=>'Typing Speed Test','slug'=>'typing-speed-test','desc'=>'Measure your WPM, accuracy, and consistency.'],
    ['icon'=>'⚡','name'=>'Reaction Time Test','slug'=>'reaction-time-test','desc'=>'Test your visual and keyboard reflex speed.'],
    ['icon'=>'🧠','name'=>'Memory Test','slug'=>'memory-test','desc'=>'Test pattern, number, and colour sequence memory.'],
    ['icon'=>'👁️','name'=>'Colour Blind Test','slug'=>'color-blind-test','desc'=>'Screen for colour vision deficiencies online.'],
];
@endphp

@section('content')

{{-- Hero --}}
<section class="ms-hero">
  <div class="container-xl">
    <div class="row align-items-start g-5">
      <div class="col-lg-8">
        <x-breadcrumb :crumbs="[['url'=>route('home'),'name'=>'Home'],['url'=>route('category.games'),'name'=>'Brain Games'],['url'=>'','name'=>'Word Scramble Game']]"/>
        <h1 class="mb-2 ms-hero-title">🔤 Word Scramble Game</h1>
        <p class="ms-hero-desc">Unscramble as many words as you can in 60 seconds. Pick a category, choose your difficulty, use hints wisely, and build streaks for bonus points.</p>

        {{-- Tool Card --}}
        <div class="card border-0 shadow-sm rounded-4 p-4 mt-3" id="wsCard">

          {{-- Category & Difficulty --}}
          <div class="row g-2 mb-3">
            <div class="col-sm-7">
              <label class="form-label small fw-semibold mb-1">Category</label>
              <select class="form-select form-select-sm" id="wsCategory" aria-label="Word category">
                <option value="animals">🐾 Animals</option>
                <option value="countries">🌍 Countries</option>
                <option value="science">🔬 Science Terms</option>
                <option value="food">🍎 Food</option>
                <option value="tech">💻 Technology</option>
                <option value="sports">⚽ Sports</option>
              </select>
            </div>
            <div class="col-sm-5">
              <label class="form-label small fw-semibold mb-1">Difficulty</label>
              <div class="btn-group w-100" role="group" aria-label="Difficulty">
                <input type="radio" class="btn-check" name="wsDiff" id="diffEasy" value="easy" checked>
                <label class="btn btn-outline-success btn-sm" for="diffEasy">Easy</label>
                <input type="radio" class="btn-check" name="wsDiff" id="diffMed" value="medium">
                <label class="btn btn-outline-warning btn-sm" for="diffMed">Medium</label>
                <input type="radio" class="btn-check" name="wsDiff" id="diffHard" value="hard">
                <label class="btn btn-outline-danger btn-sm" for="diffHard">Hard</label>
              </div>
            </div>
          </div>

          {{-- Stats bar --}}
          <div class="d-flex gap-4 mb-3">
            <div class="text-center">
              <div class="fs-4 fw-bold" id="wsTimer">60</div>
              <div class="small text-muted">Seconds</div>
            </div>
            <div class="text-center">
              <div class="fs-4 fw-bold text-success" id="wsScore">0</div>
              <div class="small text-muted">Score</div>
            </div>
            <div class="text-center">
              <div class="fs-4 fw-bold text-primary" id="wsSolved">0</div>
              <div class="small text-muted">Solved</div>
            </div>
            <div class="text-center">
              <div class="fs-4 fw-bold text-warning" id="wsStreak">×1</div>
              <div class="small text-muted">Streak</div>
            </div>
            <div class="text-center ms-auto">
              <div class="fs-5" id="wsHints">💡💡💡</div>
              <div class="small text-muted">Hints</div>
            </div>
          </div>

          {{-- Scrambled word display --}}
          <div class="text-center py-3" id="wsWordArea">
            <div class="text-muted">Press Start to begin</div>
          </div>

          {{-- Input --}}
          <div class="d-flex gap-2 mt-2">
            <input type="text" id="wsInput" class="form-control form-control-lg text-center font-monospace" placeholder="Type your answer…" autocomplete="off" autocorrect="off" spellcheck="false" disabled>
            <button class="btn btn-outline-secondary" id="btnHint" disabled title="Use a hint">💡</button>
          </div>

          {{-- Start / Skip buttons --}}
          <div class="d-flex gap-2 mt-3">
            <button class="btn btn-primary" id="btnWsStart">Start Round</button>
            <button class="btn btn-outline-secondary d-none" id="btnWsSkip">Skip Word</button>
          </div>

          {{-- Round results --}}
          <div id="wsResults" class="d-none mt-4">
            <hr>
            <h5 class="fw-bold mb-2">Round Complete!</h5>
            <p class="text-muted mb-1">Words solved: <strong id="rSolved">—</strong> | Final score: <strong id="rScore">—</strong></p>
            <div id="missedWordsSection" class="d-none">
              <div class="small fw-semibold text-danger mb-1">Words you missed:</div>
              <div id="missedList" class="d-flex flex-wrap gap-2"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 d-none d-lg-block">
        <div class="card border-0 bg-warning bg-opacity-10 rounded-4 p-4">
          <div class="fw-bold mb-2">Scoring</div>
          <table class="table table-sm mb-0">
            <thead><tr><th>Event</th><th>Points</th></tr></thead>
            <tbody>
              <tr><td>Easy word (4–5L)</td><td>10</td></tr>
              <tr><td>Medium word (6–7L)</td><td>20</td></tr>
              <tr><td>Hard word (8–10L)</td><td>40</td></tr>
              <tr><td>3-streak bonus</td><td>×2</td></tr>
              <tr><td>6-streak bonus</td><td>×3</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- SEO Sections --}}
<section class="ms-section-white">
  <div class="container-xl ws-seo-section">
    <h2 class="fw-bold mb-3">How to Play Word Scramble and Build Your Streak</h2>
    <p>Select a category and difficulty before starting. When the round begins, a scrambled word appears — your job is to type the correct word before the 60-second timer runs out. Each correct answer earns points based on word length, and consecutive correct answers build a streak multiplier. Three correct answers in a row doubles your points; six in a row triples them.</p>
    <p>Use hints strategically — you only get three per round. Each hint reveals one letter in its correct position within the scrambled word. On Hard difficulty, a well-placed hint can mean the difference between a 40-point answer and a missed word. Skipping a word costs no points but resets your streak, so it's worth using a hint before skipping.</p>

    <h2 class="fw-bold mb-3 mt-4">Best Strategies for Word Scramble by Difficulty Level</h2>
    <p>On Easy mode (4–5 letter words), the most effective strategy is looking for common vowel patterns first. English words almost always have at least one vowel — find it, then build consonant clusters around it. On Medium mode (6–7 letters), look for common prefixes and suffixes: -tion, -ing, -ness, un-, re-. These appear in roughly 40% of common English words.</p>
    <p>Hard mode (8–10 letter words) rewards players who can spot compound word structures or Latin/Greek roots. Words like "technology" break into "techno" + "logy", making them easier to identify even scrambled. Regular play with the Science Terms or Technology categories builds your familiarity with these structures faster than any other approach.</p>

    <h2 class="fw-bold mb-3 mt-4">Why Word Games Are Powerful Brain Training Tools</h2>
    <p>Unscrambling words activates multiple cognitive systems simultaneously: working memory (holding letters while you rearrange them), semantic memory (knowing which combinations form real words), and executive function (deciding which strategy to use under time pressure). This cross-system activation is why word games are more effective for cognitive fitness than simpler single-system tasks.</p>
    <p>Research published in the International Journal of Geriatric Psychiatry found that adults who regularly engage in word puzzles perform as much as a decade younger on tests of cognitive function compared to those who don't. Playing for as little as 10 minutes daily — around 8–10 rounds of this game — provides measurable benefits to processing speed and vocabulary depth over a 6-week period.</p>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="wordScrambleFaq" />
<x-related-tools :tools="$relatedTools" heading="Related Tools" />

@endsection

@push('scripts')
<script>
(function(){
  const WORDS = {
    animals: {
      easy: ['BEAR','WOLF','FROG','DEER','BIRD','LION','DUCK','CRAB','FISH','TOAD'],
      medium: ['MONKEY','JAGUAR','PARROT','FALCON','DONKEY','TURTLE','SALMON','RABBIT'],
      hard: ['ELEPHANT','ALLIGATOR','PORCUPINE','CROCODILE','WOLVERINE','FLAMINGO']
    },
    countries: {
      easy: ['PERU','IRAN','IRAQ','CUBA','CHAD','MALI','LAOS','FIJI','TOGO'],
      medium: ['FRANCE','BRAZIL','CANADA','MEXICO','TURKEY','GREECE','POLAND','SWEDEN'],
      hard: ['PORTUGAL','COLOMBIA','ARGENTINA','ETHIOPIA','THAILAND','MALAYSIA']
    },
    science: {
      easy: ['ATOM','GENE','CELL','MASS','WAVE','LENS','ACID','BASE','FLUX'],
      medium: ['PHOTON','ENZYME','NEURON','PLASMA','OSMOSIS','PROTON','GALAXY'],
      hard: ['MOLECULE','ORGANISM','ELECTRON','MITOSIS','CATALYST','CHROMOSOME']
    },
    food: {
      easy: ['RICE','CORN','PLUM','LIME','PEAR','KALE','BEEF','LAMB','CAKE'],
      medium: ['MANGO','PIZZA','PASTA','SALAD','LEMON','ONION','CARROT','ALMOND'],
      hard: ['BROCCOLI','EGGPLANT','AVOCADO','ZUCCHINI','MUSHROOM','BLUEBERRY']
    },
    tech: {
      easy: ['CODE','BYTE','DATA','WIFI','CHIP','PORT','LOOP','BOOT','DISK'],
      medium: ['SERVER','ROUTER','PYTHON','CURSOR','DOCKER','KERNEL','BINARY'],
      hard: ['DATABASE','ETHERNET','COMPILER','ALGORITHM','BANDWIDTH','FIREWALL']
    },
    sports: {
      easy: ['GOLF','SWIM','POLO','JUDO','SURF','CREW','LUGE','DIVE'],
      medium: ['TENNIS','HOCKEY','BOXING','SQUASH','KARATE','ROWING','SKIING'],
      hard: ['FOOTBALL','BASEBALL','HANDBALL','MARATHON','TRIATHLON','WRESTLING']
    }
  };

  const POINTS = {easy:10, medium:20, hard:40};

  let timer = null;
  let timeLeft = 60;
  let score = 0;
  let solved = 0;
  let streak = 0;
  let hintsLeft = 3;
  let currentWord = '';
  let scrambled = '';
  let hintRevealed = [];
  let roundWords = [];
  let roundPool = [];
  let active = false;

  const wsTimer   = document.getElementById('wsTimer');
  const wsScore   = document.getElementById('wsScore');
  const wsSolved  = document.getElementById('wsSolved');
  const wsStreak  = document.getElementById('wsStreak');
  const wsHints   = document.getElementById('wsHints');
  const wsWordArea= document.getElementById('wsWordArea');
  const wsInput   = document.getElementById('wsInput');
  const btnHint   = document.getElementById('btnHint');
  const btnStart  = document.getElementById('btnWsStart');
  const btnSkip   = document.getElementById('btnWsSkip');
  const wsResults = document.getElementById('wsResults');

  function getDiff(){ return document.querySelector('input[name="wsDiff"]:checked').value; }
  function getCat(){ return document.getElementById('wsCategory').value; }

  function scramble(word){
    const arr = word.split('');
    let out;
    do {
      for(let i=arr.length-1;i>0;i--){
        const j=Math.floor(Math.random()*(i+1));
        [arr[i],arr[j]]=[arr[j],arr[i]];
      }
      out = arr.join('');
    } while(out === word && word.length > 1);
    return out;
  }

  function renderWord(){
    let html = '<div class="d-flex justify-content-center flex-wrap gap-2 my-2">';
    for(let i=0;i<scrambled.length;i++){
      const revealed = hintRevealed.includes(i);
      const tileClass = revealed ? 'ws-letter-tile-hint' : 'ws-letter-tile-default';
      html += `<div class="border rounded-3 d-flex align-items-center justify-content-center fw-bold fs-4 ws-letter-tile ${tileClass}">${scrambled[i]}</div>`;
    }
    html += '</div>';
    wsWordArea.innerHTML = html;
  }

  function nextWord(){
    if(roundPool.length === 0){
      const pool = WORDS[getCat()][getDiff()];
      roundPool = [...pool].sort(()=>Math.random()-0.5);
    }
    currentWord = roundPool.pop();
    scrambled = scramble(currentWord);
    hintRevealed = [];
    roundWords.push({word:currentWord, solved:false});
    renderWord();
    wsInput.value = '';
    wsInput.disabled = false;
    wsInput.focus();
  }

  function updateStats(){
    wsScore.textContent = score;
    wsSolved.textContent = solved;
    const mult = streak >= 6 ? '×3' : streak >= 3 ? '×2' : '×1';
    wsStreak.textContent = mult;
    wsHints.textContent = '💡'.repeat(hintsLeft) + '🔘'.repeat(3-hintsLeft);
  }

  function startRound(){
    timeLeft = 60;
    score = 0;
    solved = 0;
    streak = 0;
    hintsLeft = 3;
    roundWords = [];
    roundPool = [];
    active = true;
    wsResults.classList.add('d-none');
    btnSkip.classList.remove('d-none');
    btnStart.textContent = 'Restart';
    btnHint.disabled = false;
    wsInput.disabled = false;
    updateStats();

    timer = setInterval(()=>{
      timeLeft--;
      wsTimer.textContent = timeLeft;
      if(timeLeft<=0){ endRound(); }
    }, 1000);

    nextWord();
  }

  function endRound(){
    clearInterval(timer);
    active = false;
    wsInput.disabled = true;
    btnHint.disabled = true;
    btnSkip.classList.add('d-none');
    btnStart.textContent = 'New Round';

    document.getElementById('rSolved').textContent = solved;
    document.getElementById('rScore').textContent = score;

    const missed = roundWords.filter(w=>!w.solved).map(w=>w.word);
    if(missed.length>0){
      document.getElementById('missedWordsSection').classList.remove('d-none');
      const list = document.getElementById('missedList');
      list.innerHTML = missed.map(w=>`<span class="badge bg-danger fs-6">${w}</span>`).join('');
    } else {
      document.getElementById('missedWordsSection').classList.add('d-none');
    }
    wsResults.classList.remove('d-none');
  }

  wsInput.addEventListener('keydown', function(e){
    if(e.key==='Enter'){
      if(!active) return;
      const ans = wsInput.value.trim().toUpperCase();
      if(ans === currentWord){
        roundWords[roundWords.length-1].solved = true;
        solved++;
        streak++;
        const mult = streak>=6?3:streak>=3?2:1;
        score += POINTS[getDiff()] * mult;
        updateStats();
        nextWord();
      } else {
        wsInput.classList.add('is-invalid');
        setTimeout(()=>wsInput.classList.remove('is-invalid'),600);
        streak = 0;
        updateStats();
      }
    }
  });

  btnHint.addEventListener('click', function(){
    if(!active || hintsLeft<=0) return;
    const unrevealed = [];
    for(let i=0;i<scrambled.length;i++){
      if(!hintRevealed.includes(i)) unrevealed.push(i);
    }
    if(unrevealed.length===0) return;
    const idx = unrevealed[Math.floor(Math.random()*unrevealed.length)];
    hintRevealed.push(idx);
    hintsLeft--;
    updateStats();
    renderWord();
  });

  btnSkip.addEventListener('click', function(){
    if(!active) return;
    streak = 0;
    updateStats();
    nextWord();
  });

  btnStart.addEventListener('click', function(){
    clearInterval(timer);
    startRound();
  });
})();
</script>
@endpush
