# Dependency - RentsCar

## Backend

| Package | Fungsi | Versi |
|---------|--------|-------|
| `laravel/framework` | Framework utama aplikasi (MVC, routing, ORM, validasi, session) | ^12.0 |
| `barryvdh/laravel-dompdf` | Generate PDF untuk laporan dan tanda terima | ^3.1 |
| `blade-ui-kit/blade-heroicons` | Icon Heroicons untuk dashboard | ^2.7 |
| `laravel/tinker` | REPL Laravel untuk development dan debugging ringan | ^2.10 |
| `spatie/laravel-activitylog` | Audit trail aktivitas user internal | ^5.0 |

## Development & Testing

| Package | Fungsi | Versi |
|---------|--------|-------|
| `fakerphp/faker` | Data dummy untuk factory dan seeder | ^1.23 |
| `laravel/pail` | Monitoring log saat development | ^1.2 |
| `laravel/pint` | Code formatter PHP | ^1.24 |
| `mockery/mockery` | Mocking untuk test | ^1.6 |
| `nunomaduro/collision` | Error output CLI yang lebih jelas | ^8.6 |
| `phpunit/phpunit` | Unit dan feature testing | ^11.5 |

## Frontend

| Package | Fungsi | Versi |
|---------|--------|-------|
| `@fontsource/inter` | Font Inter lokal melalui Vite | ^5.2 |
| `alpinejs` | Interaktivitas UI seperti sidebar dan state ringan | ^3.15 |
| `axios` | HTTP client bawaan frontend Laravel | ^1.18 |
| `sweetalert2` | Dialog konfirmasi dan notifikasi | ^11.26 |
| `@tailwindcss/vite` | Integrasi Tailwind CSS v4 dengan Vite | ^4.3 |
| `laravel-vite-plugin` | Integrasi asset Vite dengan Laravel | ^2.0 |
| `tailwindcss` | Utility-first CSS framework | ^4.3 |
| `vite` | Build tool frontend | ^7.0 |
| `concurrently` | Menjalankan server, queue, log, dan Vite secara paralel saat development | ^9.0 |

## CDN Assets

| Asset | Fungsi | Sumber |
|-------|--------|--------|
| Bootstrap Icons | Icon publik dan dashboard | `cdn.jsdelivr.net` |
| Chart.js | Grafik dashboard dan laporan | `cdn.jsdelivr.net` |
| Leaflet | Peta lokasi pada landing page | `unpkg.com` |

## Install

```bash
# Backend
composer install

# Frontend
npm install

# Production asset build
npm run build
```

## Dampak Dependency

1. **Mempercepat development** - library siap pakai untuk PDF, audit log, icon, chart, dan UI interaktif.
2. **Standarisasi** - package populer dengan dokumentasi dan komunitas yang luas.
3. **Konsistensi versi** - `composer.lock` dan `package-lock.json` menjaga versi dependency tetap sama antar environment.
4. **Risiko operasional** - DOMPDF dapat memakai memori besar jika dataset laporan terlalu besar, sehingga laporan besar sebaiknya difilter atau diproses bertahap.
5. **Kesiapan hosting** - asset frontend harus dibangun dengan `npm run build` sebelum deploy production.
