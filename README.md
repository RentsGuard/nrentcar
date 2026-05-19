# Identifikasi Dependency & Package Laravel - Proyek PBL (RentsCar)

Dokumen analisis ini disusun untuk memenuhi tugas mata kuliah Konstruksi dan Evolusi Perangkat Lunak, Prodi Teknologi Rekayasa Perangkat Lunak, Politeknik Negeri Padang. Berdasarkan modul dan *Use Case Diagram* sistem RentsCar, berikut adalah identifikasi 8 package Laravel yang digunakan:

---

## 1. Laravel Breeze

### Analisis 5W+1H
| 5W+1H | Penjelasan |
| :--- | :--- |
| **What** | Laravel Breeze |
| **Why** | Digunakan untuk membangun sistem autentikasi seperti login, logout, dan manajemen session admin/staff. |
| **Who** | Admin dan staff sistem RentsCar. |
| **When** | Digunakan saat admin atau staff masuk ke dashboard sistem. |
| **Where** | Halaman login, autentikasi, dan dashboard admin/staff. |
| **How** | Diinstal menggunakan Composer dan Artisan untuk menghasilkan fitur autentikasi Laravel seperti login, middleware auth, session, dan proteksi halaman dashboard. |

* **Sumber Referensi:** [Laravel Breeze Documentation](https://laravel.com/docs/11.x/starter-kits#laravel-breeze)

---

## 2. Laravel Livewire

### Analisis 5W+1H
| 5W+1H | Penjelasan |
| :--- | :--- |
| **What** | Laravel Livewire |
| **Why** | Digunakan untuk membuat halaman dashboard dan data rental menjadi realtime tanpa refresh manual. |
| **Who** | Admin dan staff RentsCar. |
| **When** | Digunakan saat monitoring data customer, status mobil, atau data penyewaan. |
| **Where** | Dashboard admin, data penyewaan, dan status mobil. |
| **How** | Diinstal melalui Composer lalu dibuat dalam bentuk komponen Livewire yang terhubung ke database Laravel sehingga perubahan data dapat tampil otomatis. |

* **Sumber Referensi:** [Official Livewire Documentation](https://livewire.laravel.com/)

---

## 3. Laravel Excel

### Analisis 5W+1H
| 5W+1H | Penjelasan |
| :--- | :--- |
| **What** | Laravel Excel (maatwebsite/excel) |
| **Why** | Digunakan untuk export laporan penyewaan dan data customer ke format Excel. |
| **Who** | Admin dan pemilik usaha rental mobil. |
| **When** | Digunakan saat ingin mengunduh laporan harian atau bulanan. |
| **Where** | Halaman laporan dan statistik sistem. |
| **How** | Diinstal melalui Composer dan menggunakan fitur export class Laravel untuk menghasilkan file .xlsx dari data database. |

* **Sumber Referensi:** [Official Laravel Excel Documentation](https://docs.laravel-excel.com/)

---

## 4. Laravel DOMPDF

### Analisis 5W+1H
| 5W+1H | Penjelasan |
| :--- | :--- |
| **What** | Laravel DOMPDF (barryvdh/laravel-dompdf) |
| **Why** | Digunakan untuk mencetak laporan transaksi dan bukti penyewaan dalam format PDF. |
| **Who** | Admin dan staff RentsCar. |
| **When** | Digunakan saat mencetak laporan atau invoice transaksi. |
| **Where** | Halaman laporan dan detail transaksi. |
| **How** | Diinstal menggunakan Composer lalu menggunakan Blade template Laravel yang diproses menjadi PDF melalui fungsi `Pdf::loadView()`. |

* **Sumber Referensi:** [Laravel DOMPDF GitHub Repository](https://github.com/barryvdh/laravel-dompdf)

---

## 5. Spatie Laravel Permission

### Analisis 5W+1H
| 5W+1H | Penjelasan |
| :--- | :--- |
| **What** | Spatie Laravel Permission |
| **Why** | Digunakan untuk mengatur hak akses admin dan staff pada sistem. |
| **Who** | Admin dan staff sistem RentsCar. |
| **When** | Digunakan saat sistem menentukan akses fitur berdasarkan role pengguna. |
| **Where** | Manajemen user, dashboard admin, dan middleware sistem. |
| **How** | Diinstal menggunakan Composer lalu dikonfigurasi menggunakan role dan permission pada Laravel. |

* **Sumber Referensi:** [Official Spatie Permission Documentation](https://spatie.be/docs/laravel-permission)

---

## 6. Laravel Debugbar

### Analisis 5W+1H
| 5W+1H | Penjelasan |
| :--- | :--- |
| **What** | Laravel Debugbar (barryvdh/laravel-debugbar) |
| **Why** | Digunakan untuk membantu debugging dan monitoring error selama pengembangan sistem. |
| **Who** | Developer sistem RentsCar. |
| **When** | Digunakan selama tahap development dan testing aplikasi. |
| **Where** | Backend Laravel dan proses pengembangan aplikasi. |
| **How** | Diinstal melalui Composer dan dijalankan pada mode development untuk menampilkan query database, route, request, dan error Laravel. |

* **Sumber Referensi:** [Laravel Debugbar GitHub Repository](https://github.com/barryvdh/laravel-debugbar)

---

## 7. Intervention Image

### Analisis 5W+1H
| 5W+1H | Penjelasan |
| :--- | :--- |
| **What** | Intervention Image |
| **Why** | Digunakan untuk upload dan manipulasi gambar mobil pada sistem. |
| **Who** | Admin sistem RentsCar. |
| **When** | Digunakan saat menambah atau mengubah foto mobil. |
| **Where** | Modul data mobil. |
| **How** | Diinstal melalui Composer lalu digunakan untuk resize, compress, dan menyimpan gambar mobil ke storage Laravel. |

* **Sumber Referensi:** [Official Intervention Image Documentation](https://image.intervention.io/)

---

## 8. Laravel Sanctum

### Analisis 5W+1H
| 5W+1H | Penjelasan |
| :--- | :--- |
| **What** | Laravel Sanctum |
| **Why** | Digunakan untuk keamanan autentikasi API dan session pengguna. |
| **Who** | Admin, staff, dan sistem frontend. |
| **When** | Digunakan saat autentikasi API atau komunikasi frontend-backend. |
| **Where** | Backend API Laravel. |
| **How** | Diinstal melalui Composer dan digunakan untuk token authentication Laravel. |

* **Sumber Referensi:** [Laravel Sanctum Documentation](https://laravel.com/docs/11.x/sanctum)
