@extends('layouts.app')

@section('title', 'Free Fitness Calculators — BMI, Calories, Macros & More | MindSnap')
@section('description', 'Free fitness calculators: BMI, TDEE, calorie deficit, macro calculator, protein intake, body fat %, one rep max, heart rate zones, running pace & ideal weight. Instant results.')
@section('canonical', config('app.url') . '/fitness-tools')

@section('schema')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@graph": [
    {
      "@@type": "CollectionPage",
      "@@id": "{{ config('app.url') }}/fitness-tools#collection",
      "url": "{{ config('app.url') }}/fitness-tools",
      "name": "Free Fitness Calculators",
      "description": "11 free fitness calculators including BMI, TDEE, calorie deficit, macro, protein, body fat, heart rate zones, running pace, ideal weight, and workout volume.",
      "inLanguage": "en",
      "publisher": { "@@type": "Organization", "name": "MindSnap", "url": "{{ config('app.url') }}" }
    },
    {
      "@@type": "BreadcrumbList",
      "itemListElement": [
        { "@@type": "ListItem", "position": 1, "name": "Home", "item": "{{ config('app.url') }}" },
        { "@@type": "ListItem", "position": 2, "name": "Fitness Tools", "item": "{{ config('app.url') }}/fitness-tools" }
      ]
    },
    {
      "@@type": "FAQPage",
      "mainEntity": [
        {
          "@@type": "Question",
          "name": "What is a healthy BMI?",
          "acceptedAnswer": { "@@type": "Answer", "text": "According to the WHO, a healthy BMI is between 18.5 and 24.9. Underweight is below 18.5, overweight is 25–29.9, and obese is 30 or above. BMI is a screening tool, not a diagnosis — use it alongside body fat percentage for a fuller picture." }
        },
        {
          "@@type": "Question",
          "name": "How many calories should I eat to lose weight?",
          "acceptedAnswer": { "@@type": "Answer", "text": "A safe calorie deficit is 500–750 calories per day, which leads to approximately 0.5–0.75 kg (1–1.5 lbs) of fat loss per week. First calculate your TDEE (Total Daily Energy Expenditure), then subtract your deficit. Use our Calorie Deficit Calculator for your exact number." }
        },
        {
          "@@type": "Question",
          "name": "What are macros and how do I calculate them?",
          "acceptedAnswer": { "@@type": "Answer", "text": "Macros (macronutrients) are protein, carbohydrates, and fats. A standard split is 30% protein, 40% carbs, 30% fat, but the ideal ratio depends on your goal (muscle gain, fat loss, maintenance). Our Macro Calculator customises your split based on your weight, height, activity, and goal." }
        },
        {
          "@@type": "Question",
          "name": "How much protein do I need per day?",
          "acceptedAnswer": { "@@type": "Answer", "text": "For muscle building and maintenance, aim for 1.6–2.2g of protein per kg of bodyweight (0.7–1g per lb). Sedentary adults need a minimum of 0.8g/kg. Use our Protein Calculator to get your exact daily target based on your weight and goal." }
        },{
          "@@type": "Question",
          "name": "How do I calculate my daily calorie needs?",
          "acceptedAnswer": { "@@type": "Answer", "text": "Daily calorie needs are calculated using your Basal Metabolic Rate (BMR) multiplied by an activity factor. BMR is the energy your body burns at rest — determined by age, sex, weight, and height using the Mifflin-St Jeor equation. Our Calorie Calculator applies this formula and gives your TDEE (Total Daily Energy Expenditure) for weight loss, maintenance, or gain." }
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
      <li class="breadcrumb-item active" aria-current="page" style="color:var(--text-muted);">Fitness Tools</li>
    </ol>
  </div>
</nav>

{{-- Hero --}}
<section style="background:linear-gradient(135deg,#1a1a2e 0%,#16213e 50%,#0f3460 100%); padding:64px 0 48px;">
  <div class="container-xl">
    <div class="row align-items-center g-4">
      <div class="col-lg-8">
        <div class="d-flex align-items-center gap-3 mb-3">
          <span style="font-size:2.8rem; line-height:1;">💪</span>
          <span class="badge" style="background:rgba(40,167,69,.2); color:#5cdb8d; border:1px solid rgba(40,167,69,.4); border-radius:50px; font-size:.8rem; padding:5px 14px;">Fitness Tools</span>
        </div>
        <h1 style="color:#fff; margin-bottom:16px;">Free Fitness Calculators</h1>
        <p style="color:rgba(255,255,255,.75); font-size:1.1rem; line-height:1.7; max-width:620px; margin-bottom:24px;">
          Calculate your BMI, daily calories, macro split, protein needs, body fat percentage, one rep max, heart rate zones, and more.
          11 science-based calculators — free, instant, no signup.
        </p>
        <div class="d-flex flex-wrap gap-3">
          <div class="d-flex align-items-center gap-2" style="color:rgba(255,255,255,.65); font-size:.88rem;">
            <svg width="16" height="16" fill="none" stroke="#28a745" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            Science-based formulas
          </div>
          <div class="d-flex align-items-center gap-2" style="color:rgba(255,255,255,.65); font-size:.88rem;">
            <svg width="16" height="16" fill="none" stroke="#28a745" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            Metric & imperial
          </div>
          <div class="d-flex align-items-center gap-2" style="color:rgba(255,255,255,.65); font-size:.88rem;">
            <svg width="16" height="16" fill="none" stroke="#28a745" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            Instant, no signup
          </div>
        </div>
      </div>
      <div class="col-lg-4 d-none d-lg-flex justify-content-end">
        <div style="background:rgba(40,167,69,.12); border:1px solid rgba(40,167,69,.25); border-radius:16px; padding:28px 32px; text-align:center;">
          <div style="font-size:3rem; margin-bottom:8px;">11</div>
          <div style="color:rgba(255,255,255,.7); font-size:.9rem;">Fitness Tools</div>
          <div style="height:1px; background:rgba(255,255,255,.1); margin:14px 0;"></div>
          <div style="font-size:1.6rem; margin-bottom:4px;">5M+</div>
          <div style="color:rgba(255,255,255,.7); font-size:.9rem;">Monthly searches</div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Tools Grid --}}
<section style="padding:56px 0;">
  <div class="container-xl">
    <div class="d-flex align-items-center justify-content-between mb-4">
      <h2 style="font-size:1.5rem; margin:0;">All Fitness Calculators</h2>
      <span style="color:var(--text-muted); font-size:.88rem;">{{ count($tools) ?: 11 }} tools</span>
    </div>

    @if(count($tools))
    <div class="row g-4">
      @foreach($tools as $tool)
      <div class="col-sm-6 col-lg-4">
        <a href="/{{ $tool['slug'] }}" class="tool-card d-block p-4 h-100 text-decoration-none"
           style="border-left:4px solid #28a745;">
          <div class="d-flex align-items-start gap-3">
            <span style="font-size:2rem; line-height:1; flex-shrink:0;">{{ $tool['icon'] ?? '💪' }}</span>
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
        ['⚖️','BMI Calculator','/bmi-calculator','Calculate your Body Mass Index and healthy weight range.','4,090K'],
        ['🔥','Calorie Calculator','/calorie-calculator','Find your TDEE and daily calorie needs.','1,000K'],
        ['📉','Calorie Deficit Calculator','/calorie-deficit-calculator','Set a safe deficit to lose fat without losing muscle.','301K'],
        ['🥩','Macro Calculator','/macro-calculator','Get your protein, carb, and fat split for your goal.','165K'],
        ['💊','Protein Calculator','/protein-calculator','Daily protein intake for your weight and activity level.','135K'],
        ['🏋️','One Rep Max Calculator','/one-rep-max-calculator','Estimate your 1RM for any lift from reps and weight.','90K'],
        ['📏','Body Fat Calculator','/body-fat-calculator','Estimate body fat % using the US Navy method.','550K'],
        ['❤️','Heart Rate Calculator','/heart-rate-calculator','Find your max heart rate and 5 training zones.','201K'],
        ['🏃','Running Pace Calculator','/running-pace-calculator','Pace, speed, and finish time for any race distance.','135K'],
        ['🎯','Ideal Weight Calculator','/ideal-weight-calculator','Your healthy weight range based on height.','301K'],
        ['📋','Workout Volume Calculator','/workout-volume-calculator','Track sets × reps × weight for progressive overload.','18K'],
      ] as [$icon,$name,$slug,$desc,$searches])
      <div class="col-sm-6 col-lg-4">
        <a href="{{ $slug }}" class="tool-card d-block p-4 h-100 text-decoration-none"
           style="border-left:4px solid #28a745;">
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
    <h2 class="mb-4 text-center">Quick Fitness Reference</h2>
    <div class="row g-3 justify-content-center">
      @foreach([
        ['⚖️','18.5–24.9','Healthy BMI range (WHO)'],
        ['🔥','500 kcal','Safe daily deficit for fat loss'],
        ['💊','1.6–2.2g/kg','Protein for muscle building'],
        ['❤️','220 – age','Max heart rate formula (BPM)'],
        ['💧','0.033L/kg','Daily water intake baseline'],
        ['🎯','70–80%','Ideal body fat reduction zone'],
      ] as [$icon,$stat,$label])
      <div class="col-6 col-md-4 col-lg-2">
        <div class="tool-card p-3 text-center h-100">
          <div style="font-size:1.5rem; margin-bottom:6px;">{{ $icon }}</div>
          <div style="font-weight:800; font-size:1rem; color:var(--primary-dark);">{{ $stat }}</div>
          <div style="font-size:.75rem; color:var(--text-muted); margin-top:3px;">{{ $label }}</div>
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
        <div class="accordion" id="fitnessFaq">
          @foreach([
            ['What is a healthy BMI?',
             'A healthy BMI is <strong>18.5–24.9</strong>. Below 18.5 is underweight, 25–29.9 is overweight, and 30+ is obese. BMI doesn\'t distinguish fat from muscle — athletes often show high BMI with low body fat. Pair it with a <a href="/body-fat-calculator">body fat calculator</a> for accuracy.'],
            ['How many calories should I eat to lose weight?',
             'Calculate your TDEE first with our <a href="/calorie-calculator">Calorie Calculator</a>, then subtract 500–750 kcal/day for safe fat loss (0.5–0.75 kg/week). Never go below 1,200 kcal (women) or 1,500 kcal (men) without medical supervision.'],
            ['What are macros and how do I calculate them?',
             'Macros are protein, carbohydrates, and fat. A common split for fat loss is <strong>40% protein / 30% carbs / 30% fat</strong>. For muscle gain: 30% protein / 50% carbs / 20% fat. Use our <a href="/macro-calculator">Macro Calculator</a> for a personalised breakdown.'],
            ['How much protein do I need per day?',
             'For muscle building: <strong>1.6–2.2g per kg of bodyweight</strong> (0.7–1g/lb). For maintenance: 0.8g/kg. Spread intake across 3–5 meals for optimal muscle protein synthesis. Our <a href="/protein-calculator">Protein Calculator</a> gives your exact daily target.'],
            ['How do I calculate my one rep max?',
             'The most accurate formula is <strong>Epley: 1RM = weight × (1 + reps/30)</strong>. Perform 3–5 reps at a challenging weight and plug the numbers into our <a href="/one-rep-max-calculator">One Rep Max Calculator</a>. Never attempt a true 1RM without a spotter.'],
            ['How do I calculate my daily calorie needs?',
             'Calorie needs = BMR × activity multiplier. BMR is calculated from your age, sex, height, and weight using the <strong>Mifflin-St Jeor equation</strong> (most accurate for most adults). Sedentary adults multiply BMR × 1.2; moderately active × 1.55; very active × 1.725. Our <a href="/calorie-calculator">Calorie Calculator</a> handles all of this instantly and shows targets for weight loss, maintenance, and muscle gain.'],
          ] as $i => [$q,$a])
          <div class="accordion-item" style="border:1px solid var(--border); border-radius:10px !important; margin-bottom:10px; overflow:hidden;">
            <h3 class="accordion-header">
              <button class="accordion-button {{ $i > 0 ? 'collapsed' : '' }}" type="button"
                      data-bs-toggle="collapse" data-bs-target="#fitFaq{{ $i }}"
                      style="font-weight:600; font-size:.95rem; background:transparent; color:var(--primary-dark);">
                {{ $q }}
              </button>
            </h3>
            <div id="fitFaq{{ $i }}" class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}" data-bs-parent="#fitnessFaq">
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
        ['😴','Sleep Tools','/sleep-tools','Bedtime, sleep cycles & nap calculators','#6c63ff'],
        ['🥗','Nutrition Tools','/nutrition-tools','Water intake & fasting schedule','#fd7e14'],
        ['🧠','Brain Quizzes','/quizzes','IQ test, GK quiz & more','#e94560'],
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
