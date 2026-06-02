# Dependency Documentation - RentsCar

Dokumen ini menjelaskan dependency proyek Sistem Informasi Rental Mobil **RentsCar** berbasis Laravel sebagai bagian dari tugas mata kuliah Konstruksi dan Evolusi Perangkat Lunak, Program Studi Teknologi Rekayasa Perangkat Lunak, Politeknik Negeri Padang.

---

## Identitas

- **Nama proyek:** RentsCar - Sistem Manajemen Rental Mobil
- **Framework utama:** Laravel 13
- **Tujuan:** Mengidentifikasi dependency/package Laravel yang digunakan maupun yang direncanakan untuk mendukung pengembangan sistem, menjelaskan kegunaannya menggunakan pendekatan 5W+1H, serta menganalisis dampaknya terhadap evolusi perangkat lunak.

---

## Ringkasan

Dependency pada proyek RentsCar dikelola menggunakan:

- **Composer (Backend Laravel)**
- **NPM (Frontend assets)**

Dependency dikelompokkan menjadi:

- Dependency Backend  
- Dependency Development & Testing  
- Dependency Frontend  
- Dependency Rencana Pengembangan  

---

# Dependency Backend

| Package | Fungsi | Alasan | Versi | Risiko |
|----------|--------|--------|--------|--------|
| `laravel/framework` | Framework utama Laravel | Menyediakan MVC, routing, ORM, middleware | `^13.x` | Breaking change saat upgrade major |
| `laravel/breeze` | Autentikasi sistem | Login, register, session management | `^1.x` | Fitur terbatas untuk sistem kompleks |
| `laravel/livewire` | Komponen realtime UI | Dashboard realtime tanpa refresh | `^3.x` | Kompleksitas state management |
| `laravel/sanctum` | API authentication | Keamanan API token | `^3.x` | Risiko konfigurasi keamanan |
| `barryvdh/laravel-dompdf` | Generate PDF | Cetak invoice dan laporan rental | `^3.1` | Konsumsi memori tinggi |
| `maatwebsite/excel` | Export/Import Excel | Laporan data rental & customer | `^3.1` | Performa turun tanpa chunking |
| `spatie/laravel-activitylog` | Activity logging | Audit trail aktivitas user | `^5.0` | Database membesar |
| `intervention/image` | Image processing | Upload dan resize gambar mobil | `^2.x` | Beban server tinggi |
| `blade-ui-kit/blade-heroicons` | Icon UI | Icon SVG dashboard | `^2.x` | Perubahan icon saat update |

---

# Dependency Development & Testing

| Package | Fungsi | Alasan | Versi | Risiko |
|----------|--------|--------|--------|--------|
| `phpunit/phpunit` | Unit testing | Testing backend sistem | `^12.x` | Menambah waktu development |
| `fakerphp/faker` | Data dummy | Testing data rental | `^1.23` | Data dummy bisa masuk production |
| `laravel/tinker` | REPL Laravel | Debug database & model | `^3.x` | Risiko perubahan data |
| `laravel/pint` | Code formatter | Standarisasi coding Laravel | `^1.x` | Auto-format konflik git |
| `laravel/pail` | Log monitoring | Debug realtime log | `^1.x` | Tidak untuk production |
| `barryvdh/laravel-debugbar` | Debugging tool | Monitoring query & request | `^3.x` | Hanya development |

---

# Dependency Frontend

| Package | Fungsi | Alasan | Versi | Risiko |
|----------|--------|--------|--------|--------|
| `vite` | Build tool | Compile asset cepat | `^5.x` | Butuh Node.js kompatibel |
| `tailwindcss` | CSS framework | UI modern responsive | `^4.x` | Perubahan class syntax |
| `laravel-vite-plugin` | Integrasi Laravel | Hubungkan Blade & asset | `^3.x` | Build error jika salah konfigurasi |
| `alpinejs` | UI interaktif | Modal, dropdown, sidebar | `^3.x` | Tidak cocok aplikasi kompleks |
| `chart.js` | Visualisasi data | Grafik rental | `^4.x` | Konfigurasi kompleks |
| `sweetalert2` | UI alert | Notifikasi interaktif | `^11.x` | Dependency eksternal |
| `@fontsource/inter` | Font UI | Typography modern | `^5.x` | Menambah ukuran asset |

---

# Dependency Rencana Pengembangan

| Package | Fungsi | Modul Rencana | Alasan |
|----------|--------|---------------|--------|
| `spatie/laravel-permission` | Role & permission | Manajemen akses user | Kontrol akses granular |
| `maatwebsite/excel` | Export lanjutan | Laporan keuangan | Analisis data bisnis |
| `barryvdh/laravel-dompdf` | PDF lanjutan | Invoice resmi | Dokumentasi cetak |
| `consoletvs/charts` | Dashboard chart | Statistik rental | Visualisasi data |
| `FastAPI / Flask` | AI forecasting | Prediksi permintaan rental | Machine learning |

---

## Analisis 5W+1H

## 1. Laravel Breeze

| 5W+1H | Penjelasan                                                                                                   |
| ----- | ------------------------------------------------------------------------------------------------------------ |
| What  | Laravel Breeze (Authentication Laravel)                                                                      |
| Why   | Digunakan untuk membangun sistem autentikasi seperti login, logout, register, dan manajemen session pengguna |
| Who   | Admin dan Staff                                                                                              |
| When  | Saat pengguna melakukan login atau logout dari sistem                                                        |
| Where | Modul autentikasi (Login, Register, Dashboard)                                                               |
| How   | Menggunakan Laravel Breeze scaffold yang menyediakan fitur autentikasi bawaan Laravel                        |

**Referensi:**

* https://laravel.com/docs/starter-kits#laravel-breeze

---

## 2. Laravel Livewire

| 5W+1H | Penjelasan                                                                   |
| ----- | ---------------------------------------------------------------------------- |
| What  | Laravel Livewire                                                             |
| Why   | Membuat halaman lebih interaktif tanpa perlu reload halaman secara penuh     |
| Who   | Admin dan Staff                                                              |
| When  | Saat monitoring data customer, mobil, dan transaksi rental                   |
| Where | Dashboard dan halaman manajemen data                                         |
| How   | Menggunakan komponen Livewire yang terhubung langsung dengan backend Laravel |

**Referensi:**

* https://livewire.laravel.com/docs

---

## 3. Laravel Sanctum

| 5W+1H | Penjelasan                                                          |
| ----- | ------------------------------------------------------------------- |
| What  | Laravel Sanctum                                                     |
| Why   | Menyediakan autentikasi API yang aman menggunakan token             |
| Who   | Sistem Backend dan Frontend                                         |
| When  | Saat melakukan request ke API yang memerlukan autentikasi           |
| Where | Backend API Laravel                                                 |
| How   | Menggunakan token authentication yang dikelola oleh Laravel Sanctum |

**Referensi:**

* https://laravel.com/docs/sanctum

---

## 4. Spatie Activitylog

| 5W+1H | Penjelasan                                             |
| ----- | ------------------------------------------------------ |
| What  | Spatie Laravel Activitylog                             |
| Why   | Mencatat aktivitas pengguna sebagai audit trail sistem |
| Who   | Admin dan Owner                                        |
| When  | Saat terjadi Create, Update, atau Delete data          |
| Where | Modul administrasi dan manajemen data                  |
| How   | Menggunakan trait `LogsActivity` pada model Laravel    |

**Referensi:**

* https://spatie.be/docs/laravel-activitylog
* https://github.com/spatie/laravel-activitylog

---

## 5. Laravel DOMPDF

| 5W+1H | Penjelasan                                                 |
| ----- | ---------------------------------------------------------- |
| What  | Laravel DOMPDF                                             |
| Why   | Menghasilkan file PDF untuk invoice dan laporan transaksi  |
| Who   | Admin dan Customer                                         |
| When  | Saat mencetak invoice atau laporan                         |
| Where | Modul laporan dan transaksi                                |
| How   | Mengubah Blade View menjadi PDF menggunakan library DOMPDF |

**Referensi:**

* https://github.com/barryvdh/laravel-dompdf

---

## 6. Laravel Excel

| 5W+1H | Penjelasan                                             |
| ----- | ------------------------------------------------------ |
| What  | Laravel Excel (maatwebsite/excel)                      |
| Why   | Mengekspor data laporan ke format Excel atau CSV       |
| Who   | Admin dan Owner                                        |
| When  | Saat melakukan export laporan                          |
| Where | Modul laporan dan statistik                            |
| How   | Menggunakan Export Class yang disediakan Laravel Excel |

**Referensi:**

* https://docs.laravel-excel.com
* https://github.com/SpartnerNL/Laravel-Excel

---

## 7. Intervention Image

| 5W+1H | Penjelasan                                           |
| ----- | ---------------------------------------------------- |
| What  | Intervention Image                                   |
| Why   | Mengelola upload, resize, dan optimasi gambar mobil  |
| Who   | Admin                                                |
| When  | Saat menambah atau memperbarui data mobil            |
| Where | Modul manajemen mobil                                |
| How   | Memproses gambar sebelum disimpan ke storage Laravel |

**Referensi:**

* https://image.intervention.io


# Cara Install Dependency (RentsCar)

Pada proyek RentsCar, dependency dikelola menggunakan dua ekosistem utama, yaitu Composer untuk backend Laravel dan NPM untuk frontend. Setiap dependency memiliki fungsi tertentu untuk mendukung fitur sistem seperti autentikasi, manajemen data, laporan, hingga tampilan antarmuka.

## Install Dependency Composer (Backend)

Composer digunakan untuk mengelola library PHP pada Laravel. Setiap package dapat ditambahkan menggunakan perintah berikut:
```bash 
composer require nama-vendor/nama-package
```

Perintah ini akan secara otomatis menambahkan package ke dalam file composer.json dan mengunduh dependency ke dalam folder vendor.

Pada proyek RentsCar, beberapa dependency utama backend yang digunakan adalah:

```bash 
composer require barryvdh/laravel-dompdf
composer require spatie/laravel-activitylog
```

* **laravel-dompdf digunakan untuk menghasilkan dokumen PDF seperti invoice rental mobil dan laporan transaksi.
s* **patie/laravel-activitylog digunakan untuk mencatat seluruh aktivitas pengguna seperti create, update, dan delete data sebagai audit trail sistem.

## Install Dependency Development

Dependency development adalah package yang hanya digunakan pada tahap pengembangan (development environment) dan tidak disertakan pada production.
```bash 
composer require nama-vendor/nama-package --dev
```
Contoh pada RentsCar:

```bash 
composer require barryvdh/laravel-debugbar --dev
```

* **Package ini digunakan untuk membantu developer dalam melakukan debugging.
* **Menampilkan query database, request, dan response secara real-time pada browser.
* **Tidak diaktifkan di production karena hanya untuk kebutuhan pengembangan.

## Install Dependency Frontend

Frontend dependency pada RentsCar dikelola menggunakan NPM (Node Package Manager). Dependency ini digunakan untuk membangun tampilan antarmuka aplikasi.

```bash 
npm install nama-package
Contoh Dependency Frontend
npm install chart.js
npm install alpinejs
npm install sweetalert2
```
* **Chart.js digunakan untuk menampilkan grafik data rental seperti jumlah transaksi dan laporan pendapatan.
* **Alpine.js digunakan untuk memberikan interaktivitas ringan seperti modal, dropdown, dan sidebar.
* **SweetAlert2 digunakan untuk menampilkan notifikasi pop-up yang lebih interaktif dan modern dibanding alert default browser.

## Build Asset Frontend

Setelah semua dependency frontend terinstal, aset harus dikompilasi agar dapat digunakan oleh aplikasi.
```bash 
npm run build
```

Perintah ini akan mengompilasi file CSS dan JavaScript menjadi versi production.
Hasil build akan digunakan oleh Laravel melalui Vite agar halaman dapat dimuat lebih cepat dan efisien.

# Analisis Perubahan File Dependency

Dalam proyek RentsCar, terdapat beberapa file penting yang mengatur dependency sistem.

## composer.json

File ini berfungsi untuk mendefinisikan semua dependency backend yang digunakan dalam proyek Laravel RentsCar.

* **Berisi daftar package utama seperti Laravel Framework, DOMPDF, dan Activity Log.**
* **Menentukan versi minimum dan maksimum package yang diperbolehkan.**
* **Digunakan sebagai acuan instalasi dependency di semua environment.**

## composer.lock

File ini menyimpan versi pasti dari semua dependency backend yang telah diinstal.


* **Mengunci versi package agar tidak berubah di setiap environment.**
* **Menjamin konsistensi antara developer, staging, dan production.**
* **Mencegah bug akibat perbedaan versi library.**

# package.json

File ini digunakan untuk mendefinisikan dependency frontend pada proyek RentsCar.


* **Berisi daftar library seperti Vite, Tailwind CSS, Alpine.js, dan Chart.js.**
* **Mengatur script build seperti npm run dev dan npm run build.**
* **Menjadi acuan instalasi dependency frontend.**

## package-lock.json

File ini mengunci versi semua dependency frontend yang telah diinstal melalui NPM.


* **Menjamin semua developer menggunakan versi library yang sama.**
* **Menghindari perbedaan hasil build antar environment.**
* **Menjaga stabilitas aplikasi frontend.**

# Dampak Dependency pada Proyek RentsCar

Penggunaan dependency pada proyek RentsCar memberikan beberapa dampak penting terhadap pengembangan sistem.

1. Mempercepat Proses Development

Dengan adanya dependency seperti DOMPDF, Laravel Excel, dan Activity Log, pengembang tidak perlu membuat fitur dari awal.

Contohnya:

* **Generate invoice PDF tanpa membuat parser HTML sendiri
* **Export laporan ke Excel tanpa membangun library dari nol**
Mencatat aktivitas user secara otomatis
2. Standarisasi dan Keamanan Sistem

Dependency yang digunakan merupakan library yang sudah banyak digunakan oleh komunitas Laravel sehingga lebih aman dibandingkan implementasi manual.

Namun tetap diperlukan:

* **update versi secara berkala**
* **monitoring security vulnerability**

3. Meningkatkan Kualitas UI/UX**

Frontend dependency seperti Tailwind CSS, Alpine.js, Chart.js, dan SweetAlert2 membantu menciptakan tampilan sistem yang modern dan interaktif.

Hal ini berdampak pada:

* **dashboard lebih informatif**
* **interaksi pengguna lebih responsif**
* **pengalaman pengguna lebih baik**

4. Konsistensi Lingkungan Pengembangan

File seperti composer.lock dan package-lock.json memastikan seluruh developer menggunakan versi dependency yang sama.

Manfaatnya:

* **mengurangi error saat deploy**
* **menghindari konflik versi**
* **meningkatkan stabilitas sistem**

# Risiko Umum Dependency

Walaupun sangat membantu, penggunaan dependency juga memiliki beberapa risiko.

1. Kompatibilitas Versi

Perubahan besar pada Laravel atau library tertentu dapat menyebabkan error dan membutuhkan penyesuaian kode.

2. Ketergantungan Pihak Ketiga

Jika sebuah library tidak lagi dikembangkan, maka:

* **bug tidak diperbaiki**
* **keamanan tidak diperbarui**
* **sistem menjadi rentan**
3. Konsumsi Resource

Beberapa library seperti DOMPDF atau Excel export membutuhkan memori besar jika memproses data dalam jumlah besar.

Solusi:

* **chunking data**
* **queue processing**
4. Vendor Lock-in

Terlalu banyak bergantung pada library tertentu dapat menyulitkan migrasi ke teknologi lain di masa depan.

# Evaluasi Dependency Sistem RentsCar

Dependency utama pada proyek RentsCar telah disesuaikan dengan kebutuhan sistem rental mobil modern, yaitu:

* **Laravel Framework sebagai backend utama**
* **Laravel Breeze untuk autentikasi**
* **Laravel Sanctum untuk API security**
* **Livewire untuk UI interaktif**
* **DOMPDF untuk laporan dan invoice**
* **Laravel Excel untuk pengolahan data**
* **Activity Log untuk audit sistem**
* **Chart.js untuk visualisasi data**
* **Alpine.js untuk interaksi frontend**

Seluruh dependency tersebut mendukung fitur utama sistem seperti:

* **manajemen kendaraan**
* **transaksi rental**
* **manajemen pelanggan**
* **laporan keuangan**
* **dashboard monitoring**