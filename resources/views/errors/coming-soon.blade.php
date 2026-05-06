@extends('layouts.app')

@section('title', 'Coming Soon — MindSnap')
@section('description', 'This tool is coming soon to MindSnap. Check back shortly.')
@section('robots', 'noindex, nofollow')

@section('styles')
<style>
.cs-wrap        { min-height: 60vh; display: flex; align-items: center; justify-content: center; padding: 3rem 1rem; }
.cs-inner       { text-align: center; max-width: 520px; }
.cs-icon        { font-size: 4rem; margin-bottom: 1.5rem; line-height: 1; }
.cs-title       { font-size: 2rem; font-weight: 800; margin-bottom: .75rem; }
.cs-sub         { font-size: 1.05rem; color: #666; line-height: 1.7; margin-bottom: 2rem; }
.cs-divider     { width: 48px; height: 3px; background: var(--primary-cta); border-radius: 2px; margin: 0 auto 2rem; }
.cs-cta-row     { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; }
.cs-btn-primary { background: var(--primary-cta); color: #fff; font-weight: 700; padding: 12px 28px; border-radius: 8px; text-decoration: none; font-size: .95rem; transition: opacity .15s; }
.cs-btn-primary:hover { opacity: .85; color: #fff; }
.cs-btn-back    { background: transparent; color: var(--primary-dark); font-weight: 600; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-size: .95rem; border: 2px solid #ddd; transition: border-color .15s; }
.cs-btn-back:hover { border-color: var(--primary-cta); color: var(--primary-dark); }
</style>
@endsection

@section('content')
<div class="cs-wrap">
  <div class="cs-inner">

    {{-- Icon --}}
    <div class="cs-icon">🚧</div>

    {{-- Heading --}}
    <h1 class="cs-title text-brand">Coming Soon</h1>

    {{-- Sub --}}
    <p class="cs-sub">
      This tool is being built right now and will be available shortly.
      Everything else on MindSnap is free to use in the meantime.
    </p>

    {{-- Divider --}}
    <div class="cs-divider"></div>

    {{-- CTAs --}}
    <div class="cs-cta-row">
      <a href="{{ route('home') }}" class="cs-btn-primary">Explore All Tools</a>
      <a href="javascript:history.back()" class="cs-btn-back">← Go Back</a>
    </div>

  </div>
</div>
@endsection
