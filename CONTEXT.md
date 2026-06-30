# RentsCar — Context Handoff

## Project
**Car Rental Management System** — Laravel 12, PHP 8.4.2, Tailwind v4, MySQL
**Stack**: Alpine.js, Chart.js, SweetAlert2, DOMPDF, Spatie Activitylog
**Auth**: Seeder-based (admin@gmail.com/123456, staff@gmail.com/123456), roles: admin/staff

## Branches & Status
| Branch | Owner | Status | Key Work |
|--------|-------|--------|----------|
| `aqsha` | Aqsha | ✅ Done | Auth, Layout, Dashboards, Staff CRUD, Landing, Errors, UI, Deps, logo, audit, refactor |
| `zahra` | Zahra | ✅ Done | Seeders, Tests, CRUD completion |
| `gibran` | Gibran | ✅ Done | Laporan export (PDF), Chart real data, Settings |
| `nisrina` | Nisrina | ⏳ Pending | Pengembalian + Denda (branch `feature/tambah-data-denda`) |
| `haikal` | Haikal | ❌ Not started | Public car listing |

## Implemented Features
- ✅ Login/Logout + role redirect (throttle: 5/min)
- ✅ Admin/Staff Dashboard (7 stats + real Chart.js charts)
- ✅ Staff CRUD (admin-only, search, SWAL delete, reset pw, foto)
- ✅ Customer CRUD (full KTP 18 fields + foto_ktp at top + verification)
- ✅ Mobil CRUD (foto, status sync, tipe_mobil: Matic/Manual, visibility)
- ✅ Penyewaan CRUD (dropdown customer/mobil, auto-calc, status sync)
- ✅ Verifikasi merged into Customer (status, verified_by, tanggal, catatan)
- ✅ Pengembalian CRUD (manual + auto denda calc, marks selesai)
- ✅ Profile (foto profil, password with current_password check)
- ✅ Laporan (4 stat cards, 2 real charts, PDF export, date filter)
- ✅ Pengaturan (Tampilan, Notifikasi, Role & Akses — admin only)
- ✅ Public car listing + detail with WhatsApp booking
- ✅ Landing page with hero, car grid, Leaflet map
- ✅ Settings table + model
- ✅ Activity log (Spatie)
- ✅ Seeders: 8 mobil, 5 customer, 6 penyewaan, pengembalian
- ✅ Tests: 39 passing (77 assertions)
- ✅ Logo: `images/nrentcar.png`
- ✅ File input dark styling
- ✅ Submit buttons disable on click (anti-double-click)
- ✅ Pagination on all list views (15/page)
- ✅ Validation feedback on all forms

## DB Schema (12 tables)
- `users` (nama_user, role, foto_profil)
- `customers` (18 KTP fields + foto_ktp + status_verifikasi, verified_by, tanggal_verifikasi, catatan_verifikasi)
- `mobil`, `penyewaan`, `pengembalian`, `settings`, `activity_log`, standard Laravel tables

## Permissions
- Staff cannot delete anything (all destroy routes admin-only)
- Staff cannot toggle mobil visibility (admin-only)
- Delete button only on Mobil and Staff pages (admin-only)
- Staff cannot manage staff (admin middleware)
- Staff cannot access role-akses page
- Admin can verify customers via Customer edit/show
- Profile password change requires current_password

## Code Quality
- Extracted `calculateDenda()` in PengembalianController (DRY)
- Extracted `applySearchFilter()` + `applyDateFilter()` in LaporanController (DRY)
- MobilController uses $validated directly (no redundant $data arrays)
- All models have query scopes (verified, tersedia, visible)
- Pengembalian model has `user()` relationship
- Mobil model has `foto_mobil_url` accessor

## Dependencies
- Composer: 11 required, 6 dev (removed: intervention/image, openspout/openspout, debugbar, sail)
- NPM: 3 dependencies, 5 devDependencies (removed: axios, chart.js)

## Key Config
- No `tailwind.config.js` — `@theme {}` in `resources/css/app.css`
- `@vite('resources/css/app.css')` only asset
- Dark theme: `#080808` bg, `#C1121F` accent
- `app/Models/Pengembalian.php` has `protected $table = 'pengembalian'`

## Commands
```bash
php artisan migrate:fresh --seed
php artisan test
composer run dev    # dev server
```
