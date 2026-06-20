<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    protected User $staff;

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

    public function test_staff_cannot_delete_mobil(): void
    {
        $response = $this->actingAs($this->staff)->delete('/mobil/1');
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
}
