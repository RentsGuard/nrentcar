<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected User $staff;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::create([
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
    }

    public function test_index_shows_customers(): void
    {
        Customer::create([
            'nama_customer' => 'Budi Santoso',
            'no_hp' => '081234567890',
            'nik' => '3174010101900001',
            'alamat_customer' => 'Jl. Merdeka No. 1',
        ]);

        $response = $this->actingAs($this->admin)->get('/customer');
        $response->assertStatus(200);
        $response->assertSee('Budi Santoso');
    }

    public function test_store_customer(): void
    {
        $response = $this->actingAs($this->admin)->post('/customer', [
            'nama_customer' => 'Siti Nurhaliza',
            'email' => 'siti@test.com',
            'no_hp' => '081234567891',
            'nik' => '3273010202900002',
            'alamat_customer' => 'Jl. Braga No. 78',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '1992-02-02',
            'jenis_kelamin' => 'P',
            'agama' => 'Islam',
            'status_perkawinan' => 'Belum Kawin',
            'pekerjaan' => 'Karyawan Swasta',
            'kewarganegaraan' => 'WNI',
        ]);

        $response->assertRedirect('/customer');
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('customers', ['nik' => '3273010202900002']);
    }

    public function test_delete_customer(): void
    {
        $customer = Customer::create([
            'nama_customer' => 'Budi Santoso',
            'no_hp' => '081234567890',
            'nik' => '3174010101900001',
            'alamat_customer' => 'Jl. Merdeka No. 1',
        ]);

        $response = $this->actingAs($this->admin)->delete("/customer/{$customer->id}");
        $response->assertRedirect('/customer');
        $this->assertDatabaseMissing('customers', ['id' => $customer->id]);
    }

    public function test_staff_cannot_update_customer_verification_fields(): void
    {
        $customer = Customer::create([
            'nama_customer' => 'Budi Santoso',
            'no_hp' => '081234567890',
            'nik' => '3174010101900001',
            'alamat_customer' => 'Jl. Merdeka No. 1',
        ]);

        $response = $this->actingAs($this->staff)->put("/customer/{$customer->id}", [
            'nama_customer' => 'Budi Santoso',
            'no_hp' => '081234567890',
            'nik' => '3174010101900001',
            'alamat_customer' => 'Jl. Merdeka No. 1',
            'status_verifikasi' => 'disetujui',
            'catatan_verifikasi' => 'Approved by staff',
        ]);

        $response->assertRedirect('/customer');
        $this->assertDatabaseHas('customers', [
            'id' => $customer->id,
            'status_verifikasi' => null,
            'catatan_verifikasi' => null,
            'verified_by' => null,
        ]);
    }

    public function test_ktp_upload_is_stored_on_private_disk(): void
    {
        Storage::fake('local');
        Storage::fake('public');

        $response = $this->actingAs($this->admin)->post('/customer', [
            'nama_customer' => 'Siti Nurhaliza',
            'email' => 'siti.private@test.com',
            'no_hp' => '081234567899',
            'nik' => '3273010202900009',
            'alamat_customer' => 'Jl. Braga No. 78',
            'foto_ktp' => UploadedFile::fake()->image('ktp.jpg'),
        ]);

        $response->assertRedirect('/customer');

        $customer = Customer::where('nik', '3273010202900009')->firstOrFail();
        Storage::disk('local')->assertExists($customer->foto_ktp);
        Storage::disk('public')->assertMissing($customer->foto_ktp);
    }

    public function test_guest_cannot_access_ktp_image(): void
    {
        $customer = Customer::create([
            'nama_customer' => 'Budi Santoso',
            'no_hp' => '081234567890',
            'nik' => '3174010101900001',
            'alamat_customer' => 'Jl. Merdeka No. 1',
            'foto_ktp' => 'foto_ktp/private.jpg',
        ]);

        $response = $this->get("/customer/{$customer->id}/ktp");
        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_access_private_ktp_image_without_cache(): void
    {
        Storage::fake('local');
        Storage::disk('local')->put('foto_ktp/private.jpg', 'fake-image');

        $customer = Customer::create([
            'nama_customer' => 'Budi Santoso',
            'no_hp' => '081234567890',
            'nik' => '3174010101900001',
            'alamat_customer' => 'Jl. Merdeka No. 1',
            'foto_ktp' => 'foto_ktp/private.jpg',
        ]);

        $response = $this->actingAs($this->admin)->get("/customer/{$customer->id}/ktp");

        $response->assertOk();
        $this->assertStringContainsString('no-store', $response->headers->get('Cache-Control'));
    }
}
