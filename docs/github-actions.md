# GitHub Actions — RentsCar

## Status Saat Ini

CI workflow Laravel sudah dikonfigurasi dan digunakan untuk validasi pull request.

## Workflow yang Digunakan

File workflow aktif berada di [.github/workflows/laravel-check.yml](../.github/workflows/laravel-check.yml).

### Ringkasan workflow

- Menjalankan pemeriksaan saat push ke branch `main` dan saat pull request.
- Menggunakan service MySQL untuk uji integrasi.
- Menginstal dependency PHP dan Node.js.
- Membuat build frontend dengan Vite.
- Menjalankan migrasi Laravel dan pengujian otomatis.
- Menjalankan pemeriksaan format kode dengan Pint.

### Konfigurasi utama

```yaml
name: Laravel Check

on:
  push:
    branches:
      - main
  pull_request:

jobs:
  check:
    runs-on: ubuntu-latest
    env:
      APP_ENV: testing
      DB_CONNECTION: mysql
      DB_HOST: 127.0.0.1
      DB_PORT: 3306
      DB_DATABASE: rentscar_testing
      DB_USERNAME: sail
      DB_PASSWORD: password
```

## Catatan Penting

- Workflow menggunakan service MySQL dengan kredensial yang sesuai.
- Pastikan PHP extensions `pdo_mysql`, `mysqli`, `pdo_sqlite`, dan `sqlite3` tersedia.
- Proses testing mengandalkan migrasi database dan suite test Laravel.
