# MLG — Laravel application

Phase 1 of the Laravel migration: the static site ported to Blade. Every page renders
exactly as before, but the header and footer exist once instead of five times.

The static site at the repository root is untouched and still deployable — it is the
live demo. Nothing here affects it.

## Running it

```bash
cd laravel
composer install            # needs network; writes vendor/
cp .env.example .env
php artisan key:generate
php artisan serve           # http://localhost:8000
```

No database is required at this phase. `DB_*` in `.env` is there for Phase 2.

## What Phase 1 changed

| Before | Now |
|---|---|
| Header + footer copy-pasted into 5 files (63 KB duplicated) | `partials/header`, `partials/footer`, included once by the layout |
| `index.html`, `about.html`, … | Routes: `/`, `/about`, `/blog`, `/contact`, `/courses/japanese` |
| `href="about.html"` | `href="{{ route('about') }}"` |
| `href="assets/css/style.css"` | `{{ asset('assets/css/style.css') }}` |
| One 1,312-line homepage file | 20 section partials in `resources/views/home/` |

CSS and JS moved to `public/assets/` **unchanged** — not one line rewritten.

## Layout contract

`layouts/app.blade.php` exposes:

- `@section('title')` and `@section('description')` — per page
- `@section('og')` — Open Graph tags
- `@push('schema')` — JSON-LD, stacked so a page can add more than one block

## Structure

```
resources/views/
├── layouts/app.blade.php        the only place chrome lives
├── partials/
│   ├── topbar.blade.php
│   ├── header.blade.php         nav + mobile drawer + backdrop
│   └── footer.blade.php         footer + WhatsApp + mobile bar + back-to-top
├── home.blade.php               20 @includes, nothing else
├── home/01-animated-hero.blade.php … 20-final-cta.blade.php
├── about.blade.php
├── blog.blade.php
├── contact.blade.php
└── courses/japanese.blade.php
```

Section partials are numbered in document order. Reordering the homepage means
reordering the `@include` lines in `home.blade.php` — the numbers are a reading aid,
not a dependency.

## Still hard-coded (Phase 2 and 4 move these to the database)

Course cards, destinations, batch schedule, faculty, results, acceptance letters,
reviews, fee tables and FAQs — 43 blocks on the homepage alone. They are plain markup
inside the section partials, ready to become `@foreach` loops.

The eight enquiry forms still post nowhere; `main.js` keeps its `setTimeout` stub.
Phase 5 replaces it.

## Next

**Phase 2** — migrations and models for courses, levels, batches, destinations,
faculty, testimonials, results, posts, enquiries, events and settings, seeded from the
content now sitting in these templates.
