# Dependency — RentsCar

**Apa (What):** Semua paket pihak ketiga (dependency) yang digunakan aplikasi — backend (Composer), frontend (npm), dan CDN.

**Kenapa (Why):** Mempercepat pengembangan dengan library siap pakai. Standarisasi kode dengan package populer. Menjaga konsistensi versi antar environment via `composer.lock` dan `package-lock.json`.

**Siapa (Who):** Developer yang melakukan instalasi, update, atau debug dependency.

**Kapan (When):** Dibutuhkan saat:
- Clone repository pertama kali (`composer install`, `npm install`)
- Update versi dependency
- Debug masalah kompatibilitas atau performa

**Dimana (Where):**
- Backend: dipasang di `vendor/` via Composer
- Frontend: dipasang di `node_modules/` via npm
- CDN: dimuat langsung dari server pihak ketiga saat runtime

**Bagaimana (How):** Cara install:

```bash
# Backend
composer install

# Frontend
npm install

# Build production
npm run build
```

## Backend (Composer)

| Paket | Fungsi | Versi |
|-------|--------|-------|
| `laravel/framework` | Framework utama (MVC, routing, ORM, validasi, session) | ^12.0 |
| `barryvdh/laravel-dompdf` | Generate PDF untuk laporan dan tanda terima | ^3.1 |
| `blade-ui-kit/blade-heroicons` | Ikon Heroicons untuk dashboard | ^2.7 |
| `laravel/tinker` | REPL Laravel untuk debugging ringan | ^2.10 |
| `spatie/laravel-activitylog` | Audit trail aktivitas user internal | ^5.0 |

## Development & Testing

| Paket | Fungsi | Versi |
|-------|--------|-------|
| `fakerphp/faker` | Data dummy untuk factory dan seeder | ^1.23 |
| `laravel/pail` | Monitoring log saat development | ^1.2 |
| `laravel/pint` | Code formatter PHP (PSR-12) | ^1.24 |
| `mockery/mockery` | Mocking untuk test | ^1.6 |
| `nunomaduro/collision` | Error output CLI yang lebih jelas | ^8.6 |
| `phpunit/phpunit` | Unit dan feature testing | ^11.5 |

## Frontend (npm)

| Paket | Fungsi | Versi |
|-------|--------|-------|
| `@fontsource/inter` | Font Inter lokal via Vite | ^5.2 |
| `alpinejs` | Interaktivitas UI (sidebar, state ringan) | ^3.15 |
| `axios` | HTTP client bawaan Laravel | ^1.18 |
| `sweetalert2` | Dialog konfirmasi dan notifikasi | ^11.26 |
| `@tailwindcss/vite` | Integrasi Tailwind CSS v4 dengan Vite | ^4.3 |
| `laravel-vite-plugin` | Integrasi asset Vite dengan Laravel | ^2.0 |
| `tailwindcss` | Utility-first CSS framework | ^4.3 |
| `vite` | Build tool frontend | ^7.0 |
| `concurrently` | Jalankan server, Vite, dan log secara paralel | ^9.0 |

## CDN (Saat Runtime)

| Asset | Fungsi | Sumber |
|-------|--------|--------|
| Bootstrap Icons | Ikon publik dan dashboard | `cdn.jsdelivr.net` |
| Chart.js | Grafik dashboard dan laporan | `cdn.jsdelivr.net` |
| Leaflet | Peta lokasi pada landing page | `unpkg.com` |

## Catatan Penting

- DOMPDF dapat memakai memori besar jika dataset laporan terlalu besar. Filter laporan sebelum ekspor PDF.
- Asset frontend WAJIB dibangun dengan `npm run build` sebelum deploy ke production.
- CDN hanya boleh dimuat di halaman yang membutuhkan (Chart.js hanya di dashboard/laporan, Leaflet hanya di halaman dengan peta).
