# RentsCar — Context Handoff

## Project
**Car Rental Management System** — Laravel 12, PHP 8.4.2, Tailwind v4, MySQL
**Stack**: Alpine.js, Chart.js, SweetAlert2, DOMPDF, OpenSpout, Intervention Image, Spatie Activitylog
**Auth**: Seeder-based (`admin@gmail.com`/`123456`, `staff@gmail.com`/`123456`), roles: admin/staff
**Git**: Branches merged into `aqsha` (all features done)

## Audit & Fix Status (Session 2026-06-18)

### Fixed — Security Critical
- ❌ Staff bypass verifikasi via `PUT /customer/{id}` → hapus `status_verifikasi` dari update umum, hanya `verify()` admin
- ❌ Stored XSS via `@yield('title')` → ganti `{{ $__env->yieldContent() }}` di layout + `$mobil->nama_mobil` doang di show
- ❌ XSS via inline `confirm('...{{ $user->nama_user }}...')` di staff/edit → pakai `@json()`
- ❌ SweetAlert `title` HTML injection di customer/index + staff/index → ganti `titleText`
- ❌ Rental bisa `store` dgn status dikontrol client + mobil `disewa`/`maintenance` → hapus `status` dari validasi, force `'aktif'`, cek mobil `tersedia` via `firstOrFail`
- ❌ Staff bisa create `role:admin` → enforce `in:staff`

### Fixed — Data Integrity
- ❌ `PenyewaanController::store/update/destroy` inconsistent mobil status → semua pakai `DB::transaction`, sync mobil status
- ❌ `PengembalianController::store/destroy` inconsistent penyewaan/mobil status → validasi penyewaan `aktif`, transaction, revert state on destroy
- ❌ `MobilController::destroy` bisa hapus mobil dgn rental aktif → block if `penyewaan()->where('status','aktif')->exists()`
- ❌ `Mobil::store/update` nullable field `tipe_mobil`/`bahan_bakar` bisa `Undefined array key` → `?? null`

### Fixed — Stability & Code Quality
- ❌ `AuthController` login validasi kurang `email` rule → `'required|email'`
- ❌ `PublicMobilController::show()` duplicate `where('id', '!=', $id)` → hapus satu
- ❌ `ProfileController::update()` + `StaffController::update()` nullable `password` bisa error → `?? null`
- ❌ `Penyewaan::mobil()` tanpa `withTrashed()` → history rental hilang after soft-delete → tambah
- ❌ `Pengembalian` model tanpa `HasFactory` → tambah
- ❌ `UserFactory` pakai `'name'` bukan `'nama_user'`, tanpa `'role'` → fix
- ❌ `PengembalianFactory` manggil `Penyewaan::factory()` (nonexistent) → ganti literal `penyewaan_id => 1`
- ❌ Duplicate `pengembalian` resource routes → hapus satu blok
- ❌ `/demo/*` routes aktif → hapus beserta unused imports
- ❌ `app/Http/Middleware/IsAdmin.php` dead (no-op, unused anywhere) → delete
- ❌ `app/Livewire/HealthCheck.php` + `resources/views/livewire/` dead (hanya dipakai demo route yg dihapus) → delete

### Fixed — Performance
- ❌ Chart.js loaded global di layout → pindah ke `@push('scripts')` hanya di admin dashboard, staff dashboard, laporan

### Remaining (Low Priority)
- ⏳ `UserFactory` — `email_verified_at` bisa dihapus (no email verification flow) — optional
- ⏳ `laravel/breeze`, `laravel/sanctum`, `livewire/livewire` — unused composer dependencies
- ⏳ `.env.example` — `SESSION_ENCRYPT=true`, `APP_KEY=` harus diisi
- ⏳ `composer.json` — pin version `"*"` for `blade-ui-kit/blade-heroicons`, `intervention/image`
- ⏳ `storage/debugbar/*.json` — tambah ke `.gitignore`
- ⏳ NIK validation `digits:16` (sudah fix di store/update) — migration `string` column type mismatch (schema not updated, but validation tight enough)
- ⏳ Login page HTML nesting rapi (`resources/views/auth/login.blade.php`)

## DB Schema (13 tables)
- `users` (nama_user, role, foto_profil)
- `customers` (18 KTP fields + foto_ktp + status_verifikasi, verified_by, tanggal_verifikasi, catatan_verifikasi)
- `mobil`, `penyewaan`, `pengembalian`, `settings`, `activity_log`, standard Laravel tables

## Key Config
- No `tailwind.config.js` — `@theme {}` in `resources/css/app.css`
- `@vite('resources/css/app.css')` only asset
- Dark theme: `#080808` bg, `#C1121F` accent
- Heroicons via `@svg('heroicon-s-...')`

## Known Quirks
- `app/Models/Pengembalian.php`: `protected $table = 'pengembalian'` (singular)
- Logo: `public/images/nrentcar.png` (132KB, PNG)
- Staff cannot: delete mobil (403), manage staff (admin middleware), verify customers (admin middleware), access role-akses (admin middleware)
- Admin can verify customers inside Customer edit/show pages (dropdown + approve/reject)
- `resources/helpers.php`: aliases `ss` for `session()`, `tr` for `trans()`
- Tes pakai MySQL (`rentscar_testing`), bukan SQLite — perlu `pdo_mysql`
- Auth pakai `AuthController` (custom), bukan Laravel Breeze

## Commands
```bash
php artisan migrate:fresh --seed
php artisan test
```
