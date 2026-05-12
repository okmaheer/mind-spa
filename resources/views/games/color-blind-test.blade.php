@extends('layouts.app')

@section('title', 'Colour Blind Test — Free Ishihara Screening | MindSnap')
@section('description', 'Free online colour blind test with 10 Ishihara-style plates. Detect red-green, blue-yellow, and total colour vision deficiency. No signup, instant results.')
@section('canonical', config('app.url') . '/color-blind-test')
@section('og_image', config('app.url') . '/images/og-default.jpg')

@section('styles')
<style>
  .cbt-canvas {
    border-radius: 50%;
    cursor: pointer;
    display: block;
    margin: 0 auto;
  }
  .cbt-plate-wrap {
    position: relative;
  }
  .cbt-answer-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 0.5rem;
    max-width: 360px;
    margin: 0 auto;
  }
  .cbt-answer-btn {
    font-size: 1.1rem;
    font-weight: 700;
    padding: 0.6rem 0;
    border-radius: 8px;
  }
  .cbt-progress {
    height: 8px;
  }
  .cbt-seo-section {
    max-width: 780px;
  }
  .cbt-result-icon {
    font-size: 4rem;
    line-height: 1;
  }
  .cbt-type-card {
    border-radius: 12px;
    padding: 1rem;
  }
</style>
@endsection

@section('schema')
<script type="application/ld+json">
{"@@context":"https://schema.org","@type":"WebApplication","name":"Colour Blind Test","url":"{{ config('app.url') }}/color-blind-test","description":"Free online colour blind test with 10 Ishihara-inspired plates. Detects red-green, blue-yellow, and total colour vision deficiencies instantly.","applicationCategory":"HealthApplication","operatingSystem":"Any","offers":{"@type":"Offer","price":"0","priceCurrency":"USD"},"publisher":{"@type":"Organization","name":"MindSnap","url":"{{ config('app.url') }}"}}
</script>
<script type="application/ld+json">
{"@@context":"https://schema.org","@type":"BreadcrumbList","itemListElement":[{"@type":"ListItem","position":1,"name":"Home","item":"{{ config('app.url') }}"},{"@type":"ListItem","position":2,"name":"Brain Games","item":"{{ config('app.url') }}/games"},{"@type":"ListItem","position":3,"name":"Colour Blind Test"}]}
</script>
<script type="application/ld+json">
{"@@context":"https://schema.org","@type":"FAQPage","mainEntity":[{"@type":"Question","name":"What is a colour blind test?","acceptedAnswer":{"@type":"Answer","text":"A colour blind test screens for colour vision deficiency by presenting Ishihara-style plates — circular patterns of coloured dots hiding numbers or shapes. People with certain colour vision deficiencies cannot distinguish the hidden number from the background dots."}},{"@type":"Question","name":"How common is colour blindness?","acceptedAnswer":{"@type":"Answer","text":"Approximately 8% of men and 0.5% of women of Northern European descent have some form of colour vision deficiency. Red-green colour blindness (deuteranopia or protanopia) is by far the most common type."}},{"@type":"Question","name":"Can colour blindness be cured?","acceptedAnswer":{"@type":"Answer","text":"There is currently no cure for inherited colour blindness. However, special EnChroma-type glasses and contact lenses can improve colour perception for some types of red-green colour deficiency. They do not restore full normal colour vision."}},{"@type":"Question","name":"What is the difference between colour blind and colour deficient?","acceptedAnswer":{"@type":"Answer","text":"'Colour blind' is a common term but 'colour deficient' is more accurate. Most people with colour vision problems can still see colours — they just have difficulty distinguishing certain colour pairs, particularly red-green. True total colour blindness (achromatopsia) is very rare."}},{"@type":"Question","name":"What types of colour blindness does this test detect?","acceptedAnswer":{"@type":"Answer","text":"This test can screen for red-green deficiency (the most common type, affecting 8% of men), blue-yellow deficiency (tritanopia, rarer), and strong total colour blindness. Different plates target different colour channels to help identify which type may be present."}},{"@type":"Question","name":"Is an online colour blind test as accurate as a clinical test?","acceptedAnswer":{"@type":"Answer","text":"Online tests are screening tools, not clinical diagnoses. Results can be affected by screen colour calibration, ambient lighting, and screen brightness. A confirmed diagnosis requires an optometrist using physical Ishihara plates under controlled lighting conditions."}},{"@type":"Question","name":"Can children take a colour blind test?","acceptedAnswer":{"@type":"Answer","text":"Yes. Colour vision testing is often recommended around age 4–5 before school entry, as colour deficiency can affect learning. This test uses simple single-digit numbers (1–9) and a 'can't see it' option, making it accessible for older children who can read numbers."}},{"@type":"Question","name":"What should I do if I fail the colour blind test?","acceptedAnswer":{"@type":"Answer","text":"If this screening suggests a colour vision deficiency, visit an optometrist for a full clinical assessment using professional Ishihara plates. Colour deficiency can affect career paths (aviation, military, some design roles) and it is important to have an official diagnosis on record."}}]}
</script>
@endsection

@php
$faqs = [
    ['q'=>'What is a colour blind test?','a'=>'A colour blind test screens for colour vision deficiency using Ishihara-style plates — circular patterns of coloured dots hiding numbers. People with certain colour vision deficiencies cannot distinguish the hidden number from the background.'],
    ['q'=>'How common is colour blindness?','a'=>'Approximately 8% of men and 0.5% of women have some form of colour vision deficiency. Red-green colour blindness is by far the most common type, caused by a mutation on the X chromosome.'],
    ['q'=>'Can colour blindness be cured?','a'=>'There is no cure for inherited colour blindness. Special glasses (like EnChroma) can improve colour perception for some red-green deficiency types, but do not restore full normal colour vision.'],
    ['q'=>'What is the difference between colour blind and colour deficient?','a'=>'"Colour blind" is a common misnomer. Most affected people can still see colours — they just have difficulty distinguishing certain pairs (typically red-green). True total colour blindness (achromatopsia) is extremely rare.'],
    ['q'=>'What types of colour blindness does this test detect?','a'=>'This test screens for red-green deficiency (most common, affecting ~8% of men), blue-yellow deficiency (tritanopia), and indicators of total colour blindness. Different plates isolate different colour channels.'],
    ['q'=>'Is an online colour blind test as accurate as a clinical test?','a'=>'Online tests are screening tools only. Results depend on screen calibration and lighting. A confirmed diagnosis requires an optometrist using physical Ishihara plates under controlled lighting.'],
    ['q'=>'Can children take a colour blind test?','a'=>'Yes — testing is often recommended at age 4–5 before school. This test uses simple single digits and a "can\'t see it" option to make it accessible for older children who can read numbers.'],
    ['q'=>'What should I do if I fail the colour blind test?','a'=>'Visit an optometrist for a full clinical assessment. Colour deficiency affects certain careers (aviation, military, some design roles) and an official diagnosis is important to have on record.'],
];
$relatedTools = [
    ['icon'=>'⌨️','name'=>'Typing Speed Test','slug'=>'typing-speed-test','desc'=>'Measure your WPM and accuracy.'],
    ['icon'=>'⚡','name'=>'Reaction Time Test','slug'=>'reaction-time-test','desc'=>'Test your visual reflex speed.'],
    ['icon'=>'🧠','name'=>'Memory Test','slug'=>'memory-test','desc'=>'Test pattern, number and colour sequence memory.'],
    ['icon'=>'🔤','name'=>'Word Scramble','slug'=>'word-scramble','desc'=>'Unscramble words across 6 categories.'],
];
@endphp

@section('content')

{{-- Hero --}}
<section class="ms-hero">
  <div class="container-xl">
    <div class="row align-items-start g-5">
      <div class="col-lg-8">
        <x-breadcrumb :crumbs="[['url'=>route('home'),'name'=>'Home'],['url'=>route('category.games'),'name'=>'Brain Games'],['url'=>'','name'=>'Colour Blind Test']]"/>
        <h1 class="mb-2 ms-hero-title">👁️ Colour Blind Test</h1>
        <p class="ms-hero-desc">10 Ishihara-style plates. Can you see every number? Results in under 2 minutes — no signup required.</p>

        {{-- Tool Card --}}
        <div class="card border-0 shadow-sm rounded-4 p-4 mt-3" id="cbtCard">

          {{-- Start screen --}}
          <div id="cbtStart" class="text-center py-3">
            <div class="fs-1 mb-3">👁️</div>
            <h2 class="h5 fw-bold mb-2">Colour Vision Screening</h2>
            <p class="text-muted small mb-4">10 plates · ~2 minutes · Works best in a normally lit room<br>Maximise screen brightness and sit about 35cm from the screen.</p>
            <div class="card border-0 bg-warning bg-opacity-10 rounded-3 p-3 mb-4 text-start small">
              <strong>⚠️ Important:</strong> This is a screening tool, not a clinical diagnosis. See an optometrist if you suspect colour vision deficiency.
            </div>
            <button class="btn btn-primary btn-lg px-5" id="cbtBtnStart">Start Test</button>
          </div>

          {{-- Test screen --}}
          <div id="cbtTest" class="d-none">
            {{-- Progress --}}
            <div class="mb-3">
              <div class="d-flex justify-content-between mb-1">
                <small class="text-muted">Plate <span id="cbtPlateNum">1</span> of 10</small>
                <small class="text-muted fw-semibold" id="cbtPlateType"></small>
              </div>
              <div class="progress cbt-progress">
                <div id="cbtProgressBar" class="progress-bar bg-primary"></div>
              </div>
            </div>

            {{-- Plate --}}
            <div class="cbt-plate-wrap text-center mb-4">
              <canvas id="cbtCanvas" class="cbt-canvas" width="280" height="280" aria-label="Colour vision test plate"></canvas>
            </div>

            {{-- Instruction --}}
            <p class="text-center text-muted small mb-3" id="cbtInstruction">What number do you see in the plate?</p>

            {{-- Answer buttons --}}
            <div class="cbt-answer-grid" id="cbtAnswerGrid"></div>
          </div>

          {{-- Results screen --}}
          <div id="cbtResults" class="d-none text-center py-2">
            <div class="cbt-result-icon mb-3" id="cbtResultIcon"></div>
            <h2 class="h4 fw-bold mb-1" id="cbtResultTitle"></h2>
            <p class="text-muted mb-4" id="cbtResultSub"></p>

            <div class="row g-3 mb-4" id="cbtScoreRow">
              <div class="col-4">
                <div class="card border-0 bg-success bg-opacity-10 p-3 rounded-3">
                  <div class="fs-3 fw-bold text-success" id="cbtCorrect">—</div>
                  <div class="small">Correct</div>
                </div>
              </div>
              <div class="col-4">
                <div class="card border-0 bg-danger bg-opacity-10 p-3 rounded-3">
                  <div class="fs-3 fw-bold text-danger" id="cbtMissed">—</div>
                  <div class="small">Missed</div>
                </div>
              </div>
              <div class="col-4">
                <div class="card border-0 bg-primary bg-opacity-10 p-3 rounded-3">
                  <div class="fs-3 fw-bold text-primary" id="cbtScore">—</div>
                  <div class="small">Score</div>
                </div>
              </div>
            </div>

            <div class="card border-0 bg-light rounded-3 p-3 text-start mb-4" id="cbtInterpretation"></div>

            <div class="d-flex gap-2 justify-content-center flex-wrap">
              <button class="btn btn-primary" id="cbtBtnRetry">Retake Test</button>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 d-none d-lg-block">
        <div class="card border-0 bg-danger bg-opacity-10 rounded-4 p-4">
          <div class="fw-bold mb-3">Colour Blindness Prevalence</div>
          <table class="table table-sm mb-0">
            <thead><tr><th>Type</th><th>Men</th><th>Women</th></tr></thead>
            <tbody>
              <tr><td>Red-green</td><td>8%</td><td>0.5%</td></tr>
              <tr><td>Blue-yellow</td><td>0.01%</td><td>0.01%</td></tr>
              <tr><td>Total (achromatopsia)</td><td colspan="2">0.003%</td></tr>
            </tbody>
          </table>
          <hr>
          <p class="small text-muted mb-0">X-linked inheritance explains why colour blindness is far more common in men than women.</p>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- SEO sections --}}
<section class="ms-section-white">
  <div class="container-xl cbt-seo-section">
    <h2 class="fw-bold mb-3">How Ishihara Colour Blind Tests Work</h2>
    <p>Ishihara plates were developed by Dr Shinobu Ishihara in 1917 and remain the gold standard for screening red-green colour vision deficiency. Each plate is a circle filled with dots of varying size and colour. For people with normal colour vision, the arrangement of dots forms a visible number. For people with red-green deficiency, the dots appear as a uniform field with no distinguishable number.</p>
    <p>The dots are carefully chosen so that the number dots and background dots differ only in hue (red vs green), not in brightness. This means someone cannot "see through" the test by perceiving brightness differences alone — only genuine colour discrimination reveals the number. MindSnap's plates use a canvas-based generative algorithm that mirrors this principle: dots are placed in a circular field with controlled size variance and colour clustering around the target shape.</p>

    <h2 class="fw-bold mb-3 mt-4">Types of Colour Vision Deficiency Explained</h2>
    <p>Red-green colour blindness is the umbrella term for two distinct conditions: deuteranopia (reduced sensitivity to green light, ~5% of men) and protanopia (reduced sensitivity to red light, ~1% of men). Together they affect roughly 8% of men and 0.5% of women — making them the most common form of colour vision deficiency by a large margin.</p>
    <p>Blue-yellow colour blindness (tritanopia) is far rarer, affecting approximately 1 in 10,000 people equally between men and women, because the relevant gene is on chromosome 7 rather than the X chromosome. Total colour blindness (achromatopsia) — seeing only in greyscale — is extremely rare and almost always accompanied by other visual issues including severe light sensitivity and reduced visual acuity.</p>

    <h2 class="fw-bold mb-3 mt-4">Occupations Affected by Colour Vision Deficiency</h2>
    <p>Colour vision requirements vary significantly by profession. Commercial aviation authorities (including the FAA and EASA) require pilots to pass colour vision tests as part of medical certification — though modern colour-safe instrument design has reduced the practical impact. Electrical work and electronics require distinguishing colour-coded wires (red, black, blue, yellow, green). Certain roles in the military, law enforcement, and maritime navigation also have colour vision requirements.</p>
    <p>In creative fields, graphic designers, photographers, and UX designers with colour deficiency can work effectively with assistive tools and deliberate workflow adjustments — many famous artists are believed to have had some form of colour vision deficiency. The most important step is knowing your specific deficiency type so you can adapt accordingly.</p>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="colorBlindFaq" />
<x-related-tools :tools="$relatedTools" heading="Related Tools" />

@endsection

@push('scripts')
<script>
(function(){
  'use strict';

  // ── Plate definitions ──────────────────────────────────────────────────────
  // Each plate: { number (correct answer), answer (displayed on btn), type, distractors }
  // type: 'normal' = everyone sees it, 'rg' = only RG-blind fail, 'tritan' = only tritan fail
  const PLATES = [
    { number: '6',  type: 'normal', label: 'Control',      distractors: ['2','8','0','3','5','9'] },
    { number: '12', type: 'rg',     label: 'Red-green',    distractors: ['17','21','74','8','0','X'] },
    { number: '8',  type: 'normal', label: 'Control',      distractors: ['3','6','0','5','9','2'] },
    { number: '29', type: 'rg',     label: 'Red-green',    distractors: ['70','5','6','0','X','45'] },
    { number: '5',  type: 'normal', label: 'Control',      distractors: ['2','6','3','8','9','0'] },
    { number: '3',  type: 'rg',     label: 'Red-green',    distractors: ['5','8','6','0','2','X'] },
    { number: '15', type: 'tritan', label: 'Blue-yellow',  distractors: ['17','51','X','6','0','9'] },
    { number: '74', type: 'rg',     label: 'Red-green',    distractors: ['21','X','4','0','8','5'] },
    { number: '7',  type: 'normal', label: 'Control',      distractors: ['1','4','9','0','3','5'] },
    { number: '26', type: 'rg',     label: 'Red-green',    distractors: ['6','X','62','0','8','5'] },
  ];

  // ── Colour palettes per plate type ─────────────────────────────────────────
  // bg: background dot colours, fg: foreground (number) dot colours
  const PALETTES = {
    normal: {
      bg: ['#e8a07a','#d97c52','#c86b42','#e09a6c','#cc7b56','#d08060'],
      fg: ['#7ab87a','#5da05d','#4a8f4a','#6aaa6a','#52985a','#60a060']
    },
    rg: {
      bg: ['#a0b870','#88aa58','#78a050','#90b060','#80a858','#96b268'],
      fg: ['#c07030','#b06020','#a05018','#bc6828','#aa5f22','#b86a2a']
    },
    tritan: {
      bg: ['#e87878','#d06060','#c05050','#e06868','#cc5a5a','#d47070'],
      fg: ['#7898e8','#6080d0','#5070c0','#6888e0','#5878cc','#6890d4']
    }
  };

  // ── Canvas plate renderer ───────────────────────────────────────────────────
  function drawPlate(canvas, plateIdx) {
    const plate = PLATES[plateIdx];
    const ctx   = canvas.getContext('2d');
    const W     = canvas.width;
    const H     = canvas.height;
    const cx    = W / 2;
    const cy    = H / 2;
    const R     = W / 2 - 4;

    ctx.clearRect(0, 0, W, H);

    // Clip to circle
    ctx.save();
    ctx.beginPath();
    ctx.arc(cx, cy, R, 0, Math.PI * 2);
    ctx.clip();

    const pal = PALETTES[plate.type] || PALETTES.normal;

    // Build digit mask using canvas text
    const offscreen = document.createElement('canvas');
    offscreen.width  = W;
    offscreen.height = H;
    const octx = offscreen.getContext('2d');
    octx.fillStyle = '#000';
    octx.fillRect(0, 0, W, H);
    octx.fillStyle = '#fff';
    octx.font = 'bold ' + Math.round(W * 0.42) + 'px Arial';
    octx.textAlign    = 'center';
    octx.textBaseline = 'middle';
    octx.fillText(plate.number, cx, cy);
    const maskData = octx.getImageData(0, 0, W, H).data;

    // Place dots
    const rng = seededRng(plateIdx * 1337 + 42);
    const dots = [];
    const ATTEMPTS = 1200;

    for (let i = 0; i < ATTEMPTS; i++) {
      const angle  = rng() * Math.PI * 2;
      const dist   = Math.sqrt(rng()) * (R - 12);
      const x      = cx + dist * Math.cos(angle);
      const y      = cy + dist * Math.sin(angle);
      const radius = 6 + rng() * 8;

      if (!fits(dots, x, y, radius)) continue;
      dots.push({ x, y, radius });

      const px  = Math.round(x);
      const py  = Math.round(y);
      const idx = (py * W + px) * 4;
      const onDigit = maskData[idx] > 128;

      const palette = onDigit ? pal.fg : pal.bg;
      const color   = palette[Math.floor(rng() * palette.length)];

      // Slight brightness jitter
      ctx.beginPath();
      ctx.arc(x, y, radius, 0, Math.PI * 2);
      ctx.fillStyle = jitterColor(color, rng);
      ctx.fill();
    }

    ctx.restore();

    // Outer border
    ctx.beginPath();
    ctx.arc(cx, cy, R, 0, Math.PI * 2);
    ctx.strokeStyle = '#ccc';
    ctx.lineWidth   = 2;
    ctx.stroke();
  }

  function fits(dots, x, y, r) {
    for (const d of dots) {
      const dx = d.x - x;
      const dy = d.y - y;
      if (Math.sqrt(dx*dx + dy*dy) < d.radius + r + 1) return false;
    }
    return true;
  }

  function jitterColor(hex, rng) {
    let r = parseInt(hex.slice(1,3),16);
    let g = parseInt(hex.slice(3,5),16);
    let b = parseInt(hex.slice(5,7),16);
    const j = Math.floor((rng()-0.5)*30);
    r = Math.max(0,Math.min(255,r+j));
    g = Math.max(0,Math.min(255,g+Math.floor((rng()-0.5)*30)));
    b = Math.max(0,Math.min(255,b+Math.floor((rng()-0.5)*30)));
    return `rgb(${r},${g},${b})`;
  }

  function seededRng(seed) {
    let s = seed;
    return function() {
      s = (s * 1664525 + 1013904223) & 0xffffffff;
      return (s >>> 0) / 0xffffffff;
    };
  }

  // ── State ───────────────────────────────────────────────────────────────────
  let current = 0;
  let answers = [];  // { correct: bool, type: string }

  // ── DOM refs ────────────────────────────────────────────────────────────────
  const startScreen   = document.getElementById('cbtStart');
  const testScreen    = document.getElementById('cbtTest');
  const resultsScreen = document.getElementById('cbtResults');
  const canvas        = document.getElementById('cbtCanvas');
  const progressBar   = document.getElementById('cbtProgressBar');
  const plateNumEl    = document.getElementById('cbtPlateNum');
  const plateTypeEl   = document.getElementById('cbtPlateType');
  const answerGrid    = document.getElementById('cbtAnswerGrid');
  const btnStart      = document.getElementById('cbtBtnStart');
  const btnRetry      = document.getElementById('cbtBtnRetry');

  // ── Helpers ─────────────────────────────────────────────────────────────────
  function shuffleArray(arr) {
    for (let i = arr.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [arr[i], arr[j]] = [arr[j], arr[i]];
    }
    return arr;
  }

  // ── Init test ───────────────────────────────────────────────────────────────
  function startTest() {
    current = 0;
    answers = [];
    startScreen.classList.add('d-none');
    resultsScreen.classList.add('d-none');
    testScreen.classList.remove('d-none');
    showPlate(0);
  }

  function showPlate(idx) {
    const plate = PLATES[idx];
    plateNumEl.textContent = idx + 1;
    plateTypeEl.textContent = plate.label + ' plate';
    progressBar.style.width = (idx / PLATES.length * 100) + '%';

    drawPlate(canvas, idx);

    // Build answer choices: correct + 3 random distractors + "Can't see it"
    const distractors = shuffleArray([...plate.distractors]).slice(0, 3);
    const choices     = shuffleArray([plate.number, ...distractors]);
    choices.push('?');  // can't see it — always last

    answerGrid.innerHTML = '';
    choices.forEach(choice => {
      const btn = document.createElement('button');
      btn.className    = 'btn btn-outline-secondary cbt-answer-btn';
      btn.textContent  = choice === '?' ? "Can't see" : choice;
      btn.addEventListener('click', () => handleAnswer(choice, plate));
      answerGrid.appendChild(btn);
    });
  }

  function handleAnswer(chosen, plate) {
    const isCorrect = chosen === plate.number;
    answers.push({ correct: isCorrect, type: plate.type });

    answerGrid.querySelectorAll('button').forEach(b => b.disabled = true);

    current++;
    if (current < PLATES.length) {
      setTimeout(() => showPlate(current), 400);
    } else {
      setTimeout(showResults, 500);
    }
  }

  function showResults() {
    testScreen.classList.add('d-none');
    resultsScreen.classList.remove('d-none');
    progressBar.style.width = '100%';

    const total   = answers.length;
    const correct = answers.filter(a => a.correct).length;
    const missed  = total - correct;
    const score   = Math.round((correct / total) * 100);

    document.getElementById('cbtCorrect').textContent = correct;
    document.getElementById('cbtMissed').textContent  = missed;
    document.getElementById('cbtScore').textContent   = score + '%';

    // Analyse by type
    const rgPlates     = answers.filter(a => a.type === 'rg');
    const tritanPlates = answers.filter(a => a.type === 'tritan');
    const rgFailed     = rgPlates.filter(a => !a.correct).length;
    const tritanFailed = tritanPlates.filter(a => !a.correct).length;

    let icon, title, sub, interpretation;

    if (missed === 0) {
      icon           = '✅';
      title          = 'No Deficiency Detected';
      sub            = 'You correctly identified all 10 plates.';
      interpretation = '<strong>Normal colour vision.</strong> You identified all plates correctly. No signs of red-green or blue-yellow colour vision deficiency were detected in this screening.';
    } else if (rgFailed >= 3 && tritanFailed <= 1) {
      icon           = '🔴';
      title          = 'Possible Red-Green Deficiency';
      sub            = 'You missed ' + rgFailed + ' of the red-green plates.';
      interpretation = '<strong>Possible red-green colour vision deficiency detected.</strong> Missing multiple red-green plates may indicate deuteranopia or protanopia — the most common types of colour blindness, affecting ~8% of men. This is a screening only; see an optometrist for a clinical diagnosis.';
    } else if (tritanFailed >= 1 && rgFailed <= 2) {
      icon           = '🔵';
      title          = 'Possible Blue-Yellow Deficiency';
      sub            = 'You missed ' + tritanFailed + ' blue-yellow plate(s).';
      interpretation = '<strong>Possible blue-yellow (tritanopia) deficiency indicated.</strong> This is a rarer condition affecting roughly 1 in 10,000 people. It affects men and women equally. Confirm with a clinical test under controlled lighting conditions.';
    } else if (missed >= 6) {
      icon           = '⚠️';
      title          = 'Significant Colour Vision Issues';
      sub            = 'You missed ' + missed + ' out of 10 plates.';
      interpretation = '<strong>Multiple plates missed across different types.</strong> This may indicate a significant colour vision deficiency. Screen brightness, room lighting, and screen colour calibration can affect results — but missing this many plates warrants a full clinical assessment by an optometrist.';
    } else {
      icon           = '🟡';
      title          = 'Minor Issues or Screen Factors';
      sub            = 'You missed ' + missed + ' plate(s).';
      interpretation = '<strong>Mild misses detected.</strong> Missing 1–2 plates can sometimes be caused by screen brightness, ambient lighting, or screen colour calibration rather than true colour vision deficiency. Re-take the test under ideal conditions (bright screen, dimmed ambient light) or consult an optometrist if you have concerns.';
    }

    document.getElementById('cbtResultIcon').textContent = icon;
    document.getElementById('cbtResultTitle').textContent = title;
    document.getElementById('cbtResultSub').textContent   = sub;
    document.getElementById('cbtInterpretation').innerHTML = interpretation;
  }

  // ── Events ───────────────────────────────────────────────────────────────────
  btnStart.addEventListener('click', startTest);
  btnRetry.addEventListener('click', startTest);

})();
</script>
@endpush
