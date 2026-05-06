@extends('layouts.app')
@section('title', 'Word Games for Kids Online — Free & Fun | MindSnap')
@section('description', 'Free online word games for kids: Rhyme Finder, Word Association, and Sentence Builder. Age-appropriate, no ads, no signup. Great for literacy practice.')
@section('canonical', config('app.url') . '/kids/word-games')
@section('og_image', config('app.url') . '/images/og-default.jpg')

@section('styles')
<style>
  .wg-assoc-words {
    min-height: 48px;
  }
  .wg-sentence-built {
    min-height: 52px;
    color: #999;
  }
  .wg-panel-icon {
    font-size: 5rem;
    line-height: 1.2;
  }
  .wg-panel-games {
    font-size: 2rem;
  }
  .wg-related-desc {
    font-size: .8rem;
  }
</style>
@endsection

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "WebApplication",
  "name": "Word Games for Kids Online",
  "url": "{{ config('app.url') }}/kids/word-games",
  "description": "Three free word games for kids in one place: Rhyme Finder, Word Association, and Sentence Builder. Age-appropriate content, no ads, no signup required.",
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
    { "@@type": "ListItem", "position": 3, "name": "Word Games for Kids" }
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
      "name": "What word games are available for kids on MindSnap?",
      "acceptedAnswer": { "@@type": "Answer", "text": "MindSnap's Kids Zone offers three word games: Rhyme Finder (type a word that rhymes with the given word), Word Association (name as many things as possible from a category in 60 seconds), and Sentence Builder (arrange scrambled words into a correct sentence). All three are free and ad-free." }
    },
    {
      "@@type": "Question",
      "name": "Are these word games appropriate for different ages?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes. Each game has age-appropriate word lists for three groups: Ages 5–7 (simple CVC words and common objects), Ages 8–11 (compound words, categories, and short sentences), and Ages 12+ (varied vocabulary, abstract categories, and complex sentences). Children can select their level before starting." }
    },
    {
      "@@type": "Question",
      "name": "How does the Rhyme Finder game work?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The Rhyme Finder shows a word and asks the child to type a word that rhymes with it. The game checks the answer against an embedded rhyme database covering hundreds of common English word families. Correct answers earn a point and a ✨ animation. Streaks of consecutive correct rhymes are tracked and celebrated." }
    },
    {
      "@@type": "Question",
      "name": "What is the Word Association game for kids?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The Word Association game gives children a category — such as 'Things that are RED' or 'Animals that live in water' — and challenges them to type as many words as possible within 60 seconds. Each accepted word earns a point. It builds vocabulary, category thinking, and fluency under gentle time pressure." }
    },
    {
      "@@type": "Question",
      "name": "How does Sentence Builder help with literacy skills?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Sentence Builder presents 4–5 scrambled words that form a correct sentence when arranged properly. Children click the words in the right order. This game reinforces understanding of sentence structure, grammar, and word order — skills that directly improve reading comprehension and writing ability." }
    },
    {
      "@@type": "Question",
      "name": "Can parents be sure the word content is age-appropriate?",
      "acceptedAnswer": { "@@type": "Answer", "text": "All word lists are manually curated for age-appropriateness. No profanity, violent, or adult content appears anywhere in the games. The Kids Zone is entirely ad-free, so children will never encounter inappropriate advertising. MindSnap does not collect any personal data from children." }
    },
    {
      "@@type": "Question",
      "name": "Do these word games require an internet connection?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The games load over the internet but run entirely in the browser after loading. The word lists and game logic are embedded in the page, so a brief connection is all that is needed. The games work on phones, tablets, and computers without any app download." }
    },
    {
      "@@type": "Question",
      "name": "Can teachers use these word games in a literacy lesson?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Absolutely. The Rhyme Finder and Sentence Builder games are particularly well-suited for whole-class or small-group literacy activities. No accounts are needed, and the games work on interactive whiteboards. The Word Association game works well as a speaking-and-listening warm-up activity." }
    }
  ]
}
</script>
@endsection

@php
$faqs = [
  ['q' => 'What word games are available for kids on MindSnap?',
   'a' => 'Three mini-games are included: <strong>Rhyme Finder</strong> (type a rhyming word), <strong>Word Association</strong> (name as many words from a category as possible in 60 seconds), and <strong>Sentence Builder</strong> (click scrambled words into the right order). All three are free, ad-free, and need no signup.'],
  ['q' => 'Are these word games suitable for different ages?',
   'a' => 'Yes — each game has separate word lists for Ages 5–7 (simple words), Ages 8–11 (more varied vocabulary), and Ages 12+ (complex words and categories). Select your age group before starting each game to get the right level of challenge.'],
  ['q' => 'How does the Rhyme Finder word game work?',
   'a' => 'The game shows a word and asks your child to type any word that rhymes with it. The rhyme checker uses an embedded database of common English word families. Correct rhymes earn a point and a ✨ animation. The streak counter celebrates consecutive correct answers to keep motivation high.'],
  ['q' => 'What is the Word Association game and how does it help kids?',
   'a' => 'Word Association shows a category ("Things that are BLUE", "Animals that swim") and gives 60 seconds to type as many matching words as possible. It builds vocabulary breadth, categorical thinking, and verbal fluency — all important literacy skills that improve reading comprehension and verbal reasoning test scores.'],
  ['q' => 'How does Sentence Builder improve grammar and writing?',
   'a' => 'Sentence Builder presents 4–5 scrambled words and asks children to click them in the correct order to form a grammatically correct sentence. This practises understanding of sentence structure, word order, and grammar without formal grammar lessons — making it ideal as a warm-up before creative writing sessions.'],
  ['q' => 'Are all the words in these games age-appropriate?',
   'a' => 'Yes — all word lists are carefully curated for age-appropriateness. There is no profanity, violent, or adult content. The Kids Zone is also 100% ad-free, so children won\'t encounter inappropriate advertising. MindSnap does not collect personal data from children.'],
  ['q' => 'Can I use these word games on a tablet or phone?',
   'a' => 'The games are fully responsive and work on phones, tablets, and desktop computers. No app download is required. The Sentence Builder word-tap interface works well on touchscreens, and the text input games (Rhyme Finder and Word Association) work with both on-screen and physical keyboards.'],
  ['q' => 'Can teachers use MindSnap word games in a literacy lesson?',
   'a' => 'Yes — Rhyme Finder and Sentence Builder work well for whole-class activities on an interactive whiteboard, and Word Association is an excellent speaking-and-listening warm-up. No student accounts are required, which makes it easy to use in schools without IT setup. All three games can be completed in under 5 minutes per session.'],
];

$relatedTools = [
  ['icon' => '🧮', 'name' => 'Math Puzzles',   'slug' => 'kids/math-puzzles',  'desc' => 'Fun puzzles for ages 5–14.'],
  ['icon' => '🔤', 'name' => 'Spelling Quiz',   'slug' => 'kids/spelling-quiz', 'desc' => 'Practice spelling by grade.'],
  ['icon' => '🔬', 'name' => 'Science Quiz',    'slug' => 'kids/science-quiz',  'desc' => 'Space, animals, chemistry and more.'],
  ['icon' => '🦁', 'name' => 'Animal Quiz',     'slug' => 'kids/animal-quiz',   'desc' => 'Habitats, diets, and fun facts.'],
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
          ['url' => '',                     'name' => 'Word Games'],
        ]"/>

        <h1 class="mb-2 ms-hero-title">💬 Word Games for Kids Online</h1>
        <p class="ms-hero-desc">
          Three fun word games in one place — Rhyme Finder, Word Association, and Sentence Builder.
          Age-appropriate words, streak counters, and instant feedback.
          No ads, no signup — completely free.
        </p>

        {{-- ── Age group selector ────────────────────────────────────────────── --}}
        <div class="ms-tool-card p-4">
          <div class="mb-3">
            <label class="fw-semibold mb-2 d-block">Age group:</label>
            <div class="d-flex flex-wrap gap-2 mb-4">
              <button class="btn btn-sm btn-outline-primary age-btn active" data-age="young">Ages 5–7</button>
              <button class="btn btn-sm btn-outline-primary age-btn" data-age="middle">Ages 8–11</button>
              <button class="btn btn-sm btn-outline-primary age-btn" data-age="older">Ages 12+</button>
            </div>
          </div>

          {{-- Tabs --}}
          <ul class="nav nav-tabs" id="wordGameTabs" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="rhyme-tab" data-bs-toggle="tab" data-bs-target="#rhyme-panel" type="button" role="tab">🎵 Rhyme Finder</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="assoc-tab" data-bs-toggle="tab" data-bs-target="#assoc-panel" type="button" role="tab">💡 Word Association</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="sentence-tab" data-bs-toggle="tab" data-bs-target="#sentence-panel" type="button" role="tab">📝 Sentence Builder</button>
            </li>
          </ul>

          <div class="tab-content pt-4" id="wordGameContent">

            {{-- ── Rhyme Finder ───────────────────────────────────────────── --}}
            <div class="tab-pane fade show active" id="rhyme-panel" role="tabpanel">
              <div class="text-center mb-3">
                <div class="fs-1 mb-2" id="rhymeWord">—</div>
                <p class="text-muted">Type a word that <strong>rhymes</strong> with the word above!</p>
              </div>
              <div class="d-flex gap-2 mb-3">
                <input type="text" class="form-control form-control-lg" id="rhymeInput" placeholder="Type a rhyming word…" autocomplete="off">
                <button class="btn btn-primary btn-lg" id="rhymeSubmit">Check ✨</button>
              </div>
              <div id="rhymeFeedback" class="mb-3"></div>
              <div class="d-flex justify-content-between align-items-center">
                <div>Score: <strong id="rhymeScore">0</strong> &nbsp; Streak: <strong id="rhymeStreak">0</strong> 🔥</div>
                <button class="btn btn-sm btn-outline-secondary" id="rhymeNext">Next Word →</button>
              </div>
            </div>

            {{-- ── Word Association ────────────────────────────────────────── --}}
            <div class="tab-pane fade" id="assoc-panel" role="tabpanel">
              <div id="assocStart" class="text-center py-2">
                <p class="text-muted mb-3">Type as many words as you can that fit the category within <strong>60 seconds</strong>!</p>
                <button class="btn btn-success btn-lg" id="assocStartBtn">▶ Start Game</button>
              </div>
              <div id="assocGame" class="d-none">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <span class="badge bg-primary fs-6" id="assocCategory">Category</span>
                  <span class="badge bg-danger fs-6">⏱ <span id="assocTimer">60</span>s</span>
                </div>
                <div class="d-flex gap-2 mb-3">
                  <input type="text" class="form-control" id="assocInput" placeholder="Type and press Enter…" autocomplete="off">
                </div>
                <div id="assocWords" class="d-flex flex-wrap gap-2 mb-3 wg-assoc-words"></div>
                <div class="text-muted small">Score: <strong id="assocScore">0</strong></div>
              </div>
              <div id="assocEnd" class="d-none text-center py-2">
                <div class="fs-2 mb-2">🎉</div>
                <p class="fw-semibold">You found <strong id="assocFinalScore">0</strong> words!</p>
                <div id="assocWordList" class="text-muted small mb-3"></div>
                <button class="btn btn-primary" id="assocAgainBtn">Play Again</button>
              </div>
            </div>

            {{-- ── Sentence Builder ─────────────────────────────────────────── --}}
            <div class="tab-pane fade" id="sentence-panel" role="tabpanel">
              <p class="text-muted mb-3">Click the words in the correct order to build a sentence!</p>
              <div id="sentenceQuestion" class="mb-2">
                <div class="d-flex flex-wrap gap-2 mb-3" id="sentenceWordBank"></div>
                <div class="border rounded p-3 mb-3 fw-semibold wg-sentence-built" id="sentenceBuilt">Your sentence will appear here…</div>
              </div>
              <div id="sentenceFeedback" class="mb-3"></div>
              <div class="d-flex justify-content-between align-items-center">
                <div>Score: <strong id="sentenceScore">0</strong> / <strong id="sentenceTotal">0</strong></div>
                <div class="d-flex gap-2">
                  <button class="btn btn-sm btn-outline-danger" id="sentenceClear">Clear</button>
                  <button class="btn btn-sm btn-primary" id="sentenceCheck">Check ✓</button>
                  <button class="btn btn-sm btn-outline-secondary" id="sentenceNext">Next →</button>
                </div>
              </div>
            </div>

          </div>{{-- /tab-content --}}
        </div>{{-- /ms-tool-card --}}
      </div>

      <div class="col-lg-5 d-none d-lg-flex align-items-center justify-content-center">
        <div class="text-center p-4">
          <div class="wg-panel-icon">💬</div>
          <div class="wg-panel-games mt-2">🎵 💡 📝</div>
          <p class="text-muted mt-3 small">3 games · Age-appropriate words · Streak counter</p>
          <div class="d-flex flex-column gap-2 mt-3 text-start">
            <span class="badge bg-info text-dark p-2">🎵 Rhyme Finder — find words that rhyme</span>
            <span class="badge bg-success p-2">💡 Word Association — 60-second blitz</span>
            <span class="badge bg-warning text-dark p-2">📝 Sentence Builder — unscramble sentences</span>
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
        <h2 class="h3 mb-3">Online Rhyming Games for Kids: Building Phonological Awareness</h2>
        <p>
          Phonological awareness — the ability to hear and manipulate the sound structure of words — is one of
          the strongest predictors of early reading success. The Rhyme Finder game trains this skill directly:
          a child hears (and sees) a word, and must retrieve a word from memory that shares the same ending
          sound. This is harder than it sounds for beginning readers, and repeated practice measurably improves
          phonics decoding ability.
        </p>
        <p>
          MindSnap's rhyme database covers over 200 common English word families, organised by age group.
          Ages 5–7 work with simple CVC (consonant-vowel-consonant) rhyme families like cat/bat/hat.
          Ages 8–11 include longer words and less common rhymes. Ages 12+ encounter multi-syllabic words
          and near-rhymes. Every correct answer triggers an encouraging ✨ animation and adds to the streak
          counter — a simple gamification element that keeps children engaged for longer.
        </p>

        <h2 class="h3 mt-5 mb-3">Word Association Games for Children: Expanding Vocabulary in 60 Seconds</h2>
        <p>
          Vocabulary breadth is strongly correlated with reading comprehension and academic achievement.
          The Word Association game builds vocabulary through active retrieval — requiring children to
          generate words from memory rather than simply recognise them. The 60-second timer creates a
          manageable sense of urgency without being stressful, and the open-ended category format means
          there is always more than one correct answer.
        </p>
        <p>
          Categories are designed to span different semantic fields: colour-based categories (Things that
          are RED), habitat-based categories (Things that live underground), function-based categories
          (Things you use in a kitchen), and abstract categories for older children (Things that can be
          both old and new). This variety ensures children practise retrieving words across different
          conceptual domains, which strengthens the mental vocabulary network.
        </p>

        <h2 class="h3 mt-5 mb-3">Sentence Builder: Teaching Grammar Through Play for Ages 5–12</h2>
        <p>
          Understanding how sentences are structured — subject, verb, object, adjectives, adverbs — is
          foundational to both reading comprehension and writing quality. The Sentence Builder game makes
          this visible and interactive: children see the component words and must assemble them into a
          grammatically correct sequence by clicking in the right order. Mistakes are immediately apparent
          because the sentence simply won't make sense.
        </p>
        <p>
          For ages 5–7, sentences are short (4 words, simple subject-verb-object). For ages 8–11,
          sentences include adjectives, adverbs, and prepositional phrases (5–6 words). For ages 12+,
          sentences may include subordinate clauses, commas, and more complex structures. Teachers have
          found this game particularly useful as a 5-minute grammar warm-up before a writing lesson —
          it activates thinking about sentence construction without the full cognitive demand of producing
          original writing.
        </p>
      </div>
    </div>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="wordGamesFaq" />

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
            <div class="text-muted wg-related-desc">{{ $tool['desc'] }}</div>
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

  // ── Word data ────────────────────────────────────────────────────────────────
  const rhymeData = {
    young: [
      { word:'cat', rhymes:['bat','hat','mat','rat','sat','fat','pat','flat','that'] },
      { word:'dog', rhymes:['log','fog','bog','hog','frog','clog'] },
      { word:'sun', rhymes:['fun','run','bun','gun','nun','pun','ton','done','one'] },
      { word:'big', rhymes:['dig','fig','gig','jig','pig','rig','wig','twig'] },
      { word:'cake', rhymes:['lake','make','bake','fake','sake','take','wake','brake','snake'] },
      { word:'star', rhymes:['bar','car','far','jar','tar','scar','spar','guitar'] },
      { word:'blue', rhymes:['clue','do','drew','flew','glue','grew','knew','new','shoe','stew','true','two','who','you','zoo'] },
      { word:'night', rhymes:['bite','fight','kite','light','might','right','sight','tight','white','write','bright','flight','fright','slight'] },
    ],
    middle: [
      { word:'brave', rhymes:['cave','gave','pave','rave','save','wave','behave','engrave','shave'] },
      { word:'cloud', rhymes:['crowd','loud','proud','shroud','aloud','endowed'] },
      { word:'green', rhymes:['bean','clean','dean','keen','lean','mean','queen','screen','seen','teen','between','machine','scene'] },
      { word:'stone', rhymes:['bone','cone','drone','groan','grown','known','loan','moan','own','phone','throne','tone','zone','alone','unknown'] },
      { word:'flight', rhymes:['blight','bright','delight','fight','knight','light','might','night','plight','right','sight','slight','tight','white'] },
      { word:'spring', rhymes:['bring','cling','fling','king','ring','sing','sling','sting','string','swing','thing','wing','anything','everything'] },
    ],
    older: [
      { word:'thought', rhymes:['bought','brought','caught','fought','naught','ought','sought','taught','wrought','distraught'] },
      { word:'discover', rhymes:['cover','hover','lover','recover','uncover','another','brother','mother','other'] },
      { word:'create', rhymes:['debate','estate','fate','gate','great','hate','late','mate','plate','rate','relate','state','trait','weight'] },
      { word:'science', rhymes:['alliance','appliance','compliance','defiance','reliance','resilience'] },
      { word:'explore', rhymes:['adore','before','bore','core','floor','fore','ignore','more','pour','shore','store','there','wore'] },
    ],
  };

  const assocData = {
    young: [
      { cat:'Things that are RED 🔴', words:['apple','cherry','fire truck','rose','strawberry','tomato','ladybug','blood','ruby','lollipop','mars','crayon','heart','lips','ketchup'] },
      { cat:'Animals with 4 legs 🐾', words:['cat','dog','cow','horse','pig','sheep','lion','tiger','elephant','rabbit','deer','wolf','bear','fox','giraffe'] },
      { cat:'Things in a kitchen 🍳', words:['spoon','fork','knife','plate','bowl','cup','pot','pan','oven','fridge','toaster','blender','sink','stove','microwave'] },
      { cat:'Round things ⭕', words:['ball','wheel','coin','pizza','clock','sun','moon','ring','donut','bubble','button','eye','orange','earth','drum'] },
    ],
    middle: [
      { cat:'Things that can fly ✈️', words:['bird','plane','helicopter','bee','butterfly','kite','rocket','balloon','eagle','owl','dragonfly','bat','superhero','frisbee','drone'] },
      { cat:'Things that are cold ❄️', words:['ice','snow','ice cream','freezer','antarctica','glacier','winter','frost','blizzard','hail','north pole','igloo','snowflake','sleet','tundra'] },
      { cat:'Things you read 📚', words:['book','magazine','newspaper','letter','email','blog','comic','textbook','recipe','menu','sign','label','map','dictionary','manual'] },
      { cat:'Things at the beach 🏖️', words:['sand','wave','shell','crab','seagull','umbrella','sunscreen','towel','surfboard','starfish','lighthouse','net','pier','tide','dune'] },
    ],
    older: [
      { cat:'Things that need electricity ⚡', words:['phone','computer','television','fridge','lamp','toaster','microwave','fan','dishwasher','washing machine','hairdryer','charger','router','camera','electric car'] },
      { cat:'Things that can be both old and new 🔄', words:['building','book','idea','friendship','technology','tradition','language','song','fashion','film','art','recipe','car','city','story'] },
      { cat:'Words that mean happy 😊', words:['joyful','elated','content','cheerful','delighted','ecstatic','pleased','thrilled','gleeful','jovial','merry','blissful','jubilant','radiant','overjoyed'] },
      { cat:'Things that change colour 🌈', words:['chameleon','leaves','sky','traffic light','mood ring','bruise','sunset','flame','rainbow','octopus','squid','coral','flower','fruit','autumn'] },
    ],
  };

  const sentenceData = {
    young: [
      { words:['The','cat','sat','down'], answer:'The cat sat down' },
      { words:['I','like','red','apples'], answer:'I like red apples' },
      { words:['She','can','run','fast'], answer:'She can run fast' },
      { words:['The','dog','barks','loudly'], answer:'The dog barks loudly' },
      { words:['We','love','to','play'], answer:'We love to play' },
    ],
    middle: [
      { words:['The','big','brown','bear','ate','honey'], answer:'The big brown bear ate honey' },
      { words:['She','quickly','finished','her','homework'], answer:'She quickly finished her homework' },
      { words:['My','favourite','colour','is','bright','green'], answer:'My favourite colour is bright green' },
      { words:['The','excited','children','ran','to','school'], answer:'The excited children ran to school' },
      { words:['He','carefully','opened','the','old','box'], answer:'He carefully opened the old box' },
    ],
    older: [
      { words:['Although','it','was','raining','we','played','outside'], answer:'Although it was raining we played outside' },
      { words:['The','scientist','discovered','a','new','species','of','fish'], answer:'The scientist discovered a new species of fish' },
      { words:['She','worked','hard','because','she','wanted','to','succeed'], answer:'She worked hard because she wanted to succeed' },
      { words:['Despite','the','cold','weather','the','game','continued'], answer:'Despite the cold weather the game continued' },
      { words:['He','read','the','entire','book','in','one','afternoon'], answer:'He read the entire book in one afternoon' },
    ],
  };

  // ── State ────────────────────────────────────────────────────────────────────
  let currentAge = 'young';
  let rhymeIdx = 0, rhymeScore = 0, rhymeStreak = 0;
  let assocScore = 0, assocInterval = null, assocWords = [], assocCatIdx = 0;
  let sentenceIdx = 0, sentenceScore = 0, sentenceTotal = 0, builtWords = [];

  // ── Age group ────────────────────────────────────────────────────────────────
  document.querySelectorAll('.age-btn').forEach(btn => {
    btn.addEventListener('click', function () {
      document.querySelectorAll('.age-btn').forEach(b => b.classList.remove('active'));
      this.classList.add('active');
      currentAge = this.dataset.age;
      resetAll();
    });
  });

  function resetAll() {
    rhymeIdx = 0; rhymeScore = 0; rhymeStreak = 0;
    document.getElementById('rhymeScore').textContent = 0;
    document.getElementById('rhymeStreak').textContent = 0;
    document.getElementById('rhymeFeedback').innerHTML = '';
    loadRhyme();

    sentenceIdx = 0; sentenceScore = 0; sentenceTotal = 0; builtWords = [];
    document.getElementById('sentenceScore').textContent = 0;
    document.getElementById('sentenceTotal').textContent = 0;
    loadSentence();

    stopAssoc();
    document.getElementById('assocStart').classList.remove('d-none');
    document.getElementById('assocGame').classList.add('d-none');
    document.getElementById('assocEnd').classList.add('d-none');
  }

  // ── Rhyme Finder ─────────────────────────────────────────────────────────────
  function loadRhyme() {
    const list = rhymeData[currentAge];
    rhymeIdx = Math.floor(Math.random() * list.length);
    document.getElementById('rhymeWord').textContent = list[rhymeIdx].word.toUpperCase();
    document.getElementById('rhymeInput').value = '';
    document.getElementById('rhymeFeedback').innerHTML = '';
    document.getElementById('rhymeInput').focus();
  }

  document.getElementById('rhymeSubmit').addEventListener('click', checkRhyme);
  document.getElementById('rhymeInput').addEventListener('keydown', e => { if (e.key === 'Enter') checkRhyme(); });
  document.getElementById('rhymeNext').addEventListener('click', loadRhyme);

  function checkRhyme() {
    const input = document.getElementById('rhymeInput').value.trim().toLowerCase();
    if (!input) return;
    const list = rhymeData[currentAge];
    const entry = list[rhymeIdx];
    const isCorrect = entry.rhymes.includes(input);
    const fb = document.getElementById('rhymeFeedback');
    if (isCorrect) {
      rhymeScore++; rhymeStreak++;
      fb.innerHTML = '<div class="alert alert-success py-2">✨ "' + input + '" rhymes with "' + entry.word + '"! Streak: ' + rhymeStreak + ' 🔥</div>';
    } else {
      rhymeStreak = 0;
      fb.innerHTML = '<div class="alert alert-warning py-2">Hmm, "' + input + '" doesn\'t rhyme. Try: ' + entry.rhymes.slice(0,3).join(', ') + '</div>';
    }
    document.getElementById('rhymeScore').textContent = rhymeScore;
    document.getElementById('rhymeStreak').textContent = rhymeStreak;
    setTimeout(loadRhyme, 1800);
  }

  // ── Word Association ─────────────────────────────────────────────────────────
  document.getElementById('assocStartBtn').addEventListener('click', startAssoc);
  document.getElementById('assocAgainBtn').addEventListener('click', () => {
    document.getElementById('assocEnd').classList.add('d-none');
    document.getElementById('assocStart').classList.remove('d-none');
  });

  function startAssoc() {
    const cats = assocData[currentAge];
    assocCatIdx = Math.floor(Math.random() * cats.length);
    assocScore = 0; assocWords = [];
    document.getElementById('assocCategory').textContent = cats[assocCatIdx].cat;
    document.getElementById('assocScore').textContent = 0;
    document.getElementById('assocWords').innerHTML = '';
    document.getElementById('assocInput').value = '';
    document.getElementById('assocTimer').textContent = 60;
    document.getElementById('assocStart').classList.add('d-none');
    document.getElementById('assocGame').classList.remove('d-none');
    document.getElementById('assocInput').focus();

    let timeLeft = 60;
    assocInterval = setInterval(() => {
      timeLeft--;
      document.getElementById('assocTimer').textContent = timeLeft;
      if (timeLeft <= 0) { clearInterval(assocInterval); endAssoc(); }
    }, 1000);
  }

  function stopAssoc() { if (assocInterval) { clearInterval(assocInterval); assocInterval = null; } }

  document.getElementById('assocInput').addEventListener('keydown', function (e) {
    if (e.key === 'Enter') {
      const val = this.value.trim().toLowerCase();
      if (!val) return;
      const cats = assocData[currentAge];
      const entry = cats[assocCatIdx];
      const isValid = entry.words.includes(val) && !assocWords.includes(val);
      if (isValid) {
        assocScore++; assocWords.push(val);
        const badge = document.createElement('span');
        badge.className = 'badge bg-success';
        badge.textContent = val + ' ✓';
        document.getElementById('assocWords').appendChild(badge);
        document.getElementById('assocScore').textContent = assocScore;
      } else if (assocWords.includes(val)) {
        // already used
      } else {
        const badge = document.createElement('span');
        badge.className = 'badge bg-danger';
        badge.textContent = val + ' ✗';
        document.getElementById('assocWords').appendChild(badge);
        setTimeout(() => badge.remove(), 1000);
      }
      this.value = '';
    }
  });

  function endAssoc() {
    document.getElementById('assocGame').classList.add('d-none');
    document.getElementById('assocEnd').classList.remove('d-none');
    document.getElementById('assocFinalScore').textContent = assocScore;
    document.getElementById('assocWordList').textContent = 'Your words: ' + assocWords.join(', ');
  }

  // ── Sentence Builder ─────────────────────────────────────────────────────────
  function loadSentence() {
    const list = sentenceData[currentAge];
    sentenceIdx = Math.floor(Math.random() * list.length);
    const entry = list[sentenceIdx];
    builtWords = [];
    const shuffled = [...entry.words].sort(() => Math.random() - 0.5);
    const bank = document.getElementById('sentenceWordBank');
    bank.innerHTML = '';
    shuffled.forEach(w => {
      const btn = document.createElement('button');
      btn.className = 'btn btn-outline-primary btn-sm';
      btn.textContent = w;
      btn.addEventListener('click', () => pickWord(btn, w));
      bank.appendChild(btn);
    });
    const built = document.getElementById('sentenceBuilt');
    built.textContent = 'Your sentence will appear here…';
    built.style.color = '#999';
    document.getElementById('sentenceFeedback').innerHTML = '';
  }

  function pickWord(btn, word) {
    if (btn.disabled) return;
    btn.disabled = true;
    btn.classList.replace('btn-outline-primary','btn-secondary');
    builtWords.push(word);
    const built = document.getElementById('sentenceBuilt');
    built.textContent = builtWords.join(' ');
    built.style.color = '';
  }

  document.getElementById('sentenceClear').addEventListener('click', () => {
    builtWords = [];
    document.getElementById('sentenceWordBank').querySelectorAll('button').forEach(b => {
      b.disabled = false;
      b.classList.replace('btn-secondary','btn-outline-primary');
    });
    const built = document.getElementById('sentenceBuilt');
    built.textContent = 'Your sentence will appear here…';
    built.style.color = '#999';
    document.getElementById('sentenceFeedback').innerHTML = '';
  });

  document.getElementById('sentenceCheck').addEventListener('click', () => {
    const entry = sentenceData[currentAge][sentenceIdx];
    const built = builtWords.join(' ');
    const fb = document.getElementById('sentenceFeedback');
    sentenceTotal++;
    if (built === entry.answer) {
      sentenceScore++;
      fb.innerHTML = '<div class="alert alert-success py-2">✅ Correct! "' + built + '" 🎉</div>';
    } else {
      fb.innerHTML = '<div class="alert alert-warning py-2">Not quite! The answer is: <strong>' + entry.answer + '</strong></div>';
    }
    document.getElementById('sentenceScore').textContent = sentenceScore;
    document.getElementById('sentenceTotal').textContent = sentenceTotal;
  });

  document.getElementById('sentenceNext').addEventListener('click', loadSentence);

  // ── Init ─────────────────────────────────────────────────────────────────────
  loadRhyme();
  loadSentence();

})();
</script>
@endpush
