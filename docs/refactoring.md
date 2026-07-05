# Refactoring — RentsCar

**Apa (What):** Dokumentasi perubahan refactoring yang telah dilakukan pada kode.

**Kenapa (Why):** Meningkatkan kualitas kode — menghilangkan duplikasi, memperbaiki bug, standarisasi teknologi, dan meningkatkan keamanan.

**Siapa (Who):** Developer yang melanjutkan pengembangan aplikasi.

**Kapan (When):** Refactoring dilakukan secara bertahap sejak Juni 2026.

**Dimana (Where):** Seluruh kode di repository ini — controller, view, model, route, migration, test.

**Bagaimana (How):** Perubahan dikelompokkan per area.

## 1. Migrasi UI: Bootstrap 5.3 → Tailwind CSS v4

Semua view milik Aqsha ditulis ulang dari Bootstrap ke Tailwind v4.

- Hapus CDN Bootstrap dari layout
- Ganti sistem grid Bootstrap dengan `grid` + `grid-cols-*` Tailwind
- Ganti utility Bootstrap dengan utility Tailwind
- v4 menggunakan CSS `@theme {}` (tanpa `tailwind.config.js`)

## 2. Manual JS → Alpine.js

| Sebelum | Sesudah |
|---------|---------|
| `classList.toggle()` sidebar | `x-data`, `x-show`, `@click` |
| Backdrop overlay manual | Dikelola Alpine |
| FOUC (Flash of Unstyled Content) | `x-cloak` |

## 3. Native confirm() → SweetAlert2

- Staff delete pakai `Swal.fire()` dengan styling kustom
- Mobil delete pakai `Swal.fire()` dengan styling kustom

## 4. Blade Heroicons

- Ikon sidebar dashboard diganti dengan `@heroicon('squares-2x2', 'solid')`

## 5. Audit Trail (Spatie Activitylog)

- StaffController: log create, update, delete

## 6. Security Headers

Middleware global mengirim header:
- `X-Frame-Options: DENY`
- `X-Content-Type-Options: nosniff`
- `Referrer-Policy: strict-origin-when-cross-origin`
- `Permissions-Policy: geolocation=(), microphone=(), camera=()`
- `Content-Security-Policy`

## 7. Perbaikan Bug

### PengembalianController

| Masalah | Solusi |
|---------|--------|
| `update()` reset `status_denda` ke `belum_dibayar` setiap edit | Jika `status_denda === 'lunas'`, pertahankan `total_denda`, jangan overwrite `status_denda`/`denda_lunas_at`/`denda_lunas_by` |
| `kondisi_mobil` free text vs `=== 'rusak'` | Normalisasi `strtolower(trim())` sebelum komparasi |
| Parameter `jam_kembali` tidak kepakai (form pakai `datetime-local`) | Hapus parameter `$jamKembali` dari `calculateDenda()` |
| Global `request()` helper di `index()` | Inject `Request $request`, pakai `$request->input()` |
| Dropdown penyewaan tanpa limit | Tambah `->limit(500)` di `create()` |
| `denda_per_jam` pakai stored rate (lama) bukan current | Pakai `$penyewaan->denda_per_jam`, bukan `$pengembalian->denda_per_jam` |

### Auth & Routes

| Masalah | Solusi |
|---------|--------|
| Duplikasi route `/laporan/ringkasan` | Hapus baris duplikat |
| `route('dashboard')` undefined | Tambah named route yang redirect berdasarkan role |
| `UserFactory` missing `email_verified_at` + `unverified()` | Tambah default `email_verified_at => now()` + method `unverified()` |

### Keamanan Publik

| Masalah | Solusi |
|---------|--------|
| Mobil tersembunyi bisa dibuka lewat URL | `PublicMobilController@show()` wajib `is_visible = true` |
| Search publik cocok dengan plat nomor | Search publik hanya nama + tipe mobil |
| Detail publik tampilkan plat nomor | Plat nomor dihapus dari halaman publik |
| Staff bisa verifikasi customer lewat update | Field verifikasi hanya diproses jika user admin |
| Foto KTP di public disk | Upload KTP baru ke private disk, dibuka via route internal |
| Settings routes diakses staff | Semua route pengaturan pindah ke middleware `role:admin` |
| Sidebar staff tampilkan link pengaturan | Link pengaturan hanya dirender untuk admin |
| Route cache diblokir closure routes | Homepage, tentang, dashboard redirect pakai controller method |

## Pending Refactoring

- Opsional: ekstrak navigasi publik berulang ke Blade partial jika halaman publik bertambah.
