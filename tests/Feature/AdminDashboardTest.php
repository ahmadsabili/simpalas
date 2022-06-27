<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_halaman_dashboard_admin_dapat_dikunjungi()
    {
        $response = $this->get('/admin');
        $response->assertStatus(200);
    }

    public function test_data_dashboard_admin_dapat_ditampilkan()
    {
        $response = $this->get('/admin');
        $response->assertStatus(200);
    }
}
