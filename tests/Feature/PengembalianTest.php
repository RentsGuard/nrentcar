<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Mobil;
use App\Models\Pengembalian;
use App\Models\Penyewaan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PengembalianTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected Penyewaan $penyewaan;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::create([
            'nama_user' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('123456'),
            'role' => 'admin',
        ]);

        $customer = Customer::create([
            'nama_customer' => 'Budi Santoso',
            'no_hp' => '081234567890',
            'nik' => '3174010101900001',
            'alamat_customer' => 'Jl. Merdeka No. 1',
        ]);

        $mobil = Mobil::create([
            'nama_mobil' => 'Toyota Avanza',
            'plat_mobil' => 'B 1234 XYZ',
            'tahun_mobil' => 2023,
            'tipe_mobil' => 'Matic',
            'kapasitas_mobil' => 3,
            'bahan_bakar' => 'Bensin',
            'harga_mobil' => 350000,
            'status_mobil' => 'disewa',
            'managed_by' => $this->admin->id,
        ]);

        $this->penyewaan = Penyewaan::create([
            'customer_id' => $customer->id,
            'mobil_id' => $mobil->id,
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

    public function test_index_shows_pengembalians(): void
    {
        $response = $this->actingAs($this->admin)->get('/pengembalian');
        $response->assertStatus(200);
    }

    public function test_create_form_loads(): void
    {
        $response = $this->actingAs($this->admin)->get('/pengembalian/create');
        $response->assertStatus(200);
    }

    public function test_store_pengembalian(): void
    {
        $response = $this->actingAs($this->admin)->post('/pengembalian', [
            'penyewaan_id' => $this->penyewaan->id,
            'kondisi_mobil' => 'Baik',
            'catatan' => 'Tepat waktu',
        ]);

        $response->assertRedirect('/pengembalian');
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('pengembalian', ['penyewaan_id' => $this->penyewaan->id]);
    }

    public function test_store_sets_penyewaan_selesai(): void
    {
        $this->actingAs($this->admin)->post('/pengembalian', [
            'penyewaan_id' => $this->penyewaan->id,
            'kondisi_mobil' => 'Baik',
        ]);

        $this->assertEquals('selesai', $this->penyewaan->fresh()->status);
    }

    public function test_store_fails_for_non_active_penyewaan(): void
    {
        $this->penyewaan->update(['status' => 'selesai']);

        $response = $this->actingAs($this->admin)->post('/pengembalian', [
            'penyewaan_id' => $this->penyewaan->id,
            'kondisi_mobil' => 'Baik',
        ]);

        $response->assertStatus(404);
    }

    public function test_delete_pengembalian(): void
    {
        $pengembalian = Pengembalian::create([
            'penyewaan_id' => $this->penyewaan->id,
            'tanggal_pengembalian' => now(),
            'telat_jam' => 0,
            'denda_per_jam' => 0,
            'denda_telat' => 0,
            'denda_kerusakan' => 0,
            'total_denda' => 0,
            'status_pengembalian' => 'tepat_waktu',
            'user_id' => $this->admin->id,
        ]);
        $this->penyewaan->update(['status' => 'selesai']);

        $response = $this->actingAs($this->admin)->delete("/pengembalian/{$pengembalian->id}");
        $response->assertRedirect('/pengembalian');
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('pengembalian', ['id' => $pengembalian->id]);
    }

    public function test_delete_reverts_penyewaan_to_aktif(): void
    {
        $pengembalian = Pengembalian::create([
            'penyewaan_id' => $this->penyewaan->id,
            'tanggal_pengembalian' => now(),
            'telat_jam' => 0,
            'denda_per_jam' => 0,
            'denda_telat' => 0,
            'denda_kerusakan' => 0,
            'total_denda' => 0,
            'status_pengembalian' => 'tepat_waktu',
            'user_id' => $this->admin->id,
        ]);
        $this->penyewaan->update(['status' => 'selesai']);

        $this->actingAs($this->admin)->delete("/pengembalian/{$pengembalian->id}");

        $this->assertEquals('aktif', $this->penyewaan->fresh()->status);
    }
}
