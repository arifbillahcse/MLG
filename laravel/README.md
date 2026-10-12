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

## Phase 3 — admin panel (Filament)

Login at **`/admin`**. Seeded credentials: `admin@mlg.com.bd` / `ChangeMe!2026`.

```bash
composer install            # pulls filament/filament ^3.2
php artisan migrate --seed
php artisan storage:link    # uploads are served from public/storage
php artisan serve
```

17 resources, 3 relation managers, 2 dashboard widgets and a settings screen,
across six navigation groups.

| Group | Manage |
|---|---|
| **Courses** | Courses (levels edit inline) · Batches |
| **Study Abroad** | Destinations (scholarships inline) · Application process |
| **Success Stories** | Top scores · Testimonials · Acceptance letters |
| **Content** | Blog posts · Blog categories · FAQs · Pages |
| **Enquiries** | Enquiries (with a live count badge) · Seminars & mock tests |
| **Site** | Team · Universities · Accreditations · Site settings · Users |

### Choices worth knowing

**Filament v3 is pinned**, not v4. v4 moved the actions namespace and replaced `Form`
with `Schema`, so these resources would need rewriting against it. Upgrade deliberately,
not by widening the constraint.

**The panel wears the site's colours** — Midnight Indigo primary, Torii Red danger,
Gateway Teal success, Sunrise Gold warning. The admin looks like the brand it edits.

**Consent is enforced in the UI, not just the schema.** Results, testimonials and
acceptance letters all show a red/green consent column, and `consent_given` is a required
toggle on the form.

**Passed batch dates are flagged in red** in the batch table, with "Passed — hidden from
the site" underneath. The stale-date problem is visible, not just prevented.

**Enquiries cannot be created from the admin** (`canCreate()` returns false) — they
arrive from the public forms. They can be exported to CSV and bulk-marked as contacted.

**Only administrators see the Users resource** (`UserResource::canAccess()`), so an
editor account cannot grant itself access.

**Settings are a custom page, not a CRUD table.** They are key/value rows, so the page
builds its inputs from the rows themselves — adding a setting needs a database row, not
a code change.

### Still to come

The public site does not read any of this yet — that is Phase 4. The enquiry forms still
post nowhere, so the Enquiries screen will stay empty until Phase 5.

## Phase 4 — the site reads from the database

Every repeated block is now a loop. Change a fee in the admin and it updates on the
course card, the course page, the comparison table and the fee table at once.

### What drives what

| Source | Appears in |
|---|---|
| `courses` + `course_levels` | Course grid, course pages, both fee tables, every "interest" dropdown, hero language count |
| `destinations` | Destination cards, the Study Abroad menu, footer |
| `batches` | Batch cards **and the countdown**, course page schedule |
| `results` / `testimonials` / `acceptance_letters` | Scores board, stories, letters — `publishable()` only |
| `partners` | Universities marquee — `verified()` only |
| `faculty` | Homepage team, About (split instructor/counsellor), course page |
| `posts` + `post_categories` | Blog listing, filter chips, homepage preview |
| `faqs` | Homepage FAQ (`scope=home`) and course FAQ (`scope=course`) |
| `pages` | Chairman's message, mission, vision |
| `events` | Seminar block, mock-test options |
| `settings` | Topbar, footer, contact page, map embed, **and the JSON-LD** |

### How it is held together

**`App\Support\Site`** caches settings and the nav lists forever, and
`AppServiceProvider` flushes that cache whenever a Setting, Course or Destination is
saved. No per-request settings query, but an admin edit still shows immediately.

**`ChromeComposer`** binds the topbar, header and footer, so the menus build themselves
from the course and destination tables. Adding a course in the admin adds it to the menu.

**The countdown reads `data-starts`** off `#countdown`, set from the featured batch. No
featured batch, or the date has passed, and the counter hides itself instead of counting
into the negative. `main.js` no longer carries a date at all.

**JSON-LD reads the same settings the page does**, so a changed phone number cannot go
stale in the structured data Google reads.

**`japanese.blade.php` became `courses/show.blade.php`** and no longer mentions Japanese
anywhere — it renders whatever `$course` it is handed. Phase 6 only has to change the
route.

### Not done here

Blog posts, destinations and the other courses have no detail route yet — Phase 6.

## Phase 5 — forms and enquiries

All eight forms now post to one endpoint, `POST /enquiry`, and land in the `enquiries`
table where the admin Enquiries screen already expects them.

| Form | `source_form` | Extra behaviour |
|---|---|---|
| Final CTA, About, Blog | `consultation` | — |
| Contact page | `contact` | carries email + message |
| Seminar | `seminar` | also creates an **event registration** |
| Free mock test | `mock_test` | the select posts `event_id`; also registers |
| Course enrolment | `enrolment` | level → interest, format → details |
| Placement test | `placement` | prior study → details |

### Progressive enhancement

Every form is a real `method="POST"` form that works with JavaScript disabled. `main.js`
upgrades the submit to `fetch()` for inline feedback, and on **any** unexpected response
it calls `form.submit()` and lets the browser do it properly. A network blip or an
expired session loses feedback, never the enquiry.

Validation errors come back as 422 and are shown inline against the offending field;
server-rendered failures repopulate with `old()` and mark the field `aria-invalid`.

### Protection

- **CSRF** on every form, via the shared `partials.form.head`.
- **Honeypot** — a `website` field, positioned off-screen rather than `display:none`
  (some bots skip hidden fields), with the `prohibited` rule. Anything in it fails.
- **Rate limit** `throttle:6,1` per IP. A real visitor sends one or two.
- **Server-side phone validation.** The JS check was never the real one; the regex now
  lives in `EnquiryRequest`, and the number is normalised first so `+88`, spaces and
  dashes all pass.
- `user_agent` is truncated to the column width before storage.

### Notification

A Markdown mailable goes to the `email` setting, with a reply-to of the enquirer when
they gave one. **The send is wrapped in a try/catch** — the enquiry is already saved, so
a mail outage must not turn into a lost lead or a 500 for the visitor. Failures are
logged.

`MAIL_MAILER=log` in `.env.example`, so nothing is sent until you configure a mailer.

## Next

**Phase 6** — the missing pages as data: `/courses/{slug}`, `/destinations/{slug}`,
`/blog/{slug}`, success stories, and the legal pages.
