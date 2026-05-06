@extends('admin.layout')

@section('title', 'Tools')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
<style>
  /* ── Stat cards ──────────────────────────────────── */
  .stat-card           { background:#fff; border-radius:12px; padding:1.25rem 1.5rem; box-shadow:0 1px 6px rgba(0,0,0,.08); border-top:3px solid transparent; }
  .stat-card.total     { border-color:#6c757d; }
  .stat-card.published { border-color:#198754; }
  .stat-card.draft     { border-color:#adb5bd; }
  .stat-card.scheduled { border-color:#0d6efd; }
  .stat-card .num      { font-size:2rem; font-weight:800; line-height:1; }
  .stat-card .lbl      { font-size:.72rem; font-weight:700; text-transform:uppercase; letter-spacing:.07em; color:#999; margin-top:.3rem; }

  /* ── Filter bar ──────────────────────────────────── */
  .filter-bar          { background:#fff; border-radius:12px; padding:1rem 1.25rem; box-shadow:0 1px 6px rgba(0,0,0,.08); margin-bottom:1.25rem; }
  .filter-bar .lbl     { font-size:.78rem; font-weight:600; color:#888; white-space:nowrap; }
  .filter-select       { width:155px; }
  .filter-search       { width:210px; }

  /* ── Status badges ───────────────────────────────── */
  .status-badge            { font-size:.68rem; font-weight:700; padding:3px 9px; border-radius:50px; display:inline-block; letter-spacing:.02em; }
  .status-badge.published  { background:#d1fae5; color:#065f46; }
  .status-badge.draft      { background:#f1f5f9; color:#64748b; }
  .status-badge.scheduled  { background:#dbeafe; color:#1e40af; }

  /* ── View badges ─────────────────────────────────── */
  .view-badge          { font-size:.68rem; font-weight:700; padding:3px 9px; border-radius:50px; }
  .view-badge.exists   { background:#d1fae5; color:#065f46; }
  .view-badge.missing  { background:#fee2e2; color:#991b1b; }

  /* ── Category badge ──────────────────────────────── */
  .cat-badge           { font-size:.68rem; font-weight:700; padding:3px 9px; border-radius:50px; background:#f1f5f9; color:#475569; letter-spacing:.02em; }

  /* ── Table ───────────────────────────────────────── */
  .table td, .table th { vertical-align:middle; }
  .col-icon            { width:48px; }
  .col-cat             { width:100px; }
  .col-view            { width:90px; }
  .col-date            { width:145px; }
  .col-toggle          { width:160px; }
  .col-schedule        { width:80px; }
  .tool-icon-cell      { font-size:1.25rem; text-align:center; }
  .tool-name           { font-size:.875rem; font-weight:600; color:#1e293b; }
  .tool-slug           { font-family:monospace; font-size:.75rem; color:#94a3b8; }
  .ext-link            { color:#cbd5e1; text-decoration:none; }
  .ext-link:hover      { color:#3b82f6; }
  .date-cell           { font-size:.78rem; color:#94a3b8; }
  .text-slate          { color: #94a3b8; }

  /* ── Toggle switch ───────────────────────────────── */
  .publish-toggle              { width:2.6em; height:1.4em; cursor:pointer; }
  .publish-toggle:checked      { background-color:#198754; border-color:#198754; }
  .publish-toggle:focus        { box-shadow:0 0 0 .2rem rgba(25,135,84,.25); }
  .toggle-wrap                 { display:flex; align-items:center; gap:.5rem; }
  .toggle-wrap .status-badge   { min-width:62px; text-align:center; }

  /* ── Schedule panel ──────────────────────────────── */
  .schedule-btn        { padding:.25rem .6rem; }
  .schedule-input      { width:170px; }
  .schedule-panel      { background:#f8fafc; border:1px solid #e2e8f0; border-radius:8px; padding:.6rem .75rem; margin-top:.5rem; }

  /* ── DataTables tweaks ───────────────────────────── */
  .dataTables_wrapper .dataTables_filter           { display:none; }
  .dataTables_wrapper .dataTables_length label     { font-size:.82rem; color:#64748b; }
  .dataTables_wrapper .dataTables_info             { font-size:.8rem; color:#94a3b8; }
  div.dataTables_wrapper div.dataTables_paginate ul.pagination { margin:0; }

  /* ── Toast notification ──────────────────────────── */
  .toast-wrap          { position:fixed; bottom:1.5rem; right:1.5rem; z-index:9999; display:flex; flex-direction:column; gap:.5rem; }
  .ms-toast            { background:#1e293b; color:#fff; border-radius:10px; padding:.7rem 1.1rem; font-size:.85rem; font-weight:500; box-shadow:0 4px 20px rgba(0,0,0,.25); opacity:0; transform:translateY(8px); transition:opacity .25s, transform .25s; pointer-events:none; }
  .ms-toast.show       { opacity:1; transform:translateY(0); }
  .ms-toast.success    { border-left:4px solid #22c55e; }
  .ms-toast.error      { border-left:4px solid #ef4444; }
</style>
@endsection

@section('content')

{{-- Page header --}}
<div class="d-flex align-items-center justify-content-between mb-4">
  <div>
    <h1 class="h4 fw-bold mb-0">Tools</h1>
    <p class="text-muted small mb-0">{{ $stats['total'] }} tools total</p>
  </div>
</div>

{{-- Stat cards --}}
<div class="row g-3 mb-4">
  <div class="col-6 col-lg-3">
    <div class="stat-card total">
      <div class="num text-secondary">{{ $stats['total'] }}</div>
      <div class="lbl">Total</div>
    </div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="stat-card published">
      <div class="num text-success">{{ $stats['published'] }}</div>
      <div class="lbl">Published</div>
    </div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="stat-card draft">
      <div class="num text-slate">{{ $stats['draft'] }}</div>
      <div class="lbl">Draft</div>
    </div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="stat-card scheduled">
      <div class="num text-primary">{{ $stats['scheduled'] }}</div>
      <div class="lbl">Scheduled</div>
    </div>
  </div>
</div>

{{-- Filter bar --}}
<div class="filter-bar d-flex flex-wrap align-items-center gap-3">
  <span class="lbl">Filter:</span>

  <select id="filterStatus" class="form-select form-select-sm filter-select">
    <option value="">All Statuses</option>
    <option value="published">Published</option>
    <option value="draft">Draft</option>
    <option value="scheduled">Scheduled</option>
  </select>

  <select id="filterCategory" class="form-select form-select-sm filter-select">
    <option value="">All Categories</option>
    @foreach($categories as $cat)
    <option value="{{ $cat }}">{{ ucfirst($cat) }}</option>
    @endforeach
  </select>

  <select id="filterView" class="form-select form-select-sm filter-select">
    <option value="">All Views</option>
    <option value="exists">View Exists</option>
    <option value="missing">View Missing</option>
  </select>

  <div class="ms-auto d-flex gap-2">
    <input type="search" id="toolSearch" class="form-control form-control-sm filter-search" placeholder="Search…">
    <button id="resetFilters" class="btn btn-sm btn-outline-secondary">Reset</button>
  </div>
</div>

{{-- Table card --}}
<div class="card border-0 shadow-sm">
  <div class="table-responsive">
    <table id="toolsTable" class="table table-hover mb-0 w-100">
      <thead class="table-light">
        <tr>
          <th class="col-icon"></th>
          <th>Tool</th>
          <th class="col-cat">Category</th>
          <th class="col-view">View</th>
          <th class="col-date">Published At</th>
          <th class="col-toggle">Live</th>
          <th class="col-schedule">Schedule</th>
        </tr>
      </thead>
      <tbody>
        @foreach($tools as $tool)
          @php
            $status     = $tool->publishingStatus();
            $viewExists = $tool->viewExists();
          @endphp
          <tr data-status="{{ $status }}" data-category="{{ $tool->category }}" data-view="{{ $viewExists ? 'exists' : 'missing' }}">

            <td class="tool-icon-cell">{{ $tool->icon }}</td>

            <td>
              <div class="d-flex align-items-center gap-2">
                <div>
                  <div class="tool-name">{{ $tool->name }}</div>
                  <div class="tool-slug">{{ $tool->slug }}</div>
                </div>
                <a href="{{ url($tool->slug) }}" target="_blank" class="ext-link" title="Open in new tab">
                  <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                    <polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/>
                  </svg>
                </a>
              </div>
            </td>

            <td><span class="cat-badge">{{ ucfirst($tool->category) }}</span></td>

            <td>
              <span class="view-badge {{ $viewExists ? 'exists' : 'missing' }}">
                {{ $viewExists ? '✓ Exists' : '✗ Missing' }}
              </span>
            </td>

            <td class="date-cell js-published-at">
              {{ $tool->published_at ? $tool->published_at->format('d M Y, H:i') : '—' }}
            </td>

            <td>
              <div class="toggle-wrap">
                <div class="form-check form-switch mb-0">
                  <input class="form-check-input publish-toggle" type="checkbox" role="switch"
                    data-id="{{ $tool->id }}"
                    data-publish-url="{{ route('admin.tools.publish', $tool->id) }}"
                    data-unpublish-url="{{ route('admin.tools.unpublish', $tool->id) }}"
                    {{ $status === 'published' ? 'checked' : '' }}>
                </div>
                <span class="status-badge {{ $status }} js-status-badge">{{ ucfirst($status) }}</span>
              </div>
            </td>

            <td>
              <button class="btn btn-sm btn-outline-secondary schedule-btn" type="button"
                data-bs-toggle="collapse" data-bs-target="#sch-{{ $tool->id }}" title="Schedule">
                📅
              </button>
              <div class="collapse" id="sch-{{ $tool->id }}">
                <div class="schedule-panel mt-1">
                  <form method="POST" action="{{ route('admin.tools.schedule', $tool->id) }}" class="d-flex gap-2 flex-wrap">
                    @csrf
                    <input type="datetime-local" name="date"
                      class="form-control form-control-sm schedule-input"
                      min="{{ now()->addMinute()->format('Y-m-d\TH:i') }}"
                      value="{{ $tool->isScheduled() ? $tool->published_at->format('Y-m-d\TH:i') : '' }}">
                    <button type="submit" class="btn btn-sm btn-primary">Set</button>
                  </form>
                </div>
              </div>
            </td>

          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

{{-- Toast container --}}
<div class="toast-wrap" id="toastWrap"></div>

@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
<script>
$(function () {

  const CSRF = '{{ csrf_token() }}';

  /* ── Toast helper ────────────────────────────────────────────────── */
  function toast(msg, type) {
    const el = $('<div class="ms-toast ' + type + '">' + msg + '</div>');
    $('#toastWrap').append(el);
    setTimeout(() => el.addClass('show'), 10);
    setTimeout(() => { el.removeClass('show'); setTimeout(() => el.remove(), 300); }, 3000);
  }

  /* ── DataTables custom row filter ────────────────────────────────── */
  $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
    if (settings.nTable.id !== 'toolsTable') return true;

    const status   = $('#filterStatus').val();
    const category = $('#filterCategory').val();
    const view     = $('#filterView').val();

    if (!status && !category && !view) return true;

    const nTr = settings.aoData[dataIndex].nTr;
    if (!nTr) return true;

    const $row = $(nTr);
    if (status   && $row.data('status')   !== status)   return false;
    if (category && $row.data('category') !== category) return false;
    if (view     && $row.data('view')     !== view)     return false;

    return true;
  });

  /* ── Init DataTable ──────────────────────────────────────────────── */
  const table = $('#toolsTable').DataTable({
    pageLength : 25,
    lengthMenu : [10, 25, 50, 100],
    order      : [[2, 'asc'], [1, 'asc']],
    columnDefs : [
      { orderable: false, targets: [0, 5, 6] },
      { searchable: false, targets: [0, 2, 3, 4, 5, 6] },
    ],
    language: {
      info      : 'Showing _START_–_END_ of _TOTAL_ tools',
      infoEmpty : 'No tools found',
    },
  });

  /* ── Filters ─────────────────────────────────────────────────────── */
  $('#filterStatus, #filterCategory, #filterView').on('change', function () { table.draw(); });
  $('#toolSearch').on('input', function () { table.search(this.value).draw(); });
  $('#resetFilters').on('click', function () {
    $('#filterStatus, #filterCategory, #filterView').val('');
    $('#toolSearch').val('');
    table.search('').draw();
  });

  /* ── Publish toggle (AJAX) ───────────────────────────────────────── */
  $('#toolsTable').on('change', '.publish-toggle', function () {
    const $toggle  = $(this);
    const checked  = $toggle.prop('checked');
    const url      = checked ? $toggle.data('publish-url') : $toggle.data('unpublish-url');
    const $row     = $toggle.closest('tr');
    const $badge   = $row.find('.js-status-badge');
    const $dateCell = $row.find('.js-published-at');

    $toggle.prop('disabled', true);

    $.ajax({
      url     : url,
      method  : 'POST',
      data    : { _token: CSRF },
      success : function (res) {
        /* Update row data attrs for filter */
        $row.data('status', res.status).attr('data-status', res.status);

        /* Update badge */
        $badge.removeClass('published draft scheduled')
              .addClass(res.status)
              .text(res.status.charAt(0).toUpperCase() + res.status.slice(1));

        /* Update date cell */
        $dateCell.text(res.published_at ?? '—');

        /* Re-apply filters without jumping page */
        table.row($row).invalidate('dom').draw(false);

        toast(checked ? 'Published successfully' : 'Set to draft', 'success');
        $toggle.prop('disabled', false);
      },
      error   : function () {
        $toggle.prop('checked', !checked).prop('disabled', false);
        toast('Something went wrong. Try again.', 'error');
      },
    });
  });

});
</script>
@endsection
