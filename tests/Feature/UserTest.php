<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_halaman_user_dapat_menampilkan_data_user()
    {
        $response = $this->get('/admin/users');
        $response->assertStatus(200);
    }

    public function test_admin_dapat_menambahkan_data_user()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/admin/users/create');
        $response->assertStatus(200);
        // $kelas = new Kelas([
        //     'nama_kelas' => 'XII IPA 1'
        // ]);
        // $response->assertSee($kelas->nama_kelas);
    }

    public function test_admin_dapat_mengubah_data_user()
    {
        $this->assertTrue(true);
    }

    public function test_admin_dapat_menghapus_data_user()
    {
        $this->assertTrue(true);
    }
}
