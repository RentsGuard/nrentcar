# GitHub Actions - RentsCar

## Current Status

No CI/CD pipeline is committed in this repository yet.

## Recommended Setup

### Laravel CI

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

### Production Build Check

```yaml
name: Frontend Build

on: [push, pull_request]

jobs:
  build:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v4
      - uses: actions/setup-node@v4
        with:
          node-version: '22'
          cache: npm
      - run: npm ci
      - run: npm run build
```

## Notes

- Do not store production `.env` values in the repository.
- Use GitHub repository secrets for deploy credentials.
- Tests require MySQL because `phpunit.xml` uses `DB_CONNECTION=mysql`.
- Deployment should still be triggered manually or from a protected branch after the domain, database name, database user, and password are ready.
