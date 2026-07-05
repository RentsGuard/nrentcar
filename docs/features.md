# Fitur — RentsCar

**Apa (What):** Daftar fitur yang sudah dan belum diimplementasikan.

**Kenapa (Why):** Referensi status pengembangan — fitur apa saja yang tersedia dan apa yang ditunda.

**Siapa (Who):** Developer, tester, dan pemilik proyek.

**Kapan (When):** Digunakan saat perencanaan sprint, code review, dan onboarding developer baru.

**Dimana (Where):** Seluruh aplikasi RentsCar — backend, frontend, dan halaman publik.

**Bagaimana (How):** Status fitur dikategorikan: Done, Public-Hosting Hardening, Deferred.

## Implementasi

| Fitur | Status | Catatan |
|-------|--------|---------|
| Login/Logout | Done | Redirect berbasis role, regenerasi session, throttle 5 percobaan |
| Dashboard Admin | Done | Kartu stat, grafik Chart.js pendapatan/customer, data terbaru |
| Dashboard Staff | Done | Dashboard operasional untuk role staff |
| CRUD Staff | Done | Admin-only: index, create, edit, delete, reset password |
| Landing Page | Done | Hero publik, grid mobil tersedia, kontak WhatsApp, peta |
| Daftar Mobil Publik | Done | Search/filter/sort, hanya mobil visible, navigasi mobile |
| Detail Mobil Publik | Done | Hanya mobil visible, CTA WhatsApp, tanpa plat nomor |
| Halaman Error | Done | 403, 404, 500, 503 — dark theme |
| CRUD Customer | Done | 18 field KTP, penyimpanan foto KTP privat, workflow verifikasi |
| Verifikasi Customer | Done | Admin-only approve/reject dan catatan verifikasi |
| CRUD Mobil | Done | Upload foto, manajemen status, toggle visibilitas, activity log |
| CRUD Penyewaan | Done | Dropdown customer verified + mobil tersedia, auto-kalkulasi |
| Pengembalian + Denda | Done | Catat pengembalian, hitung denda telat, denda kerusakan, status lunas |
| Profil | Done | Upload foto profil, ganti password |
| Laporan | Done | Kartu ringkasan, grafik Chart.js, ekspor PDF, filter tanggal |
| Pengaturan | Done | Admin-only: tampilan, notifikasi, role/akses |
| Activity Log | Done | Spatie Activitylog untuk aksi internal penting |
| Seeder | Done | Users, mobil, customer, penyewaan, pengembalian, verifikasi |
| Testing | Done | Feature test: auth, authorization, customer, mobil, penyewaan, pengembalian, PDF |

## Hardening Hosting Publik

| Area | Status | Catatan |
|------|--------|---------|
| Privasi KTP | Done | Upload ke private disk, akses via route terautentikasi |
| Proteksi mobil tersembunyi | Done | `/cars/{id}` hanya serve `is_visible = true` |
| Privasi armada publik | Done | Search/detail publik tidak tampilkan plat nomor |
| Akses pengaturan | Done | Semua route dan sidebar pengaturan admin-only |
| Default session | Done | `.env.example` mengaktifkan encrypted, secure, HTTP-only |
| Security headers | Done | Middleware global: frame, content-type, referrer, permissions, CSP |

## Ditunda

| Fitur | Alasan |
|-------|--------|
| Form booking publik online | Flow saat ini via WhatsApp — sesuai scope proyek |
| Payment gateway | Di luar scope proyek saat ini |
| Multi-tenant rental | Tidak diimplementasikan — prototipe single-business |
