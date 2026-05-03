@props(['slot' => 'mid_content', 'class' => ''])

@if(config('adsense.enabled') && !request()->is('kids*'))
<div class="ad-slot text-center my-4 {{ $class }}" aria-label="Advertisement">
  <ins class="adsbygoogle"
       style="display:block"
       data-ad-client="{{ config('adsense.publisher_id') }}"
       data-ad-slot="{{ config('adsense.slots.' . $slot, '') }}"
       data-ad-format="auto"
       data-full-width-responsive="true"></ins>
  <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
</div>
@endif
