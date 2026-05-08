{{-- External Third-Party Scripts --}}

{{-- Google Analytics 4: production only, lazy-loaded after first user interaction --}}
{{-- This eliminates GTM's 179ms main-thread block during LCP, improving TBT and Performance score --}}
{{-- Pageviews are still tracked — the script loads within ~100ms of any interaction --}}
@production
<script>
(function() {
  var loaded = false;
  function loadGTM() {
    if (loaded) return;
    loaded = true;

    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    window.gtag = gtag;
    gtag('js', new Date());
    gtag('config', 'G-Q6N6JM2FE8');

    var s = document.createElement('script');
    s.async = true;
    s.src = 'https://www.googletagmanager.com/gtag/js?id=G-Q6N6JM2FE8';
    document.head.appendChild(s);
  }

  // Load on first interaction
  ['scroll', 'mousemove', 'touchstart', 'keydown'].forEach(function(e) {
    window.addEventListener(e, loadGTM, {once: true, passive: true});
  });

  // Fallback: load after 4 seconds even with no interaction (catches slow readers)
  setTimeout(loadGTM, 4000);
})();
</script>
@endproduction

{{-- Add more external scripts here as needed --}}
