@extends('layouts.app')
@section('title', 'Science Quiz for Kids — Space, Animals & More | MindSnap')
@section('description', 'Free science quiz for kids covering space, animals, plants, the human body, chemistry, and weather. Fun facts after every answer. No ads, no signup.')
@section('canonical', config('app.url') . '/kids/science-quiz')
@section('og_image', config('app.url') . '/images/og-default.jpg')

@section('styles')
<style>
  .sq-progress {
    height: 10px;
  }
  .sq-panel-icon {
    font-size: 5rem;
    line-height: 1.2;
  }
  .sq-panel-topics {
    font-size: 2rem;
  }
  .sq-related-desc {
    font-size: .8rem;
  }
</style>
@endsection

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "WebApplication",
  "name": "Science Quiz for Kids",
  "url": "{{ config('app.url') }}/kids/science-quiz",
  "description": "Free interactive science quiz for kids. Choose from 6 topics: Space, Animals, Plants, Human Body, Chemistry Basics, and Earth & Weather. 10 questions per topic with fun facts.",
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
    { "@@type": "ListItem", "position": 3, "name": "Science Quiz for Kids" }
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
      "name": "What science topics does this kids quiz cover?",
      "acceptedAnswer": { "@@type": "Answer", "text": "MindSnap's science quiz for kids covers six topics: Space (planets, stars, the solar system), Animals (habitats, classification, adaptations), Plants (photosynthesis, life cycles), Human Body (organs, systems), Chemistry Basics (states of matter, elements), and Earth & Weather (seasons, climate, natural phenomena). Each topic has 10 multiple-choice questions." }
    },
    {
      "@@type": "Question",
      "name": "Is this science quiz suitable for primary school children?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes. The questions are designed to be accessible to primary and middle school children aged 7–14. Questions become slightly harder after 3 consecutive correct answers, providing a gentle difficulty ramp that keeps both beginners and advanced learners appropriately challenged." }
    },
    {
      "@@type": "Question",
      "name": "What are the 'Did You Know' facts after each question?",
      "acceptedAnswer": { "@@type": "Answer", "text": "After every question — whether answered correctly or not — a related 'Did You Know?' fun fact appears. These facts are carefully researched and accurate, and are designed to spark curiosity beyond the quiz itself. For example, after a question about the Moon, the fact explains how long it would take to drive to the Moon at highway speed." }
    },
    {
      "@@type": "Question",
      "name": "What badges can children earn in the science quiz?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Three badges can be earned: Scientist 🔬 (score of 4 or less — a great start!), Explorer 🧭 (score of 5–7), and Expert 🏆 (score of 8–10). The badge system gives children a clear achievement to aim for and celebrate, without making lower scores feel like failure." }
    },
    {
      "@@type": "Question",
      "name": "Can parents use this quiz to help with science homework?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Absolutely. The quiz covers factual content that appears in primary and early secondary science curricula. Parents can sit with their child and discuss the 'Did You Know?' facts after each question, turning the quiz into a conversation about science rather than just a test." }
    },
    {
      "@@type": "Question",
      "name": "Does the science quiz get harder as you play?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes. After 3 consecutive correct answers, the quiz selects slightly harder questions from the topic pool. This adaptive difficulty ensures children are always appropriately challenged — not bored by questions that are too easy, and not discouraged by questions that are too hard." }
    },
    {
      "@@type": "Question",
      "name": "Are the science facts in the quiz accurate?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Yes — all questions and fun facts are based on established scientific consensus and have been reviewed for accuracy. The quiz intentionally avoids contested or overly advanced topics, focusing on well-established facts appropriate for children's science education." }
    },
    {
      "@@type": "Question",
      "name": "How is this science quiz different from a normal school test?",
      "acceptedAnswer": { "@@type": "Answer", "text": "Unlike a school test, this quiz is designed to be fun first and educational second. Every answer reveals a fascinating fact, there are no penalties for wrong answers, the badge system celebrates all completion levels, and children can choose any topic they are curious about. The goal is to associate science with excitement rather than anxiety." }
    }
  ]
}
</script>
@endsection

@php
$faqs = [
  ['q' => 'What science topics does this free kids quiz cover?',
   'a' => 'Six topics: 🌌 Space (planets, stars, the solar system), 🦁 Animals (habitats, classification), 🌿 Plants (photosynthesis, life cycles), 🫀 Human Body (organs and systems), ⚗️ Chemistry Basics (states of matter, elements), and 🌍 Earth & Weather (seasons, climate). Each topic has 10 multiple-choice questions.'],
  ['q' => 'Is this science quiz suitable for primary school children?',
   'a' => 'Yes — it\'s designed for children aged 7–14. Questions become slightly harder after 3 consecutive correct answers, so both beginners and advanced learners are appropriately challenged. Teachers can use it as a curriculum-aligned warm-up activity.'],
  ['q' => 'What are the "Did You Know?" facts shown after each question?',
   'a' => 'After every question, a related fun fact appears — for example, after a question about the Moon, children learn that it would take about 130 days to drive to the Moon at 60 mph. These facts are accurate, surprising, and designed to spark genuine curiosity beyond the quiz itself.'],
  ['q' => 'What badges can children earn in the science quiz?',
   'a' => 'Three badges: Scientist 🔬 (score 1–4, a great start!), Explorer 🧭 (score 5–7), and Expert 🏆 (score 8–10). The system celebrates all levels of achievement, so children who are just beginning to learn science feel equally rewarded for completing the quiz.'],
  ['q' => 'Can I use this to help with science homework?',
   'a' => 'Yes — the content aligns with primary and early secondary science curricula. The "Did You Know?" facts after each question give parents and children something to discuss together, turning the quiz into a conversation about science rather than just a test. No signup is needed, so you can start immediately.'],
  ['q' => 'Does the quiz get harder as you play?',
   'a' => 'Yes. After 3 consecutive correct answers, the quiz selects slightly harder questions from the topic pool. This adaptive approach keeps advanced learners engaged without overwhelming beginners — both groups get a genuinely challenging but achievable experience.'],
  ['q' => 'Are the science facts in the quiz accurate and up to date?',
   'a' => 'All questions and fun facts are based on established scientific consensus and reviewed for accuracy. The quiz focuses on well-established facts appropriate for children\'s education — no contested topics or overly advanced concepts.'],
  ['q' => 'How is this quiz different from a school science test?',
   'a' => 'Unlike a test, this quiz is designed to be fun first. Every answer reveals a fascinating fact, there are no penalties for wrong answers, children can choose any topic they\'re curious about, and the badge system celebrates all levels. The aim is to associate science with excitement, not exam anxiety.'],
];

$relatedTools = [
  ['icon' => '🦁', 'name' => 'Animal Quiz',    'slug' => 'kids/animal-quiz',    'desc' => 'Habitats, diets, and fun facts.'],
  ['icon' => '🧮', 'name' => 'Math Puzzles',   'slug' => 'kids/math-puzzles',   'desc' => 'Fun puzzles for ages 5–14.'],
  ['icon' => '🔤', 'name' => 'Spelling Quiz',  'slug' => 'kids/spelling-quiz',  'desc' => 'Practice spelling by grade.'],
  ['icon' => '💬', 'name' => 'Word Games',     'slug' => 'kids/word-games',     'desc' => 'Rhymes, associations, and sentences.'],
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
          ['url' => '',                     'name' => 'Science Quiz'],
        ]"/>

        <h1 class="mb-2 ms-hero-title">🔬 Science Quiz for Kids</h1>
        <p class="ms-hero-desc">
          Pick a topic, answer 10 questions, and discover amazing "Did You Know?" facts after every answer.
          Earn your Scientist, Explorer, or Expert badge!
          No ads, no signup — completely free.
        </p>

        {{-- ── Tool ─────────────────────────────────────────────────────────── --}}
        <div class="ms-tool-card p-4" id="scienceQuizApp">

          {{-- Topic selector --}}
          <div id="topicSelector">
            <p class="fw-semibold mb-3">Choose a science topic:</p>
            <div class="row g-2">
              <div class="col-6 col-sm-4">
                <button class="btn btn-outline-primary w-100 py-3 topic-btn" data-topic="space">
                  <div class="fs-2">🌌</div><div class="small mt-1 fw-semibold">Space</div>
                </button>
              </div>
              <div class="col-6 col-sm-4">
                <button class="btn btn-outline-success w-100 py-3 topic-btn" data-topic="animals">
                  <div class="fs-2">🦁</div><div class="small mt-1 fw-semibold">Animals</div>
                </button>
              </div>
              <div class="col-6 col-sm-4">
                <button class="btn btn-outline-success w-100 py-3 topic-btn" data-topic="plants">
                  <div class="fs-2">🌿</div><div class="small mt-1 fw-semibold">Plants</div>
                </button>
              </div>
              <div class="col-6 col-sm-4">
                <button class="btn btn-outline-danger w-100 py-3 topic-btn" data-topic="body">
                  <div class="fs-2">🫀</div><div class="small mt-1 fw-semibold">Human Body</div>
                </button>
              </div>
              <div class="col-6 col-sm-4">
                <button class="btn btn-outline-warning w-100 py-3 topic-btn" data-topic="chemistry">
                  <div class="fs-2">⚗️</div><div class="small mt-1 fw-semibold">Chemistry</div>
                </button>
              </div>
              <div class="col-6 col-sm-4">
                <button class="btn btn-outline-info w-100 py-3 topic-btn" data-topic="earth">
                  <div class="fs-2">🌍</div><div class="small mt-1 fw-semibold">Earth & Weather</div>
                </button>
              </div>
            </div>
          </div>

          {{-- Progress --}}
          <div id="quizProgress" class="d-none mb-3">
            <div class="d-flex justify-content-between mb-1">
              <small class="text-muted">Question <span id="sqNum">1</span> of 10</small>
              <small class="text-muted fw-semibold" id="sqTopic"></small>
            </div>
            <div class="progress sq-progress">
              <div id="sqProgressBar" class="progress-bar"></div>
            </div>
          </div>

          {{-- Question --}}
          <div id="quizQuestion" class="d-none">
            <div class="fs-4 fw-semibold mb-4" id="sqQuestionText"></div>
            <div class="row g-2" id="sqChoices"></div>
            <div id="sqFeedback" class="mt-3 d-none"></div>
            <div id="sqFact" class="mt-2 d-none alert alert-info">
              <strong>💡 Did You Know?</strong> <span id="sqFactText"></span>
            </div>
            <button id="sqNext" class="btn btn-primary mt-3 d-none">Next Question →</button>
          </div>

          {{-- Score --}}
          <div id="quizScore" class="d-none text-center py-3">
            <div class="display-2 mb-2" id="sqBadgeEmoji"></div>
            <h2 class="h3 mb-1" id="sqBadgeName"></h2>
            <p class="fs-4 fw-bold mb-1"><span id="sqFinalScore">0</span>/10</p>
            <p class="text-muted mb-4" id="sqFinalMsg"></p>
            <div class="d-flex gap-2 justify-content-center">
              <button class="btn btn-primary" id="sqTryAgain">🔄 Try Again</button>
              <button class="btn btn-outline-secondary" id="sqChangeTopic">Change Topic</button>
            </div>
          </div>

        </div>{{-- /ms-tool-card --}}
      </div>

      <div class="col-lg-5 d-none d-lg-flex align-items-center justify-content-center">
        <div class="text-center p-4">
          <div class="sq-panel-icon">🔬</div>
          <div class="sq-panel-topics mt-2">🌌🦁🌿🫀⚗️🌍</div>
          <p class="text-muted mt-3 small">6 topics · 10 questions each · Fun facts after every answer</p>
          <div class="row g-2 mt-3 text-start">
            <div class="col-6"><span class="badge bg-secondary w-100 py-2">Scientist 🔬</span></div>
            <div class="col-6"><span class="badge bg-primary w-100 py-2">Explorer 🧭</span></div>
            <div class="col-12"><span class="badge bg-warning text-dark w-100 py-2">Expert 🏆</span></div>
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
        <h2 class="h3 mb-3">Free Space Science Quiz for Kids: Planets, Stars and the Solar System</h2>
        <p>
          Space consistently ranks as one of children's favourite science topics — and for good reason. The
          sheer scale of the universe, the mystery of black holes, and the possibility of life on other planets
          fire the imagination in ways that few other subjects can match. MindSnap's Space topic covers the
          eight planets of the solar system, the differences between stars and planets, how the Moon affects
          tides, and facts about the International Space Station.
        </p>
        <p>
          After every question, a "Did You Know?" fact deepens the learning. After a question about the
          distance from Earth to the Moon, children discover that it would take about 130 days to drive there
          at motorway speed. After a question about the Sun, they learn that its core temperature reaches
          15 million degrees Celsius. These facts make the quiz a conversation starter, not just a test —
          parents and teachers find that children want to discuss the facts long after the quiz is finished.
        </p>

        <h2 class="h3 mt-5 mb-3">Animals and Plants Science Quiz: Curriculum-Aligned Questions for Primary School</h2>
        <p>
          The Animals and Plants topics cover content that directly aligns with primary school science curricula
          in the UK, US, and Australia. Animals questions cover classification (mammal, reptile, amphibian,
          bird, fish), habitats, food chains, and adaptations. Plants questions cover photosynthesis, the role
          of roots and leaves, pollination, and seed dispersal. Every question is multiple choice with four
          options, making it accessible for children who find reading or writing challenging.
        </p>
        <p>
          The adaptive difficulty system means that a child who gets three consecutive questions right will
          receive slightly harder follow-up questions — so advanced learners are challenged, while children
          who are newer to the topic get more accessible questions. This prevents both boredom and
          discouragement, which are the two main reasons children disengage from learning activities.
        </p>

        <h2 class="h3 mt-5 mb-3">Chemistry and Earth Science Quiz for Kids: Making Abstract Concepts Accessible</h2>
        <p>
          Chemistry and Earth & Weather are often perceived as harder science topics, but MindSnap's questions
          focus on the observable and tangible: what happens when you mix baking soda and vinegar, what causes
          thunder, why does ice float on water, what is a hurricane. The Chemistry Basics topic introduces
          states of matter (solid, liquid, gas), simple chemical reactions, and familiar elements without
          requiring mathematical knowledge.
        </p>
        <p>
          The Human Body topic rounds out the six topics, covering the major organ systems in an age-appropriate
          way: the digestive system, the circulatory system, the skeleton and muscles, and the senses. Children
          are often fascinated by facts about their own bodies, and the "Did You Know?" facts in this topic
          are particularly striking — for example, that the human body contains about 37 trillion cells, or
          that the small intestine is about 6 metres long.
        </p>
      </div>
    </div>
  </div>
</section>

<x-faq-section :faqs="$faqs" id="scienceQuizFaq" />

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
            <div class="text-muted sq-related-desc">{{ $tool['desc'] }}</div>
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
  const questions = {
    space: [
      { q:'How many planets are in our solar system?', opts:['7','8','9','10'], a:1, fact:'The eight planets in order are Mercury, Venus, Earth, Mars, Jupiter, Saturn, Uranus, and Neptune. Pluto was reclassified as a "dwarf planet" in 2006.' },
      { q:'Which is the largest planet in our solar system?', opts:['Saturn','Earth','Jupiter','Neptune'], a:2, fact:'Jupiter is so large that all the other planets in the solar system could fit inside it — with room to spare! Its Great Red Spot is a storm that has been raging for over 350 years.' },
      { q:'What is the closest star to Earth?', opts:['Sirius','Alpha Centauri','The Sun','Betelgeuse'], a:2, fact:'The Sun is about 150 million km from Earth. Light from the Sun takes about 8 minutes to reach us. The next nearest star, Proxima Centauri, is over 4 light-years away.' },
      { q:'Which planet is known as the Red Planet?', opts:['Venus','Mars','Jupiter','Mercury'], a:1, fact:'Mars looks red because its surface is covered in iron oxide — rust! It has the tallest volcano in the solar system: Olympus Mons, which is nearly 3 times the height of Mount Everest.' },
      { q:'What do you call a rock that falls from space and lands on Earth?', opts:['Comet','Asteroid','Meteorite','Shooting star'], a:2, fact:'When a space rock is still in space it\'s called a meteoroid. When it enters Earth\'s atmosphere it\'s a meteor (or "shooting star"). If it survives and hits the ground, it becomes a meteorite.' },
      { q:'What is the name of our galaxy?', opts:['Andromeda','The Milky Way','Orion Arm','Cosmos'], a:1, fact:'The Milky Way contains an estimated 100–400 billion stars. Our Sun is located about halfway out from the centre, in a region called the Orion Arm. Light takes about 100,000 years to cross the galaxy.' },
      { q:'Which is the smallest planet in our solar system?', opts:['Mars','Pluto','Venus','Mercury'], a:3, fact:'Mercury is smaller than some moons — including Jupiter\'s moon Ganymede. Despite being closest to the Sun, Mercury is not the hottest planet; Venus is, due to its thick atmosphere trapping heat.' },
      { q:'What causes a solar eclipse?', opts:['Earth passes between the Moon and Sun','The Moon passes between Earth and the Sun','The Sun moves behind a cloud in space','The Earth rotates away from the Sun'], a:1, fact:'A total solar eclipse — where the Moon completely covers the Sun — lasts only a few minutes and can only be seen from a narrow path on Earth. The next total solar eclipse visible from the UK will be in 2090.' },
      { q:'What is a light year?', opts:['The amount of sunlight in a year','The distance light travels in one year','How long it takes to reach the Moon','A unit of time used by astronauts'], a:1, fact:'One light year is about 9.46 trillion kilometres (5.88 trillion miles). The Andromeda Galaxy — the nearest large galaxy to the Milky Way — is about 2.5 million light years away.' },
      { q:'What layer of gas surrounds Earth and protects us?', opts:['The ionosphere','The stratosphere','The atmosphere','The magnetosphere'], a:2, fact:'Earth\'s atmosphere extends about 10,000 km above the surface and is divided into five layers. Without it, Earth\'s surface temperature would swing between +120°C in the day and -170°C at night — like on the Moon.' },
    ],
    animals: [
      { q:'What is the largest animal on Earth?', opts:['African elephant','Great white shark','Blue whale','Giant squid'], a:2, fact:'Blue whales can reach 30 metres in length and weigh up to 200 tonnes — that\'s heavier than 30 elephants. Their hearts are the size of a small car and can be heard from 3 kilometres away.' },
      { q:'What are young kangaroos called?', opts:['Cubs','Joeys','Kittens','Pups'], a:1, fact:'A newborn joey is about the size of a grain of rice — smaller than your thumbnail! It crawls into its mother\'s pouch immediately after birth, where it continues developing for several months.' },
      { q:'Which animal is the fastest on land?', opts:['Lion','Greyhound','Cheetah','Horse'], a:2, fact:'Cheetahs can reach 70 mph (112 km/h) but can only sustain it for about 30 seconds before overheating. They accelerate from 0 to 60 mph in just 3 seconds — faster than most sports cars.' },
      { q:'How many legs does a spider have?', opts:['6','8','10','12'], a:1, fact:'Spiders have 8 legs, which is why they are arachnids, not insects (insects have 6 legs). There are about 45,000 known spider species, and scientists estimate there could be 3 times as many undiscovered.' },
      { q:'What do you call an animal that only eats plants?', opts:['Carnivore','Omnivore','Herbivore','Insectivore'], a:2, fact:'Herbivores include cows, sheep, horses, rabbits, elephants, and giant pandas. Some herbivores, like the blue whale, eat only tiny sea creatures called krill — technically making them carnivores despite their filter-feeding behaviour.' },
      { q:'Which animal has the longest lifespan?', opts:['Giant tortoise','Greenland shark','Bowhead whale','Ocean quahog clam'], a:1, fact:'The Greenland shark grows so slowly (1 cm per year) that scientists have found sharks estimated to be over 400 years old using radiocarbon dating. Some individuals alive today were born before Shakespeare.' },
      { q:'What is the only mammal capable of true flight?', opts:['Flying squirrel','Sugar glider','Bat','Flying fish'], a:2, fact:'Bats make up about 20% of all mammal species — there are over 1,400 bat species. They are the only mammals with powered flight (flying squirrels glide but cannot fly). Many bats use echolocation to navigate in complete darkness.' },
      { q:'Where do penguins live in the wild?', opts:['The Arctic','The Antarctic only','Antarctica and the Southern Hemisphere','Only in zoos'], a:2, fact:'While most penguins live in Antarctica, many species live further north — including the Galápagos penguin, which lives on the equator! No penguins live in the Arctic; that is polar bear territory.' },
      { q:'What is a group of lions called?', opts:['Herd','Pack','Pride','Colony'], a:2, fact:'A pride of lions typically contains 2–40 lions. Female lions do most of the hunting and raise the cubs cooperatively. Male lions are responsible for defending the territory. A group of male lions without a pride is called a coalition.' },
      { q:'How do fish breathe underwater?', opts:['They hold their breath','Through gills that extract oxygen from water','They surface to breathe every hour','Through their skin'], a:1, fact:'Fish pass water over their gills, which are lined with tiny blood vessels that absorb dissolved oxygen from the water. Some fish, like the lungfish, can also breathe air and survive out of water for months.' },
    ],
    plants: [
      { q:'What process do plants use to make their own food?', opts:['Respiration','Digestion','Photosynthesis','Transpiration'], a:2, fact:'Photosynthesis converts CO2 and water into glucose and oxygen using sunlight. One large tree produces enough oxygen for about 4 people to breathe. Forests are sometimes called the "lungs of the Earth" for this reason.' },
      { q:'What green pigment in leaves captures sunlight?', opts:['Carotene','Chlorophyll','Anthocyanin','Melanin'], a:1, fact:'Chlorophyll absorbs red and blue light but reflects green — that\'s why leaves look green. In autumn, chlorophyll breaks down, revealing yellow and orange pigments (carotenoids) that were there all along but hidden by the green.' },
      { q:'What part of a plant absorbs water from the soil?', opts:['Stem','Leaves','Roots','Flowers'], a:2, fact:'A single rye plant has over 14 billion root hairs. If laid end to end, its total root system would stretch over 600 km. Roots also anchor the plant and store nutrients.' },
      { q:'What do we call the powder that fertilises flowers?', opts:['Nectar','Spores','Pollen','Sap'], a:2, fact:'A single flower can produce millions of pollen grains. Pollen can travel extraordinary distances — scientists have found pollen from North American plants in Greenland. Bees carry pollen in special "pollen baskets" on their back legs.' },
      { q:'How do seeds travel to new places?', opts:['They always stay where they fall','Wind, water, animals, or explosion','Only by growing legs','By being carried only by birds'], a:1, fact:'Some plants (like the squirting cucumber) explode their seeds at speeds up to 100 km/h! Coconuts float across oceans. Dandelion seeds have tiny parachutes. Burdock seeds have hooks that inspired the invention of Velcro.' },
      { q:'Which plant is the largest living organism on Earth?', opts:['Giant Sequoia tree','Seagrass meadow','Honey fungus (mushroom)','Amazon rainforest'], a:2, fact:'The largest known individual organism is a honey fungus (Armillaria ostoyae) in Oregon, USA. It covers 9.65 km² — larger than 1,350 football pitches — and is estimated to be over 8,000 years old.' },
      { q:'What do plants release during photosynthesis?', opts:['Carbon dioxide','Nitrogen','Oxygen','Water vapour only'], a:2, fact:'Plants absorb CO2 and release O2 during photosynthesis — the opposite of what animals do during respiration. This is why having plants indoors can slightly improve air quality, though the effect is small.' },
      { q:'What is the world\'s largest flower?', opts:['Giant Water Lily','Sunflower','Titan Arum','Rafflesia arnoldii'], a:3, fact:'Rafflesia arnoldii can grow up to 1 metre in diameter and weigh up to 11 kg. It produces no roots, stems, or leaves — it is entirely parasitic and lives inside its host vine. It also smells like rotting flesh to attract flies for pollination.' },
    ],
    body: [
      { q:'How many bones are in the adult human body?', opts:['150','206','300','365'], a:1, fact:'Babies are born with about 300 bones, but many fuse together as we grow. By adulthood, we have 206. The smallest bone is the stirrup (stapes) in your ear, at just 3 mm long. The largest is the femur (thigh bone).' },
      { q:'What organ pumps blood around the body?', opts:['Lungs','Liver','Heart','Kidneys'], a:2, fact:'Your heart beats about 100,000 times a day — over 2.5 billion times in a lifetime. In one year, it pumps enough blood to fill 8 Olympic swimming pools. The heart has its own electrical system that triggers each beat.' },
      { q:'How many chambers does a human heart have?', opts:['2','3','4','5'], a:2, fact:'The heart has four chambers: two atria (upper) and two ventricles (lower). The left ventricle pumps oxygenated blood to the whole body and has the thickest walls. The right ventricle pumps blood only to the lungs.' },
      { q:'What organ is responsible for filtering blood and producing urine?', opts:['Liver','Pancreas','Kidneys','Spleen'], a:2, fact:'Your kidneys filter all your blood about 40 times a day — roughly 200 litres of blood in 24 hours. They contain about 1 million tiny filtering units called nephrons. Humans can live normally with just one healthy kidney.' },
      { q:'How long is the small intestine in an adult?', opts:['1–2 metres','3–4 metres','6–7 metres','10–12 metres'], a:2, fact:'The small intestine is actually longer than the large intestine! Its inner surface is covered in tiny finger-like projections called villi, which increase the absorptive surface area to roughly the size of a tennis court.' },
      { q:'What is the largest organ in the human body?', opts:['Liver','Brain','Skin','Intestines'], a:2, fact:'The skin is the body\'s largest organ, covering about 2 square metres in adults and making up 15% of total body weight. It renews itself completely about every 27 days. You shed about 30,000–40,000 dead skin cells every hour.' },
      { q:'Which part of the brain controls balance and coordination?', opts:['Cerebrum','Cerebellum','Brainstem','Hypothalamus'], a:1, fact:'The cerebellum (meaning "little brain" in Latin) contains more than half of all the neurons in the brain despite being only 10% of brain volume. It coordinates muscle movements so smoothly that most of its work happens below conscious awareness.' },
      { q:'How many muscles does the human body have?', opts:['Over 100','Around 400','Over 600','Exactly 500'], a:2, fact:'The human body has over 600 skeletal muscles. The strongest muscle relative to its size is the masseter (jaw muscle). The largest is the gluteus maximus. The smallest is the stapedius in the ear, measuring just 1.27 mm.' },
    ],
    chemistry: [
      { q:'What are the three states of matter?', opts:['Solid, Liquid, Gas','Hot, Warm, Cold','Element, Compound, Mixture','Hard, Soft, Liquid'], a:0, fact:'There is actually a fourth common state of matter: plasma — a super-hot gas where electrons have been stripped from atoms. The Sun and most visible stars are made of plasma. Lightning is also a plasma.' },
      { q:'What gas do humans breathe in that keeps us alive?', opts:['Nitrogen','Hydrogen','Oxygen','Carbon dioxide'], a:2, fact:'Air is about 78% nitrogen, 21% oxygen, and 1% other gases. While we breathe nitrogen with every breath, our bodies do not use it — it is simply exhaled unchanged. Oxygen is the gas our cells need for releasing energy from food.' },
      { q:'What happens when you mix an acid and a base?', opts:['They explode','They neutralise each other','They both evaporate','Nothing happens'], a:1, fact:'Mixing an acid and a base produces a salt and water — a process called neutralisation. For example, hydrochloric acid + sodium hydroxide → sodium chloride (table salt) + water. Antacid tablets work by neutralising stomach acid.' },
      { q:'What is water made of?', opts:['Hydrogen and oxygen','Carbon and oxygen','Nitrogen and hydrogen','Oxygen only'], a:0, fact:'Each water molecule (H₂O) contains 2 hydrogen atoms bonded to 1 oxygen atom. The bond angle of 104.5° gives water its unusual properties, including surface tension, high boiling point, and the fact that ice floats on liquid water.' },
      { q:'What do you call the smallest particle of an element that keeps its chemical properties?', opts:['Molecule','Proton','Atom','Cell'], a:2, fact:'Atoms are mostly empty space. If an atom were the size of a football stadium, its nucleus would be about the size of a marble at the centre. The rest is electron "cloud." All ordinary matter is made from just 118 known elements.' },
      { q:'Which gas makes fizzy drinks bubbly?', opts:['Oxygen','Nitrogen','Carbon dioxide','Hydrogen'], a:2, fact:'CO2 is dissolved into drinks under high pressure. When you open the bottle, the pressure drops and CO2 escapes as bubbles. Some fizzy drinks contain more CO2 by volume than there is CO2 in the air you breathe — by about 200 times.' },
      { q:'What change of state occurs when liquid water becomes water vapour?', opts:['Condensation','Freezing','Evaporation','Melting'], a:2, fact:'Evaporation can happen at any temperature (not just at 100°C). Water from puddles, lakes, and oceans is constantly evaporating into the atmosphere, forming clouds and eventually returning as rain or snow in the water cycle.' },
      { q:'Iron left in the rain forms what orange substance?', opts:['Oxide','Rust','Paint','Salt'], a:1, fact:'Rust is iron oxide (Fe₂O₃), formed when iron reacts with oxygen and water. The Eiffel Tower must be repainted every 7 years to prevent rusting — it takes 60 tonnes of paint each time. Stainless steel resists rust because it contains chromium.' },
    ],
    earth: [
      { q:'What causes the seasons on Earth?', opts:['Earth\'s distance from the Sun changes throughout the year','The Moon blocks sunlight in winter','Earth is tilted on its axis as it orbits the Sun','The Sun gets hotter and cooler throughout the year'], a:2, fact:'Earth\'s axis is tilted at 23.5°. When the Northern Hemisphere tilts toward the Sun, it experiences summer. When it tilts away, it experiences winter. Earth is actually slightly closer to the Sun in January (Northern Hemisphere winter) than in July.' },
      { q:'What is the most abundant gas in Earth\'s atmosphere?', opts:['Oxygen','Carbon dioxide','Argon','Nitrogen'], a:3, fact:'Nitrogen makes up 78% of air, oxygen 21%, argon 0.93%, and CO2 about 0.04%. Despite CO2\'s small percentage, it acts as a powerful greenhouse gas — changes of less than 0.01% have driven ice ages and warm periods in Earth\'s history.' },
      { q:'What is the name of the process that drives weather by moving water between the surface and atmosphere?', opts:['Carbon cycle','Nitrogen cycle','Water cycle','Rock cycle'], a:2, fact:'The water cycle moves about 496,000 km³ of water through evaporation, condensation, and precipitation every year. Some of the water molecules in your body may have been drunk by a dinosaur — the Earth\'s water is continually recycled.' },
      { q:'What type of rock is formed from cooled lava?', opts:['Sedimentary','Metamorphic','Igneous','Fossil'], a:2, fact:'Igneous rocks form when magma (underground) or lava (on the surface) cools and solidifies. Granite is a common igneous rock formed underground. Basalt forms from fast-cooling surface lava. The ocean floor is almost entirely basalt.' },
      { q:'What is the centre of the Earth called?', opts:['The mantle','The crust','The core','The magma'], a:2, fact:'Earth\'s inner core is a solid ball of iron and nickel about the size of the Moon, at around 5,400°C. The outer core is liquid iron and nickel whose movement generates Earth\'s magnetic field — which protects us from harmful solar radiation.' },
      { q:'What scale measures the strength of earthquakes?', opts:['Beaufort scale','Saffir-Simpson scale','Richter scale','Fujita scale'], a:2, fact:'The Richter scale is logarithmic — each whole number increase represents 10× more ground shaking and about 31× more energy. The largest recorded earthquake was a magnitude 9.5 in Chile in 1960. It generated waves that circled the globe multiple times.' },
      { q:'What causes thunder during a storm?', opts:['Clouds crashing together','The rapid expansion of air heated by lightning','Heavy rain hitting the ground','Wind at high altitude'], a:1, fact:'A lightning bolt heats the surrounding air to about 30,000°C — five times hotter than the surface of the Sun. This rapid heating causes explosive air expansion, creating the sound wave we hear as thunder. Sound travels about 1 km every 3 seconds, which is why you can estimate distance to lightning.' },
      { q:'How much of Earth\'s surface is covered by water?', opts:['About 50%','About 60%','About 71%','About 90%'], a:2, fact:'Despite 71% of Earth being covered in water, 97.5% of it is saltwater. Of the fresh water, 68.7% is locked in ice caps and glaciers. Only about 0.3% of all Earth\'s water is accessible fresh water in rivers and lakes — less than a thimble per person if spread evenly.' },
    ],
  };

  // ── State ─────────────────────────────────────────────────────────────────────
  let topic = null, pool = [], current = 0, score = 0, streak = 0;
  let answered = false;

  // ── DOM refs ──────────────────────────────────────────────────────────────────
  const topicSelector = document.getElementById('topicSelector');
  const quizProgress  = document.getElementById('quizProgress');
  const quizQuestion  = document.getElementById('quizQuestion');
  const quizScore     = document.getElementById('quizScore');
  const sqNum         = document.getElementById('sqNum');
  const sqTopic       = document.getElementById('sqTopic');
  const sqProgressBar = document.getElementById('sqProgressBar');
  const sqQuestionText= document.getElementById('sqQuestionText');
  const sqChoices     = document.getElementById('sqChoices');
  const sqFeedback    = document.getElementById('sqFeedback');
  const sqFact        = document.getElementById('sqFact');
  const sqFactText    = document.getElementById('sqFactText');
  const sqNext        = document.getElementById('sqNext');
  const sqBadgeEmoji  = document.getElementById('sqBadgeEmoji');
  const sqBadgeName   = document.getElementById('sqBadgeName');
  const sqFinalScore  = document.getElementById('sqFinalScore');
  const sqFinalMsg    = document.getElementById('sqFinalMsg');

  const topicNames = { space:'🌌 Space', animals:'🦁 Animals', plants:'🌿 Plants', body:'🫀 Human Body', chemistry:'⚗️ Chemistry', earth:'🌍 Earth & Weather' };

  document.querySelectorAll('.topic-btn').forEach(btn => {
    btn.addEventListener('click', function () { startQuiz(this.dataset.topic); });
  });

  document.getElementById('sqTryAgain').addEventListener('click', () => startQuiz(topic));
  document.getElementById('sqChangeTopic').addEventListener('click', () => {
    quizScore.classList.add('d-none');
    quizProgress.classList.add('d-none');
    quizQuestion.classList.add('d-none');
    topicSelector.classList.remove('d-none');
  });
  sqNext.addEventListener('click', () => { current++; if (current < pool.length) loadQuestion(); else endQuiz(); });

  function startQuiz(t) {
    topic = t;
    pool = shuffle([...questions[t]]).slice(0, 10);
    current = 0; score = 0; streak = 0;
    sqTopic.textContent = topicNames[t];
    topicSelector.classList.add('d-none');
    quizScore.classList.add('d-none');
    quizProgress.classList.remove('d-none');
    quizQuestion.classList.remove('d-none');
    loadQuestion();
  }

  function loadQuestion() {
    answered = false;
    const q = pool[current];
    sqNum.textContent = current + 1;
    sqProgressBar.style.width = (current / pool.length * 100) + '%';
    sqQuestionText.textContent = q.q;
    sqFeedback.className = 'mt-3 d-none';
    sqFact.classList.add('d-none');
    sqNext.classList.add('d-none');
    sqChoices.innerHTML = '';
    q.opts.forEach((opt, i) => {
      const col = document.createElement('div');
      col.className = 'col-6';
      const btn = document.createElement('button');
      btn.className = 'btn btn-outline-secondary w-100 py-2';
      btn.textContent = opt;
      btn.addEventListener('click', () => handleAnswer(i, q));
      col.appendChild(btn);
      sqChoices.appendChild(col);
    });
  }

  function handleAnswer(chosen, q) {
    if (answered) return;
    answered = true;
    sqChoices.querySelectorAll('button').forEach(b => b.disabled = true);
    const isCorrect = chosen === q.a;
    if (isCorrect) {
      score++; streak++;
      sqChoices.querySelectorAll('button')[chosen].classList.replace('btn-outline-secondary','btn-success');
      sqFeedback.className = 'mt-3 alert alert-success';
      sqFeedback.textContent = '✅ Correct! ' + (streak >= 3 ? 'Amazing streak: ' + streak + '! 🔥' : '');
    } else {
      streak = 0;
      sqChoices.querySelectorAll('button')[chosen].classList.replace('btn-outline-secondary','btn-danger');
      sqChoices.querySelectorAll('button')[q.a].classList.replace('btn-outline-secondary','btn-success');
      sqFeedback.className = 'mt-3 alert alert-warning';
      sqFeedback.textContent = 'Not quite! The answer is: ' + q.opts[q.a];
    }
    sqFeedback.classList.remove('d-none');
    sqFactText.textContent = q.fact;
    sqFact.classList.remove('d-none');
    sqNext.classList.remove('d-none');
  }

  function endQuiz() {
    quizProgress.classList.add('d-none');
    quizQuestion.classList.add('d-none');
    quizScore.classList.remove('d-none');
    sqFinalScore.textContent = score;
    let emoji, name, msg;
    if (score >= 8)      { emoji = '🏆'; name = 'Expert Badge Earned!';    msg = 'Incredible work — you\'re a real science expert! 🎉'; }
    else if (score >= 5) { emoji = '🧭'; name = 'Explorer Badge Earned!';  msg = 'Great job! You really know your science. Keep exploring! 💡'; }
    else                 { emoji = '🔬'; name = 'Scientist Badge Earned!'; msg = 'Nice start! Every scientist begins with curiosity. Try again! 📚'; }
    sqBadgeEmoji.textContent = emoji;
    sqBadgeName.textContent  = name;
    sqFinalMsg.textContent   = msg;
  }

  function shuffle(arr) { return arr.sort(() => Math.random() - 0.5); }

})();
</script>
@endpush
