# HEALING.md

Known issues, work-in-progress areas and troubleshooting for ShiftSync. Written while revisiting the project on 2026-10-03, after a full local run. Tick items off (or delete them) as they are fixed.

## 0. Project status

| Area | Status |
|---|---|
| Database schema + seed data | **Main focus, done.** Migrations and seeders build a full sample dataset. |
| Scheduler (daily shift records, hours/tardiness/overtime) | Works. Verified: shift records created on `schedule:work`. |
| Employee Blade UI (login, dashboard, In/Out, timesheet, my account) | Works. Verified: all pages load after login. Dashboard tiles use placeholder icons. |
| Admin Blade UI (`/admin/*`) | **WIP.** CRUD pages exist and load, but the dashboard is a stub ("Welcome to the admin panel.") and several entities are missing (see 2). |
| Angular admin SPA | **WIP.** Compiles and runs; dashboard is a stub; covers only 6 entities; API URL hardcoded. |
| JSON API (`/api/*`) | Partial. Login works (verified). Only 6 entities exposed; no admin check. |
| Tests | None beyond generated examples. |

## 1. Repo hygiene

- [x] Removed stray files from the broken submodule merge (`"\r"`, `"shiftsync_backend/\r"`, empty `employeeRecordId`, `shiftSchedule`, `start_shift_time`).
- [x] Added `shiftsync_backend/.env.example`.
- [x] Removed stale `shiftsync_backend/README.md`, `shiftsync_frontend/README.md`, and `LARAVEL-AND-ANGULAR-SETUP.txt` (content moved to root README).
- [x] Removed unused `app/Http/Controllers/CutoffPeriodController.php` (empty, unrouted) and `resources/views/welcome.blade.php` (Laravel default, unrouted).
- [ ] Frontend `package.json` name is `aios` (old project name "IAOS"/"In and Out System").

## 2. Admin side (WIP)

- [ ] **Admin dashboards are stubs.** `resources/views/admins/dashboard.blade.php` and Angular `dashboard.component.html` only show a welcome message.
- [ ] **Entities with no admin UI anywhere:** cutoff periods, employee assigned cutoff periods, overtime rules, overtime, tardiness.
- [ ] **`Admin\CutoffPeriodController` is unrouted** and has no views. Add `Route::resource('/cutoff-periods', ...)` + views, or remove it.
- [ ] **Angular SPA gaps vs. Blade admin:** no addresses, emergency contacts, or employee shift records screens.
- [ ] **Angular `users.component.ts`** has add/view/edit handlers marked "not implemented here" (routing to the form components works separately).
- [ ] **Hardcoded API URL in Angular.** Every service in `shiftsync_frontend/src/app/services/` has `http://localhost:8000/api/...`. Create `src/environments/environment.ts` (does not exist yet) and read it from there.
- [ ] **Assigned-shift routes unguarded.** In `app-routing.module.ts`, `assigned-shifts`, `employee-assigned-shift/:id`, `add-employee-assigned-shift`, `edit-employee-assigned-shift/:id` lack `canActivate: [authGuard]`.
- [ ] **API not admin-restricted.** `/api/*` only requires `auth:sanctum`; any logged-in non-admin can CRUD users. Add an admin check.
- [x] Fixed: two Angular components (`employee-assigned-shift-detail`, `employee-assigned-shift-form`) referenced missing `.css` files instead of `.scss`, which broke `ng serve`.

## 3. Code / schema issues

- [ ] **`breaks` table has no migration.** `EmployeeShiftBreak` model and `BreaksSeeder` (inserts into `breaks`) exist, but no migration creates the table. `BreaksSeeder` is not called by `DatabaseSeeder`, so seeding still works. Either add a migration or remove the model + seeder.
- [ ] **`EmployeeAssignedCutoffPeriodSeeder` not wired** into `DatabaseSeeder`. Table `employee_assigned_cutoff_period` stays empty after `db:seed`.
- [ ] **Unused import of a missing class.** `app/Console/Commands/CreateEmployeeShiftRecord.php` imports `App\Jobs\ShiftJobs\AssignTimezoneJob`, which does not exist. Harmless (PHP `use` is lazy) but misleading; remove it.
- [ ] **Misleading param name.** `ShiftController` and `inout.blade.php` pass `employeeRecordId`, but the value is an `employee_shift_records.id`. Same in `CalculateHoursRenderedJob::$employeeRecordId`. Rename to `shiftRecordId`.
- [ ] **Null check after use.** `CalculateHoursRenderedJob::handle()` reads `$shiftRecord->employeeAssignedShift` before checking `if (!$shiftRecord)`. A missing record throws (caught and logged) instead of returning early.
- [ ] **Timesheet jobs run twice.** `ShiftController::endShift` dispatches hours/tardiness/overtime jobs, and `shift:check-end-times` dispatches them again every minute while `hours_rendered` is null. Pick one path.
- [ ] **`CalculateUndertime` job exists but is never dispatched.**
- [ ] **CORS wide open.** `config/cors.php` allows `*` origins. Fine locally; restrict before any deploy.
- [ ] **No real tests.** Only Laravel/Angular generated example tests.

## 4. Troubleshooting

| Symptom | Cause | Fix |
|---|---|---|
| `No application encryption key has been specified` | Missing `APP_KEY` | `php artisan key:generate` |
| `ERROR 1698 (28000): Access denied for user 'root'@'localhost'` | MariaDB root uses unix-socket auth | Create an app user: `sudo mysql -e "CREATE DATABASE IF NOT EXISTS inout_db; CREATE USER IF NOT EXISTS 'shiftsync'@'localhost' IDENTIFIED BY '<pw>'; GRANT ALL ON inout_db.* TO 'shiftsync'@'localhost';"` |
| `SQLSTATE[HY000] [1049] Unknown database 'inout_db'` | DB not created | See row above |
| `SQLSTATE[HY000] [2002] Connection refused` | MySQL/MariaDB not running (WSL) | `sudo service mariadb start` (or `mysql`) |
| `Failed to listen on 127.0.0.1:8000 (reason: Address already in use)` | Another app on :8000 | Stop it, or `php artisan serve --port=8001` (Angular still calls :8000) |
| Blade login bounces back to `/login` | Form field is `email_or_username`, not `email` | Use email or username (e.g. `AliceS`) in the login form |
| In/Out page has no buttons / no shift today | No `employee_shift_records` row for today | Run `php artisan schedule:work` and wait ~1 min, or `php artisan app:create-employee-shift-record` once |
| Hours/tardiness/overtime stay empty | Scheduler not running | `php artisan schedule:work`, or `php artisan shift:check-end-times` |
| Angular calls fail with CORS / `ERR_CONNECTION_REFUSED` | Backend not on `:8000` | Run `php artisan serve` on port 8000 |
| Angular `401` after it worked before | Stale Sanctum token in `localStorage.currentUser` | Log out, or clear `localStorage` |
| Redirected to `/login` with "Unauthorized access" on `/admin/*` | User `is_admin = false` | Log in as an admin seed account |
| Verification / reset emails never arrive | `MAIL_MAILER=log` | Check `storage/logs/laravel.log`, or configure SMTP |
| Schema changed and things break | Stale DB | `php artisan migrate:fresh --seed` (wipes all data) |
| `ng: command not found` | Angular CLI not installed | `npm install -g @angular/cli@16`, or `npx ng serve` |
