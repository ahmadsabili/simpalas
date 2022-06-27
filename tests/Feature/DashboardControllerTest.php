<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardControllerTest extends TestCase
{
    /** @test */
    public function it_redirected_admin_dashboard()
    {
        $response = $this->get('/admin');
        $response->assertStatus(200);
        $response->assertViewIs('admin.dashboard');
        $response->assertSee('Dashboard');
    }

    
    /** @test */
    public function it_shows_admin_dashboard_data() {
        
    }

    /** @test */
    public function it_redirected_spp_dashboard() {
        $response = $this->get('/komite');
        $response->assertStatus(200);
        $response->assertViewIs('spp.dashboard');
        $response->assertSee('Dashboard');
    }
}
