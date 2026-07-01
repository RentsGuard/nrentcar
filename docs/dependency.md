# Dependency — RentsCar

## Backend

Berikut dependency utama yang dipakai pada backend Laravel:

| Package | Fungsi | Versi |
|---------|--------|-------|
| `laravel/framework` | Framework utama Laravel untuk routing, MVC, ORM, dan ekosistem aplikasi | ^12.x |
| `laravel/breeze` | Paket starter auth untuk login, register, logout, dan reset password | ^2.x |
| `laravel/livewire` | Membuat UI interaktif tanpa refresh halaman | ^4.x |
| `laravel/sanctum` | Autentikasi token untuk API sederhana | ^4.x |
| `barryvdh/laravel-dompdf` | Membuat file PDF seperti invoice atau laporan | ^3.1 |
| `spatie/laravel-activitylog` | Mencatat aktivitas pengguna untuk audit trail | ^5.0 |
| `intervention/image` | Mengolah gambar seperti resize dan upload | ^4.x |
| `blade-ui-kit/blade-heroicons` | Menyediakan icon SVG siap pakai untuk tampilan dashboard | ^2.x |

### Tabel 5W+1H per dependency

#### 1. Laravel Breeze

| 5W+1H | Penjelasan |
|-------|------------|
| What | Paket starter authentication untuk Laravel. |
| Why | Mempercepat pembuatan login, register, logout, dan reset password. |
| Where | Digunakan pada area autentikasi aplikasi. |
| When | Dipakai saat proyek membutuhkan sistem login dasar. |
| Who | Backend developer dan pengembang aplikasi. |
| How | Diinstal melalui Composer dan dipakai bersama scaffolding Laravel. |

#### 2. Laravel Livewire

| 5W+1H | Penjelasan |
|-------|------------|
| What | Library untuk membangun UI interaktif tanpa banyak JavaScript. |
| Why | Memudahkan pembuatan fitur dinamis seperti form, modal, dan filter. |
| Where | Digunakan pada halaman dashboard dan fitur interaktif. |
| When | Dipakai saat ingin fitur realtime tanpa reload halaman. |
| Who | Frontend developer dan fullstack developer. |
| How | Diinstal via Composer dan dipadukan dengan Blade. |

#### 3. Laravel Sanctum

| 5W+1H | Penjelasan |
|-------|------------|
| What | Paket autentikasi token untuk API Laravel. |
| Why | Mempermudah proteksi endpoint API sederhana. |
| Where | Digunakan pada API dan sistem autentikasi token. |
| When | Dipakai saat aplikasi membutuhkan akses API yang aman. |
| Who | Backend developer. |
| How | Menggunakan token API untuk mengakses resource yang dilindungi. |

#### 4. Laravel DOMPDF

| 5W+1H | Penjelasan |
|-------|------------|
| What | Paket untuk membuat dokumen PDF dari view Blade. |
| Why | Membantu membuat invoice, laporan, dan dokumen cetak. |
| Where | Digunakan pada fitur export PDF. |
| When | Dipakai saat pengguna perlu mengunduh file PDF. |
| Who | Backend developer dan admin aplikasi. |
| How | Menghasilkan PDF dari template Blade yang sudah dibuat. |

#### 5. Spatie Activity Log

| 5W+1H | Penjelasan |
|-------|------------|
| What | Paket pencatatan aktivitas pengguna. |
| Why | Berguna untuk audit trail dan pelacakan perubahan data. |
| Where | Digunakan pada modul yang memerlukan riwayat aktivitas. |
| When | Dipakai saat sistem perlu mencatat tindakan user. |
| Who | Admin, developer, dan tim maintenance. |
| How | Merekam aktivitas melalui log event yang terintegrasi dengan model. |

#### 6. Intervention Image

| 5W+1H | Penjelasan |
|-------|------------|
| What | Library untuk manipulasi gambar. |
| Why | Memudahkan proses resize, crop, dan validasi gambar. |
| Where | Digunakan pada upload foto profil dan gambar barang. |
| When | Dipakai saat aplikasi menerima input gambar. |
| Who | Backend developer. |
| How | Mengolah file gambar sebelum disimpan ke storage. |

#### 7. Blade Heroicons

| 5W+1H | Penjelasan |
|-------|------------|
| What | Paket icon SVG untuk Blade UI. |
| Why | Mempercepat pembuatan tampilan yang konsisten dan menarik. |
| Where | Digunakan pada tampilan dashboard dan navigasi. |
| When | Dipakai saat menampilkan icon pada elemen UI. |
| Who | Frontend developer dan UI designer. |
| How | Dipanggil langsung pada view Blade menggunakan komponen icon. |

> Catatan: `maatwebsite/excel` tidak bisa dipasang karena tidak kompatibel dengan PHP 8.5. Sebagai alternatif digunakan `openspout/openspout` untuk export Excel.

## Development & Testing

| Package | Fungsi |
|---------|--------|
| `phpunit/phpunit` | Unit testing |
| `fakerphp/faker` | Data dummy |
| `laravel/tinker` | REPL Laravel |
| `laravel/pint` | Code formatter |
| `laravel/pail` | Log monitoring |
| `barryvdh/laravel-debugbar` | Debugging tool |

## Frontend

| Package | Fungsi | Versi |
|---------|--------|-------|
| `vite` | Build tool | ^5.x |
| `tailwindcss` | CSS framework (v4 via `@theme {}`) | ^4.x |
| `alpinejs` | UI interaktivitas (modal, sidebar) | ^3.x |
| `chart.js` | Grafik dashboard | ^4.x |
| `sweetalert2` | Notifikasi pop-up interaktif | ^11.x |
| `@fontsource/inter` | Font Inter | ^5.x |

## 5W+1H Packaging Laravel & Dependency

- What (Apa): Proyek Laravel ini memakai packaging berbasis Composer untuk backend dan npm untuk frontend. Paket-paket utama didefinisikan di `composer.json` dan `package.json`, lalu diinstal ke `vendor/` dan `node_modules/`.
- Why (Mengapa): Packaging memudahkan instalasi, menjaga konsistensi versi, mempercepat development, dan mempermudah maintenance tanpa menulis dependency dari nol.
- Where (Di mana): Composer digunakan untuk dependency PHP seperti `laravel/framework`, `barryvdh/laravel-dompdf`, dan `spatie/laravel-activitylog`; npm digunakan untuk dependency frontend seperti `vite`, `tailwindcss`, `alpinejs`, dan `sweetalert2`.
- When (Kapan): Digunakan saat setup proyek, penambahan fitur baru, build frontend, serta saat deploy atau upgrade dependency.
- Who (Siapa): Backend developer, frontend developer, dan maintainer yang bertanggung jawab atas instalasi, update, dan testing dependency.
- How (Bagaimana): Gunakan `composer require` atau `composer install` untuk dependency PHP, lalu `npm install` atau `npm run build` untuk frontend. Pastikan `composer.lock` dan `package-lock.json` tetap terpantau agar versi konsisten di semua environment.

## Cara Install

```bash
# Backend
composer require barryvdh/laravel-dompdf spatie/laravel-activitylog

# Dev
composer require barryvdh/laravel-debugbar --dev

# Frontend
npm install chart.js alpinejs sweetalert2
npm run build
```

## Dampak Dependency

1. Mempercepat development — library siap pakai (PDF, aktivitas log, chart).
2. Standarisasi — komunitas luas, lebih aman dari implementasi manual.
3. Konsistensi — composer.lock + package-lock menjaga versi sama.
4. Risiko — kompatibilitas versi, vendor lock-in, dan konsumsi resource (misalnya DOMPDF yang memerlukan memori besar untuk dataset besar; solusinya chunking/queue).
