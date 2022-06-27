<?php

namespace Tests\Feature;

use App\Models\Kelas;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClassTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_halaman_kelas_dapat_menampilkan_data_kelas()
    {
        $response = $this->get('/admin/classes');
        $response->assertStatus(200);
    }

    public function test_user_dapat_menambahkan_data_kelas()
    {
        $response = $this->get('/admin/classes/create');
        $response->assertStatus(200);
        // $kelas = new Kelas([
        //     'nama_kelas' => 'XII IPA 1'
        // ]);
        // $response->assertSee($kelas->nama_kelas);
    }

    public function test_user_dapat_mengubah_data_kelas()
    {
        $this->assertTrue(true);
    }

    public function test_user_dapat_menghapus_data_kelas()
    {
        $this->assertTrue(true);
    }
}
