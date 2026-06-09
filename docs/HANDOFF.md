# RentsCar — Handoff Document

## Project Status

| Area | Status | Notes |
|------|--------|-------|
| Auth (Login, Logout) | ✅ Complete | Tailwind v4, throttle 5:1, role redirect |
| Layout (Sidebar + Navbar) | ✅ Complete | Alpine.js toggle, active glow, role badges |
| Admin Dashboard | ✅ Complete | 6 stat cards, Chart.js, recent tables |
| Staff Dashboard | ✅ Complete | Same as admin + staff greeting |
| Staff CRUD | ✅ Complete | Index (search, SweetAlert2 delete), Create, Edit |
| Landing Page | ✅ Complete | Hero, car grid from DB, footer |
| 403/404 Error Pages | ✅ Complete | Dark theme, red glow status |
| Dependency Integration | ✅ Complete | All packages used at least once |

## All Aqsha Views

All views rewritten from Bootstrap 5.3 to **Tailwind CSS v4**. Zero Bootstrap CSS, zero inline `<style>` blocks in Aqsha files.

See `UIreference/` for React/Tailwind design reference (Magic Patterns export).

## Route Summary

| Route | Method | Middleware | Description |
|-------|--------|-----------|-------------|
| `/` | GET | guest | Landing page or redirect to dashboard |
| `/login` | GET/POST | guest | Login with throttle 5:1 |
| `/logout` | POST | auth | Logout |
| `/admin/dashboard` | GET | auth, role:admin | Admin dashboard |
| `/staff/dashboard` | GET | auth, role:staff | Staff dashboard |
| `/staff` | GET | auth, role:admin | Staff index (searchable) |
| `/staff/create` | GET | auth, role:admin | Create staff form |
| `/staff` | POST | auth, role:admin | Store staff |
| `/staff/{id}/edit` | GET | auth, role:admin | Edit staff form |
| `/staff/{id}` | PUT | auth, role:admin | Update staff |
| `/staff/{id}` | DELETE | auth, role:admin | Delete staff + SweetAlert2 |
| `/demo/pdf` | GET | auth, role:admin | DOMPDF invoice demo |
| `/demo/image` | GET | auth, role:admin | Intervention Image demo |
| `/demo/excel` | GET | auth, role:admin | OpenSpout XLSX demo |
| `/demo/livewire` | GET | auth, role:admin | Livewire component demo |

## Database

- Naming: singular tables (`mobil`, `penyewaan`, `verifikasi`)
- User column: `nama_user` (not `name`)
- Roles: `admin` and `staff` only (no `user` role)

## Seed Credentials

| Role | Email | Password |
|------|-------|----------|
| Admin | `admin@gmail.com` | `123456` |
| Staff | `staff@gmail.com` | `123456` |

## Stack

- **Laravel** 12.x
- **PHP** 8.5.5
- **Tailwind CSS** v4.3 (via `@tailwindcss/vite`)
- **Vite** 7.x
- **MySQL** / MariaDB

## Key Config

- No `tailwind.config.js` — Tailwind v4 uses `@theme {}` in CSS
- Active asset: only `@vite('resources/css/app.js')` in layout head
- `resources/js/app.js`: imports bootstrap (axios), Alpine, SweetAlert2, @fontsource/inter
- `resources/css/app.css`: `@import "tailwindcss"`, `@theme {}`, `.glass-card`, scrollbar

## Security

- Auth middleware on all protected routes
- RoleMiddleware checks `admin`/`staff`
- CSRF protection active
- Throttle 5 requests per minute on login

## Team Member Assignments

| Member | Area |
|--------|------|
| **Aqsha** (current) | Auth, Layout, Dashboards, Staff CRUD, Landing, Errors, Dep integration |
| **Nisrina** | Customer CRUD, Rental/Return CRUD, Verification |
| **Haikal** | Public pages (if any beyond landing) |
| **Gibran** | Reports, Settings, Export |
| **Zahra** | Schema docs, Seeders, Testing |

## Blockers

- `maatwebsite/excel` cannot install: requires PHP <8.5, system has 8.5.5. Replaced with `openspout/openspout` ^5.7
- Routes `/mobil`, `/customer`, `/verifikasi`, `/penyewaan`, `/laporan`, `/pengaturan` — controllers/views not yet created (other members)
