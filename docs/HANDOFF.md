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
=======
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
>>>>>>> aqsha

## Credentials

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@gmail.com | 123456 |
| Staff | staff@gmail.com | 123456 |

## Stack

<<<<<<< HEAD
Laravel 12 / PHP 8.5.5 / Tailwind v4.3 / Vite 7.x / MySQL

## Security

- Auth + RoleMiddleware (`role:admin` / `role:staff`)
- CSRF active, throttle 5/min on login
=======
Laravel 12 · PHP 8.4.2 · Tailwind v4.3 · Vite 7 · MySQL · Alpine.js · Chart.js · SweetAlert2 · DOMPDF · OpenSpout · Intervention Image · Spatie Activitylog

## Permissions

- Staff **cannot**: delete mobil (403), manage staff (admin middleware), verify customers (admin middleware), access role-akses page
- Admin can verify customers inside Customer edit/show pages (dropdown + approve/reject)

## Security

Auth + RoleMiddleware (`role:admin`/`role:staff`) · CSRF · Throttle 5/min login
>>>>>>> aqsha

## Team

| Member | Area | Progress |
|--------|------|----------|
<<<<<<< HEAD
| **Aqsha** | Auth, Layout, Dashboards, Staff CRUD, Landing, Errors, All UI views, Dependencies | ✅ |
| **Nisrina** | Customer, Mobil, Penyewaan, Verifikasi, Pengembalian CRUD | ⏳ Customer ✅, others: UI only |
| **Haikal** | Public pages | Need assignment |
| **Gibran** | Laporan, Export, Pengaturan | ⏳ UI only |
| **Zahra** | Schema docs, Seeders, Testing | Need assignment |
=======
| **Aqsha** | Auth, Layout, Dashboards, Staff CRUD, Landing, Errors, All UI, Deps, logo, cleanup | ✅ |
| **Nisrina** | Customer, Mobil, Penyewaan, Verifikasi, Pengembalian CRUD | ✅ Merged |
| **Zahra** | Schema docs, Seeders, Testing | ✅ |
| **Haikal** | Public pages (welcome, mobil list/detail) | ❌ Not started |
| **Gibran** | Laporan, Export, Pengaturan | ✅ Done |
>>>>>>> aqsha

## Left / Blocker

<<<<<<< HEAD
- Store/update/destroy di Mobil, Penyewaan, Verifikasi, Pengembalian Controller
- Laporan export (PDF/Excel), Pengaturan functionality
- Public pages (Haikal), Testing & seeders (Zahra)

## Blocker

- `maatwebsite/excel` incompatible with PHP 8.5 → replaced with `openspout/openspout` ^5.7

## AI Prompts per Member

> Lihat file `docs/HANDOFF.md` versi sebelumnya atau konten di bawah untuk prompt length yang sudah dipakai tiap anggota. (Prompt dihapus dari file ini untuk menjaga ringkasnya — jika perlu, lihat riwayat git atau minta ke Aqsha)
=======
- Public car listing (Haikal — unassigned)
- Auto-calculate denda (deferred to mini hackathon)
>>>>>>> aqsha
