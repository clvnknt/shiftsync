# ShiftSync

ShiftSync is an employee shift-scheduling and time-tracking system. Employees clock in/out (start shift, lunch start/end, end shift); the backend computes hours rendered, tardiness and overtime per shift, per employee timezone.

The repo is a monorepo with two apps:

| Directory | Stack | Who uses it | Default URL |
|---|---|---|---|
| `shiftsync_backend/` | Laravel 10 (PHP 8.1+), MySQL, Sanctum, Blade views | Employees (Blade UI) + Laravel admin panel + JSON API | http://localhost:8000 |
| `shiftsync_frontend/` | Angular 16, Angular Material, ng-bootstrap | Admin SPA (talks to the backend API), **WIP** | http://localhost:4200 |

## Features

- **Employee portal (Blade):** dashboard, In/Out clock page, timesheet, my-account.
- **Admin panel (Blade, `/admin/*`, WIP):** CRUD for users, departments, roles, addresses, emergency contacts, shift schedules, employee records, assigned shifts, shift records.
- **Admin SPA (Angular, WIP):** CRUD for users, departments, roles, shift schedules, employee records, assigned shifts via `/api/*`.
- **Scheduled automation:** every minute, creates the day's shift records per employee and computes hours/tardiness/overtime for finished shifts.
- **Auth:** session login (Blade), Sanctum tokens (API), email verification, forgot/reset password.

## Project structure

```
shiftsync/
├── README.md, CLAUDE.md, HEALING.md
├── shiftsync_backend/                 Laravel app
│   ├── app/
│   │   ├── Console/Kernel.php         scheduler (2 commands, every minute)
│   │   ├── Console/Commands/          app:create-employee-shift-record, shift:check-end-times
│   │   ├── Http/Controllers/          Blade controllers (root), Admin/ (admin CRUD), Api*Controller (JSON API)
│   │   ├── Http/Middleware/           AdminMiddleware (is_admin check), CorsMiddleware
│   │   ├── Jobs/ShiftJobs/            create/order/dedupe shift records, start/end shift & lunch
│   │   ├── Jobs/TimesheetJobs/        hours rendered, tardiness, overtime, undertime
│   │   └── Models/                    Eloquent models
│   ├── database/migrations, seeders/  schema + dummy data
│   ├── resources/views/               employees/, admins/, auth/, layouts/
│   ├── routes/web.php                 Blade routes (employee + /admin)
│   ├── routes/api.php                 Sanctum API used by Angular
│   └── .env.example                   copy to .env
└── shiftsync_frontend/                Angular admin SPA
    └── src/app/
        ├── components/                list / detail / form component per entity
        ├── services/                  HTTP services (API base hardcoded to http://localhost:8000/api)
        ├── guards/auth.guard.ts
        └── auth.interceptor.ts
```

## Data model (core)

```
users ─1:1─ employee_records ─┬─ departments ── roles
                              ├─ addresses, emergency_contacts
                              ├─ employee_assigned_shifts ── shift_schedules
                              ├─ employee_shift_records ─┬─ tardiness
                              │                          └─ overtime
                              └─ employee_assigned_cutoff_period ── cutoff_periods
overtime_rules (standalone)
```

Timezones are stored as UTC offsets (e.g. `+08:00`) on `employee_records.employee_timezone` and `shift_schedules.shift_timezone`. App timezone is `UTC`.

## Prerequisites

- PHP 8.1+ and Composer
- MySQL 8 (or MariaDB)
- Node.js 18/20 + npm
- Angular CLI 16: `npm install -g @angular/cli@16`

## Setup

### 1. Backend

```bash
cd shiftsync_backend
composer install
npm install            # only needed for Vite assets
cp .env.example .env   # then set DB_USERNAME / DB_PASSWORD
php artisan key:generate
```

Create the database and an app user (MariaDB/MySQL root on Ubuntu/WSL usually needs `sudo`):

```bash
sudo mysql -e "CREATE DATABASE IF NOT EXISTS inout_db; CREATE USER IF NOT EXISTS 'shiftsync'@'localhost' IDENTIFIED BY '<password>'; GRANT ALL ON inout_db.* TO 'shiftsync'@'localhost';"
```

Put that password in `.env` as `DB_PASSWORD`, then migrate and seed:

```bash
php artisan migrate
php artisan db:seed
```

### 2. Run the backend (two terminals)

```bash
php artisan serve          # http://localhost:8000
php artisan schedule:work  # required: creates daily shift records + computes timesheet values
```

Without `schedule:work`, the In/Out page has no shift record to clock against.

### 3. Frontend (admin SPA)

```bash
cd shiftsync_frontend
npm install
ng serve                   # http://localhost:4200
```

## Seeded accounts (local dev only)

| Name | Email | Password | Admin |
|---|---|---|---|
| JohnD | johnd@example.com | password123 | yes |
| JaneD | janed@example.com | password123 | yes |
| AliceS | alices@example.com | password123 | no |
| BobJ | bobj@example.com | password123 | no |

Admins: Blade admin at `/admin/dashboard`, or the Angular SPA. Employees: `/login` then `/inout`.

## Tests

```bash
cd shiftsync_backend && php artisan test   # only Laravel example tests exist
cd shiftsync_frontend && ng test           # Angular CLI-generated spec stubs
```

## Project status

The database structure and seed data were the main focus. The employee Blade UI and scheduler work; the admin side (Blade `/admin` and the Angular SPA) is a work in progress. See `HEALING.md` for the full status table and known issues.

## Further reading

- `CLAUDE.md`: conventions and gotchas for working in this codebase.
- `HEALING.md`: known issues, repo cleanup items, and troubleshooting.
