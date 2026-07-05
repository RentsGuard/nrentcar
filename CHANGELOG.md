# Changelog

Semua perubahan penting pada proyek ini akan dicatat di sini.

## [1.0.1] — 2026-07-05

### Ditambahkan
- Route internal terautentikasi untuk melihat foto KTP customer
- Regression test untuk: mobil tersembunyi di publik, penyimpanan KTP privat, akses KTP, pengaturan admin-only, dan privasi plat nomor
- Navigasi publik mobile untuk daftar mobil, halaman tentang, dan kontak WhatsApp

### Diubah
- Upload KTP baru disimpan di private disk (bukan public disk)
- Preview KTP customer menggunakan route internal terautentikasi
- Semua route pengaturan dan link sidebar pengaturan hanya untuk admin
- Detail mobil publik hanya menampilkan CTA sewa jika mobil tersedia
- Latar halaman publik menggunakan gradien sederhana tanpa blob dekoratif
- `.env.example` mengaktifkan session terenkripsi, secure, dan HTTP-only secara default
- Homepage, tentang, dan redirect dashboard menggunakan controller method (agar route caching berfungsi)

### Diperbaiki
- Mobil tersembunyi tidak bisa dibuka lewat URL `/cars/{id}` yang ditebak
- Pencarian mobil publik tidak lagi cocok dengan plat nomor
- Detail mobil publik tidak menampilkan plat nomor
- Staff tidak bisa mengirim field verifikasi customer lewat route update customer
- Dashboard staff tidak menampilkan link pengaturan (admin-only)
- `docs/dependency.md` — konflik merge dihapus, dependensi diperbaiki

## [1.0.0] — 2026-06-30

### Ditambahkan
- Sistem auth dengan redirect berbasis role (admin/staff)
- Dashboard admin (7 kartu stat + Chart.js real)
- Dashboard staff (tampilan sama, sapaan berbeda)
- CRUD Staff (admin-only, search, SWAL delete, reset password, foto profil)
- CRUD Customer (18 field KTP, foto_ktp, workflow verifikasi)
- CRUD Mobil (foto, sinkronisasi status, tipe Matic/Manual, toggle visibilitas)
- CRUD Penyewaan (dropdown customer/mobil, auto-kalkulasi, sinkronisasi status)
- CRUD Pengembalian (input denda manual, kalkulasi denda telat, sinkronisasi status)
- Laporan (kartu stat, Chart.js real, ekspor PDF, filter tanggal)
- Pengaturan (Tampilan, Notifikasi, Role & Akses, admin-only)
- Profil (foto profil, ganti password)
- Daftar + detail mobil publik dengan pemesanan WhatsApp
- Landing page (hero, grid mobil, peta Leaflet)
- Activity log (Spatie)
- Penyimpanan pengaturan key-value

### Diperbaiki
- Otorisasi: route destroy/toggle-visibility dipindahkan ke admin-only
- Data chart: dashboard menggunakan data DB real (sebelumnya hardcoded)
- Validasi: tambah `@error()` di form Mobil, Penyewaan, Pengembalian
- Pagination: ditambahkan ke daftar Penyewaan, Pengembalian, Laporan (15/halaman)
- Form customer: tambah input `berlaku_hingga` yang hilang
- Form customer: perbaiki heading "Foto KTP" duplikat
- Form customer: perbaiki typo `KTP<` → `KTP`
- Prefix harga: tambah "Rp" ke span harga kosong
- Profil: tambah validasi `current_password` untuk ganti password
- Tombol submit: nonaktif saat diklik (cegah double-click)
- Wilayah API: hapus `withoutVerifying()` bypass SSL
- Search staff: server-side search (sebelumnya client-side saja)
- Konfirmasi hapus: distandarisasi ke SweetAlert2
- Pengembalian: tambah relasi `user()` (sebelumnya hilang)
- Mobil: tambah accessor `foto_mobil_url`
- Model: tambah query scope (`verified`, `tersedia`, `visible`)
- Dashboard: `totalPendapatan` hanya menjumlah `selesai` (sebelumnya termasuk `aktif`)
- PengembalianController: ekstrak method private `calculateDenda()` (hapus duplikasi)
- LaporanController: ekstrak method private `applySearchFilter()` + `applyDateFilter()`
- MobilController: hapus array `$data` redundant, pakai `$validated` langsung
- StaffController: hapus validasi `role` yang tidak dipakai
- Routes: hapus route `exportPdf`/`exportExcel` (method tidak pernah ada)
- Logout: tambah middleware `auth`

### Dihapus
- `intervention/image` (tidak dipakai)
- `openspout/openspout` (tidak dipakai)
- `barryvdh/laravel-debugbar` (dev, tidak dipakai)
- `laravel/sail` (dev, tidak dipakai)
- `axios` (npm, tidak dipakai)
- `chart.js` (npm, tidak dipakai — pake CDN)
- `foto_kondisi` dari Pengembalian fillable
- Import `MustVerifyEmail` dari User model
- Field validasi `role` dari StaffController

### Diubah
- Dependency Composer: 15 → 11 paket
- Dependency NPM: 10 → 5 paket
- View: semua form punya `@error()` feedback
- View: semua field harga punya prefix "Rp"
- View: pagination links di halaman daftar
- View: loading state (submit disabled saat klik)
