<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
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

        $data = [
            ['customer_id' => $customers[0]->id, 'verified_by' => $admin->id, 'tanggal_verifikasi' => '2026-06-03 10:00:00', 'status_verifikasi' => 'disetujui', 'catatan_verifikasi' => 'Dokumen KTP lengkap dan valid'],
            ['customer_id' => $customers[1]->id, 'verified_by' => $admin->id, 'tanggal_verifikasi' => '2026-06-07 10:00:00', 'status_verifikasi' => 'disetujui', 'catatan_verifikasi' => 'Data sesuai dengan KTP asli'],
            ['customer_id' => $customers[2]->id, 'verified_by' => $admin->id, 'tanggal_verifikasi' => '2026-06-27 10:00:00', 'status_verifikasi' => 'disetujui', 'catatan_verifikasi' => null],
            ['customer_id' => $customers[3]->id, 'verified_by' => null, 'tanggal_verifikasi' => null, 'status_verifikasi' => null, 'catatan_verifikasi' => 'Menunggu upload KTP'],
            ['customer_id' => $customers[4]->id, 'verified_by' => $admin->id, 'tanggal_verifikasi' => '2026-06-14 10:00:00', 'status_verifikasi' => 'ditolak', 'catatan_verifikasi' => 'Foto KTP tidak jelas, harap upload ulang'],
        ];

        foreach ($data as $d) {
            Customer::where('id', $d['customer_id'])->update([
                'status_verifikasi' => $d['status_verifikasi'],
                'verified_by' => $d['verified_by'],
                'tanggal_verifikasi' => $d['tanggal_verifikasi'],
                'catatan_verifikasi' => $d['catatan_verifikasi'],
            ]);
        }
    }
}
