@extends('layouts.app')

@section('title', 'Free Health Calculators & Brain Quizzes for Everyone | MindSnap')
@section('description', 'MindSnap gives you free health tools, sleep calculators and brain quizzes — no signup, no fees, works on any device. Used by millions worldwide.')
@section('canonical', config('app.url'))

@section('schema')
<script type="application/ld+json">{"@@context":"https://schema.org","@@type":"WebSite","name":"MindSnap","url":"{{ config('app.url') }}","description":"Free health calculators, sleep tools and brain quizzes for everyone.","potentialAction":{"@@type":"SearchAction","target":"{{ config('app.url') }}/search?q={search_term_string}","query-input":"required name=search_term_string"}}</script>
<script type="application/ld+json">{"@@context":"https://schema.org","@@type":"Organization","name":"MindSnap","url":"{{ config('app.url') }}","logo":"{{ asset('images/logo.png') }}"}</script>
@endsection

@section('content')

{{-- ═══════════════════════════════════════════════════════════════════════════
     SECTION 1 — HERO
════════════════════════════════════════════════════════════════════════════ --}}
<section id="hero"
         style="background: linear-gradient(135deg, #1a1a2e 0%, #0f3460 60%, #16213e 100%);
                min-height: 85vh;
                display: flex;
                align-items: center;
                padding: 80px 0;
                position: relative;
                overflow: hidden;">

  {{-- Subtle background decoration --}}
  <div aria-hidden="true" style="position:absolute;inset:0;pointer-events:none;">
    <div style="position:absolute;top:-80px;right:-80px;width:400px;height:400px;
                background:radial-gradient(circle,rgba(233,69,96,.12) 0%,transparent 70%);
                border-radius:50%;"></div>
    <div style="position:absolute;bottom:-60px;left:-60px;width:300px;height:300px;
                background:radial-gradient(circle,rgba(108,99,255,.1) 0%,transparent 70%);
                border-radius:50%;"></div>
  </div>

  <div class="container position-relative">
    <div class="row align-items-center">
      <div class="col-lg-7">

        <div class="d-flex align-items-center gap-2 mb-4">
          <span class="badge"
                style="background:rgba(233,69,96,.2);color:#e94560;border:1px solid rgba(233,69,96,.3);
                       border-radius:50px;padding:6px 14px;font-size:.8rem;font-weight:600;">
            🔥 New: Daily Brain Challenge
          </span>
        </div>

        <h1 style="color:#ffffff;font-size:clamp(2rem,5vw,3.2rem);font-weight:800;line-height:1.2;margin-bottom:1.25rem;">
          Free Tools for a<br>
          <span style="color:#e94560;">Sharper Mind</span> &amp; Healthier Life
        </h1>

        <p style="color:rgba(255,255,255,.75);font-size:1.15rem;max-width:520px;line-height:1.75;margin-bottom:2rem;">
          Sleep calculators, fitness tools, brain quizzes — all completely free,
          no signup needed, and built to actually work on your phone.
        </p>

        <div class="d-flex flex-wrap gap-3 mb-5">
          <a href="{{ route('category.sleep') }}" class="btn btn-cta" style="min-width:160px;font-size:1rem;">
            Explore Tools
          </a>
          <a href="{{ route('quiz.daily') }}"
             class="btn"
             style="background:transparent;border:2px solid rgba(255,255,255,.4);color:#fff;
                    border-radius:8px;padding:12px 28px;font-weight:600;min-height:48px;
                    transition:border-color .2s,background .2s;"
             onmouseover="this.style.borderColor='#fff';this.style.background='rgba(255,255,255,.08)'"
             onmouseout="this.style.borderColor='rgba(255,255,255,.4)';this.style.background='transparent'">
            Take Daily Quiz →
          </a>
        </div>

        {{-- Tool highlights --}}
        <div class="row g-3">
          @foreach([
            ['40+',  'Free Tools',       '#6c63ff'],
            ['30+',  'Calculators',      '#28a745'],
            ['10+',  'Brain Quizzes',    '#e94560'],
            ['0',    'Signup Needed',    '#17a2b8'],
          ] as [$num, $label, $color])
          <div class="col-6 col-sm-3">
            <div style="padding:16px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);border-radius:12px;text-align:center;">
              <div style="color:{{ $color }};font-size:1.6rem;font-weight:800;line-height:1;">{{ $num }}</div>
              <div style="color:rgba(255,255,255,.55);font-size:.78rem;margin-top:4px;">{{ $label }}</div>
            </div>
          </div>
          @endforeach
        </div>

      </div>

      {{-- Right side decoration (desktop only) --}}
      <div class="col-lg-5 d-none d-lg-flex justify-content-end" aria-hidden="true">
        <div style="position:relative;width:340px;height:340px;">
          {{-- Floating tool cards decoration --}}
          <div style="position:absolute;top:0;left:20px;background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.12);
                      border-radius:14px;padding:16px 20px;backdrop-filter:blur(10px);width:200px;">
            <div style="font-size:1.5rem;">😴</div>
            <div style="color:#fff;font-weight:600;font-size:.9rem;margin-top:6px;">Sleep Calculator</div>
            <div style="color:#6c63ff;font-size:.78rem;margin-top:2px;">Find your perfect bedtime</div>
          </div>
          <div style="position:absolute;top:90px;right:0;background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.12);
                      border-radius:14px;padding:16px 20px;backdrop-filter:blur(10px);width:200px;">
            <div style="font-size:1.5rem;">💪</div>
            <div style="color:#fff;font-weight:600;font-size:.9rem;margin-top:6px;">BMI Calculator</div>
            <div style="color:#28a745;font-size:.78rem;margin-top:2px;">Free, instant, no signup</div>
          </div>
          <div style="position:absolute;bottom:40px;left:10px;background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.12);
                      border-radius:14px;padding:16px 20px;backdrop-filter:blur(10px);width:200px;">
            <div style="font-size:1.5rem;">🧠</div>
            <div style="color:#fff;font-weight:600;font-size:.9rem;margin-top:6px;">Daily Brain Quiz</div>
            <div style="color:#e94560;font-size:.78rem;margin-top:2px;">New challenge every day</div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════════════════
     SECTION 2 — CATEGORY GRID
════════════════════════════════════════════════════════════════════════════ --}}
<section id="categories" style="padding:80px 0;background:#fff;">
  <div class="container">

    <div class="text-center mb-5">
      <h2 style="font-size:clamp(1.6rem,3vw,2.2rem);">What Would You Like to Do Today?</h2>
      <p style="color:var(--text-muted);max-width:480px;margin:0.75rem auto 0;">
        Pick a category and get instant results — no account, no waiting, no cost.
      </p>
    </div>

    @php
    $categories = [
      ['emoji'=>'😴','name'=>'Sleep Tools',    'slug'=>'sleep-tools',    'color'=>'#6c63ff','tools'=>'7 tools',  'desc'=>'Find your perfect bedtime, fix your sleep debt, beat jet lag'],
      ['emoji'=>'💪','name'=>'Fitness',         'slug'=>'fitness-tools',  'color'=>'#28a745','tools'=>'11 tools', 'desc'=>'BMI, TDEE, body fat, heart rate zones and more'],
      ['emoji'=>'🥗','name'=>'Nutrition',       'slug'=>'nutrition-tools','color'=>'#fd7e14','tools'=>'2 tools',  'desc'=>'Water intake and intermittent fasting timer'],
      ['emoji'=>'🧠','name'=>'Brain Quizzes',   'slug'=>'quizzes',        'color'=>'#e94560','tools'=>'10 quizzes','desc'=>'General knowledge, history, science, IQ test and more'],
      ['emoji'=>'👶','name'=>'Kids Zone',       'slug'=>'kids',           'color'=>'#17a2b8','tools'=>'5 games',  'desc'=>'Safe, ad-free learning games for ages 5–12'],
      ['emoji'=>'⏰','name'=>'Life Tools',      'slug'=>'life-tools',     'color'=>'#6f42c1','tools'=>'7 tools',  'desc'=>'Age, pregnancy, days between dates, retirement'],
      ['emoji'=>'🎮','name'=>'Games',           'slug'=>'games',          'color'=>'#e6ac00','tools'=>'5 games',  'desc'=>'Typing speed, reaction time, memory test and more'],
      ['emoji'=>'📅','name'=>'Daily Challenge', 'slug'=>'daily',          'color'=>'#e94560','tools'=>'New daily', 'desc'=>'Fresh quiz topic every single day — come back tomorrow'],
    ];
    @endphp

    <div class="row g-4">
      @foreach($categories as $cat)
      <div class="col-6 col-md-4 col-lg-3">
        <a href="{{ url($cat['slug']) }}"
           class="d-flex flex-column align-items-center text-center p-4 rounded-3 text-decoration-none h-100"
           style="background: linear-gradient(145deg, {{ $cat['color'] }}18 0%, {{ $cat['color'] }}08 100%);
                  border: 1.5px solid {{ $cat['color'] }}30;
                  transition: transform .2s, box-shadow .2s, border-color .2s;"
           onmouseover="this.style.transform='translateY(-5px)';this.style.boxShadow='0 12px 35px {{ $cat['color'] }}25';this.style.borderColor='{{ $cat['color'] }}60';"
           onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none';this.style.borderColor='{{ $cat['color'] }}30';">

          <div style="width:64px;height:64px;border-radius:16px;
                      background:{{ $cat['color'] }}20;
                      display:flex;align-items:center;justify-content:center;
                      font-size:1.8rem;margin-bottom:12px;border:1px solid {{ $cat['color'] }}30;">
            {{ $cat['emoji'] }}
          </div>

          <h3 style="font-size:1rem;font-weight:700;color:var(--primary-dark);margin:0 0 4px;">{{ $cat['name'] }}</h3>

          <span style="font-size:.75rem;font-weight:600;color:{{ $cat['color'] }};
                       background:{{ $cat['color'] }}15;border-radius:50px;
                       padding:2px 10px;margin-bottom:8px;">
            {{ $cat['tools'] }}
          </span>

          <p style="font-size:.8rem;color:var(--text-muted);margin:0;line-height:1.5;">
            {{ $cat['desc'] }}
          </p>

          <span style="margin-top:12px;font-size:.82rem;font-weight:600;color:{{ $cat['color'] }};">
            Explore →
          </span>

        </a>
      </div>
      @endforeach
    </div>

  </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════════════════
     SECTION 3 — POPULAR TOOLS
════════════════════════════════════════════════════════════════════════════ --}}
<section id="popular" style="padding:80px 0;background:var(--bg);">
  <div class="container">

    <div class="d-flex flex-wrap align-items-end justify-content-between gap-3 mb-5">
      <div>
        <h2 style="margin-bottom:6px;">Most Popular Tools</h2>
        <p style="color:var(--text-muted);margin:0;">Our most-used tools, covering sleep, fitness, life and brain training.</p>
      </div>
      <a href="{{ route('category.sleep') }}" style="color:var(--primary-cta);font-weight:600;font-size:.9rem;white-space:nowrap;">
        View all tools →
      </a>
    </div>

    @php
    $popularTools = [
      ['icon'=>'😴','name'=>'Sleep Cycle Calculator','slug'=>'sleep-calculator',    'category'=>'sleep',  'desc'=>'Wake up refreshed by timing your sleep cycles right.'],
      ['icon'=>'⚖️','name'=>'BMI Calculator',         'slug'=>'bmi-calculator',      'category'=>'fitness','desc'=>'Find out where you stand and what it actually means.'],
      ['icon'=>'🔥','name'=>'Calorie Calculator',     'slug'=>'calorie-calculator',  'category'=>'fitness','desc'=>'Your TDEE — the number behind every diet plan.'],
      ['icon'=>'🧠','name'=>'General Knowledge Quiz', 'slug'=>'quiz/general-knowledge','category'=>'quiz', 'desc'=>'10 questions. How many can you get right?'],
      ['icon'=>'⌨️','name'=>'Typing Speed Test',     'slug'=>'typing-speed-test',   'category'=>'games',  'desc'=>'Find out your WPM and see how you compare.'],
      ['icon'=>'🎂','name'=>'Age Calculator',         'slug'=>'age-calculator',      'category'=>'life',   'desc'=>'Your exact age in years, months, weeks and days.'],
    ];
    @endphp

    <div class="row g-4">
      @foreach($popularTools as $tool)
      <div class="col-12 col-md-6 col-lg-4">
        <div class="card tool-card h-100"
             style="border:1px solid var(--border);border-top:4px solid var(--{{ $tool['category'] }});">
          <div class="card-body p-4 d-flex flex-column">
            <div class="mb-2">
              <span style="font-size:2rem;line-height:1;">{{ $tool['icon'] }}</span>
            </div>
            <h3 class="h6 fw-700 mt-2 mb-1" style="color:var(--primary-dark);">
              <a href="{{ url($tool['slug']) }}" style="color:inherit;text-decoration:none;"
                 onmouseover="this.style.color='var(--primary-cta)'"
                 onmouseout="this.style.color='inherit'">
                {{ $tool['name'] }}
              </a>
            </h3>
            <p style="font-size:.875rem;color:var(--text-muted);flex-grow:1;margin-bottom:1rem;">
              {{ $tool['desc'] }}
            </p>
            <a href="{{ url($tool['slug']) }}" class="btn btn-cta btn-sm w-100" style="min-height:44px;">
              Use Free Tool →
            </a>
          </div>
        </div>
      </div>
      @endforeach
    </div>

  </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════════════════
     SECTION 4 — DAILY QUIZ BANNER
════════════════════════════════════════════════════════════════════════════ --}}
<section id="daily-banner"
         style="padding:70px 0;background:linear-gradient(135deg,#e94560 0%,#c0392b 100%);position:relative;overflow:hidden;">

  <div aria-hidden="true"
       style="position:absolute;inset:0;pointer-events:none;
              background:url(\"data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E\");"></div>

  <div class="container position-relative">
    <div class="row align-items-center justify-content-between g-4">
      <div class="col-lg-7">
        <div class="d-flex align-items-center gap-2 mb-3">
          <span style="background:rgba(255,255,255,.2);color:#fff;border-radius:50px;padding:4px 12px;font-size:.78rem;font-weight:700;letter-spacing:.5px;">
            📅 TODAY'S CHALLENGE
          </span>
        </div>

        <h2 style="color:#fff;font-size:clamp(1.5rem,3vw,2.2rem);margin-bottom:.75rem;">
          @if($dailyQuiz)
            Today's Topic: <em style="font-style:normal;color:rgba(255,255,255,.9);">{{ $dailyQuiz->topic }}</em>
          @else
            Daily Brain Quiz — A New Challenge Every Day
          @endif
        </h2>

        <p style="color:rgba(255,255,255,.85);font-size:1rem;max-width:480px;line-height:1.7;margin-bottom:1.5rem;">
          10 questions, 3 difficulty levels. Fresh topic every single day — see how your score stacks up against yesterday's.
        </p>

        <div class="d-flex flex-wrap align-items-center gap-3">
          <a href="{{ route('quiz.daily') }}"
             class="btn"
             style="background:#fff;color:#e94560;font-weight:700;border-radius:8px;
                    padding:12px 28px;min-height:48px;border:none;font-size:1rem;
                    transition:transform .15s,box-shadow .15s;"
             onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 6px 20px rgba(0,0,0,.2)'"
             onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">
            Start Today's Quiz →
          </a>
          <div style="color:rgba(255,255,255,.75);font-size:.88rem;">
            Resets in <strong id="quizCountdown" style="color:#fff;">--:--:--</strong>
          </div>
        </div>
      </div>

      <div class="col-lg-4 d-none d-lg-block text-center" aria-hidden="true">
        <div style="background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.2);
                    border-radius:20px;padding:30px;display:inline-block;">
          <div style="font-size:4rem;line-height:1;margin-bottom:12px;">🧠</div>
          <div style="color:#fff;font-weight:700;font-size:1.1rem;">Daily Challenge</div>
          <div style="color:rgba(255,255,255,.7);font-size:.85rem;margin-top:4px;">
            {{ now()->format('D, M j') }}
          </div>
          @if($dailyQuiz)
          <div style="margin-top:16px;display:flex;gap:4px;justify-content:center;">
            @for($i = 0; $i < 3; $i++)
            <div style="width:10px;height:10px;border-radius:50%;
                        background:{{ $i < 2 ? '#fff' : 'rgba(255,255,255,.3)' }};"></div>
            @endfor
          </div>
          <div style="color:rgba(255,255,255,.6);font-size:.75rem;margin-top:6px;">Medium difficulty</div>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════════════════
     SECTION 5 — KIDS ZONE HIGHLIGHT
════════════════════════════════════════════════════════════════════════════ --}}
<section id="kids" style="padding:80px 0;background:#e8f7f7;">
  <div class="container">

    <div class="row align-items-center g-5">
      <div class="col-lg-5">
        <span style="background:#17a2b815;color:#17a2b8;border-radius:50px;padding:5px 14px;font-size:.8rem;font-weight:700;">
          👶 KIDS ZONE
        </span>
        <h2 style="margin-top:14px;margin-bottom:12px;color:var(--primary-dark);">
          Fun Learning for Kids
        </h2>
        <p style="color:var(--text-muted);line-height:1.75;margin-bottom:1.25rem;">
          Math puzzles, word games, science quizzes and animal challenges — all designed for ages 5 to 12.
          Built to be enjoyable, not overwhelming.
        </p>
        <div class="d-flex flex-wrap gap-2 mb-4">
          <span style="background:#fff;border:1px solid #17a2b830;color:#17a2b8;border-radius:50px;padding:5px 12px;font-size:.8rem;font-weight:600;">🚫 No Ads</span>
          <span style="background:#fff;border:1px solid #17a2b830;color:#17a2b8;border-radius:50px;padding:5px 12px;font-size:.8rem;font-weight:600;">🔒 No Data Collected</span>
          <span style="background:#fff;border:1px solid #17a2b830;color:#17a2b8;border-radius:50px;padding:5px 12px;font-size:.8rem;font-weight:600;">✓ No Account</span>
        </div>
        <a href="{{ route('category.kids') }}" class="btn btn-cta" style="background:#17a2b8;min-width:180px;">
          Explore Kids Zone →
        </a>
      </div>

      <div class="col-lg-7">
        <div class="row g-3">
          @foreach([
            ['emoji'=>'🔢','name'=>'Math Puzzles',   'slug'=>'kids/math-puzzles', 'desc'=>'Addition, subtraction, times tables and more'],
            ['emoji'=>'📝','name'=>'Word Games',      'slug'=>'kids/word-games',   'desc'=>'Spelling, vocabulary and word scrambles'],
            ['emoji'=>'🔬','name'=>'Science Quiz',    'slug'=>'kids/science-quiz', 'desc'=>'Planets, animals, the human body and nature'],
            ['emoji'=>'🦁','name'=>'Animal Quiz',     'slug'=>'kids/animal-quiz',  'desc'=>'Which animal is fastest? Where do they live?'],
          ] as $activity)
          <div class="col-6">
            <a href="{{ url($activity['slug']) }}"
               class="d-block p-3 rounded-3 text-decoration-none h-100"
               style="background:#fff;border:1.5px solid #17a2b825;transition:transform .2s,box-shadow .2s;"
               onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 24px rgba(23,162,184,.15)'"
               onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">
              <div style="font-size:2rem;margin-bottom:8px;">{{ $activity['emoji'] }}</div>
              <div style="font-weight:700;color:var(--primary-dark);font-size:.95rem;margin-bottom:4px;">
                {{ $activity['name'] }}
              </div>
              <div style="font-size:.8rem;color:var(--text-muted);">{{ $activity['desc'] }}</div>
            </a>
          </div>
          @endforeach
        </div>
      </div>
    </div>

  </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════════════════
     SECTION 6 — HOW IT WORKS
════════════════════════════════════════════════════════════════════════════ --}}
<section id="how-it-works" style="padding:80px 0;background:#fff;">
  <div class="container">

    <div class="text-center mb-5">
      <h2>Simple. Fast. Actually Free.</h2>
      <p style="color:var(--text-muted);max-width:440px;margin:.75rem auto 0;">
        No hidden steps, no email wall, no "free trial" that expires.
      </p>
    </div>

    <div class="row g-4 justify-content-center">
      @foreach([
        [
          'step'  => '01',
          'icon'  => '🎯',
          'title' => 'Pick a Tool',
          'desc'  => 'Choose from 40+ free health calculators, quizzes and games. Search by name or browse by category.',
          'color' => '#6c63ff',
        ],
        [
          'step'  => '02',
          'icon'  => '⚡',
          'title' => 'Get Instant Results',
          'desc'  => 'Fill in your details — results appear immediately, right there on the page. No page reload, no waiting.',
          'color' => '#e94560',
        ],
        [
          'step'  => '03',
          'icon'  => '📤',
          'title' => 'Share with Friends',
          'desc'  => 'Copy your result, share it on WhatsApp or download it as an image — challenge your friends to beat your score.',
          'color' => '#28a745',
        ],
      ] as $step)
      <div class="col-12 col-md-4">
        <div class="text-center p-4">
          <div style="width:72px;height:72px;border-radius:20px;
                      background:{{ $step['color'] }}15;border:2px solid {{ $step['color'] }}25;
                      display:flex;align-items:center;justify-content:center;
                      font-size:1.8rem;margin:0 auto 16px;">
            {{ $step['icon'] }}
          </div>
          <div style="color:{{ $step['color'] }};font-weight:800;font-size:.75rem;letter-spacing:1.5px;margin-bottom:8px;">
            STEP {{ $step['step'] }}
          </div>
          <h3 style="font-size:1.15rem;font-weight:700;color:var(--primary-dark);margin-bottom:10px;">
            {{ $step['title'] }}
          </h3>
          <p style="color:var(--text-muted);font-size:.9rem;line-height:1.7;max-width:260px;margin:0 auto;">
            {{ $step['desc'] }}
          </p>
        </div>
      </div>
      @endforeach
    </div>

    {{-- Trust bar --}}
    <div class="d-flex flex-wrap justify-content-center gap-3 mt-5 pt-4" style="border-top:1px solid var(--border);">
      @foreach([
        ['✓ Free forever',          '#28a745'],
        ['✓ No email required',     '#28a745'],
        ['✓ No ads on Kids pages',  '#17a2b8'],
        ['✓ Works on all devices',  '#6c63ff'],
        ['✓ 190+ countries',        '#e94560'],
      ] as [$label, $color])
      <span style="font-size:.875rem;font-weight:600;color:{{ $color }};">{{ $label }}</span>
      @endforeach
    </div>

  </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════════════════
     SECTION 7 — SEO CONTENT BLOCK
════════════════════════════════════════════════════════════════════════════ --}}
<section id="about-mindsnap" style="padding:80px 0;background:var(--bg);">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">

        <h2 class="text-center mb-4">Free Health Tools That Actually Work</h2>

        <p style="font-size:1rem;line-height:1.85;color:var(--text);margin-bottom:1.25rem;">
          Most health tools online make you sign up, show you ads every three seconds, or give you results that feel
          copied from a textbook. MindSnap does none of that. We built a set of free health tools for everyday people —
          whether you're trying to figure out the right bedtime, cut calories without losing your mind, or just want to
          know how good your general knowledge really is.
        </p>

        <h3 style="font-size:1.1rem;font-weight:700;color:var(--primary-dark);margin:1.75rem 0 .75rem;">
          Why we keep it free
        </h3>
        <p style="font-size:1rem;line-height:1.85;color:var(--text);margin-bottom:1.25rem;">
          Health information shouldn't sit behind a paywall. A sleep calculator doesn't need your credit card.
          A BMI tool doesn't need your email address. We keep MindSnap free because the tools are straightforward,
          the formulas are public, and the only thing stopping most people from using them was a bad interface.
          We fixed that.
        </p>

        <h3 style="font-size:1.1rem;font-weight:700;color:var(--primary-dark);margin:1.75rem 0 .75rem;">
          Built for real use, on real phones
        </h3>
        <p style="font-size:1rem;line-height:1.85;color:var(--text);">
          Every calculator is tested at 375px wide — the smallest common phone screen — before it goes live.
          All inputs are large enough to tap without squinting. Results appear instantly without any page reload.
          The kids zone has zero ads and collects no data, ever. That's not a policy update, that's how it's built.
        </p>

        <div class="d-flex flex-wrap gap-3 mt-4">
          <a href="{{ route('category.sleep') }}" class="btn btn-cta">Explore Sleep Tools</a>
          <a href="{{ route('category.fitness') }}"
             class="btn"
             style="background:transparent;border:2px solid var(--primary-cta);color:var(--primary-cta);
                    border-radius:8px;padding:12px 28px;font-weight:600;min-height:48px;">
            Fitness Calculators
          </a>
        </div>

      </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')
<script defer>
// ── Countdown to midnight (daily quiz reset) ──────────────────────────────────
(function () {
  const el = document.getElementById('quizCountdown');
  if (!el) return;

  function tick() {
    const now  = new Date();
    const midnight = new Date(now);
    midnight.setHours(24, 0, 0, 0);
    const diff = Math.max(0, midnight - now);

    const h = String(Math.floor(diff / 3600000)).padStart(2, '0');
    const m = String(Math.floor((diff % 3600000) / 60000)).padStart(2, '0');
    const s = String(Math.floor((diff % 60000) / 1000)).padStart(2, '0');

    el.textContent = h + ':' + m + ':' + s;
  }

  tick();
  setInterval(tick, 1000);
})();

</script>
@endsection
