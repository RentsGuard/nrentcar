<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Mobil;
use App\Models\Penyewaan;
use App\Models\User;
use Illuminate\Database\Seeder;

class PenyewaanSeeder extends Seeder
{
    public function run(): void
    {
        $staff = User::where('role', 'staff')->first();
        $admin = User::where('role', 'admin')->first();
        $customers = Customer::all();
        $mobils = Mobil::all();

        if ($customers->isEmpty() || $mobils->isEmpty()) {
            return;
        }

        $penyewaans = [
            [
                'customer_id' => $customers[0]->id, 'mobil_id' => $mobils[6]->id,
                'user_id' => $staff?->id ?? $admin->id,
                'tanggal_sewa' => '2026-06-15', 'jam_sewa' => '10:00',
                'tanggal_kembali' => '2026-06-18', 'jam_kembali' => '17:00',
                'lama_sewa' => 3, 'total_harga' => 1500000, 'denda_per_jam' => 50000, 'status' => 'aktif',
                'catatan' => 'Digunakan untuk acara keluarga',
            ],
            [
                'customer_id' => $customers[1]->id, 'mobil_id' => $mobils[0]->id,
                'user_id' => $staff?->id ?? $admin->id,
                'tanggal_sewa' => '2026-06-01', 'jam_sewa' => '08:00',
                'tanggal_kembali' => '2026-06-04', 'jam_kembali' => '17:00',
                'lama_sewa' => 3, 'total_harga' => 1050000, 'denda_per_jam' => 50000, 'status' => 'selesai',
                'catatan' => null,
            ],
            [
                'customer_id' => $customers[2]->id, 'mobil_id' => $mobils[1]->id,
                'user_id' => $admin->id,
                'tanggal_sewa' => '2026-06-22', 'jam_sewa' => '09:00',
                'tanggal_kembali' => '2026-06-25', 'jam_kembali' => '18:00',
                'lama_sewa' => 3, 'total_harga' => 750000, 'denda_per_jam' => 35000, 'status' => 'selesai',
                'catatan' => 'Perjalanan dinas',
            ],
            [
                'customer_id' => $customers[3]->id, 'mobil_id' => $mobils[2]->id,
                'user_id' => $staff?->id ?? $admin->id,
                'tanggal_sewa' => '2026-07-01', 'jam_sewa' => '10:00',
                'tanggal_kembali' => '2026-07-04', 'jam_kembali' => '14:00',
                'lama_sewa' => 3, 'total_harga' => 2250000, 'denda_per_jam' => 75000, 'status' => 'aktif',
                'catatan' => null,
            ],
            [
                'customer_id' => $customers[4]->id, 'mobil_id' => $mobils[3]->id,
                'user_id' => $admin->id,
                'tanggal_sewa' => '2026-06-12', 'jam_sewa' => '08:00',
                'tanggal_kembali' => '2026-06-12', 'jam_kembali' => '17:00',
                'lama_sewa' => 1, 'total_harga' => 300000, 'denda_per_jam' => 30000, 'status' => 'dibatalkan',
                'catatan' => 'Customer membatalkan karena sakit',
            ],
            [
                'customer_id' => $customers[0]->id, 'mobil_id' => $mobils[4]->id,
                'user_id' => $admin->id,
                'tanggal_sewa' => '2026-07-10', 'jam_sewa' => '07:00',
                'tanggal_kembali' => '2026-07-15', 'jam_kembali' => '20:00',
                'lama_sewa' => 5, 'total_harga' => 4250000, 'denda_per_jam' => 100000, 'status' => 'aktif',
                'catatan' => 'Perpanjangan sewa',
            ],
        ];

        foreach ($penyewaans as $p) {
            Penyewaan::create($p);
        }
    }
}
