# RentsCar — Handoff Document

## Project Status

| Area | Status | Notes |
|------|--------|-------|
| Auth (Login, Logout) | ✅ Complete | Tailwind v4, throttle 5:1, role redirect |
| Layout (Sidebar + Navbar) | ✅ Complete | Alpine.js toggle, active glow, role badges |
| Admin Dashboard | ✅ Complete | 6 stat cards, Chart.js, recent tables |
| Staff Dashboard | ✅ Complete | Same as admin + staff greeting |
| Staff CRUD | ✅ Complete | Index (search, SweetAlert2 delete), Create, Edit, reset password |
| Landing Page | ✅ Complete | Hero, car grid from DB, footer |
| 403/404 Error Pages | ✅ Complete | Dark theme, red glow status |
| Customer CRUD | ✅ Complete | Full CRUD + KTP fields + upload + activity log |
| Profile | ✅ Complete | Edit profile, foto profil, password |
| **Mobil UI** | ✅ Views Only | Index (grid), Create, Edit, Show — no CRUD logic yet |
| **Penyewaan UI** | ✅ Views Only | Index (table), Create, Edit, Show — no CRUD logic yet |
| **Verifikasi UI** | ✅ Views Only | Index (table), Create, Edit, Show — no CRUD logic yet |
| **Laporan UI** | ✅ Views Only | Index (stat cards + charts + export buttons) — no logic yet |
| **Pengaturan UI** | ✅ Views Only | Index (role/display/notification settings + system info) |
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
| `/profile` | GET/PUT | auth | Edit profile |
| `/customer` | GET/POST | auth | Customer index / store |
| `/customer/create` | GET | auth | Create customer form |
| `/customer/{id}` | GET/PUT/DELETE | auth | Customer show / update / destroy |
| `/customer/{id}/edit` | GET | auth | Edit customer form |
| `/mobil` | GET/POST | auth | Mobil index / store |
| `/mobil/create` | GET | auth | Create mobil form |
| `/mobil/{id}` | GET/PUT/DELETE | auth | Mobil show / update / destroy |
| `/mobil/{id}/edit` | GET | auth | Edit mobil form |
| `/penyewaan` | GET/POST | auth | Penyewaan index / store |
| `/penyewaan/create` | GET | auth | Create penyewaan form |
| `/penyewaan/{id}` | GET/PUT/DELETE | auth | Penyewaan show / update / destroy |
| `/penyewaan/{id}/edit` | GET | auth | Edit penyewaan form |
| `/verifikasi` | GET/POST | auth | Verifikasi index / store |
| `/verifikasi/create` | GET | auth | Create verifikasi form |
| `/verifikasi/{id}` | GET/PUT/DELETE | auth | Verifikasi show / update / destroy |
| `/verifikasi/{id}/edit` | GET | auth | Edit verifikasi form |
| `/laporan` | GET | auth | Laporan index (stats + charts) |
| `/pengaturan` | GET | auth | Pengaturan index |
| `/staff` | GET/POST | auth, role:admin | Staff index / store |
| `/staff/create` | GET | auth, role:admin | Create staff form |
| `/staff/{id}/edit` | GET | auth, role:admin | Edit staff form |
| `/staff/{id}` | PUT/DELETE | auth, role:admin | Update / destroy staff |
| `/staff/{id}/reset-password` | POST | auth, role:admin | Reset staff password |
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
- Active asset: only `@vite('resources/css/app.css')` in layout head
- `resources/js/app.js`: imports bootstrap (axios), Alpine, SweetAlert2, @fontsource/inter
- `resources/css/app.css`: `@import "tailwindcss"`, `@theme {}`, `.glass-card`, scrollbar

## Security

- Auth middleware on all protected routes
- RoleMiddleware checks `admin`/`staff`
- CSRF protection active
- Throttle 5 requests per minute on login

## Team Member Assignments

| Member | Area | Progress |
|--------|------|----------|
| **Aqsha** (current) | Auth, Layout, Dashboards, Staff CRUD, Landing, Errors, Dep integration, **all UI views** | ✅ Complete (views & routes) |
| **Nisrina** | Customer CRUD, Mobil CRUD, Rental/Return CRUD, Verifikasi CRUD | ⏳ Customer ✅, Mobil/Penyewaan/Verifikasi: UI only, need CRUD logic |
| **Haikal** | Public pages (if any beyond landing) | Need assignment |
| **Gibran** | Reports, Export, Settings | ⏳ Laporan/Pengaturan: UI only, need export logic |
| **Zahra** | Schema docs, Seeders, Testing | Need assignment |

## What's Left

- `store`, `update`, `destroy` methods in MobilController, PenyewaanController, VerifikasiController — currently only return views
- Laporan export logic (PDF/Excel) — buttons are UI only
- Pengaturan functionality — settings page is static UI
- Haikal's public pages assignment
- Zahra's testing & seeding assignment

## Blockers

- `maatwebsite/excel` cannot install: requires PHP <8.5, system has 8.5.5. Replaced with `openspout/openspout` ^5.7

---

## AI Prompts / Context per Member

### Nisrina — Customer CRUD, Mobil, Penyewaan, Verifikasi

```
## Konteks
Laravel 12, PHP 8.5.5, Tailwind v4, Blade. DB singular: mobil, penyewaan, verifikasi, customers.
Field user: nama_user (bukan name). Role: admin/staff. Auth via middleware role:admin / role:staff.

## Yang Udah Ada (jangan diulang)
- CustomerController: FULL CRUD (index, create, store, show, edit, update, destroy) + upload KTP + activity log
- Customer views: 4 file (index, create, show, edit) — Tailwind v4
- Routes `/customer/*` sudah terdaftar
- MobilController: hanya index, create, show, edit (return view)
- PenyewaanController: hanya index, create, show, edit (return view)
- VerifikasiController: hanya index, create, show, edit (return view)
- Mobil views: index (grid), create, edit, show
- Penyewaan views: index (table), create, edit, show
- Verifikasi views: index (table), create, edit, show
- Semua routes sudah terdaftar di routes/web.php

## Yang Perlu Kamu Buat (CRUD logic)
1. **MobilController** — implement store(), update(), destroy()
   - Validasi sesuai model fillable
   - Upload foto_mobil ke storage
   - Activity log
2. **PenyewaanController** — implement store(), update(), destroy()
   - Validasi: customer_id, mobil_id, user_id (auth user), tanggal_sewa, tanggal_kembali, total_harga, status
   - Activity log
3. **VerifikasiController** — implement store(), update(), destroy()
   - Validasi: customer_id, verified_by (auth user), tanggal_verifikasi, status_verifikasi, catatan_verifikasi
   - Activity log

## Design Pattern (ikuti persis)
- Controller: extends Controller, namespace App\Http\Controllers
- Validasi: $request->validate([...])
- Redirect: return redirect('/mobil')->with('success', '...')
- File upload: $request->file('foto_mobil')->store('mobil', 'public')
- Delete file: Storage::disk('public')->delete($mobil->foto_mobil)
- Activity log: activity()->performedOn($model)->log("...")
- Lihat CustomerController sebagai reference pola kode

## Views (jangan diubah, sudah jadi)
Lihat resources/views/mobil/, resources/views/penyewaan/, resources/views/verifikasi/
Semua form sudah pakai old(), error(), method spoofing PUT/DELETE.
Timpa file yang ada kalau perlu update kecil.
```

### Gibran — Laporan, Export, Pengaturan

```
## Konteks
Laravel 12, PHP 8.5.5, Tailwind v4. DOMPDF, OpenSpout, Intervention Image sudah terinstall & demo routes ada.

## Yang Udah Ada
- LaporanController: index() return view with $totalPenyewaan, $totalPendapatan, $totalMobil, $totalCustomer
- Laporan view: index.blade.php — 4 stat cards + 2 charts (Chart.js) + 3 export buttons
- PengaturanController: index() return view
- Pengaturan view: index.blade.php — settings cards + system info + activity feed
- Routes /laporan, /pengaturan sudah terdaftar di routes/web.php
- Demo di routes: /demo/pdf (DOMPDF), /demo/excel (OpenSpout), /demo/image (Intervention)

## Yang Perlu Kamu Buat
1. **Export PDF** — LaporanController method exportPdf()
   - Pake DOMPDF (liat demo route /demo/pdf)
   - Laporan penyewaan lengkap dengan tabel
2. **Export Excel** — LaporanController method exportExcel()
   - Pake OpenSpout (liat demo route /demo/excel)
   - Data penyewaan ke XLSX
3. **Chart data dinamis** — Ganti data hardcoded di Chart.js dengan data dari DB
4. **Filter laporan** — Form filter tanggal/status di halaman laporan
5. **Pengaturan** — Implementasi fitur settings (role, notifikasi, tampilan) sesuai kebutuhan

## Design Reference
- Lihat resources/views/laporan/index.blade.php
- Layout: resources/views/layout.blade.php
```

### Haikal — Public Pages

```
## Konteks
Laravel 12, PHP 8.5.5, Tailwind v4, Blade. Landing page sudah ada.

## Yang Udah Ada
- Welcome page (welcome.blade.php): hero, car grid from DB, footer
- 403 & 404 error pages
- Guest redirect logic (welcome → login → dashboard)
- UIreference/ folder: React/Tailwind design reference

## Yang Perlu Kamu Buat
1. Review & polish landing page
2. Tambah public pages kalau perlu: Tentang Kami, Kontak, FAQ
3. Pastikan guest flow mulus
```

### Zahra — Testing, Seeding, Docs

```
## Konteks
Laravel 12, PHPUnit. Fitur: auth, role middleware, CRUD all modules.
Database sudah migrate dengan sample data via seeder existing.

## Yang Udah Ada
- PHPUnit configured
- UserSeeder: admin + staff credentials
- Contoh test: tests/Feature/ExampleTest.php, tests/Unit/ExampleTest.php
- Semua model, migration, controller sudah ada

## Yang Perlu Kamu Buat
1. **Database Seeders**
   - MobilSeeder: 10+ sample cars with various status
   - CustomerSeeder: 15+ sample customers with KTP data
   - PenyewaanSeeder: sample rental transactions
   - VerifikasiSeeder: sample verification records
   - Panggil di DatabaseSeeder.php
2. **Feature Tests**
   - AuthTest: login, logout, role redirect, throttle
   - CustomerTest: CRUD, validation, KTP upload
   - MobilTest: CRUD, validation
   - PenyewaanTest: CRUD, status transitions
   - VerifikasiTest: CRUD, status changes
3. **Unit Tests**
   - Model relationships test
   - Accessor test (fotoKtpUrl, fotoProfilUrl)

## Commands
php artisan test
php artisan db:seed
php artisan make:test NamaTest
php artisan make:seeder NamaSeeder

## Reference
- Database migrations: database/migrations/
- Models: app/Models/
- Controllers: app/Http/Controllers/
```
