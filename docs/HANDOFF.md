# RentsCar — Handoff

## Status

| Area | Status | Notes |
|------|--------|-------|
| Auth | ✅ | Throttle 5:1, role redirect |
| Layout (Sidebar + Navbar) | ✅ | Alpine.js, active glow, logout sidebar |
| Admin Dashboard | ✅ | 7 stat cards, Chart.js |
| Staff Dashboard | ✅ | Same + staff greeting |
| Staff CRUD | ✅ | Admin-only, search, SWAL delete, reset pw, foto profil |
| Landing + Error Pages | ✅ | Hero, car grid from DB, 403/404 |
| Customer CRUD | ✅ | Full KTP fields, foto_ktp at top, activity log |
| Verifikasi | ✅ | Merged into Customer (status, verified_by, date, notes) |
| Profile | ✅ | Foto profil upload, password change |
| Mobil CRUD | ✅ | Foto upload, status sync, soft delete |
| Penyewaan CRUD | ✅ | Customer/mobil dropdowns, status sync, DB transaction |
| Pengembalian CRUD | ✅ | Auto-kalkulasi denda, marks selesai + mobil tersedia |
| Laporan | ✅ | 5 stat cards, 3 real Chart.js charts, exports (PDF/Excel) |
| Pengaturan | ✅ | Tampilan, Notifikasi, Role & Akses (admin only) |
| Export (PDF/XLSX) | ✅ | DOMPDF + OpenSpout v5 |
| Seeders | ✅ | 8 mobil, 5 customer, 6 penyewaan, verifikasi, pengembalian |
| Testing | ✅ | **35 tests, 66 assertions** |

> Views pake Tailwind v4 (no Bootstrap). Logo: `images/nrentcar.png`.

## Key Config

- **DB:** singular tables (`mobil`, `penyewaan`), field `nama_user` (not `name`)
- **Pengembalian model:** `protected $table = 'pengembalian'` (singular)
- **Roles:** `admin` + `staff`
- **Tailwind:** v4 via `@theme {}` in CSS — no `tailwind.config.js`
- **Assets:** `@vite('resources/css/app.css')` only
- **Logo:** `public/images/nrentcar.png` (132KB, PNG)
- **Session:** `SESSION_DRIVER=file` (changed from `database` — more reliable in dev)
- **DB engine:** Laragon MySQL 8.4.3, port 3306

## Credentials

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@gmail.com | 123456 |
| Staff | staff@gmail.com | 123456 |

## Stack

Laravel 12 / PHP 8.5.5 / Tailwind v4.3 / Vite 7.x / MySQL (Laragon)

## Known Issues & Fixes

### 1. Duplicate MySQL processes (Laragon bug)
Laragon occasionally spawns 2+ `mysqld.exe` processes.
- **Prevention:** In Laragon UI, only click MySQL → Start once.
- **Hardening:** `CACHE_STORE=file`, `QUEUE_CONNECTION=sync` to reduce MySQL write dependency.

### 2. Wilayah API cascade dropdown (REMOVED)
Alpine.js + morphdom reset `<select>` options when reactive data changed. All approaches (closure vars, direct DOM) failed because Alpine re-renders the select element on any parent reactive change.
- **Fix:** Replaced all 4 wilayah `<select>` with `<input type="text">` fields. User types manually. No API dependency, no Alpine, always clickable.
- Applies to both `create.blade.php` and `edit.blade.php`

### 3. Login session lost on serve restart
`SESSION_DRIVER=database` caused sessions to vanish when MySQL had issues.
- **Fix:** Changed to `SESSION_DRIVER=file` — sessions stored on disk, survive `php artisan serve` restart.

### 4. Composer cleanup
Removed unused packages: `laravel/breeze`, `laravel/sanctum`, `livewire/livewire`.
Deleted `config/sanctum.php`.

## Current Session Context (21 Jun 2026)

Key work done:
- Migrated XAMPP MySQL → Laragon MySQL
- Updated seed date range: 1 Jun – 30 Jul 2026
- Fixed wilayah dropdown (replaced with text inputs)
- Fixed MySQL duplicate process issue
- Changed session driver to `file`
- Cleaned composer dependencies
- All 35 tests passing

## Session 2 Context (21 Jun 2026)

- **Hardening:** `.env`: `CACHE_STORE=database` → `file`, `QUEUE_CONNECTION=database` → `sync`.
  - No extra files needed. Default Laragon setup.
- **UI fixes:**
  - Dropdown text invisible → added `select { color-scheme: dark; }` in app.css
  - Search button text "Cari" removed, icon only
  - "Kapasitas/Kursi" → "Baris" (all views)
  - Price gradient box in admin mobil card simplified (drop-shadow instead of gradient overlay)
  - PNG image support: validation already allows PNG (`mimes:jpeg,png,jpg`), storage link verified working

## Next Session Priority

1. ~~**Dashboard denda count** — `pengembalianHariIni` shows 0 when no returns today. Review if logic needs change.~~ ✅ Fixed — counts both `tanggal_pengembalian` today OR `denda_lunas_at` today.
2. ~~**Manual test CRUD customer form** — verify all text inputs for provinsi/kota/kecamatan/kelurahan submit correctly.~~ 🔄 Still needed after wilayah text input changes.
3. ~~**Review `.env.example`** — ensure `SESSION_DRIVER=file`, `CACHE_STORE=file`, `QUEUE_CONNECTION=sync` reflected.~~ ✅ Done
4. **Consider deleting `docs/HANDOFF.md`** from git tracking (or keep as session handoff doc).
5. **If duplicate MySQL returns** — only click MySQL → Start once in Laragon UI.

## Security

- Auth + RoleMiddleware (`role:admin` / `role:staff`)
- CSRF active, throttle 5/min on login
- XSS protection (yieldContent, @json, titleText)
- Mass assignment protected (no $request->all())
- `password` cast: `'hashed'` in User model (detects bcrypt before re-hash)

## Team

| Member | Area | Progress |
|--------|------|----------|
| **Aqsha** | Auth, Layout, Dashboards, Staff CRUD, Landing, Errors, All UI views | ✅ |
| **Nisrina** | Customer, Mobil, Penyewaan, Verifikasi, Pengembalian CRUD | ✅ |
| **Haikal** | Public pages, API integration | ⏳ |
| **Gibran** | Laporan, Export, Pengaturan | ✅ |
| **Zahra** | Schema docs, Seeders, Testing | ✅ |

## Left / Blocker

- `maatwebsite/excel` incompatible with PHP 8.5 → replaced with `openspout/openspout` ^5.7
- Obsolete packages removed: `laravel/breeze`, `laravel/sanctum`, `livewire/livewire`
- Wilayah API dropdown removed entirely due to Alpine morphdom incompatibility
- Two Laragon MySQL processes may cause connection issues — only click MySQL → Start once
