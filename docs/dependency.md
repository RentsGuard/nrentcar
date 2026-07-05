# Dependency — RentsCar

**Apa (What):** Semua paket pihak ketiga (dependency) yang digunakan aplikasi — backend (Composer), frontend (npm), dan CDN.

**Kenapa (Why):** Mempercepat pengembangan dengan library siap pakai. Standarisasi kode dengan package populer. Menjaga konsistensi versi antar environment via `composer.lock` dan `package-lock.json`.

**Siapa (Who):** Developer yang melakukan instalasi, update, atau debug dependency.

**Kapan (When):** Dibutuhkan saat clone repository, update versi, atau debug masalah kompatibilitas.

**Dimana (Where):** Backend di `vendor/` (Composer), frontend di `node_modules/` (npm), CDN dimuat saat runtime.

**Bagaimana (How):**

```bash
composer install   # Backend
npm install        # Frontend
npm run build      # Build production
```

---

## Backend (Composer)

### 1. `laravel/framework` — ^12.0

| 5W+1H | Penjelasan |
|-------|-----------|
| What | Framework utama aplikasi — MVC, routing, ORM Eloquent, validasi, session, dan artisan CLI |
| Why | Menyediakan fondasi aplikasi: struktur kode terstandar, fitur keamanan bawaan, ekosistem package luas |
| Where | Seluruh aplikasi — dari controller hingga model, dari request hingga response |
| When | Digunakan setiap saat — setiap request melewati lifecycle Laravel |
| Who | Backend developer yang menulis controller, model, migration, dan test |
| How | Diinstal via Composer; dijalankan dengan `php artisan serve` atau web server |

### 2. `barryvdh/laravel-dompdf` — ^3.1

| 5W+1H | Penjelasan |
|-------|-----------|
| What | Package untuk generate file PDF dari HTML/Blade menggunakan DOMPDF |
| Why | Membutuhkan ekspor PDF untuk laporan penyewaan dan tanda terima |
| Where | Digunakan di LaporanController — method cetakAwal() dan cetakAkhir() |
| When | Saat user mencetak laporan awal atau akhir dalam format PDF |
| Who | Staff dan admin yang mengakses menu Laporan |
| How | Render view Blade ke HTML, lalu DOMPDF konversi ke PDF |

### 3. `blade-ui-kit/blade-heroicons` — ^2.7

| 5W+1H | Penjelasan |
|-------|-----------|
| What | Blade component untuk ikon Heroicons (outline + solid) |
| Why | Ikon konsisten di sidebar dashboard tanpa dependency CSS ikon tambahan |
| Where | Layout sidebar dashboard — `@svg('heroicon-s-squares-2x2', ...)` |
| When | Setiap render halaman dashboard admin/staff |
| Who | Developer yang mengubah navigasi sidebar |
| How | Panggil `@svg('heroicon-{style}-{nama}')` di Blade |

### 4. `laravel/tinker` — ^2.10

| 5W+1H | Penjelasan |
|-------|-----------|
| What | REPL (Read-Eval-Print Loop) interaktif Laravel via artisan |
| Why | Debugging cepat, query data, test kode tanpa harus menulis file |
| Where | Terminal — `php artisan tinker` |
| When | Saat development: debugging, cek data, test relationship |
| Who | Backend developer |
| How | Jalankan `php artisan tinker`, lalu tulis kode PHP/Laravel langsung |

### 5. `spatie/laravel-activitylog` — ^5.0

| 5W+1H | Penjelasan |
|-------|-----------|
| What | Package audit trail — mencatat aktivitas user ke database |
| Why | Melacak siapa melakukan apa dan kapan untuk keamanan dan akuntabilitas |
| Where | Dipanggil di controller: `activity()->performedOn($x)->log(...)` |
| When | Setiap aksi penting: create, update, delete data |
| Who | Admin dan staff — semua aktivitas tercatat otomatis |
| How | Panggil facade `activity()` di controller; data tersimpan di tabel `activity_log` |

---

## Development & Testing

### 6. `fakerphp/faker` — ^1.23

| 5W+1H | Penjelasan |
|-------|-----------|
| What | Library generating data dummy (nama, email, alamat, dll) |
| Why | Membutuhkan data realistis untuk factory dan seeder saat development |
| Where | Database factories — `define()` dan `definition()` |
| When | Saat migrate + seed, atau saat menulis test yang butuh data |
| Who | Developer yang membuat factory, seeder, atau test |
| How | Panggil `fake()->name()`, `fake()->email()`, dll di factory |

### 7. `laravel/pail` — ^1.2

| 5W+1H | Penjelasan |
|-------|-----------|
| What | Log viewer realtime di terminal untuk Laravel |
| Why | Melihat log aplikasi langsung tanpa buka file storage/logs |
| Where | Terminal — `php artisan pail` |
| When | Saat development untuk debug request dan error |
| Who | Backend developer |
| How | Jalankan `php artisan pail` untuk streaming log |

### 8. `laravel/pint` — ^1.24

| 5W+1H | Penjelasan |
|-------|-----------|
| What | Code formatter PHP untuk Laravel (PSR-12) |
| Why | Menjaga konsistensi gaya kode tanpa diskusi manual |
| Where | Seluruh file PHP di direktori `app/`, `config/`, `routes/`, `tests/` |
| When | Sebelum commit atau sebagai CI check |
| Who | Semua developer |
| How | Jalankan `./vendor/bin/pint` atau via GitHub Actions |

### 9. `mockery/mockery` — ^1.6

| 5W+1H | Penjelasan |
|-------|-----------|
| What | Library mocking untuk PHP — membuat objek palsu di test |
| Why | Mengisolasi kode yang diuji dari dependency eksternal |
| Where | Test file — `$mock = Mockery::mock(...)` |
| When | Saat menulis unit test yang membutuhkan mock object |
| Who | Developer yang menulis test |
| How | Definisikan mock dengan `shouldReceive()` dan return value |

### 10. `nunomaduro/collision` — ^8.6

| 5W+1H | Penjelasan |
|-------|-----------|
| What | Error handler CLI dengan tampilan lebih jelas untuk Artisan |
| Why | Mempermudah membaca error stack trace di terminal |
| Where | Semua output Artisan dan test runner |
| When | Setiap kali error terjadi di CLI |
| Who | Developer yang menjalankan artisan command atau test |
| How | Terintegrasi otomatis — tidak perlu konfigurasi manual |

### 11. `phpunit/phpunit` — ^11.5

| 5W+1H | Penjelasan |
|-------|-----------|
| What | Framework testing PHP standar industri |
| Why | Menjalankan unit test dan feature test untuk memvalidasi kode |
| Where | File di `tests/Feature/` dan `tests/Unit/` |
| When | Setiap sebelum deploy, setelah perubahan kode, atau di CI |
| Who | Semua developer |
| How | Jalankan `php artisan test` atau `./vendor/bin/phpunit` |

---

## Frontend (npm)

### 12. `@fontsource/inter` — ^5.2

| 5W+1H | Penjelasan |
|-------|-----------|
| What | Font Inter yang diinstal lokal via npm (bukan CDN) |
| Why | Font konsisten di seluruh halaman tanpa ketergantungan koneksi eksternal |
| Where | resources/css/app.css — `@import '@fontsource/inter';` |
| When | Setiap render halaman — font sudah termasuk di bundle CSS |
| Who | Developer frontend |
| How | Import di CSS; gunakan `font-family: 'Inter'` di Tailwind |

### 13. `alpinejs` — ^3.15

| 5W+1H | Penjelasan |
|-------|-----------|
| What | Library JavaScript ringan untuk interaktivitas UI |
| Why | Menggantikan jQuery — state reaktif untuk sidebar, dropdown, toggle tanpa build step |
| Where | Layout: sidebar open/close, form interaktif |
| When | Setiap interaksi user: klik hamburger menu, toggle password visibility |
| Who | Frontend developer |
| How | Tambah `x-data`, `x-show`, `@click` langsung di HTML |

### 14. `axios` — ^1.18

| 5W+1H | Penjelasan |
|-------|-----------|
| What | HTTP client untuk JavaScript (Promise-based) |
| Why | Bawaan Laravel untuk komunikasi frontend-backend via API |
| Where | resources/js/app.js — siap pakai |
| When | Saat ada request AJAX ke server |
| Who | Frontend developer |
| How | `axios.get('/api/...')` atau `axios.post('/api/...')` |

### 15. `sweetalert2` — ^11.26

| 5W+1H | Penjelasan |
|-------|-----------|
| What | Library dialog modern — notifikasi, konfirmasi, alert kustom |
| Why | Menggantikan `confirm()` dan `alert()` native dengan UI yang sesuai tema gelap |
| Where | View: konfirmasi hapus staff, hapus mobil |
| When | Saat user melakukan aksi destruktif (hapus data) |
| Who | Staff dan admin |
| How | Panggil `Swal.fire({...})` dengan opsi kustom (background, warna) |

### 16. `@tailwindcss/vite` — ^4.3

| 5W+1H | Penjelasan |
|-------|-----------|
| What | Plugin Vite untuk integrasi Tailwind CSS v4 |
| Why | Memungkinkan Tailwind v4 bekerja dengan Vite build system |
| Where | vite.config.js — plugin Tailwind |
| When | Setiap build asset: `npm run dev` atau `npm run build` |
| Who | Frontend developer |
| How | Didaftarkan di `plugins` array pada `vite.config.js` |

### 17. `laravel-vite-plugin` — ^2.0

| 5W+1H | Penjelasan |
|-------|-----------|
| What | Plugin resmi Laravel untuk integrasi Vite |
| Why | Menghubungkan Laravel dengan Vite — hot reload, asset versioning, directive Blade |
| Where | vite.config.js + layout.blade.php — `@vite('resources/css/app.css')` |
| When | Setiap render halaman — directive `@vite()` generate link ke asset |
| Who | Frontend developer |
| How | Pasang di `vite.config.js`; gunakan `@vite()` di Blade |

### 18. `tailwindcss` — ^4.3

| 5W+1H | Penjelasan |
|-------|-----------|
| What | Utility-first CSS framework |
| Why | Membangun UI kustom tanpa menulis CSS tradisional — cepat, konsisten, responsif |
| Where | Semua view Blade menggunakan utility classes Tailwind |
| When | Setiap pengembangan tampilan baru |
| Who | Frontend developer |
| How | Tambah kelas utility langsung di HTML: `class="flex items-center p-4"` |

### 19. `vite` — ^7.0

| 5W+1H | Penjelasan |
|-------|-----------|
| What | Build tool frontend modern (pengganti Webpack/Mix) |
| Why | HMR cepat saat development, bundle optimal saat production |
| Where | Seluruh asset frontend: CSS, JS, font |
| When | `npm run dev` untuk development, `npm run build` untuk production |
| Who | Frontend developer |
| How | Konfigurasi di `vite.config.js`; jalankan via npm scripts |

### 20. `concurrently` — ^9.0

| 5W+1H | Penjelasan |
|-------|-----------|
| What | Menjalankan beberapa perintah npm secara paralel |
| Why | Menjalankan artisan serve + Vite dev + log secara bersamaan |
| Where | `composer run dev` — menjalankan semua proses development |
| When | Saat development lokal |
| Who | Developer |
| How | Definisikan di `package.json` scripts; jalankan `npm run dev` atau `composer run dev` |

---

## CDN (Saat Runtime)

### 21. Bootstrap Icons

| 5W+1H | Penjelasan |
|-------|-----------|
| What | Library ikon berbasis Bootstrap — 2000+ ikon SVG |
| Why | Ikon gratis, konsisten, mudah dipakai via class `bi bi-*` |
| Where | Semua halaman — layout memuat CDN di `<head>` |
| When | Setiap render halaman |
| Who | Frontend developer |
| How | Tambah `<link>` ke `cdn.jsdelivr.net/npm/bootstrap-icons` di layout |

### 22. Chart.js

| 5W+1H | Penjelasan |
|-------|-----------|
| What | Library grafik JavaScript — bar, line, dan chart interaktif |
| Why | Visualisasi data dashboard dan laporan (pendapatan, penyewaan) |
| Where | Dashboard admin/staff, halaman laporan |
| When | Saat user membuka dashboard atau laporan |
| Who | Admin dan staff |
| How | Inisialisasi `new Chart(canvas, {...})` dengan data dari backend |

### 23. Leaflet

| 5W+1H | Penjelasan |
|-------|-----------|
| What | Library peta interaktif JavaScript (open-source, ringan) |
| Why | Menampilkan peta lokasi kantor di halaman publik |
| Where | Landing page (welcome) dan halaman tentang kami |
| When | Saat user membuka beranda atau tentang kami |
| Who | Pengunjung publik |
| How | Load dari `unpkg.com`, buat peta dengan `L.map()`, tambah marker |

---

## Catatan Penting

- DOMPDF dapat memakai memori besar jika dataset laporan terlalu besar. Filter laporan sebelum ekspor PDF.
- Asset frontend WAJIB dibangun dengan `npm run build` sebelum deploy ke production.
- CDN hanya boleh dimuat di halaman yang membutuhkan.
