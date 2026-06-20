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

Laravel 12 / PHP 8.5.5 / Tailwind v4.3 / Vite 7.x / MySQL

## Security

- Auth + RoleMiddleware (`role:admin` / `role:staff`)
- CSRF active, throttle 5/min on login
- XSS protection (yieldContent, @json, titleText)
- Mass assignment protected (no $request->all())

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
- Obsolete `laravel/breeze`, `laravel/sanctum`, `livewire/livewire` in composer (unused)
