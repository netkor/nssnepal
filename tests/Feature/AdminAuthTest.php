<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthenticated_users_cannot_access_admin_dashboard(): void
    {
        $response = $this->get('/admin/dashboard');
        
        $response->assertStatus(302);
        $response->assertRedirect('/admin/login');
    }

    public function test_authenticated_admin_can_access_admin_dashboard(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/admin/dashboard');
        
        $response->assertStatus(200);
    }
    
    public function test_admin_login_page_loads_correctly(): void
    {
        $response = $this->get('/admin/login');
        
        $response->assertStatus(200);
        $response->assertSee('Admin Login');
    }
}
