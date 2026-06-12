# RentsCar — Context Handoff

## Project
**Car Rental Management System** — Laravel 12, PHP 8.4.2, Tailwind v4, MySQL
**Stack**: Alpine.js, Chart.js, SweetAlert2, DOMPDF, OpenSpout, Intervention Image, Spatie Activitylog
**Auth**: Seeder-based (admin@gmail.com/123456, staff@gmail.com/123456), roles: admin/staff

## Branches & Status
| Branch | Owner | Status | Key Work |
|--------|-------|--------|----------|
| `aqsha` | Aqsha | ✅ Done | Auth, Layout, Dashboards, Staff CRUD, Landing, Errors, all UI, Deps, logo, cleanup |
| `zahra` | Zahra | ✅ Done | Seeders, Tests, CRUD completion |
| `gibran` | Gibran | ✅ Done | Laporan export (PDF/Excel), Chart real data, Settings |
| `nisrina` | Nisrina | ⏳ Pending | Pengembalian + Denda (branch `feature/tambah-data-denda`) |
| `haikal` | Haikal | ❌ Not started | Public car listing |

## Implemented Features
- ✅ Login/Logout + role redirect
- ✅ Admin/Staff Dashboard (6 stats + Chart.js)
- ✅ Staff CRUD (admin-only, search, SWAL delete, reset pw, foto)
- ✅ Customer CRUD (full KTP 18 fields + foto_ktp at top)
- ✅ Mobil CRUD (foto, status sync, tipe_mobil: Matic/Manual)
- ✅ Penyewaan CRUD (dropdown customer/mobil, status→mobil sync, no "menunggu")
- ✅ Verifikasi merged into Customer (status_verifikasi, verified_by, tanggal_verifikasi, catatan)
- ✅ Pengembalian CRUD (manual denda input, marks penyewaan selesai + mobil tersedia)
- ✅ Profile (foto profil, password)
- ✅ Laporan (4 stat cards, 2 real charts, export PDF/Excel, no Cetak)
- ✅ Pengaturan (Tampilan, Notifikasi, Role & Akses — admin only)
- ✅ Settings table + model
- ✅ Seeders: 8 mobil, 5 customer, 6 penyewaan, 5 verifikasi (sets customers table)
- ✅ Tests: 14 feature tests passing (31 assertions)
- ✅ Logo: `images/nrentcar.png` (enlarged, no box/border)
- ✅ File input dark styling (`resources/css/app.css`)

## DB Schema (13 tables)
- `users` (nama_user, role, foto_profil)
- `customers` (18 KTP fields + foto_ktp + status_verifikasi, verified_by, tanggal_verifikasi, catatan_verifikasi)
- `mobil`, `penyewaan`, `pengembalian`, `settings`, `activity_log`, standard Laravel tables

## Key Config
- No `tailwind.config.js` — `@theme {}` in `resources/css/app.css`
- `@vite('resources/css/app.css')` only asset
- Dark theme: `#080808` bg, `#C1121F` accent
- Heroicons via `@svg('heroicon-s-...')`

## Git Identity (per branch)
- `zahra`: `Zahra <zahrahanena17@gmail.com>`
- `gibran`: Need email (Muhammad Gibran Pangestu, 2411083021)
- `aqsha`: `maaqsha@gmail.com`

## Notes
- `app/Models/Pengembalian.php` has `protected $table = 'pengembalian'` (singular)
- Logo file: `public/images/nrentcar.png` (132KB, PNG)
- Staff cannot: delete mobil (403), manage staff (admin middleware), verify customers (admin middleware), access role-akses (admin middleware)
- Admin can verify customers inside Customer edit/show pages (dropdown + approve/reject)
- Verifikasi controller/model/views/routes fully deleted

## Commands
```bash
php artisan migrate:fresh --seed
php artisan test
```
