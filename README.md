# Multi Languages Gateway — Homepage

Static homepage for MLG (Japanese language, IELTS and Japan student visa services, Dhaka).
Plain HTML, CSS and vanilla JavaScript — no build step, no dependencies, no framework.

Open `index.html` in a browser, or serve the folder:

```bash
python3 -m http.server 8080
# http://localhost:8080
```

## Files

```
index.html            Homepage — all 14 sections
contact.html          Contact page — form, office info, map slot, next steps
blog.html             Blog index — featured post, filterable grid, pagination
assets/css/style.css  Design tokens + every component
assets/js/main.js     Animations, countdown, carousel, forms, filter, language toggle
```

The three pages share the topbar, header and footer markup verbatim. There is no
templating here, so **a change to the header or footer must be copied into all three
files** — the first thing the WordPress port fixes.

### Contact page

Office info cards, a five-field message form, a map placeholder and a four-step
"what happens next" sequence. Replace the `.map` block with a Google Maps `<iframe>`
(add `loading="lazy"`). Carries `EducationalOrganization` JSON-LD with
`openingHoursSpecification`.

### Blog page

One featured post plus a six-card grid, filterable by topic. Filtering is client-side:
each card carries `data-cat`, each chip carries `data-filter`, and the handler hides
non-matching cards and shows an empty state. Pagination is static markup — wire it to
real paging when the posts become a CMS collection.

## Design tokens

Defined once at the top of `style.css` under `:root`. Change them there and the
whole page follows.

| Token | Value | Role |
|---|---|---|
| `--ink` | `#0D1B3E` | Midnight Indigo — nav, footer, headings |
| `--red` | `#D3372B` | Torii Red — primary CTA, **Japanese/visa track** |
| `--teal` | `#0B7A70` | Gateway Teal — secondary CTA, **IELTS/global track** |
| `--gold` | `#E8A33D` | Sunrise Gold — ratings, badges, counters (navy grounds only) |
| `--paper` / `--band` | `#F5F6FA` / `#EEF0F7` | Page ground and alternating section bands |
| `--slate` | `#5A6478` | Body copy |

Red and teal are not decoration — they encode the two product lines. Keep that split.

Spacing uses a fixed scale (`--s1`…`--s9` = 4/8/12/16/24/32/48/64/96). Don't introduce
values off the scale.

**Type:** Zen Kaku Gothic New for headings (covers Latin *and* kana/kanji, so Japanese
course names never fall back), Hind Siliguri for body (covers Latin *and* Bengali, so the
EN/বাংলা toggle doesn't switch typeface), system monospace for figures.

## Sections

1. Utility bar — phone, email, EN/বাংলা toggle, socials
2. Sticky header — simple dropdowns on desktop, slide-in drawer on mobile
3. Animated hero — sakura canvas, orbiting destinations, rotating headline, floating cards
4. Program selector — Japanese / IELTS / Japan Visa
5. Live batch schedule with countdown
6. Why MLG — four pillars
7. Japan route — six-step timeline
8. Partner marquee
9. Success stories — video cards + Google review carousel
10. Transparent pricing — fee table + three visa packages
11. Free seminar + registration form
12. Blog / resources
13. FAQ accordion
14. Final CTA band + mega footer

Plus a floating WhatsApp button, a sticky mobile call/WhatsApp bar, and back-to-top —
all three hide themselves while the mobile drawer is open.

**Navigation note:** `.header` must not carry `backdrop-filter` at mobile widths. A
filtered ancestor becomes the containing block for `position: fixed`, which traps the
drawer inside the 72px header bar instead of filling the viewport. The mobile media query
turns it off deliberately — don't add it back.

Each submenu is a `<div class="submenu">` wrapping a single `<ul>`. The mobile collapse
uses `grid-template-rows: 0fr → 1fr`, which only sizes the **first** row track, so the
submenu needs exactly one child element to collapse fully.

## Animations

| Effect | Where |
|---|---|
| Sakura petal canvas | Hero — pauses when scrolled out of view |
| Orbiting destination nodes | Hero — CSS `@keyframes`, counter-rotated so flags stay upright |
| Rotating headline word | "Japan" → "the world" → "日本", colour follows the track |
| Drifting gradient blobs | Hero background |
| Scroll reveal | Every section, staggered via `data-delay="1…6"` |
| Counting statistics | Hero trust strip |
| Live countdown | Next batch section |
| Star-field canvas | Final CTA — pauses when out of view |
| Marquee | Partner wall, pauses on hover |

Two things make these safe in production:

- **Nothing depends on JS to be readable.** `.reveal` elements are visible by default;
  JS adds `.anim-ready` to arm the animation. Script blocked → full page still renders.
- **`prefers-reduced-motion: reduce` is respected** — canvases are removed and all
  animation and transition durations collapse to zero.

## Before launch — replace these

| What | Where |
|---|---|
| Phone number `+8801700000000` | `index.html` (topbar, footer, WhatsApp links, mobile bar) |
| Email, address, office hours | topbar and footer |
| `BATCH_START` date | `assets/js/main.js` § 6 — **drive this from a CMS field, never hardcode a past date** |
| Seat counts and `--fill` percentages | batch cards in `index.html` |
| Partner names | marquee in `index.html` — only institutions you can substantiate |
| Google review text and count | `#reviewTrack`, or drop in a live reviews widget |
| Video testimonial thumbnails | `.vcard__thumb` gradients are placeholders for real stills |
| Blog post thumbnails | `.post__thumb` gradients on `index.html` and `blog.html` |
| Map embed | `.map` block in `contact.html` |
| Blog post URLs | every `href="#"` in `blog.html` |
| Form submission | `assets/js/main.js` § 12 — replace the `setTimeout` with a real `fetch()` POST |
| JSON-LD `url`, `telephone`, `email`, `sameAs` | `<head>` of `index.html` |

Form validation currently checks a Bangladeshi mobile pattern (`01[3-9]XXXXXXXX`)
client-side only. Validate server-side too.

## Language toggle

Any element carrying both `data-en` and `data-bn` is swapped by the toggle. To extend
coverage, add the attribute pair to more elements — no JavaScript change needed. The
choice persists in `localStorage`. For a full bilingual site, use Polylang or WPML on the
WordPress port rather than extending this.

## Performance budget

Targets for Bangladeshi mobile: LCP under 2.0s on 4G, total homepage weight under 500KB,
zero carousels above the fold, all images WebP with explicit width/height.

Current page ships no images and no libraries. Before launch:

- Self-host both fonts as subset `woff2` (Latin + Bengali + kana) instead of the Google
  Fonts link — removes two round trips to `fonts.gstatic.com`.
- Add `width`/`height` on every image you introduce, and `loading="lazy"` below the fold.
- Minify `style.css` and `main.js`.

## Porting to WordPress

Map the tokens above into `theme.json` on a lightweight base theme (GeneratePress or
Blocksy), then rebuild these sections as blocks or Elementor templates. Batch schedule,
seminar and blog become custom post types so the dates stay live. Reach for Elementor only
where the client genuinely needs to edit visually.

## Accessibility

Skip link, visible focus rings, labelled form fields, `aria-expanded` on every disclosure,
`aria-live` form status, semantic landmarks, and a `prefers-reduced-motion` path.
Colour pairs meet WCAG AA except Sunrise Gold, which is restricted to fills, icons and
navy grounds.
