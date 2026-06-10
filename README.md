# RentsCar — Sistem Informasi Rental Mobil

Sistem manajemen rental mobil berbasis web. Kelola mobil, pelanggan, sewa, verifikasi, pengembalian, denda, dan laporan — semua terpusat.

## Tech Stack

| Lapisan | Teknologi |
|---------|-----------|
| Backend | Laravel 12, PHP 8.3+ |
| Database | MySQL / MariaDB |
| Frontend | Blade, Tailwind CSS v4, Alpine.js |
| Build | Vite, Node.js |

## Quick Start

```bash
git clone https://github.com/RentsGuard/nrentcar.git
cd nrentcar
composer install && npm install
cp .env.example .env && php artisan key:generate
php artisan migrate && npm run build && php artisan serve
```

> 📖 Panduan lengkap: [docs/installation.md](docs/installation.md)

## Dokumentasi

| Dokumen | Isi |
|---------|-----|
| [docs/installation.md](docs/installation.md) | Instalasi lokal detail + troubleshooting |
| [docs/features.md](docs/features.md) | Daftar fitur & status |
| [docs/dependency.md](docs/dependency.md) | Dependency backend & frontend |
| [docs/refactoring.md](docs/refactoring.md) | Catatan refactoring |
| [docs/github-actions.md](docs/github-actions.md) | CI/CD pipeline |
| [CHANGELOG.md](CHANGELOG.md) | Riwayat perubahan |
| [docs/HANDOFF.md](docs/HANDOFF.md) | Handoff tim pengembang |

## Target Pengguna

- **Staff** — kelola pelanggan, verifikasi, sewa, pengembalian
- **Owner/Admin** — monitor seluruh operasi, laporan, pengaturan

## Tim Pengembang

| Nama | NIM | Peran |
|------|-----|-------|
| Muhammad Sharif Al Aqsha | 2411081035 | Project Manager |
| Nisrina Nur'aini Yurizal | 2411082037 | Lead Programmer |
| Zahra' Cyurisma Hanena | 2411082041 | System Analyst |
| Haikal Pratama | 2411081042 | AI Specialist |
| Muhammad Gibran Pangestu | 2411083021 | Quality Assurance |

**Repo:** [github.com/RentsGuard/nrentcar](https://github.com/RentsGuard/nrentcar)
