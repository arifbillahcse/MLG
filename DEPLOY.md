# Deploying MLG

PHP 8.2+, Composer, MySQL 5.7+ / MariaDB 10.3+, and a web server whose document
root is the **`public/`** folder — not the project root. Getting that wrong exposes
`.env`, and it is the single most common mistake when putting Laravel on shared
hosting.

## First deploy

```bash
git clone <repo> && cd mlg/laravel

composer install --no-dev --optimize-autoloader
cp .env.example .env
php artisan key:generate

# edit .env: APP_ENV, APP_DEBUG=false, APP_URL, DB_*, MAIL_*

php artisan migrate --force --seed
php artisan storage:link

php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Then set `storage/` and `bootstrap/cache/` writable by the web server user.

## Every deploy after that

```bash
git pull
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan config:cache && php artisan route:cache && php artisan view:cache
```

`config:cache` must be re-run after any `.env` change, otherwise the old values
stay live and the change looks like it did nothing.

## cPanel / shared hosting

If the host will not let you move the document root, put the contents of
`public/` in `public_html` and edit its `index.php` so both requires
point up at the application directory. Keep the application **outside**
`public_html`.

## Launch checklist

Content and settings

- [ ] Replace every placeholder in **Site settings** — phone, WhatsApp, email,
      address, office hours, Google Maps embed, social links
- [ ] Set up `info@` on the domain; stop using the Gmail address
- [ ] Replace the chairman's name and portrait (currently a placeholder and a
      silhouette)
- [ ] Fill in the four accreditation reference numbers, or delete those rows —
      an accreditation nobody can verify is worth less than one you leave out
- [ ] Tick **is_verified** only on universities you can evidence; the marquee
      hides the rest
- [ ] Tick **consent_given** only where you hold the student's permission; the
      site will not publish a name or score without it
- [ ] Have the three legal pages written by someone qualified. The seeded text
      says in bold that it is a placeholder
- [ ] Settle the Band Score Guarantee terms before advertising one

Technical

- [ ] `APP_DEBUG=false` and `APP_ENV=production`
- [ ] HTTPS enforced; `SESSION_SECURE_COOKIE=true`
- [ ] Change the seeded admin password (`admin@mlg.com.bd` / `ChangeMe!2026`)
- [ ] Configure a real mailer and send one test enquiry end to end
- [ ] Submit `/sitemap.xml` in Google Search Console
- [ ] Confirm `robots.txt` is reachable and `/admin` is disallowed
- [ ] Daily database backup

Before handover

- [ ] Walk the client through the admin, then watch them add a batch unaided
- [ ] Confirm an enquiry arrives in the admin **and** by email
- [ ] Check the site on a real mid-range Android phone on mobile data
