@extends('admin.layout')

@section('title', 'Overview')

@section('styles')
<style>
.dash-icon  { font-size: 2rem; line-height: 1; }
.dash-count { font-size: 2rem; font-weight: 800; line-height: 1; }
</style>
@endsection

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
  <div>
    <h1 class="h4 fw-bold mb-0">Overview</h1>
    <p class="text-muted small mb-0">Publishing status across all content</p>
  </div>
  <a href="{{ route('admin.tools.index') }}" class="btn btn-sm btn-dark">
    Manage Tools →
  </a>
</div>

{{-- Stat cards --}}
<div class="row g-3 mb-4">
  @foreach([
    ['Total Tools',  $stats['total'],     'bg-white',                   'text-dark',      '🔧'],
    ['Published',    $stats['published'], 'bg-success bg-opacity-10',   'text-success',   '✅'],
    ['Draft',        $stats['draft'],     'bg-secondary bg-opacity-10', 'text-secondary', '📝'],
    ['Scheduled',    $stats['scheduled'], 'bg-primary bg-opacity-10',   'text-primary',   '🗓️'],
  ] as [$label, $count, $bg, $textCls, $icon])
  <div class="col-sm-6 col-xl-3">
    <div class="card border-0 shadow-sm h-100 {{ $bg }}">
      <div class="card-body d-flex align-items-center gap-3 p-4">
        <span class="dash-icon">{{ $icon }}</span>
        <div>
          <div class="dash-count {{ $textCls }}">{{ $count }}</div>
          <div class="text-muted small fw-semibold mt-1">{{ $label }}</div>
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>

{{-- Quick actions --}}
<div class="card border-0 shadow-sm">
  <div class="card-header bg-white fw-semibold">Quick Actions</div>
  <div class="card-body p-4">
    <div class="d-flex flex-wrap gap-3">
      <a href="{{ route('admin.tools.index') }}" class="btn btn-outline-dark">
        🔧 Manage Tools
        @if($stats['draft'] > 0)
          <span class="badge bg-secondary ms-1">{{ $stats['draft'] }} draft</span>
        @endif
        @if($stats['scheduled'] > 0)
          <span class="badge bg-primary ms-1">{{ $stats['scheduled'] }} scheduled</span>
        @endif
      </a>

      <a href="{{ config('app.url') }}" target="_blank" class="btn btn-outline-secondary">
        🌐 View Site
      </a>
    </div>
  </div>
</div>

@endsection
