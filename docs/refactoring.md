# Refactoring — RentsCar

## Completed Refactoring

### 1. Bootstrap 5.3 → Tailwind CSS v4

All Aqsha-owned views rewritten from Bootstrap utility classes to Tailwind v4.

**Changes:**
- Removed Bootstrap CSS CDN from layout
- Removed Bootstrap-specific classes
- Replaced grid system with Tailwind `grid` + `grid-cols-*`
- Replaced Bootstrap utilities with Tailwind equivalents
- No `tailwind.config.js` — v4 uses CSS `@theme {}` block

### 2. Manual JS → Alpine.js

- Sidebar open/close: `x-data`, `x-show`, `@click` replace `classList.toggle()`
- Backdrop overlay: managed via Alpine state
- `x-cloak` prevents FOUC

### 3. Native confirm() → SweetAlert2

- Staff delete confirmation uses `Swal.fire()` with custom styling

### 4. Static Icons → Blade Heroicons

- Dashboard sidebar icon replaced with `@heroicon('squares-2x2', 'solid')`

### 5. Audit Trail

- StaffController logs create/update/delete via Spatie Activitylog

## 7. Bug Fixes

| Bug | Fix |
|-----|-----|
| `PengembalianController@update()` resets `status_denda` ke `belum_dibayar` setiap edit | Jika `status_denda === 'lunas'`, `total_denda` dipertahankan, `status_denda`/`denda_lunas_at`/`denda_lunas_by` tidak dioverwrite |
| `kondisi_mobil` free text vs strict `=== 'rusak'` | Normalisasi `strtolower(trim())` sebelum komparasi di `calculateDenda()` |
| `jam_kembali` parameter gak kepake (form pake `datetime-local`) | Hapus parameter `$jamKembali` dari `calculateDenda()` |
| Global `request()` helper di `index()` | Inject `Request $request`, pake `$request->input()` |
| Dropdown penyewaan tanpa limit | Tambah `->limit(500)` di `create()` |
| `denda_per_jam` pake stored rate instead of current penyewaan rate | `update()` pake `$penyewaan->denda_per_jam` (bukan `$pengembalian->denda_per_jam`) |
| Duplikasi route `/laporan/ringkasan` | Hapus baris duplikat |
| `route('dashboard')` undefined | Tambah named route `/dashboard` di `routes/web.php` |
| `UserFactory` missing `email_verified_at` + `unverified()` | Tambah default `email_verified_at => now()` + method `unverified()` |
| Public car detail exposed hidden cars by guessed ID | `PublicMobilController@show()` sekarang wajib `is_visible = true` |
| Public search matched plate numbers | Search publik sekarang hanya nama mobil dan tipe mobil |
| Public car detail displayed plate numbers | Plat nomor disembunyikan di halaman publik, tetap ada di dashboard internal |
| Staff could submit verification fields through customer update | Field verifikasi hanya diproses jika user adalah admin |
| Foto KTP tersimpan di public disk | Upload KTP baru masuk private disk dan dibuka lewat route internal setelah login |
| Settings routes accessible by staff | Semua route `/pengaturan` dipindahkan ke middleware `role:admin` |
| Staff sidebar linked to admin-only settings | Link pengaturan hanya dirender untuk admin |
| Public mobile navigation was too limited | Tambah mobile nav publik untuk Mobil, Tentang, dan WhatsApp |
| Route cache blocked by closure routes | Homepage, tentang page, dan dashboard redirect dipindahkan ke controller method |

## Pending Refactoring

- Optional: extract repeated public navigation into a Blade partial if the public pages continue to grow.
