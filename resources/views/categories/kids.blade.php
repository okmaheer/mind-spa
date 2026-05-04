@extends('layouts.app')

@section('title', 'Kids Zone — Free Educational Games & Quizzes for Children | MindSnap')
@section('description', 'Free educational activities for kids aged 5–14: math puzzles, word games, science quiz, animal quiz, and spelling quiz. Ad-free, no accounts, no data collection. Safe for classroom and home use.')
@section('canonical', config('app.url') . '/kids')
@section('robots', 'index, follow')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@graph": [
    {
      "@@type": "CollectionPage",
      "@@id": "{{ config('app.url') }}/kids#collection",
      "url": "{{ config('app.url') }}/kids",
      "name": "Kids Zone — Free Educational Games & Quizzes",
      "description": "Free educational games and quizzes for children: math puzzles, word games, science quiz, animal quiz, and spelling quiz. No ads, no accounts.",
      "audience": { "@@type": "EducationalAudience", "educationalRole": "student" },
      "inLanguage": "en",
      "publisher": { "@@type": "Organization", "name": "MindSnap", "url": "{{ config('app.url') }}" }
    },
    {
      "@@type": "BreadcrumbList",
      "itemListElement": [
        { "@@type": "ListItem", "position": 1, "name": "Home", "item": "{{ config('app.url') }}" },
        { "@@type": "ListItem", "position": 2, "name": "Kids Zone", "item": "{{ config('app.url') }}/kids" }
      ]
    },
    {
      "@@type": "FAQPage",
      "mainEntity": [
        {
          "@@type": "Question",
          "name": "Are the kids activities safe and ad-free?",
          "acceptedAnswer": { "@@type": "Answer", "text": "Yes. The MindSnap Kids Zone has zero ads, no data collection, no accounts required, and no in-app purchases. It is completely safe for children of all ages." }
        },
        {
          "@@type": "Question",
          "name": "What age group is the Kids Zone designed for?",
          "acceptedAnswer": { "@@type": "Answer", "text": "The Kids Zone is designed for children aged 5–14. Math puzzles, spelling quizzes, and word games are levelled by age group. Science and animal quizzes are suitable for ages 8–14." }
        },{
          "@@type": "Question",
          "name": "Can teachers use MindSnap in the classroom?",
          "acceptedAnswer": { "@@type": "Answer", "text": "Yes. All Kids Zone activities work on tablets, Chromebooks, and desktop browsers with no installation. No school accounts or licences are required. Activities align with primary school curriculum topics in maths, science, spelling, and vocabulary." }
        },
        {
          "@@type": "Question",
          "name": "How many questions are in the kids quizzes?",
          "acceptedAnswer": { "@@type": "Answer", "text": "Most kids quizzes have 15 questions with instant answer feedback. A score screen is shown at the end. Children can retake quizzes as many times as they like — great for tracking improvement over time." }
        },
        {
          "@@type": "Question",
          "name": "Is MindSnap COPPA and GDPR compliant for children?",
          "acceptedAnswer": { "@@type": "Answer", "text": "MindSnap Kids Zone collects zero personal data from children, requires no registration, and serves no advertisements. There are no cookies, tracking pixels, or analytics that identify individual children. This approach exceeds the requirements of COPPA (USA) and GDPR-K (UK/EU)." }
        }
      ]
    }
  ]
}
</script>
@endsection

@section('content')

<nav aria-label="Breadcrumb" style="background:#f0f2f5; padding:10px 0; border-bottom:1px solid var(--border);">
  <div class="container-xl">
    <ol class="breadcrumb mb-0" style="font-size:.84rem;">
      <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color:var(--primary-cta);">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page" style="color:var(--text-muted);">Kids Zone</li>
    </ol>
  </div>
</nav>

{{-- Hero --}}
<section style="background:linear-gradient(135deg,#0f4c75 0%,#1b6ca8 50%,#17a2b8 100%); padding:64px 0 48px;">
  <div class="container-xl">
    <div class="row align-items-center g-4">
      <div class="col-lg-8">
        <div class="d-flex align-items-center gap-3 mb-3">
          <span style="font-size:2.8rem; line-height:1;">👶</span>
          <div class="d-flex gap-2 flex-wrap">
            <span class="badge" style="background:rgba(255,255,255,.2); color:#fff; border-radius:50px; font-size:.8rem; padding:5px 14px;">Kids Zone</span>
            <span class="badge" style="background:rgba(255,255,255,.15); color:#fff; border-radius:50px; font-size:.78rem; padding:5px 14px;">✓ No Ads</span>
            <span class="badge" style="background:rgba(255,255,255,.15); color:#fff; border-radius:50px; font-size:.78rem; padding:5px 14px;">✓ No Signup</span>
          </div>
        </div>
        <h1 style="color:#fff; margin-bottom:16px;">Kids Zone — Free Educational Games & Quizzes</h1>
        <p style="color:rgba(255,255,255,.85); font-size:1.1rem; line-height:1.7; max-width:620px; margin-bottom:24px;">
          Fun, safe, and educational activities for children aged 5–14. Maths puzzles, spelling, science, word games, and animal quizzes —
          completely free with no ads, no accounts, and no data collected.
        </p>
        <div style="background:rgba(255,255,255,.15); border:1px solid rgba(255,255,255,.3); border-radius:10px; padding:14px 20px; display:inline-flex; align-items:center; gap:10px;">
          <span style="font-size:1.4rem;">🔒</span>
          <span style="color:#fff; font-size:.88rem; font-weight:600;">Safe for Kids — Zero ads, zero tracking, zero data collection</span>
        </div>
      </div>
      <div class="col-lg-4 d-none d-lg-flex justify-content-end">
        <div style="background:rgba(255,255,255,.15); border:1px solid rgba(255,255,255,.25); border-radius:16px; padding:28px 32px; text-align:center;">
          <div style="font-size:3rem; margin-bottom:8px;">5</div>
          <div style="color:rgba(255,255,255,.8); font-size:.9rem;">Activities</div>
          <div style="height:1px; background:rgba(255,255,255,.2); margin:14px 0;"></div>
          <div style="font-size:1.6rem; margin-bottom:4px;">Ages 5–14</div>
          <div style="color:rgba(255,255,255,.8); font-size:.9rem;">Designed for</div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Activities Grid --}}
<section style="padding:56px 0;">
  <div class="container-xl">
    <h2 class="mb-2" style="font-size:1.5rem;">Learning Activities</h2>
    <p class="mb-4" style="color:var(--text-muted); font-size:.9rem;">Tap any activity to start — no loading screens, no signups.</p>

    @if(count($tools))
    <div class="row g-4">
      @foreach($tools as $tool)
      <div class="col-sm-6 col-lg-4">
        <a href="/{{ $tool['slug'] }}" class="tool-card d-block p-4 h-100 text-decoration-none"
           style="border-left:4px solid #17a2b8;">
          <div class="d-flex align-items-start gap-3">
            <span style="font-size:2rem; line-height:1; flex-shrink:0;">{{ $tool['icon'] ?? '👶' }}</span>
            <div style="min-width:0;">
              <div style="font-weight:700; color:var(--primary-dark); font-size:.95rem; margin-bottom:4px;">{{ $tool['name'] }}</div>
              <div style="font-size:.83rem; color:var(--text-muted); line-height:1.5;">{{ $tool['description'] }}</div>
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
    @else
    <div class="row g-4">
      @foreach([
        ['🔢','Maths Puzzles','/kids/math-puzzles','Addition, subtraction, multiplication & more. Levelled by age for children 6–12.','Ages 6–12'],
        ['📝','Word Games','/kids/word-games','Vocabulary building, word matching, and spelling activities. Fun and educational.','Ages 7–13'],
        ['🔬','Science Quiz','/kids/science-quiz','Biology, chemistry, physics & space. 15 illustrated questions for curious minds.','Ages 8–14'],
        ['🦁','Animal Quiz','/kids/animal-quiz','Mammals, reptiles, ocean creatures & birds. 15 fun animal questions.','Ages 5–12'],
        ['🔤','Spelling Quiz','/kids/spelling-quiz','Graded word lists from Year 1 through Year 6. Practice anytime.','Ages 5–12'],
      ] as [$icon,$name,$slug,$desc,$age])
      <div class="col-sm-6 col-lg-4">
        <a href="{{ $slug }}" class="tool-card d-block p-4 h-100 text-decoration-none"
           style="border-left:4px solid #17a2b8;">
          <div class="d-flex align-items-start gap-3">
            <span style="font-size:2rem; line-height:1; flex-shrink:0;">{{ $icon }}</span>
            <div>
              <div style="font-weight:700; color:var(--primary-dark); font-size:.95rem; margin-bottom:4px;">{{ $name }}</div>
              <div style="font-size:.83rem; color:var(--text-muted); line-height:1.5; margin-bottom:8px;">{{ $desc }}</div>
              <span style="background:rgba(23,162,184,.12); color:#0d7a8d; border-radius:50px; padding:2px 10px; font-size:.75rem; font-weight:600;">{{ $age }}</span>
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
    @endif
  </div>
</section>

{{-- Safety Promise --}}
<section style="padding:48px 0; background:#fff;">
  <div class="container-xl">
    <div class="row g-4 align-items-center">
      <div class="col-lg-6">
        <h2>Safe for Every Child</h2>
        <p style="color:var(--text); line-height:1.8; margin-bottom:16px;">
          The MindSnap Kids Zone was built with one rule: <strong>children come first</strong>.
          Every activity is reviewed for age-appropriateness, accuracy, and educational value.
        </p>
        <p style="color:var(--text); line-height:1.8;">
          Unlike other free educational sites, we show <strong>zero advertisements</strong> in the Kids Zone,
          collect <strong>no personal data</strong>, and require <strong>no accounts</strong> — ever.
        </p>
      </div>
      <div class="col-lg-6">
        <div class="row g-3">
          @foreach([
            ['🚫','No Ads','Zero advertising in the entire Kids Zone — no banners, no video ads, no pop-ups'],
            ['🔒','No Data','We collect no personal data from children. No cookies, no tracking'],
            ['👤','No Accounts','No registration or login required. Just open and play'],
            ['✅','Age-Appropriate','All content reviewed and graded for specific age groups'],
          ] as [$icon,$title,$desc])
          <div class="col-6">
            <div class="tool-card p-4 h-100">
              <div style="font-size:1.6rem; margin-bottom:8px;">{{ $icon }}</div>
              <div style="font-weight:700; color:var(--primary-dark); font-size:.88rem; margin-bottom:4px;">{{ $title }}</div>
              <div style="font-size:.78rem; color:var(--text-muted); line-height:1.5;">{{ $desc }}</div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

<section class="py-5" style="background:#f8f9ff;">
  <div class="container" style="max-width:860px;">
    <h2 class="mb-4" style="color:var(--primary-dark);">Free Educational Games for Kids Aged 5–14</h2>
    <p>Educational games are most effective when they balance challenge and achievement — the "flow state" described by psychologist Mihaly Csikszentmihalyi. MindSnap's kids activities are designed to sit at the edge of each age group's ability: familiar enough to engage, challenging enough to build real skills. Math puzzles build number sense and arithmetic fluency. Spelling quizzes reinforce phonics patterns. Science and animal quizzes develop factual knowledge and categorical thinking — all without screen-time pressure or in-app purchases.</p>
    <h2 class="mt-5 mb-4" style="color:var(--primary-dark);">Educational Quizzes for Kids — How Quizzing Helps Learning</h2>
    <p>The testing effect is one of the most replicated findings in educational psychology: being tested on information strengthens memory for that information far more effectively than re-reading or passive review. A child who takes a quiz about animals remembers more animal facts one week later than a child who read the same facts in a book. This is why quizzing is a legitimate, research-backed learning strategy — not just assessment. Our kids quizzes are designed as learning tools as much as tests.</p>
    <h2 class="mt-5 mb-4" style="color:var(--primary-dark);">Safe Online Activities for Children — Our Approach</h2>
    <p>MindSnap Kids is built with child safety as the primary design constraint. There are no user accounts, no data collection, no behavioural tracking, no social features, no in-app purchases, and no advertising. Children interact only with educational content. All activities work on any device with a browser — no app download required. The site is fully compliant with COPPA (US Children's Online Privacy Protection Act) and GDPR-K (EU children's data rules) because we collect no personal data whatsoever.</p>
  </div>
</section>

{{-- FAQ --}}
<section style="padding:56px 0;">
  <div class="container-xl">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <h2 class="text-center mb-5">Frequently Asked Questions</h2>
        <div class="accordion" id="kidsFaq">
          @foreach([
            ['Is the Kids Zone completely free and safe?',
             'Yes — 100% free, zero ads, zero data collection, no accounts needed. The Kids Zone on MindSnap is one of the few truly safe, ad-free educational platforms available online.'],
            ['What age group is the Kids Zone designed for?',
             'Content is designed for children aged <strong>5–14</strong>. Spelling and maths activities are levelled by year group (Year 1–6). Science, animal, and word activities suit ages 8–14. Younger children should use the site with a parent.'],
            ['Can teachers use MindSnap in the classroom?',
             'Yes — teachers are welcome to use any Kids Zone activity in the classroom. All activities work on tablets, Chromebooks, and desktop browsers with no installation required. No school accounts or licences needed.'],
            ['How many questions do the kids quizzes have?',
             'Most kids quizzes have <strong>15 questions</strong>. Answers are marked instantly after each question. A score screen is shown at the end — a great way for children to track improvement.'],
            ['Can teachers use MindSnap in the classroom?',
             'Yes — all Kids Zone activities work on tablets, Chromebooks, and desktop browsers with no installation required. No school accounts or licences needed. Activities cover curriculum topics including maths, science, spelling, and vocabulary for primary school children.'],
            ['Is MindSnap compliant with child safety laws (COPPA/GDPR)?',
             'The MindSnap Kids Zone collects <strong>zero personal data</strong> from children. No registration, no cookies, no tracking, no ads. This approach exceeds COPPA (USA) and GDPR-K (UK/EU) requirements. Parents can let their children use the site with complete confidence.'],
          ] as $i => [$q,$a])
          <div class="accordion-item" style="border:1px solid var(--border); border-radius:10px !important; margin-bottom:10px; overflow:hidden;">
            <h3 class="accordion-header">
              <button class="accordion-button {{ $i > 0 ? 'collapsed' : '' }}" type="button"
                      data-bs-toggle="collapse" data-bs-target="#kFaq{{ $i }}"
                      style="font-weight:600; font-size:.95rem; background:transparent; color:var(--primary-dark);">
                {{ $q }}
              </button>
            </h3>
            <div id="kFaq{{ $i }}" class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}" data-bs-parent="#kidsFaq">
              <div class="accordion-body" style="font-size:.92rem; line-height:1.8; color:var(--text);">{!! $a !!}</div>
            </div>
          </div>
          @endforeach

          <div class="accordion-item border-0 mb-2">
            <h3 class="accordion-header">
              <button class="accordion-button collapsed fw-600" type="button" data-bs-toggle="collapse" data-bs-target="#faq-kd6">
                What age are MindSnap kids activities suitable for?
              </button>
            </h3>
            <div id="faq-kd6" class="accordion-collapse collapse">
              <div class="accordion-body pt-0" style="color:#555;">
                MindSnap's kids activities are designed for children aged 5–14. Younger children (5–7) benefit most from the spelling quiz and animal quiz, which use simple vocabulary and recognition-based questions. Children aged 8–11 are well suited to the science quiz, math puzzles, and word games. Children aged 12–14 can also explore the general knowledge quizzes in the main quizzes section, which cover history, geography, and biology at a secondary school level.
              </div>
            </div>
          </div>
          <div class="accordion-item border-0 mb-2">
            <h3 class="accordion-header">
              <button class="accordion-button collapsed fw-600" type="button" data-bs-toggle="collapse" data-bs-target="#faq-kd7">
                Are these activities suitable for classroom use?
              </button>
            </h3>
            <div id="faq-kd7" class="accordion-collapse collapse">
              <div class="accordion-body pt-0" style="color:#555;">
                Yes — MindSnap's kids activities are used by teachers as warm-up activities, end-of-lesson rewards, and homework supplements. They require no accounts or logins, work on school computers and tablets, and do not require any teacher setup. Because there is no tracking or data collection, they comply with typical school technology policies. Teachers can open any activity on a class display for group play or assign a URL for individual work.
              </div>
            </div>
          </div>
          <div class="accordion-item border-0 mb-2">
            <h3 class="accordion-header">
              <button class="accordion-button collapsed fw-600" type="button" data-bs-toggle="collapse" data-bs-target="#faq-kd8">
                Do the kids activities work on a tablet or phone?
              </button>
            </h3>
            <div id="faq-kd8" class="accordion-collapse collapse">
              <div class="accordion-body pt-0" style="color:#555;">
                Yes — all MindSnap activities are fully responsive and work on smartphones, tablets, laptops, and desktop computers. No app download is required. They are tested on iOS Safari, Android Chrome, and major desktop browsers. Touch controls work correctly for all interactive elements. For the best experience on small screens, hold a phone in portrait orientation for quizzes and landscape for word games.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Related --}}
<section style="padding:40px 0 64px; background:#f8f9fa;">
  <div class="container-xl">
    <h2 class="mb-4" style="font-size:1.3rem;">For Adults — Explore More</h2>
    <div class="row g-3">
      @foreach([
        ['🧠','Brain Quizzes','/quizzes','IQ test & knowledge quizzes','#e94560'],
        ['🎮','Brain Games','/games','Typing speed, memory & reaction','#ffc107'],
        ['😴','Sleep Tools','/sleep-tools','Bedtime & sleep cycle calculators','#6c63ff'],
        ['💪','Fitness Tools','/fitness-tools','BMI, calories & macros','#28a745'],
      ] as [$icon,$label,$slug,$desc,$color])
      <div class="col-sm-6 col-lg-3">
        <a href="{{ $slug }}" class="tool-card d-flex align-items-center gap-3 p-3 text-decoration-none h-100">
          <span style="font-size:1.8rem; line-height:1; flex-shrink:0;">{{ $icon }}</span>
          <div>
            <div style="font-weight:700; color:var(--primary-dark); font-size:.9rem;">{{ $label }}</div>
            <div style="font-size:.78rem; color:var(--text-muted);">{{ $desc }}</div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
  </div>
</section>

@endsection
