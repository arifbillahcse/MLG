# Multi Languages Gateway (MLG)

Website for **Multi Languages Gateway** — a language institute and study-abroad
consultancy in Dhaka. Japanese, Korean, Chinese and IELTS courses; student visa and
university placement for Japan, Korea and China.

Built by [Softorio](https://softorio.com). Custom coded — no CMS, no page builder, no
theme.

---

## Stack

| Layer | Choice |
|---|---|
| Backend | **Laravel 11/12**, PHP 8.2+ |
| Templating | **Blade** — 42 views |
| ORM | **Eloquent** — 21 models, 23 migrations, 9 seeders |
| Admin panel | **Filament v3** at `/admin` |
| Database | MySQL / MariaDB |
| Frontend | Hand-written CSS (~1,380 lines) and vanilla JS (~650 lines) |
| Build step | **None.** No npm, no Vite, no Tailwind, no bundler |

That last row is deliberate and worth knowing before you deploy: this is Laravel
*without* a JavaScript toolchain. There is no `npm run build`. The only install step is
`composer install`.

> **Read this before you deploy.** `vendor/` has never been installed and no page has
> ever been rendered — the environment this was written in had no network access to
> packagist. Structure is statically verified (schema ↔ models ↔ seeders, Filament
> resources ↔ columns, Blade variables ↔ controller payloads, all clean), but runtime
> behaviour is not, and Filament v3's API details in particular have never been
> exercised. Budget a day or two for the first `composer install` and a click-through of
> every page. Stage it before it touches the client's domain.

---

## Running it

```bash
git clone https://github.com/arifbillahcse/MLG.git
cd MLG
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

Architecture in detail: **[`ARCHITECTURE.md`](ARCHITECTURE.md)**
Deployment: **[`DEPLOY.md`](DEPLOY.md)**

---

## What the client can edit without a developer

Courses and levels · batch dates and the homepage countdown · destinations and
scholarships · application process steps · faculty · top scores · testimonials ·
acceptance letters · partner universities · accreditations · blog posts and categories ·
FAQs · legal pages · seminars and mock tests · site settings (phone, email, address,
socials, map) · and every enquiry that comes in.

Adding a fifth language is a record in the admin, not a deployment.

### Routes

| Route | Serves |
|---|---|
| `/` | Homepage — 20 sections, all database-driven |
| `/about` · `/contact` | About, team, chairman's message · contact + map |
| `/courses/{slug}` | Japanese, Korean, Chinese, IELTS — one template |
| `/study-abroad/{slug}` | Japan, Korea, China — one template |
| `/scholarships` · `/success-stories` | MEXT/GKS/CSC grouped by country · scores, videos, reviews, letters |
| `/blog` · `/blog/{slug}` | Listing with category filters · post |
| `/privacy-policy` · `/terms` · `/refund-policy` | Rows in `pages`, `whereIn`-constrained |
| `/sitemap.xml` · `/locale/{en\|bn}` · `POST /enquiry` | Built from the DB · language switch · all 8 forms |

---

## Design decisions worth knowing before you touch it

- **Consent is a column, not a convention.** `testimonials`, `results` and
  `acceptance_letters` carry `consent_given` (default false) behind a `publishable()`
  scope. A student's name and score cannot reach a public page unless someone ticked the
  box. `partners.is_verified` works the same way for institutional claims.
- **`batches.starts_at` is a real datetime** with an `upcoming()` scope. No featured
  batch, or a date in the past, and the countdown hides itself instead of counting into
  the negative. The stale "NEXT BATCH — 12 October" that makes a competitor's homepage
  look abandoned is structurally impossible here.
- **Bengali lives in sibling columns** (`name_bn`, `title_bn`, … — 13 across 7 tables)
  with a `->t('field')` helper that falls back to English when the Bengali is blank. The
  client can translate gradually; a half-translated record never renders as an empty
  heading.
- **Forms work without JavaScript.** All eight post to `POST /enquiry` as real forms;
  `main.js` upgrades them to `fetch()` for inline feedback and falls back to
  `form.submit()` on any unexpected response. A network blip loses the feedback, never
  the lead.
- **Filament v3 is pinned, not v4.** v4 moved the actions namespace and replaced `Form`
  with `Schema`. Upgrade deliberately, not by widening the constraint.
- **`config/` is deliberately absent** — Laravel 11+ falls back to framework defaults.
  Use `php artisan config:publish <name>` when you genuinely need to override one.

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

Tokens live in `:root` at the top of `public/assets/css/style.css`. Neutrals are
biased toward indigo rather than pure grey, so nothing reads as a default. Type: **Zen
Kaku Gothic New** for display (carries Japanese glyphs natively), **Hind Siliguri** for
body (carries Bengali natively) — one stack covers all three scripts. Spacing is a fixed
4/8/12/16/24/32/48/64/96 scale.

**Known mismatch:** the supplied logo samples as navy `#16324A` with gold `#B89A50` and
contains no red at all. Torii Red is a deliberate addition for CTA contrast, not a colour
taken from the mark. If the client wants strict logo fidelity, `--red` is the one token
to change and everything downstream follows.

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

Full guide: [`DEPLOY.md`](DEPLOY.md). The three rules that actually break
deploys:

1. **The document root must be the `public/` folder**, never the project root. Point it
   at the project root and `https://domain/.env` serves your database and mail
   credentials to anyone who asks.
2. **`APP_DEBUG=false`** in production. With it on, any error page prints `.env`.
3. **Re-run `php artisan config:cache` after every `.env` edit.** Once config is cached,
   Laravel stops reading `.env` at all — a changed password will silently do nothing.

---

## Before launch — still outstanding

Content and legal items the client has to supply. Some are risk, not polish.

- [ ] **Chairman's name and photo.** The site carries the placeholder
      `A. K. M. Rahman`. It must be replaced — a real institute cannot launch with an
      invented chairman.
- [ ] **Tick `consent_given`** per testimonial, score and acceptance letter, after
      obtaining written consent. Nothing renders until you do, which is the intent.
- [ ] **Tick `is_verified`** only on partnerships that can be documented.
- [ ] **Instructor credentials.** Mahbubur Rahman is a real, named person and
      his photograph is real, but the JLPT grade, years taught and the quote
      beside them are placeholders. Confirm them with the client or clear the
      fields — an unverified qualification on a school's own site is the kind of
      claim a student enrols on.
- [ ] **Accreditation reference numbers** — real numbers, or remove the badges.
- [ ] **Privacy policy, terms, refund policy.** Seeded with bold placeholder warnings.
      These need a qualified reviewer, not a developer.
- [ ] **Band Score Guarantee terms** — whatever is promised must be written and
      honourable.
- [ ] **Real contact details.** The client's brief gave a Gmail address; use
      `info@mlg.com.bd` so mail passes SPF/DMARC instead of landing in spam.
- [ ] Real photographs, Google reviews widget.
- [ ] **Change the seeded admin password.**
- [ ] **Run the app.** See the warning at the top.

---

## Repository

```
MLG/                       ← a standard Laravel project. Clone it and run it.
├── app/
│   ├── Http/              Controllers · Requests · Middleware
│   ├── Models/            21 models + Concerns/HasTranslations
│   ├── Filament/          17 resources · 3 relation managers · 2 widgets · settings
│   ├── Support/Site.php   cached settings + nav
│   └── View/Composers/    ChromeComposer — topbar, header, footer
├── bootstrap/app.php      middleware + provider registration
├── database/              23 migrations · 9 seeders
├── resources/views/       layouts · partials · home/01–20 · courses · errors
├── routes/web.php         13 named routes
├── public/                ← the web root. Point the document root HERE
├── artisan
├── composer.json
├── ARCHITECTURE.md        how it is built, phase by phase
├── DEPLOY.md              cPanel deployment + launch checklist
└── README.md              this file
```

`config/` is intentionally absent — Laravel 11+ falls back to framework defaults. Run
`php artisan config:publish <name>` only when you genuinely need to override one.

### The static prototype

The first build was a hand-written static site (`index.html`, `assets/`, no framework) —
the client demo at `demo.softorio.com/mlg`. It was removed from the branch once the
Laravel app superseded it. It is **not lost**: it lives in git history, and the CSS and
JS were carried into `public/assets/` and have since moved on from it.

```bash
git show 1ec96b8:index.html > index.html        # recover any file
git checkout 1ec96b8 -- assets/                 # or the whole assets folder
```

Branch: `claude/mlg-competitor-analysis-gva4p4`

---

## Licence

Proprietary. Built for Multi Languages Gateway by Softorio. Not for redistribution.
