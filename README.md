# ProBiz Awards 2026

Laravel 10 (SmartEnd CMS) website for **ProBiz Awards 2026 — Dubai**.
Static marketing pages, public nomination form (references like `PBZ-2026-XXXXXX`),
media-partner applications, full admin dashboard, REST API.

## Layout (important)

This repo uses a **cPanel shared-hosting layout**:

- **Repo root = web docroot** — `index.php` bootstraps the app from `core/`.
- **`core/`** — the actual Laravel application (app, routes, config, database, resources).
- **`assets/`** — public frontend assets served from docroot.
- **`uploads/`** — user-uploaded files (never execute PHP here; `.htaccess` files enforce that).

Do **not** run `php artisan serve` from `core/` expecting the site — the standard
`core/public/index.php` entry point does not exist. Serve the **repo root**.

## Requirements

- PHP 8.1+ with extensions: mbstring, xml, sqlite3 (dev), curl, zip, bcmath, gd, intl
- Composer 2
- MySQL 5.7+ / MariaDB (production), SQLite works for local dev/tests
- Node 18+ only if rebuilding frontend assets (prebuilt assets are committed)

## Local setup

```bash
cd core
composer install
cp .env.example .env
php artisan key:generate        # required — .env.example ships WITHOUT a key on purpose
```

Configure the database in `core/.env` (SQLite example):

```
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database.sqlite
```

Then:

```bash
touch /absolute/path/to/database.sqlite
php artisan migrate --seed
```

Serve the **repo root** (not `core/`):

```bash
php -S 127.0.0.1:8000 -t /path/to/repo-root
# or point your web server docroot at the repo root
```

Admin panel: `/admin` (default backend path, see `BACKEND_PATH` in `.env`).

## Mail

Nomination confirmations are emailed to the nominee. Fill in the `MAIL_*`
settings in `core/.env` (placeholders with sane defaults are in `.env.example`).
If sending fails, the nomination is still saved and the failure is logged —
the success message only claims an email was sent when it actually was.

## Testing

```bash
cd core
php artisan test
```

Tests run on in-memory SQLite (see `phpunit.xml`). GitHub Actions runs the
suite on every push/PR (`.github/workflows/tests.yml`).

## cPanel deployment

1. Upload the repo so its **root is the domain's `public_html`** (or point the
   domain docroot at it).
2. `cd core && composer install --no-dev --optimize-autoloader`
3. Copy `core/.env.example` → `core/.env`, set `APP_ENV=production`,
   `APP_DEBUG=false`, database credentials, `APP_URL`, and mail settings.
4. `php artisan key:generate`
5. `php artisan migrate --seed`
6. `php artisan config:cache && php artisan route:cache && php artisan view:cache`
7. Ensure `uploads/` is writable by the web server user.
8. Cron for the scheduler (optional):
   `* * * * * cd /path/to/core && php artisan schedule:run >> /dev/null 2>&1`

## Security notes

- `.env.example` intentionally contains **no** `APP_KEY` — generate one per
  install and never reuse keys across environments.
- `uploads/` and its subdirectories deny PHP/script execution via `.htaccess`.
  Media-partner logo uploads accept only `jpg/jpeg/png/webp` (SVG is rejected:
  stored-XSS risk).
- The public nomination endpoint (`POST /nominations/store`) is open to guests
  by design; the admin nomination listing stays behind `auth`.
