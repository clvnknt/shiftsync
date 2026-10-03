# HEALING.md

Known issues, cleanup items and troubleshooting for ShiftSync. Found while revisiting the project on 2026-10-03. Tick items off (or delete them) as they are fixed.

## 1. Repo hygiene

- [ ] **Stray files from a broken submodule merge.** Delete these tracked junk files:
  - `"\r"` (repo root, file literally named carriage-return)
  - `"shiftsync_backend/\r"`
  - `shiftsync_backend/employeeRecordId`, `shiftsync_backend/shiftSchedule`, `shiftsync_backend/start_shift_time` (all empty; likely accidental shell redirects)
  ```bash
  git rm $'\r' $'shiftsync_backend/\r' shiftsync_backend/employeeRecordId shiftsync_backend/shiftSchedule shiftsync_backend/start_shift_time
  ```
- [ ] **`.env.example` missing.** `cp .env.example .env` in the setup fails. Add one (template below).
- [ ] **Duplicate / stale READMEs.** `shiftsync_backend/README.md` is a copy of the old root README (mentions a non-existent `docs` folder). `shiftsync_frontend/README.md` is the Angular CLI default (project still named `aios`). Replace both with a pointer to the root README.
- [ ] **`LARAVEL-AND-ANGULAR-SETUP.txt`** contained a personal email address (now removed) and a sample DB password. Its content now lives in the root README; remove or scrub it.
- [ ] Frontend `package.json` name is `aios` (old project name "IAOS"/"In and Out System").

### `.env.example` template

```dotenv
APP_NAME=ShiftSync
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inout_db
DB_USERNAME=root
DB_PASSWORD=

QUEUE_CONNECTION=sync
SESSION_DRIVER=file
CACHE_DRIVER=file

MAIL_MAILER=log
MAIL_HOST=
MAIL_PORT=587
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME="Support Team"
```

## 2. Code / schema issues

- [ ] **`breaks` table has no migration.** `EmployeeShiftBreak` model and `BreaksSeeder` (inserts into `breaks`) exist, but no migration creates the table. `BreaksSeeder` is not called by `DatabaseSeeder`, so seeding still works. Either add a migration or remove the model + seeder.
- [ ] **`EmployeeAssignedCutoffPeriodSeeder` not wired** into `DatabaseSeeder`. Table `employee_assigned_cutoff_period` stays empty after `db:seed`.
- [ ] **Unused import of a missing class.** `app/Console/Commands/CreateEmployeeShiftRecord.php` imports `App\Jobs\ShiftJobs\AssignTimezoneJob`, which does not exist. Harmless (PHP `use` is lazy) but misleading; remove it.
- [ ] **Misleading param name.** `ShiftController` and `inout.blade.php` pass `employeeRecordId`, but the value is an `employee_shift_records.id`. Same in `CalculateHoursRenderedJob::$employeeRecordId`. Rename to `shiftRecordId`.
- [ ] **Null check after use.** `CalculateHoursRenderedJob::handle()` reads `$shiftRecord->employeeAssignedShift` before checking `if (!$shiftRecord)`. A missing record throws (caught and logged) instead of returning early.
- [ ] **Timesheet jobs run twice.** `ShiftController::endShift` dispatches hours/tardiness/overtime jobs, and `shift:check-end-times` dispatches them again every minute while `hours_rendered` is null. Pick one path.
- [ ] **`CalculateUndertime` job exists but is never dispatched.**
- [ ] **Hardcoded API URL in Angular.** Every service in `shiftsync_frontend/src/app/services/` has `http://localhost:8000/api/...`. Create `src/environments/environment.ts` (does not exist yet) and read it from there.
- [ ] **Assigned-shift routes unguarded.** In `app-routing.module.ts`, `assigned-shifts`, `employee-assigned-shift/:id`, `add-employee-assigned-shift`, `edit-employee-assigned-shift/:id` lack `canActivate: [authGuard]`.
- [ ] **API not admin-restricted.** `/api/*` only requires `auth:sanctum`; any logged-in non-admin can CRUD users. Add an admin check.
- [ ] **CORS wide open.** `config/cors.php` allows `*` origins. Fine locally; restrict before any deploy.
- [ ] **No real tests.** Only Laravel/Angular generated example tests.

## 3. Troubleshooting

| Symptom | Cause | Fix |
|---|---|---|
| `cp: cannot stat '.env.example'` | File not committed | Use the template above |
| `No application encryption key has been specified` | Missing `APP_KEY` | `php artisan key:generate` |
| `SQLSTATE[HY000] [1049] Unknown database 'inout_db'` | DB not created | `mysql -u root -p -e "CREATE DATABASE inout_db"` |
| `SQLSTATE[HY000] [2002] Connection refused` | MySQL not running (WSL) | `sudo service mysql start` |
| In/Out page has no buttons / no shift today | No `employee_shift_records` row for today | Run `php artisan schedule:work` and wait ~1 min, or `php artisan app:create-employee-shift-record` once |
| Hours/tardiness/overtime stay empty | Scheduler not running | `php artisan schedule:work`, or `php artisan shift:check-end-times` |
| Angular calls fail with CORS / `ERR_CONNECTION_REFUSED` | Backend not on `:8000` | Run `php artisan serve` (default port 8000) |
| Angular `401` after it worked before | Stale Sanctum token in `localStorage.currentUser` | Log out, or clear `localStorage` |
| Redirected to `/login` with "Unauthorized access" on `/admin/*` | User `is_admin = false` | Log in as an admin seed account |
| Verification / reset emails never arrive | `MAIL_MAILER=log` | Check `storage/logs/laravel.log`, or configure SMTP |
| Schema changed and things break | Stale DB | `php artisan migrate:fresh --seed` (wipes all data) |
| `ng: command not found` | Angular CLI not installed | `npm install -g @angular/cli@16`, or `npx ng serve` |
