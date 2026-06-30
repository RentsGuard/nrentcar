# Refactoring Report

## Before

### Architecture Issues
- Duplicated filter/search logic in LaporanController (3 copies of same search, 2 copies of same date filter)
- Duplicated denda calculation in PengembalianController (identical 25-line block in store + update)
- Manual `$data` array in MobilController (redundant, $validated already had same keys)
- Hardcoded chart data in dashboards (not real metrics)
- Missing authorization on 5 routes (staff could delete/access restricted features)
- Missing validation feedback on 26+ form fields across 6 views
- No pagination on 4 list views (unbounded data load)
- No loading states on any form (double-click risk)

### Code Quality Issues
- Dead `role` validation field in StaffController (value hardcoded but validated unnecessarily)
- Dead `foto_kondisi` fillable field in Pengembalian model (never used)
- Missing `user()` relationship on Pengembalian model (lazy load N+1)
- Missing `foto_mobil_url` accessor on Mobil model (inconsistent with User/Customer)
- No query scopes on models (repeated `where('status_verifikasi', 'disetujui')` patterns)
- FQCN `\Carbon\Carbon` instead of import in LaporanController
- Dead `MustVerifyEmail` import in User model
- Countless hardcoded URLs (no route() or url())

### Security Issues
- SSL verification disabled on WilayahController (`withoutVerifying()`)
- Profile password change had no `current_password` check (session hijack vector)
- Routes allowing staff to delete records (customer, penyewaan, pengembalian)
- Staff could toggle car visibility

## After

### Architecture Improvements
- `LaporanController`: extracted `applySearchFilter()` and `applyDateFilter()` private methods — eliminates 80+ lines of duplication
- `PengembalianController`: extracted `calculateDenda()` private method — eliminates 25 lines duplicated
- `MobilController`: uses `$validated` directly instead of manual `$data` array
- `DashboardController`: real Chart.js data from DB queries
- All 5 unauthorized routes moved into `role:admin` middleware
- 26+ @error() directives added across 6 views
- 4 list controllers now use `->paginate(15)` with pagination links
- All forms disable submit on click (prevents double submission)

### Code Quality Improvements
- StaffController: removed dead `role` validation
- Pengembalian model: removed dead `foto_kondisi` from fillable
- Pengembalian model: added `user()` BelongsTo relationship
- Mobil model: added `getFotoMobilUrlAttribute()` accessor
- Customer model: added `scopeVerified()`, `scopeUnverified()`, `scopeStatusVerifikasi()`
- User model: added `scopeAdmin()`, `scopeStaff()`, `dendaLunasBy()` relationship
- LaporanController: `Carbon` imported at top (no more FQCN)
- User model: removed dead `MustVerifyEmail` comment

### Security Improvements
- WilayahController: removed `withoutVerifying()`, added `timeout(5)`
- ProfileController: `current_password` required when changing password
- `DELETE /customer/{id}` → `middleware('role:admin')`
- `DELETE /penyewaan/{id}` → `middleware('role:admin')`
- `DELETE /pengembalian/{id}` → `middleware('role:admin')`
- `PUT /mobil/{id}/toggle-visibility` → `middleware('role:admin')`

### Files Modified

| # | File | Change |
|---|------|--------|
| 1 | `routes/web.php` | Added 5 middleware auth rules, removed dead routes |
| 2 | `LaporanController.php` | Extracted 2 private methods, removed duplication |
| 3 | `PengembalianController.php` | Extracted `calculateDenda()`, added Carbon import |
| 4 | `MobilController.php` | Removed manual $data arrays |
| 5 | `DashboardController.php` | Added real chart queries, fixed totalPendapatan |
| 6 | `CustomerController.php` | Added catatan_verifikasi to verify + update |
| 7 | `ProfileController.php` | Added current_password validation |
| 8 | `StaffController.php` | Removed dead role validation |
| 9 | `WilayahController.php` | Removed withoutVerifying() |
| 10 | `PenyewaanController.php` | Added pagination |
| 11 | `Pengembalian.php` | Added user() relationship, removed foto_kondisi |
| 12 | `Mobil.php` | Added foto_mobil_url accessor |
| 13 | `Customer.php` | Added 3 query scopes |
| 14 | `Penyewaan.php` | Removed denda_per_jam from casts |
| 15 | `User.php` | Removed dead code, added scopes + relationship |
| 16 | `admin/dashboard.blade.php` | Real chart data |
| 17 | `staff/dashboard.blade.php` | Real chart data |
| 18 | `customer/create.blade.php` | Added berlaku_hingga input, fixed typo |
| 19 | `customer/edit.blade.php` | Added berlaku_hingga input, removed duplicate heading |
| 20 | `mobil/create.blade.php` | Added 8 @error() directives, "Rp" prefix |
| 21 | `mobil/edit.blade.php` | Added 8 @error() directives, "Rp" prefix |
| 22 | `penyewaan/create.blade.php` | Added 6 @error() + "Rp" prefix |
| 23 | `penyewaan/edit.blade.php` | Added @error() + "Rp" prefix |
| 24 | `penyewaan/index.blade.php` | Pagination links |
| 25 | `pengembalian/create.blade.php` | Added 4 @error() directives |
| 26 | `pengembalian/edit.blade.php` | Added 4 @error() directives |
| 27 | `pengembalian/index.blade.php` | Pagination links |
| 28 | `laporan/awal/index.blade.php` | Pagination links |
| 29 | `laporan/akhir/index.blade.php` | Pagination links |
| 30 | `layout.blade.php` | Disable submit on click |
| 31 | `composer.json` | Removed 4 unused packages |
| 32 | `package.json` | Removed 2 unused packages |

**Total: 30+ files modified, ~1000+ lines changed across all modifications.**
