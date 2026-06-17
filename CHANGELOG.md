# Changelog

## [Unreleased] — Planned

### Added
- Fitur perhitungan denda otomatis pada pengembalian (telat per jam, total denda)
- CRUD data pengembalian & denda (store, update, destroy)
- Tombol hapus pengembalian dengan konfirmasi SweetAlert2
- Card statistik denda di Dashboard (total denda, pengembalian hari ini)
- Metrik denda di halaman Laporan
- PengembalianFactory & PengembalianSeeder untuk data uji
- Dokumentasi use case, BPMN, dan ERD untuk modul pengembalian

### Changed
- Form create pengembalian: select penyewaan diisi dari database (hanya status aktif)
- Form edit pengembalian: menampilkan field auto-kalkulasi (telat_jam, denda_telat, total_denda)
- Status penyewaan otomatis berubah menjadi `selesai` saat pengembalian dicatat

### Fixed
- PengembalianController sekarang memiliki store(), update(), destroy() yang fungsional
