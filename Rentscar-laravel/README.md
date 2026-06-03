# RentsCar - Sistem Informasi Rental Mobil

## Deskripsi Proyek

RentsCar adalah Sistem Informasi Rental Mobil berbasis web yang dirancang untuk membantu pengelolaan operasional bisnis penyewaan kendaraan secara digital. Sistem ini memudahkan pemilik dan staf rental dalam mengelola data mobil, data pelanggan, proses verifikasi pelanggan, serta transaksi penyewaan kendaraan secara terpusat.

Dokumentasi proyek disusun agar aplikasi mudah dipasang, dipelihara, dikembangkan, dan digunakan sebagai dasar kolaborasi tim selama proses pengembangan perangkat lunak.

---

# Tujuan Proyek

- Mengembangkan sistem rental mobil berbasis web yang terintegrasi.
- Mempermudah pengelolaan data kendaraan rental.
- Mempermudah pencatatan data pelanggan.
- Mengelola proses verifikasi pelanggan sebelum penyewaan.
- Mengelola transaksi penyewaan kendaraan secara digital.
- Menyediakan dashboard administrasi yang mudah digunakan.
- Meningkatkan efisiensi operasional bisnis rental mobil.

---

# Masalah Yang Diselesaikan

Sebelum menggunakan sistem:

- Data pelanggan masih dicatat secara manual.
- Riwayat penyewaan sulit dilacak.
- Informasi ketersediaan kendaraan tidak terpusat.
- Verifikasi pelanggan tidak terdokumentasi dengan baik.
- Penyusunan laporan transaksi membutuhkan waktu yang lama.

Setelah menggunakan RentsCar:

- Data pelanggan tersimpan dalam database.
- Riwayat penyewaan terdokumentasi dengan baik.
- Status kendaraan dapat dipantau secara real-time.
- Proses verifikasi pelanggan lebih terstruktur.
- Pengelolaan transaksi menjadi lebih efisien.

---

# Target Pengguna

## Staff

Bertanggung jawab untuk:

- Mengelola data pelanggan.
- Melakukan verifikasi pelanggan.
- Mengelola data kendaraan.
- Mengelola transaksi penyewaan.

## Pemilik (Owner)

Bertanggung jawab untuk:

- Memantau seluruh aktivitas penyewaan.
- Melihat data pelanggan.
- Melihat data kendaraan.
- Melihat riwayat transaksi penyewaan.
- Mengawasi operasional rental.

---

# Fitur Utama

## Manajemen User

- Login dan Logout.
- Pengelolaan akun pengguna.
- Role Pemilik dan Staff.

## Manajemen Customer

- Tambah customer.
- Ubah data customer.
- Hapus data customer.
- Melihat daftar customer.

## Verifikasi Customer

- Verifikasi identitas customer.
- Penyimpanan status verifikasi.
- Riwayat verifikasi customer.

## Manajemen Mobil

- Tambah data mobil.
- Edit data mobil.
- Hapus data mobil.
- Upload foto mobil.
- Pengelolaan status kendaraan.
- Pengelolaan harga sewa kendaraan.

## Manajemen Penyewaan

- Pencatatan transaksi penyewaan.
- Penentuan tanggal sewa.
- Penentuan tanggal pengembalian.
- Perhitungan lama sewa.
- Perhitungan total biaya sewa.
- Monitoring status penyewaan.

---

# Struktur Database

Sistem dibangun menggunakan beberapa entitas utama:

## User

Menyimpan data pengguna sistem.

- id_user
- nama_user
- email
- password
- role

## Customer

Menyimpan data pelanggan rental.

- id_customer
- nama_customer
- email
- no_hp
- alamat_customer
- nik

## Mobil

Menyimpan data kendaraan rental.

- id_mobil
- nama_mobil
- plat_mobil
- tahun_mobil
- tipe_mobil
- kapasitas_mobil
- harga_mobil
- foto_mobil
- bahan_bakar
- status_mobil

## Penyewaan

Menyimpan data transaksi rental.

- id_penyewaan
- tanggal_sewa
- tanggal_kembali
- lama_sewa
- total_harga
- status

## Verifikasi

Menyimpan data verifikasi customer.

- id_customer
- id_pemilik
- tanggal_verifikasi
- status_verifikasi
- catatan_verifikasi

---

# Tech Stack

## Backend

- Laravel 13
- PHP 8.3+

## Database

- MySQL / MariaDB

## Frontend

- Blade Template
- Tailwind CSS
- Alpine.js

## Build Tool

- Vite
- Node.js
- NPM

---

# Dependency / Packages

## Backend

- Laravel Breeze
- Laravel Livewire
- Laravel Sanctum
- Barryvdh Laravel DomPDF
- Maatwebsite Excel
- Spatie Activity Log
- Intervention Image
- Blade Heroicons

## Frontend

- Tailwind CSS
- Alpine.js
- Chart.js
- SweetAlert2
- Fontsource Inter

---

# Instalasi Singkat

```bash
git clone https://github.com/RentsGuard/nrentcar.git

cd nrentcar

composer install

npm install

cp .env.example .env

php artisan key:generate

php artisan migrate

npm run build

php artisan serve
```

---

# Struktur Dokumentasi

```text
README.md
CHANGELOG.md

docs/
├── installation.md
├── features.md
├── dependency.md
├── refactoring.md
└── github-actions.md
```

---

# Screenshot Proyek

Screenshot aplikasi akan ditambahkan setelah seluruh modul selesai dikembangkan dan diuji.

Rencana screenshot:

- Halaman Login
- Dashboard Admin
- Manajemen Customer
- Verifikasi Customer
- Manajemen Mobil
- Form Penyewaan
- Riwayat Penyewaan

---

# Dokumentasi

| Dokumen | Deskripsi |
|----------|----------|
| docs/installation.md | Panduan instalasi lokal |
| docs/features.md | Dokumentasi fitur sistem |
| docs/dependency.md | Dokumentasi dependency |
| docs/refactoring.md | Catatan refactoring |
| docs/github-actions.md | Dokumentasi CI/CD |
| CHANGELOG.md | Riwayat perubahan proyek |

---

## Tim Pengembang (Kelompok 3 - PBL TRIFATEAM)

| Nama | NIM | Peran Proyek |
| :--- | :---: | :--- |
| Muhammad sharif Al Aqsha | 2411081035 | Project Manager |
| Zahra' cyurisma hanena| 2411082041 | System Analyst |
| Nisrina Nur'aini yurizal | 2411082037 | Lead Programmer |
| Haikal Pratama | 2411081042| AI Specialist |
| Muhammad gibran pangestu | 2411083021 | Quality Assurance |


# Repository

Repository digunakan untuk pengelolaan source code, dokumentasi, kolaborasi tim, dan pencatatan evolusi perangkat lunak selama proses pengembangan proyek RentsCar.

Repository:

https://github.com/RentsGuard/nrentcar