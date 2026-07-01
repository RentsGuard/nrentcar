# Refactoring — RentsCar

## Refactoring yang Sudah Selesai

### 1. Bootstrap 5.3 → Tailwind CSS v4

Semua tampilan yang menjadi tanggung jawab telah ditulis ulang dari kelas utilitas Bootstrap ke Tailwind v4.

**Perubahan:**
- Menghapus CDN CSS Bootstrap dari layout
- Menghapus kelas-kelas khusus Bootstrap
- Mengganti sistem grid dengan Tailwind `grid` dan `grid-cols-*`
- Mengganti utilitas Bootstrap dengan padanan Tailwind
- Tidak ada `tailwind.config.js` karena Tailwind v4 menggunakan blok CSS `@theme {}`

### 2. JavaScript Manual → Alpine.js

- Sidebar buka/tutup: `x-data`, `x-show`, dan `@click` menggantikan `classList.toggle()`
- Overlay backdrop dikelola melalui state Alpine
- `x-cloak` digunakan untuk mencegah FOUC

### 3. `confirm()` Bawaan → SweetAlert2

- Konfirmasi hapus staff menggunakan `Swal.fire()` dengan gaya kustom

### 4. Ikon Statis → Blade Heroicons

- Ikon sidebar dashboard diganti dengan `@heroicon('squares-2x2', 'solid')`

### 5. Audit Trail

- StaffController mencatat aktivitas create, update, dan delete melalui Spatie Activitylog

## Refactoring yang Masih Menunggu

- Anggota tim lain dapat melakukan refactoring CRUD yang menjadi tanggung jawab mereka sesuai konvensi Tailwind v4.

- GitHub Actions sudah diperbaiki dan dijaga agar workflow tetap berjalan lancar saat pull request, terutama terkait setup PHP, database, dan pengujian otomatis.
