# Dependency — RentsCar

## Backend

| Package | Fungsi | Versi |
|---------|--------|-------|
| `laravel/framework` | Framework utama (MVC, ORM, routing) | ^12.x |
| `laravel/breeze` | Auth scaffolding (login, logout) | ^2.x |
| `laravel/livewire` | Komponen realtime UI tanpa refresh | ^4.x |
| `laravel/sanctum` | API token authentication | ^4.x |
| `barryvdh/laravel-dompdf` | Generate PDF (invoice, laporan) | ^3.1 |
| `spatie/laravel-activitylog` | Audit trail aktivitas user | ^5.0 |
| `intervention/image` | Image processing (upload/resize) | ^4.x |
| `blade-ui-kit/blade-heroicons` | SVG icon untuk dashboard | ^2.x |

> **Note:** `maatwebsite/excel` tidak bisa dipasang (PHP 8.5 incompatible). Diganti `openspout/openspout` untuk export Excel.

## Development & Testing

| Package | Fungsi |
|---------|--------|
| `phpunit/phpunit` | Unit testing |
| `fakerphp/faker` | Data dummy |
| `laravel/tinker` | REPL Laravel |
| `laravel/pint` | Code formatter |
| `laravel/pail` | Log monitoring |
| `barryvdh/laravel-debugbar` | Debugging tool |
>>>>>>> feature/tambah-data-denda

## Frontend

| Package | Fungsi | Versi |
|---------|--------|-------|
| `vite` | Build tool | ^5.x |
| `tailwindcss` | CSS framework (v4 via `@theme {}`) | ^4.x |
| `alpinejs` | UI interaktivitas (modal, sidebar) | ^3.x |
| `chart.js` | Grafik dashboard | ^4.x |
| `sweetalert2` | Notifikasi pop-up interaktif | ^11.x |
| `@fontsource/inter` | Font Inter | ^5.x |

## Cara Install

```bash
# Backend
composer require barryvdh/laravel-dompdf
composer require spatie/laravel-activitylog
>>>>>>> feature/tambah-data-denda

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
>>>>>>> feature/tambah-data-denda
