# Dependency — RentsCar

## Backend

| Package | Fungsi | Versi |
|---------|--------|-------|
| `laravel/framework` | Framework utama | ^12.x |
| `laravel/breeze` | Auth scaffolding | ^2.x |
| `laravel/livewire` | Komponen realtime | ^4.x |
| `laravel/sanctum` | API token auth | ^4.x |
| `barryvdh/laravel-dompdf` | Generate PDF | ^3.1 |
| `spatie/laravel-activitylog` | Audit trail | ^5.0 |
| `intervention/image` | Image processing | ^4.x |
| `blade-ui-kit/blade-heroicons` | SVG icons | ^2.x |

> `maatwebsite/excel` incompatible PHP 8.5 → pakai `openspout/openspout`

## Dev & Testing

| Package | Fungsi |
|---------|--------|
| `phpunit/phpunit` | Unit test |
| `fakerphp/faker` | Data dummy |
| `laravel/pint` | Code formatter |
| `barryvdh/laravel-debugbar` | Debug |

## Frontend

| Package | Fungsi | Versi |
|---------|--------|-------|
| `vite` | Build tool | ^5.x |
| `tailwindcss` | CSS framework (v4) | ^4.x |
| `alpinejs` | UI interaktivitas | ^3.x |
| `chart.js` | Grafik | ^4.x |
| `sweetalert2` | Notifikasi | ^11.x |
| `@fontsource/inter` | Font Inter | ^5.x |

## Install

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

1. **Mempercepat dev** — library siap pakai (PDF, aktivitas log, chart)
2. **Standarisasi** — komunitas luas, lebih aman dari implementasi manual
3. **Konsistensi** — composer.lock + package-lock jamin versi sama
4. **Risiko** — kompatibilitas versi, vendor lock-in, konsumsi resource (DOMPDF butuh memori besar untuk dataset besar → solusi: chunking/queue)
