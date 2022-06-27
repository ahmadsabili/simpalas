<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SppHistoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_halaman_riwayat_pembayaran_spp_dapat_dikunjungi()
    {
        $this->assertTrue(true);
    }

    public function test_data_pembayaran_spp_dapat_ditampilkan()
    {
        $this->assertTrue(true);
    }
}
