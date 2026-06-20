<?php

namespace Database\Seeders;

use App\Models\Penyewaan;
use App\Models\Pengembalian;
use App\Models\User;
use Illuminate\Database\Seeder;

class PengembalianSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();
        $selesaiPenyewaan = Penyewaan::where('status', 'selesai')->get();

        if ($selesaiPenyewaan->isEmpty()) {
            return;
        }

        $pengembalians = [
            [
                'penyewaan_id' => $selesaiPenyewaan[0]->id,
                'tanggal_pengembalian' => '2026-06-04 16:00:00',
                'telat_jam' => 0,
                'denda_per_jam' => 0,
                'denda_telat' => 0,
                'denda_kerusakan' => 0,
                'total_denda' => 0,
                'status_pengembalian' => 'tepat_waktu',
                'catatan' => 'Mobil dikembalikan tepat waktu, kondisi bersih.',
                'foto_kondisi' => null,
                'user_id' => $admin->id,
            ],
            [
                'penyewaan_id' => $selesaiPenyewaan[1]->id,
                'tanggal_pengembalian' => '2026-06-26 00:00:00',
                'telat_jam' => 6,
                'denda_per_jam' => 50000,
                'denda_telat' => 300000,
                'denda_kerusakan' => 0,
                'total_denda' => 300000,
                'status_pengembalian' => 'telat',
                'catatan' => 'Kembali telat 6 jam, kondisi mobil baik.',
                'foto_kondisi' => null,
                'user_id' => $admin->id,
            ],
        ];

        foreach ($pengembalians as $p) {
            Pengembalian::create($p);
        }
    }
}
