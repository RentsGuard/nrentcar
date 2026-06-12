<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        User::create([
            'nama_user' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('123456'),
            'role' => 'admin',
        ]);

        User::create([
            'nama_user' => 'Staff',
            'email' => 'staff@test.com',
            'password' => Hash::make('123456'),
            'role' => 'staff',
        ]);
    }

    public function test_login_page_loads(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_admin_login_redirects_to_admin_dashboard(): void
    {
        $response = $this->post('/login', [
            'email' => 'admin@test.com',
            'password' => '123456',
        ]);

        $response->assertRedirect('/admin/dashboard');
    }

    public function test_staff_login_redirects_to_staff_dashboard(): void
    {
        $response = $this->post('/login', [
            'email' => 'staff@test.com',
            'password' => '123456',
        ]);

        $response->assertRedirect('/staff/dashboard');
    }

    public function test_login_with_invalid_credentials(): void
    {
        $response = $this->post('/login', [
            'email' => 'wrong@test.com',
            'password' => 'wrongpass',
        ]);

        $response->assertSessionHas('error');
    }

    public function test_logout(): void
    {
        $user = User::where('email', 'admin@test.com')->first();

        $response = $this->actingAs($user)->post('/logout');

        $response->assertRedirect('/login');
    }
}
