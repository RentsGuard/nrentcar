<?php

namespace Database\Seeders;

use App\Models\Mobil;
use Illuminate\Database\Seeder;

class MobilSeeder extends Seeder
{
    public function run(): void
    {
        $mobils = [
            ['nama_mobil' => 'Toyota Avanza', 'plat_mobil' => 'B 1234 XYZ', 'tahun_mobil' => 2022, 'tipe_mobil' => 'Matic', 'kapasitas_mobil' => 7, 'harga_mobil' => 350000, 'bahan_bakar' => 'Bensin', 'status_mobil' => 'tersedia', 'foto_mobil' => 'foto_mobil/9nOpiyPTx0oxH92v4YtBBjIEz5xuwWP4avXPPlJx.jpg'],
            ['nama_mobil' => 'Honda Brio', 'plat_mobil' => 'D 5678 ABC', 'tahun_mobil' => 2023, 'tipe_mobil' => 'Matic', 'kapasitas_mobil' => 5, 'harga_mobil' => 250000, 'bahan_bakar' => 'Bensin', 'status_mobil' => 'tersedia', 'foto_mobil' => 'foto_mobil/BB5y9YIqMwFzMetZ7Bf2ppuwJlSYiDEDkW9eLlZp.jpg'],
            ['nama_mobil' => 'Toyota Fortuner', 'plat_mobil' => 'B 9012 DEF', 'tahun_mobil' => 2024, 'tipe_mobil' => 'Matic', 'kapasitas_mobil' => 7, 'harga_mobil' => 750000, 'bahan_bakar' => 'Solar', 'status_mobil' => 'tersedia', 'foto_mobil' => 'foto_mobil/Cnc62sg06AF73Ih3TK7xMtWbxWf63TeMRiPMbmsg.jpg'],
            ['nama_mobil' => 'Daihatsu Xenia', 'plat_mobil' => 'F 3456 GHI', 'tahun_mobil' => 2021, 'tipe_mobil' => 'Matic', 'kapasitas_mobil' => 7, 'harga_mobil' => 300000, 'bahan_bakar' => 'Bensin', 'status_mobil' => 'tersedia', 'foto_mobil' => 'foto_mobil/KY3UOM0t3VvH5Jnh2abtFeCzwWczO7uMZy9MeOOD.jpg'],
            ['nama_mobil' => 'Mitsubishi Pajero Sport', 'plat_mobil' => 'B 7890 JKL', 'tahun_mobil' => 2024, 'tipe_mobil' => 'Matic', 'kapasitas_mobil' => 7, 'harga_mobil' => 850000, 'bahan_bakar' => 'Solar', 'status_mobil' => 'tersedia', 'foto_mobil' => 'foto_mobil/MEJaQGsm2tm4csij5gIpYJsbxJDLrcQ88Z0kaMuP.jpg'],
            ['nama_mobil' => 'Toyota Calya', 'plat_mobil' => 'B 1112 MNO', 'tahun_mobil' => 2023, 'tipe_mobil' => 'Manual', 'kapasitas_mobil' => 7, 'harga_mobil' => 200000, 'bahan_bakar' => 'Bensin', 'status_mobil' => 'tersedia', 'foto_mobil' => 'foto_mobil/uZdUq227hr5EOHN0oxSEjS5TQMwLkzEaL5gVIkE5.jpg'],
            ['nama_mobil' => 'Honda Civic', 'plat_mobil' => 'B 1314 PQR', 'tahun_mobil' => 2023, 'tipe_mobil' => 'Matic', 'kapasitas_mobil' => 5, 'harga_mobil' => 500000, 'bahan_bakar' => 'Bensin', 'status_mobil' => 'disewa'],
            ['nama_mobil' => 'Hyundai Ioniq', 'plat_mobil' => 'B 1516 STU', 'tahun_mobil' => 2024, 'tipe_mobil' => 'Matic', 'kapasitas_mobil' => 5, 'harga_mobil' => 600000, 'bahan_bakar' => 'Listrik', 'status_mobil' => 'maintenance'],
        ];

        foreach ($mobils as $m) {
            Mobil::create($m);
        }
    }
}
