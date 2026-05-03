@props(['crumbs' => []])

@if(count($crumbs) > 1)
<nav aria-label="Breadcrumb" style="padding:12px 0;">
  <ol class="breadcrumb mb-0" itemscope itemtype="https://schema.org/BreadcrumbList">
    @foreach($crumbs as $i => $crumb)
    <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}"
        itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
      @if(!$loop->last)
        <a href="{{ $crumb['url'] }}" itemprop="item" style="color:var(--primary-cta);">
          <span itemprop="name">{{ $crumb['name'] }}</span>
        </a>
      @else
        <span itemprop="name">{{ $crumb['name'] }}</span>
      @endif
      <meta itemprop="position" content="{{ $i + 1 }}">
    </li>
    @endforeach
  </ol>
</nav>
@endif
