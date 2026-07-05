# GitHub Issue - Draft

**Judul:** `[SECURITY] Hardening Website untuk Hosting Publik`

**Labels:** `security`, `refactor`, `documentation`

---

## Deskripsi Perubahan

Website RentsCar sudah memiliki fitur utama untuk katalog publik, dashboard admin/staff, manajemen mobil, customer, penyewaan, pengembalian, dan laporan. Sebelum website digunakan secara publik, beberapa area perlu diperkuat agar data internal dan data identitas customer tidak mudah terekspos.

Perubahan ini berfokus pada proteksi file KTP, pembatasan akses pengaturan, perlindungan mobil tersembunyi, privasi data kendaraan di halaman publik, kesiapan environment hosting, dan pembaruan dokumentasi.

## Change Request

Hardening website untuk hosting publik:

1. Simpan foto KTP customer pada private disk
2. Buat route internal untuk melihat foto KTP setelah login
3. Batasi semua menu dan route pengaturan hanya untuk admin
4. Pastikan mobil yang disembunyikan tidak bisa dibuka lewat URL publik
5. Hapus pencarian dan tampilan plat nomor dari halaman publik
6. Tambahkan navigasi publik yang lebih jelas pada mobile
7. Perbarui `.env.example` untuk default session yang lebih aman
8. Perbarui dokumentasi fitur, dependency, instalasi, refactoring, dan deployment
9. Tambahkan regression test untuk akses dan privasi data

## Komponen yang Terdampak

| Komponen | Ya/Tidak | Keterangan |
|----------|----------|------------|
| Use Case | Ya | Public UI, autentikasi, customer, admin/staff access |
| BPMN | Tidak | Tidak mengubah alur proses utama |
| ERD | Tidak | Tidak mengubah struktur database |
| Database | Tidak | Tidak ada migration baru |
| Model | Ya | Accessor URL foto KTP mengarah ke route internal |
| Controller | Ya | CustomerController dan PublicMobilController |
| View | Ya | Public pages, customer KTP preview, sidebar dashboard |
| Route | Ya | Route KTP internal dan route pengaturan admin-only |
| Middleware | Ya | Menggunakan `auth` dan `role:admin` yang sudah ada |
| Dashboard | Ya | Sidebar staff tidak lagi menampilkan Pengaturan |
| Laporan | Tidak | Tidak mengubah laporan |
| Seeder | Tidak | Tidak mengubah seed data |
| Dokumentasi | Ya | README, CHANGELOG, docs fitur, instalasi, dependency, refactoring |

## Impact Analysis

| Komponen | Dampak | Tindakan |
|----------|--------|----------|
| `CustomerController` | Upload KTP sebelumnya memakai public disk | Simpan KTP baru pada private disk dan serve via route internal |
| `Customer` model | URL foto KTP sebelumnya mengarah ke `/storage` | Accessor diarahkan ke `/customer/{id}/ktp` |
| `routes/web.php` | Pengaturan bisa diakses staff | Pindahkan semua route pengaturan ke group `role:admin` |
| `PublicMobilController` | Hidden car bisa ditebak lewat `/cars/{id}` | Query detail publik wajib `is_visible = true` |
| Public car listing | Search publik bisa menemukan plat nomor | Search publik hanya nama dan tipe mobil |
| Public car detail | Plat nomor terlihat untuk pengunjung publik | Hapus tampilan plat nomor di detail publik |
| Public UI mobile | Link publik utama tersembunyi di mobile | Tambah mobile nav compact |
| `.env.example` | Session encryption belum aktif | Set `SESSION_ENCRYPT=true`, HTTP-only, same-site |
| Tests | Belum ada regression test untuk hardening ini | Tambah test akses settings, KTP, hidden car, dan search plat |

## Rencana Implementasi

| # | Task | File | Effort |
|---|------|------|--------|
| 1 | Simpan upload KTP ke private disk | `CustomerController.php` | Small |
| 2 | Tambah route response KTP internal dengan no-cache header | `CustomerController.php`, `routes/web.php` | Medium |
| 3 | Update preview KTP agar memakai route internal | `customer/show.blade.php`, `customer/edit.blade.php` | Small |
| 4 | Pindahkan pengaturan ke middleware admin | `routes/web.php` | Small |
| 5 | Sembunyikan link Pengaturan dari sidebar staff | `layout.blade.php` | Small |
| 6 | Proteksi public car detail dari hidden car | `PublicMobilController.php` | Small |
| 7 | Hapus public plate search/display | `PublicMobilController.php`, public mobil views | Small |
| 8 | Tambah mobile public nav dan perbaikan CTA | `welcome.blade.php`, public mobil views | Small |
| 9 | Update environment example untuk hosting | `.env.example` | Small |
| 10 | Update dokumentasi | `README.md`, `CHANGELOG.md`, `docs/` | Medium |
| 11 | Tambah regression test | `AuthorizationTest.php`, `CustomerTest.php` | Medium |

## Branch

`aqsha`
