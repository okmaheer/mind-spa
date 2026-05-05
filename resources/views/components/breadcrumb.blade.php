@props(['crumbs' => []])

@if(count($crumbs) > 1)
<nav aria-label="Breadcrumb" class="mb-3">
  <ol class="breadcrumb ms-breadcrumb"
      itemscope itemtype="https://schema.org/BreadcrumbList">
    @foreach($crumbs as $i => $crumb)
    <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}"
        itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
      @if(! $loop->last)
        <a href="{{ $crumb['url'] }}" itemprop="item">
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
