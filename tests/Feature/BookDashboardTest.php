<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookDashboardTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_halaman_dashboard_buku_dapat_dikunjungi()
    {
        $response = $this->get('/buku');
        $response->assertStatus(200);
        $response->assertSee('Dashboard');
    }

    public function test_data_dashboard_buku_dapat_ditampilkan()
    {
        $response = $this->get('/buku');
        $response->assertStatus(200);
    }
}
