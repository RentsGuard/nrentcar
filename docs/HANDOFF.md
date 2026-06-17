# RentsCar — Handoff

## Status

| Area | Status | Notes |
|------|--------|-------|
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
>>>>>>> feature/tambah-data-denda

## Team

| Member | Area | Progress |
|--------|------|----------|
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
