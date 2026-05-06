# MindSnap — Coding Standards

## Stack
- Laravel 13, PHP 8.3
- Bootstrap 5 (CDN — no Vite, no Tailwind, no bundler)
- Vanilla JS only (no jQuery in frontend pages; jQuery allowed in admin only via DataTables)
- Blade templating

## CSS Rules ⛔ STRICTLY FORBIDDEN — zero exceptions

**`style="..."` inline attributes are ABSOLUTELY PROHIBITED on every HTML element.**
This is the single most important rule. It is never acceptable under any circumstance.

### Decision order (follow this every time, in this exact order):
1. **Use an existing global class** from `public/css/mindsnap.css` — check there first, always
2. **Use a Bootstrap 5 utility** (`d-none`, `fw-bold`, `text-muted`, `mb-3`, etc.) if the global class does not exist
3. **Only if neither exists**: add a named class to the page's `@section('styles') <style> ... </style> @endsection` block, then apply that class to the element

### Rules:
- `style="..."` on any HTML tag = **forbidden, no exceptions, not even for a single property**
- `style="display:none"` → use `d-none`; `style="font-weight:bold"` → use `fw-bold`; `style="color:red"` → use `text-danger`
- Page-specific styles go in `@section('styles')` as **named classes with a page prefix** (`.bmi-`, `.ts-`, `.sq-`)
- Class names must be semantic (`.ts-progress`, `.mp-tool-icon`) not presentational (`.red-text`, `.big-font`)

## Blade / Component Rules ⛔ ALWAYS USE COMPONENTS FIRST

**Before writing any HTML structure, check if a component already exists.**

### Available components — use these, never write raw HTML equivalents:
- `<x-breadcrumb :crumbs="[...]"/>` — **always** use this for breadcrumbs, never `<nav><ol class="breadcrumb">`
- `<x-faq-section :faqs="$faqs" id="pageFaq" />` — **always** use this for FAQ sections
- `<x-related-tools :tools="$relatedTools" heading="..." />` — **always** use this for related tools grids

### Other component rules:
- Never hardcode tool lists in category pages — always use `$tools` from the DB query in the controller
- Check `resources/views/components/` before writing any reusable HTML block
- **If the same HTML structure appears in 2 or more places → extract it into a Blade component immediately**
  - Create it in `resources/views/components/`
  - Use `@props()` for any varying data
  - Replace every occurrence with the component tag before moving on
  - Do not leave duplicate HTML in place and "note it for later"

## SEO Rules (every new tool page must have all of these)
- `@section('title')` — format: `[Primary Keyword] — [Descriptor] | MindSnap` (under 60 chars)
- `@section('description')` — 150–160 characters, includes primary keyword
- `@section('canonical')` — always set
- Three JSON-LD blocks in `@section('schema')`: `WebApplication`, `BreadcrumbList`, `FAQPage`
- Minimum 8 FAQ items in `$faqs` PHP array (used by both `<x-faq-section>` and JSON-LD)
- SEO text sections use `ms-longtail` or a page-specific max-width class — never `style="max-width:..."`

## Publishing / Draft Rules
- **New tool pages must be created as draft** (`published_at = null` in DB) — never published by default
- Draft tools return HTTP 503 + `Retry-After: 86400` (preserves Google index position)
- Use `renderOrComingSoon('view.name')` in every tool controller method instead of plain `view()`
- Publish only via the admin panel at `/admin/tools`

## Admin Rules
- Admin cache must be cleared on every publish/unpublish/schedule action:
  `Artisan::call('cache:clear')` + `Artisan::call('view:clear')` + `PublishableRegistry::clearCache($slug)`
- Admin views use jQuery (DataTables) — this is the only place jQuery is allowed
- Admin pages must have `<meta name="robots" content="noindex, nofollow">` and HTTP `X-Robots-Tag: noindex, nofollow`

## General Code Rules
- No comments unless the WHY is non-obvious (hidden constraint, workaround, subtle invariant)
- No docblocks or multi-line comment blocks
- No unused variables, dead code, or backwards-compat shims
- Prefer editing existing files over creating new ones
- Keep JS in `@push('scripts')` blocks at the bottom of blade files — never in `<head>`
