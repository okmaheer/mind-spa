@extends('layouts.app')

@section('title', 'Free Online Brain Games — Typing Speed, Memory & Reaction Test | MindSnap')
@section('description', 'Free online brain games: typing speed test, reaction time test, memory test, word scramble, and colour blind test. Train your brain in minutes. No signup needed.')
@section('canonical', config('app.url') . '/games')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@graph": [
    {
      "@@type": "CollectionPage",
      "@@id": "{{ config('app.url') }}/games#collection",
      "url": "{{ config('app.url') }}/games",
      "name": "Free Online Brain Games",
      "description": "5 free browser-based brain games: typing speed test, reaction time test, memory test, word scramble, and colour blind test.",
      "inLanguage": "en",
      "publisher": { "@@type": "Organization", "name": "MindSnap", "url": "{{ config('app.url') }}" }
    },
    {
      "@@type": "BreadcrumbList",
      "itemListElement": [
        { "@@type": "ListItem", "position": 1, "name": "Home", "item": "{{ config('app.url') }}" },
        { "@@type": "ListItem", "position": 2, "name": "Games", "item": "{{ config('app.url') }}/games" }
      ]
    },
    {
      "@@type": "FAQPage",
      "mainEntity": [
        {
          "@@type": "Question",
          "name": "What is a good typing speed?",
          "acceptedAnswer": { "@@type": "Answer", "text": "The average typing speed for adults is 40 WPM (words per minute). A good speed is 60–80 WPM. Professional typists typically reach 100 WPM or more. Regular practice with our Typing Speed Test can help you improve by 10–20 WPM within weeks." }
        },
        {
          "@@type": "Question",
          "name": "What is a normal reaction time?",
          "acceptedAnswer": { "@@type": "Answer", "text": "The average human reaction time is 200–250 milliseconds (0.2–0.25 seconds) to a visual stimulus. Under 200ms is excellent. Reaction time slows with age, fatigue, and alcohol. Use our Reaction Time Test to measure and track yours." }
        },
        {
          "@@type": "Question",
          "name": "Do brain games actually improve cognitive function?",
          "acceptedAnswer": { "@@type": "Answer", "text": "Research shows that practicing specific cognitive tasks improves performance in those tasks (typing speed, reaction time, memory recall). Regular brain game practice can also help maintain cognitive function as we age, though effects on general intelligence are more limited." }
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
      <li class="breadcrumb-item active" aria-current="page" style="color:var(--text-muted);">Games</li>
    </ol>
  </div>
</nav>

{{-- Hero --}}
<section style="background:linear-gradient(135deg,#1a1a2e 0%,#16213e 50%,#0f3460 100%); padding:64px 0 48px;">
  <div class="container-xl">
    <div class="row align-items-center g-4">
      <div class="col-lg-8">
        <div class="d-flex align-items-center gap-3 mb-3">
          <span style="font-size:2.8rem; line-height:1;">🎮</span>
          <span class="badge" style="background:rgba(255,193,7,.2); color:#ffd84d; border:1px solid rgba(255,193,7,.4); border-radius:50px; font-size:.8rem; padding:5px 14px;">Brain Games</span>
        </div>
        <h1 style="color:#fff; margin-bottom:16px;">Free Online Brain Games</h1>
        <p style="color:rgba(255,255,255,.75); font-size:1.1rem; line-height:1.7; max-width:620px; margin-bottom:24px;">
          Test and train your typing speed, reaction time, memory, vocabulary, and colour vision.
          5 browser-based games — play instantly, no download, no signup.
        </p>
        <div class="d-flex flex-wrap gap-3">
          <div class="d-flex align-items-center gap-2" style="color:rgba(255,255,255,.65); font-size:.88rem;">
            <svg width="16" height="16" fill="none" stroke="#ffc107" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            No download required
          </div>
          <div class="d-flex align-items-center gap-2" style="color:rgba(255,255,255,.65); font-size:.88rem;">
            <svg width="16" height="16" fill="none" stroke="#ffc107" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            Works on any device
          </div>
          <div class="d-flex align-items-center gap-2" style="color:rgba(255,255,255,.65); font-size:.88rem;">
            <svg width="16" height="16" fill="none" stroke="#ffc107" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            100% free, no signup
          </div>
        </div>
      </div>
      <div class="col-lg-4 d-none d-lg-flex justify-content-end">
        <div style="background:rgba(255,193,7,.1); border:1px solid rgba(255,193,7,.25); border-radius:16px; padding:28px 32px; text-align:center;">
          <div style="font-size:3rem; margin-bottom:8px;">5</div>
          <div style="color:rgba(255,255,255,.7); font-size:.9rem;">Brain Games</div>
          <div style="height:1px; background:rgba(255,255,255,.1); margin:14px 0;"></div>
          <div style="font-size:1.6rem; margin-bottom:4px;">~2 min</div>
          <div style="color:rgba(255,255,255,.7); font-size:.9rem;">Average play time</div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Games Grid --}}
<section style="padding:56px 0;">
  <div class="container-xl">
    <div class="d-flex align-items-center justify-content-between mb-4">
      <h2 style="font-size:1.5rem; margin:0;">All Brain Games</h2>
      <span style="color:var(--text-muted); font-size:.88rem;">{{ count($tools) ?: 5 }} games</span>
    </div>

    @if(count($tools))
    <div class="row g-4">
      @foreach($tools as $tool)
      <div class="col-sm-6 col-lg-4">
        <a href="/{{ $tool['slug'] }}" class="tool-card d-block p-4 h-100 text-decoration-none"
           style="border-left:4px solid #ffc107;">
          <div class="d-flex align-items-start gap-3">
            <span style="font-size:2rem; line-height:1; flex-shrink:0;">{{ $tool['icon'] ?? '🎮' }}</span>
            <div style="min-width:0;">
              <div style="font-weight:700; color:var(--primary-dark); font-size:.95rem; margin-bottom:4px;">{{ $tool['name'] }}</div>
              <div style="font-size:.83rem; color:var(--text-muted); line-height:1.5;">{{ $tool['description'] }}</div>
              @if(!empty($tool['monthly_searches']) && $tool['monthly_searches'] > 0)
              <div class="mt-2"><span class="badge-searches">{{ number_format($tool['monthly_searches'] / 1000) }}K searches/mo</span></div>
              @endif
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
    @else
    <div class="row g-4">
      @foreach([
        ['⌨️','Typing Speed Test','/typing-speed-test','Measure your WPM and accuracy. See how you rank against global averages.','90K'],
        ['⚡','Reaction Time Test','/reaction-time-test','How fast are your reflexes? Measure reaction time in milliseconds.','74K'],
        ['🃏','Memory Test','/memory-test','Test your visual memory by matching and recalling sequences of cards.','50K'],
        ['🔀','Word Scramble','/word-scramble','Unscramble words against the clock. Great for vocabulary and spelling.','33K'],
        ['🎨','Colour Blind Test','/color-blind-test','Check your colour vision with Ishihara-style plates. Identifies red-green deficiencies.','27K'],
      ] as [$icon,$name,$slug,$desc,$searches])
      <div class="col-sm-6 col-lg-4">
        <a href="{{ $slug }}" class="tool-card d-block p-4 h-100 text-decoration-none"
           style="border-left:4px solid #ffc107;">
          <div class="d-flex align-items-start gap-3">
            <span style="font-size:2rem; line-height:1; flex-shrink:0;">{{ $icon }}</span>
            <div>
              <div style="font-weight:700; color:var(--primary-dark); font-size:.95rem; margin-bottom:4px;">{{ $name }}</div>
              <div style="font-size:.83rem; color:var(--text-muted); line-height:1.5;">{{ $desc }}</div>
              <div class="mt-2"><span class="badge-searches">{{ $searches }} searches/mo</span></div>
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
    @endif
  </div>
</section>

{{-- Stats --}}
<section style="padding:48px 0; background:#fff;">
  <div class="container-xl">
    <h2 class="text-center mb-4">How Do You Compare?</h2>
    <div class="row g-3 justify-content-center">
      @foreach([
        ['⌨️','40 WPM','Average adult typing speed'],
        ['⚡','250ms','Average human reaction time'],
        ['🃏','7±2','Items in short-term memory (Miller\'s Law)'],
        ['👁️','8%','Men affected by colour blindness'],
      ] as [$icon,$stat,$label])
      <div class="col-6 col-md-3">
        <div class="tool-card p-4 text-center h-100">
          <div style="font-size:1.8rem; margin-bottom:8px;">{{ $icon }}</div>
          <div style="font-weight:800; font-size:1.2rem; color:var(--primary-dark);">{{ $stat }}</div>
          <div style="font-size:.8rem; color:var(--text-muted); margin-top:4px;">{{ $label }}</div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- FAQ --}}
<section style="padding:56px 0;">
  <div class="container-xl">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <h2 class="text-center mb-5">Frequently Asked Questions</h2>
        <div class="accordion" id="gamesFaq">
          @foreach([
            ['What is a good typing speed in WPM?',
             'The average adult types at <strong>40 WPM</strong>. A good speed is <strong>60–80 WPM</strong>. Professional typists and programmers typically reach 80–120 WPM. Take our <a href="/typing-speed-test">Typing Speed Test</a> to measure yours and get a personalised improvement tip.'],
            ['What is a normal reaction time?',
             'Average reaction time to a visual stimulus is <strong>200–250 milliseconds</strong>. Under 200ms is excellent (top ~10%). Reaction time worsens with age, fatigue, alcohol, and distractions. Measure yours at our <a href="/reaction-time-test">Reaction Time Test</a>.'],
            ['How does the colour blind test work?',
             'Our <a href="/color-blind-test">Colour Blind Test</a> uses Ishihara-style plates — circular patterns of coloured dots hiding numbers or shapes. People with red-green colour deficiency cannot see the hidden number. The test can detect the most common types of colour vision deficiency.'],
            ['Can brain games improve memory?',
             'Studies show that regularly practicing memory tasks improves performance in those specific tasks. Working memory training can also have modest transfer effects on attention and executive function. The best approach is variety — combine memory games with physical exercise and adequate sleep.'],
          ] as $i => [$q,$a])
          <div class="accordion-item" style="border:1px solid var(--border); border-radius:10px !important; margin-bottom:10px; overflow:hidden;">
            <h3 class="accordion-header">
              <button class="accordion-button {{ $i > 0 ? 'collapsed' : '' }}" type="button"
                      data-bs-toggle="collapse" data-bs-target="#gFaq{{ $i }}"
                      style="font-weight:600; font-size:.95rem; background:transparent; color:var(--primary-dark);">
                {{ $q }}
              </button>
            </h3>
            <div id="gFaq{{ $i }}" class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}" data-bs-parent="#gamesFaq">
              <div class="accordion-body" style="font-size:.92rem; line-height:1.8; color:var(--text);">{!! $a !!}</div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Related --}}
<section style="padding:40px 0 64px; background:#f8f9fa;">
  <div class="container-xl">
    <h2 class="mb-4" style="font-size:1.3rem;">Explore More Tools</h2>
    <div class="row g-3">
      @foreach([
        ['🧠','Brain Quizzes','/quizzes','IQ test & knowledge quizzes','#e94560'],
        ['👶','Kids Zone','/kids','Safe games & quizzes for children','#17a2b8'],
        ['😴','Sleep Tools','/sleep-tools','Bedtime & sleep cycle calculators','#6c63ff'],
        ['💪','Fitness Tools','/fitness-tools','BMI, calories & macro calculators','#28a745'],
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
