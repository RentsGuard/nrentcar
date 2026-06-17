<?php

namespace Tests\Feature;

use App\Models\Mobil;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class MobilTest extends TestCase
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

    public function test_index_shows_mobils(): void
    {
        Mobil::create([
            'nama_mobil' => 'Toyota Avanza',
            'plat_mobil' => 'B 1234 XYZ',
            'tahun_mobil' => 2023,
            'tipe_mobil' => 'Matic',
            'kapasitas_mobil' => 7,
            'bahan_bakar' => 'Bensin',
            'harga_mobil' => 350000,
            'status_mobil' => 'tersedia',
            'managed_by' => $this->admin->id,
        ]);

        $response = $this->actingAs($this->admin)->get('/mobil');
        $response->assertStatus(200);
        $response->assertSee('Toyota Avanza');
    }

    public function test_create_mobil_form(): void
    {
        $response = $this->actingAs($this->admin)->get('/mobil/create');
        $response->assertStatus(200);
    }

    public function test_store_mobil(): void
    {
        $response = $this->actingAs($this->admin)->post('/mobil', [
            'nama_mobil' => 'Honda Brio',
            'plat_mobil' => 'D 5678 ABC',
            'tahun_mobil' => 2024,
            'tipe_mobil' => 'Matic',
            'kapasitas_mobil' => 5,
            'bahan_bakar' => 'Bensin',
            'harga_mobil' => 250000,
            'status_mobil' => 'tersedia',
        ]);

        $response->assertRedirect('/mobil');
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('mobil', ['plat_mobil' => 'D 5678 ABC']);
    }

    public function test_update_mobil(): void
    {
        $mobil = Mobil::create([
            'nama_mobil' => 'Toyota Avanza',
            'plat_mobil' => 'B 1234 XYZ',
            'tahun_mobil' => 2023,
            'tipe_mobil' => 'Matic',
            'kapasitas_mobil' => 7,
            'bahan_bakar' => 'Bensin',
            'harga_mobil' => 350000,
            'status_mobil' => 'tersedia',
            'managed_by' => $this->admin->id,
        ]);

        $response = $this->actingAs($this->admin)->put("/mobil/{$mobil->id}", [
            'nama_mobil' => 'Toyota Avanza Update',
            'plat_mobil' => 'B 1234 XYZ',
            'tahun_mobil' => 2023,
            'tipe_mobil' => 'Matic',
            'kapasitas_mobil' => 7,
            'bahan_bakar' => 'Bensin',
            'harga_mobil' => 400000,
            'status_mobil' => 'tersedia',
        ]);

        $response->assertRedirect('/mobil');
        $this->assertDatabaseHas('mobil', ['harga_mobil' => 400000]);
    }

    public function test_delete_mobil(): void
    {
        $mobil = Mobil::create([
            'nama_mobil' => 'Toyota Avanza',
            'plat_mobil' => 'B 1234 XYZ',
            'tahun_mobil' => 2023,
            'tipe_mobil' => 'Matic',
            'kapasitas_mobil' => 7,
            'bahan_bakar' => 'Bensin',
            'harga_mobil' => 350000,
            'status_mobil' => 'tersedia',
            'managed_by' => $this->admin->id,
        ]);

        $response = $this->actingAs($this->admin)->delete("/mobil/{$mobil->id}");
        $response->assertRedirect('/mobil');
        $this->assertNotNull($mobil->fresh()->deleted_at);
    }
}
