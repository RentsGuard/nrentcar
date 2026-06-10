# GitHub Issue — Draft

**Judul:** `[CR] Tambah Data Denda pada Modul Pengembalian`

**Labels:** `enhancement`, `change-request`

---

## Deskripsi Perubahan

Saat ini modul Pengembalian hanya memiliki tampilan (views) tanpa logika CRUD.
Data denda tidak dapat disimpan, diedit, atau dihapus. Perhitungan denda telat
per jam belum diimplementasikan.

Perubahan ini akan melengkapi PengembalianController dengan store/update/destroy,
mengimplementasikan auto-kalkulasi denda, dan menampilkan statistik denda di
Dashboard dan Laporan.

## Change Request

Tambah data denda — pengguna (staff/admin) dapat:
1. Mencatat pengembalian mobil dengan perhitungan denda otomatis
2. Mengedit data pengembalian dan denda
3. Menghapus data pengembalian
4. Melihat statistik denda di dashboard
5. Melihat data denda di laporan

## Komponen yang Terdampak

| Komponen | Ya/Tidak | Keterangan |
|----------|----------|------------|
| Use Case | Ya | UC-06: Mengelola Pengembalian & Denda, UC-07: Statistik Denda |
| BPMN | Ya | Proses pengembalian + perhitungan denda |
| ERD | Ya | Dokumentasi entitas pengembalian |
| Database | Tidak | Tabel & kolom sudah ada |
| Model | Tidak | Model sudah lengkap |
| Controller | Ya | Tambah store/update/destroy + logic denda |
| View | Ya | Tombol delete di index, populate select di create, info tambahan di edit |
| Route | Tidak | Semua route sudah terdaftar |
| Middleware | Tidak | Tidak ada perubahan hak akses |
| Dashboard | Ya | Card stat denda + recent returns |
| Laporan | Ya | Metrik denda + ekspor data denda |
| Seeder | Ya | PengembalianSeeder |
| Dokumentasi | Ya | HANDOFF, features, CHANGELOG, use case/BPMN/ERD |

## Impact Analysis

| Komponen | Dampak | Tindakan |
|----------|--------|----------|
| PengembalianController | Method store/update/destroy kosong | Implementasi CRUD + auto-kalkulasi |
| View index | Tombol delete belum ada | Tambah tombol hapus + SweetAlert2 |
| View create | Select penyewaan kosong | Populate dari DB, tampilkan info terkait |
| View edit | Field auto-calc tidak ditampilkan | Tambah readonly fields |
| DashboardController | Tidak ada metrik denda | Tambah query total denda, count pengembalian |
| Dashboard view | Card denda belum ada | Tambah card statistik |
| LaporanController | Tidak ada data denda | Tambah query metrik denda |
| Laporan view | Metrik denda belum ada | Tambah section denda |
| docs/HANDOFF.md | Status outdated | Update status |
| docs/features.md | Return process ❌ | Ubah jadi ✅ |

## Rencana Implementasi

| # | Task | File | Effort |
|---|------|------|--------|
| 1 | Implementasi `store()` — validasi, auto-kalkulasi, upload foto, update status | `PengembalianController.php` | Medium |
| 2 | Implementasi `update()` — re-kalkulasi, ganti foto | `PengembalianController.php` | Medium |
| 3 | Implementasi `destroy()` — hapus foto + record, update status | `PengembalianController.php` | Small |
| 4 | Populate select penyewaan di form create | `create.blade.php`, `Controller@create` | Small |
| 5 | Tambah field readonly auto-calc di edit | `edit.blade.php` | Small |
| 6 | Tambah tombol delete di index | `index.blade.php` | Small |
| 7 | Card stat denda di Dashboard | `DashboardController.php`, dashboard view | Medium |
| 8 | Metrik denda di Laporan | `LaporanController.php`, laporan view | Medium |
| 9 | Buat PengembalianFactory + Seeder | `factories/`, `seeders/` | Small |
| 10 | Update dokumentasi | HANDOFF, features, CHANGELOG | Small |
| 11 | Buat diagram use case, BPMN, ERD | `docs/` | Medium |

## Branch

`feature/tambah-data-denda`
