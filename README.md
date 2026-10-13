# Multi Languages Gateway (MLG)

Website for **Multi Languages Gateway** — a language institute and study-abroad
consultancy in Dhaka. Japanese, Korean, Chinese and IELTS courses; student visa and
university placement for Japan, Korea and China.

Built by [Softorio](https://softorio.com). Custom coded — no CMS, no page builder, no
theme. Demo: `https://demo.softorio.com/mlg`

---

## What is in this repository

Two deployable things, in one repo, on purpose.

| | Path | What it is | Status |
|---|---|---|---|
| **Static site** | repository root | Hand-written HTML/CSS/JS, 5 pages, zero dependencies | The live client demo |
| **Laravel app** | `laravel/` | The same site, database-driven, with a Filament admin panel | Built, never executed |

The static site is what the client has been shown and signed off on. The Laravel app is
the dynamic build quoted separately in the proposal: same design, same markup, but every
repeated block comes out of the database and is editable from `/admin`.

Nothing in `laravel/` affects the static site. You can deploy either one on its own.

> **Read this before you deploy the Laravel app.** Its `vendor/` has never been
> installed and no page has ever been rendered — the environment it was written in had no
> network access to packagist. Structure is statically verified (schema ↔ models ↔
> seeders, Filament resources ↔ columns, Blade variables ↔ controller payloads, all
> clean), but runtime behaviour is not, and Filament v3's API details in particular have
> never been exercised. Expect the first `composer install` and the first page load to
> surface real problems. Stage it before it touches the client's domain.

---

## Track 1 — the static site

No build step. No npm. No dependencies. Open it.

```bash
python3 -m http.server 8080      # then http://localhost:8080
```

### Pages

| File | Page |
|---|---|
| `index.html` | Homepage — 20 sections |
| `about.html` | About us, team, chairman's message, facility |
| `japanese.html` | Japanese course — JLPT N5–N1 |
| `blog.html` | Blog listing with category filters |
| `contact.html` | Contact, map, enquiry form |

### Assets

```
assets/
├── css/style.css          ~1,360 lines, design tokens at the top
├── js/main.js             ~650 lines, vanilla, no libraries
└── img/
    ├── glm-logo.png       387×337 master
    └── glm-logo-132.png   152×132, used site-wide + favicon
```

Deploy by uploading the root of this repo (minus `laravel/`) to `public_html`. That is
the whole procedure.

---

## Track 2 — the Laravel app

Laravel 11/12 + Filament v3 + MySQL. Full detail in **[`laravel/README.md`](laravel/README.md)**;
deployment in **[`laravel/DEPLOY.md`](laravel/DEPLOY.md)**.

```bash
cd laravel
composer install
cp .env.example .env
php artisan key:generate
# set DB_* in .env, then:
php artisan migrate --seed
php artisan storage:link
php artisan serve                # http://localhost:8000
```

Admin panel at **`/admin`**. Seeded login: `admin@mlg.com.bd` / `ChangeMe!2026` —
**change it on first login.** Those credentials are in a public git branch.

### By the numbers

| | |
|---|---|
| Migrations | 23 |
| Eloquent models | 21 |
| Seeders | 9 |
| Blade views | 42 (homepage = 20 numbered section partials) |
| Filament resources | 17, plus 3 relation managers, 2 widgets, 1 settings page |
| Public routes | 13 |

### What the client can edit without a developer

Courses and levels · batch dates and the homepage countdown · destinations and
scholarships · application process steps · faculty · top scores · testimonials ·
acceptance letters · partner universities · accreditations · blog posts and categories ·
FAQs · legal pages · seminars and mock tests · site settings (phone, email, address,
socials, map) · and every enquiry that comes in.

Adding a fifth language is a record in the admin, not a deployment.

### Design decisions worth knowing before you touch it

- **Consent is a column, not a convention.** `testimonials`, `results` and
  `acceptance_letters` carry `consent_given` (default false) behind a `publishable()`
  scope. A student's name and score cannot reach a public page unless someone ticked the
  box. `partners.is_verified` works the same way for institutional claims.
- **`batches.starts_at` is a real datetime** with an `upcoming()` scope. No featured
  batch, or a date in the past, and the countdown hides itself instead of counting into
  the negative. The stale "NEXT BATCH — 12 October" that makes a competitor's homepage
  look abandoned is structurally impossible here.
- **Bengali lives in sibling columns** (`name_bn`, `description_bn`, …) with a
  `->t('field')` helper that falls back to English when the Bengali is empty. The client
  can translate gradually; a half-translated record never renders as a blank heading.
- **Forms work without JavaScript.** All eight post to `POST /enquiry` as real forms;
  `main.js` upgrades them to `fetch()` for inline feedback and falls back to
  `form.submit()` on any unexpected response. A network blip loses the feedback, never
  the lead.
- **Filament v3 is pinned, not v4.** v4 moved the actions namespace and replaced `Form`
  with `Schema`. Upgrade deliberately, not by widening the constraint.
- **`config/` is deliberately absent** — Laravel 11+ falls back to framework defaults.
  Use `php artisan config:publish <name>` when you genuinely need to override one.

### The assets have diverged, on purpose

`laravel/public/assets/` started as a byte-for-byte copy of `assets/` and has since
gained `.prose` typography for blog and legal pages, a honeypot rule, and a countdown
that reads `data-starts` instead of a hardcoded date. **A CSS or JS fix belongs in both
copies** until the static demo is retired. Diff them before you assume they match:

```bash
diff assets/css/style.css laravel/public/assets/css/style.css
diff assets/js/main.js    laravel/public/assets/js/main.js
```

---

## Brand

| Token | Hex | Used for |
|---|---|---|
| Midnight Indigo | `#0D1B3E` | Nav, footer, headings — the institutional voice |
| Torii Red | `#D3372B` | Primary CTA, language courses |
| Gateway Teal | `#0B7A70` | Secondary CTA, test prep and study abroad |
| Sunrise Gold | `#E8A33D` | Ratings and badges, on navy grounds only |
| Paper / Band | `#F5F6FA` / `#EEF0F7` | Page and section backgrounds |
| Slate | `#5A6478` | Body copy |

Neutrals are biased toward indigo rather than pure grey, so nothing on the page reads as
a default. Type: **Zen Kaku Gothic New** for display (carries Japanese glyphs natively),
**Hind Siliguri** for body (carries Bengali natively) — one font stack covers all three
scripts the site needs. Spacing is a fixed 4/8/12/16/24/32/48/64/96 scale.

**Known mismatch:** the supplied logo samples as navy `#16324A` with gold `#B89A50` and
contains no red at all. Torii Red is a deliberate addition for CTA contrast, not a colour
taken from the mark. If the client wants strict logo fidelity, `--red` is the one token to
change and everything downstream follows.

---

## Accessibility and performance

- WCAG AA contrast on every text/background pair in the token set
- Skip link, visible focus rings, `aria-expanded` on the nav, `aria-live` on form status
- Every animation respects `prefers-reduced-motion`
- Scroll reveals are primed on load, so above-the-fold content is never hidden waiting
  for an observer to fire
- No webfonts beyond the two above, no framework, no bundler

---

## Deployment

- **Laravel on cPanel:** [`laravel/DEPLOY.md`](laravel/DEPLOY.md)
- **The one that matters:** the document root must be **`laravel/public`**, never the
  project root. Point it at the project root and `https://domain/.env` serves your
  database and mail credentials to anyone who asks.
- `APP_DEBUG=false` in production. With it on, any error page prints `.env`.
- After **every** `.env` edit on a cached deploy, re-run `php artisan config:cache` —
  once config is cached, Laravel stops reading `.env` entirely.

---

## Before launch — still outstanding

These are content and legal items the client has to supply. Some are risk, not polish.

- [ ] **Chairman's name and photo.** The site carries the placeholder
      `A. K. M. Rahman`. It must be replaced — a real institute cannot launch with an
      invented chairman.
- [ ] **Tick `consent_given`** per testimonial, score and acceptance letter, after
      obtaining written consent. Nothing renders until you do, which is the intent.
- [ ] **Tick `is_verified`** only on partnerships that can be documented.
- [ ] **Accreditation reference numbers** — real numbers, or remove the badges.
- [ ] **Privacy policy, terms, refund policy.** Seeded with bold placeholder warnings.
      These need a qualified reviewer, not a developer.
- [ ] **Band Score Guarantee terms** — whatever is promised must be written and
      honourable.
- [ ] **Real contact details.** The client's brief gave a Gmail address; use
      `info@mlg.com.bd` so mail passes SPF/DMARC instead of landing in spam.
- [ ] Real photographs, Google reviews widget.
- [ ] **Change the seeded admin password.**
- [ ] On the static site only, Korean / Chinese / IELTS pages do not exist. In Laravel
      they are rows served by `/courses/{slug}`.

---

## Repository

```
MLG/
├── index.html  about.html  japanese.html  blog.html  contact.html
├── assets/                      css · js · img
├── laravel/
│   ├── app/                     Http · Models · Filament · Support · View
│   ├── database/                migrations · seeders
│   ├── resources/views/         layouts · partials · home/01–20 · courses · errors
│   ├── routes/web.php
│   ├── public/                  ← the web root
│   ├── README.md                architecture, phase by phase
│   └── DEPLOY.md                cPanel deployment + launch checklist
└── README.md                    this file
```

Branch: `claude/mlg-competitor-analysis-gva4p4`

---

## Licence

Proprietary. Built for Multi Languages Gateway by Softorio. Not for redistribution.
