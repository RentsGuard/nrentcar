# GitHub Actions — RentsCar

## Current Status

No CI/CD pipeline configured yet.

## Recommended Setup

### PHP Lint & Tests

```yaml
name: Laravel CI

on: [push, pull_request]

jobs:
  laravel-tests:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v4
      - uses: shivammathur/setup-php@v2
        with:
          php-version: '8.5'
          extensions: mbstring, pdo_mysql, gd
      - run: composer install --no-progress
      - run: npm ci
      - run: npm run build
      - run: php artisan key:generate
      - run: php artisan test
```

### Node Build Check

```yaml
name: Node Build

on: [push, pull_request]

jobs:
  build:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v4
      - uses: actions/setup-node@v4
        with:
          node-version: '22'
      - run: npm ci
      - run: npm run build
```

## Notes

- Needs `.env` secrets configured in GitHub repo settings
- Database service container required for integration tests
