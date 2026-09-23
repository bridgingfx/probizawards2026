# ProBiz Awards — Codebase Inspection Report

**Repo:** `bridgingfx/probizawards2026` (local: `~/workspace/repos/bridgingfx-probizawards2026`)
**Date inspected:** 2026-09-23
**Branch:** `main` — single commit `11517cb` ("inite"), working tree clean
**Method:** read-only inspection + `php -l` syntax pass over all PHP in `core/` (no code changed). The app could **not** be booted or HTTP-smoke-tested because `core/vendor/` is missing (see §3).

---

## 1. What the app is / stack

- **Laravel 10.48.16** (requires PHP `^8.1`; local CLI is PHP 8.3.6), built on the **SmartEnd CMS** commercial CMS skeleton (config `smartend.php`, all CMS tables prefixed `smartend_`).
- **cPanel shared-hosting layout:** repo root IS the web docroot — root `index.php` is the Laravel front controller (`require core/vendor/autoload.php`, `core/bootstrap/app.php`); the actual Laravel app lives in `core/`. Root carries cPanel-style `.htaccess` plus an IIS `web.config`.
- **ProBiz Awards 2026 Dubai** — "Celebrating Excellence Across UAE Business": gala **11 December 2026**, Falcon Ballroom, Le Méridien Dubai. 10 award pillars, 50 main awards, 20 restaurant distinctions (defined in `core/config/probiz.php`).
- Features: static marketing pages, public **nomination form** (`/nominate`, stores with `PBZ-2026-XXXXXX` reference IDs), **media-partner application form**, CMS (topics, banners, events, menus, popups, contacts, webmail inbox), admin dashboard at `/admin` (`BACKEND_PATH=admin`), public JSON API keyed by an `api_key` webmaster setting, sitemap, RSS, social login routes, newsletter.
- Notable packages: `laravel/sanctum`, `socialite`, `rachidlaasri/laravel-installer`, `alexusmai/laravel-file-manager`, `joedixon/laravel-translation`, `maatwebsite/excel`, `spatie/laravel-feed|newsletter`, `torann/geoip`, `anhskohbo/no-captcha`.
- Size: **4,624 tracked files, 481 PHP files, 224 Blade views, 39 migrations, 33 models**, 16 seeders, admin dashboard with ~20 controllers.

### Relationship to sibling `bridgingfx/profxawards`

Same SmartEnd/Laravel-10 DNA (identical `composer.json`), but **probizawards2026 is the newer, evolved variant**, not a byte-copy:
- **Fixes the sibling's broken nomination flow:** adds migrations `2026_09_09 create_nominations_table`, `2026_09_10 add_probiz_fields`, and `NominationController::index()` (the sibling had no migration and no `index()`, so both its public and admin nomination routes 500'd).
- Adds a **media-partners** feature (migration `2026_09_15`, `MediaPartnerController`, `MediaPartner` model, admin approval workflow).
- Adds `ProBizPageController` (~20 static pages: vote, winners, judging, judges, gala, sponsors, finalists, etc.) and `core/config/probiz.php` with real event data; the sibling's routes are finance/trading-flavoured with placeholder redirects.
- **Hardened root `.htaccess`**: explicitly denies `.env`, composer files, `phpunit.xml`, `README.md` (the sibling's served `/core/.env` publicly with a 200).
- Omits the sibling's red flags: no `fix-live-cache.php` web-shell, no `cgi-bin` junk, no WordPress W3TC `.htaccess` blocks, no wrong `RewriteBase`.
- Trade-off: the sibling had `vendor/` installed locally and a SQLite dev DB; **this repo has neither** — it cannot run here at all until `composer install` is done.

## 2. File inventory (top level)

| Path | Purpose |
|---|---|
| `index.php` | Laravel front controller (docroot) |
| `core/` | The Laravel app (app, config, routes, resources, database, tests) — **no `vendor/`** |
| `assets/` | Bundled frontend libs: `frontend/` (site theme + `images/ProBiz_Images_Only/` hero/pillar images), `dashboard/` (admin theme, Bootstrap/Angular/CKEditor), `file-manager/`, `keditor/` (page-builder theme incl. `probiz/`), `installer/`, `translation/` |
| `uploads/` | CMS user uploads (banners, contacts, media, topics, users, settings, pattern, inbox) + `banners/*.mp4` hero video |
| `magazine/` | `ProBizAwardsMagazine-DecemberEdition2026.pdf` (real content) |
| `.htaccess` (root, 22 lines) | Laravel rewrite + `FilesMatch` deny for dotfiles/composer/phpunit/README |
| `web.config` | IIS rewrite to `index.php` |
| `google0c06d5df9608d691.html` | Google Search Console verification (same code as sibling — odd to share across repos) |
| `robots.txt` | `Disallow:` (allows all) — fine |
| `mix-manifest.json` | **Stale** — maps `/js/app.js`, `/css/app.css`, which don't exist; no `mix()` usage in any view |
| `favicon.ico` | **0 bytes** |
| `fin.png` | 74×150 PNG of unknown purpose at root |

Key app areas (`core/`): `app/Http/Controllers/Dashboard/*` (admin CRUD + nominations inbox), `app/Http/Controllers/APIs/APIsController.php` (public read API + form submits gated by `api_key` setting), `app/Http/Controllers/ProBizPageController.php` + `MediaPartnerController.php` (new vs sibling), `routes/web.php` (public), `routes/dashboard.php` (auth-protected admin), `routes/apis.php`, 39 migrations incl. SmartEnd base + 3 new 2026 ones, 16 seeders.

## 3. Test results (exact)

- `php -l` over **every** PHP file in `core/app`, `core/routes`, `core/config`, `core/database` → **0 syntax failures**.
- Spot-checked `index.php`, `artisan`, `bootstrap/app.php`, `routes/web.php`, `routes/api.php`, `Models/Nomination.php`, `config/probiz.php`, `ProBizPageController.php`, `NominationController.php`, `MediaPartnerController.php` → all clean.
- **No tests were run and none can run:** `core/vendor/` does not exist (composer install never run), so `artisan`, PHPUnit, and route listing all fail at the autoloader. The `tests/` dir contains only Laravel's stock `ExampleTest` (Unit + Feature) — **there are no real tests** for nominations, media partners, API, or admin flows.
- **No boot / HTTP smoke test possible** for the same reason; plus there is no `.env` and no database file (unlike the sibling's SQLite dev DB).

## 4. Health / honesty findings

1. **Cannot run as-is.** Missing `core/vendor/` is the single biggest blocker. `composer install` (PHP ^8.1) + `.env` + `php artisan key:generate` + MySQL import/migrate are all required before anything works. Nothing in the repo documents this.
2. **Nomination "email" claim is false.** After `Nomination::create()`, `store()` redirects with *"Your nomination has been received. Please check your email for your reference number"* — but **no email is ever sent** (`Mail::` never invoked in the nomination flow; only reference ID shown on screen). Users will wait for an email that never arrives.
3. **Voting/judging are placeholders.** `/vote` renders *"Voting is not open yet"*; `/winners` says winners will be announced at the gala. No Vote/Judge models, tables, routes, or logic exist. Fine if intentional, but don't present the site as having voting.
4. **Stale `mix-manifest.json`** at root references build outputs that don't exist; harmless (no `mix()` calls) but misleading. Vite is configured (`core/vite.config.js` → `resources/sass/app.scss`, `resources/js/app.js`) yet **no view uses `@vite`** and no built assets exist — dead config.
5. **`favicon.ico` is 0 bytes**; `fin.png` (74×150) sits at root with no clear purpose.
6. `.env.example` carries vendor leftovers: `DB_DATABASE=smartend`, `APP_ENV=production` **with `APP_DEBUG=true`**, and empty `MAIL_*` settings — anyone copying it to `.env` gets debug-on-in-production with no mail.
7. Sibling-era dead routes (`/financial`, `/fintech`, `/award`→410, etc.) are kept as 301/410 stubs — deliberate for old-link hygiene, fine.

## 5. What's missing (docs / config / hygiene)

1. **README is a stub** (root: 29 bytes "ProBizawards"; `core/README.md` is stock Laravel). No setup, env, or deploy documentation.
2. **No deployment docs** for the unusual root-as-docroot + `core/` layout: required `composer install`, `.env` keys, MySQL setup, `storage/` permissions, cron for scheduler/queue — none documented.
3. **No `.env.production` example** and no documented required-env list for the live server.
4. **No real tests** — only the 2 stock Laravel example tests; nomination/media-partner/API/admin flows untested.
5. **No CI** (no GitHub workflow files); git history is a single "inite" commit.
6. **No dev database** — no SQLite file and no seed SQL dump; a fresh clone needs the full SmartEnd migration + seeder run against MySQL, undocumented.
7. `robots.txt`/`sitemap` fine, but `APP_URL=https://probizawards.com/` in `.env.example` is the only domain reference — correct domain at least.

## 6. Security red flags

1. **[HIGH] Real-looking `APP_KEY` committed in `core/.env.example`** (`base64:jZ6n9I2WTTrBB59H5rHMF3HBKU4Doj60hm4T8v0W1+8=`). If this key is ever used in a production `.env`, cookie/session encryption and signed URLs are compromised (key is in git history). **Rotate: `php artisan key:generate` on a fresh `.env`.**
2. **[HIGH] Media-partner logo uploads go to a web-accessible path with SVG allowed.** `MediaPartnerController::storeLogo()` saves to `uploads/media_partners/` (repo root, served by the web server) using the client-supplied extension; `mimes:` allows `svg`, and SVG files can carry executable scripts → stored-XSS vector. (Nomination evidence uploads use `store('nominations')` → `storage/app`, not public — that one's fine.)
3. **[MEDIUM] `uploads/media/.htaccess` has contradictory PHP rules:** `Deny from all` for `*.ph*` is followed by `<Files "*.php"> Allow from all` + `Require all granted`. Depending on Apache merge order, `.php` files in uploads may be **served/executed** — the exact opposite of the intended upload protection. Verify on the server and fix to deny.
4. **[MEDIUM] Public POST endpoints (`/subscribe`, `/comment`, `/order`, `/form-submit`, API form submits) are gated only by the `api_key` webmaster setting** — verify it's set to a strong random value on the server, not empty/default.
5. **[POSITIVE] Root `.htaccess` denies `.env`, composer files, `phpunit.xml`, `README.md` by basename** — the sibling's critical public-`.env` exposure does not apply here, as long as this `.htaccess` is what serves production.
6. No hardcoded passwords/API keys found in `app/` or `config/` (grep clean); no `.env` tracked in git; `google0c06d5df9608d691.html` is benign.

---

## Suggested next steps (for planning, not done)

- `composer install` in `core/`, create `.env` from `.env.example` with a **fresh** `APP_KEY`, `APP_DEBUG=false`, real MySQL + mail config; run migrations + seeders on a dev DB.
- Decide the logo-upload strategy: store outside docroot or strip SVG from allowed mimes; fix the `uploads/media/.htaccess` contradiction.
- Fix the nomination email claim (send the reference email via `NotificationEmail`, or reword the message).
- Write a real README + deploy runbook; add a PHPUnit feature test for the nomination and media-partner flows; consider CI.
- Set a strong `api_key` webmaster setting on the server; confirm production serves the repo's `.htaccess`.
