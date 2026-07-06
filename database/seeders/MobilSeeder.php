<?php

namespace Database\Seeders;

use App\Models\Mobil;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class MobilSeeder extends Seeder
{
    public function run(): void
    {
        $assetDir = __DIR__ . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'mobil';

        $sourceImages = [
            $assetDir . DIRECTORY_SEPARATOR . 'ToyotaAvanza.jpg',
            $assetDir . DIRECTORY_SEPARATOR . 'Brio.jpg',
            $assetDir . DIRECTORY_SEPARATOR . 'ToyotaFortuner.jpg',
        ];

        $imagePaths = [];
        foreach ($sourceImages as $i => $src) {
            $filename = 'foto_mobil/seed_' . basename($src);
            Storage::disk('public')->put($filename, file_get_contents($src));
            $imagePaths[] = $filename;
        }

        $mobils = [
            ['nama_mobil' => 'Toyota Avanza', 'plat_mobil' => 'B 1234 XYZ', 'tahun_mobil' => 2022, 'tipe_mobil' => 'Matic', 'kapasitas_mobil' => 3, 'harga_mobil' => 350000, 'bahan_bakar' => 'Bensin', 'status_mobil' => 'tersedia'],
            ['nama_mobil' => 'Honda Brio', 'plat_mobil' => 'D 5678 ABC', 'tahun_mobil' => 2023, 'tipe_mobil' => 'Matic', 'kapasitas_mobil' => 2, 'harga_mobil' => 250000, 'bahan_bakar' => 'Bensin', 'status_mobil' => 'tersedia'],
            ['nama_mobil' => 'Toyota Fortuner', 'plat_mobil' => 'B 9012 DEF', 'tahun_mobil' => 2024, 'tipe_mobil' => 'Matic', 'kapasitas_mobil' => 3, 'harga_mobil' => 750000, 'bahan_bakar' => 'Solar', 'status_mobil' => 'tersedia'],
            ['nama_mobil' => 'Daihatsu Xenia', 'plat_mobil' => 'F 3456 GHI', 'tahun_mobil' => 2021, 'tipe_mobil' => 'Matic', 'kapasitas_mobil' => 3, 'harga_mobil' => 300000, 'bahan_bakar' => 'Bensin', 'status_mobil' => 'tersedia'],
            ['nama_mobil' => 'Mitsubishi Pajero Sport', 'plat_mobil' => 'B 7890 JKL', 'tahun_mobil' => 2024, 'tipe_mobil' => 'Matic', 'kapasitas_mobil' => 3, 'harga_mobil' => 850000, 'bahan_bakar' => 'Solar', 'status_mobil' => 'tersedia'],
            ['nama_mobil' => 'Toyota Calya', 'plat_mobil' => 'B 1112 MNO', 'tahun_mobil' => 2023, 'tipe_mobil' => 'Manual', 'kapasitas_mobil' => 3, 'harga_mobil' => 200000, 'bahan_bakar' => 'Bensin', 'status_mobil' => 'tersedia'],
            ['nama_mobil' => 'Honda Civic', 'plat_mobil' => 'B 1314 PQR', 'tahun_mobil' => 2023, 'tipe_mobil' => 'Matic', 'kapasitas_mobil' => 2, 'harga_mobil' => 500000, 'bahan_bakar' => 'Bensin', 'status_mobil' => 'disewa'],
            ['nama_mobil' => 'Hyundai Ioniq', 'plat_mobil' => 'B 1516 STU', 'tahun_mobil' => 2024, 'tipe_mobil' => 'Matic', 'kapasitas_mobil' => 2, 'harga_mobil' => 600000, 'bahan_bakar' => 'Listrik', 'status_mobil' => 'maintenance'],
        ];

        foreach ($mobils as $i => $m) {
            $m['foto_mobil'] = $imagePaths[$i % count($imagePaths)];
            Mobil::create($m);
        }
    }
}
