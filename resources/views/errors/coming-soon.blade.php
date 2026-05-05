@extends('layouts.app')

@section('title', 'Coming Soon — MindSnap')
@section('description', 'This tool is coming soon to MindSnap. Check back shortly.')
@section('robots', 'noindex, nofollow')

@section('content')
<div style="min-height: 60vh; display: flex; align-items: center; justify-content: center; padding: 3rem 1rem;">
  <div style="text-align: center; max-width: 520px;">

    {{-- Icon --}}
    <div style="font-size: 4rem; margin-bottom: 1.5rem; line-height: 1;">🚧</div>

    {{-- Heading --}}
    <h1 style="font-size: 2rem; font-weight: 800; color: var(--primary-dark); margin-bottom: .75rem;">
      Coming Soon
    </h1>

    {{-- Sub --}}
    <p style="font-size: 1.05rem; color: #666; line-height: 1.7; margin-bottom: 2rem;">
      This tool is being built right now and will be available shortly.
      Everything else on MindSnap is free to use in the meantime.
    </p>

    {{-- Divider --}}
    <div style="width: 48px; height: 3px; background: var(--primary-cta); border-radius: 2px; margin: 0 auto 2rem;"></div>

    {{-- CTAs --}}
    <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
      <a href="{{ route('home') }}"
         style="background: var(--primary-cta); color: #fff; font-weight: 700; padding: 12px 28px;
                border-radius: 8px; text-decoration: none; font-size: .95rem; transition: opacity .15s;"
         onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">
        Explore All Tools
      </a>
      <a href="javascript:history.back()"
         style="background: transparent; color: var(--primary-dark); font-weight: 600; padding: 12px 24px;
                border-radius: 8px; text-decoration: none; font-size: .95rem; border: 2px solid #ddd;
                transition: border-color .15s;"
         onmouseover="this.style.borderColor='var(--primary-cta)'" onmouseout="this.style.borderColor='#ddd'">
        ← Go Back
      </a>
    </div>

  </div>
</div>
@endsection
