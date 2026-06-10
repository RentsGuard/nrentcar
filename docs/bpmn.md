# BPMN — Proses Pengembalian & Denda

## Tujuan
Memodelkan alur pengembalian mobil + perhitungan denda dari awal hingga selesai.

## Diagram (Text-Based)

```text
+-----------+     +--------------+     +----------------+     +------------------+
| Staff     |     | Staff        |     | Staff          |     | Staff            |
| Pilih     |---->| Isi Form     |---->| Upload Foto    |---->| Klik Simpan     |
| Penyewaan |     | (tgl real,   |     | (opsional)     |     |                  |
|           |     |  denda rusak)|     |                |     |                  |
+-----------+     +--------------+     +----------------+     +--------+---------+
                                                                      |
                                                                      v
+-----------+     +--------------+     +----------------+     +------------------+
| Staff     |     | Staff        |     | Staff          |     | Staff            |
| Pilih     |---->| Isi Form     |---->| Upload Foto    |---->| Klik Simpan     |
| Penyewaan |     | (tgl real,   |     | (opsional)     |     |                  |
|           |     |  denda rusak)|     |                |     |                  |
+-----------+     +--------------+     +----------------+     +--------+---------+
                                                                      |
                                                                      v
                                                           +---------------------+
                                                           | Sistem: Validasi    |
                                                           | Data                |
                                                           +--------+-----+-----+
                                                                    |     |
                                                            Error   |     | OK
                                                                    v     v
                                                           +--------+     +----+--------+
                                                           | Tampilkan     | Hitung:      |
                                                           | Pesan Error   | - telat_jam |
                                                           +---------------+ - denda_telat|
                                                                           | - total_denda|
                                                                           | - status     |
                                                                           +----+--------+
                                                                                |
                                                                                v
                                                                   +------------------------+
                                                                   | Sistem: Simpan ke DB   |
                                                                   | - Insert pengembalian  |
                                                                   | - Upload foto          |
                                                                   | - Update status sewa   |
                                                                   |   => 'selesai'         |
                                                                   | - Activity log         |
                                                                   +-----------+------------+
                                                                               |
                                                                               v
                                                                   +------------------------+
                                                                   | Sistem: Redirect ke     |
                                                                   | Index + Success Message |
                                                                   +------------------------+
```

## Swimlanes

| Lane | Tasks |
|------|-------|
| **Staff** | Pilih penyewaan, isi form, upload foto, klik simpan |
| **Sistem** | Validasi, hitung denda, simpan DB, upload file, update status, activity log |

## Events (Edit Flow)

Sama seperti create, tapi:
- Pre-populate form dengan data existing
- Sistem re-kalkulasi saat update
- Jika ganti foto, hapus foto lama

## Events (Delete Flow)

```text
[Staff Klik Hapus] --> [SweetAlert2 Konfirmasi]
    --> [Ya] --> [Sistem: Hapus foto storage]
              --> [Sistem: Delete record]
              --> [Sistem: Update status penyewaan => 'aktif']
              --> [Activity log]
              --> [Redirect Index + Success Message]
    --> [Tidak] --> [Cancel]
```
