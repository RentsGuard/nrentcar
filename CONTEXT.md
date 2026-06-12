# RentsCar — Context Handoff

## Project
**Car Rental Management System** — Laravel 12, PHP 8.4.2, Tailwind v4, MySQL
**Stack**: Alpine.js, Chart.js, SweetAlert2, DOMPDF, OpenSpout, Intervention Image, Spatie Activitylog
**Auth**: Seeder-based (admin@gmail.com/123456, staff@gmail.com/123456), roles: admin/staff

## Branches & Status
| Branch | Owner | Status | Key Work |
|--------|-------|--------|----------|
| `aqsha` | Aqsha | ✅ Done | Auth, Layout, Dashboards, Staff CRUD, Landing, Errors, all UI, Deps |
| `zahra` | Zahra | ✅ Done | Seeders (Mobil, Customer, Penyewaan, Verifikasi), Tests (Auth, Mobil, Customer), CRUD completion Mobil/Penyewaan/Verifikasi |
| `gibran` | Gibran | ✅ Done | Laporan export (PDF/Excel/Cetak), Chart real data, Settings (Tampilan, Notifikasi, Role & Akses) |
| `nisrina` | Nisrina | ⏳ Pending | Pengembalian + Denda (branch `feature/tambah-data-denda`) |
| `haikal` | Haikal | ❌ Not started | Public car listing |

## Implemented Features
- ✅ Login/Logout + role redirect
- ✅ Admin/Staff Dashboard (6 stats + Chart.js)
- ✅ Staff CRUD (search, SWAL delete, reset pw, foto)
- ✅ Customer CRUD (full KTP 18 fields + foto_ktp)
- ✅ Mobil CRUD (foto, status sync)
- ✅ Penyewaan CRUD (dropdown customer/mobil, status→mobil sync)
- ✅ Verifikasi CRUD (dropdown customer, verifikator)
- ✅ Profile (foto profil, password)
- ✅ Laporan (4 stat cards, 2 real charts, export PDF/Excel, cetak)
- ✅ Pengaturan (Tampilan, Notifikasi, Role & Akses)
- ✅ Settings table + model
- ✅ Seeders: 8 mobil, 5 customer, 6 penyewaan, 5 verifikasi
- ✅ Tests: 13 feature tests passing

## DB Schema (14 tables)
- `users` (nama_user, role, foto_profil)
- `customers` (18 KTP fields + foto_ktp)
- `mobil`, `penyewaan`, `verifikasi` (singular tables)
- `settings` (key-value), `activity_log`, standard Laravel tables

## Key Config
- No `tailwind.config.js` — `@theme {}` in `resources/css/app.css`
- `@vite('resources/css/app.css')` only asset
- Dark theme: `#080808` bg, `#C1121F` accent
- Heroicons via `@svg('heroicon-s-...')`

## Git Identity (per branch)
- `zahra`: `Zahra <zahrahanena17@gmail.com>`
- `gibran`: Need email (Muhammad Gibran Pangestu, 2411083021)
- `aqsha`: `maaqsha@gmail.com`

## Left / Blockers
- `feature/tambah-data-denda` (Nisrina) — kampus, separate
- Public pages (Haikal) — unassigned
- Laporan charts use MySQL `DATE_FORMAT` (prod only)

## Commands
```bash
php artisan migrate:fresh --seed
php artisan test --filter=AuthTest,MobilTest,CustomerTest
```