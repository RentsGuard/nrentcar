# NrentCar — Sistem Manajemen Rental Mobil

Aplikasi web full-featured untuk manajemen bisnis rental mobil berbasis Laravel 12. Kelola armada, pelanggan, transaksi sewa, pengembalian, denda, dan laporan dalam satu dashboard.

## Status Saat Ini

| Area                 | Status                                                                                                                                                                         |
| -------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ |
| Auth & Role          | Laravel Breeze (login, register, password reset, email verification, profile edit), role-based redirect (admin→/admin/dashboard, staff→/staff/dashboard), throttle 5 percobaan |
| Manajemen Mobil      | CRUD + foto upload, tipe Matic/Manual, toggle visibilitas, admin-only delete                                                                                                   |
| Manajemen Customer   | 18 field data KTP, upload foto KTP, workflow verifikasi (setujui/tolak oleh admin)                                                                                             |
| Penyewaan            | Pilih customer & mobil dari dropdown, auto-kalkulasi durasi & harga, sync status mobil, batalkan penyewaan                                                                     |
| Pengembalian + Denda | Catat pengembalian, input denda manual, auto-kalkulasi denda telat, tandai/batalkan lunas                                                                                      |
| Dashboard            | Kartu statistik + grafik Chart.js (pendapatan, penyewaan)                                                                                                                      |
| Laporan              | Statistik, grafik, ekspor PDF (DOMPDF), filter tanggal                                                                                                                         |
| Pengaturan           | Tampilan (nama, deskripsi, warna aksen), notifikasi, role akses (admin-only)                                                                                                   |
| Halaman Publik       | Daftar & detail mobil, pemesanan via WhatsApp, peta lokasi                                                                                                                     |
| Activity Log         | Spatie Activitylog — catat semua aksi CRUD                                                                                                                                     |
| Testing              | 66 test, 147 assertions — Unit, Auth, Authorization, Customer, Mobil, Penyewaan, Pengembalian, Cetak, Profile                                                                  |

## Tujuan Proyek

- Menggantikan pencatatan manual dengan sistem digital terintegrasi.
- Mempercepat operasional rental mobil (pendaftaran pelanggan hingga laporan bulanan).
- Menyediakan dashboard terpisah untuk admin (manajer) dan staff (karyawan).
- Mendokumentasikan konstruksi dan evolusi perangkat lunak secara bertahap.

## Masalah Yang Diselesaikan

- Data pelanggan, mobil, dan transaksi masih tercatat manual (buku/Excel).
- Tidak ada sistem role-based access — semua karyawan bisa akses semua data.
- Pelacakan status mobil (tersedia/disewa/maintenance) tidak real-time.
- Perubahan dependency, fitur, dan refactoring perlu dicatat agar evolusi proyek mudah ditelusuri.

## Target Pengguna

- Pengunjung website yang ingin melihat katalog mobil dan harga sewa.
- Staff yang mengelola transaksi penyewaan dan pengembalian sehari-hari.
- Admin (pemilik/manajer) yang mengelola data master, staff, dan laporan bisnis.
- Developer yang mengembangkan dan memelihara aplikasi.

## Fitur Utama

### Fitur Tersedia

- **Auth & Roles** — Breeze login/register/reset password/verifikasi email, role-based redirect
- **Staff Management** — Admin-only CRUD, reset password, foto profil
- **Customer Management** — 18 field KTP, upload foto_ktp, workflow verifikasi (setujui/tolak)
- **Car Management** — CRUD + foto, tipe Matic/Manual, toggle visibilitas, admin-only delete
- **Rental (Penyewaan)** — Customer/mobil dropdown, auto-kalkulasi durasi & harga, sync status
- **Returns (Pengembalian)** — Input denda, auto-kalkulasi denda telat, tandai/batalkan lunas
- **Dashboard** — Kartu statistik + grafik Chart.js
- **Reports** — Statistik, Chart.js, PDF export (DOMPDF), filter tanggal
- **Settings** — Appearance, notifications, role access (admin-only)
- **Activity Log** — Spatie Activitylog — semua aksi CRUD tercatat
- **Public Pages** — Car listing + detail, WhatsApp booking, peta lokasi
- **Dark Theme** — Tailwind CSS v3 + Alpine.js, tema gelap konsisten

### Fitur Rencana Pengembangan

- Upload bukti pembayaran manual.
- Workflow refund/koreksi pembayaran.
- Notifikasi real-time (email/WA).
- API untuk integrasi pihak ketiga.

## Tech Stack

| Layer        | Technology                                            |
| ------------ | ----------------------------------------------------- |
| Backend      | Laravel 12, PHP 8.5                                   |
| Frontend     | Blade, Tailwind CSS v3 + PostCSS, Alpine.js, Chart.js |
| Database     | MySQL 8.4 (Laragon)                                   |
| Build        | Vite 7, Node 22                                       |
| Auth         | Laravel Breeze (Blade + Alpine stack)                 |
| PDF          | DOMPDF (barryvdh/laravel-dompdf)                      |
| Activity Log | Spatie Activitylog                                    |
| Icons        | Bootstrap Icons + inline SVG                          |
| Notifikasi   | SweetAlert2                                           |

## Instalasi Singkat

```bash
git clone https://github.com/RentsGuard/nrentcar.git
cd nrentcar
composer install
npm install
cp .env.example .env
php artisan key:generate
```

Buat database MySQL `nrentcar`, update `.env`:

```
DB_DATABASE=nrentcar
DB_USERNAME=root
DB_PASSWORD=
```

```bash
php artisan migrate:fresh --seed
npm run build
php artisan storage:link
php artisan serve
```

Dokumentasi instalasi lengkap: [`docs/installation.md`](docs/installation.md).

## Akses Lokal

| Role  | Email           | Password |
| ----- | --------------- | -------- |
| Admin | admin@gmail.com | 12345678 |
| Staff | staff@gmail.com | 12345678 |

Password seeded hanya untuk development. Ganti sebelum production.

## Menjalankan Test

```bash
php artisan test
# atau spesifik
php artisan test --filter=MobilTest
```

**66 test, 147 assertions.** Test menggunakan database terisolasi `rentscar_testing`.

## Build Asset Frontend

```bash
npm run build    # Production build
npm run dev      # Dev build dengan HMR
```

## Deployment

1. Set `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL=https://domain-anda.com`
2. Atur database hosting di `.env`
3. `php artisan migrate --force`
4. `php artisan storage:link`
5. `npm run build`
6. `php artisan config:cache`, `route:cache`, `view:cache`
7. Gunakan HTTPS, ganti password akun seed default

## Struktur Dokumentasi

```text
README.md
docs/
├── installation.md
├── features.md
├── dependency.md
├── refactoring.md
├── github-actions.md
```

## Tim Pengembang

| Nama                       | NIM          | Peran Proyek      |
| -------------------------- | ------------ | ----------------- |
| (Muhammad Sharif Al Aqsha) | (2411081035) | Project Manager   |
| (Zahra Cyurisma Hanena)    | (2411082041) | System Analyst    |
| (Nisrina Nur'aini Yurizal) | (2411082037) | Lead Programmer   |
| (Haikal Pratama)           | (2411081042) | Lead Programmer   |
| (Muhammad Gibran Pangestu) | (2411083021) | Quality Assurance |

## Dokumentasi

| Dokumen                                            | Deskripsi                                |
| -------------------------------------------------- | ---------------------------------------- |
| [`docs/installation.md`](docs/installation.md)     | Panduan instalasi & troubleshooting      |
| [`docs/features.md`](docs/features.md)             | Dokumentasi fitur aplikasi               |
| [`docs/dependency.md`](docs/dependency.md)         | Dependency backend & frontend            |
| [`docs/refactoring.md`](docs/refactoring.md)       | Catatan refactoring & perubahan struktur |
| [`docs/github-actions.md`](docs/github-actions.md) | Workflow CI/CD                           |

## Lisensi

MIT
