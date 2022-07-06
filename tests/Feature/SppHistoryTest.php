<?php

namespace Tests\Feature;

use App\Models\Kelas;
use App\Models\PembayaranSpp;
use App\Models\Student;
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
        $response = $this->get(route('spp.riwayat.index'));
        $response->assertStatus(200);
    }

    public function test_data_pembayaran_spp_dapat_ditampilkan()
    {
        $this->withoutExceptionHandling();

        $response = $this->get(route('spp.riwayat.index'));
        $response->assertStatus(200);

        Kelas::factory()->count(20)->create();
        Student::factory()->count(10)->create();

        PembayaranSpp::create([
            'id_siswa' => 1,
            'tahun_ajaran' => '2020/2021',
            'bulan' => 'Januari',
            'nominal' => 100000
        ]);
        $response->assertSee('Riwayat Pembayaran');
        $pembayaran = PembayaranSpp::with(['siswa.kelas'])->where('id_siswa', 1)->first();
    }
}
