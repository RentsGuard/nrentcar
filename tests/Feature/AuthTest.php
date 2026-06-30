<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

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
        $response->assertSessionHas('attempts_left');
    }

    public function test_login_rate_limit_blocks_after_5_attempts(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $this->post('/login', [
                'email' => 'spam@test.com',
                'password' => 'wrongpass',
            ]);
        }

        $response = $this->post('/login', [
            'email' => 'spam@test.com',
            'password' => 'wrongpass',
        ]);

        $response->assertSessionHas('error');
        $this->assertStringContainsString('Terlalu banyak', session('error'));
    }

    public function test_login_shows_attempts_left_after_failure(): void
    {
        $this->get('/login');

        $response = $this->followingRedirects()->post('/login', [
            'email' => 'user@test.com',
            'password' => 'wrongpass',
        ]);

        $response->assertSee('Sisa percobaan');
        $response->assertSee('4');
    }

    public function test_logout(): void
    {
        $user = User::where('email', 'admin@test.com')->first();

        $response = $this->actingAs($user)->post('/logout');

        $response->assertRedirect('/login');
    }
}
