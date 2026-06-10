# Use Case — Modul Pengembalian & Denda

## UC-06: Mengelola Data Pengembalian & Denda

| Elemen | Deskripsi |
|--------|-----------|
| **Use Case ID** | UC-06 |
| **Nama** | Mengelola Data Pengembalian & Denda |
| **Aktor** | Staff, Admin |
| **Deskripsi** | Aktor mencatat pengembalian mobil, sistem menghitung denda otomatis, dan data disimpan |
| **Pre-condition** | Penyewaan aktif tersedia. Staff/login terautentikasi |
| **Post-condition** | Data pengembalian tersimpan, status penyewaan berubah jadi `selesai` |

### Flow Normal (Basic Flow)
1. Aktor memilih menu **Pengembalian**
2. Sistem menampilkan daftar pengembalian yang sudah tercatat
3. Aktor klik **Pengembalian Baru**
4. Sistem menampilkan form dengan daftar penyewaan aktif
5. Aktor memilih penyewaan, mengisi tanggal kembali real, denda kerusakan, catatan, dan foto
6. Aktor klik **Simpan**
7. Sistem menghitung:
   - `telat_jam` = selisih jam (real - jadwal)
   - `denda_telat` = telat_jam × denda_per_jam
   - `total_denda` = denda_telat + denda_kerusakan
   - `status_pengembalian` berdasarkan kondisi telat/rusak
8. Sistem menyimpan data, upload foto
9. Sistem mengubah status penyewaan jadi `selesai`
10. Sistem mencatat activity log

### Alternative Flow — Edit
- Aktor dapat mengubah tanggal real atau denda kerusakan
- Sistem menghitung ulang semua nilai otomatis

### Alternative Flow — Hapus
- Aktor menghapus data pengembalian
- Sistem mengembalikan status penyewaan ke `aktif`

---

## UC-07: Melihat Statistik Denda

| Elemen | Deskripsi |
|--------|-----------|
| **Use Case ID** | UC-07 |
| **Nama** | Melihat Statistik Denda |
| **Aktor** | Admin |
| **Deskripsi** | Admin melihat ringkasan denda pada Dashboard dan Laporan |
| **Pre-condition** | Admin login, sudah ada data pengembalian |
| **Post-condition** | Statistik ditampilkan |

### Flow Normal
1. Admin buka Dashboard
2. Sistem menampilkan card: total denda periode ini, jumlah pengembalian hari ini
3. Admin buka halaman Laporan
4. Sistem menampilkan metrik denda lengkap

---

## Diagram Use Case (Text)

```
                    +-------------------+
                    |   Sistem Rental   |
                    +-------------------+
                            |
          +-----------------+-----------------+
          |                                   |
  +-------+--------+               +----------+--------+
  | UC-06: Kelola  |               | UC-07: Lihat     |
  | Pengembalian   |               | Statistik Denda  |
  | & Denda        |               |                  |
  +-------+--------+               +----------+--------+
          |                                   |
          | (Staff, Admin)                    | (Admin)
          v                                   v
```

### Relasi UC ke Aktor
- **Staff** → UC-06
- **Admin** → UC-06, UC-07
