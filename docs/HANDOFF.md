# RentsCar — Handoff

## Status

| Area | Status | Notes |
|------|--------|-------|
<<<<<<< HEAD
| Auth (Login, Logout) | ✅ | Throttle 5:1, role redirect |
| Layout (Sidebar + Navbar) | ✅ | Alpine.js, active glow, role badges |
| Admin Dashboard | ✅ | 6 stat cards, Chart.js |
| Staff Dashboard | ✅ | Same + staff greeting |
| Staff CRUD | ✅ | Search, SweetAlert2 delete, reset password |
| Landing + Error Pages | ✅ | Hero, car grid, 403/404 dark theme |
>>>>>>> feature/tambah-data-denda
| Customer CRUD | ✅ | KTP upload, activity log |
| Profile | ✅ | Foto profil, password |
| Mobil, Penyewaan, Verifikasi UI | ✅ | Views only — no CRUD logic |
| Laporan, Pengaturan UI | ✅ | Views only — no export logic |
| Pengembalian + Denda | ⏳ | Branch `feature/tambah-data-denda` |
| Dependency Integration | ✅ | Semua package terpakai minimal sekali |

> Semua views pake Tailwind v4 (no Bootstrap). Lihat `UIreference/` untuk referensi desain.

## Key Config

- **DB:** singular tables (`mobil`, `penyewaan`, `verifikasi`), field user `nama_user` (bukan `name`)
- **Roles:** `admin` + `staff` (no `user` role)
- **Tailwind:** v4 via `@theme {}` di CSS — no `tailwind.config.js`
- **CSS:** `@vite('resources/css/app.css')` di layout head
- **JS:** `resources/js/app.js` (Alpine, SweetAlert2, @fontsource/inter)
>>>>>>> feature/tambah-data-denda
=======
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
| Testing | ✅ | **35 tests, 66 assertions** — dedicated `rentscar_testing` DB |

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
- **Test DB:** `rentscar_testing` — isolated from production `rentscar`
- **DB default guard:** `config/database.php` default `'mysql'` (was `'sqlite'`); `AppServiceProvider` blocks silent SQLite fallback
>>>>>>> aqsha

## Credentials

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@gmail.com | [redacted] |
| Staff | staff@gmail.com | [redacted] |

## Stack

<<<<<<< HEAD
Laravel 12 / PHP 8.5.5 / Tailwind v4.3 / Vite 7.x / MySQL
=======
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

### 5. MySQL data loss on `php artisan test`
Three root causes found and resolved:
1. `phpunit.xml` `DB_DATABASE=rentscar` — `RefreshDatabase` runs `migrate:fresh`, wiping production data. → Changed to `rentscar_testing`.
2. `config/database.php` default `'sqlite'` — silent fallback if `.env` fails to load (empty SQLite DB). → Changed to `'mysql'`.
3. `composer.json` `post-create-project-cmd` auto-created `database/database.sqlite`. → Removed.
- **Guard:** `AppServiceProvider::boot()` throws `RuntimeException` if `config('database.default') === 'sqlite'` when `.env` specifies otherwise.

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

## Session 3 Context (22 Jun 2026)

Critical fixes:
- **MySQL data loss root causes resolved:**
  1. `phpunit.xml` pointed `DB_DATABASE=rentscar` → `RefreshDatabase` trait ran `migrate:fresh` on production DB — changed to `rentscar_testing`
  2. `config/database.php` default `sqlite` — Laravel silently fell back to empty SQLite if `.env` failed — changed to `mysql`
  3. `composer.json` auto-created `database/database.sqlite` on fresh install — removed
- **Guard:** `AppServiceProvider` throws `RuntimeException` if DB defaults to SQLite unexpectedly
- **27 `<select>` elements audited & fixed** — all use `bg-[#0D0D0D] text-white` with dark native popup (`color-scheme: dark` in app.css)
- **Public mobil filter:** kapasitas changed from `>=` to `=` exact match; options from DB dynamically
- **All 35 tests pass** against `rentscar_testing`, production data intact

UI/UX audit & fixes across all 42 views:
| Issue | Fix |
|-------|-----|
| `mobil/index` action buttons hidden on mobile | Changed `opacity-0` → `opacity-100 sm:opacity-0 sm:group-hover:opacity-100` |
| `admin/staff dashboard` card overflow (long Rp values) | Added `truncate max-w-full` + title tooltip |
| `laporan/index` Pendapatan/Denda overflow | Added `max-w-full truncate` + tooltip |
| `laporan/awal` alamat customer clipped | `max-w-[200px] xl:max-w-[260px]` |
| `laporan/awal` total sum overflow | Added `shrink min-w-0 truncate max-w-[180px]` |
| `laporan/akhir` date inputs bg inconsistent | `bg-white/[0.04]` → `bg-[#0D0D0D]` with focus shadow |
| `laporan/akhir` Trouble column inconsistent rows | `break-words` → `truncate` + title tooltip |
| `customer/index` pagination basic style | Replaced prev/next text with shared `partials.pagination` |
| `penyewaan/index` total harga overflow | `whitespace-nowrap max-w-[150px] truncate` + tooltip |
| `pengembalian/show` denda info overflow | Added `break-words` |
| `public/mobil/index` search bg inconsistent | `bg-white/[0.04]` → `bg-[#0D0D0D]` with focus shadow |

## Next Session Priority

1. ~~**Dashboard denda count** — `pengembalianHariIni` shows 0 when no returns today. Review if logic needs change.~~ ✅ Fixed
2. ~~**Manual test CRUD customer form** — verify all text inputs for provinsi/kota/kecamatan/kelurahan submit correctly.~~ 🔄 Still needed after wilayah text input changes.
3. ~~**Review `.env.example`** — ensure `SESSION_DRIVER=file`, `CACHE_STORE=file`, `QUEUE_CONNECTION=sync` reflected.~~ ✅ Done
4. **Consider deleting `docs/HANDOFF.md`** from git tracking (or keep as session handoff doc).
5. **If duplicate MySQL returns** — only click MySQL → Start once in Laragon UI.
6. (Optional) Run `sc.exe stop MySQL && sc.exe config MySQL start= disabled` as Admin to stop Windows MySQL service conflicting with Laragon.
7. **Jika ada `<select>` baru di view yang akan datang** — sudah di-cover oleh global `select { color-scheme: dark; }` + `select option { background: #0D0D0D; color: #fff; }` di app.css. Tidak perlu per-file styling tambahan.
>>>>>>> aqsha

## Security

- Auth + RoleMiddleware (`role:admin` / `role:staff`)
- CSRF active, throttle 5/min on login
<<<<<<< HEAD
>>>>>>> feature/tambah-data-denda
=======
- XSS protection (yieldContent, @json, titleText)
- Mass assignment protected (no $request->all())
- `password` cast: `'hashed'` in User model (detects bcrypt before re-hash)
>>>>>>> aqsha

## Team

| Member | Area | Progress |
|--------|------|----------|
<<<<<<< HEAD
| **Aqsha** | Auth, Layout, Dashboards, Staff CRUD, Landing, Errors, All UI views, Dependencies | ✅ |
| **Nisrina** | Customer, Mobil, Penyewaan, Verifikasi, Pengembalian CRUD | ⏳ Customer ✅, others: UI only |
| **Haikal** | Public pages | Need assignment |
| **Gibran** | Laporan, Export, Pengaturan | ⏳ UI only |
| **Zahra** | Schema docs, Seeders, Testing | Need assignment 
>>>>>>> feature/tambah-data-denda

## Left

- Store/update/destroy di Mobil, Penyewaan, Verifikasi, Pengembalian Controller
- Laporan export (PDF/Excel), Pengaturan functionality
- Public pages (Haikal), Testing & seeders (Zahra)

## Blocker

- `maatwebsite/excel` incompatible with PHP 8.5 → replaced with `openspout/openspout` ^5.7

## AI Prompts per Member

> Lihat file `docs/HANDOFF.md` versi sebelumnya atau konten di bawah untuk prompt length yang sudah dipakai tiap anggota. (Prompt dihapus dari file ini untuk menjaga ringkasnya — jika perlu, lihat riwayat git atau minta ke Aqsha)
>>>>>>> feature/tambah-data-denda
=======
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
>>>>>>> aqsha
