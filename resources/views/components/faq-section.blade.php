@props(['faqs' => [], 'heading' => 'Frequently Asked Questions', 'id' => 'faqAccordion'])

@if(count($faqs))
<section class="ms-section-tools">
  <div class="container-xl">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <h2 class="text-center mb-5">{{ $heading }}</h2>
        <div class="accordion" id="{{ $id }}">
          @foreach($faqs as $i => $faq)
          <div class="accordion-item mb-2 ms-faq-item">
            <h3 class="accordion-header">
              <button class="accordion-button ms-faq-btn {{ $i > 0 ? 'collapsed' : '' }}"
                      type="button"
                      data-bs-toggle="collapse"
                      data-bs-target="#{{ $id }}-{{ $i }}"
                      aria-expanded="{{ $i === 0 ? 'true' : 'false' }}">
                {{ $faq['q'] }}
              </button>
            </h3>
            <div id="{{ $id }}-{{ $i }}"
                 class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}"
                 data-bs-parent="#{{ $id }}">
              <div class="accordion-body ms-faq-body">{!! $faq['a'] !!}</div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
@endif
