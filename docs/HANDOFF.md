# RentsCar — Handoff

## Status

| Area | Status | Notes |
|------|--------|-------|
| Auth | ✅ | Throttle 5:1, role redirect |
| Layout (Sidebar + Navbar) | ✅ | Alpine.js, active glow |
| Admin Dashboard | ✅ | 6 stat cards, Chart.js |
| Staff Dashboard | ✅ | Same + staff greeting |
| Staff CRUD | ✅ | Search, SweetAlert2 delete, reset pw |
| Landing + Error Pages | ✅ | Hero, car grid, 403/404 |
| Customer CRUD | ✅ | KTP upload, activity log |
| Profile | ✅ | Foto profil, password |
| Mobil, Penyewaan, Verifikasi UI | ✅ | Views only — no CRUD logic |
| Laporan, Pengaturan UI | ✅ | Views only — no export logic |
| Pengembalian + Denda | ⏳ | Branch `feature/tambah-data-denda` |
| Dependency Integration | ✅ | All packages used |

> Views pake Tailwind v4 (no Bootstrap). Referensi: `UIreference/`.

## Key Config

- **DB:** singular tables (`mobil`, `penyewaan`), field `nama_user` (not `name`)
- **Roles:** `admin` + `staff`
- **Tailwind:** v4 via `@theme {}` in CSS — no `tailwind.config.js`
- **Assets:** `@vite('resources/css/app.css')`, `resources/js/app.js` (Alpine, Swal, Inter)

## Credentials

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@gmail.com | 123456 |
| Staff | staff@gmail.com | 123456 |

## Stack

Laravel 12 · PHP 8.5.5 · Tailwind v4.3 · Vite 7 · MySQL

## Security

Auth + RoleMiddleware (`role:admin`/`role:staff`) · CSRF · Throttle 5/min login

## Team

| Member | Area | Progress |
|--------|------|----------|
| **Aqsha** | Auth, Layout, Dashboards, Staff CRUD, Landing, Errors, All UI, Deps | ✅ |
| **Nisrina** | Customer, Mobil, Penyewaan, Verifikasi, Pengembalian CRUD | ⏳ Customer ✅, others UI only |
| **Haikal** | Public pages | Unassigned |
| **Gibran** | Laporan, Export, Pengaturan | ⏳ UI only |
| **Zahra** | Schema docs, Seeders, Testing | Unassigned |

## Left

- Store/update/destroy di Mobil, Penyewaan, Verifikasi, Pengembalian
- Laporan export, Pengaturan logic
- Public pages, Testing, Seeders

## Blocker

`maatwebsite/excel` incompatible with PHP 8.5 → `openspout/openspout` ^5.7
