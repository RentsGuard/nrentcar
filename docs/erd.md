# ERD — Modul Pengembalian & Denda

## Entity: pengembalian

### Tabel

| Column | Type | Constraint | Deskripsi |
|--------|------|-----------|-----------|
| id | BIGINT UNSIGNED | PK, AUTO_INCREMENT | Primary key |
| penyewaan_id | BIGINT UNSIGNED | FK → penyewaan(id), UNIQUE | Relasi 1:1 ke penyewaan |
| tanggal_kembali_real | DATETIME | NOT NULL | Tanggal real mobil dikembalikan |
| telat_jam | INT UNSIGNED | NULLABLE | Selisih jam telat (jika ada) |
| denda_per_jam | DECIMAL(12,2) | NULLABLE | Tarif denda per jam (copy dari penyewaan) |
| denda_telat | DECIMAL(12,2) | NULLABLE | Denda karena telat (telat_jam × denda_per_jam) |
| denda_kerusakan | DECIMAL(12,2) | NULLABLE | Denda karena kerusakan (input manual) |
| total_denda | DECIMAL(12,2) | NULLABLE | denda_telat + denda_kerusakan |
| status_pengembalian | ENUM('tepat_waktu','telat','rusak','telat_dan_rusak') | DEFAULT 'tepat_waktu' | Status otomatis |
| catatan | TEXT | NULLABLE | Catatan kondisi mobil |
| foto_kondisi | VARCHAR(255) | NULLABLE | Path foto kondisi mobil |
| created_at | TIMESTAMP | NULLABLE | Timestamp dibuat |
| updated_at | TIMESTAMP | NULLABLE | Timestamp diupdate |

### Entity-Relationship (Text Diagram)

```text
+----------------+          +----------------+
|   penyewaan    |          |  pengembalian  |
+----------------+          +----------------+
| id (PK)        |<-------->| id (PK)        |
| customer_id FK |     1   1| penyewaan_id   |
| mobil_id FK    |          |   (FK, UNIQUE) |
| user_id FK     |          | tanggal_kembali|
| tanggal_sewa   |          |   _real        |
| tanggal_kembali|          | telat_jam      |
| lama_sewa      |          | denda_per_jam  |
| total_harga    |          | denda_telat    |
| denda_per_jam  |          | denda_kerusakan|
| status         |          | total_denda    |
| catatan        |          | status_        |
| created_at     |          | pengembalian   |
| updated_at     |          | catatan        |
+----------------+          | foto_kondisi   |
       |                    | created_at     |
       |                    | updated_at     |
       |                    +----------------+
       |
       |  M:1
       v
+----------------+
|   customer      |
+----------------+
| id (PK)        |
| nama_customer  |
| ...            |
+----------------+

       |
       |  M:1
       v
+----------------+
|    mobil       |
+----------------+
| id (PK)        |
| nama_mobil     |
| plat_mobil     |
| ...            |
+----------------+

       |
       |  M:1
       v
+----------------+
|    users       |
+----------------+
| id (PK)        |
| nama_user      |
| email          |
| role           |
| ...            |
+----------------+
```

### Relasi

| Entity | Cardinality | To Entity | Via |
|--------|-------------|-----------|-----|
| penyewaan → pengembalian | 1 : 1 | Setiap penyewaan max 1 pengembalian | penyewaan_id (unique) |
| penyewaan → customer | M : 1 | Banyak sewa oleh 1 customer | customer_id |
| penyewaan → mobil | M : 1 | Banyak sewa untuk 1 mobil | mobil_id |
| penyewaan → users | M : 1 | Banyak sewa dicatat 1 staff | user_id |
| pengembalian → penyewaan | 1 : 1 | Setiap pengembalian untuk 1 penyewaan (inverse) | penyewaan_id |

### Ketentuan Bisnis

1. **1:1 strict** — Satu penyewaan hanya bisa memiliki satu pengembalian (UNIQUE constraint)
2. **Cascade** — Tidak ada cascade delete. `RESTRICT ON DELETE` untuk menjaga integritas data
3. **Status pengembalian** ditentukan otomatis:
   - `tepat_waktu`: telat_jam = 0 DAN denda_kerusakan = 0
   - `telat`: telat_jam > 0 DAN denda_kerusakan = 0
   - `rusak`: telat_jam = 0 DAN denda_kerusakan > 0
   - `telat_dan_rusak`: telat_jam > 0 DAN denda_kerusakan > 0
4. **denda_per_jam** di pengembalian adalah snapshot dari penyewaan.denda_per_jam pada saat create (antisipasi perubahan tarif)
