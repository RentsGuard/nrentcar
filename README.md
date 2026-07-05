# NrentCar — Sistem Manajemen Rental Mobil

**Apa (What):** Aplikasi web untuk manajemen bisnis rental mobil. Kelola armada, pelanggan, transaksi sewa, pengembalian, denda, dan laporan dalam satu dashboard.

**Kenapa (Why):** Menggantikan pencatatan manual dengan sistem digital terintegrasi. Mempercepat operasional, mengurangi kesalahan input, dan menyediakan laporan akurat.

**Siapa (Who):** Admin (pemilik/manajer) dan Staff (karyawan). Publik dapat melihat katalog mobil dan menghubungi via WhatsApp.

**Kapan (When):** Digunakan setiap hari — dari pendaftaran pelanggan baru hingga pembuatan laporan bulanan.

**Dimana (Where):** Berjalan di web server (Laragon lokal atau hosting). Basis operasi di Padang, Indonesia.

**Bagaimana (How):** Dibangun dengan Laravel 12, PHP 8.2+, MySQL 8.4, Tailwind CSS v4, Alpine.js, Vite 7.

## Fitur Utama

| Fitur | Keterangan |
|-------|------------|
| Auth & Role | Login admin/staff, throttle 5 percobaan, redirect berdasarkan role |
| Dashboard | 7 kartu statistik + grafik Chart.js (pendapatan, penyewaan) |
| Manajemen Staff | CRUD admin-only, reset password, foto profil |
| Manajemen Customer | 18 field data KTP, upload foto KTP privat, workflow verifikasi |
| Manajemen Mobil | CRUD + foto, tipe Matic/Manual, toggle visibilitas |
| Penyewaan | Pilih customer & mobil, auto-kalkulasi, sinkronisasi status |
| Pengembalian + Denda | Catat pengembalian, hitung denda, status lunas/belum |
| Laporan | Statistik, grafik Chart.js, ekspor PDF, filter tanggal |
| Pengaturan | Admin-only (tampilan, notifikasi, role akses) |
| Halaman Publik | Daftar & detail mobil, pemesanan WhatsApp, peta lokasi |
| Activity Log | Spatie Activitylog — catat semua aksi penting |

## Struktur Proyek

```
app/
├── Http/
│   ├── Controllers/    # 13 controller
│   └── Middleware/      # RoleMiddleware
├── Models/              # 6 model
bootstrap/app.php        # Registrasi middleware
config/                  # 11 file konfigurasi
database/
├── migrations/          # 19 file
├── seeders/             # 7 seeder
├── factories/           # 5 factory
resources/
├── views/               # 41 Blade view
├── css/                 # app.css (Tailwind v4)
├── js/                  # app.js (Alpine, SweetAlert2)
routes/web.php           # Semua route
tests/
├── Feature/             # 7 file
├── Unit/                # 1 file
```

## Instalasi

Lihat [docs/installation.md](docs/installation.md).

## Testing

```bash
# Semua test
php artisan test

# Test spesifik
php artisan test --filter=MobilTest
```

**52 test, 107 assertions** — Unit, Auth, Authorization, Customer, Mobil, Penyewaan, Pengembalian, Cetak.

## Deployment

1. Set `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL=https://domain-anda.com`
2. Isi kredensial database hosting di `.env`
3. `php artisan migrate --force`
4. `php artisan storage:link`
5. `npm run build`
6. `php artisan config:cache`, `route:cache`, `view:cache`
7. Gunakan HTTPS, ganti akun seed default

## Lisensi

MIT
