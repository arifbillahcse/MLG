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

## Phase 2 — database

23 migrations, 21 Eloquent models and 8 seeders. The templates still render hard-coded
markup; Phase 4 swaps that for queries against these tables.

```bash
php artisan migrate --seed
```

Seeding creates an admin user — `admin@mlg.com.bd` / `ChangeMe!2026`. **Change it on
first login.**

### Tables

| Group | Tables |
|---|---|
| Courses | `courses`, `course_levels`, `batches` |
| Study abroad | `destinations`, `scholarships`, `process_steps` |
| Proof | `testimonials`, `results`, `acceptance_letters`, `partners`, `accreditations` |
| People | `faculty`, `users` |
| Content | `posts`, `post_categories`, `faqs`, `pages`, `settings` |
| Capture | `enquiries`, `events`, `event_registrations` |

Plus the framework's `sessions`, `cache`, `jobs` and `password_reset_tokens`.

### Decisions worth knowing

**Bengali columns exist now.** Fields the EN/বাংলা toggle has to cover carry a nullable
`*_bn` sibling (`name_bn`, `description_bn`, `question_bn`, …). Cheap to add up front,
a migration pass to add later. Phase 7 fills them in.

**Consent is a column, not a convention.** `testimonials`, `results` and
`acceptance_letters` each have `consent_given`, defaulting to false, with a
`publishable()` scope. A student's name and score cannot reach a public page unless
someone ticked the box.

**`partners.is_verified`** works the same way. An unsubstantiated partner can be stored
but withheld — the marquee should only ever render `verified()`.

**`batches.starts_at` is a real datetime** with an `upcoming()` scope that hides passed
dates. The stale-date failure that makes a competitor's homepage look abandoned is now
structurally impossible rather than a thing to remember.

**`results.score` is a string** because it holds `8.0`, `N4`, `TOPIK 4` and `HSK 3`.

**`faqs.scope`** lets the homepage FAQ and each course FAQ share one table.

**`faculty` keeps its singular table name** (`protected $table = 'faculty'`), since
Laravel would otherwise look for `faculties`.

### Seeded content

Everything currently hard-coded in the Blade templates: 4 courses with 8 levels,
3 destinations with 5 scholarships, 6 process steps, 9 faculty (6 instructors,
3 counsellors), 8 results, 6 testimonials, 5 acceptance letters, 8 partners,
4 accreditations, 5 blog categories with 9 posts, 13 FAQs, 4 pages, 6 batches,
5 events and 17 settings.

Reconciled against the live markup: letters 5/5, partners 8/8, categories 5/5,
FAQs 13/13.

### Config files

The `config/` directory is deliberately absent — Laravel 11+ falls back to the
framework defaults. Run `php artisan config:publish <name>` if you need to customise
one.

## Next

**Phase 3** — admin panel: auth, dashboard, and CRUD over every table above.
