<!-- .github/copilot-instructions.md - guidance for AI coding agents -->
# Project-specific Copilot Instructions

This project is a Laravel 12 application (PHP ^8.2) with a standard Laravel skeleton. The goal of this file is to give AI coding agents immediate, actionable context so they can be productive with minimal human handoff.

**Quick Overview:**
- **Framework:** Laravel 12 (see `composer.json` require `laravel/framework`).
- **Entry points:** `artisan` (CLI), `public/index.php` (web). Use `php artisan` for framework tasks.
- **Frontend:** Vite + Tailwind managed via `package.json` (`dev` / `build` scripts).

**Key Commands (copyable):**
- Install and setup (project scripts):
  - `composer install` then `composer run-script setup` or run the `setup` steps in `composer.json` manually.
  - `npm install` and `npm run dev` (or `npm run build` for production).
- Development (from `composer.json` `dev` script):
  - `npx concurrently "php artisan serve" "php artisan queue:listen --tries=1" "php artisan pail --timeout=0" "npm run dev"` — this repo expects those services during local dev.
- Tests:
  - `composer run test` or `php artisan test`. Tests run with an in-memory SQLite DB (see `phpunit.xml`).

**Project layout & conventions (important for edits):**
- `app/` follows PSR-4 autoloading (`App\` -> `app/`). See `composer.json` autoload.
- Routes: `routes/web.php` for web; the file currently returns the `welcome` view.
- Controllers: place controllers in `app/Http/Controllers/`. `Controller.php` is the abstract base.
- Models: `app/Models/` (example: `User.php`) — follow mass-assignment (`$fillable`) and `$casts` patterns already used.
- Database: migrations and factories live in `database/` (look at `database/factories/UserFactory.php`).
- Tests: `tests/Unit` and `tests/Feature` per `phpunit.xml`.

**Testing & CI specifics:**
- CI/tests assume `DB_CONNECTION=sqlite` and `DB_DATABASE=:memory:` (see `phpunit.xml`). When modifying tests, keep database setup lightweight and prefer in-memory migrations.
- Use `@php artisan migrate --graceful --ansi` only when persistence is required in setup scripts; otherwise use `--force` in non-interactive scripts (composer already uses `--force` where intended).

**Small change pattern (concrete examples):**
- To add a route and controller action:
  1. Create `app/Http/Controllers/MyController.php` (PSR-4 `App\Http\Controllers`).
  2. Register route in `routes/web.php` (e.g., `Route::get('/foo', [MyController::class, 'index']);`).
  3. Add a feature test in `tests/Feature/MyFeatureTest.php` using `Illuminate\Foundation\Testing\RefreshDatabase` if DB state is modified.
- To add a model attribute: update `$fillable` in `app/Models/*` and add casts in `casts()` where necessary (see `User.php`).

**Integration points & external services to watch for:**
- Queues: `php artisan queue:listen` is used in `composer.json` dev script.
- Pail (Laravel pail) and Pint are referenced in `composer.json` — do not remove or replace these without verifying their role in local dev workflows.
- Vite: front-end assets are built with `vite` via `npm run dev` / `npm run build`.

**Coding agent constraints & best practices for this repo:**
- Prefer minimal, isolated changes that avoid touching framework core files (vendor/). Focus on `app/`, `routes/`, `tests/`, `resources/`.
- Preserve `composer.json` and `package.json` scripts unless asked to modify developer workflows explicitly.
- Match existing code style and type-hints (this repo targets PHP 8.2 features; use typed properties and return types where appropriate).
- When adding or updating tests, ensure they run under the `phpunit.xml` environment (sqlite in-memory). Run `php artisan test` locally to validate.

**Files to inspect first when asked to make a change:**
- `composer.json`, `package.json` — for scripts and dependencies.
- `routes/web.php`, `app/Http/Controllers/`, `app/Models/` — for routing, controller, and model conventions.
- `phpunit.xml` and `tests/` — for test environment and expectations.
- `database/migrations` and `database/factories` — for DB structure and test data.

If anything here is unclear or you want me to include additional examples (e.g., sample controller template, test scaffolding, or the exact `npm`/`composer` invocations for Windows PowerShell), tell me which sections to expand. I'll iterate quickly.
