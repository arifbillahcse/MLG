# Deploying MLG

PHP 8.2+, Composer, MySQL 5.7+ / MariaDB 10.3+, and a web server whose document
root is the **`public/`** folder — not the project root. Getting that wrong exposes
`.env`, and it is the single most common mistake when putting Laravel on shared
hosting.

## Required PHP extensions

cPanel → Select PHP Version → Extensions. Check these are all ticked **before**
`composer install`:

```
bcmath  ctype  curl  dom  fileinfo  gd  intl  mbstring
openssl  pdo_mysql  tokenizer  xml  zip
```

`intl` and `fileinfo` are the two that are routinely off on shared hosting. Filament
requires `intl`; file uploads need `fileinfo`.

### The two-PHP trap on cPanel + CloudLinux

A CloudLinux box has **two** PHP 8.2 installs, and they do not share extensions:

| | Path | Used by |
|---|---|---|
| EA-PHP | `/opt/cpanel/ea-php82/` | whatever `php` resolves to by default |
| alt-php | `/opt/alt/php82/` | Composer, and the web server |

So `php -m | grep intl` can print `intl` while the site still throws
"The intl PHP extension is required" — you checked the wrong PHP. Trust this
instead, which reads the same vendor directory the site loads:

```bash
composer check-platform-reqs      # every line must say "success"
```

If Composer's error names `/opt/alt/php82/etc/php.ini`, the web is on alt-php.
Enable extensions in **cPanel → Select PHP Version** (the CloudLinux PHP Selector,
not MultiPHP Manager), and point your shell at the same binary:

```bash
echo 'alias php=/opt/alt/php82/usr/bin/php' >> ~/.bashrc && source ~/.bashrc
```

Never `rm -rf vendor` before `composer check-platform-reqs` passes — a failed
reinstall takes the site down until it is fixed. To recover, install with
`--ignore-platform-req=ext-intl --ignore-platform-req=ext-fileinfo`, then enable the
extensions and reinstall cleanly.

## First deploy

```bash
git clone <repo> && cd mlg

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
