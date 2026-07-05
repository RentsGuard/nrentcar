````md
# Installation Documentation

Dokumen ini menjelaskan langkah instalasi proyek **RentsCar - Sistem Manajemen Rental Mobil** pada lingkungan lokal.

## Persyaratan Sistem

* PHP 8.2 atau lebih baru
* Composer
* Node.js dan NPM
* MySQL atau MariaDB
* Git
* Web browser modern
* Terminal atau PowerShell

## Clone Repository

```bash
git clone https://github.com/RentsGuard/nrentcar.git
cd nrentcar
````

## Install Dependency Backend

```bash
composer install
```

Perintah ini membaca file `composer.json` dan memasang seluruh dependency PHP yang dibutuhkan aplikasi.

## Install Dependency Frontend

```bash
npm install
```

Perintah ini membaca file `package.json` dan memasang seluruh dependency frontend yang dibutuhkan aplikasi.

## Setup Environment

Salin file environment contoh:

```bash
cp .env.example .env
```

Pada Windows PowerShell, jika perintah `cp` tidak tersedia, gunakan:

```powershell
Copy-Item .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

## Setup Database

Buat database MySQL atau MariaDB melalui phpMyAdmin atau terminal.

Contoh nama database:

```text
rentscar
```

Sesuaikan konfigurasi database pada file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rentscar
DB_USERNAME=root
DB_PASSWORD=
SESSION_ENCRYPT=true
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=lax
```

Jalankan migration untuk membuat struktur tabel database:

```bash
php artisan migrate
```

## Setup Storage

Jalankan storage link untuk file publik seperti foto mobil dan foto profil:

```bash
php artisan storage:link
```

Foto KTP customer disimpan pada private disk dan hanya dapat diakses melalui route internal setelah login.

## Build Asset Frontend

### Production Build

```bash
npm run build
```

### Development Mode

```bash
npm run dev
```

> **Catatan Windows PowerShell:** Jika `npm` diblokir karena execution policy, gunakan `npm.cmd`.

```bash
npm.cmd run build
npm.cmd run dev
```

## Menjalankan Aplikasi

```bash
php artisan serve
```

Aplikasi akan berjalan pada alamat:

```text
http://127.0.0.1:8000
```

## Menjalankan Test

```bash
php artisan test
```

Proyek menggunakan framework testing bawaan Laravel yang berjalan di atas PHPUnit untuk menguji keandalan sistem.

Untuk menjalankan feature test saja:

```bash
php artisan test --testsuite=Feature
```

## Hak Akses Sistem

Sistem RentsCar memisahkan akses pengguna berdasarkan peran (Role-Based Access Control).

### Admin

* Mengelola data mobil
* Mengelola data pelanggan
* Mengelola transaksi rental
* Mengelola laporan
* Mengelola staff
* Mengelola pengaturan sistem
* Melakukan verifikasi customer
* Mengakses dashboard sistem

### Staff

* Melakukan transaksi rental
* Mengelola data pelanggan
* Melakukan proses pengembalian kendaraan
* Melihat data kendaraan yang tersedia
* Melihat laporan operasional

## Persiapan Hosting Production

Sebelum hosting, sesuaikan nilai berikut pada `.env` server:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://domain-anda.com

DB_DATABASE=nama_database_hosting
DB_USERNAME=user_database_hosting
DB_PASSWORD=password_database_hosting

SESSION_ENCRYPT=true
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=lax

ADMIN_WA_NUMBER=628xxxxxxxxxx
```

Jalankan perintah production setelah dependency terpasang dan `.env` sudah benar:

```bash
php artisan key:generate
php artisan migrate --force
php artisan storage:link
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Jika hosting menggunakan PowerShell dan `npm` diblokir, gunakan:

```bash
npm.cmd run build
```

Jangan gunakan akun seed default untuk production. Ganti email dan password admin/staff sebelum website dibuka publik.

## Troubleshooting

### APP_KEY Belum Dibuat

**Gejala**

```text
No application encryption key has been specified.
```

**Solusi**

```bash
php artisan key:generate
```

---

### Database Belum Tersedia

**Gejala**

```text
SQLSTATE[HY000] [1049] Unknown database
```

**Solusi**

* Buat database sesuai nilai `DB_DATABASE`
* Periksa `DB_USERNAME` dan `DB_PASSWORD` pada file `.env`
* Jalankan ulang migration

```bash
php artisan migrate
```

---

### NPM Diblokir PowerShell

**Gejala**

```text
npm.ps1 cannot be loaded because running scripts is disabled on this system
```

**Solusi**

```bash
npm.cmd install
npm.cmd run build
```

---

### Asset Masih Mengarah ke Vite Development Server

**Gejala**

```text
http://[::1]:5173
```

* File CSS tidak termuat
* File JavaScript tidak termuat
* Tampilan website tidak sesuai pada mode production

**Solusi**

* Hentikan Vite Development Server jika tidak digunakan
* Hapus file `public/hot` jika masih ada
* Jalankan build ulang

```bash
npm run build
```

---

### Cache Konfigurasi Bermasalah

**Solusi**

```bash
php artisan optimize:clear
```

---

### Permission Storage Bermasalah (Linux/macOS)

**Solusi**

```bash
chmod -R 775 storage bootstrap/cache
```

Pada Windows, pastikan folder `storage` dan `bootstrap/cache` memiliki izin tulis untuk aplikasi.

## Verifikasi Instalasi

Instalasi dianggap berhasil apabila:

* Halaman login dapat diakses
* Database berhasil terhubung
* Migration berhasil dijalankan
* Dashboard dapat diakses
* Data mobil dapat dikelola
* Transaksi rental dapat dilakukan
* Foto KTP hanya dapat dibuka setelah login
* Staff tidak dapat membuka menu pengaturan
* Asset frontend berhasil dibangun menggunakan Vite
* Seluruh test berjalan tanpa kegagalan

## Ringkasan Instalasi Cepat

```bash
git clone https://github.com/RentsGuard/nrentcar.git
cd nrentcar

composer install
npm install

cp .env.example .env
php artisan key:generate

php artisan migrate

php artisan storage:link
npm run build

php artisan serve
```

```
```
