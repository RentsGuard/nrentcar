# Changelog

All notable changes to this project will be documented in this file.

## [1.0.1] - 2026-07-05

### Added
- Authenticated private route for viewing customer KTP images
- Regression tests for hidden public cars, private KTP storage, KTP access, admin-only settings, and public plate-number privacy
- Mobile public navigation shortcuts for car list, about page, and WhatsApp contact

### Changed
- New KTP uploads are stored on the private disk instead of the public disk
- Customer KTP previews now use the authenticated internal image route
- All settings routes and the settings sidebar link are admin-only
- Public car detail now shows a rental CTA only when the car is available, otherwise it shows an availability question CTA
- Public landing/listing/detail backgrounds use simpler gradients and no decorative radial blobs
- `.env.example` now enables encrypted, secure, HTTP-only sessions by default
- Public homepage, about page, and dashboard redirect routes now use controller methods so route caching works

### Fixed
- Hidden cars can no longer be opened through guessed `/cars/{id}` URLs
- Public car search no longer matches plate numbers
- Public car detail no longer exposes plate numbers
- Staff can no longer submit customer verification fields through the general customer update route
- Staff dashboard no longer shows an admin-only settings link
- `docs/dependency.md` conflict markers were removed and dependencies were corrected

## [1.0.0] — 2026-06-30

### Added
- Auth system with role-based redirect (admin/staff)
- Admin dashboard with 7 stat cards + real Chart.js charts
- Staff dashboard (same layout, different greeting)
- Staff CRUD (admin-only, search, SWAL delete, reset password, foto profil)
- Customer CRUD (18 KTP fields, foto_ktp, verification workflow)
- Mobil CRUD (foto, status sync, tipe_mobil Matic/Manual, visibility toggle)
- Penyewaan CRUD (customer/mobil dropdowns, auto-calc, status sync)
- Pengembalian CRUD (manual denda input, late fee calc, status sync)
- Laporan (stat cards, real Chart.js charts, PDF export, date filter)
- Pengaturan (Tampilan, Notifikasi, Role & Akses admin-only)
- Profile (foto profil, password change)
- Public car listing + detail with WhatsApp booking
- Landing page with hero, car grid, Leaflet map
- Activity log (Spatie)
- Settings key-value store

### Fixed
- Authorization: destroy/toggle-visibility routes moved to admin-only
- Chart data: dashboards now use real DB data (was hardcoded)
- Validation: added `@error()` display to Mobil, Penyewaan, Pengembalian forms
- Pagination: added to Penyewaan, Pengembalian, Laporan lists (15/page)
- Customer form: added missing `berlaku_hingga` date input
- Customer form: fixed duplicate "Foto KTP" heading
- Customer form: fixed typo `KTP<` → `KTP`
- Price prefix: added "Rp" to empty price spans (Mobil, Penyewaan forms)
- Profile: added `current_password` validation for password change
- Submit buttons: disable on submit (prevents double-click)
- Wilayah API: removed `withoutVerifying()` SSL bypass
- Staff search: server-side search (was client-side only)
- Delete confirmations: standardized to SweetAlert2
- Pengembalian: added `user()` relationship (was missing)
- Mobil: added `foto_mobil_url` accessor
- Models: added query scopes (`verified`, `tersedia`, `visible`)
- Dashboard: `totalPendapatan` now only sums `selesai` (was including `aktif`)
- PengembalianController: extracted `calculateDenda()` private method (removed duplication)
- LaporanController: extracted `applySearchFilter()` + `applyDateFilter()` private methods
- MobilController: removed redundant `$data` array, uses `$validated` directly
- StaffController: removed dead `role` validation
- Routes: removed dead `exportPdf`/`exportExcel` routes (methods never existed)
- Logout: added `auth` middleware

### Removed
- `intervention/image` (unused)
- `openspout/openspout` (unused)
- `barryvdh/laravel-debugbar` (dev, unused)
- `laravel/sail` (dev, unused)
- `axios` (npm, unused)
- `chart.js` (npm, unused — using CDN)
- `foto_kondisi` from Pengembalian fillable
- Dead `MustVerifyEmail` import from User model
- Dead `role` validation field from StaffController

### Changed
- Composer dependencies: reduced from 15 to 11 packages
- NPM dependencies: reduced from 10 to 5 packages
- Views updated: all forms now have `@error()` validation feedback
- Views updated: all price fields have "Rp" prefix
- Views updated: pagination links on list pages
- Views updated: loading states (submit disabled on click)
