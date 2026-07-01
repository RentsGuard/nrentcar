<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Mobil;
use App\Models\Penyewaan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    protected User $staff;

    protected Mobil $mobil;

    protected function setUp(): void
    {
        parent::setUp();

        User::create([
            'nama_user' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('123456'),
            'role' => 'admin',
        ]);

        $this->staff = User::create([
            'nama_user' => 'Staff',
            'email' => 'staff@test.com',
            'password' => Hash::make('123456'),
            'role' => 'staff',
        ]);

        $this->mobil = Mobil::create([
            'nama_mobil' => 'Test Car',
            'plat_mobil' => 'B 9999 TST',
            'tahun_mobil' => 2024,
            'tipe_mobil' => 'Matic',
            'kapasitas_mobil' => 3,
            'bahan_bakar' => 'Bensin',
            'harga_mobil' => 350000,
            'status_mobil' => 'tersedia',
        ]);
    }

    public function test_staff_cannot_access_admin_dashboard(): void
    {
        $response = $this->actingAs($this->staff)->get('/admin/dashboard');
        $response->assertStatus(403);
    }

    public function test_admin_cannot_access_staff_dashboard(): void
    {
        $admin = User::where('email', 'admin@test.com')->first();
        $response = $this->actingAs($admin)->get('/staff/dashboard');
        $response->assertStatus(403);
    }

    public function test_staff_cannot_access_staff_management(): void
    {
        $response = $this->actingAs($this->staff)->get('/staff');
        $response->assertStatus(403);
    }

    public function test_staff_cannot_access_role_settings(): void
    {
        $response = $this->actingAs($this->staff)->get('/pengaturan/role-akses');
        $response->assertStatus(403);
    }

    public function test_staff_cannot_toggle_visibility(): void
    {
        $response = $this->actingAs($this->staff)->put("/mobil/{$this->mobil->id}/toggle-visibility");
        $response->assertStatus(403);
    }

    public function test_staff_cannot_delete_mobil(): void
    {
        $response = $this->actingAs($this->staff)->delete("/mobil/{$this->mobil->id}");
        $response->assertStatus(403);
    }

    public function test_guest_redirected_to_login(): void
    {
        $response = $this->get('/mobil');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_guest_can_access_public_cars(): void
    {
        $response = $this->get('/cars');
        $response->assertStatus(200);
    }

    public function test_guest_can_access_tentang(): void
    {
        $response = $this->get('/tentang-kami');
        $response->assertStatus(200);
    }

    public function test_admin_can_delete_staff_with_penyewaan(): void
    {
        $admin = User::where('email', 'admin@test.com')->first();
        $customer = Customer::factory()->create(['status_verifikasi' => 'disetujui']);

        $penyewaan = Penyewaan::create([
            'customer_id' => $customer->id,
            'mobil_id' => $this->mobil->id,
            'user_id' => $this->staff->id,
            'tanggal_sewa' => now(),
            'tanggal_kembali' => now()->addDay(),
            'lama_sewa' => 1,
            'total_harga' => 350000,
            'status' => 'aktif',
        ]);

        $response = $this->actingAs($admin)->delete("/staff/{$this->staff->id}");
        $response->assertStatus(302);
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('users', ['id' => $this->staff->id]);
        $this->assertDatabaseHas('penyewaan', ['id' => $penyewaan->id, 'user_id' => null]);
    }
}
