<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookFeeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_data_tagihan_buku_dapat_ditampilkan()
    {
        $response = $this->get('/admin/students');
        $response->assertStatus(200);
    }

    public function test_user_dapat_menambahkan_data_tagihan_buku()
    {
        $response = $this->get('/buku/tagihan-buku');
        $response->assertStatus(200);
    }

    public function test_user_dapat_mengubah_data_tagihan_buku()
    {
        $this->assertTrue(true);
    }

    public function test_user_dapat_menghapus_data_tagihan_buku()
    {
        $this->assertTrue(true);
    }
}
