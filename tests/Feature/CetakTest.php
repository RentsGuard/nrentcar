<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Mobil;
use App\Models\Penyewaan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CetakTest extends TestCase
{
    use RefreshDatabase;

    public function test_cetak_awal_renders_pdf()
    {
        $customer = Customer::factory()->create([
            'nama_customer' => 'Excel Diestrada',
            'nik' => '1571083003990001',
            'no_hp' => '08998002183',
            'alamat_customer' => 'Komplek Jondul V Blok C No.10, Tabing',
            'kota_kabupaten' => 'Padang',
            'provinsi' => 'Sumatera Barat',
            'status_verifikasi' => 'disetujui',
        ]);

        $mobil = Mobil::factory()->create([
            'nama_mobil' => 'Xpander',
            'plat_mobil' => 'BA 1234 CD',
            'tipe_mobil' => 'Manual',
            'bahan_bakar' => 'Bensin',
            'harga_mobil' => 400000,
            'tahun_mobil' => 2020,
            'kapasitas_mobil' => 7,
            'status_mobil' => 'tersedia',
        ]);

        $user = User::factory()->create([
            'role' => 'admin',
        ]);

        $penyewaan = Penyewaan::factory()->create([
            'customer_id' => $customer->id,
            'mobil_id' => $mobil->id,
            'user_id' => $user->id,
            'tanggal_sewa' => '2026-09-05',
            'jam_sewa' => '08:00',
            'tanggal_kembali' => '2026-09-06',
            'jam_kembali' => '17:00',
            'total_harga' => 400000,
            'denda_per_jam' => 40000,
            'status' => 'aktif',
        ]);

        $this->actingAs($user);

        $response = $this->get("/laporan/awal/cetak/{$penyewaan->id}");

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');
    }
}
