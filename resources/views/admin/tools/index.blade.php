@extends('admin.layout')

@section('title', 'Tools')

@section('styles')
<style>
  .status-badge-published { background: #d1e7dd; color: #0f5132; font-size: .75rem; font-weight: 700; padding: 3px 10px; border-radius: 50px; }
  .status-badge-draft      { background: #e9ecef; color: #495057; font-size: .75rem; font-weight: 700; padding: 3px 10px; border-radius: 50px; }
  .status-badge-scheduled  { background: #cfe2ff; color: #084298; font-size: .75rem; font-weight: 700; padding: 3px 10px; border-radius: 50px; }
  .view-badge-yes  { background: #d1e7dd; color: #0f5132; font-size: .72rem; font-weight: 700; padding: 2px 9px; border-radius: 50px; white-space: nowrap; }
  .view-badge-no   { background: #f8d7da; color: #842029; font-size: .72rem; font-weight: 700; padding: 2px 9px; border-radius: 50px; white-space: nowrap; }
  .tool-slug { font-family: monospace; font-size: .8rem; color: #888; }
  .table td, .table th { vertical-align: middle; }
  .action-col { white-space: nowrap; }
</style>
@endsection

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
  <div>
    <h1 class="h4 fw-bold mb-0">Tools</h1>
    <p class="text-muted small mb-0">{{ $grouped->flatten()->count() }} tools total</p>
  </div>
  <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-secondary">← Overview</a>
</div>

@foreach($grouped as $category => $tools)
<div class="card border-0 shadow-sm mb-4">
  <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
    <span class="fw-bold text-uppercase" style="font-size:.8rem; letter-spacing:.06em;">
      {{ $category }}
    </span>
    <span class="badge bg-secondary">{{ $tools->count() }}</span>
  </div>
  <div class="table-responsive">
    <table class="table table-hover mb-0">
      <thead class="table-light">
        <tr>
          <th style="width:44px;"></th>
          <th>Tool</th>
          <th style="width:95px;">View</th>
          <th style="width:110px;">Status</th>
          <th style="width:150px;" class="d-none d-lg-table-cell">Published At</th>
          <th style="width:260px;" class="action-col">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($tools as $tool)
          @php
            $status     = $tool->publishingStatus();
            $viewExists = $tool->viewExists();
          @endphp
          <tr>
            <td class="text-center" style="font-size:1.3rem;">{{ $tool->icon }}</td>

            <td>
              <div class="d-flex align-items-center gap-2">
                <div>
                  <div class="fw-semibold" style="font-size:.9rem;">{{ $tool->name }}</div>
                  <div class="tool-slug">{{ $tool->slug }}</div>
                </div>
                <a href="{{ url($tool->slug) }}" target="_blank" title="Open tool in new tab"
                   style="color:#aaa; flex-shrink:0;"
                   onmouseover="this.style.color='#0d6efd'" onmouseout="this.style.color='#aaa'">
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                    <polyline points="15 3 21 3 21 9"/>
                    <line x1="10" y1="14" x2="21" y2="3"/>
                  </svg>
                </a>
              </div>
            </td>

            <td>
              @if($viewExists)
                <span class="view-badge-yes">✓ Exists</span>
              @else
                <span class="view-badge-no">✗ Missing</span>
              @endif
            </td>

            <td>
              <span class="status-badge-{{ $status }}">{{ ucfirst($status) }}</span>
            </td>

            <td class="d-none d-lg-table-cell" style="font-size:.82rem; color:#888;">
              @if($tool->published_at)
                {{ $tool->published_at->format('d M Y, H:i') }}
              @else
                &mdash;
              @endif
            </td>

            <td class="action-col">
              <div class="d-flex gap-2 align-items-center flex-wrap">

                @if($status === 'published' || $status === 'scheduled')
                  <form method="POST" action="{{ route('admin.tools.unpublish', $tool->id) }}">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-secondary" title="Set to draft">
                      Set Draft
                    </button>
                  </form>
                @else
                  <form method="POST" action="{{ route('admin.tools.publish', $tool->id) }}">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-success" title="Publish now">
                      Publish Now
                    </button>
                  </form>
                @endif

                <button
                  class="btn btn-sm btn-outline-primary"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#schedule-{{ $tool->id }}"
                  aria-expanded="false"
                  title="Schedule for a future date"
                >
                  Schedule
                </button>
              </div>

              {{-- Schedule collapse --}}
              <div class="collapse mt-2" id="schedule-{{ $tool->id }}">
                <form method="POST" action="{{ route('admin.tools.schedule', $tool->id) }}" class="d-flex gap-2 align-items-center">
                  @csrf
                  <input
                    type="datetime-local"
                    name="date"
                    class="form-control form-control-sm"
                    style="width:180px;"
                    min="{{ now()->addMinute()->format('Y-m-d\TH:i') }}"
                    value="{{ $tool->isScheduled() ? $tool->published_at->format('Y-m-d\TH:i') : '' }}"
                  >
                  <button type="submit" class="btn btn-sm btn-primary">Set</button>
                </form>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endforeach

@endsection
