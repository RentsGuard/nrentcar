# RentsCar — Handoff

## Status

| Area | Status | Notes |
|------|--------|-------|
| Auth | ✅ | Throttle 5:1, role redirect |
| Layout (Sidebar + Navbar) | ✅ | Alpine.js, active glow, logout sidebar |
| Admin Dashboard | ✅ | 6 stat cards, Chart.js |
| Staff Dashboard | ✅ | Same + staff greeting |
| Staff CRUD | ✅ | Search, SweetAlert2 delete, reset pw, foto profil |
| Landing + Error Pages | ✅ | Hero, car grid from DB, 403/404 |
| Customer CRUD | ✅ | Full KTP fields, foto_ktp upload, activity log |
| Profile | ✅ | Foto profil upload, password change |
| Mobil CRUD | ✅ | Foto upload, status management, activity log |
| Penyewaan CRUD | ✅ | Customer/mobil dropdowns, status → mobil sync |
| Verifikasi CRUD | ✅ | Customer dropdown, verifikator assignment |
| Laporan + Pengaturan | ✅ | Stat cards, Chart.js (hardcoded data) |
| Export (PDF/XLSX) | ⏳ | Demo routes exist, laporan export links are `#` |
| Pengembalian + Denda | ⏳ | Branch `feature/tambah-data-denda` |
| Seeders | ✅ | Mobil, Customer, Penyewaan, Verifikasi |
| Testing | ✅ | Auth, Mobil, Customer feature tests |

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

Laravel 12 · PHP 8.4.2 · Tailwind v4.3 · Vite 7 · MySQL

## Security

Auth + RoleMiddleware (`role:admin`/`role:staff`) · CSRF · Throttle 5/min login

## Team

| Member | Area | Progress |
|--------|------|----------|
| **Aqsha** | Auth, Layout, Dashboards, Staff CRUD, Landing, Errors, All UI, Deps | ✅ |
| **Nisrina** | Customer, Mobil, Penyewaan, Verifikasi, Pengembalian CRUD | ✅ Completed |
| **Zahra** | Schema docs, Seeders, Testing | ✅ Completed |
| **Haikal** | Public pages | Unassigned |
| **Gibran** | Laporan, Export, Pengaturan | ⏳ UI only |

## Left

- Laporan export (PDF/Excel/Cetak) links masih `#`
- Pengaturan menu links masih `#`
- Laporan Chart.js masih pakai hardcoded data
- Public pages, Pengembalian + Denda

## Blocker

`maatwebsite/excel` incompatible with PHP 8.5 → `openspout/openspout` ^5.7
