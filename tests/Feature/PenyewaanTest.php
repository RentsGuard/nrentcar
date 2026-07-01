<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Mobil;
use App\Models\Penyewaan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PenyewaanTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected Customer $customer;

    protected Mobil $mobil;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::create([
            'nama_user' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('123456'),
            'role' => 'admin',
        ]);

        $this->customer = Customer::create([
            'nama_customer' => 'Budi Santoso',
            'no_hp' => '081234567890',
            'nik' => '3174010101900001',
            'alamat_customer' => 'Jl. Merdeka No. 1',
            'status_verifikasi' => 'disetujui',
        ]);

        $this->mobil = Mobil::create([
            'nama_mobil' => 'Toyota Avanza',
            'plat_mobil' => 'B 1234 XYZ',
            'tahun_mobil' => 2023,
            'tipe_mobil' => 'Matic',
            'kapasitas_mobil' => 3,
            'bahan_bakar' => 'Bensin',
            'harga_mobil' => 350000,
            'status_mobil' => 'tersedia',
            'managed_by' => $this->admin->id,
        ]);
    }

    public function test_index_shows_penyewaans(): void
    {
        $response = $this->actingAs($this->admin)->get('/penyewaan');
        $response->assertStatus(200);
    }

    public function test_create_form_loads(): void
    {
        $response = $this->actingAs($this->admin)->get('/penyewaan/create');
        $response->assertStatus(200);
    }

    public function test_store_penyewaan(): void
    {
        $response = $this->actingAs($this->admin)->post('/penyewaan', [
            'customer_id' => $this->customer->id,
            'mobil_id' => $this->mobil->id,
            'tanggal_sewa' => '2026-06-01',
            'jam_sewa' => '08:00',
            'tanggal_kembali' => '2026-06-03',
            'jam_kembali' => '17:00',
            'total_harga' => 700000,
            'denda_per_jam' => 25000,
        ]);

        $response->assertRedirect('/penyewaan');
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('penyewaan', ['customer_id' => $this->customer->id]);
    }

    public function test_store_penyewaan_fails_if_mobil_not_available(): void
    {
        $this->mobil->update(['status_mobil' => 'disewa']);

        $response = $this->actingAs($this->admin)->post('/penyewaan', [
            'customer_id' => $this->customer->id,
            'mobil_id' => $this->mobil->id,
            'tanggal_sewa' => '2026-06-01',
            'tanggal_kembali' => '2026-06-03',
            'total_harga' => 700000,
            'denda_per_jam' => 25000,
        ]);

        $response->assertStatus(404);
    }

    public function test_delete_penyewaan(): void
    {
        $penyewaan = $this->seedPenyewaan();

        $response = $this->actingAs($this->admin)->delete("/penyewaan/{$penyewaan->id}");
        $response->assertRedirect('/penyewaan');
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('penyewaan', ['id' => $penyewaan->id]);
    }

    public function test_store_sets_mobil_to_disewa(): void
    {
        $this->actingAs($this->admin)->post('/penyewaan', [
            'customer_id' => $this->customer->id,
            'mobil_id' => $this->mobil->id,
            'tanggal_sewa' => '2026-06-01',
            'jam_sewa' => '08:00',
            'tanggal_kembali' => '2026-06-03',
            'jam_kembali' => '17:00',
            'total_harga' => 700000,
            'denda_per_jam' => 25000,
        ]);

        $this->assertEquals('disewa', $this->mobil->fresh()->status_mobil);
    }

    protected function seedPenyewaan()
    {
        return Penyewaan::create([
            'customer_id' => $this->customer->id,
            'mobil_id' => $this->mobil->id,
            'user_id' => $this->admin->id,
            'tanggal_sewa' => '2026-06-01',
            'jam_sewa' => '08:00',
            'tanggal_kembali' => '2026-06-03',
            'jam_kembali' => '17:00',
            'lama_sewa' => 2,
            'total_harga' => 700000,
            'denda_per_jam' => 25000,
            'status' => 'aktif',
        ]);
    }
}
