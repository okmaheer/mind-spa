@extends('layouts.app')
@section('title', 'Animal Quiz for Kids — Habitats, Diets & Fun Facts | MindSnap')
@section('description', 'Free animal quiz for kids! Test knowledge of habitats, diets, baby names, and animal sounds. Fun facts after every answer. No ads, no signup required.')
@section('canonical', config('app.url') . '/kids/animal-quiz')
@section('og_image', config('app.url') . '/images/og-default.jpg')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "WebApplication",
  "name": "Animal Quiz for Kids",
  "url": "{{ config('app.url') }}/kids/animal-quiz",
  "description": "Free animal quiz for kids with 5 quiz modes: Habitat, Diet, Baby Names, Animal Sounds, and Speed. Fun facts after every answer, Animal of the Day feature, and no signup required.",
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
    { "@@type": "ListItem", "position": 3, "name": "Animal Quiz for Kids" }
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
      "name": "What quiz modes are available in the animal quiz for kids?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Five quiz modes are available: Habitat (where does this animal live?), Diet (carnivore, herbivore, or omnivore?), Baby Names (what is a baby fox called?), Animal Sounds (which animal makes this sound?), and Speed (which animal is faster?). Each mode draws 10 random questions from a pool of 20." }
    },
    {
      "@@type": "Question",
      "name": "What is the Animal of the Day feature?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The Animal of the Day is a highlighted animal shown at the top of the page with 5 fascinating facts. The featured animal changes each day and is selected from a curated list of interesting and diverse species. It gives children a talking point and a starting topic before they begin the quiz." }
    },
    {
      "@@type": "Question",
      "name": "Are there fun facts in the animal quiz?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes — after every question, a fun animal fact is displayed. These facts are deliberately surprising and memorable: for example, that a group of flamingos is called a flamboyance, that octopuses have three hearts, or that sloths move so slowly that algae grows in their fur. These facts encourage children to read more about animals." }
    },
    {
      "@@type": "Question",
      "name": "What age group is this animal quiz suitable for?",
      "acceptedAnswer": { "@@type": "Answer", "text": "The animal quiz is designed to be accessible for children aged 6–14. The questions cover a range of difficulty — Baby Names and Animal Sounds questions are generally accessible to younger children, while Habitat and Diet questions require more factual knowledge suited to older children. All questions are multiple choice with visual emoji cues." }
    },
    {
      "@@type": "Question",
      "name": "Can I share my score from the animal quiz?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes — at the end of each round, a share-your-score message is generated that you can copy and share with friends or family via any messaging app. It includes your score and the quiz mode you played, so others can try to beat your score." }
    },
    {
      "@@type": "Question",
      "name": "How many questions are in each animal quiz round?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Each round contains 10 randomly selected questions drawn from a pool of 20 per mode. This means you will see different questions each time you play, keeping the quiz fresh. After completing a round you can immediately start a new one with a fresh set of questions." }
    },
    {
      "@@type": "Question",
      "name": "Is the animal quiz completely free and ad-free for kids?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes — the MindSnap Kids Zone is completely free and entirely ad-free. Children will never see advertisements while playing. No signup, email address, or account creation is required. The quiz runs entirely in the browser without any app download needed." }
    },
    {
      "@@type": "Question",
      "name": "Can teachers use this animal quiz in science lessons?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes — the animal quiz aligns with primary school science topics including animal habitats, classification, and adaptations. It works on tablets, interactive whiteboards, and computers without any student accounts. Teachers can use the Animal of the Day as a discussion starter, or run a whole-class quiz round together." }
    }
  ]
}
</script>
@endsection

@php
$faqs = [
  ['q' => 'What quiz modes are available in the free animal quiz for kids?',
   'a' => 'Five modes: <strong>Habitat</strong> (where does this animal live?), <strong>Diet</strong> (carnivore, herbivore, or omnivore?), <strong>Baby Names</strong> (what is a baby fox called?), <strong>Animal Sounds</strong> (which animal makes this sound?), and <strong>Speed</strong> (which is faster?). Each mode draws 10 random questions from a pool of 20.'],
  ['q' => 'What is the "Animal of the Day" feature?',
   'a' => 'At the top of the page, one highlighted animal is featured with 5 fascinating facts. The animal changes each day and is chosen from a curated list of diverse and interesting species. It gives children — and parents — a great talking point before diving into the quiz.'],
  ['q' => 'Are there fun facts shown during the quiz?',
   'a' => 'Yes — after every question, a surprising animal fact appears. For example: a group of flamingos is called a flamboyance, octopuses have three hearts, sloths move so slowly that algae grows in their fur. These facts are designed to spark curiosity and encourage children to read more about animals.'],
  ['q' => 'What age is this animal quiz suitable for?',
   'a' => 'The quiz is accessible for children aged 6–14. Baby Names and Animal Sounds questions are generally easier for younger children, while Habitat and Diet questions require more factual knowledge. All questions are multiple choice with emoji cues, so no writing is required.'],
  ['q' => 'Can I share my animal quiz score with friends?',
   'a' => 'Yes — at the end of each round, a share-your-score message is generated that you can copy and paste into any messaging app. It includes your score and quiz mode so friends and family can try to beat it.'],
  ['q' => 'How many questions are in each animal quiz round?',
   'a' => 'Each round has 10 randomly selected questions from a pool of 20 per mode. You\'ll see different questions each time you play, keeping each round fresh. You can immediately start a new round after finishing to try for a better score.'],
  ['q' => 'Is this animal quiz completely free and ad-free?',
   'a' => 'Yes — MindSnap\'s Kids Zone is completely free and 100% ad-free. No signup, email address, or account is required. The quiz runs in your browser on any device without downloading an app. Children\'s privacy is protected — no personal data is collected.'],
  ['q' => 'Can teachers use this animal quiz in primary school science lessons?',
   'a' => 'Absolutely — the content aligns with primary science topics including habitats, animal classification, and adaptations. It works on tablets and interactive whiteboards without student accounts. Teachers can use the Animal of the Day as a discussion starter or run a whole-class quiz round together.'],
];

$relatedTools = [
  ['icon' => '🔬', 'name' => 'Science Quiz',   'slug' => 'kids/science-quiz',   'desc' => 'Space, plants, chemistry and more.'],
  ['icon' => '🧮', 'name' => 'Math Puzzles',   'slug' => 'kids/math-puzzles',   'desc' => 'Fun puzzles for ages 5–14.'],
  ['icon' => '🔤', 'name' => 'Spelling Quiz',  'slug' => 'kids/spelling-quiz',  'desc' => 'Practice spelling by grade.'],
  ['icon' => '💬', 'name' => 'Word Games',     'slug' => 'kids/word-games',     'desc' => 'Rhymes, associations, and sentences.'],
];
@endphp

@section('styles')
<style>
.aq-panel-icon { font-size:5rem; line-height:1.2; }
.aq-related-desc { font-size:.8rem; }
.aq-progress { height:10px; }
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
          ['url' => '',                     'name' => 'Animal Quiz'],
        ]"/>

        <h1 class="mb-2 ms-hero-title">🦁 Animal Quiz for Kids</h1>
        <p class="ms-hero-desc">
          Test your animal knowledge across 5 fun modes — Habitats, Diets, Baby Names, Sounds, and Speed!
          Discover a wild fact after every answer. No ads, no signup — completely free.
        </p>

        {{-- Animal of the Day --}}
        <div class="ms-tool-card p-4 mb-3" id="animalOfDay">
          <div class="d-flex align-items-start gap-3">
            <div class="fs-1" id="aodEmoji">🦊</div>
            <div>
              <p class="fw-bold mb-1">🌟 Animal of the Day: <span id="aodName">Arctic Fox</span></p>
              <div id="aodFacts" class="small text-muted"></div>
            </div>
          </div>
        </div>

        {{-- ── Quiz tool ─────────────────────────────────────────────────────── --}}
        <div class="ms-tool-card p-4" id="animalQuizApp">

          {{-- Mode selector --}}
          <div id="modeSelector">
            <p class="fw-semibold mb-3">Choose a quiz mode:</p>
            <div class="row g-2">
              <div class="col-6">
                <button class="btn btn-outline-primary w-100 py-3 mode-btn" data-mode="habitat">
                  <div class="fs-2">🌍</div><div class="small fw-semibold mt-1">Habitat</div>
                </button>
              </div>
              <div class="col-6">
                <button class="btn btn-outline-success w-100 py-3 mode-btn" data-mode="diet">
                  <div class="fs-2">🥩</div><div class="small fw-semibold mt-1">Diet</div>
                </button>
              </div>
              <div class="col-6">
                <button class="btn btn-outline-warning w-100 py-3 mode-btn" data-mode="baby">
                  <div class="fs-2">🐣</div><div class="small fw-semibold mt-1">Baby Names</div>
                </button>
              </div>
              <div class="col-6">
                <button class="btn btn-outline-info w-100 py-3 mode-btn" data-mode="sounds">
                  <div class="fs-2">🔊</div><div class="small fw-semibold mt-1">Animal Sounds</div>
                </button>
              </div>
              <div class="col-12">
                <button class="btn btn-outline-danger w-100 py-3 mode-btn" data-mode="speed">
                  <div class="fs-2">💨</div><div class="small fw-semibold mt-1">Speed — Which is Faster?</div>
                </button>
              </div>
            </div>
          </div>

          {{-- Progress --}}
          <div id="aqProgress" class="d-none mb-3">
            <div class="d-flex justify-content-between mb-1">
              <small class="text-muted">Question <span id="aqNum">1</span> of 10</small>
              <small class="fw-semibold text-muted" id="aqModeLabel"></small>
            </div>
            <div class="progress aq-progress">
              <div id="aqProgressBar" class="progress-bar bg-warning"></div>
            </div>
          </div>

          {{-- Question --}}
          <div id="aqQuestion" class="d-none">
            <div class="text-center fs-1 mb-2" id="aqAnimalEmoji"></div>
            <div class="fs-5 fw-semibold mb-4 text-center" id="aqQuestionText"></div>
            <div class="row g-2" id="aqChoices"></div>
            <div id="aqFeedback" class="mt-3 d-none alert"></div>
            <div id="aqFact" class="mt-2 d-none alert alert-info">
              <strong>🦒 Did You Know?</strong> <span id="aqFactText"></span>
            </div>
            <button class="btn btn-primary mt-3 d-none" id="aqNext">Next →</button>
          </div>

          {{-- Score --}}
          <div id="aqScore" class="d-none text-center py-3">
            <div class="fs-1 mb-2">🏆</div>
            <h2 class="h3 mb-1"><span id="aqFinalScore">0</span>/10</h2>
            <p class="text-muted mb-3" id="aqFinalMsg"></p>
            <div class="bg-light rounded p-3 mb-3 text-start small" id="aqShareText"></div>
            <div class="d-flex gap-2 justify-content-center flex-wrap">
              <button class="btn btn-sm btn-outline-secondary" id="aqCopyBtn">📋 Copy Score</button>
              <button class="btn btn-primary" id="aqPlayAgain">🔄 Play Again</button>
              <button class="btn btn-outline-secondary" id="aqChangeMode">Change Mode</button>
            </div>
          </div>

        </div>{{-- /ms-tool-card --}}
      </div>

      <div class="col-lg-5 d-none d-lg-flex align-items-center justify-content-center">
        <div class="text-center p-4">
          <div class="aq-panel-icon">🦁</div>
          <div class="fs-1 mt-2">🐘🦋🐳🦅🐢</div>
          <p class="text-muted mt-3 small">5 quiz modes · Fun facts after every answer · Animal of the Day</p>
          <div class="d-flex flex-column gap-1 mt-3 text-start small">
            <span class="badge bg-primary p-2">🌍 Habitat — where does this animal live?</span>
            <span class="badge bg-success p-2">🥩 Diet — carnivore, herbivore, omnivore?</span>
            <span class="badge bg-warning text-dark p-2">🐣 Baby Names — what is a baby called?</span>
            <span class="badge bg-info text-dark p-2">🔊 Sounds — which animal makes this sound?</span>
            <span class="badge bg-danger p-2">💨 Speed — which animal is faster?</span>
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
        <h2 class="h3 mb-3">Free Animal Habitat and Diet Quiz for Primary School Children</h2>
        <p>
          Understanding animal habitats and diets are core topics in primary school science curricula worldwide.
          The Habitat mode asks children to identify where specific animals live — the Arctic tundra, the
          African savannah, the Amazon rainforest, the deep ocean — while the Diet mode tests whether each
          animal is a carnivore (meat eater), herbivore (plant eater), or omnivore (both). Both modes use
          large emoji visual cues to make the questions accessible even for younger or less confident readers.
        </p>
        <p>
          What sets MindSnap's quiz apart is the "Did You Know?" fact after every question. Children don't
          just learn whether an answer is right or wrong — they get a fascinating additional fact. After a
          diet question about bears, they discover that a polar bear's liver contains enough vitamin A to
          be toxic to humans. After a habitat question about penguins, they learn that some penguin species
          live on the equator. These facts transform the quiz from a rote memorisation exercise into a
          genuine voyage of discovery.
        </p>

        <h2 class="h3 mt-5 mb-3">Animal Baby Names Quiz: A Fun Vocabulary Builder for Kids</h2>
        <p>
          What do you call a baby elephant? (A calf.) A baby kangaroo? (A joey.) A baby swan? (A cygnet.)
          A baby goat? (A kid.) Animal baby names are one of the most popular categories in children's
          general knowledge, and for good reason — they're surprising, often charming, and wonderfully
          memorable. The Baby Names quiz mode covers 20 animals across different habitats and classification
          groups, drawing 10 random questions for each round.
        </p>
        <p>
          Baby names also provide a natural entry point into discussions about animal biology. Why are baby
          kangaroos called joeys? Because the word "joey" entered English from Aboriginal Australian languages.
          Why is a baby cat called a kitten but a baby fox also called a kit? Because both come from the Old
          Norse word for "young animal." These etymological side-trips make the quiz an ideal starting point
          for curious children who want to know not just the answer, but the reason behind it.
        </p>

        <h2 class="h3 mt-5 mb-3">Animal Speed and Sounds Quiz: Engaging Trivia for Ages 6–14</h2>
        <p>
          The Speed mode presents two animals side by side and asks which is faster — a format that
          consistently provokes lively debate between children and adults alike. Did you know a grizzly bear
          can outrun a horse over short distances? That a peregrine falcon dives at over 240 mph — faster
          than a Formula 1 car? That a cheetah accelerates from 0–60 mph in three seconds? These comparisons
          build a genuine mental model of animal speed rather than a list of isolated facts.
        </p>
        <p>
          The Sounds mode describes an animal's sound in words — "which animal makes a BARK?" or "which animal
          ROARS?" — and asks children to identify the species from four options. This mode is particularly
          effective for classroom use, where the teacher can mimic sounds and children can discuss as a group.
          Both modes include the same "Did You Know?" facts, and the Animal of the Day at the top of the page
          gives every session a unique starting topic for conversation.
        </p>
      </div>
    </div>
  </div>
</section>

{{-- ── FAQ ─────────────────────────────────────────────────────────────────── --}}
<x-faq-section :faqs="$faqs" id="animalQuizFaq" />

{{-- ── Related Tools ────────────────────────────────────────────────────────── --}}
<x-related-tools :tools="$relatedTools" heading="More Free Kids Tools" />

@endsection

@push('scripts')
<script>
(function () {
  'use strict';

  // ── Animal of the Day data ──────────────────────────────────────────────────
  const animalOfDayPool = [
    { emoji:'🦊', name:'Arctic Fox', facts:['Arctic foxes change fur colour — white in winter, brown in summer — as perfect camouflage.','They can survive temperatures as low as −70°C without shivering.','A single fox may travel over 4,000 km following polar bears to scavenge leftover food.','They have a thick, fluffy tail called a brush that wraps around them like a blanket when sleeping.','Pups are born blind and weigh only about 57 grams — lighter than a tennis ball.'] },
    { emoji:'🐙', name:'Octopus', facts:['Octopuses have three hearts: two pump blood to the gills and one pumps it to the body.','Their blood is blue because it uses copper-based haemocyanin instead of iron-based haemoglobin.','They are masters of camouflage and can change colour and texture in under a second.','Each arm has its own mini neural network — it can act semi-independently without brain signals.','They are the most intelligent invertebrates: they use tools, solve puzzles, and can recognise human faces.'] },
    { emoji:'🦩', name:'Flamingo', facts:['A group of flamingos is called a flamboyance — one of nature\'s most spectacular collective nouns!','Flamingos are white at birth; their pink colour comes from pigments (carotenoids) in the algae and shrimp they eat.','They can live for over 40 years in the wild — one zoo flamingo lived to 83.','Flamingos can fly at up to 60 km/h and sometimes travel hundreds of kilometres overnight.','They rest on one leg to conserve heat — flamingos are tropical birds and lose less body heat through one leg than two.'] },
    { emoji:'🦦', name:'Sea Otter', facts:['Sea otters hold hands while sleeping (called "rafting") so they don\'t drift apart on ocean currents.','They are one of the few animals known to use tools — placing rocks on their chests to crack open shellfish.','Sea otters have the densest fur of any animal: up to 1 million hairs per square inch.','They eat about 25% of their body weight in food every day to fuel their high metabolism.','Sea otters are a keystone species — their return to California coast helped restore entire kelp forest ecosystems.'] },
    { emoji:'🦒', name:'Giraffe', facts:['A giraffe\'s tongue is about 45 cm long and blue-black in colour — the dark pigment may protect it from sunburn.','Despite having the same number of neck vertebrae as humans (7), each one can be up to 25 cm long.','Giraffes only need to drink water every few days — they get most moisture from the leaves they eat.','Baby giraffes are born after a 15-month pregnancy and drop nearly 2 metres to the ground at birth.','Giraffes sleep only 30 minutes per day in total, in short bursts of a few minutes at a time.'] },
    { emoji:'🦈', name:'Great White Shark', facts:['Great whites can detect one drop of blood in an Olympic swimming pool of water.','They have around 300 teeth arranged in multiple rows — if one falls out, another moves forward within 24 hours.','Great whites are warm-blooded — unique among sharks — and can maintain body temperature above the surrounding water.','They are responsible for the most unprovoked attacks on humans, but still kill far fewer people than lightning strikes or coconuts.','Great whites can live over 70 years, making them one of the longest-lived fish species.'] },
    { emoji:'🐘', name:'African Elephant', facts:['African elephants are the largest land animals on Earth, weighing up to 7 tonnes.','Elephants are one of only a handful of species that pass the mirror test — they recognise themselves in reflections.','They communicate in infrasound — frequencies too low for humans to hear — over distances of up to 10 km.','An elephant\'s pregnancy lasts 22 months — the longest of any land mammal.','Elephants mourn their dead, returning to the bones of lost family members and gently touching them with their trunks.'] },
  ];

  // ── Quiz mode data ──────────────────────────────────────────────────────────
  const modeData = {
    habitat: [
      { q:'🐧 Where do penguins live in the wild?', opts:['Arctic Circle','Antarctica and the Southern Hemisphere','Tropical rainforests','European coasts'], a:1, fact:'While most penguins live near Antarctica, some species — like the Galápagos penguin — live right on the equator! No penguins live in the Arctic; that\'s polar bear territory.' },
      { q:'🐪 Where do camels naturally live?', opts:['The Amazon rainforest','The Sahara desert and Asian steppes','The Arctic tundra','Tropical beaches'], a:1, fact:'Camels store fat (not water) in their humps. They can drink 113 litres of water in just 13 minutes and can survive for weeks without water in extreme heat.' },
      { q:'🦁 Which habitat is home to lions?', opts:['Rainforest','Arctic tundra','African savannah grasslands','Deep ocean'], a:2, fact:'Lions are the only truly social big cats, living in groups called prides. A pride can have up to 40 members, though 10–15 is more typical. Female lions do most of the hunting.' },
      { q:'🐸 Where do tree frogs live?', opts:['Underground burrows','Tropical rainforest canopies','Arctic lakes','Ocean coral reefs'], a:1, fact:'Tree frogs have sticky pads on their toes that let them cling to glass-smooth surfaces. They absorb water through their skin rather than drinking — so a damp leaf can be enough hydration.' },
      { q:'🦅 Where do bald eagles build their nests?', opts:['Underground','On ocean floors','Tall trees and cliff faces near water','Desert sand dunes'], a:2, fact:'Bald eagle nests are called eyries and can weigh over a tonne — they add to the same nest year after year. The largest recorded nest weighed nearly 3 tonnes and was over 6 metres deep.' },
      { q:'🐠 Where do clownfish live?', opts:['Open ocean','Sandy beaches','Sea anemone tentacles','Freshwater rivers'], a:2, fact:'Clownfish are immune to the stinging tentacles of anemones due to a protective mucus coating. They live inside the anemone in exchange for protecting it from predators — a perfect partnership called mutualism.' },
      { q:'🐨 Where are wild koalas found?', opts:['South America','New Zealand','Australia','South Africa'], a:2, fact:'Koalas sleep up to 22 hours a day because eucalyptus leaves are toxic and hard to digest — their gut uses enormous energy to process the leaves. They have fingerprints almost identical to humans\'.' },
      { q:'🦭 Where do walruses live?', opts:['Tropical Pacific','African coast','Arctic Ocean and subarctic seas','Great Barrier Reef'], a:2, fact:'Walruses use their long tusks to pull themselves out of water onto ice — the word "walrus" comes from Dutch for "horse whale." Both males and females have tusks, which can grow to over 1 metre.' },
      { q:'🐍 Where do anacondas live?', opts:['African deserts','Asian rainforests','South American tropical rainforests and rivers','Australian outback'], a:2, fact:'Green anacondas are the heaviest snakes in the world, weighing up to 250 kg. They spend most of their time in water, which supports their massive weight. They can swallow prey as large as a deer whole.' },
      { q:'🦜 In which habitat do most parrots live?', opts:['Tundra','Temperate forests','Tropical and subtropical regions','Polar ice'], a:2, fact:'There are about 350 species of parrots. Kakapos in New Zealand are flightless parrots. The African Grey is considered the most intelligent bird species — one named Alex learned over 100 words and could count to 6.' },
      { q:'🐻‍❄️ Where do polar bears live?', opts:['Antarctica','The Arctic Circle and surrounding seas','Norwegian fjords','Siberian taiga forest'], a:1, fact:'Polar bears are classified as marine mammals because they spend most of their lives on sea ice and in the ocean. Their fur appears white but is actually transparent — it looks white because it reflects visible light.' },
      { q:'🦚 Where do peacocks originate from?', opts:['Africa','Australia','South Asia — India and Sri Lanka','South America'], a:2, fact:'The peacock is the national bird of India. Only males (peacocks) have the spectacular tail; females are called peahens. The "eye" patterns on the feathers are used in courtship displays to attract females.' },
      { q:'🐊 Where do saltwater crocodiles live?', opts:['The Amazon River only','Rivers and coastal areas of South-East Asia and Australia','African deserts','European wetlands'], a:1, fact:'Saltwater crocodiles are the world\'s largest living reptiles, growing to over 6 metres and weighing over 1,000 kg. Despite their size, they can sprint at 17 km/h on land for short bursts.' },
      { q:'🦋 Where do monarch butterflies migrate to for winter?', opts:['Caribbean islands','Amazon rainforest','Central Mexican mountains','Southern Florida'], a:2, fact:'Monarch butterflies migrate up to 4,800 km from Canada to central Mexico. Remarkably, no individual butterfly makes the full round trip — it takes 3–4 generations, meaning descendants navigate to a location their great-grandparents visited.' },
      { q:'🐺 What is the natural habitat of grey wolves?', opts:['Only in dense tropical rainforests','Forests, tundra, mountains and grasslands across the Northern Hemisphere','Only the Canadian Arctic','Coastal beaches and estuaries'], a:1, fact:'Wolves once ranged across almost the entire Northern Hemisphere. Their reintroduction to Yellowstone National Park in 1995 triggered a "trophic cascade" — their presence changed the behaviour of elk, which allowed rivers and forests to recover.' },
      { q:'🦦 Where do river otters live?', opts:['Saltwater oceans only','Freshwater rivers, lakes and wetlands','Tropical beaches','Underground burrows in deserts'], a:1, fact:'River otters can hold their breath for up to 8 minutes underwater. They have transparent third eyelids (nictitating membranes) that act like goggles underwater. A group of otters is called a romp or a bevy.' },
      { q:'🐡 Where do pufferfish live?', opts:['Arctic waters','Cold Norwegian fjords','Tropical and subtropical ocean waters','Only in freshwater rivers'], a:2, fact:'Pufferfish inflate by swallowing water (not air) to become up to 3 times their normal size. Their internal organs contain tetrodotoxin — one of the most potent natural toxins known, 1,200 times more poisonous than cyanide.' },
      { q:'🦓 Where do zebras live?', opts:['Asian grasslands','South American pampas','African savannahs and grasslands','North American prairies'], a:2, fact:'No two zebras have identical stripe patterns — they are as unique as human fingerprints. The stripes may confuse predators in a galloping herd, deter biting insects, or help with temperature regulation through convection.' },
      { q:'🐘 Where do Asian elephants live?', opts:['Only in India','African grasslands','South and South-East Asian forests','Central American jungles'], a:2, fact:'Asian elephants are smaller than African elephants and have smaller ears. They have been domesticated for thousands of years and play important roles in religious ceremonies across South-East Asia. Only some males grow tusks.' },
      { q:'🦤 Where did the dodo bird live before going extinct?', opts:['Madagascar','Mauritius','The Galápagos Islands','New Zealand'], a:1, fact:'Dodos went extinct around 1681 — just 80 years after Europeans first encountered them on Mauritius. Having evolved without natural predators, they had no fear of humans, making them easy prey for sailors and the animals they brought.' },
    ],
    diet: [
      { q:'🐼 What does a giant panda eat?', opts:['Fish and meat','Insects only','Almost exclusively bamboo','Fruit and vegetables'], a:2, fact:'Giant pandas\' digestive systems are built for meat — they have a carnivore\'s short gut — but they eat bamboo almost exclusively. They must eat 12–15 kg of bamboo every day and spend up to 16 hours eating to meet their energy needs.' },
      { q:'🦁 What type of diet do lions have?', opts:['Herbivore','Omnivore','Carnivore','Insectivore'], a:2, fact:'Lions are apex predators and eat primarily wildebeest, zebra, and buffalo. A lion can eat up to 40 kg in a single meal but may then not eat again for several days. Female lions do about 90% of the hunting.' },
      { q:'🐻 What is a bear\'s diet classified as?', opts:['Carnivore','Herbivore','Omnivore','Frugivore'], a:2, fact:'Brown bears eat berries, nuts, fish, insects, and small mammals — a truly omnivorous diet. Before hibernation they enter hyperphagia, eating up to 20,000 calories a day to build fat reserves for winter.' },
      { q:'🦒 What do giraffes eat?', opts:['Meat from other animals','Leaves, especially from acacia trees — they are herbivores','Both plants and small animals','Fish and aquatic plants'], a:1, fact:'Giraffes spend 16–20 hours a day eating, consuming up to 34 kg of leaves. Their 45 cm tongue grabs branches and their thick lips protect against thorns. Acacia trees are their favourite food source.' },
      { q:'🦈 What do great white sharks eat?', opts:['Only seaweed','Carnivore — seals, fish, dolphins, sea turtles','Omnivore — fish and plants','Plankton only'], a:1, fact:'Great white sharks "bite and spit" large prey first, waiting for it to bleed out before consuming it. Contrary to popular belief, they rarely consume humans — most attacks are "sample bites" where the shark releases the person.' },
      { q:'🐘 Are elephants herbivores, carnivores, or omnivores?', opts:['Carnivores','Omnivores','Herbivores','Insectivores'], a:2, fact:'Elephants eat grass, fruit, bark, roots, and leaves. An adult elephant eats up to 150 kg of food per day but digests only about 40% of it — their dung is full of seeds that grow into new plants, making them important seed dispersers.' },
      { q:'🦦 Sea otters mainly eat what?', opts:['Seaweed and algae — they are herbivores','Fish, sea urchins, crabs, and molluscs — they are carnivores','Plankton only','Both fish and seaweed — they are omnivores'], a:1, fact:'Sea otters eat up to 25% of their body weight in shellfish daily. By eating sea urchins, which would otherwise overgraze kelp forests, sea otters act as ecosystem engineers — their feeding habits protect entire marine habitats.' },
      { q:'🐝 What do bees eat?', opts:['Only flower nectar','Nectar and pollen — they are omnivores in a sense','Insects smaller than themselves','Fruit and berries'], a:1, fact:'Bees eat nectar (for energy) and pollen (for protein). Worker bees make honey by adding enzymes to nectar and evaporating its water content. A honeybee will produce only about 1/12th of a teaspoon of honey in its entire lifetime.' },
      { q:'🦩 What do flamingos eat?', opts:['Fish exclusively','Small plants and animals — they are omnivores','Insects only','Fruit and seeds'], a:1, fact:'Flamingos eat with their heads upside down, filtering water through their specialised beaks to strain out algae, small crustaceans, and invertebrates. The pink colour in their feathers comes from carotenoid pigments in the food they eat.' },
      { q:'🦅 What do eagles primarily eat?', opts:['Seeds and berries','Fish, small mammals, and birds — they are carnivores','Insects and small reptiles only','Fruit and carrion only'], a:1, fact:'Eagles have eyesight 4–8 times sharper than humans — they can spot a rabbit from 3.2 km away. Their talons exert a grip pressure of over 400 psi — about 10 times the grip strength of a human hand.' },
      { q:'🐺 What type of diet do wolves have?', opts:['Herbivore','Omnivore','Carnivore','Frugivore'], a:2, fact:'Wolves are carnivores that primarily hunt deer, moose, and elk. They hunt cooperatively in packs using strategic relay chasing. Wolves can travel up to 130 km in a single day and eat up to 9 kg of meat in one feeding.' },
      { q:'🦜 Are parrots herbivores, carnivores, or omnivores?', opts:['Carnivores — they eat insects and small birds','Omnivores — seeds, fruit, and occasionally insects','Strict herbivores — only plants','Insectivores — mainly insects'], a:1, fact:'Most parrots are omnivores that eat seeds, fruit, nectar, flowers, and occasionally insects or larvae. The kea parrot of New Zealand is particularly bold — it has been observed attacking and feeding on live sheep.' },
      { q:'🐊 What do crocodiles eat?', opts:['Only fish — they are pescatarians','Plants that grow near water — they are herbivores','Almost anything — they are carnivores','Insects and small invertebrates only'], a:2, fact:'Crocodiles can go without food for over a year by slowing their metabolism. They store fat in their tails. Despite their terrifying reputation, Nile crocodiles sometimes allow birds (Egyptian plovers) to pick parasites from between their teeth without eating them.' },
      { q:'🐢 What do sea turtles eat?', opts:['All sea turtles eat seagrass only','It depends on the species — jellyfish, seagrass, or sponges','All sea turtles eat fish and squid','Coral reefs exclusively'], a:1, fact:'Leatherback turtles eat primarily jellyfish. Green turtles are herbivorous as adults, eating seagrass. Hawksbill turtles eat sponges. Each species\' diet has evolved over millions of years to fill a specific ecological role.' },
      { q:'🦔 What do hedgehogs eat?', opts:['Only insects — they are insectivores','Strictly herbivores — grass and leaves','Omnivores — insects, worms, eggs, and fruit','Carnivores — small birds and mice'], a:2, fact:'Hedgehogs eat beetles, caterpillars, earthworms, berries, melons, and even small snakes. They are immune to adder venom! A hedgehog can travel up to 3 km in a single night foraging for food.' },
      { q:'🦋 What do adult butterflies eat?', opts:['Leaves only — they are herbivores','Flower nectar and occasionally rotting fruit — they are mostly herbivores','Insects and small animals','Pollen only — like bees'], a:1, fact:'Butterflies taste through their feet — they have taste sensors on their tarsi (leg segments). A butterfly unfurls its long proboscis like a drinking straw to sip nectar. Some species also drink mineral-rich liquid from mud puddles — a behaviour called "mud-puddling."' },
      { q:'🐠 Clownfish eat what type of diet?', opts:['Seaweed and algae only — they are herbivores','Algae, plankton, and small invertebrates — they are omnivores','Small fish only — they are carnivores','The sea anemone they live in'], a:1, fact:'Clownfish actually help their host anemone by eating its parasites and dead tentacles, and by providing it with nitrogen through their waste. The relationship is mutualistic — both species benefit. Clownfish are all born male; the dominant fish changes to female.' },
      { q:'🦃 What do wild turkeys eat?', opts:['Insects only','Seeds, berries, insects, and small reptiles — they are omnivores','Grass and leaves only','Fish and aquatic plants'], a:1, fact:'Wild turkeys can fly at up to 88 km/h over short distances and run at 40 km/h. Benjamin Franklin famously argued that the turkey was a more suitable symbol for the USA than the bald eagle — he called it a "Bird of Courage."' },
      { q:'🐌 What do giant snails eat?', opts:['Only meat — they are carnivores','Plants, fungi, and decaying organic matter — they are omnivores','Only insects','Other snails exclusively'], a:1, fact:'Giant African land snails eat over 500 different plant species and can grow to 20 cm long. They are considered one of the world\'s 100 worst invasive species because they eat crops, damage infrastructure, and carry parasites.' },
      { q:'🦭 What do seals eat?', opts:['Seaweed and algae','Fish, squid, and crustaceans — they are carnivores','Plankton only','Insects and worms'], a:1, fact:'Seals have no external ears (they\'re earless seals, or "true seals") but can hear extremely well underwater. A seal\'s whiskers (vibrissae) can detect the wake of a fish that swam past up to 30 seconds earlier, even in completely dark water.' },
    ],
    baby: [
      { q:'🦊 What is a baby fox called?', opts:['Pup or Kit','Cub','Joey','Foal'], a:0, fact:'Baby foxes are called kits, cubs, or pups — all three are accepted. A litter is called a litter (or an earth). Foxes are some of the most adaptable animals on the planet and have colonised every continent except Antarctica.' },
      { q:'🐘 What is a baby elephant called?', opts:['Pup','Kid','Calf','Foal'], a:2, fact:'Baby elephants weigh about 91 kg at birth — already heavier than most adult humans! They are born with poor eyesight and use their trunk, which has around 150,000 individual muscle units, primarily by touch and smell.' },
      { q:'🦁 What is a baby lion called?', opts:['Pup','Cub','Kit','Lamb'], a:1, fact:'Lion cubs are born with spots on their fur that fade as they grow. They start hunting at around 11 months old. Cubs are reared collectively — all the females in a pride nurse each other\'s cubs, so every cub has multiple "mothers."' },
      { q:'🐧 What is a baby penguin called?', opts:['Chick','Joey','Pup','Hatchling'], a:0, fact:'Baby penguins are covered in grey fluffy down feathers and cannot swim until they develop waterproof adult feathers at around 2 months old. Both parents take turns incubating the egg by balancing it on their feet under a warm brood pouch.' },
      { q:'🦌 What is a baby deer called?', opts:['Kid','Calf','Fawn','Lamb'], a:2, fact:'Deer fawns are born with white spots that provide camouflage in dappled forest light. The spots disappear by their first autumn. Newborn fawns have no scent for the first few days — their mothers leave them hidden while foraging, minimising the scent trail that predators could follow.' },
      { q:'🐊 What is a baby crocodile called?', opts:['Chick','Hatchling','Pup','Spawnling'], a:1, fact:'Female crocodiles are surprisingly attentive mothers — they gently carry their hatchlings to the water in their mouths. The temperature of the nest determines the hatchlings\' sex: above 32°C produces males, below produces females.' },
      { q:'🦢 What is a baby swan called?', opts:['Chick','Duckling','Cygnet','Gosling'], a:2, fact:'Baby swans are called cygnets and are grey or brown — the famous "ugly duckling" story is based on this. They can swim almost immediately after hatching and often ride on their parents\' backs. Swans mate for life and can live over 20 years.' },
      { q:'🐻 What is a baby bear called?', opts:['Pup','Kit','Piglet','Cub'], a:3, fact:'Bear cubs are born during hibernation, weighing only about 280 grams — less than a can of soup. They are born blind and hairless. The mother stays asleep while nursing them, waking in spring with cubs that have grown to several kilograms.' },
      { q:'🐬 What is a baby dolphin called?', opts:['Pup','Calf','Fry','Chick'], a:1, fact:'Dolphin calves are born tail-first to prevent drowning, and immediately nudged to the surface for their first breath. Calves nurse for 1–2 years and stay with their mothers for several years, learning hunting techniques and social behaviours.' },
      { q:'🦆 What is a baby duck called?', opts:['Chick','Gosling','Cygnet','Duckling'], a:3, fact:'Ducklings famously imprint on the first moving object they see after hatching — usually their mother. But if hatched in captivity, they can imprint on humans, dogs, or even toy trains! This instinct, studied by Konrad Lorenz, revealed how early learning shapes behaviour.' },
      { q:'🐴 What is a baby horse called?', opts:['Pup','Calf','Foal','Lamb'], a:2, fact:'Horse foals can stand and walk within 1–2 hours of birth — an evolutionary necessity for prey animals. A young male horse is called a colt and a young female a filly until they turn 4 years old.' },
      { q:'🦘 What is a baby kangaroo called?', opts:['Cub','Pup','Joey','Kitten'], a:2, fact:'A newborn joey is about the size of a grain of rice — smaller than your thumbnail. It crawls unaided through its mother\'s fur into her pouch immediately after birth, where it attaches to a teat and continues developing for 6–8 months.' },
      { q:'🐳 What is a baby whale called?', opts:['Pup','Chick','Calf','Fry'], a:2, fact:'Blue whale calves are the largest babies on Earth — born at about 8 metres long and 2.7 tonnes. They gain about 90 kg per day during nursing. They drink up to 190 litres of their mother\'s extremely fat-rich milk every day.' },
      { q:'🐢 What is a baby turtle called?', opts:['Chick','Hatchling','Pup','Spawn'], a:1, fact:'Sea turtle hatchlings use the brightness of the open horizon to navigate to the sea at night. Light pollution from hotels and street lights can disorient them fatally. Once in the ocean, where they go for their first years of life remains largely a scientific mystery — called "the lost years."' },
      { q:'🐺 What is a baby wolf called?', opts:['Cub','Kit','Pup','Whelp'], a:2, fact:'Wolf pups are born blind and deaf, and are entirely dependent for the first three weeks. All pack members — not just the parents — help raise pups by regurgitating food for them. This cooperative child-rearing is one reason wolf packs are so socially complex.' },
      { q:'🦭 What is a baby seal called?', opts:['Kid','Pup','Calf','Chick'], a:1, fact:'Seal pups are covered in white fur (called lanugo) that insulates them before they develop blubber. Mother harp seals nurse their pups for only 12 days — the shortest nursing period of any mammal — before abandoning them to find food for themselves.' },
      { q:'🦓 What is a baby zebra called?', opts:['Colt','Kid','Foal','Pup'], a:2, fact:'Zebra foals can walk within 20 minutes and run within an hour of birth — essential for survival on the open savannah. A foal must quickly learn its mother\'s unique stripe pattern so it can recognise her in a galloping herd.' },
      { q:'🦅 What is a baby eagle called?', opts:['Chick or Eaglet','Fledgling only','Hatchling','Nestling'], a:0, fact:'Eagle eaglets take about 10–14 weeks to fledge (leave the nest). Their first flights are often clumsy, but they quickly develop the skills needed for the aerial hunting that defines their adult lives. Some eagle species live over 30 years in the wild.' },
      { q:'🐨 What is a baby koala called?', opts:['Pup','Joey','Cub','Kid'], a:1, fact:'Baby koalas are called joeys — like kangaroo babies. They are born blind, hairless, and the size of a jellybean. After spending 6 months in the pouch drinking milk, the joey emerges and eats a special substance from the mother\'s digestive system to acquire gut bacteria needed to digest eucalyptus.' },
      { q:'🦊 What is a baby rabbit called?', opts:['Kit or Kitten','Pup','Foal','Joey'], a:0, fact:'Baby rabbits are called kittens or kits and are born blind, deaf, and hairless — unlike hares, which are born fully furred with open eyes. A female rabbit can produce a new litter every 30 days, making them one of the most reproductively productive mammals.' },
    ],
    sounds: [
      { q:'Which animal makes a ROAR? 🔊', opts:['Wolf','Cheetah','Lion or Tiger','Dolphin'], a:2, fact:'Not all big cats roar — cheetahs, snow leopards, and clouded leopards cannot. Only lions, tigers, leopards, and jaguars can roar, because they have a special flexible ligament in their larynx instead of a rigid one.' },
      { q:'Which animal makes a HOWL? 🔊', opts:['Dog or Wolf','Cat','Frog','Bird'], a:0, fact:'Wolves howl to communicate with their pack over long distances — howls can travel up to 10 km in open terrain. Each wolf has a unique howl, like a fingerprint. A pack howl synchronises the group before a hunt.' },
      { q:'Which animal makes a HISS? 🔊', opts:['Dog','Snake or Goose','Elephant','Horse'], a:1, fact:'Snakes hiss by rapidly expelling air through their glottis (a small opening in the floor of the mouth). Geese also hiss as an aggressive warning — it is one of nature\'s most widely recognised warning sounds across species.' },
      { q:'Which animal makes a TRUMPET sound? 🔊', opts:['Giraffe','Elephant','Hippo','Rhino'], a:1, fact:'Elephants trumpet (through their trunks), rumble (through their chest), and roar. The rumbles can be infrasound — too low for humans to hear — but travel through the ground and are felt through the feet of other elephants up to 10 km away.' },
      { q:'Which animal makes a NEIGH? 🔊', opts:['Zebra','Horse','Donkey','Camel'], a:1, fact:'Horses communicate with neighs (long calls), whinnies (variations), snorts, and squeals. Horses\' ears can rotate 180 degrees independently, allowing them to hear sounds in two directions simultaneously without moving their head.' },
      { q:'Which animal is famous for its LAUGH (a "whoop")? 🔊', opts:['Hyena','Chimpanzee','Kookaburra','Baboon'], a:0, fact:'Spotted hyenas\' "laugh" is actually a sound of submission or excitement — not actual laughter. Despite often being depicted as cowardly scavengers, spotted hyenas are highly intelligent pack hunters and kill up to 95% of their own food.' },
      { q:'Which bird is famous for its HOOT? 🔊', opts:['Eagle','Crow','Owl','Flamingo'], a:2, fact:'Not all owls hoot — barn owls screech, and the barking owl makes a sound remarkably like a human scream. Owl calls are unique to each species and used for territorial defence and attracting mates. Some owl species have asymmetrically placed ears to locate sounds in 3D.' },
      { q:'Which animal produces CLICKING sounds to navigate? 🔊', opts:['Bat','Dolphin','Both bats and dolphins','Only dolphins'], a:2, fact:'Both bats and dolphins use echolocation — emitting high-frequency clicks and listening to the echoes to build a 3D picture of their surroundings. Dolphins use sound frequencies up to 150 kHz (humans hear up to 20 kHz). Bats can detect an object as thin as a human hair.' },
      { q:'Which animal makes a GOBBLE sound? 🔊', opts:['Chicken','Turkey','Guinea pig','Flamingo'], a:1, fact:'Only male turkeys (toms) gobble — it\'s a mating call. Females make a softer "yelping" sound. Wild turkeys have excellent eyesight — they can see in colour and have a 270-degree field of vision, compared to 180 degrees for humans.' },
      { q:'Which animal is known for its very loud SCREAM or SHRIEK? 🔊', opts:['Eagle','Fox','Peacock','All of the above'], a:3, fact:'Foxes, eagles, and peacocks all produce surprisingly loud, high-pitched screams. The red fox\'s mating call (especially by females) is often mistaken for a human in distress. The peacock\'s call can be heard from over a kilometre away.' },
    ],
    speed: [
      { q:'Which is faster? 💨', opts:['🐆 Cheetah (up to 70 mph)','🦁 Lion (up to 50 mph)','They\'re the same speed','🐘 Elephant (up to 25 mph)'], a:0, fact:'Cheetahs are the fastest land animals, reaching 70 mph (112 km/h) but only for about 30 seconds. After a high-speed chase, a cheetah must rest 15–30 minutes before eating, leaving it vulnerable to lions stealing its kill.' },
      { q:'Which is faster? 💨', opts:['🐬 Dolphin (up to 37 mph)','🦈 Great white shark (up to 25 mph)','🐙 Octopus (up to 25 mph)','They\'re equal'], a:0, fact:'Dolphins are among the fastest marine animals. They often ride the bow waves of ships to get a free speed boost — a behaviour called bow-riding. A dolphin\'s tail moves vertically (up-down), while a fish\'s tail moves side-to-side.' },
      { q:'Which is faster in a diving dive? 💨', opts:['🦅 Bald Eagle (up to 100 mph)','🕊️ Pigeon (up to 92 mph)','🦅 Peregrine Falcon (up to 240 mph)','🦜 Parrot (up to 80 mph)'], a:2, fact:'The peregrine falcon is the fastest animal on Earth in a stoop (dive) — recorded at over 240 mph (390 km/h). At these speeds, it must blink its third eyelid to protect its eyes and has special baffles in its nostrils to breathe against the air pressure.' },
      { q:'Which is faster? 💨', opts:['🐻 Grizzly bear (up to 35 mph)','🏇 Thoroughbred racehorse (up to 43 mph)','They\'re equal','🦌 Deer (up to 30 mph)'], a:1, fact:'A grizzly bear can run at 35 mph — faster than Usain Bolt (28 mph) — which is why you cannot outrun a bear. The fastest recorded human sprint is 27.8 mph. A bear can outrun most humans over any distance.' },
      { q:'Which is faster in the ocean? 💨', opts:['🐳 Blue whale (up to 20 mph)','🐟 Sailfish (up to 68 mph)','🦭 Seal (up to 25 mph)','🐢 Sea turtle (up to 22 mph)'], a:1, fact:'The sailfish is the fastest fish in the ocean, reaching 68 mph (110 km/h). Its sail-like dorsal fin may help it herd schools of smaller fish. Sailfish are known to work cooperatively when hunting, taking turns slashing through a bait ball.' },
      { q:'Which is faster? 💨', opts:['🐆 Cheetah (70 mph)','🦅 Peregrine falcon diving (240 mph)','They\'re equal on land','🦁 Lion (50 mph)'], a:1, fact:'The peregrine falcon is the undisputed fastest animal on Earth in a dive at 240 mph — nearly 3.5× faster than a cheetah at top speed. Even in level flight, it reaches 60–70 mph without diving.' },
      { q:'Which is faster? 💨', opts:['🐌 African giant snail (0.03 mph)','🌊 Starfish (0.006 mph)','🦥 Sloth (0.15 mph)','🐢 Tortoise (0.17 mph)'], a:3, fact:'The Galápagos tortoise moves at about 0.17 mph. Sloths move at about 0.15 mph and are even slower than tortoises! Sloths\' slowness is a survival strategy — they have such low metabolisms that predators often overlook them as inanimate objects.' },
      { q:'Which is faster? 💨', opts:['🦓 Zebra (up to 40 mph)','🦒 Giraffe (up to 37 mph)','They\'re equal','🦏 Rhino (up to 34 mph)'], a:0, fact:'Despite their graceful appearance, giraffes can run at 37 mph but cannot maintain it for long. Rhinos, despite their bulk, can charge at 34 mph. Zebras use bursts of speed and sharp directional changes (not just raw speed) to escape predators.' },
      { q:'Which is faster? 💨', opts:['🐺 Wolf (up to 38 mph)','🦊 Fox (up to 30 mph)','🐇 Rabbit (up to 45 mph)','🦡 Badger (up to 19 mph)'], a:2, fact:'Rabbits can sprint at up to 45 mph (72 km/h) — faster than a wolf! They also zigzag unpredictably at high speed, which is far more effective against predators than a straight-line sprint. This is why wolves rely on endurance rather than speed to catch rabbits.' },
      { q:'Which is faster? 💨', opts:['🦁 Lion (50 mph)','🐊 Saltwater crocodile (land, 11 mph; water, 15 mph)','🦛 Hippo (up to 19 mph)','🦣 Woolly mammoth (estimated 15 mph)'], a:0, fact:'Lions are far faster than crocodiles and hippos on land. However, hippos are surprisingly quick over short distances at 19 mph. More people in Africa are killed by hippos than by lions each year — hippos are among the most aggressive and dangerous large animals.' },
    ],
  };

  // ── Animal of the Day ────────────────────────────────────────────────────────
  const today = new Date();
  const aodIndex = (today.getFullYear() * 365 + today.getMonth() * 31 + today.getDate()) % animalOfDayPool.length;
  const aod = animalOfDayPool[aodIndex];
  document.getElementById('aodEmoji').textContent = aod.emoji;
  document.getElementById('aodName').textContent  = aod.name;
  const aodFacts = document.getElementById('aodFacts');
  aod.facts.forEach(f => {
    const p = document.createElement('p');
    p.className = 'mb-1';
    p.textContent = '• ' + f;
    aodFacts.appendChild(p);
  });

  // ── State ─────────────────────────────────────────────────────────────────────
  let mode = null, pool = [], current = 0, score = 0;
  const modeNames = { habitat:'🌍 Habitat', diet:'🥩 Diet', baby:'🐣 Baby Names', sounds:'🔊 Sounds', speed:'💨 Speed' };

  // ── DOM refs ──────────────────────────────────────────────────────────────────
  const modeSelector  = document.getElementById('modeSelector');
  const aqProgress    = document.getElementById('aqProgress');
  const aqQuestion    = document.getElementById('aqQuestion');
  const aqScoreEl     = document.getElementById('aqScore');
  const aqNum         = document.getElementById('aqNum');
  const aqModeLabel   = document.getElementById('aqModeLabel');
  const aqProgressBar = document.getElementById('aqProgressBar');
  const aqAnimalEmoji = document.getElementById('aqAnimalEmoji');
  const aqQuestionText= document.getElementById('aqQuestionText');
  const aqChoices     = document.getElementById('aqChoices');
  const aqFeedback    = document.getElementById('aqFeedback');
  const aqFact        = document.getElementById('aqFact');
  const aqFactText    = document.getElementById('aqFactText');
  const aqNext        = document.getElementById('aqNext');
  const aqFinalScore  = document.getElementById('aqFinalScore');
  const aqFinalMsg    = document.getElementById('aqFinalMsg');

  document.querySelectorAll('.mode-btn').forEach(btn => {
    btn.addEventListener('click', function () { startQuiz(this.dataset.mode); });
  });
  document.getElementById('aqPlayAgain').addEventListener('click', () => startQuiz(mode));
  document.getElementById('aqChangeMode').addEventListener('click', () => {
    aqScoreEl.classList.add('d-none');
    aqProgress.classList.add('d-none');
    aqQuestion.classList.add('d-none');
    modeSelector.classList.remove('d-none');
  });
  aqNext.addEventListener('click', () => {
    current++;
    if (current < pool.length) loadQuestion();
    else endQuiz();
  });
  document.getElementById('aqCopyBtn').addEventListener('click', () => {
    const text = document.getElementById('aqShareText').textContent;
    navigator.clipboard.writeText(text).catch(() => {});
    document.getElementById('aqCopyBtn').textContent = '✅ Copied!';
    setTimeout(() => { document.getElementById('aqCopyBtn').textContent = '📋 Copy Score'; }, 2000);
  });

  function shuffle(arr) { return arr.sort(() => Math.random() - 0.5); }

  function startQuiz(m) {
    mode = m;
    pool = shuffle([...modeData[m]]).slice(0, 10);
    current = 0; score = 0;
    aqModeLabel.textContent = modeNames[m];
    modeSelector.classList.add('d-none');
    aqScoreEl.classList.add('d-none');
    aqProgress.classList.remove('d-none');
    aqQuestion.classList.remove('d-none');
    loadQuestion();
  }

  function loadQuestion() {
    const q = pool[current];
    aqNum.textContent = current + 1;
    aqProgressBar.style.width = (current / pool.length * 100) + '%';
    // extract leading emoji from question text
    const emojiMatch = q.q.match(/^\S+\s/);
    aqAnimalEmoji.textContent = emojiMatch ? emojiMatch[0].trim() : '';
    aqQuestionText.textContent = q.q;
    aqFeedback.className = 'mt-3 d-none alert';
    aqFact.classList.add('d-none');
    aqNext.classList.add('d-none');
    aqChoices.innerHTML = '';
    q.opts.forEach((opt, i) => {
      const col = document.createElement('div');
      col.className = 'col-6';
      const btn = document.createElement('button');
      btn.className = 'btn btn-outline-secondary w-100 py-2';
      btn.textContent = opt;
      btn.addEventListener('click', () => handleAnswer(i, q));
      col.appendChild(btn);
      aqChoices.appendChild(col);
    });
  }

  function handleAnswer(chosen, q) {
    aqChoices.querySelectorAll('button').forEach(b => b.disabled = true);
    const isCorrect = chosen === q.a;
    if (isCorrect) {
      score++;
      aqChoices.querySelectorAll('button')[chosen].classList.replace('btn-outline-secondary','btn-success');
      aqFeedback.className = 'mt-3 alert alert-success';
      aqFeedback.textContent = '✅ Correct! Great job! 🎉';
    } else {
      aqChoices.querySelectorAll('button')[chosen].classList.replace('btn-outline-secondary','btn-danger');
      aqChoices.querySelectorAll('button')[q.a].classList.replace('btn-outline-secondary','btn-success');
      aqFeedback.className = 'mt-3 alert alert-warning';
      aqFeedback.textContent = 'Not quite! The right answer is: ' + q.opts[q.a];
    }
    aqFeedback.classList.remove('d-none');
    aqFactText.textContent = q.fact;
    aqFact.classList.remove('d-none');
    aqNext.classList.remove('d-none');
  }

  function endQuiz() {
    aqProgress.classList.add('d-none');
    aqQuestion.classList.add('d-none');
    aqScoreEl.classList.remove('d-none');
    aqFinalScore.textContent = score;
    let msg;
    if (score >= 9)      msg = 'Amazing! You\'re a true wildlife expert! 🦁🏆';
    else if (score >= 7) msg = 'Excellent animal knowledge! 🐘';
    else if (score >= 5) msg = 'Good effort! Keep learning and try again! 🌿';
    else                 msg = 'Nice try! Lots more animal facts to discover! 📚';
    aqFinalMsg.textContent = msg;
    document.getElementById('aqShareText').textContent =
      '🦁 I scored ' + score + '/10 on the Animal Quiz (' + modeNames[mode] + ' mode) on MindSnap! Can you beat me? Try it free: mindsnap.app/kids/animal-quiz — no ads, no signup!';
  }

})();
</script>
@endpush
