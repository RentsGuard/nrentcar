# RentsCar — Handoff

## Status

| Area | Status | Notes |
|------|--------|-------|
| Auth | ✅ | Throttle 5:1, role redirect |
| Layout (Sidebar + Navbar) | ✅ | Alpine.js, active glow, role badges |
| Admin Dashboard | ✅ | 6 stat cards, Chart.js real data |
| Staff Dashboard | ✅ | Same + staff greeting |
| Staff CRUD | ✅ | Admin-only, search, SWAL delete, reset pw, foto profil |
| Landing + Error Pages | ✅ | Hero, car grid from DB, 403/404 |
| Customer CRUD | ✅ | Full KTP fields, foto_ktp at top, activity log |
| Verifikasi | ✅ | Merged into Customer (status, verified_by, date, notes) |
| Profile | ✅ | Foto profil upload, password change |
| Mobil CRUD | ✅ | Foto upload, tipe_mobil Matic/Manual, status sync |
| Penyewaan CRUD | ✅ | Customer/mobil dropdowns, status → mobil sync, no "menunggu" |
| Pengembalian CRUD | ✅ | Manual denda input, marks selesai + mobil tersedia |
| Laporan | ✅ | 4 stat cards, 2 real Chart.js charts, exports (PDF/Excel), no Cetak |
| Pengaturan | ✅ | Tampilan, Notifikasi, Role & Akses (admin only) |
| Export (PDF/XLSX) | ✅ | DOMPDF + OpenSpout v5 |
| Seeders | ✅ | 8 mobil, 5 customer, 6 penyewaan (sets customers.verified) |
| Testing | ✅ | 14 feature tests, 31 assertions |

## Permissions

- Staff cannot delete anything (all destroy routes admin-only)
- Delete button only on Mobil and Staff pages (admin-only)
- Staff cannot: manage staff (admin middleware), access role-akses page
- Admin verify customers via Customer edit/show pages (dropdown + approve/reject)

## Key Config

- **DB:** singular tables (`mobil`, `penyewaan`, `pengembalian`), field `nama_user`
- **Pengembalian model:** `protected $table = 'pengembalian'`
- **Roles:** `admin` + `staff`
- **Tailwind:** v4 via `@theme {}` in CSS — no `tailwind.config.js`
- **Assets:** `@vite('resources/css/app.css')` only
- **Logo:** `public/images/nrentcar.png` (PNG)
- **Session:** `SESSION_DRIVER=file`
- **DB engine:** Laragon MySQL 8.4.3, port 3306
- **Test DB:** `rentscar_testing` — isolated from `rentscar`

## Credentials

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@gmail.com | 123456 |
| Staff | staff@gmail.com | 123456 |

## Stack

Laravel 12 · PHP 8.4.2 · Tailwind v4.3 · Vite 7 · MySQL
Alpine.js · Chart.js · SweetAlert2 · DOMPDF · OpenSpout · Intervention Image · Spatie Activitylog

## Known Issues & Fixes

### 1. Duplicate MySQL processes (Laragon bug)
Click MySQL → Start once. `CACHE_STORE=file`, `QUEUE_CONNECTION=sync` reduces dependency.

### 2. Wilayah API cascade dropdown (REMOVED)
Alpine morphdom broke `<select>` on reactive change. Replaced with `<input type="text">`.

### 3. Login session lost on serve restart
Fixed: `SESSION_DRIVER=database` → `file`.

### 4. Composer cleanup
Removed: `laravel/breeze`, `laravel/sanctum`, `livewire/livewire`. Deleted `config/sanctum.php`.

### 5. MySQL data loss on `php artisan test`
- `phpunit.xml` `DB_DATABASE=rentscar` → `rentscar_testing`
- `config/database.php` default `sqlite` → `mysql`
- Removed `composer.json` auto-created `database/database.sqlite`
- `AppServiceProvider` throws if DB defaults to SQLite unexpectedly

## Session History

### Session 1 (21 Jun)
- Migrated XAMPP → Laragon MySQL
- Updated seed dates: 1 Jun – 30 Jul 2026
- Wilayah dropdown → text inputs
- Session driver → file
- Composer deps cleanup
- All 35 tests passing

### Session 2 (21 Jun)
- `CACHE_STORE=database` → `file`, `QUEUE_CONNECTION=database` → `sync`
- `<select>` dark styling via `color-scheme: dark`
- Search button text "Cari" → icon only
- "Kapasitas/Kursi" → "Baris" (all views)
- Price gradient box simplified

### Session 3 (22 Jun)
- MySQL data loss root causes fixed (test DB isolation, default guard, SQLite removal)
- All `<select>` elements audited (27 total) — dark theme
- Public mobil filter kapasitas: `>=` → `=` exact match
- All 35 tests pass, production data intact
- UI/UX audit across 42 views (overflow, truncation, pagination, consistency)

### Session 4 (30 Jun)
- Verifikasi merged into customers table (controller/model/views/migrations deleted)
- Pengembalian CRUD restored
- Laporan Cetak removed
- Excel export fixed to OpenSpout v5 `Row::fromValuesWithStyle`
- Staff permissions: admin-only for all deletes
- tipe_mobil: Matic/Manual
- foto_ktp moved to top in customer form
- Denda removed from settings
- Logo: `nrentcar.png` (no box, enlarged)
- "menunggu" removed from penyewaan status
- Delete buttons removed from Customer, Pengembalian pages (only Mobil + Staff remain)
- All 14 tests pass

## Left / Blocker

- Public car listing (Haikal — not started)
- Auto-calculate denda (deferred to mini hackathon)
- `openspout/openspout` ^5.7 used (maatwebsite/excel incompatible with PHP 8.5)
