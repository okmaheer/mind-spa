@extends('layouts.app')
@section('title', 'Spelling Quiz for Kids — Free Practice by Grade | MindSnap')
@section('description', 'Free spelling quiz for kids by grade level (Grades 1–6). Practice Mode or Challenge Mode, phonetic hints, scrambled-letter animations. No ads, no signup.')
@section('canonical', config('app.url') . '/kids/spelling-quiz')
@section('og_image', config('app.url') . '/images/og-default.jpg')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "WebApplication",
  "name": "Spelling Quiz for Kids",
  "url": "{{ config('app.url') }}/kids/spelling-quiz",
  "description": "Free online spelling quiz for kids covering Grades 1–6. Features Practice Mode (no timer, unlimited hints) and Challenge Mode (60-second timer). Phonetic hints, scrambled-letter display, and a practice-again list for missed words.",
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
    { "@@type": "ListItem", "position": 3, "name": "Spelling Quiz for Kids" }
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
      "name": "What grade levels does this free spelling quiz cover?",
      "acceptedAnswer": { "@@type": "Answer", "text": "MindSnap's spelling quiz covers five grade levels: Grade 1 (CVC — consonant-vowel-consonant — words like cat, dog, run), Grade 2 (blend words like flag, stop, clap), Grade 3 (digraphs and longer words like phone, thought, night), Grade 4 (prefixes and suffixes like unhappy, careful), and Grades 5–6 (complex vocabulary like necessary, rhythm, conscience)." }
    },
    {
      "@@type": "Question",
      "name": "What is the difference between Practice Mode and Challenge Mode?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Practice Mode has no time limit and allows unlimited use of the hint button, making it ideal for younger children or for learning new words. Challenge Mode adds a 60-second timer and limits hints to 3 per round, creating a test-like environment that builds confidence for school spelling tests. Both modes track correct and wrong answers." }
    },
    {
      "@@type": "Question",
      "name": "How do the phonetic hints work in the spelling quiz?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The hint button reveals two pieces of information: a context clue (such as 'This word means the opposite of hot') and a phonetic pronunciation guide (such as 'kold' for cold). No audio files are required — the phonetic spelling shows children how the word sounds, which is the most important spelling cue for sounding-out strategies." }
    },
    {
      "@@type": "Question",
      "name": "What is the scrambled-letter display in the spelling quiz?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Each word is shown as scrambled letters at the top of the question. When the child types the correct answer, the letters animate into their correct positions with a colour-flash effect. This visual element engages children and gives a satisfying reward for correct spelling — making the activity feel like a game rather than a test." }
    },
    {
      "@@type": "Question",
      "name": "What happens to words that are spelled wrong?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Any word the child spells incorrectly is added to a 'Practice Again' list that is displayed at the end of the round. This targeted list shows children exactly which words need more attention, enabling focused practice rather than repeating words they already know. Parents and teachers can use this list to create handwriting or oral practice sessions." }
    },
    {
      "@@type": "Question",
      "name": "Is this spelling quiz aligned with school curricula?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes — the word lists are carefully chosen to align with common primary school spelling curricula in the UK, US, and Australia. Grade 1 words match Year 1 / Grade 1 common word lists. Grade 4 words include the prefix and suffix patterns taught at Key Stage 2 / Grades 3–5. Grades 5–6 words match the Year 5–6 statutory spelling list used in England." }
    },
    {
      "@@type": "Question",
      "name": "Can I use this as a spelling test preparation tool for my child?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes — Challenge Mode is specifically designed for this purpose. With a 60-second timer and limited hints, it replicates the time pressure of a classroom spelling test. Children who practise regularly in Challenge Mode consistently perform better in school spelling tests because they have already experienced the time constraint in a low-stakes environment." }
    },
    {
      "@@type": "Question",
      "name": "Is the spelling quiz free and ad-free for children?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes — completely free and 100% ad-free. No signup, email address, or account is required. MindSnap's Kids Zone never shows advertisements to children. The quiz runs entirely in the browser on any device — no app download needed. No personal data from children is collected or stored." }
    }
  ]
}
</script>
@endsection

@php
$faqs = [
  ['q' => 'What grade levels does this free spelling quiz cover?',
   'a' => 'Five levels: Grade 1 (simple CVC words: cat, dog, run), Grade 2 (blends: flag, stop, clap), Grade 3 (digraphs and longer words: phone, thought, night), Grade 4 (prefixes and suffixes: unhappy, careful), and Grades 5–6 (complex words: necessary, rhythm, conscience). Select your grade before each round.'],
  ['q' => 'What is the difference between Practice Mode and Challenge Mode?',
   'a' => 'Practice Mode has no timer and allows unlimited hints — ideal for learning new words or younger children. Challenge Mode adds a 60-second countdown and limits hints to 3 per round, simulating a classroom spelling test environment. Both modes track correct and incorrect answers and generate a "Practice Again" list at the end.'],
  ['q' => 'How do the phonetic hints work?',
   'a' => 'The Hint button reveals a context clue ("This word means the opposite of hot") and a phonetic pronunciation guide ("kold" for "cold"). No audio files are needed — the phonetic spelling shows how the word sounds, which is the key cue for sounding-out spelling strategies taught in schools.'],
  ['q' => 'What is the scrambled-letter display?',
   'a' => 'Each word is shown as scrambled letters at the top of the question. When the child types the correct answer and submits, the letters flash and rearrange into their correct positions. This visual reward makes the activity feel like a game and reinforces the correct spelling visually.'],
  ['q' => 'What happens to words my child spells wrong?',
   'a' => 'Every incorrectly spelled word is added to a "Practice Again" list shown at the end of the round. This gives children (and parents and teachers) a targeted list of words that need more work — far more efficient than repeating an entire word list when only a few words need attention.'],
  ['q' => 'Is this spelling quiz aligned with school spelling curricula?',
   'a' => 'Yes — word lists are chosen to align with common primary school curricula in the UK, US, and Australia. Grade 1 matches Year 1 common word lists. Grade 4 includes prefix/suffix patterns taught at Key Stage 2. Grades 5–6 words align with the Year 5–6 statutory spelling list used in England.'],
  ['q' => 'Can I use Challenge Mode to prepare for a school spelling test?',
   'a' => 'Yes — that\'s exactly what it\'s designed for. The 60-second timer and limited hints replicate the conditions of a classroom spelling test. Children who practise in Challenge Mode before a test are more confident because they\'ve already experienced the time pressure in a low-stakes environment. Use the "Practice Again" list for targeted review.'],
  ['q' => 'Is this spelling quiz free and ad-free for children?',
   'a' => 'Completely free and 100% ad-free. No signup or account is needed. MindSnap\'s Kids Zone never shows advertisements to children. The quiz runs in any browser on phones, tablets, and computers — no app download required. No personal data is collected or stored.'],
];

$relatedTools = [
  ['icon' => '💬', 'name' => 'Word Games',    'slug' => 'kids/word-games',    'desc' => 'Rhymes, associations, and sentences.'],
  ['icon' => '🧮', 'name' => 'Math Puzzles',  'slug' => 'kids/math-puzzles',  'desc' => 'Fun puzzles for ages 5–14.'],
  ['icon' => '🔬', 'name' => 'Science Quiz',  'slug' => 'kids/science-quiz',  'desc' => 'Space, animals, chemistry and more.'],
  ['icon' => '🦁', 'name' => 'Animal Quiz',   'slug' => 'kids/animal-quiz',   'desc' => 'Habitats, diets, and fun facts.'],
];
@endphp

@section('styles')
<style>
.sp-panel-icon  { font-size:5rem; line-height:1.2; }
.sp-mode-desc   { font-size:.75rem; }
.sp-related-desc { font-size:.8rem; }
.sp-progress    { height:8px; }
</style>
@endsection

@section('content')

{{-- ── Hero ─────────────────────────────────────────────────────────────────── --}}
<section class="ms-hero">
  <div class="container-xl">
    <div class="row align-items-start g-5">
      <div class="col-lg-7">
        <x-breadcrumb :crumbs="[
          ['url' => route('home'),          'name' => 'Home'],
          ['url' => route('category.kids'), 'name' => 'Kids Zone'],
          ['url' => '',                     'name' => 'Spelling Quiz'],
        ]"/>

        <h1 class="mb-2 ms-hero-title">🔤 Spelling Quiz for Kids</h1>
        <p class="ms-hero-desc">
          Grade-by-grade spelling practice with phonetic hints, scrambled-letter animations, and a
          "Practice Again" list for missed words. Choose Practice Mode or timed Challenge Mode.
          No ads, no signup — completely free.
        </p>

        {{-- ── Tool ─────────────────────────────────────────────────────────── --}}
        <div class="ms-tool-card p-4" id="spellingApp">

          {{-- Setup screen --}}
          <div id="setupScreen">
            <div class="mb-4">
              <label class="fw-semibold mb-2 d-block">Choose your grade level:</label>
              <div class="d-flex flex-wrap gap-2">
                <button class="btn btn-outline-primary grade-btn" data-grade="1">Grade 1</button>
                <button class="btn btn-outline-primary grade-btn" data-grade="2">Grade 2</button>
                <button class="btn btn-outline-primary grade-btn" data-grade="3">Grade 3</button>
                <button class="btn btn-outline-primary grade-btn" data-grade="4">Grade 4</button>
                <button class="btn btn-outline-primary grade-btn" data-grade="56">Grades 5–6</button>
              </div>
            </div>
            <div class="mb-4">
              <label class="fw-semibold mb-2 d-block">Choose your mode:</label>
              <div class="row g-2">
                <div class="col-6">
                  <button class="btn btn-outline-success w-100 py-3 mode-btn active-mode" data-mode="practice" id="practiceBtn">
                    <div class="fs-4">📚</div>
                    <div class="fw-semibold small mt-1">Practice Mode</div>
                    <div class="text-muted sp-mode-desc">No timer · Unlimited hints</div>
                  </button>
                </div>
                <div class="col-6">
                  <button class="btn btn-outline-danger w-100 py-3 mode-btn" data-mode="challenge" id="challengeBtn">
                    <div class="fs-4">⏱️</div>
                    <div class="fw-semibold small mt-1">Challenge Mode</div>
                    <div class="text-muted sp-mode-desc">60s timer · 3 hints max</div>
                  </button>
                </div>
              </div>
            </div>
            <button class="btn btn-primary btn-lg w-100" id="startBtn" disabled>Start Spelling Quiz →</button>
          </div>

          {{-- Quiz screen --}}
          <div id="quizScreen" class="d-none">
            {{-- Header bar --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
              <div class="d-flex gap-2 align-items-center">
                <small class="text-muted">Word <span id="spWordNum">1</span> of 10</small>
                <span class="badge bg-light text-dark border" id="spModeLabel">Practice</span>
              </div>
              <div class="d-flex gap-2 align-items-center">
                <span id="spTimerWrap" class="d-none badge bg-danger fs-6">⏱ <span id="spTimer">60</span>s</span>
                <span class="badge bg-warning text-dark">💡 <span id="spHintsLeft">∞</span> hints</span>
              </div>
            </div>

            {{-- Progress --}}
            <div class="progress mb-4 sp-progress">
              <div id="spProgressBar" class="progress-bar bg-success"></div>
            </div>

            {{-- Stars --}}
            <div class="text-center mb-1">
              <span class="fs-4" id="spStars">⭐⭐⭐⭐⭐</span>
            </div>

            {{-- Scrambled word display --}}
            <div class="text-center mb-3">
              <div class="d-flex justify-content-center gap-2 flex-wrap" id="spScrambled"></div>
            </div>

            {{-- Hint area --}}
            <div id="spHintBox" class="alert alert-light text-muted small d-none mb-3">
              <div><strong>Category:</strong> <span id="spHintCategory"></span></div>
              <div><strong>Sounds like:</strong> <span id="spHintPhonetic"></span></div>
            </div>

            {{-- Input --}}
            <div class="d-flex gap-2 mb-3">
              <input type="text" class="form-control form-control-lg text-center" id="spInput"
                     placeholder="Type the word…" autocomplete="off" autocorrect="off" spellcheck="false">
              <button class="btn btn-outline-info" id="spHintBtn" title="Get a hint">💡</button>
            </div>
            <div class="d-flex gap-2">
              <button class="btn btn-primary flex-grow-1" id="spSubmit">Check ✓</button>
              <button class="btn btn-outline-secondary" id="spSkip">Skip →</button>
            </div>

            {{-- Feedback --}}
            <div id="spFeedback" class="mt-3 d-none alert"></div>
          </div>

          {{-- Results screen --}}
          <div id="resultsScreen" class="d-none">
            <div class="text-center mb-4">
              <div class="display-1 mb-2" id="spResultEmoji">🏆</div>
              <h2 class="h3" id="spResultHeading">Round Complete!</h2>
              <p class="text-muted" id="spResultMsg"></p>
            </div>
            <div class="row g-3 mb-4 text-center">
              <div class="col-4">
                <div class="border rounded p-2">
                  <div class="fs-3 text-success fw-bold" id="spCorrectCount">0</div>
                  <small>Correct</small>
                </div>
              </div>
              <div class="col-4">
                <div class="border rounded p-2">
                  <div class="fs-3 text-danger fw-bold" id="spWrongCount">0</div>
                  <small>Incorrect</small>
                </div>
              </div>
              <div class="col-4">
                <div class="border rounded p-2">
                  <div class="fs-3 text-warning fw-bold" id="spStarCount">⭐</div>
                  <small>Stars</small>
                </div>
              </div>
            </div>

            {{-- Practice Again list --}}
            <div id="practiceAgainBlock" class="d-none mb-4">
              <h3 class="h6 fw-bold text-danger mb-2">📝 Practice Again:</h3>
              <div id="practiceAgainList" class="d-flex flex-wrap gap-2"></div>
            </div>

            <div class="d-flex gap-2 justify-content-center">
              <button class="btn btn-primary" id="spPlayAgain">🔄 New Round</button>
              <button class="btn btn-outline-secondary" id="spChangeSetup">Change Grade / Mode</button>
            </div>
          </div>

        </div>{{-- /ms-tool-card --}}
      </div>

      <div class="col-lg-5 d-none d-lg-flex align-items-center justify-content-center">
        <div class="text-center p-4">
          <div class="sp-panel-icon">🔤</div>
          <div class="fs-1 mt-2">📚⏱️✨</div>
          <p class="text-muted mt-3 small">Grades 1–6 · Practice or Challenge Mode · Phonetic hints</p>
          <div class="d-flex flex-column gap-2 mt-3 text-start">
            <span class="badge bg-success p-2">📚 Practice Mode — no timer, unlimited hints</span>
            <span class="badge bg-danger p-2">⏱️ Challenge Mode — 60s timer, 3 hints</span>
            <span class="badge bg-info text-dark p-2">💡 Phonetic hints — "kold" for "cold"</span>
            <span class="badge bg-warning text-dark p-2">📝 Practice Again list for missed words</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ── SEO Sections ─────────────────────────────────────────────────────────── --}}
<section class="ms-section-white py-5">
  <div class="container-xl">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <h2 class="h3 mb-3">Free Online Spelling Test for Kids — Grades 1 to 6 Word Lists</h2>
        <p>
          Spelling is a foundational literacy skill, but traditional spelling practice — copying words from
          a list — is one of the least effective ways to learn them. Research in cognitive science consistently
          shows that retrieval practice (trying to recall a word from memory) leads to far stronger retention
          than re-reading or copying. MindSnap's spelling quiz is built on this principle: every question
          requires the child to retrieve the correct spelling from memory and type it, making each session
          genuinely educational rather than just busywork.
        </p>
        <p>
          The five grade levels cover the full primary school spelling journey. Grade 1 focuses on simple
          CVC (consonant-vowel-consonant) words that form the foundation of English phonics: cat, dog, sit,
          run, hot, big. Grade 2 introduces consonant blends (flag, step, clap) and simple digraphs.
          Grade 3 covers long vowel patterns and digraphs (phone, knight, thought). Grade 4 adds morphology:
          prefixes (un-, pre-, dis-) and suffixes (-ful, -less, -ness) that unlock the meaning and spelling
          of hundreds of related words. Grades 5–6 cover the complex, often irregular, words that challenge
          even adult spellers — necessary, rhythm, conscience, guarantee.
        </p>

        <h2 class="h3 mt-5 mb-3">Practice Mode vs Challenge Mode: How to Choose for Your Child</h2>
        <p>
          Practice Mode is the right choice when a child is encountering a word list for the first time, or
          when they found many words difficult in a previous round. With no timer and unlimited hints, children
          can take their time, use the phonetic pronunciation guide, and read the context clue before typing.
          This low-pressure environment is especially important for children who experience spelling anxiety —
          a surprisingly common phenomenon that causes children to underperform on spelling tests despite knowing
          the words.
        </p>
        <p>
          Challenge Mode is designed for consolidation and test preparation. The 60-second timer per word
          approximates the time pressure of a classroom spelling test. The limit of 3 hints per round means
          children must rely on their memory rather than the hint system. Crucially, the "Practice Again"
          list at the end of every Challenge Mode round shows exactly which words need more work — allowing
          parents and teachers to target practice sessions efficiently rather than repeating all 10 words
          regardless of which ones were already mastered.
        </p>

        <h2 class="h3 mt-5 mb-3">Phonetic Hints and Scrambled Letters: Learning Through Engagement</h2>
        <p>
          The phonetic hint system shows how a word sounds spelled out — "nee-suh-suh-ree" for "necessary",
          "rit-um" for "rhythm". This approach mirrors the "sound it out" strategy taught in phonics lessons
          and reinforces the connection between spoken and written language. Unlike audio pronunciation guides
          that require special hardware or browser permissions, phonetic text hints work instantly on every
          device — including classroom tablets in school buildings with restricted audio settings.
        </p>
        <p>
          The scrambled-letter display adds a visual and engaging dimension to an otherwise traditional
          spelling activity. Seeing the correct letters present but in the wrong order helps children focus on
          letter choice and quantity (a key source of spelling errors) rather than having to retrieve every
          letter from zero. When the correct answer is entered and the letters animate into place, the visual
          reward reinforces the correct spelling in working memory — a small but meaningful enhancement over
          a plain text input field. Combined with the five-star progress bar and the encouraging messages,
          the overall experience is designed to associate spelling with confidence rather than anxiety.
        </p>
      </div>
    </div>
  </div>
</section>

{{-- ── FAQ ─────────────────────────────────────────────────────────────────── --}}
<section class="ms-section-alt py-5">
  <div class="container-xl">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <h2 class="h3 mb-4 text-center">Frequently Asked Questions</h2>
        <div class="accordion" id="faqAccordionSP">
          @foreach($faqs as $i => $faq)
          <div class="accordion-item">
            <h3 class="accordion-header">
              <button class="accordion-button {{ $i > 0 ? 'collapsed' : '' }}"
                      type="button"
                      data-bs-toggle="collapse"
                      data-bs-target="#faq-sp-{{ $i }}"
                      aria-expanded="{{ $i === 0 ? 'true' : 'false' }}"
                      aria-controls="faq-sp-{{ $i }}">
                {{ $faq['q'] }}
              </button>
            </h3>
            <div id="faq-sp-{{ $i }}" class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}" data-bs-parent="#faqAccordionSP">
              <div class="accordion-body text-muted">{!! $faq['a'] !!}</div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

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
            <div class="text-muted sp-related-desc">{{ $tool['desc'] }}</div>
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

  // ── Word lists ───────────────────────────────────────────────────────────────
  const wordLists = {
    1: [
      { w:'cat',  hint:'A small furry pet that meows', ph:'kat' },
      { w:'dog',  hint:'A common furry pet that barks', ph:'dog' },
      { w:'run',  hint:'To move faster than walking', ph:'run' },
      { w:'big',  hint:'The opposite of small', ph:'big' },
      { w:'hot',  hint:'The opposite of cold', ph:'hot' },
      { w:'sun',  hint:'The star at the centre of our solar system', ph:'sun' },
      { w:'cup',  hint:'You drink tea or juice from this', ph:'kup' },
      { w:'map',  hint:'A drawing that shows where places are', ph:'map' },
      { w:'sit',  hint:'What you do in a chair', ph:'sit' },
      { w:'hat',  hint:'You wear this on your head', ph:'hat' },
      { w:'bed',  hint:'Where you sleep at night', ph:'bed' },
      { w:'fox',  hint:'A red wild animal with a bushy tail', ph:'foks' },
      { w:'hen',  hint:'A female chicken', ph:'hen' },
      { w:'log',  hint:'A thick piece of wood from a tree', ph:'log' },
      { w:'wet',  hint:'The opposite of dry', ph:'wet' },
    ],
    2: [
      { w:'flag',  hint:'A piece of cloth that represents a country', ph:'flag' },
      { w:'stop',  hint:'To not move anymore; the opposite of go', ph:'stop' },
      { w:'clap',  hint:'What you do with your hands when someone does well', ph:'klap' },
      { w:'frog',  hint:'A green amphibian that jumps and croaks', ph:'frog' },
      { w:'slip',  hint:'To slide accidentally on a wet floor', ph:'slip' },
      { w:'drum',  hint:'A round musical instrument you hit with sticks', ph:'drum' },
      { w:'stem',  hint:'The stalk of a plant or flower', ph:'stem' },
      { w:'bled',  hint:'Past tense of bleed — when blood comes out', ph:'bled' },
      { w:'drip',  hint:'When water falls slowly drop by drop', ph:'drip' },
      { w:'snap',  hint:'To break something quickly, or the sound it makes', ph:'snap' },
      { w:'grip',  hint:'To hold something tightly', ph:'grip' },
      { w:'brim',  hint:'The edge at the top of a cup or hat', ph:'brim' },
      { w:'sled',  hint:'A vehicle used for sliding down snowy hills', ph:'sled' },
      { w:'crab',  hint:'A sea creature with claws and a shell', ph:'krab' },
      { w:'trim',  hint:'To cut the edges of something neatly', ph:'trim' },
    ],
    3: [
      { w:'phone',   hint:'A device you use to call people', ph:'fone' },
      { w:'night',   hint:'The dark time when the sun has gone down', ph:'nite' },
      { w:'thought', hint:'Past tense of think; an idea in your mind', ph:'thort' },
      { w:'enough',  hint:'When you have the right amount of something', ph:'ee-nuf' },
      { w:'rough',   hint:'Not smooth; the opposite of smooth or calm', ph:'ruf' },
      { w:'cough',   hint:'A sound made when something tickles your throat', ph:'kof' },
      { w:'knight',  hint:'An armoured warrior from medieval times', ph:'nite' },
      { w:'bright',  hint:'Very light or vivid; very intelligent', ph:'brite' },
      { w:'graph',   hint:'A diagram showing data as bars or lines', ph:'graf' },
      { w:'whole',   hint:'All of something; not broken into parts', ph:'hole' },
      { w:'cheese',  hint:'A food made from milk, often yellow or white', ph:'cheez' },
      { w:'bridge',  hint:'A structure built over a river or road', ph:'brij' },
      { w:'change',  hint:'To become different', ph:'chaynj' },
      { w:'plant',   hint:'A living thing that grows from soil and needs sunlight', ph:'plant' },
      { w:'tooth',   hint:'One of the hard white things in your mouth', ph:'tooth' },
    ],
    4: [
      { w:'unhappy',    hint:'Not happy; feeling sad — begins with a prefix meaning "not"', ph:'un-hap-ee' },
      { w:'careful',    hint:'Being safe and paying attention — ends with a suffix meaning "full of"', ph:'kair-ful' },
      { w:'hopeless',   hint:'Without any hope — ends with a suffix meaning "without"', ph:'hope-les' },
      { w:'darkness',   hint:'The state of being dark — ends with a suffix meaning "state of"', ph:'dark-nes' },
      { w:'preview',    hint:'To watch or see something before others do — prefix means "before"', ph:'pree-vyoo' },
      { w:'disagree',   hint:'To not agree with someone — prefix means "not" or "opposite"', ph:'dis-uh-gree' },
      { w:'enjoyment',  hint:'The feeling of pleasure — suffix means "the state of"', ph:'en-joy-ment' },
      { w:'wonderful',  hint:'Extremely good or impressive — suffix means "full of"', ph:'wun-der-ful' },
      { w:'invisible',  hint:'Something you cannot see — prefix means "not"', ph:'in-viz-uh-bul' },
      { w:'retell',     hint:'To tell a story again — prefix means "again"', ph:'ree-tel' },
      { w:'powerless',  hint:'Having no power or strength — suffix means "without"', ph:'pow-er-les' },
      { w:'misread',    hint:'To read something incorrectly — prefix means "wrongly"', ph:'mis-reed' },
      { w:'happiness',  hint:'The state or feeling of being happy — suffix means "state of"', ph:'hap-ee-nes' },
      { w:'incorrect',  hint:'Not correct; wrong — prefix means "not"', ph:'in-kuh-rekt' },
      { w:'breathless', hint:'Out of breath; unable to breathe — suffix means "without"', ph:'breth-les' },
    ],
    56: [
      { w:'necessary',   hint:'Something you must have or do; essential', ph:'nes-uh-ser-ee' },
      { w:'rhythm',      hint:'A regular beat or pattern in music or poetry', ph:'rith-um' },
      { w:'conscience',  hint:'The feeling inside that tells you right from wrong', ph:'kon-shuns' },
      { w:'guarantee',   hint:'A firm promise that something will happen or work', ph:'gar-un-tee' },
      { w:'believe',     hint:'To think something is true or real', ph:'buh-leev' },
      { w:'February',    hint:'The second month of the year', ph:'Feb-roo-er-ee' },
      { w:'environment', hint:'The world of nature around us', ph:'en-vy-run-munt' },
      { w:'appreciate',  hint:'To be grateful for something; to understand its value', ph:'uh-pree-shee-ayt' },
      { w:'privilege',   hint:'A special right or advantage given to someone', ph:'priv-uh-lij' },
      { w:'separate',    hint:'To keep apart; or two things not joined together', ph:'sep-uh-rate' },
      { w:'exaggerate',  hint:'To make something seem bigger or more extreme than it is', ph:'eg-zaj-uh-rate' },
      { w:'immediately', hint:'Right now; without any delay', ph:'ih-mee-dee-ut-lee' },
      { w:'parliament',  hint:'The group of people who make laws for a country', ph:'par-luh-munt' },
      { w:'recommend',   hint:'To suggest something as a good choice', ph:'rek-uh-mend' },
      { w:'sufficient',  hint:'Enough; as much as is needed', ph:'suh-fish-unt' },
    ],
  };

  // ── State ─────────────────────────────────────────────────────────────────────
  let selectedGrade = null, selectedMode = 'practice';
  let pool = [], current = 0, correct = 0, wrong = 0, hintsLeft = Infinity;
  let practiceAgain = [], timerInterval = null, timeLeft = 60;
  let hintUsedThisWord = false, answered = false;

  // ── DOM refs ──────────────────────────────────────────────────────────────────
  const setupScreen    = document.getElementById('setupScreen');
  const quizScreen     = document.getElementById('quizScreen');
  const resultsScreen  = document.getElementById('resultsScreen');
  const startBtn       = document.getElementById('startBtn');
  const spWordNum      = document.getElementById('spWordNum');
  const spModeLabel    = document.getElementById('spModeLabel');
  const spTimerWrap    = document.getElementById('spTimerWrap');
  const spTimerEl      = document.getElementById('spTimer');
  const spHintsLeft    = document.getElementById('spHintsLeft');
  const spProgressBar  = document.getElementById('spProgressBar');
  const spStars        = document.getElementById('spStars');
  const spScrambled    = document.getElementById('spScrambled');
  const spHintBox      = document.getElementById('spHintBox');
  const spHintCategory = document.getElementById('spHintCategory');
  const spHintPhonetic = document.getElementById('spHintPhonetic');
  const spInput        = document.getElementById('spInput');
  const spSubmit       = document.getElementById('spSubmit');
  const spSkip         = document.getElementById('spSkip');
  const spHintBtn      = document.getElementById('spHintBtn');
  const spFeedback     = document.getElementById('spFeedback');
  const spCorrectCount = document.getElementById('spCorrectCount');
  const spWrongCount   = document.getElementById('spWrongCount');
  const spStarCount    = document.getElementById('spStarCount');
  const spResultEmoji  = document.getElementById('spResultEmoji');
  const spResultHeading= document.getElementById('spResultHeading');
  const spResultMsg    = document.getElementById('spResultMsg');

  // ── Grade selection ───────────────────────────────────────────────────────────
  document.querySelectorAll('.grade-btn').forEach(btn => {
    btn.addEventListener('click', function () {
      document.querySelectorAll('.grade-btn').forEach(b => b.classList.remove('active'));
      this.classList.add('active');
      selectedGrade = this.dataset.grade;
      updateStartBtn();
    });
  });

  // ── Mode selection ────────────────────────────────────────────────────────────
  document.querySelectorAll('.mode-btn').forEach(btn => {
    btn.addEventListener('click', function () {
      document.querySelectorAll('.mode-btn').forEach(b => {
        b.classList.remove('active-mode','btn-success','btn-danger');
        b.classList.add('btn-outline-success');
        if (b.dataset.mode === 'challenge') { b.classList.remove('btn-outline-success'); b.classList.add('btn-outline-danger'); }
      });
      selectedMode = this.dataset.mode;
      if (selectedMode === 'practice') {
        this.classList.remove('btn-outline-success'); this.classList.add('btn-success','active-mode');
      } else {
        this.classList.remove('btn-outline-danger'); this.classList.add('btn-danger','active-mode');
      }
      updateStartBtn();
    });
  });

  function updateStartBtn() {
    startBtn.disabled = !selectedGrade;
  }

  startBtn.addEventListener('click', startQuiz);
  document.getElementById('spPlayAgain').addEventListener('click', startQuiz);
  document.getElementById('spChangeSetup').addEventListener('click', () => {
    clearInterval(timerInterval);
    resultsScreen.classList.add('d-none');
    quizScreen.classList.add('d-none');
    setupScreen.classList.remove('d-none');
  });

  spSubmit.addEventListener('click', submitAnswer);
  spInput.addEventListener('keydown', e => { if (e.key === 'Enter') submitAnswer(); });
  spSkip.addEventListener('click', skipWord);
  spHintBtn.addEventListener('click', showHint);

  // ── Quiz logic ────────────────────────────────────────────────────────────────
  function startQuiz() {
    const list = wordLists[selectedGrade];
    pool = shuffle([...list]).slice(0, 10);
    current = 0; correct = 0; wrong = 0; practiceAgain = [];
    hintsLeft = selectedMode === 'practice' ? Infinity : 3;

    setupScreen.classList.add('d-none');
    resultsScreen.classList.add('d-none');
    quizScreen.classList.remove('d-none');

    spModeLabel.textContent = selectedMode === 'practice' ? '📚 Practice' : '⏱️ Challenge';
    if (selectedMode === 'challenge') {
      spTimerWrap.classList.remove('d-none');
    } else {
      spTimerWrap.classList.add('d-none');
    }
    updateHintsDisplay();
    loadWord();
  }

  function loadWord() {
    if (current >= pool.length) { endQuiz(); return; }
    answered = false; hintUsedThisWord = false;
    const entry = pool[current];
    spWordNum.textContent = current + 1;
    spProgressBar.style.width = (current / pool.length * 100) + '%';
    spInput.value = '';
    spInput.focus();
    spFeedback.className = 'd-none alert';
    spHintBox.classList.add('d-none');
    spHintCategory.textContent = '';
    spHintPhonetic.textContent = '';

    // Scramble the word
    const scrambled = shuffle([...entry.w]);
    spScrambled.innerHTML = '';
    scrambled.forEach(ch => {
      const span = document.createElement('span');
      span.className = 'badge bg-primary fs-5 p-2';
      span.textContent = ch.toUpperCase();
      spScrambled.appendChild(span);
    });

    // Stars based on score so far
    updateStars();

    // Challenge mode timer (per word)
    clearInterval(timerInterval);
    if (selectedMode === 'challenge') {
      timeLeft = 60;
      spTimerEl.textContent = timeLeft;
      timerInterval = setInterval(() => {
        timeLeft--;
        spTimerEl.textContent = timeLeft;
        if (timeLeft <= 0) { clearInterval(timerInterval); timeExpired(); }
      }, 1000);
    }
  }

  function timeExpired() {
    const entry = pool[current];
    wrong++;
    practiceAgain.push(entry.w);
    spFeedback.className = 'mt-3 alert alert-danger';
    spFeedback.textContent = '⏱ Time\'s up! The word was: ' + entry.w.toUpperCase();
    spFeedback.classList.remove('d-none');
    revealCorrect(entry.w);
    setTimeout(() => { current++; loadWord(); }, 1800);
  }

  function submitAnswer() {
    if (answered) return;
    const entry = pool[current];
    const val = spInput.value.trim().toLowerCase();
    if (!val) return;
    clearInterval(timerInterval);
    answered = true;

    if (val === entry.w) {
      correct++;
      spFeedback.className = 'mt-3 alert alert-success';
      spFeedback.textContent = '✅ Correct! "' + entry.w.toUpperCase() + '" is right! 🌟';
      animateScrambled();
    } else {
      wrong++;
      practiceAgain.push(entry.w);
      spFeedback.className = 'mt-3 alert alert-warning';
      spFeedback.textContent = 'Not quite! The correct spelling is: ' + entry.w.toUpperCase() + ' 💪';
    }
    spFeedback.classList.remove('d-none');
    setTimeout(() => { current++; loadWord(); }, 1800);
  }

  function skipWord() {
    if (answered) return;
    clearInterval(timerInterval);
    answered = true;
    const entry = pool[current];
    wrong++;
    practiceAgain.push(entry.w);
    spFeedback.className = 'mt-3 alert alert-info';
    spFeedback.textContent = 'Skipped! The word was: ' + entry.w.toUpperCase();
    spFeedback.classList.remove('d-none');
    setTimeout(() => { current++; loadWord(); }, 1500);
  }

  function showHint() {
    if (hintsLeft === 0) return;
    if (hintsLeft !== Infinity) hintsLeft--;
    updateHintsDisplay();
    const entry = pool[current];
    spHintCategory.textContent = entry.hint;
    spHintPhonetic.textContent = '"' + entry.ph + '"';
    spHintBox.classList.remove('d-none');
  }

  function updateHintsDisplay() {
    spHintsLeft.textContent = hintsLeft === Infinity ? '∞' : hintsLeft;
    spHintBtn.disabled = hintsLeft === 0;
  }

  function animateScrambled() {
    // Flash all letter badges green
    spScrambled.querySelectorAll('.badge').forEach((b, i) => {
      setTimeout(() => {
        b.classList.replace('bg-primary','bg-success');
      }, i * 80);
    });
    // Rearrange to show correct word
    setTimeout(() => {
      const entry = pool[current];
      spScrambled.innerHTML = '';
      entry.w.split('').forEach(ch => {
        const span = document.createElement('span');
        span.className = 'badge bg-success fs-5 p-2';
        span.textContent = ch.toUpperCase();
        spScrambled.appendChild(span);
      });
    }, 400);
  }

  function revealCorrect(word) {
    spScrambled.innerHTML = '';
    word.split('').forEach(ch => {
      const span = document.createElement('span');
      span.className = 'badge bg-danger fs-5 p-2';
      span.textContent = ch.toUpperCase();
      spScrambled.appendChild(span);
    });
  }

  function updateStars() {
    const remaining = pool.length - current;
    if (remaining <= 0) return;
    const pct = correct / Math.max(current, 1);
    const stars = current === 0 ? 5 : Math.max(1, Math.round(pct * 5));
    spStars.textContent = '⭐'.repeat(stars) + '☆'.repeat(5 - stars);
  }

  function endQuiz() {
    clearInterval(timerInterval);
    quizScreen.classList.add('d-none');
    resultsScreen.classList.remove('d-none');

    const pct = correct / pool.length;
    let emoji, heading, msg, stars;
    if (pct >= 0.9)       { emoji='🏆'; heading='Outstanding Speller!'; msg='You\'re a spelling superstar! 🌟'; stars=5; }
    else if (pct >= 0.7)  { emoji='⭐'; heading='Great Job!';            msg='Really strong spelling — keep it up! 💪'; stars=4; }
    else if (pct >= 0.5)  { emoji='📚'; heading='Good Effort!';          msg='Nice work! Practice the "Practice Again" words below. 😊'; stars=3; }
    else                   { emoji='💡'; heading='Keep Practising!';     msg='Every expert was once a beginner — try again! 📖'; stars=1; }

    spResultEmoji.textContent  = emoji;
    spResultHeading.textContent = heading;
    spResultMsg.textContent    = msg;
    spCorrectCount.textContent = correct;
    spWrongCount.textContent   = wrong;
    spStarCount.textContent    = '⭐'.repeat(stars);

    const pa = document.getElementById('practiceAgainBlock');
    const paList = document.getElementById('practiceAgainList');
    paList.innerHTML = '';
    if (practiceAgain.length > 0) {
      pa.classList.remove('d-none');
      practiceAgain.forEach(w => {
        const badge = document.createElement('span');
        badge.className = 'badge bg-danger fs-6 p-2';
        badge.textContent = w.toUpperCase();
        paList.appendChild(badge);
      });
    } else {
      pa.classList.add('d-none');
    }
  }

  function shuffle(arr) { return arr.sort(() => Math.random() - 0.5); }

})();
</script>
@endpush
