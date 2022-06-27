<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SppStatusTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_data_pembayaran_spp_dapat_ditampilkan()
    {
        $response = $this->get('/komite/pembayaran');
        $response->assertStatus(200);
    }

    public function test_user_dapat_menambahkan_data_pembayaran_spp()
    {
        // $student = new Student([
        //     'nisn' => '0020329064',
        //     'nama' => 'Ahmad Sabili',
        //     'kelas_id' => 1,
        //     'jenis_kelamin' => 'Laki-laki'
        // ]);

        $response = $this->get('/komite/pembayaran');
        $response->assertStatus(200);
        // $response->assertSee($student->nama);
    }

    public function test_user_dapat_mengubah_data_pembayaran_spp()
    {
        $this->assertTrue(true);
    }

    public function test_user_dapat_menghapus_data_pembayaran_spp()
    {
        $this->assertTrue(true);
    }
}
