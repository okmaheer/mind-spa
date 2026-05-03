@props(['faqs' => [], 'heading' => 'Frequently Asked Questions'])

@if(count($faqs))
<section style="padding:60px 0;">
  <div class="container">
    <h2 class="mb-4">{{ $heading }}</h2>
    <div class="accordion" id="faqAccordion">
      @foreach($faqs as $i => $faq)
      <div class="accordion-item" style="border:1px solid var(--border); border-radius:8px !important; margin-bottom:8px;">
        <h3 class="accordion-header">
          <button class="accordion-button {{ $i > 0 ? 'collapsed' : '' }}"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#faq-{{ $i }}"
                  aria-expanded="{{ $i === 0 ? 'true' : 'false' }}"
                  style="font-weight:600; font-size:.95rem; border-radius:8px !important;">
            {{ $faq['question'] }}
          </button>
        </h3>
        <div id="faq-{{ $i }}"
             class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}"
             data-bs-parent="#faqAccordion">
          <div class="accordion-body" style="color:var(--text); font-size:.95rem; line-height:1.7;">
            {!! $faq['answer'] !!}
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endif
