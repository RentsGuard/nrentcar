<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::create([
            'nama_user' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('123456'),
            'role' => 'admin',
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
            'berlaku_hingga' => '2032-02-02',
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
}
