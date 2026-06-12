# RentsCar — Handoff

## Status

| Area | Status | Notes |
|------|--------|-------|
| Auth | ✅ | Throttle 5:1, role redirect |
| Layout (Sidebar + Navbar) | ✅ | Alpine.js, active glow, logout sidebar |
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
| Laporan | ✅ | 4 stat cards, 2 real Chart.js charts, exports (PDF/Excel) |
| Pengaturan | ✅ | Tampilan, Notifikasi, Role & Akses (admin only) |
| Export (PDF/XLSX) | ✅ | DOMPDF + OpenSpout v5, Excel uses Row::fromValuesWithStyle |
| Seeders | ✅ | 8 mobil, 5 customer, 6 penyewaan (sets customers.verified) |
| Testing | ✅ | 14 feature tests, 31 assertions |

> Views pake Tailwind v4 (no Bootstrap). Logo: `images/nrentcar.png`.

## Key Config

- **DB:** singular tables (`mobil`, `penyewaan`), field `nama_user` (not `name`)
- **Pengembalian model:** `protected $table = 'pengembalian'` (singular)
- **Roles:** `admin` + `staff`
- **Tailwind:** v4 via `@theme {}` in CSS — no `tailwind.config.js`
- **Assets:** `@vite('resources/css/app.css')` only
- **Logo:** `public/images/nrentcar.png` (132KB, PNG)

## Credentials

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@gmail.com | 123456 |
| Staff | staff@gmail.com | 123456 |

## Stack

Laravel 12 · PHP 8.4.2 · Tailwind v4.3 · Vite 7 · MySQL · Alpine.js · Chart.js · SweetAlert2 · DOMPDF · OpenSpout · Intervention Image · Spatie Activitylog

## Permissions

- Staff **cannot**: delete mobil (403), manage staff (admin middleware), verify customers (admin middleware), access role-akses page
- Admin can verify customers inside Customer edit/show pages (dropdown + approve/reject)

## Security

Auth + RoleMiddleware (`role:admin`/`role:staff`) · CSRF · Throttle 5/min login

## Team

| Member | Area | Progress |
|--------|------|----------|
| **Aqsha** | Auth, Layout, Dashboards, Staff CRUD, Landing, Errors, All UI, Deps, logo, cleanup | ✅ |
| **Nisrina** | Customer, Mobil, Penyewaan, Verifikasi, Pengembalian CRUD | ✅ Merged |
| **Zahra** | Schema docs, Seeders, Testing | ✅ |
| **Haikal** | Public pages (welcome, mobil list/detail) | ❌ Not started |
| **Gibran** | Laporan, Export, Pengaturan | ✅ Done |

## Left / Blocker

- Public car listing (Haikal — unassigned)
- Auto-calculate denda (deferred to mini hackathon)
