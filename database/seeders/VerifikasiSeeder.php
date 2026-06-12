<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use App\Models\Verifikasi;
use Illuminate\Database\Seeder;

class VerifikasiSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();
        $customers = Customer::all();

        if ($customers->isEmpty()) {
            return;
        }

        $verifikasis = [
            [
                'customer_id' => $customers[0]->id, 'verified_by' => $admin->id,
                'tanggal_verifikasi' => '2026-05-15', 'status_verifikasi' => 'disetujui',
                'catatan_verifikasi' => 'Dokumen KTP lengkap dan valid',
            ],
            [
                'customer_id' => $customers[1]->id, 'verified_by' => $admin->id,
                'tanggal_verifikasi' => '2026-05-20', 'status_verifikasi' => 'disetujui',
                'catatan_verifikasi' => 'Data sesuai dengan KTP asli',
            ],
            [
                'customer_id' => $customers[2]->id, 'verified_by' => $admin->id,
                'tanggal_verifikasi' => '2026-05-25', 'status_verifikasi' => 'disetujui',
                'catatan_verifikasi' => null,
            ],
            [
                'customer_id' => $customers[3]->id, 'verified_by' => null,
                'tanggal_verifikasi' => null, 'status_verifikasi' => 'menunggu',
                'catatan_verifikasi' => 'Menunggu upload KTP',
            ],
            [
                'customer_id' => $customers[4]->id, 'verified_by' => $admin->id,
                'tanggal_verifikasi' => '2026-05-10', 'status_verifikasi' => 'ditolak',
                'catatan_verifikasi' => 'Foto KTP tidak jelas, harap upload ulang',
            ],
        ];

        foreach ($verifikasis as $v) {
            Verifikasi::create($v);
        }
    }
}
