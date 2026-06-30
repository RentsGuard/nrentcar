# NrentCar — Car Rental Management System

A full-featured car rental management system built with Laravel 12. Manage cars, customers, rentals, returns, fines, and reports — all in one place.

## Features

- **Auth & Roles** — Admin/Staff login with role-based redirect (throttle: 5/min)
- **Dashboard** — 7 stat cards + real Chart.js charts (revenue, rentals)
- **Staff Management** — Admin-only CRUD, password reset, foto profil
- **Customer Management** — Full KTP fields (18 fields), foto_ktp upload, verification workflow
- **Car Management** — CRUD with foto upload, tipe_mobil (Matic/Manual), visibility toggle
- **Rental (Penyewaan)** — Customer/mobil dropdowns, auto-calc duration & price, status sync
- **Returns (Pengembalian)** — Manual fine input, auto-calc late fees, marks rental complete
- **Reports** — Stat cards, real Chart.js charts, PDF export (DOMPDF), date filtering
- **Settings** — Appearance (name, description, accent color), notifications, role access (admin)
- **Activity Log** — Spatie Activitylog tracks all actions
- **Public Pages** — Car listing + detail with WhatsApp booking link
- **Responsive** — Dark theme with Tailwind CSS v4 + Alpine.js

## Tech Stack

| Layer | Technology |
|-------|-----------|
| Backend | Laravel 12, PHP 8.4.2 |
| Frontend | Blade, Tailwind CSS v4, Alpine.js, Chart.js |
| Database | MySQL 8.4 (Laragon) |
| Build | Vite 7, Node 22 |
| Auth | Session-based, custom RoleMiddleware |
| PDF | DOMPDF |
| Activity Log | Spatie Activitylog |
| Icons | Bootstrap Icons + Blade Heroicons |
| Notifications | SweetAlert2 |

## Project Structure

```
app/
├── Http/
│   ├── Controllers/    # 13 controllers
│   └── Middleware/      # RoleMiddleware
├── Models/              # 6 models (User, Customer, Mobil, Penyewaan, Pengembalian, Setting)
├── Providers/           # AppServiceProvider
bootstrap/
├── app.php              # Middleware registration
├── providers.php
config/                  # 11 config files
database/
├── migrations/          # 18 migration files
├── seeders/             # 7 seeders
├── factories/           # 5 factories
resources/
├── views/               # 41 Blade views
├── css/                 # app.css (Tailwind v4 theme)
├── js/                  # app.js (Alpine, SweetAlert2, Fontsource)
routes/
└── web.php              # All routes
tests/
├── Feature/             # 7 feature test files
├── Unit/                # 1 unit test
```

## Installation

### Prerequisites

- PHP 8.2+
- Composer
- Node.js 20+
- MySQL 8+
- Laragon (recommended on Windows)

### Setup

```bash
# Clone
git clone https://github.com/your-org/nrentcar.git
cd nrentcar

# Install PHP dependencies
composer install

# Install Node dependencies
npm install

# Environment
cp .env.example .env
php artisan key:generate

# Database
# Create MySQL database 'nrentcar'
# Update .env: DB_DATABASE=nrentcar, DB_USERNAME=root, DB_PASSWORD=

# Migrate & seed
php artisan migrate:fresh --seed

# Build frontend
npm run build

# Create storage link
php artisan storage:link

# Start
php artisan serve
```

## Environment Variables

| Variable | Default | Description |
|----------|---------|-------------|
| `APP_NAME` | NrentCar | Application name |
| `APP_ENV` | production | Environment (local/production) |
| `APP_DEBUG` | false | Debug mode |
| `APP_URL` | http://nrentcar.test | App URL |
| `DB_DATABASE` | nrentcar | Database name |
| `DB_USERNAME` | root | Database user |
| `DB_PASSWORD` | (empty) | Database password |
| `SESSION_DRIVER` | file | Session storage |
| `ADMIN_WA_NUMBER` | 6282284611795 | WhatsApp number for booking |

## Database

Run fresh seed:

```bash
php artisan migrate:fresh --seed
```

Seed data:
- **Users**: Admin (admin@gmail.com / 123456), Staff (staff@gmail.com / 123456)
- **Mobil**: 8 cars (various types)
- **Customers**: 5 verified customers
- **Penyewaan**: 6 rental records
- **Pengembalian**: Matching returns

## Running Locally

```bash
# Dev server with Vite
composer run dev

# Or separately
php artisan serve
npm run dev
```

## Build Commands

```bash
npm run build    # Production build
npm run dev      # Dev build with HMR
```

## Testing

```bash
# Run all tests
php artisan test

# Specific test suite
php artisan test --filter=MobilTest

# Tests use isolated 'rentscar_testing' database
```

**39 tests, 77 assertions** — Auth, Authorization, Customer, Mobil, Penyewaan, Pengembalian, Cetak.

## Deployment

### Production Checklist

1. Set `APP_ENV=production`, `APP_DEBUG=false` in `.env`
2. Set `SESSION_DRIVER=file` (or `database` with encrypted sessions)
3. Set `APP_URL` to your domain
4. Run `php artisan route:cache`, `php artisan config:cache`
5. Run `php artisan storage:link`
6. Set up cron for `php artisan schedule:run`
7. Use HTTPS (set `SESSION_SECURE_COOKIE=true`)

## Troubleshooting

| Issue | Fix |
|-------|-----|
| Login session lost on restart | `SESSION_DRIVER=file` (not `database`) |
| Duplicate MySQL processes | Click MySQL → Start once in Laragon |
| Wilayah API not loading | API fallback: type address manually |
| Tests wipe production DB | Tests use `rentscar_testing` database |

## GitHub Actions

`.github/workflows/laravel-check.yml` runs on push/PR to `main`:

- `composer install`
- `npm install && npm run build`
- Laravel Pint (PSR-12 lint)
- PHPUnit tests

## License

MIT
