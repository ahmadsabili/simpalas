<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SppDashboardTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_halaman_dashboard_spp_dapat_dikunjungi()
    {
        $response = $this->get('/komite');
        $response->assertStatus(200);
    }

    public function test_data_dashboard_spp_dapat_ditampilkan()
    {
        $response = $this->get('/komite');
        $response->assertStatus(200);
    }
}
