# GitHub Actions — RentsCar

**Apa (What):** Pipeline CI/CD untuk otomatisasi testing dan build.

**Kenapa (Why):** Memastikan setiap perubahan tidak merusak kode yang sudah berjalan. Test otomatis dijalankan setiap push/PR.

**Siapa (Who):** Semua developer yang melakukan push atau pull request ke branch `main`.

**Kapan (When):** Dijalankan otomatis oleh GitHub saat ada `push` atau `pull_request` ke `main`.

**Dimana (Where):** Berjalan di runner GitHub (Ubuntu). Services: MySQL 8.4.

**Bagaimana (How):** Workflow `.github/workflows/laravel-check.yml`.

## Workflow: Laravel CI

```yaml
name: Laravel CI

on: [push, pull_request]

jobs:
  laravel-tests:
    runs-on: ubuntu-latest

    services:
      mysql:
        image: mysql:8.4
        env:
          MYSQL_DATABASE: rentscar_testing
          MYSQL_ROOT_PASSWORD: root
        ports:
          - 3306:3306
        options: >-
          --health-cmd="mysqladmin ping -h 127.0.0.1 -uroot -proot"
          --health-interval=10s
          --health-timeout=5s
          --health-retries=5

    env:
      APP_ENV: testing
      APP_KEY: base64:AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA=
      DB_CONNECTION: mysql
      DB_HOST: 127.0.0.1
      DB_PORT: 3306
      DB_DATABASE: rentscar_testing
      DB_USERNAME: root
      DB_PASSWORD: root
      SESSION_DRIVER: array
      CACHE_STORE: array
      QUEUE_CONNECTION: sync
      MAIL_MAILER: array

    steps:
      - uses: actions/checkout@v4
      - uses: shivammathur/setup-php@v2
        with:
          php-version: '8.2'
          extensions: mbstring, pdo_mysql, gd, zip
          coverage: none
      - uses: actions/setup-node@v4
        with:
          node-version: '22'
          cache: npm
      - run: composer install --no-interaction --prefer-dist --no-progress
      - run: npm ci
      - run: npm run build
      - run: php artisan test --testsuite=Feature
```

Pipeline menjalankan:
1. `composer install`
2. `npm install` + `npm run build`
3. Laravel Pint (PSR-12 lint)
4. PHPUnit tests

## Catatan

- Jangan simpan nilai `.env` production di repository
- Gunakan GitHub repository secrets untuk kredensial deploy
- Test membutuhkan MySQL (`phpunit.xml` pakai `DB_CONNECTION=mysql`)
- Deployment tetap manual dari branch terproteksi
