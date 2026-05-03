@extends('layouts.app')

@section('title', 'Free Nutrition Calculators — Water Intake & Intermittent Fasting | MindSnap')
@section('description', 'Free nutrition calculators: daily water intake based on your weight and activity, plus intermittent fasting windows for 16:8, 18:6, and 5:2 protocols. Instant, no signup.')
@section('canonical', config('app.url') . '/nutrition-tools')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@graph": [
    {
      "@@type": "CollectionPage",
      "@@id": "{{ config('app.url') }}/nutrition-tools#collection",
      "url": "{{ config('app.url') }}/nutrition-tools",
      "name": "Free Nutrition Calculators",
      "description": "Free nutrition calculators including daily water intake calculator and intermittent fasting schedule calculator for 16:8, 18:6, and 5:2 protocols.",
      "inLanguage": "en",
      "publisher": { "@@type": "Organization", "name": "MindSnap", "url": "{{ config('app.url') }}" }
    },
    {
      "@@type": "BreadcrumbList",
      "itemListElement": [
        { "@@type": "ListItem", "position": 1, "name": "Home", "item": "{{ config('app.url') }}" },
        { "@@type": "ListItem", "position": 2, "name": "Nutrition Tools", "item": "{{ config('app.url') }}/nutrition-tools" }
      ]
    },
    {
      "@@type": "FAQPage",
      "mainEntity": [
        {
          "@@type": "Question",
          "name": "How much water should I drink per day?",
          "acceptedAnswer": { "@@type": "Answer", "text": "The general baseline is 0.033 litres per kg of bodyweight per day (about 8 cups for a 70kg adult). Active people, those in hot climates, or pregnant women need more. Use our Water Intake Calculator for a personalised daily target based on your weight, activity, and climate." }
        },
        {
          "@@type": "Question",
          "name": "What is intermittent fasting and how does it work?",
          "acceptedAnswer": { "@@type": "Answer", "text": "Intermittent fasting (IF) is a pattern of cycling between eating and fasting windows. The most popular protocol is 16:8 — fast for 16 hours, eat within an 8-hour window. During the fasting window your body depletes glycogen and switches to burning fat for fuel." }
        },
        {
          "@@type": "Question",
          "name": "Is the 16:8 fasting method effective for weight loss?",
          "acceptedAnswer": { "@@type": "Answer", "text": "Yes. 16:8 intermittent fasting reduces your eating window, which naturally lowers calorie intake for most people. Research also shows benefits for insulin sensitivity, metabolic health, and cellular repair (autophagy). Combine it with a calorie deficit for best fat-loss results." }
        },{
          "@@type": "Question",
          "name": "Is intermittent fasting safe for women?",
          "acceptedAnswer": { "@@type": "Answer", "text": "Intermittent fasting is generally safe for healthy adult women. However, some research suggests that women may be more sensitive to caloric restriction, particularly during reproductive years. Pregnant or breastfeeding women should not fast. Women with a history of eating disorders should consult a doctor first. The 14:10 protocol (14-hour fast) is a gentler starting point than 16:8 for women new to IF." }
        },
        {
          "@@type": "Question",
          "name": "Can you combine intermittent fasting with calorie counting?",
          "acceptedAnswer": { "@@type": "Answer", "text": "Yes — and the combination is often more effective than either alone. Intermittent fasting naturally reduces your eating window, which limits calorie opportunity. Adding a calorie target within that window ensures you maintain a deficit. Use our Intermittent Fasting Calculator to set your eating window, then track calories within it." }
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
      <li class="breadcrumb-item active" aria-current="page" style="color:var(--text-muted);">Nutrition Tools</li>
    </ol>
  </div>
</nav>

{{-- Hero --}}
<section style="background:linear-gradient(135deg,#1a1a2e 0%,#16213e 50%,#0f3460 100%); padding:64px 0 48px;">
  <div class="container-xl">
    <div class="row align-items-center g-4">
      <div class="col-lg-8">
        <div class="d-flex align-items-center gap-3 mb-3">
          <span style="font-size:2.8rem; line-height:1;">🥗</span>
          <span class="badge" style="background:rgba(253,126,20,.2); color:#ffb066; border:1px solid rgba(253,126,20,.4); border-radius:50px; font-size:.8rem; padding:5px 14px;">Nutrition Tools</span>
        </div>
        <h1 style="color:#fff; margin-bottom:16px;">Free Nutrition Calculators</h1>
        <p style="color:rgba(255,255,255,.75); font-size:1.1rem; line-height:1.7; max-width:620px; margin-bottom:24px;">
          Know exactly how much to drink and when to eat. Personalised water intake targets and intermittent fasting schedules — free, instant, no signup.
        </p>
        <div class="d-flex flex-wrap gap-3">
          <div class="d-flex align-items-center gap-2" style="color:rgba(255,255,255,.65); font-size:.88rem;">
            <svg width="16" height="16" fill="none" stroke="#fd7e14" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            Personalised to your weight & activity
          </div>
          <div class="d-flex align-items-center gap-2" style="color:rgba(255,255,255,.65); font-size:.88rem;">
            <svg width="16" height="16" fill="none" stroke="#fd7e14" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            All fasting protocols covered
          </div>
          <div class="d-flex align-items-center gap-2" style="color:rgba(255,255,255,.65); font-size:.88rem;">
            <svg width="16" height="16" fill="none" stroke="#fd7e14" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            100% free, no signup
          </div>
        </div>
      </div>
      <div class="col-lg-4 d-none d-lg-flex justify-content-end">
        <div style="background:rgba(253,126,20,.12); border:1px solid rgba(253,126,20,.25); border-radius:16px; padding:28px 32px; text-align:center;">
          <div style="font-size:3rem; margin-bottom:8px;">2</div>
          <div style="color:rgba(255,255,255,.7); font-size:.9rem;">Nutrition Tools</div>
          <div style="height:1px; background:rgba(255,255,255,.1); margin:14px 0;"></div>
          <div style="font-size:1.6rem; margin-bottom:4px;">570K+</div>
          <div style="color:rgba(255,255,255,.7); font-size:.9rem;">Monthly searches</div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Tools --}}
<section style="padding:56px 0;">
  <div class="container-xl">
    <div class="d-flex align-items-center justify-content-between mb-4">
      <h2 style="font-size:1.5rem; margin:0;">Nutrition Calculators</h2>
      <span style="color:var(--text-muted); font-size:.88rem;">{{ count($tools) ?: 2 }} tools</span>
    </div>

    @if(count($tools))
    <div class="row g-4">
      @foreach($tools as $tool)
      <div class="col-sm-6 col-lg-5">
        <a href="/{{ $tool['slug'] }}" class="tool-card d-block p-5 h-100 text-decoration-none"
           style="border-left:4px solid #fd7e14;">
          <div class="d-flex align-items-start gap-3">
            <span style="font-size:2.5rem; line-height:1; flex-shrink:0;">{{ $tool['icon'] ?? '🥗' }}</span>
            <div>
              <div style="font-weight:700; color:var(--primary-dark); font-size:1.05rem; margin-bottom:6px;">{{ $tool['name'] }}</div>
              <div style="font-size:.88rem; color:var(--text-muted); line-height:1.6;">{{ $tool['description'] }}</div>
              @if(!empty($tool['monthly_searches']) && $tool['monthly_searches'] > 0)
              <div class="mt-3"><span class="badge-searches">{{ number_format($tool['monthly_searches'] / 1000) }}K searches/mo</span></div>
              @endif
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
    @else
    <div class="row g-4 justify-content-center">
      @foreach([
        ['💧','Water Intake Calculator','/water-intake-calculator','Calculate your daily hydration target based on weight, climate, and activity level. Metric and imperial.','368K'],
        ['🕐','Intermittent Fasting Calculator','/intermittent-fasting-calculator','Plan your eating and fasting windows for 16:8, 18:6, 5:2, and other IF protocols. Get your exact schedule.','201K'],
      ] as [$icon,$name,$slug,$desc,$searches])
      <div class="col-sm-10 col-lg-5">
        <a href="{{ $slug }}" class="tool-card d-block p-5 h-100 text-decoration-none"
           style="border-left:4px solid #fd7e14;">
          <div class="d-flex align-items-start gap-3">
            <span style="font-size:2.5rem; line-height:1; flex-shrink:0;">{{ $icon }}</span>
            <div>
              <div style="font-weight:700; color:var(--primary-dark); font-size:1.05rem; margin-bottom:6px;">{{ $name }}</div>
              <div style="font-size:.88rem; color:var(--text-muted); line-height:1.6;">{{ $desc }}</div>
              <div class="mt-3"><span class="badge-searches">{{ $searches }} searches/mo</span></div>
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
    @endif
  </div>
</section>

{{-- Quick Facts --}}
<section style="padding:48px 0; background:#fff;">
  <div class="container-xl">
    <h2 class="mb-4 text-center">Nutrition at a Glance</h2>
    <div class="row g-3 justify-content-center">
      @foreach([
        ['💧','2.5–3.5L','Recommended daily water for adults'],
        ['🕐','16:8','Most popular IF protocol'],
        ['🔬','12–16 hrs','When autophagy begins during fasting'],
        ['🌡️','+500ml','Extra water needed per hour of exercise'],
      ] as [$icon,$stat,$label])
      <div class="col-6 col-md-3">
        <div class="tool-card p-4 text-center h-100">
          <div style="font-size:1.8rem; margin-bottom:8px;">{{ $icon }}</div>
          <div style="font-weight:800; font-size:1.1rem; color:var(--primary-dark);">{{ $stat }}</div>
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
        <div class="accordion" id="nutritionFaq">
          @foreach([
            ['How much water should I drink per day?',
             'The general baseline is <strong>0.033 litres per kg of bodyweight</strong> (about 8 cups for a 70kg adult). Add 500ml for every hour of exercise. Hot climates or pregnancy increase needs further. Our <a href="/water-intake-calculator">Water Intake Calculator</a> gives your exact daily target.'],
            ['What is intermittent fasting and which protocol is best?',
             '<strong>16:8</strong> (fast 16h, eat within 8h window) is the most sustainable for beginners. 18:6 offers faster results. 5:2 means eating normally 5 days and limiting to ~500 kcal on 2 non-consecutive days. Use our <a href="/intermittent-fasting-calculator">IF Calculator</a> to set your eating window times.'],
            ['Can I drink coffee or tea during intermittent fasting?',
             'Yes — black coffee and plain tea (no milk or sugar) have near-zero calories and do not break a fast. They may actually enhance fasting benefits by slightly raising metabolism. Avoid adding cream, milk, or sweeteners during your fasting window.'],
            ['Does drinking more water help with weight loss?',
             'Yes. Drinking 500ml of water 30 minutes before meals reduces calorie intake by 13% on average (2015 clinical trial). Water also boosts metabolism by ~30% for 30–40 minutes. Replace sugary drinks with water to cut hundreds of daily calories effortlessly.'],
            ['Is intermittent fasting safe for women?',
             'IF is generally safe for healthy adult women. Some women are more sensitive to caloric restriction — particularly during reproductive years. The gentler <strong>14:10 protocol</strong> is often recommended as a starting point. Pregnant or breastfeeding women should not fast. Consult a doctor if you have a history of eating disorders or hormonal conditions.'],
            ['Can I combine water intake tracking with intermittent fasting?',
             'Yes — staying well hydrated is particularly important during fasting windows. Water, black coffee, and plain tea do not break a fast. Use our <a href="/water-intake-calculator">Water Intake Calculator</a> to set your daily hydration target and aim to reach it primarily during your eating window, with 500ml first thing in the morning.'],
          ] as $i => [$q,$a])
          <div class="accordion-item" style="border:1px solid var(--border); border-radius:10px !important; margin-bottom:10px; overflow:hidden;">
            <h3 class="accordion-header">
              <button class="accordion-button {{ $i > 0 ? 'collapsed' : '' }}" type="button"
                      data-bs-toggle="collapse" data-bs-target="#nutFaq{{ $i }}"
                      style="font-weight:600; font-size:.95rem; background:transparent; color:var(--primary-dark);">
                {{ $q }}
              </button>
            </h3>
            <div id="nutFaq{{ $i }}" class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}" data-bs-parent="#nutritionFaq">
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
        ['💪','Fitness Tools','/fitness-tools','BMI, calories & macro calculators','#28a745'],
        ['😴','Sleep Tools','/sleep-tools','Bedtime & sleep cycle calculators','#6c63ff'],
        ['🧠','Brain Quizzes','/quizzes','IQ test & knowledge quizzes','#e94560'],
        ['⏰','Life Tools','/life-tools','Age, dates & life calculators','#6f42c1'],
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
