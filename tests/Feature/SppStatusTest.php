<?php

namespace Tests\Feature;

use App\Models\Kelas;
use App\Models\PembayaranSpp;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class SppStatusTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_data_pembayaran_spp_dapat_ditampilkan()
    {
        $this->withoutExceptionHandling();
        Kelas::factory()->count(20)->create();
        Student::factory()->count(10)->create();

        $response = $this->get(route('spp.status.show', 1));
        $response->assertStatus(200);
        $response->assertSee('Status Pembayaran');

        $pembayaran = PembayaranSpp::with(['student', 'kelas'])->where('id_siswa', 1)->first();
        $response->assertSee($pembayaran);
    }

    public function test_user_dapat_menambahkan_data_pembayaran_spp()
    {
        $this->withoutExceptionHandling();
        Kelas::factory()->count(10)->create();
        $siswa = Student::create([
            'nisn' => '0020329064',
            'nama' => 'Ahmad Sabili',
            'kelas_id' => 1,
            'jenis_kelamin' => 'Laki-laki',
        ]);

        $response = $this->get(route('spp.pembayaran.create', $siswa->nisn));
        $response->assertStatus(200);
        $response->assertSee('Tambah Pembayaran');

        PembayaranSpp::create([
            'id_siswa' => $siswa->id,
            'tahun_ajaran' => '2020/2021',
            'bulan' => 'Januari',
            'nominal' => '100000',
        ]);
    }

    public function test_user_dapat_menghapus_data_pembayaran_spp()
    {
        $this->withoutExceptionHandling();
        
        Kelas::factory()->count(10)->create();
        $siswa = Student::create([
            'nisn' => '0020329064',
            'nama' => 'Ahmad Sabili',
            'kelas_id' => 1,
            'jenis_kelamin' => 'Laki-laki',
        ]);
        $pembayaran = PembayaranSpp::create([
            'id_siswa' => $siswa->id,
            'tahun_ajaran' => '2020/2021',
            'bulan' => 'Januari',
            'nominal' => '100000',
        ]);

        PembayaranSpp::find($pembayaran->id)->delete();

        $this->assertDatabaseMissing('pembayaran_spp', [
            'id_siswa' => $siswa->id,
            'tahun_ajaran' => '2020/2021',
            'bulan' => 'Januari',
            'nominal' => '100000',
        ]);
    }
}
