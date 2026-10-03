# CLAUDE.md

Guidance for Claude Code in this repo. Setup and overview: `README.md`. Known issues: `HEALING.md`.

## Layout

Monorepo, two independent apps, no shared tooling at root:

- `shiftsync_backend/`: Laravel 10, PHP 8.1+, MySQL. Run all `php artisan` / `composer` commands from here.
- `shiftsync_frontend/`: Angular 16 admin SPA. Run `npm` / `ng` commands from here.

## Commands

```bash
# backend (cd shiftsync_backend)
php artisan serve                       # :8000
php artisan schedule:work               # must run for shift records + timesheet calc
php artisan migrate:fresh --seed        # reset DB (destructive)
php artisan app:create-employee-shift-record
php artisan shift:check-end-times
php artisan test
./vendor/bin/pint                       # PHP formatter

# frontend (cd shiftsync_frontend)
ng serve                                # :4200
ng build
ng test
```

## Architecture notes

- **Three UIs over one backend:**
  - Employee Blade UI: `routes/web.php`, `auth` middleware, views in `resources/views/employees/`.
  - Admin Blade UI: `/admin/*`, `['auth','admin']` middleware, `App\Http\Controllers\Admin\*`, views in `resources/views/admins/<entity>/{index,create-,read-,update-}*.blade.php`.
  - Angular admin SPA: `routes/api.php`, `auth:sanctum`, `App\Http\Controllers\Api*Controller`.
  When adding an entity, check whether it needs all three.
- **Clock-in flow:** In/Out form, then `ShiftController`, then a `Jobs/ShiftJobs/*` job (StartShift, StartLunch, EndLunch, EndShift) sets the timestamp on an `employee_shift_records` row.
- **Scheduler (`app/Console/Kernel.php`, every minute):**
  - `app:create-employee-shift-record` creates today's shift record per employee (timezone-aware), assigns `shift_order`, removes duplicates.
  - `shift:check-end-times` dispatches `CalculateHoursRenderedJob`, `CalculateTardiness`, `CalculateOvertime` for ended shifts where `hours_rendered` is null.
- **Queue:** `QUEUE_CONNECTION=sync` by default, so `dispatch()` runs inline. No `jobs` table migration exists.
- **Timezones:** app runs in `UTC`. Employee and shift timezones are UTC-offset strings (`+08:00`). Use Carbon with explicit timezones; do not rely on server local time.
- **Admin flag:** `users.is_admin` (boolean), checked by `AdminMiddleware`.
- **Angular:** one service per entity in `src/app/services/`, each with a hardcoded `apiUrl`. Token is stored in `localStorage.currentUser` and attached by `auth.interceptor.ts`. Components follow `<entity>s` (list), `<entity>-detail`, `<entity>-form` (add + edit).

## Conventions

- Follow existing Laravel patterns: resource controllers, Eloquent models in `app/Models`, one migration per table.
- Column names are prefixed by owner (`employee_first_name`, `contact_city`, `shift_timezone`). Keep that style.
- Comments in jobs/commands are dense (step-by-step `//` comments); match that in those files.
- Don't commit `.env`, `vendor/`, `node_modules/`.

## Gotchas

- Admin side (Blade `/admin` + Angular SPA) is WIP; DB schema + seeders were the focus. Status table in `HEALING.md`.
- Use sample identities only (`@example.com`, placeholder names) in seeds, fixtures and docs. Never reference the internship company.
- Angular hardcodes `http://localhost:8000/api`; backend must run on :8000 for the SPA to work.
- Blade login field is `email_or_username`.
- Request param `employeeRecordId` in shift routes is an `employee_shift_records.id`, not an employee record id.
- `EmployeeShiftBreak` model has no table/migration.
- `/api/*` has no admin check.
